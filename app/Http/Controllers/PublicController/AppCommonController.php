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

class AppCommonController extends Controller {



  //store subscriber to user follow table
  public function Addsubscriber(Request $request) {
    $checkIfExit  = DB::table('tb_user_follows')->whereobject_type($request->o_type)->whereobject_id($request->id)->whereuser_id(Auth::guard('member')->id())->first();
    if(!empty($checkIfExit))
        return response()->json(['statusCode' => 500,'msg' => trans('actionMsg.subscribe_already_exist')]);
    else
     $insertFollow = 	DB::table('tb_user_follows')->insert(['user_id' => Auth::guard('member')->id(),'object_type' => $request->o_type,'object_id' => $request->id]);

     if($insertFollow){
       return response()->json(['statusCode' => 200,'msg' =>trans('actionMsg.subscribe_successfully') ]);
     }
     else {
       return response()->json(['statusCode' => 300,'msg' => trans('actionMsg.subscribe_error') ]);
     }
  }

  //check user already subscribed or not
  public function subscribeCheck(Request $request) {
     $checkIfExit  = DB::table('tb_user_follows')->whereobject_type($request->o_type)->whereobject_id($request->id)->whereuser_id(Auth::guard('member')->id())->first();
     if(!empty($checkIfExit))
       return response()->json(1);
     else {
       return response()->json(0);
     }
   }


   public function AddCouponsubscriber(Request $request) {

 				 if($request->action=='add') {
 					  $insertFollow = 	DB::table('tb_user_follows')->insert(['user_id' => Auth::guard('member')->id(),'object_type' => $request->o_type,'object_id' => $request->id]);
 						if($insertFollow){
 							return response()->json(['statusCode' => 200,'msg' =>trans('actionMsg.cpn_subscribe_successfully') ]);
 						}
 						else {
 							return response()->json(['statusCode' => 300,'msg' => trans('actionMsg.cpn_subscribe_error') ]);
 						}
 				 }
 				 else {
 						 $insertFollow = 	DB::table('tb_user_follows')->where('object_id',$request->id)->delete();
 						 if($insertFollow) {
 							return response()->json(['statusCode' => 200,'msg' =>trans('actionMsg.unsubscribe_successfully') ]);
 						}
 						else {
 							return response()->json(['statusCode' => 300,'msg' => trans('actionMsg.unsubscribe_error') ]);
 						}
 				 }

 	     }



