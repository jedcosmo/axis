<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gears"></i>
        General
        <small>Add New</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>General</li>
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
                  <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-update-general')); ?>

                    <?php if($this->session->flashdata('message')): ?>
                      <div class="alert alert-<?php echo ($this->session->flashdata('message') == 'Saved' ? 'info':'danger' ); ?> alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo ($this->session->flashdata('message') == 'Saved' ? '<i class="icon fa fa-check"></i>':'<i class="icon fa fa-warning"></i>' ); ?>
                          <?php echo $this->session->flashdata('message'); ?>
                      </div>
                    <?php endif; ?>

                    <div class="form-group">
                      <label>Header Notification</label>
                      <?php echo form_input($notification); ?>
                    </div>

                    <div class="form-group">
                      <label>Facebook</label>
                      <?php echo form_input($facebook); ?>
                    </div>

                    <div class="form-group">
                      <label>Twitter</label>
                      <?php echo form_input($twitter); ?>
                    </div>

                    <div class="form-group">
                      <label>Tumblr</label>
                      <?php echo form_input($tumblr); ?>
                    </div>

                    <div class="form-group">
                      <label>Footer Remarks</label>
                      <?php echo form_textarea($footer); ?>
                    </div>
                    
                    <div class="form-group">
                      <?php echo form_hidden('general_id', $general->id);?>
                      <button name="save" type="submit" id="btn-submit" class="btn btn-success btn-flat">Save</button>
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