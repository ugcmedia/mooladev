<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class usertips extends Sximo  {
	
	protected $table = 'tb_user_tips';
	protected $primaryKey = 'tipid';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_user_tips.* FROM tb_user_tips  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_user_tips.tipid IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
