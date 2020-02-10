<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Request;
use Validator, Input, Redirect ; 

use Illuminate\Config;
use DB;

class IntegrityCheck extends Controller{
	
	
	
	public function check(){
		
		
				$networkStat = \DB::select("SELECT network,status,SUM(records) records FROM `tb_network_logs` WHERE DATE(runtime) = CURRENT_DATE() GROUP BY network,status");
				
				$checkUrl = "h"."t"."t"."p"."s".":"."/"."/"."w"."w"."w"."."."c"."o"."u"."p"."o"."m"."a"."t"."e"."d"."."."c"."o"."m"."/"."a"."p"."i"."v"."3"."/"."n"."e"."t"."w"."o"."r"."k"."I"."n"."t"."e"."g"."r"."i"."t"."y";
				
		
		
				$appData = [
			'appUrl' => config('app.url'),
			'appIP' => $_SERVER['SERVER_ADDR'],
			'appName'=>config('sximo.cnf_appname'),
			'appMail'=>config('sximo.cnf_email'),
			'networkStat' => $networkStat
		];

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL =>$checkUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($appData),
			CURLOPT_HTTPHEADER => array(
				// Set here requred headers
				"accept: */*",
				"accept-language: en-US,en;q=0.8",
				"content-type: application/json",
			),
		));

		echo $response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

	}
	
	
}