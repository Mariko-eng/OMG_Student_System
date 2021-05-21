<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ajax_api extends CI_Controller
{

    public $page_level = 'app/';
    public $page_level2 = "";

    function __construct()
    {
        parent::__construct();

        $this->page_level = 'app/';

        $this->page_level2 = $this->uri->segment(2);
    }

    function students(){
        $table = 'students a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);


        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("first_name" => $dir),
            array("middle_name" => $dir),
            array("last_name" => $dir),
            array("gender" => $dir),
            array("birth_date" => $dir),
            array("nationality" => $dir),
            array("student_id" => $dir),
            array("course" => $dir),
            array("academic_year" => $dir),
            array("admission_date" => $dir),
        );
        $o_list = $order_list[$column];
        //this is the end of the sorting

    }

    function courses(){
        $table = 'courses a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);


        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("first_name" => $dir),
            array("middle_name" => $dir),
            array("last_name" => $dir),
            array("gender" => $dir),
            array("birth_date" => $dir),
            array("nationality" => $dir),
            array("student_id" => $dir),
            array("course" => $dir),
            array("academic_year" => $dir),
            array("admission_date" => $dir),
        );
        $o_list = $order_list[$column];
        //this is the end of the sorting

    }

    function high_school_data(){
        $table = 'high_school_data a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);


        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("first_name" => $dir),
            array("middle_name" => $dir),
            array("last_name" => $dir),
            array("gender" => $dir),
            array("birth_date" => $dir),
            array("nationality" => $dir),
            array("student_id" => $dir),
            array("course" => $dir),
            array("academic_year" => $dir),
            array("admission_date" => $dir),
        );
        $o_list = $order_list[$column];
        //this is the end of the sorting

    }

    function student_documents(){
        $table = 'student_documents a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);


        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("first_name" => $dir),
            array("middle_name" => $dir),
            array("last_name" => $dir),
            array("gender" => $dir),
            array("birth_date" => $dir),
            array("nationality" => $dir),
            array("student_id" => $dir),
            array("course" => $dir),
            array("academic_year" => $dir),
            array("admission_date" => $dir),
        );
        $o_list = $order_list[$column];
        //this is the end of the sorting
    }

    function users(){
        $table = 'sysytem_users a';
        $this->db->from($table);

        //echo var_dump($_REQUEST);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);


        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        // $order = $_REQUEST['order'];
        // $column = $order[0]['column'];
        // $dir = $order[0]['dir'];

        // $order_list = array(
        //     array("user_name" => $dir),
        //     array("email" => $dir),
        //     array("group" => $dir),
        // );
        // $o_list = $order_list[$column];
        //this is the end of the sorting

        $this->db->select('a.user_name,a.email,a.profile_pic,
        a.password,a.status, b.sys_group')->from('sysytem_users a')
            ->join('sysytem_user_groups b', 'a.user_name=b.sys_user');

        //filtering
        // isset($type) && $type != '' ? $this->db->where_in('a.status', $status) : '';

        // if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {

        //     $this->db->group_start();
        //     $name = explode(' ', strtolower($_REQUEST['search']['value']));
        //     count($name) == 2 ? $this->db->like(array('a.first_name' => $name[0])) : $this->db->like('a.first_name', strtolower($_REQUEST['search']['value']));
        //     count($name) == 2 ? $this->db->or_like(array('a.last_name' => $name[1])) : $this->db->or_like('a.last_name', strtolower($_REQUEST['search']['value']));
        //     $this->db->or_like('a.phone', substr($_REQUEST['search']['value'], 1));
        //     $this->db->group_end();

        // }

        $this->db->order_by(key($o_list), current($o_list));
        $users = $this->db->limit($iDisplayLength, $iDisplayStart)->get()->result();


        $no = 1;
        foreach ($users as $sb):
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
                                        <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">';
            $output .= $this->authorization->is_role_for_group('can_view_users') ?
                    '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'profile') . '">
                    Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            $output .= $this->authorization->is_role_for_group('can_add_users') ?
            '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'profile') . '">
            Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            $output .= $this->authorization->is_role_for_group('can_update_users') ?
            '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'profile') . '">
            Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            $output .= $this->authorization->is_role_for_group('can_delete_users') ?
            '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'profile') . '">
            Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';

                $output .= $this->custom_library->role_exist('create user') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url($this->page_level . 'users/edit/' . $sb->id * date('Y')) . '">
                            Edit
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';
                $output .= $this->custom_library->role_exist('delete user') ?
                    '<li onclick="return confirm(\'Deleting user will delete all records attached to a user, Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url($this->page_level . 'users/delete/' . $sb->id * date('Y')) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';

                
            // if($sb->id == $this->session->id){
            //     $output .= $this->custom_library->role_exist('create user') ?
            //         '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'profile') . '">Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            // } else {
            //     $output .= $this->custom_library->role_exist('create user') ?
            //         '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'users/edit/' . $sb->id * date('Y')) . '">Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            //     //$output .= $this->custom_library->role_exist('reset user password') ? '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'users/reset_password/' . $sb->id * date('Y')) . '">Reset<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            //     $output .= $this->custom_library->role_exist('delete user') ?
            //         '<li onclick="return confirm(\'Deleting user will delete all records attached to a user, Are you sure ? \')" class="dropdown-item"><a href="' . base_url($this->page_level . 'users/delete/' . $sb->id * date('Y')) . '">Delete<span class="pull-right"><i class="fa fa-trash"></i></span></a></li>' : '';
            //     if ($sb->status == 2) $output .= $this->custom_library->role_exist('unblock user') ?
            //         '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'users/unblock/' . $sb->id * date('Y')) . '">Unblock<span class="pull-right"><i class="fa fa-unlock"></i></span></a></li>' : '';
            //     else $output .= $this->custom_library->role_exist('block user') ?
            //         '<li onclick="return confirm(\'Deleting user will delete all records attached to a user, Are you sure ? \')" class="dropdown-item"><a href="' . base_url($this->page_level . 'users/ban/' . $sb->id * date('Y')) . '">Block<span class="pull-right"><i class="fa fa-lock"></i></span></a></li>' : '';
            // }
            $output .= '</ul></li></ul>';


            //$status = $sb->status;
            //$status_btn = '<div style="width:100px;" class="btn btn-xs btn-' . ($status == '2' ? 'danger' : 'success') . '">' . ($status == '2' ? 'Blocked' : 'Active') . '</div>';


            $records["data"][] = array(
                anchor($this->page_level . 'users/edit/' . $sb->id * date('Y'), strlen($sb->first_name) > 0 ? ucwords($sb->first_name . ' ' . $sb->last_name) : '<span style="color: red;">Registration not Completed</span>'),
                $sb->user_name,
                $sb->email,
                $sb->profile_pic,
                $sb->password,
                $sb->status,
                $sb->sys_group,
                //trending_date($sb->created_on),
                //$sb->title,
                //$status_btn,
                $output

            );
            $no++; endforeach;


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }

    function logs(){
        $table = 'logs a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);


        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("first_name" => $dir),
            array("middle_name" => $dir),
            array("last_name" => $dir),
            array("gender" => $dir),
            array("birth_date" => $dir),
            array("nationality" => $dir),
            array("student_id" => $dir),
            array("course" => $dir),
            array("academic_year" => $dir),
            array("admission_date" => $dir),
        );
        $o_list = $order_list[$column];
        //this is the end of the sorting
    }

    function mylogs() {
        $table = 'logs a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = (int)$_REQUEST['length'];
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = (int)$_REQUEST['start'];
        $sEcho = (int)($_REQUEST['draw']);

        $records = array();
        $records['data'] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("a.id" => $dir),
            array("a.id" => $dir),
        );
        $o_list = $order_list[$column];

        $this->db->select('a.*,b.first_name,b.last_name')->from('logs a')->join('users b', 'a.created_by=b.id', 'left');

        if(isset($user_type) && isset($user_id)) {
            if(($user_type == 2 || $user_type == 1) && isset($id) && !empty($id)) $this->db->where(array('a.created_by' => $id));
            else if($user_type == 2) $this->db->where(array('b.created_by' => $user_id));
            else if($user_type == 3) $this->db->where(array('a.created_by' => $user_id));
        }

        $this->db->order_by('a.id', 'desc');
        //$this->db->order_by(key($o_list), current($o_list));

        $vht = $this->db->limit($iDisplayLength, $iDisplayStart)->get()->result();

        $no = 1;
        foreach ($vht as $tl):

            $date=$tl->created_on;
            $date_str = date('Y-m-d') == date('Y-m-d', $date) ? date('H:i:s', $date) : date('d-m-Y H:i:s', $date);

            $records['data'][] = array(
                $date_str,
                humanize($tl->first_name.' '.$tl->last_name),
                humanize($tl->transaction_type),
                humanize($tl->first_name.' '.$tl->last_name.' ') . $tl->details . $tl->target,
                $tl->ip,
                $tl->login_location,
                $tl->platform
            );
            $no++; endforeach;


        $records['draw'] = $sEcho;
        $records['recordsTotal'] = $iTotalRecords;
        $records['recordsFiltered'] = $iTotalRecords;

        echo json_encode($records);
    }


    function myusers($type = null)
    {
        $status = isset($type) && $type == 'blocked' ? [2] : [0, 1];
        isset($type) && $type != '' ? $this->db->where_in('a.status', $status) : '';

        $this->db->from('users a')->where(array('id !=' => $this->session->id));

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);


        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;


        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("id" => $dir),
            array("first_name" => $dir),
            array("phone" => $dir),
            array("phone" => $dir),
            array("created_on " => $dir),
            array("user_type " => $dir),
            array("status " => $dir),
        );
        $o_list = $order_list[$column];
