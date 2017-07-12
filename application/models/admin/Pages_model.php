<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

    private $db_page_table = 'pages';
    private $db_seometa_table = 'seo_meta';
    private $current_user_id;
    
    public function __construct()
    {
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
        $config = array(
                'table' => $this->db_page_table,
                'id' => 'ID',
                'field' => 'uri',
                'title' => 'title',
                'replacement' => 'dash'
            );
        $this->load->library('admin/slug', $config);
    }
    
    public function create_page( $fields = array() ){
        $insert_fields = array();        
        
        $insert_fields['user_id'] = $this->current_user_id;
        $insert_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']));
        $insert_fields['title'] = $fields['content_title'];
        $insert_fields['heading'] = $fields['heading'];
        $insert_fields['subheading'] = $fields['subheading'];
        //$insert_fields['excerpt'] = $fields['excerpt'];
        $insert_fields['content1'] = $fields['content1'];
        $insert_fields['content2'] = $fields['content2'];
        $insert_fields['content3'] = $fields['content3'];
        $insert_fields['content4'] = $fields['content4'];
        $insert_fields['content5'] = $fields['content5'];
        $insert_fields['video1'] = $fields['video1'];
        $insert_fields['video2'] = $fields['video2'];
        $insert_fields['video3'] = $fields['video3'];
        $insert_fields['video4'] = $fields['video4'];
        $insert_fields['featured_img'] = $fields['featured-img-path'];
        
        $this->db->insert($this->db_page_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
        
        $this->saveSEOMetas($insert_id, $fields);
                                
        return $insert_id;
    }
    
    public function update_page( $fields = array() ){
        $update_fields = array();        
        
        //$user_id = $fields['user_id'];
        $page_id = $fields['page_id'];
        $update_fields['title'] = $fields['content_title'];
        $update_fields['heading'] = $fields['heading'];
        $update_fields['subheading'] = $fields['subheading'];
        $update_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']), $page_id);
        //$update_fields['excerpt'] = $fields['excerpt'];
        $update_fields['content1'] = $fields['content1'];
        $update_fields['content2'] = $fields['content2'];
        $update_fields['content3'] = $fields['content3'];
        $update_fields['content4'] = $fields['content4'];
        $update_fields['content5'] = $fields['content5'];
        $update_fields['video1'] = $fields['video1'];
        $update_fields['video2'] = $fields['video2'];
        $update_fields['video3'] = $fields['video3'];
        $update_fields['video4'] = $fields['video4'];
        $update_fields['featured_img'] = $fields['featured-img-path'];
        
        $this->db->where('ID', $page_id);        
        $this->db->update($this->db_page_table, $update_fields);
                
        if( is_object($this->checkIfSEOMetaExists($page_id, 'page')) ){            
            $this->updateSEOMetas($page_id, $fields);
        }else{
            $this->saveSEOMetas($page_id, $fields);
        }
                   
        return $this->db->affected_rows();
    }
    
    public function get_lists_pages(){
        $this->db->select('p.ID, p.title, p.status, p.date_created, p.date_updated, u.first_name');
        $this->db->from('pages p');
        $this->db->join('users u','u.id = p.user_id','inner');
        $this->db->where_in('p.status', array('published','drafted'));
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function get_details( $id = 0 ){
        $this->db->select('p.ID, p.title, p.excerpt, p.heading, p.subheading, p.content1, p.content2, p.content3, p.content4, p.content5, p.featured_img, p.status, p.video1, p.video2, p.video3, p.video4, u.first_name, m.meta_title, m.meta_keyword, m.meta_description');
        $this->db->from('pages p');
        $this->db->join('users u', 'u.id = p.user_id','inner');
        $this->db->join('seo_meta m', 'm.content_id = p.ID AND m.type = \'page\'', 'left');
        $this->db->where('p.ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function do_action( $type = '', $id = 0){
        if($type == 'trash'){
            $this->db->set('status', 'trashed');
            $this->db->where('ID', $id);
            $this->db->update($this->db_page_table);
            
            return $this->db->affected_rows();
        }
    }   
    
    public function saveSEOMetas( $insert_id, $fields ){
        $seo_insert_fields = array();
        
        if( !empty($fields['meta_title']) || !empty($fields['meta_keyword']) || !empty($fields['meta_description']) ){
            $seo_insert_fields['content_id'] = $insert_id;
            $seo_insert_fields['type'] = 'page';
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
            $this->db->where('type', 'page');
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

