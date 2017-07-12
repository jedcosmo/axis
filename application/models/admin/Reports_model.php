<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }    
    
    public function findAllClients($id){
        $this->db->select('*');
        $this->db->from('clients');
        if($id != 0){
            $this->db->where_in('ID', $id);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function findActivitiesByClientId($client_id){
        $this->db->select('ca.*, u.first_name AS admin_fname, u.last_name AS admin_lname');
        $this->db->from('client_activities ca');
        $this->db->join('users u','u.id = ca.user_id', 'left');
        $this->db->where_in('ca.client_id', $client_id);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function findDailyActivityDetail($id){
        $this->db->select('*');
        $this->db->from('daily_activities');
        $this->db->where_in('ID', $id);

        $query = $this->db->get();        
        return $query->row();
    }

    public function findActivityDetail($activity_id){
        $this->db->select('*');
        $this->db->from('activities');
        $this->db->where_in('ID', $activity_id);

        $query = $this->db->get();        
        return $query->row();
    }


    public function findAllActivities($id){
        $this->db->select('*');
        $this->db->from('activities');
        if($id != 0){
            $this->db->where_in('ID', $id);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function displayDailyActivities(){
        $this->db->select('*');
        $this->db->from('daily_activities');

        $query = $this->db->get();        
        return $query->result();
    }

    public function findActivitiesByActivityId($activity_id){
        $this->db->select('ca.*, CONCAT(u.first_name," ",u.last_name) AS user_name');
        $this->db->from('client_activities ca');
        $this->db->join('users u','ca.user_id = u.id','left');
        $this->db->where_in('ca.activity_id', $activity_id);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function findClient($client_id){
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where_in('ID', $client_id);

        $query = $this->db->get();        
        return $query->row();
    }

    public function findClientDemograpihcs( $fields = array() ){

        $this->db->select('c.*, CONCAT(u.first_name," ",u.last_name) AS created_by');
        $this->db->from('clients c');
        $this->db->join('clients_status_information csi','csi.client_id = c.ID','inner');
        $this->db->join('(SELECT s_cfsh.client_id, s_cfsh.user_id FROM clients_form_submission_history s_cfsh WHERE s_cfsh.client_form_type = "demographics" AND s_cfsh.form_action = "INSERT") cfsh', 'cfsh.client_id = c.ID', 'left');
        $this->db->join('users u','u.id = cfsh.user_id','left');
        $this->db->where_in('csi.medicare_eligibility', $fields['medicare_eligibility']);
        $this->db->where_in('csi.medicaid_eligibility', $fields['medicaid_eligibility']);
        $this->db->where_in('csi.community_status', $fields['community_status']);
        $this->db->where_in('csi.marital_status', $fields['marital_status']);
        $this->db->where_in('csi.highest_completed_education', $fields['highest_completed_education']);
        $this->db->where_in('csi.employment_status', $fields['employment_status']);
        $this->db->where_in('csi.internet_access', $fields['internet_access']);
        $this->db->where_in('csi.type_of_income', $fields['type_of_income']);
        
        $query = $this->db->get();
        
        return $query->result();

    }

    public function findClientByGoals( $fields = array() ){

        $this->db->select('c.*, car.*, CONCAT(u.first_name," ",u.last_name) AS created_by');
        $this->db->from('clients_authorization_requests car');
        $this->db->join('(SELECT s_cfsh.client_id, s_cfsh.user_id FROM clients_form_submission_history s_cfsh WHERE s_cfsh.client_form_type = "authorization_requests" AND (s_cfsh.form_action = "INSERT" OR s_cfsh.form_action = "UPDATE") GROUP BY s_cfsh.client_id) cfsh', 'cfsh.client_id = car.client_id', 'left');
        $this->db->join('users u','u.id = cfsh.user_id','left');
        $this->db->join('clients c','car.client_id = c.ID','inner');
        $this->db->where('car.field', 'goals');
        $this->db->where_in('car.value', $fields['goal']);
        
        $query = $this->db->get();
        
        return $query->result();

    }

   
}

