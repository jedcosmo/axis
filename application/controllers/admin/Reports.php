<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller {
    
    private $letters = array();
          
    public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push('Reports');
        $this->data['pagetitle'] = $this->page_title->show();
        
        $this->letters = range('A','Z');

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Reports', 'admin/reports');

        $this->load->model('admin/reports_model');
    }

    public function index(){
        $this->template->admin_render('admin/reports/index', $this->data);
    }

    public function client(){

        $this->load->model("admin/clients_model");
        $this->data["clients"] = $this->clients_model->get_lists_clients();

        $this->form_validation->set_rules('client_id', 'client_id', 'trim|required|min_length[0]|max_length[255]');

        if($this->input->post('submit') == "export") { 
            $this->client_export();
        }else{

            if($this->form_validation->run() == true ){

                $tr = "";

                $client_list = $this->reports_model->findAllClients($this->input->post("client_id"));
                $ctr1 = 1;
                foreach($client_list as $client){
                    $tr .= "<tr>";
                    $tr .= "<td><a href='".base_url()."admin/clients/profile/".$client->ID."'>".$client->first_name." ".$client->last_name."</a></td>";
                    $tr .= "<td>";
                    $client_activities = $this->reports_model->findActivitiesByClientId($client->ID);
                    foreach($client_activities as $ac){
                        $daily_activity_detail = $this->reports_model->findDailyActivityDetail($ac->activity_id);
                        $activity_detail = $this->reports_model->findActivityDetail($daily_activity_detail->activity);
                        $tr .= "<span class='label label-warning'>".date('F j, Y',strtotime($daily_activity_detail->date))."</span>&nbsp;&nbsp;";
                        $tr .= "<span class='label label-success'>".$daily_activity_detail->time_start." to ".$daily_activity_detail->time_end."</span>&nbsp;&nbsp;";
                        $tr .= "<span class='label label-info'>".$activity_detail->title."</span>";
                        $tr .= "<br/>";
                    }
                    $tr .= "</td>";
                    $tr .= "</tr>";
                }   
                $this->data['tr'] = $tr;
            }
        }

        $this->template->admin_render('admin/reports/client', $this->data);
    }

    public function activity(){
        $this->load->model("admin/activities_model");
        $this->data["activities"] = $this->activities_model->get_lists_activities();

        $this->form_validation->set_rules('activity_id', 'activity_id', 'trim|required|min_length[0]|max_length[255]');

        if($this->input->post('submit') == "export") { 
            $this->activity_export();
        }else{

            if($this->form_validation->run() == true ){

                if($this->input->post("from_date") == "" && $this->input->post("to_date") == "" ){
                    $tr = "";
                    $activity_list = $this->reports_model->findAllActivities($this->input->post("activity_id"));
                    foreach($activity_list as $activity){
                        $tr .= "<tr>";
                        $tr .= "<td>".$activity->title."</td>";
                        $tr .= "<td>";
                        
                        $daily_activities = $this->reports_model->displayDailyActivities();
                        foreach($daily_activities as $da){
                            if($activity->ID == $da->activity){
                                $client_activities = $this->reports_model->findActivitiesByActivityId($da->ID);
                                foreach($client_activities as $ca){
                                    $client_detail = $this->reports_model->findClient($ca->client_id);
                                    $tr .= "<span class='label label-warning'>".date('F j, Y', strtotime($da->date))."</span>&nbsp;&nbsp;";
                                    $tr .= "<span class='label label-success'>".$da->time_start." to ".$da->time_end."</span>&nbsp;&nbsp;";
                                    $tr .= "<a href='".base_url()."admin/clients/profile/".$client_detail->ID."'><span class='label label-info'>".$client_detail->first_name." ".$client_detail->last_name."</span></a>";
                                    $tr .="<br/>";
                                }
                            }
                        }

                        $tr .= "</td>";
                        $tr .= "</tr>";
                    }   
                    $this->data['tr'] = $tr;
                }

                if($this->input->post("from_date") != "" || $this->input->post("to_date") != "" ){
                    $tr = "";
                    $activity_list = $this->reports_model->findAllActivities($this->input->post("activity_id"));
                    foreach($activity_list as $activity){
                        $tr .= "<tr>";
                        $tr .= "<td>".$activity->title."</td>";
                        $tr .= "<td>";
                        
                        $daily_activities = $this->reports_model->displayDailyActivities();
                        foreach($daily_activities as $da){
                            $in_range = $this->check_in_range($this->input->post("from_date"), $this->input->post("to_date"), $da->date);
                            if($in_range == TRUE){
                                if($activity->ID == $da->activity){
                                    $client_activities = $this->reports_model->findActivitiesByActivityId($da->ID);
                                    foreach($client_activities as $ca){
                                        $client_detail = $this->reports_model->findClient($ca->client_id);
                                        $tr .= "<span class='label label-info'>".date('F j, Y', strtotime($da->date))."</span>&nbsp;&nbsp;";
                                        $tr .= "<span class='label label-success'>".$da->time_start." to ".$da->time_end."</span>&nbsp;&nbsp;";
                                        $tr .= $client_detail->first_name." ".$client_detail->last_name." ".$in_range;
                                        $tr .="<br/>";
                                    }
                                }
                            }

                        }

                        $tr .= "<td>";
                        $tr .= "</tr>";
                    }   
                    $this->data['tr'] = $tr;
                }


                $this->prepare_form_fields();
            }

        }

        $this->prepare_form_fields();
        $this->template->admin_render('admin/reports/activity', $this->data);
    }

    public function demographic(){

        $this->load->model("admin/clients_model");

        $this->form_validation->set_rules('demographic', 'demographic', 'trim|required|min_length[0]|max_length[255]');        

        if($this->input->post('submit') == "export") { 
            $this->demographic_export();
        }else{
            if($this->form_validation->run() == true ){
            $medicare_eligibility = $this->input->post('medicare_eligibility');
            $medicaid_eligibility = $this->input->post('medicaid_eligibility');
            $community_status = $this->input->post('community_status');
            $marital_status = $this->input->post('marital_status');
            $highest_completed_education = $this->input->post('highest_completed_education');
            $employment_status = $this->input->post('employment_status');
            $internet_access = $this->input->post('internet_access');
            $type_of_income = $this->input->post('type_of_income');
                if(isset($medicare_eligibility) || isset($medicaid_eligibility) || isset($community_status) || isset($marital_status) || isset($highest_completed_education) || isset($employment_status) || isset($internet_access) || isset($type_of_income)){
                    $tr = "";
                    $clients = $this->reports_model->findClientDemograpihcs( $this->input->post() );
                    foreach($clients as $client){
                        $tr .= "<tr>";
                        $tr .= "<td><a href='".base_url()."admin/clients/profile/".$client->ID."'>".$client->first_name." ".$client->last_name."</a".base_url()."admin/clients/profile/".$client->ID."></td>";
                        $tr .= "<td>".$client->email."</td>";
                        $tr .= "<td>".$client->phone."</td>";
                        $tr .= "</tr>";
                    }   
                    $this->data['tr'] = $tr;
                }
            }
        }

        $this->template->admin_render('admin/reports/demographic', $this->data);
    }

    public function goals(){

        $this->load->model("admin/clients_model");

        $this->form_validation->set_rules('goals', 'demographic', 'trim|min_length[0]|max_length[255]');    

        if($this->input->post('submit') == "export") { 
            $this->goals_export();
        }else{
            if($this->form_validation->run() == true ){
                $tr = "";
                $clients = $this->reports_model->findClientByGoals( $this->input->post() );
                foreach($clients as $client){
                    $tr .= "<tr>";
                    $tr .= "<td>".ucfirst(str_replace('_',' ',$client->value))."</td>";
                    $tr .= "<td><a href='".base_url()."admin/clients/profile/".$client->ID."'>".$client->first_name." ".$client->last_name."</a></td>";
                    $tr .= "<td>".$client->email."</td>";
                    $tr .= "<td>".$client->phone."</td>";
                    $tr .= "</tr>";
                }
                $this->data['tr'] = $tr;
            }
        }

        $this->template->admin_render('admin/reports/goals', $this->data);
    }


    private function prepare_form_fields( $content = array() ){
        
        $this->data['from_date'] = array(
                    'name'  => 'from_date',               
                    'class' => 'form-control datepicker date_filter',
                    'placeholder' => 'From',
                    'value' => set_value('from_date', (is_object($content) ? $content->from_date : '')),
            ); 
        
        $this->data['to_date'] = array(
                    'name'  => 'to_date',
                    'class' => 'form-control datepicker date_filter',
                    'placeholder' => 'To',
                    'value' => set_value('to_date', (is_object($content) ? $content->to_date : '')),
            );
        
    }

    private function check_in_range($start_date, $end_date, $date_from_user){
      // Convert to timestamp
      $start_ts = strtotime($start_date);
      $end_ts = strtotime($end_date);
      $user_ts = strtotime($date_from_user);

      // Check that user date is between start & end
      return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }
    
    public function attendance(){
        $this->load->model("admin/attendance_model");
        
        $this->data['results'] = array();
        $this->data['start_date'] = '';
        $this->data['end_date'] = '';
        $this->data['number_of_times'] = 0;
        
        if (isset($_POST) && !empty($_POST))
        {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $count = $this->input->post('number_of_times');
            
            $this->data['start_date'] = $start;
            $this->data['end_date'] = $end;
            $this->data['number_of_times'] = $count;
            
            $this->data['results'] = $this->attendance_model->getCSVQueryRangeExport($start, $end, $count);
        }
        
        $this->template->admin_render('admin/reports/attendance', $this->data);
    }
    
    public function attendance_export($start, $end, $count){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download'); 
        $this->load->model("admin/attendance_model");
                
        $delimiter = ",";
        $newline = "\r\n";
        $filename = 'attendance-between-['.$start.']-to-['.$end.'].csv';
        
        $result = $this->attendance_model->getCSVQueryRangeExport($start, $end, $count, true);
        
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data); 
    }

    public function client_export(){

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Reports');

        $this->load->model("admin/clients_model");
        $this->data["clients"] = $this->clients_model->get_lists_clients();

        $this->form_validation->set_rules('client_id', 'client_id', 'trim|required|min_length[0]|max_length[255]');         
        if($this->form_validation->run() == true ){

            $client_list = $this->reports_model->findAllClients($this->input->post("client_id"));
            $ctr1 = 2;
            $ctr3 = 2;
            
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
                                    
            $this->excel->getActiveSheet()->setCellValue('A1','First Name');
            $this->excel->getActiveSheet()->setCellValue('B1','Last Name');
            $this->excel->getActiveSheet()->setCellValue('C1','Activity');
            $this->excel->getActiveSheet()->setCellValue('D1','Schedule/Time');
            $this->excel->getActiveSheet()->setCellValue('E1','Added By');
            
            $this->excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            foreach($client_list as $client){                   
                

                $client_activities = $this->reports_model->findActivitiesByClientId($client->ID);
                $ctr2 = 0;
                $act_list = "";
                foreach($client_activities as $ac){
                    $daily_activity_detail = $this->reports_model->findDailyActivityDetail($ac->activity_id);
                    $activity_detail = $this->reports_model->findActivityDetail($daily_activity_detail->activity);
                    $act_list .= $activity_detail->title." [ ".date('F j, Y',strtotime($daily_activity_detail->date))." - ".$daily_activity_detail->time_start." to ".$daily_activity_detail->time_end." ]\n";
                    
                    $this->excel->getActiveSheet()->setCellValue('A'.$ctr3, $client->first_name);
                    $this->excel->getActiveSheet()->setCellValue('B'.$ctr3, $client->last_name);
                    $this->excel->getActiveSheet()->setCellValue('C'.$ctr3, $activity_detail->title);                    
                    $this->excel->getActiveSheet()->setCellValue('D'.$ctr3, date('F j, Y',strtotime($daily_activity_detail->date))." - ".$daily_activity_detail->time_start." to ".$daily_activity_detail->time_end);
                    $this->excel->getActiveSheet()->setCellValue('E'.$ctr3, $ac->admin_fname.' '.$ac->admin_lname);
                            
                    $ctr3++;
                }
                
                $ctr1++;
            }   

        }


        //$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
        //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
        //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $filename='report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


        $this->template->admin_render('admin/reports/client', $this->data);
    }

    public function activity_export(){
        
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Reports');
        
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

        $this->excel->getActiveSheet()->setCellValue('A1','Activity');
        $this->excel->getActiveSheet()->setCellValue('B1','First Name');
        $this->excel->getActiveSheet()->setCellValue('C1','Last Name');
        $this->excel->getActiveSheet()->setCellValue('D1','Date');
        $this->excel->getActiveSheet()->setCellValue('E1','Time');
        $this->excel->getActiveSheet()->setCellValue('F1','Phone');
        $this->excel->getActiveSheet()->setCellValue('G1','Alternative Phone');
        $this->excel->getActiveSheet()->setCellValue('H1','Email');
        $this->excel->getActiveSheet()->setCellValue('I1','Member Status');
        $this->excel->getActiveSheet()->setCellValue('J1','Added By');

        $this->excel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);

        if($this->input->post("from_date") == "" && $this->input->post("to_date") == "" ){
            $ctr1 = 2;
            $ctr2 = 2;
            $activity_list = $this->reports_model->findAllActivities($this->input->post("activity_id"));
                                    
            foreach($activity_list as $activity){

                $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                                                
                $client_list = "";
                $daily_activities = $this->reports_model->displayDailyActivities();
                foreach($daily_activities as $da){
                    if($activity->ID == $da->activity){
                        $client_activities = $this->reports_model->findActivitiesByActivityId($da->ID);                        
                                                                        
                        foreach($client_activities as $ca){
                            $client_detail = $this->reports_model->findClient($ca->client_id);
                            //$client_list .= $client_detail->first_name." ".$client_detail->last_name." [ ".date('F j, Y', strtotime($da->date))." - ".$da->time_start." to ".$da->time_end." ]\n";
                                                        
                            $this->excel->getActiveSheet()->setCellValue('A'.$ctr2, $activity->title);
                            $this->excel->getActiveSheet()->setCellValue('B'.$ctr2, $client_detail->last_name); 
                            $this->excel->getActiveSheet()->setCellValue('C'.$ctr2, $client_detail->first_name);
                            $this->excel->getActiveSheet()->setCellValue('D'.$ctr2, date('F j, Y',strtotime($da->date)));
                            $this->excel->getActiveSheet()->setCellValue('E'.$ctr2, $da->time_start." to ".$da->time_end);
                            $this->excel->getActiveSheet()->setCellValue('F'.$ctr2, $client_detail->phone);
                            $this->excel->getActiveSheet()->setCellValue('G'.$ctr2, $client_detail->alternative_phone);
                            $this->excel->getActiveSheet()->setCellValue('H'.$ctr2, $client_detail->email);   
                            $this->excel->getActiveSheet()->setCellValue('I'.$ctr2, ($client_detail->is_member == 'M' ? 'Member' : 'Non-member'));
                            $this->excel->getActiveSheet()->setCellValue('J'.$ctr2, $ca->user_name);
                            
                            $ctr2++;
                        }
                    }
                }
                
                $ctr1++;
            }   
        }

        if($this->input->post("from_date") != "" || $this->input->post("to_date") != "" ){
            $ctr1 = 2;
            $ctr2 = 2;
            
            $activity_list = $this->reports_model->findAllActivities($this->input->post("activity_id"));
            foreach($activity_list as $activity){
                
                $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);                
                
                $client_list = "";
                $daily_activities = $this->reports_model->displayDailyActivities();
                foreach($daily_activities as $da){
                    $in_range = $this->check_in_range($this->input->post("from_date"), $this->input->post("to_date"), $da->date);
                    if($in_range == TRUE){
                        if($activity->ID == $da->activity){
                            $client_activities = $this->reports_model->findActivitiesByActivityId($da->ID);
                            $client_list = "";
                            foreach($client_activities as $ca){
                                $client_detail = $this->reports_model->findClient($ca->client_id);
                                //$client_list .= $client_detail->first_name." ".$client_detail->last_name." [ ".date('F j, Y', strtotime($da->date))." - ".$da->time_start." to ".$da->time_end." ]\n";
                                
                                $this->excel->getActiveSheet()->setCellValue('A'.$ctr2, $activity->title);
                                $this->excel->getActiveSheet()->setCellValue('B'.$ctr2, $client_detail->last_name); 
                                $this->excel->getActiveSheet()->setCellValue('C'.$ctr2, $client_detail->first_name);
                                $this->excel->getActiveSheet()->setCellValue('D'.$ctr2, date('F j, Y',strtotime($da->date)));
                                $this->excel->getActiveSheet()->setCellValue('E'.$ctr2, $da->time_start." to ".$da->time_end);
                                $this->excel->getActiveSheet()->setCellValue('F'.$ctr2, $client_detail->phone);
                                $this->excel->getActiveSheet()->setCellValue('G'.$ctr2, $client_detail->alternative_phone);
                                $this->excel->getActiveSheet()->setCellValue('H'.$ctr2, $client_detail->email);   
                                $this->excel->getActiveSheet()->setCellValue('I'.$ctr2, ($client_detail->is_member == 'M' ? 'Member' : 'Non-member'));
                                $this->excel->getActiveSheet()->setCellValue('J'.$ctr2, $ca->user_name);
                                
                                $ctr2++;
                            }
                        }
                    }

                }
                
                $ctr1++;
            }   
        }

        $filename='report.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
                     
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');

    }
    
    public function demographic_export(){

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Reports');

        $this->load->model("admin/clients_model");
        $this->form_validation->set_rules('demographic', 'demographic', 'trim|required|min_length[0]|max_length[255]');
        
        $letters = $this->letters;
        $sample_array = array();
        $sample_array['medicare_eligibility'] = 1;
        $sample_array['demographic'] = 1;
        $sample_array['submit'] = 'export';
        
        $select_fields = 'member_id,is_member,email,first_name,last_name,gender,';
        $select_fields .= 'date_of_birth,home_address,city,state,zip,phone,alternative_phone,';
        $select_fields .= 'medicare_eligibility,medicare_eligibility_active,medicare_number,medicaid_eligibility,medicaid_number,community_status,';
        $select_fields .= 'marital_status,highest_completed_education,employment_status,internet_access,type_of_income,other_income,';
        $select_fields .= 'date_created,created_by';
        
        $select_fields =  explode(',', $select_fields);

        $header = 'A';        
        $header_repeat = '';
        foreach($select_fields as $field){                        
            if($field == 'is_member'){
                $title = 'Member Status';
            }else{
                $title = str_replace("_", " ", $field);
            }
            
            //if excel column letters already reached all.
            if($header > count($letters)){
                $header_repeat = 'A';
            }
            
            $this->excel->getActiveSheet()->getColumnDimension($header.$header_repeat)->setWidth(35);
            $this->excel->getActiveSheet()->getStyle($header.$header_repeat."1")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->setCellValue($header.$header_repeat."1", ucfirst($title)); 
            $header++;           
        }
               
        if($this->form_validation->run() == true ){

            $ctr1 = 2;
            $letter_ctr = 0;
            $clients = $this->reports_model->findClientDemograpihcs( $sample_array );
            $letter_repeat = '';
            foreach($clients as $client){

                $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                
                foreach($select_fields as $field){        
                    $l = $letters[$letter_ctr];
                    
                    //if excel column letters already reached all.
                    if($letter_ctr >= count($letters)){
                        $letter_repeat = 'A';
                        $l = $letter_repeat;
                    }
                    //echo $l.' -- '.$letter_ctr.' -- '.count($letters).$letter_repeat.' -- '.$field.'<br />';
                    $this->excel->getActiveSheet()->getColumnDimension($l.$letter_repeat)->setWidth(35); 
                    
                    if($field == 'is_member'){
                        $field_value = ($client->$field == 'M' ? 'Member' : 'Non-member');
                    }else{
                        $field_value = $client->$field;
                    }
                                                            
                    $this->excel->getActiveSheet()->setCellValue($l.$letter_repeat.$ctr1, $field_value);
                                                            
                    $letter_ctr++;
                }
                
                $letter_ctr = 0;
                $letter_repeat = '';
                $ctr1++;

            }   

        }
        
        $filename='report.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
                     
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');

    }

    public function goals_export(){

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Reports');

        $this->load->model("admin/clients_model");
        $this->form_validation->set_rules('goals', 'demographic', 'trim|min_length[0]|max_length[255]');

        $this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E1")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G1")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue("A1", "Goal");
        $this->excel->getActiveSheet()->setCellValue("B1", "First Name");
        $this->excel->getActiveSheet()->setCellValue("C1", "Last Name");
        $this->excel->getActiveSheet()->setCellValue("D1", "Email");
        $this->excel->getActiveSheet()->setCellValue("E1", "Phone");
        $this->excel->getActiveSheet()->setCellValue("F1", "Alternative Phone");
        $this->excel->getActiveSheet()->setCellValue("G1", "Created by");

        $ctr1 = 2;
        if($this->form_validation->run() == true ){
            $clients = $this->reports_model->findClientByGoals( $this->input->post() );
            foreach($clients as $client){

                $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
                $this->excel->getActiveSheet()->setCellValue('A'.$ctr1, ucfirst(str_replace('_',' ',$client->value)));
                $this->excel->getActiveSheet()->setCellValue('B'.$ctr1, $client->first_name);
                $this->excel->getActiveSheet()->setCellValue('C'.$ctr1, $client->last_name);
                $this->excel->getActiveSheet()->setCellValue('D'.$ctr1, $client->email);
                $this->excel->getActiveSheet()->setCellValue('E'.$ctr1, $client->phone);
                $this->excel->getActiveSheet()->setCellValue('F'.$ctr1, $client->alternative_phone);
                $this->excel->getActiveSheet()->setCellValue('G'.$ctr1, $client->created_by);
                $ctr1++;

            }
        }

        $filename='report.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
                     
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');

    }
    
}

