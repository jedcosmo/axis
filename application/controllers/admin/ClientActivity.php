<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientActivity extends Admin_Controller {
          
    public function __construct(){
        parent::__construct();
        
        $this->load->model('admin/clientActivity_model');
    }

    public function index(){
        
    }
    
    public function add_client_to_activity($ids){

        $client_id_array = array();
        $c = explode("-",$ids);
        $activity_id = $c[0];
        $client_id = $c[1];

        $this->clientActivity_model->add_client_to_activity($activity_id, $client_id);
    }

    public function remove_client_from_activity($ids){

        $client_id_array = array();
        $c = explode("-",$ids);
        $activity_id = $c[0];
        $client_id = $c[1];

        $this->clientActivity_model->remove_client_from_activity($activity_id, $client_id);
    }

    public function get_clients_by_activity_id($activity_id){
        
        $this->data['clients'] = $this->clientActivity_model->get_clients_by_activity_id($activity_id);
        $this->load->view('admin/activities/display_attendees', $this->data);
    }
    
}

