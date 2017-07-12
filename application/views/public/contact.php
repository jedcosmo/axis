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

<div style="background:url('<?php echo base_url(); ?>assets/img/contact.png') no-repeat fixed center center / cover;">
<section class="contact_form">

	<div class="container">

		<div class="row">

			<div class="col-md-7">

				<?php echo form_open(current_url(), array('class' => '', 'id' => 'form_contact')); ?>

					<div class="row">

						<?php if($this->session->flashdata('contact_message')): ?>
                            <div class="col-md-12">
                                <div class="alert alert-<?php echo ($this->session->flashdata('contact_message') == 'Thank You! We will contact you shortly.' ? 'info':'danger' ); ?> alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo ($this->session->flashdata('contact_message') == 'Success' ? '<i class="icon fa fa-check"></i>':'' ); ?>
                                    <?php echo $this->session->flashdata('contact_message'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!--
						<div class="col-md-12">
							<div class="form-group">
								<label></label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
				                <label>
				                  <input type="radio" name="reason[]" value="Volunteer" <?php //echo $this->input->post('reason') == 'Volunteer' ? 'checked="checked"':'' ?> />
				                  &nbsp;&nbsp;Volunteer
				                </label>
				            </div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
				                <label>
				                  <input type="radio" name="reason[]" value="Need Help" <?php //echo $this->input->post('reason') == 'Need Help' ? 'checked="checked"':'' ?> />
				                  &nbsp;&nbsp;Problem with wheelchair
				                </label>				               
				            </div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
				                <label>
				                  <input type="radio" name="reason[]" value="Problem with wheelchair" <?php //echo $this->input->post('reason') == 'Problem with wheelchair' ? 'checked="checked"':'' ?> />
				                  &nbsp;&nbsp;Need help
				                </label>
				            </div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
				                <label>
				                  <input type="radio" name="reason[]" value="Other" <?php //echo $this->input->post('reason') == 'Other' ? 'checked="checked"':'' ?> />
				                  &nbsp;&nbsp;Other
				                </label>
				            </div>
						</div>
						-->

						<div class="col-md-12">
			                <div class="form-group">
			                <label>Why Are You Contacting Us?</label>			                
			                <select name="reason" class="form-control">
			                	<option <?php echo $this->input->post('reason') == "Become a Member" ? "selected='selected'":"";  ?> value="Become a Member">Become a Member</option>
			                	<option <?php echo $this->input->post('reason') == "Become a Volunteer" ? "selected='selected'":"";  ?> value="Become a Volunteer">Become a Volunteer</option>
			                	<option <?php echo $this->input->post('reason') == "Request Assistance" ? "selected='selected'":"";  ?> value="Request Assistance">Request Assistance</option>
			                	<option <?php echo $this->input->post('reason') == "Request an Axis Project Presentation" ? "selected='selected'":"";  ?> value="Request an Axis Project Presentation">Request an Axis Project Presentation</option>
			                	<option <?php echo $this->input->post('reason') == "Apply for position" ? "selected='selected'":"";  ?> value="Apply for position">Apply for position</option>
			                	<option <?php echo $this->input->post('reason') == "Become a partner" ? "selected='selected'":"";  ?> value="Become a partner">Become a partner</option>
			                	<option <?php echo $this->input->post('reason') == "Press inquiry" ? "selected='selected'":"";  ?> value="Press inquiry">Press inquiry</option>
			                	<option <?php echo $this->input->post('reason') == "Other" ? "selected='selected'":"";  ?> value="Other">Other..</option>
			                </select>
			                </div>
			            </div>

						<div class="col-md-6">
			                <div class="form-group">
			                <label>First Name</label>
			                <?php echo form_input($first_name); ?>
			                </div>
			            </div>

			            <div class="col-md-6">
			                <div class="form-group">
			                <label>Last Name</label>
			                <?php echo form_input($last_name); ?>
			                </div>
			            </div>

			            <div class="col-md-6">
			                <div class="form-group">
			                <label>Email</label>
			                <?php echo form_input($email); ?>
			                </div>
			            </div>

			            <div class="col-md-6">
			                <div class="form-group">
			                <label>Phone</label>
			                <?php echo form_input($phone); ?>
			                </div>
			            </div>

			            <div class="col-md-12">
			                <div class="form-group">
			                <label>Message</label>
			                <?php echo form_textarea($message); ?>
			                </div>
			            </div>

			            <div class="col-md-12 text-right">
			                <div class="form-group">
			            		<!--<input type="submit" class="btn btn-default" value="Submit"/>-->
			            		<button name="submit" value="contact_form" type="submit" class="btn btn-default">Submit</button>
			            	</div>
			            </div>

			        </div>

			    <?php echo form_close(); ?>

		    </div>

		    <div class="col-md-5">

		    	<h4></h4>

		    	<p>
		    		Vivamus gravida egestas arcu. Phasellus volutpat a ipsum vitae tempor. Morbi est nisi, scelerisque in turpis non, mollis euismod nisi. Nulla vulputate ac magna a dignissim. Proin blandit sit amet nunc vel dignissim.
		    	</p>

		    	<p>
		    		Vivamus vulputate, nibh quis cursus tristique, mauris magna hendrerit mauris, feugiat congue justo est a tellus. Integer lobortis ut mauris vel semper.
		    	</p>

		    </div>

		</div>

	</div>

</section>

<section class="map">

<div style="text-decoration:none; overflow:hidden; height:500px; width:100%; max-width:100%;"><div id="embed-map-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=The+Axis+Project,+5th+Avenue,+New+York,+NY,+United+States&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="google-map-html" rel="nofollow" href="https://www.interserver-coupons.com" id="inject-map-data">interserver-coupons.com</a><style>#embed-map-canvas .text-marker{max-width:none!important;background:none!important;}img{max-width:none}</style></div><script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=bcf0339d-51f2-fcd6-cf0e-22de4f6df331&c=google-map-html&u=1476370018" defer="defer" async="async"></script>

</section>
</div>