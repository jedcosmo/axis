<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-29
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends Admin_Controller {
       
    private $client_object;
    private $client_summary;
    private $client_statuses;
    private $action;
    
    public function __construct()
    {
        parent::__construct();
        /* Title Page :: Common */
        $this->page_title->push('Assessment');
        $this->data['pagetitle'] = $this->page_title->show();
        $this->load->model('admin/clientAssessment_model');
        $this->load->model('admin/clients_model');
        
        $this->action = $this->router->method;
        
        $this->data['message'] = '';
        $this->data['post_data'] = '';
        $this->data['page_action'] = $this->action;
        $this->data['page_action_label'] = ucfirst($this->action);        
    }
    
    public function index(){
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();                                

        /* Load Template */
        $this->template->admin_render('admin/client_forms/index', $this->data);
    }
    
    public function create( $member_id = '' ){                                
        $clientAssessment = $this->clientAssessment_model;
        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['member_id'] = $member_id;
        $this->client_summary = $this->clients_model->getClientSummaryDetailsByMemberID( $member_id );
        $client_summary_ID = is_object($this->client_summary) ? $this->client_summary->ID : 0;
        $client_status = $clientAssessment->prepareClientAssessmentStatus($client_summary_ID);
        $this->data['client_id'] = $this->client_summary->ID;
        $this->data['post_assessment'] = $this->input->post();
        $this->_prepareFormValidation( $this->action ); //form validation and set rules.
        
        if( is_object($this->client_summary) && !empty($client_status)){
            redirect('admin/clients', 'refresh');
        }

        if ($this->form_validation->run() == TRUE){                 
            $this->session->set_flashdata('client_assessment_message', 'New client assessment successfully created.');
            
            $clientAssessment->create( $this->input->post() );
            
            $log_fields['client_id'] = $client_summary_ID;            
            $log_fields['client_form_type'] = 'assessment_status'; 
            $log_fields['form_action'] = 'INSERT';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );
            
            redirect('admin/assessment/edit/'.$member_id, 'refresh');                 
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_assessment_message', $errors);                
        }

        $this->_prepareFormFields();

        /* Load Template */
        $this->template->admin_render('admin/client_forms/assessment_form', $this->data);             
    }
    
    public function edit( $member_id = '' ){
        $clientAssessment = $this->clientAssessment_model;
                
        $this->client_summary = $this->clients_model->getClientSummaryDetailsByMemberID( $member_id );
        $client_summary_ID = is_object($this->client_summary) ? $this->client_summary->ID : 0;
        $this->client_statuses = $clientAssessment->prepareClientAssessmentStatus($client_summary_ID);
        $this->data['client_id'] = $client_summary_ID;
        $this->data['member_id'] = $member_id;
        $this->data['post_assessment'] = $this->input->post();

        if( !is_object($this->client_summary) && empty($this->client_statuses)){
            redirect('admin/clients', 'refresh');
        }
                        
        $this->_prepareFormValidation( $this->action ); //form validation and set rules.
        /* 
         * let's set message variable after redirection of update process, because update needs to refresh page the reason 
         * why it's been redirected to make sure field updates are reflected on page load. 
         */       
        if( $this->session->flashdata('client_assessment_message') ){
            $this->data['message'] = $this->session->flashdata('client_assessment_message');
        }

        if ($this->form_validation->run() == TRUE){                                
            $this->session->set_flashdata('client_assessment_message', 'Client assessment status successfully updated.');                
            $clientAssessment->update( $this->input->post() );

            $log_fields['client_id'] = $client_summary_ID;            
            $log_fields['client_form_type'] = 'assessment_status'; 
            $log_fields['form_action'] = 'UPDATE';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );
            
            redirect('admin/assessment/edit/'.$member_id, 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_assessment_message', $errors);                
        }

        $this->_prepareFormFields();

        /* Load Template */
        $this->template->admin_render('admin/client_forms/assessment_form', $this->data);
    }    
    
    /* Client Demographics form validation rules */
    private function _prepareFormValidation( $action  = '' ){        
        $this->form_validation->set_rules('physician_name', 'Physician Name', 'trim|required');
        $this->form_validation->set_rules('office_number', 'Office Number', 'trim|is_numeric'); 
        $this->form_validation->set_rules('physician_order', 'Physician Order', 'trim|required');
        $this->form_validation->set_rules('assessment_reason', 'Assessment Reason', 'trim|required');
    }
    
    private function _prepareFormFields(){ 
        $this->data['member_id'] = array(
                'name'  => 'member_id',
                'id'    => 'member_id',
                'type'  => 'text',
                'class' => 'form-control',
                'readonly' => 'true',
                'placeholder' => 'Member ID/No.',
                'value' => set_value('member_id', $this->_setObjectClientMemberIDHasValue()),
        );        
        
        $this->data['first_name'] = array(                
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',                
                'value' => $this->client_summary->first_name,
        );
        
        $this->data['last_name'] = array(                
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',                
                'value' => $this->client_summary->last_name,
        );
        
        $this->data['physician_name'] = array(
                'name'  => 'physician_name',
                'id'    => 'physician_name',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Physician Name',
                'value' => $this->form_validation->set_value('physician_name', $this->_setObjectClientAssessmentStatus( 'physician_name' )),
        );
        
        $this->data['office_number'] = array(
                'name'  => 'office_number',
                'id'    => 'office_number',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Office Number',
                'value' => $this->form_validation->set_value('office_number', $this->_setObjectClientAssessmentStatus( 'office_number' )),
        );
        
        //Load all client form fields checkboxes and radios...
        foreach($this->client_form_fields['assessment'] as $type => $fields){
            if( $type == 'radio' ){               
                foreach($fields as $field_name => $field){
                    $this->data[$field_name.'_radios'] = $field;                    
                    foreach($field as $fkey => $fval):
                        if( is_int($fkey) ){
                           $this->data[$field_name.'_radio_attr'][$fval['value']] = array(
                                    'name'  => $field_name,
                                    'id'    => $field_name,                                
                                    'value' => $fval['value'],
                                    'checked' => set_radio($field_name, $fval['value'], $this->_statusClientAssessmentRadioIfChecked( $field_name, $fval['value'] ))
                            );                             
                        }else{
                            if( !is_int($fkey) ){
                                foreach($fval as $fv){                                     
                                    $valKey = strtolower(str_replace(array(' ','/'),array('_'),$fkey));
                                    if(is_array($fv)){                                        
                                        $this->data[$field_name.'_radio_attr'][$valKey][$fv['value']] = array(
                                                'name'  => $field_name.'_'.$valKey,
                                                'id'    => $field_name.'_'.$valKey,                                
                                                'value' => $fv['value'],
                                                'checked' => set_radio($field_name.'_'.$valKey, $fv['value'], $this->_statusClientAssessmentRadioIfChecked( $field_name.'_'.$valKey, $fv['value'] ))
                                        );
                                    }                                
                                }                                
                            }                            
                        }                                                
                    endforeach;
                }
            }else if($type == 'checkbox'){                
                foreach($fields as $field_name => $field){
                    $this->data[$field_name.'_checkboxes'] = $field;
                    foreach($field as $fkey => $fval):            
                        $this->data[$field_name.'_checkbox_attr'][$fval['value']] = array(
                                'name'  => $field_name.'[]',
                                'id'    => $field_name,                                
                                'value' => $fval['value'],
                                'checked' => set_checkbox($field_name, $fval['value'], $this->_statusClientAssessmentCheckboxIfChecked( $field_name, $fval['value'] ))
                        );
                    endforeach;                    
                }
            }
        }
        
        $this->data['functional_limitations_notes'] = array(
                'name'  => 'functional_limitations_notes',
                'id'    => 'functional_limitations_notes',                
                'class' => 'form-control',
                'rows' => '3',
                'placeholder' => 'Notes',
                'value' => $this->form_validation->set_value('functional_limitations_notes', $this->_setObjectClientAssessmentStatus( 'functional_limitations_notes' )),
        );
        
        //Type of Allergy
        $this->data['type_of_allergy'] = array(
                'name'  => 'type_of_allergy',
                'id'    => 'type_of_allergy',                
                'class' => 'form-control',
                'type' => 'text',
                'placeholder' => 'Type of Allergy',
                'value' => $this->form_validation->set_value('type_of_allergy', $this->_setObjectClientAssessmentStatus( 'type_of_allergy' )),
        );
        
        $this->data['hospital_visit_related_to_notes'] = array(
                'name'  => 'hospital_visit_related_to_notes',
                'id'    => 'hospital_visit_related_to_notes',                
                'class' => 'form-control',
                'rows' => '3',
                'placeholder' => 'Notes',
                'value' => $this->form_validation->set_value('hospital_visit_related_to_notes', $this->_setObjectClientAssessmentStatus( 'hospital_visit_related_to_notes' )),
        );
        
        $this->data['axis_assesstment_notes'] = array(
                'name'  => 'axis_assesstment_notes',
                'id'    => 'axis_assesstment_notes',                
                'class' => 'form-control',
                'rows' => '3',
                'placeholder' => 'Notes',
                'value' => $this->form_validation->set_value('axis_assesstment_notes', $this->_setObjectClientAssessmentStatus( 'axis_assesstment_notes' )),
        );
    }
    
    //Method that will set client radio field(s) status information if checked/selected or not.
    private function _statusRadioIfChecked( $property, $key ){
        return ( (is_object($this->client_object) && !is_null($this->client_object->$property) && $this->client_object->$property == $key ) ? TRUE : FALSE );
    }
    
    //Method that will set client text field value if object has value.
    private function _setObjectHasValue( $property ){
        return (is_object($this->client_object) ? $this->client_object->$property : '');
    }

    private function _setObjectClientAssessmentStatus( $property ){
        return (is_array($this->client_statuses) && count($this->client_statuses) > 0 && isset($this->client_statuses[$property]) ? $this->client_statuses[$property] : '');
    }
    
    private function _statusClientAssessmentRadioIfChecked( $property, $key ){        
        return ( (is_array($this->client_statuses) && count($this->client_statuses) > 0 && isset($this->client_statuses[$property]) && $this->client_statuses[$property] == $key ) ? TRUE : FALSE );
    }
    
    private function _statusClientAssessmentCheckboxIfChecked( $property, $key ){        
        return ( ( is_array($this->client_statuses) && count($this->client_statuses) > 0 && isset($this->client_statuses[$property]) && (in_array($key, $this->client_statuses[$property]) || $this->client_statuses[$property] == $key) ) ? TRUE : FALSE );
    }
    
    //Method that will set client auto generated member id.
    private function _setObjectClientMemberIDHasValue(){
        $hasMemberID = $this->_setObjectHasValue( 'member_id' );
        if( $hasMemberID ){
            return $hasMemberID;
        }else{
            return (is_object($this->client_summary) ? $this->client_summary->member_id : $hasMemberID);
        }
    }
    
}
?>