<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-29
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Demographics extends Admin_Controller {
   
    private $client_object;
    private $action;
    
    public function __construct()
    {
        parent::__construct();
        /* Title Page :: Common */
        $this->page_title->push('Demographics');
        $this->data['pagetitle'] = $this->page_title->show();
        $this->load->model('admin/clientDemographics_model');
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
    
    public function create(){
        /* Breadcrumbs */                
        $this->data['breadcrumb'] = $this->breadcrumbs->show();  
        $clientDemographics = $this->clientDemographics_model;
                
        $this->_prepareDemographicsFormValidation( $this->action ); //form validation and set rules.

        if ($this->form_validation->run() == TRUE){                 
            $this->session->set_flashdata('client_demographics_message', 'New client successfully created.');

            $created_client_id = $clientDemographics->create( $this->input->post() ); 
            
            $log_fields['client_id'] = $created_client_id;            
            $log_fields['client_form_type'] = 'demographics'; 
            $log_fields['form_action'] = 'INSERT';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );
            
            redirect('admin/demographics/edit/'.$created_client_id, 'refresh');                 
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_demographics_message', $errors);                
        }

        $this->_prepareDemographicsFormFields();

        /* Load Template */
        $this->template->admin_render('admin/client_forms/demographics_form', $this->data);             
    }
    
    public function edit( $id = 0 ){
        $clientDemographics = $this->clientDemographics_model;
        
        $client_info = $clientDemographics->get_details( $id );
        $this->data['client_id'] = $client_info->ID;

        $this->_prepareDemographicsFormValidation( $this->action ); //form validation and set rules.

        /* 
         * let's set message variable after redirection of update process, because update needs to refresh page the reason 
         * why it's been redirected to make sure field updates are reflected on page load. 
         */
        if( $this->session->flashdata('client_demographics_message') ){
            $this->data['message'] = $this->session->flashdata('client_demographics_message');
        }

        if ($this->form_validation->run() == TRUE){                                
            $this->session->set_flashdata('client_demographics_message', 'Client demographics information successfully updated.');                
            $clientDemographics->update( $this->input->post() );
            
            $log_fields['client_id'] = $id;            
            $log_fields['client_form_type'] = 'demographics'; 
            $log_fields['form_action'] = 'UPDATE';
            
            $this->clients_model->logClientFormEventHistory( $log_fields );

            redirect('admin/demographics/edit/'.$id, 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('client_demographics_message', $errors);                
        }

        $this->_prepareDemographicsFormFields( $client_info );

        /* Load Template */
        $this->template->admin_render('admin/client_forms/demographics_form', $this->data);
    }
        
    //Custom field validation for Social Security Number.
    public function validate_ssn_regex( $ssn ){
        if( preg_match("/^[0-9\'-]+$/", $ssn) ){
            return true;
        }
        
        if( !empty($ssn) ){
            $this->form_validation->set_message('validate_ssn_regex', 'The Social Security Number should be in valid format (e.g. 143-562-7890).');
        }else{
            $this->form_validation->set_message('validate_ssn_regex', 'The Social Security Number field is required.');
        }
        
        return false;
    }
    
    /* Client Demographics form validation rules */
    private function _prepareDemographicsFormValidation( $action  = '' ){        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[250]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[250]');
        
        if( $action !== 'edit' ){
           $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[clients.email]|max_length[250]'); 
        }else{
           $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|max_length[250]'); 
        }        
        
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|max_length[250]');
        $this->form_validation->set_rules('ssn', 'Social Security Number', 'trim|required|callback_validate_ssn_regex|max_length[250]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|is_numeric');
        $this->form_validation->set_rules('zip', 'ZIP', 'trim|is_numeric|min_length[5]');
    }
    
    private function _prepareDemographicsFormFields( $client_info = '' ){
        $this->client_object = $client_info; //set client query data object.
        
         $this->data['member_id'] = array(
                'name'  => 'member_id',
                'id'    => 'member_id',
                'type'  => 'text',
                'class' => 'form-control',
                'readonly' => 'true',
                'placeholder' => 'Member ID/No.',
                'value' => $this->form_validation->set_value('member_id', $this->_setObjectClientMemberIDHasValue()),
        );
         
        $this->data['is_member'] = array(
                'name'  => 'is_member',
                'id'    => 'is_member',
                'type'  => 'checkbox',                
                'checked' => set_checkbox('is_member', 'M', $this->_fieldIsMemberIfChecked('is_member', 'M'))
        );
        
        $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'First Name',
                'value' => $this->form_validation->set_value('first_name', $this->_setObjectHasValue('first_name')),
        );
        
        $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Last Name',
                'value' => $this->form_validation->set_value('last_name', $this->_setObjectHasValue('last_name')),
        );
        
        $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'email',
                'class' => 'form-control',
                'placeholder' => 'Email',
                'value' => $this->form_validation->set_value('email', $this->_setObjectHasValue('email')),
        );
        
        $this->data['gender_male'] = array(
                'name'  => 'gender',
                'id'    => 'gender_male',                                
                'value' => 'M',
                'checked' => set_radio('gender', 'M', $this->_statusRadioIfChecked( 'gender', 'M' ))
        );
        
        $this->data['gender_female'] = array(
                'name'  => 'gender',
                'id'    => 'gender_female',                                
                'value' => 'F',
                'checked' => set_radio('gender', 'F', $this->_statusRadioIfChecked( 'gender', 'F' ))
        );
        
        $this->data['ssn'] = array(
                'name'  => 'ssn',
                'id'    => 'ssn',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Social Security Number',
                'value' => $this->form_validation->set_value('ssn', $this->_setObjectHasValue('ssn')),
        );
        
        $this->data['dob'] = array(
                'name'  => 'dob',
                'id'    => 'dob',
                'type'  => 'text',
                'class' => 'form-control pull-right',
                'placeholder' => 'e.g. YYYY-MM-DD',
                'value' => $this->form_validation->set_value('dob', $this->_setObjectHasValue('date_of_birth')),
        );
        
        $this->data['home_address'] = array(
                'name'  => 'home_address',
                'id'    => 'home_address',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Home Address',
                'value' => set_value('home_address', $this->_setObjectHasValue('home_address')),
        );
        
        $this->data['city'] = array(
                'name'  => 'city',
                'id'    => 'city',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'City',
                'value' => set_value('city', $this->_setObjectHasValue('city')),
        );
        
        $this->data['state'] = array(
                'name'  => 'state',
                'id'    => 'state',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'State',
                'value' => set_value('state', $this->_setObjectHasValue('state')),
        );
        
        $this->data['zip'] = array(
                'name'  => 'zip',
                'id'    => 'zip',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Zip',
                'value' => set_value('zip', $this->_setObjectHasValue('zip')),
        );
        
        $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Phone',
                'value' => set_value('phone', $this->_setObjectHasValue('phone')),
        );
        
        $this->data['alternative_phone'] = array(
                'name'  => 'alternative_phone',
                'id'    => 'alternative_phone',
                'type'  => 'text',                
                'class' => 'form-control',
                'placeholder' => 'Alternative Phone',
                'value' => set_value('alternative_phone', $this->_setObjectHasValue('alternative_phone')),
        );
        
        //Group radio buttons.
        //this will be our flagger if the block for active fields should be shown.
        $this->data['medicare_eligibility_val'] = ( (is_object($client_info) && $client_info->medicare_eligibility) ? $client_info->medicare_eligibility : $this->input->post('medicare_eligibility') ); 
        $this->data['medicare_eligibility_yes'] = array(
                'name'  => 'medicare_eligibility',
                'id'    => 'medicare_eligibility_yes',                                
                'value' => '1',
                'checked' => set_radio('medicare_eligibility', '1', $this->_statusRadioIfChecked( 'medicare_eligibility', '1' ))
        );
            //If yes was selected for radio medicare_eligibility
            $this->data['medicare_eligibility_active'] = array(
                    'name'  => 'medicare_eligibility_active',
                    'id'    => 'medicare_eligibility_active',                                
                    'value' => '1',
                    'checked' => set_radio('medicare_eligibility_active', '1', $this->_statusRadioIfChecked( 'medicare_eligibility_active', '1' ))
            );        
            $this->data['medicare_eligibility_notactive'] = array(
                    'name'  => 'medicare_eligibility_active',
                    'id'    => 'medicare_eligibility_notactive',                                
                    'value' => '0',
                    'checked' => set_radio('medicare_eligibility_active', '0', $this->_statusRadioIfChecked( 'medicare_eligibility_active', '0' ))
            );
            $this->data['medicare_number'] = array(
                    'name'  => 'medicare_number',
                    'id'    => 'medicare_number',
                    'type'  => 'text',                    
                    'class' => 'form-control',
                    'placeholder' => 'Medicare Number',
                    'value' => set_value('medicare_number', $this->_setObjectHasValue('medicare_number')),
            );
        $this->data['medicare_eligibility_no'] = array(
                'name'  => 'medicare_eligibility',
                'id'    => 'medicare_eligibility_no',                                
                'value' => '0',
                'checked' => set_radio('medicare_eligibility', '0', $this->_statusRadioIfChecked( 'medicare_eligibility', '0' ))
        );
        
        $this->data['medicaid_eligibility_val'] = ( (is_object($client_info) && $client_info->medicaid_eligibility) ? $client_info->medicaid_eligibility : $this->input->post('medicaid_eligibility') ); 
        $this->data['medicaid_eligibility_yes'] = array(
                'name'  => 'medicaid_eligibility',
                'id'    => 'medicaid_eligibility_yes',                                
                'value' => '1',
                'checked' => set_radio('medicaid_eligibility', '1', $this->_statusRadioIfChecked( 'medicaid_eligibility', '1' ))
        );
            $this->data['medicaid_number'] = array(
                    'name'  => 'medicaid_number',
                    'id'    => 'medicaid_number',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Medicaid Number',
                    'value' => set_value('medicaid_number', $this->_setObjectHasValue('medicaid_number')),
            );
        $this->data['medicaid_eligibility_no'] = array(
                'name'  => 'medicaid_eligibility',
                'id'    => 'medicaid_eligibility_no',                                
                'value' => '0',
                'checked' => set_radio('medicaid_eligibility', '0', $this->_statusRadioIfChecked( 'medicaid_eligibility', '0' ))
        );
        
        //Community status radio buttons
        $community_status = array('community' => 'Live in community',
                                  'housing' => 'Transitional Housing',
                                  'nursing' => 'Nursing Home'); 
        $this->data['community_status_radios'] = $community_status;
        foreach($community_status as $key => $val):
            $field_value = strtolower(str_replace(' ', '-', $val));
        
            $this->data['community_status_radio_attr'][$key] = array(
                    'name'  => 'community_status',
                    'id'    => 'community_status_'.$key,                                
                    'value' => $field_value,
                    'checked' => set_radio('community_status', $field_value, $this->_statusRadioIfChecked( 'community_status', $field_value ))
            );
        endforeach;
        
        //Marital status radio buttons
        $marital_status = array('married' => 'Married',
                                'not-married' => 'Not Married',
                                'divorced' => 'Divorced',
                                'separated' => 'Separated'); 
        $this->data['marital_status_radios'] = $marital_status;
        foreach($marital_status as $key => $val):            
            $this->data['marital_status_radio_attr'][$key] = array(
                    'name'  => 'marital_status',
                    'id'    => 'marital_status_'.$key,                                
                    'value' => $key,
                    'checked' => set_radio('marital_status', $key, $this->_statusRadioIfChecked( 'marital_status', $key ))
            );
        endforeach;
        
        //Highest Completed Education radio buttons
        $compeleted_education = array('high-school' => 'High School',
                                'some-college' => 'Some College',
                                'college' => 'College',
                                'graduated' => 'Graduated',
                                'phd' => 'PhD'); 
        $this->data['compeleted_education_radios'] = $compeleted_education;
        foreach($compeleted_education as $key => $val):                    
            $this->data['compeleted_education_radio_attr'][$key] = array(
                    'name'  => 'highest_completed_education',
                    'id'    => 'highest_completed_education_'.$key,                                
                    'value' => $key,
                    'checked' => set_radio('highest_completed_education', $key, $this->_statusRadioIfChecked( 'highest_completed_education', $key ))
            );
        endforeach;
        
        //Type of income radio buttons
        $type_of_income = array('ssi' => 'SSI',
                                'ssdi' => 'SSDI',
                                'other' => 'Other'); 
        $type_of_income_checked = ( (is_object($client_info) && $client_info->type_of_income) ? $client_info->type_of_income : $this->input->post('type_of_income') );         
        $this->data['type_of_income_radios'] = $type_of_income;
        foreach($type_of_income as $key => $val):                    
            $this->data['type_of_income_radio_attr'][$key] = array(
                    'name'  => 'type_of_income',
                    'id'    => 'type_of_income_'.$key,                                
                    'value' => $key,
                    'checked' => set_radio('type_of_income', $key, $this->_statusRadioIfChecked( 'type_of_income', $key ))
            );
        endforeach;
        $this->data['type_of_icome_other_income'] = array(
                    'name'  => 'other_income',
                    'id'    => 'other_income',
                    'type'  => 'text',
                    'class' => 'form-control' . (($type_of_income_checked == 'other') ? '' : ' hidden'),
                    'placeholder' => 'Other Income',
                    'value' => set_value('other_income', $this->_setObjectHasValue('other_income')),
            );
        
        //Employment status radio buttons
        $employment_status = array('1' => 'Employed', '0' => 'Unemployed'); 
        $this->data['employment_status_radios'] = $employment_status;
        
        foreach($employment_status as $key => $val):            
            $this->data['employment_status_radio_attr'][$key] = array(
                    'name'  => 'employment_status',
                    'id'    => 'employment_status_'.$key,                                
                    'value' => $key,
                    'checked' => set_radio('employment_status', $key, $this->_statusRadioIfChecked( 'employment_status', $key ))
            );
        endforeach;
        
        //Internet Access radio buttons
        $internet_access = array('1' => 'Yes', '0' => 'No'); 
        $this->data['internet_access_radios'] = $internet_access;
        foreach($internet_access as $key => $val):             
            $this->data['internet_access_radio_attr'][$key] = array(
                    'name'  => 'internet_access',
                    'id'    => 'internet_access_'.$key,                                
                    'value' => $key,
                    'checked' => set_radio('internet_access', $key, $this->_statusRadioIfChecked( 'internet_access', $key ))
            );
        endforeach;
    }
    
    //Method that will set client radio field(s) status information if checked/selected or not.
    private function _statusRadioIfChecked( $property, $key ){
        return ( (is_object($this->client_object) && !is_null($this->client_object->$property) && $this->client_object->$property == $key ) ? TRUE : FALSE );
    }
    
    private function _fieldIsMemberIfChecked( $property, $key ){
        return ( (is_object($this->client_object) && !is_null($this->client_object->$property) && $this->client_object->$property == $key ) ? TRUE : FALSE );
    }
    
    //Method that will set client text field value if object has value.
    private function _setObjectHasValue( $property ){
        return (is_object($this->client_object) ? $this->client_object->$property : '');
    }
    
    //Method that will set client auto generated member id.
    private function _setObjectClientMemberIDHasValue(){
        $hasMemberID = $this->_setObjectHasValue( 'member_id' );
        if( $hasMemberID ){
            return $hasMemberID;
        }else{
            return $this->clientDemographics_model->setClientMemberID();
        }
    }
}
?>