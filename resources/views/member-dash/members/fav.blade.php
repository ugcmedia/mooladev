@extends('public.layouts.app')
@section('content')
@section('title')
  {{--!! $data['page_data']->meta_title!!--}}
@endsection

  <?php $breadTitle =__('member/multi_lang.favourites'); ?>
  @include('member-dash/member-partials/title_heading_common')

<div class="main-content py-5">
   <div class="container">
    	<div class="row">
        @include('member-dash/member-partials/sidebar')
				@if(Session::get('memberDetail')->email_verified != 'Y')
					<div class="col-xl-9 col-lg-9 col-md-8">
						<div class="my-msg bg-white p-3 rounded mb-4">
								<p style="color:red">  {{__('member/multi_lang.verify_Mail')}}
									 <a href="{{route('resendMail')}}">
											{{__('member/multi_lang.click_here')}}
										</a>
									</p>
						</div>
					</div>
				@else
      		<div class="col-xl-9 col-lg-9 col-md-8">
            @if(strip_tags($data['page_data']->top_content) != '')
              <div class="my-msg bg-white p-3 rounded mb-4">
  								{!! $data['page_data']->top_content !!}
  						</div>
            @endif

      				<h2 class="font-weight-bold pb-2">{{__('member/multi_lang.favourites')}}</h2>

							<div class="tab-content" id="pills-tabContent">
							    <div class="tab-pane fade  show active" id="pills-Favourites" role="tabpanel" aria-labelledby="pills-Favourites-tab">

							    <div class="card">
								  <h5 class="card-header">{{__('member/multi_lang.merchants')}} <span class="badge badge-pill badge-dark">{{count($data['fav_marchant'])}}</span></h5>
								  <div class="card-body">
								  	@if(count($data['fav_marchant']) > 0)
								  		<!-- <p class="text-muted">{{__('member/multi_lang.Your_have_merchants')}}  </p> -->
										<div class="row">
									 @foreach($data['fav_marchant'] as $Fmarchand)
										<div class="col-lg-2 col-md-3 mb-3" id="fav{{$Fmarchand->flwid}}">
										<div class="fav-merchnt-box p-2 rounded border mb-2 ">
								  			<a href="{{url('/store/'.$Fmarchand->store_slug)}}" title="{{$Fmarchand->store_name}}"><img class="align-middle" src="{{asset('uploads/images/store').'/'.$Fmarchand->store_logo}}" alt="">
											</a>

								  		</div>
										<a href="javascript:void(0)" onclick="deleteFav({{$Fmarchand->flwid}});" class="delFavIcon"><i class="fa fa-trash text-danger"></i></a>
										<a href="{{url('/store/'.$Fmarchand->store_slug)}}" title="{{$Fmarchand->store_name}}"><span class="favName">{{$Fmarchand->store_name}}</span></a>
										</div>
										@endforeach

								  		</div>
											@else
											<p>{{__('member/multi_lang.sorry_found')}}!</p>
										@endif
								  </div>
								</div>

							  	<div class="card mt-3">
								  <h5 class="card-header"> {{__('member/multi_lang.brands')}} <span class="badge badge-pill badge-dark">{{count($data['fav_brand'])}}</span></h5>
								  <div class="card-body">
								  	@if(count($data['fav_brand']) > 0)

									<div class="row">
								 @foreach($data['fav_brand'] as $fbrand)
									<div class="col-lg-2 col-md-3 mb-3" id="fav{{$fbrand->flwid}}">
									<div class="fav-merchnt-box p-3 rounded border mb-2">
							  			<a href="{{url('/brand/'.$fbrand->brand_slug)}}" title="{{$fbrand->brand_name }}"><img class="align-middle" src="{{asset('uploads/images/brand').'/'.$fbrand->brand_icon}}" alt=""></a>
							  		</div>
									<a href="{{url('/brand/'.$fbrand->brand_slug)}}" title="{{$fbrand->brand_name }}"><span class="favName">{{$fbrand->brand_name }}</span></a>
									<a href="javascript:void(0)"  onclick="deleteFav({{$fbrand->flwid}});" class="delFavIcon"> <i class="fa fa-trash text-danger"></i></a>
									</div>
									@endforeach

							  		</div>
										@else
										<p>{{__('member/multi_lang.sorry_found')}}!</p>
									@endif
								  </div>
								</div>



								<div class="card mt-3">
								  <h5 class="card-header"> {{__('member/multi_lang.cats')}} <span class="badge badge-pill badge-dark">{{count($data['fav_cat'])}}</span></h5>
								  <div class="card-body">
								  	@if(count($data['fav_cat']) > 0)

									<div class="row">
								 @foreach($data['fav_cat'] as $fcat)
									<div class="col-lg-2 col-md-3 mb-3" id="fav{{$fcat->flwid}}">
									<div class="fav-merchnt-box p-3 rounded border mb-2">
							  			<a href="{{url('/category/'.$fcat->cat_slug)}}" title="{{$fcat->cat_name }}"><img class="align-middle" src="{{asset('uploads/images/category').'/'.$fcat->cat_icon}}" alt=""></a>
							  		</div>
									<a href="{{url('/category/'.$fcat->cat_slug)}}" title="{{$fcat->cat_name }}"><span class="favName">{{$fcat->cat_name }}</span></a>
									<a href="javascript:void(0)"  onclick="deleteFav({{$fcat->flwid}});" class="delFavIcon"><i class="fa fa-trash text-danger"></i></a>
									</div>
									@endforeach

							  		</div>
										@else
										<p>{{__('member/multi_lang.sorry_found')}}!</p>
									@endif
								  </div>
								</div>


								<div class="card mt-3">
								  <h5 class="card-header"> {{__('member/multi_lang.tags')}} <span class="badge badge-pill badge-dark">{{count($data['fav_tag'])}}</span></h5>
								  <div class="card-body">
								  	@if(count($data['fav_tag']) > 0)

									<div class="row">
								 @foreach($data['fav_tag'] as $ftag)
									<div class="col-lg-2 col-md-3 mb-3" id="fav{{$ftag->flwid}}">
									<div class="fav-merchnt-box p-3 rounded border mb-2">
							  			<a href="{{url('/tag/'.$ftag->tag_slug)}}" title="{{$ftag->tag_name }}"><img class="align-middle" src="{{asset('uploads/images/tag').'/'.$ftag->tag_icon}}" alt=""></a>
							  		</div>
									<a href="{{url('/tag/'.$ftag->tag_slug)}}" title="{{$ftag->tag_name }}"><span class="favName"> {{$ftag->tag_name }}</span></a>
									<a href="javascript:void(0)"  onclick="deleteFav({{$ftag->flwid}});" class="delFavIcon"><i class="fa fa-trash text-danger"></i> </a>
									</div>
									@endforeach

							  		</div>
										@else
										<p>{{__('member/multi_lang.sorry_found')}}!</p>
									@endif
								  </div>
								</div>


								<div class="card mt-3">
								  <h5 class="card-header"> {{__('member/multi_lang.Deal_stores')}} <span class="badge badge-pill badge-dark">{{count($data['fav_store_deal'])}}</span></h5>
								  <div class="card-body">
								  	@if(count($data['fav_store_deal']) > 0)

									<div class="row">
								 @foreach($data['fav_store_deal'] as $fsdeal)
									<div class="col-lg-2 col-md-3 mb-3"  id="fav{{$fsdeal->flwid}}">
									<div class="fav-merchnt-box p-3 rounded border mb-2">
							  			<a href="{{url('/store/deal/'.$fsdeal->deal_slug)}}" title="{{$fsdeal->store_name}}"><img class="align-middle" src="{{asset('uploads/images/store').'/'.$fsdeal->store_logo}}" alt=""></a>
							  		</div>
									<a href="{{url('/store/deal/'.$fsdeal->deal_slug)}}" title="{{$fsdeal->store_name}}"><span class="favName">{{$fsdeal->store_name}}</span></a>
									<a href="javascript:void(0)"  onclick="deleteFav({{$fsdeal->flwid}});" class="delFavIcon"><i class="fa fa-trash text-danger"></i>  </a>
									</div>
									@endforeach

							  		</div>
										@else
										<p>{{__('member/multi_lang.sorry_found')}}!</p>
									@endif
								  </div>
								</div>

								<div class="card mt-3">
								  <h5 class="card-header"> {{__('member/multi_lang.store_Categories')}} <span class="badge badge-pill badge-dark">{{count($data['fav_store_cat'])}}</span></h5>
								  <div class="card-body">
								  	@if(count($data['fav_store_cat']) > 0)

									<div class="row">
								 @foreach($data['fav_store_cat'] as $fscat)
									<div class="col-lg-2 col-md-3 mb-3" id="fav{{$fscat->flwid}}">
									<div class="fav-merchnt-box p-3 rounded border mb-2">
							  			<a href="{{url('/store-category/'.$fscat->slug)}}" title="{{$fscat->store_cat_name}}"><img class="align-middle" src="{{asset('uploads/images/category').'/'.$fscat->store_cat_icon}}" alt=""></a>
							  		</div>
									<a href="{{url('/store-category/'.$fscat->slug)}}" title="{{$fscat->store_cat_name}}"><span class="favName">{{$fscat->store_cat_name}}</span></a>
									<a href="javascript:void(0)" onclick="deleteFav({{$fscat->flwid}});" class="delFavIcon"><i class="fa fa-trash text-danger"></i></a>
									</div>
									@endforeach

							  		</div>
										@else
										<p>{{__('member/multi_lang.sorry_found')}}!</p>
									@endif
								  </div>
								</div>

							  </div>

							</div>

        @if(strip_tags($data['page_data']->bottom_content) != '')
          <div class="my-msg bg-white p-3 rounded mb-4">
              {!! $data['page_data']->bottom_content !!}
          </div>
        @endif

			</div>
			@endif
		</div>
	</div>
