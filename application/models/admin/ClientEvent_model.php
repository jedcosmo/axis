<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientEvent_model extends CI_Model {

    private $db_client_event_table = 'client_events';
    private $current_user_id;
    
    public function __construct(){
        parent::__construct();
    }

    public function add_client_to_event($event_id, $client_id){
        $insert_fields = array();        
        
        $insert_fields['event_id'] = $event_id;
        $insert_fields['client_id'] = $client_id;
        
        $this->db->insert($this->db_client_event_table, $insert_fields);        
        $insert_id = $this->db->insert_id();        
        return $insert_id;
    }

    public function remove_client_from_event($event_id, $client_id){
        $this->db->where(array('event_id' => $event_id, 'client_id' => $client_id));
        $this->db->delete('client_events');
        
        return $this->db->affected_rows();
    }   


    public function get_clients_by_event_id($event_id){

        $this->db->select('*');
        $this->db->from('client_events ce');
        $this->db->join('clients c','c.ID = ce.client_id','inner');
        $this->db->where_in('ce.event_id', $event_id);
        
        $query = $this->db->get();

        return $query->result();

    }

    public function delete_event($event_id){
        $this->db->where('event_id', $event_id);
        $this->db->delete('client_events');
        
        return $this->db->affected_rows();
    }

    public function add_number_of_guests($client_event_id, $fields = array()){
        $update_fields = array();        
        
        $update_fields['number_of_guests'] = $fields['number_of_guests'];
        
        $this->db->where('ID', $client_event_id);
        $this->db->update($this->db_client_event_table, $update_fields);
    }

}

