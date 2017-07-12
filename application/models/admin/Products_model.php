<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    private $db_content_table = 'products';
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
    
    public function create_product( $fields = array() ){
        $insert_fields = array();        
        
        $insert_fields['user_id'] = $this->current_user_id;
        $insert_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']));
        $insert_fields['title'] = $fields['content_title'];
        $insert_fields['excerpt'] = $fields['excerpt'];
        $insert_fields['content'] = $fields['content'];
        $insert_fields['featured_img'] = $fields['featured-img-path'];
        //$insert_fields['product_code'] = $fields['product_code'];
        $insert_fields['price'] = $fields['price'];
        $insert_fields['quantity'] = $fields['quantity'];
        
        $this->db->insert($this->db_content_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
        
        $this->saveSEOMetas($insert_id, $fields);
                                
        return $insert_id;
    }
    
    public function update_product( $fields = array() ){
        $update_fields = array();        
        
        //$user_id = $fields['user_id'];
        $product_id = $fields['product_id'];
        $update_fields['title'] = $fields['content_title'];
        $update_fields['uri'] = $this->slug->create_uri(array('title' => $fields['content_title']), $product_id);
        $update_fields['excerpt'] = $fields['excerpt'];
        $update_fields['content'] = $fields['content'];
        $update_fields['featured_img'] = $fields['featured-img-path'];
        //$update_fields['product_code'] = $fields['product_code'];
        $update_fields['price'] = $fields['price'];
        $update_fields['quantity'] = $fields['quantity'];
        
        $this->db->where('ID', $product_id);        
        $this->db->update($this->db_content_table, $update_fields);
               
        if( is_object($this->checkIfSEOMetaExists($product_id, 'product')) ){            
            $this->updateSEOMetas($product_id, $fields);
        }else{            
            $this->saveSEOMetas($product_id, $fields);
        }
                   
        return $this->db->affected_rows();
    }
    
    public function get_lists_products(){
        $this->db->select('p.ID, p.title, p.status, p.date_created, p.price, p.product_code, p.featured_img, p.date_updated, u.first_name');
        $this->db->from('products p');
        $this->db->join('users u','u.id = p.user_id','inner');
        $this->db->where_in('p.status', array('published','drafted'));
        $this->db->order_by('p.ID', 'DESC');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function get_details( $id = 0 ){
        $this->db->select('p.ID, p.title, p.excerpt, p.content, p.featured_img, p.status,
                           p.product_code, p.price, p.quantity,
                           u.first_name, m.meta_title, m.meta_keyword, m.meta_description');
        $this->db->from('products p');
        $this->db->join('users u', 'u.id = p.user_id','inner');
        $this->db->join('seo_meta m', 'm.content_id = p.ID AND m.type = \'product\'', 'left');
        $this->db->where('p.ID', $id);        
        
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
            $seo_insert_fields['type'] = 'product';
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
            $this->db->where('type', 'product');
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

