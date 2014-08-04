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

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv9IFrWTglCipymEeeFdC5d3epqmFJk5M">
    </script>   

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <script>
        function initialize() {
            var locations = <?php echo $locations_json; ?>;

            var mapOptions = {
                zoom: 16
            };

            // show all location on map
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            for(var i = 0; i < locations.length; i++) {
                var marker = new google.maps.Marker ({
                    position: new google.maps.LatLng(locations[i].lat, locations[i].long),
                    map: map,
                    title: locations[i].description
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
                    title: "You are here"
                });
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
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
