<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientEvent extends Admin_Controller {
          
    public function __construct(){
        parent::__construct();
        
        $this->load->model('admin/clientEvent_model');
    }

    public function index(){
        
    }
    
    public function add_client_to_event($ids){

        $client_id_array = array();
        $c = explode("-",$ids);
        $event_id = $c[0];
        $client_id = $c[1];

        $this->clientEvent_model->add_client_to_event($event_id, $client_id);
    }

    public function remove_client_from_event($ids){

        $client_id_array = array();
        $c = explode("-",$ids);
        $event_id = $c[0];
        $client_id = $c[1];

        $this->clientEvent_model->remove_client_from_event($event_id, $client_id);
    }

    public function get_clients_by_event_id($event_id){
        
        $this->data['clients'] = $this->clientEvent_model->get_clients_by_event_id($event_id);
        $this->load->view('admin/events/display_attendees', $this->data);
    }
    
}

