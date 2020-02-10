<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Exception;
use Log;
use App\User;
use Auth;
use DB;
use App\Models\settings;
use App\Models\categories;
use Session;
use Mail;

class AppClass extends Model
{

	//For Menu Functions start here
	  public static function hasChild($id) {
	    $getchildMenu =  DB::table('tb_front_menu')->whereactive('1')->whereparent_id($id)->first();
	    if($getchildMenu !=null && count($getchildMenu) > 0)
	        return 1;
	    else
	        return 0;
	  }
		//get store by list
		public static function getVendorByList($vendroIds) {
			$data = [];
			if(!empty($vendroIds)) {
						$vendroIds = AppClass::filterID($vendroIds);
						$data = DB::table('tb_vendors')->whereIn('vendor_id',$vendroIds)->get();
				}
				return $data;
		}

		//get category by list
		public static function getOfferByList($offerlist) {
			$data = [];
			if(!empty($offerlist)) {
						$offerlist = AppClass::filterID($offerlist);
						$data = DB::table('tb_offers')->whereIn('offer_id',$offerlist)->get();
				}
				return $data;
		}
		//get store by list
		public static function getStoreByList($storeList) {
			$data = [];
			if(!empty($storeList)) {
						$storeIds = AppClass::filterID($storeList);
						$data = DB::table('tb_stores')->whereIn('store_id',$storeIds)->get();
				}
				return $data;
		}

		//get category by list
		public static function getCatByList($catlist) {
			$data = [];
			if(!empty($catlist)) {
						$catIds = AppClass::filterID($catlist);
						$data = DB::table('tb_categories')->whereIn('cat_id',$catIds)->get();
				}
				return $data;
		}
		//get deal by cat id
		public static function getDealByCat($catID) {
			$data = [];
			$data = DB::select("select tb_deals.*, tb_stores.* from tb_deals INNER JOIN tb_stores ON tb_stores.store_id=tb_deals.store_id  where find_in_set($catID,categories)");
				return $data;
		}

		//get Trending deal
		public static function getDealTrend() {
			$hp_deal_limit = 14;
			if(!empty(config('settingConfig.hp_deal_count'))) {
				$hp_deal_limit = config('settingConfig.hp_deal_count');
			}
			$data = [];
			$data = DB::table('tb_deals')
							->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
							->limit($hp_deal_limit)
							->orderBy('tb_deals.daily_clicks', 'DESC')
							->get();
				return $data;
		}

		//get New deal
		public static function getDealNew() {
			$hp_deal_limit = 14;
			if(!empty(config('settingConfig.hp_deal_count'))) {
				$hp_deal_limit = config('settingConfig.hp_deal_count');
			}
			$data = [];
			$data = DB::table('tb_deals')
							->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
							->limit($hp_deal_limit)
							->orderBy('tb_deals.updated_date', 'DESC')
							->get();
				return $data;
		}

		public static function	getReletedBlogs($ids) {
				$blogIds = AppClass::filterID($ids);
				$data = DB::table('tb_pages')->whereIn('pageID',$blogIds)->get();
				return $data;
		}
		//get brands by list
		public static function getBrandByList($brandlist) {
			$data = [];
			if(!empty($brandlist)) {
						$brandIds = AppClass::filterID($brandlist);
						$data = DB::table('tb_brands')->whereIn('brand_id',$brandIds)->get();
				}
				return $data;
		}

		//get blog
		public static function getBlog($ids) {
			$data = [];
			if(!empty($ids)) {
					$blogIds = AppClass::filterID($ids);
					$data = DB::table('tb_pages')->whereIn('pageID',$blogIds)->wherepagetype('post')->orderByRaw('pageID',$blogIds)->get();
				}
				return $data;
		}
		//get Tags by list
		public static function getTagsByList($taglist) {
			$data = [];
			if(!empty($taglist)) {
						$tagIds = AppClass::filterID($taglist);
						$data = DB::table('tb_tags')->whereIn('tag_id',$tagIds)->get();
				}
				return $data;
		}

		//return total offers
		public static function getOffersCount($t_offres) {
				$offercount  = '';
				$offers = explode('|',$t_offres);
		 	 if(count($offers) > 0) {
		 		 $offercount = $offers[0];
		 	 }
			 return $offercount;
		}

