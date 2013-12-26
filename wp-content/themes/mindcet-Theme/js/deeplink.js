// JavaScript Document
$(document).ready(function(e) {
    
	deep=window.location.hash;
	tid=deep.split('#')
	popuopInvent(tid[1]);
	
	$("#inventpop").mCustomScrollbar();
	
});

//scroll for tal
(function(){
	$(window).load(function(){
		$("#inventpop").mCustomScrollbar();
	});
})();
	