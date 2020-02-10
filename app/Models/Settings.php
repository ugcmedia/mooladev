<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class settings extends Sximo  {

	protected $table = 'tb_settings';
	protected $primaryKey = 'setting_id';
	public $timestamps = false;
	
	public function __construct() {
		parent::__construct();

	}

	public static function querySelect(  ){

		return "  SELECT tb_settings.* FROM tb_settings  ";
	}

	public static function queryWhere(  ){

		return "  WHERE tb_settings.setting_id IS NOT NULL ";
	}

	public static function queryGroup(){
		return "  ";
	}


}
