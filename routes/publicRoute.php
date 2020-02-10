<?php

//Single vendor page routes start here
Route::get('vendor/{slug?}',['as' => 'vendorOffer','uses' =>  'PublicController\VendorController@index']);

Route::get('vendor-cashback/{slug?}',['as' => 'vendorOffer','uses' =>  'PublicController\VendorController@ActivityCashback']);
Route::post('/vendor-cashback/{slug?}','PublicController\VendorController@savetranslation')->name('cashback');


// Route::get('vendor-cashback/{slug?}',function(){
// echo "tets";
// });




//Route::get('getCoupon-comments',['as' => 'getCoupon.comment','uses' =>  'PublicController\HomeController@getCouponComment']);
//Route::post('store-Comment',['as' => 'store.comments','uses' =>  'PublicController\HomeController@StoreComment']);

//Single Category page routes start here
Route::get('category/{slug?}',['as' => 'category','uses' =>  'PublicController\CategoryController@index']);
//Route::post('ajaxCouponTab/getCoupons/{type?}/{catId?}', ['as' =>'ajaxCouponTab.dynamic','uses'=>'PublicController\HomeController@AjaxCouponTabs']);
//Route::post('CouponTab/getCoupons/{type?}/{catId?}', ['as' =>'ajaxCouponTab2.dynamic','uses'=>'PublicController\HomeController@AjaxCouponTabs2']);


/* All Store */
//Route::get('all-stores/{slug?}',['as' => 'category','uses' =>  'PublicController\AllStore@index']);
Route::get('all-stores',['as' => 'all-vendor','uses' =>  'PublicController\AllStore@index']);