		//get all tyoe balance
		public static function getAllBalById($user_id) {

			$data['cashback']     =  DB::select('SELECT IFNULL(SUM(cashback_amount),0) as cashback, status FROM `tb_user_transaction` WHERE user_id = '.$user_id.' AND cashback_type = "cashback" GROUP BY status');
			$data['rewards']      =  DB::select('SELECT IFNULL(SUM(cashback_amount),0) as reward , status FROM `tb_user_transaction` WHERE user_id =  '.$user_id.'  AND cashback_type = "reward" GROUP BY status');
			$data['bonus']        = [];
			// DB::select('SELECT IFNULL(SUM(total_amt),0) as ebonus , status FROM (
			// 																	 SELECT IFNULL(SUM(amount),0) total_amt, status FROM `tb_user_bonus` WHERE user_id = '.$user_id.' GROUP BY status
			// 																	 UNION
			// 																	 SELECT IFNULL(SUM(bonus_amount),0) total_amt, status FROM `tb_user_referrals` WHERE user_id = '.$user_id.' GROUP BY status) inq GROUP BY status');


			 $data['avail_bal']   = 0;
			 $data['total_earn']  = 0;
			 $data['pending']     = 0;
			 $data['cashback-confirmed'] = 0;
			 $data['cashback-pending']   = 0;
			 $data['cashback-declined']  = 0;
			 $data['reward-confirmed'] = 0;
			 $data['reward-pending']   = 0;
			 $data['reward-declined']  = 0;
			 $data['bonus-confirmed'] = 0;
			 $data['bonus-pending']   = 0;
			 $data['bonus-declined']  = 0;
			 $data['passbook-closing']      = 0;
			 // $data['passbook-debit']      = 0;
			 // $data['passbook-credit']      = 0;


		//	 $data['Paidout']     = DB::select('SELECT IFNULL(SUM(amount),0) as paid, IFNULL(SUM(cashback_amount),0) paidCashback, IFNULL(SUM(reward_amount),0) paidReward , IFNULL(SUM(bonus_amount),0) paidBonus  FROM `tb_user_withdrawals` WHERE user_id = '.$user_id.' AND status <> "rejected"');

			 // for($c=0; $c<Count($data['cashback']); $c++ ) {
				// 	 if($data['cashback'][$c]->status == 'confirmed') {
				// 				$data['passbook-closing'] = $data['passbook-closing'] + $data['cashback'][$c]->cashback;
				// 				$data['avail_bal']  =  $data['avail_bal'] + $data['cashback'][$c]->cashback;
				// 				$data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
				// 				$data['cashback-confirmed'] = $data['cashback'][$c]->cashback;
				// 	 }
				// 	 if($data['cashback'][$c]->status == 'pending') {
				// 				$data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
				// 				$data['pending']     = $data['pending']  + $data['cashback'][$c]->cashback;
				// 				$data['cashback-pending'] = $data['cashback'][$c]->cashback;
				// 	 }
				// 	 if($data['cashback'][$c]->status == 'declined') {
				// 		//	 $data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
				// 			 $data['cashback-declined'] = $data['cashback'][$c]->cashback;
				// 	 }
			 // }

			 //
			 // for($c=0; $c<Count($data['rewards']); $c++ ) {
				// 	 if($data['rewards'][$c]->status == 'confirmed') {
				// 		 $data['passbook-closing'] = $data['passbook-closing'] + $data['rewards'][$c]->reward;
			 //
				// 			 $data['avail_bal']  =  $data['avail_bal'] + $data['rewards'][$c]->reward;
				// 			 $data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
				// 			 $data['reward-confirmed'] = $data['rewards'][$c]->reward;
				// 	 }
				// 	 if($data['rewards'][$c]->status == 'pending') {
				// 			 $data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
				// 			 $data['pending']     = $data['pending']  + $data['rewards'][$c]->reward;
				// 			 $data['reward-pending'] = $data['rewards'][$c]->reward;
			 //
				// 	 }
				// 	 if($data['rewards'][$c]->status == 'declined') {
				// 			 //$data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
				// 			 $data['reward-declined'] = $data['rewards'][$c]->reward;
			 //
			 //
				// 	 }
			 // }




			 // for($c=0; $c<Count($data['bonus']); $c++ ) {
				// 	 if($data['bonus'][$c]->status == 'confirmed') {
				// 		$data['passbook-closing'] = $data['passbook-closing'] + $data['bonus'][$c]->ebonus;
			 //
				// 			 $data['avail_bal']   =  $data['avail_bal'] + $data['bonus'][$c]->ebonus;
				// 			 $data['total_earn']  = $data['total_earn'] + $data['bonus'][$c]->ebonus;
				// 			 $data['bonus-confirmed'] = $data['bonus'][$c]->ebonus;
			 //
			 //
				// 	 }
				// 	 if($data['bonus'][$c]->status == 'pending') {
				// 			 $data['total_earn']    = $data['total_earn'] + $data['bonus'][$c]->ebonus;
				// 			 $data['pending']       = $data['pending']  + $data['bonus'][$c]->ebonus;
				// 			 $data['bonus-pending'] = $data['bonus'][$c]->ebonus;
			 //
			 //
			 //
				// 	 }
				// 	 if($data['bonus'][$c]->status == 'declined') {
				// 			// $data['total_earn']  = $data['total_earn'] + $data['bonus'][$c]->ebonus;
				// 			 $data['bonus-declined'] = $data['bonus'][$c]->ebonus;
			 //
				// 	 }
			 // }

				$data['avail_bal']   = $data['avail_bal'] ;

				return $data;
		}


	  public static function getChlid($id) {
	    $getchildMenu =  DB::table('tb_front_menu')->whereactive('1')->whereparent_id($id)->get();
	      if(count($getchildMenu) > 0 )
	        return $getchildMenu;
	      else
	       return 0;
	  }

	  public static  function getStoreCat(){
	    $catMaster = array();
	    $catMaster['name'] = '';
	    $catMaster['icon'] = '';
			$getstoreCat  = DB::select( DB::raw("SELECT POSITION(store_id IN sc.store_list) storepos, sc.*,s.*,cat.* FROM `tb_menu_topstores` sc, `tb_stores` s, `tb_store_categories` cat WHERE FIND_IN_SET(store_id,sc.store_list) AND cat.store_cat_id = sc.store_cat_id order by 2,1"));
			return $getstoreCat;
	  }

	  public static function getMenuCategories() {
	   	$getCategories  =   DB::select(DB::raw("SELECT tcpmid,POSITION(cat_id IN cat_list) as catpost,tpc.menu_icon as PIcon, tpc.category_name,tpc.cat_list , tc.* FROM `tb_menu_topcats`  tpc, `tb_categories` tc WHERE FIND_IN_SET(cat_id,cat_list) ORDER BY 1,2"));
			return $getCategories;
	  }

	  //store-category
	  public static function getStoreCategory() {
	    $getStoreCategory  =   DB::table('tb_store_categories')->get();
	   	return $getStoreCategory;
	  }
	  //store-category
	  public static function getStoreCategoryOrder($ids) {
	    $getStoreCategory  =   DB::table('tb_store_categories')->orderByRaw( "FIELD(store_cat_id, {$ids} )")->get();
	   	return $getStoreCategory;
	  }



		public static function getStoreCatName() {
	    //$getStoreCatName  =   DB::table('tb_stores')->get();
			$getStoreCatName  =   DB::select(DB::raw("SELECT * FROM `tb_menu_topcats`  tpc, `tb_categories` tc WHERE FIND_IN_SET(cat_id,cat_list) ORDER BY 1 desc"));
			return $getStoreCatName;
	  }

		public static function getParentCategories() {
	    $getCategories  =   DB::table('tb_categories')->whereparent_id(0)->get();
			return $getCategories;
	  }

	  public static function childCat($id) {

	    $getCategories  =   DB::select("select * from `tb_categories` where `parent_id` = ".$id." limit 6");

	    return $getCategories;
	  }

		public static function getChildTag($id) {

	    $getTags  =   DB::select("select * from `tb_tags` where `parent_id` = ".$id);

	    return $getTags;
	  }

	  public static function getbestOffers() {
	    $getOffers   =   DB::table('tb_topoffers_menu')->limit('6')->get();
	    return $getOffers;
	  }

	 public static function getbestOffersCoupons($cids) {
			$ids = rtrim( str_replace(",,",",",$cids),',');
	    $getCoupons   =   DB::select(DB::raw("select `tb_coupons`.*,tb_stores.store_logo,tb_stores.store_name,tb_stores.cashback_type,tb_stores.cashback as storeCashback, tb_stores.cashback_enabled from tb_coupons  inner join `tb_stores` on `tb_stores`.`store_id` = `tb_coupons`.`store_id` where `tb_coupons`.`coupon_id` in ($ids) AND expiry_date > CURRENT_TIME  and `tb_coupons`.`coupon_status` = 'published' limit 12"));
		  return $getCoupons;
	  }

