<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
  <section class="content-header">
      <?php echo $pagetitle; ?>
      <?php echo $breadcrumb; ?>
  </section>

  <section class="content">

    <?php if( $user_role == 'admin'): ?>
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <p>Filter Reports By:</p>
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
              <p>Filter Reports By:</p>
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
              <p>Filter Reports By:</p>
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
              <p>Filter Reports By:</p>
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

      </div>
    <?php endif; ?>

    <div class="row">

      <?php if( ($user_role == 'admin') || ($user_role == 'Manager') || ($user_role == 'Instructor') ): ?>
        <div class="col-md-<?php echo $user_role == 'Manager' ? '6':'12' ?>">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Activities</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                  </tr>
                  <?php $activities_ctr = 1; ?>
                  <?php foreach($activities as $activity): ?>
                    <?php if($activities_ctr <= 5): ?>
                      <tr>
                        <td><?php echo $activity->title; ?></td>
                        <td><?php echo date('F j, Y',strtotime($activity->date)); ?></td>
                        <td><?php echo $activity->time_start; ?> to <?php echo $activity->time_end; ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php $activities_ctr++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer text-center">
              <a href="<?php echo base_url().'admin/activities'; ?>" class="uppercase">View All Activities</a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if( ($user_role == 'admin') || ($user_role == 'Manager') ): ?>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Clients</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>SSN</th>
                  </tr>
                  <?php $clients_ctr = 1; ?>
                  <?php foreach($clients as $client): ?>
                    <?php if($clients_ctr <= 5): ?>
                      <tr>
                        <td><?php echo $client->member_id; ?></td>
                        <td><?php echo $client->first_name; ?> <?php echo $client->last_name; ?></td>
                        <td><?php echo ($client->is_member == 'M') ? 'Member' : 'Non-member'; ?></td>
                        <td><?php echo $client->ssn; ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php $clients_ctr++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer text-center">
              <a href="<?php echo base_url().'admin/clients'; ?>" class="uppercase">View All Clients</a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if( $user_role == 'admin'): ?>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Events</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Venue</th>
                  </tr>
                  <?php $events_ctr = 1; ?>
                  <?php foreach($events as $event): ?>
                    <?php if($events_ctr <= 5): ?>
                      <tr>
                        <td><?php echo $event->title; ?></td>
                        <td><?php echo date('F j, Y',strtotime($event->start_date)); ?></td>
                        <td><?php echo $event->venue; ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php $events_ctr++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer text-center">
              <a href="<?php echo base_url().'admin/events'; ?>" class="uppercase">View All Events</a>
            </div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Blogs</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <th>Date</th>
                  </tr>
                  <?php $blogs_ctr = 1; ?>
                  <?php foreach($blogs as $blog): ?>
                    <?php if($blogs_ctr <= 5): ?>
                      <tr>
                        <td><?php echo $blog->title; ?></td>
                        <td><?php echo date('F j, Y',strtotime($blog->date_updated)); ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php $blogs_ctr++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer text-center">
              <a href="<?php echo base_url().'admin/blog'; ?>" class="uppercase">View All Blogs</a>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Products</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Product Code</th>
                    <th>Title</th>
                    <th>Price</th>
                  </tr>
                  <?php $products_ctr = 1; ?>
                  <?php foreach($products as $product): ?>
                    <?php if($products_ctr <= 5): ?>
                      <tr>
                        <td><?php echo $product->product_code; ?></td>
                        <td><?php echo $product->title; ?></td>
                        <td><?php echo $product->price; ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php $products_ctr++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer text-center">
              <a href="<?php echo base_url().'admin/products'; ?>" class="uppercase">View All Products</a>
              <?php echo $email_sent; ?> 
            </div>
          </div>
        </div>

      <?php endif; ?>

    </div>

  </section>
</div>
