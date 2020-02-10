<?php

namespace Hazzard\Comments\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Hazzard\Comments\Http\Requests\StoreVote;
use Hazzard\Comments\Contracts\CommentRepository;
use Auth;

class VoteController extends Controller
{
    /**
     * @var \Hazzard\Comments\Contracts\CommentRepository
     */
    protected $comments;

    /**
     * Create a new controller instance.
     *
     * @param \Hazzard\Comments\Contracts\CommentRepository $comments
     * @return void
     */
    public function __construct(CommentRepository $comments)
    {
      $this->comments = $comments;

      if(!Auth::guard('member')->check()) {
        return 'Unathorized person';
        die;
      }
        //Auth::guard('member')->id();
    }

    /**
     * Upvote the given comment.
     *
     * @param  \Hazzard\Comments\Http\Requests\StoreVote $request
     * @param  int $commentId
     * @return \Illuminate\Http\Response
     */
    public function upvote($commentId)
    {

        $this->comments->upvote($commentId,Auth::guard('member')->id());

        return response()->json(null, 204);
    }

    /**
     * Downvote the given comment.
     *
     * @param  \Hazzard\Comments\Http\Requests\StoreVote $request
     * @param  int $commentId
     * @return \Illuminate\Http\Response
     */
    public function downvote(StoreVote $request, $commentId)
    {
        $this->comments->downvote($commentId, Auth::guard('member')->id());

        return response()->json(null, 204);
    }

    /**
     * Remove the vote for the given comment.
     *
     * @param  \Hazzard\Comments\Http\Requests\StoreVote $request
     * @param  int $commentId
     * @return \Illuminate\Http\Response
     */
    public function remove(StoreVote $request, $commentId)
    {
        $this->comments->removeVote($commentId, Auth::guard('member')->id());

        return response()->json(null, 204);
    }
}
