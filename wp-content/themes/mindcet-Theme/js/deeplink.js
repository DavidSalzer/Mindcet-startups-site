// JavaScript Document
$(document).ready(function(e) {
    
	deep=window.location.hash;
	if(deep.length>0){
		tid=deep.split('#')
		popuopInvent(tid[1]);
	}
	
	
$('.inventDescription').on('click','img.wp-post-image',function(){
		pid=$(this).attr('postid');
		setStar(pid);
	});	
	
$('.contactUs').on('click',this,function(){
	$('#contactUsForm .loading').html('Sending...').hide();
	$('#cfirst').val('');
	$('#clast').val('');
	$('#cemail').val('');
	$('#cmessage').val('');

	$('#contactUsForm form').show();
	$('#contactUsForm').fadeIn();
	return false;
});

$('#contactUsForm .close').on('click',this,function(){
	$('#contactUsForm').slideUp();
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
				alert(data);	
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