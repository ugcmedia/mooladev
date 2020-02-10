<?php
namespace App\Http\Controllers\PublicController;

use App\Models\Post;
use App\Library\Markdown;
use Illuminate\Http\Request;
use Validator, Input, Redirect ;
use App\Http\Controllers\Controller;
use DB;
use App\Helpers\AppClass;
use App\Models\Settings;
use App\Models\Brands;
use App\Helpers\MobileDetect;

use Auth;


class BrandController extends Controller {

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


			$data['brand']      			 =	Brands::wherebrand_slug($slug)->first();
			if(!$data['brand']) {
				return redirect('404');
			}
			$data['dealTab']              = false;
			if(isset($_GET['deals'])) {
				$data['dealTab']            = true;
			}
			$brandID                   =	$data['brand']->brand_id;

			DB::table('tb_brands')->where('brand_id', $brandID)->increment('clicks');
			$storeList 						 		 = $this->RemoveFilterComma($data['brand']->store_list);
		  $data['topStores']    		 = DB::table('tb_stores')->whereIn('store_id',explode(',',$storeList))->get();
			$data['h2']								 = str_ireplace('#TITLE',$data['brand']->brand_name,config('settingConfig.brand_h2'));
			if(strip_tags($data['brand']->h2_tag)  != '') {
				$data['h2']								 = str_ireplace('#TITLE',$data['brand']->brand_name,$data['brand']->h2_tag);
			}
			$data['coupon_follow_data']     = DB::table('tb_user_follows')->select('object_id')
																				->whereuser_id(Auth::guard('member')->id())
																				->whereobject_type('coupon')
																				->get();
			DB::statement('SET GLOBAL group_concat_max_len = 1000000');

			$data['stbrtg']          = DB::select("SELECT get_unique_items(GROUP_CONCAT(categories)) as cat,get_unique_items(GROUP_CONCAT(store_id)) as stores,get_unique_items(GROUP_CONCAT(tags)) as tag  FROM `tb_coupons` cpn WHERE expiry_date >= CURRENT_TIME AND coupon_status = 'published' AND FIND_IN_SET('{$brandID}',brands)");
			$catiDs 							   = $this->RemoveFilterComma($data['stbrtg'][0]->cat);
			$storeIDs 						 	 = $this->RemoveFilterComma($data['stbrtg'][0]->stores);
			$tagIDs 							   = $this->RemoveFilterComma($data['stbrtg'][0]->tag);

			$data['getfCats']   	   = DB::table('tb_categories')->whereIn('cat_id',explode(',',$catiDs))->get();
			$data['getfTag']     	   = DB::table('tb_tags')->whereIn('tag_id',explode(',',$tagIDs))->get();
      $data['getfStores']    	 = DB::table('tb_stores')->whereIn('store_id',explode(',',$storeIDs))->get();

			$data['storepage'] 			 = false;
			$data['cat_page']        = false;
			$data['brand_page']      = true;
			$data['type']            = 'all';
			$data['getfBrand']       = [];
			$data['activeStore'] 		 = true;
			$data['activeCats'] 		 = false;
			$data['activeTag']		 	 = false;
			$data['activeBrand'] 		 = false;

			$perPage 								 = (int) config('settingConfig.list_brand_cpn_count');

			$data['returnArray']['coupons'] = array();

			$is_filter							 = false;
			$query                   = '';

			$query .= "select `tb_categories`.`cat_name`, `tb_categories`.`cat_icon`, `tb_stores`.`store_name`, `tb_stores`.`store_logo`,
			 `tb_stores`.`cashback_type`,`tb_stores`.`cashback_enabled`, `tb_stores`.`cashback` as `storeCashback`,
			`tb_stores`.`direct_store_link`, `tb_coupons`.* from `tb_coupons` inner join `tb_categories` on
			`tb_categories`.`cat_id` =  `tb_coupons`.`categories`  inner join `tb_stores` on `tb_stores`.`store_id` = `tb_coupons`.`store_id`
			 where `tb_coupons`.`coupon_status` = 'published'  and FIND_IN_SET('{$brandID}',tb_coupons.brands)  AND expiry_date >= CURRENT_TIME   ";

			 $total = DB::select($query);
			 $query.=" LIMIT 0,$perPage ";
			 $getData   = DB::select($query);
			 $getRecord = $this->doPaginateOnly($getData,$perPage,count($total));

			 $data['returnArray']                = [
																						'coupons' 			=> $getRecord['data'],
																						'totalRecords' 	=> $total ,
																						'filter'        => $is_filter,
																				];
			$h2Data = [$data['brand']->brand_name,$data['brand']->h2_tag,'brand','h2'];


