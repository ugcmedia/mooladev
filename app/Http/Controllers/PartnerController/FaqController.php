<?php
namespace App\Http\Controllers\MemberController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Member;
use Session;
use Auth;
use Validator;
use Hash;
/**
 *
 */
class FaqController extends Controller
{

    public function index() {
      $data['page_data']    = DB::table('tb_cashback_widgets')->wherecb_page('FAQ')->first();
      $data['faqCats']      = DB::table('tb_faq_cats')->orderBy('cat_sequence','ASC')->get();
      $data['faq']          = DB::table('tb_faqs')->wherestatus('Y')->orderBy('faq_seq','ASC')->get();
        return view('member-dash.faq.index',compact('data'));
    }



}
