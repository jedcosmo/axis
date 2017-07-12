<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-10-13
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class authorizationRequest extends Admin_Controller {
    
    private $client_object;
    private $client_summary;
    private $client_authorization;
    private $action;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/clients_model');
        $this->load->model('admin/clientAuthorizationRequest_model');
        
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
        $clientAuthReq = $this->clientAuthorizationRequest_model;
        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['member_id'] = $member_id;
        $this->client_summary = $this->clients_model->getClientSummaryDetailsByMemberID( $member_id );
        $client_summary_ID = is_object($this->client_summary) ? $this->client_summary->ID : 0;
        $client_authorization = $clientAuthReq->prepareClientauthorizationRequests($client_summary_ID);
        $this->data['client_id'] = $this->client_summary->ID;
        $this->data['post_assessment'] = $this->input->post();
        $this->_prepareFormValidation( $this->action ); //form validation and set rules.
        
        if( is_object($this->client_summary) && !empty($client_authorization)){
            redirect('admin/clients', 'refresh');
        }

        if ($this->form_validation->run() == TRUE){                 
            $this->session->set_flashdata('client_authorization_message', 'New client authorization requests successfully created.');
            
            $clientAuthReq->create( $this->input->post() );
            
            $log_fields['client_id'] = $client_summary_ID;            
            $log_fields['client_form_type'] = 'authorization_requests'; 
            $log_fields['form_action'] = 'INSERT';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );
            
            redirect('admin/authorizationRequest/edit/'.$member_id, 'refresh');                 
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_authorization_message', $errors);                
        }

        $this->_prepareFormFields();

        /* Load Template */
        $this->template->admin_render('admin/client_forms/authorization_request_form', $this->data);             
    }
    
    public function edit( $member_id = '' ){
        $clientAuthReq = $this->clientAuthorizationRequest_model;
                
        $this->client_summary = $this->clients_model->getClientSummaryDetailsByMemberID( $member_id );
        $client_summary_ID = is_object($this->client_summary) ? $this->client_summary->ID : 0;
        $this->client_authorization = $clientAuthReq->prepareClientauthorizationRequests($client_summary_ID);
        $this->data['client_id'] = $client_summary_ID;
        $this->data['member_id'] = $member_id;
        $this->data['post_assessment'] = $this->input->post();

        if( !is_object($this->client_summary) && empty($this->client_authorization)){
            redirect('admin/clients', 'refresh');
        }
                        
        $this->_prepareFormValidation( $this->action ); //form validation and set rules.
        /* 
         * let's set message variable after redirection of update process, because update needs to refresh page the reason 
         * why it's been redirected to make sure field updates are reflected on page load. 
         */       
        if( $this->session->flashdata('client_authorization_message') ){
            $this->data['message'] = $this->session->flashdata('client_authorization_message');
        }

        if ($this->form_validation->run() == TRUE){                                
            $this->session->set_flashdata('client_authorization_message', 'Client authorization requests successfully updated.');                
            $clientAuthReq->update( $this->input->post() );
            
            $log_fields['client_id'] = $client_summary_ID;            
            $log_fields['client_form_type'] = 'authorization_requests'; 
            $log_fields['form_action'] = 'UPDATE';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );
            
            redirect('admin/authorizationRequest/edit/'.$member_id, 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_authorization_message', $errors);                
        }

        $this->_prepareFormFields();

        /* Load Template */
        $this->template->admin_render('admin/client_forms/authorization_request_form', $this->data);
    }
    
    private function _prepareFormValidation( $action  = '' ){        
        $this->form_validation->set_rules('goals[]', 'Goals', 'trim|required');        
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
        
        
        //Load all client form fields checkboxes and radios...
        foreach($this->client_form_fields['authorization_request'] as $type => $fields){
            if($type == 'checkbox'){                
                foreach($fields as $field_name => $field){
                    $this->data[$field_name.'_checkboxes'] = $field;
                    foreach($field as $fkey => $fval):            
                        $this->data[$field_name.'_checkbox_attr'][$fval['value']] = array(
                                'name'  => $field_name.'[]',
                                'id'    => $field_name,                                
                                'value' => $fval['value'],
                                'checked' => set_checkbox($field_name, $fval['value'], $this->_statusClientAuthorizationCheckboxIfChecked( $field_name, $fval['value'] ))
                        );
                    endforeach;                    
                }
            }
        }
    }
    
    //Method that will set client text field value if object has value.
    private function _setObjectHasValue( $property ){
        return (is_object($this->client_object) ? $this->client_object->$property : '');
    }
    
    private function _statusClientAuthorizationCheckboxIfChecked( $property, $key ){              
        return ( ( is_array($this->client_authorization) && count($this->client_authorization) > 0 && isset($this->client_authorization[$property]) && (in_array($key, $this->client_authorization[$property]) || $this->client_authorization[$property] == $key) ) ? TRUE : FALSE );
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