 	 //cb-ajax popup for coupons
 	 public function CbAjaxPopupCommon(Request $request) {

 		 $data =  [];
     $data['desc']   = '';
 		 switch ($request) {

 			/********************************************************************
 									if type coupon
 			**********************************************************************/
 		 	case ($request->type == 'coupon' || $request->type == 'offer'):
 				$detail = DB::table('tb_coupons')->select('tb_coupons.coupon_id','tb_coupons.title','tb_coupons.description','tb_coupons.coupon_type','tb_coupons.coupon_code','tb_stores.cashback_enabled','tb_stores.store_name', 'tb_stores.store_id','tb_stores.store_logo', 'tb_stores.cashback_type','tb_stores.terms_yes','tb_stores.terms_no','tb_stores.cashback as storeCashback')
 																				 ->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')
 																				 ->where('tb_coupons.coupon_id','=',$request->id)
 																				 ->first();

 				if(count($detail) > 0) {
 								$data['outlink'] = url('/out/coupon/').'/'.$detail->coupon_id;
 								$data['title'] = $detail->title;
 								$data['couponType'] = $detail->coupon_type;
                $data['desc']   = $detail->description;
 								$data['couponCode'] = $detail->coupon_code;
                $data['todo']       = $detail->terms_yes;
                $data['coupon_id']    = $detail->coupon_id;
                $data['tonotdo']       = $detail->terms_no;
 								$data['storeId'] = $detail->store_id;
 								$data['storeName'] = $detail->store_name;
 								$data['storelogo'] = asset('uploads/images/store').'/'.$detail->store_logo;
 								$data['cashback_enabled'] = $detail->cashback_enabled;
								$data['cashBackText'] = "";
 								if(!empty($detail->cashback)) {
 									$data['cashBackText'] = AppClass::getEarnUpto($detail->storeCashback,$detail->cashback_type);
 								} else {
 									if(!empty($detail->storeCashback)) {
 										$data['cashBackText'] = AppClass::getEarnUpto($detail->storeCashback,$detail->cashback_type);
 									}
 								}
 							}
 						$data['pop_type']   =  'coupon';
 		 		break;

 				/********************************************************************
 										if type store
 				**********************************************************************/
 				case $request->type == 'store':
 					$detail = DB::table('tb_stores')->where('store_id',$request->id)->first();

 					if(count($detail) > 0) {
 						$data['id'] = "store".$detail->store_id;
 						$data['type'] = "store";

 						$data['outlink'] = url('/out/store/').'/'.$detail->store_id;
 						$data['title'] 		= AppClass::getHTag($detail->store_name,$detail->h1_tag,'store','h1');
 						$data['storeId']  = $detail->store_id;
 						$data['storeName']  = $detail->store_name;
            $data['todo']       = $detail->terms_yes;
            $data['tonotdo']       = $detail->terms_no;
			$data['cashback_enabled'] = $detail->cashback_enabled;
 						$data['storelogo'] = asset('uploads/images/store').'/'.$detail->store_logo;
 						$data['cashBackText'] = '';
 						if($detail->cashback != '') {
 							$data['cashBackText'] = AppClass::getEarnUpto($detail->cashback,$detail->cashback_type);
 						}
 					}

 					$data['pop_type']  = 'store';
 			 break;
 			 /********************************************************************
 									 if type slider
 			 **********************************************************************/
 			 case $request->type == 'slider':

 				 $detail = DB::table('tb_sliders')->select('tb_sliders.slider_id','tb_sliders.friendly_title as title','tb_sliders.link_type',
 				 																					 'tb_stores.store_id','tb_stores.store_name','tb_stores.terms_yes','tb_stores.terms_no','tb_stores.store_logo','tb_stores.cashback','tb_stores.cashback_type','tb_stores.cashback_enabled')
 																					->join('tb_stores','tb_stores.store_id','=','tb_sliders.store_id')
 																					->where('tb_sliders.slider_id',$request->id)
 																					->first();

 				if(count($detail) > 0) {
 					$data['id'] = "slider".$detail->slider_id;
 					$data['type'] = "slider";
 					$data['outlink'] = url('/out/slider/').'/'.$detail->slider_id;
 					$data['title'] = $detail->title;
          $data['todo']       = $detail->terms_yes;
          $data['tonotdo']       = $detail->terms_no;

 					$data['storeId'] 	 = $detail->store_id;
 					$data['storeName'] = $detail->store_name;
 					$data['storelogo'] = asset('uploads/images/store').'/'.$detail->store_logo;
					$data['cashback_enabled'] = $detail->cashback_enabled;
 					$data['cashBackText'] = '';
 					if($detail->cashback != '') {
 						$data['cashBackText'] = AppClass::getEarnUpto($detail->cashback,$detail->cashback_type);
 					}

 					$data['pop_type']  = 'slider';
 				}

 			 break;
 			 /********************************************************************
 									if type slider
 			**********************************************************************/
 			case $request->type == 'store-cat':
 				$detail = DB::table('tb_store_cashback as sc')->select('sc.cb_rate','sc.cb_type','sc.cb_type','sc.store_cbid','sc.store_id','sc.cb_title as title','tb_stores.store_name','tb_stores.user_split','tb_stores.store_logo','tb_stores.cashback','tb_stores.cashback_type','tb_stores.terms_yes','tb_stores.terms_no','tb_stores.cashback_enabled')
 																				->join('tb_stores','tb_stores.store_id','=','sc.store_id')
 																				->where('sc.store_cbid',$request->id)
 																				->first();

 				if(count($detail) > 0) {

 					$data['id'] = "scb".$detail->store_cbid;
 					$data['type'] = "storeCat";
 					$data['outlink'] 	 = url('/out/store-cat/').'/'.$detail->store_cbid;
 					$data['title'] 		 = $detail->title;
 					$data['uniqueID']  = $detail->store_cbid;
 					$data['storeId']   = $detail->store_id;
          $data['todo']       = $detail->terms_yes;
          $data['tonotdo']       = $detail->terms_no;

 					$data['storeName'] = $detail->store_name;
 					$data['storelogo'] = asset('uploads/images/store').'/'.$detail->store_logo;
					$data['cashback_enabled'] = $detail->cashback_enabled;
 					$data['cashBackText'] = '';
 					if($detail->cashback != '') {
 						$data['cashBackText'] = AppClass::getEarnUpto(round(($detail->cb_rate*$detail->user_split)/100,2),$detail->cashback_type,$detail->cb_type);
 					}
 				}

 					$data['pop_type']  = 'store-cat';

 	 		break;
 			/********************************************************************
 								 if type deal
 		 **********************************************************************/
 		 	case $request->type == 'deal':
 				$detail = DB::table('tb_deals')->select('tb_deals.*','tb_stores.cashback',
 											'tb_stores.store_id','tb_stores.store_name','tb_stores.terms_yes','tb_stores.terms_no','tb_stores.store_logo','tb_stores.cashback_enabled','tb_stores.user_split','tb_stores.cashback_type','tb_stores.cashback_enabled')
 											->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
 											->where('tb_deals.deal_id',$request->id)
 											->first();
 				if(count($detail) > 0) {

 					$data['id']            = $detail->deal_id;
 					$data['outlink']       = url('/out/deal/').'/'.$detail->deal_id;
 					$data['title']         = $detail->title;
 					$data['couponType']    = "discount";
 					$data['storeId']       = $detail->store_id;
          $data['todo']          = $detail->terms_yes;
          $data['tonotdo']       = $detail->terms_no;
          $data['product_image'] = $detail->product_image;
          $data['deal_price']    = $detail->deal_price;
          $data['mrp']           = $detail->mrp;
 					$data['storeName']     = $detail->store_name;

 					$data['storelogo'] = asset('uploads/images/store').'/'.$detail->store_logo;
$data['cashback_enabled'] = $detail->cashback_enabled;
 				 $data['cashBackText']  = "";
 					if($detail->cashback_enabled == 'Y' ) {
 						if($detail->deal_cashback > 0 && $detail->deal_cashback != '')
 							 $data['cashBackText']   = AppClass::getUptoText('flat|'.round( ($detail->deal_cashback*$detail->user_split)/100),ucfirst($detail->cashback_type));
 						else
 							$data['cashBackText']    = AppClass::getUptoText($detail->cashback,ucfirst($detail->cashback_type));
 				}
 				$data['pop_type']  = 'deal';
 			}
 		 	break;
 		 	default:
 		 		// code...
 		 		break;
 		 }
 		 	return response()->view('public.cashback-partials.cb-popup-outpages.cb-common-popup',compact('data'));
 	 }


