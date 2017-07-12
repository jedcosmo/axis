<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i>
        Daily Acativities
        <small>Add New</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Activities</li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
            <?php echo $message;?>
            
            <div class="box box-primary">              
              <div class="box-body pad">

                  <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-edit_page')); ?>
                    <div class="row">
                      
                      <div class="col-md-12">

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                  <label for="Title">Date</label>
                                  <div class="input-group date">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php echo form_input($date); ?>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="bootstrap-timepicker">
                                    <label for="Title">Time Start</label>
                                    <div class="input-group">
                                      <?php echo form_input($time_start); ?>
                                      <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="bootstrap-timepicker">
                                    <label for="Title">Time End</label>
                                    <div class="input-group">
                                      <?php echo form_input($time_end); ?>
                                      <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">

                          <div class="col-md-8">
                            <div class="form-group">
                              <label for="Title">Activity</label>
                              <select class="form-control" name="activity">
                                <?php foreach($activities as $a): ?>
                                  <option value="<?php echo $a->ID; ?>" <?php echo ($a->ID == $activity->activity ? "selected='selected'":""); ?> ><?php echo $a->title; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>

                          <?php if($user_role == 'admin' || $user_role == 'Manager' ): ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Title">Status</label>
                                <select class="form-control" name="status">
                                  <option value="draft" <?php echo ($activity->status == 'draft') ? 'selected="selected"':'' ?> >Draft</option>
                                  <option value="completed" <?php echo ($activity->status == 'completed') ? 'selected="selected"':'' ?> >Completed</option>
                                </select>
                              </div>                      
                            </div>
                          <?php endif; ?>
                            
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="Title">Notes</label>
                                <?php echo form_textarea($notes); ?>
                              </div>
                            </div>  
                          
                          <?php if($user_role == 'Instructor'): ?>
                            <input type="hidden" name="status" value="draft">
                          <?php endif; ?>
                        </div>

                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <?php echo form_hidden('activity_id', $activity->ID);?>
                          <button id="btn-submit" name="save" type="submit" class="btn btn-success btn-flat">Save</button>
                          <?php echo anchor('admin/activities', lang('actions_cancel'), array('class' => 'btn btn-danger btn-flat')); ?>
                        </div>
                      </div>

                    </div>
                  <?php echo form_close();?>
              </div>
            </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->    
</div>