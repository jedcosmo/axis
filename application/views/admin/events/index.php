<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calendar"></i>
        Events
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Events</li>
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
                <h3 class="box-title"><?php echo anchor('admin/events/create', '<i class="fa fa-plus"></i> Create Event', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-axis" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Event Name</th>
                  <th>Created By</th>
                  <th>Status</th>                  
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($events as $e): ?>
                        <tr>
                            <td><?php echo $e->title; ?></td>
                            <td><?php echo $e->first_name; ?></td>
                            <td><?php echo $e->status; ?></td>
                            <td><?php echo $e->date_created; ?></td>                          
                            <td class="axis-actions">
                                <?php echo anchor('admin/events/manage_attendance/'.$e->ID, '<span class="label label-info"><i title="View" class="fa fa-eye"></i> View Attendees</span>'); ?>
                                <?php echo anchor('admin/events/edit/'.$e->ID, '<span class="label label-success"><i title="Edit" class="fa fa-edit"></i> '. lang('actions_edit') .'</span>'); ?>                                                                        
                                <?php echo anchor('admin/events/action/trash/'.$e->ID, '<span class="label label-danger"><i title="Delete" class="fa fa-trash"></i> Trash</span>'); ?>
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