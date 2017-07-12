<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function get_file_install()
    {     
        if (file_exists('install.php'))
        {
            $val = '<div class="row">';
            $val.= '<div class="col-md-12">';
            $val.= '<div class="alert alert-danger">';
            $val.= '<h4><i class="icon fa fa-warning"></i>' . lang('actions_security_error') . '</h4>';
            $val.= '<p>' . sprintf(lang('actions_file_install_exist'), '<a href="#" class="btn btn-warning btn-flat btn-xs">' . strtolower(lang('actions_delete')) . '</a>') . '</p>';
            $val.= '</div>';
            $val.= '</div>';
            $val.= '</div>';

            return $val;
        }
    }
    
    public function prepareClientFormFields(){
        $this->db->select('*');
        $this->db->from('client_forms_radio_checkbox_fields');        
        
        $forms_fields = $this->db->get()->result();
        $prepared_form_fields = array();
        
        if( $forms_fields ){
            foreach($forms_fields as $fields){
                if( $fields->field_parent_label == NULL || is_null($fields->field_parent_label) || empty($fields->field_parent_label) ){
                    $prepared_form_fields[$fields->form_type][$fields->field_type][$fields->field_name][$fields->field_id] = array('label' => $fields->field_label,'value' => $fields->field_value);
                }else{
                    $prepared_form_fields[$fields->form_type][$fields->field_type][$fields->field_name][$fields->field_parent_label][$fields->field_id] = array('label' => $fields->field_label,'value' => $fields->field_value);
                }            
            }
        } 
        
        return $prepared_form_fields;
    }
    
    /*
     * @developer: j.dymosco
     * @date: October 13, 2016
     * This method is for development use only, will generate all client form fields checkboxes and radios.
     */
    public function generateClientFormFields(){
        $form_fields = array();
        
        $fields_radios = array('physician_order','assessment_reason','primary_diagnosis','adl_limitations','vision','hearing','nutritional_issues','allergies','recent_hospital_visits','recent_er_visits');
        $fields_checkboxes = array('secondary_diagnosis','physical_limitations','mood_and_behavior','functional_limitations','cognitive_skills','psycho_social_well_being','assistive_services','assistive_devices','hospital_visit_related_to','supervision_and_assisstance');
        
        $form_fields['physician_order'] = array('Yes', 'No');
        $form_fields['assessment_reason'] = array('Initial', 'Follow up');
        $form_fields['primary_diagnosis'] = array('SCI','MS','CP','Spina Bifida','MD','Spinal Stenosis','Post-polio','CVA','Amputations');
        $form_fields['secondary_diagnosis'] = array('HTN','Obesity','Decubitus Ulcers','H/O','DM','Incontinence Bowel','Incontinence Bladder','Constipation','SOB','Fatigue');
        $form_fields['physical_limitations'] = array('Limited ROM','Decreased Strength','Abnormal Vision','Pulmonary Limitations');
        $form_fields['mood_and_behavior'] = array('Made negative statements','Persistent anger with self or with others',
                                   'Expressions including non-verbal of unrealistic fears',
                                   'Repetitive health and anxiety complaints','Sad','Worried','Painful expressions','Crying','Tearfulness',
                                   'Withdrawal from activities','Reduced socialization','Physical abuse','Socially inappropriate','Disruptive behaviors','Tearfulness',
                                   'Inappropriate sexual behavior','Reduced self-care','Self-reported mood changes');
        $form_fields['functional_limitations'] = array('Limited bed mobility','Poor transfers (including toilet)','Poor sitting balance',
                                        'Abnormal posture','Poor standing balance','Poor standing tolerance','Poor balance','History of Falls (freq)','Limited ambulation','Non-ambulatory');    
        $form_fields['cognitive_skills'] = array('Impaired ADL Decision Making','Poor Memory',
                                   'Poor Comprehension',
                                   'Developmental Delay','TBI','Poor Verbal Communication');
        $form_fields['adl_limitations'] = array('Meal Preparation' => array('Can Prepare','Needs Full Assisstance','Self Direct'),
                                 'Chores' => array('Able', 'Unable'),
                                 'Managing Finances' => array('Able', 'Unable'),
                                 'Managing Meds' => array('Able', 'Unable'),
                                 'Phone Use' => array('Able', 'Unable'),
                                 'Computer Use' => array('Able', 'Unable'),
                                 'Shopping' => array('Able', 'Unable'),
                                 'Entering and Exiting the Home' => array('Able', 'Unable'),
                                 'Managing with Transportation/Travel' => array('Able', 'Unable', 'Public', 'Drives'),
                                 'DME Equipment Management' => array('Able', 'Unable'),
                                 'Bathing' => array('Able', 'Unable'),
                                 'Grooming' => array('Able', 'Unable'),
                                 'Dressing' => array('Able', 'Unable')
                            );
        $form_fields['vision'] = array('Able to see in adequate light', 'Minimal', 'Moderate', 'Severe');
        $form_fields['hearing'] = array('Clear Hearing' ,'Minimal', 'Moderate', 'Severe');
        $form_fields['psycho_social_well_being'] = array('Poor relationships with family','Poor social relationships with friends',
                                           'Participation in social activities',
                                           'Open','Fearful','Lonely',
                                           'Reports abusive relationships','Change in social activities',' Length of time alone',
                                           'Life stressor in the last 90 days','Life stressor within last 60 days','Life stressor within last 60 days',
                                           'No stress','Tobacco user','Alcohol abuse','Narcotics abuse');
        $form_fields['nutritional_issues'] = array('Weight loss of 5% 30 days', '10% in the last 180 days', 'Dehydrated');
        $form_fields['allergies'] = array('Yes','No');
        $form_fields['assistive_services'] = array('Home Care','Skilled Nursing','House-keeping','CDPAP');
        $form_fields['assistive_devices'] = array('Manual Chair','Powerchair','Cane',
                                   'Walker','Crutches','Hoyer Lift',
                                   'Commode','Shower Bench','Assistive Technology');
        $form_fields['recent_hospital_visits'] = array('1 within the past 90 days','2 within the past 90 days','3 or more');
        $form_fields['recent_er_visits'] = array('1 within the past 90 days', '2 within the past 90 days', '3 or more');
        $form_fields['hospital_visit_related_to'] = array('Urinary Related','Skin/wound Related','Respiratory Related','Orthopedic Related','Recent surgery');
        $form_fields['supervision_and_assisstance'] = array('Transfers', 'Eating', 'Toileting', 'Transportation assistance');   
        
        $form_fields_authorization['goals'] = array('Weight Loss','Increased Strength','Increased Socialization','Increased Aerobic','Improve Transfer','Increase Wheelchair Mobilization','Reduce Hospitalization','Pursue Education','Pursue Vocation','Increased Self Sufficiency','Increased Self-Advocacy');
        $form_fields_authorization['program_interventions'] = array('Accupuncture','Advocacy','Aerobic Fitness','Art Therapy','Boxing Training','Cardio Training','Community Engagement','Community Services','Community Trips','Computer Class','Cooking Training',
                                                                    'Counseling','Driving Lessons','Fitness Bands','General Health & Preventive Care Class','HHA Training','Independent Living Skills Training','Indoor Spinning','Martial Arts','Massage','Media Communications Training','Motomed',
                                                                    'Nutrition','Outdoor Hand-cycling','Prepared Meals','Rowing','Socialization with Activities','Spinal Mobility','Standing Frame','Support Groups','Vocalization/Educational Training','Weight Training','Wheelchair Care','Wheelchair Mobility','Yoga');
        
        $sub_insert_field = array();
        $insert_field = array();
        
        //echo '******* ASSESSMENT FORM RADIOS AND CHECKBOXES HERE ******* <br />';
        foreach($form_fields as $key => $ff){
            if( in_array($key, $fields_radios) ){
                //echo '******* RADIOS HERE ******* <br />';                
                foreach($ff as $fkey => $f){                    
                    if( !is_array($f) ){
                        $field_lbl = trim($f);
                        $field_value = strtolower(str_replace(array(' ','/'),array('_'),trim($f)));
                        
                        $insert_field['form_type'] = 'assessment';
                        $insert_field['field_type'] = 'radio';
                        $insert_field['field_name'] = $key;
                        $insert_field['field_label'] = $field_lbl;
                        $insert_field['field_value'] = $field_value;
                        
                        //$this->db->insert('client_forms_radio_checkbox_fields', $insert_field);                                                
                    }else{   
                        //echo '******* SUB RADIOS HERE ******* <br />';
                        foreach($f as $opt){                                                                                  
                            $field_lbl = trim($opt);
                            $field_value = strtolower(str_replace(array(' ','/'),array('_'),trim($opt)));

                            $sub_insert_field['form_type'] = 'assessment';
                            $sub_insert_field['field_type'] = 'radio';
                            $sub_insert_field['field_name'] = $key;
                            $sub_insert_field['field_parent_label'] = $fkey;
                            $sub_insert_field['field_label'] = $field_lbl;
                            $sub_insert_field['field_value'] = $field_value;
                                                        
                            //$this->db->insert('client_forms_radio_checkbox_fields', $sub_insert_field);
                        }                        
                    }                    
                }
            }else if(in_array($key, $fields_checkboxes)){
                //echo '******* CHECKBOXES HERE *******<br />';
                foreach($ff as $f){
                    $field_lbl = trim($f);
                    $field_value = strtolower(str_replace(array(' ','/'),array('_'),trim($f)));
                    
                    $insert_field['form_type'] = 'assessment';
                    $insert_field['field_type'] = 'checkbox';
                    $insert_field['field_name'] = $key;
                    $insert_field['field_label'] = $field_lbl;
                    $insert_field['field_value'] = $field_value;

                    //$this->db->insert('client_forms_radio_checkbox_fields', $insert_field);
                }
            }
        }
        
        //echo '******* AUTHORIZATION REQUEST FORM CHECKBOXES HERE ******* <br />';
        unset($insert_field);
        foreach($form_fields_authorization as $key => $ffa){
            foreach($ffa as $fa){
                $field_lbl = trim($fa);
                $field_value = strtolower(str_replace(array(' ','/'),array('_'),trim($fa)));

                $insert_field['form_type'] = 'authorization_request';
                $insert_field['field_type'] = 'checkbox';
                $insert_field['field_name'] = $key;
                $insert_field['field_label'] = $field_lbl;
                $insert_field['field_value'] = $field_value;

                //$this->db->insert('client_forms_radio_checkbox_fields', $insert_field);
            }
        }
    }
}
