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
use App\Models\Settings;
use App\Models\Tags;
use App\Helpers\MobileDetect;
use Auth;


class TagController extends Controller {

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

				$data['tag']      				 = Tags::wheretag_slug($slug)->first();
				if(!$data['tag']) {
					return redirect('404');
				}
				$tagID                     = $data['tag']->tag_id;
				DB::table('tb_tags')->where('tag_id', $tagID)->increment('clicks');

				DB::statement('SET GLOBAL group_concat_max_len = 1000000');
			 $storeList 						 	 = $this->RemoveFilterComma($data['tag']->store_list);
			$data['topStores']    		 = DB::table('tb_stores')->whereIn('store_id',explode(',',$storeList))->get();
			$data['h2']								 = str_ireplace('#TITLE',$data['tag']->tag_name,config('settingConfig.tag_h2'));
			$data['coupon_follow_data']     = DB::table('tb_user_follows')->select('object_id')
																				->whereuser_id(Auth::guard('member')->id())
																				->whereobject_type('coupon')
																				->get();
			if(strip_tags($data['tag']->h2_tag)  != '') {
				$data['h2']								 = str_ireplace('#TITLE',$data['tag']->tag_name,$data['tag']->h2_tag);
			}

			$data['stbrtg']       	   = DB::select("SELECT get_unique_items(GROUP_CONCAT(store_id) ) as store ,get_unique_items(GROUP_CONCAT(categories)) as cats,get_unique_items(GROUP_CONCAT(brands)) as brand FROM `tb_coupons` cpn  WHERE FIND_IN_SET('{$tagID}',tags) AND coupon_status = 'published' AND expiry_date >= CURRENT_TIME");

			$storeiDs 								 = $this->RemoveFilterComma($data['stbrtg'][0]->store);
			$brandIDs 						 		 = $this->RemoveFilterComma($data['stbrtg'][0]->brand);
			$catIDs 							 		 = $this->RemoveFilterComma($data['stbrtg'][0]->cats);
		
			$data['getfStores']    	   = DB::table('tb_stores')->whereIn('store_id',explode(',',$storeiDs))->get();
			$data['getfCats']      	 	 = DB::table('tb_categories')->whereIn('cat_id',explode(',',$catIDs))->get();
			$data['getfBrand']      	 = DB::table('tb_brands')->whereIn('brand_id',explode(',',$brandIDs))->get();
			$data['getfTag']           = array();
			$data['storepage'] 				 = false;
			$data['cat_page']       	 = false;
			$data['tag_page']        	 = true;
			$data['activeStore'] 		   = true;
			$data['activeCats'] 		   = false;
			$data['activeTag']		 	   = false;
			$data['activeBrand'] 		   = false;
			$data['type']            	 = 'all';
			$data['returnArray']['coupons'] = array();
			$query                   	 = '';
			$is_filter							   = false;
			$perPage 								   = (int) config('settingConfig.list_tag_cpn_count');
			$h2Data = [$data['tag']->tag_name,$data['tag']->h2_tag,'tag','h2'];


			$query .= "select `tb_categories`.`cat_name`, `tb_categories`.`cat_icon`, `tb_stores`.`store_name`, `tb_stores`.`store_logo`,
			 `tb_stores`.`cashback_type`,`tb_stores`.`cashback_enabled`, `tb_stores`.`cashback` as `storeCashback`,
			`tb_stores`.`direct_store_link`, `tb_coupons`.* from `tb_coupons` inner join `tb_categories` on
			`tb_categories`.`cat_id` =  `tb_coupons`.`categories`  inner join `tb_stores` on `tb_stores`.`store_id` = `tb_coupons`.`store_id`
			 where `tb_coupons`.`coupon_status` = 'published'  and FIND_IN_SET('{$tagID}',tb_coupons.tags) AND expiry_date >= CURRENT_TIME   ";

			 $total = DB::select($query);

			 $query.=" LIMIT 0,$perPage ";
			 $getData  = DB::select($query);

			 $getRecord = $this->doPaginateOnly($getData,$perPage,count($total));

			$data['returnArray']  = [
																 'coupons' 			=> $getRecord['data'],
																 'totalRecords'	=> $total ,
																 'filter'       => $is_filter,
														 ];

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

	 				 if($request->catFilter != '' ) {
	 					 $filterComma = $this->RemoveFilterComma($request->catFilter);
	 					 $getTags     = DB::table('tb_categories')->whereIn('cat_id',explode(',',$filterComma))->get();
	 					 foreach ($getTags as $key => $value) {
	 						 array_push($pushFArray,['name' => $value->cat_name,'id' => $value->cat_id,'type' => 'cat']);
	 					 }
	 					 $is_filter = true;
	 				 }

					 if($request->brandFilter != '' ) {
						 $filterComma = $this->RemoveFilterComma($request->brandFilter);
						 $getBrand     = DB::table('tb_brands')->whereIn('brand_id',explode(',',$filterComma))->get();
						 foreach ($getBrand as $key => $value) {
							 array_push($pushFArray,['name' => $value->brand_name,'id' => $value->brand_id,'type' => 'brand']);
						 }
						 $is_filter = true;

					 }


					$query  = '';
					$set_or = false;
					$query .= "select `tb_categories`.`cat_name`, `tb_categories`.`cat_icon`, `tb_stores`.`store_name`, `tb_stores`.`store_logo`,
					 `tb_stores`.`cashback_type`,`tb_stores`.`cashback_enabled`, `tb_stores`.`cashback` as `storeCashback`,
					`tb_stores`.`direct_store_link`, `tb_coupons`.* from `tb_coupons` inner join `tb_categories` on
					`tb_categories`.`cat_id` =  `tb_coupons`.`categories`  inner join `tb_stores` on `tb_stores`.`store_id` = `tb_coupons`.`store_id`
					 where `tb_coupons`.`coupon_status` = 'published'  and FIND_IN_SET('{$tagID}',tb_coupons.tags) AND expiry_date >= CURRENT_TIME   ";

						 $data['type']            = $request->coupon_type;

						 if($request->coupon_type == 'coupons') {
							 $query .= "and tb_coupons.coupon_type = 'coupon' ";
						 }

						 if($request->coupon_type != 'coupons') {
							 $query .= "and tb_coupons.coupon_type = 'discount' ";
						 }

					 if($request->catFilter !='' || $request->storeFilter != '' || $request->brandFilter != '') {
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


		 				 if($request->brandFilter != '') {
		 						if($set_or) $query .= ' AND ';
		 						$filterbfIds =rtrim(str_replace(",,",",",$request->brandFilter),',');
		 						$explodBfIds = explode(',',$filterbfIds);
		 						$query .=  '  (';
		 						 for($bf=0; $bf<Count($explodBfIds); $bf++) {
		 							 if($bf!=0)
		 								 $query .= ' OR ';
		 								 $query .= " FIND_IN_SET($explodBfIds[$bf],tb_coupons.brands) ";
		 						}
		 						 $query .= ') ';
		 				 }
					 $query .= ') ';
				 }

				  $total = DB::select($query);
					$requested_page = $request->page;

					$limit_start = $perPage*($requested_page-1) ; $limit_end = $perPage*$requested_page;

					$query.= " LIMIT $limit_start , $limit_end ";
					$getData  = DB::select($query);
					$getRecord = $this->doPaginateOnly($getData,$perPage,count($total));

				 $data['returnArray']  = [
																			 'coupons' 			=> $getRecord['data'],
																			 'totalRecords' => $total ,
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


 				return view('public.tag.index',compact('data'));

			}


}
