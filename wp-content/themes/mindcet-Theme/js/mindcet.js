   var maxSize=2;//mb
   var fileMesg='file is too big, Please ensure that file size is less than 2Mb.';
// JavaScript Document
var fromMarker=null;
$(document).ready(function (e) {
    
    initMap();
    showForm4();    
    showArrowsStartups();
    showArrowsJudges();
    showHighlight();

    //facebook click twice: like+unlike to fix align
    //$('#fb-like-site').click();
    //$('#fb-like-site').click();
           
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

    $('#offerStartUp').on('click', this, function (e) {
        openOfferPopUp();
        $('#formPart4').removeClass('show');
        $('#formPart4').hide();
        $('#formPart1').show();
        $('.next-page').css("display", "inline-block");
        $('#page-number-1').show();
        //openOfferPopUp();
        e.preventDefault();

    });

    $('.inventorPopUp .close').on('click', this, function () {
        $('.inventorPopUp').fadeOut(300, 'easeInOutBack');
        $('#formPart11,#formPart2,#formPart3,#page-number-1,#page-number-2,#page-number-3').hide();
      //  return false;
    });



    $('.next-page').on('click', this, function () {
        if ($('#formPart1').is(":visible")) {
            if (form1Validate()) {
                ga('send', 'event', 'button', 'click', 'add invent - 2');
                $('#formPart1').hide();
                $('#formPart2').show();
                $('.last-page').css("display", "inline-block");
                $('#page-number-1').hide();
                $('#page-number-2').show();
				
            }
            return true;
        }

        else if ($('#formPart2').is(":visible")) {
            if (form2Validate()) {
				$('.capchArea').show();
				$('.inventorPopUp').css('height','775px');
				$('.triangle').css('bottom','250px');
                ga('send', 'event', 'button', 'click', 'add invent - 3');
                $('#formPart2').hide();
                $('#page-number-2').hide();
                $('.next-page').css("display", "none");
                $('#formPart3').show();
                $('#page-number-3').show();
                $('.submit input').css("display", "inline-block");

                if (document.getElementById("title").value) { var title = document.getElementById("title").value; } else { title = "no title"; }
                //var logo = document.getElementById("logo").addEventListener('change', handleFileSelect, false);
                

                var youtubeUrl = document.getElementById("youtubeUrl").value;
                var invetName = document.getElementById("invetName").value;
                var description = document.getElementById("description").value;
                //var img1 = document.getElementById("img-1").addEventListener('change', handleFileSelect, false);
                var founderShow = document.getElementById("founder").value;


                var html = '       <div class="topArea">    '
                html += '           <div class="title ellipsis">' + title + '</div>';
                if(founderShow)
                html += '           <div class="name ellipsis"><b>Founders:</b> ' + founderShow + '</div>';
                
                // html +=                 logo;
                if (logoSrc != null)
                    html += '     <div class="startup-logo-form">  <img class="logo" src="' + logoSrc + '" alt="' + title + ' logo">   </div> ';
                html += '       </div>    ';

                html += '       <div class="mainArea">    ';
                html += '           <div class="description">' + description + '</div>';

                

                html += '           <div class="gallery">    ';
                if(youtubeUrl){
                    html+='         <div >'+getEmbedMovie(getMovieDataByURL(youtubeUrl),77,119)+'</div>';
                }
                if (ImgSrc1 != null)
                    html += '           <div>    <img class="gallery-img" src="' + ImgSrc1 + '" alt="' + title + ' img1">  </div>  ';
                if (ImgSrc2 != null)
                    html += '           <div>    <img class="gallery-img" src="' + ImgSrc2 + '" alt="' + title + ' img2">  </div>   ';
                if (ImgSrc3 != null)
                    html += '           <div>    <img class="gallery-img" src="' + ImgSrc3 + '" alt="' + title + ' img3"> </div>    ';
                html += '           </div>    ';
                html += '       </div>    ';
                html += '       <div class="bottomArea">    ';
                html += '           <label for="ads">';
                html += '               <input type="checkbox" id="ads" name="ads" value="yes" checked>';
                html += '               <span></span>I wish to receive interesting information about new EdTech startups.<br><br>';
                html += '           </label>    ';
                html += '           <label for="terms">';
                html += '               <input type="checkbox" id="terms" name="terms" checked>';
                html += '               <span></span> I accept the <a href="#" id="terms" target="_blank">terms</a> of the Global EdTech Startups Awards.<br>';
                html += '           </label>    ';
                html += '       </div>    ';

                var $inventDescription = $(html);
                $inventDescription.find('iframe').addClass("gallery-img");
                $('#formPart3').empty().prepend($inventDescription);
            }
        }


        return true;
    });

    $('.last-page').on('click', this, function () {
        $(".validate-error").hide();
        if ($('#formPart2').is(":visible")) {
            $('#formPart2').hide();
            $('#page-number-2').hide();
            $('.last-page').css("display", "none");
            $('.next-page').css("display", "inline-block");
            $('#formPart1').show();
            $('#page-number-1').show();
			
            return;
        }

        else if ($('#formPart3').is(":visible")) {
			$('.capchArea').hide();
			$('.inventorPopUp').css('height','666px');
			$('.triangle').css('bottom','138px');
            $('#formPart3').hide();
            $('#page-number-3').hide();
            $('#page-number-2').show();
            $('.submit input').css("display", "none");
            $('#formPart2').show();
            $('.next-page').show();
            $('.next-page').css("display", "inline-block");
			
        }

        return;
    });
    $('#new_post').on('submit', this, function(){
        if (document.getElementById(("ads")).checked && document.getElementById(("terms")).checked)
            return true;
        $("#validate-checkbox-error").show();
        return false;
    });

    var logoSrc = null;
    var ImgSrc1 = null;
    var ImgSrc2 = null;
    var ImgSrc3 = null;

    
    $("#logo").change(function (e) {
        
        //input.removeClass("error");
        $("#validate-img-error").hide();
        var size = document.getElementById("logo").files[0].size;
        size=size/1024/1024;
        if(size>maxSize){
            $("#validate-img-error").show();
            return false;
        }
        
        
        var fileName = $(this).val();
        var fileName = $(this).val().replace("C:\\fakepath\\","");
        $('.title-logo.logoimg').text(fileName);

        if ((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    console.log(e.target.result);
                    logoSrc = e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            console.log("noValidFile");
        }
    });
    $("#img-1").change(function (e) {
        $("#img-1").removeClass("error");
        var size = document.getElementById("img-1").files[0].size;
        size=size/1024/1024;
        if(size>maxSize){
            $("#img-1").addClass("error");
            $("#validate-img-error").show();
            return;
        }
        
        var fileName = $(this).val();
        var fileName = $(this).val().replace("C:\\fakepath\\","");
        $('.title-logo.img1').text(fileName);
        if ((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    console.log(e.target.result);
                    ImgSrc1 = e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            console.log("noValidFile");
        }
    });
    $("#img-2").change(function (e) {
        $("#img-2").removeClass("error");
        var size = document.getElementById("img-2").files[0].size;
        size=size/1024/1024;
        if(size>maxSize){
            $("#img-2").addClass("error");
            $("#validate-img-error").show();
            return;
        }

        var fileName = $(this).val().replace("C:\\fakepath\\","");
        $('.title-logo.img2').text(fileName);
        if ((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    console.log(e.target.result);
                    ImgSrc2 = e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            console.log("noValidFile");
        }
    });
    $("#img-3").change(function (e) {
        $("#img-3").removeClass("error");
        var size = document.getElementById("img-3").files[0].size;
        size=size/1024/1024;
        if(size>maxSize){
            $("#img-3").addClass("error");
            $("#validate-img-error").show();
            return;
        }

        var fileName = $(this).val();
        var fileName = $(this).val().replace("C:\\fakepath\\","");
        $('.title-logo.img3').text(fileName);
        if ((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    console.log(e.target.result);
                    ImgSrc3 = e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            console.log("noValidFile");
        }
    });

    //----------/end of form


    $('.judgeDescription').on('click','.close', this, function () {
        $('.judgeDescription').empty().append('<span class="close"></span>');
        $('.judgeDescription').slideUp(1000, 'easeInOutBack');
        $('.mask').removeClass('mask-judge');
        $('.mask').hide();
        $('body').css('overflow','auto');
        return false;
    });

    $('body').on('click','.mask-judge', this, function () {
            $('.judgeDescription .close').click();      
            return false;
        });

    $('.judgesAvantar').on('click', this, function () {
        $('.inventorPopUp .close').click();
        tid = $(this).attr('judgeId');
        $('body').css('overflow','hidden');
        $()
        $('.mask').show();
        $('.mask').addClass('mask-judge');
        
        $('.judgeDescription').slideDown(1000, 'easeInOutBack');
        var html = '       <div class="judgeDescriptionLeft">';
        html += '       <div class="judgeDescription-img">'+ allJudges[tid].imgProfile + '</div>    ';
        html += '               <div class="contactMe"><a href="mailto:' + allJudges[tid].email + '" >Contact Me</a></div>';
        html += '           </div>';
        html += '           <div class="judgeDescriptionRight">';
           html += '                <div class="judgeDescription-name">' +  allJudges[tid].name + '</div>';
        html += '               <div class="judgeDescription-role">' + allJudges[tid].role + '</div>';
        html += '               <div class="judgeDescription-full">' + allJudges[tid].descript + '</div>';
        html += '           </div>';
        html += '           <div class="judgeDescriptionMargin">';
        html += '           </div>';

        $('html, body').animate({
            scrollTop: $("#judgesCon").offset().top - 200
        }, 1000);

        var $judgeDescription = $(html);
        console.log(html);


        $('.judgeDescription').append($judgeDescription);

        return false;
    });


    updateMenuUrl();
    //hide popup when scrolling down
    $(document).on('scroll', this, function () {
        console.log($(document).scrollTop());
        setTimeout(function(){
        if ($(document).scrollTop() > 550) {
           $('#offer-zone').fadeOut("slow");
          $('#formPart11,#formPart2,#formPart3,#page-number-1,#page-number-2,#page-number-3').hide();

        }
        },500);

    });
    $('.inventList li').on('click', this, function () {
        tid = $(this).attr('idtec');
        popuopInvent(tid);
        //setIframe();
    });
    $('#best-logo-frame').on('click', this, function () {
        //tid = $(this).attr('idtec');
        popuopInvent(allTech["fev"]);
        //setIframe();
    });

    $('.inventHome li a').on('click', this, function () {
        e.preventDefault();

        //var category= $('.inventHome li a').attr('href').split('?cat=');
        //category=category[1];
        //
        //document.getElementById("scrollInventorCon").remove();
        //
        //var html= '<div id="scrollInventorCon"><span class="placholderSlide"></span><ul class="inventList">';
        //for (var prop in allTech){
        //    tid = $('.inventList li').attr('idtec');
        //    if(allTech.hasOwnProperty(tid))

        //    for (var j=0;j<3;j++){
        //            
        //    }
        //}
        //

        //    if (allTech[i].category.indexOf("category") != -1){
        //        html +='';
        //    }
        //    else{
        //        
        //    }
        
    });

    $(window).on('resize',function(){
    //  h=screen.height;
    //  $('.mask').css('height',h+'px');
    });


    $('body').on('click','#inventLikeFb,#inventTwiiwer,#inventLinkedin',function(){
        likeUrl=$(this).data('url');
        openInNewWindow(likeUrl);
    })

    $('body').on('click','.mapOpenInvent',function(e){   
    tid=$(this).attr('date-id');
    $('#marker-popup').fadeOut(300, 'easeInOutBack');
    popuopInvent(tid);
    e.preventDefault()
    return false;
 });

 $('.inventDescription .close').on('click', this, function () {
        $('#fbCount').remove();
        $('#twittCount').remove();
        
        $('.mask').removeClass('mask-invent');
        $('.mask').fadeOut('fast');
        $('body').css('overflow','auto');
        
        $('.inventDescription-append').empty();//.append('<span id="invent-close" class="close"></span>');
        $('.inventDescription').fadeOut('fast');
        //$('#id'+allTech[tid].techId).hide();
        var scr = document.body.scrollTop;

        window.location.hash = ' ';

        document.body.scrollTop = scr;
        //$('html, body').animate({
           // scrollTop: "550px"
      //  }, 0.3);
      
        //if come from marker popup
        var markerId=$("#marker-popup").attr("marker-id");
        if(markerId!=""){
            buildMarkerPopupHTML(markerId);            
        }
        return false;
    });

   $('.mask').on('click', this, function (e) {
     if($(e.target).attr("class") != "undefind" && $(e.target).attr("class").indexOf('mask')==0) { 
           $("#newsletter-popup").hide();
            //if from invent
            if($(e.target).hasClass("mask-invent")){
                $('.inventDescription .close').click();
            }
            //from marker
            else{
                $('#marker-popup .close').click();
            }
            $('.mask').fadeOut(800, 'easeInOutBack');
            if($("#newsletter-btn").hasClass("selected")){
                $("#newsletter-btn").removeClass("selected");
            }
            $("#newsletter-popup-error").hide();

            //$('.inventDescription .close').click();
            // $('#marker-popup').hide();
    }
    });

     $('#marker-popup').on('click', ".close", function () {
        //reset key-id to marker section
        $("#marker-popup").attr("marker-id","");
        
        //$('.inventDescription-append').empty();//.append('<span id="invent-close" class="close"></span>');
        $('#marker-popup').fadeOut(300, 'easeInOutBack');
        //$('#id'+allTech[tid].techId).hide();
        window.location.hash='';
        //$('html, body').animate({
        //    scrollTop: "550px"
        //}, 1);
        //$('.mask').removeClass('mask-invent');
        $('.mask').fadeOut(800, 'easeInOutBack');
        $('body').css('overflow','auto');
        return false;
    });

    $("#newsletter-btn").on("click",openNewsletter);
    $("#newsletter-popup-sign-btn").on("click",signToNewsletter);
}); //dom ready




function openOfferPopUp() {
    //disable_scroll();

    ga('send', 'event', 'button', 'click', 'add invent - 1');

    $('.inventorPopUp').fadeIn(400, 'easeInOutBack');
    $('html, body').animate({
        scrollTop: $("#offer-zone").offset().top - 154
    }, 500, function () { enable_scroll() });


    return false;

}

function popupall(allTech) {
    console.log(allTech);
}
function popupallJ(allJudges) {
    console.log(allJudges);
}
var saveVotesData;
function popupallV(allVotes) {
    console.log(allVotes);
    saveVotesData = allVotes;
}

getEmbedMovie = function (data, height, width) {
    if (data == null || data.type != "movie") return;
    if (!height) height = "215";
    if (!width) width = "342";
    if (data.movieType == "YouTube")
        return '<iframe width="' + width + '" height="' + height + '" src="//www.youtube.com/embed/' + data.id + '" frameborder="0" allowfullscreen></iframe>';
    else if (data.movieType == "Vimeo")
        return '<iframe width="' + width + '" height="' + height + '" src="//player.vimeo.com/video/' + data.id + '" frameborder="0" allowfullscreen></iframe>';
    return null;
}
getImgUrl = function (data) {
    //if (data==null || data.type!="movie") return;
    if (data == null) return;
    //if(data.movieType=="YouTube")
    return "http://img.youtube.com/vi/" + data.id + "/hqdefault.jpg"
    return null;
}

getMovieDataByURL = function (url) {
    $("#youtubeUrl").removeClass("error");
    //$(".validate-error").hide();
    if (url.indexOf('youtu.be') > 0 || url.indexOf('?v=') > 0 || url.indexOf('iframe') > 0 && url.indexOf('youtu') > 0) {

        var reg = new RegExp('(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})', 'g');
        var tubeId = reg.exec(url)[1];
        ans = {};
        ans.type = "movie";
        ans.movieType = "YouTube";
        ans.id = tubeId;
        return ans;
    }
    else {
        var vimeoId = self.getVimeoId(url);
        if (vimeoId != -1) {
            console.log(vimeoId)
            ans = {};
            ans.type = "movie";
            ans.movieType = "Vimeo";
            ans.id = vimeoId;
            return ans;
            //$(".uploadArea").append('<iframe width="'+100+'" height="'+100+'" src="//player.vimeo.com/video/'+vimeoId+'" ></iframe>');
        }

        else {
            if (url != "") {
                $("#youtubeUrl").addClass("error");
                $("#validate-general-error").show();
                return null;
            }
            else {
                return "noVideo";
            }
        }
    }
}

this.setMovieDataByURL = function (url) {
    console.log(url);   
    if (url.indexOf('youtu.be') > 0 || url.indexOf('?v=') > 0 || url.indexOf('iframe') > 0 && url.indexOf('youtu') > 0) {
        var reg = new RegExp('(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})', 'g');
        var tubeId = reg.exec(url)[1];


        $.ajax({
            url: "http://gdata.youtube.com/feeds/api/videos/" + tubeId + "?v=2&alt=jsonc",
            success: function (data) {
                if (url.indexOf('youtu.be') > 0 || url.indexOf('?v=') > 0 || url.indexOf('iframe') > 0 && url.indexOf('youtu') > 0) {
                    //var reg = new RegExp('(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})', 'g');
                    // var tubeId = reg.exec(url)[1];
                    ans = {};
                    ans.type = "movie";
                    ans.movieType = "YouTube";
                    ans.id = tubeId;

                    var imgUrl = self.getImgUrl(data.data);
                    titleUrl = data.data.title;
                    $('.moviePic').show();
                    $('.movieDetails').show();
                    $('.uploadArea-img').hide();
                    $(".uploadArea-movie").show();

                    $("figure.moviePic img").attr('src', imgUrl);

                    feedsController.changeInnerClass("movieTitle", titleUrl);

                    feedsController.changeInnerClass("movieKind", ans.movieType + " Movie");
                    feedsController.changeInnerClass("movieLink", url);

                }


            }
        });
    }

}

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function (theFile) {
            return function (e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
                $('.gallery-img')[0].insertBefore(span, null);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

function getVimeoId(url) {
    // look for a string with 'vimeo', then whatever, then a 
    // forward slash and a group of digits.
    var match = /vimeo.*\/(\d+)/i.exec(url);

    // if the match isn't null (i.e. it matched)
    if (match) {
        // the grouped/matched digits from the regex
        return match[1];
    }
    else {
        return -1;
    }
}


function updateMenuUrl() {
    //update the menu links to croll to sections in home page
    var navArray = ["#startups-banner", "#judges-banner", "#offer-zone"]
    // $(".topMenu ul li a").each(function(i){$(this).attr("href",navArray[i]);});
    //$(".footerMenu ul li a").each(function(i){$(this).attr("href",navArray[i]);});

    //add event to offer menu to open the offer popup
    $('a[href^="#offer-zone"]').on("click", openOfferPopUp);

    //scroll smooth
    $('a[href^="#"]').click(function () {    // Change to needed selector
        $("html, body").animate({    // Need both for full browser support
            scrollTop: $($(this).attr("href")).offset().top - 154 // Extra 100px
        }, 500);    // Change to desired scroll time in ms
        return false;    // Prevents the dreaded jump/flash
    });
}


//function to disable scrolling
var keys = [37, 38, 39, 40];

function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;
}

function keydown(e) {
    for (var i = keys.length; i--; ) {
        if (e.keyCode === keys[i]) {
            preventDefault(e);
            return;
        }
    }
}

function wheel(e) {
    preventDefault(e);
}

function disable_scroll() {
    if (window.addEventListener) {
        window.addEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = wheel;
    document.onkeydown = keydown;
}

function enable_scroll() {
    if (window.removeEventListener) {
        window.removeEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = document.onkeydown = null;
}



//////////////////////////

  function popuopInvent (tid) {
      //$('.inventDescription-append').empty();
        if ($('#formPart4').is(":hidden")){
            $('.inventorPopUp .close').click();
        }
        if(tid){
            window.location.hash=tid;
            ga('send', 'pageview',allTech[tid].title);
        }
        
        globalUrl=document.URL.split("#")[0];
        domUrl=document.URL;
        domUrlTweet=domUrl.replace('#','%23');
        domComments=ascii(domUrl);
        domLikes=globalUrl+'?initiator='+allTech[tid].title;
        domLikes=domLikes.split(" ").join("-");
        domLikes=domLikes.toLowerCase();
        permalink=allTech[tid].permalink;
        
        //  $('#like-frame').attr("src",globalUrl+'likeCount.htm?url='+allTech[tid].permalink);
        //$('#twittCount').attr('data-url',allTech[tid].permalink);
        //$('#twittCount').attr('data-text',allTech[tid].title+' Startup name is my favorite EdTech startup. What\'s yours?');
        $('#twittCount').remove();
        
        //$('#single-startup-zone .inventContener').append('<a href="https://twitter.com/share" id="twittCount" class="twitter-share-button" data-url="'+allTech[tid].permalink+'" data-text="'+allTech[tid].title+' is my favorite EdTech startup. What\'s yours?" data-count="vertical">Tweet</a>');
        //if($('#single-startup-zone').hasClass('twitterF')){
        //    twttr.widgets.load();
        //}
        //$('#single-startup-zone').addClass('twitterF');
        //
        //
        //$('#single-startup-zone .inventContener').append('<div class="fb-like" data-href="'+allTech[tid].permalink+'&postid='+allTech[tid].techId+'&logo='+allTech[tid].logo[0]+'" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false" id="fbCount"></div>');
        //
        setTimeout(function(){FB.XFBML.parse()},2000);
      
        $('#comments-frame').attr("src",globalUrl+'comment.php?url='+domComments+'&text='+allTech[tid].title+'&img='+allTech[tid].logo[0]+'&url='+allTech[tid].permalink);
        
        $('#inventTwitterCount').attr('data-url',allTech[tid].permalink).attr('data-text',allTech[tid].title);
        
        domLikes=document.URL.split("#")[0]+'?'+allTech[tid].techId+'#'+allTech[tid].techId;
        $('.fb-like.invent').attr("data-href",permalink);
        $('#id'+allTech[tid].techId).show();
        //http://www.facebook.com/sharer/sharer.php?s=100&p[url]=&p[images][0]=&p[title]=&p[summary]=
        //var fbUrl='http://www.facebook.com/sharer/sharer.php?s=100&p[url]='+domUrl+'&p[images][0]=&p[title]='+domUrl+'&p[summary]='+domUrl;
        var fbUrl='http://www.facebook.com/sharer/sharer.php?s=100&p[url]='+allTech[tid].permalink+'&p[title]=Global EdTech Startup Awards 2014&p[summary]='+allTech[tid].title +' is my favorite EdTech startup. What\'s yours?&p[images][0]='+allTech[tid].logo[0];//'&p[summary]='+ascii(domUrl)+
        var tweetUrl='http://twitter.com/intent/tweet?text='+allTech[tid].title +' is my favorite EdTech startup. Whart\'s yours?';
        var linkedinUrl='http://www.linkedin.com/shareArticle?mini=true&amp;url='+allTech[tid].permalink+'&amp;title=Global EdTech Startup Awards 2014&summary='+allTech[tid].title+' is my favorite EdTech startup. What\'s yours?';
        console.log(tid);
        console.log(allTech[tid]);
        var html = '       <div class="topArea">    ';
        if (allTech[tid].logo){
            if (allTech[tid].siteUrl.length > 0){
                html += ' <div class="startup-popup-logo"><a href="'+ allTech[tid].siteUrl +'"  target="_blank"><img class="wp-post-image" postid="'+allTech[tid].techId+'" src="' + allTech[tid].logo[0] + '" alt="' + allTech[tid].title + '" ></a></div>';
                }
            else {
                html += '<div class="startup-popup-logo"><img class="wp-post-image" postid="'+allTech[tid].techId+'" src="' + allTech[tid].logo[0] + '" alt="' + allTech[tid].title + '" ></div>';
                }
        }
        else{
            html += '<div class="startup-popup-logo"><img class="wp-post-image" postid="'+allTech[tid].techId+'"></div>';
        }
    if (allTech[tid].siteUrl.length > 0){
        html += '               <a href="' + allTech[tid].siteUrl + '" class="title ellipsis" target="_blank">' + allTech[tid].title + '</a>';
        }
    else {
        html += '               <div class="title ellipsis">' + allTech[tid].title + '</div>';
    }
    html += '               <div class="slogen">' + allTech[tid].slogen + '</div>';
    html += '       </div>    ';

        html += '       <div class="socialArea">    ';
      
      html+='              <div data-url="'+fbUrl+'" id="inventLikeFb"class="social fb" title="(Share on Facebook)" >Share on <span class="letter-space">Facbook</span></div>';
     //  html+='              <a href="'+fbUrl+':void(0);" class="social fb" title="(Share on Facebook)"  target="_">Share on <span class="letter-space">Facbook</span></a>';
        html+='             <div data-url="'+tweetUrl+'" id="inventTwiiwer" class="social twitter" title="(Tweet This Link)" >Share on <span class="letter-space">Twitter</span></div>';
        html+='             <div data-url="'+linkedinUrl+'" id="inventLinkedin" class="social linkedin" title="(Share on Linkedin)" >Share on <span class="letter-space">LinkedIn</span></div>';
      // html+=              '<div id="inventLikeCount" class="fb-like" data-href="'+allTech[tid].permalink+'" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>';             
       html += '          </div>    ';



    html += '       <div class="mainArea" id="inventpop">    ';

    $('#inventLikeCount').attr('data-href',allTech[tid].permalink);


    var videoIframe = getEmbedMovie(getMovieDataByURL(allTech[tid].youtube),300,480);
    if (videoIframe != undefined)
        html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(allTech[tid].youtube),300,480) + '</div>';
    if(allTech[tid].founder){
            html += '<div class="name ellipsis"><b>Founders:</b> ' + allTech[tid].founder + '</div>';
        }else{
            html +='<br>';
        }
        html += '<div class="description">' + allTech[tid].descript + '</div>';
    html += '           <div class="gallery">    ';
    allTech[tid].startupImg.forEach(function (img) {
        if (img != "") {
            html += '<div><img class="gallery-img" src="' + img + '" alt="' + allTech[tid].title + '"> </div>   ';
        }
    });
    html += '           </div>    ';
    html += '       </div>    ';

    youtube = allTech[tid].youtube;
    startupImg = allTech[tid].startupImg;
    
    h=$(window).height();
    $('body').css('overflow','hidden');

    $('.mask').fadeIn(200, 'easeInOutBack').css('height',h+'px');;
    $('.inventDescription').fadeIn(100, 'easeInOutBack');
    $('.mask').addClass('mask-invent');
    $('html, body').animate({
       // scrollTop: $("#invent-close").offset().top - 25
    }, 1);

    var $inventDescription = $(html);
   
    $('.inventDescription-append').append($inventDescription);

     $(".socialArea").prepend('<a href="https://twitter.com/share" id="twittCount" class="twitter-share-button social" data-url="'+allTech[tid].permalink+'" data-text="'+allTech[tid].title+' is my favorite EdTech startup. What\'s yours?" data-count="vertical">Tweet</a>');
        if($('#single-startup-zone').hasClass('twitterF')){
            twttr.widgets.load();
        }
        $('#single-startup-zone').addClass('twitterF');
        
        
        $(".socialArea").prepend('<div class="fb-like social" data-href="'+allTech[tid].permalink+'&postid='+allTech[tid].techId+'&logo='+allTech[tid].logo[0]+'" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false" id="fbCount"></div>');
        
    //$('.inventDescription .mainArea .movie iframe').delay(200).fadeIn(500, 'easeInOutBack');
    //$('.inventDescription .mainArea').delay(600).fadeIn(200, 'easeInOutBack');
     if($('#single-startup-zone').hasClass('twitterF')){
           setTimeout(function(){twttr.widgets.load();},2000);
        }
    //facebookCommentsLink()
    
    return false;
};

////////////////////////////////////////////////////////validate on all form's inputs
function generalValidate() {
    //StartUp Name
    validateEmptyInput($("#title"));

    //Invet email
    validateEmptyInput($("#email"));

    //Invet Name
    validateEmptyInput($("#invetName"));

    //Invet Name
    validateEmptyInput($("#slogen"));

    //email
    emailValidate($("#email"));

    //logo
    //validateLogo($(".title-logo.logoimg"));

    //Founder Mail
    emailValidate($("#founderMail"));

    //site
    validateSite($("#site"));
}

function form1Validate() {
    
    $(".validate-error").hide();
    
    //StartUp Name
    var title = validateEmptyInput($("#title"));

    //email not empty
    var emailNotEmpty=validateEmptyInput($("#email"));

    //Invet Name
    var invetName = validateEmptyInput($("#invetName"));

    //slogen
    //var slogen = validateEmptyInput($("#slogen"));
    
    //slogen's length
    var slogen8 = slogenValidate($("#slogen"));

    var selectOne=dropSelect();

    //emails
    var email = emailValidate($("#email"));
    var emailFounder = emailValidate($("#founderMail"));

    
    

    //logo
    //var logo = validateLogo($(".title-logo.logoimg"));

    if (selectOne==true &title & invetName & emailNotEmpty & (email == undefined || email) & (emailFounder == undefined || emailFounder)  & slogen8 )
        return true;
    return false;
}

function form2Validate() {
    
    $(".validate-error").hide();
    
    //StartUp Name
    var siteNotEmpty = validateEmptyInput($("#site"));

    //Invet description
    //var descriptNotEmpty=validateEmptyInput($("#description"));

    //description
    var descript = descriptionValidate($("#description"));

    //video
    var videotrue = (getMovieDataByURL($("#youtubeUrl").val()) != null);
    //videotrue = true;

    //site
    validateSite($("#site"));
    var site = true;

    if (siteNotEmpty & site & videotrue & descript)//& descriptNotEmpty 
        return true;
    return false;
}

//validate empty field
function validateEmptyInput(input) {
    if (input.val() == "") {
        input.addClass("error");
        $("#validate-general-error").show();
        return false;
        //alert(input.attr("id") + " is empty");
    }
    else {
        input.removeClass("error");
        $("#validate-general-error").hide();
        return true;
    }
}
//validate email field
function emailValidate(input) {
    var email = input.val();
    if (email != "") {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            input.addClass("error");
            //alert("email is not validate");
            $("#validate-general-error").show();
            return false;
        }
        else {
            input.removeClass("error");
            $("#validate-general-error").hide();
            return true;
        }
    }
}
//validate description field
function descriptionValidate(input){
    var words = $('#description').val().split(' ');
     if ($('#description').val()=="" ){
        input.addClass("error");
        $("#validate-general-error").show();
        return false;
    }
    else if (words.length>200 ){
        input.addClass("error");
        $("#validate-description-error").show();
        return false;
    }
    else{
        input.removeClass("error");
           // $("#validate-description-error").hide();
            //$("#validate-general-error").hide();
            return true;
    }
}

//validate slogen field
function slogenValidate(input){
    var words = $('#slogen').val().split('');
    if ( words.length>140 || input.val() == "") {
        input.addClass("error");
        $("#validate-slogen-error").show();
        if ( input.val() == "")
            $("#validate-general-error").show();
        return false;
    }
    else{
        input.removeClass("error");
        $("#validate-slogen-error").hide();
        return true;        
    }
}

//validate selected
function dropSelect(){
    catVal=$('#category').val();
    tagVal=$('#tags').val();
    if(catVal=='none' && tagVal=='none'){
        $('select#category, select#tags').addClass('needSelect');
        $('#validate-select-error').show();
            return false;    
    }else{
        $('select#category, select#tags').removeClass('needSelect');
        $('#validate-select-error').hide();
        return true;
    }

}
//validate webSite field
function validateSite(input) {
    //if there is not http
    if (input.val() != "") {
        if (input.val().indexOf("http") == -1) {
            input.val("http://" + input.val());
        }
    }
    else{
        $("#validate-general-error").show();
        return false;
    }
    //var regexp = /^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
    //if (!regexp.test(input.val())) {
    //    alert("site no validate");
    //}
}

function validateLogo(img) {
    if (img.text() == "Logo") {
        $(".formfield.input-border").addClass("error");
        $("#validate-general-error").show();
        return false;
    }
    $(".formfield.input-border").removeClass("error");
    $("#validate-general-error").hide();
    return true;
}

function showArrowsStartups(){
 if ($(".inventors .inventList li").length > 12){
     $("#inventScrollR .rightScroll-arrow").show();
     $("#inventScrollL .leftScroll-arrow").show();
 }else{
     $("#inventScrollR .rightScroll-arrow").hide();
     $("#inventScrollL .leftScroll-arrow").hide();
 } 
}
function showArrowsJudges(){
 if ($(".judgesContenar .judgesAvantar").length > 5){
     $("#judgesR .rightScroll-arrow").show();
     $("#judgesL .leftScroll-arrow").show();
 }   
}

function showHighlight(){
    var best=allTech["fev"];
    var html = '<img class="best-logo" src="'+allTech[best].logo[0]+'" alt="'+allTech[best].title+' logo">';
    $('#best-logo-frame').empty().append(html);
    var html = '<div class="best-description">'+allTech[best].descript+'</div>';
    $('#best-invent-description').empty().append(html);
}

function showForm4(){
   
    if ($('#formPart4').hasClass('show')){
         ga('send', 'event', 'button', 'click', 'add invent - success');
        $('#offer-zone').show();
        $('.next-page').css("display", "none");
        $('.last-page').css("display", "none");
        $('.submit input').css("display", "none");
        $('.last-page').css("display", "none");
        $('#formPart1').hide();
        $('#page-number-1').hide();
        $('#formPart4').show();
        //$('#formPart4').css("display", "inline-block");
    }
    else{
         $('#offer-zone').hide();
    }
}

function openInNewWindow(url, width, height)
   {
    var win=window.open(url, '_blank', menubar=0, height=100, width=100);
    //win.focus();
    return false;
}

function ascii(url){
    var urlAscii=url.split('3').join('%33').split('1').join('%31').split('2').join('%32').split('4').join('%34').split('5').join('%35').split('6').join('%36').split('7').join('%37').split('8').join('%38').split('9').join('%39').split('0').join('%30').split('#').join('%23').split(':').join('%3A').split('/').join('%2F');
    return urlAscii;
}

//function setIframe(){
//        globalUrl=document.URL.split("#")[0];
//      domUrl=document.URL;
//       
//        $('#comments-frame').attr("src",''+globalUrl+'comment.htm?url='+ domUrl+'');
//        //alert($('#comments-frame').attr("src"));
//}
/////////////////////////////////////////////////////////////////////////end validation

/////////////////////////////////////////////////////////////////////////start google map
 
var map;
var markers = [];
var favoritesByMarker = [];
 
function initMap() {
 
    // Create an array of styles.
    var styles = [
        {
            "featureType": "landscape",
            "stylers": [
            { "color": "#5cb480" }
        ]
        }, {
            "featureType": "water",
            "stylers": [
            { "color": "#0c4480" },
            { "lightness": 75 }
        ]
        }
    ];
 
    // Create a new StyledMapType object, passing it the array of styles,
    // as well as the name to be displayed on the map type control.
    var styledMap = new google.maps.StyledMapType(styles,
    { name: "Styled Map" });
 
    var options = {
        streetViewControl: false,
        center: new google.maps.LatLng(0, 0),
        zoom: 1,
    //    disableDefaultUI: true,
    //disableDoubleClickZoom: true,
        draggable: false,
      //  maxZoom:1,
        minZoom:1

    };
 
    map = new google.maps.Map(document.getElementById("map"), options);
 
    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
 
    setMarkers(saveVotesData);
}
var placeInsaveVotesData = 0;
var savePlaceInVotesData = [];
// Add a marker to the map and push to the array.
function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markers.push(marker);
 
    //save favorites linked to the marker
    savePlaceInVotesData[marker.__gm_id] = placeInsaveVotesData++;
 
    google.maps.event.addListener(marker, 'click', function () {
        var key = savePlaceInVotesData[marker.__gm_id];
        buildMarkerPopupHTML(key);
    });
}
 
function setMarkers(allMarkers) {
 
    for (marker in allMarkers) {
        //convert to latLng
        var myLatlng = new google.maps.LatLng(parseFloat(allMarkers[marker].lat), parseFloat(allMarkers[marker].lon));
        //create marker push marker to array
        addMarker(myLatlng);
    }
    //show markers on map
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
        console.log(markers[i]);
    }
}
 
function buildMarkerPopupHTML(key) {

    ga('send', 'pageview',saveVotesData[key].title);
    console.log(saveVotesData[key].logo[0]);
    console.log(saveVotesData[key].descript);
    console.log(saveVotesData[key].title);
    var globalUrl=document.URL.split("#")[0];
        domUrl=document.URL;
        domUrlTweet=domUrl.replace('#','%23');
        domComments=ascii(domUrl);
        domLikes=globalUrl+'?votes='+saveVotesData[key].title;
        domLikes=domLikes.split(" ").join("-");
        domLikes=domLikes.toLowerCase();
        permalink=saveVotesData[key].permalink;

    $('#comments-marker').attr("src",globalUrl+'comment.php?url='+saveVotesData[key].parmalink+'&text='+saveVotesData[key].title+'&img='+saveVotesData[key].logo[0]+'&url='+saveVotesData[key].parmalink);


    var fbUrl='http://www.facebook.com/sharer/sharer.php?s=100&p[url]='+saveVotesData[key].parmalink+'&p[title]=Global EdTech Startup Awards 2014&p[summary]='+saveVotesData[key].title +'  favorite EdTech startup.?&p[images][0]='+ saveVotesData[key].logo[0];//'&p[summary]='+ascii(domUrl)+
    var tweetUrl='http://twitter.com/intent/tweet?text='+ saveVotesData[key].title +' favorite EdTech startup. ';
    var linkedinUrl='http://www.linkedin.com/shareArticle?mini=true&amp;url='+ saveVotesData[key].parmalink+'&amp;title=Global EdTech Startup Awards 2014&summary='+ saveVotesData[key].title+' favorite EdTech startup.';
    
   var html= '       <div class="socialArea">    ';
    html+='              <div data-url="'+fbUrl+'" id="inventLikeFb"class="social fb" title="(Share on Facebook)" >Share on <span class="letter-space">Facbook</span></div>';
    html+='             <div data-url="'+tweetUrl+'" id="inventTwiiwer" class="social twitter" title="(Tweet This Link)" >Share on <span class="letter-space">Twitter</span></div>';
    html+='             <div data-url="'+linkedinUrl+'" id="inventLinkedin" class="social linkedin" title="(Share on Linkedin)" >Share on <span class="letter-space">LinkedIn</span></div>';
    html += '          </div>    ';

     html += '<div class="topArea">    '
    if (saveVotesData[key].logo)
        html += '<div class="startup-popup-logo">  <img class="wp-post-image logo" src="' + saveVotesData[key].logo[0] + '" alt="' + saveVotesData[key].title + ' logo">   </div> ';
    html += '</div>    ';
 
    html += '<div class="mainArea">    ';
 
    html += '<div class="popup-title">' + saveVotesData[key].title + '</div>';
 
    html += '<div class="description"><p dir="ltr" style="text-align: left;">' + saveVotesData[key].descript + '</p></div>';
 
    html += '<div class="startups-gallery">    ';
 
    html += '<div class="startups-gallery-header">';
//    html += '   <img class="gallery-img" src="'+ globalUrl +'wp-content/uploads/2014/01/final-logo2.png" alt="Class Messenger">';
    html += '   <span>Our Top 10 Startups</span>';
    html += '</div>';
 
    for (var favorite in saveVotesData[key].favId) {
        console.log(allTech[saveVotesData[key].favId[favorite]]);
        html += '<div class="startups-gallery-item">';
       
       if(allTech[saveVotesData[key].favId[favorite]].logo[0]){
         html += '<div class="startups-gallery-item-frame">';
            html +='<a href="'+ allTech[saveVotesData[key].favId[favorite]].siteUrl+'"" target="_blank" >';
            html += '<img class="gallery-img" src="' + allTech[saveVotesData[key].favId[favorite]].logo[0] + '" alt="Class Messenger">';
            html +='</a>';
         html += '   </div>';
           
        }
        html += '<div class="leftSide"><span class="gallery-description title"><a href="#" class="mapOpenInvent" date-id="'+allTech[saveVotesData[key].favId[favorite]].techId+'">' + allTech[saveVotesData[key].favId[favorite]].title + '</a></span>';
        html += '<span class="gallery-description">' + allTech[saveVotesData[key].favId[favorite]].slogen + '</span>';
        if(allTech[saveVotesData[key].favId[favorite]].founder)
        html += '<span class="gallery-description"><b>Founder: </b>' + allTech[saveVotesData[key].favId[favorite]].founder + '</span>';
        html += ' </div>  </div>';
    }
    html += '   </div>';
    html += '</div>';
 
    var $inventDescription = $(html);
    $('.popupDescription-append').empty().append($inventDescription);

    //add key-id to marker section
    $("#marker-popup").attr("marker-id",key);

    h=$(window).height();
    $('body').css('overflow','hidden');
    
    $('.mask').fadeIn(200, 'easeInOutBack').css('height',h+'px');;
    $('#marker-popup').fadeIn(100, 'easeInOutBack');
    //$('.mask').addClass('mask-invent');
    $('html, body').animate({
        scrollTop: $("#invent-close").offset().top - 25
    }, 1);
    
    


//$('body').on('click','.mapOpenInvent',function(e){
//    tid=$(this).attr('date-id');
//    $('#marker-popup').fadeOut(300, 'easeInOutBack');
//    popuopInvent(tid);
//    e.preventDefault()
//    return false;
// });
}
 
//$("#marker-popup").on("click",".close",function(){
//    $('#marker-popup').fadeOut(600, 'easeInOutBack');
//});
// 
 
 
//////////////////////////////end google map///////////////////////////////////////////

//upload file button - wotre for ie but now all browsers use it
function getFile(id){
   $(id).click();
 }
 function sub(obj){
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("yourBtn").innerHTML = fileName[fileName.length-1];
    document.myForm.submit();
    event.preventDefault();
  }

  function openNewsletter(){
    $("#newsletter-btn").addClass("selected");
    h=$(window).height();
    $('body').css('overflow','hidden');
    $("#newsletter-popup").show();
    $('.mask').fadeIn(200, 'easeInOutBack').css('height',h+'px');;
  }

  function signToNewsletter(){
      var mail=$("#newsletter-popup input")
      if(emailValidate(mail)){
         emailUser=$('#registerNews').val();
			
			jQuery.post('wp-admin/admin-ajax.php', {
						mail:emailUser,
						action: 'registerNews',
					}
					, function(data) {
						alert(data);
			});	
		
      }
      else{
          $("#newsletter-popup-error").fadeIn(200, 'easeInOutBack');
      }
  }
 