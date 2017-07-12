<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<section class="page-banner text-center" style="background:url('<?php echo base_url().$content->featured_img; ?>') no-repeat scroll center center / cover;">

    <div class="container">
        <h1><?php echo $team->first_name; ?> <?php echo $team->last_name; ?></h1>
        <hr/>
        <h4><?php echo $team->position; ?></h4>
        <a href="javascript:void(0)"><img src="<?php echo base_url()."assets/img/arrow.png"; ?>"></a>

    </div>

</section>

<section class="two-column text-center">
	<div class="container">

		<div class="row">
			<div class="col-md-4 text-right">
				<?php if(!empty($team->featured_img)): ?>
					<img src="<?php echo base_url().$team->featured_img; ?>" alt="" width="100%" />
				<?php endif; ?>
			</div>

			<div class="col-md-8 text-left">
				<?php echo $team->content; ?>
			</div>
		</div>

	</div>
</section>