	//For Menu Functions end here
	 public static function getUptoText($amt , $type) {
		 $returnTxt     = '';
		 $type = ucfirst($type);
	 	if($amt !=  '') {
			$getSettingtxt  = config('settingConfig.cb_sentence');
			$getAmt  				= explode('|',$amt);
			if($getAmt[0] == 'percent') {
				$replaceAmt  	= str_replace("#CBAMT",$getAmt[1].'%',config('settingConfig.cb_sentence'));
			}
			else {
				$replaceAmt  	= str_replace("#CBAMT",config('sximo.cnf_currencyname'). $getAmt[1] .config('sximo.cnf_currencysuffix'),config('settingConfig.cb_sentence'));
			}
			$returnTxt 	= str_replace("#TYPE",$type." ",$replaceAmt);
		}
			return $returnTxt;

	 }
	 public static function getEarnUpto($amt,$type,$cbType = null) {

		 $cashBackText = '';
		 if($amt != '') {
			  $cashBack = explode('|',$amt);
				if(count($cashBack)==2)
				{
					if($cashBack[0] == 'percent')
					{
						$cashBackText = 'Earn Upto '. $cashBack[1] .'% '. ucFirst($type);
					 }
					  else {
						 $cashBackText = 'Earn Upto '.config('sximo.cnf_currencyname').' '.$cashBack[1].' '.$type.config('sximo.cnf_currencysuffix');
					 	}
					 }
					 else {
						 if($cbType != '') {
					 		 if( $cbType == 'percent') {
					 			 $cashBackText = 'Earn Upto '. $cashBack[0] .'% '. ucFirst($type);
					 		 }
					 		 else {
					 			 $cashBackText = 'Earn Upto '.config('sximo.cnf_currencyname').' '.$cashBack[0].' '.$type.config('sximo.cnf_currencysuffix');
					 		 }
					 	 }
					 }
				 }

				return $cashBackText;

			}


	 //getTop footer
	 public static function getTopFooter() {
		 $data = [];
		 $data = 	DB::table('tb_hp_listing_menu')->get();
		 return $data;
	 }

