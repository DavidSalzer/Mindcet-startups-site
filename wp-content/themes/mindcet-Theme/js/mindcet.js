// JavaScript Document
$(document).ready(function (e) {
    $('#inventScrollR').on('click', this, function () {
        scrollVal = $('#scrollInventorCon').scrollLeft() + 500;
        $('#scrollInventorCon').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');
    });

    $('#inventScrollL').on('click', this, function () {
        scrollVal = $('#scrollInventorCon').scrollLeft() - 500;
        $('#scrollInventorCon').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');
    });
    $('#judgesR').on('click', this, function () {
        scrollVal = $('.judgesContenar').scrollLeft() + 300;
        $('.judgesContenar').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');
    });

    $('#judgesL').on('click', this, function () {
        scrollVal = $('.judgesContenar').scrollLeft() - 300;
        $('.judgesContenar').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');
    });

    //-------form------

    $('.menu-item-53').on('click', this, function () {
        $('.inventorPopUp').fadeIn(600, 'easeInOutBack');
        $(document).scrollTo('#offerStartUp');
        $(document).scrollTo('.header');
        return false;
    });

    $('#offerStartUp').on('click', this, function () {
        $('.inventorPopUp').fadeIn(600, 'easeInOutBack');
        return false;
    });

    $('.inventorPopUp .close').on('click', this, function () {
        $('.inventorPopUp').fadeOut(600, 'easeInOutBack');
        return false;
    });

    $('.next-page').on('click', this, function () {
        if ($('#formPart1').is(":visible")){
            $('#formPart1').hide();
            $('#formPart2').show();
            $('.last-page').css("display", "inline-block");
            $('#page-number-1').hide();
            $('#page-number-2').show();
           
            //$('.next-page').on('click', this, function () {
            //    if ($('#formPart2').length > 0 ){
            //        $('#formPart2').hide();
            //        $('#page-number-2').hide();
            //        $('.next-page').css("display", "none");
            //        $('#formPart3').show();
            //        $('#page-number-3').show();
            //        $('.submit').css("display", "inline-block");
            //
            //    }
            //    return false;
            //});
            return true;
        }
        
        else if ($('#formPart2').is(":visible")){
            $('#formPart2').hide();
            $('#page-number-2').hide();
            $('.next-page').css("display", "none");
            $('#formPart3').show();
            $('#page-number-3').show();
            $('.submit').css("display", "inline-block");
        }
        
        return false;
    });

    $('.last-page').on('click', this, function () {
        if ($('#formPart2').is(":visible")){
            $('#formPart2').hide();
            $('#page-number-2').hide();
            $('.last-page').css("display", "none");
            $('.next-page').css("display", "inline-block");
            $('#formPart1').show();
            $('#page-number-1').show();
            return;
        }
        
        else if ($('#formPart3').is(":visible")){
            $('#formPart3').hide();
            $('#page-number-3').hide();
            $('#page-number-2').show();
            $('.submit').css("display", "none");
            $('#formPart2').show();
            $('.next-page').show();
            $('.next-page').css("display", "inline-block");
        }
        
        return false;
    });
    $('.judgeDescription .close').on('click', this, function () {
        $('.judgeDescription').fadeOut(600, 'easeInOutBack');
        return false;
    });
    $('.judgesAvantar').on('click', this, function () {
        $('.judgeDescription').fadeIn(600, 'easeInOutBack');
        return false;
    });


    $('.inventList li').on('click', this, function () {

        tid = $(this).attr('idtec');

        var html = '       <div class="topArea">    '
        html += '		    <div class="title ellipsis">' + allTech[tid].title + '</div>';
        html +=             allTech[tid].logo;
        html += '       </div>    ';

        html += '       <div class="socialArea">    ';
        html += '           <div class="social fb"></div>    ';
        html += '           <div class="social twitter"></div>    ';
        html += '           <div class="social linkedin"></div>    ';
        html += '           <div class="social likes"></div>    ';
        html += '       </div>    ';

        html += '       <div class="mainArea">    ';
        html += '           <div class="movie"></div>    ';
        html += '		    <div class="name ellipsis">' + allTech[tid].name + '</div>';
        html += '		    <div class="description">' + allTech[tid].descript + '</div>';
        html += '           <div class="gallery">    ';
        html += '               <img class="gallery-img" src="' + allTech[tid].startupImg[0] + '" alt="' + allTech[tid].title + ' img1">    ';
        html += '               <div class="gallery-img"></div>    ';
        html += '               <div class="gallery-img"></div>    ';
        html += '           </div>    ';
        html += '           <div class="fb-comments"></div>    ';
        html += '       </div>    ';

        youtube = allTech[tid].youtube;
        startupImg = allTech[tid].startupImg;
        $('.inventDescription').fadeIn(600, 'easeInOutBack');
        $('.mask').fadeIn(600, 'easeInOutBack');

        var $inventDescription = $(html);
        $('.inventDescription').append($inventDescription);

        $('.inventDescription .close').on('click', this, function () {
            $('.inventDescription').empty().append('<span id="invent-close" class="close">x</span>');
            $('.inventDescription').fadeOut(600, 'easeInOutBack');
            $('.mask').fadeOut(600, 'easeInOutBack');
            return false;
        });

        return false;
    });


});

function popupall(allTech){
 console.log(allTech);
}


 //$('.page-1-buttons .next-page').on('click', this, function () {
 //       if ($('#formPart1').length > 0 ){
 //           $('#formPart1').hide();
 //           $('#formPart2').show();
 //           $('.page-2-buttons .last-page').css("display", "inline-block");
 //           $('.page-1-buttons .next-page').css("display", "none");
 //           $('.page-2-buttons .next-page').css("display", "inline-block");
 //           $('#page-number-1').hide();
 //           $('#page-number-2').show();
 //       }
 //       return false;
 //   });

 //   $('.page-2-buttons .next-page').on('click', this, function () {
 //       if ($('#formPart2').length > 0 ){
 //           $('#formPart2').hide();
 //           $('#page-number-2').hide();
 //           $('.page-2-buttons .next-page').css("display", "none");
 //           $('.page-2-buttons .last-page').css("display", "none");
 //           $('.page-3-buttons .last-page').css("display", "inline-block");
 //           $('#formPart3').show();
 //           $('#page-number-3').show();
 //           $('.submit').css("display", "inline-block");
 //       }
 //       
 //       return false;
 //   });

 //   $('.page-2-buttons .last-page').on('click', this, function () {
 //       if ($('#formPart2').length > 0 ){
 //           $('#formPart2').hide();
 //           $('#page-number-2').hide();
 //           $('.page-2-buttons .last-page').css("display", "none");
 //           $('.page-2-buttons .next-page').css("display", "none");
 //           $('.page-1-buttons .next-page').css("display", "inline-block");
 //           $('#formPart1').show();
 //           $('#page-number-1').show();
 //       }
 //       
 //       return false;
 //   });

 //   $('.page-3-buttons .last-page').on('click', this, function () {
 //       if ($('#formPart3').length > 0 ){
 //           $('#formPart3').hide();
 //           $('#page-number-3').hide();
 //           $('#page-number-2').show();
 //           $('.submit').css("display", "none");
 //           $('#formPart2').show();
 //           $('.page-3-buttons .last-page').css("display", "none");
 //           $('.page-2-buttons .last-page').css("display", "inline-block");
 //           $('.page-2-buttons .next-page').css("display", "inline-block");
 //       }
 //       return false;
 //   });
