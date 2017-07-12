<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tty"></i>
        Contacts
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Contacts</li>
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
                <h3 class="box-title">All Messages</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-axis" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>From</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($contacts as $contact): ?>
                        <tr>
                            <td><?php echo $contact->first_name; ?> <?php echo $contact->last_name; ?></td>
                            <td><?php echo date('F j, Y [ H:i ]', strtotime($contact->date)); ?></td>
                            <td class="axis-actions">
                                <?php echo anchor('admin/contact/get_detail/'.$contact->ID, '<span class="label label-warning"><i title="Delete" class="fa fa-eye"></i> View</span>'); ?>
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