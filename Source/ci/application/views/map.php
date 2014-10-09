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
    
    <script src="<?php echo base_url(); ?>assets/js/infobox.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>    
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
                <div class="user">
                    <p><img src="<?php echo $img_url ?>" alt="" class="img-circle user-avatar" /></p>
                </div>   

                <ol class="list-location">
                    <li class="geolocate"><a href="#" data-lat="" data-long="">Vị trí của bạn</a></li>
                    <?php foreach ($locations as $location) {
                       ?>
                       <li>
                            <a href="#" data-lat="<?php echo $location['lat']; ?>" data-long="<?php echo $location['long']; ?>"><?php echo $location['name'] ?></a>
                            <small><?php echo $location['description'] ?></small>
                       </li>
                       <?php
                    } ?>
                </ol>
            </div>
        </div><!-- end #side-bar -->
    </div>

    <?php $this->load->view('scripts/map-js.php') ?>
</body>
</html>
