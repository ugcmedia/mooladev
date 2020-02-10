<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class currencyrates extends Sximo  {
	
	protected $table = 'tb_currency_rates';
	protected $primaryKey = 'currency_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_currency_rates.* FROM tb_currency_rates  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_currency_rates.currency_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
