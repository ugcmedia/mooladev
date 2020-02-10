
<section class="blog-section">
	<article class="blog-artical my-5">
		<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="artical-body">
					<div class="post-img">
						<a href="#">
							<img class="mw-100" src="images/ramadan-art-food.webp">
						</a>
						<div class="post-disc bg-white rounded-bottom">
						<div class="post-title text-center p-4 mb-5">
							<a href="#">
								<h3>FESTIVE SPECIAL: BEST RAMADAN FOOD TO HAVE IN HYDERABAD</h3>
							</a>
							<div class="art-short-cont text-left">
								<p>Irrespective of our caste, creed, and belief we go crazy for Haleem, which tastes divine. It is available only during the Ramzan/Ramadan month every year, hence the popularity. But, Ramadan is certainly not simply about haleem, though it reigns supreme throughout the month! Ramadan equals to good food. No…</p>
							</div>
							<div class="art-btn text-center">
								<a href="blog-details.php" class="btn btn-primary rounded">Read more</a>
							</div>
								<div class="clearfix m-2">
								<div class="pp-text float-left">
									<span class="text-muted"><small>May,28 2018</small></span>
									<a href="#">junna Dh</a>
								</div>
									<div class="post-share float-right">
										<ul class="list-inline footer-social mb-0">
										<li class="list-inline-item mb-2 mr-0"><a href=""><i class="fa fa-facebook"></i></a></li>
										<li class="list-inline-item mb-2 mr-0"><a href=""><i class="fa fa-google-plus"></i></a></li>
										<li class="list-inline-item mb-2 mr-0"><a href=""><i class="fa fa-twitter"></i></a></li>
										<li class="list-inline-item mb-2 mr-0"><a href=""><i class="fa fa-pinterest"></i></a></li>
										<li class="list-inline-item mb-2 mr-0"><a href=""><i class="fa fa-comments-o"></i></a></li>
									</ul>
									</div>

							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="artical-sidebar">
					<div class="popular-post-list bg-white rounded p-3 mb-4">
						<div class="pp-title">
							<h5 class="pb-2 border-bottom">Popolar Post</h5>
						</div>
						<div class="pp-list-grp">
							<ul class="list-unstyled">
							  <li class="media">
							  	<a href="#">
							    <img class="mr-3" src="images/ramadan-art-food.webp">
							    <div class="media-body">
							     <div class="pp-text">
							     	<a href="#">Festive Special: Best Ramadan Food to have in Hyderabad</a>
							     </div>
							    </div>
								</a>
							  </li>

							 <li class="media my-3">
							  	<a href="#">
							    <img class="mr-3" src="images/ramadan-art-food.webp">
							    <div class="media-body">
							     <div class="pp-text">
							     	<a href="#">Festive Special: Best Ramadan Food to have in Hyderabad</a>
							     </div>
							    </div>
								</a>
							  </li>
							</ul>
						</div>
					</div>

					<div class="social-widget bg-white p-3 mb-4">
						<div class="pp-title">
							<h5 class="pb-2 border-bottom">Subscribe & Follow</h5>
							<div class="post-share">
							<ul class="list-inline footer-social mb-0">
							<li class="list-inline-item mb-2"><a href=""><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item mb-2"><a href=""><i class="fa fa-google-plus"></i></a></li>
							<li class="list-inline-item mb-2"><a href=""><i class="fa fa-twitter"></i></a></li>
							<li class="list-inline-item mb-2"><a href=""><i class="fa fa-linkedin"></i></a></li>
							<li class="list-inline-item mb-2"><a href=""><i class="fa fa-pinterest"></i></a></li>
							<li class="list-inline-item mb-2"><a href=""><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
						</div>
					</div>

					<div class="latest-post-list bg-white rounded p-3 mb-4">
						<div class="pp-title">
							<h5 class="pb-2 border-bottom">Latest Post</h5>
						</div>
						<div class="pp-list-grp">
							<ul class="list-unstyled">
							  <li class="media">
							  	<a href="#">
							    <img class="mr-3" src="images/ramadan-art-food.webp">
							    <div class="media-body">
							     <div class="lt-text">
							     	<a href="#">Festive Special: Best Ramadan Food to have in Hyderabad</a>
							     	<p class="text-muted"><small> May 28, 2018</small></p>
							     </div>
							    </div>
								</a>
							  </li>

							 <li class="media my-3">
							  	<a href="#">
							    <img class="mr-3" src="images/ramadan-art-food.webp">
							    <div class="media-body">
							     <div class="lt-text">
							     	<a href="#">Festive Special: Best Ramadan Food to have in Hyderabad</a>
							     	<p class="text-muted"><small> May 28, 2018</small></p>
							     </div>
							    </div>
								</a>
							  </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</article>
</section>







<section id="blog" class="section">
      <!-- Container Starts -->
      <div class="container">
        <h1 class="section-title wow fadeInUpQuick animated" style="visibility: visible;">
          THE BLOG
        </h1>
        <p class="section-subcontent">It not just another blog <br> </p>
        <!-- Row Starts -->
        <div class="row">

        @foreach( $posts as $post)
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- Blog Item Starts -->
            <div class="blog-item-wrapper wow fadeIn animated" data-wow-delay="0.3s" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
              <div class="blog-item-img">
                <a href="{{ url('posts/'.$post->alias) }}">
                  @if(file_exists('./uploads/images/'.$post->image) && $post->image !='' )
                  <img src="{{ asset('uploads/images/'.$post->image) }}" alt="" class="img-responisve">
                  @else
                  <img src="{{ asset('uploads/images/no-image.png') }}" alt="" class="img-responisve">
                  @endif
                </a>
              </div>
              <div class="blog-item-text">
                <h3 class="small-title"><a href="{{ url('posts/'.$post->alias) }}">{{ $post->title }}</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, adipisicing elit. Eos rerum dolorum, est voluptatem modi accusantium perspiciatis ...
                </p>
                <div class="blog-one-footer">
                  <a href="{{ url('posts/'.$post->alias) }}">Read More</a>

                  <a href="#"><i class="icon-bubbles"></i> {{ $post->comments }} Comments</a>
                </div>
              </div>
            </div><!-- Blog Item Wrapper Ends-->
          </div>
          @endforeach



        </div><!-- Row Ends -->
        <div class="row text-center">
        {!!  $posts->links() !!}
        </div>
      </div><!-- Container Ends -->
    </section>

    <script type="text/javascript">
      $(function(){
        $("ul.pagination li a").addClass("page-link")
      })
    </script>
