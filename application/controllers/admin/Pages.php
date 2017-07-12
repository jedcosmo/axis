<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/pages_model');        
        
        /* Title Page :: Common */
        $this->page_title->push('Pages');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Pages', 'admin/pages');
    }
    
    public function index(){
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();            
        $this->data['pages'] = $this->pages_model->get_lists_pages();            

        /* Load Template */
        $this->template->admin_render('admin/pages/index', $this->data);
    }
    
    public function create(){
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create', 'admin/pages/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[3]|max_length[250]');                
        
        if ( $this->form_validation->run() == true )
        {
            $this->pages_model->create_page( $this->input->post() );
            redirect('admin/pages', 'refresh');
        }else{
            $this->data['message'] = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );            
        
            $this->prepare_form_fields();            
        }
        
        /* Load Template */
        $this->template->admin_render('admin/pages/create', $this->data);
    }
    
    public function edit( $id ){
        $id = (int)$id;        
                       
        $page = $this->pages_model->get_details( $id );
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Page Edit', 'admin/pages/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['page'] = $page;
        
        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[3]|max_length[250]');
        
        if ( $this->form_validation->run() == true )
        {            
            $this->pages_model->update_page( $this->input->post() );

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/pages/edit/'.$id, 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        }
        
        $this->prepare_form_fields( $page );
        $this->data['preview_featured_img'] = array('src' => $page->featured_img, 'width' => '300', 'height' => 'auto');
        $this->data['btn_upload_label'] = (!empty($page->featured_img) ? 'Change Image' : 'Upload Image');
        /* Load Template */
        $this->template->admin_render('admin/pages/edit', $this->data);
    }
    
    public function action( $type, $id ){
        $id = (int)$id;
        if( !empty($type) ){
            $this->pages_model->do_action( $type, $id );
        }
        
        redirect('admin/pages', 'refresh');
    }
    
    private function prepare_form_fields( $content = array() ){        
        
        $this->data['content_title'] = array(
                    'name'  => 'content_title',
                    'id'    => 'content_title',
                    'type'  => 'text',
                    'class' => 'form-control page_name',
                    'placeholder' => 'Title',
                    'value' => $this->form_validation->set_value('content_title', (is_object($content) ? $content->title : '')),
            );

        $this->data['heading'] = array(
                    'name'  => 'heading',
                    'id'    => 'heading',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Heading',
                    'value' => $this->form_validation->set_value('heading', (is_object($content) ? $content->heading : '')),
            );

        $this->data['subheading'] = array(
                    'name'  => 'subheading',
                    'id'    => 'subheading',                    
                    'class' => 'form-excerpt-textarea',
                    'placeholder' => 'Sub Heading',
                    'value' => set_value('subheading', (is_object($content) ? $content->subheading : '')),
            ); 
        /*
        $this->data['excerpt'] = array(
                    'name'  => 'excerpt',
                    'id'    => 'excerpt',                    
                    'class' => 'form-excerpt-textarea',
                    'placeholder' => 'Excerpt',
                    'value' => set_value('excerpt', (is_object($content) ? $content->excerpt : '')),
            ); 
        */
        $this->data['content1'] = array(
                    'name'  => 'content1',
                    'id'    => 'editor_NO',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content1', (is_object($content) ? $content->content1 : ''))),
            );


        $this->data['content2'] = array(
                    'name'  => 'content2',
                    'id'    => 'editor_content2',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content2', (is_object($content) ? $content->content2 : ''))),
            );

        $this->data['content3'] = array(
                    'name'  => 'content3',
                    'id'    => 'editor_content3',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content3', (is_object($content) ? $content->content3 : ''))),
            );

        $this->data['content4'] = array(
                    'name'  => 'content4',
                    'id'    => 'editor_content4',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content4', (is_object($content) ? $content->content4 : ''))),
            );

        $this->data['content5'] = array(
                    'name'  => 'content5',
                    'id'    => 'editor_content5',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content5', (is_object($content) ? $content->content5 : ''))),
            );

        $this->data['video1'] = array(
                    'name'  => 'video1',
                    'id'    => 'video1',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Video',
                    'value' => set_value('video1', (is_object($content) ? $content->video1 : '')),
            );

        $this->data['video2'] = array(
                    'name'  => 'video2',
                    'id'    => 'video2',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Video',
                    'value' => set_value('video2', (is_object($content) ? $content->video2 : '')),
            );

        $this->data['video3'] = array(
                    'name'  => 'video3',
                    'id'    => 'video3',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Video',
                    'value' => set_value('video3', (is_object($content) ? $content->video3 : '')),
            );

        $this->data['video4'] = array(
                    'name'  => 'video4',
                    'id'    => 'video4',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Video',
                    'value' => set_value('video4', (is_object($content) ? $content->video4 : '')),
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

