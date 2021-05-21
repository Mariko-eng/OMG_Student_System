<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    public $username = "";
    public $password = "";
    public $page_level = "";
    public $page_level2 = "";
    public $footer_news = "";
    public $notification = array();
    public $view_data = array();
    public $csrf_hidden_form = "";

    function __construct()
    {
        parent::__construct();
        $this->page_level = $this->uri->slash_segment(1);
        $this->page_level2 = $this->uri->slash_segment(2);
        $csrf_form = array(
            'type' => 'hidden',
            'name' => $this->security->get_csrf_token_name(),
            'value' => $this->security->get_csrf_hash()
        );
        strlen($this->security->get_csrf_hash()) > 0 ? $this->csrf_hidden_form = form_input($csrf_form) : '';
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        $data['title'] = 'login';
        $data['subtitle'] = 'login';
        $this->load->view('login/myheader_login', $data);

        if (strlen($this->session->username) > 0) {

            $user_type = $this->session->user_type;
            $this->login_module($user_type);

        } else {

            if (isset($_REQUEST['username'])) {
                $this->form_validation->set_rules('username', 'Email', 'required|trim');
                $this->form_validation->set_rules('password', 'Password', 'required|trim');
                if ($this->form_validation->run() == true) {
                    $this->username = $this->input->post('username', true);
                    $this->password = $this->input->post('password', true);
                    $results = $this->account_exists($this->username, $this->password);
                    if (isset($results->user_name)) {
                        //this check whether the account is not disabled
                        if ($results->status == 2) {
                            $alert = $this->load->view('home_alert', array(
                                'message' => '<br/>Your Account is Currently Suspended <br/> <strong>Contact the Administrator</strong>',
                                'alert' => 'danger'
                            ), true);
                            $this->session->set_tempdata('alert', $alert,5);
                            redirect('home/login');
                        } else {
                            $session_data = array(
                                'id' => $results->aut_id,
                                'username' => $results->user_name,
                                'photo' => $results->profile_pic,
                                'email' => $results->email,
                                'user_type' => $results->sys_group,
                                'platform' => $this->agent->platform(),
                                'browser' => $this->agent->browser() . '-' . $this->agent->version(),
                                'agent_string' => $this->agent->agent_string(),
                                'agent_referral' => $this->agent->is_referral() ? $this->agent->referrer() : '',
                            );
                            $this->session->set_userdata($session_data);
 
                            $this->get_permissions($this->session->user_type);
                            $this->add_logs($results->user_name, 'login', '', ' Logged in');

                            $this->login_module($results->sys_group);
                        }
                    } else {
                        $alert = $this->load->view('home_alert', array(
                            'message' => 'Invalid Username or Password',
                            'alert' => 'danger'
                        ), true);
                        $this->session->set_flashdata('alert', $alert);
                        redirect('home/login');
                    }
                } else {
                    $alert = $this->load->view('home_alert', array(
                        'message' => 'All fields are Required',
                        'alert' => 'danger'
                    ), true);
                    $this->session->set_flashdata('alert', $alert);
                    redirect('home/login');
                }
            }
        }

    }

    function login_module($user_type)
    {
        if ($user_type == 'admin') {
            redirect('app', 'refresh');
        } elseif ($user_type == 'non_admin') {
            redirect('home', 'refresh');
        } elseif ($user_type == 'students') {
            redirect('app/student_profile', 'refresh');
        } else {
            $this->logout();
        }
    }


    public function logout()
    {
        if($this->session->user_name){
            $this->add_logs($this->session->user_name, 'login', '', ' Logged out');
        }
        $this->session->sess_destroy();
        redirect('home/login', 'refresh');
    }

    //checking whether the account exists
    public function account_exists($username, $password)
    {
        $userInfo = $this->db->select('a.*, b.sys_group')
            ->from('sysytem_users a')
            ->join('sysytem_user_groups b', 'a.user_name = b.sys_user')
            ->where(array('user_name' => $username,'password' => $password))
            ->get()
            ->row();
            return $userInfo;
    }

    function get_permissions($user_role)
    {
        $per = $this->db->select('a.sys_perm, a.sys_group,b.aut_id, b.content_type')
            ->from('sysytem_group_permissions a')
            ->join('sysytem_permissions b', 'a.sys_perm=b.permission')
            ->where(array('sys_group' => $user_role))
            ->get()
            ->result();

        $user_role = array();
        foreach ($per as $p) {
            $f = array(
                'role' => strtolower(trim($p->content_type)),
                'title' => strtolower(trim($p->sys_perm)),
                'group' => strtolower(trim($p->sys_group))
            );
            array_push($user_role, $f);
        }
        isset($user_role) ? $this->session->set_userdata(array('permission' => $user_role)) : '';
    }

    public function isloggedin()
    {
        if (strlen($this->session->userdata('id')) > 0) {
            return true;
        } else {
            return false;
        }
    }

    
     function add_logs($user = null, $trans_type = null, $target = '', $desc = '')
    {
        $this->load->library('user_agent');
        $user = strlen($user) > 0 ? $user : $this->session->id;

        $datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
        $time = time(); 

        $values = array(
            'transaction_type' => $trans_type,
            'target' => character_limiter($target, 100),
            'details' => $desc,
            'created_by' => $user,
            'created_on_str' => mdate($datestring, $time),
            'platform' => $this->agent->platform(),
            'browser' => $this->agent->browser() . '-' . $this->agent->version(),
            'agent_string' => $this->agent->agent_string(),
            'ip' => $this->input->ip_address(),
        );

        $this->db->insert('sysytem_logs', $values);
    }

    //this is the error page
    public function error()
    {
        $this->load->view('404');
    }

    public function my_account_exists($username, $password)
    {
        $userInfo = $this->db->select('a.*, b.sys_group')
            ->from('sysytem_users a')
            ->join('sysytem_user_groups b', 'a.user_name = b.sys_user')
            ->where(array('user_name' => $username,'password' => $password))
            ->get()
            ->row();
            return $userInfo;
    }

    public function mylogin()
    {
        $data['title'] = 'login';
        $data['subtitle'] = 'login';
        $this->load->view('login/myheader_login', $data);

        if (strlen($this->session->username) > 0) {

            $user_type = $this->session->user_type;
            $this->login_module($user_type);

        } else {

            if (isset($_REQUEST['username'])) {
                $this->form_validation->set_rules('username', 'Email', 'required|trim');
                $this->form_validation->set_rules('password', 'Password', 'required|trim');
                if ($this->form_validation->run() == true) {
                    $this->username = $this->input->post('username', true);
                    $this->password = $this->input->post('password', true);
                    echo $this->username;
                    echo $this->password;
                    $results = $this->my_account_exists($this->username, $this->password);
                    echo var_dump($results);
                //     if (isset($results->user_name)) {
                //         //this check whether the account is not disabled
                //         if ($results->status == 2) {
                //             $alert = $this->load->view('home_alert', array(
                //                 'message' => '<br/>Your Account is Currently Suspended <br/> <strong>Contact the Administrator</strong>',
                //                 'alert' => 'danger'
                //             ), true);
                //             $this->session->set_tempdata('alert', $alert,5);
                //             redirect('home/login');
                //         } else {
                //             $session_data = array(
                //                 'id' => $results->aut_id,
                //                 'username' => $results->user_name,
                //                 'photo' => $results->profile_pic,
                //                 'email' => $results->email,
                //                 'user_type' => $results->sys_group,
                //                 'platform' => $this->agent->platform(),
                //                 'browser' => $this->agent->browser() . '-' . $this->agent->version(),
                //                 'agent_string' => $this->agent->agent_string(),
                //                 'agent_referral' => $this->agent->is_referral() ? $this->agent->referrer() : '',
                //             );
                //             $this->session->set_userdata($session_data);
 
                //             $this->get_permissions($this->session->user_type);
                //             $this->add_logs($results->user_name, 'login', '', ' Logged in');

                //             $this->login_module($results->sys_group);
                //         }
                //     } else {
                //         $alert = $this->load->view('home_alert', array(
                //             'message' => 'Invalid Username or Password',
                //             'alert' => 'danger'
                //         ), true);
                //         $this->session->set_flashdata('alert', $alert);
                //         redirect('home/login');
                //     }
                 } else {
                     $alert = $this->load->view('home_alert', array(
                         'message' => 'All fields are Required',
                         'alert' => 'danger'
                     ), true);
                     $this->session->set_flashdata('alert', $alert);
                     redirect('home/login');
             }
            }
        }

    }

}