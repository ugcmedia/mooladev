<?php
namespace App\Http\Controllers\MemberController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Member;
use Session;
use Auth;
use Validator;
use Hash;
use Mail;
use App\Helpers\AppClass;
/**
 *
 */
class ReferEarnController extends Controller
{

    public function index() {

        $data['page_data']       = DB::table('tb_cashback_widgets')->wherecb_page('ReferEarn')->first();
        $data['invited']         = DB::table('tb_user_invites')->whereuser_id(Auth::guard('member')->id())->orderBy('invite_date','desc')->get();
        $data['referedUser']     =
          DB::table('tb_cashback_users')->where('referred_by', Session::get('memberDetail')->referral_code )->get();

        // DB::select('SELECT * FROM `tb_user_referrals` ur,`tb_cashback_users` cu WHERE user_id = '.Auth::guard('member')->id().' AND ref_id = member_id ORDER BY awarded_date desc');
        return view('member-dash.refer-earn.index',compact('data'));
    }

    public function store(Request $request) {
      $validator = Validator::make($request->all(),[
              'reason'              => 'required|max:255',
              'sub_reason'          => 'required|max:255',
              'message'             => 'required|min:10',
          ]);

      if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->with('error')->withInput();
      }
       $insertContactUs = DB::table('tb_contacts')->insert(['name' => Session::get('memberDetail')->first_name,'email' => Session::get('memberDetail')->email,
        'message' =>$request->message,'reason' => $request->reason,'sub_reason' => $request->sub_reason]);
       if($insertContactUs) {
         return redirect()->back()->with('success',trans('actionMsg.refer_earn_submit_success'));
       }
       else {
         return redirect()->back()->with('error',trans('actionMsg.refer_earn_error'));
       }

    }


    public function sendMultipleEmail(Request $request) {

      $getMails      = $this->RemoveFilterComma($request->mul_email);
      $explodedMail  = explode(',',$getMails);
      $getReferalAmt = config('settingConfig.mlm_split').'% ';
      $urlJoinNow    = AppClass::getPageUrl('join-us-now');
      $bonusAMT      = 0;

      $srcArr           = ['#RefCode','#REFLINK'];
      $rplArr           = [Session::get('memberDetail')->referral_code,url('/').'/'.$urlJoinNow.'?referal_code='.Session::get('memberDetail')->referral_code];

      $getEmailTemp     = AppClass::getTemplateByKey('referral_preview');
      $subject          = $getEmailTemp->subject;
      $subject          = str_ireplace('#JoiningBonusAmount',$getReferalAmt,$subject);
      $purpose          = $getEmailTemp->purpose;
      $sender_name      = $getEmailTemp->sender_name;
      $sender_email     = $getEmailTemp->sender_email;
      $reply_to         = $getEmailTemp->reply_to;
      $cc_email         = $getEmailTemp->cc_email;
      $body             = $getEmailTemp->body;
      $body             = str_ireplace($srcArr,$rplArr,$body);
      $smsBody          = $getEmailTemp->sms_body;

      if($getEmailTemp->sms_enabled == 'Y') {
      //    AppClass::sendSMSWithName($user->mobile_number,$smsBody);
      }

      foreach ($explodedMail as $key => $value) {

         if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
           return redirect()->back()->with('error',trans('actionMsg.refer_earn_email_error'));
         }
        AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$value);
        DB::table('tb_user_invites')->insert(['user_id' => Auth::guard('member')->id(),'invitee_email' => $value,'invite_date' => date('y-m-d H:i:s')]);
      }
      return redirect()->back()->with('success',trans('actionMsg.refer_earn_invite_success'));

    }

}
