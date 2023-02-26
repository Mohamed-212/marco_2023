<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpurchase_return extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array(
            'dashboard/Suppliers',
            'dashboard/Products',
            'dashboard/Invoices',
            'dashboard/Purchases',
            'dashboard/Stores',
            'dashboard/Variants',
            'dashboard/Soft_settings',
            'template/Template_model',
        ));
        $this->load->library('dashboard/occational');
    }

    //Default invoice add from loading
    public function index() {
        return $this->manage_purchase_return();
    }

    public function manage_purchase_return() {
        $this->permission->check_label('manage_purchase_return')->read()->redirect();
        $purchase_return_list = $this->Purchases->purchase_return_list();
        if (!empty($purchase_return_list)) {
            $j = 0;
            foreach ($purchase_return_list as $k => $v) {
                $purchase_return_list[$k]['final_date'] = $this->occational->dateConvert($purchase_return_list[$j]['return_date']);
                $j++;
            }

            $i = 0;
            foreach ($purchase_return_list as $k => $v) {
                $i++;
                $purchase_return_list[$k]['sl'] = $i;
            }
        }
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('manage_purchase_return'),
            'purchase_return_list' => $purchase_return_list,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/manage_purchase_return';
        $this->parser->parse('template/layout', $data);
    }

    public function purchase_return_form($purchase_id) {

        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $purchase_detail = $this->Purchases->retrieve_purchase_editdata($purchase_id);
                $supplier_id = $purchase_detail[0]['supplier_id'];
                $supplier_list = $this->Suppliers->supplier_list();
                $supplier_selected = $this->Suppliers->supplier_search_item($supplier_id);
                $this->load->model('Wearhouses');
                $wearhouse_list = $this->Wearhouses->wearhouse_list();
                $store_list = $this->Stores->store_list();
                $variant_list = $this->Variants->variant_list();
                $batch_no = $this->generator(7);
                if (!empty($purchase_detail)) {
                    $i = 0;
                    foreach ($purchase_detail as $k => $v) {
                        $i++;
                        $purchase_detail[$k]['sl'] = $i;
                    }
                }
                $data = array(
                    'title' => display('purchase_return_form'),
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
                    'batch_no' => $batch_no,
                );
                $data['setting'] = $this->Template_model->setting();
                $data['module'] = "dashboard";
                $data['page'] = 'purchase/purchase_return_form';
                $this->parser->parse('template/layout', $data);
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            $purchase_detail = $this->Purchases->retrieve_purchase_editdata($purchase_id);
            $supplier_id = $purchase_detail[0]['supplier_id'];
            $supplier_list = $this->Suppliers->supplier_list();
            $supplier_selected = $this->Suppliers->supplier_search_item($supplier_id);
            $this->load->model('Wearhouses');
            $wearhouse_list = $this->Wearhouses->wearhouse_list();
            $store_list = $this->Stores->store_list();
            $variant_list = $this->Variants->variant_list();
            $batch_no = $this->generator(7);
            if (!empty($purchase_detail)) {
                $i = 0;
                foreach ($purchase_detail as $k => $v) {
                    $i++;
                    $purchase_detail[$k]['sl'] = $i;
                }
            }
            $data = array(
                'title' => display('purchase_return_form'),
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
                'batch_no' => $batch_no,
            );
            $data['setting'] = $this->Template_model->setting();
            $data['module'] = "dashboard";
            $data['page'] = 'purchase/purchase_return_form';
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

    public function check_stock($store_id = null, $product_id = null, $variant = null, $variant_color = null) {
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

    public function insert_purchase_return() {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('product[]', display('product'), 'required');
                $this->form_validation->set_rules('purchase_id', display('purchase_id'), 'required');
                $this->form_validation->set_rules('store_id', display('store_id'), 'required');
                $this->form_validation->set_rules('supplier_id', display('supplier_id'), 'required');

                $purchase_id = $this->input->post('purchase_id', true);
                $store_id = $this->input->post('store_id', true);
                if ($this->form_validation->run() == TRUE) {
                    $vat_rate = $this->db->select('purchase_vat')->from('product_purchase')->where('purchase_id', $purchase_id)->get()->row();
                    if (!empty($vat_rate)) {
                        $purchase_vat = $vat_rate->purchase_vat;
                    } else {
                        $purchase_vat = 0;
                    }
                    // insert into product_purchase_return
                    $purchase_return_info = array(
                        'purchase_id' => $purchase_id,
                        'supplier_id' => $this->input->post('supplier_id', true),
                        'store_id' => $this->input->post('store_id', true),
                        'return_date' => $this->input->post('return_date', true),
                        'details' => $this->input->post('return_details', true),
                        'returned_by' => $this->session->userdata('user_id'),
                        'status' => 1
                    );
                    $result1 = $this->db->insert('product_purchase_return', $purchase_return_info);

                    if ($result1) {
                        $return_id = $this->db->insert_id();
                        $products = $this->input->post('product', true);
                        $variant_id = $this->input->post('variant_id', true);
                        $variant_color = $this->input->post('color_variant', true);
                        $batch_no = $this->input->post('batch_no', true);
                        $quantity = $this->input->post('product_quantity', true);
                        $rate = $this->input->post('product_rate', true);
                        $discount = $this->input->post('discount', true);
                        $total_return_amount = $this->input->post('total_price', true);
                        // insert into product_purchase_return_details
                        $sub_total = 0;
                        $total_discount = 0;
                        $total_without_discount = 0;
                        foreach ($products as $key => $product) {
                            $purchase_quantity = $this->db->select('quantity,rate_after_discount')->from('product_purchase_details')->where('batch_no', $batch_no[$key])->get()->row();
                            $purchase_return_details = array(
                                'return_id' => $return_id,
                                'product_id' => $product,
                                'variant_id' => $variant_id[$key],
                                'variant_color' => $variant_color[$key],
                                'batch_no' => $batch_no[$key],
                                'quantity' => $quantity[$key],
                                'purchase_quantity' => $purchase_quantity->quantity,
                                'rate' => $rate[$key],
                                'discount' => $discount[$key],
                                'total_return_amount' => $purchase_quantity->rate_after_discount * $quantity[$key]
                            );
                            // $sub_total += $total_return_amount[$key];
                            $total_with_discount = 0;
                            $sub_total += $purchase_quantity->rate_after_discount * $quantity[$key];
                            $total_without_discount += $rate[$key] * $quantity[$key];
                            $total_with_discount += $purchase_quantity->rate_after_discount * $quantity[$key];
                            //  $total_discount += (($rate[$key] * $discount[$key]) / 100) * $quantity[$key];
                            $total_discount += $total_without_discount - $total_with_discount;
                            $result2 = $this->db->insert('product_purchase_return_details', $purchase_return_details);
                            if ($result2) {
                                $return_detail_id = $this->db->insert_id();

                                //reduce from product_purchase
                                $this->db->select('*');
                                $this->db->from('product_purchase_details');
                                $this->db->where('purchase_id', $purchase_id);
                                if (!empty($product)) {
                                    $this->db->where('product_id', $product);
                                }
                                if (!empty($variant_id[$key])) {
                                    $this->db->where('variant_id', $variant_id[$key]);
                                }
                                if (!empty($variant_color[$key])) {
                                    $this->db->where('variant_color', $variant_color[$key]);
                                }
                                $product_purchase_details_info = $this->db->get()->row();
                                $product_cost = ($product_purchase_details_info->vat + ($product_purchase_details_info->quantity * $product_purchase_details_info->rate_after_discount));

                                $product_purchase_info = $this->db->select('total_items,sub_total_price,total_purchase_vat,grand_total_amount')->from('product_purchase')->where('purchase_id', $purchase_id)->get()->row();
                                $new_product_purchase = array(
                                    'total_items' => ($product_purchase_info->total_items - $quantity[$key]),
                                    'sub_total_price' => ($product_purchase_info->sub_total_price - ($product_purchase_details_info->quantity * $product_purchase_details_info->rate_after_discount)),
                                    'total_purchase_vat' => ($product_purchase_info->total_purchase_vat - $product_purchase_details_info->vat),
                                    'grand_total_amount' => ($product_purchase_info->grand_total_amount - $product_cost),
                                );

                                // reduce from product_purchase_details
                                $this->db->where('purchase_id', $purchase_id)->update('product_purchase', $new_product_purchase);

                                $product_purchase_details_data = array(
                                    'quantity' => ($purchase_quantity->quantity - $quantity[$key]),
                                    'vat' => 0,
                                    'total_amount' => 0
                                );
                                $this->db->where('batch_no', $batch_no[$key])->where('purchase_id', $purchase_id)->update('product_purchase_details', $product_purchase_details_data);
                                // reduce from product_purchase_details
                                //reduce from product_purchase
                                //////////////////////////////////////////////////////////////
                                $this->load->model('Wearhouses');
                                $this->db->where('product_id', $product);
                                
                                $this->db->from('product_information');
                                $product_id = $product;

                                $product = $this->db->get()->result_array();
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
                                    if ($totalPurchase > 0) {
                                        $totalPrcsAmnt += ($product[0]['open_quantity'] * $product[0]['open_rate']);
                                        $totalPurchase += $product[0]['open_quantity'];
                                        $newrate = $totalPrcsAmnt / $totalPurchase;
                                        $supplier_price = array(
                                            'supplier_price' => $newrate,
                                        );

                                        // $this->db->where('product_id', $product_id);
                                        // $this->db->update('product_information', $supplier_price);
                                        $this->Products->update_product($supplier_price, $product_id);

                                        $supplier_price2 = array(
                                            'child_product_price' => $newrate,
                                        );
                                        $this->db->where('child_product_id', $product_id);
                                        
                                        $this->db->update('assembly_products', $supplier_price2);
                                    }
                                }


                                /////////////////////////////////////////////////////////////////
                                // transfer
                                $store = array(
                                    'transfer_id' => $this->auth->generator(15),
                                    'purchase_id' => $purchase_id,
                                    'store_id' => $store_id,
                                    'product_id' => $product_id,
                                    'variant_id' => $variant_id[$key],
                                    'variant_color' => $variant_color[$key],
                                    'date_time' => date('m-d-Y'),
                                    'quantity' => -$quantity[$key],
                                    'return_detail_id' => $return_detail_id,
                                    'status' => 3
                                );
                                $this->db->insert('transfer', $store);
                                // transfer
                                // stock
                                $check_stock = $this->check_stock($store_id, $product_id, $variant_id[$key], $variant_color[$key]);
                                if (!empty($check_stock)) {
                                    //update
                                    $stock = array(
                                        'quantity' => $check_stock->quantity - $quantity[$key]
                                    );
                                    if (!empty($store_id)) {
                                        $this->db->where('store_id', $store_id);
                                    }
                                    if (!empty($product_id)) {
                                        $this->db->where('product_id', $product_id);
                                    }
                                    if (!empty($variant_id[$key])) {
                                        $this->db->where('variant_id', $variant_id[$key]);
                                    }
                                    if (!empty($variant_color[$key])) {
                                        $this->db->where('variant_color', $variant_color[$key]);
                                    }
                                    $this->db->update('purchase_stock_tbl', $stock);
                                    //update
                                }
                                // stock
                            } else {
                                $this->session->set_userdata(array('error_message' => display('fields_must_not_be_empty')));
                                redirect('dashboard/Cpurchase_return/purchase_return_form/' . $purchase_id);
                            }
                        }

                        // purchase return jv start
                        $supplier_id = $this->input->post('supplier_id', true);
                        $store_id = $this->input->post('store_id', true);
                        $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
                        $supplier_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                        $createdate = date('Y-m-d H:i:s');
                        $receive_by = $this->session->userdata('user_name');
                        $date = $this->input->post('return_date', true);
                        $total_vat = ($sub_total * $purchase_vat) / 100;
                        $grand_total = $sub_total + $total_vat;

                        $total_price_with_vat = $grand_total;
                        $discount_value = $total_discount;
                        $total_price_before_discount = $total_without_discount;
                        // add to supplier ledger
                        $data = array(
                            'transaction_id' =>  $this->auth->generator(15),
                            'supplier_id'   =>  $supplier_id,
                            'invoice_no'    =>  NULL,
                            'deposit_no'    =>  null,
                            'amount'        =>  $total_price_with_vat,
                            'description'   =>  $this->input->post('return_details', true),
                            'payment_type'  =>  1,
                            'date'          =>  date('Y-m-d'),
                            'status'        =>  1,
                            'sl_created_at' => date('Y-m-d H:i:s'),
                            'voucher' => 'return'
                        );
                        $this->db->insert('supplier_ledger', $data);
                        //1st, debit supplier with total price with vat
                        $supplierDebit = array(
                            'fy_id' => $find_active_fiscal_year->id,
                            'VNo' => 'PR-' . $return_id,
                            'Vtype' => 'Purchase return',
                            'VDate' => $date,
                            'COAID' => $supplier_head->HeadCode,
                            'Narration' => 'Purchase return grand total debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                            'Debit' => $total_price_with_vat,
                            'Credit' => 0,
                            'IsPosted' => 1,
                            'CreateBy' => $receive_by,
                            'CreateDate' => $createdate,
                            'store_id' => $store_id,
                            'IsAppove' => 1
                        );
                        //2nd, debit Discount Received with discount value
                        $discount_received_Debit = array(
                            'fy_id' => $find_active_fiscal_year->id,
                            'VNo' => 'PR-' . $return_id,
                            'Vtype' => 'Purchase return',
                            'VDate' => $date,
                            'COAID' => 521,
                            'Narration' => 'Purchase return total discount value debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                            'Debit' => $discount_value,
                            'Credit' => 0,
                            'IsPosted' => 1,
                            'CreateBy' => $receive_by,
                            'CreateDate' => $createdate,
                            'store_id' => $store_id,
                            'IsAppove' => 1
                        );
                        //3rd, credit Main warehouse with total price before discount
                        $main_warehouse_credit = array(
                            'fy_id' => $find_active_fiscal_year->id,
                            'VNo' => 'PR-' . $return_id,
                            'Vtype' => 'Purchase return',
                            'VDate' => $date,
                            'COAID' => 1141,
                            'Narration' => 'Purchase return total price before discount credited in Main warehouse by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                            'Debit' => 0,
                            'Credit' => $total_price_before_discount,
                            'IsPosted' => 1,
                            'CreateBy' => $receive_by,
                            'CreateDate' => $createdate,
                            'store_id' => $store_id,
                            'IsAppove' => 1
                        );
                        //4th, credit VAT on inputs with total vat
                        $vatCredit = array(
                            'fy_id' => $find_active_fiscal_year->id,
                            'VNo' => 'PR-' . $return_id,
                            'Vtype' => 'Purchase return',
                            'VDate' => $date,
                            'COAID' => 116,
                            'Narration' => 'Purchase return vat credited in vat/tax by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                            'Debit' => 0,
                            'Credit' => $total_vat,
                            'IsPosted' => 1,
                            'CreateBy' => $receive_by,
                            'CreateDate' => $createdate,
                            'store_id' => $store_id,
                            'IsAppove' => 1
                        );
                        $this->db->insert('acc_transaction', $supplierDebit);
                        $this->db->insert('acc_transaction', $discount_received_Debit);
                        $this->db->insert('acc_transaction', $main_warehouse_credit);
                        $this->db->insert('acc_transaction', $vatCredit);
                        // purchase return jv end

                        $this->session->set_userdata(array('message' => display('successfully_returned')));
                        redirect('dashboard/Cpurchase_return/manage_purchase_return');
                    } else {
                        $this->session->set_userdata(array('error_message' => display('failed_try_again')));
                        redirect('dashboard/Cpurchase_return/purchase_return_form/' . $purchase_id);
                    }
                }
                $this->session->set_userdata(array('error_message' => display('failed_try_again')));
                redirect('dashboard/Cpurchase_return/purchase_return_form/' . $purchase_id);
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('product[]', display('product'), 'required');
            $this->form_validation->set_rules('purchase_id', display('purchase_id'), 'required');
            $this->form_validation->set_rules('store_id', display('store_id'), 'required');
            $this->form_validation->set_rules('supplier_id', display('supplier_id'), 'required');

            $purchase_id = $this->input->post('purchase_id', true);
            $store_id = $this->input->post('store_id', true);
            if ($this->form_validation->run() == TRUE) {
                $vat_rate = $this->db->select('purchase_vat')->from('product_purchase')->where('purchase_id', $purchase_id)->get()->row();
                if (!empty($vat_rate)) {
                    $purchase_vat = $vat_rate->purchase_vat;
                } else {
                    $purchase_vat = 0;
                }
                // insert into product_purchase_return
                $purchase_return_info = array(
                    'purchase_id' => $purchase_id,
                    'supplier_id' => $this->input->post('supplier_id', true),
                    'store_id' => $this->input->post('store_id', true),
                    'return_date' => $this->input->post('return_date', true),
                    'details' => $this->input->post('return_details', true),
                    'returned_by' => $this->session->userdata('user_id'),
                    'status' => 1
                );
                $result1 = $this->db->insert('product_purchase_return', $purchase_return_info);
                if ($result1) {
                    $return_id = $this->db->insert_id();
                    $products = $this->input->post('product', true);
                    $variant_id = $this->input->post('variant_id', true);
                    $variant_color = $this->input->post('color_variant', true);
                    $batch_no = $this->input->post('batch_no', true);
                    $quantity = $this->input->post('product_quantity', true);
                    $rate = $this->input->post('product_rate', true);
                    $discount = $this->input->post('discount', true);
                    $total_return_amount = $this->input->post('total_price', true);
                    // insert into product_purchase_return_details
                    $sub_total = 0;
                    $total_discount = 0;
                    $total_without_discount = 0;
                    foreach ($products as $key => $product) {
                        
                        $purchase_quantity = $this->db->select('quantity')->from('product_purchase_details')->where('batch_no', $batch_no[$key])->get()->row();
                        $purchase_return_details = array(
                            'return_id' => $return_id,
                            'product_id' => $product,
                            'variant_id' => $variant_id[$key],
                            'variant_color' => $variant_color[$key],
                            'batch_no' => $batch_no[$key],
                            'quantity' => $quantity[$key],
                            'purchase_quantity' => $purchase_quantity->quantity,
                            'rate' => $rate[$key],
                            'discount' => $discount[$key],
                            'total_return_amount' => $total_return_amount[$key]
                        );
                        $sub_total += $total_return_amount[$key];
                        $total_discount += $discount[$key] * $quantity[$key];
                        $total_without_discount += $rate[$key] * $quantity[$key];
                        $result2 = $this->db->insert('product_purchase_return_details', $purchase_return_details);
                        if ($result2) {
                            $return_detail_id = $this->db->insert_id();
                            $new_quantity = array(
                                'quantity' => $purchase_quantity->quantity - $quantity[$key]
                            );
                            $this->db->where('batch_no', $batch_no[$key])->update('product_purchase_details', $new_quantity);
                            // transfer
                            $store = array(
                                'transfer_id' => $this->auth->generator(15),
                                'purchase_id' => $purchase_id,
                                'store_id' => $store_id,
                                'product_id' => $product,
                                'variant_id' => $variant_id[$key],
                                'variant_color' => $variant_color[$key],
                                'date_time' => date('m-d-Y'),
                                'quantity' => -$quantity[$key],
                                'return_detail_id' => $return_detail_id,
                                'status' => 3
                            );
                            $this->db->insert('transfer', $store);
                            // transfer
                            // stock
                            $check_stock = $this->check_stock($store_id, $product, $variant_id[$key], $variant_color[$key]);
                            if (!empty($check_stock)) {
                                //update
                                $stock = array(
                                    'quantity' => $check_stock->quantity - $quantity[$key]
                                );
                                if (!empty($store_id)) {
                                    $this->db->where('store_id', $store_id);
                                }
                                if (!empty($product)) {
                                    $this->db->where('product_id', $product);
                                }
                                if (!empty($variant_id[$key])) {
                                    $this->db->where('variant_id', $variant_id[$key]);
                                }
                                if (!empty($variant_color[$key])) {
                                    $this->db->where('variant_color', $variant_color[$key]);
                                }
                                $this->db->update('purchase_stock_tbl', $stock);
                                //update
                            }
                            // stock
                        } else {
                            $this->session->set_userdata(array('error_message' => display('fields_must_not_be_empty')));
                            redirect('dashboard/Cpurchase_return/purchase_return_form/' . $purchase_id);
                        }
                    }
                    $this->session->set_userdata(array('message' => display('successfully_returned')));
                    redirect('dashboard/Cpurchase_return/manage_purchase_return');
                } else {
                    $this->session->set_userdata(array('error_message' => display('failed_try_again')));
                    redirect('dashboard/Cpurchase_return/purchase_return_form/' . $purchase_id);
                }
            }
            $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            redirect('dashboard/Cpurchase_return/purchase_return_form/' . $purchase_id);
        }
    }

    public function purchase_return_details_data($purchase_return_id) {
        $return_detail = $this->Purchases->purchase_return_details_data($purchase_return_id);
        if (!empty($return_detail)) {
            $i = 0;
            foreach ($return_detail as $k => $v) {
                $i++;
                $return_detail[$k]['sl'] = $i;
            }
        }
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Purchases->retrieve_company();
        $data = array(
            'title' => display('purchase_return_details'),
            'purchase_id' => $return_detail[0]['purchase_id'],
            'purchase_details' => $return_detail[0]['details'],
            'supplier_name' => $return_detail[0]['supplier_name'],
            'final_date' => $return_detail[0]['created_at'],
            'invoice_no' => $return_detail[0]['invoice_no'],
            'purchase_all_data' => $return_detail,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/return_details';
        $this->parser->parse('template/layout', $data);
    }

    public function edit_purchase_return($purchase_return_id) {

        $this->form_validation->set_rules('purchase_id', display('purchase_id'), 'required');
        $this->form_validation->set_rules('store_id', display('store_id'), 'required');
        $this->form_validation->set_rules('supplier_id', display('supplier_id'), 'required');
        if ($this->form_validation->run() == TRUE) {
            $purchase_id = $this->input->post('purchase_id', true);
            $store_id = $this->input->post('store_id', true);
            $purchase_return_info = array(
                'purchase_id' => $purchase_id,
                'supplier_id' => $this->input->post('supplier_id', true),
                'store_id' => $this->input->post('store_id', true),
                'return_date' => $this->input->post('return_date', true),
                'details' => $this->input->post('return_details', true),
                'returned_by' => $this->session->userdata('user_id'),
                'status' => 1
            );
            $result1 = $this->db->where('purchase_return_id', $purchase_return_id)->update('product_purchase_return', $purchase_return_info);

            if ($result1) {
                $products = $this->input->post('product', true);
                $variant_id = $this->input->post('variant_id', true);
                $variant_color = $this->input->post('color_variant', true);
                $batch_no = $this->input->post('batch_no', true);
                $quantity = $this->input->post('product_quantity', true);
                $rate = $this->input->post('product_rate', true);
                $total_return_amount = $this->input->post('total_price', true);
                $detail_id = $this->input->post('detail_id', true);
                foreach ($products as $key => $product) {
                    $previous_details = $this->db->select('*')->from('product_purchase_return_details')->where('id', $detail_id[$key])->get()->row();
                    $purchase_quantity = $this->db->select('quantity')->from('product_purchase_details')->where('batch_no', $batch_no[$key])->get()->row();

                    $previous_quantity = $previous_details->quantity;
                    $purchase_return_details = array(
                        'return_id' => $purchase_return_id,
                        'product_id' => $product,
                        'variant_id' => $variant_id[$key],
                        'variant_color' => $variant_color[$key],
                        'batch_no' => $batch_no[$key],
                        'quantity' => $quantity[$key],
                        'purchase_quantity' => $purchase_quantity->quantity,
                        'rate' => $rate[$key],
                        'total_return_amount' => $total_return_amount[$key]
                    );
                    $this->db->where('id', $detail_id[$key])->update('product_purchase_return_details', $purchase_return_details);

                    // update product_purchase_details
                    $new_quantity = array(
                        'quantity' => $purchase_quantity->quantity + $previous_quantity - $quantity[$key]
                    );
                    $this->db->where('batch_no', $batch_no[$key])->update('product_purchase_details', $new_quantity);
                    // update product_purchase_details
                    // transfer
                    $store = array(
                        'quantity' => -$quantity[$key],
                    );
                    $this->db->where('return_detail_id', $detail_id[$key])->update('transfer', $store);
                    // transfer
                    // stock
                    $check_stock = $this->check_stock($store_id, $product, $variant_id[$key], $variant_color[$key]);
                    if (!empty($check_stock)) {
                        //update
                        $stock = array(
                            'quantity' => $check_stock->quantity + $previous_quantity - $quantity[$key]
                        );
                        if (!empty($store_id)) {
                            $this->db->where('store_id', $store_id);
                        }
                        if (!empty($product)) {
                            $this->db->where('product_id', $product);
                        }
                        if (!empty($variant_id[$key])) {
                            $this->db->where('variant_id', $variant_id[$key]);
                        }
                        if (!empty($variant_color[$key])) {
                            $this->db->where('variant_color', $variant_color[$key]);
                        }
                        $this->db->update('purchase_stock_tbl', $stock);
                        //update
                    }
                    // stock 
                }
                $this->session->set_userdata(array('message' => display('successfully_updated')));
                redirect('dashboard/Cpurchase_return/manage_purchase_return');
            } else {
                $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            }
        }

        $purchase_return_info = $this->db->select('*')->from('product_purchase_return')->where('purchase_return_id', $purchase_return_id)->get()->row_array();
        $return_detail = $this->Purchases->return_detail($purchase_return_id);
        $purchase_detail = $this->Purchases->retrieve_purchase_return_editdata($purchase_return_info['purchase_return_id']);
        $supplier_id = $purchase_return_info['supplier_id'];
        $supplier_list = $this->Suppliers->supplier_list();
        $supplier_selected = $this->Suppliers->supplier_search_item($supplier_id);
        $this->load->model('Wearhouses');
        $wearhouse_list = $this->Wearhouses->wearhouse_list();
        $store_list = $this->Stores->store_list();
        $variant_list = $this->Variants->variant_list();
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Purchases->retrieve_company();
        $data = array(
            'title' => display('purchase_return_edit'),
            'return_info' => $purchase_return_info,
            'return_all_data' => $return_detail,
            'supplier_name' => @$purchase_detail[0]['supplier_name'],
            'supplier_id' => $purchase_return_info['supplier_id'],
            'store_id' => $purchase_return_info['store_id'],
            'wearhouse_id' => @$purchase_detail[0]['wearhouse_id'],
            'variant_id' => @$purchase_detail[0]['variant_id'],
            'return_detail' => $purchase_return_info['details'],
            'purchase_id' => $purchase_return_info['purchase_id'],
            'return_all_data' => $return_detail,
            'purchase_info' => $purchase_detail,
            'supplier_list' => $supplier_list,
            'supplier_selected' => $supplier_selected,
            'wearhouse_list' => $wearhouse_list,
            'store_list' => $store_list,
            'variant_list' => $variant_list,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $data['setting'] = $this->Template_model->setting();
        $data['module'] = "dashboard";
        $data['page'] = 'purchase/purchase_return_edit';
        $this->parser->parse('template/layout', $data);
    }

    public function delete_purchase_return($purchase_return_id) {
        $purchase_return_info = $this->db->select('*')->from('product_purchase_return')->where('purchase_return_id', $purchase_return_id)->get()->row();
        $return_details = $this->db->select('*')->from('product_purchase_return_details')->where('return_id', $purchase_return_id)->get()->result_array();
        foreach ($return_details as $return) {
            $quantity = $return['quantity'];
            $batch_no = $return['batch_no'];
            // update product_purchase_details
            $purchase_quantity = $this->db->select('quantity')->from('product_purchase_details')->where('batch_no', $batch_no)->get()->row();
            $new_quantity = array(
                'quantity' => $purchase_quantity->quantity + $quantity
            );
            $result = $this->db->where('batch_no', $batch_no)->update('product_purchase_details', $new_quantity);
            // update product_purchase_details
            if ($result) {
                //transfer delete
                $this->db->delete('transfer', ['return_detail_id' => $return['id']]);
                //transfer delete
                // stock increase
                $check_stock = $this->check_stock($purchase_return_info->store_id, $return['product_id'], $return['variant_id'], $return['variant_color']);
                if (!empty($check_stock)) {
                    //update
                    $stock = array(
                        'quantity' => $check_stock->quantity + $return['quantity']
                    );
                    if (!empty($purchase_return_info->$store_id)) {
                        $this->db->where('store_id', $purchase_return_info->$store_id);
                    }
                    if (!empty($return['product_id'])) {
                        $this->db->where('product_id', $return['product_id']);
                    }
                    if (!empty($return['variant_id'])) {
                        $this->db->where('variant_id', $return['variant_id']);
                    }
                    if (!empty($return['variant_color'])) {
                        $this->db->where('variant_color', $return['variant_color']);
                    }
                    $this->db->update('purchase_stock_tbl', $stock);
                    //update
                }
                // stock increase
            }
        }
        $this->db->delete('product_purchase_return_details', ['return_id' => $purchase_return_id]);
        $this->db->delete('product_purchase_return', ['purchase_return_id' => $purchase_return_id]);

        $this->session->set_userdata(array('message' => display('successfully_deleted')));
        redirect('dashboard/Cpurchase_return/manage_purchase_return');
    }

}
