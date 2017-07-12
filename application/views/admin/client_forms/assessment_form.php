<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil-square-o"></i>
        Client Form
        <small><?php echo $page_action_label; ?> - Assessment</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Client Form</li>
        <li class="active"><?php echo $page_action_label; ?> - Assessment</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <?php if( $this->session->flashdata('client_assessment_message') || $message ): ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                                 
            <?php 
                  if( $this->session->flashdata('client_assessment_message') ){
                      echo $this->session->flashdata('client_assessment_message');
                  }else{
                      echo $message;
                  }      
            ?>
        </div>
      <?php endif; ?>
      <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-create_client_assessment')); ?>
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
                <div class="box-body">
                  <div class="row">                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Physician Name</label>
                        <?php echo form_input($physician_name); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Office Number</label>
                        <?php echo form_input($office_number); ?>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label for="">Physician's order</label>                         
                        <?php foreach($physician_order_radios as $pordo): ?>
                            <div class="radio">                        
                                <label>                                  
                                  <?php echo form_radio($physician_order_radio_attr[$pordo['value']]); ?>
                                  <?php echo $pordo['label']; ?>
                                </label>                    
                            </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group  ">
                        <label for="">Reason for assessment</label>
                        <?php foreach($assessment_reason_radios as $arrdo): ?>
                            <div class="radio">                        
                                <label>
                                  <?php echo form_radio($assessment_reason_radio_attr[$arrdo['value']]); ?>
                                  <?php echo $arrdo['label']; ?>
                                </label>                    
                            </div>
                        <?php endforeach; ?>
                      </div>
                    </div>                                                                                                                                         
                  </div>
                </div>
              </div>
            </div>          
            
            <div class="col-md-8">              
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Current Status</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Primary Diagnosis</label>
                                <?php foreach($primary_diagnosis_radios as $pdrdo): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($primary_diagnosis_radio_attr[$pdrdo['value']]); ?>
                                          <?php echo $pdrdo['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Secondary diagnosis:</label>
                                <?php foreach($secondary_diagnosis_checkboxes as $sdchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($secondary_diagnosis_checkbox_attr[$sdchk['value']]); ?>
                                          <?php echo $sdchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>  
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Physical limitations:</label>
                                <?php foreach($physical_limitations_checkboxes as $plchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($physical_limitations_checkbox_attr[$plchk['value']]); ?>
                                          <?php echo $plchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                    </div>                  
                </div>
                  
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Mood and Behavior:</label>
                                <?php foreach($mood_and_behavior_checkboxes as $mabchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($mood_and_behavior_checkbox_attr[$mabchk['value']]); ?>
                                          <?php echo $mabchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Functional Limitations:</label>
                                <?php foreach($functional_limitations_checkboxes as $flchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($functional_limitations_checkbox_attr[$flchk['value']]); ?>
                                          <?php echo $flchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                                
                                <label for="">Notes</label>
                                <?php echo form_textarea($functional_limitations_notes); ?>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Cognitive Skills Assessment:</label>
                                <?php foreach($cognitive_skills_checkboxes as $cschk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($cognitive_skills_checkbox_attr[$cschk['value']]); ?>
                                          <?php echo $cschk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                    </div>                  
                </div>
                  
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group ">
                                <label for="">ADL Limitations:</label>
                                <?php                                     
                                    foreach($adl_limitations_radios as $lbl => $adlradios ):
                                        $keyRadios = strtolower(str_replace(array(' ','/'),array('_'),$lbl));
                                        $keyLbl = 'adl_limitations_'.$keyRadios;
                                ?>
                                    <div class="radio">                                                     
                                      <?php echo $lbl; ?>:
                                      <?php                                         
                                            foreach($adlradios as $adlrdo):                                                
                                      ?>
                                                <div class="radio-inline"> 
                                                    <label>
                                                        <?php echo form_radio($adl_limitations_radio_attr[$keyRadios][$adlrdo['value']]); ?>
                                                        <?php echo $adlrdo['label']; ?>
                                                    </label>
                                                </div>
                                      <?php endforeach; ?>                                  
                                    </div> 
                                <?php endforeach; ?>                               
                            </div> 
                        </div>                        
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Vision:</label>
                                <?php foreach($vision_radios as $vrdo): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($vision_radio_attr[$vrdo['value']]); ?>
                                          <?php echo $vrdo['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group ">
                                <label for="">Hearing:</label>
                                <?php foreach($hearing_radios as $hrdo): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($hearing_radio_attr[$hrdo['value']]); ?>
                                          <?php echo $hrdo['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>                        
                    </div>                  
                </div>
                  
                <div class="box-body">
                    <div class="row">                                              
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Psycho-Social Well-Being:</label>
                                <?php foreach($psycho_social_well_being_checkboxes as $pswbchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($psycho_social_well_being_checkbox_attr[$pswbchk['value']]); ?>
                                          <?php echo $pswbchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Nutritional Issues:</label>                                
                                <?php foreach($nutritional_issues_radios as $nirdo): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($nutritional_issues_radio_attr[$nirdo['value']]); ?>
                                          <?php echo $nirdo['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group ">
                                <label for="">Allergies:</label>
                                <?php foreach($allergies_radios as $ardo): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($allergies_radio_attr[$ardo['value']]); ?>
                                          <?php echo $ardo['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>                                                                
                            </div>
                            <div class="form-group ">
                                <label for="">Type of Allergy</label>
                                <?php echo form_input($type_of_allergy); ?>
                            </div>
                            <div class="form-group ">
                                <label for="">Assistive Services:</label>
                                <?php foreach($assistive_services_checkboxes as $aschk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($assistive_services_checkbox_attr[$aschk['value']]); ?>
                                          <?php echo $aschk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>                                                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Assistive Devices:</label>
                                <?php foreach($assistive_devices_checkboxes as $adchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($assistive_devices_checkbox_attr[$adchk['value']]); ?>
                                          <?php echo $adchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div> 
                            <div class="form-group ">
                                <label for="">Recent Hospital Visits:</label>
                                <?php foreach($recent_hospital_visits_radios as $rhvdo): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($recent_hospital_visits_radio_attr[$rhvdo['value']]); ?>
                                          <?php echo $rhvdo['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group ">
                                <label for="">Recent ER Visits:</label>
                                <?php foreach($recent_er_visits_radios as $revrdo): ?>
                                    <div class="radio">                        
                                        <label>
                                          <?php echo form_radio($recent_er_visits_radio_attr[$revrdo['value']]); ?>
                                          <?php echo $revrdo['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>                  
                </div>
                  
                <div class="box-body">
                    <div class="row">                                                                      
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">Hospital Visit Related To:</label>
                                <?php foreach($hospital_visit_related_to_checkboxes as $hvrtcchk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($hospital_visit_related_to_checkbox_attr[$hvrtcchk['value']]); ?>
                                          <?php echo $hvrtcchk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>
                                
                                <label for="">Notes</label>
                                <?php echo form_textarea($hospital_visit_related_to_notes); ?>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="">On-site Supervision and Assistance:</label>
                                <?php foreach($supervision_and_assisstance_checkboxes as $saachk): ?>
                                    <div class="checkbox">                        
                                        <label>
                                          <?php echo form_checkbox($supervision_and_assisstance_checkbox_attr[$saachk['value']]); ?>
                                          <?php echo $saachk['label']; ?>
                                        </label>                    
                                    </div>
                                <?php endforeach; ?>                                
                            </div>                            
                        </div>
                    </div>                  
                </div>
                  
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Axis Client Assessment Notes</label>
                            <?php echo form_textarea($axis_assesstment_notes); ?>
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