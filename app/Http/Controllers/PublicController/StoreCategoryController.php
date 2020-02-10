<?php

namespace App\Http\Controllers\PublicController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class StoreCategoryController extends Controller
{
    public function index($slug = NULL)
    {

    	$sql = "SELECT * FROM `tb_store_categories` sc, `tb_stores` s WHERE FIND_IN_SET(store_id,sc.store_list) ";

    	if(!empty($slug)) {
    		$sql .= " and slug = '".$slug."'";
    	}
    	$sql .= " order by store_name asc";

    	// echo $sql;


    	$stores  = DB::select($sql);

		$sql = "SELECT * FROM `tb_store_categories` sc WHERE 1=1 ";
		if(!empty($slug)) {
    		$sql .= " and slug = '".$slug."'";
    	}
		$cats  = DB::select($sql);
        // dd($stores);
    	$data = array();
    	if(count($cats) > 0) {
            $data['catid'] = $cats[0]->store_cat_id;
    		$data['catename'] = $cats[0]->store_cat_name;
        $data['cateslug'] = $cats[0]->slug;
    		$data['desc'] = $cats[0]->main_desc;
			$data['banner_img'] = $cats[0]->banner_img;
    		$data['stores'] = $stores;
            $data['caticon'] = $cats[0]->store_cat_icon;
            $data['main_desc'] = $cats[0]->main_desc;
            $data['h1_tag'] = $cats[0]->h1_tag;

    	}
      // echo "<pre>";
      // print_r($data);
      // die();

    	// if ($store_id_list!=NULL) {
    	// 	$fashions= DB::table('tb_store_categories')->get();
    	// }
    	// else
    	// {
    	// 	$fashions= DB::table('tb_store_categories')->whereIn('store_list', [1, 2, 3])->get();
    	// }

    	// dd($fashions);
    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";
    	// die();

    	return view('public.store-category.index',compact('data'));
    }

}
