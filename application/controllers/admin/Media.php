<?php
/*
 * @develope: j.dymosco
 * @date: Sept. 19 2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

Class Media extends Admin_Controller{
    
    private $dir_script_filename;
    
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('pluploadhandler');
        $this->dir_script_filename = dirname($_SERVER["SCRIPT_FILENAME"]); //root directory.
    }
    
    public function upload(){
        
        $this->pluploadhandler->no_cache_headers();
        $this->pluploadhandler->cors_headers();
        
        $uploaded = $this->pluploadhandler->handle(array(
                            'target_dir' => $this->dir_script_filename . '/upload/',
                            'allow_extensions' => 'jpg,jpeg,png')
                    );
               
        if ( !$uploaded )
        {                
                return $this->output
                        ->set_content_type('application/json')                        
                        ->set_output(json_encode(array(
                                'status' => 'failed',
                                'error' => array(
                                            'code' => $this->pluploadhandler->get_error_code(),
                                            'message' => $this->pluploadhandler->get_error_message()
                                           )                                
                        )));
        } else {                
                return $this->output
                        ->set_content_type('application/json')                        
                        ->set_output(json_encode(array(
                                'status' => 'success',
                                'img_path' => $uploaded['path'],
                                'filename' => $uploaded['name'],
                                'full_path' => $this->get_clean_path( $uploaded['path'] ),
                                'csrf_new_token' => $this->security->get_csrf_hash()
                        )));
        }
    }
    
    private function get_clean_path( $path ){
        return str_replace($this->dir_script_filename, '', $path);
    }
}

