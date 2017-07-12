<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <p>Filter By:</p>
              <h3>Client Profiles</h3>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url().'admin/reports/client'; ?>" class="small-box-footer">
              Go <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <p>Filter By:</p>
              <h3>Activities</h3>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="<?php echo base_url().'admin/reports/activity'; ?>" class="small-box-footer">
              Go <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <p>Filter By:</p>
              <h3>Demographic Feature</h3>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="<?php echo base_url().'admin/reports/demographic'; ?>" class="small-box-footer">
              Go <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <p>Filter By:</p>
              <h3>Goals</h3>
            </div>
            <div class="icon">
              <i class="fa fa-archive"></i>
            </div>
            <a href="<?php echo base_url().'admin/reports/goals'; ?>" class="small-box-footer">
              Go <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
          
       <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <p>Filter By:</p>
              <h3>Attendance</h3>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <a href="<?php echo base_url().'admin/reports/attendance'; ?>" class="small-box-footer">
              Go <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>   

      </div>

    </section>

</div>