				if ($request->ajax()) {

					$pushFArray = [];

					if($request->storeFilter != '' ) {
							$filterComma = $this->RemoveFilterComma($request->storeFilter);
							$getStores   = DB::table('tb_stores')->whereIn('store_id',explode(',',$filterComma))->get();
							foreach ($getStores as $key => $value) {
								array_push($pushFArray,['name' => $value->store_name,'id' => $value->store_id,'type' => 'store']);
							}
							$is_filter = true;
					 }


					 if($request->tagFilter != '' ) {
						 $filterComma = $this->RemoveFilterComma($request->tagFilter);
						 $getTags     = DB::table('tb_tags')->whereIn('tag_id',explode(',',$filterComma))->get();
						 foreach ($getTags as $key => $value) {
							 array_push($pushFArray,['name' => $value->tag_name,'id' => $value->tag_id,'type' => 'tag']);
						 }
						 $is_filter = true;

					 }

					 if($request->catFilter != '' ) {
						 $filterComma = $this->RemoveFilterComma($request->catFilter);
						 $getTags     = DB::table('tb_categories')->whereIn('cat_id',explode(',',$filterComma))->get();
						 foreach ($getTags as $key => $value) {
							 array_push($pushFArray,['name' => $value->cat_name,'id' => $value->cat_id,'type' => 'cat']);
						 }
						 $is_filter = true;
					 }


					$query  = '';
					$set_or = false;
					$query .= "select `tb_categories`.`cat_name`, `tb_categories`.`cat_icon`, `tb_stores`.`store_name`, `tb_stores`.`store_logo`,
					 `tb_stores`.`cashback_type`,`tb_stores`.`cashback_enabled`, `tb_stores`.`cashback` as `storeCashback`,
					`tb_stores`.`direct_store_link`, `tb_coupons`.* from `tb_coupons` inner join `tb_categories` on
					`tb_categories`.`cat_id` =  `tb_coupons`.`categories`  inner join `tb_stores` on `tb_stores`.`store_id` = `tb_coupons`.`store_id`
					 where `tb_coupons`.`coupon_status` = 'published'  and FIND_IN_SET('{$brandID}',tb_coupons.brands)  AND expiry_date >= CURRENT_TIME  ";
						 $data['type']            = $request->coupon_type;

						 if($request->coupon_type == 'coupons') {
							 $query .= "and tb_coupons.coupon_type = 'coupon' ";
						 }

						 if($request->coupon_type != 'coupons') {
							 $query .= "and tb_coupons.coupon_type = 'discount' ";
						 }
	 				 if($request->catFilter !='' || $request->tagFilter != '' || $request->storeFilter != '') {
					 $query .= ' AND (';
						 if($request->storeFilter != '') {
								$filtersfIds =rtrim(str_replace(",,",",",$request->storeFilter),',');
								$explodeSfIds = explode(',',$filtersfIds);
								$query .=  '  (';
								 for($sf=0; $sf<Count($explodeSfIds); $sf++) {
									 if($sf!=0)
										 $query .= ' OR ';

									 $query .= "tb_coupons.store_id = ". $explodeSfIds[$sf];
								}
								 $query .= ') ';
								 $set_or = true;
						 }

						 if($request->tagFilter != '') {
							 if($set_or) $query .= ' AND ';
								$filtertfIds =rtrim(str_replace(",,",",",$request->tagFilter),',');
								$explodTSfIds = explode(',',$filtertfIds);
								$query .=  '  (';
								 for($tf=0; $tf<Count($explodTSfIds); $tf++) {
									 if($tf!=0)
										 $query .= ' OR ';
										 $query .= " FIND_IN_SET($explodTSfIds[$tf],tb_coupons.tags) ";
								}
								 $query .= ') ';

								 $set_or = true;
						 }



						 if($request->catFilter != '') {
							 if($set_or) $query .= ' AND ';
								$filtersfIds =rtrim(str_replace(",,",",",$request->catFilter),',');
								$explodeSfIds = explode(',',$filtersfIds);
								$query .=  '  (';
								 for($tf=0; $tf<Count($explodeSfIds); $tf++) {
									 if($tf!=0)
										 $query .= ' OR ';
										 $query .= " FIND_IN_SET($explodeSfIds[$tf],tb_coupons.categories) ";
								}
								 $query .= ') ';
								$set_or = true;
						 }

	 				 $query .= ') ';
				 }


						$total = DB::select($query);
						$requested_page = $request->page;

						$limit_start = $perPage*($requested_page-1) ; $limit_end = $perPage*$requested_page;

						$query.= " LIMIT $limit_start , $limit_end ";
						$getData   = DB::select($query);
						$getRecord = $this->doPaginateOnly($getData,$perPage,count($total));

						 $data['returnArray']  = [
																					 'coupons' 			=> $getRecord['data'],
																					 'totalRecords' => $total,
																					 'filtered'     => $pushFArray,
																					 'filter'       => $is_filter
																			 ];


							 $mobileDetection = new MobileDetect();
						  if($mobileDetection->isMobile()) {
						 	 return view('public.cashback-partials.coupon-tab-content.coupon-tab-mobile',compact('data','h2Data'));
						  }
						  else {
						 	 return view('public.cashback-partials.coupon-tab-content.coupon-tab',compact('data','h2Data'));
						  }
					}


 			return view('public.brand.index',compact('data'));
	}




}
