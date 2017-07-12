<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil-square-o"></i>
        Client Form
        <small><?php echo $page_action_label; ?> - Demographics</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Client Form</li>
        <li class="active"><?php echo $page_action_label; ?> - Demographics</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row --> 
      <?php if( $this->session->flashdata('client_demographics_message') || $message ): ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                                 
            <?php 
              if( $this->session->flashdata('client_demographics_message') ){
                  echo $this->session->flashdata('client_demographics_message');
              }else{
                  echo $message;
              }
            ?>
        </div>
      <?php endif; ?>
      <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-create_client_demographics')); ?>
        <div class="row">
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Client Information</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <?php //if($page_action != 'edit'): ?>
                        <div class="col-md-6">
                          <div class="form-group  ">
                            <label>Is Member?</label>
                            <div class="radio">
                               <?php echo form_checkbox($is_member); ?>  
                               <span class="form-info">"members" will be registered with an insurance, "non-members" will not have the insurance.</span>
                            </div>                        
                          </div>
                        </div>
                    <?php //endif; ?>
                      
                    <div class="col-md-6">
                      <div class="form-group  ">                        
                        <label>Member ID/No.</label>
                        <?php echo form_input($member_id); ?>
                      </div>
                    </div>                                   
                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label>First Name</label>
                        <?php echo form_input($first_name); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label>Last Name</label>
                        <?php echo form_input($last_name); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label for="">Email</label>
                        <?php echo form_input($email); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label for="">Social Security Number</label>
                        <?php echo form_input($ssn); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label for="">Date of Birth</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <?php echo form_input($dob); ?>
                        </div>
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label for="">Gender</label>
                        <div class="radio">
                          <label>
                            <?php echo form_radio($gender_male); ?>
                            Male
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <?php echo form_radio($gender_female); ?>
                            Female
                          </label>
                        </div>
                      </div>
                    </div>  
<!--                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label>Image</label>
                        <input type="file" value="" name="image" id="exampleInputFile">
                        <p class="help-block">Size: 2MB • Dimension: 300 x 300</p>
                      </div>
                    </div>                                                        -->
                  </div>
                </div>
                
                <div class="box-body">                  
                    <div class="form-group ">
                      <label>Home Address</label>
                      <?php echo form_input($home_address); ?>
                    </div>
                    <div class="form-group ">
                      <label>City</label>
                      <?php echo form_input($city); ?>
                    </div>
                    <div class="form-group ">
                      <label>State</label>
                      <?php echo form_input($state); ?>
                    </div>
                    <div class="form-group ">
                      <label>ZIP</label>
                      <?php echo form_input($zip); ?>
                    </div>
                    <div class="form-group ">
                      <label>Phone</label>
                      <?php echo form_input($phone); ?>
                    </div>
                    <div class="form-group ">
                      <label>Alternative Phone</label>
                      <?php echo form_input($alternative_phone); ?>
                    </div>
                </div>
              </div>
            </div>          
            
            <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Medicare Information</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Medicare Eligibility</label>
                                <div class="radio">                        
                                    <label>
                                        <?php echo form_radio($medicare_eligibility_yes); ?>                                        
                                        Yes
                                    </label>                                    
                                    <div class="form-group <?php echo ($medicare_eligibility_val && $medicare_eligibility_val != '0') ? '' : 'hidden'; ?>" id="medicare_eligibility_status">                                          
                                        <div class="radio-inline">                        
                                            <label>
                                                <?php echo form_radio($medicare_eligibility_active); ?>                                                
                                                Active
                                            </label> 
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <?php echo form_radio($medicare_eligibility_notactive); ?>                                                
                                                Not Active
                                            </label>
                                        </div>                                                                                
                                    </div>
                                </div> 
                                <div class="radio">
                                    <label>
                                      <?php echo form_radio($medicare_eligibility_no); ?>                                     
                                      No
                                    </label>
                                </div>
                                <div class="form-group <?php echo ($medicare_eligibility_val && $medicare_eligibility_val != '0') ? '' : 'hidden'; ?>" id="medicare_number">                                           
                                   <label>Medicare Number</label>  
                                   <?php echo form_input($medicare_number); ?>
                                </div>                                
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Medicaid Eligibility</label>
                                <div class="radio">                        
                                    <label>
                                        <?php echo form_radio($medicaid_eligibility_yes); ?>                                        
                                        Yes
                                    </label>                                  
                                </div> 
                                <div class="radio">
                                    <label>
                                      <?php echo form_radio($medicaid_eligibility_no); ?>                                      
                                      No
                                    </label>
                                </div>                                
                            </div>
                            <div class="form-group <?php echo ($medicaid_eligibility_val && $medicaid_eligibility_val != '0') ? '' : 'hidden'; ?>" id="medicaid_no_field">
                                <label>Medicaid Number</label>
                                <?php echo form_input($medicaid_number); ?>                                
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
                
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Status Information</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Community Status</label>                               
                                <?php foreach($community_status_radios as $csr_key => $csr_lbl): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($community_status_radio_attr[$csr_key]); ?>
                                          <?php echo $csr_lbl; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Marital Status</label>
                                <?php foreach($marital_status_radios as $ms_key => $ms_lbl): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($marital_status_radio_attr[$ms_key]); ?>
                                          <?php echo $ms_lbl; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>                                
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Highest Completed Education</label>
                                <?php foreach($compeleted_education_radios as $ce_key => $ce_lbl): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($compeleted_education_radio_attr[$ce_key]); ?>
                                          <?php echo $ce_lbl; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>                                
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Current Employment Status</label>
                                <?php foreach($employment_status_radios as $es_key => $es_lbl): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($employment_status_radio_attr[$es_key]); ?>
                                          <?php echo $es_lbl; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>                                                                
                            </div> 
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Internet Access</label>
                                <?php foreach($internet_access_radios as $ia_key => $ia_lbl): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($internet_access_radio_attr[$ia_key]); ?>
                                          <?php echo $ia_lbl; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>                                
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="">Type of Income</label>
                                <?php foreach($type_of_income_radios as $toi_key => $toi_lbl): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($type_of_income_radio_attr[$toi_key]); ?>
                                          <?php echo $toi_lbl; ?>
                                        </label>
                                        
                                        <?php if($toi_key == 'other'): ?>
                                            <?php echo form_input($type_of_icome_other_income); ?>
                                        <?php endif; ?>
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
          <?php if($page_action === 'edit'): ?>
            <?php echo form_hidden('client_id', $client_id); ?>
          <?php endif; ?>
          <button name="save" type="submit" class="btn btn-success btn-flat">Save</button>
          <a class="btn btn-danger btn-flat" href="/admin/clients">Cancel</a>
        </div>
      <?php echo form_close();?>
    </section>
    <!-- /.content -->    
</div>