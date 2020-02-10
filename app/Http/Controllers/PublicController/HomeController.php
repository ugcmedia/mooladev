<?php
namespace App\Http\Controllers\PublicController;

use App\Models\Post;
use App\Library\Markdown;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator, Input, Redirect ;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Newsletter;
use App\Helpers\AppClass;
use App\Helpers\MobileDetect;
use App\Models\Settings;
use App\Models\Coupons;
use App\Models\Storemaster;
use App\Models\Categories;
use App\Models\Clicks;
use App\Models\Deals;
use Auth;

class HomeController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index( Request $request,AppClass $appclass)
	{

		 $checkDevice  = 	new MobileDetect();
			DB::table('tb_pages')->where('filename','homepage')->increment('views');
											if($checkDevice->isMobile())
											 {
												$device_Is  							=	 'mobile';
												// $data['slider']  					= DB::table('tb_sliders')
												// 														->select('tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback_enabled','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_sliders.*','tb_stores.cashback_enabled')
												// 														->join('tb_stores','tb_stores.store_id','=','tb_sliders.store_id')
												// 														->whereenabled('Y')->orderBy('slider_position','ASC')
												// 														->where('slider_type','mobile')
												// 														->get();
											}
											else {
												$device_Is								=	 'desktop';
												// $data['slider']  					= DB::table('tb_sliders')
												// 														->select('tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback_enabled','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_sliders.*','tb_stores.cashback_enabled')
												// 														->join('tb_stores','tb_stores.store_id','=','tb_sliders.store_id')
												// 														->whereenabled('Y')->orderBy('slider_position','ASC')
												// 														->where('slider_type','main')
												// 														->get();

											}
      //
			// $data['side_slider']  		 = DB::table('tb_sliders')
			// 															->orderBy('slider_position','ASC')
			// 															->where('slider_type','hpside')
			// 															->limit(2)
			// 															->get();
																		//dd(config('settingConfig.hp_custom_brands'));
			// if(config('settingConfig.hp_is_custom_brands') == 'Y') {
			// 	$brandIds 							 = AppClass::filterID(config('settingConfig.hp_custom_brands'));
      //
			// 	$data['topBrands']     	 = DB::table('tb_brands')
			// 														->where('enabled','Y')
			// 														->whereIn('brand_id',$brandIds)
			// 														->orderByRaw( "FIELD(brand_id,".config('settingConfig.hp_custom_brands').")" )
			// 														->limit(config('settingConfig.hp_top_brand_count'))
			// 														->get();
			// }
			// else {
			// 	$data['topBrands']    		 = DB::table('tb_brands')
			// 														->where('enabled','Y')
			// 														->orderBy('clicks','desc')
			// 														->limit(config('settingConfig.hp_top_brand_count'))
			// 														->get();
			// }

			$catIds 							 = AppClass::filterID(config('settingConfig.hp_search_cats'));

			$data['searchCategories'] = DB::table('tb_vendor_categories')
																->whereIn('cat_id',$catIds)
																->orderByRaw( "FIELD(cat_id,".config('settingConfig.hp_search_cats').")" )
																->get();

																//dd($data['searchCategories']);
		//	$data['testinomial']  = DB::table('tb_content_block')->whereblock_type('testi_hiw')->get();
			$data['featured_stores'] = DB::table('tb_vendors')
																->where('vendor_featured','Y')
																->orderBy('clicks','desc')
																//->limit(config('settingConfig.hp_featured_stores_count'))
																->get();

			//dd($data['featured_stores']);


			// $data['top_coupon_popular']  = DB::select(DB::raw("SELECT tb_coupons.*, tb_stores.store_id,tb_stores.store_name,tb_stores.offers_count,tb_stores.store_slug,tb_stores.store_logo,tb_stores.cashback_type,tb_stores.cashback as storeCashback, tb_stores.cashback_enabled FROM
			// 																								tb_coupons INNER JOIN tb_stores ON tb_coupons.store_id = tb_stores.store_id WHERE expiry_date > CURRENT_TIME  AND
			// 																								tb_coupons.coupon_status = 'published'
			// 																								ORDER BY clicks DESC LIMIT ".config('settingConfig.hp_coupon_count').""));
			// $hp_deal_limit = 12;
			// if(!empty(config('settingConfig.hp_deal_count'))) {
			// 	$hp_deal_limit = config('settingConfig.hp_deal_count');
			// }
      //
			// $data['dealsData']        		= DB::table('tb_deals')
			// 																->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
			// 																->limit($hp_deal_limit)
			// 																->orderBy('tb_deals.updated_date', 'DESC')
			// 																->get();
      //

			$hp_offers_limit = 12;
								if(!empty(config('settingConfig.hp_offer_count')))
								{
									$hp_offers_limit = config('settingConfig.hp_offer_count');
								}

			$data['trendingOffers']        	= DB::table('tb_offers')
																			->join('tb_vendors','tb_vendors.vendor_code','=','tb_offers.vendor_code')
																			//->where('offer_expiry', '>', 'NOW()')
																			->limit($hp_offers_limit)
																			->orderBy('tb_offers.clicks', 'DESC')
																			->get();

																			//dd($data['trendingOffers']);

			$data['hp_hiw']     = DB::table('tb_content_block')
													->whereblock_type('hp_hiw')
													->get();

			$data['hp_why_joinus']     = DB::table('tb_content_block')
													->whereblock_type('hp_why_joinus')
													->get();

			$data['hp_stats']     = DB::table('tb_content_block')
													->whereblock_type('hp_stats')
													->get();

			$data['partners'] = DB::table('tb_vendors')
																->where('vendor_featured','Y')
																->orderBy('clicks','desc')
																//->limit(config('settingConfig.hp_featured_stores_count'))
																->get();



      //
			// $data['trending_offers']  = DB::table('tb_status')
			// 														->wherestatus_type('trending_offers')
			// 														->get();

			$data['device']           = $device_Is;
  		return view('public.homepage.index',compact('data'));
	}

	public function getAppDownloadLink(Request $request) {
			$sendSMS = AppClass::sendSMS($request->mobile_no,url('/getApp'));
			if($sendSMS) {
					return response()->json(['statusCode' => 200,'msg' => trans('actionMsg.hp_get_app_link_success_msg')]);
				}
			else {
				return response()->json(['statusCode' => 300,'msg' => trans('actionMsg.hp_get_app_link_error_msg')]);
			}

	}

	public function getCouponComment(Request $request)
	{
			$getComments  = DB::table('tb_coupon_comments')->wherecoupon_id($request->coupon_id)->get();
			$allComments   =  [];
			$replyComments =  [];
				foreach ($getComments as $key => $value) {
					if($value->comment_id ==  0 || $value->comment_id == '')
					{
						array_push($allComments,$value);
					}
					if($value->comment_id != 0 || $value->comment_id != '')
					 {
						array_push($replyComments,$value);
					}
				}
				$tabType = $request->divId;

				return response()->view('public.cashback-partial.comments', ['allComments' => $allComments,'replyComments' => $replyComments,'couponId' => $request->coupon_id,'divid' =>$tabType]);
	}

	public function StoreComment(Request $request) {
			if($request->comment_type == 'newComment') {
				$data = [
						'coupon_id' 	=> $request->coupon_id,
						'user_email'  => $request->email,
						'user_name' 	=> $request->user_name,
						'comment'		  => $request->comment,
						'published'   => 'N'
					];
					$updateCommentCount  = DB::table('tb_coupons')->wherecoupon_id($request->coupon_id)->update(['comment_count' => +1]);
				}
				else {
					$data = [
							'coupon_id' 	=> $request->coupon_id,
							'user_email'  => $request->email,
							'user_name'   => $request->user_name,
							'comment'     => $request->comment,
							'comment_id'  => $request->comment_id,
							'published'   => 'N'
						];
				}

				$storeComment  = DB::table('tb_coupon_comments')->insert($data);
				if($storeComment) {
					return 1;
				}
				else {
					return 0;
				}
	 }


	//mail champ subscribe
	public function subscribeMailChamp(Request $request) {

			$storeToNewsLatter = Newsletter::subscribe($request->email);
			if($storeToNewsLatter) {
				if($storeToNewsLatter['status'] == 'subscribed') {
					return response()->json(['statusCode' => 200,'msg' => trans('actionMsg.hp_subsribe_success_msg')]);
				}
				else {
					return response()->json(['statusCode' => 300,'msg' =>trans('actionMsg.hp_subsribe_error_msg')]);
				}
			}
			else {
				return response()->json(['statusCode' => 500,'msg' => trans('actionMsg.hp_subsribe_info_msg')]);
			}
	}




	 public function getSeachData(Request $request) {
		 			$data               = '';
		 			$data['storeData']  = DB::table('tb_stores')->Where('store_name', 'like', $request->keyword. '%')->where('store_status','publish')->limit(10)->get();
					$data['catData']    = DB::table('tb_categories')->where('cat_name','like',$request->keyword. '%')->limit(10)->get();
					$data['store_catData']    = DB::table('tb_store_categories')->where('store_cat_name','like',$request->keyword. '%')->limit(10)->get();
					$data['tagData']    = DB::table('tb_tags')->where('tag_name','like',$request->keyword. '%')->where('enabled','Y')->limit(10)->get();
					$data['brandData']    = DB::table('tb_brands')->where('brand_name','like',$request->keyword. '%')->where('enabled','Y')->limit(10)->get();
					$data['storeCount'] = Count($data['storeData']);
					$data['catCount']   = Count($data['catData']);
					return response()->view('public.cashback-partials.menu-partials.ajax_search_result',compact('data'));
	 }








	 public function storeContactUs(Request $request) {

		 $return = $this->reCaptcha($request->all());

		 if($return !== false)
		 {
			 if($return['success'] !='true')
			 {
				 return redirect()->back()->with('error',trans('actionMsg.invalid_captcha'));
			 }
		 }

		 $validator = Validator::make($request->all(),[
						 'name'          => 'required|max:255',
						 'email'         => 'required',
						 'reason'         => 'required',
						 'msg'           => 'required|min:10',
 				 ]
				 );
		 if($validator->fails()) {
			 return redirect()->back()->withErrors($validator)->with('error')->withInput();
		 }
		 	$insertContactUs = DB::table('tb_contacts')->insert(['name' => $request->name,'email' => $request->email,'message' =>$request->msg, 'reason' =>$request->reason, 'sub_reason' =>$request->sub_reason]);
			if($insertContactUs) {

				$searchArr          = ['#NAME','#REASON','#MESSAGE'];
				$repArr             = [$request->name,$request->reason,$request->msg];
				$getEmailTemp       = AppClass::getTemplateByKey('contact_query_recd');

				if($getEmailTemp) {
					$subject          = $getEmailTemp->subject;
					$purpose          = $getEmailTemp->purpose;
					$sender_name      = $getEmailTemp->sender_name;
					$sender_email     = $getEmailTemp->sender_email;
					$reply_to         = $getEmailTemp->reply_to;
					$cc_email         = $getEmailTemp->cc_email;
					$body             = $getEmailTemp->body;
					$body             = str_ireplace($searchArr,$repArr,$body);
					$smsBody          = $getEmailTemp->sms_body;
					if($getEmailTemp->sms_enabled == 'Y') {
							AppClass::sendSMSWithName(Session::get('memberDetail')->mobile_number,$smsBody);
					}
					AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$request->email);
				}
				return redirect()->back()->with('success',trans('actionMsg.contactus_submit_success'));
			}
			else {
				return redirect()->back()->with('error',trans('actionMsg.contactus_submit_error'));
			}

	 }



	 public function ajaxStoreDeal(Request $request) {

			 $is_filter  = false;
			 $pushFArray = [];

			 $parameter = [
				 'dealID'   => $request->deal_id,
				 'catFilter' => $request->catFilter,
				 'storeID'   => $request->store_id
			 ];

			 if($request->catFilter != '' ) {
					 $filterComma = $this->RemoveFilterComma($request->catFilter);
					 $getCats     = DB::table('tb_categories')->whereIn('cat_id',explode(',',$filterComma))->get();
					 foreach ($getCats as $key => $value) {
						 array_push($pushFArray,['name' => $value->cat_name,'id' => $value->cat_id,'type' => 'cat']);
					 }
					 $is_filter = true;
			}

			 $data    			= AppClass::getAjaxData($parameter);
			 $totalRecords 	= $data['totalR'];


			 $returnArray    = [
														'dealID' 	  	  => $request->deal_id,
														'filter'        => $is_filter,
														'data'          => $data['record'],
														'filtredRecord' => $pushFArray,
														'total'         => $totalRecords,
														'pagination'    => $data['paginate']
													];

			return response()->view('public.store-deal.ajaxDeal', $returnArray);

	 }

	 public function ajaxPopup($id,$type)
	 {
		 $atag = 0;

		 if($type == 'deal') {
			 $detail = \DB::select('SELECT deal_id,title,ts.store_id,store_name,store_logo FROM `tb_deals` td, `tb_stores` ts  WHERE td.store_id = ts.store_id  AND deal_id = '.$id);
			 if(count($detail) > 0) {
				 $cpdata = $detail[0];

				 $a_id = "deal".$cpdata->deal_id;
				 $a_type = "deal";
				 $a_outlink = url('/out/deal/').'/'.$cpdata->deal_id;
				 $a_title = $cpdata->title;
				 $a_couponType = "discount";

				 //$a_couponCode = "";
				 $a_uniqueID = $cpdata->deal_id;
				 $a_storeId = $cpdata->store_id;
				 $a_storeName = $cpdata->store_name;
				 $a_storelogo = asset('uploads/images/store').'/'.$cpdata->store_logo;

		 		 $atag = '<a href="#" id="'.$a_id.'" onclick="openCashBackPopup(this)" data-toggle="modal"
		 		 						 data-outlink="'.$a_outlink.'" data-type="'.$a_type.'" data-uniqueID="'.$a_uniqueID.'" data-title="'.$a_title.'"
		 								 data-coupontype="'.$a_couponType.'" data-storeid="'.$a_storeId.'" data-storename="'.$a_storeName.'"
		 								 data-cashback="'.$a_cashback.'" data-storelogo="'.$a_storelogo.'" data-target="#cashback-popup">'.$a_title.'</a>';
			 }

		 } else if($type == 'store') {
			 $detail = \DB::select('SELECT store_id,store_name,store_logo, h1_tag, cashback, cashback_type FROM `tb_stores` WHERE store_id = '.$id);
			 if(count($detail) > 0) {
				 $cpdata = $detail[0];
				 $a_id = "store".$cpdata->store_id;
				 $a_type = "store";
				 $a_outlink = url('/out/store/').'/'.$cpdata->store_id;
				 $a_title = AppClass::getH1($cpdata->store_name,$$cpdata->h1_tag,'store');

				 //$a_couponType = $cpdata->coupon_type;
				 //$a_couponCode = "";
				 $a_uniqueID = $cpdata->store_id;
				 $a_storeId = $cpdata->store_id;
				 $a_storeName = $cpdata->store_name;
				 $a_storelogo = asset('uploads/images/store').'/'.$cpdata->store_logo;

				 $cashBackText = '';
				 if($cpdata->cashback != '') {
					 $cashBack = explode('|',$cpdata->cashback);
					 if($cashBack[0] == 'percent') {
						 $cashBackText =  'Earn Upto '.$cashBack[1] .'%'. $cpdata->cashback_type;
					 } else {
							 $cashBackText = 'Earn Upto '. config('sximo.cnf_currencyname').' '.$cashBack[1].' '.$cpdata->cashback_type;
					 }
				 }
				 $a_cashback = $cashBackText;


		 		 $atag = '<a href="#" id="'.$a_id.'" onclick="openCashBackPopup(this)" data-toggle="modal"
		 		 						 data-outlink="'.$a_outlink.'" data-type="'.$a_type.'" data-uniqueID="'.$a_uniqueID.'" data-title="'.$a_title.'"
		 								 data-storeid="'.$a_storeId.'" data-storename="'.$a_storeName.'" data-cashback="'.$a_cashback.'"
		 								 data-storelogo="'.$a_storelogo.'" data-target="#cashback-popup">'.$a_title.'</a>';
			 }

		 } else if($type == 'slider') {
			 $detail = \DB::select('SELECT slider_id,friendly_title as title, link_type,ts.store_id,store_name,store_logo FROM `tb_sliders` sl, `tb_stores` ts WHERE ts.store_id = sl.store_id AND slider_id = '.$id);
			 if(count($detail) > 0) {
				 $cpdata = $detail[0];
				 $a_id = "slider".$cpdata->slider_id;
				 $a_type = "slider";
				 $a_outlink = url('/out/slider/').'/'.$cpdata->slider_id;
				 $a_title = $cpdata->title;

				 $a_uniqueID = $cpdata->slider_id;
				 $a_storeId = $cpdata->store_id;
				 $a_storeName = $cpdata->store_name;
				 $a_storelogo = asset('uploads/images/store').'/'.$cpdata->store_logo;

		 		 $atag = '<a href="#" id="'.$a_id.'" onclick="openCashBackPopup(this)" data-toggle="modal"
		 		 						 data-outlink="'.$a_outlink.'" data-type="'.$a_type.'" data-uniqueID="'.$a_uniqueID.'" data-title="'.$a_title.'"
		 								 data-storeid="'.$a_storeId.'" data-storename="'.$a_storeName.'"
		 								 data-storelogo="'.$a_storelogo.'" data-target="#cashback-popup">'.$a_title.'</a>';
			 }

		 } else if($type == 'storeCat') {

			 $detail = \DB::select('SELECT sc.store_cbid,sc.store_id,cb_title as title, store_name,store_logo FROM `tb_store_cashback` sc , `tb_stores` ts WHERE ts.store_id = sc.store_id AND store_cbid ='.$id);

			 if(count($detail) > 0) {
				 $cpdata = $detail[0];
				 $a_id = "scb".$cpdata->store_cbid;
				 $a_type = "storeCat";
				 $a_outlink = url('/out/store-cat/').'/'.$cpdata->store_cbid;
				 $a_title = $cpdata->title;
				 $a_uniqueID = $cpdata->store_cbid;
				 $a_storeId = $cpdata->store_id;
				 $a_storeName = $cpdata->store_name;
				 $a_storelogo = asset('uploads/images/store').'/'.$cpdata->store_logo;
				 $a_cashback = $cashBackText;

		 		 $atag = '<a href="#" id="'.$a_id.'" onclick="openCashBackPopup(this)" data-toggle="modal"
		 		 						 data-outlink="'.$a_outlink.'" data-type="'.$a_type.'" data-uniqueID="'.$a_uniqueID.'" data-title="'.$a_title.'"
		 								 data-storeid="'.$a_storeId.'" data-storename="'.$a_storeName.'" data-cashback="'.$a_cashback.'"
		 								 data-storelogo="'.$a_storelogo.'" data-target="#cashback-popup">'.$a_title.'</a>';
			 }

		 } else {
			 $detail = \DB::select('SELECT coupon_id,title,coupon_type,coupon_code,store_name, st.store_id,store_logo, cashback_type, st.cashback as storeCashback  FROM `tb_coupons` cpn, `tb_stores` st WHERE cpn.store_id = st.store_id AND coupon_id = '.$id);
			 //print_r($detail);
			 if(count($detail) > 0) {
				 $cpdata = $detail[0];
				 $a_id = "cpn".$cpdata->coupon_id;
				 $a_type = "coupon";
				 $a_outlink = url('/out/coupon/').'/'.$cpdata->coupon_id;
				 $a_title = $cpdata->title;
				 $a_couponType = $cpdata->coupon_type;
				 $a_couponCode = $cpdata->coupon_code;
				 $a_uniqueID = $cpdata->coupon_id;
				 $a_storeId = $cpdata->store_id;
				 $a_storeName = $cpdata->store_name;
				 $a_storelogo = asset('uploads/images/store').'/'.$cpdata->store_logo;
				 $cashBackText = "";
				 if(!empty($cpdata->cashback)) {
					 $cashBackText = 'Earn Upto '.$cpdata->cashback .' '.$cpdata->cashback_type;;
				 } else {
					 if(!empty(AppClass::getOnlyCashbackValue($cpdata->storeCashback))) {
						 $cashBackText     =  'Upto '.AppClass::getOnlyCashbackValue($cpdata->storeCashback) .' '.$cpdata->cashback_type;
					 }
				 }
				 $a_cashback = $cashBackText;

		 		 $atag = '<a href="#" id="'.$a_id.'" onclick="openCashBackPopup(this)" data-toggle="modal"
		 		 						 data-outlink="'.$a_outlink.'" data-type="'.$a_type.'" data-uniqueID="'.$a_uniqueID.'" data-title="'.$a_title.'"
		 								 data-coupontype="'.$a_couponType.'" data-couponcode="'.$a_couponCode.'" data-storeid="'.$a_storeId.'" data-storename="'.$a_storeName.'"
		 								 data-cashback="'.$a_cashback.'" data-storelogo="'.$a_storelogo.'" data-target="#cashback-popup">'.$a_title.'</a>';
			 }
		 }


		 return $atag;
	 }





}
