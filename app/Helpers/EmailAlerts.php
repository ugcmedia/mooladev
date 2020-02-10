<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Exception;
use Log;
use DB;
use App\Helpers\AppClass;
use Mail;

class EmailAlerts extends Model
{

	public static function alertPayoutUpdate()
	{

	}

	public static function trigger($module,$id)
	{
		//echo $module; echo $id;
		$template = AppClass::getTemplateByModule($module);
		if(count($template) > 0) {
			$subject = $template->subject;
			$body = $template->body;
			$sms_content = $template->sms_body;
			// Replace sitename
			$data =  DB::table('vw_'.$module)->where('ID',$id)->first();
			//$data = \DB::select('select * from vw_'.$module.'  WHERE ID = '.$id);
			$data = json_decode(json_encode($data), TRUE);
			foreach($data as $key=>$value)
			{
				$subject = str_ireplace('#'.$key,$value,$subject);
				$body = str_ireplace('#'.$key,$value,$body);
				/* 
				$subject = str_ireplace($key,$value,$subject);
				$body = str_ireplace($key,$value,$body); */
				
				$body = str_ireplace('#subject',$subject,$body);
				
				$sms_content = str_ireplace('#'.$key,$value,$sms_content);
				//$sms_content = str_ireplace($key,$value,$sms_content);

			}

			/* $headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$template->sender_name.' <'.$template->sender_email.'>' . "\r\n";
			Mail::send('mailEmail', ['data' => $body],function($message) use ($data,$subject,$body,$template){
			$message->to($data['EMAIL'])->subject($subject);
			$message->from($template->sender_email,$template->sender_name); 
			});*/
			
			AppClass::sendEmail($subject,$purpose=null,$template->sender_name,$template->sender_email,$template->reply_to,$template->cc_email,$body,$data['EMAIL'],$fullName = null);
			
			$tb_module = EmailAlerts::getTableByModule($module);
			if( $tb_module )
			{
				if( Schema::hasTable($tb_module->module_db) && Schema::hasColumn($tb_module->module_db,'email_sent') )
				DB::table($tb_module->module_db)->where($tb_module->module_db_key,$id)->update(['email_sent'=>'Y']);
				
				$sub_key = $tb_module->module_db_key;
				if($tb_module->module_db=='tb_missing_cashback') $sub_key = 'claim_id';
				
				if( Schema::hasTable($tb_module->module_db.'_changes') && Schema::hasColumn($tb_module->module_db.'_changes','email_sent') )
				DB::table($tb_module->module_db.'_changes')->where($sub_key,$id)->update(['email_sent'=>'Y']);
				
			}
		

//		mail($data['EMAIL'], $subject, $body, $headers);

		if( strlen(trim($sms_content))>1 && $template->sms_enabled=='Y')
			AppClass::sendSMS($data['MOBILE_NUM'],$sms_content);
		}
	}
	
	public static function getTableByModule($module)
	{
		$tb_module = DB::table('tb_module')->where('module_name', $module)->first();
		if($tb_module)
			return $tb_module;
		else
			return null;
	}


}
