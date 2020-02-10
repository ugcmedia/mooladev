<?php

namespace App\Http\Controllers\Auth\Partner;


use App\Models\Partner;
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

class PartnerRegisterController extends Controller
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

    public function index(Request $request)
    {

      //dd('welcome to vendor panel');

      return view('partner.register.index');

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
     public function saveUser(Request $request, Partner $vendor)
     {

       //dd($request);

		    // $return = $this->reCaptcha($request->all());
        // //print_r($return);
       	// if($return !== false)
       	// {
        //   echo "inside return <br>";
        //      		if($return['success'] !='true')
        //      		{
        //           echo "inside return success <br>";
        //                       if(isset($request->from_join))
        //                        {
        //                         echo "inside return form join success <br>";
        //                         return redirect()->back()->with('error', trans('actionMsg.invalid_captcha'))->withInput();
        //                       }
        //                       else
        //                        {
        //                         echo "inside return form join success else <br>";
        //                         return redirect()->back()->with('merror',["msg" =>  trans('actionMsg.invalid_captcha'),"type"=>'joniNow'])->withInput();
        //                       }
        //
       	// 	        }
       	// }

        //echo "outside return <br>";



       $validator = Validator::make($request->all(),[
               'vendor_name'          => 'required|max:255',
               // 'last_name'           => 'regex:/^[\pL\s\-]+$/u|max:255',
               'email'               => 'required|unique:tb_vendor_account,email',
               //'email'               => 'required',
               'password'            => 'required|min:6'
            ]
        );

      //  echo "<pre>";
      //  print_r($validator);


       if( $validator->fails() )
       {
               echo "inside validation fails <br>";

                if(isset($request->from_join))
                 {
                   //dd($request->from_join);
                  echo "inside
                   validation fails joinNow <br>";
                  //dd($validator);
                  //die();
                  return redirect()->back()->withErrors($validator)->with('jnerror','join-Now-msg')->withInput();
                }
                else
                 {
                  echo "inside validation fails joinNow else <br>";
                    return redirect()->back()->withErrors($validator)->with('jnerror','join-Now-msg')->withInput();
                 }

       }







       //echo "outside validator <br>";

       //die();

       $currentUrl        = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('/');
	     $refUrl               = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('/');
       $currentUrl        = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : $refUrl;
       setcookie('redirect_to',$request->previous_url, time()+(3600*60));


       $loginPass                  =  $request->password;
       $request['password']        =  bcrypt($loginPass);
       $request['va_token']  =  str_random(60);
       $request['vendor_code'] = time();
       //$request['creation_mode']   =  'D';





            // $my_reg= array('vendor_name' =>$request->vendor_name ,
            //                           'email' =>$request->email ,
            //                            'password' =>$request->password,
            //                             'va_token' =>$request->va_token ,
            //                             'vendor_code' =>$request->vendor_code ,
            //                           );


            //dd($request->all() );

              //$createUser =DB::table('tb_vendor_account')->insert($my_reg);

              $createUser = $vendor->Create($request->all());

             //dd($vendor);

            // echo $createUser;
            // die();

          //   dd($createUser);

             // $confirmationCode = Crypt::encrypt($createUser->vendor_id);





      if($createUser)
      {


        Session::put('email',$createUser->email);
        $confirmationCode =  Crypt::encrypt($createUser->vendor_id);

//echo $confirmationCode;
// echo (url('verifyMail/'.$confirmationCode) );
// die();

        $getEmailTemp     = AppClass::getTemplateByKey('partner_email_verification_signup');
        $subject          = $getEmailTemp->subject;
        $purpose          = $getEmailTemp->purpose;
        $sender_name      = $getEmailTemp->sender_name;
        $sender_email     = $getEmailTemp->sender_email;
        $reply_to         = $getEmailTemp->reply_to;
        $cc_email         = $getEmailTemp->cc_email;
        $body             = $getEmailTemp->body;
        $body             = str_ireplace('#PARTNERNAME',$createUser->vendor_name,$body);
        //$body             = str_ireplace('#LASTNAME',$createUser->vendor_name,$body);
        $body             = str_ireplace('#VERIFICATION_LINK',url('verifyMailPartner/'.$confirmationCode),$body);
		    $body             = str_ireplace('#VERIFICATIONLINK',url('verifyMailPartner/'.$confirmationCode),$body);

        // $smsBody          = $getEmailTemp->sms_body;
        // $smsBody          = str_ireplace('#FIRSTNAME',$createUser->vendor_name,$smsBody);
        // $smsBody          = str_ireplace('#LASTNAME',$createUser->vendor_name,$smsBody);
        // if($getEmailTemp->sms_enabled == 'Y') {
        //     AppClass::sendSMSWithName($user->mobile_number,$smsBody);
        // }

        AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$createUser->email);

          // dd(sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$createUser->email) );

        return redirect('partner-thank-you')->with('success','We have sent verification mail please verify your email address');

        //$updatePartner   = $createUser->update($updateData);

        // $userdata = array(
        //   'email' => $request->email ,
        //   'va_pass' => $loginPass
        // );
        //
        // if (Auth::guard('vendor')->attempt($userdata))
        // {
        //   dd(Auth::guard('vendor'));
        //
        //   dd('sss-'.Auth::guard('vendor')->id());
        //
        //     Session::put('vendorDetail',$vendor->find(Auth::guard('vendor')->id()));
        //     // if(isset($request->from_join)) {
        //       //return redirect('partner-thank-you');
        //       return redirect()->route('partner-thank-you')->with('success','We have sent verification mail please verify your email address');
        //     // }
        //     // else {
        //     //   return redirect()->back();
        //     // }
        //
        //  }

      }
      else
      {



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





    public function getVerifyMail()
    {
      return view('public.verifyEmail.verifyMail');
    }

    public function verifyMail($code,Partner $vendor)
    {

      $findUser   = $vendor->find(Crypt::decrypt($code));

      if(count($findUser) > 0){
      $updateUser = $findUser->Update(['email_verified' => 'Y']);
      Session::put('vendorDetail',$findUser);

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

    public function verifiedMail()
    {
        return view('public.verifyEmail.verifiedMail');
    }


    public function resendVerificationMail() {
      if(!Auth::guard('vendor')->check()) {
        $get_mail         =  Session::get('email');
      }
      else {
        $get_mail         =  Session::get('vendorDetail')->email;
      }

       $user             =  Partner::where('email', '=', $get_mail)->first();
       $confirmationCode = Crypt::encrypt($user->vendor_id);
       Mail::send('public.layouts.email.verifyEmail', ['confirmation_code' => $confirmationCode],function($message) use ($user){
       $message->to($user->email)->subject('Verify - Email Verification');
       $message->from(config('settingConfig.dev_email_sender'),config('sximo.cnf_comname'));
      });
        return redirect()->back()->with('success',trans('actionMsg.verify_email_success_msg'));

    }

    public function completeProfile(Request $request, Partner $vendor)
    {
      return view('partner.register.complete-profile');
      // if(Auth::guard('vendor')->check()) {
      //   //return view('public.verifyEmail.verifiedMail');
      // } else {
      //   dd('not logged in');
      //   return redirect('partner/login');
      // }
    }



    public function sendOTP($userID = null) {

       $request       = $_POST;
       $curl          = curl_init();

       if($userID == null) {
         $userFind      = Partner::find(decrypt($request['mem_key']));
         if(strlen($request['mobile_no']) < 10 || !is_numeric($request['mobile_no'])) {
           return response()->json(['success' => 0,'msg' => config('actionMsg.valid_mobileno_error_msg')]);
         }
         $updatePhoneNo = $userFind->update(['mobile_number' => $request['mobile_no']]);
         $mobileNm      =  $request['mobile_no'];
       }
       else {
         $userFind      = Partner::find(decrypt($userID));
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

   public function verfiyOTP(Request $request,Partner $vendor) {
       $findUser = $vendor->find(decrypt($request->mem_key));
       if(Session::get('otp') == $request->otp) {
          $updateStatus     = $findUser->update(['mobile_verified' => 'Y']);
          Session::put('vendorDetail',$findUser);
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

   public function forgotpassword(Request $request) {

      $validator = Validator::make($request->all(),[
              'email'               => 'required|max:255']
          );
      if($validator->fails()) {
          return redirect()->back()->withErrors($validator)->with('serror','joinNow')->withInput();
      }

      $user             =  Partner::where('email', '=', $request->email)->first();

      if($user) {

		  if($user->creation_mode!='D' )
			 return redirect()->back()->with('merror',['msg' => trans('actionMsg.email_resend_social'),'type' =>'login']);
			else if($user->account_status=='banned' )
			 return redirect()->back()->with('merror',['msg' => trans('actionMsg.email_resend_banned'),'type' =>'login']);
		  else{
          $mailToken        = str_shuffle(md5(rand(0,100000)));
          $confirmationCode =  Crypt::encrypt($user->vendor_id);
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

          if($getEmailTemp->sms_enabled == 'Y') {
              AppClass::sendSMSWithName($user->mobile_number,$smsBody);
          }
          AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$user->email);
          $now = new \DateTime();
          $mail_expireTime = strtotime("+3 day", $now->getTimestamp());
          $user->update(['mail_token' => $mailToken,'mail_send_timestamp' => $mail_expireTime]);
          return redirect()->back()->with('msuccess',['msg' => trans('actionMsg.email_resend_success_msg'),'type' =>'slogin']);
		}
      }
      else {
        return redirect()->back()->with('merror',['msg' => trans('actionMsg.user_not_found_msg'),'type' =>'login']);
      }


   }

   //reset Password
    public function resetPassword($id,$token) {
        $memId    = Crypt::decrypt($id);
        $getUser  = Partner::wherevendor_id($memId)->first();
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
        $findUser = Partner::find(decrypt($id));
        $mem   = new  Partner();


        if(DB::table('tb_cashback_users')->wherevendor_id(Crypt::decrypt($id))->update(['password' => bcrypt($request->password)])) {
            return redirect()->back()->with('success',trans('actionMsg.password_update_success'));
        }
        else {
          return redirect()->back()->with('error',trans('actionMsg.password_update_error'));
        }
     }

}
