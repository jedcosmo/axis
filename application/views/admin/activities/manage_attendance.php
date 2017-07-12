<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i>
        Daily Acativities
        <small>Manage Attendance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Activities</li>
        <li class="active">Manage Attendance</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
          
        <div class="col-md-12">            
          <div class="box box-primary"> 
                <div class="box-header with-border">                     
                    <div class="col-md-5">
                        <h3 class="box-title"><b>Activity</b> - <?php echo $activity_label; ?></h3><br />                        
                        <b>Date:</b> <?php echo $activity_details->date; ?><br />
                        <b>Time:</b> <?php echo $activity_details->time_start; ?> - <?php echo $activity_details->time_end; ?>
                    </div>
                    <div class="col-md-5">
                        <b>Status:</b> <?php echo $activity_details->status; ?><br />
                        <b>Created By:</b> <?php echo $activity_details->first_name; ?> - <?php echo $activity_details->last_name; ?><br />
                        <b>Notes:</b> <?php echo $activity_details->notes; ?>
                    </div>                    
                </div>
          </div>
        </div>
          
        <div class="col-md-6">
          <div class="box box-info">    
            <div class="box-header with-border">
                <h3 class="box-title">Clients Master List</h3>
                <h3 class="box-title pull-right">
                  <a href="javascript:void(0)" class="btn btn-block btn-primary btn-flat" onClick="addNewClient()"><i class="fa fa-plus"></i> Add New Client</a>
                </h3>

                <div class="clearfix"></div>

                <div class="new_client_form" style="display:none;">
                  <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-create_new_client')); ?>

                    <div class="row">
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
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Gender</label>
                          <select name="gender" class="form-control">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Birthdate</label>
                          <?php echo form_input($birthdate); ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Social Security Number</label>
                          <?php echo form_input($ssn); ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Email</label>
                          <?php echo form_input($email); ?>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label>Home Address</label>
                          <?php echo form_input($address); ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>City</label>
                          <?php echo form_input($city); ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>State</label>
                          <?php echo form_input($state); ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Zip</label>
                          <?php echo form_input($zip); ?>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <button name="save" type="submit" id="btn-submit" class="btn btn-success pull-right btn-flat">Save</button>
                        </div>
                      </div>
                    </div>

                  <?php echo form_close(); ?>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-axis" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($clients as $c): ?>
                      <tr>
                          <td><?php echo $c->ID; ?></td>
                          <td><?php echo $c->first_name; ?> <?php echo $c->last_name; ?></td>
                          <td class="axis-actions">

                            <?php
                              if(in_array($c->ID, $attendee_array)){
                                $onclick = "";
                              }else{
                                $onclick = "addClientAttendance('".base_url()."','".$activity_id."','".$c->ID."')";
                              }
                            ?>

                            <a href="javascript:void(0)" id="add_<?php echo $c->ID; ?>" onclick="<?php echo $onclick; ?>" ><span class="label <?php echo (in_array($c->ID, $attendee_array) == TRUE ? 'label-info':'label-success'); ?>"><i title="Edit" class="fa <?php echo (in_array($c->ID, $attendee_array) == TRUE ? 'fa-check':'fa-plus'); ?>"></i> <?php echo (in_array($c->ID, $attendee_array) == TRUE ? 'Added':'Add'); ?></span></a>
                          </td>                          
                      </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">            
          <div class="box box-primary">             
            <div class="box-header with-border">
                <h3 class="box-title">Attendees</h3>
                <h3 class="box-title pull-right">
                  <a href="<?php echo base_url(uri_string()); ?>" class="btn btn-block btn-success btn-flat"><i class="fa fa-refresh"></i> Refresh List</a>
                </h3>
            </div>
            <div class="box-body pad">
                <div id="add_attendees"></div>
                <div id="display_attendees">

                  <div class="box-body">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Remove</th>
                        </tr>
                        <?php foreach($attendees as $a): ?>
                          <tr>
                            <td><?php echo $a->client_id ?></td>
                            <td><?php echo $a->first_name; ?> <?php echo $a->last_name; ?></td>
                            <td><a href="javascript:void(0);" onclick="removeFromActivity('<?php echo base_url(); ?>','<?php echo $a->activity_id; ?>','<?php echo $a->client_id ?>')" ><span class="label label-danger"><i title="Remove" class="fa fa-times"></i> Remove</span></a></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>

                </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->    
</div>