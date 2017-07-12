<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-userss"></i>
        Team
        <small>Edit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Team</li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">

        <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-edit_product')); ?>
        <div class="col-md-12">                        
            <div class="box box-primary">              
              <div class="box-body pad">                  

                <div class="row">

                  <div class="col-md-12">
                    <?php if($this->session->flashdata('message')): ?>
                      <div class="alert alert-<?php echo ($this->session->flashdata('message') == 'Saved' ? 'info':'danger' ); ?> alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo ($this->session->flashdata('message') == 'Saved' ? '<i class="icon fa fa-check"></i>':'' ); ?>
                          <?php echo $this->session->flashdata('message'); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group ">
                      <label for="">First Name</label>
                      <?php echo form_input($first_name); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group ">
                      <label for="">Last Name</label>
                      <?php echo form_input($last_name); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group ">
                      <label for="">Position</label>
                      <?php echo form_input($position); ?>
                    </div>            
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="Excerpt">Excerpt</label>                          
                      <?php echo form_textarea($excerpt); ?>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="Content">Content</label>
                      <?php echo form_textarea($content); ?>
                    </div>  
                  </div>
                  <div class="col-md-12">             
                    <div class="form-group" id="media_uploader">
                        <label for="Featured Image">Featured Image</label><br />                            
                        <?php echo anchor('#', '<i class="fa fa-file-image-o"></i> ' . $btn_upload_label, array('class' => 'btn btn-primary btn-flat','id' => 'media_featured_img')); ?>                            
                        <p class="help-block">Size: 2MB • Dimension: 477 x 713</p>                            
                        <div id="preview-img">                                
                            <?php if( !empty($preview_featured_img['src']) ): ?>
                                <a class="btn btn-flat btn-danger preview-edit-remove-btn-img" data-toggle="modal" data-target=".bs-remove-modal-sm"><i class="fa fa-remove"></i> Remove</a>
                                <?php echo img($preview_featured_img); ?>
                            <?php endif; ?>
                        </div>                            
                        <?php echo form_input(array('name' => 'featured-img-path', 'id' => 'featured-img-path', 'type' => 'hidden', 'value' => $preview_featured_img['src']));?>
                    </div> 
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <?php echo form_hidden('team_id', $team->ID);?>
                      <button name="save" type="submit" id="btn-submit" class="btn btn-success btn-flat">Save</button>
                      <?php echo anchor('admin/team', lang('actions_cancel'), array('class' => 'btn btn-danger btn-flat')); ?>
                    </div>   
                  </div>

                </div>
              </div>

            </div>
          </div>
        <?php echo form_close();?>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->    
</div>