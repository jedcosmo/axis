<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<section class="page-banner text-center" style="background:url('<?php echo base_url().$content->featured_img; ?>') no-repeat scroll center center / cover;">

    <div class="container">
        <h1><?php echo $blog->title; ?></h1>
        <hr/>

        <a href="javascript:void(0)"><img src="<?php echo base_url()."assets/img/arrow.png"; ?>"></a>

    </div>

</section>

<section class="two-column text-center">
	<div class="container">

		<div class="row">
			<div class="col-md-4 text-right">
				<?php if(!empty($blog->featured_img)): ?>
					<img src="<?php echo base_url().$blog->featured_img; ?>" alt="" width="100%" />
				<?php endif; ?>
			</div>

			<div class="col-md-8 text-left">
				<?php echo $blog->content; ?>
			</div>
		</div>

	</div>
</section>