	 //top store cat
	 public static function getTopStoreCat($ids,$type) {
		 		$data							 = '';

		 		$IDs 							 = AppClass::filterID($ids);
				$data							 = DB::table('tb_store_categories')->whereIn('store_cat_id',$IDs)
														->orderByRaw( "FIELD(store_cat_id, {$ids} )")->limit(10);
				if($type == 'topStore') {
					$data 					= $data->limit(config('settingConfig.list_max_cat_topstores'));
				}
				$data						  = $data->get();
				return $data;
	 }
	 //top store Categories
	 public static function getTopStoreList($storecatId) {
		 $data							 = DB::select("SELECT * FROM tb_store_categories sc ,  tb_stores ts WHERE sc.store_cat_id = $storecatId AND
			 															FIND_IN_SET(store_id,IF(is_seq_overrride='Y',store_list,popular_store_list))  ORDER BY FIND_IN_SET(store_id,IF(is_seq_overrride='Y',store_list,popular_store_list))");

		 return $data;
	 }
	 //get Deal Filter
	 public static function getDealFilter($ids) {
		 $data							 = '';
		 $IDs 							 = AppClass::filterID($ids);
		 dd($IDs);
		 $data							 = DB::table('tb_deals')->whereIn('deal_id',$IDs)->get();

		 return $data;
	 }

 	 public static function	 filterID($ids) {
		 	$rids 	= '';
		 	$IDs 	= rtrim(str_replace(",,",",",$ids),',');
			$rids 	= explode(',',$IDs);
			return $rids;
	 }

	 public static function getTrendingOffers($cat) {
		 	$data = [];
			$data = DB::table('tb_sliders')->where('category',$cat)->get();
			return $data;
	 }

	 //get h1 tags
	 public static function getHTag($value,$default,$for,$tag) {

		 $string  = '';
		 //if h1 tag
		 if($tag == 'h1') {

			 if($for == 'store') {
					 $string  =	 config('settingConfig.store_h1');
			 }
			 if($for == 'tag') {
				 $string  =	 config('settingConfig.tag_h1');
			 }
			 if($for == 'cat') {
				 $string  =	 config('settingConfig.cat_h1');
			 }
			 if($for == 'brand') {
				 $string  =	 config('settingConfig.brand_h1');
			 }


		 }

		 //if h2 tag
		 if($tag == 'h2') {
			 if($for == 'store') {
					 $string  =	 config('settingConfig.store_h2');
			 }
			 if($for == 'tag') {
				 $string  =	 config('settingConfig.tag_h2');
			 }
			 if($for == 'cat') {
				 $string  =	 config('settingConfig.cat_h2');
			 }
			 if($for == 'brand') {
				 $string  =	 config('settingConfig.brand_h2');
			 }

		 }


		 if($default != '' ) {
			 $string  = $default;
		 }
		 else {
			 $string  =  str_replace("#TITLE",$value,$string);
		 }
			return $string;

	 }

	 //for top Categories
	 public static function getTopCats($catIds) {
		 	$getCategory = categories::whereIn('cat_id',explode(',',$catIds))->select('cat_name','menu_name','cat_slug','parent_id','offers_count','cat_id')->orderByRaw( "FIELD(cat_id,{$catIds} )" )->get();
			return $getCategory;
	 }

	 //for popular cat
	 public static function getPopular() {
		 	$topCat = config('settingConfig.menu_popular_cats');
			$topCat = rtrim( str_replace(",,",",",$topCat),',');
		 	$getPopularCat  = DB::select( DB::raw("SELECT tc.* FROM `tb_categories` tc , `tb_settings`  ts WHERE setting_key = 'menu_popular_cats' AND FIND_IN_SET(cat_id,'{$topCat}') ORDER BY FIELD(cat_id,{$topCat}) LIMIT 6"));
			return $getPopularCat;
	 }

		//get footer stores
		public static  function getFooterCat(){
			$catMaster = array();
			$catMaster['name'] = '';
			$catMaster['icon'] = '';
			$getfooterCat  = DB::select( DB::raw("SELECT POSITION(store_id IN sc.footer_stores) as pos,sc.*,s.* FROM `tb_store_categories` sc, `tb_stores` s WHERE is_shown_menu = 'Y' AND FIND_IN_SET(store_id,sc.footer_stores) ORDER BY 2,1"));

			return $getfooterCat;
		}


		public static	function word_limit($string, $count){
			$original_string = $string;
	   	$words = explode(' ', $original_string);

		   if (count($words) > $count){
		    $words = array_slice($words, 0, $count);
		    $string = implode(' ', $words);
		   }

	   	return $string;
		}

		public static function getOnlyCashbackValue($value) {
			$replaceAmt     = '';
			if($value !=  '') {
				$getAmt  				= explode('|',$value);
					if($getAmt[0] == 'percent') {
						$replaceAmt  	= $getAmt[1].'%';
					}
					else {
						$replaceAmt  	= config('sximo.cnf_currencyname').' '.$getAmt[1].config('sximo.cnf_currencysuffix');
					}
				}
				return $replaceAmt;
		}

		//get how it works popup data
		public static function getHIWPOP() {
				$data			 = DB::table('tb_content_block')->whereblock_type('hiw_pop')->get();
				return $data;
		}
		//get how it works popup data
		public static function getHIW() {
				$data			 = DB::table('tb_content_block')->whereblock_type('hiw')->get();
				return $data;
		}
		public static function getBlockContent($type) {
				$data			 = DB::table('tb_content_block')->whereblock_type($type)->get();
				return $data;
		}

		public static function getFooterLinks() {
				$data = DB::table('tb_footer')->get();
				return $data;
		}

		public static function getPages($pagesIds) {
			$data		  = [];
			$getLinks = config('pageList');
			if(!empty($pagesIds)) {
					$IDs =rtrim(str_replace(",,",",",$pagesIds),',');
					$pIds = explode(',',$IDs);
					foreach ($pIds as $key => $value) {
						array_push($data,	$getLinks[$value]);
					}
				}
				return $data;
		}

		public static function getPagesEmail($pagesIds) {
			$data = [];
			if(!empty($pagesIds)) {
					$IDs =rtrim(str_replace(",,",",",$pagesIds),',');
					$pIds = explode(',',$IDs);
						$data = DB::table('tb_pages')->whereIn('pageID',$pIds)->orderByRaw( "FIELD(pageID,{$pagesIds} )" )->get();
				}
				return $data;
		}

		public static function getStores($storeIds) {
			$data = [];
			if(!empty($storeIds)) {
					$IDs =rtrim(str_replace(",,",",",$storeIds),',');
					$sIds = explode(',',$IDs);
					$data = DB::table('tb_stores')->where('store_status','publish')->whereIn('store_id',$sIds)->orderByRaw( "FIELD(store_id,{$storeIds} )" )->get();
				}

				return $data;
		}

		public static function getCat($catIds) {
			$data = [];
			if(!empty($catIds)) {
					$IDs =rtrim(str_replace(",,",",",$catIds),',');
					$cIds = explode(',',$IDs);
					$data = DB::table('tb_categories')->whereIn('cat_id',$cIds)->orderByRaw( "FIELD(cat_id,{$catIds} )" )->get();
				}
				return $data;
		}


		public static function stringReplaceSetting($string,$getTitle) {
				 if($getTitle != '') {
						$string   = str_replace("#TITLE",$getTitle,$string);
					}
				  $string 	= str_replace("#CURRENTMONTH",date('F'),$string);
					$string 	= str_replace("#CURRENTYEAR",date('Y'),$string);
					$string   = str_replace("#SITENAME",config('settingConfig.seo_site_name'),$string);
					return $string;
	}





public static function getDealData($data){
			$paginates = false;
			$query   = 'select * from `tb_deals` inner join `tb_stores` on `tb_stores`.`store_id` = `tb_deals`.`store_id`';


			if($data['storeFilter'] != '' || $data['catFilter'] != '')
			{
				$set_or = false;

				$query  .= ' AND ( ';
			if($data['storeFilter'] != '') {
				 $filtersfIds =rtrim(str_replace(",,",",",$data['storeFilter']),',');
				 $explodeSfIds = explode(',',$filtersfIds);
				 $query .=  '  (';
					for($sf=0; $sf<Count($explodeSfIds); $sf++) {
						if($sf!=0)
							$query .= ' OR ';

						$query .= "tb_deals.store_id = ". $explodeSfIds[$sf];
				 }
					$query .= ') ';
					$set_or = true;
			}

			if($data['catFilter'] != '') {
				 $filtersfIds =rtrim(str_replace(",,",",",$data['catFilter']),',');
				 $explodeSfIds = explode(',',$filtersfIds);
				 if($set_or) $query .= ' AND ';
				 $query .=  '  (';
					for($tf=0; $tf<Count($explodeSfIds); $tf++) {
						if($tf!=0)
							$query .= ' OR ';
							$query .= " FIND_IN_SET($explodeSfIds[$tf],tb_deals.categories) ";
				 }
					$query .= ') ';
			}

			$query .= ') ';
			}

			// if($data['dealId'] != '') {
			// 	$paginates = true;
			// 	$query  .= ' and tb_deals.deal_id < '.$data["dealId"].'';
			// }

			$query   .= ' where expiry >= CURRENT_TIME	order by `tb_deals`.`deal_id` desc';
			$total    =  DB::select($query);
//			$query   .= '  limit '.config('settingConfig.list_dod_count').' ';
			//echo $query;
			$getData =   DB::select($query);

			return ['getData' => $getData,'total' => $total,'paginate' => $paginates];

		}

		public static function getAjaxData($data) {

					$query = 'select * from `tb_deals` inner join `tb_stores` on `tb_stores`.`store_id` = `tb_deals`.`store_id` where `tb_deals`.`store_id` = '.$data['storeID'].'';
					$pagination = false;

					if($data['catFilter'] != '') {
		 			 	$filtertfIds =rtrim(str_replace(",,",",",$data['catFilter']),',');
		 				$explodTSfIds = explode(',',$filtertfIds);
		 				$query .=  ' AND (';
		 				 for($tf=0; $tf<Count($explodTSfIds); $tf++) {
		 					 if($tf!=0)
		 						 $query .= ' OR ';
		 					 	 $query .= " FIND_IN_SET($explodTSfIds[$tf],tb_deals.categories) ";
		 				}
		 				 $query .= ') ';
		 		 }

				//  if($data['dealID'] != '') {
				//   $pagination = true;
			 	// 	$query 		.= ' AND tb_deals.deal_id > '.$data['dealID'].'';
			 	// }

					$total  = DB::select($query);
					// $query .= '	 LIMIT '.config('settingConfig.list_store_deal_count');
					$getData  = DB::select($query);
					return ['record' => $getData,'totalR' => $total,'paginate' => $pagination];
		}

		public static function curlMe($url)
		{

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: en-US,en;q=0.8',"Cache-Control: max-age=0",'Connection: keep-alive','Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8 ' ));
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:48.0) Gecko/20100101 Firefox/48.0");
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$data = curl_exec($ch);
			curl_close($ch);

			return $data;

		}

