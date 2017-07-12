<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil-square-o"></i>
        Client Form
        <small><?php echo $page_action_label; ?> - Authorization Request</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Client Form</li>
        <li class="active"><?php echo $page_action_label; ?> - Authorization Request</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <?php if( $this->session->flashdata('client_authorization_message') || $message ): ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                                 
            <?php 
                  if( $this->session->flashdata('client_authorization_message') ){
                      echo $this->session->flashdata('client_authorization_message');
                  }else{
                      echo $message;
                  }      
            ?>
        </div>
      <?php endif; ?>
      <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-create_client_authorization')); ?>
        <div class="row">
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Client Information</h3>
                </div>
                <div class="box-body">                                       
                  <div class="form-group  ">
                    <label>Member ID/No.</label>
                    <?php echo form_input($member_id); ?>
                    <?php echo form_hidden('client_id',$client_id); ?>
                  </div>   
                  <div class="form-group  ">
                    <label>First Name</label>
                    <?php echo form_input($first_name); ?>
                  </div>
                  <div class="form-group  ">
                    <label>Last Name</label>
                    <?php echo form_input($last_name); ?>
                  </div>  
                </div>
              </div>
            </div>          
            
            <div class="col-md-8">              
              <div class="box box-success">               
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Goals</label>
                                <?php foreach($goals_checkboxes as $gchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($goals_checkbox_attr[$gchk['value']]); ?>
                                          <?php echo $gchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>  
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Program Interventions</label>
                                <?php foreach($program_interventions_checkboxes as $pichk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($program_interventions_checkbox_attr[$pichk['value']]); ?>
                                          <?php echo $pichk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>                  
                </div>                
              </div>
            </div>
        </div>      
        <!-- /.row -->
        <div class="box-footer">
          <button name="save" type="submit" class="btn btn-success btn-flat">Save</button>
          <a class="btn btn-danger btn-flat" href="/admin/clients">Cancel</a>
        </div>
      <?php echo form_close();?>
    </section>
    <!-- /.content -->    
</div>