<html>
<head>
	<title>Add location</title>
	<meta  charset="utf-8" name="name" content="content">
        <!-- Core CSS - Include with every page -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv9IFrWTglCipymEeeFdC5d3epqmFJk5M&libraries=places">
        </script>   

        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        
        <script>
            function initialize() {
                var mapOptions = {
                    zoom: 13,
                    center: new google.maps.LatLng(10.768451, 106.6943626)
                };
                var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      
                var myMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(10.768451, 106.6943626),
                    draggable: true,
                    map: map
                });
                
                google.maps.event.addListener(myMarker, 'dragend', function(evt){
                    document.getElementById('lat').value = evt.latLng.lat().toFixed(6);
                    document.getElementById('long').value = evt.latLng.lng().toFixed(6);
                });

                google.maps.event.addListener(myMarker, 'dragstart', function(evt){
                    $('.help-block').html('Yes, you can move to every where you want');
                });
            }
            
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <style>
            #map-canvas {
                border: 1px solid #b0b0b0;
                border-radius: 5px;
            }
        </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Location</h2>
            </div>
            <div class="col-md-6">
                <?php if($error):  
                                echo $error;
                           endif;?>
                <?php
                        echo form_open_multipart("user/add");
                        if(validation_errors()){
                                echo'<h3>Whoops! There was an error</h3>';
                                echo validation_errors();
                        }
                ?>
                <table border="0">
                        <tr>
                                <td>Tên địa điểm:</td>
                                <td><?php echo form_input($name_location); ?></td>
                        </tr>
                        <tr>
                                <td>Mô tả:</td>
                                <td><?php echo form_input($description); ?></td>
                        </tr>		
                            <tr>
                                <td>Lat:</td>
                                <td><?php echo form_input($lat); ?></td>
                        </tr>
                        <tr>
                                <td>Long:</td>
                                <td><?php echo form_input($long); ?></td>
                        </tr>
                        <tr>
                                <td>User_id:</td>
                                <td><?php echo form_input($user_id); ?></td>
                        </tr>
                        <tr>
                                <td>Cập nhật ảnh đại diện:</td>
                                <td><?php echo form_checkbox($check_upload); ?></td>
                        </tr>
                        <tr>
                                <td>Chọn tập tin hình ảnh</td>
                                <td><?php echo form_upload($file_upload); ?></td>
                        </tr>
                </table>
                <?php echo form_submit('submit', 'Create'); ?> or <?php echo anchor('user/index', 'cancel'); ?>
                <?php echo form_close(); ?>                
            </div>
            <div class="col-md-6">
                <div id="map-canvas" style="height: 400px"></div>
                <div class="help-block">Please drag to your location</div>
            </div>
        </div>
    </div>
</body>
</html>