		public static function sendSMS($to,$sms)
		{
					$sms_api = null;

					$sms_api = str_ireplace( array('#API_KEY','#SENDER','#NUMBER','#MESSAGE') , array(config('settingConfig.dev_sms_apikey'),config('settingConfig.dev_sms_apisender'),$to,urlencode($sms)),config('settingConfig.dev_sms_apiurl')  );

					return	AppClass::curlMe($sms_api);
		}

		public static function sendSMSWithName($to,$sms)
		{
					$sms_api = null;
				if(Auth::guard('member')->check()) {
					$srhArr  = ['#WEBSITENAME','#FIRSTNAME','#LASTNAME'];
				  $repArr  = [config('sximo.cnf_appname'),Session::get('memberDetail')->first_name,Session::get('memberDetail')->last_name];
					$sms     = str_ireplace($srhArr,$repArr,$sms);
				}
				else {
					$srhArr  = ['#WEBSITENAME'];
					$repArr  = [config('sximo.cnf_appname')];
					$sms    = str_ireplace($srhArr,$repArr,$sms);
				}
					$sms_api = str_ireplace( array('#API_KEY','#SENDER','#NUMBER','#MESSAGE') , array(config('settingConfig.dev_sms_apikey'),config('settingConfig.dev_sms_apisender'),$to,urlencode($sms)),config('settingConfig.dev_sms_apiurl')  );
					AppClass::curlMe($sms_api);

		}


		public static function getPreviewEmail() {
				$data = DB::table('tb_email_templates')->select('subject','body')->whereemail_key('referral_preview')->first();

				return  $data;
		}

		public static function getUserDetail($id) {
			$data = DB::table('tb_cashback_users')->wheremember_id($id)->first();
			return  $data;
		}

		public static function getSocialLinks($url,$title = null)
		{
			return array(
			'facebook'=>'https://www.facebook.com/sharer/sharer.php?u='.$url,
			'google'=>'https://plus.google.com/share?url='.$url,
			'twitter'=>'https://twitter.com/intent/tweet?text='.urlencode($title).'&amp;url='.$url,
			'whatsapp'=>'whatsapp://send?text='.urlencode($url).urlencode('    '.$title),
			'comment'=>'sms:?body='.urlencode($url).urlencode('    '.$title),
			'envelope'=>'mailto:?subject=Check this out - '.$title.'&amp;body=Visit here for more details  '.$url,

		//	'facebook-messenger'=>'fb-messenger://share/?link='.$url
			);

		}



		public static function getSocialFollow()
		{
			$html = '<ul class="ft-social-icons list-inline">';
			if( strlen(config('settingConfig.social_facebook'))>1)
			$html .= '<li class="list-inline-item btn-facebook">
						<a href="'.config('settingConfig.social_facebook').'" target="_blank">
									<i class="fab fa-facebook-f"></i>
									</a>
							</li>';

			if( strlen(config('settingConfig.social_google-plus'))>1)
			$html .= '<li class="list-inline-item ico-google btn-google">
									<a href="'.config('settingConfig.social_google-plus').'" target="_blank">
									<i class="fab fa-google-plus-g"></i>
									</a>
							</li>	';

			if( strlen(config('settingConfig.social_instagram'))>1)
			$html .= '<li class="list-inline-item insta-icon btn-instagram">
								<a href="'.config('settingConfig.social_instagram').'" target="_blank">
									<i class="fab fa-instagram"></i>
									</a>
							</li>';

			if( strlen(config('settingConfig.social_twitter'))>1)
			$html .= '
							<li class="list-inline-item btn-twitter">
									<a href="'.config('settingConfig.social_twitter').'" target="_blank">
									<i class="fab fa-twitter"></i>
									</a>
							</li>';
						$html .='</ul>';

						return $html;

		}


		//get all tyoe balance
		public static function getAllBal() {

			$data['cashback']     =  DB::select('SELECT IFNULL(SUM(cashback_amount),0) as cashback, status FROM `tb_user_transaction` WHERE user_id = '.Auth::guard('member')->id().' AND cashback_type = "cashback" GROUP BY status');
			$data['rewards']      =  DB::select('SELECT IFNULL(SUM(cashback_amount),0) as reward , status FROM `tb_user_transaction` WHERE user_id =  '.Auth::guard('member')->id().'  AND cashback_type = "reward" GROUP BY status');
			$data['bonus']        =  DB::select('SELECT IFNULL(SUM(total_amt),0) as ebonus , status FROM (
																				 SELECT IFNULL(SUM(amount),0) total_amt, status FROM `tb_user_bonus` WHERE user_id = '.Auth::guard('member')->id().' GROUP BY status
																				 UNION
																				 SELECT IFNULL(SUM(bonus_amount),0) total_amt, status FROM `tb_user_referrals` WHERE user_id = '.Auth::guard('member')->id().' GROUP BY status) inq GROUP BY status');


			 $data['avail_bal']   = 0;
			 $data['total_earn']  = 0;
			 $data['pending']     = 0;
			 $data['cashback-confirmed'] = 0;
			 $data['cashback-pending']   = 0;
			 $data['cashback-declined']  = 0;
       $data['reward-confirmed'] = 0;
       $data['reward-pending']   = 0;
       $data['reward-declined']  = 0;
		 	 $data['bonus-confirmed'] = 0;
		   $data['bonus-pending']   = 0;
		   $data['bonus-declined']  = 0;
			 $data['passbook-closing']      = 0;
			 // $data['passbook-debit']      = 0;
			 // $data['passbook-credit']      = 0;


			 $data['Paidout']     = DB::select('SELECT IFNULL(SUM(amount),0) as paid, IFNULL(SUM(cashback_amount),0) paidCashback, IFNULL(SUM(reward_amount),0) paidReward , IFNULL(SUM(bonus_amount),0) paidBonus  FROM `tb_user_withdrawals` WHERE user_id = '.Auth::guard('member')->id().' AND status <> "rejected"');

			 for($c=0; $c<Count($data['cashback']); $c++ ) {
					 if($data['cashback'][$c]->status == 'confirmed') {
						 		$data['passbook-closing'] = $data['passbook-closing'] + $data['cashback'][$c]->cashback;
								$data['avail_bal']  =  $data['avail_bal'] + $data['cashback'][$c]->cashback;
								$data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
								$data['cashback-confirmed'] = $data['cashback'][$c]->cashback;
					 }
					 if($data['cashback'][$c]->status == 'pending') {
								$data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
								$data['pending']     = $data['pending']  + $data['cashback'][$c]->cashback;
								$data['cashback-pending'] = $data['cashback'][$c]->cashback;
					 }
					 if($data['cashback'][$c]->status == 'declined') {
						//	 $data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
							 $data['cashback-declined'] = $data['cashback'][$c]->cashback;
					 }
			 }


			 for($c=0; $c<Count($data['rewards']); $c++ ) {
					 if($data['rewards'][$c]->status == 'confirmed') {
						 $data['passbook-closing'] = $data['passbook-closing'] + $data['rewards'][$c]->reward;

							 $data['avail_bal']  =  $data['avail_bal'] + $data['rewards'][$c]->reward;
							 $data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
							 $data['reward-confirmed'] = $data['rewards'][$c]->reward;
					 }
					 if($data['rewards'][$c]->status == 'pending') {
							 $data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
							 $data['pending']     = $data['pending']  + $data['rewards'][$c]->reward;
							 $data['reward-pending'] = $data['rewards'][$c]->reward;

					 }
					 if($data['rewards'][$c]->status == 'declined') {
							 //$data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
							 $data['reward-declined'] = $data['rewards'][$c]->reward;


					 }
			 }




			 for($c=0; $c<Count($data['bonus']); $c++ ) {
					 if($data['bonus'][$c]->status == 'confirmed') {
						$data['passbook-closing'] = $data['passbook-closing'] + $data['bonus'][$c]->ebonus;

							 $data['avail_bal']   =  $data['avail_bal'] + $data['bonus'][$c]->ebonus;
							 $data['total_earn']  = $data['total_earn'] + $data['bonus'][$c]->ebonus;
							 $data['bonus-confirmed'] = $data['bonus'][$c]->ebonus;


					 }
					 if($data['bonus'][$c]->status == 'pending') {
							 $data['total_earn']    = $data['total_earn'] + $data['bonus'][$c]->ebonus;
							 $data['pending']       = $data['pending']  + $data['bonus'][$c]->ebonus;
							 $data['bonus-pending'] = $data['bonus'][$c]->ebonus;



					 }
					 if($data['bonus'][$c]->status == 'declined') {
							// $data['total_earn']  = $data['total_earn'] + $data['bonus'][$c]->ebonus;
							 $data['bonus-declined'] = $data['bonus'][$c]->ebonus;

					 }
			 }

				$data['avail_bal']   = $data['avail_bal']   - $data['Paidout'][0]->paid;

				return $data;
		}

