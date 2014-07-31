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
    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập vào hệ thống Tìm Chòi</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('authen/login','role="form"') ?>
                        <a href="<?php echo $loginUrl; ?>" class="btn btn-info"></i>Đăng nhập với Facebook</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
