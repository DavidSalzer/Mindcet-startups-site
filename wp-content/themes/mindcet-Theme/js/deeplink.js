// JavaScript Document
$(document).ready(function(e) {
    
	deep=window.location.hash;
	if(deep.length>0){
		tid=deep.split('#')
		popuopInvent(tid[1]);
	}
	
});

	