<?php
/*
 * @devloper: j.dymosco
 * @date: 2017-01-31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends Admin_Controller {
          
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/attendance_model');

        /* Title Page :: Common */
        $this->page_title->push('Attendance');
        $this->data['pagetitle'] = $this->page_title->show();
        
    }
    
    public function index(){
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show(); 
        $this->data['attendance'] = $this->attendance_model->get_attendance_lists();
        $this->data['attendance_edit_details'] = '';
        $this->data['action_url'] = '/create';
        $this->data['form_action'] = '';
        $this->data['form_header_title'] = 'Create';
                                
        $this->_prepareAttendanceFormFields();

        /* Load Template */
        $this->template->admin_render('admin/attendance/index', $this->data);
    }
    
    public function create(){
        $inserted_id = $this->attendance_model->create_attendance( $this->input->post() );
        
        $this->session->set_flashdata('message', 'New Attendance successfully created.');                    
        redirect('admin/attendance/edit/'.$inserted_id, 'refresh');
    }    
    
    public function edit( $attendance_id ){ 
        $attendance_details = '';
        $this->data['action_url'] = '';
        $this->data['form_action'] = 'update';
        $this->data['form_header_title'] = 'Edit';
        
        if( $this->input->post('form_action') && $this->input->post('form_action') == 'update' ){
            $this->attendance_model->update_attendance( $this->input->post() );
            
            $this->session->set_flashdata('message', 'Attendance successfully updated.');
            redirect('admin/attendance/edit/'.$attendance_id, 'refresh');
        }
        
        if( !empty($attendance_id) ){
            $attendance_details = $this->attendance_model->get_attendance_details( $attendance_id ); 
            $attendance_attendees = $this->attendance_model->get_attendance_attendees( $attendance_id );
            
            $this->data['attendance_date'] = $attendance_details->attendance_date;
            $this->data['attendance_id'] = $attendance_details->attendance_id;
            $this->data['attendance_notes'] = $attendance_details->attendance_notes;
            $this->data['attendance_status'] = $attendance_details->status;
            $this->data['attendance_attendees'] = $attendance_attendees;
        }
        
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show(); 
        $this->data['attendance'] = $this->attendance_model->get_attendance_lists();
        $this->data['attendance_edit_details'] = '';
                                
        $this->_prepareAttendanceFormFields( $attendance_details );

        /* Load Template */
        $this->template->admin_render('admin/attendance/index', $this->data);
    }
    
    public function delete( $attendance_id ){
        $this->attendance_model->delete_attendance( $attendance_id );
        
        $this->session->set_flashdata('message', 'Attendance successfully deleted.');
        redirect('admin/attendance', 'refresh');
    }
    
    public function completed( $attendance_id ){
        $this->attendance_model->set_attendance_completed( $attendance_id );
        
        $this->session->set_flashdata('message', 'Attendance successfully set to completed.');
        redirect('admin/attendance', 'refresh');
    }
    
    public function export($id = 0, $format = 'pdf'){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');        
                
        $delimiter = ",";
        $newline = "\r\n";
        
        $attendance = $this->attendance_model->get_attendance_details( $id );
        
        $filename = 'Attendance-['.$attendance->attendance_date.'-'.$attendance->status.'-'.date('Y-m-d',strtotime($attendance->date_created)).']-Attendees.csv';
        
        $result = $this->attendance_model->getCSVQueryExport( $id );
        
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);                      
        force_download($filename, $data);
    }
    
    private function _prepareAttendanceFormFields( $object = '' ){
        $this->object = $object;
        
        $this->data['attendance_date'] = array(
                'name'  => 'attendance_date',
                'id'    => 'attendance_date',
                'type'  => 'text',                
                'class' => 'form-control',
                'placeholder' => 'Attendance Date',
                'autocomplete' => 'off',
                'size' => '70',
                'value' => $this->form_validation->set_value('attendance_date', $this->_setObjectHasValue('attendance_date')),
        );
        
        $this->data['notes'] = array(
                    'name'  => 'notes',
                    'id'    => 'notes',                    
                    'class' => 'form-control',
                    'placeholder' => 'Notes',
                    'rows' => '3',
                    'value' => set_value('notes', (is_object($object) ? $object->attendance_notes : '')),
        );
    }
    
    //Method that will set client text field value if object has value.
    private function _setObjectHasValue( $property ){        
        return (is_object($this->object) ? $this->object->$property : '');
    }
    
}