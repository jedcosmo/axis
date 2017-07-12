<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<section class="home-about text-center">
    <div class="container">
        <?php echo $content->content1; ?>
        <br/><br/>
        <a href="<?php echo base_url()."about"; ?>" class="btn btn-default learn_more">LEARN MORE</a>
    </div>
</section>

<section class="today_at_axis text-center">
    <h3>TODAY AT AXIS</h3>
    <hr/>

    <div class="container">
        <div class="row">
            <?php if(!empty($daily)){ ?>
                <?php foreach($daily as $day): ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="box row">
                            <div class="col-xs-6 col-sm-6 col-md-5 date text-right"><?php echo date('D'); ?><span><?php echo date('d') ?></span></div>
                            <div class="col-xs-6 col-sm-6 col-md-7 title text-left"><?php echo $day->time_start; ?> - <?php echo $day->time_start; ?><span><?php echo $day->title; ?></span></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php }else{ ?>
                <div class="col-md-12"><h4 class="white">No Activity For Today</h4></div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="home-programs text-center">

    <?php echo $content->content2; ?>

    <?php
        $program_array = array("advocacy_desk.jpg","cardio_boxing.jpg","yoga.jpg","handcycling.jpg","pitstop.jpg"); 
    ?> 

    <ul class="list-unstyled">
        <?php $program_ctr=0; ?>
        <?php foreach($programs as $program): ?>
            <?php if($program_ctr <= 4): ?>
                <li style="background:url('<?php echo base_url().$program->featured_img; ?>') no-repeat scroll center center / cover;">
                    <a href="<?php echo base_url(); ?>programs/#<?php echo $program->uri; ?>" >
                        <div class="hover">
                            <span><?php echo $program->title; ?></span>
                            <p><?php echo $program->excerpt; ?></p>
                            <div class="play"></div>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php $program_ctr++; ?>
        <?php endforeach; ?>        
    </ul>

    <a href="<?php echo base_url()."programs"; ?>" class="btn btn-default home-programs-btn">VIEW OUR PROGRAMS</a>

</section>

<section class="home-impact">
    <div class="container">
        <?php echo $content->content3; ?>
    </div>
</section>

<section class="home-blogs text-center">

    <?php echo $content->content4; ?>

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

    <a href="<?php echo base_url()."blogs"; ?>" class="btn btn-default home-blogs-btn">VIEW BLOGS</a>

</section>

<section class="home-events text-center">

    <?php echo $content->content5; ?>

    <div class="container">
        <div class="row">
            <?php $ctr=1; ?>
            <?php if(!empty($events)){ ?>
                <?php foreach($events as $event): ?>
                    <?php if($ctr <= 3): ?>
                        <?php
                            $date = date('M-d-Y', strtotime($event->start_date));
                            $var = explode("-", $date);
                        ?>
                        <div class="col-md-4">
                            <div class="box row">
                                <a href="<?php echo base_url()."event/".$event->uri; ?>">   
                                    <div class="col-md-2 date text-center"><?php echo strtoupper($var[0]); ?><span><?php echo $var[1]; ?></span></div>
                                    <div class="col-md-10 title text-center"><?php echo $event->title; ?><span><?php echo $event->venue; ?></span></div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $ctr++; ?>
                <?php endforeach; ?>
            <?php }else{ ?>
                <div class="col-md-12"><h4 class="white">No Events</h4></div>
            <?php } ?>
        </div>
    </div>

    <a href="<?php echo base_url()."calendar"; ?>" class="btn btn-default home-events-btn">VIEW ALL EVENTS</a>

</section>