		//get monthly statement
		//get all tyoe balance
		public static function getMonthlyBal($month_num , $year_num) {

			$data['cashback']     =  DB::select('SELECT SUM(cashback_amount) as cashback, status FROM `tb_user_transaction` WHERE user_id = '.Auth::guard('member')->id().' AND cashback_type = "cashback" AND MONTH(transaction_time) = '.$month_num.' AND YEAR(transaction_time)  = '.$year_num.' GROUP BY status');
			$data['rewards']      =  DB::select('SELECT SUM(cashback_amount) as reward , status FROM `tb_user_transaction` WHERE user_id =  '.Auth::guard('member')->id().'  AND cashback_type = "reward"  AND MONTH(transaction_time) = '.$month_num.'  AND YEAR(transaction_time) = '.$year_num.' GROUP BY status');
			$data['bonus']        =  DB::select('SELECT SUM(total_amt) as ebonus , status FROM (
																				 SELECT SUM(amount) total_amt, status FROM `tb_user_bonus` WHERE user_id = '.Auth::guard('member')->id().' AND  YEAR(date_added) = '.$year_num.' AND  MONTH(date_added) = '.$month_num.'  GROUP BY status
																				 UNION
																				 SELECT SUM(bonus_amount) total_amt, status FROM `tb_user_referrals` WHERE user_id = '.Auth::guard('member')->id().'  AND  YEAR(awarded_date) = '.$year_num.' AND  MONTH(awarded_date) = '.$month_num.' GROUP BY status) inq GROUP BY status');


			 $data['avail_bal']   = 0;
			 $data['total_earn']  = 0;
			 $data['pending']     = 0;
			 $data['cashback-confirmed'] = 0;
			 $data['cashback-pending']   = 0;
			 $data['cashback-declined']  = 0;
			 $data['reward-confirmed'] = 0;
			 $data['reward-pending']   = 0;
			 $data['reward-declined']  = 0;
			 $data['bonus-confirmed'] = 0;
			 $data['bonus-pending']   = 0;
			 $data['bonus-declined']  = 0;
			 $data['passbook-closing']      = 0;
			 // $data['passbook-debit']      = 0;
			 // $data['passbook-credit']      = 0;


			 $data['Paidout']     = DB::select('SELECT SUM(amount) as paid FROM `tb_user_withdrawals` WHERE user_id = '.Auth::guard('member')->id().' AND
			 		 MONTH(withdrawal_request_date) = '.$month_num.' AND YEAR(withdrawal_request_date) = '.$year_num.' AND	status <> "rejected"');

			 for($c=0; $c<Count($data['cashback']); $c++ ) {
					 if($data['cashback'][$c]->status == 'confirmed') {
								$data['passbook-closing'] = $data['passbook-closing'] + $data['cashback'][$c]->cashback;
								$data['avail_bal']  =  $data['avail_bal'] + $data['cashback'][$c]->cashback;
								$data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
								$data['cashback-confirmed'] = $data['cashback'][$c]->cashback;
					 }
					 if($data['cashback'][$c]->status == 'pending') {
								$data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
								$data['pending']     = $data['pending']  + $data['cashback'][$c]->cashback;
								$data['cashback-pending'] = $data['cashback'][$c]->cashback;
					 }
					 if($data['cashback'][$c]->status == 'declined') {
						//	 $data['total_earn']  = $data['total_earn'] + $data['cashback'][$c]->cashback;
							 $data['cashback-declined'] = $data['cashback'][$c]->cashback;
					 }
			 }


			 for($c=0; $c<Count($data['rewards']); $c++ ) {
					 if($data['rewards'][$c]->status == 'confirmed') {
						 $data['passbook-closing'] = $data['passbook-closing'] + $data['rewards'][$c]->reward;

							 $data['avail_bal']  =  $data['avail_bal'] + $data['rewards'][$c]->reward;
							 $data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
							 $data['reward-confirmed'] = $data['rewards'][$c]->reward;
					 }
					 if($data['rewards'][$c]->status == 'pending') {
							 $data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
							 $data['pending']     = $data['pending']  + $data['rewards'][$c]->reward;
							 $data['reward-pending'] = $data['rewards'][$c]->reward;

					 }
					 if($data['rewards'][$c]->status == 'declined') {
							 //$data['total_earn']  = $data['total_earn'] + $data['rewards'][$c]->reward;
							 $data['reward-declined'] = $data['rewards'][$c]->reward;


					 }
			 }




			 for($c=0; $c<Count($data['bonus']); $c++ ) {
					 if($data['bonus'][$c]->status == 'confirmed') {
						$data['passbook-closing'] = $data['passbook-closing'] + $data['bonus'][$c]->ebonus;

							 $data['avail_bal']   =  $data['avail_bal'] + $data['bonus'][$c]->ebonus;
							 $data['total_earn']  = $data['total_earn'] + $data['bonus'][$c]->ebonus;
							 $data['bonus-confirmed'] = $data['bonus'][$c]->ebonus;


					 }
					 if($data['bonus'][$c]->status == 'pending') {
							 $data['total_earn']    = $data['total_earn'] + $data['bonus'][$c]->ebonus;
							 $data['pending']       = $data['pending']  + $data['bonus'][$c]->ebonus;
							 $data['bonus-pending'] = $data['bonus'][$c]->ebonus;



					 }
					 if($data['bonus'][$c]->status == 'declined') {
							// $data['total_earn']  = $data['total_earn'] + $data['bonus'][$c]->ebonus;
							 $data['bonus-declined'] = $data['bonus'][$c]->ebonus;

					 }
			 }

				$data['avail_bal']   = $data['avail_bal']   - $data['Paidout'][0]->paid;

				return $data;
		}

		public static function getMonthlyTransaction($month_num , $year_num)
		{

			$data =  DB::select("SELECT * FROM (SELECT 'credit' entry_type,'withdrawal' user_action,withdrawal_id action_id,amount,CONCAT(mode,' ( ', mode_info1,' )') as title, withdrawal_request_date as entry_date,status FROM `tb_user_withdrawals` WHERE user_id =".Auth::guard('member')->id()."
                                            AND status <> 'rejected' AND MONTH(withdrawal_request_date) = {$month_num} AND YEAR(withdrawal_request_date) = {$year_num}
                                  UNION
                                  SELECT 'debit','purchase',transaction_id,cashback_amount,store_name,transaction_time,tr.status FROM `tb_user_transaction` tr , `tb_stores` ts WHERE tr.merchant_id = ts.store_id  AND tr.user_id =".Auth::guard('member')->id()."
                                  AND status = 'confirmed'
                                  AND MONTH(transaction_time) = {$month_num}
									AND YEAR(transaction_time) = {$year_num}

                                  UNION
                                  SELECT 'debit','bonus',bonus_id,amount,bonus_name,date_added,ub.status FROM `tb_user_bonus` ub, `tb_bonus_types` bt
                                  WHERE ub.bonus_type = bt.bonus_code AND ub.user_id = ".Auth::guard('member')->id()."
                                  AND status = 'confirmed'
                                  AND MONTH(date_added) = {$month_num}
									AND YEAR(date_added) = {$year_num}

                                  UNION
                                  SELECT 'debit','referral',refid,bonus_amount,CONCAT(first_name,'' ,last_name) ,ur.awarded_date,ur.status FROM `tb_user_referrals` ur ,  `tb_cashback_users` cu
                                  WHERE cu.member_id = ur.ref_id AND ur.user_id = ".Auth::guard('member')->id()."  AND status = 'confirmed'
                                  AND MONTH(awarded_date) = {$month_num}
								AND YEAR(awarded_date) = {$year_num}

                                  )
                                  ent
                                  ORDER BY entry_date DESC

                                  ");

								  return $data;
		}

		public static function getTips() {
			$data = DB::table('tb_user_tips')->whereenabled('Y')->get();
			return $data;
		}

		public static function getJoiningTip() {

			$tjoin = '';

			$JoiningTip = DB::select("SELECT name,bonus_amount,validity_days,note FROM `tb_user_tips` tp , `tb_bonus_types` bn WHERE tp.tip_key = bonus_code AND bonus_code = 'join_bonus' LIMIT 1");

			if($JoiningTip)
			{
				$JoiningTip = $JoiningTip[0];
			$tjoin = str_ireplace( array('#bonus_amount','#validity_days'),array(config('sximo.cnf_currencyname').$JoiningTip->bonus_amount.config('sximo.cnf_currencysuffix'),$JoiningTip->validity_days), $JoiningTip->note);
			}
			return $tjoin;
		}



		public static function getAllCat() {
				$data  = DB::table('tb_categories')->get();
				return $data;
		}

		public static function getAllBrand() {
			$data  = DB::table('tb_brands')->where('enabled','Y')->get();
			return $data;
		}

		public static function getAllStore() {
			$data  = DB::table('tb_stores')->where('store_status','publish')->get();
			return $data;
		}

		public static function getAllTag() {
			$data  = DB::table('tb_tags')->get();
			return $data;
		}

		//check first transation
		public static function Isfirst_trans() {

				/* $firstTran  = false;
				$get        = DB::table('tb_user_transaction')->whereuser_id(Session::get('memberDetail')->member_id)->first();
				if(Count($get)) {
					$firstTran  = true;
				}

				return $firstTran; */

				$withdrawCount = DB::table('tb_user_withdrawals')->where('user_id',Auth::guard('member')->id())->where('status','<>','rejected')->count();
		if($withdrawCount>0)
			return false;
		else
			return true;
		}

		//update notifications
		public static function updateNotification($id,$table) {
			$update    = DB::table($table)->where('change_id',$id)->update(['user_read' => 'Y']);
		}


		//get bonus amount
		public static function getBonusType($field) {
				$data = DB::table('tb_bonus_types')->wherebonus_code($field)->whereenabled('Y')->first();

				return $data;
		}


		public static function getTemplateByKey($template_key)
		{
			$template = DB::table('tb_email_templates')->where('email_key', $template_key)->where('enabled','Y')->first();
//dd($template);
			return $template;
		}

		public static function getTemplateByModule($module)
		{
			$template = DB::table('tb_email_templates')->where('module', $module)->where('enabled','Y')->first();

			return $template;
		}


		//send emails

		public static function sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc,$body,$to,$fullName = null) {

			$app_name = config('sximo.cnf_appname');
						if(Auth::guard('member')->check())
						 {
							 // echo"if";
							 // die();
							 $srhArr  = ['#WEBSITENAME','#FIRSTNAME','#LASTNAME','WEBSITENAME'];
							$repArr  = [$app_name , $subject,Session::get('memberDetail')->first_name,Session::get('memberDetail')->last_name,$app_name];
						  $subject    = str_ireplace($srhArr,$repArr,$subject);

							$srhArr  = ['#WEBSITENAME','#subject','#FIRSTNAME','#LASTNAME','WEBSITENAME'];
							$repArr  = [$app_name , $subject,Session::get('memberDetail')->first_name,Session::get('memberDetail')->last_name,$app_name];
							$body    = str_ireplace($srhArr,$repArr,$body);
							$fullName =Session::get('memberDetail')->first_name.' '.Session::get('memberDetail')->last_name;
						}
						else
						{
							// echo"else";


							$subject = str_ireplace('#WEBSITENAME',$app_name,$subject);
							$srhArr  = ['#WEBSITENAME','#subject'];
							$repArr  = array( $app_name , $subject);
							$body    = str_ireplace($srhArr,$repArr,$body);

// echo "<h1>1</h1>";
// print_r($subject);
// echo "<h1>2</h1>";
// print_r($srhArr);
// echo "<h1>3</h1>";
// print_r($repArr);
// echo "<h1>4</h1>";
// print_r($body);
// echo"re". $to;
// echo"sssssssss".$sender_email;
//

						}

 					$a=	Mail::send('mailEmail', ['data' => $body], function ($message) use ($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc,$body,$to,$fullName)
						{
							$message->from($sender_email, $sender_name);
							$message->sender($sender_email, $sender_name);
							$message->to($to, $fullName);
							//$message->cc(explode(',',$cc),  null);
							$message->replyTo($reply_to,  null);
							$message->subject($subject);
						} );

					// echo "<h1>MAil: $a</h1>";
					// 	die();
		}