</div>
<script type="text/javascript" src="{{asset('public_assets/js/member.js')}}"></script>

<script type="text/javascript">

function deleteFav(delID)
	{


		$.ajax({
      method:'post',
      cache: false,
      url: "{{url('/deleteFav')}}",
      data: {'delID':delID,'_token': $('input[name=_token]').val()} ,
      success:function(response){

      },
        complete:function(response) {

      }
    }).done(function(data)
			{
				$('#fav'+delID).remove();
			});


	}

$(document).ready(function(){
	// 	console.log($( "#pills-tab" ).tab());
	// $('#pills-tab').tab({ active: 2 });





	$(".area .input").click(function(e) {

   $("label[type='checkbox']", this)
   var pX = e.pageX,
      pY = e.pageY,
      oX = parseInt($(this).offset().left),
      oY = parseInt($(this).offset().top);

   $(this).addClass('active');

   if ($(this).hasClass('active')) {
      $(this).removeClass('active')
      if ($(this).hasClass('active-2')) {
         if ($("input", this).attr("type") == "checkbox") {
            if ($("span", this).hasClass('click-efect')) {
               $(".click-efect").css({
                  "margin-left": (pX - oX) + "px",
                  "margin-top": (pY - oY) + "px"
               })
               $(".click-efect", this).animate({
                  "width": "0",
                  "height": "0",
                  "top": "0",
                  "left": "0"
               }, 400, function() {
                  $(this).remove();
               });
            } else {
               $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
               $('.x-' + oX + '.y-' + oY + '').animate({
                  "width": "500px",
                  "height": "500px",
                  "top": "-250px",
                  "left": "-250px",
               }, 600);
            }
         }

         if ($("input", this).attr("type") == "radio") {

            $(".area .input input[type='radio']").parent().removeClass('active-radio').addClass('no-active-radio');
            $(this).addClass('active-radio').removeClass('no-active-radio');

            $(".area .input.no-active-radio").each(function() {
               $(".click-efect", this).animate({
                  "width": "0",
                  "height": "0",
                  "top": "0",
                  "left": "0"
               }, 400, function() {
                  $(this).remove();
               });
            });

            if (!$("span", this).hasClass('click-efect')) {
               $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
               $('.x-' + oX + '.y-' + oY + '').animate({
                  "width": "500px",
                  "height": "500px",
                  "top": "-250px",
                  "left": "-250px",
               }, 600);
            }

         }
      }
      if ($(this).hasClass('active-2')) {
         $(this).removeClass('active-2')
      } else {
         $(this).addClass('active-2');
      }
   }
	});
});
</script>

@endsection
