<?php
Route::group(['prefix' => 'moolaApi'], function () {
  //general Api start from here
  Route::get('/getWelcomeScreen', 'AppApiController\PublicApiController@welcomeAPI');
  Route::get('/getHomepage', 'AppApiController\PublicApiController@homepageAPI');
  Route::get('/getAllCategories','AppApiController\PublicApiController@allCategoriesAPI');
  Route::get('singleVendorDetail/{id?}','AppApiController\PublicApiController@getVendorInfo');
  Route::get('/getAllFaqCategories','AppApiController\PublicApiController@allFaqCat');
  Route::get('/getAllVendor','AppApiController\PublicApiController@allVendorAPI');
  Route::get('/catWiseVendor/{catID?}','AppApiController\PublicApiController@catWiseVendor');
  Route::get('/getLocations','AppApiController\PublicApiController@getLocations');
  Route::get('/faqFilterCat','AppApiController\PublicApiController@allFaqCat');
  Route::get('/faqFilteredCat/{catCode}','AppApiController\PublicApiController@FaqCategoryAPI');
  Route::get('/searchVendorOffer/{keyword?}','AppApiController\PublicApiController@getAllSearchResults');

    //Account Api start from here
    Route::group(['prefix' => 'user'], function () {
     Route::post('/loginUser', 'AppApiController\MemberApiController@loginUser');
     Route::post('/registerUser', 'AppApiController\MemberApiController@createUser');
     Route::post('/socialLogin', 'AppApiController\MemberApiController@socialUserLoginSignup');
     Route::post('/updatePassword', 'AppApiController\MemberApiController@updatePassword');
     Route::post('/forgotPassword', 'AppApiController\MemberApiController@forgotPassword');
     Route::post('/getUserInfo', 'AppApiController\MemberApiController@getUserInfo');
     Route::post('/uploadReceipt', 'AppApiController\MemberApiController@uploadReceipt');
     Route::post('/renewToken', 'AppApiController\MemberApiController@renewToken');
     Route::post('/addFavorite','AppApiController\MemberApiController@addUserFavs');
     Route::post('/deleteFavorite','AppApiController\MemberApiController@deleteUserFavs');
     Route::get('/getUserFavrorite','AppApiController\MemberApiController@getUserFavs');
     Route::post('/updateProfile','AppApiController\MemberApiController@updateProfile');
     Route::get('/getUserTransaction','AppApiController\MemberApiController@getUserTransaction');
   });

});
/*

http://206.189.141.185/saturn/
username: yGqrCCenxQCNuE
password: X*c7Dg>T)@NY8~D
DB_NAME : moola101
*/
