<?php

// if( ! defined(BASEPATH)) exit("NO DIRECT ACCESS ALLOWED");

class Site_Options{

    private $CI;

    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    function get_site_data($data = null){
        if(isset($data)){
            $result = $this->CI->db->select()->from("site_options")->where('site_data',$data)->get()->row();
            return isset($result) ? $result->value : 'No value';
        }else{
            return null;
        }
    }
}

