<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/events_model');        
        
        /* Title Page :: Common */
        $this->page_title->push('Events');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Events', 'admin/events');
    }
    
    public function index(){        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();            
        $this->data['events'] = $this->events_model->get_lists_events();            

        /* Load Template */
        $this->template->admin_render('admin/events/index', $this->data);        
    }
    
    public function create(){
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create', 'admin/events/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[10]|max_length[250]');                
        
        if ( $this->form_validation->run() == true )
        {
            $this->events_model->create_event( $this->input->post() );

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/events/create', 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        
            $this->prepare_form_fields();            
        }
        
        /* Load Template */
        $this->template->admin_render('admin/events/create', $this->data);
    }
    
    public function edit( $id ){
        $id = (int)$id;        
                
        $event = $this->events_model->get_details( $id );
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Event Edit', 'admin/event/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['event'] = $event;
        
        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[10]|max_length[250]');
        
        if ( $this->form_validation->run() == true )
        {            
            $this->events_model->update_event( $this->input->post() );

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/events/edit/'.$id, 'refresh');            
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        }
        
        $this->prepare_form_fields( $event );
        $this->data['preview_featured_img'] = array('src' => $event->featured_img, 'width' => '300', 'height' => '300');
        $this->data['btn_upload_label'] = (!empty($event->featured_img) ? 'Change Image' : 'Upload Image');
        /* Load Template */
        $this->template->admin_render('admin/events/edit', $this->data);
    }
    
    public function action( $type, $id ){
        $id = (int)$id;
        if( !empty($type) ){
            $this->events_model->do_action( $type, $id );
        }
        
        redirect('admin/events', 'refresh');
    }
    
    private function prepare_form_fields( $content = array() ){        
        
        $this->data['content_title'] = array(
                    'name'  => 'content_title',
                    'id'    => 'content_title',
                    'type'  => 'text',
                    'class' => 'form-control page_name',
                    'placeholder' => 'Title',
                    'value' => $this->form_validation->set_value('content_title', (is_object($content) ? $content->title : '')),
            );
        
        $this->data['excerpt'] = array(
                    'name'  => 'excerpt',
                    'id'    => 'excerpt',                    
                    'class' => 'form-excerpt-textarea',
                    'placeholder' => 'Excerpt',
                    'value' => set_value('excerpt', (is_object($content) ? $content->excerpt : '')),
            ); 
        
        $this->data['content'] = array(
                    'name'  => 'content',
                    'id'    => 'editor_NO',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content', (is_object($content) ? $content->content : ''))),
            );
        
        $this->data['venue'] = array(
                    'name'  => 'venue',
                    'id'    => 'venue',
                    'type'  => 'text',
                    'class' => 'form-control page_name',
                    'placeholder' => 'Venue',
                    'value' => $this->form_validation->set_value('venue', (is_object($content) ? $content->venue : '')),
            );
        
        $this->data['start_date'] = array(
                    'name'  => 'start_date',
                    'id'    => 'start_datepicker',
                    'type'  => 'text',
                    'class' => 'form-control pull-right',                    
                    'value' => $this->form_validation->set_value('start_date', (is_object($content) ? $content->start_date : '')),
            );
        
        $this->data['end_date'] = array(
                    'name'  => 'end_date',
                    'id'    => 'end_datepicker',
                    'type'  => 'text',
                    'class' => 'form-control pull-right',                    
                    'value' => $this->form_validation->set_value('end_date', (is_object($content) ? $content->end_date : '')),
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
        
        $this->data['meta_title'] = array(
                    'name'  => 'meta_title',
                    'id'    => 'meta_title',                    
                    'class' => 'form-meta-textarea',
                    'placeholder' => 'Meta Title',
                    'value' => set_value('meta_title', (isset($content->meta_title) ? $content->meta_title : '')),
            );
        
        $this->data['meta_keyword'] = array(
                    'name'  => 'meta_keyword',
                    'id'    => 'meta_keyword',                    
                    'class' => 'form-meta-textarea',
                    'placeholder' => 'Meta Keyword',
                    'value' => set_value('meta_keyword', (isset($content->meta_keyword) ? $content->meta_keyword : '')),
            );
        
        $this->data['meta_description'] = array(
                    'name'  => 'meta_description',
                    'id'    => 'meta_description',                    
                    'class' => 'form-meta-textarea',
                    'placeholder' => 'Meta Description',
                    'value' => set_value('meta_description', (isset($content->meta_description) ? $content->meta_description : '')),
            );
    }

    public function manage_attendance($event_id){
        $event_id = (int)$event_id;        
        
        if(!$this->ion_auth->logged_in() OR ( !$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $event_id))){
            redirect('auth', 'refresh');
        }

        /* Validate form input */
        $this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[2]|max_length[100]');                
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[2]|max_length[100]');                
        $this->form_validation->set_rules('email', 'Email', 'required');                
        
        if ( $this->form_validation->run() == true ){
            $this->load->model('admin/clients_model');
            $this->load->model('admin/clientEvent_model');
            $this->load->model('admin/clientDemographics_model');

            $client = $this->clientDemographics_model->setClientMemberID();
            $member_id = str_replace("M", "N", $client);
            $generated_client_id = $this->clients_model->create( $this->input->post() , $member_id );

            $this->clientEvent_model->add_client_to_event($event_id, $generated_client_id);
            redirect('admin/events/manage_attendance/'.$event_id, 'refresh');
        }else{
            $this->data['message'] = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );            
            $this->prepare_form_fields();            
        }

        $this->load->model('admin/clients_model');
        $this->load->model('admin/clientEvent_model');        

        $attendee_array = array();
        $events = $this->events_model->get_details($event_id);
        $clients = $this->clients_model->get_lists_clients();
        $attendees = $this->clientEvent_model->get_clients_by_event_id($event_id);
        foreach($attendees as $a){
            array_push($attendee_array, $a->client_id);
        }

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Events ', 'admin/events/manage_attendance');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['clients'] = $clients;
        $this->data['event_id'] = $event_id;
        $this->data['attendee_array'] = $attendee_array;
        $this->data['attendees'] = $attendees;
        
        /* Load Template */
        $this->template->admin_render('admin/events/manage_attendance', $this->data);

    }
}

