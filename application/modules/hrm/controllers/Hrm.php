<?php
defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Dynamic style php file
# Developed by :Isahaq
#------------------------------------

class Hrm extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('hrm_model', 'country_model', 'dashboard/States'));
    }


    public function bdtask_designation_list()
    {
        $data['title'] = display('manage_designation');
        $data['designation_list'] = $this->hrm_model->designation_list();
//        $data['module']           = "hrm";
//        $data['page']             = "hrm/designation_list";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/hrm/designation_list', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_designation_form($id = null)
    {
        $data['title'] = display('add_designation');
        #-------------------------------#
        $this->form_validation->set_rules('designation', display('designation'), 'required|max_length[200]');
        $this->form_validation->set_rules('details', display('details'), 'max_length[250]');
        #-------------------------------#
        $data['designation'] = (object)$postData = [
            'id' => $id,
            'designation' => $this->input->post('designation', true),
            'details' => $this->input->post('details', true),
        ];
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            #if empty $id then insert data
            if (empty($id)) {
                if ($this->hrm_model->create_designation($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect("hrm/hrm/bdtask_designation_list");
            } else {
                if ($this->hrm_model->update_designation($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect("hrm/hrm/bdtask_designation_list");
            }
        } else {
            if (!empty($id)) {
                $data['title'] = display('designation_update_form');
                $data['designation'] = $this->hrm_model->single_designation_data($id);
            }
            $data['module']           = "hrm";
            $data['page']             = "hrm/designation_form";
            echo Modules::run('template/layout', $data);
//            $content = $this->parser->parse('hrm/hrm/designation_form', $data, true);
//            $this->template_lib->full_admin_html_view($content);
        }
    }


    public function bdtask_deletedesignation($id = null)
    {
        if ($this->hrm_model->delete_designation($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }

        redirect("hrm/hrm/bdtask_designation_list");
    }

    public function get_country_cities()
    {
        $country_id = $this->input->post('country_id');
        $cities = $this->States->get_states_by_country($country_id);

        $data = '';
        foreach ($cities as $city) {
            // var_dump($city);
            $data .= '<option value="'.$city->id.'">' . $city->name . '</option>';
        }

        echo $data;
    }


    /*employee part start*/
    public function bdtask_employee_form($id = null)
    {
       
        $data['title'] = display('add_employee');
        $this->form_validation->set_rules('first_name', display('first_name'), 'required|max_length[100]');
        $this->form_validation->set_rules('last_name', display('last_name'), 'required|max_length[100]');
        $this->form_validation->set_rules('designation', display('designation'), 'required|max_length[100]');
        $this->form_validation->set_rules('phone', display('phone'), 'max_length[20]');
        $this->form_validation->set_rules('hrate', display('salary'), 'max_length[20]');
        $contactInfo = $this->input->post('contact_info');
        $this->load->library('fileupload');
        $img = $this->fileupload->do_upload(
            './my-assets/image/employee/',
            'image'

        );
        $old_image = $this->input->post('old_image');

        $is_website = $this->input->post('is_website', true);

        if ($is_website) {
            $c = $this->db->select('count(*) as cnt')->from('employee_history')->where('is_website', '1')->get()->row();

            if ($c->cnt > 0) {
                if (!empty($id)) {
                    $this->session->set_flashdata('exception', display('yone_emp'));
                    redirect("hrm/hrm/bdtask_employee_form/" . $id);
                }
            } else {
                $is_website = 1;
            }
        } else {
            $is_website = 0;
        }

        if (empty($id)) {
            $is_website = 0;
        }

        $data['employee'] = (object)$postData = [
            'id' => $this->input->post('id', true),
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'designation' => $this->input->post('designation', true),
            'phone' => $this->input->post('phone', true),
            'image' => (!empty($img) ? $img : $old_image),
            'rate_type' => $this->input->post('rate_type', true),
            'email' => $this->input->post('email', true),
            'hrate' => $this->input->post('hrate', true),
            'address_line_1' => $this->input->post('address_line_1', true),
            'address_line_2' => $this->input->post('address_line_2', true),
            'blood_group' => $this->input->post('blood_group', true),
            'country' => $this->input->post('country', true),
            'city' => $this->input->post('city', true),
            'zip' => $this->input->post('zip', true),
            'cities' => implode(',', $this->input->post('cities', true)),
            'is_website' => $is_website
        ];
        #-------------------------------#
        if ($this->form_validation->run()) {

            if (empty($id)) {
                
                $empId = $this->hrm_model->create_employee($postData);
                if ($empId) {
                    // $this->employee_contact_info->insert($empId, $contactInfo);
                    $this->session->set_flashdata('message', display('save_successfully'));
                    redirect("hrm/hrm/bdtask_employee_list");
                } else {
                    $this->session->set_flashdata('error_message', display('please_try_again'));
                    redirect("hrm/hrm/bdtask_employee_form/");
                }

            } else {
                if ($this->hrm_model->update_employee($postData)) {
                    $old_head = $this->input->post('id', true) . '-' . $this->input->post('old_first_name', true) . '' . $this->input->post('old_last_name', true);
                    $up_headname = $id . '-' . $data['first_name'] . '' . $data['last_name'];
                    $updatedby = $this->session->userdata('id');
                    $updateddate = date('Y-m-d H:i:s');
                    $coa_inf = array(
                        'HeadName' => $up_headname,
                        'UpdateBy' => $updatedby,
                        'UpdateDate' => $updateddate,
                    );
                    $this->db->where('HeadName', $old_head);
                    $this->db->update('acc_coa', $coa_inf);
                    // $this->employee_contact_info->update($this->input->post('id', true), $contactInfo);
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                    redirect("hrm/hrm/bdtask_employee_form/" . $id);
                }
                redirect("hrm/hrm/bdtask_employee_list");
            }


        } else {
            if (!empty($id)) {
                $data['employee'] = $this->hrm_model->single_employee_data($id);
                // $data['contact_info'] = $this->employee_contact_info->allInfos($id);
                $data['title'] = display('edit_employee');
            }
            $data['country_list'] = $this->country_model->country();
            $data['countries'] = $this->States->get_country_list();
            $data['states'] = $this->States->get_states_by_country($data['employee']->country);
            $data['desig'] = $this->hrm_model->designation_dropdown();
            $data['module'] = "hrm";
            $data['page'] = "hrm/employee_form";
            echo Modules::run('template/layout', $data);
//            $content = $this->parser->parse('hrm/hrm/employee_form', $data, true);
//            $this->template_lib->full_admin_html_view($content);
        }
    }


    public function bdtask_employee_list()
    {
        $data['title'] = display('manage_employee');
        $data['employee_list'] = $this->hrm_model->employee_list();
//        $data['module'] = "hrm";
//        $data['page'] = "hrm/employee_list";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/hrm/employee_list', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    public function bdtask_employee_profile($id)
    {

        $data['title'] = display('employee_profile');
        $data['row'] = $this->hrm_model->employee_details($id);
        // $data['contact_info'] = $this->employee_contact_info->allInfos($id);
//        $data['module'] = "hrm";
//        $data['page'] = "hrm/resumepdf";
//        echo modules::run('template/layout', $data);
        $content = $this->parser->parse('hrm/hrm/resumepdf', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function bdtask_delete_employee($id = null)
    {
        if ($this->hrm_model->delete_employee($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }

        redirect("hrm/hrm/bdtask_employee_list");
    }

}

