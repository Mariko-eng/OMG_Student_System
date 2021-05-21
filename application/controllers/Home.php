<?php

class Home extends CI_Controller{

    public $page_level = "";
    public $page_level2 = "";
    public $page_level3 = "";
    public $site_name = '';
    public $site_email = '';
    public $site_contact = '';

    function __construct()
    {
        parent::__construct();

        $this->site_name = $this->site_options->get_site_data('site_name');
        $this->site_email = $this->site_options->get_site_data('contact_email');
        $this->site_contact = $this->site_options->get_site_data('contact_phone');


        $this->page_level = $this->uri->slash_segment(1);
        $this->page_level2 = $this->uri->slash_segment(2);
        $this->page_level3 = $this->uri->slash_segment(3);

    }
    
    public function index(){
        if($this->isloggedin()){
            $this->app();
        }else{
            $this->login();
        }
    }

    public function isloggedin()
    {
        return strlen($this->session->userdata('user_type')) > 0;
        // returns an empty incase of just false 
    }

    public function login(){
        $this->load->view('login/myheader_login');
        $this->load->view('login/mylogin');
        $this->load->view('login/myfooter_login');
    }

    public function app(){
        //echo var_dump($_SESSION['permission']);
        $data = array(
            'title' => 'courses',
            'subtitle' => 'Welcome',
            'link_details' => 'Account overview'
        );
        $this->load->view('constants/header', $data);
        $this->load->view('constants/footer');
    }
}