<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div style="background:url('<?php echo base_url(); ?>assets/img/mission.jpg') no-repeat fixed center center / cover; z-index:-1; height:100%; width:100%; position:fixed; top:0; left:0; "></div>

<section class="page-banner text-center" style="background:url('<?php echo base_url().$content->featured_img; ?>') no-repeat scroll center center / cover;">

    <div class="container">
        <h1><?php echo $content->heading; ?></h1>
        <hr/>
        <h4><?php echo nl2br($content->subheading); ?></h4>

        <a href="javascript:void(0)"><img src="<?php echo base_url()."assets/img/arrow.png"; ?>"></a>

    </div>

</section>

<section class="mission text-center">
	<div class="container">

		<?php echo $content->content1; ?>

		<div class="video">
			<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video1); ?>"></iframe>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#target_mission"><img src="<?php echo base_url()."assets/img/play.png"; ?>"></a>
		</div>

	</div>
</section>

<section class="story text-center">
	<div class="container">

		<?php echo $content->content2; ?>

		<div class="video"></div>

	</div>
</section>

<section class="team text-center">
	<h3>TEAM</h3>
	<hr/>

	<div class="row">
	<?php foreach($team as $t): ?>
		<div class="col-xs-6 col-sm-4 col-md-3 member" style="background:url('<?php echo base_url().$t->featured_img; ?>') no-repeat scroll center center / cover;">
			<a href="<?php echo base_url(); ?>team/<?php echo $t->uri; ?>">
                <span><?php echo $t->first_name; ?> <?php echo $t->last_name; ?></span>
                <div></div>
            </a>
		</div>
	<?php endforeach; ?>
	</div>

</section>

<section class="needs text-center">
	<div class="container">

		<?php echo $content->content3; ?>

	</div>
</section>

<section class="response text-center">
	<div class="container">

		<?php echo $content->content4; ?>

		<div class="row">
			<div class="col-md-4 video text-center">
				<div class="item">
					<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video2); ?>"></iframe>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#target_1"><img src="<?php echo base_url()."assets/img/play.png"; ?>"></a>
				</div>
			</div>
			<div class="col-md-4 video text-center">
				<div class="item">
					<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video3); ?>"></iframe>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#target_2"><img src="<?php echo base_url()."assets/img/play.png"; ?>"></a>
				</div>
			</div>
			<div class="col-md-4 video text-center">
				<div class="item">
					<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video4); ?>"></iframe>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#target_3"><img src="<?php echo base_url()."assets/img/play.png"; ?>"></a>
				</div>
			</div>
		</div>
		
        <?php echo $content->content5; ?>

	</div>
</section>

<div id="target_1" class="modal fade program_modal" role="dialog">		
  	<div class="modal-dialog modal-lg">
  		<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video2); ?>"></iframe>
  	</div>  	
</div>

<div id="target_2" class="modal fade program_modal" role="dialog">		
  	<div class="modal-dialog modal-lg">
  		<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video3); ?>"></iframe>
  	</div>  	
</div>

<div id="target_3" class="modal fade program_modal" role="dialog">		
  	<div class="modal-dialog modal-lg">
  		<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video4); ?>"></iframe>
  	</div>  	
</div>

<div id="target_mission" class="modal fade program_modal" role="dialog">		
  	<div class="modal-dialog modal-lg">
  		<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video1); ?>"></iframe>
  	</div>  	
</div>