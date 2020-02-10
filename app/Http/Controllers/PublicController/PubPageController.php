<?php
namespace App\Http\Controllers\PublicController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Helpers\AppClass;
// use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
// use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
// use Ivory\GoogleMap\Map;
// use Ivory\GoogleMap\Base\Coordinate;
// use Ivory\GoogleMap\Overlay\Animation;
// use Ivory\GoogleMap\Overlay\Icon;
// use Ivory\GoogleMap\Overlay\Marker;
// use Ivory\GoogleMap\Overlay\MarkerShape;
// use Ivory\GoogleMap\Overlay\MarkerShapeType;
// use Ivory\GoogleMap\Overlay\Symbol;
// use Ivory\GoogleMap\Overlay\SymbolPath;
// use Ivory\GoogleMap\Overlay\InfoWindow;
// use Ivory\GoogleMap\Overlay\InfoWindowType;
// use Ivory\GoogleMap\Base\Size;
// use Ivory\GoogleMap\Base\Point;
use Mapper;

class PubPageController extends Controller
{

	public $req;
	public $slug;
	public $location_allowed;
	public $lat;
	public $long;

	public function __construct(Request $request)
	{
		parent::__construct();


		$this->data['pageLang'] = 'en';
		if(\Session::get('lang') != '')
		{
			$this->data['pageLang'] = \Session::get('lang');
		}
		$this->req = $request;

	}


	public function index(Request $request,$cat = null,$location_allow = null,$lat = null,$long = null)
	{

		 $this->slug = $cat;
		 $this->location_allowed = $location_allow;
		 $this->lat    = $lat;
		 $this->long 	 = $long;

	   $page = $request->segment(1);

		 //dd($page);

		\DB::table('tb_pages')->where('alias',$page)->update(array('views'=> \DB::raw('views+1')));

		if($page !='') {

			$sql = \DB::table('tb_pages')->where('alias','=',$page)->where('status','=','enable')->first();

			$funcname = $sql->filename;

			// dd($funcname);

			if($funcname=='joinnow' && Auth::guard('member')->check() )
				return redirect('/member/overview/');

			if($funcname=='referearn' && Auth::guard('member')->check() )
				return redirect('/member/refer-and-earn/');

			if($funcname ==  'allBrands' || $funcname ==  'allStores' || $funcname ==  'allCats' || $funcname ==  'allStoreCats' || $funcname ==  'allTags' || $funcname == 'howitworks'  ||
					$funcname == 'referearn' || $funcname == 'contactUs' || $funcname == 'DOD' || $funcname == 'business' || $funcname == 'joinnow'
					|| $funcname  == 'faq' || $funcname == 'storedeal' || $funcname == 'maintenance' || $funcname == 'blocked' || $funcname == 'sitemap' ||
					 $funcname == 'WhatsApp' || $funcname == 'nearme' || $funcname == 'aboutus' || $funcname ==  'becomepartner')
		 {
					$this->$funcname($funcname);
			}
			else
			 {

				$this->data['title'] = $sql->title ;
				$this->data['subtitle'] = $sql->sinopsis ;
							if(file_exists(base_path().'/resources/views/public/'.config('sximo.cnf_theme').'/template/'.$sql->filename.'.blade.php') && $sql->filename !='')
							{
								$page_template = 'public.'.config('sximo.cnf_theme').'.template.'.$sql->filename;
							} else {
								$page_template = 'public.'.config('sximo.cnf_theme').'.template.page';
							}

				//dd($page_template);
				//echo $page_template;

				$this->data['pages'] = $page_template;

				$this->data['pageID'] = $sql->pageID;
				$this->data['image'] 	= $sql->image;

				$this->data['content'] = \PostHelpers::formatContent($sql->note);
				$this->data['note'] = $sql->note;
				$page = 'public.'.config('sximo.cnf_theme').'.index' ;

				return view( $page, $this->data);
			}
		}
		else
			return view('errors.404');
	}

	// All Brand Page
	public function allBrands($fileName)
	{

		if(config('settingConfig.module_brands') != 'Y') {
			echo view('errors.404');
			die;
		}
		$getBrand = DB::table('tb_brands')->where('enabled','=','Y')->get();
		//dd($getBrand);
		$data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();

		echo view('public.allbrands.index',compact('getBrand','data'));
	}


    public function allStores($fileName)
    {
			$getStore = DB::table('tb_stores')->where('store_status','publish')->get();
			$data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();

    	echo view('public.allstore.index',compact('getStore','data'));
    }

