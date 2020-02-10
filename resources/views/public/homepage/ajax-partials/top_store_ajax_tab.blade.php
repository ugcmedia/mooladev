<div class="top-store-cont p-3">
<div class="row">
<?php $scount = 1; ?>
  @foreach(AppClass::getTopStoreList($store_list) as $store)
  <?php   if($scount==15) break;
  $storeimg = ($store->store_logo != '') ? asset('uploads/images/store').'/'.$store->store_logo : asset('uploads/images/no-image.jpg');
    $offercount = '0';
    if(!empty($store->offers_count)) {
      $offercount = AppClass::getOffersCount($store->offers_count);
    }
    ?>
   <div class="col-xxl-5 col-6 col-md-3 col-sm-4">
       <a href="{{url('store/'.str_slug($store->store_slug))}}">
         <div class="top-store-box text-center">
           <img src="{{$storeimg}}" class="mb-3" />
           <p class="secondary-text font-15 mb-0">
             {{$store->store_name}}
           </p>
           <p class="primary-text font-15 mb-2">
             {{$offercount}} Offers
           </p>
        </div>
      </a>
    </div>
	<?php $scount++;?>
  @endforeach
  <div id="viewAlllink" class="col-xxl-5 col-6 col-md-3 col-sm-4 d-flex align-items-center mx-auto mx-md-0">
      <a href="#" class="view-ajax btn btn-primary v-all-lg-button btn-block d-flex align-items-center justify-content-center">{{__('public/homepage.hp_view_all')}}<br />
      </a>
    </div>


</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $(".view-ajax").append($("#ajaxtab{{$store_list}}").attr('data-title'));
  $("#viewAlllink a").attr("href", "<?php echo url('store-category/')?>/"+$("#ajaxtab{{$store_list}}").attr('data-slug')+"");
})
</script>
