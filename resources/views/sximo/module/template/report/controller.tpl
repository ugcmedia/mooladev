<?php namespace App\Http\Controllers;

use App\Models\{controller};
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class {controller}Controller extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = '{class}';
	static $per_page	= '25';

	public function __construct()
	{
		
		parent::__construct();
		$this->model = new {controller}();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = array();
	
		$this->data = array_merge(array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> '{class}',
			'pageUrl'			=>  url('{class}'),
			'return'	=> self::returnUrl()
			
		),$this->data);


		
	}

	public function index( Request $request )
	{
		// Make Sure users Logged 
		if(!\Auth::check()) 
			return redirect('user/login')->with('status', 'error')->with('message','You are not login');
		$this->grab( $request) ;
		if($this->access['is_view'] ==0) 
			return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');				
		// Render into template
		return view( $this->module.'.index',$this->data);
	}	
	function show( Request $request , $id ) 
	{
		/* Handle import , export and view */
		$task =$id ;
		switch( $task)
		{

		case 'data':
				$this->grab( $request) ;
				return view( $this->module.'.result',$this->data);
				break;
				
		case 'search':
				return $this->getSearch('native');	
				break;
				
			case 'export':
				return $this->getExport( $request );
				break;
	
		}
	}
}