	 public function allCats($fileName)
    {
    		$getcat= DB::table('tb_categories')->get();
			$data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
    	echo view('public.allcategory.index',compact('getcat','data'));
    }


	 public function allStoreCats($fileName)
    {
			$data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
    	echo view('public.allstorecat.index',compact('data'));
    }

		// All Tags Page
		public function allTags($fileName) {
			if(config('settingConfig.module_tags') != 'Y') {
				echo view('errors.404');
				die;
			}
			$gettags= DB::table('tb_tags')->where('enabled','=','Y')->get();
 			$data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
     	echo view('public.alltags.index',compact('gettags','data'));
     }

		public function howitworks($fileName) {

			$data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
			// $data['withdrawtype'] = DB::table('tb_payout_types')->whereenabled('Y')->get();
			$data['testinomial']  = DB::table('tb_content_block')->whereblock_type('testi_hiw')->get();
			$data['hiw_images']       = DB::table('tb_content_block')->whereblock_type('hp_hiw')->get();
			$data['faq']          = DB::table('tb_faqs')->wherefaq_cat('hiw')->wherestatus('Y')->get();

			echo view('public.howitworks.index',compact('data'));
		}

		public function becomepartner($fileName) {
			// dd('$fileName');
			$data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
			$data['testinomial']  = DB::table('tb_content_block')->whereblock_type('testi_hiw')->get();;
			$data['hiw_images']       = DB::table('tb_content_block')->whereblock_type('hp_hiw')->get();
			$data['faq']          = DB::table('tb_faqs')->wherefaq_cat('hiw')->wherestatus('Y')->get();
			$data['hp_stats']     = DB::table('tb_content_block')->whereblock_type('hp_stats')->get();

			$data['partners'] = DB::table('tb_vendors')->where('vendor_featured','Y')->orderBy('clicks','desc')->get();

			echo view('public.partner.index',compact('data'));
		}

	 public function	referearn ($fileName) {

		 $data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 // $data['BonusForJoin'] = DB::table('tb_bonus_types')->wherebonus_code('join_bonus')->whereenabled('Y')->first();
		 // $data['BonusForRefer'] = DB::table('tb_bonus_types')->wherebonus_code('referral_bonus')->whereenabled('Y')->first();
		  $data['refer_hiw']    = DB::table('tb_content_block')->whereblock_type('refer_hiw')->get();
		 $data['refer_faq']		 = DB::table('tb_faqs')->where('faq_cat','referral')->get();
		 // $data['refer_hiw']     = DB::table('tb_content_block')->whereblock_type('refer_hiw')->get();
		 echo view('public.referandearn.index',compact('data'));

	 }

	 public function	aboutus ($fileName) {
		 $data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 // $data['BonusForJoin'] = DB::table('tb_bonus_types')->wherebonus_code('join_bonus')->whereenabled('Y')->first();
		 // $data['BonusForRefer'] = DB::table('tb_bonus_types')->wherebonus_code('referral_bonus')->whereenabled('Y')->first();
		 $data['referEarn']    = DB::table('tb_content_block')->whereblock_type('aboutus')->get();
		 $data['refer_faq']		 = DB::table('tb_faqs')->where('faq_cat','referral')->get();
$data['testinomial']  = DB::table('tb_content_block')->whereblock_type('testi_hiw')->get();


			$data['hp_stats']   = DB::table('tb_content_block')
														->whereblock_type('hp_stats')
															->get();

		 echo view('public.aboutus.index',compact('data'));
	 }

	 public function contactUs($fileName) {
		 $data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 echo view('public.contactus.index',compact('data'));
	 }

	 public function blocked($fileName) {
		 $data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 echo view('errors.blocked',compact('data'));
	 }

	 public function business($fileName) {
		 $data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 echo view('public.business.index',compact('data'));
	 }

