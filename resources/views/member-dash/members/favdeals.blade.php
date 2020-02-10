@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection

  <?php $breadTitle =__('member/multi_lang.my_fav_deals'); ?>
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

      				<h2 class="font-weight-bold pb-2">{{__('member/multi_lang.my_fav_deals')}}</h2>

					<div class="row">
					@if(count($deals) > 0)
						@foreach($deals as $deal)
						<div class="col-lg-4 col-md-4 col-sm-6 mb-3">
						  @include('public.deals.common')
						  </div>

						  @endforeach
					@endif
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

<script>var dealUrl = "{{route('deals.getAjax')}}"; var store_id = false; var cat_id = false;</script>
<script type="text/javascript" src="{{asset('public_assets/js/deal.js')}}"></script>

@endsection
