<div id="HIWpopOver" class="d-none">
<span data-t="">{!! trans('public/common.whats_this_text',['COMPANY_NAME' => config('sximo.cnf_appname'),'STORE_NAME' => $sharePopCName])  !!} </br>
          <p class="mb-0 text-right"><a href="javascript:void(0)" class="text-15 primary-link fw-700 sthiwbtn" data-toggle="modal" data-target="#hiw-popup" >{{__('public/common.hiw_works')}}</a> </p>
    </div>
<div id="SharePopOver" class="d-none">
<ul class="list-inline pop-social-icons mb-0">
  @php
    $getSocialLink = AppClass::getSocialLinks(url()->current().'#repCouponId');
  @endphp
    <a href="{{$getSocialLink['google']}}"   target="_blank"><li class="list-inline-item btn-google"><i class="fab fa-google-plus-g"></i></li></a>
    <a href="{{$getSocialLink['facebook']}}" target="_blank"><li class="list-inline-item btn-facebook"><i class="fab fa-facebook-f"></i></li></a>
    <a href="{{$getSocialLink['twitter']}}"  target="_blank"><li class="list-inline-item btn-twitter"><i class="fab fa-twitter"></i></li></a>
      <a href="{{$getSocialLink['whatsapp']}}" target="_blank"><li class="list-inline-item btn-whatsapp"><i class="fab fa-whatsapp"></i></li></a>
  </ul>
</div>
<script type='text/javascript'>
/* <![CDATA[ */
var fav_urls = {"addUrl":'{{route('add.coupon.subscribe')}}',"removeUrl":'{{route('add.coupon.subscribe')}}'};
<?php
  if($isDevice == 'mobile') { ?>
    var fav_labels = {"addLab":'<i class="fas fa-plus-circle"></i>',"removeLab":'<i class="fas fa-minus-circle"></i> '};
  <?php } else { ?>
    var fav_labels = {"addLab":'<i class="fas fa-plus-circle"></i> {{__("public/common.add_fav_txt")}}',"removeLab":'<i class="fas fa-minus-circle"></i> {{__("public/common.remove_fav_txt")}}'};
  <?php } ?>
var rat = {"url":'{{url('/rateStore')}}'}
/* ]]> */
</script>
