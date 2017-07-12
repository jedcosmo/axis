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

<section class="daily_events text-center">

    <h3>DAILY EVENTS</h3>
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

<section class="calendar_block text-center">

    <h3>WEEKLY CALENDAR</h3>
    <hr/>

    <div class="container">

        <div class="box-body table_responsive no-padding">
            <table class="table table_calendar">
                <tbody>
                    <tr class="header">
                        <th>DAY SCHEDULE</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                    <tr>
                        <td>WEEK <br> <?php echo $monday ?> -<br/> <?php echo $saturday ?></td>
                        <td>  
                            <?php foreach($monday_activities as $mon_act): ?>
                                <?php if(strpos($mon_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-success"><?php echo $mon_act->time_start; ?> - <?php echo $mon_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $mon_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($tuesday_activities as $tue_act): ?>
                                <?php if(strpos($tue_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-success"><?php echo $tue_act->time_start; ?> - <?php echo $tue_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $tue_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($wednesday_activities as $wed_act): ?>
                                <?php if(strpos($wed_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-success"><?php echo $wed_act->time_start; ?> - <?php echo $wed_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $wed_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($thursday_activities as $thu_act): ?>
                                <?php if(strpos($thu_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-success"><?php echo $thu_act->time_start; ?> - <?php echo $thu_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $thu_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($friday_activities as $fri_act): ?>
                                <?php if(strpos($fri_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-success"><?php echo $fri_act->time_start; ?> - <?php echo $fri_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $fri_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($saturday_activities as $sat_act): ?>
                                <?php if(strpos($sat_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-success"><?php echo $sat_act->time_start; ?> - <?php echo $sat_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $sat_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>WEEK <br> <?php echo $next_monday ?> -<br/> <?php echo $next_saturday ?></td>
                        <td>  
                            <?php foreach($next_monday_activities as $next_mon_act): ?>
                                <?php if(strpos($next_mon_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_mon_act->time_start; ?> - <?php echo $next_mon_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_mon_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_tuesday_activities as $next_tue_act): ?>
                                <?php if(strpos($next_tue_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_tue_act->time_start; ?> - <?php echo $next_tue_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_tue_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_wednesday_activities as $next_wed_act): ?>
                                <?php if(strpos($next_wed_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_wed_act->time_start; ?> - <?php echo $next_wed_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_wed_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_thursday_activities as $next_thu_act): ?>
                                <?php if(strpos($next_thu_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_thu_act->time_start; ?> - <?php echo $next_thu_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_thu_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_friday_activities as $next_fri_act): ?>
                                <?php if(strpos($next_fri_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_fri_act->time_start; ?> - <?php echo $next_fri_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_fri_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_saturday_activities as $next_sat_act): ?>
                                <?php if(strpos($next_sat_act->time_start, 'AM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_sat_act->time_start; ?> - <?php echo $next_sat_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_sat_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <br/><br/>

            <table class="table table_calendar">
                <tbody>
                    <tr class="header">
                        <th>NIGHT SCHEDULE</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                    <tr>
                        <td>WEEK <br> <?php echo $monday ?> -<br/> <?php echo $saturday ?></td>
                        <td>  
                            <?php foreach($monday_activities as $mon_act): ?>
                                <?php if(strpos($mon_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-success"><?php echo $mon_act->time_start; ?> - <?php echo $mon_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $mon_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($tuesday_activities as $tue_act): ?>
                                <?php if(strpos($tue_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-success"><?php echo $tue_act->time_start; ?> - <?php echo $tue_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $tue_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($wednesday_activities as $wed_act): ?>
                                <?php if(strpos($wed_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-success"><?php echo $wed_act->time_start; ?> - <?php echo $wed_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $wed_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($thursday_activities as $thu_act): ?>
                                <?php if(strpos($thu_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-success"><?php echo $thu_act->time_start; ?> - <?php echo $thu_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $thu_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($friday_activities as $fri_act): ?>
                                <?php if(strpos($fri_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-success"><?php echo $fri_act->time_start; ?> - <?php echo $fri_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $fri_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($saturday_activities as $sat_act): ?>
                                <?php if(strpos($sat_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-success"><?php echo $sat_act->time_start; ?> - <?php echo $sat_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $sat_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>WEEK <br> <?php echo $next_monday ?> -<br/> <?php echo $next_saturday ?></td>
                        <td>  
                            <?php foreach($next_monday_activities as $next_mon_act): ?>
                                <?php if(strpos($next_mon_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_mon_act->time_start; ?> - <?php echo $next_mon_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_mon_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_tuesday_activities as $next_tue_act): ?>
                                <?php if(strpos($next_tue_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_tue_act->time_start; ?> - <?php echo $next_tue_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_tue_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_wednesday_activities as $next_wed_act): ?>
                                <?php if(strpos($next_wed_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_wed_act->time_start; ?> - <?php echo $next_wed_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_wed_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_thursday_activities as $next_thu_act): ?>
                                <?php if(strpos($next_thu_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_thu_act->time_start; ?> - <?php echo $next_thu_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_thu_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_friday_activities as $next_fri_act): ?>
                                <?php if(strpos($next_fri_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_fri_act->time_start; ?> - <?php echo $next_fri_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_fri_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>  
                            <?php foreach($next_saturday_activities as $next_sat_act): ?>
                                <?php if(strpos($next_sat_act->time_start, 'PM') !== false): ?>
                                    <span class="label label-warning"><?php echo $next_sat_act->time_start; ?> - <?php echo $next_sat_act->time_end; ?>:</span><br/>
                                    <span class="act_title"><?php echo $next_sat_act->title; ?></span>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row boxes">
            <div class="col-md-6 text-left"><?php echo $content->content1; ?></div>
            <div class="col-md-6 text-left"><?php echo $content->content2; ?></div>
        </div>

    </div>

</section>

<section class="home-events events text-center">

    <?php echo $content->content3; ?>

    <div class="container">
        <div class="row">
            <?php if(!empty($events)){ ?>
                <?php foreach($events as $event): ?>
                    <?php
                        $date = date('M-d-Y', strtotime($event->start_date));
                        $var = explode("-", $date);
                    ?>
                    <div class="col-md-4">
                        <div class="box row">
                            <a href="<?php echo base_url()."event/".$event->uri; ?>" onclick="showModal('<?php echo $days_ago; ?>','event')" >
                                <div class="col-md-2 date text-center"><?php echo strtoupper($var[0]); ?><span><?php echo $var[1]; ?></span></div>
                                <div class="col-md-10 title text-center"><?php echo $event->title; ?><span><?php echo $event->venue; ?></span></div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php }else{ ?>
                <div class="col-md-12"><h4 class="white">No Events</h4></div>
            <?php } ?>
        </div>
    </div>

</section>