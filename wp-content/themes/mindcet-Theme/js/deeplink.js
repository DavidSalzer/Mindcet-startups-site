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
	
	$('#aboutUs').slideUp();
	console.log(e);
	$('#contactUsForm').css({'left':(e.pageX-50)+'px','top':(e.pageY-760)+'px'});
	$('#contactUsForm form').show();
	$('#contactUsForm').fadeIn();
	return false;
});

$('.aboutUs').on('click',this,function(e){
	console.log(e);
	$('#contactUsForm').slideUp();
	$('.aboutUsMask').fadeIn('fast',function(){
		$('body').css('overflow','hidden');
		$('#aboutUs').fadeIn();
	});
	
	return false;
});

$('#contactUsForm .close').on('click',this,function(){
	$('#contactUsForm').slideUp();
	$('body').css('overflow','auto');
	$('#aboutUs').hide();
});

$('#aboutUs .close,.aboutUsMask').on('click',this,function(){
	$('#aboutUs').slideUp();
	$('.aboutUsMask').fadeOut();
		$('body').css('overflow','auto');

});

	
$('#cbtm').on('click',this,function(){
		sendMessage();
	});	

//addStartUp();

});//dom ready

function addStartUp(){
	$('#new_post').on('submit',this,function(e){	
	recaptcha_challenge=$("input#recaptcha_challenge_field").val();
	recaptcha_response=$("input#recaptcha_response_field").val();
	
	jQuery.post('wp-admin/admin-ajax.php', {
				action: 'addStartUp',
				recaptcha_challenge_field:recaptcha_challenge,
				recaptcha_response_field:recaptcha_response,
				
			}
			, function(data) {
				console.log(data);
					if(data=='ok'){
						return true;
					}else{
						alert('captcha is not valid');
						return false;
					}	
			});
			return false;
			e.preventDefault();	
	});
}


function setStar(){
	jQuery.post('wp-admin/admin-ajax.php', {
				postId:pid,
				action: 'addLike',
			}
			, function(data) {
					if(data=='fail'){
						alert('captcha is incorrect. please try again');
						return false;
					}else{
						return true;
					}	
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