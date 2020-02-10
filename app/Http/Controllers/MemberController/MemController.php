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
use App\Helpers\AppClass;
/**
 *
 */
class MemController extends Controller
{

    public function index()
    {
      //    $data['page_data']     = DB::table('tb_cashback_widgets')->wherecb_page('Profile')->first();


  $data['page_data']     = '';
          return view('member-dash.members.index',compact('data'));
    }

    public function updateProfile(Request $request,Member $member,$id) {
          $findMember = $member->find($id);


          if($request->hasFile('profile'))
         {
				 $file = $request->profile;
				 //getting timestamp
				 $extension = $request['profile']->getClientOriginalExtension(); // getting image extension
				 $fileName = rand(11111,99999).'.'.$extension; // renameing image
				 $request['profile_picture'] = $fileName;

				 $file->move(public_path().'/uploads/images/user/', $fileName);
			 }
			 else
        {
				$request['profile_picture'] = $findMember->profile_picture;
			 }

        if($findMember)
             $updateProfile = $findMember->update($request->all());
         if($updateProfile)
         {
           Session::put('memberDetail',$member->find(Auth::guard('member')->id()));

           return redirect()->back()->with('success',trans('actionMsg.member_profile_submit_success'));
         }
         else
         {
           return redirect()->back()->with('error',trans('actionMsg.member_profile_error'));
         }

    }



		//Change User Password
		public function changePassword(Request $request) {
			$rules =  [
				'old_password' => 'required',
				'password' => 'required|same:password|min:6',
				'confirm_password' => 'required|same:password',
			];
			$validator = Validator::make($request->all(),$rules);

			if($validator->fails()) {
				 return redirect()->back()->withErrors($validator)->with('change_pass','changepass');
			 }
			 $current_password = Session::get('memberDetail')->password;

			 if(Hash::check($request->old_password, $current_password))
		 		{
			 	$user_id = Auth::guard('member')->id();
			 	$userFind = Member::find($user_id);
			 	$userFind->password = Hash::make($request->password);
			 	$userFind->save();

        //SEND Password change mail
        //send welcome email
        $getEmailTemp     = AppClass::getTemplateByKey('pass_changed_notice');
        $subject          = $getEmailTemp->subject;
        $purpose          = $getEmailTemp->purpose;
        $sender_name      = $getEmailTemp->sender_name;
        $sender_email     = $getEmailTemp->sender_email;
        $reply_to         = $getEmailTemp->reply_to;
        $cc_email         = $getEmailTemp->cc_email;
        $body             = $getEmailTemp->body;
        $body             = str_ireplace('#SupportEmail',config('sximo.cnf_email'),$body);
        $smsBody          = $getEmailTemp->sms_body;
        if($getEmailTemp->sms_enabled == 'Y') {
            AppClass::sendSMSWithName($user->mobile_number,$smsBody);
        }
        AppClass::sendEmail($subject,$purpose,$sender_name,$sender_email,$reply_to,$cc_email,$body,$userFind->email);
        Session::put('memberDetail',$userFind);

				return redirect()->back()->with('success',trans('actionMsg.member_change_password_success'));
		 		}
				else {
					return redirect()->back()->with('error',trans('actionMsg.member_change_password_error'));
				}

		}

		public function deleteFav(){

			$delID =  isset($_POST['delID']) ? $_POST['delID'] : 0;

				\DB::table('tb_user_follows')->whereuser_id(Auth::guard('member')->id())->whereflwid($delID)->delete();

				echo 1;
		}

    public function getfavourites()
     {

    //   $data['page_data']     = DB::table('tb_cashback_widgets')->wherecb_page('favorites')->first();
    //
    //   $data['fav_marchant']  = DB::table('tb_user_follows')
    //                           ->join('tb_stores','tb_stores.store_id','=','tb_user_follows.object_id')
    //                           ->whereuser_id(Auth::guard('member')->id())
    //                           ->whereobject_type('store')->get();
    //  $data['fav_tag']  = DB::table('tb_user_follows')
    //                           ->join('tb_tags','tb_tags.tag_id','=','tb_user_follows.object_id')
    //                           ->whereuser_id(Auth::guard('member')->id())
    //                           ->whereobject_type('tag')->get();
    //  $data['fav_brand']  = DB::table('tb_user_follows')
    //                           ->join('tb_brands','tb_brands.brand_id','=','tb_user_follows.object_id')
    //                           ->whereuser_id(Auth::guard('member')->id())
    //                           ->whereobject_type('brand')->get();
    //  $data['fav_cat']  = DB::table('tb_user_follows')
    //                           ->join('tb_categories','tb_categories.cat_id','=','tb_user_follows.object_id')
    //                           ->whereuser_id(Auth::guard('member')->id())
    //                               ->whereobject_type('cat')->get();
    // $data['fav_store_cat']  = DB::table('tb_user_follows')
    //             ->join('tb_store_categories','tb_store_categories.store_cat_id','=','tb_user_follows.object_id')
    //             ->whereuser_id(Auth::guard('member')->id())
    //             ->whereobject_type('store-cat')->get();
    // $data['fav_store_deal']  = DB::table('tb_user_follows')
    //             ->join('tb_stores','tb_stores.store_id','=','tb_user_follows.object_id')
    //             ->whereuser_id(Auth::guard('member')->id())
    //             ->whereobject_type('store-deal')->get();


  $data['page_data'] ='';
  $data['fav_marchant']='';
  $data['fav_tag']='';
 $data['fav_brand'] ='';
$data['fav_cat']  ='';
$data['fav_store_cat']='';
$data['fav_store_deal'] ='';

        return view('member-dash.members.fav',compact('data'));
    }

	public function getMyCoupons()
	{
		$data['page_data']     = DB::table('tb_cashback_widgets')->wherecb_page('my_coupon')->first();

				 $query = "SELECT DISTINCT tc.*,ts.*,`ts`.`cashback` as `storeCashback` FROM `tb_user_follows` uf, `tb_coupons` tc , `tb_stores` ts
	WHERE user_id = ".Auth::guard('member')->id()." AND object_type = 'coupon' AND object_id = coupon_id AND tc.store_id = ts.store_id AND tc.coupon_status = 'published' AND expiry_date > CURRENT_TIME ";
				 $getData  = DB::select($query);
				 $getRecord = $this->doPaginateOnly($getData,999,999);
				 $data['returnArray']['coupons']  =  $getRecord['data'];
				 $data['returnArray']['filter'] = false;
				 $data['type']              		  = 'all';
				 $data['storepage'] 			        = true;
			$data['cat_page']               = false;

			$data['coupon_follow_data']     = DB::table('tb_user_follows')->select('object_id')
																				->whereuser_id(Auth::guard('member')->id())
																				->whereobject_type('coupon')
																				->get();

				return view('member-dash.members.my_coupons',compact('data'));

	}


}