		public static function getBgClassByStatus($status)
		{
			$bgColog = ' bg-none ';
			switch($status) {

				  case "requested":
					$bgColog = ' bg-primary ';
					break;
					case "paid":
					$bgColog = ' bg-success ';
					break;
					case "confirmed":
					$bgColog = ' bg-success ';
					break;
					case "rejected":
					$bgColog = ' bg-danger ';
					break;
					case "pending":
					$bgColog = ' bg-warning ';
					break;
					case "declined":
					$bgColog = ' bg-danger ';
					break;
				default:
					$bgColog = ' bg-none ';
			}

			return $bgColog.' '.$status;
		}


//get child comment for blog
 public static function getBlogChildComment($parentId) {
	 $data = DB::table('tb_comments')
	 					->select('tb_comments.*','tb_cashback_users.first_name','tb_cashback_users.profile_picture','tb_cashback_users.social_link','tb_cashback_users.creation_mode','tb_cashback_users.email')
	 					->leftJoin('tb_cashback_users','tb_cashback_users.member_id','=','tb_comments.userID')
						->where('parentCommentID',$parentId)->wherestatus('approved')
						->get();
	 return $data;
 }

 public static function getPageUrl($name)
 {
	 		$data 		= '';
			$getLinks = config('pageList');
			//dd($getLinks);
			foreach ($getLinks as $key => $value) {

				// if($value['slug'] == $name)
				// {
				// 		$data =$value['slug'];
				// 		//return $data;
				//
				// }
			}
 }

