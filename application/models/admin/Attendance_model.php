<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {
    
    private $db_attendance_table = 'attendance';
    private $db_client_attendance_table = 'client_attendance';
    private $current_user_id;
    
    public function __construct(){
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
    }
    
    public function create_attendance( $fields = [] ){
        $attendance_details = array();        
        
        $attendance_details['user_id'] = $this->current_user_id;
        $attendance_details['attendance_date'] = $fields['attendance_date'];
        
        if( !empty($fields['notes']) ){
            $attendance_details['attendance_notes'] = $fields['notes'];
        }
        
        $this->db->insert($this->db_attendance_table, $attendance_details);
        
        $insert_id = $this->db->insert_id();
        
        $this->insert_update_attendance_attendees($insert_id, $fields['client_attendees'], $fields['form_action']);
        
        return $insert_id;
    }
    
    public function update_attendance( $fields = [] ){
        $attendance_details = array();     
        
        //make sure were just updating attendance that is not yet completed.
        /*if($fields['attendance_status'] != 'draft'){
            return false;
        }*/
        
        $attendance_id = $fields['attendance_id'];
        $attendance_details['user_id'] = $this->current_user_id;
        $attendance_details['attendance_date'] = $fields['attendance_date'];
        
        if( !empty($fields['notes']) ){
            $attendance_details['attendance_notes'] = $fields['notes'];
        }
        
        $this->db->where('attendance_id', $attendance_id);
        $this->db->update($this->db_attendance_table, $attendance_details);
        
        $affected_rows = $this->db->affected_rows();
        
        $this->insert_update_attendance_attendees($attendance_id, $fields['client_attendees'], $fields['form_action']);
        
        return $affected_rows;
    }
    
    public function delete_attendance( $attendance_id ){
        $this->db->where('attendance_id', $attendance_id);                
        $this->db->delete('attendance');        
        $attendance_affected_rows = $this->db->affected_rows();
        
        $this->db->where('attendance_id', $attendance_id);
        $this->db->delete('client_attendance');        
        $client_attendance_affected_rows = $this->db->affected_rows();
        
        return ($client_attendance_affected_rows && $attendance_affected_rows);
    }
    
    public function set_attendance_completed( $attendance_id ){
        $attendance_details['status'] = 'completed';
        $attendance_details['completed_by'] = $this->current_user_id;
        
        $this->db->where('attendance_id', $attendance_id);
        $this->db->update($this->db_attendance_table, $attendance_details);
        
        return $this->db->affected_rows();
    }
    
    public function get_attendance_lists(){
        $this->db->select('a.*, CONCAT(u.first_name," ",u.last_name) as user_name, CONCAT(uc.first_name," ",uc.last_name) as completed_by_name');
        $this->db->from('attendance a');
        $this->db->join('users u','a.user_id = u.id','left');
        $this->db->join('users uc','a.completed_by = uc.id','left');
        $this->db->order_by('a.date_created DESC');
        
        $query = $this->db->get();

        return $query->result();
    }
    
    public function get_attendance_details( $attendance_id ){
        $this->db->select('a.*, CONCAT(u.first_name," ",u.last_name) as user_name');
        $this->db->from('attendance a');
        $this->db->join('users u','a.user_id = u.id','left');
        $this->db->where('a.attendance_id', $attendance_id);        
        
        $query = $this->db->get();

        return $query->row();
    }
    
    public function get_attendance_attendees( $attendance_id, $get_type = 'all' ){
        
        if( $get_type == 'all' ){
            $this->db->select('ca.*, CONCAT(c.first_name," ",c.last_name) as client_name');
            $this->db->from('client_attendance ca');
            $this->db->join('clients c','ca.attendance_client_id = c.ID','inner');
        }
        
        if( $get_type == 'ids_only' ){
            $this->db->select('ca.attendance_client_id');
            $this->db->from('client_attendance ca');
        }
        
        $this->db->where('ca.attendance_id', $attendance_id);
        
        $query = $this->db->get();        

        return $query->result();
    }
    
    public function insert_update_attendance_attendees( $attendance_id, $attendees, $action = '' ){
        $attendee_details = array();
        $current_attendees = [];
        $cleaned_current_attendees = [];
                
        $attendee_details['attendance_id'] = $attendance_id;
        $attendee_details['attendance_user_id'] = $this->current_user_id;
        
        if($action == 'update'){
            $current_attendees = $this->get_attendance_attendees($attendance_id, 'ids_only');
            $cleaned_current_attendees = $this->_prepare_get_attendance_attendees($current_attendees);
            $to_removed_attendess = array_diff($cleaned_current_attendees, $attendees);
           
            $this->_to_remove_attendees($attendance_id, $to_removed_attendess);
        }
        
        if(is_array($attendees) && count($attendees) > 0){
            foreach($attendees as $attendee){
                $attendee_details['attendance_client_id'] = $attendee;
                
                //this will avoid duplication of attendee on update of details.
                if( $action == 'update' && in_array($attendee, $cleaned_current_attendees) ){
                    continue;
                }
                
                $this->db->insert($this->db_client_attendance_table, $attendee_details);
            }
        }
    }  
    
    public function getCSVQueryExport( $attendance_id ){
        $select_fields = 'c.member_id as Member_ID, c.email as Email, c.first_name as First_Name, c.last_name as Last_Name, c.gender as Gender,';
        $select_fields .= 'c.date_of_birth as Date_of_Birth, c.home_address as Home_Address, c.city as City, c.state as State, c.zip as Zip, c.phone as Phone, c.alternative_phone as Alternative_Phone,';
        $select_fields .= 'IF(cis.medicare_eligibility,"Yes","No") as Medicare_Eligibility, IF(cis.medicare_eligibility_active,"Yes","No") as Medicare_Eligibility_Active, cis.medicare_number as Medicare_Number, IF(cis.medicaid_eligibility,"Yes","No") as Medicaid_Eligibility, cis.medicaid_number as Medicaid_Number, cis.community_status as Community_Status,';
        $select_fields .= 'cis.marital_status as Marital_Status, cis.highest_completed_education as Highest_Completed_Education, cis.employment_status as Employment_Status, IF(cis.internet_access,"Yes","No") as Internet_Access, cis.type_of_income as Type_of_Income, cis.other_income as Other_Income,';
        
        $this->db->select($select_fields.'att.attendance_date AS DateAttended');
        $this->db->from('client_attendance ca');
        $this->db->join('attendance att','att.attendance_id = ca.attendance_id','left');
        $this->db->join('clients c','ca.attendance_client_id = c.ID','inner');
        $this->db->join('clients_status_information cis','ca.attendance_client_id = cis.client_id','left');
        
        $this->db->where('ca.attendance_id', $attendance_id);
        
        $query = $this->db->get();
        
        return $query;
    }
    
    public function getCSVQueryRangeExport($start = '', $end = '', $count = 0, $obj_query = false){
        $count_str = '';
        $select_fields = ",c.member_id as Member_ID, IF(STRCMP(c.is_member,'M'), 'Member' ,'Non-member') as Member_Status, c.email as Email, c.first_name as First_Name, c.last_name as Last_Name, c.gender as Gender,";
        $select_fields .= 'c.date_of_birth as Date_of_Birth, c.home_address as Home_Address, c.city as City, c.state as State, c.zip as Zip, c.phone as Phone, c.alternative_phone as Alternative_Phone,';
        $select_fields .= 'IF(csi.medicare_eligibility,"Yes","No") as Medicare_Eligibility, IF(csi.medicare_eligibility_active,"Yes","No") as Medicare_Eligibility_Active, csi.medicare_number as Medicare_Number, IF(csi.medicaid_eligibility,"Yes","No") as Medicaid_Eligibility, csi.medicaid_number as Medicaid_Number, csi.community_status as Community_Status,';
        $select_fields .= 'csi.marital_status as Marital_Status, csi.highest_completed_education as Highest_Completed_Education, csi.employment_status as Employment_Status, IF(csi.internet_access,"Yes","No") as Internet_Access, csi.type_of_income as Type_of_Income, csi.other_income as Other_Income';
        $exclude_field_attendace_id = '';
        $number_of_times = 'AS NumberOfTimesAttended';
        $groupConcatAttendanceIDs = '';
        $dateRangeLeftJoin = '';
        $dateRangeDefault = '';
        $dateRangeNoAttendance = '';
                                
        if( !$obj_query ){
            $exclude_field_attendace_id = 'ca.attendance_client_id,';
            $number_of_times = '';
            $groupConcatAttendanceIDs = "GROUP_CONCAT(ca.attendance_id SEPARATOR ',') AS AttendanceIDs,";
        }
        
        if( $count >= 1 ){
            $count_str = "AND acj.count_attended = $count";
        }
        
        //If date range are not set let's override the query string condition.
        if( $count >= 1 && (empty($start) || empty($end)) ){
            $count_str = "WHERE acj.count_attended = $count";
        }
        
        if( !empty($start) && !empty($end) ){            
            $dateRangeLeftJoin = "WHERE DATE(l_att.attendance_date) BETWEEN '$start' AND '$end'";
            $dateRangeDefault = "WHERE DATE(att.attendance_date) BETWEEN '$start' AND '$end'";
            $dateRangeNoAttendance = "WHERE DATE(nl_att.attendance_date) BETWEEN '$start' AND '$end'";
        }
                        
        //default query string...
        $query_str = "SELECT $exclude_field_attendace_id acj.count_attended $number_of_times, 
                        GROUP_CONCAT(DATE(att.attendance_date) SEPARATOR ', ') AS DatesAttended,
                        $groupConcatAttendanceIDs
                        GROUP_CONCAT(DISTINCT(CONCAT(u.first_name,' ',u.last_name)) SEPARATOR ', ') AS AddedBy
                        $select_fields
                        FROM client_attendance AS ca
                        LEFT JOIN attendance AS att ON att.attendance_id = ca.attendance_id
                        LEFT JOIN clients AS c ON ca.attendance_client_id = c.ID
                        LEFT JOIN clients_status_information AS csi ON csi.client_id = ca.attendance_client_id
                        LEFT JOIN users u ON u.id = ca.attendance_user_id
                        LEFT JOIN (
                            SELECT a_ctr.attendance_client_id AS client_id, COUNT(a_ctr.attendance_client_id) AS count_attended 
                            FROM client_attendance AS a_ctr
                            LEFT JOIN attendance AS l_att ON l_att.attendance_id = a_ctr.attendance_id
                            $dateRangeLeftJoin
                            GROUP BY a_ctr.attendance_client_id) AS acj ON acj.client_id = ca.attendance_client_id
                        $dateRangeDefault
                        $count_str
                        GROUP BY ca.attendance_client_id
                    ";
        
        if( is_string($count) && $count == 'no-attendance' ){
            $query_str = "SELECT $exclude_field_attendace_id ca.count_attended $number_of_times,
                            ca.date_added AS DatesAttended
                            $select_fields
                            FROM clients AS c
                            LEFT JOIN clients_status_information AS csi ON csi.client_id = c.ID
                            LEFT JOIN(
                                SELECT lca.attendance_client_id, nl_att.attendance_date, lca.date_added, COUNT(lca.attendance_client_id) AS count_attended
                                FROM client_attendance AS lca
                                LEFT JOIN attendance AS nl_att ON nl_att.attendance_id = lca.attendance_id
                                $dateRangeNoAttendance
                                GROUP BY lca.attendance_client_id
                            ) AS ca ON ca.attendance_client_id = c.ID
                            WHERE (ca.count_attended IS NULL OR ca.count_attended <= 0)
                            GROUP BY c.ID
                            ORDER BY c.ID
                    ";
        }
        
        $query =  $this->db->query($query_str);
        
        return ($obj_query ? $query : $query->result());
    }
    
    private function _prepare_get_attendance_attendees( $current_attendees ){
        $cleaned_array = [];
        
        if( is_array($current_attendees) && count($current_attendees) > 0 ){
            foreach($current_attendees as $ca){
                $cleaned_array[] = $ca->attendance_client_id;
            }
        }
        
        return $cleaned_array;
    }
    
    private function _to_remove_attendees( $attendance_id, $attendees ){
        if( is_array($attendees) && count($attendees) > 0 ){
            foreach($attendees as $attendee_id){
                $this->db->where('attendance_id', $attendance_id);
                $this->db->where('attendance_client_id', $attendee_id);
                $this->db->delete('client_attendance');               
            }
            
            return $this->db->affected_rows();
        }
        
        return false;
    }
    
}