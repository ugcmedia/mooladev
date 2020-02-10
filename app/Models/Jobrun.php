<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class jobrun extends Sximo  {
	
	protected $table = 'tb_cron_jobs';
	protected $primaryKey = 'jobid';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_cron_jobs.* FROM tb_cron_jobs  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_cron_jobs.jobid IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
