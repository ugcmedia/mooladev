@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection

  <?php $breadTitle =__('member/multi_lang.faq'); ?>
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
      			<div class=" ">
				   <div class="">
				    	<div class="faq-categories support-faq-wrapper p-3">
				    		<h3 class="faq-title font-weight-bold">{{__('member/multi_lang.categories')}}</h3>

				    		<div class="faq-section mt-4">
				    			<div class="row">
                    @foreach( $data['faqCats']  as $faqCat)
                    <div class="col-lg-3 col-md-6">
                        <a href="#{{$faqCat->cat_code}}">
                        <div class="category-item bg-white text-center">

                          <div class="faq-list-icon">
                            <i class="fa {{$faqCat->cat_icon}}" aria-hidden="true"></i>
                          </div>
                          {{$faqCat->cat_name}}
                        </div>
                        </a>
                      </div>
                      @endforeach


 							  </div>
							</div>
          </div>

          @foreach( $data['faqCats']  as $faqCat)
          <!-- How It Works section start -->
          <div class="p-3" id="{{$faqCat->cat_code}}">
            <h3 class="font-weight-bold pt-3 pb-3">	{{$faqCat->cat_name}}</h3>
            <div class="all-ques-wrapper" id="accordion" role="tablist" aria-multiselectable="true">
              @foreach($data['faq'] as $faq)
              @if($faq->faq_cat == $faqCat->cat_code)
                <div class="ques-box mb-4 ">
                <div class="ques-heading p-3 bg-light" role="tab" id="headingOne">
                  <div class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#{{$faq->faq_id}}" aria-expanded="true" aria-controls="collapseOne">
                    <h6 class="font-weight-bold ques-title mb-0">
                      {!! $faq->faq_title !!}
                    </h6>
                 </a>
             </div>

          </div>
            <div id="{{$faq->faq_id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body bg-white">
                    <div class="ques-content p-3">
                      {!! $faq->faq_desc !!}
                    </div>
                </div>
              </div>
            </div>
            @endif
        @endforeach


        </div>
        </div>
        @endforeach

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
</div>
</div>
</div>

@endsection
