<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {

    private $db_content_table = 'team';
    private $current_user_id;
    
    public function __construct()
    {
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
        $config = array(
                'table' => $this->db_content_table,
                'id' => 'ID',
                'field' => 'uri',
                'title' => 'first_name',
                'replacement' => 'dash'
            );
        $this->load->library('admin/slug', $config);
    }
    
    public function create_team( $fields = array() ){
        $insert_fields = array();        
        
        $insert_fields['user_id'] = $this->current_user_id;

        $insert_fields['first_name'] = $fields['first_name'];
        $insert_fields['last_name'] = $fields['last_name'];
        $insert_fields['uri'] = $this->slug->create_uri(array('first_name' => $fields['first_name']));
        $insert_fields['excerpt'] = $fields['excerpt'];
        $insert_fields['content'] = $fields['content'];
        $insert_fields['position'] = $fields['position'];
        $insert_fields['featured_img'] = $fields['featured-img-path'];
        
        $this->db->insert($this->db_content_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
                                
        return $insert_id;
    }
    
    public function update_team( $fields = array() ){
        $update_fields = array();        
        
        $team_id = $fields['team_id'];
        $update_fields['user_id'] = $this->current_user_id;
        $update_fields['first_name'] = $fields['first_name'];
        $update_fields['last_name'] = $fields['last_name'];
        $update_fields['uri'] = $this->slug->create_uri(array('first_name' => $fields['first_name']), $blog_id);
        $update_fields['excerpt'] = $fields['excerpt'];
        $update_fields['content'] = $fields['content'];
        $update_fields['position'] = $fields['position'];
        $update_fields['featured_img'] = $fields['featured-img-path'];
        
        $this->db->where('ID', $team_id);        
        $this->db->update($this->db_content_table, $update_fields);
                     
        return $this->db->affected_rows();
    }
    
    public function get_lists_team(){
        $this->db->select('t.ID, t.first_name, t.last_name, t.uri, t.excerpt, t.content, t.status, t.position, t.featured_img, t.date_created');
        $this->db->from('team t');
        $this->db->join('users u','u.id = t.user_id','inner');
        $this->db->where_in('t.status', array('published','drafted'));
        $this->db->order_by('t.ID', 'DESC');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function get_details( $id = 0 ){
        $this->db->select('t.ID, t.first_name, t.last_name, t.uri, t.excerpt, t.content, t.status, t.featured_img, t.position');
        $this->db->from('team t');
        $this->db->join('users u', 'u.id = t.user_id','inner');
        $this->db->where('t.ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }

    public function get_details_by_uri($uri = 0){
        $this->db->select('*');
        $this->db->from('team');
        $this->db->where('uri', $uri);        
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function do_action( $type = '', $id = 0){
        if($type == 'trash'){
            $this->db->set('status', 'trashed');
            $this->db->where('ID', $id);
            $this->db->update($this->db_content_table);
            
            return $this->db->affected_rows();
        }
    }   

}

