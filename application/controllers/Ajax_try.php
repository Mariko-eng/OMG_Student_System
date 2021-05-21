<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_try extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

   public function get_users()
   {
    $table = 'sysytem_users';
    $this->db->from($table);
    $totalrecords = $this->db->count_all_results();
    $draw = intval($this->input->get("draw"));
    $displayStart = intval($this->input->get("start"));
    $displayLength = intval($this->input->get("length"));
    $displayLength = $displayLength < 0 ? $totalrecords : $displayLength;

    $this->db->select('a.aut_id,a.user_name,a.email,a.profile_pic,
        a.password,a.status, a.group')->from('sysytem_users a')
        ->join('sysytem_user_groups b', 'a.user_name=b.sys_user')
        ->limit($displayLength, $displayStart);
    $users = $this->db->get();

    $data = [];
    foreach($users->result() as $r) {
        $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">';
                    $output .= $this->authorization->is_role_for_group('can_view_users','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/users/view/' . $r->aut_id) . '">
                            View
                            <span class="pull-right">
                                <i class="fa fa-folder"></i>
                            </span>
                        </a>
                    </li>' : '';

                    $output .= $this->authorization->is_role_for_group('can_update_users','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/users/update/' . $r->aut_id) . '">
                            Edit
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';
                $output .= $this->authorization->is_role_for_group('can_delete_users','title') ?
                    '<li onclick="return confirm(\'Deleting user will delete all records attached to a user, Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url('app/users/delete/' . $r->aut_id) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';
            $output .= '</ul></li></ul>';

           $data[] = array(
                $r->aut_id,$r->user_name,$r->email,$r->profile_pic,
                $r->password,$r->group,$output);
      }

      $result = array(
               "draw" => $draw,
                "recordsTotal" => $totalrecords,
                "recordsFiltered" => $totalrecords,
                "data" => $data
            );
        echo json_encode($result);
        exit();
   }

   public function get_logs()
   {
    $table = 'sysytem_logs';
    $this->db->from($table);

    $totalrecords = $this->db->count_all_results();
    $draw = intval($this->input->get("draw")); 
    $displayStart = intval($this->input->get("start"));
    $displayLength = intval($this->input->get("length"));
    $displayLength = $displayLength < 0 ? $totalrecords : $displayLength;

    //filtering
    if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {
        $this->db->group_start();
        $this->db->or_like('created_by', $_REQUEST['search']['value']);
        $this->db->or_like('details', $_REQUEST['search']['value']);
        $this->db->or_like('transaction_type', $_REQUEST['search']['value']);
        $this->db->or_like('created_on_str', $_REQUEST['search']['value']);
        $this->db->group_end();
    }

    $limit_logs = $this->db->limit($displayLength, $displayStart)->get("sysytem_logs");

    $data = [];
    foreach($limit_logs->result() as $r) {
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">';                 
                $output .= $this->authorization->is_role_for_group('can_delete_sysytem_logs','title') ?
                    '<li onclick="return confirm(\'Deleting user will delete all records attached to a user, Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url('app/logs/delete/' . $r->aut_id) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';
            $output .= '</ul></li></ul>';

           $data[] = array(
            $r->aut_id,$r->created_by,$r->created_on_str,$r->ip,$r->transaction_type,
            $r->details,$r->platform,$r->browser,$r->agent_string,$output);
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalrecords, 
            "recordsFiltered" => $totalrecords,
            "data" => $data);
        echo json_encode($result);
        exit();
   }

   public function get_courses(){
    $table = 'courses';
    $this->db->from($table);

    $totalrecords = $this->db->count_all_results();
    $draw = intval($this->input->get("draw"));
    $displayStart = intval($this->input->get("start"));
    $displayLength = intval($this->input->get("length"));
    $displayLength = $displayLength < 0 ? $totalrecords : $displayLength;
    
    //filtering
    if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {
        $this->db->group_start();
        $this->db->or_like('course_name', $_REQUEST['search']['value']);
        $this->db->or_like('course_id', $_REQUEST['search']['value']);
        $this->db->or_like('faculty', $_REQUEST['search']['value']);
        $this->db->group_end();
    
    }
    $limit_logs = $this->db->limit($displayLength, $displayStart)->get("courses");

    $data = [];
    foreach($limit_logs->result() as $r) {
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">';
                $output .= $this->authorization->is_role_for_group('can_view_courses','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/courses/view/' . $r->aut_id) . '">
                             View
                            <span class="pull-right">
                                <i class="fa fa-folder"></i>
                            </span>
                        </a>
                    </li>' : '';

                    $output .= $this->authorization->is_role_for_group('can_update_courses','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/courses/update/' . $r->aut_id) . '">
                            Edit
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';                    
                $output .= $this->authorization->is_role_for_group('can_delete_courses','title') ?
                    '<li onclick="return confirm(\'Deleting a course will delete all records attached to the course,
                     Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url('app/courses/delete/' . $r->aut_id) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';
            $output .= '</ul></li></ul>';

           $data[] = array(
            $r->aut_id,$r->course_id,$r->course_name,$r->period,$r->faculty,$output);
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalrecords, 
            "recordsFiltered" => $totalrecords,
            "data" => $data);
        echo json_encode($result);
        exit();
   }   

   public function get_students(){
    $table = 'students a';
    $this->db->from($table);

    $totalrecords = $this->db->count_all_results();
    $draw = intval($this->input->get("draw"));
    $displayStart = intval($this->input->get("start"));
    $displayLength = intval($this->input->get("length"));
    $displayLength = $displayLength < 0 ? $totalrecords : $displayLength;

    //filtering
    if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {
        $this->db->group_start();
        $this->db->or_like('student_id', $_REQUEST['search']['value']);
        $this->db->or_like('username', $_REQUEST['search']['value']);
        $this->db->or_like('academic_year', $_REQUEST['search']['value']);
        $this->db->or_like('course', $_REQUEST['search']['value']);
        $this->db->or_like('first_name', $_REQUEST['search']['value']);
        $this->db->or_like('last_name', $_REQUEST['search']['value']);
        $this->db->or_like('gender', $_REQUEST['search']['value']);
        $this->db->or_like('email', $_REQUEST['search']['value']);
        $this->db->group_end();
    }

    $limit_logs = $this->db->limit($displayLength, $displayStart)->get("students");

    // $limit_logs = $this->db->select('a.*,b.group')->from('students a')
    //     ->join('sysytem_users b', 'a.email=b.email')
    //     ->limit($displayLength, $displayStart);
    // $users = $this->db->get();


    $data = [];
    foreach($limit_logs->result() as $r) {
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">';
                $output .= $this->authorization->is_role_for_group('can_view_students','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/students/view/' . $r->aut_id) . '">
                            View
                            <span class="pull-right">
                                <i class="fa fa-folder"></i>
                            </span>
                        </a>
                    </li>' : '';
                $output .= $this->authorization->is_role_for_group('can_update_students','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/students/update/' . $r->aut_id) . '">
                            Edit
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';
                $output .= $this->authorization->is_role_for_group('can_add_student_documents','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/student_documents/new/' . $r->aut_id) . '">
                            Add Student Docs
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';
                $output .= $this->authorization->is_role_for_group('can_add_high_school_data','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/high_school_data/new/' . $r->aut_id) . '">
                            Add High School Data
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                </li>' : '';                    
                $output .= $this->authorization->is_role_for_group('can_delete_sysytem_logs','title') ?
                    '<li onclick="return confirm(\'Deleting student will delete all records attached to a student, 
                    Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url('app/students/delete/' . $r->aut_id) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';
            $output .= '</ul></li></ul>';

           $data[] = array(
            $r->aut_id,$r->student_id,$r->first_name,$r->last_name,
            $r->username,$r->gender,$r->birth_date,
            $r->email,$r->phone,$r->profile_pic,$r->nationality,
            $r->admission_date,$r->course,$r->academic_year,$output);
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalrecords, 
            "recordsFiltered" => $totalrecords,
            "data" => $data);
        echo json_encode($result);
        exit();

   }

   public function get_student_docs(){
    $table = 'student_documents';
    $this->db->from($table);

    $totalrecords = $this->db->count_all_results();
    $draw = intval($this->input->get("draw"));
    $displayStart = intval($this->input->get("start"));
    $displayLength = intval($this->input->get("length"));
    $displayLength = $displayLength < 0 ? $totalrecords : $displayLength;

    $limit_logs = $this->db->limit($displayLength, $displayStart)->get("student_documents ");

    $data = [];
    foreach($limit_logs->result() as $r) {
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">';
                $output .= $this->authorization->is_role_for_group('can_view_student_documents','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/student_documents/view/' . $r->aut_id) . '">
                            View
                            <span class="pull-right">
                                <i class="fa fa-folder"></i>
                            </span>
                        </a>
                    </li>' : '';
                    $output .= $this->authorization->is_role_for_group('can_update_student_documents','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/student_documents/update/' . $r->aut_id) . '">
                            Edit
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';                       
                $output .= $this->authorization->is_role_for_group('can_delete_student_documents','title') ?
                    '<li onclick="return confirm(\'Deleting student document will delete all records attached to a student document, 
                    Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url('app/student_documents/delete/' . $r->aut_id) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';
            $output .= '</ul></li></ul>';

           $data[] = array(
            $r->aut_id,$r->student_id,$r->national_id_no,$r->national_id_doc_name,
            $r->high_school_cert_no,$r->high_school_cert_doc_name,$r->birth_certificate_no,
            $r->birth_certificate_doc_name,$output);
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalrecords, 
            "recordsFiltered" => $totalrecords,
            "data" => $data);
        echo json_encode($result);
        exit();

   }

   public function get_high_school_data(){
    $table = 'high_school_data';
    $this->db->from($table);

    $totalrecords = $this->db->count_all_results();
    $draw = intval($this->input->get("draw"));
    $displayStart = intval($this->input->get("start"));
    $displayLength = intval($this->input->get("length"));
    $displayLength = $displayLength < 0 ? $totalrecords : $displayLength;

    $limit_logs = $this->db->limit($displayLength, $displayStart)->get("high_school_data");

    $data = [];
    foreach($limit_logs->result() as $r) {
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">';
                $output .= $this->authorization->is_role_for_group('can_view_high_school_data','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/high_school_data/view/' . $r->aut_id) . '">
                            View
                            <span class="pull-right">
                                <i class="fa fa-folder"></i>
                            </span>
                        </a>
                    </li>' : '';
                    $output .= $this->authorization->is_role_for_group('can_update_high_school_data','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/high_school_data/update/' . $r->aut_id) . '">
                            Edit
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';                    
                $output .= $this->authorization->is_role_for_group('can_delete_high_school_data','title') ?
                    '<li onclick="return confirm(\'Delete high school data record, Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url('app/high_school_data/delete/' . $r->aut_id) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';
            $output .= '</ul></li></ul>';

           $data[] = array(
            $r->aut_id,$r->student_id,$r->school_name,$r->english_degree,$r->math_degree,
            $r->physics_degree,$r->chemistry_degree,$r->biology_degree,
            $r->total,$output);
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalrecords, 
            "recordsFiltered" => $totalrecords,
            "data" => $data);
        echo json_encode($result);
        exit();

   }

   public function get_courses_stud_profile(){
    $table = 'courses';
    $this->db->from($table);

    $totalrecords = $this->db->count_all_results();
    $draw = intval($this->input->get("draw"));
    $displayStart = intval($this->input->get("start"));
    $displayLength = intval($this->input->get("length"));
    $displayLength = $displayLength < 0 ? $totalrecords : $displayLength;
    
    //filtering
    if (isset($_REQUEST['search']['value']) && strlen($_REQUEST['search']['value']) > 2) {
        $this->db->group_start();
        $this->db->or_like('course_name', $_REQUEST['search']['value']);
        $this->db->or_like('course_id', $_REQUEST['search']['value']);
        $this->db->or_like('faculty', $_REQUEST['search']['value']);
        $this->db->group_end();
    
    }
    $limit_logs = $this->db->limit($displayLength, $displayStart)->get("courses");

    $data = [];
    foreach($limit_logs->result() as $r) {
            $output = '<ul class=""><li><a class="btn green-jungle btn-sm" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Action <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">';
                $output .= $this->authorization->is_role_for_group('can_view_courses','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/courses/view/' . $r->aut_id) . '">
                             View
                            <span class="pull-right">
                                <i class="fa fa-folder"></i>
                            </span>
                        </a>
                    </li>' : '';

                    $output .= $this->authorization->is_role_for_group('can_update_courses','title') ?
                    '<li class="dropdown-item">
                        <a href="' . base_url('app/courses/update/' . $r->aut_id) . '">
                            Edit
                            <span class="pull-right">
                                <i class="fa fa-edit"></i>
                            </span>
                        </a>
                    </li>' : '';                    
                $output .= $this->authorization->is_role_for_group('can_delete_courses','title') ?
                    '<li onclick="return confirm(\'Deleting a course will delete all records attached to the course,
                     Are you sure ? \')" class="dropdown-item">
                        <a href="' . base_url('app/courses/delete/' . $r->aut_id) . '">
                            Delete
                            <span class="pull-right">
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </li>' : '';
            $output .= '</ul></li></ul>';

           $data[] = array(
            $r->aut_id,$r->course_id,$r->course_name,$r->period,$r->faculty,$output);
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalrecords, 
            "recordsFiltered" => $totalrecords,
            "data" => $data);
        echo json_encode($result);
        exit();
   }   
}

