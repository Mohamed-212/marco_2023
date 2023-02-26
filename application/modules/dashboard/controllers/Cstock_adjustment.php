<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cstock_adjustment extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('dashboard/lstock_adjustment');
        $this->load->library('dashboard/session');
        $this->load->model('dashboard/Stores');
        $this->load->model('dashboard/stock_adjustment_model');
        $this->auth->check_user_auth();
    }
    public function stock_adjustment()
    {
        $this->permission->check_label('stock_adjustment')->create()->redirect();
        $content = $this->lstock_adjustment->stock_adjustment_form();
        $this->template_lib->full_admin_html_view($content);
    }
    public function product_search_by_store()
    {
        $store_id    = $this->input->post('store_id', TRUE);
        $product_name = $this->input->post('product_name', TRUE);
        $product_info = $this->Stores->product_search_item($store_id, $product_name);
        $json_product = [];
        foreach ($product_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id']);
        }
        echo json_encode($json_product);
    }

    public function check_stock($store_id = null, $product_id = null, $variant = null, $variant_color = null)
    {
        $this->db->select('stock_id,quantity');
        $this->db->from('purchase_stock_tbl');
        if (!empty($store_id)) {
            $this->db->where('store_id', $store_id);
        }
        if (!empty($product_id)) {
            $this->db->where('product_id', $product_id);
        }
        if (!empty($variant)) {
            $this->db->where('variant_id', $variant);
        }
        if (!empty($variant_color)) {
            $this->db->where('variant_color', $variant_color);
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_stock_adjustment()
    {
        $this->form_validation->set_rules('store_id', display('store_id'), 'required');
        if ($this->form_validation->run() == false) {
            $this->stock_adjustment();
        } else {
            // stock_adjustment_table info for insertion
            $store_id          = $this->input->post('store_id', TRUE);
            $date              = date('Y-m-d', strtotime($this->input->post('date', TRUE)));
            $adjustment_details = $this->input->post('adjustment_details', TRUE);
            $created_by        = $this->session->userdata('user_id');
            $data = array(
                'store_id'  => $store_id,
                'date'      => $date,
                'details'   => $adjustment_details,
                'adjustment_status' => 0,
                'created_by' => $created_by,
            );
            $this->db->insert('stock_adjustment_table', $data);
            // stock_adjustment_details table info for insertion
            $adjustment_id    = $this->db->insert_id();
            $product_id       = $this->input->post('product_id', TRUE);
            $variant_id       = $this->input->post('variant_id', TRUE);
            $color_variant    = $this->input->post('color_variant', TRUE);
            $adjustment_type  = $this->input->post('adjustment_type', TRUE);
            $previous_quantity = $this->input->post('previous_quantity', TRUE);
            $adjusted_quantity = $this->input->post('adjusted_quantity', TRUE);
            $adjustment_detail = [];
            $i = 1;
            foreach ($product_id as $product) {
                $adjustment_detail[] = array(
                    'adjustment_id'      => $adjustment_id,
                    'product_id'         => $product,
                    'variant_id'         => $variant_id[$i],
                    'color_variant'      => ((!empty($color_variant[$i])) ? $color_variant[$i] : ''),
                    'adjustment_quantity' => $adjusted_quantity[$i],
                    'previous_quantity'  => $previous_quantity[$i],
                    'adjustment_type'    => $adjustment_type[$i],
                );
                $i++;
            }
            $result = $this->db->insert_batch('stock_adjustment_details', $adjustment_detail);
            if ($result) {
                $this->session->set_userdata(array('message' => display('successfully_added')));
                redirect(base_url('dashboard/Cstock_adjustment/stock_adjustment'));
            }
            $this->session->set_userdata(array('error_message' => display('something_went_wrong')));
            redirect(base_url('dashboard/Cstock_adjustment/stock_adjustment'));
        }
    }
    public function update_status($adjustment_id)
    {
        $adjustment_status = $this->input->post('adjustment_status', TRUE);
        
        $stock_adjustment_info = $this->db->select('*')->from('stock_adjustment_table')->where('adjustment_id', $adjustment_id)->get()->row();
        if ($stock_adjustment_info->adjustment_status == 0) {
            if ($adjustment_status == 0) {
                $status_update = array(
                    'adjustment_status' => $adjustment_status
                );
                $this->db->where('adjustment_id', $adjustment_id);
                $update = $this->db->update('stock_adjustment_table', $status_update);
                if ($update) {
                    $this->session->set_userdata(array('message' => display('adjustment_status_is_pending')));
                    redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                } else {
                    $this->session->set_userdata(array('error_message' => display('something_went_wrong')));
                    redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                }
            } elseif ($adjustment_status == 1) {
                $status_update = array(
                    'adjustment_status' => $adjustment_status
                );
                $this->db->where('adjustment_id', $adjustment_id);
                $update = $this->db->update('stock_adjustment_table', $status_update);
                if ($update) {
                    $stock_adjustment_details = $this->db->select('*')->from('stock_adjustment_details')->where('adjustment_id', $adjustment_id)->get()->result_array();
                    if (!empty($stock_adjustment_details)) {
                        foreach ($stock_adjustment_details as $product_wise_adjustment) {

                            if ($product_wise_adjustment['adjustment_type'] == 'increase') {
                                $quantity = $product_wise_adjustment['adjustment_quantity'];
                            } elseif ($product_wise_adjustment['adjustment_type'] == 'decrease') {
                                $quantity = -$product_wise_adjustment['adjustment_quantity'];
                            }
                            if (!empty($quantity)) {
                                $store_id = $stock_adjustment_info->store_id;
                                $transfer = array(
                                    'transfer_id'  => $this->auth->generator(15),
                                    'stock_adjustment_id' => $adjustment_id,
                                    'store_id'     => $store_id,
                                    'product_id'   => $product_wise_adjustment['product_id'],
                                    'variant_id'   => $product_wise_adjustment['variant_id'],
                                    'variant_color' => ((!empty($product_wise_adjustment['color_variant'])) ? $product_wise_adjustment['color_variant'] : ''),
                                    'date_time'    => $stock_adjustment_info->date,
                                    'quantity'     => $quantity,
                                    'status'       => 3
                                );
                                $this->db->insert('transfer', $transfer);
                                // stock 
                                $check_stock   = $this->check_stock($store_id, $product_wise_adjustment['product_id'], $product_wise_adjustment['variant_id'], $product_wise_adjustment['color_variant']);
                                if (empty($check_stock)) {
                                    // insert
                                    $stock = array(
                                        'store_id'     => $store_id,
                                        'product_id'   => $product_wise_adjustment['product_id'],
                                        'variant_id'   => $product_wise_adjustment['variant_id'],
                                        'variant_color' => ((!empty($product_wise_adjustment['color_variant'])) ? $product_wise_adjustment['color_variant'] : ''),
                                        'quantity'     => $quantity,
                                        'warehouse_id' => '',
                                    );
                                    $result = $this->db->insert('purchase_stock_tbl', $stock);
                                    if ($result) {
                                        $this->session->set_userdata(array('message' => display('stock_updated_successfully')));
                                        redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                                    } else {
                                        $this->session->set_userdata(array('error_message' => display('something_went_wrong')));
                                        redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                                    }

                                    // insert
                                } else {
                                    //update
                                    $stock = array(
                                        'quantity' => $check_stock->quantity + $quantity
                                    );
                                    if (!empty($store_id)) {
                                        $this->db->where('store_id', $store_id);
                                    }
                                    if (!empty($product)) {
                                        $this->db->where('product_id', $product_wise_adjustment['product_id']);
                                    }
                                    if (!empty($product_wise_adjustment['variant_id'])) {
                                        $this->db->where('variant_id', $product_wise_adjustment['variant_id']);
                                    }
                                    if (!empty($product_wise_adjustment['color_variant'])) {
                                        $this->db->where('variant_color', $product_wise_adjustment['color_variant']);
                                    }
                                    $result = $this->db->update('purchase_stock_tbl', $stock);
                                    if ($result) {
                                        $this->session->set_userdata(array('message' => display('stock_updated_successfully')));
                                        redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                                    } else {
                                        $this->session->set_userdata(array('error_message' => display('something_went_wrong')));
                                        redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                                    }
                                    //update
                                }
                                // stock
                            }
                        }
                    } else {
                        $this->session->set_userdata(array('error_message' => display('something_went_wrong')));
                        redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                    }
                } else {
                    $this->session->set_userdata(array('error_message' => display('something_went_wrong')));
                    redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                }
            } elseif ($adjustment_status == 2) {
                $status_update = array(
                    'adjustment_status' => $adjustment_status
                );
                $this->db->where('adjustment_id', $adjustment_id);
                $update = $this->db->update('stock_adjustment_table', $status_update);
                if ($update) {
                    $this->session->set_userdata(array('message' => display('stock_adjustment_cancelled')));
                    redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                } else {
                    $this->session->set_userdata(array('error_message' => display('something_went_wrong')));
                    redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
                }
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('status_already_changed')));
            redirect(base_url('dashboard/Cstock_adjustment/manage_stock_adjustment'));
        }
    }
    public function manage_stock_adjustment()
    {
        $this->permission->check_label('manage_stock_adjustment')->read()->redirect();

        $config["base_url"]   = base_url('dashboard/Cstock_adjustment/manage_stock_adjustment');
        $config["total_rows"] = $this->stock_adjustment_model->count_stock_adjustment_list();

        $config["per_page"]    = 20;
        $config["uri_segment"] = 4;
        $config["num_links"]   = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open']   = "<ul class='pagination'>";
        $config['full_tag_close']  = "</ul>";
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['cur_tag_open']    = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']   = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']   = "<li>";
        $config['next_tag_close']  = "</li>";
        $config['prev_tag_open']   = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open']  = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']   = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();

        $content = $this->lstock_adjustment->manage_stock_adjustment($page, $config["per_page"], $links);
        $this->template_lib->full_admin_html_view($content);
    }
    public function adjustment_details($adjustment_id)
    {
        $content = $this->lstock_adjustment->stock_adjustment_details($adjustment_id);
        $this->template_lib->full_admin_html_view($content);
    }
    public function adjustment_voucher($adjustment_id)
    {
        $content = $this->lstock_adjustment->stock_adjustment_html_data($adjustment_id);
        $this->template_lib->full_admin_html_view($content);
    }
}