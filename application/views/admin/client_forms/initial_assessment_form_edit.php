<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil-square-o"></i>
        Client Form
        <small>Edit - Post Initial Request for Increase in frequency</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Client Form</li>
        <li class="active">Edit - Post Initial Request for Increase in frequency</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <?php if( $this->session->flashdata('client_initial_assessment_message') || $message ): ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                                 
            <?php 
                  if( $this->session->flashdata('client_initial_assessment_message') ){
                      echo $this->session->flashdata('client_initial_assessment_message');
                  }else{
                      echo $message;
                  }      
            ?>
        </div>
      <?php endif; ?>
      <?php echo form_open(current_url(), array('class' => '', 'id' => 'form-create_client_assessment')); ?>
        <div class="row">
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Information</h3>
                </div>
                <div class="box-body">                                       
                  
                  <div class="row">
                    <div class="col-md-4">
                      <!--
                      <div class="form-group">
                        <label for="">Requested Weekly Visits</label>
                        <div class="checkbox">
                          <label>
                            <?php //echo form_radio($three_days_a_week); ?> 
                            3 Days a week
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <?php //echo form_radio($four_days_a_week); ?> 
                            4 Days a week
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <?php //echo form_radio($five_days_a_week); ?> 
                            5 Days a week
                          </label>
                        </div>
                      </div>
                      -->
                      <div class="form-group">
                        <label>Requested Weekly List</label>
                        <select class="form-control" name="number_of_days_per_week">
                          <option <?php echo ($client_initial_assessment->number_of_days_per_week == '3' ? 'selected="selected"':'') ?> value="3">3 days a week</option>
                          <option <?php echo ($client_initial_assessment->number_of_days_per_week == '4' ? 'selected="selected"':'') ?> value="4">4 days a week</option>
                          <option <?php echo ($client_initial_assessment->number_of_days_per_week == '5' ? 'selected="selected"':'') ?> value="5">5 days a week</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Proposed Start Date</label>
                        <?php echo form_input($proposed_start_date); ?>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Proposed End Date</label>
                        <?php echo form_input($proposed_end_date); ?>
                      </div>
                    </div>
                  </div>
                
                </div>
              </div>


              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Goals</h3>
                </div>
                <div class="box-body">  

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">Select</th>
                        <th>Goal</th>
                        <th>Current Level</th>
                        <th>Expected Outcome</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($weight_loss); ?></td>
                        <td>Weight Loss</td>
                        <td><?php echo form_textarea($weight_loss_current_level); ?></td>
                        <td><?php echo form_textarea($weight_loss_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($increased_strength); ?></td>
                        <td>Increased Strength</td>
                        <td><?php echo form_textarea($increased_strength_current_level); ?></td>
                        <td><?php echo form_textarea($increased_strength_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($increased_wheelchair_mobilization); ?></td>
                        <td>Increased Wheelchair Mobilization</td>
                        <td><?php echo form_textarea($increased_wheelchair_mobilization_current_level); ?></td>
                        <td><?php echo form_textarea($increased_wheelchair_mobilization_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($increased_self_sufficiency); ?></td>
                        <td>Increased Self-Sufficiency </td>
                        <td><?php echo form_textarea($increased_self_sufficiency_current_level); ?></td>
                        <td><?php echo form_textarea($increased_self_sufficiency_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($increased_socialization); ?></td>
                        <td>Increased Socialization</td>
                        <td><?php echo form_textarea($increased_socialization_current_level); ?></td>
                        <td><?php echo form_textarea($increased_socialization_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($reduced_hospitalization); ?></td>
                        <td>Reduced Hospitalization</td>
                        <td><?php echo form_textarea($reduced_hospitalization_current_level); ?></td>
                        <td><?php echo form_textarea($reduced_hospitalization_expected_outcome); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($increased_aerobic_function); ?></td>
                        <td>Increased Aerobic Function</td>
                        <td><?php echo form_textarea($increased_aerobic_function_current_level); ?></td>
                        <td><?php echo form_textarea($increased_aerobic_function_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($improve_transfer);?></td>
                        <td>Improve Transfer</td>
                        <td><?php echo form_textarea($improve_transfer_current_level); ?></td>
                        <td><?php echo form_textarea($improve_transfer_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($pursue_vocation);?></td>
                        <td>Pursue Vocation</td>
                        <td><?php echo form_textarea($pursue_vocation_current_level); ?></td>
                        <td><?php echo form_textarea($pursue_vocation_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($pursue_education);?></td>
                        <td>Pursue Education</td>
                        <td><?php echo form_textarea($pursue_education_current_level); ?></td>
                        <td><?php echo form_textarea($pursue_education_expected_outcome); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($increased_self_advocacy);?></td>
                        <td>Increased Self-Advocacy</td>
                        <td><?php echo form_textarea($increased_self_advocacy_current_level); ?></td>
                        <td><?php echo form_textarea($increased_self_advocacy_expected_outcome); ?></td>
                      </tr>
                    </tbody>
                  </table>                                     
                
                </div>
              </div>


              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Notes</h3>
                </div>
                <div class="box-body">  

                  <div class="form-group">
                    <?php echo form_textarea($notes); ?>
                  </div>

                </div>
              </div>


            </div>          
            
            <div class="col-md-6">              
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Program Interventions</h3>
                </div>
                  
                <div class="box-body">

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">Select</th>
                        <th width='400'>Activity</th>
                        <th>x's per week</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($acupuncture); ?></td>
                        <td>Acupuncture</td>
                        <td><?php echo form_input($acupuncture_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($advocacy); ?></td>
                        <td>Advocacy</td>
                        <td><?php echo form_input($advocacy_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($aerobic); ?></td>
                        <td>Aerobics</td>
                        <td><?php echo form_input($aerobic_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($art_therapy); ?></td>
                        <td>Art Therapy</td>
                        <td><?php echo form_input($art_therapy_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($boxing_fitness); ?></td>
                        <td>Boxing Fitness</td>
                        <td><?php echo form_input($boxing_fitness_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($cardio_training); ?></td>
                        <td>Cardio Training</td>
                        <td><?php echo form_input($cardio_training_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($communications); ?></td>
                        <td>Communications</td>
                        <td><?php echo form_input($communications_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($community_engagement); ?></td>
                        <td>Community Engagement</td>
                        <td><?php echo form_input($community_engagement_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($community_services); ?></td>
                        <td>Community Services</td>
                        <td><?php echo form_input($community_services_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($community_trips); ?></td>
                        <td>Community Trips</td>
                        <td><?php echo form_input($community_trips_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($computer_class); ?></td>
                        <td>Computer Class</td>
                        <td><?php echo form_input($computer_class_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($cooking_training); ?></td>
                        <td>Cooking Training</td>
                        <td><?php echo form_input($cooking_training_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($counseling_media); ?></td>
                        <td>Counseling Media</td>
                        <td><?php echo form_input($counseling_media_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($driving_lessons); ?></td>
                        <td>Driving Lessons</td>
                        <td><?php echo form_input($driving_lessons_times); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($fitness_bands); ?></td>
                        <td>Fitness bands</td>
                        <td><?php echo form_input($fitness_bands_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($general_health); ?></td>
                        <td>General Health & Preventative Care Classes</td>
                        <td><?php echo form_input($general_health_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($hha_training); ?></td>
                        <td>HHA Training</td>
                        <td><?php echo form_input($hha_training_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($independent_living_skills); ?></td>
                        <td>Independent Living Skills</td>
                        <td><?php echo form_input($independent_living_skills_times); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($indoor_spinning); ?></td>
                        <td>Indoor Spinning</td>
                        <td><?php echo form_input($indoor_spinning_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($martial_arts); ?></td>
                        <td>Martial Arts</td>
                        <td><?php echo form_input($martial_arts_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($massage); ?></td>
                        <td>Massage</td>
                        <td><?php echo form_input($massage_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($motomed); ?></td>
                        <td>Motomed</td>
                        <td><?php echo form_input($motomed_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($nutrition); ?></td>
                        <td>Nutrition</td>
                        <td><?php echo form_input($nutrition_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($outdoor_hand_cycling); ?></td>
                        <td>Outdoor Hand Cycling</td>
                        <td><?php echo form_input($outdoor_hand_cycling_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($prepared_meals); ?></td>
                        <td>Prepared Meals</td>
                        <td><?php echo form_input($prepared_meals_times); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($rowing); ?></td>
                        <td>Rowing</td>
                        <td><?php echo form_input($rowing_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($socialization_with_activities); ?></td>
                        <td>Socialization with Activities</td>
                        <td><?php echo form_input($socialization_with_activities_times); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($spinal_mobility); ?></td>
                        <td>Spinal Mobility </td>
                        <td><?php echo form_input($spinal_mobility_times); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($standing_frame); ?></td>
                        <td>Standing Frame</td>
                        <td><?php echo form_input($standing_frame_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($vocational_consultation); ?></td>
                        <td>Vocational Consultation</td>
                        <td><?php echo form_input($vocational_consultation_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($educational_consultation); ?></td>
                        <td>Educational Consultation </td>
                        <td><?php echo form_input($educational_consultation_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($wheelchair_care); ?></td>
                        <td>Wheelchair Care</td>
                        <td><?php echo form_input($wheelchair_care_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($wheelchair_loan); ?></td>
                        <td>Wheelchair Loan</td>
                        <td><?php echo form_input($wheelchair_loan_times); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($weight_training); ?></td>
                        <td>Weight Training</td>
                        <td><?php echo form_input($weight_training_times); ?></td>
                      </tr>                      
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($wheelchair_mobility); ?></td>
                        <td>Wheelchair Mobility</td>
                        <td><?php echo form_input($wheelchair_mobility_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($yoga); ?></td>
                        <td>Yoga</td>
                        <td><?php echo form_input($yoga_times); ?></td>
                      </tr>
                      <tr>
                        <td class="text-center"><?php echo form_checkbox($one_on_one_instruction); ?></td>
                        <td>One on One Instruction</td>
                        <td><?php echo form_input($one_on_one_instruction_times); ?></td>
                      </tr>
                    </tbody>
                  </table>
                 
                </div>  

              </div>


              <div class="box box-primary">
                  
                <div class="box-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Completed By:</label>
                        <?php echo form_input($completed_by); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date Completed:</label>
                        <?php echo form_input($date_completed); ?>
                      </div>
                    </div>
                  </div>

                </div>

              </div>


            </div>

        </div>      

        <div class="box-footer">
          <?php echo form_hidden('client_id',$client_id); ?>
          <button name="save" type="submit" class="btn btn-success btn-flat">Save</button>
          <a class="btn btn-danger btn-flat" href="/admin/clients">Cancel</a>
        </div>

      <?php echo form_close();?>

    </section>  
</div>