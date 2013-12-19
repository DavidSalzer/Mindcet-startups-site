// JavaScript Document
$(document).ready(function(e) {
	$('#inventScrollL').on('click',this,function(){
		scrollVal=$('#scrollInventorCon').scrollLeft()+500;
		$('#scrollInventorCon').animate( {scrollLeft: scrollVal}, 500,'easeOutBack');
	});
	
	$('#inventScrollR').on('click',this,function(){
		scrollVal=$('#scrollInventorCon').scrollLeft()-500;
		$('#scrollInventorCon').animate( {scrollLeft: scrollVal}, 500,'easeOutBack');
	});
	$('#judgesL').on('click',this,function(){
		scrollVal=$('.judgesContenar').scrollLeft()+300;
		$('.judgesContenar').animate( {scrollLeft: scrollVal}, 500,'easeOutBack');
	});
	
	$('#judgesR').on('click',this,function(){
		scrollVal=$('.judgesContenar').scrollLeft()-300;
		$('.judgesContenar').animate( {scrollLeft: scrollVal}, 500,'easeOutBack');
	});
	
	$('#offerStartUp').on('click',this,function(){
		$('.inventorPopUp').fadeIn(600,'easeInOutBack');
		return false;
	});
	
	$('.inventorPopUp .close').on('click',this,function(){
		$('.inventorPopUp').fadeOut(600,'easeInOutBack');
		return false;
	});

    $('.judgeDescription .close').on('click',this,function(){
		$('.judgeDescription').fadeOut(600,'easeInOutBack');
		return false;
	});
    $('.judgesAvantar').on('click',this,function(){
		$('.judgeDescription').fadeIn(600,'easeInOutBack');
		return false;
	});
    
	
});