	 public function DOD($fileName) {
		 $hp_deal_limit = 12;
	 		if(!empty(config('settingConfig.list_dod_count'))) {
	 			$hp_deal_limit = config('settingConfig.list_dod_count');
	 	 }

		 $request                  = new Request();
		 $data['pageInfo']     		 = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 $dealData   				 	     = DB::table('tb_deals')
 																			->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
 																			->orderBy('tb_deals.updated_date', 'DESC')
																			->whereRaw('expiry > CURRENT_TIME')
 																			->paginate($hp_deal_limit);

		 $storeCat             	   = DB::select("SELECT get_unique_items(GROUP_CONCAT(store_id)) as store,get_unique_items(GROUP_CONCAT(categories)) as cat FROM `tb_deals` cpn WHERE expiry >= CURRENT_TIME");
		 $storeiDs 								 = $this->RemoveFilterComma($storeCat[0]->store);
		 $catiDs 							     = $this->RemoveFilterComma($storeCat[0]->cat);

		 $data['getfCats']   	    = DB::table('tb_categories')->whereIn('cat_id',explode(',',$catiDs))->get();
		 $data['getfStores']    	= DB::table('tb_stores')->whereIn('store_id',explode(',',$storeiDs))->get();

		 $data['dealsData']				= DB::table('tb_deals')
													      ->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
													      ->limit($hp_deal_limit)
													      ->orderBy('tb_deals.updated_date', 'DESC')
													      ->get();

		 $data['getfTag']     	   = [];
		 $data['getfBrand']        = [];
		 //define Active class for tab ussing this logic
		 $data['activeStore'] 	   = true;
		 $data['activeCats'] 			 = false;
		 $data['activeTag']				 = false;
		 $data['activeBrand'] 		 = false;
		 $filter 									 = false;
		 if($this->req->ajax()){
			 $filter 									 = false;
			 $pushFArray 							 = [];
			 $dealData   				 	     = DB::table('tb_deals')
																				 ->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
																				 ->orderBy('tb_deals.clicks', 'DESC')
																				 ->whereRaw('expiry > CURRENT_TIME');

																				 // ->paginate(8);

      //if filter store
			 if($this->req->storeFilter != '' ) {
	 				$filterComma = $this->RemoveFilterComma($this->req->storeFilter);
	 			 	$getStores   = DB::table('tb_stores')->whereIn('store_id',explode(',',$filterComma))->get();
	 				foreach ($getStores as $key => $value) {
	 					array_push($pushFArray,['name' => $value->store_name,'id' => $value->store_id,'type' => 'store']);
	 				}
				 	/* $explodeSfIds	=	 AppClass::filterID($this->req->storeFilter);
					for($sf=0; $sf<Count($explodeSfIds); $sf++) {
							if($sf!=0) {
									$dealData  = $dealData->Where('tb_deals.store_id',$explodeSfIds[$sf]);
							}
					 } */

					 $dealData  = $dealData->whereIn('tb_deals.store_id',explode(',',$filterComma));

					 $filter 		  = true;
	 		 }

			 //if filter categories
			 if($this->req->catFilter != '' ) {
			 	 $filterComma = $this->RemoveFilterComma($this->req->catFilter);
			 	 $getCats     = DB::table('tb_categories')->whereIn('cat_id',explode(',',$filterComma))->get();
			 	 foreach ($getCats as $key => $value) {
			 		 array_push($pushFArray,['name' => $value->cat_name,'id' => $value->cat_id,'type' => 'cat']);
			 	 }
				 $explodeCfIds	=	 AppClass::filterID($this->req->catFilter);

				  $dealData->where(function($startQuery) use ($explodeCfIds) {
						for($cf=0; $cf<Count($explodeCfIds); $cf++)
						$startQuery->OrwhereRaw('FIND_IN_SET('.$explodeCfIds[$cf].',tb_deals.categories)');
					  });

			 	 $filter = true;
			 }
			 //echo $dealData->toSql(); die;
			 $dealData 				=	$dealData->paginate($hp_deal_limit);

			 echo view('public.cashback-partials..deal-partials.hottest_deal_ajax_tab', [
             'dealData' => $dealData,
						 'filtered'	=> $pushFArray,
						 'dodPage'  => true,
             'filter'   => $filter]);
		 }
		 else {
			 $dodPage        = true;
			 echo view('public.deals.index',compact('data','filter','dealData','dodPage'));

		 }

	 }

	 public function joinnow($fileName) {



		 if(isset($_GET['referal_code'])) {
			 Session::put('referCode',$_GET['referal_code']);
		 }

		 $data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 $data['leftContent']  = DB::table('tb_content_block')->whereblock_type('joinus_page')->get();
		 // $data['bonus_info']	 = DB::table('tb_bonus_types')->where('bonus_code','join_bonus')->first();
		 echo view('public.joinnow.index',compact('data'));

	 }

