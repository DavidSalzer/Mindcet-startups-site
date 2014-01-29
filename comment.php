<?php 
    $logo=$_GET['img'];
    $name=$_GET['text'];
    $url=$_GET['url'];


?>
<!doctype html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js" type="text/javascript" ></script>
    <script>
        function getParameterByName(name) {
            var match = RegExp('[?&]' + name + '=([^&]*)')
                    .exec(window.location.search);
            return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
        }
    </script>
    <meta property="og:title" content="Global EdTech Startup Awards 2014"/>
   <meta property="og:description" content="<?php echo $name;?> name is my favorite EdTech startup. What's yours?"/>
   <meta property="og:image" content="<?php echo $logo;?>">
   <meta property="og:url" content="<?php echo $url;?>">
</head>
<body>
<div id="fb-root"></div>
<script>
    $(document).ready(function (e) {
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=156410301157974";
            fjs.parentNode.insertBefore(js, fjs);
        } (document, 'script', 'facebook-jssdk'));

    });



    </script>


     <div class="fb-comments" data-href="<?php echo $url;?>" data-num-posts="5" data-width="500"></div>
   
</body>
</html>
