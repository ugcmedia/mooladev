@extends('layouts.app')
@section('content')
<section class="page-header row">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li  class="active"> {{ $pageTitle }} </li>
    </ol>
  </section>

<div class="page-content row">
  <div class="page-content-wrapper no-margin">

    <div class="sbox">
      <div class="sbox-content">


{!! render_backup_list() !!}


      </div>
    </div>
  </div>
</div>

@stop
