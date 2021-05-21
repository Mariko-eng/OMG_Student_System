<?php

class Authorization {
    private $CI;

    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->database();        
    }

    public function is_role_for_group($role=null, $attr="role"){
        if (isset($this->CI->session->permission)) {

            $array = $this->CI->session->permission;

            $key = array_search(strtolower($role), array_column($array, $attr));

            return strlen($key) == 0 ? false : true;
        } else {
            return false;
        }
    }


}