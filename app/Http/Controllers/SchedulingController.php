<?php namespace App\Http\Controllers;

use App\Models\Scheduling;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class SchedulingController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'scheduling';
	static $per_page	= '10';

	public function __construct()
	{
		parent::__construct();
		$this->model = new Scheduling();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = array();
	
		$this->data = array_merge(array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'scheduling',
			'return'	=> self::returnUrl()
			
		),$this->data);

		
	}

	public function index( Request $request )
	{		
	if(!\Auth::check()) 
			return redirect('user/login')->with('status', 'error')->with('message','You are not login');
		$this->grab( $request) ;
		if($this->access['is_view'] ==0) 
			return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');				
		
		
		return view('scheduling.index',$this->data);
	}
	function show(Request $request, $id = null)
	{
		return view('scheduling.view',$this->data);
	}	
	public function create( $id = null)
	{		
		return view('scheduling.form',$this->data);	
	}	
	public function edit( $id = null)
	{		
		return view('scheduling.form',$this->data);	
	}	
	function store( Request $request)
	{		
	
	}
	public function destroy( Request $request)
	{
		
		
	}			


}