   var maxSize=2;//mb
   var fileMesg='file is too big, Please ensure that file size is less than 2Mb.';
// JavaScript Document
$(document).ready(function (e) {
    
    showForm4();    
    showArrowsStartups();
    showArrowsJudges();
    
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
        $('.inventorPopUp').fadeOut(600, 'easeInOutBack');
        return false;
    });



    $('.next-page').on('click', this, function () {
        if ($('#formPart1').is(":visible")) {
            if (form1Validate()) {
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



                var html = '       <div class="topArea">    '
                html += '		    <div class="title ellipsis">' + title + '</div>';
                html += '		    <div class="name ellipsis">' + invetName + '</div>';

                // html +=                 logo;
                if (logoSrc != null)
                    html += '     <div class="startup-logo-form">  <img class="logo" src="' + logoSrc + '" alt="' + title + ' logo">   </div> ';
                html += '       </div>    ';

                //html += '       <div class="socialArea">    ';
                //html += '           <div class="social fb"></div>    ';
                //html += '           <div class="social twitter"></div>    ';
                //html += '           <div class="social linkedin"></div>    ';
                //html += '           <div class="social likes"></div>    ';
                //html += '       </div>    ';

                html += '       <div class="mainArea">    ';
                //html += '           <img class="movie" src="' + getImgUrl(getMovieDataByURL(youtubeUrl)) + '" /><span class="play_button"></span> ' + '</div>    ';
                var videoIframe = getEmbedMovie(getMovieDataByURL(youtubeUrl), 140, 225);
                if (videoIframe != undefined)
                    html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(youtubeUrl), 140, 225) + '</div>';
                html += '		    <div class="description">' + description + '</div>';
                html += '           <div class="gallery">    ';
                if (ImgSrc1 != null)
                    html += '           <div>    <img class="gallery-img" src="' + ImgSrc1 + '" alt="' + title + ' img1">  </div>  ';
                if (ImgSrc2 != null)
                    html += '           <div>    <img class="gallery-img" src="' + ImgSrc2 + '" alt="' + title + ' img2">  </div>   ';
                if (ImgSrc3 != null)
                    html += '           <div>    <img class="gallery-img" src="' + ImgSrc3 + '" alt="' + title + ' img3"> </div>    ';
                html += '           </div>    ';
                //html += '           <div class="fb-comments"></div>    ';
                html += '       </div>    ';
                html += '       <div class="bottomArea">    ';
                html += '           <label for="ads">';
                html += '               <input type="checkbox" id="ads" name="ads" checked>';
                html += '               <span></span>I accept to get intersting information about new EdTech startups.<br><br>';
                html += '           </label>    ';
                html += '           <label for="terms">';
                html += '               <input type="checkbox" id="terms" name="terms" checked>';
                html += '               <span></span>I accept the terms of the EdTech Startups competition.<br>';
                html += '           </label>    ';
                html += '       </div>    ';

                var $inventDescription = $(html);
                $('#formPart3').empty().prepend($inventDescription);
            }
        }


        return true;
    });

    $('.last-page').on('click', this, function () {
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
            //alert(fileMesg);
            //input.addClass("error");
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
		$('.mask').hide();
        return false;
    });

    $('.judgesAvantar').on('click', this, function () {
        $('.inventorPopUp .close').click();
        tid = $(this).attr('judgeId');
		$('.mask').show();
		
        $('.judgeDescription').slideDown(1000, 'easeInOutBack');
        //imgProfile = allJudges[tid].imgProfile;

        //var html = '    <span class="close">x</span>';
        var html = '       <div class="judgeDescriptionLeft">';
        //allJudges[tid].imgProfile.forEach(function(imgProfile){
        //    if(imgProfile!=""){
                html += '       <div class="judgeDescription-img">'+ allJudges[tid].imgProfile + '</div>    ';
        //    }
        //});
        html += '               <div class="contactMe"><a href="mailto:' + allJudges[tid].email + '" >Contact Me</a></div>';
        html += '           </div>';
        html += '           <div class="judgeDescriptionRight">';
        html += '                <div class="judgeDescription-name">' +  allJudges[tid].name + '</div>';
        html += '               <div class="judgeDescription-role">' + allJudges[tid].role + '</div>';
        html += '               <div class="judgeDescription-full">' + allJudges[tid].descript + '</div>';
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
        }
		},500);

    });
    $('.inventList li').on('click', this, function () {
        tid = $(this).attr('idtec');
        popuopInvent(tid);
    });

    //$('.inventHome li').on('click', this, function () {
    //    
    //    
    //});



}); //dom ready