	 public function faq($fileName) {
		 $data['pageInfo']     = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 $data['faqCats']      = DB::table('tb_faq_cats')->orderBy('cat_sequence','ASC')->get();
		 $data['faq']          = DB::table('tb_faqs')->wherestatus('Y')->orderBy('faq_seq','ASC')->get();
		 echo view('public.faq.index',compact('data'));
	 }

	 public function storedeal($fileName) {

		 $data['pageInfo']        = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 $data['store']            = DB::table('tb_stores')->wherestore_id($slug)->first();
		 $data['dealsData']        = DB::table('tb_deals')->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')->where('tb_deals.store_id',$slug)->get();
		 $data['cashbackStru']     = DB::table('tb_store_cashback')->wherestore_id($slug)->get();
		 $data['cat']              = DB::select('SELECT  get_unique_items(GROUP_CONCAT(categories)) as cat FROM `tb_deals` cpn WHERE expiry >= CURRENT_TIME  AND store_id  = '.$slug.'');

		 $catiDs 							   = $this->RemoveFilterComma($data['cat'][0]->cat);
		 $data['getfCats']   	   = DB::table('tb_categories')->whereIn('cat_id',explode(',',$catiDs))->get();

		 echo view('public.store-deal.index',compact('data'));
	 }

	 public function maintenance($fileName) {

		 $data['pageInfo']        = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 echo view('public.maintenance.index',compact('data'));
	 }

	 public function sitemap($fileName) {
		 $data['pageInfo']        = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 $data['pages']           = DB::table('tb_pages')->wherepagetype('page')->orderBy('title','Asc')->limit(25)->get();
		 $data['posts']           = DB::table('tb_pages')->wherepagetype('post')->orderBy('updated','desc')->limit(25)->get();
		 $data['stores']          = DB::table('tb_stores')->orderBy('clicks','desc')->limit(25)->get();
		 $data['cats']            = DB::table('tb_categories')->orderBy('clicks','desc')->limit(25)->get();
		 $data['brands']      		= DB::table('tb_brands')->whereenabled('Y')->orderBy('clicks','desc')->limit(25)->get();
		 $data['tags']      	    = DB::table('tb_tags')->whereenabled('Y')->orderBy('clicks','desc')->limit(25)->get();
		 $data['storeCats']       = DB::table('tb_store_categories')->orderBy('updated_date','desc')->limit(25)->get();

		 echo view('public.site-map.index',compact('data'));
	 }

	 public function WhatsApp($fileName) {
		 $data['pageInfo']        = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
		 $data['faq']          		= DB::table('tb_faqs')->wherefaq_cat('whatsapp')->wherestatus('Y')->get();

		 echo view('public.whatsup.index',compact('data'));

	 }

