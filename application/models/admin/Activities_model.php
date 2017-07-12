<?php
/*
 * @devloper: j.dymosco
 * @date: 2016-09-15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities_model extends CI_Model {

    private $db_daily_activity_table = 'daily_activities';
    private $current_user_id;
    
    public function __construct(){
        parent::__construct();
        $this->current_user_id = $this->ion_auth->user()->row()->id;
    }

    public function create_activity( $fields = array() ){
        $insert_fields = array();        
        
        $insert_fields['user_id'] = $this->current_user_id;
        $insert_fields['date'] = $fields['date'];
        $insert_fields['time_start'] = $fields['time_start'];
        $insert_fields['time_end'] = $fields['time_end'];
        $insert_fields['activity'] = $fields['activity'];
        $insert_fields['status'] = 'draft';
        $insert_fields['notes'] = $fields['notes'];
        
        $this->db->insert($this->db_daily_activity_table, $insert_fields);
        
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }

    public function update_activity($fields = array()){
        $update_fields = array();        
        
        $activity_id = $fields['activity_id'];
        $update_fields['user_id'] = $this->current_user_id;
        $update_fields['date'] = $fields['date'];
        $update_fields['time_start'] = $fields['time_start'];
        $update_fields['time_end'] = $fields['time_end'];
        $update_fields['activity'] = $fields['activity'];
        $update_fields['status'] = $fields['status'];
        $update_fields['notes'] = $fields['notes'];
        
        $this->db->where('ID', $activity_id);        
        $this->db->update($this->db_daily_activity_table, $update_fields);
                   
        return $this->db->affected_rows();
    }

    public function delete($activity_id){
        $this->db->where('ID', $activity_id);
        $this->db->delete('daily_activities');
        
        return $this->db->affected_rows();
    } 

    public function get_lists_daily_activities(){
        $this->db->select('da.ID, da.date, da.time_start, da.time_end, da.activity, da.status, a.title');
        $this->db->from('daily_activities da');
        $this->db->join('activities a','da.activity = a.ID','inner');
        
        $query = $this->db->get();

        return $query->result();
    }

    public function get_todays_activities(){

        $date = date('Y-m-d');

        $this->db->select('da.ID, da.date, da.time_start, da.time_end, da.activity, da.status, a.title');
        $this->db->from('daily_activities da');    
        $this->db->join('activities a','da.activity = a.ID','inner');
        $this->db->where_in('da.date', $date);
        $this->db->order_by('da.time_start', 'ASC');
        
        $query = $this->db->get();

        return $query->result();
    }

    public function get_activities_by_date($date){

        $this->db->select('da.ID, da.date, da.time_start, da.time_end, da.activity, da.status, a.title');
        $this->db->from('daily_activities da');    
        $this->db->join('activities a','da.activity = a.ID','inner');
        $this->db->where_in('da.date', $date);
        $this->db->order_by('da.time_start', 'ASC');
        
        $query = $this->db->get();

        return $query->result();
    }
    
    public function get_lists_activities(){
        $this->db->select('ID, title');
        $this->db->order_by('title', 'ASC');
        $this->db->from('activities');
        
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_details($id = 0){
        $this->db->select('da.*, u.first_name, u.last_name');
        $this->db->from('daily_activities da');
        $this->db->join('users u', 'da.user_id = u.id', 'left');
        $this->db->where('da.ID', $id);        
        
        $query = $this->db->get();
        
        return $query->row();
    }

    public function add_client_to_activity($activity_id, $client_id){        
        
        $update_fields = array();        
    
        $update_fields['clients'] = $client_id;

        $this->db->where('ID', $activity_id);        
        $this->db->update($this->db_daily_activity_table, $update_fields);
                   
        return $this->db->affected_rows();

    }

    /*
     * Model methods for processing activity items starts here.
     */
    public function activity_insert( $value ){
        $insert_fields['title'] = $value;
        $insert_fields['user_id'] = $this->current_user_id;
        
        $this->db->insert('activities', $insert_fields);        
        $insert_id = $this->db->insert_id();
         
        return $insert_id;
    }
    
    //Edit method, will get details of an activity item.
    public function activity_edit( $activity_id = 0 ){
        $this->db->select('title');
        $this->db->from('activities');
        $this->db->where('ID', $activity_id);        
        
        $query = $this->db->get();
        
        return $query->row()->title;
    }
    
    //Update method, updates an specific detail of activity item.
    public function activity_update($activity_id, $value){
        $update_fields['title'] = $value;
        
        $this->db->where('ID', $activity_id);        
        $this->db->update('activities', $update_fields);
        
        return $this->db->affected_rows();
    }
    
    //Delete method, deletes an specific activity item.
    public function activity_delete($activity_id){
        $this->db->where('ID', $activity_id);
        $this->db->delete('activities');
        
        return $this->db->affected_rows();
    }
    //End of activity items CRUD...
}