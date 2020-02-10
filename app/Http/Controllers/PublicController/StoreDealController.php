<?php

namespace App\Http\Controllers\PublicController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Helpers\AppClass;

class StoreDealController extends Controller
{
    public function index($slug = NULL)
    {

      $data['store']            = DB::table('tb_stores')->where('store_status','publish')->wheredeal_slug($slug)->first();
	    $storeID                  =	$data['store']->store_id;
	    DB::table('tb_stores')->where('store_id', $storeID)->increment('clicks');
      // $data['dealsData']        = DB::table('tb_deals')
      //                               ->select('tb_stores.*','tb_deals.title','tb_deals.product_image','tb_deals.store_id','tb_deals.deal_cashback','tb_deals.deal_id','tb_deals.mrp','tb_deals.deal_price','tb_deals.product_link','tb_deals.categories','tb_deals.expiry','tb_deals.updated_date','tb_deals.clicks')
      //                               ->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')->where('tb_deals.store_id', $data['store']->store_id)->limit(config('settingConfig.list_store_deal_count'))->get();

      // $data['dealsData']        = DB::table('tb_deals')->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
      //                             ->where('tb_deals.store_id', $data['store']->store_id)
      //                             ->whereDate('expiry', '>', date('Y-m-d H:i:s'))->limit(config('settingConfig.list_store_deal_count'))
      //                             ->orderBy('tb_deals.deal_id', 'DESC')->get();

      $data['dealsData']        = DB::table('tb_deals')->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')
                                  ->where('tb_deals.store_id', $data['store']->store_id)
                                  ->limit(config('settingConfig.list_store_deal_count'))
                                  ->orderBy('tb_deals.deal_id', 'DESC')->get();

      $data['dealsDataTotal']   = DB::table('tb_deals')->join('tb_stores','tb_stores.store_id','=','tb_deals.store_id')->where('tb_deals.store_id', $data['store']->store_id)->count();
      $data['similar_store']    = DB::select(DB::raw("SELECT DISTINCT ts.*  FROM `tb_store_categories` tc, `tb_stores` ts  WHERE FIND_IN_SET('{$storeID}',store_list) AND store_id <> '.$storeID.' AND FIND_IN_SET (store_id,store_list) ORDER BY RAND() LIMIT 5"));
      $data['cashbackStru']     = DB::table('tb_store_cashback')->wherestore_id(  $data['store']->store_id )->get();
      $data['cat']              = DB::select('SELECT  get_unique_items(GROUP_CONCAT(categories)) as cat FROM `tb_deals` cpn WHERE expiry >= CURRENT_TIME  AND store_id  = '. $data['store']->store_id.'');

      $catiDs 							   = $this->RemoveFilterComma($data['cat'][0]->cat);
      $data['getfCats']   	   = DB::table('tb_categories')->whereIn('cat_id',explode(',',$catiDs))->get();


      return view('public.store-deal.index',compact('data'));
    }


}
