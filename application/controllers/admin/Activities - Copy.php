<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/activities_model');

        /* Title Page :: Common */
        $this->page_title->push('Activities');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Activities', 'admin/activities');
    }
    
    public function index(){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()){
            redirect('auth/login', 'refresh');
        }else{

            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['activities'] = $this->activities_model->get_lists_daily_activities();                     

            /* Load Template */
            $this->template->admin_render('admin/activities/index', $this->data);
        }
    }
    
    public function create(){

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create', 'admin/activities/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['activities'] = $this->activities_model->get_lists_activities();    

        /* Validate form input */
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[5]|max_length[250]');                
        
        if ( $this->form_validation->run() == true ){
            $activity_id = $this->activities_model->create_activity( $this->input->post() );
            redirect('admin/activities/manage_attendance/'.$activity_id, 'refresh');
        }else{
            $this->data['message'] = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );            
            $this->prepare_form_fields();            
        }
        /* Load Template */
        $this->data['date_now'] = date('Y-m-d');
        $this->template->admin_render('admin/activities/create', $this->data);
    }
    
    public function edit($id){
        $id = (int)$id;        
        
        if ( !$this->ion_auth->logged_in() OR ( !$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)) ){
            redirect('auth', 'refresh');
        }
        
        $activity = $this->activities_model->get_details($id);
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Activity Edit', 'admin/activities/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['activities'] = $this->activities_model->get_lists_activities();    
        $this->data['activity'] = $activity;
        
        /* Validate form input */
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[5]|max_length[250]');
        
        if($this->form_validation->run() == true ){            
            $this->activities_model->update_activity( $this->input->post() );  
            redirect('admin/activities/', 'refresh');            
        }else{
            $this->data['message'] = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );                                
        }
        
        $this->prepare_form_fields($activity);

        /* Load Template */
        $this->template->admin_render('admin/activities/edit', $this->data);
    }
    
    public function delete($id){
        $id = (int)$id;

        $this->load->model('admin/clientactivity_model');
        $this->clientactivity_model->delete_activity($id);
        $this->activities_model->delete($id);
        
        redirect('admin/activities', 'refresh');
    }
    
    private function prepare_form_fields( $content = array() ){        
        
        $this->data['date'] = array(
                    'name'  => 'date',
                    'id'    => 'activity_date',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('date', (is_object($content) ? $content->date : '')),
            );
        
        $this->data['time_start'] = array(
                    'name'  => 'time_start',
                    'id'    => 'time_start',                    
                    'class' => 'form-control timepicker',
                    'placeholder' => 'Time Start',
                    'value' => set_value('time_start', (is_object($content) ? $content->time_start : '')),
            ); 
        
        $this->data['time_end'] = array(
                    'name'  => 'time_end',
                    'id'    => 'time_end',                    
                    'class' => 'form-control timepicker',
                    'placeholder' => 'Time End',
                    'value' => set_value('time_end', (is_object($content) ? $content->time_end : '')),
            );
        
        $this->data['name'] = array(
                    'name'  => 'name',
                    'id'    => 'name',                    
                    'class' => 'form-control',
                    'placeholder' => 'Search Client here...',
                    'value' => set_value('Name', (isset($content->name) ? $content->name : '')),
            );

        $this->data['first_name'] = array(
                    'name'  => 'first_name',
                    'id'    => 'first_name',
                    'required' => 'required',                    
                    'class' => 'form-control',
                    'placeholder' => 'First Name',
                    'value' => set_value('First Name', (isset($content->first_name) ? $content->first_name : '')),
            );

        $this->data['last_name'] = array(
                    'name'  => 'last_name',
                    'id'    => 'last_name',
                    'required' => 'required',                    
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'value' => set_value('Last Name', (isset($content->last_name) ? $content->last_name : '')),
            );

        $this->data['email'] = array(
                    'name'  => 'email',
                    'id'    => 'email',
                    'required' => 'required',                    
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'value' => set_value('Email', (isset($content->email) ? $content->email : '')),
            );

        $this->data['birthdate'] = array(
                    'name'  => 'dob',
                    'id'    => 'birthdate',
                    'type'  => 'text',
                    'placeholder'  => 'E.g. yyyy-mm-dd',
                    'class' => 'form-control datepicker',                    
                    'value' => set_value('Birthdate', (isset($content->dob) ? $content->dob : '')),
            );
        
        $this->data['phone'] = array(
                    'name'  => 'phone',
                    'id'    => 'phone',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Phone',
                    'required' => 'required',
                    'value' => set_value('Phone', (isset($content->phone) ? $content->phone : '')),
            );

        $this->data['ssn'] = array(
                    'name'  => 'ssn',
                    'id'    => 'ssn',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Social Security Number',
                    'value' => set_value('SSN', (isset($content->ssn) ? $content->ssn : '')),
            );

        $this->data['address'] = array(
                    'name'  => 'home_address',
                    'id'    => 'address',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Address',
                    'value' => set_value('Address', (isset($content->address) ? $content->address : '')),
            );

        $this->data['city'] = array(
                    'name'  => 'city',
                    'id'    => 'city',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'City',
                    'value' => set_value('City', (isset($content->city) ? $content->city : '')),
            );

        $this->data['state'] = array(
                    'name'  => 'state',
                    'id'    => 'state',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'State',
                    'value' => set_value('State', (isset($content->state) ? $content->state : '')),
            );

        $this->data['zip'] = array(
                    'name'  => 'zip',
                    'id'    => 'zip',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Zip',
                    'value' => set_value('Zip', (isset($content->zip) ? $content->zip : '')),
            );

        $this->data['message'] = array(
                    'name'  => 'message',
                    'id'    => 'message',                    
                    'class' => 'form-control',
                    'placeholder' => 'Message',
                    'value' => set_value('message', (is_object($content) ? $content->message : '')),
            );
        
    }

    public function manage_attendance($activity_id){
        $activity_id = (int)$activity_id;        
        
        if(!$this->ion_auth->logged_in() OR ( !$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $activity_id))){
            redirect('auth', 'refresh');
        }

        $this->load->model('admin/clients_model');
        $this->load->model('admin/clientActivity_model');
        $this->load->model('admin/clientDemographics_model');

        /* Validate form input */
        $this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[2]|max_length[100]');                
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[2]|max_length[100]');                
        $this->form_validation->set_rules('email', 'Email', 'required');                

        if ( $this->form_validation->run() == true ){

            $client = $this->clientDemographics_model->setClientMemberID();
            $member_id = str_replace("M", "N", $client);
            $generated_client_id = $this->clients_model->create( $this->input->post() , $member_id );

            $this->clientActivity_model->add_client_to_activity($activity_id, $generated_client_id);
            redirect('admin/activities/manage_attendance/'.$activity_id, 'refresh');
        }else{
            $this->data['message'] = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );            
            $this->prepare_form_fields();            
        }

        $attendee_array = array();
        $activities = $this->activities_model->get_details($activity_id);
        $clients = $this->clients_model->get_lists_clients();
        $attendees = $this->clientActivity_model->get_clients_by_activity_id($activity_id);
        foreach($attendees as $a){
            array_push($attendee_array, $a->client_id);
        }

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Activity ', 'admin/activities/manage_attendance');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['clients'] = $clients;
        $this->data['activity_id'] = $activity_id;
        $this->data['attendee_array'] = $attendee_array;
        $this->data['attendees'] = $attendees;
        
        /* Load Template */
        $this->template->admin_render('admin/activities/manage_attendance', $this->data);

    }
    
}

