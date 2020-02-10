<?php
namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use Crypt;
use Session;
use DB;
use Socialize;
use Auth;
use App\Helpers\AppClass;
use Date;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     // validator Rules
     public function rules($id = 0)
     {
       // return [;
     }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */


     public function saveUser(Request $request, Member $member)
     {


            		 // $return = $this->reCaptcha($request->all());
                 //   	if($return !== false)
                 //   	{
                 //   		if($return['success'] !='true')
                 //   		{
                 //
                 //        if(isset($request->from_join))
                 //         {
                 //            return redirect()->back()->with('error', trans('actionMsg.invalid_captcha'))->withInput();
                 //         }
                 //        else
                 //        {
                 //            return redirect()->back()->with('merror',["msg" =>  trans('actionMsg.invalid_captcha'),"type"=>'joniNow'])->withInput();
                 //        }
                 //
                 //
                 //              			  /* if(isset($request->from_join)) {
                 //                        return redirect()->back()->with('error',trans('actionMsg.register_submit_errorjoniNow'))->withInput();
                 //                      }
                 //                      else {
                 //                        return redirect()->back()->with('merror',['msg' => trans('actionMsg.register_submit_errorjoniNow'),'type' =>'joniNow'])->withInput();
                 //                      }
                 //              		 */
                 //   		}
                 //   	}


       $validator = Validator::make($request->all(),[
               'first_name'          => 'required|regex:/^[\pL\s\-]+$/u|max:255',
               'last_name'           => 'regex:/^[\pL\s\-]+$/u|max:255',
               'email'               => 'required|unique:tb_cashback_users,email',
               'password'            => 'required|min:6'
            ]
            );
       if($validator->fails())
        {
          if(isset($request->from_join)) {
            return redirect()->back()->withErrors($validator)->with('error')->withInput();
          }
          else {
            return redirect()->back()->withErrors($validator)->with('serror','joinNow')->withInput();
          }
       }

       //$currentUrl                 = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('/');
	     $refUrl               = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('/');
       $currentUrl           = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : $refUrl;
       //setcookie('redirect_to',$request->previous_url, time()+(3600*60));


       $loginPass                  =  $request->password;
       $request['password']        =  bcrypt($request->password);
       $request['remember_token']  =  str_random(60);
       $request['creation_mode']   =  'D';


       $createUser = $member->Create($request->all());
       // $confirmationCode = Crypt::encrypt($createUser->member_id);

// dd($createUser);

       // print_r($createUser);
       // die();

      if($createUser)

       {
         // echo "fisrt if";
         // die();

        Session::put('email',$createUser->email);
        $confirmationCode =  Crypt::encrypt($createUser->member_id);
        $getEmailTemp     = AppClass::getTemplateByKey('email_verification_signup');
        $subject          = $getEmailTemp->subject;
        $purpose          = $getEmailTemp->purpose;
        $sender_name      = $getEmailTemp->sender_name;
        $sender_email     = $getEmailTemp->sender_email;
        $reply_to         = $getEmailTemp->reply_to;
        $cc_email         = $getEmailTemp->cc_email;
        $body             = $getEmailTemp->body;
        $body             = str_ireplace('#FIRSTNAME',$createUser->first_name,$body);
        $body             = str_ireplace('#LASTNAME',$createUser->last_name,$body);
        $body             = str_ireplace('#VERIFICATION_LINK',url('verifyMail/'.$confirmationCode),$body);
	    	$body             = str_ireplace('#VERIFICATIONLINK',url('verifyMail/'.$confirmationCode),$body);
        $smsBody          = $getEmailTemp->sms_body;
        $smsBody          = str_ireplace('#FIRSTNAME',$createUser->first_name,$smsBody);
        $smsBody          = str_ireplace('#LASTNAME',$createUser->last_name,$smsBody);

        // if($getEmailTemp->sms_enabled == 'Y')
        // {
        //     AppClass::sendSMSWithName($user->mobile_number,$smsBody);
        // }

        AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$createUser->email);




    $referCode = '';

    // if(isset($_GET['referal_code'] ))   {
    //   if($_GET['referal_code'] != null) {
    //       $referCode  = $_GET['referal_code'];
    //    }
    //  }
    //    if($request->referal_code != null) {
    //      $referCode  = $request->refer_code;
    //   }
			 $referCode 		 =  substr(preg_replace('/[^A-Za-z]/', '', strtoupper($createUser->first_name)),0,25).$createUser->member_id;

        $updateData = ['referral_code' => $referCode];

        if($request->refer_code != null || isset($_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'])) {

          $date             = date('y-m-d');


	  if(config('settingConfig.mlm_enabled') =='Y')
		{ $referral_commission = config('settingConfig.mlm_split'); $referral_validity = config('settingConfig.referral_valid_date'); }
			else
			{ $referral_commission = 0; $referral_validity = date('Y-m-d');}



          if($request->refer_code != null) {
            $updateData = ['referral_code' => $referCode,'referred_by' => $request->refer_code, 'referral_commission' =>$referral_commission ,'referral_validity'=>$referral_validity ];
            $memRefId   = Member::wherereferral_code($request->refer_code)->first();

          }
          else if($_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'] != null){
              $updateData = ['referral_code' => $referCode,'referred_by' => $_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'] , 'referral_commission'=>$referral_commission,'referral_validity'=>$referral_validity ];
              $memRefId   = Member::wherereferral_code($_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'])->first();
          }
            $getBonusForJoin = DB::table('tb_bonus_types')->wherebonus_code('join_bonus')->whereenabled('Y')->first();
            if(Count($getBonusForJoin) > 0)  {
              $joinValidity     = date('Y-m-d', strtotime($date. ' +'.$getBonusForJoin->validity_days.'days'));
              //bonus_transaction
              // $insertUserJoin   = DB::table('tb_user_referrals')->insert(['user_id'             => $createUser->member_id,
              //                                                                 'ref_id'          => 0,
              //                                                                 'joined_date'     => date('Y-m-d h:i:s a', time()),
              //                                                                 'bonus_amount'    => $getBonusForJoin->bonus_amount,
              //                                                                 'status'          => 'pending',
              //                                                                 'validity_date'   => $joinValidity
              //   ]);

                $insertUserBonus  = DB::table('tb_user_bonus')->insert(['user_id'     => $createUser->member_id,
                                                                        'bonus_type'  => $getBonusForJoin->bonus_code,
                                                                        'amount'      => $getBonusForJoin->bonus_amount,
                                                                        'date_added'  => date('Y-m-d'),
                                                                        'date_expire' => $joinValidity,
                                                                        'status'      => 'pending']);

            }

            $getBonusForRefer = DB::table('tb_bonus_types')->wherebonus_code('referral_bonus')->whereenabled('Y')->first();

            if(Count($getBonusForRefer) > 0)  {

              $joinValidity          = date('Y-m-d', strtotime($date. ' +'.$getBonusForRefer->validity_days.'days'));

        /*       $insertUserReferrals   = DB::table('tb_user_referrals')->insert(['user_id'       => $memRefId->member_id,
                                                                              'ref_id'         => $createUser->member_id,
                                                                              'joined_date'    => date('Y-m-d h:i:s a', time()),
                                                                              'bonus_amount'   => $getBonusForRefer->bonus_amount,
                                                                              'status'         => 'pending',
                                                                              'validity_date'  => $joinValidity,
                                                                              'email_sent'     => 'Y'
                ]);
 */
                $serchArr         = ['#change_time','#bonus_amount','#new_status','#FIRSTNAME','#LASTNAME'];
                $rplArr           = [date(config('sximo.cnf_date'). ' H:i:s'),$getBonusForRefer->bonus_amount,'pending',$memRefId->first_name,$memRefId->last_name];
                $getEmailTemp     = AppClass::getTemplateByKey('ref_bonus_transaction');
                if($getEmailTemp) {
                  $subject          = $getEmailTemp->subject;
                  $purpose          = $getEmailTemp->purpose;
                  $sender_name      = $getEmailTemp->sender_name;
                  $sender_email     = $getEmailTemp->sender_email;
                  $reply_to         = $getEmailTemp->reply_to;
                  $cc_email         = $getEmailTemp->cc_email;
                  $body             = $getEmailTemp->body;
                  $body             = str_ireplace($serchArr,$rplArr,$body);
                  $smsBody          = $getEmailTemp->sms_body;
                  if($getEmailTemp->sms_enabled == 'Y') {
                      AppClass::sendSMSWithName($memRefId->mobile_number,$smsBody);
                  }
                  AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$memRefId->email);
                }


        $insertUserBonus  = DB::table('tb_user_bonus')->insert(['user_id'     => $memRefId->member_id,
                                                                   'bonus_type'  => $getBonusForRefer->bonus_code,
                                                                'amount'      => $getBonusForRefer->bonus_amount,
                                                             'date_added'  => date('Y-m-d'),
                                                               'date_expire' => $joinValidity,
        'status'      => 'pending']);

          }

        }

        $updateMember   = $createUser->update($updateData);


        $userdata = array(
        'email' => $request->email ,
        'password' => $loginPass
      );
        if (Auth::guard('member')->attempt($userdata))
        {

            Session::put('memberDetail',$member->find(Auth::guard('member')->id()));
            // if(isset($request->from_join)) {
              return redirect($currentUrl);
            // }
            // else {
            //   return redirect()->back();
            // }

         }

            //return redirect()->route('verifyEmail')->with('success','We are send verification mail please verify your email address');

      }
      else {

        if(isset($request->from_join))
        {

          return redirect()->back()->with('error',trans('actionMsg.register_submit_errorjoniNow'))->withInput();
        }
        else
        {

          return redirect()->back()->with('merror',['msg' => trans('actionMsg.register_submit_errorjoniNow'),'type' =>'joniNow'])->withInput();
        }
      }

    }

    public function getVerifyMail() {
      return view('public.verifyEmail.verifyMail');
    }

    public function verifyMail($code,Member $member) {

      $findUser   = $member->find(Crypt::decrypt($code));

      if(count($findUser) > 0){
      $updateUser = $findUser->Update(['email_verified' => 'Y']);
      Session::put('memberDetail',$findUser);

        if($updateUser) {
          return redirect()->route('verifiedMail')->with('success',trans('actionMsg.verify_email_success_msg'));
        }
        else {
          return redirect()->back()->with('error',trans('actionMsg.verify_email_error_msg'));
        }
      }else{
         return redirect()->back()->with('error', trans('actionMsg.user_not_found_msg'));
      }
    }

    public function verifiedMail() {
        return view('public.verifyEmail.verifiedMail');
    }


    public function resendVerificationMail() {
      if(!Auth::guard('member')->check()) {
        $get_mail         =  Session::get('email');
      }
      else {
        $get_mail         =  Session::get('memberDetail')->email;
      }

       $user             =  Member::where('email', '=', $get_mail)->first();
       $confirmationCode = Crypt::encrypt($user->member_id);
       Mail::send('public.layouts.email.verifyEmail', ['confirmation_code' => $confirmationCode],function($message) use ($user){
       $message->to($user->email)->subject('Verify - Email Verification');
       $message->from(config('settingConfig.dev_email_sender'),config('sximo.cnf_comname'));
      });
        return redirect()->back()->with('success',trans('actionMsg.verify_email_success_msg'));

    }



    public function sendOTP($userID = null) {

       $request       = $_POST;
       $curl          = curl_init();

       if($userID == null) {
         $userFind      = Member::find(decrypt($request['mem_key']));
         if(strlen($request['mobile_no']) < 10 || !is_numeric($request['mobile_no'])) {
           return response()->json(['success' => 0,'msg' => config('actionMsg.valid_mobileno_error_msg')]);
         }
         $updatePhoneNo = $userFind->update(['mobile_number' => $request['mobile_no']]);
         $mobileNm      =  $request['mobile_no'];
       }
       else {
         $userFind      = Member::find(decrypt($userID));
         $mobileNm      = $userFind->mobile_number;
       }


       $otp            = $this->generateOTP();

       Session::put('otp',$otp);
       Session::put('mobileNo',encrypt($mobileNm));
		$message       = ''.config('settingConfig.dev_sms_apisender').' :: Your one time Password is : '.$otp.'';

     /*   $api_key       = config('settingConfig.dev_sms_apikey');
       $mobileNo      = $mobileNm;
       $message       = ''.config('settingConfig.dev_sms_apisender').' :: Your one time Password is : '.$otp.'';
       $sender        = config('settingConfig.dev_sms_apisender');
       $url           = config('settingConfig.dev_sms_apiurl');

       $url  	        = str_replace("#API_KEY",$api_key,$url);
       $url  	        = str_replace("#NUMBER",$mobileNo,$url);
       $url  	        = str_replace("#MESSAGE",$message,$url);
       $url         	= str_replace("#SENDER",$sender,$url);

       curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl); */

	  AppClass::sendSMS($mobileNm,$message);

      curl_close($curl);
      if(!$userID) {
        if (false)
          return response()->json(['success' => 0 ,'msg'=> trans('actionMsg.otp_send_error_msg')]);
        else
          return response()->json(['success' => 1 ,'msg'=> trans('actionMsg.otp_send_success_msg')]);
      }
      else {
        if (false)
          return 0;
        else
          return 1;
      }

   }


   public function generateOTP()
   {
       $new_opt = rand(1000,9999);
       return $new_opt;
   }

   public function resendOTP(Request $request) {
      if(!$this->sendOTP($request->mem_key))
          return response()->json(['success' => 0 ,'msg'=> trans('actionMsg.otp_send_error_msg')]);
       else
          return response()->json(['success' => 1 ,'msg'=> trans('actionMsg.otp_resend_success_msg')]);
    }

   public function verfiyOTP(Request $request,Member $member) {
       $findUser = $member->find(decrypt($request->mem_key));
       if(Session::get('otp') == $request->otp) {
          $updateStatus     = $findUser->update(['mobile_verified' => 'Y']);
          Session::put('memberDetail',$findUser);
          return response()->json(['success' => 1,'msg' => trans('actionMsg.success_verified_no')]);
      }
      else {
        return response()->json(['success' => 0,'msg' => trans('actionMsg.invalid_otp_msg')]);
      }

   }

   public function refreshCaptcha()
     {
         return response()->json(['captcha'=> captcha_img()]);
     }



   public function forgotpassword(Request $request)
   {

//dd($request);

      $validator = Validator::make($request->all(),[
              'email'               => 'required|max:255']
          );
      if($validator->fails())
      {

          return redirect()->back()->withErrors($validator)->with('serror','joinNow')->withInput();
      }

      $user             =  Member::where('email', '=', $request->email)->first();



      if($user)
      {
                //  dd($user);

          		  if($user->creation_mode!='D' )
          			 return redirect()->back()->with('merror',['msg' => trans('actionMsg.email_resend_social'),'type' =>'login']);
          			else if($user->account_status=='banned' )
          			 return redirect()->back()->with('merror',['msg' => trans('actionMsg.email_resend_banned'),'type' =>'login']);
          		  else
                {
                    $mailToken        = str_shuffle(md5(rand(0,100000)));
                    $confirmationCode =  Crypt::encrypt($user->member_id);
                    $getEmailTemp     = AppClass::getTemplateByKey('forgot_password');
                    $subject          = $getEmailTemp->subject;
                    $purpose          = $getEmailTemp->purpose;
                    $sender_name      = $getEmailTemp->sender_name;
                    $sender_email     = $getEmailTemp->sender_email;
                    $reply_to         = $getEmailTemp->reply_to;
                    $cc_email         = $getEmailTemp->cc_email;
                    $body             = $getEmailTemp->body;
                    $body             = str_ireplace('#FIRSTNAME',$user->first_name,$body);
                    $body             = str_ireplace('#LASTNAME',$user->last_name,$body);
                    $body             = str_ireplace('#FORGOT_LINK',url('resetPassword/'.$confirmationCode.'/'.$mailToken),$body);
                    $smsBody          = $getEmailTemp->sms_body;
                    $smsBody          = str_ireplace('#FIRSTNAME',$user->first_name,$smsBody);
                    $smsBody          = str_ireplace('#LASTNAME',$user->last_name,$smsBody);

                            if($getEmailTemp->sms_enabled == 'Y')
                             {
                                AppClass::sendSMSWithName($user->mobile_number,$smsBody);
                            }

                    AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$user->email);
                    $now = new \DateTime();
                    $mail_expireTime = strtotime("+3 day", $now->getTimestamp());
                    $user->update(['mail_token' => $mailToken,'mail_send_timestamp' => $mail_expireTime]);
                    return redirect()->back()->with('msuccess',['msg' => trans('actionMsg.email_resend_success_msg'),'type' =>'slogin']);
		             }
      }
      else
      {
        return redirect()->back()->with('merror',['msg' => trans('actionMsg.user_not_found_msg'),'type' =>'login']);
      }


   }

















   //reset Password
    public function resetPassword($id,$token) {
        $memId    = Crypt::decrypt($id);
        $getUser  = Member::wheremember_id($memId)->first();
        if($getUser){
          //$now   = new \DateTime();
          $rlexpire =false;
          if (time() > $getUser->mail_send_timestamp) {
            $rlexpire  = true;
            //return redirect()->back()->with('error','Your Link Expire');
          }
            return view('public.cashback-partial.changePassword',compact('id','getUser','rlexpire'));

        }
        else {
          return redirect('/')->with('error', 'Sorry');
        }
    }

    //reset Password
     public function postresetPassword(Request $request,$id) {
        $validator = Validator::make($request->all(),['password' => 'required|min:6',  'confirm_password' => 'required|same:password']);
        if($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }
        $findUser = Member::find(decrypt($id));
        $mem   = new  Member();


        if(DB::table('tb_cashback_users')->wheremember_id(Crypt::decrypt($id))->update(['password' => bcrypt($request->password)])) {
            return redirect()->back()->with('success',trans('actionMsg.password_update_success'));
        }
        else {
          return redirect()->back()->with('error',trans('actionMsg.password_update_error'));
        }
     }


}
