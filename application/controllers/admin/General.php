<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends Admin_Controller {
          
    public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push('General');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'General', 'admin/general');

        $this->load->model('admin/general_model');
    }
    
    public function update(){
       
        $general = $this->general_model->get_details();
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'General Edit', 'admin/general/update');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['general'] = $general;

        $this->form_validation->set_rules('facebook', 'Facebook', 'trim|min_length[3]|max_length[250]');                
        $this->form_validation->set_rules('twitter', 'Twitter', 'trim|min_length[3]|max_length[250]');                
        $this->form_validation->set_rules('tumblr', 'Tumblr', 'trim|min_length[3]|max_length[250]');                
        $this->form_validation->set_rules('footer', 'Footer', 'trim|min_length[3]');                
        
        $this->session->unset_userdata('message');

        /* Validate form input */
        if ( $this->form_validation->run() == true ){            
            $this->general_model->update( $this->input->post() );            
            $this->session->set_flashdata('message', 'Saved');
        }else{
            $errors = ( validation_errors() ? validation_errors() : $this->session->flashdata('message') );
            $this->session->set_flashdata('message', $errors);
        }
        
        $this->prepare_form_fields($general);
        /* Load Template */
        $this->template->admin_render('admin/general/index', $this->data);
    }


    private function prepare_form_fields( $content = array() ){  

        $this->data['notification'] = array(
                    'name'  => 'notification',
                    'id'    => 'notification',                    
                    'class' => 'form-control',
                    'placeholder' => 'Header Notificaion',
                    'value' => set_value('notification', (is_object($content) ? $content->notification : '')),
            );      

        $this->data['footer'] = array(
                    'name'  => 'footer',
                    'id'    => 'footer',                    
                    'class' => 'form-control',
                    'placeholder' => 'Footer',
                    'value' => $this->form_validation->set_value('footer', (is_object($content) ? $content->footer : '')),
            );

        $this->data['facebook'] = array(
                    'name'  => 'facebook',
                    'id'    => 'facebook',                    
                    'class' => 'form-control',
                    'placeholder' => 'Facebook',
                    'value' => set_value('facebook', (is_object($content) ? $content->facebook : '')),
            );

        $this->data['twitter'] = array(
                    'name'  => 'twitter',
                    'id'    => 'twitter',                    
                    'class' => 'form-control',
                    'placeholder' => 'Twitter',
                    'value' => set_value('twitter', (is_object($content) ? $content->twitter : '')),
            );

        $this->data['tumblr'] = array(
                    'name'  => 'tumblr',
                    'id'    => 'tumblr',                    
                    'class' => 'form-control',
                    'placeholder' => 'Tumblr',
                    'value' => set_value('tumblr', (is_object($content) ? $content->tumblr : '')),
            );

    }

    
}

