<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper('number');
        $this->load->model('admin/dashboard_model');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() )
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Title Page */
            $this->page_title->push(lang('menu_dashboard'));
            $this->data['pagetitle'] = $this->page_title->show();

            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['count_users']       = $this->dashboard_model->get_count_record('users');
            $this->data['count_groups']      = $this->dashboard_model->get_count_record('groups');
            $this->data['disk_totalspace']   = $this->dashboard_model->disk_totalspace(DIRECTORY_SEPARATOR);
            $this->data['disk_freespace']    = $this->dashboard_model->disk_freespace(DIRECTORY_SEPARATOR);
            $this->data['disk_usespace']     = $this->data['disk_totalspace'] - $this->data['disk_freespace'];
            $this->data['disk_usepercent']   = $this->dashboard_model->disk_usepercent(DIRECTORY_SEPARATOR, FALSE);
            $this->data['memory_usage']      = $this->dashboard_model->memory_usage();
            $this->data['memory_peak_usage'] = $this->dashboard_model->memory_peak_usage(TRUE);
            $this->data['memory_usepercent'] = $this->dashboard_model->memory_usepercent(TRUE, FALSE);


            /* TEST */
            $this->data['url_exist']    = is_url_exist('http://www.domprojects.com');

            $this->load->model('admin/activities_model');
            $this->load->model('admin/events_model');
            $this->load->model('admin/blog_model');
            $this->load->model('admin/products_model');
            $this->load->model('admin/clients_model');


            $this->data['activities'] = $this->activities_model->get_lists_daily_activities();
            $this->data['events'] = $this->events_model->get_lists_events();
            $this->data['blogs'] = $this->blog_model->get_lists_blog();
            $this->data['products'] = $this->products_model->get_lists_products();
            $this->data['clients'] = $this->clients_model->getClientsListsSummary();


            /* Load Template */
            $this->template->admin_render('admin/dashboard/index', $this->data);
        }
	}
}

