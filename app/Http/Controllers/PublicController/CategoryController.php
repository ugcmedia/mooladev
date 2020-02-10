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


class CategoryController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index(Request $request,AppClass $appclass,$slug)
	{

				$data['cat']      				 = Vendorcategories::wherecat_slug($slug)->first();
				if(!$data['cat']) {
					return redirect('404');
				}
				// $data['dealTab']              = false;
				// if(isset($_GET['deals'])) {
				// 	$data['dealTab']            = true;
				// }

				$catID                     = $data['cat']->cat_id;
				//DB::table('tb_vendor_categories')->where('cat_id', $catID)->increment('clicks');
				//$storeList 						 		 = $this->RemoveFilterComma($data['cat']->store_list);

			// 	$data['vendors']    		 = DB::table('tb_vendors')->get();

				$data['category']					=DB::table('tb_vendor_categories')->get();

				$data['featured_stores'] = DB::table('tb_vendors')
																	->where('vendor_featured','Y')
																	->orderBy('clicks','desc')
																  ->limit(5)
																	//->limit(config('settingConfig.hp_featured_stores_count'))
																	->get();

				// 		$storeList 						 		 = $this->RemoveFilterComma($data['cat']->store_list);
				 		//$data['vendors']   		 = DB::table('tb_vendors')->whereIn('vendor_id',explode(',',$storeList))->get();


				//$is_filter=false;
				// $data['coupon_follow_data']     = DB::table('tb_user_follows')->select('object_id')
				// 																	->whereuser_id(Auth::guard('member')->id())
				// 																	->whereobject_type('coupon')
				// 																	->get();


				$data['h2']								 = str_ireplace('#TITLE',$data['cat']->cat_name,config('settingConfig.cat_h2'));
				if(strip_tags($data['cat']->h2_tag)  != '')
				{
					$data['h2']								 = str_ireplace('#TITLE',$data['cat']->cat_name,$data['cat']->h2_tag);
				}

			 	 // 	DB::statement('SET GLOBAL group_concat_max_len = 1000000');
				 //
				 // $data['stbrtg']       	   = DB::select("SELECT get_unique_items(GROUP_CONCAT(cat_id) ) as store ,get_unique_items(GROUP_CONCAT(categories)),get_unique_items(GROUP_CONCAT(tags)) as tag,get_unique_items(GROUP_CONCAT(brands)) as brand FROM `tb_coupons` cpn  WHERE FIND_IN_SET('{$catID}',categories) AND coupon_status = 'published' AND expiry_date >= CURRENT_TIME");
				 //
				 // $storeiDs 								 = $this->RemoveFilterComma($data['stbrtg'][0]->store);
				 // $brandIDs 						 		 = $this->RemoveFilterComma($data['stbrtg'][0]->brand);
				 // $tagIDs 							 		 = $this->RemoveFilterComma($data['stbrtg'][0]->tag);
				 // $data['dealCats']         = DB::select("SELECT get_unique_items(GROUP_CONCAT(categories)) as cat FROM `tb_deals` cpn WHERE expiry >= CURRENT_TIME AND   FIND_IN_SET('{$catID}',categories)");
				 // $dealCatsIds = $this->RemoveFilterComma($data['dealCats'][0]->cat);
				 //


				 // $data['getfCats'] = array(); // There is not Category filter for store page so as defined as 0
				 // $data['getfStores']    	 = DB::table('tb_vendors')->whereIn('store_id',explode(',',$storeiDs))->get();
				 // $data['getfTag']      	 	 = DB::table('tb_tags')->whereIn('tag_id',explode(',',$tagIDs))->get();
				 // $data['getfBrand']      	 = DB::table('tb_brands')->whereIn('brand_id',explode(',',$brandIDs))->get();
				 // $data['getfDealCats']   	 = DB::table('tb_vendor_categories')->whereIn('cat_id',explode(',',$dealCatsIds))->get();
				 $data['storepage'] 			 = false;
				 // $data['cat_page']     	   = true;
				 // $data['type']             = 'all';
         //


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

				 //$query  = "select `tb_vendor_categories`.`cat_name`, `tb_vendor_categories`.`cat_icon`, `tb_vendors`.`vendor_name`, `tb_vendors`.`vendor_logo`,`tb_vendors`.`vendor_slug`,`tb_vendors`.`outlet_primary_image`,`tb_vendors`.`vendor_desc`, `tb_vendors`.`cashback_type`,`tb_vendors`.`cashback_enabled`,`tb_vendors`.`vendor_cashback` as `vendor_cashback` from `tb_vendors` inner join `tb_vendor_categories` on `tb_vendor_categories`.`cat_id` = `tb_vendors`.`vendor_categories` ";

					// $query .= "select `tb_vendor_categories`.`cat_name`, `tb_vendor_categories`.`cat_icon`, `tb_vendors`.`vendor_name`, `tb_vendors`.`vendor_logo`,`tb_vendors`.`vendor_slug`,`tb_vendors`.`outlet_primary_image`,`tb_vendors`.`vendor_desc`,
					//  `tb_vendors`.`cashback_type`,`tb_vendors`.`cashback_enabled`,`tb_vendors`.`vendor_cashback` as `vendor_Cashback`
					//
					// from `tb_vendors` inner join `tb_vendor_categories` on
					// `tb_vendor_categories`.`cat_id` =  `tb_vendors`.`vendor_categories` ";

					 // where  `tb_vendors`.`vendor_status` = 'published'  and FIND_IN_SET('{$catID}',tb_vendors.vendor_categories)     and `tb_vendors`.`vendor_status` = 'published'  ";





			   $total = DB::select($query);

			    $query.= " 	ORDER BY ".config('settingConfig.sort_category_page')." LIMIT 0,$perPage ";
				 // 	  $query.= " 	ORDER BY ".config('settingConfig.sort_category_page')." LIMIT 0,3";
 				 $getData  = DB::select($query);
//dd($getData);


				 $getRecord = $this->doPaginateOnly($getData,$perPage,count($total));


				 $data['returnArray']  = [
																		'coupons' 			=> $getRecord['data'],
																		'totalRecords' 	=> $total ,
																		'filter'        => $is_filter,
																	];

          $h2Data = [$data['cat']->cat_name,$data['cat']->h2_tag,'cat','h2'];




					if ($request->ajax())
					 {
						 	$pushFArray = [];
						if($request->catFilter != '' )
						{

								$catID = $this->RemoveFilterComma($request->catFilter);

								// $getStores     = DB::table('tb_vendors')->whereIn('vendor_categories',explode(',',$catID))->get();
								//
								// foreach ($getStores as $key => $value)
								// 	{
								// 			array_push($pushFArray,['name' => $value->vendor_name,'id' => $value->vendor_id]);
								// 	}
								//
								// 	$is_filter = true;


									$getStores     = DB::table('tb_vendor_categories')->whereIn('cat_id',explode(',',$catID))->get();
// print_r($getStores);
// die();
													foreach ($getStores as $key => $value)
																	{
																			array_push($pushFArray,['name' => $value->cat_name,'id' => $value->cat_id]);
																	}

	// print_r($pushFArray	);
	// die();

																	$is_filter = true;






						 }

						 // if($request->tagFilter != '' ) {
							//  $filterComma = $this->RemoveFilterComma($request->tagFilter);
							//  $getTags     = DB::table('tb_tags')->whereIn('tag_id',explode(',',$filterComma))->get();
							//  foreach ($getTags as $key => $value) {
							// 	 array_push($pushFArray,['name' => $value->tag_name,'id' => $value->tag_id,'type' => 'tag']);
							//  }
							//  $is_filter = true;
						 //
						 // }

						 // if($request->brandFilter != '' ) {
							//  $filterComma = $this->RemoveFilterComma($request->brandFilter);
							//  $getBrand     = DB::table('tb_brands')->whereIn('brand_id',explode(',',$filterComma))->get();
							//  foreach ($getBrand as $key => $value) {
							// 	 array_push($pushFArray,['name' => $value->brand_name,'id' => $value->brand_id,'type' => 'brand']);
							//  }
							//  $is_filter = true;
						 //
						 // }


						$set_or = false;



	$query  = "";


	$query  = "select `tb_vendor_categories`.`cat_name`, `tb_vendor_categories`.`cat_icon`, `tb_vendors`.`vendor_name`, `tb_vendors`.`vendor_logo`,`tb_vendors`.`vendor_slug`,`tb_vendors`.`outlet_primary_image`,`tb_vendors`.`outlet_name`,`tb_vendors`.`vendor_desc`, `tb_vendors`.`cashback_type`, `tb_vendors`.`outlet_address`,`tb_vendors`.`cashback_enabled`,`tb_vendors`.`vendor_cashback` as `vendor_cashback` from `tb_vendors` inner join `tb_vendor_categories` on `tb_vendor_categories`.`cat_id` = `tb_vendors`.`vendor_categories` where tb_vendors.vendor_categories IN ({$catID})";



			// 			$query .= "select `tb_vendor_categories`.`cat_name`, `tb_vendor_categories`.`cat_icon`, `tb_vendors`.`store_name`, `tb_vendors`.`store_logo`,`tb_vendors`.`vendor_slug`,`tb_vendors`.`outlet_primary_image`,`tb_vendors`.`vendor_desc`,
			// 			 `tb_vendors`.`cashback_type`,`tb_vendors`.`cashback_enabled`,`tb_vendors`.`cashback` as `vendor_cashback`
			//
			// 			 from `tb_vendors`  inner join `tb_vendor_categories` on
			// 			`tb_vendor_categories`.`cat_id` =  `tb_vendors`.`vendor_categories`
			//
			// where  `tb_vendors`.`vendor_status = 'published' and 'tb_vendors'.vendor_categories IN ({$catID})   AND expiry_date > CURRENT_TIME  and `tb_vendors`.`vendor_status = 'published'  ";

		//	echo $query;
			//die();


							 // $data['type']            = $request->coupon_type;
							 //
							 // if($request->coupon_type == 'coupons') {
								//  $query .= "and tb_coupons.coupon_type = 'coupon' ";
							 // }




							//  if($request->coupon_type != 'coupons') {
							// 	 $query .= "and tb_coupons.coupon_type = 'discount' ";
							//  }
						 // if($request->storeFilter !='' || $request->tagFilter != '' || $request->brandFilter != '') {
						 // $query .= ' AND (';
							//  if($request->storeFilter != '') {
							// 		$filtersfIds =rtrim(str_replace(",,",",",$request->storeFilter),',');
							// 		$explodeSfIds = explode(',',$filtersfIds);
							// 		$query .=  '  (';
							// 		 for($sf=0; $sf<Count($explodeSfIds); $sf++) {
							// 			 if($sf!=0)
							// 				 $query .= ' OR ';
						 //
							// 			 $query .= "tb_coupons.store_id = ". $explodeSfIds[$sf];
							// 		}
							// 		 $query .= ') ';
							// 		 $set_or = true;
							//  }





						// 	 if($request->tagFilter != '') {
						// 		 if($set_or) $query .= ' AND ';
						// 			$filtertfIds =rtrim(str_replace(",,",",",$request->tagFilter),',');
						// 			$explodTSfIds = explode(',',$filtertfIds);
						// 			$query .=  '  (';
						// 			 for($tf=0; $tf<Count($explodTSfIds); $tf++) {
						// 				 if($tf!=0)
						// 					 $query .= ' OR ';
						// 					 $query .= " FIND_IN_SET($explodTSfIds[$tf],tb_coupons.tags) ";
						// 			}
						// 			 $query .= ') ';
					 //
						// 			 $set_or = true;
						// 	 }



						// 	 if($request->brandFilter != '') {
						// 			if($set_or) $query .= ' AND ';
						// 			$filterbfIds =rtrim(str_replace(",,",",",$request->brandFilter),',');
						// 			$explodBfIds = explode(',',$filterbfIds);
						// 			$query .=  '  (';
						// 			 for($bf=0; $bf<Count($explodBfIds); $bf++) {
						// 				 if($bf!=0)
						// 					 $query .= ' OR ';
						// 					 $query .= " FIND_IN_SET($explodBfIds[$bf],tb_coupons.brands) ";
						// 			}
						// 			 $query .= ') ';
						// 	 }
						//  $query .= ') ';
					 // }



					 // if($request->userFilter=='new')
				 		// 	$query .= " AND user_type <> '{$request->userFilter}' ";

//dd($query);

//dd($pushFArray);


					 	$total = DB::select($query);

						$requested_page = $request->page;



											$limit_start = $perPage*($requested_page-1) ;
											$limit_end = $perPage*$requested_page;

											$query.= " 	ORDER BY ".config('settingConfig.sort_category_page')." LIMIT $limit_start , $limit_end ";
										//		$query.= " 	ORDER BY ".config('settingConfig.sort_category_page')." LIMIT 0,3";

											$getData  = DB::select($query);
										  $getRecord = $this->doPaginateOnly($getData,$perPage,count($total));


											// $filterName  = "select DISTINCT `tb_vendor_categories`.`cat_name` from `tb_vendors` inner join `tb_vendor_categories` on `tb_vendor_categories`.`cat_id` = `tb_vendors`.`vendor_categories` where tb_vendors.vendor_categories IN ({$catID})";
											// 	$filterName_value = DB::select($filterName);
											//
											//  															 $data['returnArray']  = [
											// 																																	 'coupons' 			=> $getRecord['data'],
											// 																																		'totalRecords' => $getRecord['data']['totalRecord'] ,
											// 																																		 'filtered'     => $pushFArray,
											// 																																		 'filterName'=>	$filterName_value,
											// 																																			'filter'       => $is_filter
											// 																																		 ];


																																													 $data['returnArray']  = [
																																										 																	 'coupons' 			=> $getRecord['data'],
																																										 																	 'totalRecords' => $getRecord['data']['totalRecord']  ,
																																										 																	 'filtered'     => $pushFArray,
																																										 																	 'filter'       => $is_filter
																																										 															 ];




														// $data['returnArray']  = [
													 	// 														 'coupons' 			=> $getRecord['data'],
													 	// 														 'totalRecords' => 	$getStores ,
													 	// 														 'filtered'     => $pushFArray,
													 	// 														 'filter'       => $is_filter
													 	// 												 ];
														//





								 					$mobileDetection = new MobileDetect();
												 if($mobileDetection->isMobile())
												 {
													 return view('public.cashback-partials.coupon-tab-content.coupon-tab-mobile',compact('data','h2Data'));
												 }
												 else
												 {
													 return view('public.cashback-partials.coupon-tab-content.coupon-tab',compact('data','h2Data'));
												 }
				 }



 				return view('public.category.index',compact('data'));

			}

			public function CategoryDeal(Request $request) {

				$filter  = false;
				$pushFArray = [];
				$getDeal = "select * from `tb_deals` inner join `tb_vendors` on `tb_vendors`.`store_id` = `tb_deals`.`store_id`  AND expiry > CURRENT_TIME AND FIND_IN_SET('{$request->ID}',categories)";

				if($request->cat_filter !='' && $request->cat_filter !=null ) {
					$filterComma = $this->RemoveFilterComma($request->cat_filter);
					$getTags     = DB::table('tb_vendor_categories')->whereIn('cat_id',explode(',',$filterComma))->get();
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

				$getDeal = $getDeal." order by  ".config('settingConfig.sort_deal_store_page')."";

				$getDeal = DB::select($getDeal);
				return response()->view('public.cashback-partials..deal-partials.hottest_deal_ajax_tab', [
							'dealData' => $getDeal,
							'filtered' => $pushFArray,
							'dodPage'  => false,
							'isCat'			=>true,
							'filter'   => $filter]);
			}
}
