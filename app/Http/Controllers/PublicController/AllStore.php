<?php
namespace App\Http\Controllers\PublicController;

use App\Models\Post;
use App\Library\Markdown;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator ;
use Validator, Input, Redirect ;
use App\Http\Controllers\Controller;
use DB;
use App\Helpers\AppClass;
use App\Models\Settings;
use App\Models\Vendorcategories;
use App\Helpers\MobileDetect;
use Auth;


class AllStore  extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index(Request $request)
		{
      //  $data['vendors']    		 = DB::table('tb_vendors')->get();
	      $data['category']					  =DB::table('tb_vendor_categories')->get();
				$data['locations']					  =DB::table('tb_location_master')->get();
				
				$data['featured_stores'] = DB::table('tb_vendors')
																	->where('vendor_featured','Y')
																	->orderBy('clicks','desc')
																	->limit(5)
																	//->limit(config('settingConfig.hp_featured_stores_count'))
																	->get();


						  $data['storepage'] 			 = false;

						  $data['activeStore'] 			= true;
							$data['activeCats'] 			  = false;
							$data['activeTag']					= false;
							$data['activeBrand'] 		  = false;

		 						$data['pageId']           = 1;
								$data['returnArray']['coupons'] = array();
		 						$is_filter							   = false;
							  $perPage 						 = (int) config('settingConfig.list_cat_cpn_count');

							$query  = '';
							$query="select`vendor_name`,`vendor_logo`,`vendor_slug`,`outlet_primary_image`,`vendor_desc`,`outlet_name`,`outlet_address`,`cashback_type`,`cashback_enabled`,`vendor_cashback` from `tb_vendors`";

					     $total = DB::select($query);

					   // $query.= " 	ORDER BY ".config('settingConfig.sort_category_page')." LIMIT 0,$perPage ";
						  $query.= " 	ORDER BY ".config('settingConfig.sort_category_page')." LIMIT 0,3";
		 				   $getData  = DB::select($query);


						 $getRecord = $this->doPaginateOnly($getData,$perPage,count($total));

						 $data['returnArray']  = [
																				'coupons' 			=> $getRecord['data'],
																				'totalRecords' 	=> $total ,
																				'filter'        => $is_filter,
																			];

						if ($request->ajax())
						{

											$pushFArray = [];
											if($request->catFilter !='' )
											{
													$catID = $this->RemoveFilterComma($request->catFilter);
													$filterComma = $this->RemoveFilterComma($request->catFilter);
													$getTags     = DB::table('tb_vendor_categories')->whereIn('cat_id',explode(',',$filterComma))->get();
													foreach ($getTags as $key => $value) {
														array_push($pushFArray,['name' => $value->cat_name,'id' => $value->cat_id,'type' => 'cat']);
													}

													$is_filter = true;
													$query  = "select `tb_vendor_categories`.`cat_name`, `tb_vendor_categories`.`cat_icon`, `tb_vendors`.`vendor_name`, `tb_vendors`.`vendor_logo`,`tb_vendors`.`vendor_slug`,`tb_vendors`.`outlet_primary_image`,`tb_vendors`.`outlet_name`,`tb_vendors`.`vendor_desc`, `tb_vendors`.`cashback_type`, `tb_vendors`.`outlet_address`,`tb_vendors`.`cashback_enabled`,`tb_vendors`.`vendor_cashback` as `vendor_cashback` from `tb_vendors` inner join `tb_vendor_categories` on `tb_vendor_categories`.`cat_id` = `tb_vendors`.`vendor_categories` where tb_vendors.vendor_categories IN ({$catID})";
													if($request->locationFilter != '') {
														$locationID = $this->RemoveFilterComma($request->locationFilter);
														$getLocations     = DB::table('tb_location_master')->whereIn('location_id',explode(',',$locationID))->get();
														foreach ($getLocations as $key => $value) {
															array_push($pushFArray,['name' => $value->area_name,'id' => $value->location_id,'type' => 'location']);
														}

														$query .= " AND tb_vendors.outlet_location IN ({$locationID})";
													}
											}

											else if($request->locationFilter !='' && !$request->catFilter) {
												$locationID = $this->RemoveFilterComma($request->locationFilter);
												$getLocations     = DB::table('tb_location_master')->whereIn('location_id',explode(',',$locationID))->get();
												foreach ($getLocations as $key => $value) {
													array_push($pushFArray,['name' => $value->area_name,'id' => $value->location_id,'type' => 'location']);
												}
												$is_filter = true;
												$query  = "select  `tb_vendors`.`vendor_name`, `tb_vendors`.`vendor_logo`,`tb_vendors`.`vendor_slug`,`tb_vendors`.`outlet_primary_image`,`tb_vendors`.`outlet_name`,`tb_vendors`.`vendor_desc`, `tb_vendors`.`cashback_type`, `tb_vendors`.`outlet_address`,`tb_vendors`.`cashback_enabled`,`tb_vendors`.`vendor_cashback` as `vendor_cashback` from `tb_vendors` where tb_vendors.outlet_location IN ({$locationID})";
											}
											else {
												$query="select`vendor_name`,`vendor_logo`,`vendor_slug`,`outlet_primary_image`,`vendor_desc`,`outlet_name`,`outlet_address`,`cashback_type`,`cashback_enabled`,`vendor_cashback` from `tb_vendors`";
											}

											$total = DB::select($query);

											$requested_page = $request->page;
											$limit_start = $perPage*($requested_page-1) ;
											$limit_end = $perPage*$requested_page;
											$query.= " 	ORDER BY ".config('settingConfig.sort_category_page')." LIMIT $limit_start , $limit_end ";
											$getData  = DB::select($query);
											$getRecord = $this->doPaginateOnly($getData,$perPage,count($total));

											$data['returnArray']  = [
																						   'coupons' 			=> $getRecord['data'],
																							 'totalRecords' => $getRecord['data']['totalRecord'] ,
																							 'filtered'     => $pushFArray,
																							 'filter'       => $is_filter
																						];

															$mobileDetection = new MobileDetect();
									             if($mobileDetection->isMobile())
															 {
																			 return view('public.cashback-partials.coupon-tab-content.coupon-tab-mobile',compact('data'));
																}
																else
																{
																				return view('public.cashback-partials.coupon-tab-content.coupon-tab',compact('data'));
																 }
												}
  								return view('public.allstore.index',compact('data'));
			}


}
