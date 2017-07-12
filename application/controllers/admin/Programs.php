<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/programs_model');        
        
        /* Title Page :: Common */
        $this->page_title->push('Programs');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Programs', 'admin/programs');
    }
    
    public function index(){        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();            
        $this->data['programs'] = $this->programs_model->get_lists_programs();            

        /* Load Template */
        $this->template->admin_render('admin/programs/index', $this->data);        
    }
    
    public function create(){
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create', 'admin/programs/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[3]|max_length[250]');                
        
        if ( $this->form_validation->run() == true )
        {
            $this->programs_model->create_program( $this->input->post() );

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/programs/create', 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        
            $this->prepare_form_fields();            
        }
        
        /* Load Template */
        $this->template->admin_render('admin/programs/create', $this->data);
    }
    
    public function edit( $id ){
        $id = (int)$id;              
        
        $program = $this->programs_model->get_details( $id );
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Event Edit', 'admin/event/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['program'] = $program;
        
        /* Validate form input */
        $this->form_validation->set_rules('content_title', 'title', 'trim|required|min_length[3]|max_length[250]');
        
        if ( $this->form_validation->run() == true )
        {            
            $this->programs_model->update_program( $this->input->post() ); 

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/programs/edit/'.$id, 'refresh');            
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        }
        
        $this->prepare_form_fields( $program );
        $this->data['preview_featured_img'] = array('src' => $program->featured_img, 'width' => '300', 'height' => 'auto');
        $this->data['btn_upload_label'] = (!empty($program->featured_img) ? 'Change Image' : 'Upload Image');
        /* Load Template */
        $this->template->admin_render('admin/programs/edit', $this->data);
    }
    
    public function action( $type, $id ){
        $id = (int)$id;
        if( !empty($type) ){
            $this->programs_model->do_action( $type, $id );
        }
        
        redirect('admin/programs', 'refresh');
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
        
        $this->data['excerpt'] = array(
                    'name'  => 'excerpt',
                    'id'    => 'excerpt',                    
                    'class' => 'form-excerpt-textarea',
                    'placeholder' => 'Excerpt',
                    'value' => set_value('excerpt', (is_object($content) ? $content->excerpt : '')),
            ); 

        $this->data['video'] = array(
                    'name'  => 'video',
                    'id'    => 'video',                    
                    'class' => 'form-control',
                    'placeholder' => 'Video URL',
                    'value' => set_value('video', (is_object($content) ? $content->video : '')),
            ); 

        /*
        $this->data['content'] = array(
                    'name'  => 'content',
                    'id'    => 'editor_NO',
                    'cols' => '80',
                    'rows' => '10',                                        
                    'value' => html_entity_decode(set_value('content', (is_object($content) ? $content->content : ''))),
            );
        */
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

