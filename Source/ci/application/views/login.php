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
                        <h3 class="panel-title">Đăng nhập vào hệ thống NOAH</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($ps)): ?>
                        <div id="login-message" class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo $ps; ?>
                        </div>
                        <?php endif; ?>
                        <?php echo form_open('authen/login','role="form"') ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Tự động đăng nhập lần sau
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="<?php echo $loginUrl; ?>" class="btn btn-success">Đăng nhập với Facebook</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
