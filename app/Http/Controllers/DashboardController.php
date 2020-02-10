<?php namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller {

	public function __construct()
	{
		parent::__construct();

        $this->data = array(
            'pageTitle' =>  $this->config['cnf_appname'],
            'pageNote'  =>  'Welcome to Dashboard',

        );
	}

	public function index_old( Request $request )
	{
		$amt_res = DB::select("SELECT IFNULL(SUM(comission),0) as amount , 'total_earning' as amount_type FROM `tb_network_transactions` WHERE status NOT IN ('cancelled','cancel','declined')
			UNION
			SELECT IFNULL(SUM(cashback_amount),0) , 'user_cashback' FROM `tb_user_transaction` WHERE status NOT IN ('cancelled','cancel','declined')
			UNION
			SELECT IFNULL(SUM(amount),0) , 'bonus' FROM `tb_user_bonus`  WHERE status NOT IN ('cancelled','cancel','declined')
			UNION
			SELECT IFNULL(SUM(bonus_amount),0) , 'referral' FROM `tb_user_referrals`  WHERE status NOT IN ('cancelled','cancel','declined')");

		$amounts = array();
		foreach($amt_res as $amt)
		$amounts[$amt->amount_type] = $amt->amount;

		$count_res = DB::select("SELECT COUNT(*) as object_count , 'coupon' as object_type FROM `tb_coupons`
		UNION
		SELECT COUNT(*) , 'brand' FROM `tb_brands`
		UNION
		SELECT COUNT(*),'deal' FROM `tb_deals`
		UNION
		SELECT COUNT(*),'store' FROM `tb_stores`
		UNION
		SELECT COUNT(*),'tag' FROM `tb_tags`
		UNION
		SELECT COUNT(*),'network' FROM `tb_network`
		UNION
		SELECT COUNT(*),'click' FROM `tb_clicks`
		UNION
		SELECT COUNT(*),'user' FROM `tb_cashback_users`
		UNION
		SELECT COUNT(*),'page' FROM `tb_pages` WHERE pagetype = 'page'
		UNION
		SELECT COUNT(*),'post' FROM `tb_pages` WHERE pagetype = 'post'
		UNION
		SELECT COUNT(*),'brands' FROM `tb_brands`
		UNION
		SELECT COUNT(*),'store_cat' FROM `tb_store_categories`
		UNION
		SELECT COUNT(*),'cat' FROM `tb_categories`
		UNION
		SELECT COUNT(*),'tags' FROM `tb_tags`
		");

		$topStores = DB::select("SELECT * FROM `tb_stores` s  ORDER BY s.clicks DESC LIMIT 10");
		$topCoupons  = DB::select("SELECT object_id , count(*) as clicks, store_name, title FROM `tb_clicks` cl, `tb_coupons` cp , `tb_stores` ts WHERE object_type = 'coupon' AND object_id = coupon_id AND cp.store_id = ts.store_id GROUP BY object_id ORDER BY 2 DESC LIMIT 10");

		$topDeals  = DB::select("SELECT object_id , count(*) as clicks, store_name, title FROM `tb_clicks` cl, `tb_deals` cp , `tb_stores` ts WHERE object_type = 'deal' AND object_id = deal_id AND cp.store_id = ts.store_id GROUP BY object_id ORDER BY 2 DESC LIMIT 10");

		$newUsers = DB::select("SELECT us.*,DATE(created_at) as created_date FROM `tb_cashback_users` us  ORDER BY 1 DESC LIMIT 5");
		$topUsers = DB::select("SELECT us.*,
		(SELECT COUNT(*) FROM `tb_clicks` WHERE user_id = us.member_id) as clicks,
		(SELECT SUM(cashback_amount) FROM `tb_user_transaction` WHERE status NOT IN ('cancelled','cancel','declined') AND user_id = us.member_id) as cbamt,
		(SELECT COUNT(*) FROM `tb_user_referrals` WHERE status NOT IN ('cancelled','cancel','declined') AND user_id = us.member_id) as referrals
		FROM `tb_cashback_users` us ORDER BY cbamt DESC LIMIT 5");


		$counts = array();
		foreach($count_res as $cnt)
		$counts[$cnt->object_type] = $cnt->object_count;

		$blocks =array();

		$blocks_res = DB::select("SELECT COUNT(*) object_count,'tickets' as object_type FROM `tb_tickets`   WHERE status <> 'close'
			UNION
			SELECT COUNT(*) ccount,'claims' FROM `tb_missing_cashback` WHERE tick_status <> 'close'
			UNION
			SELECT COUNT(*) ccount,'withdrawl'  FROM `tb_user_withdrawals` WHERE status NOT IN ('paid','calcelled','rejected')");

		foreach($blocks_res as $blk)
		$blocks[$blk->object_type] = $blk->object_count;

		$weekRep = array();

		$weekRepRes = DB::select("SELECT COUNT(*) object_count,'user' object_type FROM `tb_cashback_users` WHERE DATE(join_date) BETWEEN DATE_SUB( CURRENT_DATE() , INTERVAL 14 DAY) AND  DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)
		UNION
		SELECT IFNULL(SUM(comission),0) tsales,'sale' FROM `tb_network_transactions` WHERE DATE(transaction_time) BETWEEN DATE_SUB(CURRENT_DATE(), INTERVAL 14 DAY) AND DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)");
		foreach($weekRepRes as $weekRepR)
		$weekRep[$weekRepR->object_type] = $weekRepR->object_count;


		$monthRep = array();

		$monthRepRes = DB::select("SELECT COUNT(*) object_count,'user' object_type FROM `tb_cashback_users` WHERE DATE(join_date) BETWEEN DATE_SUB( CURRENT_DATE() , INTERVAL 30 DAY) AND  CURRENT_DATE()
		UNION
		SELECT IFNULL(SUM(comission),0) tsales,'sale' FROM `tb_network_transactions` WHERE DATE(transaction_time) BETWEEN DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY) AND CURRENT_DATE()");
		foreach($monthRepRes as $monthRepR)
		$monthRep[$monthRepR->object_type] = $monthRepR->object_count;

		$repUsers = array();
		$repUsersA = DB::select("SELECT COUNT(*) ucount,DATE(join_date) join_date FROM `tb_cashback_users` WHERE DATE(join_date) BETWEEN DATE_SUB( CURRENT_DATE() , INTERVAL 7 DAY) AND CURRENT_DATE()   GROUP BY DATE(join_date)");
		foreach($repUsersA as $ura)
		$repUsers[ str_replace('-','',$ura->join_date) ] = $ura->ucount;

		$repSales = array();
		$repSalesA = DB::select("SELECT SUM(comission) tsales, DATE(transaction_time) trdate FROM `tb_network_transactions` WHERE DATE(transaction_time) BETWEEN DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY) AND CURRENT_DATE() GROUP BY DATE(transaction_time)");
		foreach($repSalesA as $usa)
		$repSales[ str_replace('-','',$usa->trdate) ] = $usa->tsales;

		$comments = array();
		$comments =  DB::table('comments')->where('status',"pending")->orderBy('created_at','desc')->limit(5)->get();


		$this->data['amounts']					= $amounts;
		$this->data['counts']					= $counts;
		$this->data['topStores']				= $topStores;
		$this->data['topCoupons']				= $topCoupons;
		$this->data['topDeals']					= $topDeals;
		$this->data['newUsers']					= $newUsers;
		$this->data['topUsers']					= $topUsers;
		$this->data['comments']					= $comments;
		$this->data['blocks']					= $blocks;
		$this->data['weekRep']					= $weekRep;
		$this->data['monthRep']					= $monthRep;
		$this->data['repUsers']					= $repUsers;
		$this->data['repSales']					= $repSales;

		return view('dashboard.index',$this->data);
	}
	
	function index()
	{
		return view('dashboard.index',$this->data);
	}
	
	function generateEmailTemplates()
	{
		
		$base = base_path().'/public/etemplate/';
		
		$EmailHead = base_path()."/resources/views/EmailHead.blade.php";
		$EmailFoot = base_path()."/resources/views/EmailFoot.blade.php";
		
		$index_html = '<h1>Email Templates</h1><br>';
			
			$EmailHeadHtml = file_get_contents($EmailHead);
			$EmailFootHtml =  file_get_contents($EmailFoot);
			
			
		$res  = DB::table('tb_email_templates')->get();
		foreach($res as $template)
		{
			$info = $EmailHeadHtml.$template->body.$EmailFootHtml;
			$index_html .= '<a href="'.url('/etemplate/'.$template->email_key.'.html').'">'.$template->purpose.'</a><br>';
			$fp=fopen( $base.$template->email_key.'.html' ,"w+"); 
			fwrite($fp,$info); 
			fclose($fp);
			
			
		}
		
			$fp=fopen( $base.'index.html' ,"w+"); 
			fwrite($fp,$index_html); 
			fclose($fp);
		
			return redirect('/etemplate/');
		
	}


}
