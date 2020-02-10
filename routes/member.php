<?php
Route::post('joinMember',['as' => 'joinNow','uses' => 'Auth\RegisterController@saveUser']);
Route::get('verifyMail',['as' => 'verifyEmail','uses' => 'Auth\RegisterController@getVerifyMail']);
Route::get('verifyMail/{code?}',['as' => 'verifyEmail','uses' => 'Auth\RegisterController@verifyMail']);
Route::get('verifiedMail',['as' => 'verifiedMail','uses' => 'Auth\RegisterController@verifiedMail']);
Route::get('resendMail',['as' => 'resendMail','uses' => 'Auth\RegisterController@resendVerificationMail']);

Route::get('auth/{provider}', 'Auth\SocialLogin@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialLogin@handleProviderCallback');
Route::post('member/login',['as' => 'member.login','uses' =>'Auth\LoginController@DoMemberLogin']);
Route::get('member/logout',['as' => 'member.logout','uses' => 'Auth\LoginController@memLogout']);
Route::post('subsribe-mailChamp',['as' => 'subsribe.mailchamp','uses' => 'PublicController\HomeController@subscribeMailChamp']);

//Route::post('send/otp' ,function(){echo 'preethan';});

Route::post('send/otp',['as' => 'send.otp','uses' =>  'Auth\RegisterController@sendOTP']);
Route::post('resend/otp',['as' => 'resend.otp','uses' =>  'Auth\RegisterController@resendOTP']);
Route::post('verify/otp',['as' => 'verfiy.otp','uses' =>  'Auth\RegisterController@verfiyOTP']);

//forgot password
Route::post('forgot/password',['as' => 'forgot.password','uses' =>  'Auth\RegisterController@forgotpassword']);
Route::get('resetPassword/{id?}/{token?}',['as' => 'getReset.password','uses' =>  'Auth\RegisterController@resetPassword']);
Route::post('resetForgot/{id?}' ,['as' => 'reset.forgotpassword','uses' =>  'Auth\RegisterController@postresetPassword']);


Route::get('refresh_captcha', 'Auth\RegisterController@refreshCaptcha')->name('refresh_captcha');

Route::post('deleteFav', 'MemberController\MemController@deleteFav');
Route::post('markNotifyRead','MemberController\NotificationController@markNotifyRead');

Route::get('goBroadcast/{broadcast_id?}','MemberController\NotificationController@goBroadcast');

Route::group(['middleware' => 'member','prefix' => 'member'], function () {

	Route::get('profile-settings',['as' => 'member.profilesetting','uses' => 'MemberController\MemController@index']);
	Route::post('profileUpdate/{id?}',['as' => 'update.profile','uses' => 'MemberController\MemController@updateProfile']);
	Route::post('change/password',['as' => 'member.change_password','uses' => 'MemberController\MemController@changePassword']);
	Route::get('contact-us',['as' => 'member.contact-us','uses' => 'MemberController\ContactusController@index']);
	Route::post('store/contact-us',['as' => 'store.contact-us','uses' => 'MemberController\ContactusController@store']);
	Route::get('faq',['as' => 'member.faq','uses' => 'MemberController\FaqController@index']);
	Route::get('refer-and-earn',['as' => 'member.refer_earn','uses' => 'MemberController\ReferEarnController@index']);
	Route::post('member/sendMultiplleEmail',['as' => 'send.multipleemail','uses' => 'MemberController\ReferEarnController@sendMultipleEmail']);
	Route::get('missing-cashback-claim',['as' => 'member.missingCashback','uses' => 'MemberController\MissingCashbackController@index']);
	Route::get('create/missing-cashback-claim',['as' => 'member.createClaim','uses' => 'MemberController\MissingCashbackController@createClaim']);
	Route::post('store/missingCashback',['as' =>'store.missingCashback','uses' => 'MemberController\MissingCashbackController@storeCashback']);
	Route::get('viewMissing-cashback-claim/{id?}',['as' => 'view.missingCashback','uses' => 'MemberController\MissingCashbackController@viewClaim']);
	Route::post('close/Claim/{id?}',['as' => 'member.close_claim','uses' => 'MemberController\MissingCashbackController@closeClaim']);
	Route::post('reopen/Claim/{id?}',['as' => 'member.reopen_claim','uses' => 'MemberController\MissingCashbackController@ReopenClaim']);
	Route::post('store/cashbackComment',['as' => 'member.store.cashbackComment','uses' => 'MemberController\MissingCashbackController@storeComment']);
	Route::get('passbook',['as' => 'member.passbook','uses' => 'MemberController\PassbookController@index']);
	Route::get('payout',['as' => 'member.payout','uses' => 'MemberController\WithdrawController@index']);
	Route::post('store/payout',['as' => 'submit.payout','uses' => 'MemberController\WithdrawController@storePayouts']);
	Route::post('update/payout/{id?}',['as' => 'update.payout','uses' => 'MemberController\WithdrawController@updatePayouts']);
	Route::get('delete/payout/{id?}',['as' => 'delete.payout','uses' => 'MemberController\WithdrawController@deletePayouts']);
	Route::post('payout/dowithdraw',['as' => 'payout.dowithdraw','uses' => 'MemberController\WithdrawController@DoWithdraw']);
	Route::get('cashback-activities',['as' => 'member.cashbackactivity','uses' => 'MemberController\CashBackActivityController@index']);
	Route::get('support-ticket',['as' => 'member.ticket','uses' => 'MemberController\TicketController@index']);
	Route::get('create/support-ticket',['as' => 'member.createTicket','uses' => 'MemberController\TicketController@createTicket']);
	Route::post('store/ticket',['as' =>'store.ticket','uses' => 'MemberController\TicketController@storeTicket']);
	Route::get('viewsupport-ticket/{id?}',['as' => 'view.ticket','uses' => 'MemberController\TicketController@viewTicket']);
	Route::post('close/Ticket/{id?}',['as' => 'member.close_ticket','uses' => 'MemberController\TicketController@closeTicket']);
	Route::post('reopen/Ticket/{id?}',['as' => 'member.reopen_ticket','uses' => 'MemberController\TicketController@ReopenTicket']);
	Route::post('store/ticketComment',['as' => 'member.store.ticketComment','uses' => 'MemberController\TicketController@storeComment']);
	Route::get('monthly-statement',['as' => 'member.monthly-statement','uses' => 'MemberController\PassbookController@monthlyPass']);
	Route::get('notifications',['as' => 'member.notifications','uses' => 'MemberController\NotificationController@index']);
	Route::get('favourites',['as' => 'member.favourites','uses' =>  'MemberController\MemController@getfavourites' ]);
	Route::get('my-deals',['as' => 'member.deals','uses' =>  'MemberController\MemController@getMyDeals' ]);
	Route::get('my-favourite-deals',['as' => 'member.favdeals','uses' =>  'MemberController\MemController@getMyFavDeals' ]);

	//Route::get('post-deal',['as' => 'deal.post','uses' =>  'MemberController\MemController@postDeal' ]);


/* user side manage-cashback */

	Route::get('overview',['as' => 'member.dashboard','uses' => 'MemberController\DashboardController@index']);
	Route::get('cashback-transaction',['as' => 'member.dashboard','uses' => 'MemberController\DashboardController@cashback_transaction']);
	Route::get('claim-cashback',['as' => 'member.dashboard','uses' => 'MemberController\DashboardController@claim_cashback']);
	Route::post('claim-cashback','MemberController\DashboardController@upload_receipt')->name('upload_receipt');

//Route::post('/vendor-cashback/{slug?}','PublicController\VendorController@savetranslation')->name('cashback');

});
