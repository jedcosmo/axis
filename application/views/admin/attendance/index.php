<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i>
        Daily Attendance
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Attendance</li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <?php if( $this->session->flashdata('message') ): ?>
            <div class="col-xs-12">                        
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                        
                    <?php echo $this->session->flashdata('message'); ?>                        
                </div>                            
            </div>
        <?php endif; ?>
          
        <div class="col-xs-4">                        
            <div class="box">    
                <div class="box-header with-border">
                    <h3 class="box-title axis-margin-r-5"><?php echo $form_header_title; ?> Attendance</h3>                
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-body pad">                        
                        <?php echo form_open(current_url().$action_url, array('class' => '', 'id' => 'form-create_daily_attendance')); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <input type="hidden" name="attendance_status" value="<?php echo $attendance_status; ?>" />
                                                  <label for="attendance-date">Attendance Date</label>                                                  
                                                  <div class="input-group">
                                                      <?php echo form_input($attendance_date); ?>
                                                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                  </div>
                                              </div>                                            
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="attendance-notes">Attendance Notes (optional)</label>
                                                  <?php echo form_textarea($notes); ?>
                                              </div>                                            
                                          </div>
                                                                                      
                                          <div class="col-md-12">
                                            <div class="form-group">
                                                 <label for="Title">Search Client</label>
                                                 <div class="input-group">                                          
                                                    <input type="text" placeholder="Type here to search clients." class="form-control" id="clients_search" size="70" autocomplete="off"/>
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-search"></i>
                                                    </div>
                                                 </div>
                                                 <div class="search-clients-loader"><span>Searching clients...</span></div>
                                            </div>                                            
                                          </div>                                        
                                            
                                          <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Title">Attendees</label>                                            
                                                <div class="attendees-listing" id="attendees-listing">
                                                    <ul class="col-md-12">
                                                        <?php if( isset($attendance_attendees) && is_array($attendance_attendees) ){ ?>
                                                            <?php foreach($attendance_attendees as $aa){ ?>
                                                                <li class="attendee-<?php echo $aa->attendance_client_id; ?>"><input type="checkbox" checked="checked" value="<?php echo $aa->attendance_client_id; ?>" name="client_attendees[]" class="client_attendees"><span><?php echo $aa->client_name; ?></span> <div class="attendees-action"><a href="javascript:void(0);" data-attendee_id="<?php echo $aa->attendance_client_id; ?>" class="remove label label-danger">Remove</a></div></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>                                                                                                                                        
                                          </div>                                           
                                        </div>
                                    </div>
                                </div>                                   
                                
                                <div class="col-md-8">
                                    <div class="form-group">
                                      <input type="hidden" name="attendance_id" value="<?php echo $attendance_id; ?>" />
                                      <input type="hidden" name="form_action" value="<?php echo $form_action; ?>" />
                                      <button name="save" type="submit" id="btn-submit" class="btn btn-success btn-flat">Submit Attendance</button>
                                      <?php echo anchor('admin/attendance', lang('actions_cancel'), array('class' => 'btn btn-danger btn-flat')); ?>
                                    </div>
                                </div>                                
                                
                                <?php if( $form_action == 'update' && $attendance_status == 'draft' ){ ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo anchor('admin/attendance/completed/'.$attendance_id, 'Set as Completed', array('class' => 'btn btn-danger btn-flat', 'id' => 'set-attendance-completed')); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-8">          
          <div class="box">    
            <div class="box-header with-border">
                <h3 class="box-title axis-margin-r-5">Attendance</h3> 
                <a href="/admin/reports/attendance" class="export-attendance btn btn-success btn-flat">Export Attendance in CSV</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="table-axis-attendance" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date Attendance For</th>                    
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Completed By</th>
                    <th>Notes</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php if($attendance){ ?>
                        <?php foreach($attendance as $a){ ?>
                            <tr>                                                            
                                <td><a href="/admin/attendance/edit/<?php echo $a->attendance_id; ?>"><?php echo $a->attendance_date; ?></a></td>
                                <td><?php echo $a->status; ?></td>
                                <td><?php echo $a->user_name; ?></td>
                                <td><?php echo $a->completed_by_name; ?></td>
                                <td><?php echo $a->attendance_notes; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-flat">Select Action</button>
                                        <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          <span class="caret"></span>
                                          <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">                                                                                  
                                            <li><?php echo anchor('admin/attendance/export/'.$a->attendance_id.'/csv', '<i class="fa fa-arrow-circle-o-down"></i> Export Attendees in CSV', array('class' => '')); ?></li>
                                            <li><?php echo anchor('javascript:void(0);', '<i title="Delete" class="fa fa-trash"></i> Delete Attendance', 'class="remove-attendance" data-toggle="modal" data-target=".remove-attendance-modal" data-redirect="/admin/attendance/delete/'.$a->attendance_id.'"'); ?></li>                                        
                                        </ul>
                                    </div>                                    
                                </td>
                            </tr>                                
                        <?php } ?>
                    <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>