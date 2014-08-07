<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tìm Chòi - Web application</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">   

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv9IFrWTglCipymEeeFdC5d3epqmFJk5M&libraries=places">
    </script>   

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <script>
        var locationAPI = "http://localhost/timchoi/index.php/api/location/loca";

        $.getJSON( locationAPI, {
            format: "json"
        }).done(function(data) {
            var locations = jQuery.parseJSON(data);
        
            function initialize(locations) {
                var mapOptions = {
                    zoom: 13
                };

                // show all location on map
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                // infowindow
                var infowindow = new google.maps.InfoWindow();

                for(var i = 0; i < locations.length; i++) {
                    // infowindow
                    var contentString = '<div id="content">'+
                      '<div id="siteNotice">'+
                      '</div>'+
                      '<h1 id="firstHeading" class="firstHeading">'+locations[i].name+'</h1>'+
                      '<div id="bodyContent">'+
                      '<p>'+locations[i].description+'</p>'+
                      '</div>'+
                      '</div>';

                    var marker = new google.maps.Marker ({
                        position: new google.maps.LatLng(locations[i].lat, locations[i].long),
                        map: map,
                        icon: "<?php echo base_url() . 'assets/images/dark-marker.png'; ?>",
                        title: locations[i].name,
                        info: contentString
                    });

                   

                    // handle click event
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(this.info);
                        infowindow.open(map, this);

                        // zoom map
                        //map.setZoom(15);
                        //map.setCenter(this.getPosition());
                    });
                }

                // get your current location using HTML5 Geolocation
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var long = position.coords.longitude;
                    var geolocate = new google.maps.LatLng(lat, long);

                    //
                    $('.geolocate').find('a').attr('data-lat', lat);
                    $('.geolocate').find('a').attr('data-long', long);

                    map.setCenter(geolocate);

                    // marker 
                    var market = new google.maps.Marker ({
                        position: geolocate,
                        map: map,
                        icon: "<?php echo base_url() . 'assets/images/pink-marker.png'; ?>",
                        title: "You are here"
                    });
                });

                // search box
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
            }

            google.maps.event.addDomListener(window, 'load', initialize(locations));
               
            });
    </script>

    <script>
        $(document).ready(function () {
            var a = $('.list-location').find('a');
            a.click(function() {
                var lat = $(this).attr('data-lat');
                var long = $(this).attr('data-long');
                var location = new google.maps.LatLng(lat, long);

                map.setCenter(location);

                return false;
            });
        });
    </script>
    
</head>

<body>
    
    <div id="wrapper">
        <div id="map-canvas">
        </div><!-- end #map-canvas -->
        
        <div id="search-box">
            <input type="text" id="pac-input" class="controls" placeholder="Search Box" />
        </div><!-- end search-box -->

        <div id="sidebar">
            <div class="sidebar-inner">
                <ol class="list-location">
                    <li class="geolocate"><a href="#" data-lat="" data-long="">Vị trí của bạn</a></li>
                    <?php foreach ($locations as $location) {
                       ?>
                       <li>
                            <a href="#" data-lat="<?php echo $location['lat']; ?>" data-long="<?php echo $location['long']; ?>"><?php echo $location['name'] ?></a>
                            <small><?php echo $location['lat'] . ', ' . $location['long']; ?></small>
                       </li>
                       <?php
                    } ?>
                </ol>
            </div>
        </div><!-- end #side-bar -->

    </div>

</body>
</html>
