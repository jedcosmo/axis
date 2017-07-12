<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php //if($page != "contact"): ?>
<section id="join_section" style="display:<?php echo $toggleForm; ?>;">
    <div class="container">
        <div class="row">

            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-4">                
                <h3><?php echo $join_form_content->heading; ?></h3>
                <?php echo $join_form_content->content1; ?>
            </div>
            <div class="col-md-6 member_form">
                <?php echo form_open(current_url()."#join_section", array('class' => 'submit_join_form', 'id' => 'member_form')); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Member Form</h3>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <?php if($this->session->flashdata('member_form_message')): ?>
                                <div class="col-md-12">
                                    <div class="alert alert-<?php echo ($this->session->flashdata('member_form_message') == 'Thank You! We will contact you shortly.' ? 'info':'danger' ); ?> alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo ($this->session->flashdata('member_form_message') == 'Success' ? '<i class="icon fa fa-check"></i>':'' ); ?>
                                        <?php echo $this->session->flashdata('member_form_message'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>First Name</label>
                            <?php echo form_input($member_first_name); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Last Name</label>
                            <?php echo form_input($member_last_name); ?>
                            </div>
                        </div>
                        <!--
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="member_gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Date of Birth</label>
                            <?php //echo form_input($member_birthdate); ?>
                            </div>
                        </div>
                        -->
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Email</label>
                            <?php echo form_input($member_email); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Phone</label>
                            <?php echo form_input($member_phone); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Address</label>
                            <?php echo form_input($member_address); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>City</label>
                            <?php echo form_input($member_city); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>State</label>
                            <?php echo form_input($member_state); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Zip</label>
                            <?php echo form_input($member_zip); ?>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button name="submit" value="member_form" type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>            
            <!--
            <div class="col-md-6 volunteer_form">
                <?php //echo form_open(current_url()."#join_section", array('class' => 'submit_join_form', 'id' => 'volunteer_form')); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Volunteer Form</h3>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <?php //if($this->session->flashdata('volunteer_form_message')): ?>
                                <div class="col-md-12">
                                    <div class="alert alert-<?php //echo ($this->session->flashdata('volunteer_form_message') == 'Thank You! We will contact you shortly.' ? 'info':'danger' ); ?> alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php //echo ($this->session->flashdata('volunteer_form_message') == 'Success' ? '<i class="icon fa fa-check"></i>':'' ); ?>
                                        <?php //echo $this->session->flashdata('volunteer_form_message'); ?>
                                    </div>
                                </div>
                            <?php //endif; ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>First Name</label>
                            <?php //echo form_input($volunteer_first_name); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Last Name</label>
                            <?php //echo form_input($volunteer_last_name); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="volunteer_gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Date of Birth</label>
                            <?php //echo form_input($volunteer_birthdate); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Email</label>
                            <?php //echo form_input($volunteer_email); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Phone</label>
                            <?php //echo form_input($volunteer_phone); ?>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button name="submit" value="volunteer_form" type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                <?php //echo form_close(); ?>
            </div>
            -->

        </div>
    </div>
</section>
<?php //endif; ?>

<section class="footer">

    <div class="container">

        <div class="row">

            <div class="col-md-3 text-left">
                <a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url()."assets/img/logo-footer.png"; ?>"></a>
            </div>

            <div class="col-md-9 text-right">

                <ul class="list-unstyled footer-menu">
                    <li><a href="<?php echo base_url(); ?>">HOME</a></li>
                    <li><a href="<?php echo base_url()."about"; ?>">ABOUT</a></li>
                    <li><a href="<?php echo base_url()."programs"; ?>">PROGRAMS</a></li>                    
                    <li><a href="<?php echo base_url()."calendar"; ?>">CALENDAR</a></li>
                    <li><a href="<?php echo base_url()."get_involved"; ?>">GET INVOLVED</a></li>
                    <li><a href="<?php echo base_url()."shop"; ?>">SHOP</a></li>
                    <li><a href="<?php echo base_url()."client_profiles"; ?>">STORIES</a></li>
                    <li><a href="<?php echo base_url()."blogs"; ?>">BLOG</a></li>
                    <li><a href="<?php echo base_url()."contact"; ?>">CONTACT US</a></li>
                </ul>

                <ul class="list-unstyled footer-social">
                    <?php if(!empty($general->facebook)): ?>
                        <li class="fb"><a href="<?php echo $general->facebook; ?>" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($general->twitter)): ?>
                        <li class="tw"><a href="<?php echo $general->twitter; ?>" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($general->tumblr)): ?>
                        <li class="tb"><a href="<?php echo $general->tumblr; ?>" target="_blank"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                </ul>

                <?php echo nl2br($general->footer); ?>

            </div>

        </div>

    </div>

</section>


</body>

<script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url($plugins_dir . '/datepicker/bootstrap-datepicker.js'); ?>"></script>  
<script src="https://unpkg.com/isotope-layout@3.0/dist/isotope.pkgd.js"></script>
<script src="<?php echo base_url()."assets/js/axis.js"; ?>"></script>

</html>