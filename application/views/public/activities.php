<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<section class="page-banner text-center" style="background:url('<?php echo base_url()."assets/img/calendar.jpg"; ?>') no-repeat scroll center center / cover;">

    <div class="container">
        <h1><?php echo $content->heading; ?></h1>
        <hr/>
        <h4><?php echo nl2br($content->subheading); ?></h4>

        <a href="javascript:void(0)"><img src="<?php echo base_url()."assets/img/arrow.png"; ?>"></a>

    </div>

</section>

<section class="weekly_events text-center">
    <!--
    <h3>TODAY AT AXIS</h3>
    <hr/>
    -->
    <h3>Activities for <?php echo date('F j Y', strtotime($date)); ?></h3>
    <hr/>

    <div class="container">
        <div class="row">
            <?php if(!empty($activities)){ ?>
                <?php foreach($activities as $activity): ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="box row">
                            <div class="col-xs-6 col-sm-6 col-md-5 date text-right"><?php echo date('D', strtotime($date)); ?><span><?php echo date('d', strtotime($date)); ?></span></div>
                            <div class="col-xs-6 col-sm-6 col-md-7 title text-left"><?php echo $activity->time_start; ?> - <?php echo $activity->time_start; ?><span><?php echo $activity->title; ?></span></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php }else{ ?>
                <div class="col-md-12"><h4 class="black">No Activity For This Day</h4></div>
            <?php } ?>
        </div>
    </div>

</section>