<li class="megaMenu"><a href="#" class="navtext"><span>{{$menu->menu_name}}</span></a>
  <div class="wsshoptabing wtsdepartmentmenu clearfix">
    <div class="container">
      <div class="wsshopwp clearfix">
        <ul class="wstabitem clearfix">
          <?php $storeCatName = "";
                $storeIcon    = "";
                $storeCatSlug = "";
          $i=0;
          $c=0;
          $l=0;
           ?>
        @foreach(AppClass::getStoreCat() as $catStore)
        <?php
        // echo "<pre>";
        // print_r($catStore);
        // die();
        $newcate = false;
         if($storeCatName != $catStore->category_name	) {
           $storeCatName   = $catStore->category_name;
           $storeCatSlug   = $catStore->slug;
           $storeIcon      = $catStore->menu_icon;
           $newcate = true;
           $c = 0;
           $l++;
           if($l > 9 ) {
             break;
           }
       ?>
       <?php if($i!=0) { ?>
                </ul>
             </div>
           </div>
     </li>
   <?php } ?>
       <li @if($l == 1) class="wsshoplink-active" @endif><a href="{{url('store-category/'.str_slug($storeCatSlug))}}"><i class="{{$storeIcon}}" ></i> {{$storeCatName}}</a>
         <div class="wstitemright clearfix wstitemrightactive">
           <div class="container-fluid">
             <div class="row">
               <div class="col-lg-12 col-md-12 clearfix">
                 <div class="wstheading clearfix">{{__('public/common.heading_top_store',['store_name' => $storeCatName])}} <span class="float-right"><a href="{{url('store-category/'.str_slug($storeCatSlug))}}">{{__('public/common.see_all_top_store',['cat_name' => $storeCatName])}}</a></span></div>
                 <ul class="wstliststy01 clearfix">
       <?php } ?>
       <?php
       $storeimg = ($catStore->store_logo != '')? asset('uploads/images/store').'/'.$catStore->store_logo : asset('uploads/images/no-image.jpg');
       $offercount = 'No';

       if(!empty($catStore->offers_count)) {
          $offers = explode('|',$catStore->offers_count);
          if(count($offers) > 0) {
            $offercount = $offers[0];
          }
       }
       $storecashback = "";
       $cashBackText =  AppClass::getEarnUpto($catStore->cashback,$catStore->cashback_type);

       // if(!empty($catStore->cashback)) {
       //   $cashBack = explode('|',$catStore->cashback);
       //   if(count($cashBack) > 0) {
       //     if($cashBack[0] == 'percent') {
       //       $storecashback = $cashBack[1].'% '.$catStore->cashback_type;
       //     } else {
       //       $storecashback = config('sximo.cnf_currencyname').$cashBack[1].config('sximo.cnf_currencysuffix').' '.$catStore->cashback_type;
       //     }
       //   }
       // }
       ?>
         <?php if($c%6==0 && $c!=0) { echo '</ul><ul class="wstliststy01 clearfix">'; } ?>
           <?php if($c < 12) { ?>
                    <li><a href="{{url('store/'.str_slug($catStore->store_slug))}}">
                      <div class="menu-store-cont text-center">
                        <div class="menu-store-logo">
                          <img src="{{$storeimg}}" alt="{{$catStore->store_name}}">
                        </div>
                        <div class="m-store-details">
                          <p class="mb-0 storeName font-weight-bold">{{$catStore->store_name }}</p>
                          <p class="mb-0 storeoffers">{{$offercount}} {{__('public/common.offers_available')}}</p>
                          @if($catStore->cashback_enabled == 'Y')
                          <span>{{$storecashback}}</span>
                          @endif
                        </div>
                      </div>
                    </a>
                  </li>
                <?php $c++; $i++; ?>
              <?php } ?>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    </div>
  </li>
    <div class="all-store-link">
      <a href="{{url(config('pageList.allStoreCats'))}}"><i class="fa  fa-shopping-cart mr-1"></i> {{__('public/storepage.browse_all_storecat')}}</a>
    </div>
    </ul>
</div>
</div>
</div>
</li>
