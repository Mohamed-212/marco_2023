<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cstock_opening extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array(
            'dashboard/Stores',
            'dashboard/Variants',
            'dashboard/Stock_opening_model',
            'dashboard/Soft_settings',
            'template/Template_model',
            'dashboard/Products',
        ));
        $this->load->library('dashboard/occational');
    }
    public function product_search()
    {
        $product_name = $this->input->post('product_name', TRUE);
        $product_info = $this->Stock_opening_model->product_search_item($product_name);
        $json_product = [];
        foreach ($product_info as $value) {
            $variant_id = $value['variants'];
            if (strpos($variant_id, ',') > -1) {
                $variant_id = explode(',', $variant_id);
                if (is_array($variant_id) && isset($variant_id[0])) {
                    $variant_id = $variant_id[0];
                }
            } else {
                $variant_id = $variant_id;
            }

            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id'], 'varient_id' => $variant_id);
        }
        echo json_encode($json_product);
    }
    public function add_stock_opening()
    {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $store_list   = $this->Stores->store_list();
                $get_def_store = $this->Stores->get_def_store();
                $variant_list = $this->Variants->variant_list();
                $voucher_no   = $this->generator(7);

                $data = array(
                    'title'       => display('add_stock_opening'),
                    'store_list'  => $store_list,
                    'def_store'   => $get_def_store,
                    'variant_list' => $variant_list,
                    'voucher_no'  => 'StockOP-' . $voucher_no,
                );
                $data['setting'] = $this->Template_model->setting();
                $data['module'] = "dashboard";
                $data['page']   = 'stock_opening/add_stock_opening';
                $this->parser->parse('template/layout', $data);
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            $store_list   = $this->Stores->store_list();
            $get_def_store = $this->Stores->get_def_store();
            $variant_list = $this->Variants->variant_list();
            $batch_no     = $this->generator(7);

            $data = array(
                'title'       => display('add_stock_opening'),
                'store_list'  => $store_list,
                'def_store'   => $get_def_store,
                'variant_list' => $variant_list,
                'batch_no'    => $batch_no,
            );
            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page']   = 'stock_opening/add_stock_opening';
            $this->parser->parse('template/layout', $data);
        }
    }
    //This function is used to Generate Key
    public function generator($lenth)
    {
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
    public function insert_stock_opening()
    {

        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                //insert stock opening
                $voucher_no        = $this->input->post('voucher_no', TRUE);
                $voucher_date      = $this->input->post('voucher_date', TRUE);
                $store_id          = $this->input->post('store_id', TRUE);
                $voucher_detail    = $this->input->post('voucher_detail', TRUE);
                $p_id              = $this->input->post('product_id', TRUE);
                $batch             = $this->input->post('batch_no', true);
                $expiry            = $this->input->post('expiry_date', true);
                $quantity          = $this->input->post('product_quantity', TRUE);
                $variant_id        = $this->input->post('variant_id', TRUE);
                $color_variant     = $this->input->post('color_variant', TRUE);
                $rate              = $this->input->post('product_rate', TRUE);
                $t_price           = $this->input->post('total_price', TRUE);
                $sub_total_price   = $this->input->post('sub_total_price', TRUE);
                $grand_total_price = $this->input->post('grand_total_price', TRUE);

                if (!empty($voucher_date) && strlen($voucher_date) > 2) {
                    $voucher_date = date('Y-m-d', strtotime($voucher_date));
                }

                //Variant id required check
//                $result = array();
//                foreach ($p_id as $k => $v) {
//                    if (empty($variant_id[$k])) {
//                        $this->session->set_userdata(array('error_message' => display('variant_is_required')));
//                        redirect('dashboard/cstock_opening/add_stock_opening');
//                    }
//                }

                //Stock opening Details
                $cogs_price = 0;
                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_quantity = (int)$quantity[$i];
                    $product_rate     = (float)$rate[$i];
                    $product_id       = $p_id[$i];
                    $batch_no         = $batch[$i];
                    $expiry_date      = $expiry[$i];
                    if (!empty($expiry_date) && strlen($expiry_date) > 2) {
                        $expiry_date = date('Y-m-d', strtotime($expiry_date));
                    }
                    $total_price      = (float)$t_price[$i];
                    $variant          = $variant_id[$i];
                    $variant_color    = $color_variant[$i];
                    $cogs_price       += ($product_rate * $product_quantity);
                    $store = array(
                        'transfer_id'   => $this->auth->generator(15),
                        'voucher_no'    => $voucher_no,
                        'store_id'      => $store_id,
                        'product_id'    => $product_id,
                        'variant_id'    => $variant,
                        'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                        'date_time'     => $voucher_date,
                        'quantity'      => $product_quantity,
                        'status'        => 3
                    );
                    if (!empty($quantity)) {

                        $this->db->where('product_id', $product_id);
                        $this->db->from('product_information');
                        $product = $this->db->get()->result_array();
                        //update supplier price
                        $purchaseData = $this->Products->product_purchase_info($product_id);
                        $totalPurchase = 0;
                        $totalPrcsAmnt = 0;
                        if (!empty($purchaseData)) {
                            foreach ($purchaseData as $k => $v) {
                                $rate_after_exp_up = floatval($purchaseData[$k]['rate_after_exp']);
                                $quantity_up = floatval($purchaseData[$k]['quantity']);
                                $newtotal = $rate_after_exp_up * $quantity_up;
                                $totalPrcsAmnt = ($totalPrcsAmnt + $newtotal);
                                $totalPurchase = ($totalPurchase + $purchaseData[$k]['quantity']);
                            }
                        }
                        $totalPrcsAmnt += ($product_quantity * $product_rate);
                        $totalPurchase += $product_quantity;
                        $newrate = $totalPrcsAmnt / $totalPurchase;
                        $supplier_price = array(
                            'supplier_price' => $newrate,
                            'open_quantity' => $product[0]['open_quantity'] + $product_quantity,
                            'open_rate' => $product_rate,
                        );

                        $this->Products->update_product($supplier_price, $product_id);
                        // $this->db->where('product_id', $product_id);
                        // $this->db->update('product_information', $supplier_price);

                        $this->db->insert('transfer', $store);
                        // stock 
                        $check_stock = $this->Stock_opening_model->check_stock($store_id, $product_id, $variant, $variant_color);
                        if (empty($check_stock)) {
                            // insert
                            $stock = array(
                                'store_id'     => $store_id,
                                'product_id'   => $product_id,
                                'variant_id'   => $variant,
                                'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                                'quantity'     => $product_quantity,
                                'warehouse_id' => '',
                            );
                            $this->db->insert('purchase_stock_tbl', $stock);
                            // insert
                        } else {
                            //update
                            $stock = array(
                                'quantity' => $check_stock->quantity + $product_quantity,
                            );
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
                            $this->db->update('purchase_stock_tbl', $stock);
                            //update
                        }
                        // stock
                    }
                }

                $this->load->model('accounting/account_model');
                // $store_head   = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
                $createdate   = date('Y-m-d H:i:s');
                $receive_by   = $this->session->userdata('user_id');
                $date         = $createdate;
                //1st Inventory-Openning total price debit
                $store_debit = array(
                    'fy_id'     => $find_active_fiscal_year->id,
                    'VNo'       => $voucher_no,
                    'Vtype'     => 'Inventory-Openning',
                    'VDate'     => $date,
                    'COAID' => 1141, //Main Warehouse
                    'Narration' => 'Inventory-Openning total price debited at Main warehouse',
//                    'COAID'     => $store_head->HeadCode, //Main Warehouse
//                    'Narration' => 'Inventory-Openning total price debited at ' . $store_head->HeadName,
                    'Debit'     => $grand_total_price,
                    'Credit'    => 0, //purchase price asbe
                    'IsPosted'  => 1,
                    'CreateBy'  => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id'  => $store_id,
                    'IsAppove'  => 1
                );

                //2nd Inventory-Openning COGS Credit
                $COGSCredit = array(
                    'fy_id'     => $find_active_fiscal_year->id,
                    'VNo'       => $voucher_no,
                    'Vtype'     => 'Inventory-Openning',
                    'VDate'     => $date,
                    'COAID'     => 4111,
                    'Narration' => 'Inventory-Openning total price credited at COGS',
                    'Debit'     => 0,
                    'Credit'    => $cogs_price,
                    'IsPosted'  => 1,
                    'CreateBy'  => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id'  => $store_id,
                    'IsAppove'  => 1
                );
                $this->db->insert('acc_transaction', $store_debit);
                $this->db->insert('acc_transaction', $COGSCredit);
                $this->session->set_userdata(array('message' => display('successfully_added')));
                redirect('dashboard/cstock_opening/add_stock_opening');
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect('dashboard/Admin_dashboard');
            }
        }
        else {
            //insert stock opening
            $voucher_no        = $this->input->post('voucher_no', TRUE);
            $voucher_date      = $this->input->post('voucher_date', TRUE);
            $store_id          = $this->input->post('store_id', TRUE);
            $voucher_detail    = $this->input->post('voucher_detail', TRUE);
            $p_id              = $this->input->post('product_id', TRUE);
            $batch             = $this->input->post('batch_no', true);
            $expiry            = $this->input->post('expiry_date', true);
            $quantity          = $this->input->post('product_quantity', TRUE);
            $variant_id        = $this->input->post('variant_id', TRUE);
            $color_variant     = $this->input->post('color_variant', TRUE);
            $rate              = $this->input->post('product_rate', TRUE);
            $t_price           = $this->input->post('total_price', TRUE);
            $sub_total_price   = $this->input->post('sub_total_price', TRUE);
            $grand_total_price = $this->input->post('grand_total_price', TRUE);

            //Variant id required check
            $result = array();
            foreach ($p_id as $k => $v) {
                if (empty($variant_id[$k])) {
                    $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                    redirect('dashboard/cstock_opening/add_stock_opening');
                }
            }

            //Stock opening Details
            $cogs_price = 0;
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_quantity = $quantity[$i];
                $product_rate     = $rate[$i];
                $product_id       = $p_id[$i];
                $batch_no         = $batch[$i];
                $expiry_date      = $expiry[$i];
                $total_price      = $t_price[$i];
                $variant          = $variant_id[$i];
                $variant_color    = $color_variant[$i];
                $cogs_price       += ($product_rate * $product_quantity);
                $store = array(
                    'transfer_id'   => $this->auth->generator(15),
                    'voucher_no'    => $voucher_no,
                    'store_id'      => $store_id,
                    'product_id'    => $product_id,
                    'variant_id'    => $variant,
                    'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                    'date_time'     => $voucher_date,
                    'quantity'      => $product_quantity,
                    'status'        => 3
                );
                if (!empty($quantity)) {
                    $this->db->insert('transfer', $store);
                    // stock 
                    $check_stock = $this->Stock_opening_model->check_stock($store_id, $product_id, $variant, $variant_color);
                    if (empty($check_stock)) {
                        // insert
                        $stock = array(
                            'store_id'     => $store_id,
                            'product_id'   => $product_id,
                            'variant_id'   => $variant,
                            'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                            'quantity'     => $product_quantity,
                            'warehouse_id' => '',
                        );
                        // $this->db->insert('purchase_stock_tbl', $stock);
                        // insert
                    } else {
                        //update
                        $stock = array(
                            'quantity' => $check_stock->quantity + $product_quantity
                        );
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
                        // $this->db->update('purchase_stock_tbl', $stock);
                        //update
                    }
                    // stock
                }
            }
            $this->session->set_userdata(array('message' => display('successfully_added')));
            redirect('dashboard/cstock_opening/add_stock_opening');
        }
    }
}