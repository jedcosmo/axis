<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!--
<section class="page-banner text-center" style="background:url('<?php //echo base_url()."assets/img/calendar.jpg"; ?>') no-repeat scroll center center / cover;">

    <div class="container">
        <h1><?php //echo $content->heading; ?></h1>
        <hr/>
        <h4><?php //echo nl2br($content->subheading); ?></h4>

        <a href="javascript:void(0)"><img src="<?php //echo base_url()."assets/img/arrow.png"; ?>"></a>

    </div>

</section>
-->
<section class="weekly_events text-center">
    <!--
    <h3>TODAY AT AXIS</h3>
    <hr/>
    -->

    <div class="container text-left">

        <div class="row">

            <div class="col-md-8">
                <h3><?php echo $events->title; ?></h3>
                <?php echo $events->content; ?>
            </div>

            <div class="col-md-4">
                <h3>Sign Up</h3>
                <?php echo form_open(current_url(), array('class' => '', 'id' => 'modal')); ?>
                    <div class="row signup_form">

                        <?php if($this->session->flashdata('message')): ?>
                            <div class="col-md-12">
                                <div class="alert alert-<?php echo ($this->session->flashdata('message') == 'Thank You! We will contact you shortly.' ? 'info':'danger' ); ?> alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo ($this->session->flashdata('message') == 'Success' ? '<i class="icon fa fa-check"></i>':'' ); ?>
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-md-12">
                            <div class="form-group">
                            <label>First Name</label>
                            <?php echo form_input($first_name); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Last Name</label>
                            <?php echo form_input($last_name); ?>
                            </div>
                        </div>
                        <!--
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Date of Birth</label>
                            <?php //echo form_input($birthdate); ?>
                            </div>
                        </div>
                        -->
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Phone</label>
                            <?php echo form_input($phone); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Email</label>
                            <?php echo form_input($email); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Number of Guests</label>
                            <?php echo form_input($number_of_guests); ?>
                            </div>
                        </div>

                        <!--
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Social Security Number</label>
                            <?php //echo form_input($ssn); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Address</label>
                            <?php //echo form_input($address); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>City</label>
                            <?php //echo form_input($city); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>State</label>
                            <?php //echo form_input($state); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Zip</label>
                            <?php //echo form_input($zip); ?>
                            </div>
                        </div>
                        -->
                        <div class="col-md-12 text-right">
                            <button name="submit" value="event_form" type="submit" class="btn btn-default">Submit</button>
                        </div>

                    </div>

                <?php echo form_close(); ?>
            </div>

        </div>

    </div>

</section>