function openOfferPopUp() {
    //disable_scroll();
    $('.inventorPopUp').fadeIn(1500, 'easeInOutBack');
    $('html, body').animate({
        scrollTop: $("#offer-zone").offset().top - 160
    }, 500, function () { enable_scroll() });


    return false;

}

function popupall(allTech) {
    console.log(allTech);
}
function popupallJ(allJudges) {
    console.log(allJudges);
}

function facebookCommentsLink() {
    $("#facebook-comments .fb-comments").attr("data-href", window.location.href);
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
    $(".validate-error").hide();
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
            scrollTop: $($(this).attr("href")).offset().top - 160 // Extra 100px
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
        if ($('#formPart4').is(":hidden")){
            $('.inventorPopUp .close').click();
        }
		if(tid){window.location.hash=tid;}
		domUrl=document.URL;
        domUrlTweet=domUrl.replace('#','%23');
        var fbUrl='http://www.facebook.com/sharer/sharer.php?s=100&p[url]='+domUrl+'&p[images][0]=&p[title]=&p[summary]=';
        var tweetUrl='http://twitter.com/intent/tweet?text='+domUrlTweet;
        var linkedinUrl='http://www.linkedin.com/shareArticle?mini=true&amp;url='+domUrl;
        console.log(tid);
		console.log(allTech[tid]);
    var html = '       <div class="topArea">    ';
   
    html += '<div class="startup-popup-logo"><img class="wp-post-image" postid="'+allTech[tid].techId+'" src="' + allTech[tid].logo[0] + '" alt="' + allTech[tid].title + '" ></div>';
   
    if (allTech[tid].siteUrl.length > 0){
        html += '		        <a href="' + allTech[tid].siteUrl + '" class="title ellipsis">' + allTech[tid].title + '</a>';
        }
    else {
        html += '		        <div class="title ellipsis">' + allTech[tid].title + '</div>';
    }
   
    html += '       </div>    ';

        html += '       <div class="socialArea">    ';
	   html+='              <div onClick="openInNewWindow('+"'"+fbUrl+"'"+')" class="social fb" title="(Share on Facebook)" >Share on <span class="letter-space">Facbook</span></div>';
        html+='             <div onClick="openInNewWindow('+"'"+tweetUrl+"'"+')" class="social twitter" title="(Tweet This Link)" >Share on <span class="letter-space">Twitter</span></div>';
        html+='             <div onClick="openInNewWindow('+"'"+linkedinUrl+"'"+')" class="social linkedin" title="(Share on Linkedin)" >Share on <span class="letter-space">LinkedIn</span></div>';
        
       html += '          </div>    ';



    html += '       <div class="mainArea" id="inventpop">    ';
    //html += '           <img class="movie" src="' + getImgUrl(getMovieDataByURL(allTech[tid].youtube)) + '" /><span class="play_button"></span> ' + '</div>    ';
    var videoIframe = getEmbedMovie(getMovieDataByURL(allTech[tid].youtube),300,480);
    if (videoIframe != undefined)
        html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(allTech[tid].youtube),300,480) + '</div>';
    //html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(allTech[tid].youtube)) +'</div>';
    html += '		    <div class="name ellipsis">' + allTech[tid].name + '</div>';
    html += '		    <div class="description">' + allTech[tid].descript + '</div>';
    html += '           <div class="gallery">    ';
    allTech[tid].startupImg.forEach(function (img) {
        if (img != "") {
            html += '<div><img class="gallery-img" src="' + img + '" alt="' + allTech[tid].title + '"> </div>   ';
        }
    });
    //html += '               <img class="gallery-img" src="' + allTech[tid].startupImg[0] + '" alt="' + allTech[tid].title + ' img1">    ';
    //html += '               <div class="gallery-img"></div>    ';
    //html += '               <div class="gallery-img"></div>    ';
    html += '           </div>    ';
    //html += '           <div class="fb-comments"></div>    ';

    //html += '            <div id="facebook-comments" class="text-box" shape-id="0">';
    //html += '               <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid" data-colorscheme="light" data-numposts="10" data-width="488px" shape-id="0" fb-xfbml-state="rendered"> ';   
    //html += '                   <span style="">';
    //html += '                       <iframe id="f1956c9268" data-href="' + domUrl + '" name="ff7c6a088" scrolling="no" title="Facebook Social Plugin" class="fb_ltr fb_iframe_widget_lift" src="https://m.facebook.com/plugins/comments.php?api_key=162470583945071&amp;channel_url=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D28%23cb%3Df142527dc8%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%253A55898%252Ff2e22d2284%26relation%3Dparent.parent&amp;colorscheme=light&amp;href=http%3A%2F%2Flocalhost%3A55898%2F%25D7%2590%25D7%2595%25D7%2596%25D7%25A0%25D7%2599-%25D7%25A4%25D7%2599%25D7%259C-%25D7%25A9%25D7%2595%25D7%25A7%25D7%2595%25D7%259C%25D7%2593&amp;locale=en_US&amp;mobile=true&amp;numposts=5&amp;sdk=joey&amp;skin=light" style="border: none; overflow: hidden; min-height: 492px;  width: 100%;">';
    //html += '                       </iframe>';
    //html += '                   </span>';
    //html += '               </div>';
    //html += '           </div>';
    html += '       </div>    ';

    youtube = allTech[tid].youtube;
    startupImg = allTech[tid].startupImg;
    $('.inventDescription').fadeIn(600, 'easeInOutBack');
    $('.mask').fadeIn(600, 'easeInOutBack');

    $('html, body').animate({
        scrollTop: $("#invent-close").offset().top - 25
    }, 1000);

    var $inventDescription = $(html);
    $('.inventDescription').append($inventDescription);
    //facebookCommentsLink()
    $('.inventDescription .close').on('click', this, function () {
        $('.inventDescription').empty().append('<span id="invent-close" class="close"></span>');
        $('.inventDescription').fadeOut(600, 'easeInOutBack');
		window.location.hash='';
        $('html, body').animate({
            scrollTop: "550px"
        }, 1);
        $('.mask').fadeOut(600, 'easeInOutBack');
        return false;
    });

    return false;
};

