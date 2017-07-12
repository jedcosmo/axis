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

<div style="background:url('<?php echo base_url(); ?>assets/img/blog.png') no-repeat fixed center center / cover; ">
<section class=" text-center">
    <div class="masonry_wrapper">
        <div class="masonry">
            <?php foreach($blogs as $blog): ?>
                <div class="item">
                    <div class="hover">
                        <div class="pads">
                            <a href="<?php echo base_url().'blog/'.$blog->uri; ?>">
                                <img src="<?php echo base_url().$blog->featured_img; ?>" style="">
                                <span class="text-left"><?php echo $blog->title; ?></span>
                                <p class="text-left"><?php echo $blog->excerpt; ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</div>