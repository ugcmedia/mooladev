@extends('layouts.app')
@section('content')
<section class="page-header row">
    <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li  class="active"> {{ $pageTitle }} </li>
    </ol>
  </section>

<div class="page-content row">
  <div class="page-content-wrapper no-margin">

    <div class="sbox">
      <div class="sbox-title">
        <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      </div>
      <div class="sbox-content" style="margin:0px;padding:0px;overflow:hidden" id="framebox">
		<?php
		$plaintext = time()+(300);
$app_key = getenv('CRON_KEY');
	$app_tag = getenv('CRON_TAG');
$cipher = "AES-128-ECB";
if (in_array($cipher, openssl_get_cipher_methods()))
$ciphertext = urlencode( openssl_encrypt($plaintext, $cipher, $app_key));
else $ciphertext = '';
?>

		<iframe frameBorder="0" src="{{url('/cron/?key='.$ciphertext)}}" style="overflow:hidden;height:100%;width:100%;min-height:800px;" height="100%" width="100%"></iframe>

      </div>
    </div>
  </div>
</div>


@stop