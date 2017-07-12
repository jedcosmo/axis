<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/products_model');        
        
        /* Title Page :: Common */
        $this->page_title->push('Products');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Products', 'admin/products');
    }
    
    public function index(){        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();            
        $this->data['products'] = $this->products_model->get_lists_products();            

        /* Load Template */
        $this->template->admin_render('admin/products/index', $this->data);        
    }
    
    public function create(){
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create', 'admin/products/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[3]|max_length[250]');
        
        if ( $this->form_validation->run() == true )
        {
            $this->products_model->create_product( $this->input->post() );

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/products/create', 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        
            $this->prepare_form_fields();            
        }
        
        /* Load Template */
        $this->template->admin_render('admin/products/create', $this->data);
    }
    
    public function edit( $id ){
        $id = (int)$id;                
        
        $product = $this->products_model->get_details( $id );
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Product Edit', 'admin/products/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['product'] = $product;
        
        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[3]|max_length[250]');
        //$this->form_validation->set_rules('product_code', 'product code', 'trim|required|alpha_numeric|min_length[5]|max_length[200]');
        //$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
        //$this->form_validation->set_rules('quantity', 'quantity', 'trim|required|numeric');
        
        if ( $this->form_validation->run() == true )
        {            
            $this->products_model->update_product( $this->input->post() );

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/products/edit/'.$id, 'refresh');            
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        }
        
        $this->prepare_form_fields( $product );
        $this->data['preview_featured_img'] = array('src' => $product->featured_img, 'width' => '300', 'height' => 'auto');
        $this->data['btn_upload_label'] = (!empty($product->featured_img) ? 'Change Image' : 'Upload Image');
        /* Load Template */
        $this->template->admin_render('admin/products/edit', $this->data);
    }
    
    public function action( $type, $id ){
        $id = (int)$id;
        if( !empty($type) ){
            $this->products_model->do_action( $type, $id );
        }
        
        redirect('admin/products', 'refresh');
    }
    
    private function prepare_form_fields( $content = array() ){        
        
        $this->data['content_title'] = array(
                    'name'  => 'content_title',
                    'id'    => 'content_title',
                    'type'  => 'text',
                    'class' => 'form-control page_name',
                    'placeholder' => 'Product Name',
                    'value' => $this->form_validation->set_value('content_title', (is_object($content) ? $content->title : '')),
            );
        
        $this->data['excerpt'] = array(
                    'name'  => 'excerpt',
                    'id'    => 'excerpt',                    
                    'class' => 'form-excerpt-textarea',
                    'placeholder' => 'Excerpt',
                    'value' => set_value('excerpt', (is_object($content) ? $content->excerpt : '')),
            ); 
        
        $this->data['content'] = array(
                    'name'  => 'content',
                    'id'    => 'editor_NO',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content', (is_object($content) ? $content->content : ''))),
            );
        
        $this->data['product_code'] = array(
                    'name'  => 'product_code',
                    'id'    => 'product_code',
                    'type'  => 'text',
                    'class' => 'form-control page_name',
                    'placeholder' => 'Product Code',
                    'value' => $this->form_validation->set_value('product_code', (is_object($content) ? $content->product_code : '')),
            );
        
        $this->data['price'] = array(
                    'name'  => 'price',
                    'id'    => 'price',
                    'type'  => 'text',
                    'class' => 'form-control pull-right',    
                    'placeholder' => 'Price',
                    'value' => $this->form_validation->set_value('price', (is_object($content) ? $content->price : '')),
            );
        
        $this->data['quantity'] = array(
                    'name'  => 'quantity',
                    'id'    => 'quantity',
                    'type'  => 'text',
                    'class' => 'form-control pull-right',                    
                    'value' => $this->form_validation->set_value('quantity', (is_object($content) ? $content->quantity : '')),
            );
        
        $this->data['meta_title'] = array(
                    'name'  => 'meta_title',
                    'id'    => 'meta_title',                    
                    'class' => 'form-meta-textarea',
                    'placeholder' => 'Meta Title',
                    'value' => set_value('meta_title', (isset($content->meta_title) ? $content->meta_title : '')),
            );
        
        $this->data['meta_keyword'] = array(
                    'name'  => 'meta_keyword',
                    'id'    => 'meta_keyword',                    
                    'class' => 'form-meta-textarea',
                    'placeholder' => 'Meta Keyword',
                    'value' => set_value('meta_keyword', (isset($content->meta_keyword) ? $content->meta_keyword : '')),
            );
        
        $this->data['meta_description'] = array(
                    'name'  => 'meta_description',
                    'id'    => 'meta_description',                    
                    'class' => 'form-meta-textarea',
                    'placeholder' => 'Meta Description',
                    'value' => set_value('meta_description', (isset($content->meta_description) ? $content->meta_description : '')),
            );
    }
}

