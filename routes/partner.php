<?php

Route::get('partner/login', ['as' => 'partner.login', 'uses' => 'Auth\Partner\PartnerLoginController@index']);
Route::post('partner/doLogin', ['as' => 'partner.dologin', 'uses' => 'Auth\Partner\PartnerLoginController@doPartnerLogin']);
//Route::post('vpanel/login',['as' => 'vpanel.login','uses' =>'Auth\vendor\LoginController@DoMemberLogin']);
Route::get('partner/logout',['as' => 'partner.logout','uses' => 'Auth\Partner\PartnerLoginController@memLogout']);
Route::get('partner/register',['as' => 'partner.register','uses' => 'Auth\Partner\PartnerRegisterController@index']);
Route::post('joinPartner',['as' => 'joinPartner','uses' => 'Auth\Partner\PartnerRegisterController@saveUser']);
//Route::get('verifyMail',['as' => 'verifyEmail','uses' => 'Auth\Partner\PartnerRegisterController@getVerifyMail']);
Route::get('verifyMailPartner',['as' => 'verifyMailPartner','uses' => 'Auth\Partner\PartnerRegisterController@getVerifyMail']);
Route::get('verifyMailPartner/{code?}',['as' => 'verifyMailPartner','uses' => 'Auth\Partner\PartnerRegisterController@verifyMail']);
Route::get('verifiedMailPartner',['as' => 'verifiedMailPartner','uses' => 'Auth\Partner\PartnerRegisterController@verifiedMail']);
Route::get('resendMailPartner',['as' => 'resendMailPartner','uses' => 'Auth\Partner\PartnerRegisterController@resendVerificationMail']);

//Route::get('auth/{provider}', 'Auth\SocialLogin@redirectToProvider');
//Route::get('auth/{provider}/callback', 'Auth\SocialLogin@handleProviderCallback');

//Route::post('subsribe-mailChamp',['as' => 'subsribe.mailchamp','uses' => 'PublicController\HomeController@subscribeMailChamp']);

//Route::post('send/otp' ,function(){echo 'preethan';});
Route::post('send/otp',['as' => 'send.otp','uses' =>  'Auth\Partner\PartnerRegisterController@sendOTP']);
Route::post('resend/otp',['as' => 'resend.otp','uses' =>  'Auth\Partner\PartnerRegisterController@resendOTP']);
Route::post('verify/otp',['as' => 'verfiy.otp','uses' =>  'Auth\Partner\PartnerRegisterController@verfiyOTP']);

//forgot password
Route::post('forgot/password',['as' => 'forgot.password','uses' =>  'Auth\Partner\PartnerRegisterController@forgotpassword']);
Route::get('resetPassword/{id?}/{token?}',['as' => 'getReset.password','uses' =>  'Auth\Partner\PartnerRegisterController@resetPassword']);
Route::post('resetForgot/{id?}' ,['as' => 'reset.forgotpassword','uses' =>  'Auth\Partner\PartnerRegisterController@postresetPassword']);


Route::group(['middleware' => 'partner','prefix' => 'partner'], function () {

	Route::get('complete-profile',['as' => 'partner.completeProfile','uses' => 'PartnerController\CompleteProfileController@index']);
	Route::post('complete-profile',['as' => 'partner.completeProfile','uses' => 'PartnerController\CompleteProfileController@submitProfile']);
	Route::get('offers',['as' => 'partner.offers','uses' => 'PartnerController\OfferController@index']);
	Route::get('offers/add',['as' => 'partner.offerAdd','uses' => 'PartnerController\OfferController@add']);
	Route::post('offers/save',['as' => 'partner.offerSave','uses' => 'PartnerController\OfferController@save']);
	Route::get('offers/edit/{id?}',['as' => 'partner.offerEdit','uses' => 'PartnerController\OfferController@edit']);
	Route::get('offers/delete/{id?}',['as' => 'partner.offerDelete','uses' => 'PartnerController\OfferController@delete']);
	Route::post('offers/update/{id?}',['as' => 'partner.offerUpdate','uses' => 'PartnerController\OfferController@update']);
	Route::get('partner-overview',['as' => 'partner.dashboard','uses' => 'PartnerController\DashboardController@index']);



	//Route::get('complete-profile',['as' => 'vendor.completeProfile','uses' => 'Auth\Partner\PartnerRegisterController@completeProfile']);
	Route::get('overview',['as' => 'member.dashboard','uses' => 'MemberController\DashboardController@index']);
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

	/* manage-cashback */
Route::post('offers/save',['as' => 'partner.offerSave','uses' => 'PartnerController\OfferController@save']);
Route::get('manage-cashback',['as' => 'partner.dashboard','uses' => 'PartnerController\CashBackController@manage_cashback']);
Route::post('manage-cashback','PartnerController\CashBackController@update_cashback')->name('edit_cashback');
Route::get('cashback-dispuite',['as' => 'partner.dashboard','uses' => 'PartnerController\CashBackController@cashback_dispuite']);



});
