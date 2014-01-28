$(document).ready(function(e) {
  $('#categoryNav,#tagsNav').on('change',this,function(){
  	setTimeout(function (){
		catId=$('#categoryNav').val();
		tagName=$('#tagsNav').val();
		buildCatGallery(catId,tagName);
	},500);
  });
  

    
});	



function buildCatGallery(catId,tagName){
	
	if(tagName=='none'){
		tagName='';
	}
	if(catId=='none'){
		catId='';
	}
	
	jQuery.post('wp-admin/admin-ajax.php', {
				catId:catId,
				tagName:tagName,
				action: 'catGallery',
			}
			, function(data) {
				console.log(data);
				//$('.inventList').fadeOut();
				$('#scrollInventorCon').html(data);
				//$('.inventList').fadeIn();	
				 if ($(".inventors .inventList li").length > 12){
				     $("#inventScrollR .rightScroll-arrow").show();
				     $("#inventScrollL .leftScroll-arrow").show();
				 }else{
				     $("#inventScrollR .rightScroll-arrow").hide();
				     $("#inventScrollL .leftScroll-arrow").hide();
				 } 

			$('.inventList li').on('click', this, function () {
        		tid = $(this).attr('idtec');
        		popuopInvent(tid);
        //setIframe();
    			});
			});

}