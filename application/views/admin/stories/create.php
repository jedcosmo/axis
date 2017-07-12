<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-quote-left"></i>
        Stories
        <small>Add New</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Stories</li>
        <li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
            
            <div class="box box-primary">              
              <div class="box-body pad">
                  <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-create_story')); ?>

                  <?php if($this->session->flashdata('message')): ?>
                    <div class="alert alert-<?php echo ($this->session->flashdata('message') == 'Saved' ? 'info':'danger' ); ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo ($this->session->flashdata('message') == 'Saved' ? '<i class="icon fa fa-check"></i>':'' ); ?>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                  <?php endif; ?>

                  <div class="form-group required ">
                    <label for="Title">Title</label>
                    <?php echo form_input($content_title); ?>
                  </div>
                  <div class="form-group">
                    <label for="Excerpt">Excerpt</label>                          
                    <?php echo form_textarea($excerpt); ?>
                  </div>
                  <div class="form-group">
                    <label for="Content">Content</label>
                    <?php echo form_textarea($content); ?>
                  </div>   
                  <div class="form-group">
                    <label for="Video">Video Url</label>
                    <?php echo form_input($video); ?>
                  </div>     
                  <div class="form-group" id="media_uploader">
                    <label for="Featured Image">Featured Image</label><br />                            
                    <?php echo anchor('#', '<i class="fa fa-file-image-o"></i> Upload Image', array('class' => 'btn btn-primary btn-flat','id' => 'media_featured_img')); ?>                            
                    <p class="help-block">Size: 2MB • Dimension: 300 x 300</p>                            
                    <div id="preview-img"></div>                            
                    <?php echo form_input(array('name' => 'featured-img-path', 'id' => 'featured-img-path', 'type' => 'hidden', 'value' => ''));?>
                  </div>                   
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Meta Title">Meta Title</label>
                        <?php echo form_textarea($meta_title); ?>
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Meta keyword">Meta keyword</label>
                        <?php echo form_textarea($meta_keyword); ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Meta Description">Meta Description</label>
                        <?php echo form_textarea($meta_description); ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button name="save" type="submit" id="btn-submit" class="btn btn-success btn-flat">Save</button>
                    <?php echo anchor('admin/stories', lang('actions_cancel'), array('class' => 'btn btn-danger btn-flat')); ?>
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