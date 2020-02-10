<?php
namespace App\Http\Controllers\PublicController;

use App\Models\Post;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Helpers\AppClass;
use App\Helpers\MobileDetect;

class MobileController extends Controller {

  public $checkDevice;


  public function __construct()
	{
    $this->checkDevice = 	new MobileDetect();
		parent::__construct();
	}

  //subscribe WhatsApp
  public function subscribeWhatsApp(Request $request) {
	  DB::table('tb_whatsapp_subscribers')->insert(['phone_number' =>$request->mobile_no]);
	  $sms_body  = str_ireplace('#LINK',url('/getWhatsApp'),config('settingConfig.social_whatsapp_body'));
    $sendSMS = AppClass::sendSMS($request->mobile_no,$sms_body);
    if($sendSMS) {
        return response()->json(['statusCode' => 200,'msg' => trans('actionMsg.hp_get_app_link_success_msg')]);
      }
    else {
      return response()->json(['statusCode' => 300,'msg' => trans('actionMsg.hp_get_app_link_error_msg')]);
    }
  }

  public function getWhatsApp() {
    $msg = config('settingConfig.social_whatsapp_sendtxt');
    if($this->checkDevice->isMobile()) {
        return '  <!DOCTYPE html>
                  <html>
                  <head>
                  <meta http-equiv="Refresh" content="1;url=whatsapp://send?text='.$msg.'&phone='.config('settingConfig.social_whatsapp_number').'&abid='.config('social_whatsapp_number').'">
                  </head>
                  </html>';
    }
    else {
      return '<!DOCTYPE html>
              <html>
              <head>
              <meta http-equiv="Refresh" content="1;url=https://api.whatsapp.com/send?phone='.config('settingConfig.social_whatsapp_number').'&text='.$msg.'">
              </head>
              </html>';
    }

  }


  //request for get app link
  public function getAppDownloadLink(Request $request) {
	  $sms_body  = str_ireplace('#LINK',url('/getApp'),config('settingConfig.social_dwapp_body'));
      $sendSMS = AppClass::sendSMS($request->mobile_no,$sms_body);
      if($sendSMS) {
          return response()->json(['statusCode' => 200,'msg' => trans('actionMsg.hp_get_app_link_success_msg')]);
        }
      else {
        return response()->json(['statusCode' => 300,'msg' => trans('actionMsg.hp_get_app_link_error_msg')]);
      }
  }

  //when user comes from get app link
  public function getDownloadLink() {

    if($this->checkDevice->isAndroidOS()) {
        return '<!DOCTYPE html>
                  <html>
                  <head>
                  <meta http-equiv="Refresh" content="1;url='.config('settingConfig.app_google').'">
                  </head>
                  </html>';
    }
    else if($this->checkDevice->isiOS()) {
        return '  <!DOCTYPE html>
                  <html>
                  <head>
                  <meta http-equiv="Refresh" content="1;url='.config('settingConfig.app_apple').'">
                  </head>
                  </html>';
    }
    else {
        return '<!DOCTYPE html>
                <html>
                <head>
                <meta http-equiv="Refresh" content="1;url='.url('/').'">
                </head>
                </html>';
      }
  }

  //download ios app
  public function downloadIosapp() {

      return '<!DOCTYPE html>
              <html>
              <head>
              <meta http-equiv="Refresh" content="1;url='.config('settingConfig.app_apple').'">
              </head>
              </html>';

  }

  //download android app
  public function downloadAndroidapp() {
        return
                '<!DOCTYPE html>
                  <html>
                  <head>
                  <meta http-equiv="Refresh" content="1;url='.config('settingConfig.app_google').'">
                  </head>
                  </html>';

  }




}
