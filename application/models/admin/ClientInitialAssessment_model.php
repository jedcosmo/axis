<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientInitialAssessment_model extends CI_Model {

    private $db_content_table = 'clients_initial_assessment';
    
    private $db_clients_initial_assessment_table = 'clients_initial_assessment';
    
    public function __construct()
    {
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
    }
    
    public function create( $fields = array() ){
        $insert_fields = array();                 

        $insert_fields['client_id'] = $fields['client_id'];
        //$insert_fields['three_days_a_week'] = !isset($fields['three_days_a_week']) ? '0' : '1';
        //$insert_fields['four_days_a_week'] = !isset($fields['four_days_a_week']) ? '0' : '1';
        //$insert_fields['five_days_a_week'] = !isset($fields['five_days_a_week']) ? '0' : '1';
        $insert_fields['number_of_days_per_week'] = $fields['number_of_days_per_week'];
        $insert_fields['proposed_start_date'] = $fields['proposed_start_date'];
        $insert_fields['proposed_end_date'] = $fields['proposed_end_date'];

        $insert_fields['weight_loss'] = !isset($fields['weight_loss']) ? '0':'1';
        $insert_fields['weight_loss_current_level'] = $fields['weight_loss_current_level'];
        $insert_fields['weight_loss_expected_outcome'] = $fields['weight_loss_expected_outcome'];
        $insert_fields['increased_strength'] = !isset($fields['increased_strength']) ? '0':'1';
        $insert_fields['increased_strength_current_level'] = $fields['increased_strength_current_level'];
        $insert_fields['increased_strength_expected_outcome'] = $fields['increased_strength_expected_outcome'];
        $insert_fields['increased_wheelchair_mobilization'] = !isset($fields['increased_wheelchair_mobilization']) ? '0':'1';
        $insert_fields['increased_wheelchair_mobilization_current_level'] = $fields['increased_wheelchair_mobilization_current_level'];
        $insert_fields['increased_wheelchair_mobilization_expected_outcome'] = $fields['increased_wheelchair_mobilization_expected_outcome'];
        $insert_fields['increased_self_sufficiency'] = !isset($fields['increased_self_sufficiency']) ? '0':'1';
        $insert_fields['increased_self_sufficiency_current_level'] = $fields['increased_self_sufficiency_current_level'];
        $insert_fields['increased_self_sufficiency_expected_outcome'] = $fields['increased_self_sufficiency_expected_outcome'];
        $insert_fields['increased_socialization'] = !isset($fields['increased_socialization']) ? '0':'1';
        $insert_fields['increased_socialization_current_level'] = $fields['increased_socialization_current_level'];
        $insert_fields['increased_socialization_expected_outcome'] = $fields['increased_socialization_expected_outcome'];
        $insert_fields['reduced_hospitalization'] = !isset($fields['reduced_hospitalization']) ? '0':'1';
        $insert_fields['reduced_hospitalization_current_level'] = $fields['reduced_hospitalization_current_level'];
        $insert_fields['reduced_hospitalization_expected_outcome'] = $fields['reduced_hospitalization_expected_outcome'];                        
        $insert_fields['increased_aerobic_function'] = !isset($fields['increased_aerobic_function']) ? '0':'1';
        $insert_fields['increased_aerobic_function_current_level'] = $fields['increased_aerobic_function_current_level'];
        $insert_fields['increased_aerobic_function_expected_outcome'] = $fields['increased_aerobic_function_expected_outcome'];
        $insert_fields['improve_transfer'] = !isset($fields['improve_transfer']) ? '0':'1';
        $insert_fields['improve_transfer_current_level'] = $fields['improve_transfer_current_level'];
        $insert_fields['improve_transfer_expected_outcome'] = $fields['improve_transfer_expected_outcome'];
        $insert_fields['pursue_vocation'] = !isset($fields['pursue_vocation']) ? '0':'1';
        $insert_fields['pursue_vocation_current_level'] = $fields['pursue_vocation_current_level'];
        $insert_fields['pursue_vocation_expected_outcome'] = $fields['pursue_vocation_expected_outcome'];
        $insert_fields['pursue_education'] = !isset($fields['pursue_education']) ? '0':'1';
        $insert_fields['pursue_education_current_level'] = $fields['pursue_education_current_level'];
        $insert_fields['pursue_education_expected_outcome'] = $fields['pursue_education_expected_outcome'];
        $insert_fields['increased_self_advocacy'] = !isset($fields['increased_self_advocacy']) ? '0':'1';
        $insert_fields['increased_self_advocacy_current_level'] = $fields['increased_self_advocacy_current_level'];
        $insert_fields['increased_self_advocacy_expected_outcome'] = $fields['increased_self_advocacy_expected_outcome'];

        $insert_fields['acupuncture'] = !isset($fields['acupuncture']) ? '0':'1';
        $insert_fields['acupuncture_times'] = $fields['acupuncture_times'];
        $insert_fields['advocacy'] = !isset($fields['advocacy']) ? '0':'1';
        $insert_fields['advocacy_times'] = $fields['advocacy_times'];
        $insert_fields['aerobics'] = !isset($fields['aerobic']) ? '0':'1';
        $insert_fields['aerobic_times'] = $fields['aerobic_times'];
        $insert_fields['art_therapy'] = !isset($fields['art_therapy']) ? '0':'1';
        $insert_fields['art_therapy_times'] = $fields['art_therapy_times'];
        $insert_fields['boxing_fitness'] = !isset($fields['boxing_fitness']) ? '0':'1';
        $insert_fields['boxing_fitness_times'] = $fields['boxing_fitness_times'];
        $insert_fields['cardio_training'] = !isset($fields['cardio_training']) ? '0':'1';
        $insert_fields['cardio_training_times'] = $fields['cardio_training_times'];
        $insert_fields['communications'] = !isset($fields['communications']) ? '0':'1';
        $insert_fields['communications_times'] = $fields['communications_times'];
        $insert_fields['community_engagement'] = !isset($fields['community_engagement']) ? '0':'1';
        $insert_fields['community_engagement_times'] = $fields['community_engagement_times'];
        $insert_fields['community_services'] = !isset($fields['community_services']) ? '0':'1';
        $insert_fields['community_services_times'] = $fields['community_services_times'];
        $insert_fields['community_trips'] = !isset($fields['community_trips']) ? '0':'1';
        $insert_fields['community_trips_times'] = $fields['community_trips_times'];
        $insert_fields['computer_class'] = !isset($fields['computer_class']) ? '0':'1';
        $insert_fields['computer_class_times'] = $fields['computer_class_times'];
        $insert_fields['cooking_training'] = !isset($fields['cooking_training']) ? '0':'1';
        $insert_fields['cooking_training_times'] = $fields['cooking_training_times'];
        $insert_fields['counseling_media'] = !isset($fields['counseling_media']) ? '0':'1';
        $insert_fields['counseling_media_times'] = $fields['counseling_media_times'];
        $insert_fields['driving_lessons'] = !isset($fields['driving_lessons']) ? '0':'1';
        $insert_fields['driving_lessons_times'] = $fields['driving_lessons_times'];
        $insert_fields['fitness_bands'] = !isset($fields['fitness_bands']) ? '0':'1';
        $insert_fields['fitness_bands_times'] = $fields['fitness_bands_times'];
        $insert_fields['general_health'] = !isset($fields['general_health']) ? '0':'1';
        $insert_fields['general_health_times'] = $fields['general_health_times'];
        $insert_fields['hha_training'] = !isset($fields['hha_training']) ? '0':'1';
        $insert_fields['hha_training_times'] = $fields['hha_training_times'];
        $insert_fields['independent_living_skills'] = !isset($fields['independent_living_skills']) ? '0':'1';
        $insert_fields['independent_living_skills_times'] = $fields['independent_living_skills_times'];
        $insert_fields['indoor_spinning'] = !isset($fields['indoor_spinning']) ? '0':'1';
        $insert_fields['indoor_spinning_times'] = $fields['indoor_spinning_times'];
        $insert_fields['martial_arts'] = !isset($fields['martial_arts']) ? '0':'1';
        $insert_fields['martial_arts_times'] = $fields['martial_arts_times'];
        $insert_fields['massage'] = !isset($fields['massage']) ? '0':'1';
        $insert_fields['massage_times'] = $fields['massage_times'];
        $insert_fields['motomed'] = !isset($fields['motomed']) ? '0':'1';
        $insert_fields['motomed_times'] = $fields['motomed_times'];
        $insert_fields['nutrition'] = !isset($fields['nutrition']) ? '0':'1';
        $insert_fields['nutrition_times'] = $fields['nutrition_times'];
        $insert_fields['outdoor_hand_cycling'] = !isset($fields['outdoor_hand_cycling']) ? '0':'1';
        $insert_fields['outdoor_hand_cycling_times'] = $fields['outdoor_hand_cycling_times'];
        $insert_fields['prepared_meals'] = !isset($fields['prepared_meals']) ? '0':'1';
        $insert_fields['prepared_meals_times'] = $fields['prepared_meals_times'];        
        $insert_fields['rowing'] = !isset($fields['rowing']) ? '0':'1';
        $insert_fields['rowing_times'] = $fields['rowing_times'];
        $insert_fields['socialization_with_activities'] = !isset($fields['socialization_with_activities']) ? '0':'1';
        $insert_fields['socialization_with_activities_times'] = $fields['socialization_with_activities_times'];
        $insert_fields['spinal_mobility'] = !isset($fields['spinal_mobility']) ? '0':'1';
        $insert_fields['spinal_mobility_times'] = $fields['spinal_mobility_times'];
        $insert_fields['standing_frame'] = !isset($fields['standing_frame']) ? '0':'1';
        $insert_fields['standing_frame_times'] = $fields['standing_frame_times'];
        $insert_fields['vocational_consultation'] = !isset($fields['vocational_consultation']) ? '0':'1';
        $insert_fields['vocational_consultation_times'] = $fields['vocational_consultation_times'];
        $insert_fields['educational_consultation'] = !isset($fields['educational_consultation']) ? '0':'1';
        $insert_fields['educational_consultation_times'] = $fields['educational_consultation_times'];
        $insert_fields['wheelchair_care'] = !isset($fields['wheelchair_care']) ? '0':'1';
        $insert_fields['wheelchair_care_times'] = $fields['wheelchair_care_times'];
        $insert_fields['wheelchair_loan'] = !isset($fields['wheelchair_loan']) ? '0':'1';
        $insert_fields['wheelchair_loan_times'] = $fields['wheelchair_loan_times'];
        $insert_fields['weight_training'] = !isset($fields['weight_training']) ? '0':'1';
        $insert_fields['weight_training_times'] = $fields['weight_training_times'];    
        $insert_fields['wheelchair_mobility'] = !isset($fields['wheelchair_mobility']) ? '0':'1';
        $insert_fields['wheelchair_mobility_times'] = $fields['wheelchair_mobility_times'];
        $insert_fields['yoga'] = !isset($fields['yoga']) ? '0':'1';
        $insert_fields['yoga_times'] = $fields['yoga_times'];
        $insert_fields['one_on_one_instruction'] = !isset($fields['one_on_one_instruction']) ? '0':'1';
        $insert_fields['one_on_one_instruction_times'] = $fields['one_on_one_instruction_times'];

        $insert_fields['notes'] = $fields['notes'];
        $insert_fields['completed_by'] = $fields['completed_by'];
        $insert_fields['date'] = $fields['date_completed'];

        $this->db->insert($this->db_clients_initial_assessment_table, $insert_fields);
        $insert_id = $this->db->insert_id();
        return $insert_id;

    }
    
    public function update( $fields = array() ){
        $update_fields = array();                            
        
        $update_fields['client_id'] = $fields['client_id'];
        //$update_fields['three_days_a_week'] = !isset($fields['three_days_a_week']) ? '0' : '1';
        //$update_fields['four_days_a_week'] = !isset($fields['four_days_a_week']) ? '0' : '1';
        //$update_fields['five_days_a_week'] = !isset($fields['five_days_a_week']) ? '0' : '1';
        $update_fields['number_of_days_per_week'] = $fields['number_of_days_per_week'];
        $update_fields['proposed_start_date'] = $fields['proposed_start_date'];
        $update_fields['proposed_end_date'] = $fields['proposed_end_date'];

        $update_fields['weight_loss'] = !isset($fields['weight_loss']) ? '0':'1';
        $update_fields['weight_loss_current_level'] = $fields['weight_loss_current_level'];
        $update_fields['weight_loss_expected_outcome'] = $fields['weight_loss_expected_outcome'];
        $update_fields['increased_strength'] = !isset($fields['increased_strength']) ? '0':'1';
        $update_fields['increased_strength_current_level'] = $fields['increased_strength_current_level'];
        $update_fields['increased_strength_expected_outcome'] = $fields['increased_strength_expected_outcome'];
        $update_fields['increased_wheelchair_mobilization'] = !isset($fields['increased_wheelchair_mobilization']) ? '0':'1';
        $update_fields['increased_wheelchair_mobilization_current_level'] = $fields['increased_wheelchair_mobilization_current_level'];
        $update_fields['increased_wheelchair_mobilization_expected_outcome'] = $fields['increased_wheelchair_mobilization_expected_outcome'];
        $update_fields['increased_self_sufficiency'] = !isset($fields['increased_self_sufficiency']) ? '0':'1';
        $update_fields['increased_self_sufficiency_current_level'] = $fields['increased_self_sufficiency_current_level'];
        $update_fields['increased_self_sufficiency_expected_outcome'] = $fields['increased_self_sufficiency_expected_outcome'];
        $update_fields['increased_socialization'] = !isset($fields['increased_socialization']) ? '0':'1';
        $update_fields['increased_socialization_current_level'] = $fields['increased_socialization_current_level'];
        $update_fields['increased_socialization_expected_outcome'] = $fields['increased_socialization_expected_outcome'];
        $update_fields['reduced_hospitalization'] = !isset($fields['reduced_hospitalization']) ? '0':'1';
        $update_fields['reduced_hospitalization_current_level'] = $fields['reduced_hospitalization_current_level'];
        $update_fields['reduced_hospitalization_expected_outcome'] = $fields['reduced_hospitalization_expected_outcome'];                        
        $update_fields['increased_aerobic_function'] = !isset($fields['increased_aerobic_function']) ? '0':'1';
        $update_fields['increased_aerobic_function_current_level'] = $fields['increased_aerobic_function_current_level'];
        $update_fields['increased_aerobic_function_expected_outcome'] = $fields['increased_aerobic_function_expected_outcome'];
        $update_fields['improve_transfer'] = !isset($fields['improve_transfer']) ? '0':'1';
        $update_fields['improve_transfer_current_level'] = $fields['improve_transfer_current_level'];
        $update_fields['improve_transfer_expected_outcome'] = $fields['improve_transfer_expected_outcome'];
        $update_fields['pursue_vocation'] = !isset($fields['pursue_vocation']) ? '0':'1';
        $update_fields['pursue_vocation_current_level'] = $fields['pursue_vocation_current_level'];
        $update_fields['pursue_vocation_expected_outcome'] = $fields['pursue_vocation_expected_outcome'];
        $update_fields['pursue_education'] = !isset($fields['pursue_education']) ? '0':'1';
        $update_fields['pursue_education_current_level'] = $fields['pursue_education_current_level'];
        $update_fields['pursue_education_expected_outcome'] = $fields['pursue_education_expected_outcome'];
        $update_fields['increased_self_advocacy'] = !isset($fields['increased_self_advocacy']) ? '0':'1';
        $update_fields['increased_self_advocacy_current_level'] = $fields['increased_self_advocacy_current_level'];
        $update_fields['increased_self_advocacy_expected_outcome'] = $fields['increased_self_advocacy_expected_outcome'];

        $update_fields['acupuncture'] = !isset($fields['acupuncture']) ? '0':'1';
        $update_fields['acupuncture_times'] = $fields['acupuncture_times'];
        $update_fields['advocacy'] = !isset($fields['advocacy']) ? '0':'1';
        $update_fields['advocacy_times'] = $fields['advocacy_times'];
        $update_fields['aerobics'] = !isset($fields['aerobic']) ? '0':'1';
        $update_fields['aerobic_times'] = $fields['aerobic_times'];
        $update_fields['art_therapy'] = !isset($fields['art_therapy']) ? '0':'1';
        $update_fields['art_therapy_times'] = $fields['art_therapy_times'];
        $update_fields['boxing_fitness'] = !isset($fields['boxing_fitness']) ? '0':'1';
        $update_fields['boxing_fitness_times'] = $fields['boxing_fitness_times'];
        $update_fields['cardio_training'] = !isset($fields['cardio_training']) ? '0':'1';
        $update_fields['cardio_training_times'] = $fields['cardio_training_times'];
        $update_fields['communications'] = !isset($fields['communications']) ? '0':'1';
        $update_fields['communications_times'] = $fields['communications_times'];
        $update_fields['community_engagement'] = !isset($fields['community_engagement']) ? '0':'1';
        $update_fields['community_engagement_times'] = $fields['community_engagement_times'];
        $update_fields['community_services'] = !isset($fields['community_services']) ? '0':'1';
        $update_fields['community_services_times'] = $fields['community_services_times'];
        $update_fields['community_trips'] = !isset($fields['community_trips']) ? '0':'1';
        $update_fields['community_trips_times'] = $fields['community_trips_times'];
        $update_fields['computer_class'] = !isset($fields['computer_class']) ? '0':'1';
        $update_fields['computer_class_times'] = $fields['computer_class_times'];
        $update_fields['cooking_training'] = !isset($fields['cooking_training']) ? '0':'1';
        $update_fields['cooking_training_times'] = $fields['cooking_training_times'];
        $update_fields['counseling_media'] = !isset($fields['counseling_media']) ? '0':'1';
        $update_fields['counseling_media_times'] = $fields['counseling_media_times'];
        $update_fields['driving_lessons'] = !isset($fields['driving_lessons']) ? '0':'1';
        $update_fields['driving_lessons_times'] = $fields['driving_lessons_times'];
        $update_fields['fitness_bands'] = !isset($fields['fitness_bands']) ? '0':'1';
        $update_fields['fitness_bands_times'] = $fields['fitness_bands_times'];
        $update_fields['general_health'] = !isset($fields['general_health']) ? '0':'1';
        $update_fields['general_health_times'] = $fields['general_health_times'];
        $update_fields['hha_training'] = !isset($fields['hha_training']) ? '0':'1';
        $update_fields['hha_training_times'] = $fields['hha_training_times'];
        $update_fields['independent_living_skills'] = !isset($fields['independent_living_skills']) ? '0':'1';
        $update_fields['independent_living_skills_times'] = $fields['independent_living_skills_times'];
        $update_fields['indoor_spinning'] = !isset($fields['indoor_spinning']) ? '0':'1';
        $update_fields['indoor_spinning_times'] = $fields['indoor_spinning_times'];
        $update_fields['martial_arts'] = !isset($fields['martial_arts']) ? '0':'1';
        $update_fields['martial_arts_times'] = $fields['martial_arts_times'];
        $update_fields['massage'] = !isset($fields['massage']) ? '0':'1';
        $update_fields['massage_times'] = $fields['massage_times'];
        $update_fields['motomed'] = !isset($fields['motomed']) ? '0':'1';
        $update_fields['motomed_times'] = $fields['motomed_times'];
        $update_fields['nutrition'] = !isset($fields['nutrition']) ? '0':'1';
        $update_fields['nutrition_times'] = $fields['nutrition_times'];
        $update_fields['outdoor_hand_cycling'] = !isset($fields['outdoor_hand_cycling']) ? '0':'1';
        $update_fields['outdoor_hand_cycling_times'] = $fields['outdoor_hand_cycling_times'];
        $update_fields['prepared_meals'] = !isset($fields['prepared_meals']) ? '0':'1';
        $update_fields['prepared_meals_times'] = $fields['prepared_meals_times'];        
        $update_fields['rowing'] = !isset($fields['rowing']) ? '0':'1';
        $update_fields['rowing_times'] = $fields['rowing_times'];
        $update_fields['socialization_with_activities'] = !isset($fields['socialization_with_activities']) ? '0':'1';
        $update_fields['socialization_with_activities_times'] = $fields['socialization_with_activities_times'];
        $update_fields['spinal_mobility'] = !isset($fields['spinal_mobility']) ? '0':'1';
        $update_fields['spinal_mobility_times'] = $fields['spinal_mobility_times'];
        $update_fields['standing_frame'] = !isset($fields['standing_frame']) ? '0':'1';
        $update_fields['standing_frame_times'] = $fields['standing_frame_times'];
        $update_fields['vocational_consultation'] = !isset($fields['vocational_consultation']) ? '0':'1';
        $update_fields['vocational_consultation_times'] = $fields['vocational_consultation_times'];
        $update_fields['educational_consultation'] = !isset($fields['educational_consultation']) ? '0':'1';
        $update_fields['educational_consultation_times'] = $fields['educational_consultation_times'];
        $update_fields['wheelchair_care'] = !isset($fields['wheelchair_care']) ? '0':'1';
        $update_fields['wheelchair_care_times'] = $fields['wheelchair_care_times'];
        $update_fields['wheelchair_loan'] = !isset($fields['wheelchair_loan']) ? '0':'1';
        $update_fields['wheelchair_loan_times'] = $fields['wheelchair_loan_times'];
        $update_fields['weight_training'] = !isset($fields['weight_training']) ? '0':'1';
        $update_fields['weight_training_times'] = $fields['weight_training_times'];    
        $update_fields['wheelchair_mobility'] = !isset($fields['wheelchair_mobility']) ? '0':'1';
        $update_fields['wheelchair_mobility_times'] = $fields['wheelchair_mobility_times'];
        $update_fields['yoga'] = !isset($fields['yoga']) ? '0':'1';
        $update_fields['yoga_times'] = $fields['yoga_times'];
        $update_fields['one_on_one_instruction'] = !isset($fields['one_on_one_instruction']) ? '0':'1';
        $update_fields['one_on_one_instruction_times'] = $fields['one_on_one_instruction_times'];

        $update_fields['notes'] = $fields['notes'];
        $update_fields['completed_by'] = $fields['completed_by'];
        $update_fields['date'] = $fields['date_completed'];
        
        $this->db->where('client_id', $fields['client_id']);        
        $this->db->update($this->db_content_table, $update_fields);
        
        return true;
    }

    public function getClientInitialAssessmentByMemberID($client_id){
        $this->db->select('*');
        $this->db->from('clients_initial_assessment');
        $this->db->where('client_id', $client_id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function get_lists(){
        $this->db->select('b.ID, b.title, b.status, b.date_created, b.date_updated, u.first_name');
        $this->db->from('blog b');
        $this->db->join('users u','u.id = b.user_id','inner');
        $this->db->where_in('b.status', array('published','drafted'));
        
        $query = $this->db->get();
        
        return $query->result();
    }        
    
    public function updateStatusKeyVal($update_fields, $fields){
        $client_id = $fields['client_id'];
        $member_id = $fields['member_id'];
        
        $this->removeStatusKeyVal($client_id, $member_id);
        $this->_doLoopStatusKeyVal( $update_fields, $fields );
    }
    
    public function removeStatusKeyVal($client_id, $member_id){
        $this->db->where('m_id', $member_id);
        $this->db->where('client_id', $client_id);
        $this->db->delete($this->db_clients_initial_assessment_table);
        error_log($this->db->affected_rows());
        return $this->db->affected_rows();
    }
    
    public function insertStatusKeyVal( $item ){
        $this->db->insert($this->db_clients_initial_assessment_table, $item);        
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }
    
    public function getCSVQueryExport(){
        $select_fields = $this->_prepareCSVQuerySelectFields();
                
        $query_str = "SELECT c.member_id AS MemberID, c.first_name AS FirstName, c.last_name AS LastName
                        $select_fields
                        FROM `clients_initial_assessment` AS cia
                        INNER JOIN clients AS c ON c.ID = cia.client_id                        
                    ";
        $query = $this->db->query($query_str);
        
        return $query;
    }
    
    private function _doLoopStatusKeyVal( $insert_fields, $fields ){
        $excluded_key = array('member_id','client_id','save');        
        foreach($fields as $key => $val):                                    
            if( !is_array($val) && !in_array($key, $excluded_key) ){                
                $insert_fields['status_field'] = $key;
                $insert_fields['status_value'] = $val;                                                
                $insert_id = $this->insertStatusKeyVal( $insert_fields );
            }else{
                $this->_isArrayStatusVal($key, $val, $insert_fields);
            }             
        endforeach;
        
        return $insert_id;
    }
    
    private function _isArrayStatusVal( $key, $val, $additional = array()){        
        $array_fields = $additional;                
        if( is_array($val) && count($val) > 0 ){              
              foreach($val as $v){
                  $array_fields['status_field'] = $key;
                  $array_fields['status_value'] = $v;
                  
                  $insert_id = $this->insertStatusKeyVal( $array_fields );
              }
              
              return $insert_id;
        }
        
        return false;
    }
    
    private function _prepareCSVQuerySelectFields(){
        $query_fields = array('number_of_days_per_week','proposed_start_date','proposed_end_date','weight_loss','weight_loss_current_level',
                    'weight_loss_expected_outcome','increased_strength','increased_strength_current_level','increased_strength_expected_outcome','increased_wheelchair_mobilization',
                    'increased_wheelchair_mobilization_current_level','increased_wheelchair_mobilization_expected_outcome','increased_self_sufficiency','increased_self_sufficiency_current_level','increased_self_sufficiency_expected_outcome',
                    'increased_socialization','increased_socialization_current_level','increased_socialization_expected_outcome','reduced_hospitalization','reduced_hospitalization_current_level',
                    'reduced_hospitalization_expected_outcome','increased_aerobic_function','increased_aerobic_function_current_level','increased_aerobic_function_expected_outcome','improve_transfer',
                    'improve_transfer_current_level','improve_transfer_expected_outcome','pursue_vocation','pursue_vocation_current_level','pursue_vocation_expected_outcome',
                    'pursue_education','pursue_education_current_level','pursue_education_expected_outcome','increased_self_advocacy','increased_self_advocacy_current_level',
                    'increased_self_advocacy_expected_outcome','acupuncture','acupuncture_times','advocacy','advocacy_times',
                    'aerobics','aerobic_times','art_therapy','art_therapy_times','boxing_fitness',
                    'boxing_fitness_times','cardio_training','cardio_training_times','communications','communications_times',
                    'community_engagement','community_engagement_times','community_services','community_services_times','community_trips',
                    'community_trips_times','computer_class','computer_class_times','cooking_training','cooking_training_times',
                    'counseling_media','counseling_media_times','driving_lessons','driving_lessons_times','fitness_bands',
                    'fitness_bands_times','general_health','general_health_times','hha_training','hha_training_times',
                    'independent_living_skills','independent_living_skills_times','indoor_spinning','indoor_spinning_times','martial_arts',
                    'martial_arts_times','massage','massage_times','motomed','motomed_times',
                    'nutrition','nutrition_times','outdoor_hand_cycling','outdoor_hand_cycling_times','prepared_meals',
                    'prepared_meals_times','rowing','rowing_times','socialization_with_activities','socialization_with_activities_times',
                    'spinal_mobility','spinal_mobility_times','standing_frame','standing_frame_times','vocational_consultation',
                    'vocational_consultation_times','educational_consultation','educational_consultation_times','wheelchair_care','wheelchair_care_times',
                    'wheelchair_loan','wheelchair_loan_times','weight_training','weight_training_times','wheelchair_mobility',
                    'wheelchair_mobility_times','yoga','yoga_times','one_on_one_instruction','one_on_one_instruction_times',
                    'notes','completed_by','date');
        
        $separator = ',';
        $select_field = $separator;
        $count_fields = count($query_fields);
        $ctr = 1;
        
        foreach($query_fields as $qf){
            $select_field .= 'cia.'.$qf;
            
            if($ctr < $count_fields){
                $select_field .= $separator;
            }
            
            $ctr++;
        }
        
        return $select_field;
    }
}

