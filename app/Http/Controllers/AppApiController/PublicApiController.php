<?php namespace App\Http\Controllers\AppApiController;

use App\Http\Controllers\AppApiController\AppApiBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator, Input, Redirect;
use DB;
use App\Helpers\AppClass;

class PublicApiController extends AppApiBaseController {

    public function __construct()
	{
        parent::__construct();
    }

    public function welcomeAPI(){
        $welcome_screens = $this->getAppContentBlocks('app_welcome_slides');
        $final_data = array(
            'status' => 'success',
            'msg'=> '',
            'result' => $welcome_screens
        );

        return \Response::json($final_data);
    }

    public function homepageAPI()
    {
        $homedata = array();
      //  $sliders = $this->getSliders('app');
        $topStores = AppClass::getStoreByList( config('AppSettingConfig.appd_top_stores') );
        $topCats = AppClass::getCatByList( config('AppSettingConfig.appd_top_categories') );
        $allCategories = DB::table('tb_vendor_categories')->get();
        $allCategories = collect($allCategories)->map(function($x){ return (array) $x; })->toArray();
        $homedata['featured_stores'] = DB::table('tb_vendors')
                                ->where('vendor_featured','Y')
                                ->orderBy('clicks','desc')
                                //->limit(config('settingConfig.hp_featured_stores_count'))
                                ->get();
        $hp_offers_limit = 12;
        $allCategories = DB::table('tb_vendor_categories')->get();
        $allCategories = collect($allCategories)->map(function($x){ return (array) $x; })->toArray();
        $homedata['allVendors']  = $allCategories;
        $homedata['trendingOffers'] 	= DB::table('tb_offers')
                                    ->join('tb_vendors','tb_vendors.vendor_code','=','tb_offers.vendor_code')
                                  //  ->where('offer_expiry', '>', 'NOW()')
                                    ->limit($hp_offers_limit)
                                    ->orderBy('tb_offers.clicks', 'DESC')
                                    ->get();
        $homedata['sliders'] = [];
        $homedata['topStores'] = $topStores;
        $homedata['topCats'] = $topCats;
        $final_data = array(
            'status' => 'success',
            'msg'=> '',
            'result' => $homedata
        );

        return \Response::json($final_data);
    }

	public function homepageCoupons($cat_id)
	{
		$coupons = DB::select(DB::raw("SELECT coupon_id, title, coupon_type, coupon_code, expiry_date, store_id, categories, promo_text, tags, brands, tb_stores.store_id,tb_stores.store_name,tb_stores.offers_count,tb_stores.store_slug,tb_stores.store_logo,tb_stores.cashback_type,tb_stores.cashback as storeCashback, tb_stores.cashback_enabled FROM
        tb_coupons INNER JOIN tb_stores ON tb_coupons.store_id = tb_stores.store_id WHERE expiry_date > CURRENT_TIME  AND
        tb_coupons.coupon_status = 'published' AND FIND_IN_SET({$cat_id} , categories )
        ORDER BY clicks DESC LIMIT ".config('settingConfig.hp_coupon_count').""));

		 $final_data = array(
            'status' => 'success',
            'msg'=> '',
            'result' => $coupons
        );

        return \Response::json($final_data);

	}


    public function getLocations() {
      $getLocations = DB::table('tb_location_master')->get();
      $final_data = array(
             'status' => 'success',
             'msg'=> '',
             'result' => $getLocations
         );

         return \Response::json($final_data);
    }

    public function allStoresAPI()
    {
        $pageInfo = $this->getPageInfo('allStores');
        $allStores = $this->getAllStores('publish');

        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'pageInfo' => $pageInfo,
                'allStores' => $allStores
            )
        );
        return \Response::json($final_data);

    }

