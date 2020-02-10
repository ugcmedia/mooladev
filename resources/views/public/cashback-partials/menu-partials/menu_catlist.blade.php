<li class="megaMenu"><a href="#" class="navtext"><span>{{$menu->menu_name}} </span></a>
  <div class="wsshoptabing wtsdepartmentmenu1 clearfix">
    <div class="container">
      <div class="row">
        <?php
          $mCategories = AppClass::getMenuCategories();
          // echo "<pre>";
          // print_r($mCategories);
          // echo "</pre>";
          $CatName = "";
          $i=0;
          $l=0;
        ?>
        @foreach($mCategories as $cats)
        <?php
          if($CatName != $cats->category_name	) {
            $CatName   = $cats->category_name;
            $l++;
            if($l > 6 ) {
              break;
            }
        ?>
          <?php if($i!=0) { ?>
            </ul>
          </div>
          <?php } ?>
          <div class="col-lg-2 col-md-12">
            <ul class="wstliststy02 menucatlist clearfix">
              <li class="wstheading clearfix"> <a href="#">{{$CatName}}</a> </li>
        <?php } ?>
        <li>
          <a href="{{url('category/'.str_slug($cats->cat_slug))}}">
            @if($cats->menu_name != '' || $cats->menu_name != null) {{str_limit($cats->menu_name,20)}}@else {{str_limit($cats->cat_name,20)}} @endif
          </a>
        </li>
        <?php $i++; ?>
        @endforeach
        </ul>
      </div>
    </div>
    <div class="menu-popular-cat">
      <div class="row">
        <?php $lp  = 0; ?>
        @foreach(AppClass::getPopular() as $cat)
          <?php $lp++;
            if($lp > 7)
              break;
          ?>
          <div class="col-lg-2 col-md-12">
            <a href="{{url('category/'.str_slug($cat->cat_slug))}}">
              <div class="menu-cat-box">
                <div class="menu-cat-img">
                  <img @if($cat->cat_icon != '')
                    src="{{asset('uploads/images/category').'/'.$cat->cat_icon}}"
                   @else
                    src="{{asset('uploads/images/no-image.png')}}"
                   @endif>
                </div>
                <div class="menu-cat-title text-center">
                  <p>@if($cats->menu_name != '' || $cat->menu_name != null) {{str_limit($cat->menu_name,20)}}@else {{str_limit($cat->cat_name,20)}} @endif</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  </div>
</li>
