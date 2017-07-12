<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i>
        Daily Activities
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Activities</li>
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
                <h3 class="box-title axis-margin-r-5"><?php echo anchor('admin/activities/create', '<i class="fa fa-plus"></i> Add Daily Activity', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                <h3 class="box-title"><?php echo anchor('admin/activities/lists', '<i class="fa fa-list-alt"></i> Activities', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <!-- date range filtering -->
              <div class="row activities-date-range">
                  <div class="col-xs-8">&nbsp;</div>
                  <div class="col-xs-4">
                    <div class="col-xs-6">
                        <label>Start - Date</label>
                        <div class="input-group">
                            <input type="text" value="" name="min_date" id="min_date" class="form-control"/>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 no_padding">                       
                        <label>End - Date</label> 
                        <div class="input-group">
                            <input type="text" value="" name="max_date" id="max_date" class="form-control"/>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                        </div>                        
                    </div>  
                  </div>                                      
              </div>
              <!-- /.date range filtering -->
              
              <table id="table-axis-activities" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Activity</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($activities as $a): ?>
                        <tr>
                            <td><?php echo date('F d, Y', strtotime($a->date))?></td>
                            <td><?php echo $a->time_start; ?> - <?php echo $a->time_end; ?></td>
                            <td><?php echo $a->title; ?></td>
                            <td><span class="label <?php echo ($a->status == 'draft') ? 'label-warning':'label-primary'; ?> "><i class="fa <?php echo ($a->status == 'draft') ? 'fa-unlock':'fa-lock'; ?>"></i> <?php echo ucfirst($a->status); ?></span></td>
                            <td class="axis-actions">

                              <?php if($user_role == 'admin' || ($user_role == 'Manager' && $a->status == 'draft') || ($user_role == 'Instructor' && $a->status == 'draft') ): ?>
                                <?php echo anchor('admin/activities/manage_attendance/'.$a->ID, '<span class="label label-info"><i title="View" class="fa fa-search"></i> View Attendees</span>'); ?>
                              <?php endif; ?>

                              <?php if($user_role == 'admin' || ($user_role == 'Manager' && $a->status == 'draft') || ($user_role == 'Instructor' && $a->status == 'draft') ): ?>
                                <?php echo anchor('admin/activities/edit/'.$a->ID, '<span class="label label-success"><i title="Edit" class="fa fa-edit"></i> Edit</span>'); ?>
                              <?php endif; ?>

                              <?php if($user_role == 'admin'): ?>
                                <?php echo anchor('admin/activities/delete/'.$a->ID, '<span class="label label-danger"><i title="Delete" class="fa fa-trash"></i> Trash</span>'); ?>
                              <?php endif; ?>

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