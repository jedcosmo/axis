<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!doctype html>
<html lang="en">
<head>
    <title>Axis Project | <?php echo $content->title; ?></title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

    <!--MASONRY-->
    <link rel="stylesheet" href="http://w3bits.com/wp-content/themes/bits2/labs.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/css/masonry.css"; ?>">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/datepicker/datepicker3.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url()."assets/css/main.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."assets/css/responsive.css"; ?>">

</head>

<body>

<section id="scroll_menu">
    <div class="container">

        <a href="<?php echo base_url(); ?>" class="pull-left"><img src="<?php echo base_url()."assets/img/logo.png"; ?>" class="logo"></a>

        <ul class="list-unstyled text-center pull-right">
            <li class="<?php echo ($page == 'home') ? 'active':'' ?>" ><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
            <li class="<?php echo ($page == 'about') ? 'active':'' ?>" ><a href="<?php echo base_url()."about"; ?>"><i class="fa fa-users" aria-hidden="true"></i> ABOUT</a></li>
            <li class="<?php echo ($page == 'programs') ? 'active':'' ?>" ><a href="<?php echo base_url()."programs"; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> PROGRAMS</a></li>            
            <li class="<?php echo ($page == 'calendar') ? 'active':'' ?>" ><a href="<?php echo base_url()."calendar"; ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> CALENDAR</a></li>
            <li class="<?php echo ($page == 'get_involved') ? 'active':'' ?>" ><a href="<?php echo base_url()."get_involved"; ?>"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> GET INVOLVED</a></li>
            <li class="<?php echo ($page == 'shop') ? 'active':'' ?>" ><a href="<?php echo base_url()."shop"; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SHOP</a></li>
            <li class="<?php echo ($page == 'client_profiles') ? 'active':'' ?>" ><a href="<?php echo base_url()."client_profiles"; ?>"><i class="fa fa-user" aria-hidden="true"></i> STORIES</a></li>
            <li class="<?php echo ($page == 'blogs') ? 'active':'' ?>" ><a href="<?php echo base_url()."blogs"; ?>"><i class="fa fa-rss" aria-hidden="true"></i> BLOG</a></li>
            <li class="<?php echo ($page == 'contact') ? 'active':'' ?>" ><a href="<?php echo base_url()."contact"; ?>"><i class="fa fa-phone" aria-hidden="true"></i> CONTACT US</a></li>
        </ul>

    </div>    
</section>

<section class="sider">

    <div class="clearfix text-right">
        <a id="close_sider" href="javascript:void(0);"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>

    <ul class="list-unstyled text-left">
        <li class="<?php echo ($page == 'home') ? 'active':'' ?>"><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
        <li class="<?php echo ($page == 'about') ? 'active':'' ?>"><a href="<?php echo base_url()."about"; ?>"><i class="fa fa-users" aria-hidden="true"></i> ABOUT</a></li>
        <li class="<?php echo ($page == 'programs') ? 'active':'' ?>"><a href="<?php echo base_url()."programs"; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> PROGRAMS</a></li>        
        <li class="<?php echo ($page == 'calendar') ? 'active':'' ?>"><a href="<?php echo base_url()."calendar"; ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> CALENDAR</a></li>
        <li class="<?php echo ($page == 'get_involved') ? 'active':'' ?>" ><a href="<?php echo base_url()."get_involved"; ?>"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> GET INVOLVED</a></li>
        <li class="<?php echo ($page == 'shop') ? 'active':'' ?>"><a href="<?php echo base_url()."shop"; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SHOP</a></li>
        <li class="<?php echo ($page == 'client_profiles') ? 'active':'' ?>"><a href="<?php echo base_url()."client_profiles"; ?>"><i class="fa fa-user" aria-hidden="true"></i> STORIES</a></li>
        <li class="<?php echo ($page == 'blogs') ? 'active':'' ?>"><a href="<?php echo base_url()."blogs"; ?>"><i class="fa fa-rss" aria-hidden="true"></i> BLOG</a></li>
        <li class="<?php echo ($page == 'contact') ? 'active':'' ?>"><a href="<?php echo base_url()."contact"; ?>"><i class="fa fa-phone" aria-hidden="true"></i> CONTACT US</a></li>
    </ul>
</section>

<?php if($general->notification !=""): ?>
    <div class="alert notification text-center alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $general->notification; ?>
    </div>
<?php endif; ?>    

<section class="page-header">

    <div class="container"> 

        <div class="row">

            <div class="col-md-3 text-left">
                <a href="<?php echo base_url(); ?>" class="pull-left"><img src="<?php echo base_url()."assets/img/logo.png"; ?>"></a>
            </div>

            <div class="col-md-9 text-right">
                <ul class="list-unstyled social">
                    <li><a href="javascript:void(0);" id="join_us" class="btn btn-info inner-join">BECOME A MEMBER</a></li>
                    <li><a href="https://www.classy.org/checkout/donation?eid=113664" target="_blank" id="join_us" class="btn btn-info inner-join">DONATE</a></li>
                    <?php if(!empty($general->facebook)): ?>
                        <li class="fb"><a href="<?php echo $general->facebook; ?>" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($general->twitter)): ?>
                        <li class="tw"><a href="<?php echo $general->twitter; ?>" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($general->tumblr)): ?>
                        <li class="tb"><a href="<?php echo $general->tumblr; ?>" target="_blank"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                </ul>


                <div class="page-menu">
                    <ul class="list-unstyled text-right">
                        <li class="<?php echo ($page == 'home') ? 'active':'' ?>"><a href="<?php echo base_url(); ?>">HOME</a></li>
                        <li class="<?php echo ($page == 'about') ? 'active':'' ?>"><a href="<?php echo base_url()."about"; ?>">ABOUT</a></li>
                        <li class="<?php echo ($page == 'programs') ? 'active':'' ?>"><a href="<?php echo base_url()."programs"; ?>">PROGRAMS</a></li>
                        <li class="<?php echo ($page == 'calendar') ? 'active':'' ?>"><a href="<?php echo base_url()."calendar"; ?>"> CALENDAR</a></li>
                        <li class="<?php echo ($page == 'get_involved') ? 'active':'' ?>"><a href="<?php echo base_url()."get_involved"; ?>"> GET INVOLVED</a></li>
                        <li class="<?php echo ($page == 'shop') ? 'active':'' ?>"><a href="<?php echo base_url()."shop"; ?>">SHOP</a></li>
                        <li class="<?php echo ($page == 'client_profiles') ? 'active':'' ?>"><a href="<?php echo base_url()."client_profiles"; ?>">STORIES</a></li>
                        <li class="<?php echo ($page == 'blogs') ? 'active':'' ?>"><a href="<?php echo base_url()."blogs"; ?>">BLOG</a></li>
                        <li class="<?php echo ($page == 'contact') ? 'active':'' ?>"><a href="<?php echo base_url()."contact"; ?>">CONTACT US</a></li>
                    </ul>
                </div>

                <a id="open_sider" href="javascript:void(0)"><i class="fa fa-bars" aria-hidden="true"></i></a>

            </div>

        </div>

    </div>

</section>