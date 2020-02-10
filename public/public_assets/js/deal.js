
var pageNo = 1;

$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip()
	
    getAjaxTab();
    $('.fstoreiDs').on('change',function(){
		pageNo = 1;
        getAjaxTab();
      });
    $('.fcatiDs').on('change',function(){
		pageNo = 1;
        getAjaxTab();
     });
});


function loadMore()
{
	 pageNo++;
       $(".load-data").html("Loading....");
       getAjaxTab(true);
   
}

  function getAjaxTab(pagination = false) {


    var sf = '';
    var cf = '';
    var dealId = '';
    

	if(store_id)
		sf = store_id;
	else
	{
		$('.fstoreiDs:checked').each(function()
      {
        sf = sf+''+ jQuery(this).val() +',';
      });
	}
	if(cat_id)
		cf = cat_id;
		else
	{	
      $('.fcatiDs:checked').each(function()
        {
          cf = cf+''+ jQuery(this).val() +',';
        });
	}
      $.ajax({
        method:'post',
        cache: false,
        url:dealUrl,
        data: {'storeFilter':sf,'catFilter' : cf,'pageNo':pageNo,'deal_id' :dealId, '_token': $('input[name=_token]').val()} ,
        success:function(response){
           if(pagination === true) {
            if(response != '')
            {
                $('.remove-row').remove();
                $('#dealsData').append(response);
            }
            else
            {
                $('.nounderline').html("No Data");
            }
          }
          else {
            $('#dealsData').html(response);
          }
        },
          complete:function() {
			  
			  
  $('.deals-card .vote-box button').click( function(){
	  var myPar = $(this).parents('.deals-card');
	  var dealid = myPar.attr('id');
	  var action = 'up';
	  
	  /* if( $(this).hasClass('vote-up') )
	  { action = 'up' ; myPar.find('.cap-vote').text(  parseInt(myPar.find('.cap-vote').text())+1 );}
		else
		{ action = 'down' ; myPar.find('.cap-vote').text(  parseInt(myPar.find('.cap-vote').text())-1 );}
	   */
	   
	   if( $(this).hasClass('vote-up') ) action = 'up' ; else action = 'down' ;
	   
	   $.ajax({
        type: "POST",
        url: baseUrl+'/rateDeal',
        data: {'deal_id':dealid,'action' : action},
        success: function(response){
			if( parseInt(response)> 0 )
			{
			if( action =='up' )
	 myPar.find('.cap-vote').text(  parseInt(myPar.find('.cap-vote').text())+1 );
		else
		 myPar.find('.cap-vote').text(  parseInt(myPar.find('.cap-vote').text())-1 );	
	 
	 toastr.success('Successfully Voted  !', 'Success');
			}
			 else
				toastr.error('You have already Voted', 'Sorry!');
	 
	 
	 
		}
		});
		
		myPar.find('button').unbind( "click" );
	
  } );

        }
      });
      return false
  }