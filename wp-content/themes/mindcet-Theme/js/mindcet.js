var maxSize = 2; //mb
var fileMesg = 'file is too big, Please ensure that file size is less than 2Mb.';
// JavaScript Document
var fromMarker = null;
var isMobile = false;
var logoSrc = null;
var ImgSrc1 = null;
var ImgSrc2 = null;
var ImgSrc3 = null;
$(document).ready(function (e) {

    $(".invent-next").on("swipe", function () { alert("You swiped ") });

    $("#newsletter-btn").on("click", openNewsletter);
    $("#newsletter-popup-sign-btn").on("click", signToNewsletter);
    $(".tagLogo").on("click", openSubMenu);
    $("body").on("click", "div,span,ul", closeSubMenu);
    $("#newsletter-popup").on("click", function (e) { e.preventDefault(); return false; })
    Hammer($("#single-startup-zone").get(0)).on("swipeleft", getPrevStartup);
    Hammer($("#single-startup-zone").get(0)).on("swiperight", getNextStartup);
    $("#nextImageL").on("click", getNextStartup);
    $("#nextImageR").on("click", getPrevStartup);

    resizOfferStartUpDiv();
    dispalyOption();
    setStartupUl();

    initMap();
    showForm4();
    showArrowsStartups();
    showArrowsJudges();

    if ($(".ui-loader").length > 0) {
        $(".ui-loader").remove();
    }


    $('#inventScrollR').on('click', this, function () {
        var offsetToScroll = $(".inventList").width() * 2;
        if (isMobile) {
            offsetToScroll = $(".inventList").width();
        }
        scrollVal = $('#scrollInventorCon').scrollLeft() + offsetToScroll;

        $('#scrollInventorCon').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');

        allLi = $('.inventList').length;
        liW = $('.inventList').width();
        plcW = $('.placholderSlide').width();
        allW = (allLi * liW) + (2 * plcW) - $('#scrollInventorCon').width();
        console.log(scrollVal + 'allw: ' + allW);

        if (scrollVal <= 0) {
            $('#inventScrollL .leftScroll-arrow').hide();
        } else {
            $('#inventScrollL .leftScroll-arrow').show();
        }

        if (scrollVal >= allW) {
            $('#inventScrollR .rightScroll-arrow').hide();
        } else {
            $('#inventScrollR .rightScroll-arrow').show();
        }

    });

    $('#inventScrollL').on('click', this, function () {
        var offsetToScroll = $(".inventList").width() * 2;
        if (isMobile) {
            offsetToScroll = $(".inventList").width();
        }
        scrollVal = $('#scrollInventorCon').scrollLeft() - offsetToScroll;
        $('#scrollInventorCon').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');

        allLi = $('.inventList').length;
        liW = $('.inventList').width();
        plcW = $('.placholderSlide').width();
        allW = (allLi * liW) - (2 * plcW) - liW;

        if (scrollVal <= 0) {
            $('#inventScrollL .leftScroll-arrow').hide();
        } else {
            $('#inventScrollL .leftScroll-arrow').show();
        }

        if (scrollVal > allW) {
            $('#inventScrollR .rightScroll-arrow').hide();
        } else {
            $('#inventScrollR .rightScroll-arrow').show();
        }

    });

    $('#judgesR').on('click', this, function () {
        scrollVal = $('.judgesContenar').scrollLeft() + 300;
        $('.judgesContenar').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');

        jcon = $('.judgesContenar .placholderSlide').length;
        conw = $('.judgesContenar .placholderSlide').width();
        av = $('.judgesContenar .judgesAvantar').length;
        avw = $('.judgesContenar .judgesAvantar').width(); //border and margin



        allw = (jcon * conw) + (av * avw) - $('#judgesCon').width();

        console.log(scrollVal + ' ' + allw);
        if (scrollVal <= 0) {
            $('#judgesL .leftScroll-arrow').hide();
        } else {
            $('#judgesL .leftScroll-arrow').show();
        }

        if (scrollVal > allw) {
            $('#judgesR .rightScroll-arrow').hide();
        } else {
            $('#judgesR .rightScroll-arrow').show();
        }

    });

    $('#judgesL').on('click', this, function () {
        scrollVal = $('.judgesContenar').scrollLeft() - 300;
        $('.judgesContenar').animate({ scrollLeft: scrollVal }, 500, 'easeOutBack');

        jcon = $('.judgesContenar .placholderSlide').length;
        conw = $('.judgesContenar .placholderSlide').width();
        av = $('.judgesContenar .judgesAvantar').length;
        avw = $('.judgesContenar .judgesAvantar').width(); //border and margin



        allw = (jcon * conw) + (av * avw) - $('#judgesCon').width();
        console.log(scrollVal + ' ' + allw);

        $('#judgesR .rightScroll-arrow').show();

        if (scrollVal <= 0) {
            $('#judgesL .leftScroll-arrow').hide();
        } else {
            $('#judgesL .leftScroll-arrow').show();
        }



    });


    //-------form------

    $('#offerStartUp').on('click', this, function (e) {
        openOfferPopUp();
        $('#formPart4').removeClass('show');
        $('#formPart4').hide();
        $('.popInvent input[type="submit"]').hide();
        $(".capchArea").hide();
        $('#formPart1').show();
        $('.next-page').css("display", "inline-block");
        $('#page-number-1').show();
        e.preventDefault();

        if (isMobile) {
            $("body").addClass("freeze");
            $("#page-number-1").html("1/2");
        }
        else {
            $("#page-number-1").html("1/4");
        }
        return false;

    });

    $('.inventorPopUp .close').on('click', this, function () {
        $('.inventorPopUp').fadeOut(300, 'easeInOutBack');
        $('#formPart11,#formPart1-2,#formPart2,#formPart3,.page-number').hide();

        //display of mobile
        if (isMobile) {
            $(".header").show();
            $(".topNav").show();
            $(".page-wrap").removeClass("mobile");
            $("#sign-header-mobile").hide();
            $("body").removeClass("freeze");
        }
        //  return false;
    });



    $('.next-page').on('click', this, function () {
        if ($('#formPart1').is(":visible")) {
            if (form1Validate()) {
                if (isMobile) {
                    if (form1_2Validate() && form2Validate()) {
                        showPreviewForm();
                    }
                    else {
                        $('#offer-zone-inner').animate({
                            scrollTop: 0
                        }, 1000);
                    }
                }
                else {
                    showForm1_2();

                }

            }
            else {
                $('#offer-zone-inner').animate({
                    scrollTop: 0
                }, 1000);
            }
            return true;
        }
        else if ($('#formPart1-2').is(":visible")) {
            if ((form1_2Validate())) {
                showForm2();
            }
            else {
                $('#offer-zone-inner').animate({
                    scrollTop: 0
                }, 1000);
            }
        }
        else if ($('#formPart2').is(":visible")) {
            if (form2Validate()) {
                showPreviewForm();
            }
            else {
                $('#offer-zone-inner').animate({
                    scrollTop: 0
                }, 1000);
            }
        }
        return true;
    });

    $('.last-page').on('click', this, function () {
        $(".validate-error").hide();
        if ($('#formPart1-2').is(":visible")) {
            $('#formPart1-2').hide();
            $('#page-number-1-2').hide();
            $('.last-page').css("display", "none");
            $('.next-page').css("display", "inline-block");
            $('#formPart1').show();
            $('#page-number-1').show();

            return;
        }
        if ($('#formPart2').is(":visible")) {
            $('#formPart2').hide();
            $('#page-number-2').hide();
            $('.next-page').css("display", "inline-block");
            $('#formPart1-2').show();
            $('#page-number-1-2').show();

            return;
        }

        else if ($('#formPart3').is(":visible")) {
            $('.capchArea').hide();
            $('.inventorPopUp').css('height', '666px');
            if (!isMobile) {
                $('.triangle').css('bottom', '138px');
            }
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
    $('#new_post').on('submit', this, function () {
        if (document.getElementById(("ads")).checked && document.getElementById(("terms")).checked)
            return true;
        $("#validate-checkbox-error").show();
        return false;
    });




    $("#logo").change(function (e) {
        $("#validate-img-error").hide();
        var size = document.getElementById("logo").files[0].size;
        size = size / 1024 / 1024;
        if (size > maxSize) {
            $("#validate-img-error").show();
            return false;
        }


        var fileName = $(this).val();
        var fileName = $(this).val().replace("C:\\fakepath\\", "");
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
        size = size / 1024 / 1024;
        if (size > maxSize) {
            $("#img-1").addClass("error");
            $("#validate-img-error").show();
            return;
        }

        var fileName = $(this).val();
        var fileName = $(this).val().replace("C:\\fakepath\\", "");
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
        size = size / 1024 / 1024;
        if (size > maxSize) {
            $("#img-2").addClass("error");
            $("#validate-img-error").show();
            return;
        }

        var fileName = $(this).val().replace("C:\\fakepath\\", "");
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
        size = size / 1024 / 1024;
        if (size > maxSize) {
            $("#img-3").addClass("error");
            $("#validate-img-error").show();
            return;
        }

        var fileName = $(this).val();
        var fileName = $(this).val().replace("C:\\fakepath\\", "");
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


    $('.judgeDescription').on('click', '.close', this, function () {
        $('.judgeDescription').empty().append('<span class="close"></span>');
        $('.judgeDescription').slideUp(1000, 'easeInOutBack');
        $('.mask').removeClass('mask-judge');
        $('.mask').hide();
        $('body').css('overflow', 'auto');
        return false;
    });

    $('body').on('click', '.mask-judge', this, function () {////שונה
        $('.judgeDescription .close').click();
        return false;
    });

    $('.judgesAvantar').on('click', this, function () {
        $('.inventorPopUp .close').click();
        tid = $(this).attr('judgeId');

        $('.mask').show();
        $('.mask').addClass('mask-judge');


        $('.mask').fadeIn(200, 'easeInOutBack').css('height', '100%'); ////נוסף


        $('.judgeDescription').slideDown(1000, 'easeInOutBack');
        var html = '       <div class="judgeDescriptionLeft">';
        html += '       <div class="judgeDescription-img">' + allJudges[tid].imgProfile + '</div>    ';
        html += '               <div class="contactMe"><a href="mailto:' + allJudges[tid].email + '" >Contact Me</a></div>';
        html += '           </div>';
        html += '           <div class="judgeDescriptionRight">';
        html += '                <div class="judgeDescription-name">' + allJudges[tid].name + '</div>';
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
        //display of mobile
        if (!isMobile) {
            setTimeout(function () {
                if ($(document).scrollTop() > 550) {
                    $('#offer-zone').fadeOut("slow");
                    $('#formPart11,#formPart2,#formPart3,#page-number-1,#page-number-2,#page-number-3').hide();

                }
            }, 500);
        }
    });
    $('#scrollInventorCon').on('click', ".inventList li", function () {
        tid = $(this).attr('idtec');
        popuopInvent(tid);
        //setIframe();
    });
    $('#best-logo-frame').on('click', this, function () {
        //if there is not startup favorite
        if (allTech["fev"].H1) {
            window.open(allTech["fev"].link, '_blank');
        }
        else {
            popuopInvent(allTech["fev"]);
        }
        //setIframe();
    });

    $('.inventHome li a').on('click', this, function () {
        e.preventDefault();
    });

    $(window).on('resize', function () {
        resizOfferStartUpDiv();
        dispalyOption();
        setStartupUl();
    });


    $('body').on('click', '#inventLikeFb,#inventTwiiwer,#inventLinkedin', function () {
        likeUrl = $(this).data('url');
        openInNewWindow(likeUrl);
    })

    $('body').on('click', '.mapOpenInvent', function (e) {
        tid = $(this).attr('date-id');
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
        $('body').css('overflow', 'auto');

        $('.inventDescription-append').empty(); //.append('<span id="invent-close" class="close"></span>');
        $('.inventDescription').fadeOut('fast');
        var scr = document.body.scrollTop;

        window.location.hash = ' ';

        document.body.scrollTop = scr;
        //if come from marker popup
        var markerId = $("#marker-popup").attr("marker-id");
        if (markerId != "") {
            buildMarkerPopupHTML(markerId);
        }
        return false;
    });

    $('.mask').on('click', this, function (e) {
        if ($('#newsletter-btn').hasClass('selected')) {
            closeNewsletter();
            $('body').css('overflow', 'auto');
            return;
        }


        if ($(e.target).attr("class") != "undefind" && $(e.target).attr("class").indexOf('mask') == 0) {

            $('body').css('overflow', 'auto');
            //if from invent
            if ($(e.target).hasClass("mask-invent")) {
                $('.inventDescription .close').click();
                return;
            }
            //from marker
            else {
                $('#marker-popup .close').click();
            }

        }

    });

    $('#marker-popup').on('click', ".close", function () {
        //reset key-id to marker section
        $("#marker-popup").attr("marker-id", "");

        $('#marker-popup').fadeOut(300, 'easeInOutBack');

        var scr = document.body.scrollTop;

        window.location.hash = '';

        document.body.scrollTop = scr;

        $('.mask').fadeOut(800, 'easeInOutBack');
        $('body').css('overflow', 'auto');

        return false;
    });

    $('#yearNav').on('change', function () {
        changeStartupByYear(this.value);
    });

    showHighlight();

}); //dom ready




function openOfferPopUp() {
    //disable_scroll();

    ga('send', 'event', 'button', 'click', 'add invent - 1');

    $('.inventorPopUp').fadeIn(400, 'easeInOutBack');



    //display of mobile
    if (isMobile) {
        $(".header").hide();
        $(".topNav").hide();
        $(".page-wrap").addClass("mobile");
        $("#sign-header-mobile").show();
        $("#formPart2").show();
    }

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
    if (data == null) return;
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

    //add event to offer menu to open the offer popup
    $('a[href^="#offer-zone"]').on("click", function () { $('#offerStartUp').click(); });

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

function popuopInvent(tid) {
    //$('.inventDescription-append').empty();
    if ($('#formPart4').is(":hidden")) {
        $('.inventorPopUp .close').click();
    }
    if (tid) {
        window.location.hash = tid;
        ga('send', 'pageview', allTech[tid].title);
    }

    globalUrl = document.URL.split("#")[0];
    domUrl = document.URL;
    domUrlTweet = domUrl.replace('#', '%23');
    domComments = ascii(domUrl);
    domLikes = globalUrl + '?initiator=' + allTech[tid].title;
    domLikes = domLikes.split(" ").join("-");
    domLikes = domLikes.toLowerCase();
    permalink = allTech[tid].permalink;

    $('#twittCount').remove();

    setTimeout(function () { FB.XFBML.parse() }, 2000);

    $('#comments-frame').attr("src", globalUrl + 'comment.php?url=' + domComments + '&text=' + allTech[tid].title + '&img=' + allTech[tid].logo[0] + '&url=' + allTech[tid].permalink);

    $('#inventTwitterCount').attr('data-url', allTech[tid].permalink).attr('data-text', allTech[tid].title);

    domLikes = document.URL.split("#")[0] + '?' + allTech[tid].techId + '#' + allTech[tid].techId;
    $('.fb-like.invent').attr("data-href", permalink);
    $('#id' + allTech[tid].techId).show();
    var fbUrl = 'http://www.facebook.com/sharer/sharer.php?s=100&p[url]=' + allTech[tid].permalink + '&p[title]=Global EdTech Startup Awards 2015&p[summary]=' + allTech[tid].title + ' is my favorite EdTech startup. What\'s yours?&p[images][0]=' + allTech[tid].logo[0]; //'&p[summary]='+ascii(domUrl)+
    var tweetUrl = 'http://twitter.com/intent/tweet?text=@' + allTech[tid].title + ' is my favorite EdTech startup. Whart\'s yours?' + allTech[tid].permalink + ' &hashtags=Edtech,Startups,Education ';
    var linkedinUrl = 'http://www.linkedin.com/shareArticle?mini=true&amp;url=' + allTech[tid].permalink + '&amp;title=Global EdTech Startup Awards 2015&summary=' + allTech[tid].title + ' is my favorite EdTech startup. What\'s yours?';
    console.log(tid);
    console.log(allTech[tid]);
    var html = '       <div class="topArea">    ';
    if (allTech[tid].logo) {
        if (allTech[tid].siteUrl.length > 0) {
            html += ' <div class="startup-popup-logo"><a href="' + allTech[tid].siteUrl + '"  target="_blank"><img class="wp-post-image" postid="' + allTech[tid].techId + '" src="' + allTech[tid].logo[0] + '" alt="' + allTech[tid].title + '" ></a></div>';
        }
        else {
            html += '<div class="startup-popup-logo"><img class="wp-post-image" postid="' + allTech[tid].techId + '" src="' + allTech[tid].logo[0] + '" alt="' + allTech[tid].title + '" ></div>';
        }
    }
    else {
        html += '<div class="startup-popup-logo"><img class="wp-post-image" postid="' + allTech[tid].techId + '"></div>';
    }
    if (allTech[tid].siteUrl.length > 0) {
        html += '               <a href="' + allTech[tid].siteUrl + '" class="title ellipsis" target="_blank">' + allTech[tid].title + '</a>';
    }
    else {
        html += '               <div class="title ellipsis">' + allTech[tid].title + '</div>';
    }
    html += '               <div class="slogen">' + allTech[tid].slogen + '</div>';
    html += '       </div>    ';

    html += '       <div class="socialArea">    ';

    html += '              <div data-url="' + fbUrl + '" id="inventLikeFb"class="social fb" title="(Share on Facebook)" >Share on <span class="letter-space">Facbook</span></div>';
    //  html+='              <a href="'+fbUrl+':void(0);" class="social fb" title="(Share on Facebook)"  target="_">Share on <span class="letter-space">Facbook</span></a>';
    html += '             <div data-url="' + tweetUrl + '" id="inventTwiiwer" class="social twitter" title="(Tweet This Link)" >Share on <span class="letter-space">Twitter</span></div>';
    html += '             <div data-url="' + linkedinUrl + '" id="inventLinkedin" class="social linkedin" title="(Share on Linkedin)" >Share on <span class="letter-space">LinkedIn</span></div>';
    // html+=              '<div id="inventLikeCount" class="fb-like" data-href="'+allTech[tid].permalink+'" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>';             
    html += '          </div>    ';



    html += '       <div class="mainArea" id="inventpop">    ';

    $('#inventLikeCount').attr('data-href', allTech[tid].permalink);


    var videoIframe = getEmbedMovie(getMovieDataByURL(allTech[tid].youtube), $(".inventDescription .mainArea .movie iframe").height(), $(".inventDescription .mainArea .movie iframe").width());
    if (videoIframe != undefined)
        html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(allTech[tid].youtube), $(".inventDescription .mainArea .movie iframe").height(), $(".inventDescription .mainArea .movie iframe").width()) + '</div>';
    if (allTech[tid].founder) {
        html += '<div class="name ellipsis"><b>Founders:</b> ' + allTech[tid].founder + '</div>';
    } else {
        html += '<br>';
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

    h = $(window).height();
    $('body').css('overflow', 'hidden');

    $('.mask').fadeIn(200, 'easeInOutBack'); //.css('height',h+'px');
    $('.inventDescription').fadeIn(100, 'easeInOutBack');
    $('.mask').addClass('mask-invent');
    $('html, body').animate({
        // scrollTop: $("#invent-close").offset().top - 25
    }, 1);
    $('.inventDescription-append').empty();
    var $inventDescription = $(html);

    $('.inventDescription-append').append($inventDescription);

    $(".socialArea").prepend('<a href="https://twitter.com/share" id="twittCount" class="twitter-share-button social" data-size="small" data-url="' + allTech[tid].permalink + '" data-text="@' + allTech[tid].title + ' is my favorite EdTech startup. What\'s yours? #Edtech #Startups #Education" data-count="vertical">Tweet</a>');
    if ($('#single-startup-zone').hasClass('twitterF')) {
        twttr.widgets.load();
    }
    $('#single-startup-zone').addClass('twitterF');


    $(".socialArea").prepend('<div class="fb-like social" data-href="' + allTech[tid].permalink + '&postid=' + allTech[tid].techId + '&logo=' + allTech[tid].logo[0] + '" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false" id="fbCount"></div>');

    //$('.inventDescription .mainArea .movie iframe').delay(200).fadeIn(500, 'easeInOutBack');
    //$('.inventDescription .mainArea').delay(600).fadeIn(200, 'easeInOutBack');
    if ($('#single-startup-zone').hasClass('twitterF')) {
        setTimeout(function () { twttr.widgets.load(); }, 2000);
    }
    //facebookCommentsLink()
    if (isMobile) {
        $(".mask").height($("#single-startup-zone").height());
    }
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
    validateEmptyInput($("#city"));

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
    var emailNotEmpty = validateEmptyInput($("#email"));

    //Invet Name
    var invetName = validateEmptyInput($("#invetName"));

    //Invet city
    var invetCity = validateEmptyInput($("#city"));

    //slogen
    //var slogen = validateEmptyInput($("#slogen"));

    //slogen's length
    var slogen8 = slogenValidate($("#slogen"));

    // var selectOne = dropSelect();

    //emails
    var email = emailValidate($("#email"));
    var emailFounder = emailValidate($("#founderMail"));




    //logo
    //var logo = validateLogo($(".title-logo.logoimg"));

    //if (selectOne == true & title & invetName & invetCity & emailNotEmpty & (email == undefined || email) & (emailFounder == undefined || emailFounder) & slogen8)
    if (title & invetName & invetCity & emailNotEmpty & (email == undefined || email) & (emailFounder == undefined || emailFounder) & slogen8)
        return true;
    return false;
}
function form1_2Validate() {
    var selectOne = dropSelect();
    if (selectOne == true) {
        return true;
    }
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
function descriptionValidate(input) {
    var words = $('#description').val().split(' ');
    if ($('#description').val() == "") {
        input.addClass("error");
        $("#validate-general-error").show();
        return false;
    }
    else if (words.length > 200) {
        input.addClass("error");
        $("#validate-description-error").show();
        return false;
    }
    else {
        input.removeClass("error");
        // $("#validate-description-error").hide();
        //$("#validate-general-error").hide();
        return true;
    }
}

//validate slogen field
function slogenValidate(input) {
    var words = $('#slogen').val().split('');
    if (words.length > 140 || input.val() == "") {
        input.addClass("error");
        $("#validate-slogen-error").show();
        if (input.val() == "")
            $("#validate-general-error").show();
        return false;
    }
    else {
        input.removeClass("error");
        $("#validate-slogen-error").hide();
        return true;
    }
}

//validate selected
function dropSelect() {
    catVal = $('#category').val();
    tagVal = $('#tags').val();
    var result = true;
    if (catVal == 'none') {
        $('select#category').addClass('needSelect');
        $('#validate-select-error').show();
        result = false;
    }
    else{
        $('select#category').removeClass('needSelect');
    }
    if (tagVal == 'none') {
        $('select#tags').addClass('needSelect');
        $('#validate-select-error').show();
        result = false;
    }
    else{
        $('select#tags').removeClass('needSelect');
    }
    if (result) {
        $('select#category, select#tags').removeClass('needSelect');
        $('#validate-select-error').hide();

    }
    return result;


}
//validate webSite field
function validateSite(input) {
    //if there is not http
    if (input.val() != "") {
        if (input.val().indexOf("http") == -1) {
            input.val("http://" + input.val());
        }
    }
    else {
        $("#validate-general-error").show();
        return false;
    }

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

function showArrowsStartups() {
    if ($(".inventors .inventList li").length > 12) {
        $("#inventScrollR .rightScroll-arrow").show();
        $("#inventScrollL .leftScroll-arrow").hide();
    } else {
        $("#inventScrollR .rightScroll-arrow").hide();
        $("#inventScrollL .leftScroll-arrow").hide();
    }
}


function showArrowsJudges() {
    if ($(".judgesContenar .judgesAvantar").length > 5) {
        $("#judgesR .rightScroll-arrow").show();
        //$("#judgesL .leftScroll-arrow").show();
    }
}

function showHighlight() {
    //if homepage
    if (window.location.search.length == 0) {
        var best = allTech["fev"];
        if (allTech[best]) {
            var html = '<img class="best-logo" src="' + allTech[best].logo[0] + '" alt="' + allTech[best].title + ' logo">';
            $('#best-logo-frame').empty().append(html);
            var html = '<div class="best-description">' + allTech[best].descript + '</div>';
            $('#best-invent-description').empty().append(html);
        }
    }
}

function showForm1_2() {
    ga('send', 'event', 'button', 'click', 'add invent - 1_2');
    $('#formPart1').hide();
    $('#formPart1-2').show();
    $('.last-page').css("display", "inline-block");
    $('#page-number-1').hide();
    $('#page-number-1-2').show();
}

function showForm2() {
    ga('send', 'event', 'button', 'click', 'add invent - 2');
    $('#formPart1').hide();
    $('#formPart1-2').hide();
    $('#formPart2').show();
    $('.last-page').css("display", "inline-block");
    $('#page-number-1').hide();
    $('#page-number-1-2').hide();
    $('#page-number-2').show();
}
function showPreviewForm() {
    $('.capchArea').show();
    if (isMobile) {
        $('#page-number-3').html("2/2");
    }
    else {
        $('.inventorPopUp').css('height', '775px');
    }
    if (!isMobile) {
        $('.triangle').css('bottom', '250px');
    }
    ga('send', 'event', 'button', 'click', 'add invent - 3');
    $('#formPart1').hide();
    $('#formPart1-2').hide();
    $('#formPart2').hide();
    $('#page-number-1').hide();
    $('#page-number-2').hide();
    $('.next-page').css("display", "none");
    $('#formPart3').show();
    $('#page-number-3').show();
    $('.submit input').css("display", "inline-block");

    if (document.getElementById("title").value) { var title = document.getElementById("title").value; } else { title = "no title"; }
    //var logo = document.getElementById("logo").addEventListener('change', handleFileSelect, false);

    var slogen = document.getElementById("slogen").value;
    var youtubeUrl = document.getElementById("youtubeUrl").value;
    var invetName = document.getElementById("invetName").value;
    var invetCity = document.getElementById("city").value;
    var description = document.getElementById("description").value;
    //var img1 = document.getElementById("img-1").addEventListener('change', handleFileSelect, false);
    var founderShow = document.getElementById("founder").value;


    var html = '       <div class="topArea">    '
    html += '           <div class="title ellipsis">' + title + '</div>';
    html += '             <div class="slogen">' + slogen + ' </div>';
    if (founderShow)
        html += '           <div class="name ellipsis"><b>Founders:</b> ' + founderShow + '</div>';

    // html +=                 logo;
    if (logoSrc != null)
        html += '     <div class="startup-logo-form">  <img class="logo" src="' + logoSrc + '" alt="' + title + ' logo">   </div> ';
    html += '       </div>    ';

    html += '       <div class="mainArea">    ';
    html += '           <div class="description">' + description + '</div>';



    html += '           <div class="gallery">    ';
    if (youtubeUrl) {
        html += '         <div >' + getEmbedMovie(getMovieDataByURL(youtubeUrl), 77, 119) + '</div>';
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
function showForm4() {

    if ($('#formPart4').hasClass('show')) {
        ga('send', 'event', 'button', 'click', 'add invent - success');
        $('#offer-zone').show();
        $('.next-page').css("display", "none");
        $('.last-page').css("display", "none");
        $('.submit input').css("display", "none");
        $('.last-page').css("display", "none");
        $('#formPart1').hide();
        $('#formPart1-2').hide();
        $('#formPart2').hide();
        $('#page-number-1').hide();
        $('#formPart4').show();
        //$('#formPart4').css("display", "inline-block");
    }
    else {
        $('#offer-zone').hide();
    }
}

function openInNewWindow(url, width, height) {
    var win = window.open(url, '_blank', menubar = 0, height = 100, width = 100);
    //win.focus();
    return false;
}

function ascii(url) {
    var urlAscii = url.split('3').join('%33').split('1').join('%31').split('2').join('%32').split('4').join('%34').split('5').join('%35').split('6').join('%36').split('7').join('%37').split('8').join('%38').split('9').join('%39').split('0').join('%30').split('#').join('%23').split(':').join('%3A').split('/').join('%2F');
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
    if ($("#map").length != 0) {
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
        var mapZoom = 1;
        if (isMobile) {
            mapZoom = 0;
        }
        var options = {
            streetViewControl: false,
            center: new google.maps.LatLng(0, 0),
            zoom: mapZoom,
            //    disableDefaultUI: true,
            //disableDoubleClickZoom: true,
            draggable: true,
            //  maxZoom:1,
            minZoom: mapZoom

        };

        map = new google.maps.Map(document.getElementById("map"), options);

        google.maps.event.addListener(map, 'center_changed', function () {
            checkBounds(map);
        });

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');

        setMarkers(saveVotesData);
    }
}


// If the map position is out of range, move it back
function checkBounds(map) {

    var latNorth = map.getBounds().getNorthEast().lat();
    var latSouth = map.getBounds().getSouthWest().lat();
    var newLat;

    console.log("check bounds " + latNorth + " " + latSouth);

    if (latNorth < 85 && latSouth > -85)     /* in both side -> it's ok */
        return;
    else {
        if (latNorth > 85 && latSouth < -85)   /* out both side -> it's ok */
            return;
        else {

            if (latNorth > 85)
                newLat = map.getCenter().lat() - (latNorth - 85);   /* too north, centering */
            if (latSouth < -85)
                newLat = map.getCenter().lat() - (latSouth + 85);   /* too south, centering */
        }


    }

    if (newLat) {
        console.log("current center" + map.getCenter());
        var newCenter = new google.maps.LatLng(newLat, map.getCenter().lng());
        console.log("setting new center" + newCenter);
        map.setCenter(newCenter);
    }

}


var placeInsaveVotesData = 0;
var savePlaceInVotesData = [];
// Add a marker to the map and push to the array.
function addMarker(location, markerId) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });

    marker.markerId = markerId
    markers.push(marker);

    //save favorites linked to the marker
    savePlaceInVotesData[marker.markerId] = placeInsaveVotesData++;

    google.maps.event.addListener(marker, 'click', function () {
        // var key = savePlaceInVotesData[marker.markerId];
        buildMarkerPopupHTML(marker.markerId);
    });
}

function setMarkers(allMarkers) {

    for (marker in allMarkers) {
        //convert to latLng
        var myLatlng = new google.maps.LatLng(parseFloat(allMarkers[marker].lat), parseFloat(allMarkers[marker].lon));
        //create marker push marker to array
        addMarker(myLatlng, allMarkers[marker].markerId);
    }
    //show markers on map
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
        console.log(markers[i]);
    }
}

function buildMarkerPopupHTML(id) {
    var key;
    for (i = 0; i < saveVotesData.length; i++) {
        if (saveVotesData[i].markerId == id) {
            key = i;
        }
    }
    ga('send', 'pageview', saveVotesData[key].title);
    console.log(saveVotesData[key].logo[0]);
    console.log(saveVotesData[key].descript);
    console.log(saveVotesData[key].title);
    var globalUrl = document.URL.split("#")[0];
    domUrl = document.URL;
    domUrlTweet = domUrl.replace('#', '%23');
    domComments = ascii(domUrl);
    domLikes = globalUrl + '?votes=' + saveVotesData[key].title;
    domLikes = domLikes.split(" ").join("-");
    domLikes = domLikes.toLowerCase();
    permalink = saveVotesData[key].permalink;

    $('#comments-marker').attr("src", globalUrl + 'comment.php?url=' + saveVotesData[key].parmalink + '&text=' + saveVotesData[key].title + '&img=' + saveVotesData[key].logo[0] + '&url=' + saveVotesData[key].parmalink);


    var fbUrl = 'http://www.facebook.com/sharer/sharer.php?s=100&p[url]=' + saveVotesData[key].parmalink + '&p[title]=Global EdTech Startup Awards 2015&p[summary]=' + saveVotesData[key].title + '  favorite EdTech startup.?&p[images][0]=' + saveVotesData[key].logo[0]; //'&p[summary]='+ascii(domUrl)+
    var tweetUrl = 'http://twitter.com/intent/tweet?text=' + saveVotesData[key].title + ' favorite EdTech startup. ';
    var linkedinUrl = 'http://www.linkedin.com/shareArticle?mini=true&amp;url=' + saveVotesData[key].parmalink + '&amp;title=Global EdTech Startup Awards 2015&summary=' + saveVotesData[key].title + ' favorite EdTech startup.';

    var html = '<div class="topArea">    '
    if (saveVotesData[key].logo)
        html += '<div class="startup-popup-logo">  <img class="wp-post-image logo" src="' + saveVotesData[key].logo[0] + '" alt="' + saveVotesData[key].title + ' logo">   </div> ';
    html += '</div>    ';

    html += '<div class="mainArea">    ';

    html += '<div class="popup-title">' + saveVotesData[key].title + '</div>';

    html += '<div class="description"><p dir="ltr" style="text-align: left;">' + saveVotesData[key].descript + '</p></div>';

    html += '<div class="startups-gallery">    ';

    html += '<div class="startups-gallery-header">';
    //    html += '   <img class="gallery-img" src="'+ globalUrl +'wp-content/uploads/2014/01/final-logo2.png" alt="Class Messenger">';
    html += '   <span>Startups List</span>';
    html += '</div>';

    for (var favorite in saveVotesData[key].favId) {
        //if this year
        if (allTech[saveVotesData[key].favId[favorite]]) {
            console.log(allTech[saveVotesData[key].favId[favorite]]);
            html += '<div class="startups-gallery-item">';

            if (allTech[saveVotesData[key].favId[favorite]].logo[0]) {
                html += '<div class="startups-gallery-item-frame">';
                html += '<a href="#"  class="mapOpenInvent" date-id="' + allTech[saveVotesData[key].favId[favorite]].techId + '">';
                html += '<img class="gallery-img" src="' + allTech[saveVotesData[key].favId[favorite]].logo[0] + '" alt="Class Messenger">';
                html += '</a>';
                html += '   </div>';

            }

            html += '<div class="leftSide"><span class="gallery-description title"><a href="#" class="mapOpenInvent" date-id="' + allTech[saveVotesData[key].favId[favorite]].techId + '">' + allTech[saveVotesData[key].favId[favorite]].title + '</a></span>';
            html += '<span class="gallery-description">' + allTech[saveVotesData[key].favId[favorite]].slogen + '</span>';
            if (allTech[saveVotesData[key].favId[favorite]].founder)
                html += '<span class="gallery-description"><b>Founder: </b>' + allTech[saveVotesData[key].favId[favorite]].founder + '</span>';
            html += ' </div>  </div>';
        }
    }
    html += '   </div>';
    html += '</div>';

    html += '       <div class="socialArea">    ';
    html += '              <div  data-url="' + fbUrl + '" id="inventLikeFb"class="social fb mapSocial" title="(Share on Facebook)" >Share on <span class="letter-space">Facbook</span></div>';
    html += '             <div  data-url="' + tweetUrl + '" id="inventTwiiwer" class="social twitter mapSocial" title="(Tweet This Link)" >Share on <span class="letter-space">Twitter</span></div>';
    html += '             <div  data-url="' + linkedinUrl + '" id="inventLinkedin" class="social linkedin" title="(Share on Linkedin)" >Share on <span class="letter-space">LinkedIn</span></div>';
    html += '          </div>    ';

    var $inventDescription = $(html);
    $('.popupDescription-append').empty().append($inventDescription);

    //add key-id to marker section
    $("#marker-popup").attr("marker-id", saveVotesData[key].markerId);

    h = $(window).height();
    $('body').css('overflow', 'hidden');

    $('.mask').fadeIn(200, 'easeInOutBack');
    $('#marker-popup').fadeIn(100, 'easeInOutBack');
    $('html, body').animate({
        scrollTop: $("#invent-close").offset().top - 25
    }, 1);

    window.location.hash = "map/" + saveVotesData[key].markerId;


}

//////////////////////////////end google map///////////////////////////////////////////

//upload file button - wotre for ie but now all browsers use it
function getFile(id) {
    $(id).click();
}
function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
    document.myForm.submit();
    event.preventDefault();
}

function openNewsletter() {
    $("#newsletter-btn").addClass("selected");
    h = $(window).height();
    preventBodyToScroll();
    $("#newsletter-popup-title").show();
    $("#registerNews").show();
    $("#newsletter-popup-sign-btn").show();
    $("#newsletter-success").hide();

    $("#newsletter-popup").show();
    $("#newsletter-popup-sign-btn").show();
    $('.mask').fadeIn(200, 'easeInOutBack').css('height', '100%');
}

function closeNewsletter() {
    $("#newsletter-btn").removeClass("selected");
    $("#newsletter-popup").hide();
    $('.mask').fadeOut('fast');
    bodyReturnScroll();
}

function signToNewsletter() {
    var mail = $("#newsletter-popup input")
    if (emailValidate(mail)) {
        emailUser = $('#registerNews').val();

        jQuery.post('wp-admin/admin-ajax.php', {
            mail: emailUser,
            action: 'registerNews'
        }
					,
					function (data) {
					    if (data == 1) {
					        //To do
					        $("#newsletter-popup-title").hide();
					        $("#registerNews").hide();
					        $("#newsletter-popup-error").hide();
					        $("#newsletter-popup-sign-btn").hide();
					        $("#newsletter-success").show();
					        setTimeout(function () {
					            $('.mask').click();
					        }, 2000);


					    }
					});

    }
    else {
        $("#newsletter-popup-error").fadeIn(200, 'easeInOutBack');
    }
}

//set offerStartUp btn for mobile
function resizOfferStartUpDiv() {
    $("#offerStartUp").css("line-height", $("#offerStartUp").height() + "px");
}

function setStartupUl() {
    var numOfLiInUl = 3;
    //display of mobile
    if (isMobile) {
        numOfLiInUl = 2;
    }

    var html = '<ul class="inventList">  ';
    $(".inventList li").each(function (i) {

        //if insert to exist ul or create new 
        if (i % numOfLiInUl == 0) {
            html += '</ul><ul class="inventList">';
        }
        html += $(this).get(0).outerHTML;


    });
    html += '</ul>';

    $(".inventList").remove();

    $("#scrollInventorCon .placholderSlide:first").after(html);
    $(".inventList:first").remove();

    //check who is the winner
    var isWinner;
    var isFinalList;
    $(".inventList li").each(function (i) {
        $this = $(this);

        //if (allTech[$this.attr("idtec")].winner != "") {
        //    isWinner = allTech[$this.attr("idtec")].winner[Object.keys(allTech[$this.attr("idtec")].winner)[0]];

        //is winner
        if (allTech[$this.attr("idtec")].winner == "1") {
            $this.find(".winner").show();
        }
        // }

        //if (allTech[$this.attr("idtec")].finalList != "") {
        //    isFinalList = allTech[$this.attr("idtec")].finalList[Object.keys(allTech[$this.attr("idtec")].finalList)[0]];
        if ((allTech[$this.attr("idtec")].finalList == "1") && (allTech[$this.attr("idtec")].winner != "1")) {
            $this.find(".finalList").show();
        }
        // }


    });


}

//update if in mobile design or pc.  
function dispalyOption() {
    var $header = $(".header");
    isMobile = false;
    if ($(".header").height() == 58) {
        //if($("#offer-zone").width()==$("body").width()){
        isMobile = true;
        if ($header.hasClass("cf")) {
            $header.removeClass("cf");
        }
    }
    else {
        if (!$header.hasClass("cf")) {
            $header.addClass("cf");
        }
    }
}

//open sub menu
function openSubMenu() {
    if (isMobile) {
        $("#sum-menu-mobile").toggle();
        return false;
    }
}

function closeSubMenu() {
    $("#sum-menu-mobile").fadeOut();
}

function getNextStartup(e) {
    e.preventDefault();
    var currentId = $(".startup-popup-logo img").attr("postid");
    var currentIndex = allTechArray.indexOf(currentId);
    if (currentIndex < allTechArray.length - 2) {
        popuopInvent(allTechArray[currentIndex + 1]);
    }
}

function getPrevStartup(e) {
    e.preventDefault();
    var currentId = $(".startup-popup-logo img").attr("postid");
    var currentIndex = allTechArray.indexOf(currentId);
    if (currentIndex != 0) {
        popuopInvent(allTechArray[currentIndex - 1]);
    }
}

function preventBodyToScroll() {
    $('body').on('wheel.modal mousewheel.modal', function () { return false; });
}

function bodyReturnScroll() {
    $('body').off('wheel.modal mousewheel.modal');
}


function changeStartupByYear(year) {
    //reset list display
    stopAjax();
    $('#categoryNav,#tagsNav').val("none");
    $('#scrollInventorCon').animate({ scrollLeft: 0 });


    allTech = allYearsTechByOrder[year];
    //if user dose'nt choose "select year"
    if (allTech) {
        tempArr = []; //to save the startups by their id


        //to ul stracture
        var counter = 0;
        var html = '<ul class="inventList">';

        //reverse loop
        var len = allTech.length;
        var isWinner = "0";
        var isFinalList = "0";
        while (len--) {
            //for (var key in allTech) {
            var startup = allTech[len];
            tempArr[startup.techId] = startup; //to save the startups by their id

            if (counter == 3) {
                html += '</ul><ul class="inventList">';
                counter = 0;
            }
            html += '  <li idtec="' + startup.techId + '">';

            //if (startup.winner != "") {
            //    isWinner = startup.winner[Object.keys(startup.winner)[0]];
            //}
            //if (startup.finalList != "") {
            //    isFinalList = startup.finalList[Object.keys(startup.finalList)[0]];
            //}

            //is finalList
            if (startup.finalList == "1") {
                html += '   <div class="finalList" style="display:block"></div>';
                //isFinalList = "0"; //reset
            }
            else {
                html += '   <div class="finalList"></div>';
            }

            //is winner
            if (startup.winner == "1") {
                html += '   <div class="winner" style="display:block"></div>';
                //isWinner = "0"; //reset
            }
            else {
                html += '   <div class="winner"></div>';
            }

            html += '      <div class="img-wrap">';
            if (startup.logo) {
                html += '          <img src="' + startup.logo[0] + '"alt="logo">';
            }
            html += '      </div>';
            html += '      <h2>';
            html += '          <a href="' + startup.permalink + '" idtech="' + startup.techId + '">';
            html += startup.title;
            html += '          </a>';
            html += '      </h2>';
            html += '  </li>';

            counter++;
        }
        html += '</ul>';

        //add to dom
        $(".inventList").remove();
        $("#scrollInventorCon .placholderSlide:first").after(html);



        allTech = tempArr; //change allTech to array thar it's order is by startups id

        showArrowsStartups();

    }
    else {
        $(".inventList").remove();
    }
}

  
          
       
    
     