<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs_model extends CI_Model {

    private $db_content_table = 'programs';
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
    
    public function create_program( $fields = array() ){
        $insert_fields = array();        
        
        $insert_fields['user_id'] = $this->current_user_id;
        $insert_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']));
        $insert_fields['title'] = $fields['content_title'];
        $insert_fields['video'] = $fields['video'];
        $insert_fields['excerpt'] = $fields['excerpt'];
        //$insert_fields['content'] = $fields['content'];
        $insert_fields['featured_img'] = $fields['featured-img-path'];
        
        $this->db->insert($this->db_content_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
        
        $this->saveSEOMetas($insert_id, $fields);
                                
        return $insert_id;
    }
    
    public function update_program( $fields = array() ){
        $update_fields = array();        
        
        //$user_id = $fields['user_id'];
        $program_id = $fields['program_id'];
        $update_fields['title'] = $fields['content_title'];
        $update_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']), $program_id);
        $update_fields['video'] = $fields['video'];
        $update_fields['excerpt'] = $fields['excerpt'];
        //$update_fields['content'] = $fields['content'];
        $update_fields['featured_img'] = $fields['featured-img-path'];
        
        $this->db->where('ID', $program_id);        
        $this->db->update($this->db_content_table, $update_fields);
                
        if( is_object($this->checkIfSEOMetaExists($program_id, 'program')) ){            
            $this->updateSEOMetas($program_id, $fields);
        }else{
            $this->saveSEOMetas($program_id, $fields);
        }
                   
        return $this->db->affected_rows();
    }
    
    public function get_lists_programs(){
        $this->db->select('p.ID, p.title, p.excerpt, p.video, p.status, p.featured_img, p.date_created, p.date_updated, p.uri, u.first_name');
        $this->db->from('programs p');
        $this->db->join('users u','u.id = p.user_id','inner');
        $this->db->where_in('p.status', array('published','drafted'));
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function get_details( $id = 0 ){
        $this->db->select('p.ID, p.title, p.excerpt, p.video, p.featured_img, p.status, p.uri,
                           u.first_name, m.meta_title, m.meta_keyword, m.meta_description');
        $this->db->from('programs p');
        $this->db->join('users u', 'u.id = p.user_id','inner');
        $this->db->join('seo_meta m', 'm.content_id = p.ID AND m.type = \'program\'', 'left');
        $this->db->where('p.ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }

    public function get_details_by_uri($uri = 0){
        $this->db->select('*');
        $this->db->from('programs');
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
    
    public function saveSEOMetas( $insert_id, $fields ){
        $seo_insert_fields = array();
        
        if( !empty($fields['meta_title']) || !empty($fields['meta_keyword']) || !empty($fields['meta_description']) ){
            $seo_insert_fields['content_id'] = $insert_id;
            $seo_insert_fields['type'] = 'program';
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
            $this->db->where('type', 'program');
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

