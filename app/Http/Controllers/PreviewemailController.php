<?php namespace App\Http\Controllers;

use App\Models\Previewemail;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use DB;

class PreviewemailController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'previewemail';
	static $per_page	= '25';

	public function __construct()
	{
		
		parent::__construct();
		$this->model = new Previewemail();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = array();
	
		$this->data = array_merge(array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'previewemail',
			'pageUrl'			=>  url('previewemail'),
			'return'	=> self::returnUrl()
			
		),$this->data);


		
	}

	public function index( Request $request )
	{
		
		$base = base_path().'/public/etemplate/';
		
		$EmailHead = base_path()."/resources/views/EmailHead.blade.php";
		$EmailFoot = base_path()."/resources/views/EmailFoot.blade.php";
		
		$index_html = '<h1>Email Templates</h1><br>';
			
			$EmailHeadHtml = file_get_contents($EmailHead);
			$EmailFootHtml =  file_get_contents($EmailFoot);
			
			
		$res  = DB::table('tb_email_templates')->get();
		foreach($res as $template)
		{
			$info = $EmailHeadHtml.$template->body.$EmailFootHtml;
			$index_html .= '<a href="'.url('/etemplate/'.$template->email_key.'.html').'">'.$template->purpose.'</a><br>';
			$fp=fopen( $base.$template->email_key.'.html' ,"w+"); 
			fwrite($fp,$info); 
			fclose($fp);
			
			
		}
		
			$fp=fopen( $base.'index.html' ,"w+"); 
			fwrite($fp,$index_html); 
			fclose($fp);
		
		
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