////////////////////////////////////////////////////////validate on all form's inputs
function generalValidate() {
    //StartUp Name
    validateEmptyInput($("#title"));

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
    //StartUp Name
    var title = validateEmptyInput($("#title"));

    //Invet Name
    var invetName = validateEmptyInput($("#invetName"));

    //slogen
    //var slogen = validateEmptyInput($("#slogen"));
    
    //slogen's length
    var slogen8 = slogenValidate($("#slogen"));

    //emails
    var email = emailValidate($("#email"));
    var emailFounder = emailValidate($("#founderMail"));

    
    

    //logo
    //var logo = validateLogo($(".title-logo.logoimg"));

    if (title & invetName & (email == undefined || email) & (emailFounder == undefined || emailFounder)  & slogen8 )
        return true;
    return false;
}

function form2Validate() {

    
    //description
    var descript = descriptionValidate($("#description"));

    //video
    var videotrue = (getMovieDataByURL($("#youtubeUrl").val()) != null);
    //videotrue = true;

    //site
    validateSite($("#site"));
    var site = true;

    if (site & videotrue & descript)
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
    //alert(words.length);
    if (words.length>200) {
        input.addClass("error");
            //alert("description is not validate");
            $("#validate-description-error").show();
            return false;
    }
    else{
        input.removeClass("error");
            $("#validate-description-error").hide();
            return true;
    }
}

//validate slogen field
function slogenValidate(input){
    var words = $('#slogen').val().split(' ');
    if ( words.length>9 || input.val() == "") {
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

//validate webSite field
function validateSite(input) {
    //if there is not http
    if (input.val() != "") {
        if (input.val().indexOf("http") == -1) {
            input.val("http://" + input.val());
        }
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
 }   
}
function showArrowsJudges(){
 if ($(".judgesContenar .judgesAvantar").length > 5){
     $("#judgesR .rightScroll-arrow").show();
     $("#judgesL .leftScroll-arrow").show();
 }   
}

function showForm4(){
    if ($('#formPart4').hasClass('show')){
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

function openInNewWindow(url, width, height){
    var win=window.open(url, '_blank', location=0, menubar=0, height=100, width=100);
    win.focus();
}
/////////////////////////////////////////////////////////////////////////end validation
