<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/team_model');        
        
        /* Title Page :: Common */
        $this->page_title->push('Team');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Team', 'admin/team');
    }
    
    public function index(){        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();            
        $this->data['team'] = $this->team_model->get_lists_team();            

        /* Load Template */
        $this->template->admin_render('admin/team/index', $this->data);        
    }
    
    public function create(){
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create', 'admin/team/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Validate form input */
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[250]');
        
        if ( $this->form_validation->run() == true )
        {
            $this->team_model->create_team( $this->input->post() );

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/team/create', 'refresh');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        
            $this->prepare_form_fields();            
        }
        
        /* Load Template */
        $this->template->admin_render('admin/team/create', $this->data);
    }
    
    public function edit( $id ){
        $id = (int)$id;                
        
        $team = $this->team_model->get_details( $id );
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Team Edit', 'admin/team/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['team'] = $team;
        
        /* Validate form input */
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[250]');
        
        if ( $this->form_validation->run() == true )
        {            
            $this->team_model->update_team( $this->input->post() );  

            $this->session->set_flashdata('message', 'Saved');

            redirect('admin/team/edit/'.$id, 'refresh');            
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        }
        
        $this->prepare_form_fields( $team );
        $this->data['preview_featured_img'] = array('src' => $team->featured_img, 'width' => '300', 'height' => 'auto');
        $this->data['btn_upload_label'] = (!empty($team->featured_img) ? 'Change Image' : 'Upload Image');
        /* Load Template */
        $this->template->admin_render('admin/team/edit', $this->data);
    }
    
    public function action( $type, $id ){
        $id = (int)$id;
        if( !empty($type) ){
            $this->team_model->do_action( $type, $id );
        }
        
        redirect('admin/team', 'refresh');
    }
    
    private function prepare_form_fields( $content = array() ){        
        
        $this->data['first_name'] = array(
                    'name'  => 'first_name',
                    'id'    => 'first_name',
                    'type'  => 'text',
                    'class' => 'form-control ',
                    'placeholder' => 'First Name',
                    'value' => $this->form_validation->set_value('first_name', (is_object($content) ? $content->first_name : '')),
            );

        $this->data['last_name'] = array(
                    'name'  => 'last_name',
                    'id'    => 'last_name',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'placeholder' => 'Last Name',
                    'value' => $this->form_validation->set_value('last_name', (is_object($content) ? $content->last_name : '')),
            );
        
        $this->data['position'] = array(
                    'name'  => 'position',
                    'id'    => 'position',                    
                    'class' => 'form-control',
                    'placeholder' => 'Position',
                    'value' => set_value('position', (is_object($content) ? $content->position : '')),
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
        
    }
}

