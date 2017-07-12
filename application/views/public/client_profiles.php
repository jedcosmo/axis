<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<section class="page-banner text-center" style="background:url('<?php echo base_url().$content->featured_img; ?>') no-repeat scroll center center / cover;">

    <div class="container">
        <h1><?php echo $content->heading; ?></h1>
        <hr/>
        <h4><?php echo nl2br($content->subheading); ?></h4>

        <a href="javascript:void(0)"><img src="<?php echo base_url()."assets/img/arrow.png"; ?>"></a>

    </div>

</section>

<section class="video">
	
	<?php if(!empty($featured)): ?>

		<div class="container">

			<div class="row">
				<div class="col-md-4 text-left">
					<h3><?php echo $featured->title; ?></h3>
					<?php echo $featured->content; ?>
				</div>

				<div class="col-md-8">
					<div class="embed_video">
						<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $featured->video); ?>"></iframe>
					</div>
				</div>
			</div>

		</div>

	<?php endif; ?>

</section>

<section class="videos">

	<div class="row">
		<?php foreach($stories as $s): ?>
			<?php if($s->isDefault != 1): ?>
				<div class="col-md-3">

					<a class="default_story_a" href="<?php echo base_url().'story/'.$s->uri ?>/#story_video">
						<div class="contain" style="background: #000 url('<?php echo base_url().$s->featured_img; ?>') no-repeat scroll center center / cover;">
							<div class="hover">
								<span><?php echo $s->title; ?></span>
							</div>
						</div>
					</a>

					<a class="responsive_story_a" href="<?php echo base_url().'story/'.$s->uri ?>/#video">
						<div class="contain" style="background: #000 url('<?php echo base_url().$s->featured_img; ?>') no-repeat scroll center center / cover;">
							<div class="hover">
								<span><?php echo $s->title; ?></span>
							</div>
						</div>
					</a>

					<a class="mobile_story_a" href="<?php echo base_url().'story/'.$s->uri ?>/#mobile_video">
						<div class="contain" style="background: #000 url('<?php echo base_url().$s->featured_img; ?>') no-repeat scroll center center / cover;">
							<div class="hover">
								<span><?php echo $s->title; ?></span>
							</div>
						</div>
					</a>

				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

</section>
