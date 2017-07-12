<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i>
        Team
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Team</li>
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
                <h3 class="box-title"><?php echo anchor('admin/team/create', '<i class="fa fa-plus"></i> Add Member', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-axis" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Status</th>                  
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($team as $t): ?>
                        <tr>
                            <td><?php echo $t->first_name; ?> <?php echo $t->last_name; ?></td>
                            <td><?php echo $t->position; ?></td>
                            <td><?php echo $t->status; ?></td>
                            <td><?php echo $t->date_created; ?></td>                          
                            <td class="axis-actions">
                                <?php echo anchor('admin/team/edit/'.$t->ID, '<span class="label label-success"><i title="Edit" class="fa fa-edit"></i> '. lang('actions_edit') .'</span>'); ?>                                                                        
                                <?php echo anchor('admin/team/action/trash/'.$t->ID, '<span class="label label-danger"><i title="Delete" class="fa fa-trash"></i> Trash</span>'); ?>
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