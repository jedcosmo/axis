<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i>
        Activities
        <small>Lists</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Activities</li>
        <li class="active">Lists</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row"> 
        <div class="col-xs-12">
            <?php if($this->session->flashdata('success') || $this->session->flashdata('error')): ?>            
                    <div class="alert alert-<?php echo ($this->session->flashdata('success') ? 'info':'danger' ); ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo ($this->session->flashdata('success') ? '<i class="icon fa fa-check"></i>':'' ); ?>
                        <?php echo $this->session->flashdata('success'); ?>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>                
            <?php endif; ?>

            <?php if($action == 'update'){ ?>
                    <div class="callout callout-info lead">
                        <h4>Edit Activity</h4>
                        <span>You are currently editing an activity item, to exit edit mode you can just cancel this action.</span>
                    </div>
            <?php } ?>
            
            <?php if($action == 'delete'){ ?>
                    <div class="callout callout-info lead">                        
                        <span>Are you sure on deleting this activity item?</span> 
                    </div>
            <?php } ?>
        </div>
                  
        <div class="col-xs-4">
            <div class="box">                
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $activity_box_header; ?> Activity</h3>
                </div>
                <div class="box-body">
                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_activity')); ?>
                        <?php if($action != 'delete'){ ?>
                            <div class="form-group">                            
                                <div class="col-sm-12">
                                    <input name="title" value="<?php echo $activity_label; ?>" id="title" class="form-control" placeholder="Activity Label" type="text">
                                </div>
                                <input type="hidden" name="action" value="<?php echo $action; ?>" />
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <div class="btn-group">
                                    <?php if($action != 'delete'){ ?>
                                        <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?> 
                                    <?php } ?>
                                    
                                    <?php if($action == 'delete'){ ?>
                                        <?php echo anchor('admin/activities/lists/delete/'.$activity_to_delete.'/yes', 'Yes, delete the item', array('class' => 'btn btn-primary btn-flat')); ?>
                                    <?php } ?>
                                    
                                    <?php if($action == 'update' || $action == 'delete'){ ?>
                                        <?php echo anchor('admin/activities/lists', lang('actions_cancel'), array('class' => 'btn btn-danger btn-flat')); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
        <div class="col-xs-8">          
          <div class="box">                            
            <div class="box-body">
              <table id="table-axis" class="table table-bordered table-striped">
                <thead>
                  <tr>                    
                    <th>Activity</th>                    
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $l){ ?>
                        <tr>                            
                            <td><?php echo $l->title; ?></td>
                            <td>
                                <?php if($user_role == 'admin' || ($user_role == 'Manager' && $l->status == 'draft') || ($user_role == 'Instructor' && $l->status == 'draft') ): ?>
                                    <?php echo anchor('admin/activities/lists/edit/'.$l->ID, '<span class="label label-success"><i title="Edit" class="fa fa-edit"></i> Edit</span>'); ?>
                                <?php endif; ?>
                                
                                <?php if($user_role == 'admin'): ?>
                                    <?php echo anchor('admin/activities/lists/delete/'.$l->ID, '<span class="label label-danger"><i title="Delete" class="fa fa-trash"></i> Trash</span>'); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
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