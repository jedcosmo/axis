<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    private $db_content_table = 'contact';
    
    public function __construct(){
        parent::__construct();
    }
    
    public function create_contact( $fields = array() ){
        $insert_fields = array();        
        
        $insert_fields['first_name'] = $fields['first_name'];
        $insert_fields['last_name'] = $fields['last_name'];
        $insert_fields['email'] = $fields['email'];
        $insert_fields['phone'] = $fields['phone'];
        $insert_fields['message'] = $fields['message'];
        $insert_fields['reason'] = $fields['reason'];
        
        $this->db->insert($this->db_content_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
                                
        return $insert_id;
    }    
    
    public function get_lists_contact(){
        $this->db->select('*');
        $this->db->from('contact');
        $this->db->order_by('ID', DESC);
        
        $query = $this->db->get();
        
        return $query->result();
    }

    public function count_contacts(){
        $this->db->select('*');
        $this->db->from('contact');
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    public function get_details( $id = 0 ){
        $this->db->select('*');
        $this->db->from('contact');
        $this->db->where('ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
}

