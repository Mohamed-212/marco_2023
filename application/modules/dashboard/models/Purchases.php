<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchases extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'dashboard/Products'
        ));
    }

    //Count purchase
    public function count_purchase()
    {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        return $query = $this->db->get()->num_rows();
    }

    //purchase List
    public function purchase_list()
    {
        $this->db->select('a.*, a.created_at as date_time,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('date_time', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Select All Supplier List
    public function select_all_supplier()
    {
        $query = $this->db->select('*')
            ->from('supplier_information')
            ->where('status', '1')
            ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Select All currency List
    public function select_all_currency()
    {
        $query = $this->db->select('*')
            ->from('currency_info')
            ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Get default currency info
    public function get_def_currency()
    {
        $this->db->select('*');
        $this->db->from('currency_info');
        $this->db->where('default_status', 1);
        $result = $this->db->get()->row_array();
        return $result;
    }

    //Purchase Search  List
    public function purchase_by_search($supplier_id)
    {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->where('b.supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
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

    //NUMBER GENERATOR
    public function number_generator()
    {
        $this->db->select('invoice', 'invoice_no');
        $query = $this->db->get('product_purchase');
        $result = $query->result_array();
        $invoice_no = count($result);
        if ($invoice_no >= 1 && $invoice_no < 2) {
            $invoice_no = 1000 + (($invoice_no == 1) ? 0 : $invoice_no) + 1;
        } elseif ($invoice_no >= 2) {
            $invoice_no = 1000 + (($invoice_no == 1) ? 0 : $invoice_no);
        } else {
            $invoice_no = 1000;
        }
        return $invoice_no;
    }

    //Purchase entry
    public function purchase_entry()
    {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {

                //Generator purchase id
                $purchase_id = $this->auth->generator(15);
                $p_id = $this->input->post('product_id', TRUE);
//                $batch = $this->input->post('batch_no', true);
//                $expiry = $this->input->post('expiry_date', true);
                $supplier_id = $this->input->post('supplier_id', TRUE);
                $quantity = $this->input->post('product_quantity', TRUE);
                $variant_id = $this->input->post('variant_id', TRUE);
                $color_variant = $this->input->post('color_variant', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $pur_order_no = $this->input->post('purchase_order', TRUE);
                $vat_rate = $this->input->post('vat_rate', TRUE);
                $vat = $this->input->post('vat', TRUE);
//                $color = $this->input->post('colorv', TRUE);
                $size = $this->input->post('sizev', TRUE);
                $cat_id = $this->input->post('category_id', TRUE);
                //start for total discount
                //إجمالي الخصم على مستوى الفاتورة
                $total_discount = floatval($this->input->post('total_purchase_dis', TRUE));
                //إجمالي الفاتورة بعد الخصم الخاص بكل منتج و قبل الضريبة
                $sub_total = floatval($this->input->post('sub_total_price', TRUE));
                // توزيع الخصم على إجمالي الفاتورة لمعرفة نسبة الخصم
                $ratio = $sub_total > 0 ? $total_discount / $sub_total : 0;
                //End for total discount
                //
                //
                //start for total Expense & VAT
                //إجمالي المصاريف على مستوى الفاتورة
                $total_expence = floatval($this->input->post('purchase_expences', TRUE));
                //إجمالي الضريبة على مستوى الفاتورة
                $total_vat = floatval($this->input->post('total_purchase_vat', TRUE));
                //إجمالي الفاتورة بدون  VAT
                $grand_total_without_VAT = floatval($this->input->post('grand_total_price', TRUE) - $total_vat);
                // توزيع المصاريف على إجمالي الفاتورة لمعرفة نسبة الخصم
                $ratio_expence = $grand_total_without_VAT > 0 ? ($total_expence + $total_vat) / $grand_total_without_VAT : 0;
                //End for total Expense & VAT
                //
                ///// حساب ضريبة القيمة المضافة على النظارات الشمسية //////
                //قيمة ضريبة النظارات الشمسية
                $t_price = $this->input->post('total_price', TRUE);
                $sunglasses_VAT = floatval($this->input->post('sunglasses_vat', TRUE));
                //حساب إجمالي تكلفة النظارات الشمسية 
                $total_sunglasses_price = 0;
                foreach ($p_id as $key => $value) {
                    if (!empty($p_id[$key]) && !empty($p_id[$key])) {

                        if ($cat_id[$key] == '3D8ELDWLSMLAAZL') {
                            $total_price = $t_price[$key];
                            $total_sunglasses_price = $total_sunglasses_price + $total_price;
                        }
                    }
                }
                ////////حساب قيمة الضريبة من إجمالي النظارات الشمسية
                $value_vat_sunglasses = $total_sunglasses_price * ($sunglasses_VAT / 100);
                ///// توزيع الضريبة على إجمالي النظارات لمعرفة نسبة الزيادة
                if ($total_sunglasses_price <= 0) {
                    $ratio_sunglasses = 0;
                } else {
                    $ratio_sunglasses = $value_vat_sunglasses / $total_sunglasses_price;
                }
                //
                //insert sun vat to expense table
                //
                if ($sunglasses_VAT > 0) {
                    $sun_vat = array(
                        'purchase_id' => $purchase_id,
                        'expense_title' => 'sunglasses-VAT',
                        'purchase_expense' => $value_vat_sunglasses,
                        'payment_method' => 'cash',
                    );
                    $this->db->insert('proof_of_purchase_expese', $sun_vat);
                }

                //
                //
                // Supplier & product id relation ship checker.
                for ($i = 1, $n = count($p_id); $i <= $n; $i++) {
                    $product_id = $p_id[$i];
                    $value = $this->product_supplier_check($product_id, $supplier_id);
                    if ($value == 0) {
                        $this->session->set_userdata(array('error_message' => display("product_and_supplier_did_not_match")));
                        redirect(base_url('dashboard/Cpurchase'));
                    }
                }
                //Variant id required check
                $result = array();
                //                foreach ($p_id as $k => $v) {
                //                    if (empty($variant_id[$k])) {
                //                        $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                //                        redirect('dashboard/Cpurchase');
                //                    }
                //                }
                //proof of purchase expense 
                $cost_sectors = $this->input->post('bank_id', TRUE);
                if (!empty($cost_sectors)) {
                    $purchase_costs = array();
                    foreach ($cost_sectors as $key => $sector) {
                        $expense_title = $this->input->post('purchase_expences_title_' . ($key + 1));
                        $purchase_expense = $this->input->post('purchase_expences_' . ($key + 1));
                        if (!empty($purchase_expense)) {
                            $purchase_costs[] = array(
                                'purchase_id' => $purchase_id,
                                'expense_title' => $expense_title,
                                'purchase_expense' => $purchase_expense,
                                'payment_method' => $sector,
                            );
                        }
                    }
                    if (!empty($purchase_costs)) {
                        $this->db->insert_batch('proof_of_purchase_expese', $purchase_costs);
                    }
                }

                // upload attachment file
                // load upload library for file uploading
                $config['upload_path']          = './my-assets/attachments/';
                $config['allowed_types']        = '*';
                $config['encrypt_name'] = true;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $upload_data = ['file' => null];

//                if (!$this->upload->do_upload('file')) {
//                    $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
//                    redirect(base_url('dashboard/Cpurchase'));
//                } else {
//                    $upload_data = array('file' => $this->upload->data());
//                }
                if ($this->upload->do_upload('file')) {
                    $upload_data = array('file' => $this->upload->data());
                }

                //Add Product To Purchase Table
                $data = array(
                    'purchase_id' => $purchase_id,
                    'invoice_no' => $this->input->post('invoice_no', TRUE),
                    'pur_order_no' => $pur_order_no,
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'def_currency_id' => $this->input->post('def_currency_id', TRUE),
                    'currency_id' => $this->input->post('currency_id', TRUE),
                    'conversion_rate' => $this->input->post('conversion', TRUE),
                    'invoice' => 'Inv-' . $this->number_generator(),
                    'wearhouse_id' => '',
                    'sub_total_price' => $this->input->post('sub_total_price', TRUE),
                    'total_items' => $this->input->post('total_number_of_items', TRUE),
                    'purchase_vat' => $this->input->post('purchase_vat', TRUE),
                    'total_purchase_vat' => $this->input->post('total_purchase_vat', TRUE),
                    'total_purchase_dis' => $total_discount,
                    'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
                    'purchase_date' => $this->input->post('purchase_date', TRUE),
                    'purchase_details' => $this->input->post('purchase_details', TRUE),
                    'purchase_expences' => $this->input->post('purchase_expences', TRUE),
                    'user_id' => $this->session->userdata('user_id'),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s', strtotime($this->input->post('purchase_date', TRUE))),
                    'file' => isset($upload_data['file']) && isset($upload_data['file']['file_name']) ? 'my-assets/attachments/' . $upload_data['file']['file_name'] : null,
                );
                $this->db->insert('product_purchase', $data);
                $datac4 = array(
                    'convertion_rate' => $this->input->post('conversion', TRUE),
                );
                $this->db->update('currency_info', $datac4, array('currency_id' => $this->input->post('currency_id', TRUE)));
                //Add Product To Supplier Ledger
                $ledger = array(
                    'transaction_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'invoice_no' => $this->input->post('invoice_no', TRUE),
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
                    'amount' => $this->input->post('grand_total_price', TRUE),
                    'date' => date('d-m-Y', strtotime($this->input->post('purchase_date', TRUE))),
                    'description' => $this->input->post('purchase_details', FALSE),
                    'status' => 1,
                    'sl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE) . date('H:i:s'))),
                    'deposit_no' =>  $this->auth->generator(10)
                );
                $this->db->insert('supplier_ledger', $ledger);
                //Product Purchase Details
                $rate = $this->input->post('product_rate', TRUE);
                $t_price = $this->input->post('total_price', TRUE);
                $total_price_without_discount = 0;

                foreach ($p_id as $i => $value) {
                    if (!empty($p_id[$i]) && !empty($p_id[$i])) {
                        $product_quantity = $quantity[$i];
                        $product_rate = $rate[$i];
                        $product_id = $p_id[$i];
//                        $batch_no = $batch[$i];
//                        $expiry_date = $expiry[$i];
                        $total_price = $t_price[$i];
                        // $variant = $variant_id[$i];
                        $variant = $size[$i];
                        // $variant_color = @$color_variant[$i];
//                        $variant_color = $color[$i];
                        $product_discount = $discount[$i];
                        $total_price_without_discount += ($rate[$i] * $quantity[$i]);
                        $category_id = $cat_id[$i];

                        // todo
                        if ($category_id == '3D8ELDWLSMLAAZL') {
                            //start for total sunglasses VAT
                            //ضرب نسبة الضريبة في إجمالي الصنف بعد المصاريف لمعرفة مقدار الزيادة في  كل صنف
                            $total_price_sunvat = $ratio_sunglasses * $total_price;
                            //تحديد إجمالي سعر المنتج بعد الزيادة
                            $total_price_after_sunvat = $total_price + $total_price_sunvat;
                            //تحديد سعر المنتج الواحد بعد الزيادة
                            $rate4 = $total_price_after_sunvat / $product_quantity;
                            //End for total sunglasses VAT
                        } else {
                            $rate4 = $product_rate;
                            $total_price_after_sunvat = $total_price;
                        }

                        //start for total discount
                        //ضرب نسبة الخصم في إجمالي الصنف لمعرفة مقدار الخصم من كل صنف
                        $total_price_dis = $ratio * $total_price_after_sunvat;
                        //تحديد إجمالي سعر المنتج بعد الخصم
                        $total_price_after_dis = $total_price_after_sunvat - $total_price_dis;
                        //تحديد سعر المنتج الواحد بعد الخصم
                        $rate2 = $total_price_after_dis / $product_quantity;
                        //End for total discount
                        //start for total Expense & VAT
                        //ضرب نسبة المصروف في إجمالي الصنف بعد الخصم لمعرفة مقدار الزيادة في  كل صنف
                        $total_price_exp = $ratio_expence * $total_price_after_dis;
                        //تحديد إجمالي سعر المنتج بعد الزيادة
                        $total_price_after_exp = $total_price_after_dis + $total_price_exp;
                        //تحديد سعر المنتج الواحد بعد الزيادة
                        $rate3 = $total_price_after_exp / $product_quantity;
                        //End for total Expense & VAT


                        $i_vat_rate = $vat_rate[$i];
                        $i_vat = $vat[$i];
                        $data1 = array(
                            'purchase_detail_id' => $this->auth->generator(15),
                            'purchase_id' => $purchase_id,
                            'product_id' => $product_id,
//                            'batch_no' => $batch_no,
                            'expiry_date' => '',
                            'wearhouse_id' => '',
                            'store_id' => $this->input->post('store_id', TRUE),
                            'quantity' => $product_quantity,
                            'rate' => $product_rate,
                            'rate_after_discount' => (float)$rate2,
                            'rate_after_exp' => (float)$rate3,
                            'rate_after_sunvat' => (float)$rate4,
                            'category_id' => $category_id,
                            'discount' => $product_discount,
                            'vat_rate' => $i_vat_rate,
                            'vat' => $i_vat,
                            'total_amount' => $total_price,
                            'variant_id' => $variant,
                            // 'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
//                            'variant_color' => $variant_color,
                            'status' => 1
                        );

                        if (!empty($quantity)) {
                            $this->db->insert('product_purchase_details', $data1);
                            //////////////////////////////////////////////////////////////
                            $this->db->where('product_id', $product_id);
                            $this->db->from('product_information');
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
                            }
                            $totalPrcsAmnt += ($product[0]['open_quantity'] * $product[0]['open_rate']);
                            $totalPurchase += $product[0]['open_quantity'];
                            $newrate = $totalPrcsAmnt / $totalPurchase;
                            $supplier_price = array(
                                'supplier_price' => $newrate,
                            );

                            $this->Products->update_product($supplier_price, $product_id);
                            // $this->db->where('product_id', $product_id);
                            // $this->db->update('product_information', $supplier_price);

                            $supplier_price2 = array(
                                'child_product_price' => $newrate,
                            );
                            $this->db->where('child_product_id', $product_id);
                            $this->db->update('assembly_products', $supplier_price2);

                            /////////////////////////////////////////////////////////////////
                        }
                        $store = array(
                            'transfer_id' => $this->auth->generator(15),
                            'purchase_id' => $purchase_id,
                            'store_id' => $this->input->post('store_id', TRUE),
                            'product_id' => $product_id,
                            'variant_id' => $variant,
//                            'variant_color' => $variant_color,
                            'date_time' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE))),
                            'quantity' => $product_quantity,
                            'status' => 3
                        );
                        if (!empty($quantity)) {
                            $this->db->insert('transfer', $store);
                            // stock 
                            $store_id = $this->input->post('store_id', TRUE);
                            $check_stock = $this->check_stock($store_id, $product_id, $variant, null);
                            if (empty($check_stock)) {
                                // insert
                                $stock = array(
                                    'store_id' => $store_id,
                                    'product_id' => $product_id,
                                    'variant_id' => $variant,
//                                    'variant_color' => $variant_color,
                                    'quantity' => $product_quantity,
                                    'warehouse_id' => '',
                                    'created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE))),
                                );
                                $this->db->insert('purchase_stock_tbl', $stock);
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
//                                if (!empty($variant_color)) {
//                                    $this->db->where('variant_color', $variant_color);
//                                }
                                $this->db->update('purchase_stock_tbl', $stock);
                                //update
                            }
                            // stock
                        }
                    }
                }

                $this->load->model('accounting/account_model');
                $supplier_id = $this->input->post('supplier_id', TRUE);
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
                $supplier_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                if (empty($supplier_head)) {
                    $PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', '2111')->get()->row();
                    if (!empty($PHead)) {
                        $childCount = $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode', '2111')->get()->row();
                        if (!empty($childCount->HeadCode)) {
                            $HeadCode = $childCount->HeadCode + 1;
                        } else {
                            $HeadCode = '21111';
                        }
                        $supplier_name = $this->db->select('supplier_name')->from('supplier_information')->where('supplier_id', $supplier_id)->get()->row();
                        $acc_coa = array(
                            'HeadCode' => $HeadCode,
                            'HeadName' => $supplier_name->supplier_name,
                            'PHeadName' => $PHead->HeadName,
                            'PHeadCode' => $PHead->HeadCode,
                            'HeadLevel' => 4,
                            'IsActive' => 1,
                            'IsTransaction' => 1,
                            'IsGL' => 0,
                            'HeadType' => 'L',
                            'supplier_id' => $supplier_id,
                            'CreateBy' => $this->session->userdata('user_id'),
                            'CreateDate' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('acc_coa', $acc_coa);
                        $supplier_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                    }
                }
                $createdate = date('Y-m-d H:i:s');
                $receive_by = $this->session->userdata('user_id');
                $date = $createdate;

                $total_price_before_discount = $total_price_without_discount;
                $total_purchase_vat = $this->input->post('total_purchase_vat', TRUE);
                $total_price_with_vat = $this->input->post('grand_total_price', TRUE);
                $total_purchase_discount = $total_price_before_discount - ($total_price_with_vat - $total_purchase_vat);
                $purchase_expence = $this->input->post('purchase_expences', TRUE);

                //1st Main warehouse Debit (total_price_before_discount)
                $main_warehouse_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1141, //Main Warehouse
                    'Narration' => 'Purchase total price before discount debit by Main warehouse',
                    'Debit' => $total_price_before_discount,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //2nd (vat on input) Debit
                $vat = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 116,
                    'Narration' => 'Purchase vat/tax total debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => $total_purchase_vat,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //3rd supplier credit (total_price_with_vat or grand_total_price)
                $suppliercredit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => $supplier_head->HeadCode,
                    'Narration' => 'Purchase "total_price_with_vat" credited by supplier: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_price_with_vat,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );

                //4th total_purchase_discount credit
                $discount = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 521,
                    'Narration' => 'Purchase total discount credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_purchase_discount,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //5th proof of purchase expences Main warehouse Debit (purchase_expence)
                $debit_purchase_expences_inventory = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1141,
                    'Narration' => 'Purchase expence proof (Main warehouse) debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => $purchase_expence,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //6th Cash in box general administration credit
                $credit_purchase_expences = array();
                $p_cost_sectors = $this->input->post('bank_id', TRUE);
                if (!empty($p_cost_sectors)) {
                    foreach ($p_cost_sectors as $key => $sector) {
                        $ind_purchase_expence = $this->input->post('purchase_expences_' . ($key + 1));
                        if (!empty($ind_purchase_expence)) {
                            if ($sector == 'cash') {
                                $credit_purchase_expences[] = array(
                                    'fy_id' => $find_active_fiscal_year->id,
                                    'VNo' => 'p-' . $purchase_id,
                                    'Vtype' => 'Purchase',
                                    'VDate' => $date,
                                    'COAID' => 1111,
                                    'Narration' => 'Purchase expence proof (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                                    'Debit' => 0,
                                    'Credit' => $ind_purchase_expence,
                                    'IsPosted' => 1,
                                    'CreateBy' => $receive_by,
                                    'CreateDate' => $createdate,
                                    'store_id' => $store_id,
                                    'IsAppove' => 1
                                );
                            } else {
                                $bank_id = $sector;
                                $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('bank_id', $bank_id)->get()->row();
                                if (empty($bank_head)) {
                                    $this->load->model('accounting/account_model');
                                    $bank_name = $this->db->select('bank_name')->from('bank_list')->where('bank_id', $bank_id)->get()->row();
                                    if ($bank_name) {
                                        $bank_data = array(
                                            'bank_id' => $bank_id,
                                            'bank_name' => $bank_name->bank_name,
                                        );
                                        $this->account_model->insert_bank_head($bank_data);
                                    }
                                    $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('bank_id', $bank_id)->get()->row();
                                }
                                $credit_purchase_expences[] = array(
                                    'fy_id' => $find_active_fiscal_year->id,
                                    'VNo' => 'p-' . $purchase_id,
                                    'Vtype' => 'Purchase',
                                    'VDate' => $date,
                                    'COAID' => $bank_head->HeadCode,
                                    'Narration' => 'Purchase expence proof bank credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                                    'Debit' => 0,
                                    'Credit' => $ind_purchase_expence,
                                    'IsPosted' => 1,
                                    'CreateBy' => $receive_by,
                                    'CreateDate' => $createdate,
                                    'store_id' => $store_id,
                                    'IsAppove' => 1
                                );
                            }
                        }
                    }

                    if (!empty($credit_purchase_expences)) {
                        $this->db->insert_batch('acc_transaction', $credit_purchase_expences);
                    }
                } else {
                    $credit_purchase_expences = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'p-' . $purchase_id,
                        'Vtype' => 'Purchase',
                        'VDate' => $date,
                        'COAID' => 1111,
                        'Narration' => 'Purchase expence proof (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                        'Debit' => 0,
                        'Credit' => $purchase_expence,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'store_id' => $store_id,
                        'IsAppove' => 1
                    );
                    $this->db->insert('acc_transaction', $credit_purchase_expences);
                }
                $credit_purchase_sunvat = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1111,
                    'Narration' => 'Purchase sunglasses VAT (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $value_vat_sunglasses,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                $this->db->insert('acc_transaction', $credit_purchase_sunvat);

                $this->db->insert('acc_transaction', $main_warehouse_debit);
                $this->db->insert('acc_transaction', $suppliercredit);
                $this->db->insert('acc_transaction', $vat);
                $this->db->insert('acc_transaction', $discount);
                $this->db->insert('acc_transaction', $debit_purchase_expences_inventory);

                // Woocommerce module stock update
                $woocom_stock = $this->input->post('woocom_stock', TRUE);
                if (check_module_status('woocommerce') && ($woocom_stock == '1')) {

                    $this->load->library('woocommerce/woolib/woo_lib');
                    $this->load->model('woocommerce/woo_model');
                    $this->woo_lib->connection();
                    $def_store = $this->woo_model->get_def_store();

                    $woo_stock = [];
                    for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                        $product_quantity = $quantity[$i];
                        $product_id = $p_id[$i];
                        $variant = $variant_id[$i];
                        $fulldata = $woo_data = [];
                        $product_stock = 0;


                        $prodinfo = $this->woo_model->get_product_sync_by_local_id($product_id);

                        if (!empty($prodinfo)) {
                            if ($prodinfo->woo_product_type == 'variable') {

                                $varinfo = $this->woo_model->get_variant_sync_by_local($product_id, $variant);

                                if (!empty($varinfo->woo_product_id) && !empty($varinfo->woo_variant_id)) {

                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $variant);

                                    $woo_data[] = array(
                                        'id' => $varinfo->woo_variant_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );

                                    if (!empty($woo_data)) {
                                        $fulldata['update'] = $woo_data;
                                        $woovarinfo = $this->woo_lib->post_request(array('param' => 'products/' . $varinfo->woo_product_id . '/variations/batch'), $fulldata);
                                    }
                                }
                            } else {

                                $pdef_info = $this->woo_model->get_product_variant_info($product_id);

                                if (!empty($pdef_info)) {

                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $pdef_info->default_variant);

                                    $woo_stock[] = array(
                                        'id' => $prodinfo->woo_product_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );
                                }
                            }
                        }
                    }
                    if (!empty($woo_stock)) { //update global stock
                        $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                    }
                }
                return true;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect('dashboard/Cpurchase');
            }
        } else {
            //Generator purchase id
            $purchase_id = $this->auth->generator(15);
            $p_id = $this->input->post('product_id', TRUE);
            $batch = $this->input->post('batch_no', true);
            $expiry = $this->input->post('expiry_date', true);
            $supplier_id = $this->input->post('supplier_id', TRUE);
            $quantity = $this->input->post('product_quantity', TRUE);
            $variant_id = $this->input->post('variant_id', TRUE);
            $variant_id = $this->input->post('variant_id', TRUE);
            $color_variant = $this->input->post('color_variant', TRUE);
            $discount = $this->input->post('discount', TRUE);

            // Supplier & product id relation ship checker.
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_id = $p_id[$i];
                $value = $this->product_supplier_check($product_id, $supplier_id);
                if ($value == 0) {
                    $this->session->set_userdata(array('error_message' => display("product_and_supplier_did_not_match")));
                    redirect(base_url('dashboard/Cpurchase'));
                }
            }
            //Variant id required check
            $result = array();
            foreach ($p_id as $k => $v) {
                if (empty($variant_id[$k])) {
                    $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                    redirect('dashboard/Cpurchase');
                }
            }
            //Add Product To Purchase Table
            $data = array(
                'purchase_id' => $purchase_id,
                'invoice_no' => $this->input->post('invoice_no', TRUE),
                'supplier_id' => $this->input->post('supplier_id', TRUE),
                'store_id' => $this->input->post('store_id', TRUE),
                'wearhouse_id' => '',
                'sub_total_price' => $this->input->post('sub_total_price', TRUE),
                'total_items' => $this->input->post('total_number_of_items', TRUE),
                'purchase_vat' => $this->input->post('purchase_vat', TRUE),
                'total_purchase_vat' => $this->input->post('total_purchase_vat', TRUE),
                'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
                'purchase_date' => $this->input->post('purchase_date', TRUE),
                'purchase_details' => $this->input->post('purchase_details', TRUE),
                'purchase_expences' => $this->input->post('purchase_expences', TRUE),
                'user_id' => $this->session->userdata('user_id'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE))),
            );
            $this->db->insert('product_purchase', $data);
            //Add Product To Supplier Ledger
            $ledger = array(
                'transaction_id' => $this->auth->generator(15),
                'purchase_id' => $purchase_id,
                'invoice_no' => $this->input->post('invoice_no', TRUE),
                'supplier_id' => $this->input->post('supplier_id', TRUE),
                'amount' => $this->input->post('grand_total_price', TRUE),
                'date' => date('d-m-Y', strtotime($this->input->post('purchase_date', TRUE))),
                'description' => $this->input->post('purchase_details', FALSE),
                'status' => 1,
                'sl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE))),
                'deposit_no' =>  $this->auth->generator(10)
            );
            $this->db->insert('supplier_ledger', $ledger);
            //Product Purchase Details
            $rate = $this->input->post('product_rate', TRUE);
            $t_price = $this->input->post('total_price', TRUE);
            $total_price_without_discount = 0;
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_quantity = $quantity[$i];
                $product_rate = $rate[$i];
                $product_id = $p_id[$i];
                $batch_no = $batch[$i];
                $expiry_date = $expiry[$i];
                $total_price = $t_price[$i];
                $variant = $variant_id[$i];
                $variant_color = $color_variant[$i];
                $product_discount = $discount[$i];
                $total_price_without_discount += ($rate[$i] * $quantity[$i]);
                $data1 = array(
                    'purchase_detail_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'product_id' => $product_id,
                    'batch_no' => $batch_no,
                    'expiry_date' => date('Y-m-d', strtotime($expiry_date)),
                    'wearhouse_id' => '',
                    'store_id' => $this->input->post('store_id', TRUE),
                    'quantity' => $product_quantity,
                    'rate' => $product_rate,
                    'discount' => $product_discount,
                    'total_amount' => $total_price,
                    'variant_id' => $variant,
                    'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                    'status' => 1
                );

                if (!empty($quantity)) {
                    $this->db->insert('product_purchase_details', $data1);
                }
                $store = array(
                    'transfer_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'store_id' => $this->input->post('store_id', TRUE),
                    'product_id' => $product_id,
                    'variant_id' => $variant,
                    'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                    'date_time' => $this->input->post('purchase_date', TRUE),
                    'quantity' => $product_quantity,
                    'status' => 3
                );
                if (!empty($quantity)) {
                    $this->db->insert('transfer', $store);
                    // stock 
                    $store_id = $this->input->post('store_id', TRUE);
                    $check_stock = $this->check_stock($store_id, $product_id, $variant, $variant_color);
                    if (empty($check_stock)) {
                        // insert
                        $stock = array(
                            'store_id' => $store_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant,
                            'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                            'quantity' => $product_quantity,
                            'warehouse_id' => '',
                            'created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE))),
                        );
                        $this->db->insert('purchase_stock_tbl', $stock);
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
                        $this->db->update('purchase_stock_tbl', $stock);
                        //update
                    }
                    // stock
                }
            }
            // Woocommerce module stock update
            $woocom_stock = $this->input->post('woocom_stock', TRUE);
            if (check_module_status('woocommerce') && ($woocom_stock == '1')) {

                $this->load->library('woocommerce/woolib/woo_lib');
                $this->load->model('woocommerce/woo_model');
                $this->woo_lib->connection();
                $def_store = $this->woo_model->get_def_store();

                $woo_stock = [];
                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_quantity = $quantity[$i];
                    $product_id = $p_id[$i];
                    $variant = $variant_id[$i];
                    $fulldata = $woo_data = [];
                    $product_stock = 0;

                    $prodinfo = $this->woo_model->get_product_sync_by_local_id($product_id);

                    if (!empty($prodinfo)) {
                        if ($prodinfo->woo_product_type == 'variable') {
                            $varinfo = $this->woo_model->get_variant_sync_by_local($product_id, $variant);
                            if (!empty($varinfo->woo_product_id) && !empty($varinfo->woo_variant_id)) {
                                $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $variant);
                                $woo_data[] = array(
                                    'id' => $varinfo->woo_variant_id,
                                    'manage_stock' => TRUE,
                                    'stock_quantity' => $product_stock,
                                    'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                );
                                if (!empty($woo_data)) {
                                    $fulldata['update'] = $woo_data;
                                    $woovarinfo = $this->woo_lib->post_request(array('param' => 'products/' . $varinfo->woo_product_id . '/variations/batch'), $fulldata);
                                }
                            }
                        } else {
                            $pdef_info = $this->woo_model->get_product_variant_info($product_id);
                            if (!empty($pdef_info)) {
                                $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $pdef_info->default_variant);
                                $woo_stock[] = array(
                                    'id' => $prodinfo->woo_product_id,
                                    'manage_stock' => TRUE,
                                    'stock_quantity' => $product_stock,
                                    'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                );
                            }
                        }
                    }
                }
                if (!empty($woo_stock)) { //update global stock
                    $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                }
            }
            return true;
        }
    }

    //Purchase order entry
    public function purchase_order_receive_entry()
    {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                //Generator purchase id
                $purchase_id = $this->auth->generator(15);
                $p_id = $this->input->post('product_id', TRUE);
                $batch = $this->input->post('batch_no', true);
                $expiry = $this->input->post('expiry_date', true);
                $supplier_id = $this->input->post('supplier_id', TRUE);
                $quantity = $this->input->post('product_quantity', TRUE);
                $variant_id = $this->input->post('variant_id', TRUE);
                $color_variant = $this->input->post('color_variant', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $pur_order_no = $this->input->post('purchase_order', TRUE);
                $vat_rate = $this->input->post('vat_rate', TRUE);
                $vat = $this->input->post('vat', TRUE);
                $color = $this->input->post('colorv', TRUE);
                $size = $this->input->post('sizev', TRUE);
                $cat_id = $this->input->post('category_id', TRUE);

                //start for total discount
                //إجمالي الخصم على مستوى الفاتورة
                $total_discount = floatval($this->input->post('total_purchase_dis', TRUE));
                //إجمالي الفاتورة بعد الخصم الخاص بكل منتج و قبل الضريبة
                $sub_total = floatval($this->input->post('sub_total_price', TRUE));
                // توزيع الخصم على إجمالي الفاتورة لمعرفة نسبة الخصم
                $ratio = $total_discount / $sub_total;
                //End for total discount
                //
                //
                //start for total Expense & VAT
                //إجمالي المصاريف على مستوى الفاتورة
                $total_expence = floatval($this->input->post('purchase_expences', TRUE));
                //إجمالي الضريبة على مستوى الفاتورة
                $total_vat = floatval($this->input->post('total_purchase_vat', TRUE));
                //إجمالي الفاتورة بدون  VAT
                $grand_total_without_VAT = floatval($this->input->post('grand_total_price', TRUE) - $total_vat);
                // توزيع المصاريف على إجمالي الفاتورة لمعرفة نسبة الزيادة
                $ratio_expence = ($total_expence + $total_vat) / $grand_total_without_VAT;
                //End for total Expense & VAT
                //
                //
                ///// حساب ضريبة القيمة المضافة على النظارات الشمسية //////
                //قيمة ضريبة النظارات الشمسية
                $t_price = $this->input->post('total_price', TRUE);
                $sunglasses_VAT = floatval($this->input->post('sunglasses_vat', TRUE));
                //حساب إجمالي تكلفة النظارات الشمسية 
                $total_sunglasses_price = 0;
                foreach ($p_id as $key => $value) {
                    if (!empty($p_id[$key]) && !empty($p_id[$key])) {

                        if ($cat_id[$key] == '3D8ELDWLSMLAAZL') {
                            $total_price = $t_price[$key];
                            $total_sunglasses_price = $total_sunglasses_price + $total_price;
                        }
                    }
                }
                ////////حساب قيمة الضريبة من إجمالي النظارات الشمسية
                $value_vat_sunglasses = $total_sunglasses_price * ($sunglasses_VAT / 100);
                ///// توزيع الضريبة على إجمالي النظارات لمعرفة نسبة الزيادة
                $ratio_sunglasses = 0;
                if ($total_sunglasses_price > 0) {
                    $ratio_sunglasses = $value_vat_sunglasses / $total_sunglasses_price;
                }
                //
                //insert sun vat to expense table
                //
                if ($sunglasses_VAT > 0) {
                    $sun_vat = array(
                        'purchase_id' => $purchase_id,
                        'expense_title' => 'sunglasses-VAT',
                        'purchase_expense' => $value_vat_sunglasses,
                        'payment_method' => 'cash',
                    );
                    $this->db->insert('proof_of_purchase_expese', $sun_vat);
                }
                //
                //
                //Variant id required check
                $result = array();
                //                foreach ($p_id as $k => $v) {
                //                    if (empty($variant_id[$k])) {
                //                        $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                //                        redirect('dashboard/Cpurchase');
                //                    }
                //                }
                //proof of purchase expense 
                $cost_sectors = $this->input->post('bank_id', TRUE);
                if (!empty($cost_sectors)) {
                    $purchase_costs = array();
                    foreach ($cost_sectors as $key => $sector) {
                        $expense_title = $this->input->post('purchase_expences_title_' . ($key + 1));
                        $purchase_expense = $this->input->post('purchase_expences_' . ($key + 1));
                        if (!empty($purchase_expense)) {
                            $purchase_costs[] = array(
                                'purchase_id' => $purchase_id,
                                'expense_title' => $expense_title,
                                'purchase_expense' => $purchase_expense,
                                'payment_method' => $sector,
                            );
                        }
                    }
                    if (!empty($purchase_costs)) {
                        $this->db->insert_batch('proof_of_purchase_expese', $purchase_costs);
                    }
                }


                //Add Product To Purchase Table
                $data = array(
                    'purchase_id' => $purchase_id,
                    'invoice_no' => $this->input->post('invoice_no', TRUE),
                    'pur_order_no' => $pur_order_no,
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'def_currency_id' => $this->input->post('def_currency_id', TRUE),
                    'currency_id' => $this->input->post('currency_id', TRUE),
                    'conversion_rate' => $this->input->post('conversion_rate', TRUE),
                    'invoice' => 'Inv-' . $this->number_generator(),
                    'wearhouse_id' => '',
                    'sub_total_price' => $this->input->post('sub_total_price', TRUE),
                    'total_items' => $this->input->post('total_number_of_items', TRUE),
                    'purchase_vat' => $this->input->post('purchase_vat', TRUE),
                    'total_purchase_vat' => $this->input->post('total_purchase_vat', TRUE),
                    'total_purchase_dis' => $total_discount,
                    'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
                    'purchase_date' => $this->input->post('purchase_date', TRUE),
                    'purchase_details' => $this->input->post('purchase_details', TRUE),
                    'purchase_expences' => $this->input->post('purchase_expences', TRUE),
                    'user_id' => $this->session->userdata('user_id'),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s')
                );
                $this->db->insert('product_purchase', $data);

                $datac4 = array(
                    'convertion_rate' => $this->input->post('conversion_rate', TRUE),
                );
                $this->db->update('currency_info', $datac4, array('currency_id' => $this->input->post('currency_id', TRUE)));

                //Add Product To Supplier Ledger
                $ledger = array(
                    'transaction_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'deposit_no'    =>  $this->auth->generator(10),
                    'invoice_no' => $this->input->post('invoice_no', TRUE),
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
                    'amount' => $this->input->post('grand_total_price', TRUE),
                    'date' => date('d-m-Y', strtotime($this->input->post('purchase_date', TRUE))),
                    'description' => $this->input->post('purchase_details', FALSE),
                    'status' => 1,
                    'sl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE))),
                );
                $this->db->insert('supplier_ledger', $ledger);
                //Product Purchase Details
                $rate = $this->input->post('product_rate', TRUE);

                $total_price_without_discount = 0;
                //  for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                foreach ($p_id as $key => $value) {
                    if (!empty($p_id[$key]) && !empty($p_id[$key])) {
                        $product_quantity = $quantity[$key];
                        $product_rate = $rate[$key];
                        $product_id = $p_id[$key];
                        $batch_no = $batch[$key];
                        $expiry_date = $expiry[$key];
                        $total_price = $t_price[$key];
                        // $variant = $variant_id[$i];
                        $variant = $size[$key];
                        // $variant_color = @$color_variant[$i];
                        $variant_color = $color[$key];
                        $product_discount = $discount[$key];
                        $total_price_without_discount += ($rate[$key] * $quantity[$key]);
                        $category_id = $cat_id[$key];

                        if ($category_id == '3D8ELDWLSMLAAZL') {
                            //start for total sunglasses VAT
                            //ضرب نسبة الضريبة في إجمالي الصنف بعد المصاريف لمعرفة مقدار الزيادة في  كل صنف
                            $total_price_sunvat = $ratio_sunglasses * $total_price;
                            //تحديد إجمالي سعر المنتج بعد الزيادة
                            $total_price_after_sunvat = $total_price + $total_price_sunvat;
                            //تحديد سعر المنتج الواحد بعد الزيادة
                            $rate4 = $total_price_after_sunvat / $product_quantity;
                            //End for total sunglasses VAT
                        } else {
                            $rate4 = $product_rate;
                            $total_price_after_sunvat = $total_price;
                        }
                        //start for total discount
                        //ضرب نسبة الخصم في إجمالي الصنف لمعرفة مقدار الخصم من كل صنف
                        $total_price_dis = $ratio * $total_price_after_sunvat;
                        //تحديد إجمالي سعر المنتج بعد الخصم
                        $total_price_after_dis = $total_price_after_sunvat - $total_price_dis;
                        //تحديد سعر المنتج الواحد بعد الخصم
                        $rate2 = $total_price_after_dis / $product_quantity;
                        //End for total discount
                        //start for total Expense & VAT
                        //ضرب نسبة المصروف في إجمالي الصنف بعد الخصم لمعرفة مقدار الزيادة في  كل صنف
                        $total_price_exp = $ratio_expence * $total_price_after_dis;
                        //تحديد إجمالي سعر المنتج بعد الزيادة
                        $total_price_after_exp = $total_price_after_dis + $total_price_exp;
                        //تحديد سعر المنتج الواحد بعد الزيادة
                        $rate3 = $total_price_after_exp / $product_quantity;
                        //End for total Expense & VAT
                        //


                        $i_vat_rate = $vat_rate[$key];
                        $i_vat = $vat[$key];
                        $data1 = array(
                            'purchase_detail_id' => $this->auth->generator(15),
                            'purchase_id' => $purchase_id,
                            'product_id' => $product_id,
                            'batch_no' => $batch_no,
                            'expiry_date' => !empty($expiry_date) ? date('Y-m-d', strtotime($expiry_date)) : '',
                            'wearhouse_id' => '',
                            'store_id' => $this->input->post('store_id', TRUE),
                            'quantity' => $product_quantity,
                            'rate' => $product_rate,
                            'rate_after_discount' => $rate2,
                            'rate_after_exp' => $rate3,
                            'rate_after_sunvat' => $rate4,
                            'category_id' => $category_id,
                            'discount' => $product_discount,
                            'vat_rate' => $i_vat_rate,
                            'vat' => $i_vat,
                            'total_amount' => $total_price,
                            'variant_id' => $variant,
                            // 'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                            'variant_color' => $variant_color,
                            'status' => 1
                        );

                        if (!empty($quantity)) {
                            $this->db->insert('product_purchase_details', $data1);
                            ///////////////////////////حساب متوسط سعر الشراء//////////////////
                            $this->db->where('product_id', $product_id);
                            $this->db->from('product_information');
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
                            }
                            $totalPrcsAmnt += ($product[0]['open_quantity'] * $product[0]['open_rate']);
                            $totalPurchase += $product[0]['open_quantity'];
                            $newrate = $totalPrcsAmnt / $totalPurchase;
                            $supplier_price = array(
                                'supplier_price' => $newrate,
                            );

                            $this->Products->update_product($supplier_price, $product_id);
                            // $this->db->where('product_id', $product_id);
                            // $this->db->update('product_information', $supplier_price);

                            $supplier_price2 = array(
                                'child_product_price' => $newrate,
                            );
                            $this->db->where('child_product_id', $product_id);
                            $this->db->update('assembly_products', $supplier_price2);
                            /////////////////////////////////////////////////////////////////
                        }
                        $store = array(
                            'transfer_id' => $this->auth->generator(15),
                            'purchase_id' => $purchase_id,
                            'store_id' => $this->input->post('store_id', TRUE),
                            'product_id' => $product_id,
                            'variant_id' => $variant,
                            'variant_color' => $variant_color,
                            'date_time' => $this->input->post('purchase_date', TRUE),
                            'quantity' => $product_quantity,
                            'status' => 3
                        );
                        if (!empty($quantity)) {
                            $this->db->insert('transfer', $store);
                            // stock 
                            $store_id = $this->input->post('store_id', TRUE);
                            $check_stock = $this->check_stock($store_id, $product_id, $variant, $variant_color);
                            if (empty($check_stock)) {
                                // insert
                                $stock = array(
                                    'store_id' => $store_id,
                                    'product_id' => $product_id,
                                    'variant_id' => $variant,
                                    'variant_color' => $variant_color,
                                    'quantity' => $product_quantity,
                                    'warehouse_id' => '',
                                );
                                $this->db->insert('purchase_stock_tbl', $stock);
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
                                $this->db->update('purchase_stock_tbl', $stock);
                                //update
                            }
                            // stock
                        }
                    }
                }

                $this->load->model('accounting/account_model');
                $supplier_id = $this->input->post('supplier_id', TRUE);
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
                $supplier_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                if (empty($supplier_head)) {
                    $PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', '2111')->get()->row();
                    if (!empty($PHead)) {
                        $childCount = $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode', '2111')->get()->row();
                        if (!empty($childCount->HeadCode)) {
                            $HeadCode = $childCount->HeadCode + 1;
                        } else {
                            $HeadCode = '21111';
                        }
                        $supplier_name = $this->db->select('supplier_name')->from('supplier_information')->where('supplier_id', $supplier_id)->get()->row();
                        $acc_coa = array(
                            'HeadCode' => $HeadCode,
                            'HeadName' => $supplier_name->supplier_name,
                            'PHeadName' => $PHead->HeadName,
                            'PHeadCode' => $PHead->HeadCode,
                            'HeadLevel' => 4,
                            'IsActive' => 1,
                            'IsTransaction' => 1,
                            'IsGL' => 0,
                            'HeadType' => 'L',
                            'supplier_id' => $supplier_id,
                            'CreateBy' => $this->session->userdata('user_id'),
                            'CreateDate' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('acc_coa', $acc_coa);
                        $supplier_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                    }
                }
                $createdate = date('Y-m-d H:i:s');
                $receive_by = $this->session->userdata('user_id');
                $date = $createdate;

                $total_price_before_discount = $total_price_without_discount;
                $total_purchase_vat = $this->input->post('total_purchase_vat', TRUE);
                $total_price_with_vat = $this->input->post('grand_total_price', TRUE);
                $total_purchase_discount = $total_price_before_discount - ($total_price_with_vat - $total_purchase_vat);
                $purchase_expence = $this->input->post('purchase_expences', TRUE);

                //1st Main warehouse Debit (total_price_before_discount)
                $main_warehouse_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1141, //Main Warehouse
                    'Narration' => 'Purchase total price before discount debit by Main warehouse',
                    'Debit' => $total_price_before_discount,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //2nd (vat on input) Debit
                $vat = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 116,
                    'Narration' => 'Purchase vat/tax total debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => $total_purchase_vat,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //3rd supplier credit (total_price_with_vat or grand_total_price)
                $suppliercredit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => $supplier_head->HeadCode,
                    'Narration' => 'Purchase "total_price_with_vat" credited by supplier: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_price_with_vat,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );

                //4th total_purchase_discount credit
                $discount = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 521,
                    'Narration' => 'Purchase total discount credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_purchase_discount,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //5th proof of purchase expences Main warehouse Debit (purchase_expence)
                $debit_purchase_expences_inventory = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1141,
                    'Narration' => 'Purchase expence proof (Main warehouse) debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => $purchase_expence,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //6th Cash in box general administration credit
                $credit_purchase_expences = array();
                $p_cost_sectors = $this->input->post('bank_id', TRUE);
                if (!empty($p_cost_sectors)) {
                    foreach ($p_cost_sectors as $key => $sector) {
                        $ind_purchase_expence = $this->input->post('purchase_expences_' . ($key + 1));
                        if (!empty($ind_purchase_expence)) {
                            if ($sector == 'cash') {
                                $credit_purchase_expences[] = array(
                                    'fy_id' => $find_active_fiscal_year->id,
                                    'VNo' => 'p-' . $purchase_id,
                                    'Vtype' => 'Purchase',
                                    'VDate' => $date,
                                    'COAID' => 1111,
                                    'Narration' => 'Purchase expence proof (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                                    'Debit' => 0,
                                    'Credit' => $ind_purchase_expence,
                                    'IsPosted' => 1,
                                    'CreateBy' => $receive_by,
                                    'CreateDate' => $createdate,
                                    'store_id' => $store_id,
                                    'IsAppove' => 1
                                );
                            } else {
                                $bank_id = $sector;
                                $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('bank_id', $bank_id)->get()->row();
                                if (empty($bank_head)) {
                                    $this->load->model('accounting/account_model');
                                    $bank_name = $this->db->select('bank_name')->from('bank_list')->where('bank_id', $bank_id)->get()->row();
                                    if ($bank_name) {
                                        $bank_data = array(
                                            'bank_id' => $bank_id,
                                            'bank_name' => $bank_name->bank_name,
                                        );
                                        $this->account_model->insert_bank_head($bank_data);
                                    }
                                    $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('bank_id', $bank_id)->get()->row();
                                }
                                $credit_purchase_expences[] = array(
                                    'fy_id' => $find_active_fiscal_year->id,
                                    'VNo' => 'p-' . $purchase_id,
                                    'Vtype' => 'Purchase',
                                    'VDate' => $date,
                                    'COAID' => $bank_head->HeadCode,
                                    'Narration' => 'Purchase expence proof bank credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                                    'Debit' => 0,
                                    'Credit' => $ind_purchase_expence,
                                    'IsPosted' => 1,
                                    'CreateBy' => $receive_by,
                                    'CreateDate' => $createdate,
                                    'store_id' => $store_id,
                                    'IsAppove' => 1
                                );
                            }
                        }
                    }

                    if (!empty($credit_purchase_expences)) {
                        $this->db->insert_batch('acc_transaction', $credit_purchase_expences);
                    }
                } else {
                    $credit_purchase_expences = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'p-' . $purchase_id,
                        'Vtype' => 'Purchase',
                        'VDate' => $date,
                        'COAID' => 1111,
                        'Narration' => 'Purchase expence proof (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                        'Debit' => 0,
                        'Credit' => $purchase_expence,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'store_id' => $store_id,
                        'IsAppove' => 1
                    );
                    $this->db->insert('acc_transaction', $credit_purchase_expences);
                }

                $credit_purchase_sunvat = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1111,
                    'Narration' => 'Purchase sunglasses VAT (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $value_vat_sunglasses,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                $this->db->insert('acc_transaction', $credit_purchase_sunvat);


                $this->db->insert('acc_transaction', $main_warehouse_debit);
                $this->db->insert('acc_transaction', $suppliercredit);
                $this->db->insert('acc_transaction', $vat);
                $this->db->insert('acc_transaction', $discount);
                $this->db->insert('acc_transaction', $debit_purchase_expences_inventory);

                // Woocommerce module stock update
                $woocom_stock = $this->input->post('woocom_stock', TRUE);
                if (check_module_status('woocommerce') && ($woocom_stock == '1')) {

                    $this->load->library('woocommerce/woolib/woo_lib');
                    $this->load->model('woocommerce/woo_model');
                    $this->woo_lib->connection();
                    $def_store = $this->woo_model->get_def_store();

                    $woo_stock = [];
                    for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                        $product_quantity = $quantity[$i];
                        $product_id = $p_id[$i];
                        $variant = $variant_id[$i];
                        $fulldata = $woo_data = [];
                        $product_stock = 0;


                        $prodinfo = $this->woo_model->get_product_sync_by_local_id($product_id);

                        if (!empty($prodinfo)) {
                            if ($prodinfo->woo_product_type == 'variable') {

                                $varinfo = $this->woo_model->get_variant_sync_by_local($product_id, $variant);

                                if (!empty($varinfo->woo_product_id) && !empty($varinfo->woo_variant_id)) {

                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $variant);

                                    $woo_data[] = array(
                                        'id' => $varinfo->woo_variant_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );

                                    if (!empty($woo_data)) {
                                        $fulldata['update'] = $woo_data;
                                        $woovarinfo = $this->woo_lib->post_request(array('param' => 'products/' . $varinfo->woo_product_id . '/variations/batch'), $fulldata);
                                    }
                                }
                            } else {

                                $pdef_info = $this->woo_model->get_product_variant_info($product_id);

                                if (!empty($pdef_info)) {

                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $pdef_info->default_variant);

                                    $woo_stock[] = array(
                                        'id' => $prodinfo->woo_product_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );
                                }
                            }
                        }
                    }
                    if (!empty($woo_stock)) { //update global stock
                        $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                    }
                }
                return true;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect('dashboard/Cpurchase');
            }
        } else {
            //Generator purchase id
            $purchase_id = $this->auth->generator(15);
            $p_id = $this->input->post('product_id', TRUE);
            $batch = $this->input->post('batch_no', true);
            $expiry = $this->input->post('expiry_date', true);
            $supplier_id = $this->input->post('supplier_id', TRUE);
            $quantity = $this->input->post('product_quantity', TRUE);
            $variant_id = $this->input->post('variant_id', TRUE);
            $variant_id = $this->input->post('variant_id', TRUE);
            $color_variant = $this->input->post('color_variant', TRUE);
            $discount = $this->input->post('discount', TRUE);

            // Supplier & product id relation ship checker.
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_id = $p_id[$i];
                $value = $this->product_supplier_check($product_id, $supplier_id);
                if ($value == 0) {
                    $this->session->set_userdata(array('error_message' => display("product_and_supplier_did_not_match")));
                    redirect(base_url('dashboard/Cpurchase'));
                }
            }
            //Variant id required check
            $result = array();
            foreach ($p_id as $k => $v) {
                if (empty($variant_id[$k])) {
                    $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                    redirect('dashboard/Cpurchase');
                }
            }
            //Add Product To Purchase Table
            $data = array(
                'purchase_id' => $purchase_id,
                'invoice_no' => $this->input->post('invoice_no', TRUE),
                'supplier_id' => $this->input->post('supplier_id', TRUE),
                'store_id' => $this->input->post('store_id', TRUE),
                'wearhouse_id' => '',
                'sub_total_price' => $this->input->post('sub_total_price', TRUE),
                'total_items' => $this->input->post('total_number_of_items', TRUE),
                'purchase_vat' => $this->input->post('purchase_vat', TRUE),
                'total_purchase_vat' => $this->input->post('total_purchase_vat', TRUE),
                'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
                'purchase_date' => $this->input->post('purchase_date', TRUE),
                'purchase_details' => $this->input->post('purchase_details', TRUE),
                'purchase_expences' => $this->input->post('purchase_expences', TRUE),
                'user_id' => $this->session->userdata('user_id'),
                'status' => 1
            );
            $this->db->insert('product_purchase', $data);
            //Add Product To Supplier Ledger
            $ledger = array(
                'transaction_id' => $this->auth->generator(15),
                'purchase_id' => $purchase_id,
                'invoice_no' => $this->input->post('invoice_no', TRUE),
                'supplier_id' => $this->input->post('supplier_id', TRUE),
                'amount' => $this->input->post('grand_total_price', TRUE),
                'date' => date('d-m-Y', strtotime($this->input->post('purchase_date', TRUE))),
                'description' => $this->input->post('purchase_details', FALSE),
                'status' => 1,
                'sl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('purchase_date', TRUE))),
            );
            $this->db->insert('supplier_ledger', $ledger);
            //Product Purchase Details
            $rate = $this->input->post('product_rate', TRUE);
            $t_price = $this->input->post('total_price', TRUE);
            $total_price_without_discount = 0;
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_quantity = $quantity[$i];
                $product_rate = $rate[$i];
                $product_id = $p_id[$i];
                $batch_no = $batch[$i];
                $expiry_date = $expiry[$i];
                $total_price = $t_price[$i];
                $variant = $variant_id[$i];
                $variant_color = $color_variant[$i];
                $product_discount = $discount[$i];
                $total_price_without_discount += ($rate[$i] * $quantity[$i]);
                $data1 = array(
                    'purchase_detail_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'product_id' => $product_id,
                    'batch_no' => $batch_no,
                    'expiry_date' => date('Y-m-d', strtotime($expiry_date)),
                    'wearhouse_id' => '',
                    'store_id' => $this->input->post('store_id', TRUE),
                    'quantity' => $product_quantity,
                    'rate' => $product_rate,
                    'discount' => $product_discount,
                    'total_amount' => $total_price,
                    'variant_id' => $variant,
                    'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                    'status' => 1
                );

                if (!empty($quantity)) {
                    $this->db->insert('product_purchase_details', $data1);
                }
                $store = array(
                    'transfer_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'store_id' => $this->input->post('store_id', TRUE),
                    'product_id' => $product_id,
                    'variant_id' => $variant,
                    'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                    'date_time' => $this->input->post('purchase_date', TRUE),
                    'quantity' => $product_quantity,
                    'status' => 3
                );
                if (!empty($quantity)) {
                    $this->db->insert('transfer', $store);
                    // stock 
                    $store_id = $this->input->post('store_id', TRUE);
                    $check_stock = $this->check_stock($store_id, $product_id, $variant, $variant_color);
                    if (empty($check_stock)) {
                        // insert
                        $stock = array(
                            'store_id' => $store_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant,
                            'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                            'quantity' => $product_quantity,
                            'warehouse_id' => '',
                        );
                        $this->db->insert('purchase_stock_tbl', $stock);
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
                        $this->db->update('purchase_stock_tbl', $stock);
                        //update
                    }
                    // stock
                }
            }
            // Woocommerce module stock update
            $woocom_stock = $this->input->post('woocom_stock', TRUE);
            if (check_module_status('woocommerce') && ($woocom_stock == '1')) {

                $this->load->library('woocommerce/woolib/woo_lib');
                $this->load->model('woocommerce/woo_model');
                $this->woo_lib->connection();
                $def_store = $this->woo_model->get_def_store();

                $woo_stock = [];
                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_quantity = $quantity[$i];
                    $product_id = $p_id[$i];
                    $variant = $variant_id[$i];
                    $fulldata = $woo_data = [];
                    $product_stock = 0;

                    $prodinfo = $this->woo_model->get_product_sync_by_local_id($product_id);

                    if (!empty($prodinfo)) {
                        if ($prodinfo->woo_product_type == 'variable') {
                            $varinfo = $this->woo_model->get_variant_sync_by_local($product_id, $variant);
                            if (!empty($varinfo->woo_product_id) && !empty($varinfo->woo_variant_id)) {
                                $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $variant);
                                $woo_data[] = array(
                                    'id' => $varinfo->woo_variant_id,
                                    'manage_stock' => TRUE,
                                    'stock_quantity' => $product_stock,
                                    'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                );
                                if (!empty($woo_data)) {
                                    $fulldata['update'] = $woo_data;
                                    $woovarinfo = $this->woo_lib->post_request(array('param' => 'products/' . $varinfo->woo_product_id . '/variations/batch'), $fulldata);
                                }
                            }
                        } else {
                            $pdef_info = $this->woo_model->get_product_variant_info($product_id);
                            if (!empty($pdef_info)) {
                                $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $pdef_info->default_variant);
                                $woo_stock[] = array(
                                    'id' => $prodinfo->woo_product_id,
                                    'manage_stock' => TRUE,
                                    'stock_quantity' => $product_stock,
                                    'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                );
                            }
                        }
                    }
                }
                if (!empty($woo_stock)) { //update global stock
                    $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                }
            }
            return true;
        }
    }

    //Retrieve purchase Edit Data
    public function retrieve_purchase_editdata($purchase_id)
    {
        $this->db->select('a.*,b.*,c.product_id,c.product_name,c.product_model,d.supplier_id,d.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details b', 'b.purchase_id =a.purchase_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');
        $this->db->where('a.purchase_id', $purchase_id);
        $this->db->order_by('a.purchase_details', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Update Purchase
    public function update_purchase($npurchase_id = false, $ninvoice_no = false)
    {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                //Generator purchase id
                $purchase_id = $this->input->post('purchase_id', TRUE);
                if (empty($purchase_id)) {
                    $purchase_id = $npurchase_id;
                }
                $p_id = $this->input->post('product_id', TRUE);
                $batch = $this->input->post('batch_no', true);
                $expiry = $this->input->post('expiry_date', true);
                $supplier_id = $this->input->post('supplier_id', TRUE);
                $variants = $this->input->post('variant_id', TRUE);
                $variant_colors = $this->input->post('color_variant', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $vat_rate = $this->input->post('vat_rate', TRUE);
                $vat = $this->input->post('vat', TRUE);

                //Supplier & product id relation ship checker.
                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_id = $p_id[$i];
                    $value = $this->product_supplier_check($product_id, $supplier_id);
                    if ($value == 0) {
                        $this->session->set_userdata('error_message', display("product_and_supplier_did_not_match"));
                        redirect('dashboard/Cpurchase');
                    }
                }
                //Variant id required check
                $result = array();
                foreach ($p_id as $k => $v) {
                    if (empty($variants[$k])) {
                        $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                        redirect('dashboard/Cpurchase');
                    }
                }

                //proof of purchase expense 
                $cost_sectors = $this->input->post('bank_id');
                if (!empty($cost_sectors)) {

                    $this->db->where('purchase_id', $purchase_id);
                    $result = $this->db->delete('proof_of_purchase_expese');
                    $purchase_costs = array();
                    foreach ($cost_sectors as $key => $sector) {
                        if (!empty($this->input->post('purchase_expences_' . ($key + 1)))) {
                            $expense_title = $this->input->post('purchase_expences_title_' . ($key + 1));
                            $purchase_expense = $this->input->post('purchase_expences_' . ($key + 1));
                            if (!empty($purchase_expense)) {
                                $purchase_costs[] = array(
                                    'purchase_id' => $purchase_id,
                                    'expense_title' => $expense_title,
                                    'purchase_expense' => $purchase_expense,
                                    'payment_method' => $sector,
                                );
                            }
                        }
                    }
                    $this->db->insert_batch('proof_of_purchase_expese', $purchase_costs);
                }

                //Update Product Purchase Table
                $data = array(
                    'purchase_id' => $purchase_id,
                    'invoice_no' => !empty($this->input->post('invoice_no', TRUE)) ? $this->input->post('invoice_no', TRUE) : $ninvoice_no,
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'invoice' => 'Inv-' . $this->number_generator(),
                    'wearhouse_id' => '',
                    'sub_total_price' => $this->input->post('sub_total_price', TRUE),
                    'total_items' => $this->input->post('total_number_of_items', TRUE),
                    'purchase_vat' => $this->input->post('purchase_vat', TRUE),
                    'total_purchase_vat' => $this->input->post('total_purchase_vat', TRUE),
                    'purchase_expences' => $this->input->post('purchase_expences', TRUE),
                    'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
                    'purchase_date' => $this->input->post('purchase_date', TRUE),
                    'purchase_details' => $this->input->post('purchase_details', FALSE),
                    'user_id' => $this->session->userdata('user_id'),
                    'status' => 1
                );

                $this->db->where('purchase_id', $purchase_id);
                $result = $this->db->delete('product_purchase');

                if ($result) {
                    $this->db->insert('product_purchase', $data);
                }

                //Add Product To Supplier Ledger
                $ledger = array(
                    'invoice_no' => $this->input->post('invoice_no', TRUE),
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
                    'amount' => $this->input->post('grand_total_price', TRUE),
                    'date' => $this->input->post('purchase_date', TRUE),
                    'description' => $this->input->post('purchase_details', FALSE),
                    'status' => 1
                );
                $this->db->where('purchase_id', $purchase_id);
                $this->db->update('supplier_ledger', $ledger);

                //Delete old purchase details info
                if (!empty($purchase_id)) {
                    //find previous purchase history and reduce the stock
                    $purchase_history = $this->db->select('*')->from('product_purchase_details')->where('purchase_id', $purchase_id)->get()->result_array();
                    if (count($purchase_history) > 0) {
                        foreach ($purchase_history as $purchase_item) {
                            //update
                            $check_stock = $this->check_stock($purchase_item['store_id'], $purchase_item['product_id'], $purchase_item['variant_id'], $purchase_item['variant_color']);
                            $stock = array(
                                'quantity' => $check_stock->quantity - $purchase_item['quantity']
                            );
                            if (!empty($purchase_item['store_id'])) {
                                $this->db->where('store_id', $purchase_item['store_id']);
                            }
                            if (!empty($purchase_item['product_id'])) {
                                $this->db->where('product_id', $purchase_item['product_id']);
                            }
                            if (!empty($purchase_item['variant_id'])) {
                                $this->db->where('variant_id', $purchase_item['variant_id']);
                            }
                            if (!empty($purchase_item['variant_color'])) {
                                $this->db->where('variant_color', $purchase_item['variant_color']);
                            }
                            $this->db->update('purchase_stock_tbl', $stock);
                            //update
                        }
                    }

                    //find previous purchase history and reduce the stock
                    $this->db->where('purchase_id', $purchase_id);
                    $this->db->delete('product_purchase_details');

                    //Delete transfer data from transfer
                    $this->db->where('purchase_id', $purchase_id);
                    $this->db->delete('transfer');
                }

                //Product Purchase Details
                $rate = $this->input->post('product_rate', TRUE);
                $quantity = $this->input->post('product_quantity', TRUE);
                $t_price = $this->input->post('total_price', TRUE);

                $purchase_detail_id = $this->input->post('purchase_detail_id', TRUE);

                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_quantity = $quantity[$i];
                    $product_rate = $rate[$i];
                    $product_id = $p_id[$i];
                    $batch_no = $batch[$i];
                    $expiry_date = $expiry[$i];
                    $total_price = $t_price[$i];
                    $variant_id = $variants[$i];
                    $variant_color = (!empty($variant_colors[$i]) ? $variant_colors[$i] : NULL);
                    $product_discount = $discount[$i];
                    $total_price_without_discount += ($rate[$i] * $quantity[$i]);
                    $i_vat_rate = $vat_rate[$i];
                    $i_vat = $vat[$i];

                    $data1 = array(
                        'purchase_detail_id' => $this->auth->generator(15),
                        'purchase_id' => $purchase_id,
                        'product_id' => $product_id,
                        'batch_no' => $batch_no,
                        'expiry_date' => date('Y-m-d', strtotime($expiry_date)),
                        'store_id' => $this->input->post('store_id', TRUE),
                        'wearhouse_id' => '',
                        'variant_id' => $variant_id,
                        'variant_color' => $variant_color,
                        'quantity' => $product_quantity,
                        'rate' => $product_rate,
                        'discount' => $product_discount,
                        'vat_rate' => $i_vat_rate,
                        'vat' => $i_vat,
                        'total_amount' => $total_price,
                        'status' => 1
                    );

                    if (!empty($quantity)) {
                        $this->db->insert('product_purchase_details', $data1);
                    }

                    $store = array(
                        'transfer_id' => $this->auth->generator(15),
                        'purchase_id' => $purchase_id,
                        'store_id' => $this->input->post('store_id', TRUE),
                        'product_id' => $product_id,
                        'variant_id' => $variant_id,
                        'variant_color' => $variant_color,
                        'date_time' => $this->input->post('purchase_date', TRUE),
                        'quantity' => $product_quantity,
                        'status' => 3
                    );
                    $this->db->insert('transfer', $store);

                    // stock
                    $store_id = $this->input->post('store_id', TRUE);
                    $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                    if (!empty($check_stock)) {
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
                        if (!empty($variant_id)) {
                            $this->db->where('variant_id', $variant_id);
                        }
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $this->db->update('purchase_stock_tbl', $stock);
                        //update
                    } else {
                        // insert
                        $stock = array(
                            'store_id' => $store_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                            'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                            'quantity' => $product_quantity,
                            'warehouse_id' => '',
                        );
                        $this->db->insert('purchase_stock_tbl', $stock);
                        // insert
                    }
                    // stock
                }

                $this->load->model('accounting/account_model');

                // Reverse purchase transections start
                $previous_purchases = $this->db->select('*')->from('acc_transaction')->where('VNo', 'p-' . $purchase_id)->get()->result_array();
                if (count($previous_purchases) > 0) {
                    //                    $transection_reverse = array();
                    //                    foreach ($previous_purchases as $key => $purchases) {
                    //                        $ID = $purchases['ID'];
                    //                        $fy_id = $purchases['fy_id'];
                    //                        $VNo = $purchases['VNo'];
                    //                        $Vtype = $purchases['Vtype'];
                    //                        $VDate = $purchases['VDate'];
                    //                        $COAID = $purchases['COAID'];
                    //                        $Narration = $purchases['Narration'];
                    //                        $Debit = $purchases['Debit'];
                    //                        $Credit = $purchases['Credit'];
                    //                        $IsPosted = $purchases['IsPosted'];
                    //                        $is_opening = $purchases['is_opening'];
                    //                        $store_id = $purchases['store_id'];
                    //                        $CreateBy = $this->session->userdata('user_id');
                    //                        $createdate = date('Y-m-d H:i:s');
                    //                        $UpdateBy = $this->session->userdata('user_id');
                    //                        $IsAppove = $purchases['IsAppove'];
                    //
                    //                        $transection_reverse[] = array(
                    //                            'fy_id' => $fy_id,
                    //                            'VNo' => $VNo,
                    //                            'Vtype' => $Vtype,
                    //                            'VDate' => $createdate,
                    //                            'COAID' => $COAID,
                    //                            'Narration' => 'Purchase reverse transection ' . $Narration,
                    //                            'Debit' => $Credit,
                    //                            'Credit' => $Debit,
                    //                            'IsPosted' => $IsPosted,
                    //                            'CreateBy' => $CreateBy,
                    //                            'CreateDate' => $createdate,
                    //                            'store_id' => $store_id,
                    //                            'IsAppove' => 1
                    //                        );
                    //                    }
                    //                    $reverse = $this->db->insert_batch('acc_transaction', $transection_reverse);

                    $this->db->where('VNo', 'p-' . $purchase_id);
                    $this->db->delete('acc_transaction');
                }
                // Reverse purchase transections end		


                $supplier_id = $this->input->post('supplier_id', TRUE);
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
                $supplier_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                if (empty($supplier_head)) {
                    $PHead = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', '2111')->get()->row();
                    if (!empty($PHead)) {
                        $childCount = $this->db->select('MAX(HeadCode) as HeadCode')->from('acc_coa')->where('PHeadCode', '2111')->get()->row();
                        if (!empty($childCount->HeadCode)) {
                            $HeadCode = $childCount->HeadCode + 1;
                        } else {
                            $HeadCode = '21111';
                        }
                        $supplier_name = $this->db->select('supplier_name')->from('supplier_information')->where('supplier_id', $supplier_id)->get()->row();
                        $acc_coa = array(
                            'HeadCode' => $HeadCode,
                            'HeadName' => $supplier_name->supplier_name,
                            'PHeadName' => $PHead->HeadName,
                            'PHeadCode' => $PHead->HeadCode,
                            'HeadLevel' => 4,
                            'IsActive' => 1,
                            'IsTransaction' => 1,
                            'IsGL' => 0,
                            'HeadType' => 'L',
                            'supplier_id' => $supplier_id,
                            'CreateBy' => $this->session->userdata('user_id'),
                            'CreateDate' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('acc_coa', $acc_coa);
                        $supplier_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('supplier_id', $supplier_id)->get()->row();
                    }
                }
                $createdate = date('Y-m-d H:i:s');
                $receive_by = $this->session->userdata('user_id');
                $date = $createdate;

                $total_price_before_discount = $total_price_without_discount;
                $total_purchase_vat = $this->input->post('total_purchase_vat', TRUE);
                $total_price_with_vat = $this->input->post('grand_total_price', TRUE);
                $total_purchase_discount = $total_price_before_discount - ($total_price_with_vat - $total_purchase_vat);
                $purchase_expence = $this->input->post('purchase_expences', TRUE);

                //1st Main warehouse Debit (total_price_before_discount)
                $main_warehouse_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1141, //Main Warehouse
                    'Narration' => 'Purchase total price before discount debit by Main warehouse',
                    'Debit' => $total_price_before_discount,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //2nd (vat on input) Debit
                $vat = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 116,
                    'Narration' => 'Purchase vat/tax total debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => $total_purchase_vat,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //3rd supplier credit (total_price_with_vat or grand_total_price)
                $suppliercredit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => $supplier_head->HeadCode,
                    'Narration' => 'Purchase "total_price_with_vat" credited by supplier: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_price_with_vat,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );

                //4th total_purchase_discount credit
                $discount = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 521,
                    'Narration' => 'Purchase total discount credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_purchase_discount,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );
                //5th proof of purchase expences Main warehouse Debit (purchase_expence)
                $debit_purchase_expences_inventory = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'p-' . $purchase_id,
                    'Vtype' => 'Purchase',
                    'VDate' => $date,
                    'COAID' => 1141,
                    'Narration' => 'Purchase expence proof (Main warehouse) debit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                    'Debit' => $purchase_expence,
                    'Credit' => 0, //purchase price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'store_id' => $store_id,
                    'IsAppove' => 1
                );



                //6th Cash in box general administration credit
                $credit_purchase_expences = array();
                $p_cost_sectors = $this->input->post('bank_id');
                if (!empty($p_cost_sectors)) {
                    foreach ($p_cost_sectors as $key => $sector) {
                        if (!empty($this->input->post('purchase_expences_' . ($key + 1)))) {
                            $ind_purchase_expence = $this->input->post('purchase_expences_' . ($key + 1));
                            if (!empty($ind_purchase_expence)) {
                                if ($sector == 'cash') {
                                    $credit_purchase_expences[] = array(
                                        'fy_id' => $find_active_fiscal_year->id,
                                        'VNo' => 'p-' . $purchase_id,
                                        'Vtype' => 'Purchase',
                                        'VDate' => $date,
                                        'COAID' => 1111,
                                        'Narration' => 'Purchase expence proof (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                                        'Debit' => 0,
                                        'Credit' => $ind_purchase_expence,
                                        'IsPosted' => 1,
                                        'CreateBy' => $receive_by,
                                        'CreateDate' => $createdate,
                                        'store_id' => $store_id,
                                        'IsAppove' => 1
                                    );
                                } else {
                                    $bank_id = $sector;
                                    $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('bank_id', $bank_id)->get()->row();
                                    if (empty($bank_head)) {
                                        $this->load->model('accounting/account_model');
                                        $bank_name = $this->db->select('bank_name')->from('bank_list')->where('bank_id', $bank_id)->get()->row();
                                        if ($bank_name) {
                                            $bank_data = array(
                                                'bank_id' => $bank_id,
                                                'bank_name' => $bank_name->bank_name,
                                            );
                                            $this->account_model->insert_bank_head($bank_data);
                                        }
                                        $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('bank_id', $bank_id)->get()->row();
                                    }
                                    $credit_purchase_expences[] = array(
                                        'fy_id' => $find_active_fiscal_year->id,
                                        'VNo' => 'p-' . $purchase_id,
                                        'Vtype' => 'Purchase',
                                        'VDate' => $date,
                                        'COAID' => $bank_head->HeadCode,
                                        'Narration' => 'Purchase expence proof bank credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                                        'Debit' => 0,
                                        'Credit' => $ind_purchase_expence,
                                        'IsPosted' => 1,
                                        'CreateBy' => $receive_by,
                                        'CreateDate' => $createdate,
                                        'store_id' => $store_id,
                                        'IsAppove' => 1
                                    );
                                }
                            }
                        }
                    }

                    $this->db->insert_batch('acc_transaction', $credit_purchase_expences);
                } else {
                    $credit_purchase_expences = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'p-' . $purchase_id,
                        'Vtype' => 'Purchase',
                        'VDate' => $date,
                        'COAID' => 1111,
                        'Narration' => 'Purchase expence proof (Cash in box general administration) credit by supplier id: ' . $supplier_head->HeadName . '(' . $supplier_id . ')',
                        'Debit' => 0,
                        'Credit' => $purchase_expence,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'store_id' => $store_id,
                        'IsAppove' => 1
                    );
                    $this->db->insert('acc_transaction', $credit_purchase_expences);
                }


                $this->db->insert('acc_transaction', $main_warehouse_debit);
                $this->db->insert('acc_transaction', $suppliercredit);
                $this->db->insert('acc_transaction', $vat);
                $this->db->insert('acc_transaction', $discount);
                $this->db->insert('acc_transaction', $debit_purchase_expences_inventory);

                // Woocommerce Stock update
                $woocom_stock = $this->input->post('woocom_stock', TRUE);
                if (check_module_status('woocommerce') && ($woocom_stock == '1')) {

                    $this->load->library('woocommerce/woolib/woo_lib');
                    $this->load->model('woocommerce/woo_model');
                    $this->woo_lib->connection();
                    $def_store = $this->woo_model->get_def_store();

                    $woo_stock = [];
                    for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                        $product_quantity = $quantity[$i];
                        $product_id = $p_id[$i];
                        $variant = $variants[$i];
                        $fulldata = $woo_data = [];
                        $product_stock = 0;


                        $prodinfo = $this->woo_model->get_product_sync_by_local_id($product_id);

                        if (!empty($prodinfo)) {
                            if ($prodinfo->woo_product_type == 'variable') {

                                $varinfo = $this->woo_model->get_variant_sync_by_local($product_id, $variant);

                                if (!empty($varinfo->woo_product_id) && !empty($varinfo->woo_variant_id)) {

                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $variant);

                                    $woo_data[] = array(
                                        'id' => $varinfo->woo_variant_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );

                                    if (!empty($woo_data)) {
                                        $fulldata['update'] = $woo_data;
                                        $woovarinfo = $this->woo_lib->post_request(array('param' => 'products/' . $varinfo->woo_product_id . '/variations/batch'), $fulldata);
                                    }
                                }
                            } else {

                                $pdef_info = $this->woo_model->get_product_variant_info($product_id);

                                if (!empty($pdef_info)) {

                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $pdef_info->default_variant);

                                    $woo_stock[] = array(
                                        'id' => $prodinfo->woo_product_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );
                                }
                            }
                        }
                    }
                    if (!empty($woo_stock)) { //update global stock
                        $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                    }
                }

                return true;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect('dashboard/Cpurchase');
            }
        } else {
            //Generator purchase id
            $purchase_id = $this->input->post('purchase_id', TRUE);
            $p_id = $this->input->post('product_id', TRUE);
            $batch = $this->input->post('batch_no', true);
            $expiry = $this->input->post('expiry_date', true);
            $supplier_id = $this->input->post('supplier_id', TRUE);
            $variants = $this->input->post('variant_id', TRUE);
            $variant_colors = $this->input->post('color_variant', TRUE);
            $discount = $this->input->post('discount', TRUE);

            $vat_rate = $this->input->post('vat_rate', TRUE);
            $vat = $this->input->post('vat', TRUE);

            //Supplier & product id relation ship checker.
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_id = $p_id[$i];
                $value = $this->product_supplier_check($product_id, $supplier_id);
                if ($value == 0) {
                    $this->session->set_userdata('error_message', display("product_and_supplier_did_not_match"));
                    redirect('dashboard/Cpurchase');
                }
            }
            //Variant id required check
            $result = array();
            foreach ($p_id as $k => $v) {
                if (empty($variants[$k])) {
                    $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                    redirect('dashboard/Cpurchase');
                }
            }

            //Update Product Purchase Table
            $data = array(
                'purchase_id' => $purchase_id,
                'invoice_no' => $this->input->post('invoice_no', TRUE),
                'supplier_id' => $this->input->post('supplier_id', TRUE),
                'store_id' => $this->input->post('store_id', TRUE),
                'wearhouse_id' => '',
                'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
                'purchase_date' => $this->input->post('purchase_date', TRUE),
                'purchase_details' => $this->input->post('purchase_details', FALSE),
                'user_id' => $this->session->userdata('user_id'),
                'status' => 1
            );

            $this->db->where('purchase_id', $purchase_id);
            $result = $this->db->delete('product_purchase');

            if ($result) {
                $this->db->insert('product_purchase', $data);
            }

            //Add Product To Supplier Ledger
            $ledger = array(
                'invoice_no' => $this->input->post('invoice_no', TRUE),
                'supplier_id' => $this->input->post('supplier_id', TRUE),
                'amount' => $this->input->post('grand_total_price', TRUE),
                'date' => $this->input->post('purchase_date', TRUE),
                'description' => $this->input->post('purchase_details', FALSE),
                'status' => 1
            );
            $this->db->where('purchase_id', $purchase_id);
            $this->db->update('supplier_ledger', $ledger);

            //Delete old purchase details info
            if (!empty($purchase_id)) {
                //find previous purchase history and reduce the stock
                $purchase_history = $this->db->select('*')->from('product_purchase_details')->where('purchase_id', $purchase_id)->get()->result_array();
                if (count($purchase_history) > 0) {
                    foreach ($purchase_history as $purchase_item) {
                        //update
                        $check_stock = $this->check_stock($purchase_item['store_id'], $purchase_item['product_id'], $purchase_item['variant_id'], $purchase_item['variant_color']);
                        $stock = array(
                            'quantity' => $check_stock->quantity - $purchase_item['quantity']
                        );
                        if (!empty($purchase_item['store_id'])) {
                            $this->db->where('store_id', $purchase_item['store_id']);
                        }
                        if (!empty($purchase_item['product_id'])) {
                            $this->db->where('product_id', $purchase_item['product_id']);
                        }
                        if (!empty($purchase_item['variant_id'])) {
                            $this->db->where('variant_id', $purchase_item['variant_id']);
                        }
                        if (!empty($purchase_item['variant_color'])) {
                            $this->db->where('variant_color', $purchase_item['variant_color']);
                        }
                        $this->db->update('purchase_stock_tbl', $stock);
                        //update
                    }
                }

                //find previous purchase history and reduce the stock
                $this->db->where('purchase_id', $purchase_id);
                $this->db->delete('product_purchase_details');

                //Delete transfer data from transfer
                $this->db->where('purchase_id', $purchase_id);
                $this->db->delete('transfer');
            }

            //Product Purchase Details
            $rate = $this->input->post('product_rate', TRUE);
            $quantity = $this->input->post('product_quantity', TRUE);
            $t_price = $this->input->post('total_price', TRUE);
            $purchase_detail_id = $this->input->post('purchase_detail_id', TRUE);

            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_quantity = $quantity[$i];
                $product_rate = $rate[$i];
                $product_id = $p_id[$i];
                $batch_no = $batch[$i];
                $expiry_date = $expiry[$i];
                $total_price = $t_price[$i];
                $variant_id = $variants[$i];
                $variant_color = (!empty($variant_colors[$i]) ? $variant_colors[$i] : NULL);
                $product_discount = $discount[$i];

                $i_vat_rate = $vat_rate[$i];
                $i_vat = $vat[$i];

                $data1 = array(
                    'purchase_detail_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'product_id' => $product_id,
                    'batch_no' => $batch_no,
                    'expiry_date' => date('Y-m-d', strtotime($expiry_date)),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'wearhouse_id' => '',
                    'variant_id' => $variant_id,
                    'variant_color' => $variant_color,
                    'quantity' => $product_quantity,
                    'rate' => $product_rate,
                    'discount' => $product_discount,
                    'vat_rate' => $i_vat_rate,
                    'vat' => $i_vat,
                    'total_amount' => $total_price,
                    'status' => 1
                );

                if (!empty($quantity)) {
                    $this->db->insert('product_purchase_details', $data1);
                }
                $store = array(
                    'transfer_id' => $this->auth->generator(15),
                    'purchase_id' => $purchase_id,
                    'store_id' => $this->input->post('store_id', TRUE),
                    'product_id' => $product_id,
                    'variant_id' => $variant_id,
                    'variant_color' => $variant_color,
                    'date_time' => $this->input->post('purchase_date', TRUE),
                    'quantity' => $product_quantity,
                    'status' => 3
                );
                $this->db->insert('transfer', $store);

                // stock
                $store_id = $this->input->post('store_id', TRUE);
                $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                if (!empty($check_stock)) {
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
                    if (!empty($variant_id)) {
                        $this->db->where('variant_id', $variant_id);
                    }
                    if (!empty($variant_color)) {
                        $this->db->where('variant_color', $variant_color);
                    }
                    $this->db->update('purchase_stock_tbl', $stock);
                    //update
                } else {
                    // insert
                    $stock = array(
                        'store_id' => $store_id,
                        'product_id' => $product_id,
                        'variant_id' => $variant_id,
                        'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                        'quantity' => $product_quantity,
                        'warehouse_id' => '',
                    );
                    $this->db->insert('purchase_stock_tbl', $stock);
                    // insert
                }
                // stock
            }

            // Woocommerce Stock update
            $woocom_stock = $this->input->post('woocom_stock', TRUE);
            if (check_module_status('woocommerce') && ($woocom_stock == '1')) {

                $this->load->library('woocommerce/woolib/woo_lib');
                $this->load->model('woocommerce/woo_model');
                $this->woo_lib->connection();
                $def_store = $this->woo_model->get_def_store();

                $woo_stock = [];
                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_quantity = $quantity[$i];
                    $product_id = $p_id[$i];
                    $variant = $variants[$i];
                    $fulldata = $woo_data = [];
                    $product_stock = 0;


                    $prodinfo = $this->woo_model->get_product_sync_by_local_id($product_id);

                    if (!empty($prodinfo)) {
                        if ($prodinfo->woo_product_type == 'variable') {

                            $varinfo = $this->woo_model->get_variant_sync_by_local($product_id, $variant);

                            if (!empty($varinfo->woo_product_id) && !empty($varinfo->woo_variant_id)) {

                                $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $variant);

                                $woo_data[] = array(
                                    'id' => $varinfo->woo_variant_id,
                                    'manage_stock' => TRUE,
                                    'stock_quantity' => $product_stock,
                                    'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                );

                                if (!empty($woo_data)) {
                                    $fulldata['update'] = $woo_data;
                                    $woovarinfo = $this->woo_lib->post_request(array('param' => 'products/' . $varinfo->woo_product_id . '/variations/batch'), $fulldata);
                                }
                            }
                        } else {

                            $pdef_info = $this->woo_model->get_product_variant_info($product_id);

                            if (!empty($pdef_info)) {

                                $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $pdef_info->default_variant);

                                $woo_stock[] = array(
                                    'id' => $prodinfo->woo_product_id,
                                    'manage_stock' => TRUE,
                                    'stock_quantity' => $product_stock,
                                    'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                );
                            }
                        }
                    }
                }
                if (!empty($woo_stock)) { //update global stock
                    $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                }
            }
            return true;
        }
    }

    public function get_conversion_rate($currency_id)
    {
        $this->db->select('*');
        $this->db->from('currency_info');
        $this->db->where('currency_id ', $currency_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    //Get total product
    public function get_total_product($product_id, $store_id = null)
    {

        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where(array('product_information.product_id' => $product_id, 'product_information.status' => 1));
        $product_information = $this->db->get()->row();

        $html = $colorhtml = "";
        if ($product_information->variants) {
            $exploded = explode(',', $product_information->variants);

            $this->db->select('*');
            $this->db->from('variant');
            $this->db->where_in('variant_id', $exploded);
            $this->db->order_by('variant_name', 'asc');
            $variant_list = $this->db->get()->result();
            $var_types = array_column($variant_list, 'variant_type');

            $html .= "<select id=\"variant_id\" class=\"form-control variant_id\" required=\"\" style=\"width:200px\">";
            foreach ($variant_list as $varitem) {

                if ($varitem->variant_type == 'size') {
                    $size = $varitem->variant_id;
                    $html .= "<option value=" . $varitem->variant_id . ">" . $varitem->variant_name . "</option>";
                }
            }
            $html .= "</select>";

            if (in_array('color', $var_types)) {

                foreach ($variant_list as $varitem2) {

                    if ($varitem2->variant_type == 'color') {
                        $color = $varitem2->variant_id;
                        $colorhtml .= "<option value=" . $varitem2->variant_id . ">" . $varitem2->variant_name . "</option>";
                    }
                }
            }
        }

        // $this->db->reset_query();
        // $this->db->select("SUM(quantity) as totalPurchaseQnty")
        //     ->from('product_purchase_details')
        //     ->where('product_id', $product_id);
        // if (!empty($store_id)) {
        //     $this->db->where('store_id', $store_id);
        // }
        // $purchase = $this->db
        //     ->get()
        //     ->row();
        // $this->db->reset_query();
        // $this->db->select("SUM(quantity) as totalSalesQnty")
        //     ->from('invoice_stock_tbl')
        //     ->where('product_id', $product_id);
        // if (!empty($store_id)) {
        //     $this->db->where('store_id', $store_id);
        // }
        // $sales = $this->db
        //     ->get()
        //     ->row();
        // $stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
        // $stock = ($purchase->totalPurchaseQnty + $product_information->open_quantity) - $sales->totalSalesQnty;

        // get stock from wise variant
        $varies = explode(',', $product_information->variants);
        $size_id = $varies[0];
        $color_id = isset($varies[1]) ? $varies[1] : null;
        if ($product_information->assembly == 1) {
            $stock = $this->Purchases->check_variant_wise_stock2($product_id, $store_id, $size_id, $color_id);
        } else {
            $stock = $this->Purchases->check_variant_wise_stock($product_id, $store_id, $size_id, $color_id);
        }


        $data2 = array(
            'total_product' => $stock,
            'product_id' => $product_information->product_id,
            'supplier_price' => $product_information->supplier_price,
            'variant' => $html,
            'variant_color' => $colorhtml,
            'size' => $size,
            'color' => $color,
            'category_id' => $product_information->category_id,
        );

        return $data2;
    }

    //Retrieve company Edit Data
    public function retrieve_company()
    {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Delete purchase Item
    public function delete_purchase($purchase_id)
    {
        //reduce stock first
        $purchase_history = $this->db->select('*')->from('product_purchase_details')->where('purchase_id', $purchase_id)->get()->result_array();
        if (count($purchase_history) > 0) {
            foreach ($purchase_history as $purchase_item) {
                //update
                $check_stock = $this->check_stock($purchase_item['store_id'], $purchase_item['product_id'], $purchase_item['variant_id'], $purchase_item['variant_color']);
                $stock = array(
                    'quantity' => $check_stock->quantity - $purchase_item['quantity']
                );
                if (!empty($purchase_item['store_id'])) {
                    $this->db->where('store_id', $purchase_item['store_id']);
                }
                if (!empty($purchase_item['product_id'])) {
                    $this->db->where('product_id', $purchase_item['product_id']);
                }
                if (!empty($purchase_item['variant_id'])) {
                    $this->db->where('variant_id', $purchase_item['variant_id']);
                }
                if (!empty($purchase_item['variant_color'])) {
                    $this->db->where('variant_color', $purchase_item['variant_color']);
                }
                $this->db->update('purchase_stock_tbl', $stock);
                //update
            }
        }
        //reduce stock
        //Delete product_purchase table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase');
        //Delete product_purchase_details table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase_details');
        //Delete transer info table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('transfer');
        //Delete acc_transaction data
        $this->db->where('VNo', 'p-' . $purchase_id);
        $this->db->delete('acc_transaction');

        //Delete acc_transaction data
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('supplier_ledger');
        return true;
    }

    public function purchase_search_list($cat_id, $company_id)
    {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('purchases a');
        $this->db->join('purchase_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('purchase_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve purchase_details_data
    public function purchase_details_data($purchase_id)
    {
        $this->db->select('a.*,b.*,c.*,d.product_id,d.product_name,d.image_thumb,e.unit_short_name,d.product_model,f.variant_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id', 'left');
        $this->db->join('product_purchase_details c', 'c.purchase_id = a.purchase_id', 'left');
        $this->db->join('product_information d', 'd.product_id = c.product_id', 'left');
        $this->db->join('unit e', 'e.unit_id = d.unit', 'left');
        $this->db->join('variant f', 'f.variant_id = c.variant_id', 'left');
        $this->db->where('a.purchase_id', $purchase_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //This function will check the product & supplier relationship.
    public function product_supplier_check($product_id, $supplier_id)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        // $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return 0;
    }

    //This function is used to Generate Key
    public function generator($lenth)
    {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 61);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

    // Get variant stock info
    public function check_variant_wise_stock($product_id, $store_id, $variant_id, $variant_color = false, $date_from = null, $date_to = null)
    {
        $this->db->select("SUM(quantity) as totalPurchaseQnty");
        $this->db->from('purchase_stock_tbl');
        $this->db->where('product_id', $product_id);
        // $this->db->where('variant_id', $variant_id);
        if (!empty($variant_id)) {
            $this->db->where('variant_id', $variant_id);
        }
        if (!empty($variant_color)) {
            $this->db->where('variant_color', $variant_color);
        }
        if (!empty($store_id)) {
            $this->db->where('store_id', $store_id);
        }

        if ($date_from && $date_to) {
            $dateRange = "DATE(created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($date_from)) . "') AND DATE('" . date('Y-m-d', strtotime($date_to)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }

        if ($date_from) {
            // $this->db->where('DATE(created_at) >= DATE(' . date('Y-m-d', strtotime($date_from)) . ')', null, false);
        }

        if ($date_to) {
            // $this->db->where('DATE(created_at) <= DATE(' . date('Y-m-d', strtotime($date_to)) . ')', null, false);
        }


        
        $purchase = $this->db->get()->row();

        // var_dump($date_from, $date_to, $purchase, $store_id, $product_id);exit;

        // dd($this->db->last_query());

        $this->db->select("SUM(quantity) as totalSalesQnty");
        $this->db->from('invoice_stock_tbl');
        $this->db->where('product_id', $product_id);
        if (!empty($variant_id)) {
            $this->db->where('variant_id', $variant_id);
        }
        if (!empty($variant_color)) {
            $this->db->where('variant_color', $variant_color);
        }
        if (!empty($store_id)) {
            $this->db->where('store_id', $store_id);
        }

        // if ($date_from) {
        //     $this->db->where('DATE(created_at) >= DATE(' . date('Y-m-d', strtotime($date_from)) . ')', null, false);
        // }

        // if ($date_to) {
        //     $this->db->where('DATE(created_at) <= DATE(' . date('Y-m-d', strtotime($date_to)) . ')', null, false);
        // }

        if ($date_from && $date_to) {
            $dateRange = "DATE(created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($date_from)) . "') AND DATE('" . date('Y-m-d', strtotime($date_to)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }

        $sales = $this->db->get()->row();

        // var_dump($purchase->totalPurchaseQnty , $sales->totalSalesQnty);exit;

        // $product_information = $this->db->select('open_quantity')->from('product_information')->where('product_id', $product_id)->get()->row();

        $stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
        // $stock = ($purchase->totalPurchaseQnty + $product_information->open_quantity) - $sales->totalSalesQnty;

        return $stock;
    }

    public function check_variant_wise_stock2($product_id, $store_id, $variant_id, $variant_color = false, $date_from = null, $date_to = null)
    {

        $this->db->select("parent_product_id,child_product_id");
        $this->db->from('assembly_products');
        $this->db->where('parent_product_id', $product_id);
        $query = $this->db->get();
        $product_list = $query->result();
        $stock = 1000000000;
        if (!empty($product_list)) {
            foreach ($product_list as $product) {
                $this->db->select("SUM(quantity) as totalPurchaseQnty");
                $this->db->from('purchase_stock_tbl');
                $this->db->where('product_id', $product->child_product_id);
                if ($date_from) {
                    $this->db->where('DATE(created_at) >= DATE(' . date('Y-m-d', strtotime($date_from)) . ')', null, false);
                }
        
                if ($date_to) {
                    $this->db->where('DATE(created_at) <= DATE(' . date('Y-m-d', strtotime($date_to)) . ')', null, false);
                }
                $purchase = $this->db->get()->row();

                $this->db->select("SUM(quantity) as totalSalesQnty");
                $this->db->from('invoice_stock_tbl');
                $this->db->where('product_id', $product->child_product_id);
                if ($date_from) {
                    $this->db->where('DATE(created_at) >= DATE(' . date('Y-m-d', strtotime($date_from)) . ')', null, false);
                }
        
                if ($date_to) {
                    $this->db->where('DATE(created_at) <= DATE(' . date('Y-m-d', strtotime($date_to)) . ')', null, false);
                }
                $sales = $this->db->get()->row();
                $stock1 = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
                if ($stock1 < $stock) {
                    $stock = $stock1;
                }
            }
        }

        return $stock;
    }

    public function check_batch_no_wise_stock($product_id, $store_id, $variant_id, $variant_color = false, $batch_no)
    {
        $this->db->select("SUM(quantity) as totalPurchaseQnty");
        $this->db->from('product_purchase_details');
        $this->db->where('product_id', $product_id);
        $this->db->where('variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('variant_color', $variant_color);
        }
        $this->db->where('store_id', $store_id);
        $this->db->where('batch_no', $batch_no);
        $purchase = $this->db->get()->row();


        $this->db->select("SUM(quantity) as totalTransQnty");
        $this->db->from('transfer_details');
        $this->db->where('product_id', $product_id);
        $this->db->where('variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('variant_color', $variant_color);
        }
        $this->db->where('t_store_id', $store_id);
        $this->db->where('batch_no', $batch_no);
        $transfer_details = $this->db->get()->row();

        $this->db->select("SUM(quantity) as totalSalesQnty");
        $this->db->from('invoice_details');
        $this->db->where('product_id', $product_id);
        $this->db->where('variant_id', $variant_id);
        if (!empty($variant_color)) {
            $this->db->where('variant_color', $variant_color);
        }
        $this->db->where('store_id', $store_id);
        $this->db->where('batch_no', $batch_no);
        $sales = $this->db->get()->row();
        $stock = (($purchase->totalPurchaseQnty + $transfer_details->totalTransQnty) - $sales->totalSalesQnty);
        return $stock;
    }

    public function check_pos_batch_no_wise_stock($product_id, $store_id, $batch_no)
    {
        $this->db->select("SUM(quantity) as totalPurchaseQnty");
        $this->db->from('product_purchase_details');
        $this->db->where('product_id', $product_id);
        $this->db->where('store_id', $store_id);
        $this->db->where('batch_no', $batch_no);
        $purchase = $this->db->get()->row();


        $this->db->select("SUM(quantity) as totalTransQnty");
        $this->db->from('transfer_details');
        $this->db->where('product_id', $product_id);
        $this->db->where('t_store_id', $store_id);
        $this->db->where('batch_no', $batch_no);
        $transfer_details = $this->db->get()->row();

        $this->db->select("SUM(quantity) as totalSalesQnty");
        $this->db->from('invoice_details');
        $this->db->where('product_id', $product_id);
        $this->db->where('store_id', $store_id);
        $this->db->where('batch_no', $batch_no);
        $sales = $this->db->get()->row();

        $stock = (($purchase->totalPurchaseQnty + $transfer_details->totalTransQnty) - $sales->totalSalesQnty);
        return $stock;
    }

    // check variant wise product price
    public function check_variant_wise_price($product_id, $variant_id, $variant_color = false)
    {
        $pinfo = $this->db->select('price, onsale, onsale_price, variant_price')
            ->from('product_information')
            ->where('product_id', $product_id)
            ->get()->row();

        if ($pinfo->variant_price) {

            $this->db->select('price');
            $this->db->from('product_variants');
            $this->db->where('product_id', $product_id);
            $this->db->where('var_size_id', $variant_id);
            if (!empty($variant_color)) {
                $this->db->where('var_color_id', $variant_color);
            } else {
                $this->db->where("var_color_id IS NULL");
            }
            $varprice = $this->db->get()->row();

            if (!empty($varprice)) {
                $price_arr['price'] = $varprice->price;
                $price_arr['regular_price'] = $pinfo->price;
            } else {
                if (!empty($pinfo->onsale) && !empty($pinfo->onsale_price)) {
                    $price_arr['price'] = $pinfo->onsale_price;
                    $price_arr['regular_price'] = $pinfo->price;
                } else {
                    $price_arr['price'] = $price_arr['regular_price'] = $pinfo->price;
                }
            }
        } else {

            if (!empty($pinfo->onsale) && !empty($pinfo->onsale_price)) {
                $price_arr['price'] = $pinfo->onsale_price;
                $price_arr['regular_price'] = $pinfo->price;
            } else {
                $price_arr['price'] = $price_arr['regular_price'] = $pinfo->price;
            }
        }

        return $price_arr;
    }

    //////////////// pricing ///////////////
    public function check_product_price($product_id, $pricing_id)
    {
        $pinfo = $this->db->select('pricing,price')
            ->from('product_information')
            ->where('product_id', $product_id)
            ->get()->row();

        if ($pinfo->pricing == 1) {

            $this->db->select('product_price');
            $this->db->from('pricing_types_product');
            $this->db->where('product_id', $product_id);
            $this->db->where('pri_type_id', $pricing_id);
            $proprice = $this->db->get()->row();

            if (!empty($proprice)) {
                $price_arr['price'] = $proprice->product_price;
            } else {

                $price_arr['price'] = $pinfo->price;
            }
        } else {


            $price_arr['price'] = $pinfo->price;
        }

        return $price_arr;
    }

    public function get_next_pur_order_id()
    {
        $this->db->select_max('pur_order_id');
        $this->db->from('purchase_orders');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $num = $result->row();
            return $num->pur_order_id + 1;
        }
        return '1';
    }

    //purchase order List
    public function get_purchase_order_list()
    {
        $this->db->select('a.*,b.supplier_name, c.store_name');
        $this->db->from('purchase_orders a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id', 'left');
        $this->db->join('store_set c', 'c.store_id = a.store_id', 'left');
        $this->db->order_by('pur_order_id', 'desc');
        $this->db->order_by('a.purchase_date', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Purchase Order entry
    public function purchase_order_entry($purchase_id)
    {
        //Generator purchase id
        $p_id = $this->input->post('product_id', TRUE);
        $supplier_id = $this->input->post('supplier_id', TRUE);
        $quantity = $this->input->post('product_quantity', TRUE);
        $variant_id = $this->input->post('variant_id', TRUE);
        $color_variant = $this->input->post('color_variant', TRUE);
        $color = $this->input->post('colorv', TRUE);
        $size = $this->input->post('sizev', TRUE);
        $discount = $this->input->post('discount', TRUE);

        //start for total discount
        //إجمالي الخصم على مستوى الفاتورة
        $total_discount = floatval($this->input->post('total_purchase_dis', TRUE));
        //إجمالي الفاتورة بعد الخصم الخاص بكل منتج و قبل الضريبة
        $sub_total = floatval($this->input->post('sub_total_price', TRUE));
        // توزيع الخصم على إجمالي الفاتورة لمعرفة نسبة الخصم
        $ratio = $total_discount / $sub_total;
        //End for total discount


        $vat_rate = $this->input->post('vat_rate', TRUE);
        $vat = $this->input->post('vat', TRUE);

        // $batch        =$this->input->post('batch_no',true);
        $expiry = $this->input->post('expiry_date', true);

        //Variant id required check
        $result = array();
        //        foreach ($p_id as $k => $v) {
        //            if (empty($variant_id[$k])) {
        //                $this->session->set_userdata(array('error_message' => display('variant_is_required')));
        //                redirect('dashboard/Cpurchase/purchase_order');
        //            }
        //        }
        //Product Purchase Details
        $rate = $this->input->post('product_rate', TRUE);
        $t_price = $this->input->post('total_price', TRUE);

        $data2 = [];
        //  for ($i = 0, $n = count($p_id); $i < $n; $i++) {//
        foreach ($p_id as $key => $value) {
            if (!empty($p_id[$key]) && !empty($p_id[$key])) {
                $product_quantity = $quantity[$key];
                $product_rate = $rate[$key];
                $product_id = $p_id[$key];
                $total_price = $t_price[$key];
                $variant = $variant_id[$key];
                $variant_color = @$color_variant[$key];
                $colorid = $color[$key];
                $sizeid = $size[$key];
                $expiry_date = $expiry[$key];
                $product_discount = $discount[$key];
                $i_vat_rate = $vat_rate[$key];
                $i_vat = $vat[$key];

                //start for total discount
                //ضرب نسبة الخصم في إجمالي الصنف لمعرفة مقدار الخصم من كل صنف
                $total_price_dis = $ratio * $total_price;
                //تحديد إجمالي سعر المنتج بعد الخصم
                $total_price_after_dis = $total_price - $total_price_dis;
                //تحديد سعر المنتج الواحد بعد الخصم
                $rate2 = $total_price_after_dis / $product_quantity;
                //End for total discount

                if ($product_quantity > 0) {
                    $data2[] = array(
                        'pur_order_detail_id' => $this->auth->generator(15),
                        'pur_order_id' => $purchase_id,
                        'product_id' => $product_id,
                        'store_id' => $this->input->post('store_id', TRUE),
                        'quantity' => $product_quantity,
                        'rate' => $product_rate,
                        'rate_after_discount' => $rate2,
                        'total_amount' => $total_price,
                        // 'variant_id' => $variant,
                        'variant_id' => $sizeid,
                        // 'variant_color' => (!empty(@$variant_color) ? @$variant_color : NULL),
                        'variant_color' => $colorid,
                        'discount' => $product_discount,
                        'vat_rate' => $i_vat_rate,
                        'vat' => $i_vat,
                        'expiry_date' => date('Y-m-d', strtotime($expiry_date)),
                    );
                }
            }
        }
        $this->db->trans_start();
        $pdate = $this->input->post('purchase_date', TRUE);
        $edate = $this->input->post('expire_date', TRUE);
        $sdate = $this->input->post('supply_date', TRUE);
        //Add Product To Purchase Table
        $data = array(
            'pur_order_id' => $purchase_id,
            'pur_order_no' => 'PO-' . $purchase_id,
            'supplier_id' => $this->input->post('supplier_id', TRUE),
            'store_id' => $this->input->post('store_id', TRUE),
            'total_items' => $this->input->post('total_number_of_items', TRUE),
            'sub_total_price' => $this->input->post('sub_total_price', TRUE),
            'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
            'purchase_date' => !empty($pdate) ? date('Y-m-d', strtotime($pdate)) : '',
            'expire_date' => !empty($edate) ? date('Y-m-d', strtotime($edate)) : '',
            'supply_date' => !empty($sdate) ? date('Y-m-d', strtotime($sdate)) : '',
            'purchase_details' => $this->input->post('purchase_details'),
            'user_id' => $this->session->userdata('user_id'),
            'purchase_vat' => $this->input->post('purchase_vat', TRUE),
            'total_purchase_vat' => $this->input->post('total_purchase_vat', TRUE),
            'total_purchase_dis' => $total_discount,
            'def_currency_id' => $this->input->post('def_currency_id', TRUE),
            'currency_id' => $this->input->post('currency_id', TRUE),
            'conversion_rate' => $this->input->post('conversion', TRUE),
        );
        $this->db->insert('purchase_orders', $data);

        if (!empty($data2)) {
            $this->db->insert_batch('purchase_order_details', $data2);
            $data4 = array(
                'convertion_rate' => $this->input->post('conversion', TRUE),
            );
            $this->db->update('currency_info', $data4, array('currency_id' => $this->input->post('currency_id', TRUE)));
        }


        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Delete purchase Item
    public function delete_purchase_order($purchase_order_id)
    {
        $this->db->trans_start();
        //Delete product_purchase table
        $this->db->where('pur_order_id', $purchase_order_id);
        $this->db->delete('purchase_orders');
        //Delete product_purchase_details table
        $this->db->where('pur_order_id', $purchase_order_id);
        $this->db->delete('purchase_order_details');
        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_purchase_order_by_id($pur_order_id)
    {

        $this->db->select('a.*,b.*,c.product_id,c.product_name,c.product_model,c.category_id,d.supplier_id,d.supplier_name');
        $this->db->from('purchase_orders a');
        $this->db->join('purchase_order_details b', 'b.pur_order_id =a.pur_order_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id', 'left');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id', 'left');
        $this->db->where('a.pur_order_id', $pur_order_id);
        $this->db->order_by('a.pur_order_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_po_shortinfo_by_id($pur_order_id)
    {
        $this->db->select('a.*,d.*');
        $this->db->from('purchase_orders a');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id', 'left');
        $this->db->where('a.pur_order_id', $pur_order_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_purchase_order_details($pur_order_id)
    {
        $this->db->select('a.*, b.*, c.variant_name, d.variant_name as variant_color,e.rc_quantity, e.rc_rate, e.rc_total_amount,,f.rt_quantity, f.rt_rate, f.rt_total_amount,g.unit_short_name');
        $this->db->from('purchase_order_details a');
        $this->db->join('product_information b', 'b.product_id=a.product_id', 'left');
        $this->db->join('unit g', 'g.unit_id = b.unit', 'left');
        $this->db->join('variant c', 'c.variant_id=a.variant_id', 'left');
        $this->db->join('variant d', 'd.variant_id=a.variant_color', 'left');
        $this->db->join('purchase_order_receive e', 'e.pur_order_detail_id=a.pur_order_detail_id', 'left');
        $this->db->join('purchase_order_return f', 'f.pur_order_detail_id=a.pur_order_detail_id', 'left');
        $this->db->where('a.pur_order_id', $pur_order_id);
        $result = $this->db->get()->result_array();
        return $result;
    }

    // Purchase order update
    public function purchase_order_receive($pur_order_id)
    {
        $check_receive_status = $this->db->select('receive_status')->from('purchase_orders')->where('pur_order_id', $pur_order_id)->get()->row();
        if ($check_receive_status->receive_status == 0) {
            $p_id = $this->input->post('product_id', TRUE);
            $pur_order_detail_ids = $this->input->post('pur_order_detail_id', TRUE);
            $supplier_id = $this->input->post('supplier_id', TRUE);
            $invoice_no = $this->input->post('invoice_no', TRUE);
            $quantity = $this->input->post('product_quantity', TRUE);
            $variant_id = $this->input->post('variant_id', TRUE);
            $color_variant = $this->input->post('color_variant', TRUE);

            //Product Purchase Details
            $rate = $this->input->post('product_rate', TRUE);
            $t_price = $this->input->post('total_price', TRUE);

            //start for total discount
            //إجمالي الخصم على مستوى الفاتورة
            $total_discount = $this->input->post('total_purchase_dis', TRUE);
            //إجمالي الفاتورة بعد الخصم الخاص بكل منتج و قبل الضريبة
            $sub_total = $this->input->post('sub_total_price', TRUE);
            // توزيع الخصم على إجمالي الفاتورة لمعرفة نسبة الخصم
            $ratio = $total_discount / $sub_total;
            //End for total discount

            $data2 = [];
            // for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            foreach ($p_id as $key => $value) {
                if (!empty($p_id[$key]) && !empty($p_id[$key])) {
                    $pur_order_detail_id = $pur_order_detail_ids[$key];
                    $product_quantity = $quantity[$key];
                    $product_rate = $rate[$key];
                    $product_id = $p_id[$key];
                    $total_price = $t_price[$key];
                    $variant = $variant_id[$key];
                    $variant_color = $color_variant[$key];

                    //start for total discount
                    //ضرب نسبة الخصم في إجمالي الصنف لمعرفة مقدار الخصم من كل صنف
                    $total_price_dis = $ratio * $total_price;
                    //تحديد إجمالي سعر المنتج بعد الخصم
                    $total_price_after_dis = $total_price - $total_price_dis;
                    //تحديد سعر المنتج الواحد بعد الخصم
                    $rate2 = $total_price_after_dis / $product_quantity;
                    //End for total discount

                    if ($product_quantity > 0) {
                        $data2[] = array(
                            'pur_order_detail_id' => $pur_order_detail_id,
                            'pur_order_id' => $pur_order_id,
                            'product_id' => $product_id,
                            'rc_quantity' => $product_quantity,
                            'rc_rate' => $product_rate,
                            'rc_rate_after_discount' => $rate2,
                            'rc_total_amount' => $total_price
                        );
                    }
                }
            }
            $this->db->trans_start();
            //Add Product To Purchase Table
            $data = array(
                'invoice_no' => $this->input->post('invoice_no', TRUE),
                'receive_status' => 1,
                'total_purchase_dis_rc' => $this->input->post('total_purchase_dis', TRUE)
            );
            $this->db->update('purchase_orders', $data, array('pur_order_id' => $pur_order_id));
            $this->db->delete('purchase_order_receive', array('pur_order_id' => $pur_order_id));
            $this->purchase_order_receive_entry();
            if (!empty($data2)) {
                $this->db->insert_batch('purchase_order_receive', $data2);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function purchase_order_update($pur_order_id)
    {
        //Generator purchase id
        $pur_order_id = $pur_order_id;
        $pur_no = $this->db->select('pur_order_no')->from('purchase_orders')->where('pur_order_id', $pur_order_id)->get()->row();
        if ($pur_no) {
            $check_if_purchased = $this->db->select('purchase_id,invoice_no')->from('product_purchase')->where('pur_order_no', $pur_no->pur_order_no)->get()->row();
            if ($check_if_purchased) {
                $this->update_purchase($check_if_purchased->purchase_id, $check_if_purchased->invoice_no);
            }
        }
        $p_id = $this->input->post('product_id', TRUE);
        $expiry = $this->input->post('expiry_date', true);
        $supplier_id = $this->input->post('supplier_id', TRUE);
        $variants = $this->input->post('variant_id', TRUE);
        $variant_colors = $this->input->post('color_variant', TRUE);
        $discount = $this->input->post('discount', TRUE);

        //start for total discount
        //إجمالي الخصم على مستوى الفاتورة
        $total_discount = $this->input->post('total_purchase_dis', TRUE);
        //إجمالي الفاتورة بعد الخصم الخاص بكل منتج و قبل الضريبة
        $sub_total = $this->input->post('sub_total_price', TRUE);
        // توزيع الخصم على إجمالي الفاتورة لمعرفة نسبة الخصم
        $ratio = $total_discount / $sub_total;
        //End for total discount

        $vat_rate = $this->input->post('vat_rate', TRUE);
        $vat = $this->input->post('vat', TRUE);
        $color = $this->input->post('colorv', TRUE);
        $size = $this->input->post('sizev', TRUE);

        //Supplier & product id relation ship checker.
        //  for ($i = 1, $n = count($p_id); $i <= $n; $i++) {
        foreach ($p_id as $key => $value) {
            $product_id = $p_id[$key];
            $value = $this->product_supplier_check($product_id, $supplier_id);
            if ($value == 0) {
                $this->session->set_userdata('error_message', display("product_and_supplier_did_not_match"));
                redirect(base_url('dashboard/Cpurchase/purchase_order'));
            }
        }
        //Variant id required check
        $result = array();
        //        foreach ($p_id as $k => $v) {
        //            if (empty($variants[$k])) {
        //                $this->session->set_userdata(array('error_message' => display('variant_is_required')));
        //                redirect(base_url('dashboard/Cpurchase/purchase_order'));
        //            }
        //        }
        //Update Product Purchase Table
        $pdate = $this->input->post('purchase_date', TRUE);
        $edate = $this->input->post('expire_date', TRUE);
        $sdate = $this->input->post('supply_date', TRUE);
        $data = array(
            'pur_order_no' => $this->input->post('purchase_order', TRUE),
            'supplier_id' => $this->input->post('supplier_id', TRUE),
            'store_id' => $this->input->post('store_id', TRUE),
            'purchase_vat' => $this->input->post('purchase_vat', TRUE),
            'total_purchase_vat' => $this->input->post('total_purchase_vat', TRUE),
            'total_purchase_dis' => $total_discount,
            'sub_total_price' => $this->input->post('sub_total_price', TRUE),
            'total_items' => $this->input->post('total_number_of_items', TRUE),
            'grand_total_amount' => $this->input->post('grand_total_price', TRUE),
            'purchase_date' => date('Y-m-d', strtotime($pdate)),
            'supply_date' => date('Y-m-d', strtotime($sdate)),
            'expire_date' => date('Y-m-d', strtotime($edate)),
            'purchase_details' => $this->input->post('purchase_details', TRUE),
        );

        $this->db->update('purchase_orders', $data, array('pur_order_id' => $pur_order_id));
        //Delete old purchase order details info
        if (!empty($pur_order_id)) {
            $this->db->where('pur_order_id', $pur_order_id);
            $this->db->delete('purchase_order_details');
        }

        //Product Purchase Details
        $rate = $this->input->post('product_rate', TRUE);
        $quantity = $this->input->post('product_quantity', TRUE);
        $t_price = $this->input->post('total_price', TRUE);
        $purchase_detail_id = $this->input->post('purchase_detail_id', TRUE);

        // for ($i = 1, $n = count($p_id); $i < $n; $i++) {
        foreach ($p_id as $key => $value) {
            if (!empty($p_id[$key]) && !empty($p_id[$key])) {
                $product_quantity = $quantity[$key];
                $product_rate = $rate[$key];
                $product_id = $p_id[$key];
                $expiry_date = $expiry[$key];
                $total_price = $t_price[$key];
                //  $variant_id = $variants[$i];
                $variant_id = $size[$key];
                // $variant_color = (!empty($variant_colors[$i]) ? $variant_colors[$i] : NULL);
                $variant_color = $color[$key];
                $product_discount = $discount[$key];
                $i_vat_rate = $vat_rate[$key];
                $i_vat = $vat[$key];

                //start for total discount
                //ضرب نسبة الخصم في إجمالي الصنف لمعرفة مقدار الخصم من كل صنف
                $total_price_dis = $ratio * $total_price;
                //تحديد إجمالي سعر المنتج بعد الخصم
                $total_price_after_dis = $total_price - $total_price_dis;
                //تحديد سعر المنتج الواحد بعد الخصم
                $rate2 = $total_price_after_dis / $product_quantity;
                //End for total discount

                $data1 = array(
                    'pur_order_detail_id' => $this->auth->generator(15),
                    'pur_order_id' => $pur_order_id,
                    'product_id' => $product_id,
                    'variant_id' => $variant_id,
                    // 'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                    'variant_color' => $variant_color,
                    'expiry_date' => date('Y-m-d', strtotime($expiry_date)) != '1970-01-01' ? date('Y-m-d', strtotime($expiry_date)) : '',
                    'store_id' => $this->input->post('store_id', TRUE),
                    'quantity' => $product_quantity,
                    'rate' => $product_rate,
                    'rate_after_discount' => $rate2,
                    'discount' => $product_discount,
                    'vat_rate' => $i_vat_rate,
                    'vat' => $i_vat,
                    'total_amount' => $total_price,
                );

                if (!empty($quantity)) {
                    $this->db->insert('purchase_order_details', $data1);
                }
            }
        }
        return true;
    }

    public function return_purchase_order()
    {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                //Generator purchase id
                $purchase_id = $this->input->post('purchase_id', TRUE);
                $p_id = $this->input->post('product_id', TRUE);
                $batch = $this->input->post('batch_no', true);
                $expiry = $this->input->post('expiry_date', true);
                $supplier_id = $this->input->post('supplier_id', TRUE);
                $variants = $this->input->post('variant_id', TRUE);
                $variant_colors = $this->input->post('color_variant', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $vat_rate = $this->input->post('vat_rate', TRUE);
                $vat = $this->input->post('vat', TRUE);

                //Supplier & product id relation ship checker.
                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_id = $p_id[$i];
                    $value = $this->product_supplier_check($product_id, $supplier_id);
                    if ($value == 0) {
                        $this->session->set_userdata('error_message', display("product_and_supplier_did_not_match"));
                        redirect('dashboard/Cpurchase/purchase_order');
                    }
                }
                //Variant id required check
                $result = array();
                foreach ($p_id as $k => $v) {
                    if (empty($variants[$k])) {
                        $this->session->set_userdata(array('error_message' => display('variant_is_required')));
                        redirect('dashboard/Cpurchase');
                    }
                }

                //proof of purchase expense 
                $cost_sectors = $this->input->post('bank_id', TRUE);
                if (!empty($cost_sectors)) {

                    $this->db->where('purchase_id', $purchase_id);
                    $result = $this->db->delete('proof_of_purchase_expese');
                }

                //delete Product Purchase Table
                $this->db->where('purchase_id', $purchase_id);
                $result = $this->db->delete('product_purchase');



                //delete Product from Supplier Ledger
                $this->db->where('purchase_id', $purchase_id);
                $this->db->delete('supplier_ledger');

                //Delete old purchase details info
                if (!empty($purchase_id)) {
                    //find previous purchase history and reduce the stock
                    $purchase_history = $this->db->select('*')->from('product_purchase_details')->where('purchase_id', $purchase_id)->get()->result_array();
                    if (count($purchase_history) > 0) {
                        foreach ($purchase_history as $purchase_item) {
                            //update
                            $check_stock = $this->check_stock($purchase_item['store_id'], $purchase_item['product_id'], $purchase_item['variant_id'], $purchase_item['variant_color']);
                            $stock = array(
                                'quantity' => $check_stock->quantity - $purchase_item['quantity']
                            );
                            if (!empty($purchase_item['store_id'])) {
                                $this->db->where('store_id', $purchase_item['store_id']);
                            }
                            if (!empty($purchase_item['product_id'])) {
                                $this->db->where('product_id', $purchase_item['product_id']);
                            }
                            if (!empty($purchase_item['variant_id'])) {
                                $this->db->where('variant_id', $purchase_item['variant_id']);
                            }
                            if (!empty($purchase_item['variant_color'])) {
                                $this->db->where('variant_color', $purchase_item['variant_color']);
                            }
                            $this->db->update('purchase_stock_tbl', $stock);
                            //update
                        }
                    }
                    //find previous purchase history and reduce the stock
                    $this->db->where('purchase_id', $purchase_id);
                    $this->db->delete('product_purchase_details');
                    //Delete transfer data from transfer
                    $this->db->where('purchase_id', $purchase_id);
                    $this->db->delete('transfer');
                }

                $this->load->model('accounting/account_model');
                $previous_purchases = $this->db->select('*')->from('acc_transaction')->where('VNo', 'p-' . $purchase_id)->get()->result_array();

                if (count($previous_purchases) > 0) {
                    $transection_reverse = array();
                    foreach ($previous_purchases as $key => $purchases) {
                        $ID = $purchases['ID'];
                        $fy_id = $purchases['fy_id'];
                        $VNo = $purchases['VNo'];
                        $Vtype = $purchases['Vtype'];
                        $VDate = $purchases['VDate'];
                        $COAID = $purchases['COAID'];
                        $Narration = $purchases['Narration'];
                        $Debit = $purchases['Debit'];
                        $Credit = $purchases['Credit'];
                        $IsPosted = $purchases['IsPosted'];
                        $is_opening = $purchases['is_opening'];
                        $store_id = $purchases['store_id'];
                        $CreateBy = $this->session->userdata('user_id');
                        $createdate = date('Y-m-d H:i:s');
                        $UpdateBy = $this->session->userdata('user_id');
                        $IsAppove = $purchases['IsAppove'];

                        $transection_reverse[] = array(
                            'fy_id' => $fy_id,
                            'VNo' => $VNo,
                            'Vtype' => $Vtype,
                            'VDate' => $createdate,
                            'COAID' => $COAID,
                            'Narration' => 'recerse transection ' . $Narration,
                            'Debit' => $Credit,
                            'Credit' => $Debit,
                            'IsPosted' => $IsPosted,
                            'CreateBy' => $CreateBy,
                            'CreateDate' => $createdate,
                            'store_id' => $store_id,
                            'IsAppove' => 1
                        );
                    }

                    $reverse = $this->db->insert_batch('acc_transaction', $transection_reverse);
                }

                // Woocommerce Stock update
                $woocom_stock = $this->input->post('woocom_stock', TRUE);
                if (check_module_status('woocommerce') && ($woocom_stock == '1')) {

                    $this->load->library('woocommerce/woolib/woo_lib');
                    $this->load->model('woocommerce/woo_model');
                    $this->woo_lib->connection();
                    $def_store = $this->woo_model->get_def_store();

                    $woo_stock = [];
                    for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                        $product_quantity = $quantity[$i];
                        $product_id = $p_id[$i];
                        $variant = $variants[$i];
                        $fulldata = $woo_data = [];
                        $product_stock = 0;


                        $prodinfo = $this->woo_model->get_product_sync_by_local_id($product_id);

                        if (!empty($prodinfo)) {
                            if ($prodinfo->woo_product_type == 'variable') {

                                $varinfo = $this->woo_model->get_variant_sync_by_local($product_id, $variant);

                                if (!empty($varinfo->woo_product_id) && !empty($varinfo->woo_variant_id)) {
                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $variant);
                                    $woo_data[] = array(
                                        'id' => $varinfo->woo_variant_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );
                                    if (!empty($woo_data)) {
                                        $fulldata['update'] = $woo_data;
                                        $woovarinfo = $this->woo_lib->post_request(array('param' => 'products/' . $varinfo->woo_product_id . '/variations/batch'), $fulldata);
                                    }
                                }
                            } else {
                                $pdef_info = $this->woo_model->get_product_variant_info($product_id);
                                if (!empty($pdef_info)) {
                                    $product_stock = $this->woo_model->get_product_stock($def_store->store_id, $product_id, $pdef_info->default_variant);
                                    $woo_stock[] = array(
                                        'id' => $prodinfo->woo_product_id,
                                        'manage_stock' => TRUE,
                                        'stock_quantity' => $product_stock,
                                        'stock_status' => (intval($product_stock) > 0 ? 'instock' : 'outofstock')
                                    );
                                }
                            }
                        }
                    }
                    if (!empty($woo_stock)) { //update global stock
                        $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                    }
                }
                return true;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect('Admin_dashboard');
            }
        }
    }

    // Product Return
    public function purchase_order_return($pur_order_id)
    {
        $this->return_purchase_order();

        $p_id = $this->input->post('product_id', TRUE);
        $pur_order_detail_ids = $this->input->post('pur_order_detail_id', TRUE);
        $supplier_id = $this->input->post('supplier_id', TRUE);
        $invoice_no = $this->input->post('invoice_no', TRUE);
        $quantity = $this->input->post('product_quantity', TRUE);
        $variant_id = $this->input->post('variant_id', TRUE);
        $color_variant = $this->input->post('color_variant', TRUE);
        //Product Purchase Details
        $rate = $this->input->post('product_rate', TRUE);
        $t_price = $this->input->post('total_price', TRUE);
        $data2 = [];
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $pur_order_detail_id = $pur_order_detail_ids[$i];
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $variant = $variant_id[$i];
            $variant_color = $color_variant[$i];

            if ($product_quantity > 0) {
                $data2[] = array(
                    'pur_order_detail_id' => $pur_order_detail_id,
                    'pur_order_id' => $pur_order_id,
                    'product_id' => $product_id,
                    'rt_quantity' => $product_quantity,
                    'rt_rate' => $product_rate,
                    'rt_total_amount' => $total_price
                );
            }
        }

        $this->db->trans_start();

        //Add Product To Purchase Table
        $data = array(
            'return_status' => 1
        );
        $this->db->update('purchase_orders', $data, array('pur_order_id' => $pur_order_id));

        $this->db->delete('purchase_order_return', array('pur_order_id' => $pur_order_id));

        if (!empty($data2)) {
            $this->db->insert_batch('purchase_order_return', $data2);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_batch_wise_product($product_id = null, $variant_id = null, $variant_color = null, $store_id = null)
    {
        $this->db->select('batch_no,expiry_date');
        $this->db->from('product_purchase_details');
        $this->db->where('product_id', $product_id);
        if (!empty($variant_id)) {
            $this->db->where('variant_id', $variant_id);
        }
        if (!empty($variant_color)) {
            $this->db->where('variant_color', $variant_color);
        }
        if (!empty($store_id)) {
            $this->db->where('store_id', $store_id);
        }
        $query = $this->db->get();
        $batch_wise_product_list = $query->result();
        $batchHtml = "";
        if (!empty($batch_wise_product_list)) {
            $batchHtml .= '<option value=""></option>';
            foreach ($batch_wise_product_list as $batch) {
                $batchHtml .= "<option value=" . $batch->batch_no . ">" . $batch->batch_no . '(' . $batch->expiry_date . ')' . "</option>";
            }
        }
        return $batchHtml;
    }

    public function check_batch_wise_transfer_product($product_id = null, $variant_id = null, $variant_color = null, $store_id = null)
    {
        $this->db->select('a.batch_no,b.expiry_date');
        $this->db->from('transfer_details a');
        $this->db->join('product_purchase_details b', 'b.batch_no = a.batch_no', 'left');
        $this->db->where('a.product_id', $product_id);
        if (!empty($variant_id)) {
            $this->db->where('a.variant_id', $variant_id);
        }
        if (!empty($variant_color)) {
            $this->db->where('a.variant_color', $variant_color);
        }
        if (!empty($store_id)) {
            $this->db->where('a.t_store_id', $store_id);
        }
        $this->db->group_by('a.batch_no');
        $query = $this->db->get();
        $batch_wise_product_list = $query->result();
        $batchHtml = "";
        if (!empty($batch_wise_product_list)) {
            $batchHtml .= '<option value=""></option>';
            foreach ($batch_wise_product_list as $batch) {
                $batchHtml .= "<option value=" . $batch->batch_no . ">" . $batch->batch_no . '(' . $batch->expiry_date . ')' . "</option>";
            }
        }
        return $batchHtml;
    }

    //purchase return List
    public function purchase_return_list()
    {
        $this->db->select('a.*,b.supplier_name,c.invoice_no,c.invoice');
        $this->db->from('product_purchase_return a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->join('product_purchase c', 'c.purchase_id = a.purchase_id');
        $this->db->order_by('a.return_date', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve purchase_details_data
    public function purchase_return_details_data($purchase_return_id)
    {

        $this->db->select('a.*,b.*,c.*,d.product_id,d.product_name,d.product_model,f.variant_name,p.invoice_no');
        $this->db->from('product_purchase_return a');
        $this->db->join('product_purchase p', 'p.purchase_id = a.purchase_id');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->join('product_purchase_return_details c', 'c.return_id = a.purchase_return_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('variant f', 'f.variant_id = c.variant_id');
        $this->db->where('a.purchase_return_id', $purchase_return_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve purchase Edit Data
    public function retrieve_purchase_return_editdata($purchase_id)
    {
        $this->db->select('a.*,b.*,c.product_id,c.product_name,c.product_model,d.supplier_id,d.supplier_name');
        $this->db->from('product_purchase_return a');
        $this->db->join('product_purchase_return_details b', 'b.return_id =a.purchase_return_id');
        $this->db->join('product_information c', 'c.product_id = b.product_id');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');
        $this->db->where('a.purchase_id', $purchase_id);
        $this->db->order_by('a.details', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function return_detail($purchase_return_id)
    {
        $this->db->select('a.*,b.product_name,b.product_model');
        $this->db->from('product_purchase_return_details a');
        $this->db->where('a.return_id', $purchase_return_id);
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function purchase_expense_detail($purchase_id)
    {
        $purchase_expense_detail = $this->db->select('*')->from('proof_of_purchase_expese')->where('purchase_id', $purchase_id)->get()->result();
        return $purchase_expense_detail;
    }

    public function total_purchase_expense($purchase_id)
    {
        $total_purchase_expense = $this->db->select('SUM(purchase_expense) as purchase_expense')->from('proof_of_purchase_expese')->where('purchase_id', $purchase_id)->get()->result_array();
        return $total_purchase_expense;
    }
}
