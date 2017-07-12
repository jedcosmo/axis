<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Events_model extends CI_Model {

    private $db_content_table = 'events';
    private $db_seometa_table = 'seo_meta';
    private $current_user_id;
    
    public function __construct()
    {
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
        $config = array(
                'table' => $this->db_content_table,
                'id' => 'ID',
                'field' => 'uri',
                'title' => 'title',
                'replacement' => 'dash'
            );
        $this->load->library('admin/slug', $config);
    }
    
    public function create_event( $fields = array() ){
        $insert_fields = array();        
        
        $insert_fields['user_id'] = $this->current_user_id;
        $insert_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']));
        $insert_fields['title'] = $fields['content_title'];
        $insert_fields['excerpt'] = $fields['excerpt'];
        $insert_fields['content'] = $fields['content'];
        $insert_fields['featured_img'] = $fields['featured-img-path'];
        $insert_fields['venue'] = $fields['venue'];
        $insert_fields['start_date'] = $fields['start_date'];
        $insert_fields['end_date'] = $fields['end_date'];
        
        $this->db->insert($this->db_content_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
        
        $this->saveSEOMetas($insert_id, $fields);
                                
        return $insert_id;
    }
    
    public function update_event( $fields = array() ){
        $update_fields = array();        
        
        //$user_id = $fields['user_id'];
        $event_id = $fields['event_id'];
        $update_fields['title'] = $fields['content_title'];
        $update_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']), $event_id);
        $update_fields['excerpt'] = $fields['excerpt'];
        $update_fields['content'] = $fields['content'];
        $update_fields['featured_img'] = $fields['featured-img-path'];
        $update_fields['venue'] = $fields['venue'];
        $update_fields['start_date'] = $fields['start_date'];
        $update_fields['end_date'] = $fields['end_date'];
        
        $this->db->where('ID', $event_id);        
        $this->db->update($this->db_content_table, $update_fields);
                
        if( is_object($this->checkIfSEOMetaExists($event_id, 'event')) ){            
            $this->updateSEOMetas($event_id, $fields);
        }else{
            $this->saveSEOMetas($event_id, $fields);
        }
                   
        return $this->db->affected_rows();
    }
    
    public function get_lists_events(){
        $this->db->select('e.ID, e.title, e.status, e.date_created, e.date_updated, e.start_date, e.venue, e.uri, u.first_name');
        $this->db->order_by('e.start_date', 'DESC');
        $this->db->from('events e');
        $this->db->join('users u','u.id = e.user_id','inner');
        $this->db->where_in('e.status', array('published','drafted'));
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function get_details( $id = 0 ){
        $this->db->select('e.ID, e.title, e.excerpt, e.content, e.featured_img, e.status,
                           e.venue, e.start_date, e.end_date, e.uri,
                           u.first_name, m.meta_title, m.meta_keyword, m.meta_description');
        $this->db->from('events e');
        $this->db->join('users u', 'u.id = e.user_id','inner');
        $this->db->join('seo_meta m', 'm.content_id = e.ID AND m.type = \'event\'', 'left');
        $this->db->where('e.ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }

    public function get_details_by_uri($uri = 0){
        $this->db->select('e.ID, e.title, e.excerpt, e.content, e.featured_img, e.status,
                           e.venue, e.start_date, e.end_date, e.uri,
                           u.first_name, m.meta_title, m.meta_keyword, m.meta_description');
        $this->db->from('events e');
        $this->db->join('users u', 'u.id = e.user_id','inner');
        $this->db->join('seo_meta m', 'm.content_id = e.ID AND m.type = \'event\'', 'left');
        $this->db->where('e.uri', $uri);        
        
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
    
    public function saveSEOMetas( $insert_id, $fields ){
        $seo_insert_fields = array();
        
        if( !empty($fields['meta_title']) || !empty($fields['meta_keyword']) || !empty($fields['meta_description']) ){
            $seo_insert_fields['content_id'] = $insert_id;
            $seo_insert_fields['type'] = 'event';
            $seo_insert_fields['meta_title'] = $fields['meta_title'];
            $seo_insert_fields['meta_keyword'] = $fields['meta_keyword'];
            $seo_insert_fields['meta_description'] = $fields['meta_description'];
            
            $this->db->insert($this->db_seometa_table, $seo_insert_fields);
            
            return $this->db->insert_id();
        }
        
        return false;
    }
    
    public function updateSEOMetas( $content_id, $fields ){
        $seo_update_fields = array();
        
        if( $fields['meta_title'] != '' || $fields['meta_keyword'] != '' || $fields['meta_description'] != '' ){                                    
            $seo_update_fields['meta_title'] = $fields['meta_title'];
            $seo_update_fields['meta_keyword'] = $fields['meta_keyword'];
            $seo_update_fields['meta_description'] = $fields['meta_description'];

            $this->db->where('content_id', $content_id);
            $this->db->where('type', 'event');
            $this->db->update($this->db_seometa_table, $seo_update_fields);
            
            return $this->db->affected_rows();
        }
        
        return false;
    }
    
    public function checkIfSEOMetaExists( $content_id, $type ){
        $query = $this->db->get_where($this->db_seometa_table, array('content_id' => $content_id, 'type' => $type));        
        return $query->row();
    }
}

