<?php
defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Dynamic style php file
# Developed by :Isahaq
#------------------------------------

class Attendance extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('attendance_model'));
    }


    public function bdtask_add_attendance()
    {
        $data['title'] = display('add_attendance');
        $data['dropdownatn'] = $this->attendance_model->employee_dropdown();
        $data['att_list'] = $this->attendance_model->attendance_list();
//        $data['module'] = "hrm";
//        $data['page'] = "attendance/attendance_form";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/attendance/attendance_form', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_create_atten()
    {
        $this->form_validation->set_rules('employee_id', display('employee_id'), 'required|max_length[100]');
        $this->form_validation->set_rules('intime', 'sign_in', 'required|max_length[100]');
        $this->form_validation->set_rules('details', display('details'), 'max_length[250]');
        #-------------------------------#
        $date = $this->input->post('date', true);
        $intime = $this->input->post('intime', true);
        $sign_in = date('h:i a', strtotime($intime));
        $check_exist = $this->attendance_model->check_exist($this->input->post('employee_id', true), $date);

        if ($check_exist > 0) {
            $this->session->set_flashdata('exception', display('already_exist'));
            redirect("hrm/attendance/bdtask_add_attendance");
        }

        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $postData = [
                'employee_id' => $this->input->post('employee_id', true),
                'date' => $date,
                'sign_in' => $sign_in,
            ];

            if ($this->attendance_model->atten_create($postData)) {
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect("hrm/attendance/bdtask_add_attendance");
        }
        redirect("hrm/attendance/bdtask_add_attendance");

    }

    public function sign_out()
    {
        $this->form_validation->set_rules('sign_out', display('sign_out'), 'required|max_length[100]');
        if ($this->form_validation->run() === true) {
            $date = $this->input->post('sign_out');
            $sign_out = date('h:i a', strtotime($date));
            $s_out = $sign_out;
            $time = substr($s_out, 0, -2);
            $thelper = substr($s_out, -2, 2);
            $outtime = str_replace(' ', '', $time);
            $sign_out = $outtime . ' ' . $thelper;
            $sign_in = $this->input->post('sign_in', true);
            $in = new DateTime($sign_in);
            $Out = new DateTime($sign_out);
            $interval = $in->diff($Out);
            $stay = $interval->format('%H:%I');

            $postData = [
                'att_id' => $this->input->post('attendance_id'),
                'sign_out' => $sign_out,
                'staytime' => $stay
            ];

            if ($this->attendance_model->signout($postData)) {
                $data['status'] = true;
                $data['message'] = display('save_successfully');
            } else {
                $data['status'] = false;
                $data['exception'] = 'please try again';
            }

        } else {
            $data['status'] = false;
            $data['exception'] = validation_errors();
        }

        echo json_encode($data);
    }

    public function bdtask_edit_attendance($id = null)
    {

        $this->form_validation->set_rules('att_id', null, 'required|max_length[11]');
        $this->form_validation->set_rules('employee_id', display('employee_id'), 'required');
        $this->form_validation->set_rules('date', display('date'), 'required');
        $this->form_validation->set_rules('sign_in', display('sign_in'), 'required');
        $this->form_validation->set_rules('sign_out', display('sign_out'));
        $this->form_validation->set_rules('staytime', display('staytime'));
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            $sign_out = date("h:i a", strtotime($this->input->post('sign_out', true)));
            $sign_in = date("h:i a", strtotime($this->input->post('sign_in', true)));
            $in = new DateTime($sign_in);
            $Out = new DateTime($sign_out);
            $interval = $in->diff($Out);
            $stay = $interval->format('%H:%I');

            $postData = [
                'att_id' => $this->input->post('att_id', true),
                'employee_id' => $this->input->post('employee_id', true),
                'date' => $this->input->post('date', true),
                'sign_in' => $sign_in,
                'sign_out' => $sign_out,
                'staytime' => $stay,

            ];

            if ($this->attendance_model->signout($postData)) {
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("hrm/attendance/manage_attendance");

        } else {
            $data['data'] = $this->attendance_model->attn_updateForm($id);
            $data['dropdownatn'] = $this->attendance_model->employee_dropdown();
            $data['title'] = 'edit attendance';
//            $data['module'] = "hrm";
//            $data['page'] = "attendance/edit_attendance";
//            echo modules::run('template/layout', $data);
            $content = $this->parser->parse('hrm/attendance/edit_attendance', $data, true);
            $this->template_lib->full_admin_html_view($content);
        }

    }


    public function manage_attendance()
    {
        $data['title'] = display('manage_attendance');
        $config["base_url"] = base_url('attendance_list/');
        $config["total_rows"] = $this->attendance_model->attendance_list_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
        $config["num_links"] = 5;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['attendance_list'] = $this->attendance_model->manage_attendance($config["per_page"], $page);
//        $data['module'] = "hrm";
//        $data['page'] = "attendance/attendance_list";
//        echo Modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/attendance/attendance_list', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    function attendance_bulkupload()
    {
        $count = 0;
        $fp = fopen($_FILES['upload_csv_file']['tmp_name'], 'r') or die("can't open file");

        if (($handle = fopen($_FILES['upload_csv_file']['tmp_name'], 'r')) !== FALSE) {

            while ($csv_line = fgetcsv($fp, 1024)) {
                //keep this if condition if you want to remove the first row
                for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                    $insert_csv = array();
                    $insert_csv['employee_id'] = (!empty($csv_line[0]) ? $csv_line[0] : null);
                    $insert_csv['date'] = (!empty($csv_line[1]) ? $csv_line[1] : null);
                    $insert_csv['sign_in'] = (!empty($csv_line[2]) ? $csv_line[2] : null);
                    $insert_csv['sign_out'] = (!empty($csv_line[3]) ? $csv_line[3] : null);
                    $insert_csv['staytime'] = (!empty($csv_line[4]) ? $csv_line[4] : null);
                }
                $date = date("Y-m-d", strtotime($insert_csv['date']));
                $sign_out = date("h:i:s a", strtotime($insert_csv['sign_out']));
                $sign_in = date("h:i:s a", strtotime($insert_csv['sign_in']));
                $in = new DateTime($sign_in);
                $Out = new DateTime($sign_out);
                $interval = $in->diff($Out);
                $stay = $interval->format('%H:%I:%S');
                $attendancedata = array(
                    'employee_id' => $insert_csv['employee_id'],
                    'date' => $date,
                    'sign_in' => $sign_in,
                    'sign_out' => $sign_out,
                    'staytime' => $stay,
                );


                if ($count > 0) {
                    $this->db->insert('attendance', $attendancedata);
                }
                $count++;
            }

        }
        $this->session->set_userdata(array('message' => display('successfully_added')));
        redirect(base_url('Cattendance/manage_attendance'));

    }


    public function bdtask_delete_attendance($id = null)
    {
        if ($this->attendance_model->delete_attendance($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }

        redirect("hrm/attendance/manage_attendance");
    }

    // attendance report
    public function bdtask_attendance_report()
    {
        $data['title'] = display('attendance_report');
        $data['attendance_list'] = $this->attendance_model->attendance_list();
        $data['dropdownatn'] = $this->attendance_model->employee_dropdown();
//        $data['module'] = "hrm";
//        $data['page'] = "attendance/attendance_report";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/attendance/attendance_report', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_datewiseattendancereport()
    {
        $data['title'] = display('attendance_report');
        $format_start_date = $this->input->post('start_date', true);
        $format_end_date = $this->input->post('end_date', true);
        $data['from_date'] = $format_start_date;
        $data['to_date'] = $format_end_date;
        $data['query'] = $this->attendance_model->datewiseReport($format_start_date, $format_end_date);
//        $data['module'] = "hrm";
//        $data['page'] = "attendance/user_views_report";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/attendance/user_views_report', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    //userwise attendance report
    public function employeewise_att_report()
    {
        $data['title'] = display('attendance_report');
        $id = $this->input->post('employee_id', true);
        $start_date = $this->input->post('s_date', true);
        $end_date = $this->input->post('e_date', true);
        $data['employee_id'] = $id;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['ab'] = $this->attendance_model->emp_information($id);
        $data['query'] = $this->attendance_model->search($id, $start_date, $end_date);
//        $data['module'] = "hrm";
//        $data['page'] = "attendance/att_reportview";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/attendance/att_reportview', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

}

