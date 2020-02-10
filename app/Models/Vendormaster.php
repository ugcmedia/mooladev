<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class vendormaster extends Sximo  {

	protected $table = 'tb_vendors';
	protected $primaryKey = 'vendor_id';

	public function __construct() {
		parent::__construct();

	}

	public static function querySelect(  ){

		return "  SELECT tb_vendors.* FROM tb_vendors  ";
	}

	public static function queryWhere(  ){

		return "  WHERE tb_vendors.vendor_id IS NOT NULL ";
	}

	public static function queryGroup(){
		return "  ";
	}


}
