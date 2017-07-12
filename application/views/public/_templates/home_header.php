<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!doctype html>
<html lang="en">
<head>
    <title>Axis Project</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

    <!--MASONRY-->
    <link rel="stylesheet" href="http://w3bits.com/wp-content/themes/bits2/labs.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/css/masonry.css"; ?>">

    <link rel="stylesheet" href="<?php echo base_url()."assets/css/main.css"; ?>">
    <link rel="stylesheet" href="<?php echo base_url()."assets/css/responsive.css"; ?>">

</head>

<body>


<video id="video-background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0" tabindex="0" loop poster="" style="">
    <source src="<?php echo base_url()."assets/img/new_video.mp4"; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
    <source src="<?php echo base_url()."assets/img/new_video.webm"; ?>" type='video/webm; codecs="vp8, vorbis"' />
    <source src="<?php echo base_url()."assets/img/new_video.ogg"; ?>" type='video/ogg; codecs="theora, vorbis"' />
</video>

<?php if($general->notification !=""): ?>
    <div class="alert notification text-center alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $general->notification; ?>
    </div>
<?php endif; ?>

<section id="scroll_menu">
    <div class="container">

        <a href="<?php echo base_url(); ?>" class="pull-left"><img src="<?php echo base_url()."assets/img/logo.png"; ?>" class="logo"></a>

        <ul class="list-unstyled text-center pull-right">
            <li class="active" ><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
            <li><a href="<?php echo base_url()."about"; ?>"><i class="fa fa-users" aria-hidden="true"></i> ABOUT</a></li>
            <li><a href="<?php echo base_url()."programs"; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> PROGRAMS</a></li>            
            <li><a href="<?php echo base_url()."calendar"; ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> CALENDAR</a></li>
            <li><a href="<?php echo base_url()."get_involved"; ?>"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> GET INVOLVED</a></li>
            <li><a href="<?php echo base_url()."shop"; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SHOP</a></li>
            <li><a href="<?php echo base_url()."client_profiles"; ?>"><i class="fa fa-user" aria-hidden="true"></i> STORIES</a></li>
            <li><a href="<?php echo base_url()."blogs"; ?>"><i class="fa fa-rss" aria-hidden="true"></i> BLOG</a></li>
            <li><a href="<?php echo base_url()."contact"; ?>"><i class="fa fa-phone" aria-hidden="true"></i> CONTACT US</a></li>
        </ul>

    </div>    
</section>

<section class="sider">

    <div class="clearfix text-right">
        <a id="close_sider" href="javascript:void(0);"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>

    <ul class="list-unstyled text-left">
        <li class="active" ><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
        <li><a href="<?php echo base_url()."about"; ?>"><i class="fa fa-users" aria-hidden="true"></i> ABOUT</a></li>
        <li><a href="<?php echo base_url()."programs"; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> PROGRAMS</a></li>        
        <li><a href="<?php echo base_url()."calendar"; ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> CALENDAR</a></li>
        <li><a href="<?php echo base_url()."get_involved"; ?>"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> GET INVOLVED</a></li>
        <li><a href="<?php echo base_url()."shop"; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SHOP</a></li>
        <li><a href="<?php echo base_url()."client_profiles"; ?>"><i class="fa fa-user" aria-hidden="true"></i> STORIES</a></li>
        <li><a href="<?php echo base_url()."blogs"; ?>"><i class="fa fa-rss" aria-hidden="true"></i> BLOG</a></li>
        <li><a href="<?php echo base_url()."contact"; ?>"><i class="fa fa-phone" aria-hidden="true"></i> CONTACT US</a></li>
    </ul>
</section>

<section class="home-header">

    <div class="container"> 
        
        <a id="logo" href="<?php echo base_url(); ?>" class="pull-left"><img src="<?php echo base_url()."assets/img/logo.png"; ?>"></a>

        <ul class="list-unstyled pull-right social">
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

        <a href="https://www.classy.org/checkout/donation?eid=113664" target="_blank" class="btn btn-info pull-right get-involved-btn">DONATE</a>
        <a href="javascript:void(0);" id="join_us" class="btn btn-info pull-right get-involved-btn">BECOME A MEMBER</a>

        <a id="open_sider" href="javascript:void(0)"><i class="fa fa-bars" aria-hidden="true"></i></a>

        <div class="clearfix"></div>

        <h1 class="text-center"><?php echo $content->heading; ?></h1>
        <h4 class="text-center"><?php echo nl2br($content->subheading); ?></h4>

    </div>

    <div class="home-menu" id="home-menu">
        <ul class="list-unstyled text-center container">
            <li class="active" ><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
            <li><a href="<?php echo base_url()."about"; ?>"><i class="fa fa-users" aria-hidden="true"></i> ABOUT</a></li>
            <li><a href="<?php echo base_url()."programs"; ?>"><i class="fa fa-sitemap" aria-hidden="true"></i> PROGRAMS</a></li>            
            <li><a href="<?php echo base_url()."calendar"; ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> CALENDAR</a></li>
            <li><a href="<?php echo base_url()."get_involved"; ?>"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> GET INVOLVED</a></li>
            <li><a href="<?php echo base_url()."shop"; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SHOP</a></li>
            <li><a href="<?php echo base_url()."client_profiles"; ?>"><i class="fa fa-user" aria-hidden="true"></i> STORIES</a></li>
            <li><a href="<?php echo base_url()."blogs"; ?>"><i class="fa fa-rss" aria-hidden="true"></i> BLOG</a></li>
            <li><a href="<?php echo base_url()."contact"; ?>"><i class="fa fa-phone" aria-hidden="true"></i> CONTACT US</a></li>
        </ul>
    </div>

</section>