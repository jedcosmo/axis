<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-29
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class InitialAssessment extends Admin_Controller {   

    private $client_object;
    private $client_summary;
    private $client_statuses;
    private $action;
    
    public function __construct()
    {
        parent::__construct();
        /* Title Page :: Common */
        $this->page_title->push('Demographics');
        $this->data['pagetitle'] = $this->page_title->show();
        $this->load->model('admin/clients_model');
        $this->load->model('admin/clientInitialAssessment_model');

        $this->action = $this->router->method;
        
        $this->data['message'] = '';
        $this->data['post_data'] = '';
        //$this->data['page_action'] = $this->action;
        //$this->data['page_action_label'] = ucfirst($this->action);
    }
    
    public function index(){
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();                                
    }
    
    public function create( $member_id = '' ){

        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['member_id'] = $member_id;
        $this->client_summary = $this->clients_model->getClientSummaryDetailsByMemberID( $member_id );
        $client_summary_ID = is_object($this->client_summary) ? $this->client_summary->ID : 0;
        $this->data['client_id'] = $this->client_summary->ID;
        $this->data['post_initial_assessment'] = $this->input->post();

        $this->form_validation->set_rules('proposed_start_date', 'Proposed Start Date', 'trim');
        $this->form_validation->set_rules('proposed_end_date', 'Proposed End Date', 'trim');
        $this->form_validation->set_rules('date_completed', 'Date Completed', 'trim');

        if ($this->form_validation->run() == TRUE){
            $this->session->set_flashdata('client_initial_assessment_message', 'New client post initial request successfully created.');

            $log_fields['client_id'] = $client_summary_ID;            
            $log_fields['client_form_type'] = 'initial_assessment_status'; 
            $log_fields['form_action'] = 'CREATE';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );
            
            $this->clientInitialAssessment_model->create( $this->input->post() );
            redirect('admin/initialAssessment/edit/'.$member_id, 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_initial_assessment_message', $errors);                
        }

        $this->prepareFormFields($this->input->post());

        /* Load Template */
        $this->template->admin_render('admin/client_forms/initial_assessment_form_create', $this->data);             
    }

    public function edit( $member_id = '' ){                
        $this->client_summary = $this->clients_model->getClientSummaryDetailsByMemberID( $member_id );
        $client_summary_ID = is_object($this->client_summary) ? $this->client_summary->ID : 0;
        $client_initial_assessment = $this->clientInitialAssessment_model->getClientInitialAssessmentByMemberID($client_summary_ID);

        $this->data['client_id'] = $this->client_summary->ID;
        
        
        $this->form_validation->set_rules('proposed_start_date', 'Proposed Start Date', 'trim');
        $this->form_validation->set_rules('proposed_end_date', 'Proposed End Date', 'trim');
        $this->form_validation->set_rules('date_completed', 'Date Completed', 'trim');

        if( !is_object($this->client_summary) && empty($this->client_statuses)){
            redirect('admin/clients', 'refresh');
        }
                           
        if( $this->session->flashdata('client_initial_assessment_message') ){
            $this->data['message'] = $this->session->flashdata('client_initial_assessment_message');
        }

        if ($this->form_validation->run() == TRUE){
            $this->session->set_flashdata('client_initial_assessment_message', 'Client assessment status successfully updated.');                
            $this->clientInitialAssessment_model->update( $this->input->post() );

            $log_fields['client_id'] = $client_summary_ID;            
            $log_fields['client_form_type'] = 'initial_assessment_status'; 
            $log_fields['form_action'] = 'UPDATE';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );
            
            redirect('admin/initialAssessment/edit/'.$member_id, 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_initial_assessment_message', $errors);                
        }
        
        $this->prepareFormFields($client_initial_assessment);

        /* Load Template */
        $this->data['client_initial_assessment'] = $client_initial_assessment;
        $this->template->admin_render('admin/client_forms/initial_assessment_form_edit', $this->data);
    }


    private function prepareFormFields( $content = array() ){

        /*
        $this->data['days'] = array(
                'type'  => 'checkbox',
                'name' => 'three_days_a_week',
                'checked' => set_radio('three_days_a_week', '3', ($content->three_days_a_week == 3 ? TRUE:FALSE ))
        );

        $this->data['four_days_a_week'] = array(
                'type'  => 'checkbox',
                'name' => 'four_days_a_week',
                'checked' => set_radio('four_days_a_week', '4', ($content->four_days_a_week == 1 ? TRUE:FALSE ))
        );

        $this->data['five_days_a_week'] = array(
                'type'  => 'checkbox',
                'name' => 'five_days_a_week',
                'checked' => set_radio('five_days_a_week', '5', ($content->five_days_a_week == 1 ? TRUE:FALSE ))
        );
        */

        $this->data['proposed_start_date'] = array(                
                'type'  => 'text',
                'name' => 'proposed_start_date',                
                'class' => 'form-control datepicker',  
                'value' => set_value('proposed_start_date', (is_object($content) ? $content->proposed_start_date : ''))
        );

        $this->data['proposed_end_date'] = array(                
                'type'  => 'text',
                'name' => 'proposed_end_date',                
                'class' => 'form-control datepicker',  
                'value' => set_value('proposed_end_date', (is_object($content) ? $content->proposed_end_date : ''))
        );

        $this->data['weight_loss'] = array(                
                'type'  => 'checkbox',
                'name' => 'weight_loss',                
                'checked' => set_radio('weight_loss', '1', ($content->weight_loss == 1 ? TRUE:FALSE ))
        );

        $this->data['weight_loss_current_level'] = array(                
                'name' => 'weight_loss_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('weight_loss_current_level', (is_object($content) ? $content->weight_loss_current_level : ''))
        );

        $this->data['weight_loss_expected_outcome'] = array(                
                'name' => 'weight_loss_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('weight_loss_expected_outcome', (is_object($content) ? $content->weight_loss_expected_outcome : ''))
        );

        $this->data['increased_wheelchair_mobilization'] = array(                
                'type'  => 'checkbox',
                'name' => 'increased_wheelchair_mobilization',    
                'checked' => set_radio('increased_wheelchair_mobilization', '1', ($content->increased_wheelchair_mobilization == 1 ? TRUE:FALSE ))
        );

        $this->data['increased_wheelchair_mobilization_current_level'] = array(                
                'name' => 'increased_wheelchair_mobilization_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_wheelchair_mobilization_current_level', (is_object($content) ? $content->increased_wheelchair_mobilization_current_level : ''))
        );

        $this->data['increased_wheelchair_mobilization_expected_outcome'] = array(                
                'name' => 'increased_wheelchair_mobilization_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_wheelchair_mobilization_expected_outcome', (is_object($content) ? $content->increased_wheelchair_mobilization_expected_outcome : ''))
        );

        $this->data['increased_aerobic_function'] = array(                
                'type'  => 'checkbox',
                'name' => 'increased_aerobic_function',  
                'checked' => set_radio('increased_aerobic_function', '1', ($content->increased_aerobic_function == 1 ? TRUE:FALSE ))
        );

        $this->data['increased_aerobic_function_current_level'] = array(                
                'name' => 'increased_aerobic_function_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_aerobic_function_current_level', (is_object($content) ? $content->increased_aerobic_function_current_level : ''))
        );

        $this->data['increased_aerobic_function_expected_outcome'] = array(                
                'name' => 'increased_aerobic_function_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_aerobic_function_expected_outcome', (is_object($content) ? $content->increased_aerobic_function_expected_outcome : ''))
        );

        $this->data['improve_transfer'] = array(                
                'type'  => 'checkbox',
                'name' => 'improve_transfer',     
                'checked' => set_radio('improve_transfer', '1', ($content->improve_transfer == 1 ? TRUE:FALSE ))
        );

        $this->data['improve_transfer_current_level'] = array(                
                'name' => 'improve_transfer_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('improve_transfer_current_level', (is_object($content) ? $content->improve_transfer_current_level : ''))
        );

        $this->data['improve_transfer_expected_outcome'] = array(                
                'name' => 'improve_transfer_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('improve_transfer_expected_outcome', (is_object($content) ? $content->improve_transfer_expected_outcome : ''))
        );

        $this->data['increased_strength'] = array(                
                'type'  => 'checkbox',
                'name' => 'increased_strength',     
                'checked' => set_radio('increased_strength', '1', ($content->increased_strength == 1 ? TRUE:FALSE ))
        );

        $this->data['increased_strength_current_level'] = array(                
                'name' => 'increased_strength_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_strength_current_level', (is_object($content) ? $content->increased_strength_current_level : ''))
        );

        $this->data['increased_strength_expected_outcome'] = array(                
                'name' => 'increased_strength_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_strength_expected_outcome', (is_object($content) ? $content->increased_strength_expected_outcome : ''))
        );

        $this->data['increased_self_sufficiency'] = array(                
                'type'  => 'checkbox',
                'name' => 'increased_self_sufficiency',     
                'checked' => set_radio('increased_self_sufficiency', '1', ($content->increased_self_sufficiency == 1 ? TRUE:FALSE ))
        );

        $this->data['increased_self_sufficiency_current_level'] = array(                
                'name' => 'increased_self_sufficiency_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_self_sufficiency_current_level', (is_object($content) ? $content->increased_self_sufficiency_current_level : ''))
        );

        $this->data['increased_self_sufficiency_expected_outcome'] = array(                
                'name' => 'increased_self_sufficiency_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_self_sufficiency_expected_outcome', (is_object($content) ? $content->increased_self_sufficiency_expected_outcome : ''))
        );

        $this->data['increased_socialization'] = array(                
                'type'  => 'checkbox',
                'name' => 'increased_socialization',     
                'checked' => set_radio('increased_socialization', '1', ($content->increased_socialization == 1 ? TRUE:FALSE ))
        );

        $this->data['increased_socialization_current_level'] = array(                
                'name' => 'increased_socialization_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_socialization_current_level', (is_object($content) ? $content->increased_socialization_current_level : ''))
        );

        $this->data['increased_socialization_expected_outcome'] = array(                
                'name' => 'increased_socialization_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_socialization_expected_outcome', (is_object($content) ? $content->increased_socialization_expected_outcome : ''))
        );

        $this->data['reduced_hospitalization'] = array(                
                'type'  => 'checkbox',
                'name' => 'reduced_hospitalization',     
                'checked' => set_radio('reduced_hospitalization', '1', ($content->reduced_hospitalization == 1 ? TRUE:FALSE ))
        );

        $this->data['reduced_hospitalization_current_level'] = array(                
                'name' => 'reduced_hospitalization_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('reduced_hospitalization_current_level', (is_object($content) ? $content->reduced_hospitalization_current_level : ''))
        );

        $this->data['reduced_hospitalization_expected_outcome'] = array(                
                'name' => 'reduced_hospitalization_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('reduced_hospitalization_expected_outcome', (is_object($content) ? $content->reduced_hospitalization_expected_outcome : ''))
        );

        $this->data['pursue_vocation'] = array(                
                'type'  => 'checkbox',
                'name' => 'pursue_vocation',     
                'checked' => set_radio('pursue_vocation', '1', ($content->pursue_vocation == 1 ? TRUE:FALSE ))
        );

        $this->data['pursue_vocation_current_level'] = array(                
                'name' => 'pursue_vocation_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('pursue_vocation_current_level', (is_object($content) ? $content->pursue_vocation_current_level : ''))
        );

        $this->data['pursue_vocation_expected_outcome'] = array(                
                'name' => 'pursue_vocation_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('pursue_vocation_expected_outcome', (is_object($content) ? $content->pursue_vocation_expected_outcome : ''))
        );

        $this->data['pursue_education'] = array(                
                'type'  => 'checkbox',
                'name' => 'pursue_education',     
                'checked' => set_radio('pursue_education', '1', ($content->pursue_education == 1 ? TRUE:FALSE ))
        );

        $this->data['pursue_education_current_level'] = array(                
                'name' => 'pursue_education_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('pursue_education_current_level', (is_object($content) ? $content->pursue_education_current_level : ''))
        );

        $this->data['pursue_education_expected_outcome'] = array(                
                'name' => 'pursue_education_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('pursue_education_expected_outcome', (is_object($content) ? $content->pursue_education_expected_outcome : ''))
        );

        $this->data['increased_self_advocacy'] = array(                
                'type'  => 'checkbox',
                'name' => 'increased_self_advocacy',     
                'checked' => set_radio('increased_self_advocacy', '1', ($content->increased_self_advocacy == 1 ? TRUE:FALSE ))
        );

        $this->data['increased_self_advocacy_current_level'] = array(                
                'name' => 'increased_self_advocacy_current_level',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_self_advocacy_current_level', (is_object($content) ? $content->increased_self_advocacy_current_level : ''))
        );

        $this->data['increased_self_advocacy_expected_outcome'] = array(                
                'name' => 'increased_self_advocacy_expected_outcome',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('increased_self_advocacy_expected_outcome', (is_object($content) ? $content->increased_self_advocacy_expected_outcome : ''))
        );

        $this->data['aerobic'] = array(                
                'type'  => 'checkbox',
                'name' => 'aerobic',   
                'checked' => set_radio('aerobic', '1', ($content->aerobics == 1 ? TRUE:FALSE ))
        );

        $this->data['aerobic_times'] = array(                
                'name' => 'aerobic_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('aerobic_times', (is_object($content) ? $content->aerobic_times : ''))
        );

        $this->data['boxing_fitness'] = array(                
                'type'  => 'checkbox',
                'name' => 'boxing_fitness',
                'checked' => set_radio('boxing_fitness', '1', ($content->boxing_fitness == 1 ? TRUE:FALSE ))
        );

        $this->data['boxing_fitness_times'] = array(                
                'name' => 'boxing_fitness_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('boxing_fitness_times', (is_object($content) ? $content->boxing_fitness_times : ''))
        );

        $this->data['cardio_training'] = array(                
                'type'  => 'checkbox',
                'name' => 'cardio_training',
                'checked' => set_radio('cardio_training', '1', ($content->cardio_training == 1 ? TRUE:FALSE ))
        );

        $this->data['cardio_training_times'] = array(                
                'name' => 'cardio_training_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('cardio_training_times', (is_object($content) ? $content->cardio_training_times : ''))
        );

        $this->data['fitness_bands'] = array(                
                'type'  => 'checkbox',
                'name' => 'fitness_bands',
                'checked' => set_radio('fitness_bands', '1', ($content->fitness_bands == 1 ? TRUE:FALSE ))
        );

        $this->data['fitness_bands_times'] = array(                
                'name' => 'fitness_bands_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('fitness_bands_times', (is_object($content) ? $content->fitness_bands_times : ''))
        );

        $this->data['indoor_spinning'] = array(                
                'type'  => 'checkbox',
                'name' => 'indoor_spinning',
                'checked' => set_radio('indoor_spinning', '1', ($content->indoor_spinning == 1 ? TRUE:FALSE ))
        );

        $this->data['indoor_spinning_times'] = array(                
                'name' => 'indoor_spinning_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('indoor_spinning_times', (is_object($content) ? $content->indoor_spinning_times : ''))
        );

        $this->data['martial_arts'] = array(                
                'type'  => 'checkbox',
                'name' => 'martial_arts',
                'checked' => set_radio('martial_arts', '1', ($content->martial_arts == 1 ? TRUE:FALSE ))
        );

        $this->data['martial_arts_times'] = array(                
                'name' => 'martial_arts_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('martial_arts_times', (is_object($content) ? $content->martial_arts_times : ''))
        );

        $this->data['nutrition'] = array(                
                'type'  => 'checkbox',
                'name' => 'nutrition',
                'checked' => set_radio('nutrition', '1', ($content->nutrition == 1 ? TRUE:FALSE ))
        );

        $this->data['nutrition_times'] = array(                
                'name' => 'nutrition_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('nutrition_times', (is_object($content) ? $content->nutrition_times : ''))
        );


        $this->data['outdoor_hand_cycling'] = array(                
                'type'  => 'checkbox',
                'name' => 'outdoor_hand_cycling',
                'checked' => set_radio('outdoor_hand_cycling', '1', ($content->outdoor_hand_cycling == 1 ? TRUE:FALSE ))
        );

        $this->data['outdoor_hand_cycling_times'] = array(                
                'name' => 'outdoor_hand_cycling_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('outdoor_hand_cycling_times', (is_object($content) ? $content->outdoor_hand_cycling_times : ''))
        );

        $this->data['rowing'] = array(                
                'type'  => 'checkbox',
                'name' => 'rowing',
                'checked' => set_radio('rowing', '1', ($content->rowing == 1 ? TRUE:FALSE ))
        );

        $this->data['rowing_times'] = array(                
                'name' => 'rowing_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('rowing_times', (is_object($content) ? $content->rowing_times : ''))
        );

        $this->data['spinal_mobility'] = array(                
                'type'  => 'checkbox',
                'name' => 'spinal_mobility',
                'checked' => set_radio('spinal_mobility', '1', ($content->spinal_mobility == 1 ? TRUE:FALSE ))
        );

        $this->data['spinal_mobility_times'] = array(                
                'name' => 'spinal_mobility_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('spinal_mobility_times', (is_object($content) ? $content->spinal_mobility_times : ''))
        );

        $this->data['standing_frame'] = array(                
                'type'  => 'checkbox',
                'name' => 'standing_frame',
                'checked' => set_radio('standing_frame', '1', ($content->standing_frame == 1 ? TRUE:FALSE ))
        );

        $this->data['standing_frame_times'] = array(                
                'name' => 'standing_frame_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('standing_frame_times', (is_object($content) ? $content->standing_frame_times : ''))
        );

        $this->data['weight_training'] = array(                
                'type'  => 'checkbox',
                'name' => 'weight_training',
                'checked' => set_radio('weight_training', '1', ($content->weight_training == 1 ? TRUE:FALSE ))
        );

        $this->data['weight_training_times'] = array(                
                'name' => 'weight_training_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('weight_training_times', (is_object($content) ? $content->weight_training_times : ''))
        );

        $this->data['wheelchair_mobility'] = array(                
                'type'  => 'checkbox',
                'name' => 'wheelchair_mobility',
                'checked' => set_radio('wheelchair_mobility', '1', ($content->wheelchair_mobility == 1 ? TRUE:FALSE ))
        );

        $this->data['wheelchair_mobility_times'] = array(                
                'name' => 'wheelchair_mobility_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('wheelchair_mobility_times', (is_object($content) ? $content->wheelchair_mobility_times : ''))
        );

        $this->data['one_on_one_instruction'] = array(                
                'type'  => 'checkbox',
                'name' => 'one_on_one_instruction',
                'checked' => set_radio('one_on_one_instruction', '1', ($content->one_on_one_instruction == 1 ? TRUE:FALSE ))
        );

        $this->data['one_on_one_instruction_times'] = array(                
                'name' => 'one_on_one_instruction_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('one_on_one_instruction_times', (is_object($content) ? $content->one_on_one_instruction_times : ''))
        );

        $this->data['acupuncture'] = array(                
                'type'  => 'checkbox',
                'name' => 'acupuncture',
                'checked' => set_radio('acupuncture', '1', ($content->acupuncture == 1 ? TRUE:FALSE ))
        );

        $this->data['acupuncture_times'] = array(                
                'name' => 'acupuncture_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('acupuncture_times', (is_object($content) ? $content->acupuncture_times : ''))
        );

        $this->data['advocacy'] = array(                
                'type'  => 'checkbox',
                'name' => 'advocacy',
                'checked' => set_radio('advocacy', '1', ($content->advocacy == 1 ? TRUE:FALSE ))
        );

        $this->data['advocacy_times'] = array(                
                'name' => 'advocacy_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('advocacy_times', (is_object($content) ? $content->advocacy_times : ''))
        );

        $this->data['art_therapy'] = array(                
                'type'  => 'checkbox',
                'name' => 'art_therapy',
                'checked' => set_radio('art_therapy', '1', ($content->art_therapy == 1 ? TRUE:FALSE ))
        );

        $this->data['art_therapy_times'] = array(                
                'name' => 'art_therapy_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('art_therapy_times', (is_object($content) ? $content->art_therapy_times : ''))
        );

        $this->data['communications'] = array(                
                'type'  => 'checkbox',
                'name' => 'communications',
                'checked' => set_radio('communications', '1', ($content->communications == 1 ? TRUE:FALSE ))
        );

        $this->data['communications_times'] = array(                
                'name' => 'communications_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('communications_times', (is_object($content) ? $content->communications_times : ''))
        );

        $this->data['community_engagement'] = array(                
                'type'  => 'checkbox',
                'name' => 'community_engagement',
                'checked' => set_radio('community_engagement', '1', ($content->community_engagement == 1 ? TRUE:FALSE ))
        );

        $this->data['community_engagement_times'] = array(                
                'name' => 'community_engagement_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('community_engagement_times', (is_object($content) ? $content->community_engagement_times : ''))
        );

        $this->data['community_services'] = array(                
                'type'  => 'checkbox',
                'name' => 'community_services',
                'checked' => set_radio('community_services', '1', ($content->community_services == 1 ? TRUE:FALSE ))
        );

        $this->data['community_services_times'] = array(                
                'name' => 'community_services_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('community_services_times', (is_object($content) ? $content->community_services_times : ''))
        );

        $this->data['community_trips'] = array(                
                'type'  => 'checkbox',
                'name' => 'community_trips',
                'checked' => set_radio('community_trips', '1', ($content->community_trips == 1 ? TRUE:FALSE ))
        );

        $this->data['community_trips_times'] = array(                
                'name' => 'community_trips_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('community_trips_times', (is_object($content) ? $content->community_trips_times : ''))
        );

        $this->data['computer_class'] = array(                
                'type'  => 'checkbox',
                'name' => 'computer_class',
                'checked' => set_radio('computer_class', '1', ($content->computer_class == 1 ? TRUE:FALSE ))
        );

        $this->data['computer_class_times'] = array(                
                'name' => 'computer_class_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('computer_class_times', (is_object($content) ? $content->computer_class_times : ''))
        );

        $this->data['cooking_training'] = array(                
                'type'  => 'checkbox',
                'name' => 'cooking_training',
                'checked' => set_radio('cooking_training', '1', ($content->cooking_training == 1 ? TRUE:FALSE ))
        );

        $this->data['cooking_training_times'] = array(                
                'name' => 'cooking_training_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('cooking_training_times', (is_object($content) ? $content->cooking_training_times : ''))
        );

        $this->data['counseling_media'] = array(                
                'type'  => 'checkbox',
                'name' => 'counseling_media',
                'checked' => set_radio('counseling_media', '1', ($content->counseling_media == 1 ? TRUE:FALSE ))
        );

        $this->data['counseling_media_times'] = array(                
                'name' => 'counseling_media_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('counseling_media_times', (is_object($content) ? $content->counseling_media_times : ''))
        );

        $this->data['driving_lessons'] = array(                
                'type'  => 'checkbox',
                'name' => 'driving_lessons',
                'checked' => set_radio('driving_lessons', '1', ($content->driving_lessons == 1 ? TRUE:FALSE ))
        );

        $this->data['driving_lessons_times'] = array(                
                'name' => 'driving_lessons_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('driving_lessons_times', (is_object($content) ? $content->driving_lessons_times : ''))
        );

        $this->data['general_health'] = array(                
                'type'  => 'checkbox',
                'name' => 'general_health',
                'checked' => set_radio('general_health', '1', ($content->general_health == 1 ? TRUE:FALSE ))
        );

        $this->data['general_health_times'] = array(                
                'name' => 'general_health_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('general_health_times', (is_object($content) ? $content->general_health_times : ''))
        );

        $this->data['hha_training'] = array(                
                'type'  => 'checkbox',
                'name' => 'hha_training',
                'checked' => set_radio('hha_training', '1', ($content->hha_training == 1 ? TRUE:FALSE ))
        );

        $this->data['hha_training_times'] = array(                
                'name' => 'hha_training_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('hha_training_times', (is_object($content) ? $content->hha_training_times : ''))
        );

        $this->data['independent_living_skills'] = array(                
                'type'  => 'checkbox',
                'name' => 'independent_living_skills',
                'checked' => set_radio('independent_living_skills', '1', ($content->independent_living_skills == 1 ? TRUE:FALSE ))
        );

        $this->data['independent_living_skills_times'] = array(                
                'name' => 'independent_living_skills_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('independent_living_skills_times', (is_object($content) ? $content->independent_living_skills_times : ''))
        );

        $this->data['massage'] = array(                
                'type'  => 'checkbox',
                'name' => 'massage',
                'checked' => set_radio('massage', '1', ($content->massage == 1 ? TRUE:FALSE ))
        );

        $this->data['massage_times'] = array(                
                'name' => 'massage_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('massage_times', (is_object($content) ? $content->massage_times : ''))
        );

        $this->data['motomed'] = array(                
                'type'  => 'checkbox',
                'name' => 'motomed',
                'checked' => set_radio('motomed', '1', ($content->motomed == 1 ? TRUE:FALSE ))
        );

        $this->data['motomed_times'] = array(                
                'name' => 'motomed_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('motomed_times', (is_object($content) ? $content->motomed_times : ''))
        );

        $this->data['prepared_meals'] = array(                
                'type'  => 'checkbox',
                'name' => 'prepared_meals',
                'checked' => set_radio('prepared_meals', '1', ($content->prepared_meals == 1 ? TRUE:FALSE ))
        );

        $this->data['prepared_meals_times'] = array(                
                'name' => 'prepared_meals_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('prepared_meals_times', (is_object($content) ? $content->prepared_meals_times : ''))
        );

        $this->data['socialization_with_activities'] = array(                
                'type'  => 'checkbox',
                'name' => 'socialization_with_activities',
                'checked' => set_radio('socialization_with_activities', '1', ($content->socialization_with_activities == 1 ? TRUE:FALSE ))
        );

        $this->data['socialization_with_activities_times'] = array(                
                'name' => 'socialization_with_activities_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('socialization_with_activities_times', (is_object($content) ? $content->socialization_with_activities_times : ''))
        );

        $this->data['vocational_consultation'] = array(                
                'type'  => 'checkbox',
                'name' => 'vocational_consultation',
                'checked' => set_radio('vocational_consultation', '1', ($content->vocational_consultation == 1 ? TRUE:FALSE ))
        );

        $this->data['vocational_consultation_times'] = array(                
                'name' => 'vocational_consultation_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('vocational_consultation_times', (is_object($content) ? $content->vocational_consultation_times : ''))
        );

        $this->data['educational_consultation'] = array(                
                'type'  => 'checkbox',
                'name' => 'educational_consultation',
                'checked' => set_radio('educational_consultation', '1', ($content->educational_consultation == 1 ? TRUE:FALSE ))
        );

        $this->data['educational_consultation_times'] = array(                
                'name' => 'educational_consultation_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('educational_consultation_times', (is_object($content) ? $content->educational_consultation_times : ''))
        );

        $this->data['wheelchair_care'] = array(                
                'type'  => 'checkbox',
                'name' => 'wheelchair_care',
                'checked' => set_radio('wheelchair_care', '1', ($content->wheelchair_care == 1 ? TRUE:FALSE ))
        );

        $this->data['wheelchair_care_times'] = array(                
                'name' => 'wheelchair_care_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('wheelchair_care_times', (is_object($content) ? $content->wheelchair_care_times : ''))
        );

        $this->data['wheelchair_loan'] = array(                
                'type'  => 'checkbox',
                'name' => 'wheelchair_loan',
                'checked' => set_radio('wheelchair_loan', '1', ($content->wheelchair_loan == 1 ? TRUE:FALSE ))
        );

        $this->data['wheelchair_loan_times'] = array(                
                'name' => 'wheelchair_loan_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('wheelchair_loan_times', (is_object($content) ? $content->wheelchair_loan_times : ''))
        );

        $this->data['yoga'] = array(                
                'type'  => 'checkbox',
                'name' => 'yoga',
                'checked' => set_radio('yoga', '1', ($content->yoga == 1 ? TRUE:FALSE ))
        );

        $this->data['yoga_times'] = array(                
                'name' => 'yoga_times',                
                'type' => 'number',                
                'class' => 'form-control',  
                'value' => set_value('yoga_times', (is_object($content) ? $content->yoga_times : ''))
        );

        $this->data['notes'] = array(                
                'name' => 'notes',                
                'class' => 'form-excerpt-textarea',  
                'value' => set_value('notes', (is_object($content) ? $content->notes : ''))
        );

        $this->data['completed_by'] = array(                
                'name' => 'completed_by',                
                'type' => 'text',                
                'class' => 'form-control',  
                'value' => set_value('completed_by', (is_object($content) ? $content->completed_by : ''))
        );

        $this->data['date_completed'] = array(                
                'name' => 'date_completed',                
                'type' => 'text',                
                'class' => 'form-control datepicker',  
                'value' => set_value('date_completed', (is_object($content) ? $content->date : ''))
        );
        
        /*
        $this->data['physician_name'] = array(
                'name'  => 'physician_name',
                'id'    => 'physician_name',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Physician Name',
                'value' => $this->form_validation->set_value('physician_name', $this->_setObjectClientAssessmentStatus( 'physician_name' )),
        );
        */

    }

    private function _isChecked( $property, $key ){
        return ( (is_object($this->client_object) && !is_null($this->client_object->$property) && $this->client_object->$property == $key ) ? TRUE : FALSE );
    }
       
    private function _setObjectClientAssessmentStatus( $property ){
        return (is_array($this->client_statuses) && count($this->client_statuses) > 0 && isset($this->client_statuses[$property]) ? $this->client_statuses[$property] : '');
    }

    private function _setObjectHasValue( $property ){
        return (is_object($this->client_object) ? $this->client_object->$property : '');
    }
}
?>