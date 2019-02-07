<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online Services</title>

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <section class="signin-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="signin-logo">
                            <img src="<?php echo base_url(); ?>img/logo_250x60.png">
                        </div>

                        <form class="form-signin" method="post" action="<?php echo base_url(); ?>member/adminlogin">
                            <div class="login-wrap">
                                <div class="user-login-info">
                                    <input type="text" class="form-control" placeholder="User ID" name="name" autofocus="">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                           
                               <button class="btn btn-lg btn-login btn-block" type="submit"> Log in</button>
                                <?php $error = $this->session->flashdata('error');
                                if($error) { ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo $error; ?>
                                    </div>
                                <?php }?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>js/sb-admin-2.js"></script>

</body>

</html>
