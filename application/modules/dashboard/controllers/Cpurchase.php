<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpurchase extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array(
            'dashboard/Suppliers',
            'dashboard/Purchases',
            'dashboard/Stores',
            'dashboard/Variants',
            'dashboard/Soft_settings',
            'template/Template_model',
        ));
        $this->load->library('dashboard/occational');
    }

    //Default index function loading
    public function index() {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $this->permission->check_label('add_purchase')->create()->redirect();
                $all_supplier = $this->Purchases->select_all_supplier();
                $all_currency = $this->Purchases->select_all_currency();
                $get_def_currency = $this->Purchases->get_def_currency();
                $store_list = $this->Stores->store_list();
                $get_def_store = $this->Stores->get_def_store();
                $variant_list = $this->Variants->variant_list();
                $bank_list = $this->db->select('bank_id,bank_name')->from('bank_list')->get()->result();
                $batch_no = $this->generator(7);
                $data = array(
                    'title' => display('add_purchase'),
                    'all_supplier' => $all_supplier,
                    'all_currency' => $all_currency,
                    'store_list' => $store_list,
                    'def_store' => $get_def_store,
                    'def_currency' => $get_def_currency,
                    'variant_list' => $variant_list,
                    'batch_no' => $batch_no,
                    'bank_list' => $bank_list
                );
                $data['setting'] = $this->Template_model->setting();
                $data['module'] = "dashboard";
                $data['page'] = 'purchase/add_purchase_form';
                $this->parser->parse('template/layout', $data);
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            $this->permission->check_label('add_purchase')->create()->redirect();
            $all_supplier = $this->Purchases->select_all_supplier();
            $store_list = $this->Stores->store_list();
            $get_def_store = $this->Stores->get_def_store();
            $variant_list = $this->Variants->variant_list();
            $batch_no = $this->generator(7);
            $data = array(
                'title' => display('add_purchase'),
                'all_supplier' => $all_supplier,
                'store_list' => $store_list,
                'def_store' => $get_def_store,
                'variant_list' => $variant_list,
                'batch_no' => $batch_no,
            );
            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page'] = 'purchase/add_purchase_form';
            $this->parser->parse('template/layout', $data);
        }
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $number = array("6", "2", "9", "4", "5", "1", "8", "7", "3", "0");
        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 8);
            $rand_number = $number["$rand_value"];
            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

    //Purchase Add Form
    public function manage_purchase() {
        $this->permission->check_label('manage_purchase')->read()->redirect();

        $purchases_list = $this->Purchases->purchase_list();
        if (!empty($purchases_list)) {
            $j = 0;
            foreach ($purchases_list as $k => $v) {
                $purchases_list[$k]['final_date'] = $this->occational->dateConvert($purchases_list[$j]['purchase_date']);
                $j++;
            }

            $i = 0;
            foreach ($purchases_list as $k => $v) {
                $i++;
                $purchases_list[$k]['sl'] = $i;
            }
        }
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('manage_purchase'),
            'purchases_list' => $purchases_list,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase';
        $this->parser->parse('template/layout', $data);
    }

    //Insert Purchase and uload
    public function insert_purchase() {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $this->permission->check_label('add_purchase')->create()->redirect();
                $this->Purchases->purchase_entry();
                $this->session->set_userdata(array('message' => display('successfully_added')));
                if (isset($_POST['add-purchase'])) {
                    redirect(base_url('dashboard/Cpurchase/manage_purchase'));
                } elseif (isset($_POST['add-purchase-another'])) {
                    redirect(base_url('dashboard/Cpurchase'));
                }
            }
        } else {
            $this->permission->check_label('add_purchase')->create()->redirect();
            $this->Purchases->purchase_entry();
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-purchase'])) {
                redirect(base_url('dashboard/Cpurchase/manage_purchase'));
            } elseif (isset($_POST['add-purchase-another'])) {
                redirect(base_url('dashboard/Cpurchase'));
            }
        }
    }

    //Purchase Update Form
    public function purchase_update_form($purchase_id) {
        $this->permission->check_label('manage_purchase')->update()->redirect();
        $purchase_detail = $this->Purchases->retrieve_purchase_editdata($purchase_id);
        $supplier_id = $purchase_detail[0]['supplier_id'];
        $supplier_list = $this->Suppliers->supplier_list();
        $supplier_selected = $this->Suppliers->supplier_search_item($supplier_id);
        $this->load->model('Wearhouses');
        $wearhouse_list = $this->Wearhouses->wearhouse_list();
        $store_list = $this->Stores->store_list();
        $variant_list = $this->Variants->variant_list();
        $bank_list = $this->db->select('bank_id,bank_name')->from('bank_list')->get()->result();
        $batch_no = $this->generator(7);
        if (!empty($purchase_detail)) {
            $i = 0;
            foreach ($purchase_detail as $k => $v) {
                $i++;
                $purchase_detail[$k]['sl'] = $i;
            }
        }

        $proof_of_purchase_expese = $this->db->select('*')->from('proof_of_purchase_expese')->where('purchase_id', $purchase_id)->get()->result_array();
        $total_purchase_expense = $this->Purchases->total_purchase_expense($purchase_id);
        $data = array(
            'title' => display('purchase_edit'),
            'purchase_id' => $purchase_detail[0]['purchase_id'],
            'invoice_no' => $purchase_detail[0]['invoice_no'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'supplier_id' => $purchase_detail[0]['supplier_id'],
            'grand_total' => $purchase_detail[0]['grand_total_amount'],
            'purchase_details' => $purchase_detail[0]['purchase_details'],
            'purchase_date' => $purchase_detail[0]['purchase_date'],
            'store_id' => $purchase_detail[0]['store_id'],
            'wearhouse_id' => $purchase_detail[0]['wearhouse_id'],
            'variant_id' => $purchase_detail[0]['variant_id'],
            'purchase_info' => $purchase_detail,
            'supplier_list' => $supplier_list,
            'supplier_selected' => $supplier_selected,
            'wearhouse_list' => $wearhouse_list,
            'store_list' => $store_list,
            'variant_list' => $variant_list,
            'proof_of_purchase_expese' => $proof_of_purchase_expese,
            'total_purchase_expense' => $total_purchase_expense,
            'batch_no' => $batch_no,
            'bank_list' => $bank_list
        );
        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/edit_purchase_form';
        $this->parser->parse('template/layout', $data);
    }

    //Purchase Update
    public function purchase_update() {
        $this->permission->check_label('manage_purchase')->update()->redirect();
        $this->Purchases->update_purchase();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('dashboard/Cpurchase/manage_purchase'));
    }

    // Purchase delete
    public function purchase_delete($purchase_id) {
        $this->permission->check_label('manage_purchase')->delete()->redirect();
        $this->Purchases->delete_purchase($purchase_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        redirect('dashboard/Cpurchase/manage_purchase');
    }

    //Purchase item by search
    public function purchase_item_by_search() {
        $supplier_id = $this->input->post('supplier_id', TRUE);
        $purchases_list = $this->Purchases->purchase_by_search($supplier_id);
        $j = 0;
        if (!empty($purchases_list)) {
            foreach ($purchases_list as $k => $v) {
                $purchases_list[$k]['final_date'] = $this->occational->dateConvert($purchases_list[$j]['purchase_date']);
                $j++;
            }
            $i = 0;
            foreach ($purchases_list as $k => $v) {
                $i++;
                $purchases_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'purchases_list' => $purchases_list
        );
        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase';
        $this->parser->parse('template/layout', $data);
    }

    //purchase search by model
    public function product_search_by_model(){
        $model = $this->input->post('term', TRUE);
        $query = $this->db->query("SELECT * FROM `product_information` WHERE `assembly` = '0' AND (`product_model` LIKE '%" . $model . "%')");
        $product_info = $query->result_array();
        $json_product = [];
        foreach ($product_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id']);
        }
        echo json_encode($json_product);
    }

    //Purchase search by supplier id
    public function product_search_by_supplier() {
        $supplier_id = $this->input->post('supplier_id', TRUE);
        $product_name = $this->input->post('product_name', TRUE);
        $product_info = $this->Suppliers->product_search_item($supplier_id, $product_name);
        $json_product = [];
        foreach ($product_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $size = strpos($value['variants'], ',') > -1 ? (explode(',', $value['variants']))[0] : $value['variants'];
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id'], 'variant_id' => $size);
        }
        echo json_encode($json_product);
    }

    // Retrieve Purchase Data
    public function retrieve_product_data() {
        $product_id = $this->input->post('product_id', TRUE);
        $store_id = $this->input->post('store_id', TRUE);

        $product_info = $this->Purchases->get_total_product($product_id, $store_id);
        echo json_encode($product_info);
    }

    public function get_conversion_rate() {
        $currency_id = $this->input->post('currency_id', TRUE);
        $conversion_rate = $this->Purchases->get_conversion_rate($currency_id);
        echo json_encode($conversion_rate);
    }

    //Retrive right now inserted data to cretae html
    public function purchase_details_data($purchase_id) {
        $purchase_detail = $this->Purchases->purchase_details_data($purchase_id);
        if (!empty($purchase_detail)) {
            $i = 0;
            foreach ($purchase_detail as $k => $v) {
                $i++;
                $purchase_detail[$k]['sl'] = $i;
            }
            foreach ($purchase_detail as $k => $v) {
                $purchase_detail[$k]['convert_date'] = $this->occational->dateConvert($purchase_detail[$k]['purchase_date']);
            }
        }
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Purchases->retrieve_company();
        $data = array(
            'title' => display('purchase_ledger'),
            'purchase_id' => $purchase_detail[0]['purchase_id'],
            'invoice' => $purchase_detail[0]['invoice'],
            'purchase_details' => $purchase_detail[0]['purchase_details'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'final_date' => $purchase_detail[0]['convert_date'],
            'sub_total_amount' => $purchase_detail[0]['grand_total_amount'],
            'invoice_no' => $purchase_detail[0]['invoice_no'],
            'purchase_all_data' => $purchase_detail,
            'total_purchase_dis' => $purchase_detail[0]['total_purchase_dis'],
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase_detail';
        $this->parser->parse('template/layout', $data);
    }

    // Get variant price and stock 
    public function check_admin_2d_variant_info() {
        $product_id = urldecode($this->input->post('product_id', TRUE));
        $store_id = urldecode($this->input->post('store_id', TRUE));
        $variant_id = urldecode($this->input->post('variant_id', TRUE));
        $variant_color = urldecode($this->input->post('variant_color', TRUE));
        if ($this->input->post('assembly', TRUE)==null) {
           $assembly = 0;
        } else {
             $assembly = urldecode($this->input->post('assembly', TRUE));
        }
        if ($assembly == 1) {
            $stock = $this->Purchases->check_variant_wise_stock2($product_id, $store_id, $variant_id, $variant_color);
        } else {
            $stock = $this->Purchases->check_variant_wise_stock($product_id, $store_id, $variant_id, $variant_color);
        }
        if ($stock > 0) {
            $result[0] = "yes";
            $price = $this->Purchases->check_variant_wise_price($product_id, $variant_id, $variant_color);
            $batch = $this->Purchases->check_batch_wise_product($product_id, $variant_id, $variant_color, $store_id);
            $result[1] = $stock; //stock
            $result[2] = floatval($price['price']); //price
            $result[3] = 0; //discount
            if (!empty($batch)) {
                $result[4] = $batch; //discount
            } else {
                $batch2 = $this->Purchases->check_batch_wise_transfer_product($product_id, $variant_id, $variant_color, $store_id);
                $result[4] = $batch2;
            }
        } else {
            $result[0] = 'no';
        }
        echo json_encode($result);
    }

    public function check_admin_batch_wise_stock_info() {
        $product_id = urldecode($this->input->post('product_id', TRUE));
        $store_id = urldecode($this->input->post('store_id', TRUE));
        $variant_id = urldecode($this->input->post('variant_id', TRUE));
        $variant_color = urldecode($this->input->post('variant_color', TRUE));
        $batch_no = urldecode($this->input->post('batch_no', TRUE));
        $stock = $this->Purchases->check_batch_no_wise_stock($product_id, $store_id, $variant_id, $variant_color, $batch_no);
        if ($stock > 0) {
            $result[0] = "yes";
            $result[1] = $stock; //stock
        } else {
            $result[0] = 'no';
        }
        echo json_encode($result);
    }

    //// for pricing //////

    public function check_product_price() {
        $product_id = urldecode($this->input->post('product_id', TRUE));
        $pricing_id = urldecode($this->input->post('pricing_id', TRUE));
        $price = $this->Purchases->check_product_price($product_id, $pricing_id);
        $result[1] = floatval($price['price']); //price
        echo json_encode($result);
    }

    public function check_pos_batch_wise_stock_info() {
        $product_id = urldecode($this->input->post('product_id', TRUE));
        $store_id = urldecode($this->input->post('store_id', TRUE));
        $batch_no = urldecode($this->input->post('batch_no', TRUE));
        $stock = $this->Purchases->check_pos_batch_no_wise_stock($product_id, $store_id, $batch_no);
        if ($stock > 0) {
            $result[0] = "yes";
            $result[1] = $stock; //stock
        } else {
            $result[0] = 'no';
        }
        echo json_encode($result);
    }

    //Stock in available
    public function available_stock() {
        $product_id = $this->input->post('product_id', TRUE);
        $store_id = $this->input->post('store_id', TRUE);
        $variant_id = $this->input->post('variant_id', TRUE);
        $variant_color = $this->input->post('variant_color', TRUE);

        $this->db->select('SUM(a.quantity) as total_purchase');
        $this->db->from('transfer a');
        $this->db->where('a.product_id', $product_id);
        $this->db->where('a.store_id', $store_id);
        $this->db->where('a.variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('a.variant_color', $variant_color);
        }
        $total_purchase = $this->db->get()->row();

        $this->db->select('b.quantity');
        $this->db->from('invoice_stock_tbl b');
        $this->db->where('b.product_id', $product_id);
        $this->db->where('b.store_id', $store_id);
        $this->db->where('b.variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('b.variant_color', $variant_color);
        }
        $total_sale = $this->db->get()->row();

        echo $total_purchase->quantity - $total_sale->total_sale;
    }

    //check stock product quantity
    public function check_product_stock() {

        $product_id = $this->input->post('product_id', TRUE);
        $variant_id = $this->input->post('variant_id', TRUE);
        $store_id = $this->input->post('store_id', TRUE);
        $variant_color = $this->input->post('variant_color', TRUE);

        $this->db->select('SUM(a.quantity) as total_purchase');
        $this->db->from('transfer a');
        $this->db->where('a.product_id', $product_id);
        $this->db->where('a.variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('a.variant_color', $variant_color);
        }
        $this->db->where('a.store_id', $store_id);
        $total_purchase = $this->db->get()->row();

        $this->db->select('SUM(b.quantity) as total_sale');
        $this->db->from('invoice_details b');
        $this->db->where('b.product_id', $product_id);
        $this->db->where('b.variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('b.variant_color', $variant_color);
        }
        $this->db->where('b.store_id', $store_id);
        $total_sale = $this->db->get()->row();

        echo $total_purchase->total_purchase - $total_sale->total_sale;
    }

    //Wearhouse available stock check
    public function wearhouse_available_stock() {

        $product_id = $this->input->post('product_id', TRUE);
        $variant_id = $this->input->post('variant_id', TRUE);
        $variant_color = $this->input->post('variant_color', TRUE);
        $store_id = $this->input->post('store_id', TRUE);
        $purchase_to = $this->input->post('purchase_to', TRUE);

        $this->db->select('SUM(a.quantity) as total_purchase');
        $this->db->from('transfer a');
        $this->db->where('a.product_id', $product_id);
        $this->db->where('a.variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('a.variant_color', $variant_color);
        }
        $this->db->where('a.store_id', $store_id);
        $total_purchase = $this->db->get()->row();

        $this->db->select('SUM(b.quantity) as total_sale');
        $this->db->from('invoice_details b');
        $this->db->where('b.product_id', $product_id);
        $this->db->where('b.variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('b.variant_color', $variant_color);
        }
        $this->db->where('b.store_id', $store_id);
        $total_sale = $this->db->get()->row();

        // $product_information = $this->db->select('open_quantity')->from('product_information')->where('product_id', $product_id)->get()->row();

        // $stock = ($total_purchase->total_purchase + $product_information->open_quantity) - $total_sale->total_sale;
        $stock = $total_purchase->total_purchase - $total_sale->total_sale;


        if ($stock > 0) {
            $result[0] = "yes";
            $batch = $this->Purchases->check_batch_wise_product($product_id, $variant_id, $variant_color, $store_id);
            $result[1] = $stock; //stock
            $result[4] = $batch; //discount
        } else {
            $result[0] = 'no';
        }
        echo json_encode($result);
    }

    // check default store is or not
    public function check_default_store() {
        $store_id = $this->input->post('store_id', TRUE);
        $result = false;
        if (!empty($store_id)) {
            $this->db->where('store_id', $store_id);
            $this->db->where('default_status', 1);
            $query = $this->db->get('store_set');
            if ($query->num_rows() > 0) {
                $result = TRUE;
            }
        }
        echo $result;
    }

    // Add purchase form
    public function add_purchase_order() {
        $this->permission->check_label('create_purchase_order')->create()->redirect();

        $this->form_validation->set_rules('supplier_id', display('supplier'), 'trim|required');
        $this->form_validation->set_rules('currency_id', display('currency'), 'trim|required');
        $this->form_validation->set_rules('purchase_order', display('purchase_order'), 'trim|required');
        $this->form_validation->set_rules('store_id', display('purchase_to'), 'trim|required');

        $purchase_id = $this->Purchases->get_next_pur_order_id();

        if ($this->form_validation->run() == TRUE) {
            $result = $this->Purchases->purchase_order_entry($purchase_id);
            if ($result) {
                $this->session->set_userdata(array('message' => display('successfully_added')));
                if (isset($_POST['add-purchase'])) {
                    redirect(base_url('dashboard/Cpurchase/purchase_order'));
                }
            } else {
                $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            }
        }
        $all_supplier = $this->Purchases->select_all_supplier();
        $all_currency = $this->Purchases->select_all_currency();
        $get_def_currency = $this->Purchases->get_def_currency();
        $store_list = $this->Stores->store_list();
        $get_def_store = $this->Stores->get_def_store();
        $variant_list = $this->Variants->variant_list();
        $batch_no = $this->generator(7);
        $data = array(
            'title' => display('add_purchase_order'),
            'all_supplier' => $all_supplier,
            'all_currency' => $all_currency,
            'store_list' => $store_list,
            'def_store' => $get_def_store,
            'def_currency' => $get_def_currency,
            'variant_list' => $variant_list,
            'purchase_order_no' => "PO-" . $purchase_id,
            'batch_no' => $batch_no,
        );
        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase_order_add';
        $this->parser->parse('template/layout', $data);
    }

    //Purchase Order
    public function purchase_order() {
        $this->permission->check_label('purchase_order')->read()->redirect();

        $order_list = $this->Purchases->get_purchase_order_list();

        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('create_purchase_order'),
            'order_list' => $order_list,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase_order';
        $this->parser->parse('template/layout', $data);
    }

    // Add purchase form
    public function edit_purchase_order($pur_order_id) {
        $this->permission->check_label('purchase_order')->update()->redirect();

        $this->form_validation->set_rules('supplier_id', display('supplier'), 'trim|required');
        $this->form_validation->set_rules('purchase_order', display('purchase_order'), 'trim|required');
        $this->form_validation->set_rules('store_id', display('purchase_to'), 'trim|required');

        $purchase_detail = $this->Purchases->get_purchase_order_by_id($pur_order_id);

        if ($purchase_detail[0]['receive_status']) {
            redirect(base_url('dashboard/Cpurchase/purchase_order'));
            return;
        }

        if ($this->form_validation->run() == TRUE) {

            $result = $this->Purchases->purchase_order_update($pur_order_id);
            if ($result) {
                $this->session->set_userdata(array('message' => display('successfully_updated')));

                //     if (isset($_POST['add-purchase'])) {
                redirect(base_url('dashboard/Cpurchase/purchase_order'));
                //   }
            } else {
                $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            }
        }
        $all_supplier = $this->Suppliers->supplier_list();
        $store_list = $this->Stores->store_list();
        $data = array(
            'title' => display('edit_purchase_order'),
            'pur_order_id' => $pur_order_id,
            'pur_order_no' => $purchase_detail[0]['pur_order_no'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'supplier_id' => $purchase_detail[0]['supplier_id'],
            'grand_total' => $purchase_detail[0]['grand_total_amount'],
            'purchase_details' => $purchase_detail[0]['purchase_details'],
            'purchase_date' => $purchase_detail[0]['purchase_date'],
            'store_id' => $purchase_detail[0]['store_id'],
            'variant_id' => $purchase_detail[0]['variant_id'],
            'purchase_info' => $purchase_detail,
            'all_supplier' => $all_supplier,
            'store_list' => $store_list,
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase_order_edit';
        $this->parser->parse('template/layout', $data);
    }

    // Purchase order delete
    public function purchase_order_delete($purchase_order_id) {
        $this->permission->check_label('purchase_order')->delete()->redirect();
        $result = $this->Purchases->delete_purchase_order($purchase_order_id);
        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_delete')));
        } else {
            $this->session->set_userdata(array('error_message' => display('failed_try_again')));
        }
        redirect('dashboard/Cpurchase/purchase_order');
    }

    public function purchase_order_print($pur_order_id) {
        $purchase_detail = $this->Purchases->get_po_shortinfo_by_id($pur_order_id);

        $po_details = $this->Purchases->get_purchase_order_details($pur_order_id);
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Purchases->retrieve_company();
        $Soft_settings = $this->Soft_settings->retrieve_setting_editdata();
        $data = array(
            'title' => display('purchase_order'),
            'pur_order_id' => $pur_order_id,
            'pur_order_no' => $purchase_detail[0]['pur_order_no'],
            'supplier_id' => $purchase_detail[0]['supplier_id'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'supplier_mobile' => $purchase_detail[0]['mobile'],
            'supplier_vat_no' => $purchase_detail[0]['vat_no'],
            'supplier_cr_no' => $purchase_detail[0]['cr_no'],
            'total_amount' => $purchase_detail[0]['grand_total_amount'],
            'purchase_details' => $purchase_detail[0]['purchase_details'],
            'purchase_date' => $purchase_detail[0]['purchase_date'],
            'expire_date' => $purchase_detail[0]['expire_date'],
            'supply_date' => $purchase_detail[0]['supply_date'],
            'store_id' => $purchase_detail[0]['store_id'],
            'approve_status' => $purchase_detail[0]['approve_status'],
            'receive_status' => $purchase_detail[0]['receive_status'],
            'return_status' => $purchase_detail[0]['return_status'],
            'purchase_vat' => $purchase_detail[0]['purchase_vat'],
            'purchase_info' => $purchase_detail,
            'po_details' => $po_details,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'Soft_settings' => $Soft_settings,
            'total_purchase_dis' => $purchase_detail[0]['total_purchase_dis'],
        );


        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase_order_print';
        $this->parser->parse('template/layout', $data);
    }

    //Purchase Order
    public function receive_item() {
        $this->permission->check_label('receive_item')->read()->redirect();

        $order_list = $this->Purchases->get_purchase_order_list();

        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('manage_purchase_order_receive'),
            'order_list' => $order_list,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/pur_order_receive_list';
        $this->parser->parse('template/layout', $data);
    }

    // Manage Purchase order
    public function manage_purorder($param = 'view', $pur_order_id, $param2 = false) {
        $this->permission->check_label('purchase_order')->update()->redirect();

        if ($param == 'receive') {
            $this->form_validation->set_rules('purchase_order', display('purchase_order'), 'trim|required');
            $this->form_validation->set_rules('invoice_no', display('invoice_no'), 'trim|required');
            $this->form_validation->set_rules('batch_no[]', display('batch_no'), 'required');
            $purchase_detail = $this->Purchases->get_purchase_order_by_id($pur_order_id);
            if ($this->form_validation->run() == TRUE) {

                $result = $this->Purchases->purchase_order_receive($pur_order_id);
                if ($result) {
                    $this->session->set_userdata(array('message' => display('successfully_added')));
                    redirect(base_url('dashboard/Cpurchase/receive_item'));
                } else {
                    $this->session->set_userdata(array('error_message' => display('failed_try_again')));
                }
            }
            $all_supplier = $this->Suppliers->supplier_list();
            $all_currency = $this->Purchases->select_all_currency();
            $store_list = $this->Stores->store_list();
            $batch_no = $this->generator(7);
            $bank_list = $this->db->select('bank_id,bank_name')->from('bank_list')->get()->result();
            $data = array(
                'title' => display('receive_item'),
                'pur_order_id' => $pur_order_id,
                'pur_order_no' => $purchase_detail[0]['pur_order_no'],
                'invoice_no' => $purchase_detail[0]['invoice_no'],
                'supplier_name' => $purchase_detail[0]['supplier_name'],
                'supplier_id' => $purchase_detail[0]['supplier_id'],
                'grand_total' => $purchase_detail[0]['grand_total_amount'],
                'purchase_vat' => $purchase_detail[0]['purchase_vat'],
                'total_purchase_vat' => $purchase_detail[0]['total_purchase_vat'],
                'sub_total_price' => $purchase_detail[0]['sub_total_price'],
                'purchase_details' => $purchase_detail[0]['purchase_details'],
                'purchase_date' => $purchase_detail[0]['purchase_date'],
                'store_id' => $purchase_detail[0]['store_id'],
                'def_currency_id' => $purchase_detail[0]['def_currency_id'],
                'currency_id' => $purchase_detail[0]['currency_id'],
                'conversion_rate' => $purchase_detail[0]['conversion_rate'],
                'variant_id' => $purchase_detail[0]['variant_id'],
                'batch_no' => $batch_no,
                'purchase_info' => $purchase_detail,
                'all_supplier' => $all_supplier,
                'all_currency' => $all_currency,
                'store_list' => $store_list,
                'param2' => $param2,
                'bank_list' => $bank_list
            );
            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page'] = 'purchase/pur_order_receive';
            $this->parser->parse('template/layout', $data);
        } else if ($param == 'return') {

            $this->form_validation->set_rules('purchase_order', display('purchase_order'), 'trim|required');
            $this->form_validation->set_rules('invoice_no', display('invoice_no'), 'trim|required');

            $purchase_detail = $this->Purchases->get_po_shortinfo_by_id($pur_order_id);
            $po_details = $this->Purchases->get_purchase_order_details($pur_order_id);

            if ($this->form_validation->run() == TRUE) {

                $result = $this->Purchases->purchase_order_return($pur_order_id);
                if ($result) {
                    $this->session->set_userdata(array('message' => display('successfully_added')));
                    redirect(base_url('dashboard/Cpurchase/receive_item'));
                } else {
                    $this->session->set_userdata(array('error_message' => display('failed_try_again')));
                }
            }

            $all_supplier = $this->Suppliers->supplier_list();
            $store_list = $this->Stores->store_list();
            $currency_details = $this->Soft_settings->retrieve_currency_info();
            $purchase_id = $this->db->select('purchase_id')->from('product_purchase')->where('pur_order_no', $purchase_detail[0]['pur_order_no'])->get()->result();

            $proof_of_purchase_expese = $this->db->select('*')->from('proof_of_purchase_expese')->where('purchase_id', $purchase_id[0]->purchase_id)->get()->result_array();
            $total_purchase_expense = $this->Purchases->total_purchase_expense($purchase_id[0]->purchase_id);
            $bank_list = $this->db->select('bank_id,bank_name')->from('bank_list')->get()->result();
            $data = array(
                'title' => display('return_item'),
                'pur_order_id' => $pur_order_id,
                'pur_order_no' => $purchase_detail[0]['pur_order_no'],
                'invoice_no' => $purchase_detail[0]['invoice_no'],
                'supplier_id' => $purchase_detail[0]['supplier_id'],
                'grand_total' => $purchase_detail[0]['grand_total_amount'],
                'purchase_vat' => $purchase_detail[0]['purchase_vat'],
                'total_purchase_vat' => $purchase_detail[0]['total_purchase_vat'],
                'sub_total_price' => $purchase_detail[0]['sub_total_price'],
                'purchase_details' => $purchase_detail[0]['purchase_details'],
                'purchase_date' => $purchase_detail[0]['purchase_date'],
                'store_id' => $purchase_detail[0]['store_id'],
                'approve_status' => $purchase_detail[0]['approve_status'],
                'receive_status' => $purchase_detail[0]['receive_status'],
                'return_status' => $purchase_detail[0]['return_status'],
                'purchase_info' => $purchase_detail,
                'po_details' => $po_details,
                'all_supplier' => $all_supplier,
                'store_list' => $store_list,
                'currency' => $currency_details[0]['currency_icon'],
                'position' => $currency_details[0]['currency_position'],
                'proof_of_purchase_expese' => $proof_of_purchase_expese,
                'total_purchase_expense' => $total_purchase_expense,
                'bank_list' => $bank_list,
                'purchase_id' => $purchase_id
            );
            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page'] = 'purchase/pur_order_return';
            $this->parser->parse('template/layout', $data);
        } else if ($param == 'view2') {
            $purchase_detail = $this->Purchases->get_po_shortinfo_by_id($pur_order_id);
            $po_details = $this->Purchases->get_purchase_order_details($pur_order_id);
            $all_supplier = $this->Suppliers->supplier_list();
            $store_list = $this->Stores->store_list();
            $currency_details = $this->Soft_settings->retrieve_currency_info();
            $company_info = $this->Purchases->retrieve_company();
            $Soft_settings = $this->Soft_settings->retrieve_setting_editdata();

            $data = array(
                'title' => display('purchase_order'),
                'pur_order_id' => $pur_order_id,
                'pur_order_no' => $purchase_detail[0]['pur_order_no'],
                'supplier_id' => $purchase_detail[0]['supplier_id'],
                'total_amount' => $purchase_detail[0]['grand_total_amount'],
                'purchase_details' => $purchase_detail[0]['purchase_details'],
                'purchase_date' => $purchase_detail[0]['purchase_date'],
                'store_id' => $purchase_detail[0]['store_id'],
                'approve_status' => $purchase_detail[0]['approve_status'],
                'receive_status' => $purchase_detail[0]['receive_status'],
                'return_status' => $purchase_detail[0]['return_status'],
                'purchase_info' => $purchase_detail,
                'po_details' => $po_details,
                'all_supplier' => $all_supplier,
                'store_list' => $store_list,
                'company_info' => $company_info,
                'currency' => $currency_details[0]['currency_icon'],
                'position' => $currency_details[0]['currency_position'],
                'Soft_settings' => $Soft_settings,
                'total_purchase_dis' => $purchase_detail[0]['total_purchase_dis'],
                'total_purchase_dis_rc' => $purchase_detail[0]['total_purchase_dis_rc'],
                'total_purchase_vat' => $purchase_detail[0]['total_purchase_vat']
            );


            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page'] = 'purchase/pur_order_print_2';
            $this->parser->parse('template/layout', $data);
        } else if ($param == 'view1') {
            $purchase_detail = $this->Purchases->get_po_shortinfo_by_id($pur_order_id);
            $po_details = $this->Purchases->get_purchase_order_details($pur_order_id);
            $all_supplier = $this->Suppliers->supplier_list();
            $store_list = $this->Stores->store_list();
            $currency_details = $this->Soft_settings->retrieve_currency_info();
            $company_info = $this->Purchases->retrieve_company();
            $Soft_settings = $this->Soft_settings->retrieve_setting_editdata();

            $data = array(
                'title' => display('purchase_order'),
                'pur_order_id' => $pur_order_id,
                'pur_order_no' => $purchase_detail[0]['pur_order_no'],
                'supplier_id' => $purchase_detail[0]['supplier_id'],
                'total_amount' => $purchase_detail[0]['grand_total_amount'],
                'purchase_details' => $purchase_detail[0]['purchase_details'],
                'purchase_date' => $purchase_detail[0]['purchase_date'],
                'store_id' => $purchase_detail[0]['store_id'],
                'approve_status' => $purchase_detail[0]['approve_status'],
                'receive_status' => $purchase_detail[0]['receive_status'],
                'return_status' => $purchase_detail[0]['return_status'],
                'purchase_info' => $purchase_detail,
                'po_details' => $po_details,
                'all_supplier' => $all_supplier,
                'store_list' => $store_list,
                'company_info' => $company_info,
                'currency' => $currency_details[0]['currency_icon'],
                'position' => $currency_details[0]['currency_position'],
                'Soft_settings' => $Soft_settings,
                'total_purchase_dis' => $purchase_detail[0]['total_purchase_dis'],
                'total_purchase_dis_rc' => $purchase_detail[0]['total_purchase_dis_rc'],
                'total_purchase_vat' => $purchase_detail[0]['total_purchase_vat']
            );


            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page'] = 'purchase/pur_order_print_1';
            $this->parser->parse('template/layout', $data);
        } else {
            $purchase_detail = $this->Purchases->get_po_shortinfo_by_id($pur_order_id);
            $po_details = $this->Purchases->get_purchase_order_details($pur_order_id);
            $all_supplier = $this->Suppliers->supplier_list();
            $store_list = $this->Stores->store_list();
            $currency_details = $this->Soft_settings->retrieve_currency_info();
            $company_info = $this->Purchases->retrieve_company();
            $Soft_settings = $this->Soft_settings->retrieve_setting_editdata();

            $data = array(
                'title' => display('purchase_order'),
                'pur_order_id' => $pur_order_id,
                'pur_order_no' => $purchase_detail[0]['pur_order_no'],
                'supplier_id' => $purchase_detail[0]['supplier_id'],
                'total_amount' => $purchase_detail[0]['grand_total_amount'],
                'purchase_details' => $purchase_detail[0]['purchase_details'],
                'purchase_date' => $purchase_detail[0]['purchase_date'],
                'store_id' => $purchase_detail[0]['store_id'],
                'approve_status' => $purchase_detail[0]['approve_status'],
                'receive_status' => $purchase_detail[0]['receive_status'],
                'return_status' => $purchase_detail[0]['return_status'],
                'purchase_info' => $purchase_detail,
                'po_details' => $po_details,
                'all_supplier' => $all_supplier,
                'store_list' => $store_list,
                'company_info' => $company_info,
                'currency' => $currency_details[0]['currency_icon'],
                'position' => $currency_details[0]['currency_position'],
                'Soft_settings' => $Soft_settings,
                'total_purchase_dis' => $purchase_detail[0]['total_purchase_dis'],
                'total_purchase_dis_rc' => $purchase_detail[0]['total_purchase_dis_rc'],
                'total_purchase_vat' => $purchase_detail[0]['total_purchase_vat']
            );


            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page'] = 'purchase/pur_order_print';
            $this->parser->parse('template/layout', $data);
        }
    }

    public function purchase_inserted_data($purchase_id) {
        $purchase_detail = $this->Purchases->purchase_details_data($purchase_id);
        if (!empty($purchase_detail)) {
            $i = 0;
            foreach ($purchase_detail as $k => $v) {
                $i++;
                $purchase_detail[$k]['sl'] = $i;
            }
        }
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Purchases->retrieve_company();
        $created_at = explode(" ", $purchase_detail[0]['created_at']);
        $created_date = @$created_at[0];
        $created_time = @$created_at[1];
        $purchase_expense_detail = $this->Purchases->purchase_expense_detail($purchase_id);
        $purchase_date = explode("-", $purchase_detail[0]['purchase_date']);
        $purchase_detail[0]['purchase_date'] = $purchase_date[2] . '-' . $purchase_date[0] . '-' . $purchase_date[1];
        $data = array(
            'title' => display('purchase_details'),
            'purchase_id' => $purchase_detail[0]['purchase_id'],
            'invoice' => $purchase_detail[0]['invoice'],
            'invoice_no' => $purchase_detail[0]['invoice_no'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'supplier_mobile' => $purchase_detail[0]['mobile'],
            'supplier_email' => $purchase_detail[0]['email'],
            'store_id' => $purchase_detail[0]['store_id'],
            'vat_no' => $purchase_detail[0]['vat_no'],
            'cr_no' => $purchase_detail[0]['cr_no'],
            'supplier_address' => $purchase_detail[0]['address'],
            'purchase_date' => $purchase_detail[0]['purchase_date'],
            'created_at' => $purchase_detail[0]['created_at'],
            'created_date' => $created_date,
            'created_time' => $created_time,
            'sub_total_price' => $purchase_detail[0]['sub_total_price'],
            'purchase_vat' => $purchase_detail[0]['purchase_vat'],
            'total_purchase_vat' => $purchase_detail[0]['total_purchase_vat'],
            'total_purchase_dis' => $purchase_detail[0]['total_purchase_dis'],
            'grand_total_amount' => $purchase_detail[0]['grand_total_amount'],
            'purchase_all_data' => $purchase_detail,
            'purchase_expense_detail' => $purchase_expense_detail,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $data['Soft_settings'] = $this->Soft_settings->retrieve_setting_editdata();
        $chapterList = $this->parser->parse('dashboard/purchase/purchase_html', $data, true);
        $this->template_lib->full_admin_html_view($chapterList);
    }

    public function add_new_p_cost_row($count) {
        $row_id = mt_rand();
        $html = '';
        $bank_list = $this->db->select('bank_id,bank_name')->from('bank_list')->get()->result();
        $html .= '<tr id="row_' . $row_id . '">
                    <td class="text-left">
                        <input type="text" class="text-right form-control purchase_expences" name="purchase_expences_title_' . $count . '" placeholder ="Please Provide expense name" />
                    </td>
                    <td class="text-left">
                     <input type="text" onkeyup="calculate_add_purchase_cost(' . $count . ');"onchange="calculate_add_purchase_cost(' . $count . ');" id="purchase_expences2_' . $count . '" class="text-right form-control purchase_expences2" name="purchase_expences2_' . $count . '" placeholder ="0.00" />
                        <input type="text" onkeyup="calculate_add_purchase_cost(' . $count . ');"onchange="calculate_add_purchase_cost(' . $count . ');" id="purchase_expences_' . $count . '" class="text-right form-control purchase_expences" name="purchase_expences_' . $count . '" placeholder ="0.00" readonly=""/>
                    </td>
                    <td>
                        <div class="form-group row guifooterpanel">
                            <div class="col-sm-12">
                                <select class="form-control dont-select-me" name="bank_id[]">
                                    <option value="cash">Cash</option>';
        if ($bank_list) {
            foreach ($bank_list as $bank) {
                $html .= '<option value="' . $bank->bank_id . '">' . $bank->bank_name . '</option>';
            }
        }
        $html .= '</select>
                            </div>
                        </div>
                    </td>
                    <td class="text-left">
                        <button type="button" class="btn btn-danger btn-sm del_more_btn" data-row_id="' . $row_id . '" ><i class="fa fa-minus"></i></button>
                    </td>
                </tr>';
        echo $html;
    }

    public function purchase_download_attachment($purchase_id = null)
    {
        $file_name = $this->input->get('file');
        if (!$purchase_id || !$file_name) {
            return;
        }
        $this->load->helper('download');

        force_download($file_name, null);
    }

    public function edit_purorder($pur_order_id)
    {
        
    }
}
