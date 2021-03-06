<script>
        var locationAPI = "/timchoi/index.php/api/location/loca";

        $.getJSON( locationAPI, {
            format: "json"
        }).done(function(data) {
            var locations = jQuery.parseJSON(data);
        
            function initialize(locations) {
                //define the basic color of your map, plus a value for saturation and brightness
                var main_color = '#2d313f',
                    saturation_value= -20,
                    brightness_value= 5;

                //we define here the style of the map
                var style= [ 
                    {
                        //set saturation for the labels on the map
                        elementType: "labels",
                        stylers: [
                            {saturation: saturation_value}
                        ]
                    },  
                    {   //poi stands for point of interest - don't show these lables on the map 
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    {
                        //don't show highways lables on the map
                        featureType: 'road.highway',
                        elementType: 'labels',
                        stylers: [
                            {visibility: "off"}
                        ]
                    }, 
                    {   
                        //don't show local road lables on the map
                        featureType: "road.local", 
                        elementType: "labels.icon", 
                        stylers: [
                            {visibility: "off"} 
                        ] 
                    },
                    { 
                        //don't show arterial road lables on the map
                        featureType: "road.arterial", 
                        elementType: "labels.icon", 
                        stylers: [
                            {visibility: "off"}
                        ] 
                    },
                    {
                        //don't show road lables on the map
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [
                            {visibility: "off"}
                        ]
                    }, 
                    //style different elements on the map
                    { 
                        featureType: "transit", 
                        elementType: "geometry.fill", 
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    }, 
                    {
                        featureType: "poi",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "poi.government",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "poi.sport_complex",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "poi.attraction",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "poi.business",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "transit.station",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "landscape",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                        
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.fill",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }, 
                            { lightness: brightness_value }, 
                            { saturation: saturation_value }
                        ]
                    }, 
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [
                            { hue: main_color },
                            { visibility: "on" }
                        ]
                    }
                ];

                var mapOptions = {
                    zoom: 13,
                    styles: style
                };

                // show all location on map
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                var imgLink = '<?php echo base_url() . "/uploads/"; ?>';         

                var overlay = new google.maps.OverlayView();
                
                
                    overlay.onAdd = function() {
                        var panes = this.getPanes();
                        this.panes_ = panes;
                        for (var i = 0; i < locations.length; i++) {               
                            //Create 'div' container with class 'marker'
                            var div = document.createElement('div');

                            //Add style to div
                            div.style.position = "absolute";

                            //Add class marker to style in CSS
                            div.className = "marker";

                            //Add div content
                            div.innerHTML = '<figure class="marker-figure">'+
                                                '<img src="'+imgLink+locations[i].image+'">'+
                                            '</figure>'+
                                            '<section class="marker-hover">'+
                                                '<h2 class="title">'+locations[i].name+'</h2>'+
                                                '<p class="description" >'+locations[i].description+'</p>'+
                                            '</section>';

                            //Add div to pane
                            this.div_ = div;
                            
                            panes.floatPane.appendChild(this.div_);
                        };

                    }
                    overlay.draw = function() {
                        var latlng;
                        for (var i = 0; i < locations.length; i++) {  
                            latlng = new google.maps.LatLng(locations[i].lat, locations[i].long);
                            var point = this.getProjection().fromLatLngToDivPixel(latlng);
                            var div = this.panes_.floatPane.getElementsByTagName('div')[i];

                            if(div.className == 'marker') {
                                div.style.left = (point.x - 37) + 'px';
                                div.style.top = (point.y - 88) + 'px';
                            }
                        }
                        
                    }
                    overlay.onRemove = function() {
                        this.div_.parentNode.removeChild(this.div_);
                    }
                
                
                overlay.setMap(map);

                
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

                map.panTo(location);

                return false;
            });


            $('#map-canvas').on('mouseenter', '.marker-figure', function() {
                $(this).parent('.marker').addClass('z-index');
                $(this).next('.marker-hover').addClass("active");
            }).on('mouseleave', '.marker-figure', function() {
                $(this).parent('.marker').removeClass('z-index');
                $(this).next('.marker-hover').removeClass("active");
            }); 
        });
    </script>