    public function allCategoriesAPI()
    {
      //  $pageInfo = $this->getPageInfo('allCats');
        $allCategories = DB::table('tb_vendor_categories')->get();
        $allCategories = collect($allCategories)->map(function($x){ return (array) $x; })->toArray();

        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
            //    'pageInfo' => $pageInfo,
                'allCategories' => $this->buildTree($allCategories,'cat_id')
            )
        );
        return \Response::json($final_data);
    }

    public function allVendorAPI()
    {
      //  $pageInfo = $this->getPageInfo('allCats');
        $allCategories = DB::table('tb_vendors')->get();
        $allCategories = collect($allCategories)->map(function($x){ return (array) $x; })->toArray();
        $filter = [];
        $filter['category']					     = DB::table('tb_vendor_categories')->get();
        $filter['locations']					   = DB::table('tb_location_master')->get();
        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
            //    'pageInfo' => $pageInfo,
                'allVendors' => $allCategories,
                'filters' => $filter
            )
        );
        return \Response::json($final_data);
    }




    public function allStoreCategoriesAPI()
    {
        $pageInfo = $this->getPageInfo('allStoreCats');
        $storeCats = DB::table('tb_store_categories')->orderby('store_cat_id','ASC')->get();

        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'pageInfo' => $pageInfo,
                'allStoreCategories' => $storeCats
            )
        );
        return \Response::json($final_data);

    }


    public function allStoreCategoryAPI($store_cat_id)
    {
        $catInfo = DB::table('tb_store_categories')->where('store_cat_id',$store_cat_id)->first();
        $catStores = $this->getStoreByList($catInfo->store_list);

        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'catInfo' => $catInfo,
                'catStores' => $catStores
            )
        );

        return \Response::json($final_data);

    }

	public function FaqCategoryAPI($faq_code)
    {
        $faqs = DB::table('tb_faqs')->where('faq_cat',$faq_code)->orderBy('faq_seq','ASC')->get();
        $final_data = array(
            'status' => 'success',
            'msg'=> '',
            'result' => array(
                'faqs'=>$faqs
            )
        );
        return \Response::json($final_data);

    }


    public function  getVendorInfo($vendorID)
    {

      $vendorInfo = \DB::table('tb_vendors')->where('tb_vendors.vendor_id',$vendorID)->first();
      $vnedorOffers =  \DB::table('tb_vendors')->join('tb_offers','tb_offers.vendor_code','=','tb_vendors.vendor_code')->where('tb_vendors.vendor_id',$vendorID)->get();
      $final_data = array(
          'status' => 1,
          'msg'=> '',
          'result' => array(
              'vendorInfo' => $vendorInfo,
              'vendroOffers' => $vnedorOffers
          )
      );
      return \Response::json($final_data);
    }

    public function catWiseVendor($catID) {
      $getCatWiseVendors = \DB::table('tb_vendors')->where('vendor_categories',$catID)->get();
      $final_data = array(
          'status' => 1,
          'msg'=> '',
          'result' => array(
              'categoryVendors'=>$getCatWiseVendors,
          )
      );
      return \Response::json($final_data);
    }

	public function allFaqCat()
	{
		$faqCats = DB::table('tb_faq_cats')->get();
		$final_data = array(
				'status' => 'success',
				'msg'=> '',
				'result' => array(
					'faqCategories' => $faqCats
				)
			);
			return \Response::json($final_data);
	}


	public function allTagsAPI()
    {
        $pageInfo = $this->getPageInfo('allTags');
        $tags = DB::table('tb_tags')->orderby('tag_id','ASC')->get();
		$tags = collect($tags)->map(function($x){ return (array) $x; })->toArray();
        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'pageInfo' => $pageInfo,
                'tags' => $this->buildTree($tags,'tag_id')
            )
        );
        return \Response::json($final_data);

    }

	public function allBrandsAPI()
    {
        $pageInfo = $this->getPageInfo('allBrands');
        $brands = DB::table('tb_brands')->orderby('brand_id','ASC')->get();

        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'pageInfo' => $pageInfo,
                'brands' => $brands
            )
        );
        return \Response::json($final_data);

    }

	public function getReferEarnPageAPI()
	{
		$pageInfo = $this->getPageInfo('referearn');
        $referBlocks = $this->getContentBlocks('referearn');
		$settings = array();
		$BonusForJoin = DB::table('tb_bonus_types')->wherebonus_code('join_bonus')->whereenabled('Y')->first();
		 $BonusForRefer = DB::table('tb_bonus_types')->wherebonus_code('referral_bonus')->whereenabled('Y')->first();
		 $settings['BonusForJoin'] = $BonusForJoin->bonus_amount;
		 $settings['BonusForRefer'] = $BonusForRefer->bonus_amount;

		 $settings['ReferralStopped'] = config('settingConfig.referral_shutdown');
		 $settings['ReferralValidity'] = config('settingConfig.referral_valid_date');
		 $settings['ReferralTerms'] = config('settingConfig.referral_terms');

		 $faqs = DB::table('tb_faqs')->where('faq_cat','referral')->orderBy('faq_seq','ASC')->get();
        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'pageInfo' => $pageInfo,
                'referBlocks' => $referBlocks,
				'referSettings' => $settings,
				'faqs' => $faqs
            )
        );
        return \Response::json($final_data);
	}

	public function getHiwPageAPI()
	{
		$pageInfo = $this->getPageInfo('howitworks');
        $hiwBlocks = $this->getContentBlocks('hiw');

			$withdrawtypes = DB::table('tb_payout_types')->whereenabled('Y')->get();
			$testinomials  = DB::table('tb_testimonials')->get();


        $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'pageInfo' => $pageInfo,
                'hiwBlocks' => $hiwBlocks,
				'withdrawTypes' => $withdrawtypes,
				'testinomials' => $testinomials
            )
        );
        return \Response::json($final_data);
	}

	public function getAllSearchResults($keyword)
	{
		  $data['vendors'] = DB::table('tb_vendors')->where('vendor_name','like','%'.$keyword.'%')->get();
      $data['offers'] = DB::table('tb_offers')->join('tb_vendors','tb_vendors.vendor_code','=','tb_offers.vendor_code')->where('offer_title','like','%'.$keyword.'%')->get();
		  $final_data = array(
            'status' => 'success',
            'msg'=> '',
            'result' => array(
                'searchResults'=>$data
            )
        );
        return \Response::json($final_data);
	}

	 public function searchResult($keyword) {

      $data = array( 'coupon'=> array(),'stores'=> array(),'categories'=> array(),'deals'=> array() );
      $data['coupons'] =  DB::table('tb_coupons')
                           ->select('tb_coupons.coupon_id','tb_coupons.title','tb_coupons.coupon_type','tb_coupons.coupon_code','tb_coupons.expiry_date','tb_coupons.store_id','tb_coupons.categories','tb_coupons.promo_text','tb_coupons.tags','tb_coupons.brands','tb_stores.store_name','tb_stores.cashback_enabled','tb_stores.store_slug','tb_stores.store_logo','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_stores.direct_store_link')
                           ->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')->where('title','like','%'.$keyword.'%')
                           ->where('tb_coupons.expiry_date','>', DB::raw('NOW()'))
                           ->where('tb_coupons.coupon_status','published')
                           ->limit( 100 )
						                     ->get();

     $data['stores'] =  DB::table('tb_stores')
                           ->where('store_name','like','%'.$keyword.'%')
                           ->where('store_status','publish')
                           ->limit(100)
                           ->get();

   $data['categories'] =  DB::table('tb_categories')
                         ->where('cat_name','like','%'.$keyword.'%')
                         ->limit(100)
                           ->get();
   $data['deals'] 			=  DB::table('tb_deals')
                         ->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
                         ->where('title','like','%'.$keyword.'%')
                         ->limit(100)
                         ->get();

						 return $data;
  }


  public function generateStoreJSON($store_id)
  {

  }


  public function getCouponsByCategory($cat_id)
  {
	  $filters = $this->getFilters('cat',$cat_id);
	  $filterNames = $this->getFilterNames($filters);
	  $catInfo = $this->getCategoryInfo($cat_id);
	  if($catInfo->parent_id==0)
		  $parent_id = $cat_id;
	  else
			$parent_id = $catInfo->parent_id;

	  $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'catInfo' => $catInfo,
                //'filters' => $filters,
				'filters' => $filterNames,
				'childCats' => $this->getCategoryByParent($parent_id)
            )
        );

        return \Response::json($final_data);
  }

  public function getCouponsByTag($tag_id)
  {

	  $filters = $this->getFilters('tag',$tag_id);

	  $filterNames = $this->getFilterNames($filters);
	  $tagInfo = $this->getTagInfo($tag_id);
	  if($tagInfo->parent_id==0)
		  $parent_id = $tag_id;
	  else
			$parent_id = $tagInfo->parent_id;

	  $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => array(
                'tagInfo' => $tagInfo,
                //'filters' => $filters,
				'filters' => $filterNames,
				'childCats' => $this->getCategoryByParent($parent_id)
            )
        );

        return \Response::json($final_data);
  }

  public function getFilters($type,$type_id)
  {
	  $filters =  array('Fstores'=>null,'Fcats'=>null,'Ftags'=>null,'Fbrands'=>null);

	  $filQry = "SELECT get_unique_items(GROUP_CONCAT(store_id) ) as Fstores ,get_unique_items(GROUP_CONCAT(categories)) as Fcats,get_unique_items(GROUP_CONCAT(tags)) as Ftags,get_unique_items(GROUP_CONCAT(brands)) as Fbrands FROM `tb_coupons` cpn  WHERE coupon_status = 'published' AND expiry_date >= CURRENT_TIME ";
	  if($type=='cat')
		  $filQry .= " AND FIND_IN_SET({$type_id},categories) ";
	  if($type=='tag')
		  $filQry .= " AND FIND_IN_SET({$type_id},tags) ";
	  $fils = DB::select($filQry);
	  if( count($fils) > 0 )
		  $filters = $fils[0];

	  return $filters;
  }

  public function getFilterNames($filters)
	{
		//$tagNames = DB::select("SELECT GROUP_CONCAT(tag_name)  FROM `tb_tags` WHERE tag_id IN (202,188,9,193,181,153,91) ORDER BY FIELD (tag_id,202,188,9,193,181,153,91)");

		//$filterNames =  array('FstoreNames'=>null,'FcatNames'=>null,'FtagNames'=>null,'FbrandNames'=>null);
		$tagNames = null;
		if($filters->Ftags)
		$tagNames = DB::table('tb_tags')->select('tag_name','tag_id')->whereRaw("tag_id IN ( {$filters->Ftags} ) ")->orderByRaw("FIELD(tag_id,{$filters->Ftags}) ")->get();

		$storeNames = null;
		if($filters->Fstores)
		$storeNames = DB::table('tb_stores')->select('store_name','store_id')->whereRaw("store_id IN ( {$filters->Fstores} ) ")->orderByRaw("FIELD(store_id,{$filters->Fstores}) ")->get();

		$catNames = null;
		if($filters->Fcats)
		$catNames = DB::table('tb_categories')->select('cat_name','cat_id')->whereRaw("cat_id IN ( {$filters->Fcats} ) ")->orderByRaw("FIELD(cat_id,{$filters->Fcats}) ")->get();

		$brandNames = null;
		if($filters->Fbrands)
		$brandNames = DB::table('tb_brands')->select('brand_name','brand_id')->whereRaw("brand_id IN ( {$filters->Fbrands} ) ")->orderByRaw("FIELD(brand_id,{$filters->Fbrands}) ")->get();

		$filterNames =  array('Fstores'=>$storeNames,'Fcats'=>$catNames,'Ftags'=>$tagNames,'Fbrands'=>$brandNames);
		return $filterNames;

	}

  public function getCategoryInfo($cat_id)
  {
	 $this->generateCatJSON($cat_id);
	return \DB::table('tb_categories')->where('cat_id',$cat_id)->first();
  }

  public function generateCatJSON($cat_id)
  {
    $coupons = array();
	  $Ocoupons = DB::table('tb_coupons')
    ->select('tb_coupons.coupon_id','tb_coupons.title','tb_coupons.coupon_type','tb_coupons.coupon_code','tb_coupons.expiry_date','tb_coupons.store_id','tb_coupons.categories','tb_coupons.promo_text','tb_coupons.tags','tb_coupons.brands','tb_stores.store_name','tb_stores.store_logo')
    ->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')
    ->whereRaw("FIND_IN_SET({$cat_id},categories)")
    ->where('coupon_status','published')
    ->where('expiry_date','>',DB::Raw('CURRENT_TIME') )->get();
    foreach($Ocoupons as $coupon)
    {
        $coupon->categories = explode(',',$coupon->categories);
        $coupon->tags = explode(',',$coupon->tags);
        $coupon->brands = explode(',',$coupon->brands);
        $coupons[] = $coupon;
    }
  	$filename =  hash('sha256',$cat_id*7);
  	$fp  = fopen(public_path().'/pyrenean/cat_'.$filename.'.json','w+');
  	fwrite($fp,json_encode($coupons));
  	fclose($fp);
	// echo 'generated Cat';
  }

  public function getTagInfo($tag_id)
  {
	 $this->generateTagJSON($tag_id);
	return \DB::table('tb_tags')->where('tag_id',$tag_id)->first();
  }

  public function generateTagJSON($tag_id)
  {
    $coupons = array();
	  $Ocoupons = DB::table('tb_coupons')
    ->select('tb_coupons.coupon_id','tb_coupons.title','tb_coupons.coupon_type','tb_coupons.coupon_code','tb_coupons.expiry_date','tb_coupons.store_id','tb_coupons.categories','tb_coupons.promo_text','tb_coupons.tags','tb_coupons.brands','tb_stores.store_name','tb_stores.store_logo')
    ->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')
    ->whereRaw("FIND_IN_SET({$tag_id},tags)")
    ->where('coupon_status','published')
    ->where('expiry_date','>',DB::Raw('CURRENT_TIME') )->get();
    foreach($Ocoupons as $coupon)
    {
        $coupon->categories = explode(',',$coupon->categories);
        $coupon->tags = explode(',',$coupon->tags);
        $coupon->brands = explode(',',$coupon->brands);
        $coupons[] = $coupon;
    }
  	$filename =  hash('sha256',$tag_id*7);
  	$fp  = fopen(public_path().'/pyrenean/tag_'.$filename.'.json','w+');
  	fwrite($fp,json_encode($coupons));
  	fclose($fp);
	// echo 'generated Cat';
  }


   public function getCouponInfo($coupon_id)
   {
	   $coupon = DB::table('tb_coupons')->select('tb_coupons.coupon_id','tb_coupons.title','tb_coupons.coupon_type','tb_coupons.coupon_code','tb_coupons.expiry_date','tb_coupons.store_id','tb_coupons.categories','tb_coupons.promo_text','tb_coupons.tags','tb_coupons.brands','tb_stores.store_name','tb_stores.cashback_enabled','tb_stores.store_slug','tb_stores.store_logo','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_stores.direct_store_link')->join('tb_stores','tb_stores.store_id','=','tb_coupons.store_id')->where('coupon_id',$coupon_id)->first();

	   if( $coupon )
	   {
		         $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => $coupon
        );

        return \Response::json($final_data);
	   }
	   else{

		         $final_data = array(
            'status' => 0,
            'msg'=> '',
            'result' => null
        );

        return \Response::json($final_data);
	   }
   }

   public function getDealInfo($deal_id)
   {


	   $deal = DB::table('tb_deals')->select('tb_deals.*','tb_stores.store_name','tb_stores.cashback','tb_stores.user_split','tb_stores.cashback_enabled','tb_stores.store_slug','tb_stores.store_logo','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_stores.direct_store_link')
        ->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')->where('deal_id',$deal_id)->first();

	   if( $deal )
	   {
		         $final_data = array(
            'status' => 1,
            'msg'=> '',
            'result' => $deal
        );

        return \Response::json($final_data);
	   }
	   else{

		         $final_data = array(
            'status' => 0,
            'msg'=> '',
            'result' => null
        );

        return \Response::json($final_data);
	   }
   }

   public function getAppLang()
   {
	   $lang_path = base_path('/resources/lang/en/app/');

	   $langJson = array(
	   'common' => include $lang_path.'common.php',
	   'home' => include $lang_path.'home.php',
	   'alerts' => include $lang_path.'alerts.php',
	   );

	   return \Response::json($langJson);

   }

   public function getAppStyles()
   {
		$styleJson = include( base_path('/config/AppStyleConfig.php') );
		return \Response::json($styleJson);
   }

   public function getAppSettings()
   {
	   $settingsJson = include( base_path('/config/AppSettingConfig.php') );
		return \Response::json($settingsJson);
   }
}
