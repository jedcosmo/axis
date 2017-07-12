<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<section class="get_involved">

	<?php //echo $content->content1; ?>

	
	<ul class="list-unstyled">
		<li style="background:url(<?php echo base_url().'assets/img/get_involved1.jpg'; ?>) no-repeat scroll center center / cover;">
			<a href="javascript:void(0);">
				<div><i class="fa fa-fw fa-building"></i></div>
				<span>BRING AXIS TO YOUR COMMUNITY</span>
			</a>
		</li>
		<li style="background:url(<?php echo base_url().'assets/img/get_involved2.jpg'; ?>) no-repeat scroll center center / cover;">
			<a href="javascript:void(0);">
				<div><i class="fa fa-fw fa-tty"></i></div>
				<span>START A CONVERSATION</span>
			</a>
		</li>
		<li style="background:url(<?php echo base_url().'assets/img/get_involved3.jpg'; ?>) no-repeat scroll center center / cover;">
			<a href="javascript:void(0);">
				<div><i class="fa fa-fw fa-rss"></i></div>
				<span>STAY INFORMED</span>
			</a>
		</li>
		<li style="background:url(<?php echo base_url().'assets/img/get_involved4.jpg'; ?>) no-repeat scroll center center / cover;">
			<a href="javascript:void(0);">
				<div><i class="fa fa-fw fa-flag"></i></div>
				<span>EVENTS AND CAMPAIGNS</span>
			</a>
		</li>
		<li style="background:url(<?php echo base_url().'assets/img/get_involved5.jpg'; ?>) no-repeat scroll center center / cover;">
			<a href="javascript:void(0);">
				<div><i class="fa fa-fw fa-money"></i></div>
				<span>FUNDRAISE</span>
			</a>
		</li>
	</ul>
	

</section>

<section class="response get_involved_response text-center">
	<div class="container">

		<div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="border donate">
                    <a href="https://www.classy.org/checkout/donation?eid=113664" target="_blank">
                        <i class="fa fa-gift" aria-hidden="true"></i>
                        DONATE
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="border fundraise">
                    <a href="javascript:void(0);">
                        <i class="fa fa-leaf" aria-hidden="true"></i>
                        FUNDRAISE
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="border participate">
                    <a href="javascript:void(0);">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        PARTICIPATE
                    </a>
                </div>
            </div>
        </div>

	</div>
</section>

<section class="get_join">

	<div class="container">

		<div class="row">

			<div class="col-md-6 text-left">
				<div class="video">
					<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video1); ?>"></iframe>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#target_getjoin"><img src="<?php echo base_url()."assets/img/play.png"; ?>"></a>
				</div>
			</div>

			<div class="col-md-6 text-left">
				<?php echo $content->content2; ?>
				<!--
				<h4>JOIN US</h4>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent suscipit neque sed mi dignissim, ut elementum libero luctus. Phasellus sed vulputate lorem. Mauris dapibus lacus sapien, at vulputate metus tempus eget. Ut ornare vehicula tempor. Curabitur scelerisque vulputate ornare. Maecenas ultrices finibus nibh, ac mollis velit. Nam mauris turpis, varius quis orci id, pretium eleifend odio. Sed eget neque velit. Suspendisse fringilla, nisi ac lacinia gravida
				</p>
				-->
			</div>

		</div>

	</div>

</section>

<section class="volunteer_and_partner">

	<div class="row">

		<div class="col-md-6 text-left left">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-8">
					<?php echo $content->content3; ?>
					<!--
					<h4>VOLUNTEER</h4>
					<p>
						Cras placerat tempus ligula, vel tincidunt dolor suscipit eu. Etiam feugiat justo vel sem pellentesque, eget lacinia quam aliquet. Integer et vulputate odio, quis malesuada arcu. Etiam posuere arcu ex, a viverra mi congue vel. Nam commodo velit non dui tempus vulputate. Nulla vel metus et arcu blandit convallis sagittis sit amet enim.
					</p>
					-->

					<a href="<?php echo base_url()."contact"; ?>" class="btn btn-default get_involved_contact_btn">CONTACT US</a>
				</div>
			</div>
		</div>

		<div class="col-md-6 text-left right">
			<div class="row">
				<div class="col-md-8">
					<?php echo $content->content4; ?>
					<!--
					<h4>PARTNER WITH US</h4>
					<p>
						Proin ut ex sed erat tempor ultricies quis ac neque. Nullam ultrices eu ex in lacinia. Morbi et neque ac ante molestie gravida non ut justo. Nulla facilisi. Suspendisse lectus tellus, sagittis vel quam at, eleifend facilisis felis.
					</p>
					-->

					<a href="<?php echo base_url()."contact"; ?>" class="btn btn-default get_involved_contact_btn">CONTACT US</a>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>

	</div>

</section>

<div id="target_getjoin" class="modal fade program_modal" role="dialog">		
  	<div class="modal-dialog modal-lg">
  		<iframe src="<?php echo str_replace("https://vimeo.com/","//player.vimeo.com/video/", $content->video1); ?>"></iframe>
  	</div>  	
</div>