  //Out pages
  public function Outpage($type,$object_id) {

      $date = new DateTime();

       $data     = [];
       $storeID  = '';
       $url      = '';

       if(Auth::guard('member')->check()) {
         $userID  = Auth::guard('member')->id();
       }
       else {
         $userID  = 0;
       }
       if($type == 'coupon') {
           $data['record']   	 		= DB::table('tb_coupons')->select('tb_coupons.*','tb_stores.store_id','tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback','tb_stores.cashback_enabled','tb_stores.cashback_type as StoreCashback')->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')
                                     ->wherecoupon_id($object_id)
                                     ->where('tb_coupons.expiry_date','>',DB::raw('NOW()'))
                                     ->where('tb_coupons.coupon_status','published')
                                     ->first();
           if(Count($data['record']) > 0) {
             $storeID   						  = $data['record']->store_id;
             $url       							= $data['record']->affiliate_link;
             $parameter 							= [$userID,$date->getTimestamp(),	$data['record']->coupon_id,$storeID];
             DB::table('tb_coupons')->where('coupon_id', $object_id)->increment('clicks');
             DB::table('tb_coupons')->where('coupon_id', $object_id)->increment('daily_clicks');
             DB::table('tb_stores')->where('store_id', $storeID )->increment('clicks');
           }
       }
       if($type == 'deal' ) {
           $data['record'] 		    = DB::table('tb_deals')->select('tb_deals.*','tb_stores.store_id','tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback','tb_stores.cashback_enabled','tb_stores.cashback_type as StoreCashback')->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')->wheredeal_id($object_id)->first();
           if(Count($data['record']) > 0) {
             $storeID  				 			= $data['record']->store_id;
             $url       							= $data['record']->product_link;
             $parameter 							= [];
             //$data['url'] 						=	$this->replaceUrlVar($url,$parameter,'deal');
             DB::table('tb_deals')->where('deal_id', $object_id)->increment('clicks');
             DB::table('tb_stores')->where('store_id', $storeID )->increment('clicks');

           }
       }
       if($type == 'slider') {
         $data['record']					  = DB::table('tb_sliders')->select('tb_sliders.*','tb_stores.store_id','tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback','tb_stores.cashback_enabled','tb_stores.cashback_type as StoreCashback')->join('tb_stores','tb_stores.store_id','=','tb_sliders.store_id')->where('tb_sliders.slider_id',$object_id)->first();

         if(Count($data['record']) > 0 || $data['record'] != null)  {
           $storeID  								=	$data['record']->store_id;
           $url       								= $data['record']->slider_link;
           $parameter 								= [];
           //$data['url'] 							=	$this->replaceUrlVar($url,$parameter,'slider');
           DB::table('tb_sliders')->where('slider_id', $object_id)->increment('clicks');
           DB::table('tb_stores')->where('store_id', $storeID )->increment('clicks');
         }

       }
       if($type == 'store') {
         $data['record']					  = DB::table('tb_stores')->select('tb_stores.store_id','direct_store_link','tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback','tb_stores.cashback_enabled','tb_stores.cashback_type as StoreCashback')->wherestore_id($object_id)->first();

         if(Count($data['record']) > 0 || $data['record'] != null)  {
           $storeID  								=	$object_id;
           $url       								= $data['record']->direct_store_link;
           $parameter 								= [];
           //$data['url'] 							=	$this->replaceUrlVar($url,$parameter,'store');
           DB::table('tb_stores')->where('store_id', $object_id)->increment('clicks');
         }

       }
       if($type == 'store-cat') {
         $data['record'] 				  = DB::table('tb_store_cashback')->select('tb_store_cashback.*','tb_stores.store_id','tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback','tb_stores.cashback_enabled','tb_stores.cashback_type as StoreCashback')->join('tb_stores','tb_stores.store_id','=','tb_store_cashback.store_id')->wherestore_cbid($object_id)->first();
           if(Count($data['record']) > 0) {
             $storeID 								  = $data['record']->store_id;
             $url       								= $data['record']->promo_link;
             $parameter 								= [];
             //$data['url'] 							=	$this->replaceUrlVar($url,$parameter,'store-cat');
             DB::table('tb_stores')->where('store_id', $storeID )->increment('clicks');
           }
       }


       $HTTP_REFERER = '';
       if(isset($_SERVER['HTTP_REFERER']))
         $HTTP_REFERER = $_SERVER['HTTP_REFERER'];

       $insertIntoClick = DB::table('tb_clicks')->insert(['store_id' => $storeID,
                                         'object_type' => $type,
                                         'object_id' => $object_id,
                                         'user_id' => $userID,
                                         'click_time' => date('Y-m-d H:i:s'),
                                         'out_link' => $url,
                                         'ip_address' => $_SERVER['REMOTE_ADDR'],
                                         'referral' => $HTTP_REFERER,
                                         'user_agent' => $_SERVER['HTTP_USER_AGENT']]
                                       );
       $lastId          = DB::getPdo()->lastInsertId();

       $updateClick     = DB::select('UPDATE `tb_clicks` cl,  `tb_network` nt
                                 SET cl.network_id = nt.network_id
                                 WHERE cl.out_link REGEXP nt.tracking_link AND click_id ='.$lastId.' ');

       $updateClick     = DB::select('UPDATE `tb_clicks` cl, `tb_stores` st
                                       SET cl.cashback_enabled = st.cashback_enabled,
                                       cl.user_split = st.user_split,
                                       cl.cashback_type = st.cashback_type
                                       WHERE st.store_id  = cl.store_id AND click_id ='.$lastId.' ');

       $data['url']     = str_ireplace( 'MYCBCLKID',$lastId,$url );

       return view ('public.cashback-partials.cb-popup-outpages.outPage',compact('data'));
  }



  public function replaceUrlVarOld($url = null,$data,$type) {
      if($url  != '') {
        if($type == 'coupon') {
           $url = str_replace("{USERID}",$data[0],$url);
           $url = str_replace("{TIMESTAMP}",$data[1],$url);
           $url = str_replace("{COUPONID}",$data[2],$url);
           $url = str_replace("{STOREID}",$data[3],$url);
        }
        if($type == 'deal') {
           $url = $url;
        }
        if($type == 'slider') {
          $url = $url;
       }
       if($type  == 'store') {
         $url = $url;
       }
       if($type  == 'store-cat') {
         $url = $url;
       }

      }
      return $url;

  }

  public function getSearchPopup() {

    return response()->view('public.cashback-partials.menu-partials.search-pop');
  }


  public function searchResult(Request $request) {

      $data['keyword'] = $request->keyword;

      $data['coupons'] =  DB::table('tb_coupons')
                           ->select('tb_coupons.*','tb_stores.store_name','tb_stores.cashback_enabled','tb_stores.store_slug','tb_stores.store_logo','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_stores.direct_store_link')
                           ->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')->where('title','like','%'.$request->keyword.'%')
                           ->where('tb_coupons.expiry_date','>', DB::raw('NOW()'))
                           ->where('tb_coupons.coupon_status','published')
                           ->paginate( config('settingConfig.list_search_page') );

     $data['stores'] =  DB::table('tb_stores')
                           ->where('store_name','like','%'.$request->keyword.'%')
                           ->where('store_status','publish')
                           ->limit(100)
                           ->get();

   $data['categories'] =  DB::table('tb_categories')
                         ->where('cat_name','like','%'.$request->keyword.'%')
                         ->limit(100)
                           ->get();
   $data['deals'] 			=  DB::table('tb_deals')
                         ->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
                         ->where('title','like','%'.$request->keyword.'%')
                         ->limit(100)
                         ->get();

     if($request->ajax()) {
       $data['coupons'] =  DB::table('tb_coupons')
                            ->select('tb_coupons.*','tb_stores.store_name','tb_stores.cashback_enabled','tb_stores.store_slug','tb_stores.store_logo','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_stores.direct_store_link')
                            ->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')
                            ->where('title','like','%'.$request->keyword.'%')
                            ->where('tb_coupons.expiry_date','>', DB::raw('NOW()'))
                            ->where('tb_coupons.coupon_status','published')
                            ->paginate( config('settingConfig.list_search_page') );

       return response()->view('public.cashback-partial.paginateSearch',compact('data'));
     }

     return view('public.cashback-partials.menu-partials.search-result-page',compact('data'));

  }


}
