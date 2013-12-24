
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

    $('#offerStartUp').on('click', this, function (e) {
        openOfferPopUp();
		e.preventDefault();
       
    });

    $('.inventorPopUp .close').on('click', this, function () {
        $('.inventorPopUp').fadeOut(600, 'easeInOutBack');
        return false;
    });

    $('.next-page').on('click', this, function () {
        if ($('#formPart1').is(":visible")) {
            $('#formPart1').hide();
            $('#formPart2').show();
            $('.last-page').css("display", "inline-block");
            $('#page-number-1').hide();
            $('#page-number-2').show();

            return true;
        }

        else if ($('#formPart2').is(":visible")) {
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
           // html +=                 logo;
            if(logoSrc!=null)
                html += '       <img class="logo" src="' + logoSrc + '" alt="' + title + ' logo">    ';
            html += '       </div>    ';

            //html += '       <div class="socialArea">    ';
            //html += '           <div class="social fb"></div>    ';
            //html += '           <div class="social twitter"></div>    ';
            //html += '           <div class="social linkedin"></div>    ';
            //html += '           <div class="social likes"></div>    ';
            //html += '       </div>    ';

            html += '       <div class="mainArea">    ';
            //html += '           <img class="movie" src="' + getImgUrl(getMovieDataByURL(youtubeUrl)) + '" /><span class="play_button"></span> ' + '</div>    ';
            html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(youtubeUrl)) +'</div>';
            html += '		    <div class="name ellipsis">' + invetName + '</div>';
            html += '		    <div class="description">' + description + '</div>';
            html += '           <div class="gallery">    ';
            if(ImgSrc1!=null)
                html += '               <img class="gallery-img" src="' + ImgSrc1 + '" alt="' + title + ' img1">    ';
            if(ImgSrc2!=null)
                html += '               <img class="gallery-img" src="' + ImgSrc2 + '" alt="' + title + ' img2">    ';
            if(ImgSrc3!=null)
                html += '               <img class="gallery-img" src="' + ImgSrc3 + '" alt="' + title + ' img3">    ';
            html += '           </div>    ';
            //html += '           <div class="fb-comments"></div>    ';
            html += '       </div>    ';

            var $inventDescription = $(html);
            $('#formPart3').empty().prepend($inventDescription);
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

        return ;
    });
      
    var logoSrc=null;
    var ImgSrc1=null;
    var ImgSrc2=null;
    var ImgSrc3=null;
    
    $("#logo").change(function(e) {

        var fileName = $(this).val();
		
		$('.title-logo.logoimg').text(fileName);
    
	    if((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {

            if(this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(e.target.result);
                    logoSrc= e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            alert("noValidFile");
        }
    });
    $("#img-1").change(function(e) {

        var fileName = $(this).val();
		$('.title-logo.img1').text(fileName);
        if((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {

            if(this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(e.target.result);
                    ImgSrc1= e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            alert("noValidFile");
        }
    });
    $("#img-2").change(function(e) {

        var fileName = $(this).val();
		$('.title-logo.img2').text(fileName);
        if((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {

            if(this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(e.target.result);
                    ImgSrc2= e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            alert("noValidFile");
        }
    });
    $("#img-3").change(function(e) {

        var fileName = $(this).val();
		$('.title-logo.img3').text(fileName);
        if((/\.(gif|jpg|jpeg|png)$/i).test(fileName)) {

            if(this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(e.target.result);
                    ImgSrc3= e.target.result;
                    smallImgAdded = true;
                };

                reader.readAsDataURL(this.files[0]);
            }
        }
        else {
            alert("noValidFile");
        }
    });

    //$('.submit input').on('click', this, function () {
    //        $('#formPart3').hide();
    //        $('#formPart4').show();
    //        $('.last-page').css("display", "none");
    //        $('#page-number-3').hide();
    //        $('.submit input').css("display", "none");
    //        var html = '        <div class="form-end-message">Registration is pending approval. <br><br>Thank you!</div>';
    //        var $formEndMessage = $(html);
    //        $('#formPart4').append($formEndMessage);

    //    return false;
    //});

//----------/end of form


    $('.judgeDescription .close').on('click', this, function () {
        $('.judgeDescription').fadeOut(600, 'easeInOutBack');
        return false;
    });

    //$('.judgesAvantar').on('click', this, function () {
    //    $('.judgeDescription').fadeIn(600, 'easeInOutBack');

    //var html = '       <div class="judgeDescriptionLeft">';
    //html = '               <div class="judgeDescription-img"></div>';
    //html = '               <div class="contactMe"><a ' + + '" >Contact Me</a></div>';
    //html = '           </div>';
    //html = '           <div class="judgeDescriptionRight">';
    //html = '                <div class="judgeDescription-name">' +  title - name + '</div>';
    //html = '               <div class="judgeDescription-role">' + title - role + '</div>';
    //html = '               <div class="judgeDescription-full">' +  + '</div>';
    //html = '           </div>';

    //$('html, body').animate({
    //    scrollTop: $("#judges-banner").offset().top - 25
    //}, 2000);

    //var $judgeDescription = $(html);
    //$('.judgeDescription').append($judgeDescription);

    //    return false;
    //});


    $('.inventList li').on('click', this, function () {
        $('.inventorPopUp .close').click();
        tid = $(this).attr('idtec');

        var html = '       <div class="topArea">    '
        html += '		    <div class="title ellipsis">' + allTech[tid].title + '</div>';
        html += '<div class="startup-popup-logo"><img class="wp-post-image" src="'+allTech[tid].logo[0]+'" alt="'+allTech[tid].title+'" ></div>';
        html += '       </div>    ';

        html += '       <div class="socialArea">    ';
        html += '           <div class="social fb">Share on <span class="letter-space">Facbook</span></div>    ';
        //html += '           <div class="social fb"><div class="fb-share-button" data-href="http://localhost:55898/%D7%90%D7%95%D7%96%D7%A0%D7%99-%D7%A4%D7%99%D7%9C-%D7%A9%D7%95%D7%A7%D7%95%D7%9C%D7%93" data-type="button_count"></div></div>    ';
        //html += '           <a href="http://www.facebook.com/sharer/sharer.php?u=http://www.hubspot.com/software-buyers-guide/" class="social fb" title="(Share on Facebook)" target="_blank">Share on Facebook</a>';
        html += '           <div class="social twitter">Share on <span class="letter-space">Twitter</span></div>    ';
        //html += '           <a href="http://twitter.com/intent/tweet?text=Learn%20how%20to%20optimize%20your%20calls-to-action%20-%20download%20@HubSpot%27s%20free%20ebook%20on%20mastering%20the%20design%20and%20copy%20of%20CTAs:%20http://bit.ly/LSjMFA%20%20" class="social twitter" title="(Tweet This Link)" target="_blank">Share on Twitter</a>';
        html += '           <div class="social linkedin">Share on <span class="letter-space">Linkedin</span></div>    ';
        //html += '           <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://bit.ly/LSjMFA" class="social linkedin" title="(Share on LinkedIn)" target="_blank">Share on LinkedIn</a>';
        //html += '           <div class="social likes"></div>    ';

        html += '       </div>    ';

        html += '       <div class="mainArea">    ';
        //html += '           <img class="movie" src="' + getImgUrl(getMovieDataByURL(allTech[tid].youtube)) + '" /><span class="play_button"></span> ' + '</div>    ';
        var videoIframe = getEmbedMovie(getMovieDataByURL(allTech[tid].youtube));
        if(videoIframe!=undefined)
            html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(allTech[tid].youtube)) + '</div>';
        //html += '            <div class="movie">' + getEmbedMovie(getMovieDataByURL(allTech[tid].youtube)) +'</div>';
        html += '		    <div class="name ellipsis">' + allTech[tid].name + '</div>';
        html += '		    <div class="description">' + allTech[tid].descript + '</div>';
        html += '           <div class="gallery">    ';
        allTech[tid].startupImg.forEach(function(img){
            if(img!=""){
                html += '<img class="gallery-img" src="' + img + '" alt="' + allTech[tid].title + '">    ';
            }
        });
        //html += '               <img class="gallery-img" src="' + allTech[tid].startupImg[0] + '" alt="' + allTech[tid].title + ' img1">    ';
        //html += '               <div class="gallery-img"></div>    ';
        //html += '               <div class="gallery-img"></div>    ';
        html += '           </div>    ';
        //html += '           <div class="fb-comments"></div>    ';

        //html += '            <div id="recipe-facebook-comments" class="text-box" shape-id="0">';
        //html += '               <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid" data-href="http://localhost:55898/%D7%90%D7%95%D7%96%D7%A0%D7%99-%D7%A4%D7%99%D7%9C-%D7%A9%D7%95%D7%A7%D7%95%D7%9C%D7%93" data-colorscheme="light" data-numposts="5" data-width="488px" shape-id="0" fb-xfbml-state="rendered"> ';   
        //html += '                   <span style="height: 159px;">';
        //html += '                       <iframe id="f1956c9268" name="ff7c6a088" scrolling="no" title="Facebook Social Plugin" class="fb_ltr fb_iframe_widget_lift" src="https://m.facebook.com/plugins/comments.php?api_key=162470583945071&amp;channel_url=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D28%23cb%3Df142527dc8%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%253A55898%252Ff2e22d2284%26relation%3Dparent.parent&amp;colorscheme=light&amp;href=http%3A%2F%2Flocalhost%3A55898%2F%25D7%2590%25D7%2595%25D7%2596%25D7%25A0%25D7%2599-%25D7%25A4%25D7%2599%25D7%259C-%25D7%25A9%25D7%2595%25D7%25A7%25D7%2595%25D7%259C%25D7%2593&amp;locale=en_US&amp;mobile=true&amp;numposts=5&amp;sdk=joey&amp;skin=light" style="border: none; overflow: hidden; height: 159px; width: 100%;">';
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
            scrollTop: $("#single-startup-zone").offset().top - 25
        }, 2000);

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
        
 updateMenuUrl();




});


function openOfferPopUp(){
     $('.inventorPopUp').fadeIn(600, 'easeInOutBack');
        $('html, body').animate({
            scrollTop: $("#offer-zone").offset().top -25
        }, 2000);
        return false;
}

function popupall(allTech){
 console.log(allTech);
}

function facebookCommentsLink() {
    $("#recipe-facebook-comments .fb-comments").attr("data-href", window.location.href );
}

getEmbedMovie=function(data,height,width){
	if (data==null || data.type!="movie") return;
	if(!height) height="215";
	if(!width) width="342";
	if(data.movieType=="YouTube")
		return'<iframe width="'+width+'" height="'+height+'" src="//www.youtube.com/embed/'+data.id+'" frameborder="0" allowfullscreen></iframe>';
    else if(data.movieType=="Vimeo")
        return '<iframe width="'+width+'" height="'+height+'" src="//player.vimeo.com/video/'+data.id+'" frameborder="0" allowfullscreen></iframe>';
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
            return "noVideo";
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
      reader.onload = (function(theFile) {
        return function(e) {
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
        else{
            return -1;
        }
 }


 function updateMenuUrl(){
        //update the menu links to croll to sections in home page
        var navArray=["#startups-banner","#judges-banner", "#offer-zone"]
        $(".topMenu ul li a").each(function(i){$(this).attr("href",navArray[i]);});
        //$(".footerMenu ul li a").each(function(i){$(this).attr("href",navArray[i]);});

        //add event to offer menu to open the offer popup
        $('a[href^="#offer-zone"]').on("click",openOfferPopUp);
        
        //scroll smooth
        $('a[href^="#"]').click(function() {    // Change to needed selector
        $("html, body").animate({    // Need both for full browser support
            scrollTop: $( $(this).attr("href") ).offset().top - 154 // Extra 100px
        }, 500);    // Change to desired scroll time in ms
        return false;    // Prevents the dreaded jump/flash
    });
 }
