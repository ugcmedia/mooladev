
<!-- Modal -->
<div class="modal fade" id="hwiVid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <button type="button" class="vid-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always">></iframe>
        </div>
      </div>
    </div>
  </div>
 </div>
 <style media="screen">
 .vid-close.close {
    position:absolute;
    right:-30px;
    top:0;
    z-index:999;
    font-size:2rem;
    font-weight: normal;
    color:#fff;
    opacity:1;
    }
 </style>
 <script type="text/javascript">
 $(document).ready(function() {

// Gets the video src from the data-src on each button

var $videoSrc;
$('.video-btn').click(function(event) {

  if($(this).attr('data-for') == 'video') {

    $videoSrc = $(this).data( "src" );
    // when the modal is opened autoplay it
    $('#hwiVid').on('shown.bs.modal', function (e) {

    // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
      $("#video").attr('src',$videoSrc + "?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1" );
    })
    // stop playing the youtube video when I close the modal
    $('#hwiVid').on('hide.bs.modal', function (e) {
      // a poor man's stop video
      $("#video").attr('src',$videoSrc);
    })
  }
  else{
    $('#join-us-modal').modal('show');
    $('#hwiVid').modal('show');
  }
});

});

 </script>
