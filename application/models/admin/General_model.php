<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {

    private $db_general_table = 'general';
    private $current_user_id;
    
    public function __construct(){
        parent::__construct();
    }
    
    public function update( $fields = array() ){
        $update_fields = array();        
        
        $general_id = $fields['general_id'];
        $update_fields['home_video'] = $fields['home_video'];
        $update_fields['footer'] = $fields['footer'];
        $update_fields['facebook'] = $fields['facebook'];
        $update_fields['twitter'] = $fields['twitter'];
        $update_fields['tumblr'] = $fields['tumblr'];
        $update_fields['notification'] = $fields['notification'];
        
        $this->db->where('id', $general_id);        
        $this->db->update($this->db_general_table, $update_fields);
                   
        return $this->db->affected_rows();
    }
    
    public function get_list(){
        $this->db->select('*');
        $this->db->from('general');
        
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_details(){
        $this->db->select('*');
        $this->db->from('general');
        $this->db->where('id', 1);        
        
        $query = $this->db->get();
        
        return $query->row();
    }

}

