<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Default Controller

Route::group(['middleware' => 'setting'], function () {
	Route::get('/', 'PublicController\HomeController@index');
});
include('publicRoute.php');
include('member.php');
include('partner.php');
Route::post('/home/submit', 'HomeController@submit');
Route::get('/home/skin/{any?}', 'HomeController@getSkin');
Route::get('/appCheck','IntegrityCheck@check');
Route::get('dashboard/import', 'DashboardController@getImport');
Route::get('dashboard/genTemplate','DashboardController@generateEmailTemplates');
/* Auth & Profile */
Route::get('user/profile','UserController@getProfile');
Route::get('user/login','UserController@fakeLogin');
Route::get('lonavala','UserController@getLogin');
//Route::get('user/register','UserController@getRegister');
Route::get('user/logout','UserController@getLogout');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/reset/{any?}','UserController@getReset');
Route::get('user/reminder','UserController@getReminder');
Route::get('user/activation','UserController@getActivation');
// Social Login
Route::get('user/socialize/{any?}','UserController@socialize');
Route::get('user/autosocialize/{any?}','UserController@autosocialize');
//
Route::post('user/signin','UserController@postSignin');
Route::post('user/create','UserController@postCreate');
Route::post('user/saveprofile','UserController@postSaveprofile');
Route::post('user/savepassword','UserController@postSavepassword');
Route::post('user/doreset/{any?}','UserController@postDoreset');
Route::post('user/request','UserController@postRequest');

/* Posts & Blogs */
Route::get('blog','HomeController@blogs');
Route::get('blog/{any}','HomeController@blogs');
Route::post('blog/comment','HomeController@comment');
Route::get('blog/remove/{id?}/{id2?}/{id3?}','HomeController@remove');
Route::post('blog/comment/reply/{id?}','HomeController@replyCommentBlog');


///paypal payments

Route::get('paypal','PublicController\PaypalController@index');


// Start Routes for Notification
Route::resource('notification','NotificationController');
Route::get('home/load','HomeController@getLoad');
Route::get('home/lang/{any}','HomeController@getLang');

Route::get('/set_theme/{any}', 'HomeController@set_theme');


include('pages.php');


Route::resource('sximoapi','SximoapiController');

// Routes for  all generated Module\

// Start Routes for settings

Route::get('settings/{type?}',['as' => 'settings','uses' => 'SettingsController@index']);
Route::post('updateSetting','SettingsController@updateSetting');
Route::post('bulkColor','ColorsController@bulkColor');
Route::post('updateColor','ColorsController@updateColor');
Route::get('colors/{type?}',['as' => 'colors','uses' => 'ColorsController@show']);

include('module.php');


Route::post('doPaypal','CustomController@withdrawPaypal');
Route::get('statusPaypal','Integrations\PaypalStatus@updateStatus');


// Custom routes
$path = base_path().'/routes/custom/';
$lang = scandir($path);
foreach($lang as $value) {
	if($value === '.' || $value === '..') {continue;}
	include( 'custom/'. $value );

}
// End custom routes
Route::group(['middleware' => 'auth'], function () {
	Route::resource('dashboard','DashboardController');
	Route::resource('new-dash','DDashboardController');
});


Route::group(['namespace' => 'Sximo','middleware' => 'auth'], function () {
	// This is root for superadmin
		include('sximo.php');
});

Route::group(['namespace' => 'Core','middleware' => 'auth'], function () {
	include('core.php');
});




/* Sitemap */

/* Sitemap */

Route::get('sitemap.xml', 'SitemapController@index');
Route::get('robots.txt', 'SitemapController@robots');
Route::get('sitemap/{any}', 'SitemapController@sitemap');
include('moolaApi.php');
