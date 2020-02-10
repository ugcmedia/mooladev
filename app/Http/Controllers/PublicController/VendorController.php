<?php
namespace App\Http\Controllers\PublicController;

use App\Models\Post;
use App\Library\Markdown;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator, Input, Redirect ;
use App\Http\Controllers\Controller;
use DB;
use App\Helpers\AppClass;
use App\Helpers\MobileDetect;
use App\Models\Settings;
use App\Models\Vendormaster;
use Auth;
use Session;



class VendorController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index( Request $request,AppClass $appclass,$slug)
	{


			$data['vendor']	=	Vendormaster::wherevendor_slug($slug)->first();
			//dd($data['vendor']->vendor_code);
			if(!$data['vendor']) {
				return redirect('404');
			}
			$vendorCode    		=	$data['vendor']->vendor_code;
			$data['offers']        	= DB::table('tb_offers')
																			->join('tb_vendors','tb_vendors.vendor_code','=','tb_offers.vendor_code')
																			->where('tb_offers.vendor_code', $vendorCode)
																			->orderBy('tb_offers.clicks', 'DESC')
																			->get();

			// $data['dealTab']              = false;
			// if(isset($_GET['deals'])) {
			// 	$data['dealTab']            = true;
			// }


			DB::table('tb_vendors')->where('vendor_code', $vendorCode)->increment('clicks');

			//$data['similar_vendor']     		 = DB::select(DB::raw("SELECT DISTINCT ts.*  FROM `tb_vendor_categories` tc, `tb_vendors` ts  WHERE FIND_IN_SET('{$vendorCode}',vendor_list) AND vendor_code <> '.$vendorCode.' AND FIND_IN_SET (vendor_code,vendor_list) ORDER BY RAND() LIMIT 5"));
			// $data['extra_cashback']					  	   = DB::table('tb_vendor_cashback')
			// 																	->select('tb_vendor_cashback.*','tb_vendors.vendor_name','tb_vendors.vendor_logo')
			// 																  ->join('tb_vendors','tb_vendors.vendor_code','=','tb_vendor_cashback.vendor_code')
			// 																	->where('tb_vendor_cashback.vendor_code',$vendorCode)
			// 																	->where('tb_vendor_cashback.promo_link','!=','')
			// 																	->get();
      //
			// $data['cashbackStru']      		  = DB::table('tb_vendor_cashback')->wherevendor_code($vendorCode)->get();
      //
			// $data['coupon_follow_data']     = DB::table('tb_user_follows')->select('object_id')
			// 																	->whereuser_id(Auth::guard('member')->id())
			// 																	->whereobject_type('coupon')
			// 																	->get();
																				// dd($data['coupon_follow_data']  );
			//DB::statement('SET GLOBAL group_concat_max_len = 1000000');

			// $data['stbrtg']          	 		  = DB::select("SELECT get_unique_items(GROUP_CONCAT(categories)) as cat,get_unique_items(GROUP_CONCAT(brands)) as brand,get_unique_items(GROUP_CONCAT(tags)) as tag  FROM `tb_coupons` cpn WHERE expiry_date >= CURRENT_TIME AND coupon_status = 'published' AND vendor_code = '{$vendorCode}'");
			// $catiDs 							 	   		  = $this->RemoveFilterComma($data['stbrtg'][0]->cat);
			// $brandIDs 						 	 	 		  = $this->RemoveFilterComma($data['stbrtg'][0]->brand);
			// $tagIDs 							   	      = $this->RemoveFilterComma($data['stbrtg'][0]->tag);
     //
			// $data['dealCats']          	 		  = DB::select("SELECT get_unique_items(GROUP_CONCAT(categories)) as cat FROM `tb_deals` cpn WHERE expiry >= CURRENT_TIME AND  vendor_code = '{$vendorCode}'");
			// $dealCatsIds = $this->RemoveFilterComma($data['dealCats'][0]->cat);
     //
			// $data['getfVendors']						  = array(); // There is not vendor filter for vendor page so as defined as 0
			// $data['getfCats']   	   	      = DB::table('tb_categories')->whereIn('cat_id',explode(',',$catiDs))->get();
			// $data['getfDealCats']   	   	  = DB::table('tb_categories')->whereIn('cat_id',explode(',',$dealCatsIds))->get();
			// $data['getfTag']     	          = DB::table('tb_tags')->whereIn('tag_id',explode(',',$tagIDs))->get();
			// $data['getfBrand']              = DB::table('tb_brands')->whereIn('brand_id',explode(',',$brandIDs))->get();
			// $data['vendorpage'] 			        = true;
			// $data['cat_page']               = false;
			// $data['type']              		  = 'all';
			// //define Active class for tab ussing this logic
			// $data['activeVendor'] 						= false;
			// $data['activeCats'] 			  	  = true;
			// $data['activeTag']							= false;
			// $data['activeBrand'] 					  = false;
     //
			// $data['returnArray']['coupons'] = array();
			// $is_filter							 = false;
			// $perPage 								 = (int) config('settingConfig.list_vendor_cpn_count');
     //
			// $query  = '';
			// $query .= "select `tb_vendors`.`vendor_name`, `tb_vendors`.`vendor_logo`,
			// 	`tb_vendors`.`cashback_type`, `tb_vendors`.`cashback` as `vendorCashback`,
			// 	`tb_vendors`.`direct_vendor_link`,`tb_vendors`.`cashback_enabled`, `tb_coupons`.* from `tb_coupons`  inner join `tb_vendors` on `tb_vendors`.`vendor_code` = `tb_coupons`.`vendor_code`  WHERE
			// 	 tb_vendors.vendor_code = '{$vendorCode}' AND expiry_date > CURRENT_TIME  and `tb_coupons`.`coupon_status` = 'published' " ;
     //
			// $total = DB::select($query);
     //
		 // 	$query.= " 	ORDER BY ".config('settingConfig.sort_vendor_page')." LIMIT 0,$perPage";
     //
		 // 	$getData   = DB::select($query);
     //
			// $getRecord = $this->doPaginateOnly($getData,$perPage,count($total));
     //
		 // $data['returnArray']   = [
			// 													'coupons' 			=> $getRecord['data'],
			// 													'totalRecords' 	=> $total,
			// 													'filter'        => $is_filter,
			// 												];
			// $h2Data = [$data['vendor']->vendor_name,$data['vendor']->h2_tag,'vendor','h2'];

 			return view('public.vendor.index',compact('data'));
	}


	public function vendorAjaxFilter($vendorCode,$perPage) {
		$request    = new Request();
	}

	public function rateVendor()
	{
		$vendor_code = $_POST['vendorID'];
		$cur_votes = $_POST['cur_votes'];
		$new_vote = $_POST['new_vote'];
		$cur_count = $_POST['cur_count'];
		$new_rating = round(( ($cur_votes*$cur_count)+$new_vote)/($cur_count+1),1);
		\DB::select("UPDATE `tb_vendors` SET rate_vote =ROUND( ((rate_vote * rate_count) + {$new_vote}  ) / (rate_count + 1),1), rate_count = rate_count + 1  WHERE vendor_code = ".$vendor_code);
		echo $new_rating .' ('. ($cur_count+1).' ';
	}

	public function HottestDeal(Request $request) {
		$filter  = false;
		$pushFArray = [];

		$getDeal = "select * from `tb_deals` inner join `tb_vendors` on `tb_vendors`.`vendor_code` = `tb_deals`.`vendor_code`  AND expiry > CURRENT_TIME AND tb_deals.vendor_code = '{$request->ID}' ";

		if($request->cat_filter !='' && $request->cat_filter !=null ) {
			$filterComma = $this->RemoveFilterComma($request->cat_filter);
			$getTags     = DB::table('tb_categories')->whereIn('cat_id',explode(',',$filterComma))->get();
			foreach ($getTags as $key => $value) {
				array_push($pushFArray,['name' => $value->cat_name,'id' => $value->cat_id,'type' => 'cat']);
			}
			$filter      = true;
			$filterbfIds = rtrim(str_replace(",,",",",$request->cat_filter),',');
			$explodBfIds = explode(',',$filterbfIds);
			$getDeal      .=  'AND (';
			 for($bf=0; $bf<Count($explodBfIds); $bf++) {
				 if($bf!=0)
					 $getDeal .= ' OR ';
					 $getDeal .= " FIND_IN_SET($explodBfIds[$bf],tb_deals.categories) ";
			}
				$getDeal      .= ' )';

		}

		$getDeal = $getDeal." order by  ".config('settingConfig.sort_deal_vendor_page')."";

		$getDeal = DB::select($getDeal);

		return response()->view('public.cashback-partials..deal-partials.hottest_deal_ajax_tab', [
					'dealData' => $getDeal,
					'filtered' => $pushFArray,
					'dodPage'  => false,
					'filter'   => $filter]);
	}




	public function ActivityCashback( Request $request,AppClass $appclass,$slug)
	{

		$data['vendor']	=	Vendormaster::wherevendor_slug($slug)->first();
		//dd($data['vendor']->vendor_code);
		if(!$data['vendor']) {
			return redirect('404');
		}
		$vendorCode    		=	$data['vendor']->vendor_code;
		$data['offers']        	= DB::table('tb_offers')
																		->join('tb_vendors','tb_vendors.vendor_code','=','tb_offers.vendor_code')
																		->where('tb_offers.vendor_code', $vendorCode)
																		->orderBy('tb_offers.clicks', 'DESC')
																		->get();

		DB::table('tb_vendors')->where('vendor_code', $vendorCode)->increment('clicks');

		$data['featured_stores'] = DB::table('tb_vendors')
															->where('vendor_featured','Y')
															->orderBy('clicks','desc')
															//->limit(config('settingConfig.hp_featured_stores_count'))
															->get();



 			return view('public.vendor.activecashback',compact('data'));
	}

	public function savetranslation(Request $req)
	{
//echo(Session::get('memberDetail'));
//die();




//dd(Auth::guard('member'));
//dd(Auth::user());
	//	dd($req);

 //$validator=
 //$this->validate($req,['filedata' => 'mimes:jpeg,bmp,png,gif,svg,pdf']);
//dd($validator);


		// $this->validate($req,['orderid' => 'required', 'string', 'min:10']);
		// $this->validate($req,['receiptdate'=>'required']);
		// $this->validate($req,['transaction_amount'=>'required']);
		// $validator = Validator::make($req->all(), ['filedata' => 'mimes:jpeg,bmp,png,gif,svg,pdf']);
		// $this->validate($req,['msg' => 'required', 'string']);

		if( isset( Session::get('memberDetail')->member_id) )
				$user_id=Session::get('memberDetail')->member_id;
						//echo(Session::get('memberDetail')->member_id);
					//	die();


		$order_id =$req->orderid;
		$order_date=$req->receiptdate;
		$transaction_amount=$req->transaction_amount;
		$order_image=$_FILES["filedata"]["name"];
		$user_comment=$req->msg;
		$vandor_code=$req->Vandor_code;



		$values = array( 'user_id'=>$user_id,
															'vendor_code'=>$vandor_code,
															'transaction_id'=>time()+7,
															'order_id' =>$order_id,
															'order_date' =>$order_date,
															'transaction_amount' =>$transaction_amount,
															'order_image' =>$order_image,
															'user_comment' =>$user_comment
															);

					$imageFileType = strtolower(pathinfo($order_image,PATHINFO_EXTENSION));


					if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif"  && $imageFileType != "pdf")
					{
						$req->session()->put('invalid_image', '<strong>Ohh.... !</strong> ( '.$imageFileType.' ) is not allowed ,Please Select Image File.(like, jpg , png , pdf )');
						return redirect()->back();
					}

				$users=DB::table('tb_user_transaction')->insert(	$values);


							if ($users)
							{
										$req->session()->put('chashback_tra', '<strong>Thank You!</strong>  For for Uploding Your Purchase Receipt We Will Chack Soon and We Will Get Back To You.');
										return redirect()->back();
								//echo "<script> alert(' Thank You For for Uploding Your Purchase Receipt We Will Chack Soon and We Will Get Back To You	.'); </script>";

							}
							else
							{
										$req->session()->put('chashback_tra', '<strong>Sorry!</strong>  For for Uploding Data is invalid <strong>Please Try again</strong>... ');
										return redirect()->back();
								//echo "<script> alert('Tb_user_transaction data Not  save.'); </script>";

							}



	}

}
