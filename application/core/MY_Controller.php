<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

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

        //echo $this->page_level;

    }

    public function isloggedin()
    {
        return $this->session->userdata('user_type') == "non_admin" || $this->session->userdata('user_type') == "students" ||
        $this->session->userdata('user_type') == "admin" ? true : false;

    }

    public function logout()
    {
        if($this->session->user_name){
            $this->add_logs($this->session->user_name, 'login', '', ' Logged out');
        }
        $this->session->sess_destroy();
        redirect('home/login', 'refresh');
    }


    public function dashboard()
    {
        $this->isloggedin() == true ? '' : $this->logout();
        $data = array(
            'title' => 'dashboard',
            'subtitle' => 'Welcome',
        );
        $this->session->unset_userdata('alert');
        $data['page_view'] = $this->load->view('dashboard', $data, true);
        $this->load->view('main_page', $data);
    }

    public function courses($type = null, $id = null){
        $this->isloggedin() ? '' : $this->logout();
        $data = array(
            'title' => $title = $this->uri->segment(2),
            'subtitle' => $type
        );
        $data['page_view'] = "";

        switch($type){
            case 'view':
                $this->session->unset_userdata('alert');
                $data['row'] = $this->db->select()->from('courses')->where('aut_id', $id)->get()->row_array();
                $this->add_logs($this->session->id, 'Courses: view', 'Course ' . $id, ' has viewed ');
                $data['page_view'] .= $this->load->view('school/view/view_courses', $data, true);
                $this->load->view('main_page_new', $data);
                break;
            case 'new':
                $this->session->unset_userdata('alert');
                $this->form_validation
                    ->set_rules('course_name', 'Course Name', 'trim|required')
                    ->set_rules('course_id', 'Course ID', 'trim|required')
                    ->set_rules('period', 'Password', 'trim|required');
                
                $course_name = $this->input->post('course_name');    
                $course_id = $this->input->post('course_id');

                if ($this->form_validation->run() == true)
                {                    
                    $total_rows =  $this->db->count_all('courses');
                    $this->db->select_max('aut_id');
                    $query = $this->db->get('courses')->row();
                    $auto_id;
                    if($total_rows < 1){
                        $auto_id = 1;
                    }else{
                        $auto_id = $query->aut_id + 1;
                    }
                    $faculty = $this->input->post('faculty');                       
                    $values = array(
                        'aut_id' => $auto_id,
                        'faculty' => $faculty[0],
                        'course_name' => $this->input->post('course_name'),    
                        'course_id' => $this->input->post('course_id'),
                        'period' => $this->input->post('period')
                    );

                    $course_name = $this->input->post('course_name');    
                    $course_id = $this->input->post('course_id');

                    if($this->check_course_exist($course_name, $course_id)){
                        $alert_message = 'Failed to add Course, Either Course is Existing Already Or Wrong Information Inserted!!!!';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;

                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;                    
                        
                        $data['page_view'] .= $this->load->view('school/new/new_courses', $data, true);
                        $this->load->view('main_page_new', $data);
                    }else{
                        if($this->db->insert('courses', $values)){
                            $alert_message = 'A new course has been added to the system';
                            $alert_type = 'success';
                            $data['message'] = $alert_message;
                            $data['alert'] = $alert_type;

                            $alert = $this->load->view('alert', $data, true);
                            $this->add_logs($this->session->id, 'Course: added','courses', ' has been added');
                            $this->session->set_flashdata('alert', $alert);
                            redirect('app/courses/list');
                        }else{
                            $alert_message = 'Course Not Added To The System';
                            $alert_type = 'danger';
                            $data['message'] = $alert_message;
                            $data['alert'] = $alert_type;
                            $alert_page = $this->load->view('alert', $data, true);
                            $data['alert_page'] = $alert_page;

                            $data['page_view'] .= $this->load->view('school/new/new_courses', $data, true);
                            $this->load->view('main_page_new', $data);
                        }
                    }
                }else
                {    
                    $data['page_view'] .= $this->load->view('school/new/new_courses', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'update':
                $this->session->unset_userdata('alert');
                $data['row'] = $this->db->select()->from('courses')->where('aut_id', $id)->get()->row_array();
                $this->form_validation
                    ->set_rules('course_name', 'Course Name', 'trim|required')
                    ->set_rules('course_id', 'Course ID', 'trim|required')
                    ->set_rules('period', 'Password', 'trim|required');

                if ($this->form_validation->run() == true)
                {                    
                    $faculty = $this->input->post('faculty');                       
                    $values = array(
                        'faculty' => $faculty,
                        'course_name' => $this->input->post('course_name'),    
                        'course_id' => $this->input->post('course_id'),
                        'period' => $this->input->post('period')
                    );

                    $this->db->where('aut_id', $id);
                    if($this->db->update('courses', $values)){
                        $alert_message = 'Course'. $id.'has been updated to the system';
                        $alert_type = 'success';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;

                        $alert = $this->load->view('alert', $data, true);
                        $this->add_logs($this->session->id, 'Course: updated','courses', ' has been updated');
                        $this->session->set_flashdata('alert', $alert);
                        redirect('app/courses/list');
                    }else{
                        $alert_message = 'Course Not Updated';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;

                        $data['page_view'] .= $this->load->view('school/edit/update_courses', $data, true);
                        $this->load->view('main_page_new', $data);
                    }
                }else
                {    
                    $data['page_view'] .= $this->load->view('school/edit/update_courses', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'delete':
                $this->session->unset_userdata('alert');
                if ($this->db->where('aut_id', $id)->delete('courses')) {
                    $alert_message = 'Course has been deleted';
                    $alert_type = 'success';
                    $this->add_logs($this->session->id, 'Course: delete', 'Course ' . $id, ' has deleted ');
                } else {
                    $alert_message = 'Failed to delete course';
                    $alert_type = 'danger';
                }
                $data = array(
                    'message' => $alert_message,
                    'alert' => $alert_type
                );
                $alert = $this->load->view('alert', $data, true);
                $this->session->set_flashdata('alert', $alert);
                redirect('app/courses/list'); 
                break;
            default:
            $this->session->unset_userdata('alert');
            $data['scripts'] = $this->load->view('ajax/courses', $data, true);
            $data['page_view'] .= $this->load->view('school/datatables_courses', $data, true);
            $this->add_logs($this->session->id, 'Courses: list', 'Courses', ' has listed ');
            $this->load->view('main_page', $data);
        }
    }

    public function check_course_exist($course_name,$course_id) {
        $this->db->select('course_name');
        $this->db->where('course_name',$course_name);
        $query_course_name = $this->db->get('courses');
        
        if(($query_course_name->num_rows() == 1)){
            return true;
        }

        $this->db->select('course_id');
        $this->db->where('course_id',$course_id);
        $query_course_id= $this->db->get('courses');

        if($query_course_id->num_rows() == 1){
            return true;
        }
   }

    public function students($type = null, $id = null){
        $this->isloggedin() ? '' : $this->logout();
        $data = array(
            'title' => $title = $this->uri->segment(2),
            'subtitle' => $type
        );
        $data['page_view'] = "";

        switch($type){
            case 'view':
                $data['row'] = $this->db->select()->from('students')->where('aut_id', $id)->get()->row_array();
                $this->add_logs($this->session->id, 'Students: view', 'student ' . $id, ' has viewed ');
                $data['page_view'] .= $this->load->view('school/view/view_students', $data, true);
                $this->load->view('main_page_new', $data);
                break;
            case 'new':
                $this->form_validation
                    ->set_rules('first_name', 'First Name', 'trim|required')
                    ->set_rules('last_name', 'Last Name', 'trim|required')
                    ->set_rules('user_name', 'User Name', 'trim|required')
                    ->set_rules('gender', 'Gender', 'trim|required')
                    ->set_rules('birth_date', 'Birth Date', 'trim|required')
                    ->set_rules('email', 'Email', 'trim|required')
                    ->set_rules('phone', 'Phone', 'trim|required')
                    ->set_rules('profile_pic', 'Profile Picture', 'trim')
                    ->set_rules('nationality', 'Nationality', 'trim|required')
                    ->set_rules('course_name', 'Course', 'trim|required')
                    ->set_rules('academic_year', 'Academic Year', 'trim|required');
                
                $this->db->select('aut_id, course_name');
                $data['school_courses'] = $this->db->get('courses')->result_array();

                if ($this->form_validation->run() == true){
                    $total_rows =  $this->db->count_all('students');
                    $this->db->select_max('aut_id');
                    $query_aut_id = $this->db->get('students')->row();
                    $this->db->select_max('student_id');
                    $query_student_id = $this->db->get('students')->row();
                    $auto_id;   $stud_id;
                
                    if($total_rows < 1){
                        $auto_id = 1;
                        $stud_id = 202100000;
                    }else{
                        $auto_id = $query_aut_id->aut_id + 1;
                        $stud_id = $query_student_id->student_id + 1;
                    }

                    $the_course = $this->input->post('course_name');
                    $this->db->select('course_name');
                    $this->db->where('aut_id', $the_course);
                    $selected_course = $this->db->get('courses')->result_array();

                    $values = array(
                        'aut_id' => $auto_id,
                        'student_id' => $stud_id,
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'username' => $this->input->post('user_name'),
                        'gender' => $this->input->post('gender'),
                        'birth_date' => $this->input->post('birth_date'),
                        'email' => $this->input->post('email'),
                        'phone' => $this->input->post('phone'),
                        'nationality' => $this->input->post('nationality'),
                        'password' => random_string('alnum', 12),
                        'course' => $this->input->post('course_name'),
                        'academic_year' => $this->input->post('academic_year')
                    );

                    $email = $this->input->post('email');

                    $path = $config['upload_path'] = 'uploads/students/';
                    $config['max_size'] = '2000';
                    if (!is_dir($path)) //create the folder if it's not already exists
                    {
                        mkdir($path, 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('userfile')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['profile_pic'] = $path . $file_name;
                    }
                    if($this->check_student_exist($email)){
                        $alert_message = 'Failed to add Student, Either Student is Existing Already Or Wrong Information Inserted!!!!';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;  
                        $data['page_view'] .= $this->load->view('school/new/new_students', $data, true);
                        $this->load->view('main_page_new', $data);
                    }else if($this->db->insert('students', $values)){
                        $values_user = array(
                            "user_name" => $values["username"],
                            "email" => $values["email"],
                            "student_id" => $values["student_id"],
                            "password" => $values["password"],
                            "profile_pic" => $values["profile_pic"],
                            "status" => 1,
                            "group" => "students"
                        );
                        $values_user_group = array(
                            "sys_user" => $values["username"],
                            "sys_group" => "students"
                        );
                        $this->db->insert('sysytem_users',$values_user);
                        $this->db->insert('sysytem_user_groups',$values_user_group);
                        $alert_message = 'A new student has been added to the system';
                        $alert_type = 'success';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert = $this->load->view('alert', $data, true);
                        $this->add_logs($this->session->id, 'User: added','students', ' has been added');
                        $this->session->set_flashdata('alert', $alert);
                        redirect('app/students/list');
                    }else{
                        $alert_message = 'Student Not Added To The System';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;

                        $data['page_view'] .= $this->load->view('school/new/new_students', $data, true);
                        $this->load->view('main_page_new', $data);
                    }
                }else{
                    $data['page_view'] .= $this->load->view('school/new/new_students', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'update':
                $data['row'] = $this->db->select()->from('students')->where('aut_id', $id)->get()->row_array();
                $data['school_courses'] = $this->db->select('course_name')->get('courses')->result_array();
                $this->form_validation
                    ->set_rules('first_name', 'First Name', 'trim|required')
                    ->set_rules('last_name', 'Last Name', 'trim|required')
                    ->set_rules('user_name', 'User Name', 'trim|required')
                    ->set_rules('gender', 'Gender', 'trim|required')
                    ->set_rules('birth_date', 'Birth Date', 'trim|required')
                    ->set_rules('email', 'Email', 'trim|required')
                    ->set_rules('phone', 'Phone', 'trim|required')
                    ->set_rules('profile_pic', 'Profile Picture', 'trim')
                    ->set_rules('nationality', 'Nationality', 'trim|required')
                    ->set_rules('course_name', 'Course', 'trim|required')
                    ->set_rules('password', 'Password', 'trim|required')
                    ->set_rules('academic_year', 'Academic Year', 'trim|required');

                if ($this->form_validation->run() == true)
                {   
                    $this->db->select('student_id');
                    $student = $this->db->get('students')->row_array();     
                    $values = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'username' => $this->input->post('user_name'),
                        'gender' => $this->input->post('gender'),
                        'birth_date' => $this->input->post('birth_date'),
                        'email' => $this->input->post('email'),
                        'phone' => $this->input->post('phone'),
                        'nationality' => $this->input->post('nationality'),
                        'course' => $this->input->post('course_name'),
                        'password' => $this->input->post('password'),
                        'academic_year' => $this->input->post('academic_year')
                    );
                    $path = $config['upload_path'] = 'uploads/students/';
                    $config['max_size'] = '2000';
                    if (!is_dir($path)) //create the folder if it's not already exists
                    {
                        mkdir($path, 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('userfile')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['profile_pic'] = $path . $file_name;
                    }

                    $this->db->select('student_id');
                    $this->db->where('aut_id', $id);
                    $stud_id_data = $this->db->from('students')->get()->row_array();

                    $this->db->where('aut_id', $id);
                    if($this->db->update('students', $values)){
                        $values_user = array(
                            "user_name" => $values["username"],
                            "email" => $values["email"],
                            "password" => $values["password"]
                        );

                        if($this->upload->do_upload('userfile')){
                            $data = array('upload_data' => $this->upload->data());
                            $upload_data = $this->upload->data();
                            $file_name = $upload_data['file_name'];
                            $values_user['profile_pic'] = $path . $file_name;
                        }

                        $this->db->where('student_id', $stud_id_data['student_id']);
                        $this->db->update('sysytem_users', $values_user);

                        $alert_message = 'Student'. $id.'has been updated';
                        $alert_type = 'success';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;

                        $alert = $this->load->view('alert', $data, true);
                        $this->add_logs($this->session->id, 'Student:'.$id.' updated','students', ' has been updated');
                        $this->session->set_flashdata('alert', $alert);
                        redirect('app/students/list');
                    }else{
                        $alert_message = 'Student Not Updated';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;

                        $data['page_view'] .= $this->load->view('school/edit/update_students', $data, true);
                        $this->load->view('main_page_new', $data);
                    }
                }else
                {    
                    $data['page_view'] .= $this->load->view('school/edit/update_students', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'delete':
                if ($this->db->where('aut_id', $id)->delete('students')) {
                    $alert_message = 'Student has been deleted';
                    $alert_type = 'success';
                    $this->add_logs($this->session->id, 'Students: delete', 'Student ' . $id, ' has deleted ');
                }else {
                    $alert_message = 'Failed to delete student';
                    $alert_type = 'danger';
                }
                $data = array(
                    'message' => $alert_message,
                    'alert' => $alert_type
                );
                $alert = $this->load->view('alert', $data, true);
                $this->session->set_flashdata('alert', $alert);

                redirect('app/students/list'); 
                break;
            default:
                $data['scripts'] = $this->load->view('ajax/students', $data, true);
                $data['page_view'] .= $this->load->view('school/datatables_students', $data, true);
                $this->add_logs($this->session->id, 'Students: list', 'students', ' has listed ');
                $this->load->view('main_page', $data);
            }
        }

    public function check_student_exist($email){
        $this->db->select('email');
        $this->db->where('email',$email);
        $query_first_name = $this->db->get('students');
    
        if(($query_first_name->num_rows() == 1)){
            return true;
        }
    }

    public function student_documents($type = null, $id = null){
        $this->isloggedin() ? '' : $this->logout();
        $data = array(
            'title' => $title = $this->uri->segment(2),
            'subtitle' => $type
        );
        $data['page_view'] = "";

        switch($type){
            case 'view':
                $data['row'] = $this->db->select()->from('student_documents')->where('aut_id', $id)->get()->row_array();
                $this->add_logs($this->session->id, 'Student Docs: view', 'Student Documents ' . $id, ' has viewed ');
                $data['page_view'] .= $this->load->view('school/view/view_student_docs', $data, true);
                $this->load->view('main_page_new', $data);
                break;
            case 'new':
                $this->form_validation
                    ->set_rules('national_id_no', 'National ID N0', 'trim|required')
                    ->set_rules('userfile', 'National ID DOCUMENT', 'trim')
                    ->set_rules('userfile1', 'BIRTH CERTIFICATE DOCUMENT', 'trim')
                    ->set_rules('userfile2', 'HIGH SCHOOL CERTIFICATE DOCUMENT', 'trim');

                $this->db->select('student_id');
                $this->db->where('aut_id',$id);
                $stud_id = $this->db->get('students')->result_array();

                if ($this->form_validation->run() == true){  
                    $total_rows =  $this->db->count_all('student_documents');
                    $this->db->select_max('aut_id');
                    $query = $this->db->get('student_documents')->row();
                    $auto_id;
                    if($total_rows < 1){
                        $auto_id = 1;
                    }else{
                        $auto_id = $query->aut_id + 1;
                    }
                    $values = array(
                        'aut_id' => $auto_id,
                        'student_id' => $stud_id[0]['student_id'],
                        'national_id_no' => $this->input->post('national_id_no'),
                        'birth_certificate_no' => $this->input->post('birth_cert_no'),
                        'high_school_cert_no' => $this->input->post('high_school_cert_no'),
                    );

                    $path = $config['upload_path'] = 'uploads/student_docs/';
                    $config['max_size'] = '2000';
                    if (!is_dir($path)) //create the folder if it's not already exists
                    {
                        mkdir($path, 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('userfile')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['national_id_doc_name'] = $path . $file_name;
                    }

                    if ($this->upload->do_upload('userfile1')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['high_school_cert_doc_name'] = $path . $file_name;
                    }

                    if ($this->upload->do_upload('userfile2')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['birth_certificate_doc_name'] = $path . $file_name;
                    }

                if($this->check_student_id_docs_exist($stud_id[0]['student_id'])){
                    $alert_message = 'Failed to add Student Documents, 
                    Either Student is Existing Already Or Wrong Information Inserted!!!!';
                    $alert_type = 'danger';
                    $data['message'] = $alert_message;
                    $data['alert'] = $alert_type;
                    $alert_page = $this->load->view('alert', $data, true);
                    $data['alert_page'] = $alert_page;
                    $data['row_stud_id'] = $stud_id[0]['student_id'];
                    
                    $data['title'] = 'Student Documents';
                    $data['subtitle'] = 'new';
                    $data['page_view'] = '';
                    $data['page_view'] .= $this->load->view('school/new/new_student_docs', $data, true);
                    $this->load->view('main_page_new', $data);
                }else if($this->db->insert('student_documents', $values)){
                    $alert_message = 'A new student Documents record has been added to the system';
                    $alert_type = 'success';
                    $data['message'] = $alert_message;
                    $data['alert'] = $alert_type;
                    $data['title'] = 'Student Documents';
                    $data['subtitle'] = 'list';
                    $alert = $this->load->view('alert', $data, true);
                    $this->add_logs($this->session->id, 'Student Document: added','student_documents', ' has been added');
                    $this->session->set_flashdata('alert', $alert);
                    redirect('app/student_documents/list');
                }else{
                    $alert_message = 'Student Document Record Not Added To The System';
                    $alert_type = 'danger';
                    $data['message'] = $alert_message;
                    $data['alert'] = $alert_type;
                    $alert_page = $this->load->view('alert', $data, true);
                    $data['alert_page'] = $alert_page;
                    
                    $data['row_stud_id'] = $stud_id[0]['student_id'];
                    $data['page_view'] .= $this->load->view('school/new/new_student_docs', $data, true);
                    $this->load->view('main_page_new', $data);
                    }
                }else{
                    $values = array(
                        'national_id_no' => $this->input->post('national_id_no'),
                        'national_id_pages' => $this->input->post('national_id_pages'),
                        'national_id_office' => $this->input->post('national_id_office'),
                        'resident_card_no' => $this->input->post('resident_card_no'),
                        'resident_card_office' => $this->input->post('resident_card_office'),
                        'ration_card_no' => $this->input->post('ration_card_no'),
                        'ration_card_office' => $this->input->post('ration_card_office'),
                        'certificate_nationality_no' => $this->input->post('certificate_nationality_no'),
                        'certificate_nationality_date' => $this->input->post('certificate_nationality_date')
                    );
                    $data['row_stud_id'] = $stud_id[0]['student_id'];  
                    $data['page_view'] .= $this->load->view('school/new/new_student_docs', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'update':
                $data['row'] = $this->db->select()->from('student_documents')->where('aut_id', $id)->get()->row_array();
                $this->form_validation
                    ->set_rules('national_id_no', 'National ID N0', 'trim|required')
                    ->set_rules('userfile', 'National ID DOCUMENT', 'trim')
                    ->set_rules('userfile1', 'BIRTH CERTIFICATE DOCUMENT', 'trim')
                    ->set_rules('userfile2', 'HIGH SCHOOL CERTIFICATE DOCUMENT', 'trim');

                if ($this->form_validation->run() == true){  
                    $values = array(
                        'national_id_no' => $this->input->post('national_id_no'),
                        'birth_certificate_no' => $this->input->post('birth_cert_no'),
                        'high_school_cert_no' => $this->input->post('high_school_cert_no'),
                    );

                    $path = $config['upload_path'] = 'uploads/student_docs/';
                    $config['max_size'] = '2000';
                    if (!is_dir($path)) //create the folder if it's not already exists
                    {
                        mkdir($path, 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('userfile')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['national_id_doc_name'] = $path . $file_name;
                    }
                    if ($this->upload->do_upload('userfile1')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['high_school_cert_doc_name'] = $path . $file_name;
                    }
                    if ($this->upload->do_upload('userfile2')){
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['birth_certificate_doc_name'] = $path . $file_name;
                    }

                    $this->db->where('aut_id', $id);
                    if($this->db->update('student_documents', $values)){
                        $alert_message = 'Student Document'. $id.'has been updated';
                        $alert_type = 'success';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;

                        $alert = $this->load->view('alert', $data, true);
                        $this->add_logs($this->session->id, 'Student Document:'.$id.' updated','students',
                         ' has been updated');
                        $this->session->set_flashdata('alert', $alert);
                        redirect('app/student_documents/list');
                        }else{
                            $alert_message = 'Student Documents Not Updated';
                            $alert_type = 'danger';
                            $data['message'] = $alert_message;
                            $data['alert'] = $alert_type;
                            $alert_page = $this->load->view('alert', $data, true);
                            $data['alert_page'] = $alert_page;

                            $data['page_view'] .= $this->load->view('school/edit/update_student_docs', $data, true);
                            $this->load->view('main_page_new', $data);
                        }
                    }else{    
                        $data['page_view'] .= $this->load->view('school/edit/update_student_docs', $data, true);
                        $this->load->view('main_page_new', $data);
                    }
                break;
            case 'delete':
                if ($this->db->where('aut_id', $id)->delete('student_documents')) {
                    $alert_message = 'Student document has been deleted';
                    $alert_type = 'success';
                    $this->add_logs($this->session->id, 'Student Document: delete', 'student_documents ' . $id, ' has deleted ');
                } else {
                    $alert_message = 'Failed to delete student_document';
                    $alert_type = 'danger';
                }
                $data = array(
                    'message' => $alert_message,
                    'alert' => $alert_type
                );
                $alert = $this->load->view('alert', $data, true);
                $this->session->set_flashdata('alert', $alert);
                redirect('app/student_documents/list'); 
                break;
            default:
            $data['scripts'] = $this->load->view('ajax/student_docs', $data, true);
            $data['page_view'] .= $this->load->view('school/datatables_student_docs', $data, true);
            $this->add_logs($this->session->id, 'Student Docs: list', 'Student Docs', ' has listed ');
            $this->load->view('main_page', $data);
        }
    }

    public function check_student_id_docs_exist($student_id){
        //$this->db->select('student_id');
        $this->db->where('student_id',$student_id);
        $query_student_id = $this->db->get('student_documents');
        
        if(($query_student_id->num_rows() == 1)){
            return true;
        }
    }

    public function high_school_data($type = null, $id = null){
        $this->isloggedin() ? '' : $this->logout();
        $data = array(
            'title' => $title = $this->uri->segment(2),
            'subtitle' => $type
        );         

        $data['page_view'] = "";

        $data_row = null;
        switch($type){
            case 'view':
                $data['row'] = $this->db->select()->from('high_school_data')->where('aut_id', $id)->get()->row_array();
                $this->add_logs($this->session->id, 'High School Data: view', 'high school data ' . $id, ' has viewed ');
                $data['page_view'] .= $this->load->view('school/view/view_high_school_data', $data, true);
                $this->load->view('main_page_new', $data);
                break;
            case 'new':
                $this->form_validation
                    ->set_rules('biology_degree', 'Biology Degree', 'required')
                    ->set_rules('physics_degree', 'Physics Degree', 'required')
                    ->set_rules('math_degree', 'Math Degree', 'required')
                    ->set_rules('english_degree', 'English Degree', 'required')
                    ->set_rules('chemistry_degree', 'Chemistry Degree', 'required')
                    ->set_rules('total', 'Total', 'required')
                    ->set_rules('certificate_no', 'Certificate No', 'trim|required');

                $this->db->select('student_id');
                $this->db->where('aut_id',$id);
                $stud_id = $this->db->get('students')->result_array();
    
                if ($this->form_validation->run() == true){  
                    $total_rows =  $this->db->count_all('high_school_data');
                    $this->db->select_max('aut_id');
                    $query = $this->db->get('high_school_data')->row();
                    $auto_id;
                    if($total_rows < 1){
                        $auto_id = 1;
                    }else{
                        $auto_id = $query->aut_id + 1;
                    }                   
                $values = array(
                    'aut_id' => $auto_id,
                    'student_id' => $stud_id[0]['student_id'],
                    'school_name' => $this->input->post('school_name'),
                    'biology_degree' => $this->input->post('biology_degree'),
                    'physics_degree' => $this->input->post('physics_degree'),
                    'math_degree' => $this->input->post('math_degree'),
                    'english_degree' => $this->input->post('english_degree'),
                    'chemistry_degree' => $this->input->post('chemistry_degree'),
                    'total' => $this->input->post('total'),
                    'certificate_no' => $this->input->post('certificate_no'),
                    );
                
                    if($this->check_student_id_high_school_exist($stud_id[0]['student_id'])){
                        $alert_message = 'Failed to add Student High School Data Record, 
                        Either It is Existing Already Or Wrong Information Submitted!!!!';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;    
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;

                        $data['title'] = 'High School Data';
                        $data['subtitle'] = 'new';
                        $data['page_view'] = '';    
                        $data['row_stud_id'] = $stud_id[0]['student_id'];
                        $data['page_view'] .= $this->load->view('school/new/new_high_school_data', $data, true);
                        $this->load->view('main_page_new', $data);
                    }else if($this->db->insert('high_school_data', $values)){
                        $alert_message = 'A new Student High School Data record has been added to the system';
                        $alert_type = 'success';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert = $this->load->view('alert', $data, true);
                        $this->add_logs($this->session->id, ' Student High School Data: added','high_school_data', ' has been added');
                        $this->session->set_flashdata('alert', $alert);
                        redirect('app/high_school_data/list');
                    }else{
                        $alert_message = 'Student High School Data Record Not Added To The System';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;
                        
                        $data['row_stud_id'] = $stud_id[0]['student_id'];
                        $data['page_view'] .= $this->load->view('school/new/new_high_school_data', $data, true);
                        $this->load->view('main_page_new', $data);
                        }
                    }else{
                        $data['row_stud_id'] = $stud_id[0]['student_id'];  
                        $data['page_view'] .= $this->load->view('school/new/new_high_school_data', $data, true);
                        $this->load->view('main_page_new', $data);
                    }
                break;
            case 'update':
                $data['row'] = $this->db->select()->from('high_school_data')->where('aut_id', $id)->get()->row_array();
                $this->form_validation
                    ->set_rules('biology_degree', 'Biology Degree', 'required')
                    ->set_rules('physics_degree', 'Physics Degree', 'required')
                    ->set_rules('math_degree', 'Math Degree', 'required')
                    ->set_rules('english_degree', 'English Degree', 'required')
                    ->set_rules('chemistry_degree', 'Chemistry Degree', 'required')
                    ->set_rules('total', 'Total', 'required')
                    ->set_rules('certificate_no', 'Certificate No', 'trim|required');

                if ($this->form_validation->run() == true)
                {                   
                    $values = array(
                        'school_name' => $this->input->post('school_name'),
                        'biology_degree' => $this->input->post('biology_degree'),
                        'physics_degree' => $this->input->post('physics_degree'),
                        'math_degree' => $this->input->post('math_degree'),
                        'english_degree' => $this->input->post('english_degree'),
                        'chemistry_degree' => $this->input->post('chemistry_degree'),
                        'total' => $this->input->post('total'),
                        'certificate_no' => $this->input->post('certificate_no'),
                        );

                    $this->db->where('aut_id', $id);
                    if($this->db->update('high_school_data', $values)){
                        $alert_message = 'High School Data record :'. $id.'has been updated';
                        $alert_type = 'success';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;

                        $alert = $this->load->view('alert', $data, true);
                        $this->add_logs($this->session->id, 'High School Data record:'.$id.' updated','high_school_data', ' has been updated');
                        $this->session->set_flashdata('alert', $alert);
                        redirect('app/high_school_data/list');
                    }else{
                        $alert_message = 'High School Data Record Not Updated';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;

                        $data['page_view'] .= $this->load->view('school/edit/update_high_school_data', $data, true);
                        $this->load->view('main_page_new', $data);
                    }
                }else
                {    
                    $data['page_view'] .= $this->load->view('school/edit/update_high_school_data', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'delete':
                if ($this->db->where('aut_id', $id)->delete('high_school_data')) {
                    $alert_message = 'High school data has been deleted';
                    $alert_type = 'success';
                    $this->add_logs($this->session->id, 'High school data: delete',
                        'high_school_data ' . $id, ' has been deleted ');
                } else {
                    $alert_message = 'Failed to delete high school data';
                    $alert_type = 'danger';
                }
                $data = array(
                    'message' => $alert_message,
                    'alert' => $alert_type
                );
                $alert = $this->load->view('alert', $data, true);
                $this->session->set_flashdata('alert', $alert);
                redirect('app/high_school_data/list');
                break;
            default:
                $data['scripts'] = $this->load->view('ajax/high_school_data', $data, true);
                $data['page_view'] .= $this->load->view('school/datatables_high_school_data', $data, true);
                $this->add_logs($this->session->id, 'High School Data: list', 'High School Data', ' has been listed ');
                $this->load->view('main_page', $data);
            }
    }

    public function check_student_id_high_school_exist($student_id){
        $this->db->where('student_id',$student_id);
        $query_student_id = $this->db->get('high_school_data');
        
        if(($query_student_id->num_rows() == 1)){
            return true;
        }

    }

    public function users($type = null, $id = null){
        $this->isloggedin() ? '' : $this->logout();
        $data = array(
            'title' => $title = $this->uri->segment(2),
            'subtitle' => $type
        );

        $data['page_view'] = "";

        switch($type){
            case 'view':
                $data['row'] = $this->db->select()->from('sysytem_users')->where('aut_id', $id)->get()->row_array();
                $this->add_logs($this->session->id, 'Users: view', 'User ' . $id, ' has viewed ');
                $data['page_view'] .= $this->load->view('school/view/view_users', $data, true);
                $this->load->view('main_page_new', $data);
                break;
            case 'new':
                $this->form_validation
                    ->set_rules('user_name', 'User Name', 'trim|required')
                    ->set_rules('email', 'Email', 'trim|required');
                
                $user_name = $this->input->post('user_name');    

                if ($this->form_validation->run() == true)
                {                    
                    $total_rows =  $this->db->count_all('sysytem_users');
                    $this->db->select_max('aut_id');
                    $query = $this->db->get('sysytem_users')->row();
                    $auto_id;
                    if($total_rows < 1){
                        $auto_id = 1;
                    }else{
                        $auto_id = $query->aut_id + 1;
                    }                       
                    $values = array(
                        'aut_id' => $auto_id,
                        'user_name' => $this->input->post('user_name'),    
                        'email' => $this->input->post('email'),
                        'password' => random_string('alnum', 12),
                        'status' => 1
                    );
                    $group = $this->input->post('group');

                    $values_group = array(
                        'sys_user' => $this->input->post('user_name'),
                        'sys_group' => $group[0]
                    );

                    $path = $config['upload_path'] = 'uploads/users/';
                    $config['max_size'] = '10000';
                    if (!is_dir($path)) //create the folder if it's not already exists
                    {
                        mkdir($path, 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
                    $this->upload->initialize($config);

                    //initialising variables for the files
                    if ( ! $this->upload->do_upload('userfile')){
                            $error = array('error' => $this->upload->display_errors());
                            echo "Npt Uploaded";
                            echo var_dump($error);
                        }
                    else{
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['profile_pic'] = $path . $file_name;
                    }

                    $data['title'] = "users";                   
                    $data['page_view'] = '';

                    if($this->check_user_exist($user_name)){
                        $alert_message = 'Failed to add User, Either User is Existing Already Or Wrong Information Inserted!!!!';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;

                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;
                        $data['subtitle'] = "new";
                        
                        $data['page_view'] .= $this->load->view('school/new/new_users', $data, true);
                        $this->load->view('main_page_new', $data);
                    }else{
                        if($this->db->insert('sysytem_users', $values)){
                            if($this->db->insert('sysytem_user_groups', $values_group)){
                                $alert_message = 'A new user has been added to the system';
                                $alert_type = 'success';
                                $data['message'] = $alert_message;
                                $data['alert'] = $alert_type;
                                $alert_page = $this->load->view('alert', $data, true);
                                $data['alert_page'] = $alert_page;
                            
                                
                                $alert = $this->load->view('alert',$data, true);
                                $this->session->set_flashdata('alert', $alert);
                                $this->add_logs($this->session->id, 'User: added','users', ' has been added');
                                redirect('app/users/list');
                            }
                        }else{
                            $alert_message = 'User Not Added To The System';
                            $alert_type = 'danger';
                            $data['message'] = $alert_message;
                            $data['alert'] = $alert_type;
                            $alert_page = $this->load->view('alert', $data, true);
                            $data['alert_page'] = $alert_page;

                            $data['page_view'] .= $this->load->view('school/new_update_users', $data, true);
                            $this->load->view('main_page_new', $data);
                        }
                    }
                }else{    
                    $data['page_view'] .= $this->load->view('school/new/new_users', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'update':
                $data['row'] = $this->db->select()->from('sysytem_users')->where('aut_id', $id)->get()->row_array();
                $this->form_validation
                    ->set_rules('user_name', 'User Name', 'trim|required')
                    ->set_rules('email', 'Email', 'trim|required')
                    ->set_rules('group', 'Role', 'trim|required')
                    ->set_rules('password', 'Password', 'trim|required')
                    ->set_rules('profile_pic', 'Profile Picture', 'trim');

                if ($this->form_validation->run() == true)
                {   
                    $values = array(
                        'user_name' => $this->input->post('user_name'),    
                        'email' => $this->input->post('email'),
                        'group' => $this->input->post('group'),
                        'password' => $this->input->post('password')
                    );

                    $path = $config['upload_path'] = 'uploads/users/';
                    $config['max_size'] = '2000';
                    if (!is_dir($path)) //create the folder if it's not already exists
                    {
                        mkdir($path, 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
                    $this->upload->initialize($config);

                    //initialising variables for the files
                    if ( ! $this->upload->do_upload('userfile')){
                            $error = array('error' => $this->upload->display_errors());
                        }
                    else{
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data();
                        $file_name = $upload_data['file_name'];
                        $values['profile_pic'] = $path . $file_name;
                    }

                    $this->db->where('aut_id', $id);
                    if($this->db->update('sysytem_users', $values)){
                        $alert_message = 'User :'. $id.'has been updated';
                        $alert_type = 'success';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;

                        $alert = $this->load->view('alert', $data, true);
                        $this->add_logs($this->session->id, 'User :'.$id.' updated','users', ' has been updated');
                        $this->session->set_flashdata('alert', $alert);
                        redirect('app/users/list');
                    }else{
                        $alert_message = 'User Not Updated';
                        $alert_type = 'danger';
                        $data['message'] = $alert_message;
                        $data['alert'] = $alert_type;
                        $alert_page = $this->load->view('alert', $data, true);
                        $data['alert_page'] = $alert_page;

                        $data['page_view'] .= $this->load->view('school/edit/update_users', $data, true);
                        $this->load->view('main_page_new', $data);
                    }
                }else
                {    
                    $data['page_view'] .= $this->load->view('school/edit/update_users', $data, true);
                    $this->load->view('main_page_new', $data);
                }
                break;
            case 'delete':
                if ($this->db->where('aut_id', $id)->delete('sysytem_users')) {
                    $alert_message = 'User has been deleted';
                    $alert_type = 'success';
                    $this->add_logs($this->session->id, 'User: delete',
                        'System Users ' . $id,
                        ' has deleted ');
                } else {
                    $alert_message = 'Failed to delete user';
                    $alert_type = 'danger';
                }
                $data = array(
                    'message' => $alert_message,
                    'alert' => $alert_type
                );
                $alert = $this->load->view('alert', $data, true);
                $this->session->set_flashdata('alert', $alert);
                redirect('app/users/list');
                break;
            default:
            $data['scripts'] = $this->load->view('ajax/users_try', $data, true);
            $data['page_view'] .= $this->load->view('school/datatables_users', $data, true);
            $this->add_logs($this->session->id, 'Users: list', 'System Users', ' has listed ');
            $this->load->view('main_page', $data);
        }
    }

    public function check_user_exist($user_name) {
        $this->db->select('user_name');
        $this->db->where('user_name',$user_name);
        $query_user_name = $this->db->get('sysytem_users');
        
        if(($query_user_name->num_rows() == 1)){
            return true;
        }
    }

    public function logs($type = null){
        $this->isloggedin() ? '' : $this->logout();
        $data = array(
            'title' => $title = $this->uri->segment(2),
            'subtitle' => $type
        );
        $data['page_view'] = "";

        switch($type){
            case 'delete':
                if ($this->db->where('aut_id', $id)->delete('sysytem_logs')) {
                    $alert_message = 'Log has been deleted';
                    $alert_type = 'success';
                    $this->add_logs($this->session->id, 'Log: delete', 'sysytem_logs ' . $id, ' has deleted ');
                } else {
                    $alert_message = 'Failed to delete log';
                    $alert_type = 'danger';
                }
                $data = array(
                    'message' => $alert_message,
                    'alert' => $alert_type
                );
                $alert = $this->load->view('alert', $data, true);
                $this->session->set_flashdata('alert', $alert);
                redirect('app/logs/list');
                break;
            default:
            $data['scripts'] = $this->load->view('ajax/logs', $data, true);
            $data['page_view'] .= $this->load->view('school/datatables_logs', $data, true);
            $this->add_logs($this->session->id, 'Logs: list', 'logs', ' has listed ');
        }
        $this->load->view('main_page', $data);
    }

    public function add_logs($user = null, $trans_type = null, $target = '', $desc = ''){
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

    public function student_profile($type = null){
        $this->isloggedin() ? '' : $this->logout();
        $data['title'] = "Student Profile";
        $data['subtitle'] = "View";
        $data['page_view'] = '';
        $data['row'] = $this->db->select()
            ->from('students')
            ->where('username', $_SESSION['username'])
            ->get()
            ->row_array();

        $this->add_logs($this->session->id, 'Students: view', 'student ' . $_SESSION['id'], ' has viewed ');
        $data['page_view'] .= $this->load->view('school/view/view_student_profile', $data, true);
        $this->load->view('main_page_stud_profile', $data);
    }
 
    public function student_profile_courses(){
        $this->isloggedin() ? '' : $this->logout();
        $data['title'] = "Courses";
        $data['subtitle'] = "list";
        $data['page_view'] = '';
        
        $data['scripts'] = $this->load->view('ajax/courses_stud_profile', $data, true);
        $data['page_view'] .= $this->load->view('school/datatables_courses_stud_profile', $data, true);
        $this->add_logs($this->session->id, 'Courses: list', 'Courses', ' has listed ');
        $this->load->view('main_page_stud_profile', $data);
    }

    public function student_profile_high_school_data($type = null){
        $this->isloggedin() ? '' : $this->logout();
        $data['title'] = "Student High School Data";
        $data['subtitle'] = "view";
        $data['page_view'] = '';
        $stud_id = $this->db->select('student_id')
            ->from('students')
            ->where('username', $_SESSION['username'])
            ->get()
            ->row_array();

        $data['row'] = $this->db->select()
            ->from('high_school_data')
            ->where('student_id', $stud_id['student_id'])
            ->get()
            ->row_array();
        
        $data['row_stud_id'] = $stud_id['student_id'];
        $data['page_view'] .= $this->load->view('stud_profile_high_school_data', $data, true);
        $this->add_logs($this->session->id, 'High School Data: view', 'high school data ' . $_SESSION['id'], ' has viewed ');
        $this->load->view('main_page_stud_profile', $data);
    }

    public function student_profile_student_documents($type = null){
        $this->isloggedin() ? '' : $this->logout();
        $data['title'] = "Student Documents";
        $data['subtitle'] = "view";
        $data['page_view'] = '';
        $stud_id = $this->db->select('student_id')
            ->from('students')
            ->where('username', $_SESSION['username'])
            ->get()
            ->row_array();
        

        $data['row'] = $this->db->select()->from('student_documents')->where('student_id', $stud_id['student_id'])->get()->row_array();
        //echo var_dump($data['row']);
        //echo var_dump($stud_id);
        $data['row_stud_id'] = $stud_id['student_id'];
        $data['page_view'] .= $this->load->view('stud_profile_student_documents', $data, true);
        $this->add_logs($this->session->id, 'Student Document: view', 'student_documents ' . $_SESSION['id'], ' has viewed ');
        $this->load->view('main_page_stud_profile', $data);
    }

    public function error()
    {
        $this->load->view('404');
    }

}