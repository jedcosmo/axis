<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cubes"></i>
        Product
        <small>Edit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Product</li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">

        <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-edit_product')); ?>

        <div class="col-md-12">
          <?php if($this->session->flashdata('message')): ?>
            <div class="alert alert-<?php echo ($this->session->flashdata('message') == 'Saved' ? 'info':'danger' ); ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo ($this->session->flashdata('message') == 'Saved' ? '<i class="icon fa fa-check"></i>':'' ); ?>
                <?php echo $this->session->flashdata('message'); ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-md-8">                        
            <div class="box box-primary">              
              <div class="box-body pad">                  
                  <div class="tab-pane active " id="tab_NO">
                    <div class="form-group required ">
                      <label for="Product Name">Product Name</label>
                      <?php echo form_input($content_title); ?>
                    </div>
                    <div class="form-group">
                      <label for="Excerpt">Excerpt</label>
                      <?php echo form_textarea($excerpt); ?>
                    </div>
                    <div class="form-group">
                      <label for="Product Description">Product Description</label>
                      <?php echo form_textarea($content); ?>
                    </div>                          
                    <div class="form-group" id="media_uploader">
                        <label for="Featured Image">Featured Image</label><br />                            
                        <?php echo anchor('#', '<i class="fa fa-file-image-o"></i> ' . $btn_upload_label, array('class' => 'btn btn-primary btn-flat','id' => 'media_featured_img')); ?>                            
                        <p class="help-block">Size: 2MB • Dimension: 300 x 300</p>                            
                        <div id="preview-img">                                
                            <?php if( !empty($preview_featured_img['src']) ): ?>
                                <a class="btn btn-flat btn-danger preview-edit-remove-btn-img" data-toggle="modal" data-target=".bs-remove-modal-sm"><i class="fa fa-remove"></i> Remove</a>
                                <?php echo img($preview_featured_img); ?>
                            <?php endif; ?>
                        </div>                            
                        <?php echo form_input(array('name' => 'featured-img-path', 'id' => 'featured-img-path', 'type' => 'hidden', 'value' => $preview_featured_img['src']));?>
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
                  </div>
                  <div class="form-group">
                    <?php echo form_hidden('product_id', $product->ID);?>
                    <button id="btn-submit" name="save" type="submit" class="btn btn-success btn-flat">Save</button>
                    <?php echo anchor('admin/products', lang('actions_cancel'), array('class' => 'btn btn-danger btn-flat')); ?>
                  </div>                  
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">              
              <div class="box-body pad">
                <!--
                <div class="form-group">
                    <label>Product Code</label>
                    <?php //echo form_input($product_code); ?>
                </div>
                -->

                <div class="form-group">
                    <label>Price</label>
                    <?php echo form_input($price); ?>
                </div>
                  
                <div class="form-group">
                    <label>Quantity</label>
                    <?php echo form_input($quantity); ?>
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