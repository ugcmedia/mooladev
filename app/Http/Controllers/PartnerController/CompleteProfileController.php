<?php
namespace App\Http\Controllers\PartnerController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Member;
use App\Models\Vendor;
use Session;
use Auth;
use Validator;
use Hash;
use App\Helpers\AppClass;

/**
 *
 */
class CompleteProfileController extends Controller
{

    public function index() {
      return view('partner.register.complete-profile');
    }

    public function submitProfile(Request $request,Vendor $vendor) {

      // $rules =  [
      //   'vendor_name' => 'required',
      //   'vendor_support_email' => 'required',
      //   'vendor_logo' => 'required',
      // ];
      // $validator = Validator::make($request->all(),$rules);
      // if($validator->fails()) {
      //    return redirect()->back()->withErrors($validator)->withInput();
      //  }

      $vendorCode =   Session::get('partnerDetail');
        if($request->hasFile('logo')) {
       $file = $request->logo;
       //getting timestamp
       $extension = $request['logo']->getClientOriginalExtension(); // getting image extension
       $fileName = rand(11111,99999).'.'.$extension; // renameing image
       $request['vendor_logo'] = $fileName;

       $file->move(public_path().'/uploads/vendor_logo/', $fileName);
      }

      if($request->hasFile('primary_image')) {
       $file = $request->primary_image;
       //getting timestamp
       $extension = $request['primary_image']->getClientOriginalExtension(); // getting image extension
       $fileName2 = rand(11111,99999).'.'.$extension; // renameing image
       $request['outlet_primary_image'] = $fileName2;

       $file->move(public_path().'/uploads/vendor_outlet_primary_image/', $fileName2);
      }

      if($request->hasFile('attachment')) {
         $file = $request->attachment;
         //getting timestamp
         $extension = $request['attachment']->getClientOriginalExtension(); // getting image extension
         $fileName3 = rand(11111,99999).'.'.$extension; // renameing image
         $request['outlet_attachment'] = $fileName3;

         $file->move(public_path().'/uploads/vendor_attechment/', $fileName3);
        }

        $request['vendor_code'] =$vendorCode->vendor_code;
        if(!isset($request->cashback_status)) {
            $request['cashback_enabled'] = 'N';
        }
        $data = [
          'vendor_name' => $request->vendor_name,
          'vendor_contact_number' => $request->vendor_contact_number,
          'vendor_support_email' => $request->vendor_support_email,
          'vendor_website' => $request->vendor_website,
          'vendor_desc' => $request->vendor_desc,
          'outlet_name' => $request->outlet_name,
          'outlet_address' => $request->outlet_address,
          'outlet_lat' => $request->outlet_lat,
          'outlet_long' => $request->outlet_long,
          'outlet_gallery' => $request->outlet_gallery,
          'cashback_enabled' => $request->cashback_enabled,
          'cashback_type' => $request->cashback_type,
          'vendor_phnumber' => $request->vendor_phnumber,
          'vendor_howto' => $request->vendor_howto,
          'vendor_policy' => $request->vendor_policy,
          'vendor_stats' => $request->vendor_stats,
          'vendor_logo' => $request->vendor_logo,
          'outlet_primary_image' => $request->outlet_primary_image,
          'outlet_attachment' => $request->outlet_attachment,
          'vendor_code'       =>$request->vendor_code
        ];
        $INSERT = $vendor->insert($data);
        if($INSERT) {
          return redirect('partner/partner-overview');
        }
        else {
          return redirect()->back()->with('error','unable to submit profile')->withInput();
        }

    }

}
