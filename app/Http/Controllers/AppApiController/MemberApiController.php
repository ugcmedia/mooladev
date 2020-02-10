<?php namespace App\Http\Controllers\AppApiController;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator, Input, Redirect;
use DB;
use App\Helpers\AppClass;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MemberController\DashboardController;
//use Illuminate\Routing\Controller;
use Auth;
use App\Models\Member;
use Crypt;
use Session;

class MemberApiController extends Controller {



    public function validateToken($token)
    {
        if( strlen($token) < 3 )
        return 0;

        $userKey = DB::table('tb_user_tokens')->where('expires_on','>',time())->where('token_key',$token)->first();
        if($userKey)
        return $userKey->user_id;
        else
        return 0;
    }

  	public function isTokenExists($token)
     {
        if( strlen($token) < 3 )
        return 0;
        $userKey = DB::table('tb_user_tokens')->where('token_key',$token)->first();
        if($userKey)
        return $userKey->user_id;
        else
        return 0;
     }

     public function loginUser(Request $request,Member $member)
	   {

  		  $authInfo = $request->all();
  		  $userEmail = $authInfo['useremail'];
  		  $userPass = $authInfo['userpassword'];
  		  $userdata = array('email'=>$userEmail,'password'=>$userPass);
    		if (Auth::guard('member')->attempt($userdata))
    		{
    			$user_id = Auth::guard('member')->id();
    			Session::put('memberDetail',$member->find($user_id));
    			DB::table('tb_user_login_logs')->insert( array('user_id'=>$user_id , 'ip_addr'=>$request->ip())  );

                $user_token = hash('sha256',$user_id.time());
                DB::table('tb_user_tokens')->insert( array('token_key'=>$user_token,'user_id'=>$user_id,'created_on'=>time(),'expires_on'=>time()+(60*60*6)) );

                $final_data = array(
                    'status' => 'success',
                    'msg'=> '',
                    'result' => array(
                        'access_token'=>$user_token,
                        'expires_on' => time()+(59*60*60)
                    )
                );
                return \Response::json($final_data);
    		 }
      		else
      		{
                  $final_data = array(
                      'status' => 'error',
                      'msg'=> 'Auth Failed',
                      'result' => array(
                          'access_token'=>null,
                          'expires_on' => 0
                      )
                  );
                  return \Response::json($final_data);
      		}

    }

    public function getUserInfo(Request $request)
    {
        $token = $request->bearerToken();

        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
            $userInfo = DB::table('tb_cashback_users')->select('first_name','last_name','email','created_at','member_id as user_id','profile_picture','creation_mode','social_link')->where('member_id',$user_id)->first();
            $final_data = array(
                'status' => 'success',
                'msg'=> '',
                'result' => array('cashback'=>AppClass::getAllBalById($user_id),'info'=>$userInfo)
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }
    }

