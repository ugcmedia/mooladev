<?php
namespace App\Http\Controllers\Auth;

use Mail;
use Illuminate\Http\Request;
use Validator, Input, Redirect ;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Member;
use Auth;
use Socialite;
use Session;
use URL;
use App\Helpers\AppClass;

class SocialLogin extends Controller {

	public function __construct()
	{
		parent::__construct();
	}



	public function redirectToProvider($provider)
	{
		$refUrl                 = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('/');
		$currentUrl = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : $refUrl;
		setcookie('redirect-to', $currentUrl, time()+(3600*60));
		//return Socialite::driver($provider)->redirect();
		//return Socialite::buildProvider(\Laravel\Socialite\Two\FacebookProvider::class, $config);
		$fbConfig = [
        'client_id' => config('settingConfig.social_fb_clientid'),
        'client_secret' => config('settingConfig.social_fb_secret'),
        'redirect' =>  url('/auth/facebook/callback'),
    ];
		$goConfig = 	     [
		        'client_id' => config('settingConfig.social_google_clientid'),
		        'client_secret' => config('settingConfig.social_google_secret'),
		        'redirect' => url('auth/google/callback'),
		    ];

		if($provider=='facebook')
		$providerObj = Socialite::buildProvider(\Laravel\Socialite\Two\FacebookProvider::class, $fbConfig);
		else if($provider=='google')
		$providerObj = Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class, $goConfig);

