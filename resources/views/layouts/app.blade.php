<?php

  $set_theme = session('set_theme');
  if($set_theme =='') {
    $set_theme = 'light-theme.css';
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> {{ config('sximo.cnf_appname')}} </title>

<link rel="shortcut icon" href="{{ asset('uploads/images/').'/'.config('sximo.cnf_favicon')}}" type="image/x-icon">

<link href="{{ asset('sximo5/sximo.min.css')}}" rel="stylesheet">

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

<body class="sxim-init" >
<div id="wrapper">


        @include('layouts.sidebar')
        <div class="gray-bg  <?php if(Auth::user()->group_id == 1) echo 'superadmin-head'; else echo 'bird-head'; ?> " id="page-wrapper">
          <div class="minimal-header ">
            @if(file_exists(public_path().'/uploads/images/'.config('sximo.cnf_logo') ) && config('sximo.cnf_logo') !='')
                <img src="{{ asset('uploads/images/'.config('sximo.cnf_logo')) }}" alt="{{ config('sximo.cnf_appname') }}"  />
            @else
            {{ config('sximo.cnf_appname')}}
            @endif
          </div>
            @include('layouts.header')

            @yield('content')

        </div>
    </div>



	@include('media::partials.media')


	<script>
        'use strict';

      $(document).ready(function () {
            $('[data-type="mediaUpload"]').rvMedia({
                multiple: false,
                onSelectFiles: function (files, $el) {
                    $($el.data('target')).val(files[0].url);
					$($el.data('target')+'Preview .img-preview img').attr('src',files[0].full_url);
                }
            });
        });
    </script>


    <div class="footer fixed">
        <div class="pull-right">

        </div>
        <div>
            <strong>Copyright</strong> &copy; <?php echo date('Y');?> .<b> {{ config('sximo.cnf_comname')}}</b> </div>
    </div>

<div class="modal fade" id="sximo-modal" tabindex="-1" role="dialog">
<div class="modal-dialog  ">
  <div class="modal-content">
    <div class="modal-header bg-default">

        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
    </div>
    <div class="modal-body" id="sximo-modal-content">

    </div>

  </div>
</div>
</div>

{{ SiteHelpers::showNotification() }}

<style>
#sidebar-navigation #sidemenu {overflow-y:scroll !important}
</style>

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

  loadNotification();
  setInterval(function(){
   // loadNotification()
  }, 10000);

  $('.switch-theme').on('click', function(event) {
      theme = $(this).attr('code') ;
      url_theme = '{!! asset("sximo5") !!}/'+ theme ;
      $.get('{{ url("sximo5") }}/'+ theme ,function(){

         $('#switch-theme').attr('href',url_theme);
      })
  });

});
;

function loadNotification(){
    $.get('{{ url("home/load") }}',function(data){
    $('.notif-alert').html(data.total);
        var html = '';
        $.each( data.note, function( key, val ) {
        html += '<li><a href="'+val.url+'"><div class="message-center"><div class="note-content"><h5>'+val.title+'</h5><span class="mail-desc">'+val.text+'</span> <span class="time">'+val.date+'</span> </div></div><div class="clr"></div></a></li>' ;
        });
        $('#notification-menu').html(html);
    });
}
</script>

</body>
</html>
