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
});



function setStar(pid){
	jQuery.post('wp-admin/admin-ajax.php', {
				postId:pid,
				action: 'addLike',
			}
			, function(data) {
				alert(data);	
			});	

}
	