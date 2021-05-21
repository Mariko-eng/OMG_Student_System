<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->isloggedin() == true ? '' : $this->logout();

    }
 

    public function index()
    {
        $this->dashboard();
    }


    public function isloggedin()
    {
        return $this->session->userdata('user_type') == "non_admin" ||
        $this->session->userdata('user_type') == "students" ||
        $this->session->userdata('user_type') == "admin" ? true : false;

    }

}
