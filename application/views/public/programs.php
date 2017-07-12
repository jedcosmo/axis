<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div style="background:url('<?php echo base_url(); ?>assets/img/impact2.jpg') no-repeat fixed center center / cover; z-index:-1; height:100%; width:100%; position:fixed; top:0; left:0; "></div>

<section class="page-banner text-center" style="background:url('<?php echo base_url().$content->featured_img; ?>') no-repeat scroll center center / cover;">

    <div class="container">
        <h1><?php echo $content->heading; ?></h1>
        <hr/>
        <h4><?php echo nl2br($content->subheading); ?></h4>

        <a href="javascript:void(0)"><img src="<?php echo base_url()."assets/img/arrow.png"; ?>"></a>

    </div>

</section>

<section class="programs">

	<div class="row">
	
		<?php foreach($programs as $program): ?>
			<div class="col-xs-12 col-sm-6 col-md-3 program" style="background:url(<?php echo base_url().$program->featured_img; ?>) no-repeat scroll top center / cover;">
				<a href="javascript:void(0);" data-toggle="modal" data-target="#<?php echo $program->uri; ?>" >
					<div class="hover">					
		                <span><?php echo $program->title; ?></span>
		                <p><?php echo $program->excerpt; ?></p>
		                <div class="play"></div>
		            </div>
		        </a>
			</div>
		<?php endforeach; ?>
		
	</div>
	
</section>

<section class="program_section program_section_1">
		
	<div class="row">
		<div class="col-md-9">
			<?php echo $content->content1; ?>
		</div>

		<div class="col-md-3"></div>
	</div>

</section>

<section class="program_section program_section_2">

	<div class="row">
		<div class="col-md-3"></div>
		
		<div class="col-md-9">
			<?php echo $content->content2; ?>
		</div>
	</div>

</section>

<section class="joun_us text-center">
	<div class="container">

		<?php echo $content->content3; ?>

		<a href="javascript:void(0);" class="btn btn-default join_us">JOIN US</a>

	</div>
</section>

<?php foreach($programs as $program): ?>
	<div id="<?php echo $program->uri; ?>" class="modal fade program_modal" role="dialog">
		
	  	<div class="modal-dialog modal-lg">
	  		<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $program->video); ?>"></iframe>
	  	</div>
	  	
	</div>
<?php endforeach; ?>