	public static function getDealImage($imageName){

		$sizes = config('media.sizes');

		$extn = pathinfo($imageName,PATHINFO_EXTENSION);
		$newImageName =  str_replace('.'.$extn,'-'.$sizes['deal'].'.'.$extn,$imageName);
		return asset('uploads/images/products').'/'.$newImageName;
	}


	public static function getfeaturedDeals() {
		$data = [];
		$data 	= 						DB::table('tb_deals')
													->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
													->where(DB::raw('DATE(tb_deals.updated_date)'),'>=', DB::raw('SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY)'))
													->where(DB::raw('tb_deals.expiry'),'>',DB::raw('NOW()'))
													->orderBy('tb_deals.clicks','DESC')
													->limit(2)
													->get();
		return $data;

	}
	public static function getHottestCoupon() {
		$data = [];
		$data = 	DB::table('tb_coupons')
														->select('tb_coupons.*','tb_stores.cashback_enabled','tb_stores.store_name','tb_stores.cashback_enabled','tb_stores.store_slug','tb_stores.store_logo','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_stores.direct_store_link')
														->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')
														->where(DB::raw('DATE(tb_coupons.updated_date)'),'>=', DB::raw('SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY)'))
														->where(DB::raw('tb_coupons.expiry_date'),'>',DB::raw('NOW()'))
														->orderBy('tb_coupons.clicks','DESC')
														->limit(2)
														->get();
				return $data;
	}

	public static function getTrendings() {

			$data = [];
			$data['store']  = DB::table('tb_stores')->orderBy('clicks','DESC')->limit(5)->get();
			$data['cat']  	= DB::table('tb_categories')->orderBy('clicks','DESC')->limit(5)->get();
			$data['brand']  = DB::table('tb_brands')->orderBy('clicks','DESC')->limit(5)->get();
			$data['tag']  	= DB::table('tb_tags')->orderBy('clicks','DESC')->limit(5)->get();
			return $data;
	}

	public static function getWidget($pageType) {
			$data 	= [];
			$data = DB::table('tb_page_widgets')->where('page_type',$pageType)->orderBy('sequence')->get();
			return $data;
	}

	public static function getCats($list) {

			$data 	= [];
			$IDs =rtrim(str_replace(",,",",",$list),',');
			$list = explode(',',$IDs);
			$data = DB::table('tb_categories')->whereIn('cat_id',$list)->get();

			return $data;
	}

	// convert html > ul > li to a PHP array

	public static function getMetaImg($data,$type) {
		$img = asset('uploads/images/'.config('sximo.cnf_logo_light'));
		switch (true) {
			case $type == 'pages':
					if(!empty($data->image)){
							$img = asset('uploads/images').'/'.$data->image;
					}
				break;
				case $type == 'blog':
				if(!empty($data->image)){
						$img = asset('uploads/images/'.$data->image);
				}
				break;
				case $type == 'brand':
				if(!empty($data->image)){
						$img =asset('uploads/images/brand').'/'.$data->brand_ico;
				}
				break;
				case $type == 'cat':
				if(!empty($data->image)){
						$img =asset('uploads/images/category').'/'.$data->cat_icon;
				}
				break;
				case $type == 'store':
				if(!empty($data->image)){
						$img =asset('uploads/images/store').'/'.$data->store_logo;
				}
				break;
				case $type == 'tag':
				if(!empty($data->image)){
						$img =asset('uploads/images/tag').'/'.$data->tag_icon;
				}

			default:
				// code...
				break;
		}
		return $img;
	}

	public static function getMerInfoByID($merchant_id){
			$data = DB::table('tb_stores')->where('platform_merchant_id',$merchant_id)->first();
			return $data;
	}
}
