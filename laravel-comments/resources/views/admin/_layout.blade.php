<?php
use Hazzard\Comments\ScriptVariables;
$polyfills = [
    'Promise',
    'Object.assign',
    'Array.from',
    'Array.prototype.includes',
    'Element.prototype.closest'
];
$set_theme = session('set_theme');
  if($set_theme =='') {
    $set_theme = 'light-theme.css';
  }
?>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name') }}</title>

  <link href="{{ ScriptVariables::mix('admin.css', 'vendor/comments') }}" rel="stylesheet">
  {{-- <link href="http://laravel-comments.app/public/admin.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium">

  <link rel="shortcut icon" href="{{ asset('uploads/images/').'/'.config('sximo.cnf_favicon')}}" type="image/x-icon">


<link href="{{ asset('sximo5/js/plugins/iCheck/skins/square/green.css')}}" rel="stylesheet">
<link href="{{ asset('sximo5/js/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
<link href="{{ asset('sximo5/js/plugins/toast/css/jquery.toast.css')}}" rel="stylesheet">
<!-- Icon CSS -->
<link href="{{ asset('sximo5/fonts/icomoon.css')}}" rel="stylesheet">
<link href="{{ asset('sximo5/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet">
<link href="{{ asset('sximo5/fonts/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<!--<link href="{{ asset('sximo5/css/colors.css')}}" rel="stylesheet"> -->

<!-- Sximo 5 Main CSS -->
<link href="{{ asset('sximo5/css/sximo.css')}}" rel="stylesheet">

<!--
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
-->

<link href="{{ asset('sximo5/'.$set_theme)}}" rel="stylesheet" id="switch-theme">

<script type="text/javascript" src="{{ asset('sximo5/sximo.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('sximo5/js/sximo.js') }}"></script>
<script type="text/javascript" src="{{ asset('sximo5/js/custom.js') }}"></script>
<!--
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
-->


<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<link href="{{ asset('sximo5/css/custom.css')}}" rel="stylesheet">


</head>
<body>
  <div id="app" v-cloak class="sxim-init" >

	<div id="wrapper">
         @include('layouts.sidebar')
	       <div class="gray-bg" id="page-wrapper">
              @yield('content')
          </div>
	</div>

  </div>

  {{ ScriptVariables::render() }}

  @if (config('comments.emoji'))
    <script src="//twemoji.maxcdn.com/2/twemoji.min.js?2.2.3"></script>
  @endif

  <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features={{ implode(',', $polyfills) }}"></script>

  <script src="{{ ScriptVariables::mix('admin.js', 'vendor/comments') }}"></script>
  {{-- <script src="http://laravel-comments.app/public/admin.js"></script> --}}
  
  <script type="text/javascript">
jQuery(document).ready(function ($) {
	
	$('#sidebar-navigation #sidemenu').height($( window  ).height());

	//$('.page-content .page-content-wrapper .sbox .table-responsive table').DataTable();

	/* $('.page-content .page-content-wrapper .sbox .table-responsive table')
				.addClass( 'nowrap' )
				.dataTable( {
					responsive: true,
					columnDefs: [
						{ targets: [-1, -3], className: 'dt-body-right' }
					]
				} ); */


		$('.switch-wrap input[type=checkbox]').each(function (){
			if(this.checked)  $('.depen-'+this.name).show();
			else $('.depen-'+this.name).hide();
		});

		$('.switch-wrap :checkbox').change(function () {
			if(this.checked)  $('.depen-'+this.name).show();
			else $('.depen-'+this.name).hide();
		});

		$('[data-toggle="tooltip"]').tooltip();

  $('#sidemenu').sximMenu();

});
</script>
<style>
#sidemenu > li > a {    width: 80% !important;}
</style>
</body>
</html>
