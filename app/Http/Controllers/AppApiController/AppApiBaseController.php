<?php namespace App\Http\Controllers\AppApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect;
use DB;
use App\Helpers\AppClass;

class AppApiBaseController extends Controller {

    public function __construct()
	{
        parent::__construct();
    }

    public function makeLog($event,$data,$userkey)
    {

    }

    public function getSliders($type)
    {
        return DB::table('tb_sliders')
																		->select('tb_stores.store_name','tb_stores.store_logo','tb_stores.cashback_enabled','tb_stores.cashback as storeCashback','tb_stores.cashback_type','tb_sliders.*','tb_stores.cashback_enabled')
																		->join('tb_stores','tb_stores.store_id','=','tb_sliders.store_id')
																		->whereenabled('Y')->orderBy('slider_position','ASC')
																		->where('slider_type',$type)
																		->get();
    }

    public function getAppContentBlocks($block_type)
    {
        return DB::table('tb_content_block')->where('block_type',$block_type)->get();
    }
  //
  //
  //
  //   public function getContentBlocks($block_type)
  //   {
  //       return DB::table('tb_content_block')->where('block_type',$block_type)->get();
  //   }
  //
    public  function buildTree(array $elements, $ele_key, $parentId = 0) {
    $branch = array();

    //print_r($elements);
    //die();

    foreach ($elements as $element) {
      //print_r($element);
      //die();

      //$element = $element->toArray();
        if ($element['parent_cat'] == $parentId) {
            $children = $this->buildTree($elements,$ele_key, $element[$ele_key]);
            if ($children) {
              $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
    }
  //
  //
    public function getPageInfo($filename)
    {
        $pageInfo = DB::table('tb_pages')->where('filename',$filename)->first();
        return $pageInfo;
    }

  //   public function getAllStores($status)
  //   {
  //       $stores = DB::table('tb_stores')->where('store_status',$status)->get();
  //       return $stores;
  //   }
  //
	// public function getCategoryByParent($parent_id)
	// {
	// 	$childCats = DB::table('tb_categories')->select('cat_name','cat_id')->where('parent_id',$parent_id)->get();
	// 	return $childCats;
	// }
  //
  //   public function getStoreByList($storeList) {
  //       $data = [];
  //       if(!empty($storeList)) {
  //                   $storeIds = AppClass::filterID($storeList);
  //                   $data = DB::table('tb_stores')->whereIn('store_id',$storeIds)->orderByRaw('FIELD(store_id,'.$storeList.')')->get();
  //           }
  //           return $data;
  //   }

}
