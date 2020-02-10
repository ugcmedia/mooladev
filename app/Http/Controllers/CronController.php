<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


use Illuminate\Config;
use DB;



class CronController extends Controller{
	
	
	public function resetCouponCount()
	{
		
		$coupons = \DB::select("SELECT title,coupon_id FROM `tb_coupons` WHERE  promo_text = 'Discount'");
		foreach($coupons as $coupon)
		{
			$discount_text = \AppClass::getDiscount($coupon->title);
				 \DB::table('tb_coupons')->where('coupon_id',$coupon->coupon_id)->update(['promo_text' => $discount_text]);
		}
		die;
		\DB::statement("UPDATE `tb_stores` SET offers_count = '0|0|0'");
		
		\DB::statement("UPDATE `tb_stores` ts, ( SELECT store_id, COUNT(*) total_c, SUM(IF(coupon_type='coupon',1,0)) coupon_c,SUM(IF(coupon_type='discount',1,0))  discont_c FROM `tb_coupons` WHERE coupon_status = 'published' AND expiry_date > CURRENT_TIME   GROUP BY store_id) inq
 SET offers_count = CONCAT(total_c,'|',coupon_c,'|',discont_c)
 WHERE ts.store_id = inq.store_id");
 
		\DB::statement("UPDATE `tb_categories` SET offers_count = '0|0|0', deal_count = 0");
			\DB::statement("UPDATE `tb_brands` SET offers_count = '0|0|0'");
			\DB::statement("UPDATE `tb_tags` SET offers_count = '0|0|0'");
			
		\DB::statement("UPDATE `tb_categories` cat,
(SELECT tct.cat_id,COUNT(*) total_c, SUM(IF(coupon_type='coupon',1,0)) coupon_c,SUM(IF(coupon_type='discount',1,0))  discont_c FROM `tb_coupons` tc , `tb_categories` tct WHERE expiry_date > CURRENT_TIME AND coupon_status = 'published' AND FIND_IN_SET(tct.cat_id,categories) GROUP BY tct.cat_id) inq
SET offers_count = CONCAT(total_c,'|',coupon_c,'|',discont_c)
 WHERE cat.cat_id = inq.cat_id");
		
		\DB::statement("UPDATE `tb_categories` cat,
(SELECT tc.cat_id,COUNT(td.deal_id) dcount FROM `tb_deals` td, `tb_categories` tc  WHERE expiry > CURRENT_TIME AND FIND_IN_SET(tc.cat_id,td.categories) GROUP BY tc.cat_id) inq
SET deal_count = inq.dcount
 WHERE cat.cat_id = inq.cat_id");
 
 \DB::statement("UPDATE `tb_brands` cat,
(SELECT tct.brand_id,COUNT(*) total_c, SUM(IF(coupon_type='coupon',1,0)) coupon_c,SUM(IF(coupon_type='discount',1,0))  discont_c FROM `tb_coupons` tc , `tb_brands` tct WHERE expiry_date > CURRENT_TIME AND coupon_status = 'published' AND FIND_IN_SET(tct.brand_id,brands) GROUP BY tct.brand_id) inq
SET offers_count = CONCAT(total_c,'|',coupon_c,'|',discont_c)
 WHERE cat.brand_id = inq.brand_id");
 
 \DB::statement("UPDATE `tb_tags` cat,
(SELECT tct.tag_id,COUNT(*) total_c, SUM(IF(coupon_type='coupon',1,0)) coupon_c,SUM(IF(coupon_type='discount',1,0))  discont_c FROM `tb_coupons` tc , `tb_tags` tct WHERE expiry_date > CURRENT_TIME AND coupon_status = 'published' AND FIND_IN_SET(tct.tag_id,tags) GROUP BY tct.tag_id) inq
SET offers_count = CONCAT(total_c,'|',coupon_c,'|',discont_c)
 WHERE cat.tag_id = inq.tag_id");
		
	}
	
	public function setTopStores()
	{
		\DB::statement("UPDATE `tb_categories` SET `store_list` = NULL WHERE override_sl = 'N'");
		
		\DB::statement("UPDATE `tb_tags` SET `store_list` = NULL WHERE override_sl = 'N'");
		
		\DB::statement("UPDATE `tb_brands` SET `store_list` = NULL WHERE override_sl = 'N'");
		
		\DB::statement("UPDATE `tb_categories` tc,
(SELECT GROUP_CONCAT(store_id ORDER BY row_number ASC) topStores, cat_id FROM (SELECT *,@ranking := if(@type = cat_id, @ranking + 1, 1) as row_number,
@type := cat_id as dummy
 FROM (SELECT SUM(tc.clicks) clicks,tc.store_id,cat.cat_id FROM `tb_coupons` tc ,  `tb_categories` cat WHERE FIND_IN_SET(cat.cat_id,categories)  GROUP BY tc.store_id,cat.cat_id ORDER BY 3,1 DESC) inq , (SELECT @type := 0 ) as dum1, (SELECT @ranking := 0 ) as dum2 ) inq WHERE row_number<6 GROUP BY cat_id) inq
SET tc.store_list = inq.topStores
WHERE tc.cat_id = inq.cat_id AND tc.override_sl = 'N'");

		\DB::statement("UPDATE `tb_tags` tc,
(SELECT GROUP_CONCAT(store_id ORDER BY row_number ASC) topStores, tag_id FROM (SELECT *,@ranking := if(@type = tag_id, @ranking + 1, 1) as row_number,
@type := tag_id as dummy
 FROM (SELECT SUM(tc.clicks) clicks,tc.store_id,cat.tag_id FROM `tb_coupons` tc ,  `tb_tags` cat WHERE FIND_IN_SET(cat.tag_id,tags)  GROUP BY tc.store_id,cat.tag_id ORDER BY 3,1 DESC) inq , (SELECT @type := 0 ) as dum1, (SELECT @ranking := 0 ) as dum2 ) inq WHERE row_number<6 GROUP BY tag_id) inq
SET tc.store_list = inq.topStores
WHERE tc.tag_id = inq.tag_id AND tc.override_sl = 'N'");


		\DB::statement("UPDATE `tb_brands` tc,
(SELECT GROUP_CONCAT(store_id ORDER BY row_number ASC) topStores, brand_id FROM (SELECT *,@ranking := if(@type = brand_id, @ranking + 1, 1) as row_number,
@type := brand_id as dummy
 FROM (SELECT SUM(tc.clicks) clicks,tc.store_id,cat.brand_id FROM `tb_coupons` tc ,  `tb_brands` cat WHERE FIND_IN_SET(cat.brand_id,brands)  GROUP BY tc.store_id,cat.brand_id ORDER BY 3,1 DESC) inq , (SELECT @type := 0 ) as dum1, (SELECT @ranking := 0 ) as dum2 ) inq WHERE row_number<6 GROUP BY brand_id) inq
SET tc.store_list = inq.topStores
WHERE tc.brand_id = inq.brand_id AND tc.override_sl = 'N'");
	}
	
}