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

<section class="products">

	<div class="container">
		<ul class="list-unstyled">
			<?php if(!empty($products)): ?>
				<?php $ctr = 1; ?>
				<?php foreach($products as $product): ?>
					<li style="background:url('<?php echo base_url().$product->featured_img; ?>') no-repeat scroll center center / 70%;">
						<p>
							<?php echo $product->title; ?>
							<span>$<?php echo $product->price; ?></span>
						</p>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>

</section>