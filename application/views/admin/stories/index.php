<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-quote-left"></i>
        Stories
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Stories</li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-xs-12">          
          <div class="box">    
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/stories/create', '<i class="fa fa-plus"></i> Create Stories', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-axis" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Created By</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($stories as $s): ?>
                        <tr>
                            <td><?php echo $s->title; ?></td>
                            <td><?php echo $s->first_name; ?></td>
                            <td><?php echo $s->date_created; ?></td>
                            <td class="axis-actions">

                                <?php echo anchor('admin/stories/edit/'.$s->ID, '<span class="label label-success"><i title="Edit" class="fa fa-edit"></i> '. lang('actions_edit') .'</span>'); ?> 

                               <?php if(!empty($featured)){ ?>
                                  <?php if($s->ID == $featured->ID): ?>
                                    <?php echo anchor('admin/stories/remove_featured', '<span class="label label-warning"><i title="Unset" class="fa fa-flag-o"></i> Unset as Featured</span>'); ?>
                                  <?php endif; ?>
                               <?php }else{ ?>
                                  <?php echo anchor('admin/stories/add_featured/'.$s->ID, '<span class="label label-info"><i title="Set" class="fa fa-flag-o"></i> Set as Featured</span>'); ?>
                               <?php } ?>
                                
                                <?php echo anchor('admin/stories/action/trash/'.$s->ID, '<span class="label label-danger"><i title="Delete" class="fa fa-trash"></i> Trash</span>'); ?>

                            </td>                          
                        </tr>
                    <?php endforeach; ?>
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