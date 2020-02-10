<?php

namespace Hazzard\Comments\Http\Controllers;

use Illuminate\Http\Request;
use Hazzard\Comments\Comment;
use Illuminate\Routing\Controller;
use Hazzard\Comments\ThrottlesPosts;
use Hazzard\Comments\ScriptVariables;
use Hazzard\Comments\Contracts\Formatter;
use Hazzard\Comments\Events\CommentWasPosted;
use Hazzard\Comments\Http\Requests\BulkUpdate;
use Hazzard\Comments\Http\Requests\StoreComment;
use Hazzard\Comments\Http\Requests\UpdateComment;
use Hazzard\Comments\Contracts\CommentRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Session;
use DB;

class CommentController extends Controller
{
    use ThrottlesPosts,
        AuthorizesRequests;

    /**
     * @var \Hazzard\Comments\Contracts\CommentRepository
     */
    protected $comments;

    /**
     * @var \Hazzard\Comments\Contracts\Formatter
     */
    protected $formatter;

    /**
     * Create a new controller instance.
     *
     * @param  \Hazzard\Comments\Contracts\CommentRepository $comments
     * @param  \Hazzard\Comments\Contracts\Formatter $formatter
     * @return void
     */
    public function __construct(CommentRepository $comments, Formatter $formatter)
    {
        $this->comments = $comments;
        $this->formatter = $formatter;

        $this->middleware('auth', ['only' => ['update', 'destroy', 'bulkUpdate']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($id = $request->id) {
            return $this->comments->findOrFail($id);
        }

        $pageId = $request->page_id;
        $commentableId = $request->commentable_id;
        $commentableType = $request->commentable_type;
        $canModerate = $request->user() && $request->user()->can('moderate', Comment::class);

        if (! ($commentableId || $commentableType) && ! $pageId && ! $canModerate) {
            return response()->json('The page_id or commentable_id and commentable_type are missing.', 400);
        }

        $args = $request->only('commentable_id', 'commentable_type', 'page_id', 'page', 'order', 'target');

        if(Auth::guard('member')->check()) {
            $args['user_id'] = Auth::guard('member')->id();
        } elseif ($email = $request->cookie('comment_author_email')) {
            $args['email'] = $email;
        }

        if ( $canModerate) {
            $args['hide_user_details'] = true;
        }

        $comments = $this->comments->get($args)->toArray();
        for ($i=0; $i < count($comments['comments']); $i++) {
            if($comments['comments'][$i]['user_id'] != null ) {
                $getUser = DB::table('tb_cashback_users')->where('member_id',$comments['comments'][$i]['user_id'])->first();
                if($getUser) {
                  if($getUser->creation_mode == 'D' || $getUser->profile_picture != null &&$getUser->profile_picture != '')
                    {
                      if($getUser->profile_picture !='' && $getUser->profile_picture != null)
                        $avatar = asset('uploads/images/user'.'/'.$getUser->profile_picture);
                      else
                        $avatar = asset('uploads/images/user_default.png');
                    }
                  else {
                      $avatar = $getUser->social_link;
                  }
                    $comments['comments'][$i]['author_name']    =  $getUser->first_name;
                    $comments['comments'][$i]['author_email']   =  $getUser->email;
                    $comments['comments'][$i]['author_avatar']  =  $avatar;
                }
            }
        }

        // if(Auth::guard('member')->check()) {
        //     $comments['author_name']  = Session::get('memberDetail')->first_name;
        //     $comments['author_email']  = Session::get('memberDetail')->email;
        //   }

        if (($request->ajax() && ! $request->pjax()) || $request->wantsJson()) {
            return $comments;
        }

        ScriptVariables::add('data.comments', $comments);

        return view('comments::comments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Hazzard\Comments\Http\Requests\StoreComment $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request)
    {

        $throttle = $this->shouldThrottlePosts($request);

        if ($throttle && $this->hasTooManyPostAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        if(Auth::guard('member')->check()) {
          $request['author_name'] = Session::get('memberDetail')->first_name;
          $request['author_email'] = Session::get('memberDetail')->email;
        }
        $comment = $this->comments->create(
            $this->getStoreInput($request)
        );

        if ($throttle) {
            $this->incrementPostAttempts($request);
        }
        // if($request->commentable_type == 'App.Posts') {
        //
        // }
        
        event(new CommentWasPosted($comment));

        if ($request->user()) {
            return response()->json($comment, 201);
        }

        return response()->json($comment, 201)->withCookie(
            cookie()->forever('comment_author_email', $comment->author_email)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Hazzard\Comments\Http\Requests\UpdateComment $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComment $request, $id)
    {	
	
        $comment = $this->comments->findOrFail($id);
        // $this->authorize('update', $comment);
		
       if (Auth::check()) {
            $input = array_filter($request->only('content', 'status', 'author_name', 'author_email', 'author_url'));
        } else {
            $input = $request->only('content');
        }
		
        /*   DB::statement("UPDATE  `tb_coupons` tc LEFT OUTER JOIN (SELECT COUNT(DISTINCT cm2.id) ccount,cm2.commentable_id   FROM `comments` cm1 , `comments` cm2 WHERE cm1.id = {$id} AND cm1.commentable_id = cm2.commentable_id AND cm2.status = 'approved' GROUP BY  cm2.commentable_id) cont ON  coupon_id = commentable_id
			SET tc.comment_count = IFNULL(cont.ccount,0)");
        
           DB::statement("UPDATE  `tb_coupons` tc LEFT OUTER JOIN (SELECT COUNT(*) ccount,commentable_id FROM `comments` WHERE commentable_type = 'App\\Coupons' AND status = 'approved' GROUP BY commentable_id) cont ON  coupon_id = commentable_id
			SET tc.comment_count = IFNULL(cont.ccount,0)
			WHERE commentable_id = ".$id);  */
        
		
        $updateReturn =  $this->comments->update($id, $input);
		if($updateReturn->commentable_type=='App\\Coupons')
		{
			
		 DB::statement("UPDATE `tb_coupons`
		SET comment_count = IFNULL((SELECT COUNT(*) FROM `comments` WHERE commentable_type = 'App\\\\Coupons' AND status = 'approved' AND commentable_id = ".$updateReturn->commentable_id." GROUP BY commentable_id),0)
		WHERE coupon_id = ".$updateReturn->commentable_id);
		
		}
		
		if($updateReturn->commentable_type=='App\\Deals')
		{
			
		 DB::statement("UPDATE `tb_deals`
		SET comments = IFNULL((SELECT COUNT(*) FROM `comments` WHERE commentable_type = 'App\\\\Deals' AND status = 'approved' AND commentable_id = ".$updateReturn->commentable_id." GROUP BY commentable_id),0)
		WHERE deal_id = ".$updateReturn->commentable_id);
		
		}
		
		return $updateReturn;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $comment = $this->comments->findOrFail($id);

      //  $this->authorize('delete', $comment);
        if (Auth::check()) {
          $comment->delete($id);
        }
        return response()->json(null, 204);
    }

    /**
     * Report the specified comment.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, $id)
    {
        $comment = $this->comments->findOrFail($id);

        //$this->authorize('report', $comment);

        $this->comments->report($comment,Auth::guard('member')->id());

        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Hazzard\Comments\Http\Requests\BulkUpdate $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdate(BulkUpdate $request)
    {

      //  $this->authorize('moderate', Comment::class);
      if (Auth::check()) {
        $ids = (array) $request->ids;

        if ($request->status === 'delete') {
            return ['deleted' => $this->comments->deleteByIds($ids)];
        }
      }
        return [
            'updated' => $this->comments->updateStatusByIds($ids, $request->status)
        ];
    }

    /**
     * Render the comment as HTML.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $xml = $this->formatter->parse($request->content);

        return $this->formatter->render($xml);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getStoreInput(Request $request)
    {
        $input = array_merge(
            $request->only(
                'page_id', 'commentable_id', 'commentable_type',
                'root_id', 'parent_id', 'content', 'author_name',
                'author_email', 'author_url', 'permalink', 'referrer'
            ),
            [
                'author_ip' => $request->server('REMOTE_ADDR'),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]
        );

        if (! config('comments.allow_replies')) {
            unset($input['root_id'], $input['parent_id']);
        }
        if(Auth::guard('member')->check()) {
            $input['user_id'] = Auth::guard('member')->id();
          //  unset($input['author_name'], $input['author_email'], $input['author_url']);
        }

        return $input;
    }
}