    public function createUser(Request $request)
    {
          $member = new Member;
          $userInfo = $request->all();

      		$is_userExists = DB::table('tb_cashback_users')->where('email',$request->email)->first();
  	     	if( $is_userExists )
  		    {
  			       $final_data = array(
                  'status' => 'error',
                  'msg'=> 'User aleady Exists',
                  'result' => false
              );
              return \Response::json($final_data);
  	    	}

          $userInfo['creation_mode'] = 'D';
          $userInfo['password']        =  bcrypt( $request->password );
          $userInfo['remember_token']  =  str_random(60);
          $userInfo['salt'] = $userInfo['hashkey'] = md5(time());
          $referral_commission = 0; $referral_validity = null;

          // if(config('settingConfig.mlm_enabled') =='Y') {
          //   $referral_commission = config('settingConfig.mlm_split');
          //   $referral_validity   = config('settingConfig.referral_valid_date');
          // }
            $userInfo['referral_validity']= $referral_validity;
            $userInfo['referral_commission']= $referral_commission;
            $userInfo['email_verified'] = 'N';
            $userInfo['mobile_verified'] = 'N';
            $userInfo['account_status'] = 'active';
            $createUser = $member->Create( $userInfo ) ;

        if($createUser)  {
            $referCode 		 =  substr(preg_replace('/[^A-Za-z]/', '', strtoupper($userInfo['first_name'])),0,25).$createUser->member_id;
            $updateData = ['referral_code' => $referCode];

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
            AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$createUser->email);

          //  $this->referUser( $createUser );

            $updateMember   = $createUser->update($updateData);

		      	DB::table('tb_user_login_logs')->insert( array('user_id'=> $createUser->member_id , 'ip_addr'=>$request->ip())  );
		       	$user_id = $createUser->member_id;
            $user_token = hash('sha256',$user_id.time());
            DB::table('tb_user_tokens')->insert( array('token_key'=>$user_token,'user_id'=>$user_id,'created_on'=>time(),'expires_on'=>time()+(60*60*6)) );

      			$final_data = array(
                      'status' => 'success',
                      'msg'=> 'User Created',
                      'result' => array(
                          'access_token'=>$user_token,
                          'expires_on' => time()+(59*60*60)
                      )
                  );
            return \Response::json($final_data);

        }
        else{
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Error Creating User',
                'result' => false
            );
            return \Response::json($final_data);
        }

    }

    public function socialUserLoginSignup(Request $request)
    {
        $member = new Member;
        $social_user = DB::table('tb_cashback_users')->where('email',$request->email)->where('social_ref_key',$request->social_ref_key)->first();

        if($social_user)
        {
            $user_id = $social_user->member_id;

            DB::table('tb_user_login_logs')->insert( array('user_id'=>$user_id , 'ip_addr'=>$request->ip())  );
            $user_token = hash('sha256',$user_id.time());
            DB::table('tb_user_tokens')->insert( array('token_key'=>$user_token,'user_id'=>$user_id,'created_on'=>time(),'expires_on'=>time()+(60*60*6)) );
            $final_data = array(
                'status' => 'success',
                'msg'=> '',
                'result' => array(
                    'access_token'=>$user_token,
                    'expires_on' => time()+(59*60*60)
                )
            );
            return \Response::json($final_data);
        }
        else{
            $userInfo = $request->all();
            $userInfo['last_name'] = '';
            $userInfo['email_verified'] = 'Y';
            $userInfo['mobile_verified'] = 'N';
            $userInfo['account_status'] = 'active';
            $userInfo['remember_token']  =  str_random(60);
            $userInfo['salt'] = $userInfo['hashkey'] = md5(time());
            $userInfo['password']  =  '';
            $createMember = $member->Create( $userInfo ) ;
            if($createMember)
            {
                $referCode 		 =  substr(preg_replace('/[^A-Za-z]/', '', strtoupper($createMember->first_name)),0,25).$createMember->member_id;
				        $updateData = ['referral_code' => $referCode];
                $updateMember   = $createMember->update($updateData);
        				//send welcome email
        				$getEmailTemp     = AppClass::getTemplateByKey('welcome_email');
        				$subject          = $getEmailTemp->subject;
        				$purpose          = $getEmailTemp->purpose;
        				$sender_name      = $getEmailTemp->sender_name;
        				$sender_email     = $getEmailTemp->sender_email;
        				$reply_to         = $getEmailTemp->reply_to;
        				$cc_email         = $getEmailTemp->cc_email;
        				$body             = $getEmailTemp->body;
        				$body             = str_ireplace('#FIRSTNAME',$createMember->first_name,$body);
        				$body             = str_ireplace('#LASTNAME',$createMember->last_name,$body);
        				$smsBody          = $getEmailTemp->sms_body;
        				$smsBody          = str_ireplace('#FIRSTNAME',$createMember->first_name,$smsBody);
        				$smsBody          = str_ireplace('#LASTNAME',$createMember->last_name,$smsBody);
      				if($getEmailTemp->sms_enabled == 'Y') {
      						AppClass::sendSMSWithName($user->mobile_number,$smsBody);
      				}

				    AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$createMember->email);

          //  $this->referUser($createMember);

  				$user_id = $createMember->member_id;
              DB::table('tb_user_login_logs')->insert( array('user_id'=>$user_id , 'ip_addr'=>$request->ip())  );
              $user_token = hash('sha256',$user_id.time());
              DB::table('tb_user_tokens')->insert( array('token_key'=>$user_token,'user_id'=>$user_id,'created_on'=>time(),'expires_on'=>time()+(60*60*6)) );

              $final_data = array(
                  'status' => 'success',
                  'msg'=> '',
                  'result' => array(
                      'access_token'=>$user_token,
                      'expires_on' => time()+(59*60*60)
                  )
              );
            return \Response::json($final_data);
            }

        	else{
    				$final_data = array(
                    'status' => 'error',
                    'msg'=> 'Error Creating User',
                    'result' => null
                );
                return \Response::json($final_data);

    			}
        }
    }

    public function uploadReceipt(Request $request) {
      $token = $request->bearerToken();
      $user_id = $this->validateToken($token);
      if($user_id>0)
      {
        if($request->hasFile('order_image')) {
          $imageFileType = strtolower(pathinfo($request->order_image->getClientOriginalName(),PATHINFO_EXTENSION));
          if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif"  && $imageFileType != "pdf")
          {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Image Type',
                'result' => null
            );
            return \Response::json($final_data);
          }
          else {
            $file = $request->order_image;
            $extension = $request['order_image']->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $file->move(public_path().'/uploads/receipts', $fileName);
            $insertTransction = DB::table('tb_user_transaction')->insertGetId([
                  'order_id' => $request->order_id,
                  'transaction_id'=>time()+7,
                  'order_date' => date('Y-m-d H:i:s',strtotime($request->order_date)),
                  'transaction_amount' => $request->transaction_amount,
                  'user_comment' => $request->user_comment,
                  'order_image' => $fileName,
                  'vendor_code' => $request->vendor_code,
                  'user_id' =>$user_id
              ]);
              if($insertTransction) {
                  $getTransactionID = DB::table('tb_user_transaction')->where('utrid',$insertTransction)->first();
                  $final_data = array(
                      'status' => 'success',
                      'msg'=> 'Your receipt has successfully scan',
                      'result' => ['transactionID' => $getTransactionID->transaction_id]
                  );
                  return \Response::json($final_data);
              }
           }

         }
         else {
           $final_data = array(
               'status' => 'error',
               'msg'=> 'Please Upload Receipt',
               'result' => null
           );
           return \Response::json($final_data);
         }
      }
      else {
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }
      }
    }

    public function referUser( $createUser )
    {
        if(  strlen($createUser->referred_by) > 1  ) {

            $date             = date('y-m-d');

              $memRefId   = Member::wherereferral_code($createUser->referred_by)->first();



              $getBonusForJoin = DB::table('tb_bonus_types')->wherebonus_code('join_bonus')->whereenabled('Y')->first();
              if(Count($getBonusForJoin) > 0)  {
                $joinValidity     = date('Y-m-d', strtotime($date. ' +'.$getBonusForJoin->validity_days.'days'));

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
    }

    public function getUserNotifications($is_ext=1,Request $request)
    {

        $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
            $userInfo = DB::table('tb_cashback_users')->select('first_name','last_name','email','created_at')->where('member_id',$user_id)->first();

            $alertSettings = DB::table('tb_user_alert_settings')->get();
            $cbAlerts = DB::table('vw_alert_transaction')->whereuser_id( $user_id)->get();
            $wdAlerts = DB::table('vw_alert_withdrawal')->whereuser_id($user_id)->get();
            $bnAlerts =  DB::table('vw_alert_bonus')->whereuser_id($user_id)->get();
            $rfAlerts =  DB::table('vw_alert_referral')->whereuser_id($user_id)->get();
            $bdAlerts =  DB::table('vw_alert_broadcast')->whereuser_id($user_id)->get();

            $myNotifications = array();

			foreach($bdAlerts as $bdAlert)
			{
				if($is_ext==0 )
						  $myNotifications['broadcast'][] = array('title'=>$bdAlert->title,'message'=> strip_tags($bdAlert->message),'notiUrl'=>$bdAlert->click_link );
						 else
				$myNotifications[] = array('type'=>'basic','title'=>$bdAlert->title,'message'=> strip_tags($bdAlert->message),'notiUrl'=>$bdAlert->click_link,'tab'=>'broadcast');
			}

            $notifications = array(
                'Cashback' => $cbAlerts,
                'Withdrawals'=>$wdAlerts,
                'Bonus' => $bnAlerts,
                'Referral'=>$rfAlerts
            );
            $notiTypeMap = array(
                'Cashback' => 'cashback',
                'Withdrawals'=>'withdrawal',
                'Bonus' => 'bonus',
                'Referral'=>'referral'
            );
            $alertTemplate = array();
            foreach($alertSettings as $alert)
            {
                $alertTemplate[$alert->alert_category][$alert->setting_key]['title'] = $alert->alert_title;
                $alertTemplate[$alert->alert_category][$alert->setting_key]['content'] = $alert->alert_content;
                $alertTemplate[$alert->alert_category][$alert->setting_key]['slug'] = $alert->slug;
            }

            foreach( $notiTypeMap as $notiType => $notiCashLw )
            {


            foreach($cbAlerts  as $notiCash){
                    $notiCashLw = $notiTypeMap[$notiType];
                    $cbChangeTime = $notiCash->change_time;
                      if($notiCash->change_type=='insert')
                       {
                        $cbTitle = $alertTemplate[$notiType]['insert_'.$notiCashLw]['title'];
                        $cbContent = $alertTemplate[$notiType]['insert_'.$notiCashLw]['content'];
                       }
                       else {
                         $cbTitle = $alertTemplate[$notiType]['update_'.$notiCashLw]['title'];
                         $cbContent = $alertTemplate[$notiType]['update_'.$notiCashLw]['content'];
                       }
                       $cbSlug = str_ireplace('#change_id',$notiCash->change_id,$alertTemplate[$notiType]['insert_'.$notiCashLw]['slug']);

                      $notAry = (array) $notiCash;
                      foreach ($notiCash as $key => $value) {
                        // code...
                        $cbTitle = str_ireplace('#'.$key,$value,$cbTitle);
                        $cbContent = str_ireplace('#'.$key,$value,$cbContent);
                      }

                      $cbTitle = str_ireplace('#username',$userInfo->first_name,$cbTitle);
                      $cbContent = str_ireplace('#user_name',$userInfo->first_name,$cbContent);
					  if($is_ext==0 )
						  $myNotifications[$notiCashLw][] = array('title'=>$cbTitle,'message'=>$cbContent,'notiUrl'=>$cbSlug  );
						 else
                      $myNotifications[] = array('type'=>'basic','title'=>$cbTitle,'message'=>$cbContent,'notiUrl'=>$cbSlug,'tab'=> $notiCashLw );
                    }
            }

			 $final_data = array(
                'status' => 1,
                'msg'=> '',
                'result' => array_splice( $myNotifications,0,5)
            );
            return \Response::json($final_data);

        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }

    }

	public function renewToken(Request $request)
	{
		$token = $request->bearerToken();

        $user_id = $this->isTokenExists($token);

		$isRenewToken = false;
		if( $user_id > 0 /*&& isset($_POST['idiotEmail']) */)
		{
			$is_userExists = DB::table('tb_cashback_users')->where('member_id',$user_id)/*->where('email',$_POST['idiotEmail'])*/->first();
			if($is_userExists)
			$isRenewToken = true;
		}


		if($isRenewToken)
		{
			DB::table('tb_user_login_logs')->insert( array('user_id'=>$user_id , 'ip_addr'=>$request->ip())  );

            $user_token = hash('sha256',$user_id.time());
            DB::table('tb_user_tokens')->insert( array('token_key'=>$user_token,'user_id'=>$user_id,'created_on'=>time(),'expires_on'=>time()+(60*60*6)) );

            $final_data = array(
                'status' => 'success',
                'msg'=> '',
                'result' => array(
                    'access_token'=>$user_token,
                    'expires_on' => time()+(59*60*60)
                )
            );
            return \Response::json($final_data);
		}
		else
		{
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token or Email',
                'result' => array(
                    'access_token'=>null,
                    'expires_on' => 0
                )
            );
            return \Response::json($final_data);
		}

	}

  	public function updatePassword(Request $request, Member $member)
  	{
		    $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        $userData = $member->find($user_id);
		    if($user_id >0  && isset($request->newPassword) && isset($request->currentPassword) )
        {
		    	$userdata = array('email'=>$userData->email,'password'=>$request->currentPassword);
		  	if (Auth::guard('member')->attempt($userdata))
			  {
        $updatePass = $userData->update(['password'=> bcrypt( $request->newPassword )]);
        if($updatePass) {
          $final_data = array(
                  'status' => 'success',
                  'msg'=> 'Password Updated',
                  'result' => true
          );
        }
          else {
            $final_data = array(
                    'status' => 'error',
                    'msg'=> 'Unable to update password',
                    'result' => false
            );
          }
          return \Response::json($final_data);
  			}
  			else{
  				$final_data = array(
                  'status' => 'error',
                  'msg'=> 'Invalid Password',
                  'result' => false
              );
              return \Response::json($final_data);
  			}
        }
        else
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Token or Missing Parameters',
                'result' => null
            );
            return \Response::json($final_data);
        }
  	}


	public function forgotPassword(Request $request)
	{
		if( isset($request->email) )
		$user = DB::table('tb_cashback_users')->where('email', $request->email)->first();
		else
			$user = false;
        if($user )
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


          AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$user->email);
          $now = new \DateTime();
          $mail_expireTime = strtotime("+3 day", $now->getTimestamp());
          DB::table('tb_cashback_users')->where('member_id',$user->member_id)->update(['mail_token' => $mailToken,'mail_send_timestamp' => $mail_expireTime]);

            $final_data = array(
                'status' => 'success',
                'msg'=> 'Email Sent',
                'result' => true
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> "User doesn't exist with this email",
                'result' => null
            );
            return \Response::json($final_data);
        }
	}

	public function generateOTP(Request $request)
	{
		 $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0 && isset($_POST['mobileNumber']) )
        {
            $new_opt = rand(1000,9999);

			$sms_body  = str_ireplace('#OTP',$new_opt,config('settingConfig.sms_send_otp_msg'));
			$sendSMS = AppClass::sendSMS($_POST['mobileNumber'],$sms_body);

            $final_data = array(
                'status' => 1,
                'msg'=> 'OTP Sent',
                'result' => $new_opt
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token or Mobile Number',
                'result' => null
            );
            return \Response::json($final_data);
        }
	}

	public function updateMobile(Request $request)
	{

		 $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0 && isset($_POST['mobileNumber']) )
        {
            DB::table('tb_cashback_users')->where('member_id',$user_id)->update( ['mobile_number'=>$_POST['mobileNumber'],'mobile_verified'=>'Y'  ]  );

			$final_data = array(
                'status' => 1,
                'msg'=> 'Mobile Number Updated',
                'result' => true
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token or Mobile Number',
                'result' => null
            );
            return \Response::json($final_data);
        }


	}

	public function getUserFavs(Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id > 0)
        {
           $follows = DB::select("SELECT GROUP_CONCAT(object_id) object_ids, object_type FROM `tb_user_follows` WHERE user_id = {$user_id}  GROUP BY object_type");
		   $follow_data = array( 'vendor'=>[],'offer' => []);
		   foreach($follows as $followO)
		   {
			   if( $followO->object_type == 'vendor' )
				   $follow_data['vendor'] = AppClass::getVendorByList($followO->object_ids);
			   else if( $followO->object_type == 'offer' )
				   $follow_data['offer'] = AppClass::getOfferByList($followO->object_ids);
		   }

			$final_data = array(
                'status' => 'success',
                'msg'=> '',
                'result' => $follow_data
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }
	}

	public function addUserFavs(Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);

        if($user_id > 0 && isset($_POST['object_type']) && isset($_POST['object_id']) )
        {

            DB::table('tb_user_follows')->insert( array('user_id'=>$user_id,'object_type'=>$_POST['object_type'],'object_id'=>$_POST['object_id']) );

		  	$final_data = array(
                'status' => 'success',
                'msg'=> 'Fav Added',
                'result' => true
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Token or Missing Fav Info',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}

	public function deleteUserFavs(Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0 && isset($_POST['object_type']) && isset($_POST['object_id']) )
        {
            DB::table('tb_user_follows')->where( array('user_id'=>$user_id,'object_type'=>$_POST['object_type'],'object_id'=>$_POST['object_id']) )->delete();

			$final_data = array(
                'status' => 'success',
                'msg'=> 'Fav Deleted',
                'result' => true
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Token or Missing Fav Info',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}

	public function getUserDashboard(Request $request)
	{
		 $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
            $final_data = array(
                'status' => 1,
                'msg'=> '',
                'result' => AppClass::getAllBalById($user_id)
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }
	}

	public function getUserClicks($page_num,$store_id,Request $request)
	{
		 $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
			$click_data    =  DB::table('tb_clicks')
                            ->join('tb_stores','tb_stores.store_id','=','tb_clicks.store_id')
                            ->where('tb_clicks.user_id','=',$user_id)
							->whereRaw( " tb_clicks.store_id = IF({$store_id}=0,tb_clicks.store_id,{$store_id}) " )
                            ->orderBy('tb_clicks.click_time','desc')
							->offset( ($page_num-1)*25)
                            ->limit(25*$page_num)->get();

            $final_data = array(
                'status' => 1,
                'msg'=> '',
                'result' => $click_data
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }
	}

  //user transaction
  public function getUserTransaction(Request $request) {
    $token = $request->bearerToken();
    $user_id = $this->validateToken($token);

    if($user_id>0)
    {
      $final_data['usertransaction']  =  DB::table('tb_user_transaction')->join('tb_vendors','tb_vendors.vendor_code','=','tb_user_transaction.vendor_code')->where('tb_user_transaction.user_id','=',$user_id)->get();
      $final_data = array(
          'status' => 'success',
          'msg'=> '',
          'result' => $final_data
      );
      return \Response::json($final_data);
    }
    else {
      $final_data = array(
          'status' => 0,
          'msg'=> 'Invalid Token',
          'result' => null
      );
      return \Response::json($final_data);
    }
  }

	public function getUserActivity(Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
			$final_data = array(); $data = array();
			$data['cashback_data']  = DB::table('tb_user_transaction')
                                ->join('tb_stores','tb_stores.store_id','=','tb_user_transaction.merchant_id')
                                ->whereuser_id($user_id)
                                ->orderBy('tb_user_transaction.transaction_time','desc')
								                ->select('tb_user_transaction.*', 'store_name')
                                ->limit(25)->get();

			$data['bonus_data']     =  DB::table('tb_user_bonus')
                                ->join('tb_bonus_types','tb_bonus_types.bonus_code','=','tb_user_bonus.bonus_type')
                                ->whereuser_id($user_id)
                                ->orderBy('tb_user_bonus.date_added','desc')
                              ->limit(25)->get();


  $data['refer_data']    =  DB::table('tb_user_referrals')
                              ->join('tb_cashback_users','tb_cashback_users.member_id','=','tb_user_referrals.ref_id')
                              ->join('tb_stores','tb_stores.store_id','=','tb_user_referrals.merchant_id')
                              ->select('tb_user_referrals.refid','tb_user_referrals.awarded_date','tb_user_referrals.bonus_amount','tb_user_referrals.status',
                                       'tb_cashback_users.first_name','tb_stores.store_name','tb_cashback_users.last_name','tb_cashback_users.mobile_verified','tb_cashback_users.email_verified')
                              ->where('tb_user_referrals.user_id','=',$user_id)
                              ->orderBy('tb_user_referrals.utrid','desc')
                              ->limit(25)->get();

    $data['click_data']    =  DB::table('tb_clicks')
                            ->join('tb_stores','tb_stores.store_id','=','tb_clicks.store_id')
                            ->where('tb_clicks.user_id','=',$user_id)
                            ->orderBy('tb_clicks.click_time','desc')
                            ->limit(25)->get();

    $netData       = DB::table('tb_network')->select('network_id','trans_convert_days')->get();


	$cashback_meta = array();
    		$cashback_vw_res = DB::table('vw_alert_transaction')->where('user_id',$user_id)->get();
    		foreach($cashback_vw_res as $cbres)
    		$cashback_meta[$cbres->transaction_id][] = array('change_time'=>$cbres->change_time,'status'=>$cbres->new_status,'amount'=>$cbres->new_cashback );

    		$data['cashback_meta'] = $cashback_meta;

    		$bonus_meta = array();
    		$bonus_vw_res = DB::table('vw_alert_bonus')->where('user_id',$user_id)->get();
    		foreach($bonus_vw_res as $bnsres)
    		$bonus_meta[$bnsres->bonus_id][] = array('change_time'=>$bnsres->change_time,'status'=>$bnsres->new_status );

    		$data['bonus_meta'] = $bonus_meta;

    		$referral_meta = array();
    		$ref_vw_res = DB::table('vw_alert_referral')->where('user_id',$user_id)->get();
    		foreach($ref_vw_res as $refres)
    		$referral_meta[$refres->refid][] = array('change_time'=>$refres->change_time,'status'=>$refres->new_status );

    		$data['referral_meta'] = $referral_meta;

			  foreach($netData as $net) {
				$data['network_days'][$net->network_id] = $net->trans_convert_days;
			  }



            $final_data = array(
                'status' => 1,
                'msg'=> '',
                'result' => $data
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}



	public function getUserWithdrawal(Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0  )
        {
			$data = array();

			$data['balance'] = AppClass::getAllBalById($user_id);

			$data['payout_type']      =  DB::table('tb_payout_types')->whereenabled('Y')->get();
        $data['payout_data']      = DB::table('tb_cashback_user_methods')->join('tb_payout_types','tb_payout_types.code','=','tb_cashback_user_methods.payout_type')->where('tb_cashback_user_methods.member_id',$user_id)->where('tb_payout_types.enabled','Y')->get();

        $data['withdraw_history'] =  DB::table('tb_user_withdrawals')->join('tb_payout_types','tb_payout_types.code','=','tb_user_withdrawals.mode')->where('tb_user_withdrawals.user_id',$user_id)->orderBy('tb_user_withdrawals.withdrawal_request_date','DESC')->get();

		$withdraw_meta = array();
		$withdraw_vw_res = DB::table('vw_alert_withdrawal')->where('user_id',$user_id)->get();
		foreach($withdraw_vw_res as $wthres)
		$withdraw_meta[$wthres->withdrawal_id][] = array('change_time'=>$wthres->change_time,'status'=>$wthres->new_status );

		$data['withdraw_meta'] = $withdraw_meta;

			$final_data = array(
                'status' => 1,
                'msg'=> '',
                'result' => true
            );
            return \Response::json($data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}

	public function addUserPayoutMode(Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
			 $insertIntoPayout = DB::table('tb_cashback_user_methods')->insert([
			'member_id'      => $user_id,
			'payout_type'    => $request->payout_type,
			'payout_info1'   => $request->info1,
			'payout_info2'   => $request->info2,
			'payout_info3'   => $request->info3,
			'payout_info4'   => $request->info4,
			'payout_info5'   => $request->info5,
		  ]);
		  if( $insertIntoPayout )
            $final_data = array(
                'status' => 1,
                'msg'=> 'Payout Mode Added',
                'result' => true
            );
			else
				$final_data = array(
                'status' => 0,
                'msg'=> 'Unable to add Payout Mode',
                'result' => false
            );

            return \Response::json($final_data);

        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}

	public function editUserPayoutMode($metid, Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {

			$updatePayout = DB::table('tb_cashback_user_methods')->wheremetid($metid)->where('member_id',$user_id)->update([
          'payout_info1'   => $request->info1,
          'payout_info2'   => $request->info2,
          'payout_info3'   => $request->info3,
          'payout_info4'   => $request->info4,
          'payout_info5'   => $request->info5,
			]);

		  if( $updatePayout )
            $final_data = array(
                'status' => 1,
                'msg'=> 'Payout Mode Updated',
                'result' => true
            );
			else
				$final_data = array(
                'status' => 0,
                'msg'=> 'Unable to update or no changes made',
                'result' => false
            );

            return \Response::json($final_data);

        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}

	public function deleteUserPayoutMode($metid, Request $request)
	{
		$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
			$deletePayout = DB::table('tb_cashback_user_methods')->wheremetid($metid)->where('member_id',$user_id)->delete();

		  if( $deletePayout )
            $final_data = array(
                'status' => 1,
                'msg'=> 'Payout Mode Deleted',
                'result' => true
            );
			else
				$final_data = array(
                'status' => 0,
                'msg'=> 'Unable to delete Payout Mode or its already deleted',
                'result' => false
            );

            return \Response::json($final_data);

        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}



	 public function DoUserWithdraw(Request $request) {

		  $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {

        $getBal  = AppClass::getAllBalById($user_id);

		if($request->withdrawal_amount <= 0 ){

		 $final_data = array(
                'status' => 0,
                'msg'=> 'Zero amount withdrawal not allowed',
                'result' => null
            );
            return \Response::json($final_data);

        }


        $avail_reward  = $getBal['reward-confirmed'] - $getBal['Paidout'][0]->paidReward;
        $avail_cashback  = $getBal['cashback-confirmed'] - $getBal['Paidout'][0]->paidCashback;
        $avail_bonus  = $getBal['bonus-confirmed'] - $getBal['Paidout'][0]->paidBonus;
		$allowed_cashback = 0;
		 $payout_mode = DB::table('tb_payout_types')->wherecode($request->mode)->first();
		$allowed_modes = explode(',',$payout_mode->cashback_allowed) ;

		if( $this->isFirstWithdrawal($user_id) )
		$min_transaction = $payout_mode->minimum_first_transaction;
		else
		$min_transaction = $payout_mode->minimum_transaction;

		if($request->withdrawal_amount < $min_transaction ){


		   $final_data = array(
                'status' => 0,
                'msg'=>  str_replace('#amount',$min_transaction,trans('actionMsg.withdraw_transaction_error')) ,
                'result' => null
            );
            return \Response::json($final_data);


        }



		if( in_array('reward',$allowed_modes))
			$allowed_cashback += $avail_reward;
		if( in_array('cashback',$allowed_modes))
			$allowed_cashback += $avail_cashback;
		if( in_array('bonus',$allowed_modes))
			$allowed_cashback += $avail_bonus;

		$user_exceed = true; $user_subzero = true;

		if( $request->withdrawal_amount <= $allowed_cashback  )
			$user_exceed = false;
		if($request->withdrawal_amount>0)
			$user_subzero = false;

		if(!$user_exceed )
		{
		$pending_amount = $request->withdrawal_amount;

		$total_amount = $request->withdrawal_amount;
		$bonus_amount = 0;
		$cashback_amount = 0;
		$reward_amount= 0;

		if( in_array('bonus',$allowed_modes))
		{
		if($pending_amount > $avail_bonus && $pending_amount > 0)
		$bonus_amount = $avail_bonus;
		else
			$bonus_amount = $pending_amount;

		$pending_amount = $pending_amount - $bonus_amount;
		}

		if( in_array('reward',$allowed_modes))
		{
		if($pending_amount > $avail_reward && $pending_amount > 0)
		$reward_amount = $avail_reward;
		else
			$reward_amount = $pending_amount;

		$pending_amount = $pending_amount - $reward_amount;

		}


		if( in_array('cashback',$allowed_modes))
		{
		if($pending_amount > $avail_cashback && $pending_amount > 0)
		$cashback_amount = $avail_cashback;
		else
			$cashback_amount = $pending_amount;

		$pending_amount = $pending_amount - $cashback_amount;
		}


		if($pending_amount != 0 )
		{


			$final_data = array(
                'status' => 0,
                'msg'=>  trans('actionMsg.withdraw_amount_error'),
                'result' => null
            );
            return \Response::json($final_data);



		}

		$insertToWithdraw  = true;
		 	DB::table('tb_user_withdrawals')->insert([
          'user_id'                 => $user_id,
          'mode'                    => $request->mode,
          'amount'                  => $request->withdrawal_amount,
		  'cashback_amount'			=> $cashback_amount,
		  'reward_amount'			=> $reward_amount,
		  'bonus_amount'			=> $bonus_amount,
          'mode_info1'              => $request->mode_info1,
          'mode_info2'              => $request->mode_info2,
          'mode_info3'              => $request->mode_info3,
          'mode_info4'              => $request->mode_info4,
          'mode_info5'              => $request->mode_info5,
          'withdrawal_request_date' => date('Y-m-d   H:i:s'),
          'status'                  => 'requested'
        ]);
        if($insertToWithdraw) {

		$userInfo = DB::table('tb_cashback_users')->select('first_name','last_name','email','created_at','member_id as user_id','profile_picture','creation_mode','social_link')->where('member_id',$user_id)->first();


        $lastId             = DB::getPdo()->lastInsertId();
        $searchArr          = ['#PayoutRequestID','#PayoutMode','#PayoutDetails','#PayoutAmount'];
        $repArr             = [$lastId,$request->mode,$request->mode_info1.'('.$request->mode_info2.')', $request->withdrawal_amount];
        $getEmailTemp       = AppClass::getTemplateByKey('payout_requested');

        if($getEmailTemp) {
          $subject          = $getEmailTemp->subject;
          $purpose          = $getEmailTemp->purpose;
          $sender_name      = $getEmailTemp->sender_name;
          $sender_email     = $getEmailTemp->sender_email;
          $reply_to         = $getEmailTemp->reply_to;
          $cc_email         = $getEmailTemp->cc_email;
          $body             = $getEmailTemp->body;
          $body             = str_ireplace($searchArr,$repArr,$body);
          $smsBody          = $getEmailTemp->sms_body;
          $smsBody          = str_ireplace('#FIRSTNAME',$userInfo->first_name,$smsBody);
          $smsBody          = str_ireplace('#LASTNAME',$userInfo->last_name,$smsBody);
          if($getEmailTemp->sms_enabled == 'Y') {
              AppClass::sendSMSWithName($userInfo->mobile_number,$smsBody);
          }
          AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$userInfo->email);
        }

		 $final_data = array(
                'status' => 1,
                'msg'=>  trans('actionMsg.withdraw_request_success'),
                'result' => true
            );
            return \Response::json($final_data);


        }
        else {


		  $final_data = array(
                'status' => 0,
                'msg'=>  trans('actionMsg.withdraw_request_error'),
                'result' => null
            );
            return \Response::json($final_data);

        }
		}
		else {

		  $final_data = array(
                'status' => 0,
                'msg'=>  trans('actionMsg.withdraw_funds_error'),
                'result' => null
            );
            return \Response::json($final_data);


        }
	}
	else{
		$final_data = array(
                'status' => 0,
                'msg'=>  'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);

	}


    }

	public function isFirstWithdrawal($user_id)
	{


		$withdrawCount = DB::table('tb_user_withdrawals')->where('user_id',$user_id)->where('status','<>','rejected')->count();
		if($withdrawCount>0)
			return false;
		else
			return true;

	}


	public function getUserRefers(Request $request)
	{
		 $token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
			$data = array();

			$userInfo = DB::table('tb_cashback_users')->select('referral_validity','referral_commission','referral_code','first_name','last_name','email','created_at','member_id as user_id','profile_picture','creation_mode','social_link')->where('member_id',$user_id)->first();

			 $data['userInfo'] = $userInfo;
			 $data['invited']         = DB::table('tb_user_invites')->whereuser_id($user_id)->orderBy('invite_date','desc')->get();
			$data['referedUser']     = DB::table('tb_cashback_users')->where('referred_by', $userInfo->referral_code )->get();


			 $getSocialLinks = AppClass::getSocialLinks(url('/join-us-now').'?referal_code='.$userInfo->referral_code,'Refer AND earn');

			$data['socialLinks']  = $getSocialLinks;
			$data['referralLink'] = url('/join-us-now').'?referal_code='.$userInfo->referral_code;

            $final_data = array(
                'status' => 1,
                'msg'=> '',
                'result' => $data
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }
	}

	public function getUserClaims(Request $request)
	{


	$token = $request->bearerToken();
        $user_id = $this->validateToken($token);
        if($user_id>0)
        {
			$claims = DB::table('tb_missing_cashback')->select('tb_missing_cashback.*','tb_stores.store_name','tb_clicks.click_time')
                                   ->join('tb_stores','tb_stores.store_id','=','tb_missing_cashback.tick_store_id')
                                   ->join('tb_clicks','tb_clicks.click_id','=','tb_missing_cashback.click_id')
                                   ->orderBy('tb_missing_cashback.tick_crDate','desc')
                                   ->wheretick_user_id($user_id)->get();

            $final_data = array(
                'status' => 1,
                'msg'=> '',
                'result' => $claims
            );
            return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 0,
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }

	}

  public function updateProfile(Request $request,Member $member) {
        $token = $request->bearerToken();
          $user_id = $this->validateToken($token);

        if($user_id>0)
        {
          // $getUser = $member->where('member_id',$user_id)->first();
          $queryUpdate = DB::table('tb_cashback_users')->where('member_id',$user_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_number' => $request->mobile_no
          ]);
          if($queryUpdate)  {
            $final_data = array(
                'status' => 'success',
                'msg'=> 'User profile successfully updated',
                'result' => null
            );
          }
          else {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Unable to update profile',
                'result' => null
            );
          }
          return \Response::json($final_data);
        }
        else
        {
            $final_data = array(
                'status' => 'error',
                'msg'=> 'Invalid Token',
                'result' => null
            );
            return \Response::json($final_data);
        }
  }

}
