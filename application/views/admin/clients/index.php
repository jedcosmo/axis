<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil-square-o"></i>
        Clients
        <small>Overview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Clients</li>
        <li class="active">Overview</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-xs-12">          
          <div class="box">    
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <h3 class="box-title"><?php echo anchor('admin/demographics/create', '<i class="fa fa-plus"></i> New Client Demographics', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>   
                </div>                
                <div class="col-xs-6 text-align-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-flat">Export All Client Forms in CSV</button>
                        <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">                                      
                            <li>                             
                                <?php echo anchor('admin/clients/export/all/post-initial-assessment/csv', '<i class="fa fa-arrow-circle-o-down"></i> Post Initial Assessment', array('class' => '')); ?>                                                                        
                            </li>
                            <li>                            
                                <?php echo anchor('admin/clients/export/all/assessment/csv', '<i class="fa fa-arrow-circle-o-down"></i> Assessment', array('class' => '')); ?>                                                                        
                            </li>
                            <li>                            
                                <?php echo anchor('admin/clients/export/all/authorization-request/csv', '<i class="fa fa-arrow-circle-o-down"></i> Authorization Request', array('class' => '')); ?>                                                                        
                            </li>
                            <li><?php echo anchor('admin/clients/export/all/demographics/csv', '<i class="fa fa-arrow-circle-o-down"></i> Demographics', array('class' => '')); ?></li>                                        
                        </ul>
                    </div>
                </div>                                
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <!-- date range filtering -->
              <div class="row clients-date-range">
                  <div class="col-xs-8">&nbsp;</div>
                  <div class="col-xs-4">
                    <div class="col-xs-6">
                        <label>Start - Date Created</label>
                        <div class="input-group">
                            <input type="text" value="" name="min_date" id="min_date" class="form-control"/>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 no_padding">                       
                        <label>End - Date Created</label> 
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
                
              <table id="table-axis-clients" class="table table-bordered table-striped clients">
                <thead>
                <tr>
                  <th>Member ID/No.</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Type</th>
                  <th>SSN</th>                  
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($clients as $c): ?>
                        <tr>
                            <td><?php echo $c->member_id; ?></td>
                            <td><?php echo $c->first_name; ?></td>
                            <td><?php echo $c->last_name; ?></td>
                            <td><?php echo ($c->is_member == 'M') ? 'Member' : 'Non-member'; ?></td>
                            <td><?php echo $c->ssn; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($c->date_created)); ?></td>                          
                            <td class="axis-actions">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger btn-flat ">Actions</button>
                                    <button type="button" class="btn btn-danger btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">                                      
                                        <li> 
                                            <?php if(!is_null($c->cia_count > 0) && $c->cia_count > 0): ?>
                                                <?php echo anchor('admin/initialAssessment/edit/'.$c->member_id, '<i class="fa fa-pencil"></i> Edit Post Initial Assessment', array('class' => '')); ?>
                                            <?php else: ?>
                                                <?php echo anchor('admin/initialAssessment/create/'.$c->member_id, '<i class="fa fa-plus"></i> Add Post Initial Assessment', array('class' => '')); ?>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <?php if(!is_null($c->cas_count > 0) && $c->cas_count > 0): ?>
                                                <?php echo anchor('admin/assessment/edit/'.$c->member_id, '<i class="fa fa-pencil"></i> Edit Assessment', array('class' => '')); ?>
                                            <?php else: ?>
                                                <?php echo anchor('admin/assessment/create/'.$c->member_id, '<i class="fa fa-plus"></i> Add Assessment', array('class' => '')); ?>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <?php if(!is_null($c->car_count > 0) && $c->car_count > 0): ?>
                                                <?php echo anchor('admin/authorizationRequest/edit/'.$c->member_id, '<i class="fa fa-pencil"></i> Edit Authorization Request', array('class' => '')); ?>
                                            <?php else: ?>
                                                <?php echo anchor('admin/authorizationRequest/create/'.$c->member_id, '<i class="fa fa-plus"></i> Add Authorization Request', array('class' => '')); ?>
                                            <?php endif; ?>
                                        </li>
                                        <li><?php echo anchor('admin/demographics/edit/'.$c->ID, '<i class="fa fa-pencil"></i> Edit Demographics', array('class' => '')); ?></li>                                        
                                    </ul>
                                </div>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-flat ">Export in PDF</button>
                                    <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">                                      
                                        <li> 
                                            <?php if(!is_null($c->cia_count > 0) && $c->cia_count > 0): ?>
                                                <?php echo anchor('admin/clients/export/'.$c->ID.'/post-initial-assessment', '<i class="fa fa-arrow-circle-o-down"></i> Export Post Initial Assessment', array('class' => '', 'target' => '_blank')); ?>                                            
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <?php if(!is_null($c->cas_count > 0) && $c->cas_count > 0): ?>
                                                <?php echo anchor('admin/clients/export/'.$c->ID.'/assessment', '<i class="fa fa-arrow-circle-o-down"></i> Export Assessment', array('class' => '', 'target' => '_blank')); ?>                                            
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <?php if(!is_null($c->car_count > 0) && $c->car_count > 0): ?>
                                                <?php echo anchor('admin/clients/export/'.$c->ID.'/authorization-request', '<i class="fa fa-arrow-circle-o-down"></i> Export Authorization Request', array('class' => '', 'target' => '_blank')); ?>                                            
                                            <?php endif; ?>
                                        </li>
                                        <li><?php echo anchor('admin/clients/export/'.$c->ID.'/demographics', '<i class="fa fa-arrow-circle-o-down"></i> Export Demographics', array('class' => '', 'target' => '_blank')); ?></li>                                        
                                    </ul>
                                </div>                                
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