		return $providerObj->redirect();

	}

	public function handleProviderCallback($provider,Request $request)
   {

		 $fbConfig = [
				 'client_id' => config('settingConfig.social_fb_clientid'),
				 'client_secret' => config('settingConfig.social_fb_secret'),
				 'redirect' =>  url('/auth/facebook/callback'),
		 ];
		 $goConfig = 	     [
						 'client_id' => config('settingConfig.social_google_clientid'),
						 'client_secret' => config('settingConfig.social_google_secret'),
						 'redirect' => url('auth/google/callback'),
				 ];

		 if($provider=='facebook')
		 $providerObj = Socialite::buildProvider(\Laravel\Socialite\Two\FacebookProvider::class, $fbConfig);
		 else if($provider=='google')
		 $providerObj = Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class, $goConfig);

	       $user = $providerObj->stateless()->user();
				 $authUser = Member::where('email',$user->email)->wherecreation_mode('D')->first();
				 if(isset($_COOKIE['redirect-to'])) {
 				    $RedirectTo = urldecode($_COOKIE['redirect-to']);
 				}
				else {
					$RedirectTo = '/';
				}
				 if ($authUser) {
				 	if ($authUser->email == $user->email) {
				 		 echo  redirect($RedirectTo)->with('merror',['msg' => trans('actionMsg.social_login_error_msg'),'type' =>'login']);
				  }
				}
				else {
					$authUser = $this->findOrCreateUser($user, $provider);
					if(!$authUser)
						return redirect($RedirectTo)->with('merror', ['msg' => trans('actionMsg.social_fb_email_error_msg'),'type' =>'joniNow'] );

					Auth::guard('member')->login($authUser,true);
					Session::put('memberDetail',$authUser);
					return redirect($RedirectTo)->with('msuccess',['msg' => trans('actionMsg.social_login_success_msg'),'type' =>'slogin']);

				}

    }

   public function findOrCreateUser($user, $provider)
   {
        $mode     = '';
				if(isset($_COOKIE['redirect-to'])) {
					 $RedirectTo = urldecode($_COOKIE['redirect-to']);
			 }
			 else {
				 $RedirectTo = '/';
			 }
        if($provider == 'facebook') {

            $mode = 'F';
						if(!$user->email ) {
							return null;
							//return redirect($RedirectTo)->with('error','Your Facebook is not linked to any email id, try other modes of Singup');
						}
        }
        if($provider == 'google') {
          	$mode   = 'G';
        }

       $authUser = Member::where('social_ref_key', $user->id)->orWhere('email',$user->email)->first();
       if ($authUser) {
           return $authUser;
       }
			 else {
       $createMember =  Member::create([
           'first_name'           => $user->name,
           'creation_mode'        => $mode,
           'email'                => $user->email,
           'social_ref_key'       => $user->id,
           'social_link'          => $user->avatar,
					 'email_verified'       => 'Y'
       ]);
			 // echo substr(preg_replace('/[^A-Za-z]/', '', strtoupper($createMember->first_name)),0,25).$createMember->member_id;
			 // echo preg_replace('/[^A-Za-z]/', '', strtoupper($createMember->first_name));
			 // echo substr( strtoupper($createMember->first_name),0,25);

		//	 dd($createMember);
			 $referCode 		 =  substr(preg_replace('/[^A-Za-z]/', '', strtoupper($createMember->first_name)),0,25).$createMember->member_id;

			 $updateData     =  ['referral_code' => $referCode];

	 			if(isset($_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'])) {

	 				$date             = date('y-m-d');

						  if(config('settingConfig.mlm_enabled') =='Y')
		{ $referral_commission = config('settingConfig.mlm_split'); $referral_validity = config('settingConfig.referral_valid_date'); }
			else
			{ $referral_commission = 0; $referral_validity = date('Y-m-d');}



	 				if($_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'] != null){
	 						$updateData = ['referral_code' => $referCode,'referred_by' => $_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'],
							'referral_commission'=>$referral_commission,'referral_validity'=>$referral_validity];
	 						$memRefId   = Member::wherereferral_code($_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'])->first();
	 				}
	 					$getBonusForJoin = DB::table('tb_bonus_types')->wherebonus_code('join_bonus')->whereenabled('Y')->first();
	 					if(Count($getBonusForJoin) > 0)  {
	 						$joinValidity     = date('Y-m-d', strtotime($date. ' +'.$getBonusForJoin->validity_days.'days'));
	 						// $insertUserJoin   = DB::table('tb_user_referrals')->insert(['user_id'             => $createMember->member_id,
	 						// 																																'ref_id'          => 0,
	 						// 																																'joined_date'     => date('Y-m-d h:i:s a', time()),
	 						// 																																'bonus_amount'    => $getBonusForJoin->bonus_amount,
	 						// 																																'status'          => 'pending',
	 						// 																																'validity_date'   => $joinValidity
	 						// 	]);

	 							$insertUserBonus  = DB::table('tb_user_bonus')->insert(['user_id'     => $createMember->member_id,
	 																																			'bonus_type'  => $getBonusForJoin->bonus_code,
	 																																			'amount'      => $getBonusForJoin->bonus_amount,
	 																																			'date_added'  => date('Y-m-d'),
	 																																			'date_expire' => $joinValidity,
	 																																			'status'      => 'pending']);
	 					}

	 					$getBonusForRefer = DB::table('tb_bonus_types')->wherebonus_code('referral_bonus')->whereenabled('Y')->first();
	 					if(Count($getBonusForRefer) > 0)  {
	 						$joinValidity          = date('Y-m-d', strtotime($date. ' +'.$getBonusForRefer->validity_days.'days'));
	 						$insertUserReferrals   = DB::table('tb_user_referrals')->insert(['user_id'       => $memRefId->member_id,
	 																																						'ref_id'         => $createMember->member_id ,
	 																																						'joined_date'    => date('Y-m-d h:i:s a', time()),
	 																																						'bonus_amount'   => $getBonusForRefer->bonus_amount,
	 																																						'status'         => 'pending',
	 																																						'validity_date'  => $joinValidity
	 							]);
	 					$insertUserBonus  = DB::table('tb_user_bonus')->insert(['user_id'     => $memRefId->member_id,
	 																																	'bonus_type'  => $getBonusForRefer->bonus_code,
	 																																	'amount'      => $getBonusForRefer->bonus_amount,
	 																																	'date_added'  => date('Y-m-d'),
	 																																	'date_expire' => $joinValidity,
	 																																	'status'      => 'pending']);

	 					}

	 			}


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

			 $updateMember   =  $createMember->update($updateData);
			 return $createMember;
		 }


   }

}