//            (key($status)) . '">' . (current($status))

        //this is the end of the sorting


        $this->db->select('a.id,a.first_name,a.last_name,a.gender, c.country, a.phone,status,a.created_on,b.title,')->from('users a')
            ->join('user_type b', 'a.user_type=b.id', 'left')
            ->join('country c', 'c.a2_iso=a.country', 'left');

        //filtering
        isset($type) && $type != '' ? $this->db->where_in('a.status', $status) : '';

        if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {

            $this->db->group_start();
            $name = explode(' ', strtolower($_REQUEST['search']['value']));
            count($name) == 2 ? $this->db->like(array('a.first_name' => $name[0])) : $this->db->like('a.first_name', strtolower($_REQUEST['search']['value']));
            count($name) == 2 ? $this->db->or_like(array('a.last_name' => $name[1])) : $this->db->or_like('a.last_name', strtolower($_REQUEST['search']['value']));
            $this->db->or_like('a.phone', substr($_REQUEST['search']['value'], 1));
            $this->db->group_end();

        }


        //this block works on filtering

        if (isset($_REQUEST["date_range"]) && strlen($_REQUEST["date_range"]) > 0) {
            $dates = split_date($_REQUEST["date_range"], '~');
            $this->db->where(array('a.created_on >=' => strtotime($dates['date1'] . ' 00:00:00'), 'a.created_on <=' => strtotime($dates['date2'] . ' 23:59:59')));
        }

        isset($_REQUEST["gender"]) && strlen($_REQUEST["gender"]) > 0 ? $this->db->where(array('a.gender' => $_REQUEST["gender"])) : '';
        isset($_REQUEST["country"]) && strlen($_REQUEST["country"]) > 0 ? $this->db->where(array('a.country' => $_REQUEST["country"])) : '';
        isset($_REQUEST["user_role"]) && strlen($_REQUEST["user_role"]) > 0 ? $this->db->where(array('a.user_type' => $_REQUEST["user_role"])) : '';
        isset($_REQUEST["status"]) && strlen($_REQUEST["status"]) > 0 ? ($_REQUEST["status"] == 2 ? $this->db->where(array('a.status' => $_REQUEST["status"])) : $this->db->where(array('a.status !=' => 2))) : '';


        //end of filtering


        $this->db->order_by(key($o_list), current($o_list));

        $users = $this->db->limit($iDisplayLength, $iDisplayStart)->get()->result();


        $no = 1;
        foreach ($users as $sb):
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
                                        <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">';
            if($sb->id == $this->session->id){
                $output .= $this->custom_library->role_exist('create user') ?
                    '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'profile') . '">Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            } else {
                $output .= $this->custom_library->role_exist('create user') ?
                    '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'users/edit/' . $sb->id * date('Y')) . '">Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
                //$output .= $this->custom_library->role_exist('reset user password') ? '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'users/reset_password/' . $sb->id * date('Y')) . '">Reset<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
                $output .= $this->custom_library->role_exist('delete user') ?
                    '<li onclick="return confirm(\'Deleting user will delete all records attached to a user, Are you sure ? \')" class="dropdown-item"><a href="' . base_url($this->page_level . 'users/delete/' . $sb->id * date('Y')) . '">Delete<span class="pull-right"><i class="fa fa-trash"></i></span></a></li>' : '';
                if ($sb->status == 2) $output .= $this->custom_library->role_exist('unblock user') ?
                    '<li class="dropdown-item"><a href="' . base_url($this->page_level . 'users/unblock/' . $sb->id * date('Y')) . '">Unblock<span class="pull-right"><i class="fa fa-unlock"></i></span></a></li>' : '';
                else $output .= $this->custom_library->role_exist('block user') ?
                    '<li onclick="return confirm(\'Deleting user will delete all records attached to a user, Are you sure ? \')" class="dropdown-item"><a href="' . base_url($this->page_level . 'users/ban/' . $sb->id * date('Y')) . '">Block<span class="pull-right"><i class="fa fa-lock"></i></span></a></li>' : '';
            }
            $output .= '</ul></li></ul>';


            $status = $sb->status;
            $status_btn = '<div style="width:100px;" class="btn btn-xs btn-' . ($status == '2' ? 'danger' : 'success') . '">' . ($status == '2' ? 'Blocked' : 'Active') . '</div>';


            $records["data"][] = array(
                anchor($this->page_level . 'users/edit/' . $sb->id * date('Y'), strlen($sb->first_name) > 0 ? ucwords($sb->first_name . ' ' . $sb->last_name) : '<span style="color: red;">Registration not Completed</span>'),
                $sb->gender,
                $sb->country,
                $sb->phone,
                trending_date($sb->created_on),
                $sb->title,
                $status_btn,
                $output

            );
            $no++; endforeach;


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    function category()
    {

        $table = 'category a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = (int)$_REQUEST['length'];
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = (int)$_REQUEST['start'];
        $sEcho = (int)($_REQUEST['draw']);

        $records = array();
        $records['data'] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("a.id" => $dir),
            array("a.name" => $dir),
        );
        $o_list = $order_list[$column];

        $this->db->select('a.id, a.name, a.parent, a.status')->from($table);

        //filtering
        if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {
            $this->db->group_start();
            $this->db->or_like('a.name', $_REQUEST['search']['value']);
            $this->db->group_end();
        }

        isset($_REQUEST["status"]) && strlen($_REQUEST["status"]) > 0 ? $this->db->where(array('a.status' => $_REQUEST["status"])) : '';
        isset($_REQUEST["parent"]) && strlen($_REQUEST["parent"]) > 0 ? $this->db->where(array('a.parent' => $_REQUEST["parent"])) : '';

        $this->db->order_by(key($o_list), current($o_list));

        $vht = $this->db->limit($iDisplayLength, $iDisplayStart)->get()->result();

        $no = 1;
        foreach ($vht as $sb):

            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
                                        <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">';
            $output .= $this->custom_library->role_exist('view category') ?
                '<li class="dropdown-item"><a href="'. base_url($this->page_level . 'category/view/' . $sb->id * date('Y')) .'">View<span class="pull-right"><i class="fa fa-eye"></i></span></a></li>' : '';
            $output .= $this->custom_library->role_exist('edit category') ?
                '<li class="dropdown-item"><a href="'. base_url($this->page_level . 'category/edit/' . $sb->id * date('Y')) .'">Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            if($sb->status == 'active'){
                $output .= $this->custom_library->role_exist('block category') ?
                    '<li class="dropdown-item"><a href="'. base_url($this->page_level . 'category/block/' . $sb->id * date('Y')) .'">Block<span class="pull-right"><i class="fa fa-ban"></i></span></a></li>' : '';
            } else {
                $output .= $this->custom_library->role_exist('unblock category') ?
                    '<li class="dropdown-item"><a href="'. base_url($this->page_level . 'category/unblock/' . $sb->id * date('Y')) .'">Unblock<span class="pull-right"><i class="fa fa-unlock"></i></span></a></li>' : '';
            }
            $output .= $this->custom_library->role_exist('delete category') ?
                '<li onclick="return confirm(\'You are about to delete a record, Are you sure ? \')" class="dropdown-item"><a href="'. base_url($this->page_level . 'category/delete/' . $sb->id * date('Y')) .'">Delete<span class="pull-right"><i class="fa fa-trash"></i></span></a></li>' : '';
            $output .= '</ul></li></ul>';

            $parent = isset($sb->parent) && !empty($sb->parent) ? ($this->db->select('a.name')->from($table)->where('id', $sb->parent)->get()->row())->name : 'None';

            $records['data'][] = array(
                $no,
                $sb->name,
                $parent,
                humanize($sb->status),
                $output
            );
            $no++; endforeach;


        $records['draw'] = $sEcho;
        $records['recordsTotal'] = $iTotalRecords;
        $records['recordsFiltered'] = $iTotalRecords;

        echo json_encode($records);
    }

    function products()
    {
        $app_id = $this->db->from('users')->select('app_id')->where('id', $this->session->id)->get()->row();
        $table = 'products a';
        $this->db->from($table);

        $trecords = $this->db->count_all_results();
        $iTotalRecords = $trecords;
        $iDisplayLength = (int)$_REQUEST['length'];
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = (int)$_REQUEST['start'];
        $sEcho = (int)($_REQUEST['draw']);

        $records = array();
        $records['data'] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // this is the part where sorting is made
        $order = $_REQUEST['order'];
        $column = $order[0]['column'];
        $dir = $order[0]['dir'];

        $order_list = array(
            array("a.id" => $dir),
            array("a.created_on" => $dir),
            array("a.name" => $dir),
            array("b.name" => $dir),
            array("a.seller_id" => $dir),
            array("a.status" => $dir),
            array("a.availability_date" => $dir),
            array("a.district" => $dir),
            array("a.expiry" => $dir),
        );
        $o_list = $order_list[$column];

        $this->db->select('a.*, b.name as catname')->from($table)->join('category b', 'b.id=a.category');

        if(isset($app_id) && $this->session->user_type > 1){
            $this->db->where(array('seller_id' => $app_id->app_id));
        }

        //filtering
        if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {
            $this->db->group_start();
            $this->db->or_like('a.name', $_REQUEST['search']['value']);
            $this->db->group_end();
        }

        isset($_REQUEST["status"]) && strlen($_REQUEST["status"]) > 0 ? $this->db->where(array('a.status' => $_REQUEST["status"])) : '';
        isset($_REQUEST["category"]) && strlen($_REQUEST["category"]) > 0 ? $this->db->where(array('a.category' => $_REQUEST["category"])) : '';
        isset($_REQUEST["type"]) && strlen($_REQUEST["type"]) > 0 ? $this->db->where('a.type', $_REQUEST["type"]) : '';
        isset($_REQUEST["available_from"]) && strlen($_REQUEST["available_from"]) > 0 ? $this->db->where(array('a.availability_date >=' => strtotime($_REQUEST["available_from"]))) : '';
        isset($_REQUEST["available_to"]) && strlen($_REQUEST["available_to"]) > 0 ? $this->db->where(array('a.availability_date <=' => strtotime($_REQUEST["available_to"]))) : '';

        $this->db->order_by(key($o_list), current($o_list));

        $vht = $this->db->limit($iDisplayLength, $iDisplayStart)->get()->result();

        $no = 1;
        foreach ($vht as $sb):

            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">';
            $output .= $this->custom_library->role_exist('view products') ?
                '<li class="dropdown-item"><a href="'. base_url($this->page_level . 'products/view/' . $sb->id * date('Y')) .'">View<span class="pull-right"><i class="fa fa-eye"></i></span></a></li>' : '';
            $output .= $this->custom_library->role_exist('edit products') ?
                '<li class="dropdown-item"><a href="'. base_url($this->page_level . 'products/edit/' . $sb->id * date('Y')) .'">Edit<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>' : '';
            if($sb->status == 'active'){
                $output .= $this->custom_library->role_exist('publish products') ?
                    '<li onclick="return confirm(\'You are about to publish a product, Are you sure ? \')" class="dropdown-item"><a href="'. base_url($this->page_level . 'products/publish/' . $sb->id * date('Y')) .'">Publish<span class="pull-right"><i class="fa fa-check"></i></span></a></li>' : '';
            } elseif($sb->status == 'published') {
                $output .= $this->custom_library->role_exist('unpublish products') ?
                    '<li onclick="return confirm(\'You are about to unpublish a product, Are you sure ? \')" class="dropdown-item"><a href="'. base_url($this->page_level . 'products/unpublish/' . $sb->id * date('Y')) .'">Unpublish<span class="pull-right"><i class="fa fa-ban"></i></span></a></li>' : '';
            } elseif($sb->status == 'unpublished') {
                $output .= $this->custom_library->role_exist('publish products') ?
                    '<li onclick="return confirm(\'You are about to publish a product, Are you sure ? \')" class="dropdown-item"><a href="'. base_url($this->page_level . 'products/publish/' . $sb->id * date('Y')) .'">Publish<span class="pull-right"><i class="fa fa-check"></i></span></a></li>' : '';
            }
            $output .= $this->custom_library->role_exist('reset products') ?
                '<li onclick="return confirm(\'You are about to reset a product expiry, Are you sure ? \')" class="dropdown-item"><a href="'. base_url($this->page_level . 'products/reset/' . $sb->id * date('Y')) .'">Reset<span class="pull-right"><i class="fa fa-check"></i></span></a></li>' : '';
            $output .= $this->custom_library->role_exist('delete products') ?
                '<li onclick="return confirm(\'You are about to delete a product, Are you sure ? \')" class="dropdown-item"><a href="'. base_url($this->page_level . 'products/delete/' . $sb->id * date('Y')) .'">Delete<span class="pull-right"><i class="fa fa-trash"></i></span></a></li>' : '';
            $output .= '</ul></li></ul>';
            $path = $this->admin_units->get_path($sb->village);
            $seller = $this->db->where('id', $sb->seller_id)->select('category, name_of_institution, surname, given_names')->from('register')->get()->row();
            $seller_name = 'N/A';
            if(isset($seller)){
                if($seller->category == 'Individual'){
                    $seller_name = $seller->surname . ' ' . $seller->given_names;
                } elseif ($seller->category == 'Institution'){
                    $seller_name = $seller->name_of_institution;
                }
            }
            $records['data'][] = array(
                $no,
                date('d-m-Y H:i:s', $sb->created_on),
                $sb->name,
                $sb->catname,
                $seller_name,
                $sb->status == 'active' ? 'New' : humanize($sb->status),
                date('d-m-Y', $sb->availability_date),
                count($path) >= 2 ? $path[2]['title'] : 'N/A',
                date('d-m-Y', $sb->expiry),
                $output
            );
            $no++; endforeach;


        $records['draw'] = $sEcho;
        $records['recordsTotal'] = $iTotalRecords;
        $records['recordsFiltered'] = $iTotalRecords;

        echo json_encode($records);
    }

}


?>