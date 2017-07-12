<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends Admin_Controller {

    public $pdf;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('admin/clients_model');
        $this->load->model('admin/clientDemographics_model');
        $this->load->model('admin/clientAssessment_model');
        $this->load->model('admin/clientAuthorizationRequest_model');
        $this->load->model('admin/clientInitialAssessment_model');        
    }
    
    public function index(){

        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['clients'] = $this->clients_model->getClientsListsSummary();

        /* Load Template */
        $this->template->admin_render('admin/clients/index', $this->data);
    }

    public function profile($id){

        $this->load->model('admin/clientDemographics_model');
        
        $client_info = $this->clientDemographics_model->get_details($id);

        $this->_prepareDemographicsFormFields( $client_info );
        $this->template->admin_render('admin/clients/client_profile', $this->data);
    }

    private function _prepareDemographicsFormFields( $client_info = '' ){
        $this->client_object = $client_info;
        
         $this->data['member_id'] = array(
                'name'  => 'member_id',
                'id'    => 'member_id',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'Member ID/No.',
                'value' => $this->form_validation->set_value('member_id', $this->_setObjectClientMemberIDHasValue()),
        );
         
        $this->data['is_member'] = array(
                'name'  => 'is_member',
                'id'    => 'is_member',
                'disabled' => 'disabled',
                'type'  => 'checkbox',                
                'checked' => set_checkbox('is_member', 'M', $this->_fieldIsMemberIfChecked('is_member', 'M'))
        );
        
        $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'First Name',
                'value' => $this->form_validation->set_value('first_name', $this->_setObjectHasValue('first_name')),
        );
        
        $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'Last Name',
                'value' => $this->form_validation->set_value('last_name', $this->_setObjectHasValue('last_name')),
        );
        
        $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'email',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'Email',
                'value' => $this->form_validation->set_value('email', $this->_setObjectHasValue('email')),
        );
        
        $this->data['gender_male'] = array(
                'name'  => 'gender',
                'id'    => 'gender_male',                                
                'value' => 'M',
                'disabled' => 'disabled',
                'checked' => set_radio('gender', 'M', $this->_statusRadioIfChecked( 'gender', 'M' ))
        );
        
        $this->data['gender_female'] = array(
                'name'  => 'gender',
                'id'    => 'gender_female',                                
                'value' => 'F',
                'disabled' => 'disabled',
                'checked' => set_radio('gender', 'F', $this->_statusRadioIfChecked( 'gender', 'F' ))
        );
        
        $this->data['ssn'] = array(
                'name'  => 'ssn',
                'id'    => 'ssn',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'Social Security Number',
                'value' => $this->form_validation->set_value('ssn', $this->_setObjectHasValue('ssn')),
        );
        
        $this->data['dob'] = array(
                'name'  => 'dob',
                //'id'    => 'dob',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control pull-right',
                'placeholder' => 'e.g. YYYY-MM-DD',
                'value' => $this->form_validation->set_value('dob', $this->_setObjectHasValue('date_of_birth')),
        );
        
        $this->data['home_address'] = array(
                'name'  => 'home_address',
                'id'    => 'home_address',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'Home Address',
                'value' => set_value('home_address', $this->_setObjectHasValue('home_address')),
        );
        
        $this->data['city'] = array(
                'name'  => 'city',
                'id'    => 'city',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'City',
                'value' => set_value('city', $this->_setObjectHasValue('city')),
        );
        
        $this->data['state'] = array(
                'name'  => 'state',
                'id'    => 'state',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'State',
                'value' => set_value('state', $this->_setObjectHasValue('state')),
        );
        
        $this->data['zip'] = array(
                'name'  => 'zip',
                'id'    => 'zip',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'Zip',
                'value' => set_value('zip', $this->_setObjectHasValue('zip')),
        );
        
        $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'readonly' => 'true',
                'class' => 'form-control',
                'placeholder' => 'Phone',
                'value' => set_value('phone', $this->_setObjectHasValue('phone')),
        );
        
        //Group radio buttons.
        //this will be our flagger if the block for active fields should be shown.
        $this->data['medicare_eligibility_val'] = ( (is_object($client_info) && $client_info->medicare_eligibility) ? $client_info->medicare_eligibility : $this->input->post('medicare_eligibility') ); 
        $this->data['medicare_eligibility_yes'] = array(
                'name'  => 'medicare_eligibility',
                'id'    => 'medicare_eligibility_yes',                                
                'value' => '1',
                'disabled' => 'disabled',
                'checked' => set_radio('medicare_eligibility', '1', $this->_statusRadioIfChecked( 'medicare_eligibility', '1' ))
        );
            //If yes was selected for radio medicare_eligibility
            $this->data['medicare_eligibility_active'] = array(
                    'name'  => 'medicare_eligibility_active',
                    'id'    => 'medicare_eligibility_active',                                
                    'value' => '1',
                    'disabled' => 'disabled',
                    'checked' => set_radio('medicare_eligibility_active', '1', $this->_statusRadioIfChecked( 'medicare_eligibility_active', '1' ))
            );        
            $this->data['medicare_eligibility_notactive'] = array(
                    'name'  => 'medicare_eligibility_active',
                    'id'    => 'medicare_eligibility_notactive',                                
                    'value' => '0',
                    'disabled' => 'disabled',
                    'checked' => set_radio('medicare_eligibility_active', '0', $this->_statusRadioIfChecked( 'medicare_eligibility_active', '0' ))
            );
        $this->data['medicare_eligibility_no'] = array(
                'name'  => 'medicare_eligibility',
                'id'    => 'medicare_eligibility_no',                                
                'value' => '0',
                'disabled' => 'disabled',
                'checked' => set_radio('medicare_eligibility', '0', $this->_statusRadioIfChecked( 'medicare_eligibility', '0' ))
        );
        
        $this->data['medicaid_eligibility_val'] = ( (is_object($client_info) && $client_info->medicaid_eligibility) ? $client_info->medicaid_eligibility : $this->input->post('medicaid_eligibility') ); 
        $this->data['medicaid_eligibility_yes'] = array(
                'name'  => 'medicaid_eligibility',
                'id'    => 'medicaid_eligibility_yes',                                
                'value' => '1',
                'disabled' => 'disabled',
                'checked' => set_radio('medicaid_eligibility', '1', $this->_statusRadioIfChecked( 'medicaid_eligibility', '1' ))
        );
            $this->data['medicaid_number'] = array(
                    'name'  => 'medicaid_number',
                    'id'    => 'medicaid_number',
                    'type'  => 'text',
                    'disabled' => 'disabled',
                    'class' => 'form-control',
                    'placeholder' => 'Medicaid Number',
                    'value' => set_value('medicaid_number', $this->_setObjectHasValue('medicaid_number')),
            );
        $this->data['medicaid_eligibility_no'] = array(
                'name'  => 'medicaid_eligibility',
                'id'    => 'medicaid_eligibility_no',                                
                'value' => '0',
                'disabled' => 'disabled',
                'checked' => set_radio('medicaid_eligibility', '0', $this->_statusRadioIfChecked( 'medicaid_eligibility', '0' ))
        );
        
        //Community status radio buttons
        $community_status = array('community' => 'Live in community',
                                  'housing' => 'Transitional Housing',
                                  'nursing' => 'Nursing Home'); 
        $this->data['community_status_radios'] = $community_status;
        foreach($community_status as $key => $val):
            $field_value = strtolower(str_replace(' ', '-', $val));
        
            $this->data['community_status_radio_attr'][$key] = array(
                    'name'  => 'community_status',
                    'id'    => 'community_status_'.$key,                                
                    'value' => $field_value,
                    'disabled' => 'disabled',
                    'checked' => set_radio('community_status', $field_value, $this->_statusRadioIfChecked( 'community_status', $field_value ))
            );
        endforeach;
        
        //Marital status radio buttons
        $marital_status = array('married' => 'Married',
                                'not-married' => 'Not Married',
                                'divorced' => 'Divorced',
                                'separated' => 'Separated'); 
        $this->data['marital_status_radios'] = $marital_status;
        foreach($marital_status as $key => $val):            
            $this->data['marital_status_radio_attr'][$key] = array(
                    'name'  => 'marital_status',
                    'id'    => 'marital_status_'.$key,                                
                    'value' => $key,
                    'disabled' => 'disabled',
                    'checked' => set_radio('marital_status', $key, $this->_statusRadioIfChecked( 'marital_status', $key ))
            );
        endforeach;
        
        //Highest Completed Education radio buttons
        $compeleted_education = array('high-school' => 'High School',
                                'some-college' => 'Some College',
                                'college' => 'College',
                                'graduated' => 'Graduated',
                                'phd' => 'PhD'); 
        $this->data['compeleted_education_radios'] = $compeleted_education;
        foreach($compeleted_education as $key => $val):                    
            $this->data['compeleted_education_radio_attr'][$key] = array(
                    'name'  => 'highest_completed_education',
                    'id'    => 'highest_completed_education_'.$key,                                
                    'value' => $key,
                    'disabled' => 'disabled',
                    'checked' => set_radio('highest_completed_education', $key, $this->_statusRadioIfChecked( 'highest_completed_education', $key ))
            );
        endforeach;
        
        //Type of income radio buttons
        $type_of_income = array('ssi' => 'SSI',
                                'ssdi' => 'SSDI',
                                'other' => 'Other'); 
        $type_of_income_checked = ( (is_object($client_info) && $client_info->type_of_income) ? $client_info->type_of_income : $this->input->post('type_of_income') );         
        $this->data['type_of_income_radios'] = $type_of_income;
        foreach($type_of_income as $key => $val):                    
            $this->data['type_of_income_radio_attr'][$key] = array(
                    'name'  => 'type_of_income',
                    'id'    => 'type_of_income_'.$key,                                
                    'value' => $key,
                    'disabled' => 'disabled',
                    'checked' => set_radio('type_of_income', $key, $this->_statusRadioIfChecked( 'type_of_income', $key ))
            );
        endforeach;
        $this->data['type_of_icome_other_income'] = array(
                    'name'  => 'other_income',
                    'id'    => 'other_income',
                    'type'  => 'text',
                    'disabled' => 'disabled',
                    'class' => 'form-control' . (($type_of_income_checked == 'other') ? '' : ' hidden'),
                    'placeholder' => 'Other Income',
                    'value' => set_value('other_income', $this->_setObjectHasValue('other_income')),
            );
        
        //Employment status radio buttons
        $employment_status = array('1' => 'Employed', '0' => 'Unemployed'); 
        $this->data['employment_status_radios'] = $employment_status;
        
        foreach($employment_status as $key => $val):            
            $this->data['employment_status_radio_attr'][$key] = array(
                    'name'  => 'employment_status',
                    'id'    => 'employment_status_'.$key,                                
                    'value' => $key,
                    'disabled' => 'disabled',
                    'checked' => set_radio('employment_status', $key, $this->_statusRadioIfChecked( 'employment_status', $key ))
            );
        endforeach;
        
        //Internet Access radio buttons
        $internet_access = array('1' => 'Yes', '0' => 'No'); 
        $this->data['internet_access_radios'] = $internet_access;
        foreach($internet_access as $key => $val):             
            $this->data['internet_access_radio_attr'][$key] = array(
                    'name'  => 'internet_access',
                    'id'    => 'internet_access_'.$key,                                
                    'value' => $key,
                    'disabled' => 'disabled',
                    'checked' => set_radio('internet_access', $key, $this->_statusRadioIfChecked( 'internet_access', $key ))
            );
        endforeach;
    }
    
    public function export($id = '', $type = '', $format = 'pdf'){
        if(is_numeric($id) && $id > 0 && $format == 'pdf'){
            $this->_exportPDFormat($id, $type); //$id => Client ID
        }
        
        if(is_string($id) && $id == 'all' && $format == 'csv'){
            $this->_exportCSVFormat($type);
        }
    }
    
    public function autocomplete(){
        $keyword = $this->input->get('search');
        $results = $this->clients_model->get_clients($keyword, "`ID`, CONCAT(`first_name`,' ', `last_name`) AS `client_name`");
        
        echo json_encode($results);
        die();
    }

    //Method that will set client radio field(s) status information if checked/selected or not.
    private function _statusRadioIfChecked( $property, $key ){
        return ( (is_object($this->client_object) && !is_null($this->client_object->$property) && $this->client_object->$property == $key ) ? TRUE : FALSE );
    }
    
    private function _fieldIsMemberIfChecked( $property, $key ){
        return ( (is_object($this->client_object) && !is_null($this->client_object->$property) && $this->client_object->$property == $key ) ? TRUE : FALSE );
    }
    
    //Method that will set client text field value if object has value.
    private function _setObjectHasValue( $property ){
        return (is_object($this->client_object) ? $this->client_object->$property : '');
    }
    
    //Method that will set client auto generated member id.
    private function _setObjectClientMemberIDHasValue(){
        $hasMemberID = $this->_setObjectHasValue( 'member_id' );
        if( $hasMemberID ){
            return $hasMemberID;
        }else{
            return $this->clientDemographics_model->setClientMemberID();
        }
    }
    
    private function _exportPDFormat($client_id, $type){
        $this->load->library("Pdf");
        
        $type_header = ucwords(str_replace('-',' ',$type));
                        
        // create new PDF document
        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // set default header data
        $this->pdf->SetHeaderData('', '', 'Client - '.$type_header, "The Axis Project\nwww.wheelingforward.org", array(0,0,0), array(0,0,0));

        // set margins
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // set default font subsetting mode
        $this->pdf->setFontSubsetting(true);
        
        // set font
        $this->pdf->SetFont('helvetica', '', 10);        
        
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $this->pdf->AddPage();
                                
        // Set some content to print / display content       
        $this->_getExportPDFFormatByType($type, $client_id);                        
                
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $this->pdf->Output($type.'_'.$client_id.'.pdf', 'I');
    }
    
    private function _exportCSVFormat($type){        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');        
                
        $delimiter = ",";
        $newline = "\r\n";
        $filename = 'clients-'.$type.'-'.date('Y-m-d').".csv";
        
        if($type == 'demographics'){
           $result = $this->clientDemographics_model->getCSVQueryExport();
        }else if($type == 'assessment'){
           $result = $this->clientAssessment_model->getCSVQueryExport();           
        }else if($type == 'post-initial-assessment'){
           $result = $this->clientInitialAssessment_model->getCSVQueryExport(); 
        }else if($type == 'authorization-request'){
           $result = $this->clientAuthorizationRequest_model->getCSVQueryExport(); 
        }                       
                          
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);                      
        force_download($filename, $data);                       
    }        
    
    private function _getExportPDFFormatByType($type, $client_id){
        if($type == 'demographics'){
            $this->_formatExportPDFClientDemographics($client_id);
        }else if($type == 'assessment'){
            $this->_formatExportPDFClientAssessment($client_id);
        }else if($type == 'post-initial-assessment'){
            $this->_formatExportPDFClientPostInitialAssessment($client_id);
        }else if($type == 'authorization-request'){
            $this->_formatExportPDFClientAuthorizationRequest($client_id);
        }
    }
    
    private function _formatExportPDFClientDemographics( $client_id ){
        $client_details = $this->clientDemographics_model->get_details( $client_id );        
        $element = '';
                
        if( is_object($client_details) || is_array($client_details) ){
            $element = "<p><b>Client Name:</b> $client_details->first_name $client_details->last_name";
            $element .= "<br /><b>Member ID:</b> ".$client_details->member_id;
            $element .= "<br /><b>Email Address:</b> ".$client_details->email;
            $element .= "<br /><b>Home Address:</b> ".$client_details->home_address.' '.$client_details->city.' '.$client_details->state;
            $element .= "<br /><b>Gender:</b> ".$client_details->gender;
            $element .= "<br /><b>Date of Birth:</b> ".$client_details->date_of_birth;
            $element .= "<br /><b>SSN:</b> ".$client_details->ssn;            
            $element .= "<br /><b>Phone:</b> ".$client_details->phone;
            $element .= "<br /><b>Alternative Phone:</b> ".$client_details->alternative_phone;
            $element .= "<br /><b>Medicare Eligibility:</b> ".($client_details->medicare_eligibility >= 1 ? 'Yes' : 'No');
            $element .= "<br /><b>Medicare Eligibility Active?:</b> ".($client_details->medicare_eligibility_active >= 1 ? 'Active' : 'Not Active');
            $element .= "<br /><b>Medicare Number:</b> ".$client_details->medicare_number;
            $element .= "<br /><b>Medicaid Eligibility:</b> ".($client_details->medicaid_eligibility >= 1 ? 'Yes' : 'No');
            $element .= "<br /><b>Community Status:</b> ".ucfirst(str_replace('-',' ',$client_details->community_status));
            $element .= "<br /><b>Marital Status:</b> ".ucfirst(str_replace('-',' ',$client_details->marital_status));
            $element .= "<br /><b>Highest Completed Education:</b> ".ucfirst(str_replace('-',' ',$client_details->highest_completed_education));
            $element .= "<br /><b>Employment Status:</b> ".($client_details->employment_status >= 1 ? 'Employed' : 'Unemployed');
            $element .= "<br /><b>Internet Access:</b> ".($client_details->internet_access >= 1 ? 'Yes' : 'No');
            $element .= "<br /><b>Type of Income:</b> ".$client_details->type_of_income;
            $element .= "<br /><b>Other Income:</b> ".$client_details->other_income."</p>";
        }        
        
        // Print text using writeHTMLCell()
        $this->pdf->writeHTMLCell(0, 0, '', '', $element, 0, 1, 0, true, '', true);
    }
    
    private function _formatExportPDFClientAssessment( $client_id ){
        $client_summary_details = $this->clients_model->getClientSummaryDetailsByMemberID( $client_id );
        $client_assessment_details = $this->clientAssessment_model->prepareClientAssessmentStatus( $client_id );
        $key_pattern = array('primary_diagnosis', 'secondary_diagnosis', 'cognitive_skills');
        $element = '';
        
        if( is_object($client_summary_details) || is_array($client_summary_details) ){
            $element = "<p><b>Client Name:</b> $client_summary_details->first_name $client_summary_details->last_name";
            $element .= "<br /><b>Member ID:</b> ".$client_summary_details->member_id."</p>";                                     
           
            if( $client_assessment_details ){
                $element .= "<p>";
                foreach($client_assessment_details as $key => $details){                    
                    $key_label = ucwords(str_replace('_',' ',$key));
                    $element .= "<br /> <b>$key_label:</b> ". ( is_array($details) ? implode(', ', $this->_cleanupExportFormatArrayText($details, $key, $key_pattern)) : $this->_cleanupExportFormatArrayText($details, $key, $key_pattern) );
                    if($key == 'assessment_reason' || $key == 'supervision_and_assisstance'){
                        $element .= "<br />"; 
                    }
                }
                $element .= "</p>";                
            }
        }
        
        // Print text using writeHTMLCell()
        $this->pdf->writeHTMLCell(0, 0, '', '', $element, 0, 1, 0, true, '', true);
    }
    
    private function _formatExportPDFClientPostInitialAssessment( $client_id ){
        $client_summary_details = $this->clients_model->getClientSummaryDetailsByMemberID( $client_id );
        $client_initial_assessment = $this->clientInitialAssessment_model->getClientInitialAssessmentByMemberID( $client_id );
        $element = '';
        
        if( is_object($client_summary_details) || is_array($client_summary_details) ){
            $element = "<p><b>Client Name:</b> $client_summary_details->first_name $client_summary_details->last_name";
            $element .= "<br /><b>Member ID:</b> ".$client_summary_details->member_id."</p><br /><br />";
            
            if( $client_initial_assessment ){
                $element .= "<p><br /><b>Requested Weekly List:</b> ".$client_initial_assessment->number_of_days_per_week." days a week";
                $element .= "<br /><b>Proposed Start Date:</b> ".$client_initial_assessment->proposed_start_date;
                $element .= "<br /><b>Proposed End Date:</b> ".$client_initial_assessment->proposed_end_date."<br /></p>";
                
                $element .= "<p><b>Notes:</b> ".$client_initial_assessment->notes;
                $element .= "<br /><b>Completed By:</b> ".$client_initial_assessment->completed_by;
                $element .= "<br /><b>Date Completed:</b> ".$client_initial_assessment->date."<br /></p>";
            }                                                            
        }               
                
        // Print text using writeHTMLCell()
        $this->pdf->writeHTMLCell(0, 0, '', '', $element, 0, 1, 0, true, '', true);
        
        if( $client_initial_assessment ){
            $header = array('Selected', 'Goal', 'Current Level', 'Expected Outcome');
            $w = array(18, 60, 30, 72);
            $data = array(
                array(($client_initial_assessment->weight_loss ? 'Yes' : 'No'), 'Weight Loss', $client_initial_assessment->weight_loss_current_level, $client_initial_assessment->weight_loss_expected_outcome),
                array(($client_initial_assessment->increased_strength ? 'Yes' : 'No'),'Increased Strength', $client_initial_assessment->increased_strength_current_level,$client_initial_assessment->increased_strength_expected_outcome),
                array(($client_initial_assessment->increased_wheelchair_mobilization ? 'Yes' : 'No'),'Increased Wheelchair Mobilization', $client_initial_assessment->increased_wheelchair_mobilization_current_level, $client_initial_assessment->increased_wheelchair_mobilization_expected_outcome),
                array(($client_initial_assessment->increased_self_sufficiency ? 'Yes' : 'No'),'Increased Self-Sufficiency', $client_initial_assessment->increased_self_sufficiency_current_level, $client_initial_assessment->increased_self_sufficiency_expected_outcome),
                array(($client_initial_assessment->increased_socialization ? 'Yes' : 'No'),'Increased Socialization', $client_initial_assessment->increased_socialization_current_level, $client_initial_assessment->increased_socialization_expected_outcome),
                array(($client_initial_assessment->reduced_hospitalization ? 'Yes' : 'No'),'Reduced Hospitalization', $client_initial_assessment->reduced_hospitalization_current_level, $client_initial_assessment->reduced_hospitalization_expected_outcome),
                array(($client_initial_assessment->increased_aerobic_function ? 'Yes' : 'No'),'Increased Aerobic Function', $client_initial_assessment->increased_aerobic_function_current_level, $client_initial_assessment->increased_aerobic_function_expected_outcome),
                array(($client_initial_assessment->improve_transfer ? 'Yes' : 'No'),'Improve Transfer', $client_initial_assessment->improve_transfer_current_level, $client_initial_assessment->improve_transfer_expected_outcome),
                array(($client_initial_assessment->pursue_vocation ? 'Yes' : 'No'),'Pursue Vocation', $client_initial_assessment->pursue_vocation_current_level, $client_initial_assessment->pursue_vocation_expected_outcome),
                array(($client_initial_assessment->pursue_education ? 'Yes' : 'No'),'Pursue Education', $client_initial_assessment->pursue_education_current_level, $client_initial_assessment->pursue_education_expected_outcome),
                array(($client_initial_assessment->increased_self_advocacy ? 'Yes' : 'No'),'Increased Self-Advocacy', $client_initial_assessment->increased_self_advocacy_current_level, $client_initial_assessment->increased_self_advocacy_expected_outcome),
            );
            $this->_formatExportClientPIATablePDF( $header, $data, $w );
            
            $element = "";
            $this->pdf->writeHTMLCell(0, 0, '', '', $element, 0, 1, 0, true, '', true);
            
            $header = array('Selected', 'Activity', 'per week');
            $w = array(18, 85, 77);
            $data = array(
                array(($client_initial_assessment->acupuncture ? 'Yes' : 'No'), 'Acupuncture', $client_initial_assessment->acupuncture_times),
                array(($client_initial_assessment->advocacy ? 'Yes' : 'No'), 'Advocacy', $client_initial_assessment->advocacy_times),
                array(($client_initial_assessment->aerobics ? 'Yes' : 'No'), 'Aerobics', $client_initial_assessment->aerobics_times),
                array(($client_initial_assessment->art_therapy ? 'Yes' : 'No'), 'Art Therapy', $client_initial_assessment->art_therapy_times),                
                array(($client_initial_assessment->boxing_fitness ? 'Yes' : 'No'), 'Boxing Fitness', $client_initial_assessment->boxing_fitness_times),
                array(($client_initial_assessment->cardio_training ? 'Yes' : 'No'), 'Cardio Training', $client_initial_assessment->cardio_training_times),
                array(($client_initial_assessment->communications ? 'Yes' : 'No'), 'Communications', $client_initial_assessment->communications_times),
                array(($client_initial_assessment->community_engagement ? 'Yes' : 'No'), 'Community Engagement', $client_initial_assessment->community_engagement_times),
                array(($client_initial_assessment->community_services ? 'Yes' : 'No'), 'Community Services', $client_initial_assessment->community_services_times),
                array(($client_initial_assessment->community_trips ? 'Yes' : 'No'), 'Community Trips', $client_initial_assessment->community_trips_times),
                array(($client_initial_assessment->computer_class ? 'Yes' : 'No'), 'Computer Class', $client_initial_assessment->computer_class_times),
                array(($client_initial_assessment->cooking_training ? 'Yes' : 'No'), 'Cooking Training', $client_initial_assessment->cooking_training_times),
                array(($client_initial_assessment->counseling_media ? 'Yes' : 'No'), 'Counseling Media', $client_initial_assessment->counseling_media_times),
                array(($client_initial_assessment->driving_lessons ? 'Yes' : 'No'), 'Driving Lessons', $client_initial_assessment->driving_lessons_times),
                array(($client_initial_assessment->fitness_bands ? 'Yes' : 'No'), 'Fitness bands', $client_initial_assessment->fitness_bands_times),
                array(($client_initial_assessment->general_health ? 'Yes' : 'No'), 'General Health & Preventative Care Classes', $client_initial_assessment->general_health_times),
                array(($client_initial_assessment->hha_training ? 'Yes' : 'No'), 'HHA Training', $client_initial_assessment->hha_training_times),
                array(($client_initial_assessment->independent_living_skills ? 'Yes' : 'No'), 'Independent Living Skills', $client_initial_assessment->independent_living_skills_times),
                array(($client_initial_assessment->indoor_spinning ? 'Yes' : 'No'), 'Indoor Spinning', $client_initial_assessment->indoor_spinning_times),
                array(($client_initial_assessment->martial_arts ? 'Yes' : 'No'), 'Martial Arts', $client_initial_assessment->martial_arts_times),
                array(($client_initial_assessment->massage ? 'Yes' : 'No'), 'Massage', $client_initial_assessment->massage_times),
                array(($client_initial_assessment->motomed ? 'Yes' : 'No'), 'Motomed', $client_initial_assessment->motomed_times),
                array(($client_initial_assessment->nutrition ? 'Yes' : 'No'), 'Nutrition', $client_initial_assessment->nutrition_times),
                array(($client_initial_assessment->outdoor_hand_cycling ? 'Yes' : 'No'), 'Outdoor Hand Cycling', $client_initial_assessment->outdoor_hand_cycling_times),
                array(($client_initial_assessment->prepared_meals ? 'Yes' : 'No'), 'Prepared Meals', $client_initial_assessment->prepared_meals_times),
                array(($client_initial_assessment->rowing ? 'Yes' : 'No'), 'Rowing', $client_initial_assessment->rowing_times),
                array(($client_initial_assessment->socialization_with_activities ? 'Yes' : 'No'), 'Socialization with Activities', $client_initial_assessment->socialization_with_activities_times),
                array(($client_initial_assessment->spinal_mobility ? 'Yes' : 'No'), 'Spinal Mobility', $client_initial_assessment->spinal_mobility_times),
                array(($client_initial_assessment->standing_frame ? 'Yes' : 'No'), 'Standing Frame', $client_initial_assessment->standing_frame_times),
                array(($client_initial_assessment->vocational_consultation ? 'Yes' : 'No'), 'Vocational Consultation', $client_initial_assessment->vocational_consultation_times),
                array(($client_initial_assessment->educational_consultation ? 'Yes' : 'No'), 'Educational Consultation', $client_initial_assessment->educational_consultation_times),
                array(($client_initial_assessment->wheelchair_care ? 'Yes' : 'No'), 'Wheelchair Care', $client_initial_assessment->wheelchair_care_times),
                array(($client_initial_assessment->wheelchair_loan ? 'Yes' : 'No'), 'Wheelchair Loan', $client_initial_assessment->wheelchair_loan_times),
                array(($client_initial_assessment->weight_training ? 'Yes' : 'No'), 'Weight Training', $client_initial_assessment->weight_training_times),
                array(($client_initial_assessment->wheelchair_mobility ? 'Yes' : 'No'), 'Wheelchair Mobility', $client_initial_assessment->wheelchair_mobility_times),
                array(($client_initial_assessment->yoga ? 'Yes' : 'No'), 'Yoga', $client_initial_assessment->yoga_times),
                array(($client_initial_assessment->one_on_one_instruction ? 'Yes' : 'No'), 'One on One Instruction', $client_initial_assessment->one_on_one_instruction_times),
            );
            $this->_formatExportClientPIATablePDF( $header, $data, $w );
        }                
    }
    
    private function _formatExportClientPIATablePDF( $header, $data, $w ){                
        // Colors, line width and bold font
        $this->pdf->SetFillColor(255, 0, 0);
        $this->pdf->SetTextColor(255);
        $this->pdf->SetDrawColor(128, 0, 0);
        $this->pdf->SetLineWidth(0.3);
        $this->pdf->SetFont('', 'B');
        
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->pdf->Ln();
        // Color and font restoration
        $this->pdf->SetFillColor(224, 235, 255);
        $this->pdf->SetTextColor(0);
        $this->pdf->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->pdf->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->pdf->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->pdf->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill); 
            
            if($num_headers >= 4){
                $this->pdf->Cell($w[3], 6, $row[3], 'LR', 0, 'L', $fill); 
            }                       
            
            $this->pdf->Ln();
            
            $fill=!$fill;
        }
        
        $this->pdf->Cell(array_sum($w), 0, '', 'T');
    }
    
    private function _formatExportPDFClientAuthorizationRequest( $client_id ){
        $client_summary_details = $this->clients_model->getClientSummaryDetailsByMemberID( $client_id );
        $client_authorization_details = $this->clientAuthorizationRequest_model->prepareClientauthorizationRequests( $client_id );
        $element = '';
        
        if( is_object($client_summary_details) || is_array($client_summary_details) ){
            $element = "<p><b>Client Name:</b> $client_summary_details->first_name $client_summary_details->last_name";
            $element .= "<br /><b>Member ID:</b> ".$client_summary_details->member_id."</p>";
            
            if( $client_authorization_details ){
                $element .= "<p>";
                foreach($client_authorization_details as $key => $details){                    
                    $key_label = ucwords(str_replace('_',' ',$key));
                    $element .= "<br /> <b>$key_label:</b> ". ( is_array($details) ? implode(', ', $this->_cleanupExportFormatArrayText($details)) : $this->_cleanupExportFormatArrayText($details) );                    
                }
                $element .= "</p>";                
            }
        }
        
        // Print text using writeHTMLCell()
        $this->pdf->writeHTMLCell(0, 0, '', '', $element, 0, 1, 0, true, '', true);
    }
    
    /*
     * Function that will clean up array text for displaying in PDF reporting.
     */
    private function _cleanupExportFormatArrayText($data, $key = '', $key_pattern = array()){
        $new_data = array();
        
        if(!is_array($data)){ 
            if(in_array($key, $key_pattern)){
                return strtoupper(str_replace('_',' ',$data));
            }
            
            return ucwords(str_replace('_',' ',$data));             
        }
        
        foreach($data as $d){
            if(strlen($d) <= 3 && in_array($key, $key_pattern)){
               $new_data[] = strtoupper(str_replace('_',' ',$d));  
            }else{
               $new_data[] = ucwords(str_replace('_',' ',$d));  
            }            
        }
        
        return $new_data;
    }
}