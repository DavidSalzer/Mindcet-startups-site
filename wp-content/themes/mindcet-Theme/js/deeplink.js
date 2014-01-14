// JavaScript Document
$(document).ready(function(e) {
    
	deep=window.location.hash;
	if(deep.length>0 && deep.indexOf('#')>-1){
		tid=deep.split('#')
		popuopInvent(tid[1]);
	}
	
	
$('.inventDescription').on('click','img.wp-post-image',function(){
		pid=$(this).attr('postid');
		setStar(pid);
	});	
	
$('.contactUs').on('click',this,function(e){
	$('#contactUsForm .loading').html('Sending...').hide();
	$('#cfirst').val('');
	$('#clast').val('');
	$('#cemail').val('');
	$('#cmessage').val('');
	
	console.log(e);
	$('#contactUsForm').css({'left':(e.pageX-50)+'px','top':(e.pageY-760)+'px'});
	$('#contactUsForm form').show();
	$('#contactUsForm').fadeIn();
	return false;
});

$('.aboutUs').on('click',this,function(e){
	console.log(e);
	$('#aboutUs').css({'left':(e.pageX-50)+'px','top':(e.pageY-760)+'px'});
	$('#aboutUs').show();
	$('#aboutUs').fadeIn();
	return false;
});

$('#contactUsForm .close').on('click',this,function(){
	$('#contactUsForm').slideUp();
	$('#aboutUs').hide();
});

$('#aboutUs .close').on('click',this,function(){
	$('#aboutUs').slideUp();
	$('#contactUsForm').hide();
});

	
$('#cbtm').on('click',this,function(){
		sendMessage();
	});	



});//dom ready



function setStar(pid){
	jQuery.post('wp-admin/admin-ajax.php', {
				postId:pid,
				action: 'addLike',
			}
			, function(data) {
				//alert(data);	
			});	

}

	
function sendMessage(){
	$('#contactUsForm form').hide();
	$('#contactUsForm .loading').show();
	
	var cfirst=$('#cfirst').val();
	var clast=$('#clast').val();
	var cemail=$('#cemail').val();
	var cmsg=$('#cmessage').val();

	jQuery.post('wp-admin/admin-ajax.php', {
				first:cfirst,
				last:clast,
				email:cemail,
				msg:cmsg,
				action: 'sendMesg',
			}
			, function(data) {
				$('#contactUsForm .loading').html(data);
					
			});

}