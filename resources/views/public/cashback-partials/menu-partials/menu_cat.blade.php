<li><a href="#" class="navtext"><span>{{$menu->menu_name}} </span></a>
  <div class="wsshoptabing wtsdepartmentmenu clearfix">
    <div id="cat-dropdown" class="wsshopwp clearfix d-lg-inline-flex d-md-block">
      <div class="cat-drop-list" style="width: 20%;">

        <ul class="list-unstyled p-3">
          <li><p class="font-weight-bold mb-0">{{__('public/storepage.popular_Cat')}}</p></li>
          <?php $lp  = 0;

          ?>
          @foreach(AppClass::getPopular() as $cat)
            <?php $lp++;
              if($lp > 7)
                break;
            ?>
              <li><a href="{{url('category/'.str_slug($cat->cat_slug))}}">{{$cat->menu_name}} </a></li>
          @endforeach
        </ul>
      <div class="v-all-m-cat-link">
      <a href="{{url('all-coupon-categories')}}">{{__('public/storepage.View_all_categories')}}<i class="fa fa-angle-right"></i></a>
    </div>
    </div>
    <?php $CatName = "";
          $catIcon    = "";
          $CatSlug = "";
          $catID = "";
    $i=0;
    $c=0;
    $l=0;
     ?>
      <ul class="wstabitem clearfix" style="width: 80%;">

              @foreach(AppClass::getMenuCategories() as $cats)
              <?php   $newcate = false;
                 if($CatName != $cats->category_name	) {
                   $CatName   = $cats->category_name;
                   $CatSlug   = $cats->cat_slug;
                   $catIcon   = $cats->PIcon;
                   $catID     = $cats->parent_id;
                   $newcate = true;
                   $c = 0;
                   $l++;
                   if($l > 7 ) {
                     break;
                   }

               ?>
               <?php if($i!=0) { ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
              <?php } ?>
                <li @if($l == 1) class="wsshoplink-active" @endif ><a href="#"><i class="{{$catIcon}}" ></i> {{$CatName}}</a>
                  <div id="wstitemright02"  class="wstitemright clearfix wstitemrightactive" style="width: 60%;">
                       <div class="container-fluid">
                         <div class="row">
                           <div class="col-lg-12 col-md-12 clearfix">
                              <ul id="menu-cat-list" class="wstliststy01 clearfix">
                <?php }
                 ?>

                            @if($c < 6)
                                <li><a href="{{url('category/'.str_slug($cats->cat_slug))}}">
                                  <div class="menu-cat-box">
                                    <div class="menu-cat-img">
                                      <img @if($cats->cat_icon != '')
                                        src="{{asset('uploads/images/category').'/'.$cats->cat_icon}}"
                                       @else
                                        src="{{asset('uploads/images/no-image.png')}}"
                                       @endif>
                                    </div>
                                    <div class="menu-cat-title text-center">
                                      <p>@if($cats->menu_name != '' || $cats->menu_name != null) {{str_limit($cats->menu_name,20)}}@else {{str_limit($cats->cat_name,20)}} @endif</p>
                                    </div>
                                  </div>
                                  </a>
                                </li>
                              @endif


                <?php $c++; $i++;

                ?>
                @endforeach
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
       </ul>
    </div>
  </div>
</li>
