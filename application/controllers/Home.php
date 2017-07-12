<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/pages_model');
        $this->load->model('admin/programs_model');
        $this->load->model('admin/blog_model');
        $this->load->model('admin/events_model');
        $this->load->model('admin/activities_model');
        $this->load->model('admin/team_model');
        $this->load->model('admin/clientDemographics_model');
        $this->load->model('admin/clients_model');
        $this->load->model('admin/clientEvent_model');
        $this->load->model('admin/products_model');
        $this->load->model('admin/stories_model');
        $this->load->model('admin/contact_model');
        $this->load->model('admin/general_model');
        $this->load->model('admin/team_model');

        $this->data['general'] = $this->general_model->get_details();
        $this->prepare_form_fields();

        $this->data['toggleForm'] = "none";
        $this->data['join_form_content'] = $this->pages_model->get_details(21);

        if($this->input->post('submit') == "member_form"){
            $this->form_validation->set_rules('member_first_name', 'First Name', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('member_last_name', 'Last Name', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('member_email', 'Email', 'trim|required|valid_email|min_length[3]|max_length[250]');
            //$this->form_validation->set_rules('member_dob', 'Date of Birth', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('member_phone', 'Phone', 'trim|required|numeric|min_length[3]|max_length[250]');

            if($this->form_validation->run() == true ){
                $client = $this->clientDemographics_model->setClientMemberID();
                $member_id = str_replace("M", "N", $client);

                $this->clients_model->create_member( $this->input->post() , $member_id );

                $this->send_mail('member_form', $this->input->post() );

                $this->session->set_flashdata('member_form_message', 'Thank You! We will contact you shortly.');
                $this->resert_form_fields();    
            }else{
                $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
                $this->session->set_flashdata('member_form_message', $errors);                
                $this->prepare_form_fields();
            }

            $this->data['toggleForm'] = "block";
        }

        if($this->input->post('submit') == "volunteer_form"){
            $this->form_validation->set_rules('volunteer_first_name', 'First Name', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('volunteer_last_name', 'Last Name', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('volunteer_email', 'Email', 'trim|required|valid_email|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('volunteer_dob', 'Date of Birth', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('volunteer_phone', 'Phone', 'trim|numeric|min_length[3]|max_length[250]');

            if($this->form_validation->run() == true ){
                $client = $this->clientDemographics_model->setClientMemberID();
                $member_id = str_replace("M", "N", $client);

                $this->clients_model->create_volunteer( $this->input->post() , $member_id );

                $this->send_mail('volunteer_form', $this->input->post() );

                $this->session->set_flashdata('volunteer_form_message', 'Thank You! We will contact you shortly.');
                $this->resert_form_fields();    
            }else{
                $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
                $this->session->set_flashdata('volunteer_form_message', $errors);                
                $this->prepare_form_fields();
            }

            $this->data['toggleForm'] = "block";
        }

    }


	public function index(){

		$this->data['page'] = "home";
		$this->data['content'] = $this->pages_model->get_details(9);
		$this->data['programs'] = $this->programs_model->get_lists_programs();
		$this->data['blogs'] = $this->blog_model->get_lists_blog();
		$this->data['events'] = $this->events_model->get_lists_events();
        $this->data['daily'] = $this->activities_model->get_todays_activities();

		$this->load->view('public/_templates/home_header', $this->data);
		$this->load->view('public/home', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function programs(){	

		$this->data['page'] = "programs";
		$this->data['content'] = $this->pages_model->get_details(10);
		$this->data['programs'] = $this->programs_model->get_lists_programs();

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/programs', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

    public function program($uri){    

        $this->data['page'] = "programs";
        $this->data['content'] = $this->pages_model->get_details(15);
        $this->data['program'] = $this->programs_model->get_details_by_uri($uri);

        $this->load->view('public/_templates/page_header', $this->data);
        $this->load->view('public/program', $this->data);
        $this->load->view('public/_templates/footer', $this->data);
    }

	public function about(){	

		$this->data['page'] = "about";
		$this->data['content'] = $this->pages_model->get_details(11);
        $this->data['team'] = $this->team_model->get_lists_team();

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/about', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

    public function team($uri){    

        $this->data['page'] = "team";
        $this->data['content'] = $this->pages_model->get_details(11);
        $this->data['team'] = $this->team_model->get_details_by_uri($uri);

        $this->load->view('public/_templates/page_header', $this->data);
        $this->load->view('public/team', $this->data);
        $this->load->view('public/_templates/footer', $this->data);
    }

	public function calendar(){	
	
		$this->data['page'] = "calendar";
		$this->data['content'] = $this->pages_model->get_details(12);
		$this->data['daily'] = $this->activities_model->get_todays_activities();
		$this->data['events'] = $this->events_model->get_lists_events();

        $monday = date('Y-m-d',strtotime('monday this week'));
        $tuesday = date('Y-m-d',strtotime('tuesday this week'));
        $wednesday = date('Y-m-d',strtotime('wednesday this week'));
        $thursday = date('Y-m-d',strtotime('thursday this week'));
        $friday = date('Y-m-d',strtotime('friday this week'));
        $saturday = date('Y-m-d',strtotime('saturday this week'));

        $next_mon = strtotime('next monday'); $next_monday = date('Y-m-d', $next_mon);
        $next_tue = strtotime('next tuesday'); $next_tuesday = date('Y-m-d', $next_tue);
        $next_wed = strtotime('next wednesday'); $next_wednesday = date('Y-m-d', $next_wed);
        $next_thu = strtotime('next thursday'); $next_thursday = date('Y-m-d', $next_thu);
        $next_fri = strtotime('next friday'); $next_friday = date('Y-m-d', $next_fri);
        $next_sat = strtotime('next saturday + 1 week'); $next_saturday = date('Y-m-d', $next_sat);

        $this->data['monday'] = date('m / d',strtotime($monday));
        $this->data['saturday'] = date('m / d',strtotime($saturday));
        $this->data['next_monday'] = date('m / d',strtotime($next_monday));
        $this->data['next_saturday'] = date('m / d',strtotime($next_saturday));

        $this->data['monday_activities'] = $this->activities_model->get_activities_by_date($monday);
        $this->data['tuesday_activities'] = $this->activities_model->get_activities_by_date($tuesday);
        $this->data['wednesday_activities'] = $this->activities_model->get_activities_by_date($wednesday);
        $this->data['thursday_activities'] = $this->activities_model->get_activities_by_date($thursday);
        $this->data['friday_activities'] = $this->activities_model->get_activities_by_date($friday);
        $this->data['saturday_activities'] = $this->activities_model->get_activities_by_date($saturday);

        $this->data['next_monday_activities'] = $this->activities_model->get_activities_by_date($next_monday);
        $this->data['next_tuesday_activities'] = $this->activities_model->get_activities_by_date($next_tuesday);
        $this->data['next_wednesday_activities'] = $this->activities_model->get_activities_by_date($next_wednesday);
        $this->data['next_thursday_activities'] = $this->activities_model->get_activities_by_date($next_thursday);
        $this->data['next_friday_activities'] = $this->activities_model->get_activities_by_date($next_friday);
        $this->data['next_saturday_activities'] = $this->activities_model->get_activities_by_date($next_saturday);

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/calendar', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function activities($date){	
	
		$this->data['page'] = "calendar";
		$this->data['content'] = $this->pages_model->get_details(12);
		$this->data['activities'] = $this->activities_model->get_activities_by_date($date);
		$this->data['date'] = $date;

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/activities', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function event($uri){	

		$this->data['page'] = "calendar";
		$this->data['content'] = $this->pages_model->get_details(12);
		$this->data['events'] = $this->events_model->get_details_by_uri($uri);

        $event_detail = $this->events_model->get_details_by_uri($uri);

        $this->session->unset_userdata('message');                            

        if($this->input->post('submit') == "event_form"){
    		/* Validate form input */
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('number_of_guests', 'Number of Guests', 'trim|numeric|min_length[1]|max_length[250]');

            if ( $this->form_validation->run() == true ){

                $client = $this->clientDemographics_model->setClientMemberID();
                $member_id = str_replace("M", "N", $client);

                $generated_client_id = $this->clients_model->create( $this->input->post() , $member_id );
                $client_event_id = $this->clientEvent_model->add_client_to_event($event_detail->ID, $generated_client_id);
                $this->clientEvent_model->add_number_of_guests($client_event_id, $this->input->post());

                $this->send_mail('event', $this->input->post() );

                $this->session->set_flashdata('message', 'Thank You! We will contact you shortly.');
                $this->resert_form_fields();    
            }else{
                $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
                $this->session->set_flashdata('message', $errors);                
                $this->prepare_form_fields();
            }
        }

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/event', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function shop(){	

		$this->data['page'] = "shop";
		$this->data['content'] = $this->pages_model->get_details(13);
		$this->data['products'] = $this->products_model->get_lists_products();

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/shop', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function client_profiles(){	

		$this->data['page'] = "client_profiles";
		$this->data['content'] = $this->pages_model->get_details(14);
		$this->data['stories'] = $this->stories_model->get_lists_stories();
		$this->data['featured'] = $this->stories_model->find_featured();

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/client_profiles', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function story($uri){	
	
		$this->data['page'] = "client_profiles";
		$this->data['content'] = $this->pages_model->get_details(14);
		$this->data['stories'] = $this->stories_model->get_lists_stories();
		$this->data['story'] = $this->stories_model->get_details_by_uri($uri);

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/story', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function blogs(){	

		$this->data['page'] = "blogs";
		$this->data['content'] = $this->pages_model->get_details(15);
		$this->data['blogs'] = $this->blog_model->get_lists_blog();

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/blogs', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

    public function blog($uri){    

        $this->data['page'] = "blogs";
        $this->data['content'] = $this->pages_model->get_details(15);
        $this->data['blog'] = $this->blog_model->get_details_by_uri($uri);

        $this->load->view('public/_templates/page_header', $this->data);
        $this->load->view('public/blog', $this->data);
        $this->load->view('public/_templates/footer', $this->data);
    }

	public function contact(){	

		$this->data['page'] = "contact";
		$this->data['content'] = $this->pages_model->get_details(16);

        if($this->input->post('submit') == "contact_form"){
    		/* Validate form input */
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[250]');                
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[250]');                
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_numeric|min_length[3]|max_length[250]');                
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|min_length[3]|max_length[250]');    
            $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[10]|max_length[250]');    
            //$this->form_validation->set_rules('reason[]', 'Select at least one reason why you are contacting us', 'required');

            $this->session->unset_userdata('message');                            

    		if ( $this->form_validation->run() == true ){
                $this->contact_model->create_contact( $this->input->post() );

                $this->send_mail('contact', $this->input->post() );

                $this->session->set_flashdata('contact_message', 'Thank You! We will contact you shortly.');
                $this->resert_form_fields();            
            }else{
                $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
                $this->session->set_flashdata('contact_message', $errors);                
                $this->prepare_form_fields();            
            }
        }

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/contact', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

	public function get_involved(){	

        $this->data['page'] = "get_involved";
		$this->data['content'] = $this->pages_model->get_details(17);

		$this->load->view('public/_templates/page_header', $this->data);
		$this->load->view('public/get_involved', $this->data);
		$this->load->view('public/_templates/footer', $this->data);
	}

    public function join_us(){ 

        $this->data['content'] = $this->pages_model->get_details(21);

        /* Validate form input */
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('ssn', 'Social Security Number', 'trim|max_length[250]');
        $this->form_validation->set_rules('home_address', 'Home Address', 'trim|max_length[250]');
        $this->form_validation->set_rules('city', 'City', 'trim|max_length[250]');
        $this->form_validation->set_rules('state', 'State', 'trim|max_length[250]');
        $this->form_validation->set_rules('zip', 'Zip', 'trim|numeric|max_length[250]');

        $this->session->unset_userdata('message');   

        if ( $this->form_validation->run() == true ){
            $client = $this->clientDemographics_model->setClientMemberID();
            $member_id = str_replace("M", "N", $client);

            $this->clients_model->create( $this->input->post() , $member_id );

            $this->send_mail('join', $this->input->post() );

            $this->session->set_flashdata('message', 'Thank You! We will contact you shortly.');
            $this->resert_form_fields();    
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);                
            $this->prepare_form_fields();          
        }

        $this->load->view('public/_templates/page_header', $this->data);
        $this->load->view('public/join_us', $this->data);
        $this->load->view('public/_templates/footer', $this->data);
    }

	private function prepare_form_fields( $content = array() ){
        
        $this->data['first_name'] = array(
                    'name'  => 'first_name',
                    'id'    => 'first_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'First Name',
                    'value' => $this->form_validation->set_value('first_name', (is_object($content) ? $content->first_name : '')),
            );

        $this->data['last_name'] = array(
                    'name'  => 'last_name',
                    'id'    => 'last_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'value' => $this->form_validation->set_value('last_name', (is_object($content) ? $content->last_name : '')),
            );
        
        $this->data['birthdate'] = array(
                    'name'  => 'dob',
                    'id'    => 'birthdate',
                    'type'  => 'text',
                    'placeholder'  => 'E.g. yyyy-mm-dd',
                    'class' => 'form-control datepicker',                    
                    'value' => $this->form_validation->set_value('dob', (is_object($content) ? $content->dob : '')),
            );

        $this->data['email'] = array(
                    'name'  => 'email',
                    'id'    => 'mail',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'value' => $this->form_validation->set_value('email', (is_object($content) ? $content->email : '')),
            );
        
        $this->data['phone'] = array(
                    'name'  => 'phone',
                    'id'    => 'phone',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Phone',
                    'value' => $this->form_validation->set_value('phone', (is_object($content) ? $content->phone : '')),
            );

        $this->data['ssn'] = array(
                    'name'  => 'ssn',
                    'id'    => 'ssn',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Social Security Number',
                    'value' => $this->form_validation->set_value('ssn', (is_object($content) ? $content->sss : '')),
            );

        $this->data['address'] = array(
                    'name'  => 'home_address',
                    'id'    => 'address',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Address',
                    'value' => $this->form_validation->set_value('home_address', (is_object($content) ? $content->home_address : '')),
            );

        $this->data['city'] = array(
                    'name'  => 'city',
                    'id'    => 'city',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'City',
                    'value' => $this->form_validation->set_value('city', (is_object($content) ? $content->city : '')),
            );

        $this->data['state'] = array(
                    'name'  => 'state',
                    'id'    => 'state',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'State',
                    'value' => $this->form_validation->set_value('state', (is_object($content) ? $content->state : '')),
            );

        $this->data['zip'] = array(
                    'name'  => 'zip',
                    'id'    => 'zip',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Zip',
                    'value' => $this->form_validation->set_value('zip', (is_object($content) ? $content->zip : '')),
            );

         $this->data['number_of_guests'] = array(
                    'name'  => 'number_of_guests',
                    'id'    => 'number_of_guests',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Number of Guests',
                    'value' => $this->form_validation->set_value('number_of_guests', (is_object($content) ? $content->number_of_guests : '')),
            );

       	$this->data['message'] = array(
                    'name'  => 'message',
                    'id'    => 'message',                    
                    'class' => 'form-control',
                    'placeholder' => 'Message',
                    'value' => set_value('message', (is_object($content) ? $content->message : '')),
            ); 

        $this->data['member_first_name'] = array(
                    'name'  => 'member_first_name',
                    'id'    => 'member_first_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'First Name',
                    'value' => $this->form_validation->set_value('member_first_name', (is_object($content) ? $content->member_first_name : '')),
            );

        $this->data['member_last_name'] = array(
                    'name'  => 'member_last_name',
                    'id'    => 'member_last_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'value' => $this->form_validation->set_value('member_last_name', (is_object($content) ? $content->member_last_name : '')),
            );
        
        $this->data['member_birthdate'] = array(
                    'name'  => 'member_dob',
                    'id'    => 'member_birthdate',
                    'type'  => 'text',
                    'placeholder'  => 'E.g. yyyy-mm-dd',
                    'class' => 'form-control datepicker',                    
                    'value' => $this->form_validation->set_value('member_dob', (is_object($content) ? $content->member_dob : '')),
            );

        $this->data['member_email'] = array(
                    'name'  => 'member_email',
                    'id'    => 'member_email',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'value' => $this->form_validation->set_value('member_email', (is_object($content) ? $content->member_email : '')),
            );
        
        $this->data['member_phone'] = array(
                    'name'  => 'member_phone',
                    'id'    => 'member_phone',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Phone',
                    'value' => $this->form_validation->set_value('member_phone', (is_object($content) ? $content->member_phone : '')),
            );

        $this->data['member_address'] = array(
                    'name'  => 'member_address',
                    'id'    => 'address',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Address',
                    'value' => $this->form_validation->set_value('member_address', (is_object($content) ? $content->member_address : '')),
            );

        $this->data['member_city'] = array(
                    'name'  => 'member_city',
                    'id'    => 'member_city',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'City',
                    'value' => $this->form_validation->set_value('member_city', (is_object($content) ? $content->member_city : '')),
            );

        $this->data['member_state'] = array(
                    'name'  => 'member_state',
                    'id'    => 'member_state',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'State',
                    'value' => $this->form_validation->set_value('member_state', (is_object($content) ? $content->member_state : '')),
            );

        $this->data['member_zip'] = array(
                    'name'  => 'member_zip',
                    'id'    => 'member_zip',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Zip',
                    'value' => $this->form_validation->set_value('member_zip', (is_object($content) ? $content->member_zip : '')),
            );

        $this->data['volunteer_first_name'] = array(
                    'name'  => 'volunteer_first_name',
                    'id'    => 'volunteer_first_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'First Name',
                    'value' => $this->form_validation->set_value('volunteer_first_name', (is_object($content) ? $content->volunteer_first_name : '')),
            );

        $this->data['volunteer_last_name'] = array(
                    'name'  => 'volunteer_last_name',
                    'id'    => 'volunteer_last_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'value' => $this->form_validation->set_value('volunteer_last_name', (is_object($content) ? $content->volunteer_last_name : '')),
            );
        
        $this->data['volunteer_birthdate'] = array(
                    'name'  => 'volunteer_dob',
                    'id'    => 'volunteer_birthdate',
                    'type'  => 'text',
                    'placeholder'  => 'E.g. yyyy-mm-dd',
                    'class' => 'form-control datepicker',                    
                    'value' => $this->form_validation->set_value('volunteer_dob', (is_object($content) ? $content->volunteer_dob : '')),
            );

        $this->data['volunteer_email'] = array(
                    'name'  => 'volunteer_email',
                    'id'    => 'volunteer_email',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'value' => $this->form_validation->set_value('volunteer_email', (is_object($content) ? $content->volunteer_email : '')),
            );
        
        $this->data['volunteer_phone'] = array(
                    'name'  => 'volunteer_phone',
                    'id'    => 'volunteer_phone',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Phone',
                    'value' => $this->form_validation->set_value('volunteer_phone', (is_object($content) ? $content->volunteer_phone : '')),
            );
        /*
       	$this->data['is_volunteer'] = array(
                'name'  => 'volunteer',
                'id'    => 'volunteer',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('is_volunteer', '1', FALSE)
        );

        $this->data['need_help'] = array(
                'name'  => 'need_help',
                'id'    => 'need_help',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('need_help', '1', FALSE)
        );

        $this->data['wheelchair_problem'] = array(
                'name'  => 'wheelchair_problem',
                'id'    => 'wheelchair_problem',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('wheelchair_problem', '1', FALSE)
        );

        $this->data['other'] = array(
                'name'  => 'other',
                'id'    => 'other',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('other', '1', FALSE)
        );
        */
    }

    private function resert_form_fields( $content = array() ){        
        
        $this->data['first_name'] = array(
                    'name'  => 'first_name',
                    'id'    => 'first_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'First Name',
                    'required' => 'required',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->first_name : '')),
            );

        $this->data['last_name'] = array(
                    'name'  => 'last_name',
                    'id'    => 'last_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'required' => 'required',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->last_name : '')),
            );
        
        $this->data['birthdate'] = array(
                    'name'  => 'dob',
                    'id'    => 'birthdate',
                    'type'  => 'text',
                    'placeholder'  => 'E.g. yyyy-mm-dd',
                    'class' => 'form-control datepicker',                    
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->dob : '')),
            );

        $this->data['email'] = array(
                    'name'  => 'email',
                    'id'    => 'email',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'required' => 'required',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->email : '')),
            );
        
        $this->data['phone'] = array(
                    'name'  => 'phone',
                    'id'    => 'phone',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Phone',
                    'required' => 'required',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->phone : '')),
            );

        $this->data['ssn'] = array(
                    'name'  => 'ssn',
                    'id'    => 'ssn',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Social Security Number',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->sss : '')),
            );

        $this->data['address'] = array(
                    'name'  => 'home_address',
                    'id'    => 'address',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Address',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->home_address : '')),
            );

        $this->data['city'] = array(
                    'name'  => 'city',
                    'id'    => 'city',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'City',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->city : '')),
            );

        $this->data['state'] = array(
                    'name'  => 'state',
                    'id'    => 'state',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'State',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->state : '')),
            );

        $this->data['zip'] = array(
                    'name'  => 'zip',
                    'id'    => 'zip',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Zip',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->zip : '')),
            );

        $this->data['message'] = array(
                    'name'  => 'message',
                    'id'    => 'message',                    
                    'class' => 'form-control',
                    'placeholder' => 'Message',
                    'value' => set_value('', (is_object($content) ? $content->message : '')),
            ); 

        $this->data['is_volunteer'] = array(
                'name'  => 'volunteer',
                'id'    => 'volunteer',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('is_volunteer', '1', FALSE)
        );

        $this->data['need_help'] = array(
                'name'  => 'need_help',
                'id'    => 'need_help',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('need_help', '1', FALSE)
        );

        $this->data['wheelchair_problem'] = array(
                'name'  => 'wheelchair_problem',
                'id'    => 'wheelchair_problem',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('wheelchair_problem', '1', FALSE)
        );

        $this->data['other'] = array(
                'name'  => 'other',
                'id'    => 'other',
                'type'  => 'checkbox',     
                'class' => 'minimal',
                'checked' => set_checkbox('other', '1', FALSE)
        );

        $this->data['member_first_name'] = array(
                    'name'  => 'member_first_name',
                    'id'    => 'member_first_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'First Name',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->member_first_name : '')),
            );

        $this->data['member_last_name'] = array(
                    'name'  => 'member_last_name',
                    'id'    => 'member_last_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->member_last_name : '')),
            );
        
        $this->data['member_birthdate'] = array(
                    'name'  => 'member_dob',
                    'id'    => 'member_birthdate',
                    'type'  => 'text',
                    'placeholder'  => 'E.g. yyyy-mm-dd',
                    'class' => 'form-control datepicker',                    
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->member_dob : '')),
            );

        $this->data['member_email'] = array(
                    'name'  => 'member_email',
                    'id'    => 'member_email',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->member_email : '')),
            );
        
        $this->data['member_phone'] = array(
                    'name'  => 'member_phone',
                    'id'    => 'member_phone',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Phone',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->member_phone : '')),
            );

        $this->data['volunteer_first_name'] = array(
                    'name'  => 'volunteer_first_name',
                    'id'    => 'volunteer_first_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'First Name',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->volunteer_first_name : '')),
            );

        $this->data['volunteer_last_name'] = array(
                    'name'  => 'volunteer_last_name',
                    'id'    => 'volunteer_last_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->volunteer_last_name : '')),
            );
        
        $this->data['volunteer_birthdate'] = array(
                    'name'  => 'volunteer_dob',
                    'id'    => 'volunteer_birthdate',
                    'type'  => 'text',
                    'placeholder'  => 'E.g. yyyy-mm-dd',
                    'class' => 'form-control datepicker',                    
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->volunteer_dob : '')),
            );

        $this->data['volunteer_email'] = array(
                    'name'  => 'volunteer_email',
                    'id'    => 'volunteer_email',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->volunteer_email : '')),
            );
        
        $this->data['volunteer_phone'] = array(
                    'name'  => 'volunteer_phone',
                    'id'    => 'volunteer_phone',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Phone',
                    'value' => $this->form_validation->set_value('', (is_object($content) ? $content->volunteer_phone : '')),
            );
        
    }
    
    public function send_mail($page, $field = array()){

        if($page == 'contact'){

            $name = $field['first_name']." ".$field['last_name'];
            $email = $field['email'];
            $phone = $field['phone'];
            $subject = "";
            $message = "";

            $subject .= "Email from ".$name;
            $message .= "Reason: ".$field['reason']."<br/><br/>";
            $message .= $field['message'];
            $message .= "<br/><br/><br/>";
            $message .= "Sender: ".$name." [ ".$field['phone']." ] ";
        }

        if($page == 'event'){

            $name = $field['first_name']." ".$field['last_name'];
            $email = $field['email'];
            $phone = $field['phone'];
            $number_of_guests = $field['number_of_guests'];
            $subject = "";
            $message = "";

            //$gender = $field['gender'] == "M" ? "Male":"Female";

            $subject .= "Notification from Event Form";
            $message .= "<strong>Name: </strong>".$field['first_name']." ".$field['last_name']."<br/>";
            //$message .= "<strong>Gender: </strong>".$gender."<br/>";
            //$message .= "<strong>Birthdate: </strong>".date('F j, Y', strtotime($field['dob']))."<br/>";
            $message .= "<strong>Email: </strong>".$field['email']."<br/>";
            $message .= "<strong>Phone: </strong>".$field['phone']."<br/>";
            $message .= "<strong>Number of Guests: </strong>".$field['number_of_guests']."<br/>";
            //$message .= "<strong>Address: </strong>".$field['home_address']." ".$field['city']." ".$field['state']." ".$field['zip']."<br/>";
        }

        if($page == 'member_form'){

            $name = $field['member_first_name']." ".$field['member_last_name'];
            $email = $field['member_email'];
            $phone = $field['member_phone'];
            $subject = "";
            $message = "";

            //$gender = $field['member_gender'] == "M" ? "Male":"Female";

            $subject .= "Notification from Members' Form ";
            $message .= "<strong>Name: </strong>".$field['member_first_name']." ".$field['member_last_name']."<br/>";
            //$message .= "<strong>Gender: </strong>".$gender."<br/>";
            //$message .= "<strong>Birthdate: </strong>".date('F j, Y', strtotime($field['member_dob']))."<br/>";
            $message .= "<strong>Email: </strong>".$field['member_email']."<br/>";
            $message .= "<strong>Phone: </strong>".$field['member_phone']."<br/>";
            $message .= "<strong>Address: </strong>".$field['member_address']." ".$field['member_city']." ".$field['member_state']." ".$field['member_zip']."<br/>";
        }
        /*
        $this->load->library('email');
        $this->email->from($email, $name);
        $this->email->to('calvin@domandtom.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
        */

        $to = "calvin@domandtom.com";

        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type:text/html;charset=UTF-8 \r\n";
        $headers .= "From: $email \r\n";
        $headers .= "Reply-To: $email \r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to,$subject,$message,$headers,"-f your@email.here");
        
    }
    
    public function test_mail(){
        /*
        $this->load->library('email');
        $this->email->from('test@mail.com', 'John Doe');
        $this->email->to('calvin@domandtom.com');
        $this->email->subject('Test Subject');
        $this->email->message('Test Message');
        if ($this->email->send()) {
            die("Success");
        } else {
            show_error($this->email->print_debugger());
        }
        */

        $to = "cguevarra@getdevs.com";
        $subject = "Subject";
        $from = "from@mail.com";
        $message = "This is a test message";
        $replyTo = "no-reply@mail.com";

        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type:text/html;charset=UTF-8 \r\n";
        $headers .= "From: $from \r\n";
        $headers .= "Reply-To: $replyTo \r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to,$subject,$message,$headers,"-f your@email.here");
    }

}