	 public function nearmebkp($fileName) {
			 $userLocation[]		      = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
			 $lat   									= $userLocation[0]['geoplugin_latitude'];
			 $lng   									= $userLocation[0]['geoplugin_longitude'];

			 $oStores = array();
			 $store_cat = $this->slug;
			 $data['oStores'] = $oStores;
			 $data['stores'] = array();

			 $data['pageInfo']        = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
			 $data['store_cat']				= DB::table('tb_store_categories')->where('offline_mode','Y')->limit(6)->get();
			 $data['showSide'] 				= true;
			 $store_list = DB::table('tb_store_categories')->where('slug',$store_cat)->value('store_list');

					if($store_cat && $store_cat != '' && $store_cat != 'null')
			 {
				 $store_list_and = ' AND st.store_id IN ('.$store_list.') ';
			 }
			 else
			$store_list_and = '';

			if($this->lat) {
				$loc_store_list = array();
				Mapper::map($this->lat,$this->long, ['zoom' => 6,'eventAfterLoad' => 'attachMapListeners(map);']);
				/*  $outlat_data =  DB::select('SELECT st.store_id,st.store_name,st.store_logo, st.map_icon, ou.*, ((outlet_lat-'.$this->lat.')*(outlet_lat-'.$this->lat.')) + ((outlet_long - '.$this->long.')*(outlet_long -'.$this->long.'))
					 AS distance_in_km FROM tb_store_outlets ou, tb_stores st WHERE ou.store_id = st.store_id '.$store_list_and.' ORDER BY distance_in_km ASC'); */

					 $outlat_data =  DB::select('SELECT st.store_id,st.store_name,st.store_logo, st.map_icon, ou.*, ( ST_Distance_Sphere( point('.$this->long.','.$this->lat.'),point(outlet_long,outlet_lat) ) /1000 )
					 AS distance_in_km FROM tb_store_outlets ou, tb_stores st WHERE ou.store_id = st.store_id '.$store_list_and.' ORDER BY distance_in_km ASC');


			  if($this->location_allowed === true) {
						 	$data['showSide'] = false;
					 }
				 foreach ($outlat_data as $key => $value) {
					 $loc_store_list[] = $value->store_id;
					 $oStores[$value->store_id] = round($value->distance_in_km,2);
					 Mapper::marker($value->outlet_lat, $value->outlet_long,[ 'title'=>$value->outlet_name, 'icon' => array('url' =>asset('uploads/images/map-markers/'.$value->map_icon.''), 'size'=>[50,50]  ), 'scale' => 1000, 'eventClick'=>'mapHlStore('.$value->store_id.') ; ' ]);
				 }
				 	 $data['oStores'] = $oStores;



				 $data['stores'] = DB::table('tb_stores')->where('offline_mode','Y')->whereIn('store_id',array_unique($loc_store_list))->limit(10)->get();
			echo view('public.nearme.index',compact('data','userLocation'));

			}





			else {
				Mapper::map($lat, $lng, ['zoom' => 6,'marker' => false]);
				echo view('public.nearme.index',compact('data','userLocation'));
			}

	 }

	 public function nearme($fileName) {
			 $userLocation[]		      = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
			 $lat   									= $userLocation[0]['geoplugin_latitude'];
			 $lng   									= $userLocation[0]['geoplugin_longitude'];
			 // dd($lat.' '. $lng);
			 // $map = new Map();
			 // $mapHelper = MapHelperBuilder::create()->build();
			 // $apiHelper = ApiHelperBuilder::create()
			 //     ->setKey('AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc')
			 //     ->build();
			 // $map->setAutoZoom(false);
		 	 // $map->setHtmlAttribute('class', 'near-me-map');
			 // $map->setMapOption('zoom', 15	);

			 // $infoWindow = new InfoWindow('content', InfoWindowType::INFO_BOX, new Coordinate());
			 // $infoWindow->setVariable('info_window');
			 // $infoWindow->setContent('<div style="background:white;height:70px;width:70px; border-radius:50%; text-align:center"><img src="'.asset('public_assets/images/amazon.png').'" width="70"></div>');
			 // $infoWindow->setPosition(new Coordinate($lat, $lng));
			 // $infoWindow->setPixelOffset(new Size(1.1, 2.1));
			 // $infoWindow->setOpen(true);
			 // $infoWindow->setAutoClose(true);
			 //
			 // $infoWindow->setOption('zIndex', 10);
			 // $map->getOverlayManager()->addInfoWindow($infoWindow);

			 // $icon = new Icon(
			 //     Icon::DEFAULT_URL
			 // );
			 // $icon->setUrl('https://maps.gstatic.com/mapfiles/markers/marker.png');
			 // $icon->setSize(new Size(50, 50));
			//  $symbol = new Symbol(
			//     SymbolPath::CIRCLE,
			//     new Point(20, 34),
			//     new Point(0, 0),
			//     ['scale' => 10]
			// );
			// $symbol->setVariable('symbol');
			// $symbol->setAnchor(new Point(12, 32));
			//
			//  $icon = new Icon();
			//  $icon = new Icon(
			//      Icon::DEFAULT_URL,
			//      new Point(40, 54),
			//      new Point(5, 4),
			//      new Size(100, 100),
			//      new Size(50, 80)
			//  );
			//  $icon->setVariable('icon');
			//  $icon->setUrl('https://dealswoot.ga/uploads/images/store/bewakoof.png');
			//  $icon->setSize(new Size(10, 10));
			//
			// 	$marker = new Marker(
			// 	    new Coordinate(),
			// 	    Animation::BOUNCE,
			// 	    new Icon(),
			// 	    new Symbol(SymbolPath::CIRCLE),
			// 	    new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.1, 1.4]),
			// 	    ['clickable' => false]
			// 	);
			// 	$marker->setVariable('marker1');
			// 	$marker->setPosition(new Coordinate($lat, $lng));
			// 	$marker->setAnimation(Animation::DROP);
			// 	$marker->setIcon($icon);
			//
			// 	$marker->setOption('flat', true);
			//
			// 	$marker2 = new Marker(
			// 			new Coordinate(),
			// 			Animation::BOUNCE,
			// 			new Icon(),
			// 			new Symbol(SymbolPath::CIRCLE),
			// 			new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.1, 1.4]),
			// 			['clickable' => false]
			// 	);
			//
			// 	$marker2->setVariable('marker2');
			// 	$marker->setPosition(new Coordinate(23.0333,72.6167));
			// 	$marker2->setAnimation(Animation::DROP);
			// 	$marker2->setIcon($icon);
			//
			// 	$marker2->setOption('flat', true);
			//
			// 	$map->getOverlayManager()->addMarker($marker);
			// 	$map->getOverlayManager()->addMarker($marker2);



		 	 // Sets the center
	//		 $data['map']							= $map;


			 $store_cat = $this->slug;
			 $data['store_cat_name'] = ucfirst($store_cat);

			 $data['pageInfo']        = DB::table('tb_pages')->wherefilename($fileName)->where('status','=','enable')->first();
			 //$data['store_cat']				= DB::table('tb_store_categories')->where('offline_mode','Y')->limit(6)->get();
			 $data['showSide'] 				= true;
			  $store_list = DB::table('tb_store_categories')->where('slug',$store_cat)->value('store_list');

			if($store_cat && $store_cat != '' && $store_cat != 'null')
			 {
				 $store_list_and = ' AND st.store_id IN ('.$store_list.') ';
			 }
			 else
			$store_list_and = '';

			if(!$this->lat)
			{
				$this->lat = $lat;
				$this->long = $lng;
			}

			if($this->lat) {
				$data['myLat'] = $this->lat;
				$data['myLong'] = $this->long;

				$loc_store_list = array();
				Mapper::map($this->lat,$this->long, ['zoom' =>  config('settingConfig.nearme_map_zoom') ]);
				/*  $outlat_data =  DB::select('SELECT st.store_id,st.store_name,st.store_logo, st.map_icon, ou.*, ((outlet_lat-'.$this->lat.')*(outlet_lat-'.$this->lat.')) + ((outlet_long - '.$this->long.')*(outlet_long -'.$this->long.'))
					 AS distance_in_km FROM tb_store_outlets ou, tb_stores st WHERE ou.store_id = st.store_id '.$store_list_and.' ORDER BY distance_in_km ASC'); */

					 $outlat_data =  DB::select('SELECT st.store_id,st.store_name,st.store_logo, st.map_icon,st.offers_count,st.store_slug, st.cashback_enabled,  ou.*,
					 ( ST_Distance_Sphere( point('.$this->long.','.$this->lat.'),point(outlet_long,outlet_lat) ) /1000 )
					 AS distance_in_km FROM tb_store_outlets ou, tb_stores st WHERE ou.store_id = st.store_id AND ( ST_Distance_Sphere( point('.$this->long.','.$this->lat.'),point(outlet_long,outlet_lat) ) /1000 ) < '.config('settingConfig.nearme_km_range').' '.$store_list_and.' ORDER BY distance_in_km ASC');

			  if($this->location_allowed === true) {
						 	$data['showSide'] = false;
					 }
				 foreach ($outlat_data as $key => $value) {
					 $loc_store_list[] = $value->store_id;

					 Mapper::marker($value->outlet_lat, $value->outlet_long,[ 'title'=>$value->outlet_name, 'icon' => array('url' =>asset('uploads/images/map-markers/'.$value->map_icon.''), 'size'=>[50,50]  ), 'scale' => 1000, 'eventClick'=>'mapHlStore('.$value->outlet_id.') ; ' ]);
				 }

				$store_list_csv = implode(',',array_unique($loc_store_list));
				$data['outlat_data'] = $outlat_data;
				$data['store_cat']				= DB::select("SELECT * FROM `tb_store_categories` sc ,  `tb_stores` ts   WHERE  FIND_IN_SET(ts.store_id,'{$store_list_csv}') AND FIND_IN_SET(ts.store_id,sc.store_list) AND sc.offline_mode = 'Y'");
				 //$data['stores'] = DB::table('tb_stores')->where('offline_mode','Y')->whereIn('store_id',array_unique($loc_store_list))->limit(10)->get();
			echo view('public.nearme.index',compact('data','userLocation'));

			}

			/* else {
				Mapper::map($lat, $lng, ['zoom' => 6,'marker' => false]);
				echo view('public.nearme.index',compact('data','userLocation'));
			} */

	 }

}
