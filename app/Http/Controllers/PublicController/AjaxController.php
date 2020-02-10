<?php

namespace App\Http\Controllers\PublicController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Deals;
use DB;

class AjaxController extends Controller
{
        public function __construct()
    {


    }

    public function storeAjaxTab($storeIds) {
      return response()->view('public.homepage.ajax-partials.top_store_ajax_tab', ['store_list' => $storeIds]);
    }

    public  function couponAjaxTab($catId = null,$slug = null) {

      $getData = [];
      $viewAll    = '';
      if($catId == 'trending') {
        $viewAll  = false;
        $getData = DB::select(DB::raw("SELECT tb_coupons.*, tb_stores.store_id,tb_stores.store_name,tb_stores.offers_count,tb_stores.store_slug,tb_stores.store_logo,tb_stores.cashback_type,tb_stores.cashback as storeCashback, tb_stores.cashback_enabled FROM
                                                        tb_coupons INNER JOIN tb_stores ON tb_coupons.store_id = tb_stores.store_id WHERE expiry_date > CURRENT_TIME  AND
                                                        tb_coupons.coupon_status = 'published'
                                                        ORDER BY daily_clicks DESC LIMIT ".config('settingConfig.hp_coupon_count').""));

       }
       else if($catId == 'new') {
         $viewAll  = false;
         $getData = DB::select(DB::raw("SELECT tb_coupons.*, tb_stores.store_id,tb_stores.store_name,tb_stores.offers_count,tb_stores.store_slug,tb_stores.store_logo,tb_stores.cashback_type,tb_stores.cashback as storeCashback, tb_stores.cashback_enabled FROM
                                                        tb_coupons INNER JOIN tb_stores ON tb_coupons.store_id = tb_stores.store_id WHERE expiry_date > CURRENT_TIME  AND
                                                        tb_coupons.coupon_status = 'published'
                                                        ORDER BY updated_date DESC LIMIT ".config('settingConfig.hp_coupon_count').""));
        }
       else {
         $viewAll  = true;
        $getData = DB::select(DB::raw("SELECT tb_coupons.*, tb_stores.store_id,tb_stores.store_name,
            tb_stores.store_slug,tb_stores.offers_count,tb_stores.store_logo,tb_stores.cashback_type,tb_stores.cashback as
            storeCashback, tb_stores.cashback_enabled FROM tb_coupons INNER JOIN tb_stores ON
            tb_coupons.store_id = tb_stores.store_id WHERE FIND_IN_SET($catId,categories)
            AND expiry_date > CURRENT_TIME AND tb_coupons.coupon_status = 'published' ORDER BY
            clicks DESC LIMIT ".config('settingConfig.hp_coupon_count').""));
          }
          return response()->view('public.homepage.ajax-partials.top_coupon_ajax_tab', ['couponData' => $getData,'slug'=>$slug,'viewAll' => $viewAll]);
    }

    public function TrendingAjaxTab($catCode) {
      return response()->view('public.homepage.ajax-partials.trending_offers_ajax_tab', ['cat_code' => $catCode]);
    }

    public function DailyDealAjaxTab($catID) {
      return response()->view('public.homepage.ajax-partials.daily_deals_ajax', ['cat_id' => $catID]);
    }

    public function extraCashbackAjaxTab($storeCatId) {

      return response()->view('public.homepage.ajax-partials.extra_cashback_ajax', ['store_cat_id' => $storeCatId]);
    }

    public function refreshCaptcha()
      {

          return response()->json(['captcha'=> captcha_img()]);
      }

    public function searchLocation(Request $request) {

        if(!empty($request->keyword)) {
            $getData = DB::table('tb_pincode_master')->where('location_name', 'like', $request->keyword . '%')
                      ->orWhere('pincode', 'like', $request->keyword . '%')
                      ->limit(6)
                      ->get();
            $htmlData = '';
            if(Count($getData) > 0) {
              $htmlData = '<ul class="list-group">';
              foreach ($getData as $key => $value) {
                $htmlData .= '<li class="list-group-item"><a  onclick=reloadMap('.$value->latitude.','.$value->longitude.') style="cursor:pointer">'.$value->location_name. ' ('.$value->city.'), ' .$value->pincode.'</a></li>';
              }
               $htmlData .= '</ul>';
             }
            else { 
              $htmlData = 'No record found';
            }
             return $htmlData;
        }
    }

}
