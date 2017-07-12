<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/contact_model');        
        
        /* Title Page :: Common */
        $this->page_title->push('Contact');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Contact', 'admin/contact');
    }
    
    public function index(){        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['contacts'] = $this->contact_model->get_lists_contact();            

        /* Load Template */
        $this->template->admin_render('admin/contact/index', $this->data);        
    }

    public function get_detail($id){        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['contact'] = $this->contact_model->get_details($id);
        $this->data['count'] = $this->contact_model->count_contacts($id);

        /* Load Template */
        $this->template->admin_render('admin/contact/read', $this->data);        
    }

}

