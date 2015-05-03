<?php
    /*
          Template Name: Embedded Page
      */
    
    
?>
<!DOCTYPE html>
<html style="width: 687px;height: 514px;">
    <meta charset="<?php bloginfo('charset'); ?>" />

    <meta property="og:image" content="http://globaledtechawards.org/wp-content/themes/mindcet-Theme/img/thumbnail%20logo.gif" />
    <meta property="og:title" content="Global EdTech Startup Awards 2014" />
    <meta property="og:description" content="What's your favorite EdTech startup?" />
    <meta property="og:updated_time" content="1391001033173" />
    <!--<meta property="og:image" content="http://mindcet.co.il.tigris.nethost.co.il/wp-content/uploads/2014/01/final-logo1.png"/>-->
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <link rel="image_src" href="http://globaledtechawards.org/wp-content/themes/mindcet-Theme/img/thumbnail%20logo.gif" />
    <?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow" />
    <?php } ?>

    <title>
        <?php
            if (function_exists('is_tag') && is_tag()) {
               single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
            elseif (is_archive()) {
               wp_title(''); echo ' Archive - '; }
            elseif (is_search()) {
               echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
            elseif (!(is_404()) && (is_single()) || (is_page())) {
               wp_title(''); echo ' - '; }
            elseif (is_404()) {
               echo 'Not Found - '; }
            if (is_home()) {
               bloginfo('name'); echo ' - '; bloginfo('description'); }
            else {
                bloginfo('name'); }
            if ($paged>1) {
               echo ' - page '. $paged; }
        ?>
    </title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico">

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
     
    <link rel="stylesheet" href="http://localhost/Mindcet-startups-site/wp-content/themes/mindcet-Theme/style.css" type="text/css" />
    <link rel="stylesheet" media="all and (max-width: 1023px)" href="http://localhost/Mindcet-startups-site/wp-content/themes/mindcet-Theme/mobile.css" type="text/css" />



    <style>
                .addthis_toolbox{
        position: absolute;
        top: 597px;
        right: 330px;
        z-index: 15;
        left:0;
        }
    </style>

            <!--[if lt IE 11]>
                                                            .addthis_toolbox{
                                                            position: absolute;
                                                            top: 597px;
                                                            right: 330px;
                                                            z-index: 15;
                                                            left:0;
                                                            }
                                                        <![endif]-->
</head>
    <body style="width: 100%;height: 100%;">
        <div class="google-map" style="width: 100%;height: 100%;">
            <div id="map"></div>
        </div>
        <script>
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
                    //if (isMobile) {
                    //    mapZoom = 0;
                    //}
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
            
                //console.log("check bounds " + latNorth + " " + latSouth);
            
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
                    //console.log("current center" + map.getCenter());
                    var newCenter = new google.maps.LatLng(newLat, map.getCenter().lng());
                    //console.log("setting new center" + newCenter);
                    map.setCenter(newCenter);
                }
            
            }
            
            function setMarkers(allMarkers) {
            
                for (marker in allMarkers) {
                    //convert to latLng
                    var myLatlng = new google.maps.LatLng(parseFloat(allMarkers[marker].lat), parseFloat(allMarkers[marker].lon));
                    //create marker push marker to array
                    addMarker(myLatlng,allMarkers[marker].markerId);
                }
                //show markers on map
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                    console.log(markers[i]);
                }
            }
            
            var placeInsaveVotesData = 0;
            var savePlaceInVotesData = [];
            // Add a marker to the map and push to the array.
            function addMarker(location,markerId) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            marker.markerId=markerId;
                markers.push(marker);
            
                //save favorites linked to the marker
                savePlaceInVotesData[marker.markerId] = placeInsaveVotesData++;
            
                google.maps.event.addListener(marker, 'click', function () {
                 //   var key = savePlaceInVotesData[marker.__gm_id];
           // window.open("https://www.toggl.com/app/timer", "_parent ");
            window.open(window.location.href.split("?")[0]+"#map/"+marker.markerId, "_parent ");
                    //buildMarkerPopupHTML(key);
                });
            }
            
            var saveVotesData=<?php echo getAllVotes();?>;
            initMap();
        </script>
    </body>

</html>
