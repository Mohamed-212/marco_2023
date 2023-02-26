<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoices extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard/Customers');
        $this->load->model('dashboard/Cfiltration_model');
    }

    //Select All pricing_types
    public function select_all_pri_type() {
        $query = $this->db->select('*')
                ->from('pricing_types')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count invoice
    public function count_invoice() {
        return $this->db->count_all("invoice");
    }

    //Count store invoice
    public function total_store_invoice() {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('store_id', $this->session->userdata('store_id'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Invoice List
    public function invoice_list() {
        $this->db->select('a.*,b.*,c.order');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('order c', 'c.order_id = a.order_id', 'left');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit(10);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Invoice List count
    public function count_invoice_list($filter = []) {
        $this->db->select('a.invoice_id');
        $this->db->from('invoice a');
        if (!empty($filter['invoice_no'])) {
            $this->db->where('a.invoice', $filter['invoice_no']);
        }
        if (!empty($filter['customer_id'])) {
            $this->db->where('a.customer_id', $filter['customer_id']);
        }
        if (!empty($filter['employee_id'])) {
            $this->db->where('a.employee_id', $filter['employee_id']);
        }
        if (!empty($filter['date'])) {
            // $this->db->where("STR_TO_DATE(a.date, '%m-%d-%Y')=DATE('" . $filter['date'] . "')");
            $this->db->where("DATE(a.created_at) = DATE('" . date('Y-m-d', strtotime($filter['date'])) . "')");
        }
        if (!empty($filter['invoice_status'])) {
            $this->db->where('a.invoice_status', $filter['invoice_status']);
        }
        $query = $this->db->count_all_results();
        return $query;
    }

   

    //Invoice List
    public function get_invoice_list($filter, $start, $limit) {
        $this->db->select('a.*, a.created_at as date_time,b.*,c.order');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('order c', 'c.order_id = a.order_id', 'left');
        if (!empty($filter['invoice_no'] != '')) {
            $this->db->where('a.invoice', $filter['invoice_no']);
        }
        if ($filter['customer_id'] != '') {
            $this->db->where('a.customer_id', $filter['customer_id']);
        }
        if ($filter['from_date'] != '') {
            $this->db->where("DATE(a.created_at)>=DATE('" . date('Y-m-d', strtotime($filter['from_date'])) . "')");
        }
        if ($filter['to_date'] != '') {
            $this->db->where("DATE(a.created_at)<=DATE('" . date('Y-m-d', strtotime($filter['to_date'])) . "')");
        }
        if ($filter['invoice_status'] != '') {
            $this->db->where('a.invoice_status', $filter['invoice_status']);
        }
        if ($filter['employee_id']!='') {
            $this->db->where('a.employee_id', $filter['employee_id']);
        }
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return false;
    }

    //Invoice List count
    public function count_invoice_return_list($filter = []) {
        $this->db->select('a.invoice_id');
        $this->db->from('invoice_return a');
        $this->db->group_by('a.return_invoice_id');
        if (!empty($filter['invoice_no'])) {
            $this->db->where('a.invoice_id', $filter['invoice_no']);
        }
        if (!empty($filter['customer_id'])) {
            $this->db->where('a.customer_id', $filter['customer_id']);
        }
        if (!empty($filter['employee_id'])) {
            $this->db->where('a.employee_id', $filter['employee_id']);
        }
        if (!empty($filter['date'])) {
            $this->db->where("STR_TO_DATE(a.create_at, '%m-%d-%Y')=DATE('" . $filter['date'] . "')");
        }
        // if (!empty($filter['invoice_status'])) {
        //     $this->db->where('a.invoice_status', $filter['invoice_status']);
        // }
        $query = $this->db->count_all_results();
        return $query;
    }

    //Invoice List
    public function get_invoice_return_list($filter, $start, $limit) {
        $this->db->select('a.*,b.*');
        $this->db->from('invoice_return a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->group_by('a.return_invoice_id');
        if (!empty($filter['invoice_no'] != '')) {
            $this->db->where('a.return_invoice_id', $filter['invoice_no']);
        }
        if ($filter['customer_id'] != '') {
            $this->db->where('a.customer_id', $filter['customer_id']);
        }
        if ($filter['from_date'] != '') {
            $this->db->where("STR_TO_DATE(a.created_at, '%m-%d-%Y')>=DATE('" . $filter['from_date'] . "')");
        }
        if ($filter['to_date'] != '') {
            $this->db->where("STR_TO_DATE(a.created_at, '%m-%d-%Y')<=DATE('" . $filter['to_date'] . "')");
        }
        // if ($filter['invoice_status'] != '') {
        //     $this->db->where('a.invoice_status', $filter['invoice_status']);
        // }
        if ($filter['employee_id']!='') {
            $this->db->where('a.employee_id', $filter['employee_id']);
        }
        $this->db->order_by('a.invoice_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return false;
    }

    //POS customer setup
    public function pos_customer_setup() {
        $query = $this->db->select('a.customer_id,a.customer_name')
                ->from('customer_information a')
                ->where('a.customer_name', 'Walking Customer')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //Customer list
    public function customer_list() {
        $query = $this->db->select('*')
                ->from('customer_information')
                ->where('customer_name !=', 'Walking Customer')
                ->order_by('customer_name', 'asc')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //Stock Report by date
    public function stock_report_bydate($product_id) {
        $this->db->select("
				SUM(d.quantity) as 'totalSalesQnty',
				SUM(b.quantity) as 'totalPurchaseQnty',
				(sum(b.quantity) - sum(d.quantity)) as stock
			");

        $this->db->from('product_information a');
        $this->db->join('product_purchase_details b', 'b.product_id = a.product_id', 'left');
        $this->db->join('invoice_details d', 'd.product_id = a.product_id', 'left');
        $this->db->join('product_purchase e', 'e.purchase_id = b.purchase_id', 'left');
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_name', 'asc');

        if (empty($product_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            //Single product information 
            $this->db->where('a.product_id', $product_id);
        }
        $query = $this->db->get();

        return $query->row();
    }

    //Stock Report by date
    public function stock_report_bydate_pos($product_id) {
        $purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
                ->from('purchase_stock_tbl')
                ->where('product_id', $product_id)
                ->get()
                ->row();

        $sales = $this->db->select("SUM(quantity) as totalSalesQnty")
                ->from('invoice_stock_tbl')
                ->where('product_id', $product_id)
                ->get()
                ->row();

        return $stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
    }

    public function check_stock($store_id = null, $product_id = null, $variant = null, $variant_color = null) {
        $this->db->select('stock_id,quantity');
        $this->db->from('invoice_stock_tbl');
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

    //Invoice entry
    public function invoice_entry($order_id = null, $quotation_id = null) {
      
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $invoice_id = generator(15);
                $quantity = $this->input->post('product_quantity', TRUE);
                $available_quantity = $this->input->post('available_quantity', TRUE);
                $product_id = $this->input->post('product_id', TRUE);
                $payment_id = $this->input->post('payment_id', TRUE);
                $product_type = $this->input->post('product_type', TRUE);

                //Stock availability check
                $result = array();
                foreach ($available_quantity as $k => $v) {
                    if ($v < $quantity[$k]) {
                        $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                        redirect('dashboard/Cinvoice');
                    }
                }

                //Product existing check
                if ($product_id == null) {
                    $this->session->set_userdata(array('error_message' => display('please_select_product')));
                    redirect('dashboard/Cinvoice');
                }

                //payment account existing check
                if ((float)$this->input->post('paid_amount', TRUE) > 0 && empty($payment_id)) {
                    $this->session->set_userdata(array('error_message' => display('please_select_payment')));
                    redirect('dashboard/Cinvoice');
                }

                //Customer existing check
                if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
                    $this->session->set_userdata(array('error_message' => display('please_select_customer')));
                    redirect(base_url() . 'dashboard/Cinvoice');
                }

                //Customer data Existence Check.
                if ($this->input->post('customer_id', TRUE)) {
                    $customer_id = $this->input->post('customer_id', TRUE);
                } else {
                    $customer_id = generator(15);
                    //Customer  basic information adding.
                    $data = array(
                        'customer_id' => $customer_id,
                        'customer_name' => $this->input->post('customer_name_others', TRUE),
                        'customer_address_1' => $this->input->post('customer_name_others_address', TRUE),
                        'customer_mobile' => $this->input->post('customer_mobile_no', TRUE),
                        'customer_email' => "NONE",
                        'status' => 1
                    );
                    $this->Customers->customer_entry($data);
                    //Previous balance adding -> Sending to customer model to adjust the data.
                    $this->Customers->previous_balance_add(0, $customer_id);
                }

                // create customer head start
                $check_customer = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->get()->row();
                if (check_module_status('accounting') == 1) {
                    $this->load->model('accounting/account_model');
                    
                    if (!empty($check_customer)) {
                        $customer_data = $data = array(
                            'customer_id' => $customer_id,
                            'customer_name' => $check_customer->customer_name,
                        );
                    } else {
                        $customer_data = $data = array(
                            'customer_id' => $customer_id,
                            'customer_name' => $this->input->post('customer_id', TRUE)
                        );
                    }
                    $this->account_model->insert_customer_head($customer_data);
                }

                $customerName = $check_customer;


                $invoiceNewNo = 'Inv-' . $this->number_generator();

                // create customer head END
                //Full or partial Payment record.
                if ((float)$this->input->post('paid_amount', TRUE) > 0) {
                    $headinfo = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', $this->input->post('payment_id', TRUE))->get()->row();
                    //Insert to customer_ledger Table 
                    $data2 = array(
                        'transaction_id' => generator(15),
                        'customer_id' => $customer_id,
                        'invoice_no' => $invoice_id,
                        'date' => DateTime::createFromFormat('d-m-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                        'amount' => $this->input->post('paid_amount', TRUE),
                        'payment_type' => 1,
                        'status' => 1,
                        'cl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                        'voucher' => 'Rcv',
                        'details' => "سند قبض رقم PLHH - عميل $customerName->customer_name - حواله على $headinfo->HeadName الشركة",
                        'Vno' => $invoiceNewNo,
                        'acc' => 'Inv-' . $invoice_id
                    );
                    $this->db->insert('customer_ledger', $data2);
                }

                // if ($this->input->post('is_installment', true) == 1 && (float)$this->input->post('due_amount', TRUE) > 0 && (float)$this->input->post('paid_amount', TRUE) > 0) {
                //     $data2 = array(
                //         'transaction_id' => generator(15),
                //         'customer_id' => $customer_id,
                //         'invoice_no' => $invoice_id,
                //         'receipt_no' => $this->auth->generator(15),
                //         'date' => DateTime::createFromFormat('d-m-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                //         'amount' => $this->input->post('due_amount', TRUE),
                //         'status' => 1,
                //         'cl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                //     );
                //     $this->db->insert('customer_ledger', $data2);
                // } else {
                    // 'Inv-' . $invoice_id
                    $t_qty = 0;
                    foreach ($quantity as $q) {
                        $t_qty += $q;
                    }
                    $data2 = array(
                        'transaction_id' => generator(15),
                        'customer_id' => $customer_id,
                        'invoice_no' => $invoice_id,
                        'receipt_no' => $this->auth->generator(15),
                        'description' => 'ITP',
                        'date' => DateTime::createFromFormat('d-m-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                        'amount' => $this->input->post('grand_total_price', TRUE),
                        'status' => 1,
                        'cl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                        'voucher' => 'Sall',
                        'details' => "فاتورة مبيعات رقم PLHH - عميل $customerName->customer_name - عدد $t_qty منتج",
                        'Vno' => $invoiceNewNo,
                        'acc' => 'Inv-'. $invoice_id
                    );
                    $this->db->insert('customer_ledger', $data2);
                // }

                // if ($this->input->post('is_installment', true) == 0) {
                    // Insert to customer ledger Table 
                    // $data2 = array(
                    //     'transaction_id' => generator(15),
                    //     'customer_id' => $customer_id,
                    //     'invoice_no' => $invoice_id,
                    //     'receipt_no' => $this->auth->generator(15),
                    //     'description' => 'ITP',
                    //     'date' => DateTime::createFromFormat('d-m-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                    //     'amount' => $this->input->post('grand_total_price', TRUE),
                    //     'status' => 1,
                    //     'cl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                    // );
                    // $this->db->insert('customer_ledger', $data2);
                // }

                // get current customer balance after invoice creating
                $customerSummaryAfterInvoice = $this->Customers->customer_transection_summary($customer_id);
                $customerBalanceAfterInvoice = $customerSummaryAfterInvoice[1][0]['total_debit']-$customerSummaryAfterInvoice[0][0]['total_credit'];

                //Data inserting into invoice table
                (($this->input->post('total_cgst', true) && $this->input->post('is_quotation', true) == 0) ? $total_cgsti = $this->input->post('total_cgst', true) : $total_cgsti = 0);
                (($this->input->post('total_sgst', true)) ? $total_sgsti = $this->input->post('total_sgst', true) : $total_sgsti = 0);
                (($this->input->post('total_igst', true)) ? $total_igsti = $this->input->post('total_igst', true) : $total_igsti = 0);

                $tota_vati = $total_cgsti + $total_sgsti + $total_igsti;
                $installment_month_no = $this->input->post('month_no', true);
                $data = array(
                    'invoice_id' => $invoice_id,
                    'customer_id' => $customer_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                    'total_amount' => $this->input->post('grand_total_price', TRUE),
                    'invoice' => $invoiceNewNo,
                    'total_discount' => $this->input->post('total_discount', TRUE),
                    'total_vat' => $tota_vati,
                    'is_quotation' => ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
                    'employee_id' => $this->input->post('employee_id', true),
                    'is_installment' => $this->input->post('is_installment', true),
                    'month_no' => $installment_month_no,
                    'due_day' => $this->input->post('due_day', true),
                    'invoice_discount' => $this->input->post('invoice_discount', TRUE),
                    'percentage_discount' => $this->input->post('percentage_discount', TRUE),
                    'user_id' => $this->session->userdata('user_id'),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'paid_amount' => $this->input->post('paid_amount', TRUE),
                    'due_amount' => $this->input->post('due_amount', TRUE),
                    'service_charge' => $this->input->post('service_charge', TRUE),
                    'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
                    'shipping_method' => $this->input->post('shipping_method', TRUE),
                    'invoice_details' => $this->input->post('invoice_details', TRUE),
                    'status' => 5,
                    'created_at' => date("Y-m-d H:i:s", strtotime($this->input->post('invoice_date', TRUE))),
                    'order_id' => $order_id,
                    'quotation_id' => $quotation_id,
                    'product_type' => $product_type,
                    'customer_balance' => $this->input->post('customer_balance', TRUE),
                    'customer_balance_after' => round($customerBalanceAfterInvoice, 2),
                    'payment_id' => $this->input->post('payment_id', TRUE)
                );
                $this->db->insert('invoice', $data);

                // insert installment
                if ($this->input->post('is_installment', true) == 1) {
                    $installment_amount = $this->input->post('amount', TRUE);
                    $installment_due_date = $this->input->post('due_date', TRUE);
                    for ($i = 0; $i < $installment_month_no; $i++) {
                        // echo date('Y-m-d', strtotime($installment_due_date[$i])) . '<br>';
                        $installment_data = array(
                            'invoice_id' => $invoice_id,
                            'amount' => $installment_amount[$i],
                            'due_date' => date('d-m-Y', strtotime($installment_due_date[$i])),
                            'due_date_datetime' => date('Y-m-d H:i:s', strtotime($installment_due_date[$i])),
                        );
                        $this->db->insert('invoice_installment', $installment_data);
                    }
                    // echo "<pre>";print_r($installment_due_date);exit;
                }

                //Invoice details info
                $rate = $this->input->post('product_rate', TRUE);
                $p_id = $this->input->post('product_id', TRUE);
                $total_amount = $this->input->post('total_price', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $inv_disc = (float)$this->input->post('invoice_discount', TRUE);
                
                $percentage_disc = (float)$this->input->post('percentage_discount', TRUE);
                $cgst = $this->input->post('cgst', TRUE);


//                $total_price_vat=array_sum($total_amount)+(float)$this->input->post('total_cgst', TRUE);
//                $total_with_discount_inv=$total_price_vat-$inv_disc-(float)$this->input->post('total_discount', TRUE);
//                $inv_disc_rate  = ($inv_disc+(((float)$percentage_disc/100)*(float)$total_with_discount_inv))/(float)$total_price_vat;

                $total_with_discount_inv=array_sum($total_amount)-(float)$this->input->post('total_discount', TRUE);
                $inv_disc_rate = ($inv_disc+(((float)$percentage_disc/100) * $total_with_discount_inv))/(float)$total_with_discount_inv;

                // echo "<pre>";var_dump($inv_disc_rate);

                $variants = $this->input->post('variant_id', TRUE);
                // var_dump($inv_disc, $total_price_vat, $total_with_discount_inv, $percentage_disc, $inv_disc_rate);
                // $pricing = $this->input->post('pricing', TRUE);
                $color_variants = $this->input->post('color_variant', TRUE);
                $color = $this->input->post('colorv', TRUE);
                $size = $this->input->post('sizev', TRUE);
                $assembly = $this->input->post('assembly', TRUE);
                $batch_no = $this->input->post('batch_no', TRUE);
                $cogs_price = 0;

                //Invoice details for invoice
                for ($i = 0, $n = count($quantity); $i < $n; $i++) {
                    $product_assembly = $assembly[$i];
                    $prices = $this->db->select('a.price, b.*')->from('product_information a')->join('pricing_types_product b', 'b.product_id = a.product_id')->where('a.product_id', $p_id[$i])->get()->result_array();

                    $without_price =  $prices[0]['price'];
                    $whole_price = 0;
                    $customer_price = 0;
                    foreach ($prices as $p) {
                        // var_dump($p);exit;
                        // $without_price = $p['price'];
                        if ($p['pri_type_id'] == 1) {
                            $whole_price = $p['product_price'];
                        }

                        if ($p['pri_type_id'] == 2) {
                            $customer_price = $p['product_price'];
                        }
                    }

                    // if  (!$this->input->post('is_quotation', TRUE)) {
                    //     $without_price += $cgst[$i];
                    //     // var_dump($whole_price , $cgst[$i]);exit;
                    //     $whole_price += $cgst[$i];
                    //     $customer_price += $cgst[$i];
                    // }

                    if ($product_assembly == 1) {
                        $product_quantity = $quantity[$i];
                        $product_rate = $rate[$i];
                        $product_id = $p_id[$i];
                        $discount_rate = $discount[$i];
                        $total_price = $total_amount[$i];
                        //  $variant_id = $variants[$i];
                        $variant_id = $size[$i];
                        //$pricing_id = $pricing[$i];
                        // $variant_color = $color_variants[$i];
                        $variant_color = $color[$i];
                        $batch = $batch_no[$i];
                        $supplier_rate = $this->supplier_rate($product_id); // سعر التكلفة للمنتج الواحد
                        $cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity); // التكلفة للكمية كلها

                        if ($this->input->post('is_quotation', TRUE)) {
                            $without_price_after_disc = (($without_price - $discount_rate) - (($without_price - $discount_rate)  * $inv_disc_rate));
                            $whole_price_after_disc = (($whole_price - $discount_rate) - (($whole_price - $discount_rate) * $inv_disc_rate));
                            $customer_price_after_disc = (($customer_price - $discount_rate) - (($customer_price - $discount_rate) * $inv_disc_rate));
                        } else {
                            $without_price_after_disc = (($without_price - $discount_rate) - (($without_price - $discount_rate)  * $inv_disc_rate) );
                            $whole_price_after_disc = (($whole_price - $discount_rate) - (($whole_price - $discount_rate) * $inv_disc_rate) );
                            $customer_price_after_disc = (($customer_price - $discount_rate) - (($customer_price - $discount_rate) * $inv_disc_rate) );    
                        }

                        $i_disc = $without_price - $without_price_after_disc;
                        if ($this->input->post('pri_type', true) == 1) {
                            $i_disc = $whole_price - $whole_price_after_disc;
                        } elseif ($this->input->post('pri_type', true) == 2) {
                            $i_disc = $customer_price - $customer_price_after_disc;
                        }


                        $invoice_details = array(
                            'invoice_details_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                             'pricing_id' => $this->input->post('pri_type'),
                            'variant_color' => $variant_color,
                            'batch_no' => $batch,
                            'store_id' => $this->input->post('store_id', TRUE),
                            'quantity' => $product_quantity,
                            'rate' => $product_rate,
                            'supplier_rate' => $supplier_rate[0]['supplier_price'],
                            'total_price' => $total_price,
                            'discount' => $discount_rate,
                            'invoice_discount' => $i_disc,
                            'status' => 1,
                            'whole_price' => $whole_price,
                            'sale_price' => $without_price,
                            'without_price_after_disc' => $without_price_after_disc,
                            'whole_price_after_disc' => $whole_price_after_disc,
                            'customer_price_after_disc' => $customer_price_after_disc
                        );

                        if (!empty($quantity)) {
                            $this->db->select('*');
                            $this->db->from('invoice_details');
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('product_id', $product_id);
                            $this->db->where('variant_id', $variant_id);
                            if (!empty($variant_color)) {
                                $this->db->where('variant_color', $variant_color);
                            }
                            $query = $this->db->get();
                            $result = $query->num_rows();
                            if ($result > 0) {
                                $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                                $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('product_id', $product_id);
                                $this->db->where('variant_id', $variant_id);
                                if (!empty($variant_color)) {
                                    $this->db->where('variant_color', $variant_color);
                                }
                                $this->db->update('invoice_details');
                            } else {
                                $this->db->insert('invoice_details', $invoice_details);
                            }
                        }
                        //////////////////////////////////////////////////////////////////////
                        $this->db->select('*');
                        $this->db->from('assembly_products');
                        $this->db->where('parent_product_id', $product_id);
                        $this->db->join('product_information', 'product_information.product_id = assembly_products.child_product_id');
                        $query = $this->db->get();
                        $product_list = $query->result();
                        ///////////////////////////////////////////////////////////////////////////
                        if (!empty($product_list)) {
                            foreach ($product_list as $product) {
                                //                                $invoice_details = array(
                                //                                    'invoice_details_id' => generator(15),
                                //                                    'invoice_id' => $invoice_id,
                                //                                    'product_id' => $product->child_product_id,
                                //                                    'variant_id' => $variant_id,
                                //                                    //  'pricing_id' => $pricing_id,
                                //                                    'variant_color' => $variant_color,
                                //                                    'batch_no' => $batch,
                                //                                    'store_id' => $this->input->post('store_id', TRUE),
                                //                                    'quantity' => $product_quantity,
                                //                                    'rate' => 0,
                                //                                    'supplier_rate' => $product->supplier_price,
                                //                                    'total_price' => 0,
                                //                                    'discount' => 0,
                                //                                    'status' => 1
                                //                                );
                                if (!empty($quantity)) {
                                //                                    $this->db->select('*');
                                //                                    $this->db->from('invoice_details');
                                //                                    $this->db->where('invoice_id', $invoice_id);
                                //                                    $this->db->where('product_id', $product->child_product_id);
                                //                                    $this->db->where('variant_id', $variant_id);
                                //                                    if (!empty($variant_color)) {
                                //                                        $this->db->where('variant_color', $variant_color);
                                //                                    }
                                //                                    $query = $this->db->get();
                                //                                    $result = $query->num_rows();
                                //                                    if ($result > 0) {
                                //                                        $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                                //                                        $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                                //                                        $this->db->where('invoice_id', $invoice_id);
                                //                                        $this->db->where('product_id', $product->child_product_id);
                                //                                        $this->db->where('variant_id', $variant_id);
                                //                                        if (!empty($variant_color)) {
                                //                                            $this->db->where('variant_color', $variant_color);
                                //                                        }
                                //                                        $this->db->update('invoice_details');
                                //                                    } else {
                                //                                        $this->db->insert('invoice_details', $invoice_details);
                                //                                    }

                                    // stock 
                                    $store_id = $this->input->post('store_id', TRUE);
                                    $check_stock = $this->check_stock($store_id, $product->child_product_id, $variant_id, $variant_color);
                                    if (empty($check_stock)) {
                                        // insert
                                        $stock = array(
                                            'store_id' => $store_id,
                                            'product_id' => $product->child_product_id,
                                            'variant_id' => $variant_id,
                                            'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                                            'quantity' => $product_quantity,
                                            'warehouse_id' => '',
                                        );
                                        $this->db->insert('invoice_stock_tbl', $stock);
                                        // insert
                                    } else {
                                        //update
                                        $stock = array(
                                            'quantity' => $check_stock->quantity + $product_quantity
                                        );
                                        if (!empty($store_id)) {
                                            $this->db->where('store_id', $store_id);
                                        }
                                        if (!empty($product->child_product_id)) {
                                            $this->db->where('product_id', $product->child_product_id);
                                        }
                                        if (!empty($variant_id)) {
                                            $this->db->where('variant_id', $variant_id);
                                        }
                                        if (!empty($variant_color)) {
                                            $this->db->where('variant_color', $variant_color);
                                        }
                                        $this->db->update('invoice_stock_tbl', $stock);
                                        //update
                                    }
                                    // stock
                                }
                            }
                        }
                    } else {
                        $product_quantity = $quantity[$i];
                        $product_rate = $rate[$i];
                        $product_id = $p_id[$i];
                        $discount_rate = $discount[$i];
                        $total_price = $total_amount[$i];
                        //  $variant_id = $variants[$i];
                        $variant_id = $size[$i];
                        //$pricing_id = $pricing[$i];
                        // $variant_color = $color_variants[$i];
                        $variant_color = $color[$i];
                        $batch = $batch_no[$i];
                        $supplier_rate = $this->supplier_rate($product_id); // سعر التكلفة للمنتج الواحد
                        $cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity); // التكلفة للكمية كلها

                        // $without_price_after_disc = (($without_price - $discount_rate) - (($without_price - $discount_rate)  * $inv_disc_rate) + $cgst[$i]);
                        // $whole_price_after_disc = (($whole_price - $discount_rate) - (($whole_price - $discount_rate) * $inv_disc_rate) + $cgst[$i]);
                        // $customer_price_after_disc = (($customer_price - $discount_rate) - (($customer_price - $discount_rate) * $inv_disc_rate) + $cgst[$i]);

                        if ($this->input->post('is_quotation', TRUE)) {
                            $without_price_after_disc = (($without_price - $discount_rate) - (($without_price - $discount_rate)  * $inv_disc_rate));
                            $whole_price_after_disc = (($whole_price - $discount_rate) - (($whole_price - $discount_rate) * $inv_disc_rate));
                            $customer_price_after_disc = (($customer_price - $discount_rate) - (($customer_price - $discount_rate) * $inv_disc_rate));
                        } else {
                            $without_price_after_disc = (($without_price - $discount_rate) - (($without_price - $discount_rate)  * $inv_disc_rate));
                            $whole_price_after_disc = (($whole_price - $discount_rate) - (($whole_price - $discount_rate) * $inv_disc_rate));
                            $customer_price_after_disc = (($customer_price - $discount_rate) - (($customer_price - $discount_rate) * $inv_disc_rate));    
                        }
                        

                    // echo "<pre>";var_dump($without_price_after_disc, $whole_price_after_disc, $customer_price_after_disc, $discount_rate, $inv_disc_rate, (float)$inv_disc_rate*((float)$total_price/(float)$product_quantity), $total_price);exit;

                        $i_disc = $without_price - $without_price_after_disc;
                        if ($this->input->post('pri_type', true) == 1) {
                            $i_disc = $whole_price - $whole_price_after_disc;
                        } elseif ($this->input->post('pri_type', true) == 2) {
                            $i_disc = $customer_price - $customer_price_after_disc;
                        }

                        $invoice_details = array(
                            'invoice_details_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                            'pricing_id' => $this->input->post('pri_type'),
                            'variant_color' => $variant_color,
                            'batch_no' => $batch,
                            'store_id' => $this->input->post('store_id', TRUE),
                            'quantity' => $product_quantity,
                            'rate' => $product_rate,
                            'supplier_rate' => $supplier_rate[0]['supplier_price'],
                            'total_price' => $total_price,
                            'discount' => $discount_rate,
                            'invoice_discount' => $i_disc,
                            'status' => 1,
                            'whole_price' => $whole_price,
                            'sale_price' => $without_price,
                            'without_price_after_disc' => $without_price_after_disc,
                            'whole_price_after_disc' => $whole_price_after_disc,
                            'customer_price_after_disc' => $customer_price_after_disc
                        );

                        if (!empty($quantity)) {
                            $this->db->select('*');
                            $this->db->from('invoice_details');
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('product_id', $product_id);
                            $this->db->where('variant_id', $variant_id);
                            if (!empty($variant_color)) {
                                $this->db->where('variant_color', $variant_color);
                            }
                            $query = $this->db->get();
                            $result = $query->num_rows();
                            if ($result > 0) {
                                $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                                $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('product_id', $product_id);
                                $this->db->where('variant_id', $variant_id);
                                if (!empty($variant_color)) {
                                    $this->db->where('variant_color', $variant_color);
                                }
                                $this->db->update('invoice_details');
                            } else {
                                $this->db->insert('invoice_details', $invoice_details);
                            }

                            // stock 
                            $store_id = $this->input->post('store_id', TRUE);
                            $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                            if (empty($check_stock)) {
                                // insert
                                $stock = array(
                                    'store_id' => $store_id,
                                    'product_id' => $product_id,
                                    'variant_id' => $variant_id,
                                    'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                                    'quantity' => $product_quantity,
                                    'warehouse_id' => '',
                                );
                                $this->db->insert('invoice_stock_tbl', $stock);
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
                                if (!empty($variant_id)) {
                                    $this->db->where('variant_id', $variant_id);
                                }
                                if (!empty($variant_color)) {
                                    $this->db->where('variant_color', $variant_color);
                                }
                                $this->db->update('invoice_stock_tbl', $stock);
                                //update
                            }
                            // stock
                        }
                    }
                }

                // SALES/INVOICE TRANSECTIONS ENTRY
                $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                
                if (empty($customer_head)) {
                    $this->load->model('accounting/account_model');
                    $customer_name = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->get()->row();
                    if ($customer_name) {
                        $customer_data = $data = array(
                            'customer_id' => $customer_id,
                            'customer_name' => $customer_name->customer_name,
                        );
                        $this->account_model->insert_customer_head($customer_data);
                        
                    }
                    $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                }
                $createdate = date('Y-m-d H:i:s');
                $receive_by = $this->session->userdata('user_id');
                $date = $createdate;

                $i_vat = $this->db->select('total_vat')->from('invoice')->where('invoice_id', $invoice_id)->get()->row();
                $tota_vat = $i_vat->total_vat;
                $total_with_vat = $this->input->post('grand_total_price', TRUE);
                $cogs_price = $cogs_price;
                $inv_price_without_disc = array_sum($this->input->post('total_price', TRUE));
                $percentage_discount=(((float)$percentage_disc/100)*(float)$total_with_discount_inv);
                $total_discount = (int)$this->input->post('total_discount', TRUE)+(int)$this->input->post('invoice_discount', TRUE)+(int)$percentage_discount;
//                $total_price_before_discount = ($total_with_vat - $tota_vat) + $total_discount;
                $total_price_before_discount = $total_with_vat - $total_discount;
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();

                $payment_id = $this->input->post('payment_id', TRUE);
                //$account_no = $this->input->post('account_no', TRUE);

                //1st customer debit total_with_vat
                $customer_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => $customer_head->HeadCode,
                    'Narration' => 'Sales "total with vat" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => $total_with_vat,
                    'Credit' => 0,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                $this->db->insert('acc_transaction', $customer_debit);

                //2nd Allowed Discount Debit
                $allowed_discount_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 4114,
                    'Narration' => 'Sales "total discount" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => $total_discount,
                    'Credit' => 0,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    //'IsAppove' => 0
                    'IsAppove' => 1
                );
                //3rd Showroom Sales credit
                $showroom_sales_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 5111, // account payable game 11
                    'Narration' => 'Sales "total price before discount" store_credit credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_price_before_discount,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                //4th VAT on Sales
                $vat_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 2114, // account payable game 11
                    'Narration' => 'Sales "total vat" credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $tota_vat,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );

                //5th cost of goods sold debit
                $cogs_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 4111,
                    'Narration' => 'Sales "cost of goods sold" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => $cogs_price,
                    'Credit' => 0, //sales price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                //6th cost of goods sold Main warehouse Credit
                $cogs_main_warehouse_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 1141,
                    'Narration' => '"cost of goods sold" Main warehouse credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $cogs_price, //supplier price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                //7th paid_amount Credit
                if ($this->input->post('paid_amount', TRUE) > 0) {
                    $paid_amount = $this->input->post('paid_amount', TRUE);
                    $customer_credit = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'Inv-' . $invoice_id,
                        'Vtype' => 'Sales',
                        'VDate' => $date,
                        'COAID' => $customer_head->HeadCode,
                        'Narration' => 'Sales "paid_amount" Credit by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                        'Debit' => 0,
                        'Credit' => $paid_amount,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'IsAppove' => 1
                    );
                    $this->db->insert('acc_transaction', $customer_credit);
                    if (!empty($payment_id)) {
                        $payment_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', $payment_id)->get()->row();
                        $bank_debit = array(
                            'fy_id' => $find_active_fiscal_year->id,
                            'VNo' => 'Inv-' . $invoice_id,
                            'Vtype' => 'Sales',
                            'VDate' => $date,
                            'COAID' => $payment_head->HeadCode,
                            'Narration' => 'Sales "paid_amount" debited by cash/bank id: ' . $payment_head->HeadName . '(' . $payment_id . ')',
                            'Debit' => $paid_amount,
                            'Credit' => 0,
                            'IsPosted' => 1,
                            'CreateBy' => $receive_by,
                            'CreateDate' => $createdate,
                            'IsAppove' => 1
                        );
                        $this->db->insert('acc_transaction', $bank_debit);
                    }
                }
                $this->db->insert('acc_transaction', $allowed_discount_debit);
                $this->db->insert('acc_transaction', $showroom_sales_credit);
                $this->db->insert('acc_transaction', $vat_credit);
                $this->db->insert('acc_transaction', $cogs_debit);
                $this->db->insert('acc_transaction', $cogs_main_warehouse_credit);
                // SALES/INVOICE TRANSECTIONS END
                //Tax information
                $cgst = $this->input->post('cgst', TRUE);
                $sgst = $this->input->post('sgst', TRUE);
                $igst = $this->input->post('igst', TRUE);
                $cgst_id = $this->input->post('cgst_id', TRUE);
                $sgst_id = $this->input->post('sgst_id', TRUE);
                $igst_id = $this->input->post('igst_id', TRUE);
                //Tax collection summary for three start
                //CGST tax info
                if (!empty($cgst)) {
                    for ($i = 0, $n = count(@$cgst); $i < $n; $i++) {
                        $cgst_tax = $cgst[$i];
                        $cgst_tax_id = $cgst_id[$i];
                        $cgst_summary = array(
                            'tax_collection_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $cgst_tax,
                            'tax_id' => $cgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                            'tcs_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                        );
                        if (!empty($cgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $cgst_tax_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $cgst_summary);
                            }
                        }
                    }
                }
                //SGST tax info
                if (!empty($sgst)) {
                    for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                        $sgst_tax = $sgst[$i];
                        $sgst_tax_id = $sgst_id[$i];

                        $sgst_summary = array(
                            'tax_collection_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $sgst_tax,
                            'tax_id' => $sgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                            'tcs_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $sgst_tax_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $sgst_summary);
                            }
                        }
                    }
                }
                if (!empty($igst)) {
                    //IGST tax info
                    for ($i = 0, $n = count($igst); $i < $n; $i++) {
                        $igst_tax = $igst[$i];
                        $igst_tax_id = $igst_id[$i];

                        $igst_summary = array(
                            'tax_collection_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $igst_tax,
                            'tax_id' => $igst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                            'tcs_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $igst_tax_id)
                                    ->get()
                                    ->num_rows();

                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $igst_summary);
                            }
                        }
                    }
                }
                //Tax collection summary for three end
                //Tax collection details for three start
                //CGST tax info
                if (!empty($cgst)) {
                    for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                        $cgst_tax = $cgst[$i];
                        $cgst_tax_id = $cgst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id =  $size[$i];
                        
                        $cgst_details = array(
                            'tax_col_de_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $cgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $cgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                            'tcd_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                        );
                        if (!empty($cgst[$i])) {

                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $cgst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $cgst_details);
                            }
                        }
                    }
                }

                //SGST tax info
                if (!empty($sgst)) {
                    for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                        $sgst_tax = $sgst[$i];
                        $sgst_tax_id = $sgst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $size[$i];
                        $sgst_summary = array(
                            'tax_col_de_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $sgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $sgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                            'tcd_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $sgst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $sgst_summary);
                            }
                        }
                    }
                }
                // IGST tax info
                if (!empty($igst)) {
                    for ($i = 0, $n = count($igst); $i < $n; $i++) {
                        $igst_tax = $igst[$i];
                        $igst_tax_id = $igst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $size[$i];
                        $igst_summary = array(
                            'tax_col_de_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $igst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $igst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                            'tcd_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $igst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $igst_summary);
                            }
                        }
                    }
                }
                //Tax collection details for three end

                return $invoice_id;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } 
        else 
        {
            //Invoice entry info
            $invoice_id = generator(15);
            $quantity = $this->input->post('product_quantity', TRUE);
            $available_quantity = $this->input->post('available_quantity', TRUE);
            $product_id = $this->input->post('product_id', TRUE);
            $product_type = $this->input->post('product_type', TRUE);

            $invoiceNewNo = 'Inv-' . $this->number_generator();

            //Stock availability check
            $result = array();
            foreach ($available_quantity as $k => $v) {
                if ($v < $quantity[$k]) {
                    $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                    redirect('dashboard/Cinvoice');
                }
            }

            //Product existing check
            if ($product_id == null) {
                $this->session->set_userdata(array('error_message' => display('please_select_product')));
                redirect('dashboard/Cinvoice');
            }

            //Customer existing check
            if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
                $this->session->set_userdata(array('error_message' => display('please_select_customer')));
                redirect(base_url() . 'dashboard/Cinvoice');
            }

            //Customer data Existence Check.
            if ($this->input->post('customer_id', TRUE)) {
                $customer_id = $this->input->post('customer_id', TRUE);
            } else {
                $customer_id = generator(15);
                //Customer  basic information adding.
                $data = array(
                    'customer_id' => $customer_id,
                    'customer_name' => $this->input->post('customer_name_others', TRUE),
                    'customer_address_1' => $this->input->post('customer_name_others_address', TRUE),
                    'customer_mobile' => $this->input->post('customer_mobile_no', TRUE),
                    'customer_email' => "NONE",
                    'status' => 1
                );
                $this->Customers->customer_entry($data);
                //Previous balance adding -> Sending to customer model to adjust the data.
                $this->Customers->previous_balance_add(0, $customer_id);
            }

            $check_customer = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->get()->row();
            // create customer head start
            if (check_module_status('accounting') == 1) {
                $this->load->model('accounting/account_model');
                
                if (!empty($check_customer)) {
                    $customer_data = $data = array(
                        'customer_id' => $customer_id,
                        'customer_name' => $check_customer->customer_name,
                    );
                } else {
                    $customer_data = $data = array(
                        'customer_id' => $customer_id,
                        'customer_name' => $this->input->post('customer_id', TRUE)
                    );
                }
                $this->account_model->insert_customer_head($customer_data);
            }

            $customerName = $check_customer;
            // create customer head END
            //Full or partial Payment record.
            if ($this->input->post('paid_amount', TRUE) > 0) {
                $headinfo = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', $this->input->post('payment_id', TRUE))->get()->row();
                //Insert to customer_ledger Table 
                $data2 = array(
                    'transaction_id' => generator(15),
                    'customer_id' => $customer_id,
                    'invoice_no' => $invoice_id,
                    
                    'date' => DateTime::createFromFormat('d-m-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                    'amount' => $this->input->post('paid_amount', TRUE),
                    'payment_type' => 1,
                    'description' => 'ITP',
                    'status' => 1,
                    'cl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                    'voucher' => 'Rcv',
                    'details' => "سند قبض رقم PLHH - عميل $customerName->customer_name - حواله على $headinfo->HeadName الشركة",
                    'Vno' => $invoiceNewNo,
                    'acc' => 'Inv-' . $invoice_id
                );
                $this->db->insert('customer_ledger', $data2);
            }

            //Insert to customer ledger Table 
            $data2 = array(
                'transaction_id' => generator(15),
                'customer_id' => $customer_id,
                'invoice_no' => $invoice_id,
                'receipt_no' => $this->auth->generator(15),
                'date' => DateTime::createFromFormat('d-m-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                'amount' => $this->input->post('grand_total_price', TRUE),
                'status' => 1,
                'cl_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                'voucher' => 'Sall',
                'details' => "فاتورة مبيعات رقم PLHH - عميل $customerName->customer_name - عدد $quantity منتج",
                'Vno' => $invoiceNewNo,
                'acc' => 'Inv-' . $invoice_id
            );
            $this->db->insert('customer_ledger', $data2);

            //Data inserting into invoice table
            $data = array(
                'invoice_id' => $invoice_id,
                'customer_id' => $customer_id,
                'date' => $this->input->post('invoice_date', TRUE),
                'total_amount' => $this->input->post('grand_total_price', TRUE),
                'invoice' => $invoiceNewNo,
                'total_discount' => $this->input->post('total_discount', TRUE),
                'invoice_discount' => $this->input->post('invoice_discount', TRUE),
                'percentage_discount' => $this->input->post('percentage_discount', TRUE),
                'user_id' => $this->session->userdata('user_id'),
                'store_id' => $this->input->post('store_id', TRUE),
                'paid_amount' => $this->input->post('paid_amount', TRUE),
                'due_amount' => $this->input->post('due_amount', TRUE),
                'service_charge' => $this->input->post('service_charge', TRUE),
                'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
                'shipping_method' => $this->input->post('shipping_method', TRUE),
                'invoice_details' => $this->input->post('invoice_details', TRUE),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                'order_id' => $order_id,
                'quotation_id' => $quotation_id,
                'product_type' => $product_type,
                'customer_balance' => $this->input->post('customer_balance', TRUE),
            );
            $this->db->insert('invoice', $data);


            //Insert payment method
            $terminal = $this->input->post('terminal', TRUE);
            $bank_id = $this->input->post('bank_id', TRUE);
            $account_no = $this->input->post('account_no', TRUE);
            $payment_amount = $this->input->post('grand_total_price', TRUE);

            if (!empty($bank_id)) {
                $bank_paydata = array(
                    'bank_payment_id' => generator(15),
                    'terminal_id' => ($terminal ? $terminal : ''),
                    'bank_id' => $bank_id,
                    'account_no' => $account_no,
                    'amount' => $payment_amount,
                    'invoice_id' => $invoice_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                );
                $this->db->insert('bank_payment', $bank_paydata);
            }

            //Invoice details info
            $rate = $this->input->post('product_rate', TRUE);
            $p_id = $this->input->post('product_id', TRUE);
            $total_amount = $this->input->post('total_price', TRUE);
            $discount = $this->input->post('discount', TRUE);
            $variants = $this->input->post('variant_id', TRUE);
            // $pricing = $this->input->post('pricing', TRUE);
            $color_variants = $this->input->post('color_variant', TRUE);
            $batch_no = $this->input->post('batch_no', TRUE);
            $cogs_price = 0;

            //Invoice details for invoice
            for ($i = 0, $n = count($quantity); $i < $n; $i++) {
                $product_quantity = $quantity[$i];
                $product_rate = $rate[$i];
                $product_id = $p_id[$i];
                $discount_rate = $discount[$i];
                $total_price = $total_amount[$i];
                //  $pricing_id = $pricing[$i];
                $variant_id = $variants[$i];
                $variant_color = $color_variants[$i];
                $batch = $batch_no[$i];
                $supplier_rate = $this->supplier_rate($product_id);
                $cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity);

                $invoice_details = array(
                    'invoice_details_id' => generator(15),
                    'invoice_id' => $invoice_id,
                    'product_id' => $product_id,
                    //  'pricing_id' => $pricing_id,
                    'variant_id' => $variant_id,
                    'variant_color' => $variant_color,
                    'batch_no' => $batch,
                    'store_id' => $this->input->post('store_id', TRUE),
                    'quantity' => $product_quantity,
                    'rate' => $product_rate,
                    'supplier_rate' => $supplier_rate[0]['supplier_price'],
                    'total_price' => $total_price,
                    'discount' => $discount_rate,
                    'status' => 1
                );

                if (!empty($quantity)) {
                    $this->db->select('*');
                    $this->db->from('invoice_details');
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->where('product_id', $product_id);
                    $this->db->where('variant_id', $variant_id);
                    if (!empty($variant_color)) {
                        $this->db->where('variant_color', $variant_color);
                    }
                    $query = $this->db->get();
                    $result = $query->num_rows();

                    if ($result > 0) {
                        $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                        $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                        $this->db->where('invoice_id', $invoice_id);
                        $this->db->where('product_id', $product_id);
                        $this->db->where('variant_id', $variant_id);
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $this->db->update('invoice_details');
                    } else {
                        $this->db->insert('invoice_details', $invoice_details);
                    }

                    // stock 
                    $store_id = $this->input->post('store_id', TRUE);
                    $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                    if (empty($check_stock)) {
                        // insert
                        $stock = array(
                            'store_id' => $store_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                            'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                            'quantity' => $product_quantity,
                            'warehouse_id' => '',
                        );
                        $this->db->insert('invoice_stock_tbl', $stock);
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
                        if (!empty($variant_id)) {
                            $this->db->where('variant_id', $variant_id);
                        }
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $this->db->update('invoice_stock_tbl', $stock);
                        //update
                    }
                    // stock
                }
            }

            //Tax information
            $cgst = $this->input->post('cgst', TRUE);
            $sgst = $this->input->post('sgst', TRUE);
            $igst = $this->input->post('igst', TRUE);
            $cgst_id = $this->input->post('cgst_id', TRUE);
            $sgst_id = $this->input->post('sgst_id', TRUE);
            $igst_id = $this->input->post('igst_id', TRUE);

            //Tax collection summary for three start
            //CGST tax info
            if (!empty($cgst)) {
                for ($i = 0, $n = count(@$cgst); $i < $n; $i++) {
                    $cgst_tax = $cgst[$i];
                    $cgst_tax_id = $cgst_id[$i];
                    $cgst_summary = array(
                        'tax_collection_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $cgst_tax,
                        'tax_id' => $cgst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                        'tcs_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                    );
                    if (!empty($cgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $cgst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $cgst_summary);
                        }
                    }
                }
            }
            //SGST tax info
            if (!empty($sgst)) {
                for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                    $sgst_tax = $sgst[$i];
                    $sgst_tax_id = $sgst_id[$i];

                    $sgst_summary = array(
                        'tax_collection_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $sgst_tax,
                        'tax_id' => $sgst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                        'tcs_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                    );
                    if (!empty($sgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $sgst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $sgst_summary);
                        }
                    }
                }
            }
            if (!empty($igst)) {
                //IGST tax info
                for ($i = 0, $n = count($igst); $i < $n; $i++) {
                    $igst_tax = $igst[$i];
                    $igst_tax_id = $igst_id[$i];

                    $igst_summary = array(
                        'tax_collection_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $igst_tax,
                        'tax_id' => $igst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                        'tcs_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                    );
                    if (!empty($igst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->get()
                                ->num_rows();

                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $igst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $igst_summary);
                        }
                    }
                }
            }
            //Tax collection summary for three end
            //Tax collection details for three start
            //CGST tax info
            if (!empty($cgst)) {
                for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                    $cgst_tax = $cgst[$i];
                    $cgst_tax_id = $cgst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $cgst_details = array(
                        'tax_col_de_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $cgst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $cgst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                        'tcd_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                    );
                    if (!empty($cgst[$i])) {

                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $cgst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $cgst_details);
                        }
                    }
                }
            }

            //SGST tax info
            if (!empty($sgst)) {
                for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                    $sgst_tax = $sgst[$i];
                    $sgst_tax_id = $sgst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $sgst_summary = array(
                        'tax_col_de_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $sgst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $sgst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                        'tcd_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                    );
                    if (!empty($sgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $sgst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $sgst_summary);
                        }
                    }
                }
            }
            // IGST tax info
            if (!empty($igst)) {
                for ($i = 0, $n = count($igst); $i < $n; $i++) {
                    $igst_tax = $igst[$i];
                    $igst_tax_id = $igst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $igst_summary = array(
                        'tax_col_de_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $igst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $igst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                        'tcd_created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE)))
                    );
                    if (!empty($igst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $igst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $igst_summary);
                        }
                    }
                }
            }
            //Tax collection details for three end

            return $invoice_id;
        }
    }

    public function pos_invoice_entry() {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                //Invoice entry info
                $invoice_id = generator(15);
                $quantity = $this->input->post('product_quantity', TRUE);
                $available_quantity = $this->input->post('available_quantity', TRUE);
                $product_id = $this->input->post('product_id', TRUE);

                //Stock availability check
                $result = array();
                foreach ($available_quantity as $k => $v) {
                    if ($v < $quantity[$k]) {
                        $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                        redirect('dashboard/Cinvoice');
                    }
                }

                //Product existing check
                if ($product_id == null) {
                    $this->session->set_userdata(array('error_message' => display('please_select_product')));
                    redirect('dashboard/Cinvoice');
                }

                //Customer existing check
                if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
                    $this->session->set_userdata(array('error_message' => display('please_select_customer')));
                    redirect(base_url() . 'dashboard/Cinvoice');
                }

                //Customer data Existence Check.
                if ($this->input->post('customer_id', TRUE)) {
                    $customer_id = $this->input->post('customer_id', TRUE);
                } else {
                    $customer_id = generator(15);
                    //Customer  basic information adding.
                    $data = array(
                        'customer_id' => $customer_id,
                        'customer_name' => $this->input->post('customer_name_others', TRUE),
                        'customer_address_1' => $this->input->post('customer_name_others_address', TRUE),
                        'customer_mobile' => $this->input->post('customer_mobile_no', TRUE),
                        'customer_email' => "NONE",
                        'status' => 1
                    );
                    $this->Customers->customer_entry($data);
                    //Previous balance adding -> Sending to customer model to adjust the data.
                    $this->Customers->previous_balance_add(0, $customer_id);
                }

                // create customer head start
                if (check_module_status('accounting') == 1) {
                    $this->load->model('accounting/account_model');
                    $check_customer = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->get()->row();
                    if (!empty($check_customer)) {
                        $customer_data = $data = array(
                            'customer_id' => $customer_id,
                            'customer_name' => $check_customer->customer_name,
                        );
                    } else {
                        $customer_data = $data = array(
                            'customer_id' => $customer_id,
                            'customer_name' => $this->input->post('customer_id', TRUE)
                        );
                    }
                    $this->account_model->insert_customer_head($customer_data);
                }
                // create customer head END
                //Full or partial Payment record.
                if ($this->input->post('paid_amount', TRUE) > 0) {
                    //Insert to customer_ledger Table 
                    $data2 = array(
                        'transaction_id' => generator(15),
                        'customer_id' => $customer_id,
                        'invoice_no' => $invoice_id,
                        'receipt_no' => $this->auth->generator(15),
                        'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                        'amount' => $this->input->post('paid_amount', TRUE),
                        'payment_type' => 1,
                        'description' => 'ITP',
                        'status' => 1,
                        'acc' => 'Inv-' . $invoice_id
                    );
                    $this->db->insert('customer_ledger', $data2);
                }

                //Insert to customer ledger Table 
                $data2 = array(
                    'transaction_id' => generator(15),
                    'customer_id' => $customer_id,
                    'invoice_no' => $invoice_id,
                    'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                    'amount' => $this->input->post('grand_total_price', TRUE),
                    'status' => 1,
                    'acc' => 'Inv-' . $invoice_id
                );
                $this->db->insert('customer_ledger', $data2);

                //Data inserting into invoice table
                (($this->input->post('total_cgst', true)) ? $total_cgsti = $this->input->post('total_cgst', true) : $total_cgsti = 0);
                (($this->input->post('total_sgst', true)) ? $total_sgsti = $this->input->post('total_sgst', true) : $total_sgsti = 0);
                (($this->input->post('total_igst', true)) ? $total_igsti = $this->input->post('total_igst', true) : $total_igsti = 0);

                $tota_vati = $total_cgsti + $total_sgsti + $total_igsti;
                $data = array(
                    'invoice_id' => $invoice_id,
                    'customer_id' => $customer_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                    'total_amount' => $this->input->post('grand_total_price', TRUE),
                    'invoice' => 'Inv-' . $this->number_generator(),
                    'total_discount' => $this->input->post('total_discount', TRUE),
                    'total_vat' => $tota_vati,
                    'invoice_discount' => $this->input->post('invoice_discount', TRUE),
                    'percentage_discount' => $this->input->post('percentage_discount', TRUE),
                    'user_id' => $this->session->userdata('user_id'),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'paid_amount' => $this->input->post('paid_amount', TRUE),
                    'due_amount' => $this->input->post('due_amount', TRUE),
                    'service_charge' => $this->input->post('service_charge', TRUE),
                    'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
                    'shipping_method' => $this->input->post('shipping_method', TRUE),
                    'invoice_details' => $this->input->post('invoice_details', TRUE),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                );
                $this->db->insert('invoice', $data);

                //Invoice details info
                $rate = $this->input->post('product_rate', TRUE);
                $p_id = $this->input->post('product_id', TRUE);
                $total_amount = $this->input->post('total_price', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $variants = $this->input->post('variant_id', TRUE);
                $color_variants = $this->input->post('color_variant', TRUE);
                $batch_no = $this->input->post('batch_no', TRUE);
                $cogs_price = 0;

                //Invoice details for invoice
                for ($i = 0, $n = count($quantity); $i < $n; $i++) {
                    $product_quantity = $quantity[$i];
                    $product_rate = $rate[$i];
                    $product_id = $p_id[$i];
                    $discount_rate = $discount[$i];
                    $total_price = $total_amount[$i];
                    $variant_id = $variants[$i];
                    $variant_color = $color_variants[$i];
                    $batch = $batch_no[$i];
                    $supplier_rate = $this->supplier_rate($product_id);
                    $cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity);

                    $invoice_details = array(
                        'invoice_details_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'product_id' => $product_id,
                        'variant_id' => $variant_id,
                        'variant_color' => $variant_color,
                        'batch_no' => $batch,
                        'store_id' => $this->input->post('store_id', TRUE),
                        'quantity' => $product_quantity,
                        'rate' => $product_rate,
                        'supplier_rate' => $supplier_rate[0]['supplier_price'],
                        'total_price' => $total_price,
                        'discount' => $discount_rate,
                        'status' => 1
                    );

                    if (!empty($quantity)) {
                        $this->db->select('*');
                        $this->db->from('invoice_details');
                        $this->db->where('invoice_id', $invoice_id);
                        $this->db->where('product_id', $product_id);
                        $this->db->where('variant_id', $variant_id);
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $query = $this->db->get();
                        $result = $query->num_rows();
                        if ($result > 0) {
                            $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                            $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('product_id', $product_id);
                            $this->db->where('variant_id', $variant_id);
                            if (!empty($variant_color)) {
                                $this->db->where('variant_color', $variant_color);
                            }
                            $this->db->update('invoice_details');
                        } else {
                            $this->db->insert('invoice_details', $invoice_details);
                        }

                        // stock 
                        $store_id = $this->input->post('store_id', TRUE);
                        $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                        if (empty($check_stock)) {
                            // insert
                            $stock = array(
                                'store_id' => $store_id,
                                'product_id' => $product_id,
                                'variant_id' => $variant_id,
                                'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                                'quantity' => $product_quantity,
                                'warehouse_id' => '',
                            );
                            $this->db->insert('invoice_stock_tbl', $stock);
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
                            if (!empty($variant_id)) {
                                $this->db->where('variant_id', $variant_id);
                            }
                            if (!empty($variant_color)) {
                                $this->db->where('variant_color', $variant_color);
                            }
                            $this->db->update('invoice_stock_tbl', $stock);
                            //update
                        }
                        // stock
                    }
                }

                // SALES/INVOICE TRANSECTIONS ENTRY
                $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                if (empty($customer_head)) {
                    $this->load->model('accounting/account_model');
                    $customer_name = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $result->customer_id)->get()->row();
                    if ($customer_name) {
                        $customer_data = $data = array(
                            'customer_id' => $result->customer_id,
                            'customer_name' => $customer_name->customer_name,
                        );
                        $this->account_model->insert_customer_head($customer_data);
                    }
                    $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                }
                $createdate = date('Y-m-d H:i:s');
                $receive_by = $this->session->userdata('user_id');
                $date = $createdate;

                $i_vat = $this->db->select('total_vat')->from('invoice')->where('invoice_id', $invoice_id)->get()->row();
                $tota_vat = $i_vat->total_vat;
                $total_with_vat = $this->input->post('grand_total_price', TRUE);
                $cogs_price = $cogs_price;
                $total_discount = $this->input->post('total_discount', TRUE);
                $total_price_before_discount = ($total_with_vat - $tota_vat) + $total_discount;
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();

                $terminal = $this->input->post('terminal', TRUE);
                $payment_id = $this->input->post('payment_id', TRUE);
                $account_no = $this->input->post('account_no', TRUE);
                $payment_amount = $this->input->post('payment_amount', TRUE);

                if (!empty($payment_id)) {
                    $payment_debit = [];
                    for ($c = 0; $c < count($payment_id); $c++) {
                        $payment_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', $payment_id[$c])->get()->row();
                        //1st cash/bank debit total_with_vat
                        $payment_debit[] = array(
                            'fy_id' => $find_active_fiscal_year->id,
                            'VNo' => 'Inv-' . $invoice_id,
                            'Vtype' => 'Sales',
                            'VDate' => $date,
                            'COAID' => $payment_head->HeadCode,
                            'Narration' => 'Sales "total with vat" debited by cash/bank id: ' . $payment_head->HeadName,
                            'Debit' => $payment_amount[$c],
                            'Credit' => 0,
                            'IsPosted' => 1,
                            'CreateBy' => $receive_by,
                            'CreateDate' => $createdate,
                            'IsAppove' => 0
                        );
                    }
                    $this->db->insert_batch('acc_transaction', $payment_debit);
                } else {
                    //1st customer debit total_with_vat
                    $customer_debit = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'Inv-' . $invoice_id,
                        'Vtype' => 'Sales',
                        'VDate' => $date,
                        'COAID' => $customer_head->HeadCode,
                        'Narration' => 'Sales "total with vat" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                        'Debit' => $total_with_vat,
                        'Credit' => 0,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'IsAppove' => 0
                    );
                    $this->db->insert('acc_transaction', $customer_debit);
                }

                //2nd Allowed Discount Debit
                $allowed_discount_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 4114,
                    'Narration' => 'Sales "total discount" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => $total_discount,
                    'Credit' => 0,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 0
                );
                //3rd Showroom Sales credit
                $showroom_sales_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 5111, // account payable game 11
                    'Narration' => 'Sales "total price before discount" store_credit credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_price_before_discount,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 0
                );
                //4th VAT on Sales
                $vat_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 2114, // account payable game 11
                    'Narration' => 'Sales "total vat" credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $tota_vat,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 0
                );

                //5th cost of goods sold debit
                $cogs_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 4111,
                    'Narration' => 'Sales "cost of goods sold" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => $cogs_price,
                    'Credit' => 0, //sales price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 0
                );
                //6th cost of goods sold Main warehouse Credit
                $cogs_main_warehouse_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 1141,
                    'Narration' => '"cost of goods sold" Main warehouse credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $cogs_price, //supplier price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 0
                );
                $this->db->insert('acc_transaction', $allowed_discount_debit);
                $this->db->insert('acc_transaction', $showroom_sales_credit);
                $this->db->insert('acc_transaction', $vat_credit);
                $this->db->insert('acc_transaction', $cogs_debit);
                $this->db->insert('acc_transaction', $cogs_main_warehouse_credit);
                // SALES/INVOICE TRANSECTIONS END
                //Tax information
                $cgst = $this->input->post('cgst', TRUE);
                $sgst = $this->input->post('sgst', TRUE);
                $igst = $this->input->post('igst', TRUE);
                $cgst_id = $this->input->post('cgst_id', TRUE);
                $sgst_id = $this->input->post('sgst_id', TRUE);
                $igst_id = $this->input->post('igst_id', TRUE);
                //Tax collection summary for three start
                //CGST tax info
                if (!empty($cgst)) {
                    for ($i = 0, $n = count(@$cgst); $i < $n; $i++) {
                        $cgst_tax = $cgst[$i];
                        $cgst_tax_id = $cgst_id[$i];
                        $cgst_summary = array(
                            'tax_collection_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $cgst_tax,
                            'tax_id' => $cgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($cgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $cgst_tax_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $cgst_summary);
                            }
                        }
                    }
                }
                //SGST tax info
                if (!empty($sgst)) {
                    for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                        $sgst_tax = $sgst[$i];
                        $sgst_tax_id = $sgst_id[$i];

                        $sgst_summary = array(
                            'tax_collection_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $sgst_tax,
                            'tax_id' => $sgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $sgst_tax_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $sgst_summary);
                            }
                        }
                    }
                }
                if (!empty($igst)) {
                    //IGST tax info
                    for ($i = 0, $n = count($igst); $i < $n; $i++) {
                        $igst_tax = $igst[$i];
                        $igst_tax_id = $igst_id[$i];

                        $igst_summary = array(
                            'tax_collection_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $igst_tax,
                            'tax_id' => $igst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $igst_tax_id)
                                    ->get()
                                    ->num_rows();

                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $igst_summary);
                            }
                        }
                    }
                }
                //Tax collection summary for three end
                //Tax collection details for three start
                //CGST tax info
                if (!empty($cgst)) {
                    for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                        $cgst_tax = $cgst[$i];
                        $cgst_tax_id = $cgst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $variants[$i];
                        $cgst_details = array(
                            'tax_col_de_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $cgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $cgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($cgst[$i])) {

                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $cgst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $cgst_details);
                            }
                        }
                    }
                }

                //SGST tax info
                if (!empty($sgst)) {
                    for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                        $sgst_tax = $sgst[$i];
                        $sgst_tax_id = $sgst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $variants[$i];
                        $sgst_summary = array(
                            'tax_col_de_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $sgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $sgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $sgst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $sgst_summary);
                            }
                        }
                    }
                }
                // IGST tax info
                if (!empty($igst)) {
                    for ($i = 0, $n = count($igst); $i < $n; $i++) {
                        $igst_tax = $igst[$i];
                        $igst_tax_id = $igst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $variants[$i];
                        $igst_summary = array(
                            'tax_col_de_id' => generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $igst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $igst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $igst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $igst_summary);
                            }
                        }
                    }
                }
                //Tax collection details for three end

                return $invoice_id;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            //Invoice entry info
            $invoice_id = generator(15);
            $quantity = $this->input->post('product_quantity', TRUE);
            $available_quantity = $this->input->post('available_quantity', TRUE);
            $product_id = $this->input->post('product_id', TRUE);
            $product_type = $this->input->post('product_type', TRUE);

            //Stock availability check
            $result = array();
            foreach ($available_quantity as $k => $v) {
                if ($v < $quantity[$k]) {
                    $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                    redirect('dashboard/Cinvoice');
                }
            }

            //Product existing check
            if ($product_id == null) {
                $this->session->set_userdata(array('error_message' => display('please_select_product')));
                redirect('dashboard/Cinvoice');
            }

            //Customer existing check
            if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
                $this->session->set_userdata(array('error_message' => display('please_select_customer')));
                redirect(base_url() . 'dashboard/Cinvoice');
            }

            //Customer data Existence Check.
            if ($this->input->post('customer_id', TRUE)) {
                $customer_id = $this->input->post('customer_id', TRUE);
            } else {
                $customer_id = generator(15);
                //Customer  basic information adding.
                $data = array(
                    'customer_id' => $customer_id,
                    'customer_name' => $this->input->post('customer_name_others', TRUE),
                    'customer_address_1' => $this->input->post('customer_name_others_address', TRUE),
                    'customer_mobile' => $this->input->post('customer_mobile_no', TRUE),
                    'customer_email' => "NONE",
                    'status' => 1
                );
                $this->Customers->customer_entry($data);
                //Previous balance adding -> Sending to customer model to adjust the data.
                $this->Customers->previous_balance_add(0, $customer_id);
            }

            // create customer head start
            if (check_module_status('accounting') == 1) {
                $this->load->model('accounting/account_model');
                $check_customer = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->get()->row();
                if (!empty($check_customer)) {
                    $customer_data = $data = array(
                        'customer_id' => $customer_id,
                        'customer_name' => $check_customer->customer_name,
                    );
                } else {
                    $customer_data = $data = array(
                        'customer_id' => $customer_id,
                        'customer_name' => $this->input->post('customer_id', TRUE)
                    );
                }
                $this->account_model->insert_customer_head($customer_data);
            }
            // create customer head END
            //Full or partial Payment record.
            if ($this->input->post('paid_amount', TRUE) > 0) {
                //Insert to customer_ledger Table 
                $data2 = array(
                    'transaction_id' => generator(15),
                    'customer_id' => $customer_id,
                    'invoice_no' => $invoice_id,
                    'receipt_no' => $this->auth->generator(15),
                    'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                    'amount' => $this->input->post('paid_amount', TRUE),
                    'payment_type' => 1,
                    'description' => 'ITP',
                    'status' => 1,
                    'acc' => 'Inv-' . $invoice_id
                );
                $this->db->insert('customer_ledger', $data2);
            }

            //Insert to customer ledger Table 
            $data2 = array(
                'transaction_id' => generator(15),
                'customer_id' => $customer_id,
                'invoice_no' => $invoice_id,
                'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                'amount' => $this->input->post('grand_total_price', TRUE),
                'status' => 1,
                'acc' => 'Inv-' . $invoice_id
            );
            $this->db->insert('customer_ledger', $data2);

            //Data inserting into invoice table
            $data = array(
                'invoice_id' => $invoice_id,
                'customer_id' => $customer_id,
                'date' => $this->input->post('invoice_date', TRUE),
                'total_amount' => $this->input->post('grand_total_price', TRUE),
                'invoice' => 'Inv-' . $this->number_generator(),
                'total_discount' => $this->input->post('total_discount', TRUE),
                'invoice_discount' => $this->input->post('invoice_discount', TRUE),
                'user_id' => $this->session->userdata('user_id'),
                'store_id' => $this->input->post('store_id', TRUE),
                'paid_amount' => $this->input->post('paid_amount', TRUE),
                'due_amount' => $this->input->post('due_amount', TRUE),
                'service_charge' => $this->input->post('service_charge', TRUE),
                'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
                'shipping_method' => $this->input->post('shipping_method', TRUE),
                'invoice_details' => $this->input->post('invoice_details', TRUE),
                'status' => 1,
                'product_type' => $product_type,
            );
            $this->db->insert('invoice', $data);


            //Insert payment method
            $terminal = $this->input->post('terminal', TRUE);
            $bank_id = $this->input->post('bank_id', TRUE);
            $account_no = $this->input->post('account_no', TRUE);
            $payment_amount = $this->input->post('grand_total_price', TRUE);

            if (!empty($bank_id) && !empty($account_no)) {
                $bank_paydata = array(
                    'bank_payment_id' => generator(15),
                    'terminal_id' => ($terminal ? $terminal : ''),
                    'bank_id' => $bank_id,
                    'account_no' => $account_no,
                    'amount' => $payment_amount,
                    'invoice_id' => $invoice_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                );
                $this->db->insert('bank_payment', $bank_paydata);
            }

            //Invoice details info
            $rate = $this->input->post('product_rate', TRUE);
            $p_id = $this->input->post('product_id', TRUE);
            $total_amount = $this->input->post('total_price', TRUE);
            $discount = $this->input->post('discount', TRUE);
            $variants = $this->input->post('variant_id', TRUE);
            $color_variants = $this->input->post('color_variant', TRUE);
            $batch_no = $this->input->post('batch_no', TRUE);
            $cogs_price = 0;

            //Invoice details for invoice
            for ($i = 0, $n = count($quantity); $i < $n; $i++) {
                $product_quantity = $quantity[$i];
                $product_rate = $rate[$i];
                $product_id = $p_id[$i];
                $discount_rate = $discount[$i];
                $total_price = $total_amount[$i];
                $variant_id = $variants[$i];
                $variant_color = $color_variants[$i];
                $batch = $batch_no[$i];
                $supplier_rate = $this->supplier_rate($product_id);
                $cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity);

                $invoice_details = array(
                    'invoice_details_id' => generator(15),
                    'invoice_id' => $invoice_id,
                    'product_id' => $product_id,
                    'variant_id' => $variant_id,
                    'variant_color' => $variant_color,
                    'batch_no' => $batch,
                    'store_id' => $this->input->post('store_id', TRUE),
                    'quantity' => $product_quantity,
                    'rate' => $product_rate,
                    'supplier_rate' => $supplier_rate[0]['supplier_price'],
                    'total_price' => $total_price,
                    'discount' => $discount_rate,
                    'status' => 1
                );

                if (!empty($quantity)) {
                    $this->db->select('*');
                    $this->db->from('invoice_details');
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->where('product_id', $product_id);
                    $this->db->where('variant_id', $variant_id);
                    if (!empty($variant_color)) {
                        $this->db->where('variant_color', $variant_color);
                    }
                    $query = $this->db->get();
                    $result = $query->num_rows();

                    if ($result > 0) {
                        $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                        $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                        $this->db->where('invoice_id', $invoice_id);
                        $this->db->where('product_id', $product_id);
                        $this->db->where('variant_id', $variant_id);
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $this->db->update('invoice_details');
                    } else {
                        $this->db->insert('invoice_details', $invoice_details);
                    }

                    // stock 
                    $store_id = $this->input->post('store_id', TRUE);
                    $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                    if (empty($check_stock)) {
                        // insert
                        $stock = array(
                            'store_id' => $store_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                            'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
                            'quantity' => $product_quantity,
                            'warehouse_id' => '',
                        );
                        $this->db->insert('invoice_stock_tbl', $stock);
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
                        if (!empty($variant_id)) {
                            $this->db->where('variant_id', $variant_id);
                        }
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $this->db->update('invoice_stock_tbl', $stock);
                        //update
                    }
                    // stock
                }
            }

            //Tax information
            $cgst = $this->input->post('cgst', TRUE);
            $sgst = $this->input->post('sgst', TRUE);
            $igst = $this->input->post('igst', TRUE);
            $cgst_id = $this->input->post('cgst_id', TRUE);
            $sgst_id = $this->input->post('sgst_id', TRUE);
            $igst_id = $this->input->post('igst_id', TRUE);

            //Tax collection summary for three start
            //CGST tax info
            if (!empty($cgst)) {
                for ($i = 0, $n = count(@$cgst); $i < $n; $i++) {
                    $cgst_tax = $cgst[$i];
                    $cgst_tax_id = $cgst_id[$i];
                    $cgst_summary = array(
                        'tax_collection_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $cgst_tax,
                        'tax_id' => $cgst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($cgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $cgst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $cgst_summary);
                        }
                    }
                }
            }
            //SGST tax info
            if (!empty($sgst)) {
                for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                    $sgst_tax = $sgst[$i];
                    $sgst_tax_id = $sgst_id[$i];

                    $sgst_summary = array(
                        'tax_collection_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $sgst_tax,
                        'tax_id' => $sgst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($sgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $sgst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $sgst_summary);
                        }
                    }
                }
            }
            if (!empty($igst)) {
                //IGST tax info
                for ($i = 0, $n = count($igst); $i < $n; $i++) {
                    $igst_tax = $igst[$i];
                    $igst_tax_id = $igst_id[$i];

                    $igst_summary = array(
                        'tax_collection_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $igst_tax,
                        'tax_id' => $igst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($igst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->get()
                                ->num_rows();

                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $igst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $igst_summary);
                        }
                    }
                }
            }
            //Tax collection summary for three end
            //Tax collection details for three start
            //CGST tax info
            if (!empty($cgst)) {
                for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                    $cgst_tax = $cgst[$i];
                    $cgst_tax_id = $cgst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $cgst_details = array(
                        'tax_col_de_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $cgst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $cgst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($cgst[$i])) {

                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $cgst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $cgst_details);
                        }
                    }
                }
            }

            //SGST tax info
            if (!empty($sgst)) {
                for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                    $sgst_tax = $sgst[$i];
                    $sgst_tax_id = $sgst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $sgst_summary = array(
                        'tax_col_de_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $sgst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $sgst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($sgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $sgst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $sgst_summary);
                        }
                    }
                }
            }
            // IGST tax info
            if (!empty($igst)) {
                for ($i = 0, $n = count($igst); $i < $n; $i++) {
                    $igst_tax = $igst[$i];
                    $igst_tax_id = $igst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $igst_summary = array(
                        'tax_col_de_id' => generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $igst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $igst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($igst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $igst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $igst_summary);
                        }
                    }
                }
            }
            //Tax collection details for three end

            return $invoice_id;
        }
    }

    //Update Invoice
    public function update_invoice() {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                //Invoice and customer info
                $invoice_id = $this->input->post('invoice_id', TRUE);
                $customer_id = $this->input->post('customer_id', TRUE);
                $quantity = $this->input->post('product_quantity', TRUE);
                $available_quantity = $this->input->post('available_quantity', TRUE);

                //Stock availability check
                $result = array();
                foreach ($available_quantity as $k => $v) {
                    if ($v < $quantity[$k]) {
                        $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                        redirect('dashboard/Cinvoice/manage_invoice');
                    }
                }

                if ($invoice_id != '') {
                    //Data update into invoice table
                    $data = array(
                        'invoice_id' => $invoice_id,
                        'customer_id' => $customer_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                        'total_amount' => $this->input->post('grand_total_price', TRUE),
                        'invoice' => $this->input->post('invoice', TRUE),
                        'total_discount' => $this->input->post('total_discount', TRUE),
                        'invoice_discount' => (int) $this->input->post('invoice_discount', TRUE) + (int) $this->input->post('total_discount', TRUE),
                        'user_id' => $this->session->userdata('user_id'),
                        'store_id' => $this->input->post('store_id', TRUE),
                        'paid_amount' => $this->input->post('paid_amount', TRUE),
                        'due_amount' => $this->input->post('due_amount', TRUE),
                        'service_charge' => $this->input->post('service_charge', TRUE),
                        'shipping_charge' => $this->input->post('shipping_charge', TRUE),
                        'shipping_method' => $this->input->post('shipping_method', TRUE),
                        'invoice_details' => $this->input->post('invoice_details', TRUE),
                        'invoice_status' => $this->input->post('invoice_status', TRUE),
                        'status' => 1
                    );
                    $this->db->where('invoice_id', $invoice_id);
                    $result = $this->db->delete('invoice');

                    if ($result) {
                        $this->db->insert('invoice', $data);
                    }

                    //Delete old customer ledger data
                    $this->db->where('invoice_no', $invoice_id);
                    $result = $this->db->delete('customer_ledger');

                    //Insert customer ledger data where amount > 0
                    if ($this->input->post('paid_amount', TRUE) > 0) {
                        //Insert to customer_ledger Table 
                        $data1 = array(
                            'transaction_id' => $this->auth->generator(15),
                            'customer_id' => $customer_id,
                            'invoice_no' => $invoice_id,
                            'receipt_no' => $this->auth->generator(15),
                            'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                            'amount' => $this->input->post('paid_amount', TRUE),
                            'payment_type' => 1,
                            'description' => 'ITP',
                            'status' => 1,
                            'acc' => 'Inv-' . $invoice_id
                        );
                        $this->db->insert('customer_ledger', $data1);
                    }

                    //Update to customer ledger Table 
                    $data2 = array(
                        'transaction_id' => $this->auth->generator(15),
                        'customer_id' => $customer_id,
                        'invoice_no' => $invoice_id,
                        'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                        'amount' => $this->input->post('grand_total_price', TRUE),
                        'status' => 1,
                        'acc' => 'Inv-' . $invoice_id
                    );
                    $this->db->insert('customer_ledger', $data2);
                }

                //Insert payment method
                $terminal = $this->input->post('terminal', TRUE);
                $card_type = $this->input->post('card_type', TRUE);
                $card_no = $this->input->post('card_no', TRUE);
                if ($card_no != null) {
                    $data3 = array(
                        'terminal_id' => ($terminal ? $terminal : ''),
                        'card_type' => $card_type,
                        'card_no' => $card_no,
                        'amount' => $this->input->post('grand_total_price', TRUE),
                        'invoice_id' => $invoice_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->update('cardpayment', $data3);
                }

                //Delete old invoice info
                if (!empty($invoice_id)) {
                    //find previous invoice history and REDUCE the stock
                    $invoice_history = $this->db->select('*')->from('invoice_details')->where('invoice_id', $invoice_id)->get()->result_array();
                    if (count($invoice_history) > 0) {
                        foreach ($invoice_history as $invoice_item) {
                            //update
                            $check_stock = $this->check_stock($invoice_item['store_id'], $invoice_item['product_id'], $invoice_item['variant_id'], $invoice_item['variant_color']);
                            $stock = array(
                                'quantity' => $check_stock->quantity - $invoice_item['quantity']
                            );
                            if (!empty($invoice_item['store_id'])) {
                                $this->db->where('store_id', $invoice_item['store_id']);
                            }
                            if (!empty($invoice_item['product_id'])) {
                                $this->db->where('product_id', $invoice_item['product_id']);
                            }
                            if (!empty($invoice_item['variant_id'])) {
                                $this->db->where('variant_id', $invoice_item['variant_id']);
                            }
                            if (!empty($invoice_item['variant_color'])) {
                                $this->db->where('variant_color', $invoice_item['variant_color']);
                            }
                            $this->db->update('invoice_stock_tbl', $stock);
                            //update
                        }
                    }
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->delete('invoice_details');
                }

                //Invoice details for inovoice
                $invoice_d_id = $this->input->post('invoice_details_id', TRUE);
                $rate = $this->input->post('product_rate', TRUE);
                $p_id = $this->input->post('product_id', TRUE);
                $total_amount = $this->input->post('total_price', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $variants = $this->input->post('variant_id', TRUE);
                // $pricing = $this->input->post('pricing', TRUE);
                $color_variants = $this->input->post('color_variant', TRUE);
                $batch_no = $this->input->post('batch_no', TRUE);
                $cogs_price = 0;
                //Invoice details for invoice
                if (!empty($p_id)) {
                    for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                        $product_quantity = $quantity[$i];
                        $product_rate = $rate[$i];
                        $product_id = $p_id[$i];
                        $discount_rate = $discount[$i];
                        $total_price = $total_amount[$i];
                        $variant_id = $variants[$i];
                        //  $pricing_id = $pricing[$i];
                        $variant_color = (!empty($color_variants[$i]) ? $color_variants[$i] : NULL);
                        $invoice_detail_id = (!empty($invoice_d_id[$i]) ? $invoice_d_id[$i] : null);
                        $supplier_rate = $this->supplier_rate($product_id);
                        $batch = $batch_no[$i];
                        $cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity);

                        $invoice_details = array(
                            'invoice_details_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                            // 'pricing_id' => $pricing_id,
                            'variant_color' => $variant_color,
                            'batch_no' => $batch,
                            'store_id' => $this->input->post('store_id', TRUE),
                            'quantity' => $product_quantity,
                            'rate' => $product_rate,
                            'supplier_rate' => $supplier_rate[0]['supplier_price'],
                            'total_price' => $total_price,
                            'discount' => $discount_rate,
                            'status' => 1
                        );

                        if (!empty($p_id)) {
                            $this->db->select('invoice_details_id');
                            $this->db->from('invoice_details');
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('product_id', $product_id);
                            $this->db->where('variant_id', $variant_id);
                            if (!empty($variant_color)) {
                                $this->db->where('variant_color', $variant_color);
                            }
                            $query = $this->db->get();
                            $result = $query->num_rows();

                            if ($result > 0) {
                                $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                                $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('product_id', $product_id);
                                $this->db->where('variant_id', $variant_id);
                                if (!empty($variant_color)) {
                                    $this->db->where('variant_color', $variant_color);
                                }
                                $this->db->update('invoice_details');
                            } else {
                                $this->db->insert('invoice_details', $invoice_details);
                            }
                            // stock
                            $store_id = $this->input->post('store_id', TRUE);
                            $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                            //update
                            if (!empty($check_stock)) {
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
                                $this->db->update('invoice_stock_tbl', $stock);
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
                                $this->db->insert('invoice_stock_tbl', $stock);
                                // insert
                            }
                            //update
                            // stock
                        }
                    }
                }



                // Reverse invoice transections start
                $previous_invoices = $this->db->select('*')->from('acc_transaction')->where('VNo', 'Inv-' . $invoice_id)->get()->result_array();
                if (count($previous_invoices) > 0) {
                //                    $transection_reverse = array();
                //                    foreach ($previous_invoices as $key => $invoices) {
                //                        $ID = $invoices['ID'];
                //                        $fy_id = $invoices['fy_id'];
                //                        $VNo = $invoices['VNo'];
                //                        $Vtype = $invoices['Vtype'];
                //                        $VDate = $invoices['VDate'];
                //                        $COAID = $invoices['COAID'];
                //                        $Narration = $invoices['Narration'];
                //                        $Debit = $invoices['Debit'];
                //                        $Credit = $invoices['Credit'];
                //                        $IsPosted = $invoices['IsPosted'];
                //                        $is_opening = $invoices['is_opening'];
                //                        $store_id = $invoices['store_id'];
                //                        $CreateBy = $this->session->userdata('user_id');
                //                        $createdate = date('Y-m-d H:i:s');
                //                        $UpdateBy = $this->session->userdata('user_id');
                //                        $IsAppove = $invoices['IsAppove'];
                //
                //                        $transection_reverse[] = array(
                //                            'fy_id' => $fy_id,
                //                            'VNo' => $VNo,
                //                            'Vtype' => $Vtype,
                //                            'VDate' => $createdate,
                //                            'COAID' => $COAID,
                //                            'Narration' => 'Invoice reverse transection ' . $Narration,
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

                    $this->db->where('VNo', 'Inv-' . $invoice_id);
                    $this->db->delete('acc_transaction');
                }
                // Reverse invoice transections end
                // SALES/INVOICE TRANSECTIONS ENTRY
                $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                if (empty($customer_head)) {
                    $this->load->model('accounting/account_model');
                    $customer_name = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $result->customer_id)->get()->row();
                    if ($customer_name) {
                        $customer_data = $data = array(
                            'customer_id' => $result->customer_id,
                            'customer_name' => $customer_name->customer_name,
                        );
                        $this->account_model->insert_customer_head($customer_data);
                    }
                    $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                }
                $createdate = date('Y-m-d H:i:s');
                $receive_by = $this->session->userdata('user_id');
                $date = $createdate;

                $i_vat = $this->db->select('total_vat')->from('invoice')->where('invoice_id', $invoice_id)->get()->row();
                $tota_vat = $i_vat->total_vat;
                $total_with_vat = $this->input->post('grand_total_price', TRUE);
                $cogs_price = $cogs_price;
                $total_discount = $this->input->post('total_discount', TRUE);
                $total_price_before_discount = ($total_with_vat - $tota_vat) + $total_discount;
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();

                $payment_id = $this->input->post('payment_id', TRUE);
                $account_no = $this->input->post('account_no', TRUE);

                if (!empty($payment_id)) {
                    $payment_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', $payment_id)->get()->row();
                    //1st bank debit total_with_vat
                    $bank_debit = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'Inv-' . $invoice_id,
                        'Vtype' => 'Sales',
                        'VDate' => $date,
                        'COAID' => $payment_head->HeadCode,
                        'Narration' => 'Sales "total with vat" debited by cash/bank id: ' . $payment_head->HeadName . '(' . $bank_id . ')',
                        'Debit' => $total_with_vat,
                        'Credit' => 0,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'IsAppove' => 1
                    );
                    $this->db->insert('acc_transaction', $bank_debit);
                } else {
                    //1st customer debit total_with_vat
                    $customer_debit = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'Inv-' . $invoice_id,
                        'Vtype' => 'Sales',
                        'VDate' => $date,
                        'COAID' => $customer_head->HeadCode,
                        'Narration' => 'Sales "total with vat" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                        'Debit' => $total_with_vat,
                        'Credit' => 0,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'IsAppove' => 1
                    );
                    $this->db->insert('acc_transaction', $customer_debit);
                }

                //2nd Allowed Discount Debit
                $allowed_discount_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 4114,
                    'Narration' => 'Sales "total discount" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => $total_discount,
                    'Credit' => 0,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                //3rd Showroom Sales credit
                $showroom_sales_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 5111, // account payable game 11
                    'Narration' => 'Sales "total price before discount" store_credit credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $total_price_before_discount,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                //4th VAT on Sales
                $vat_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 2114, // account payable game 11
                    'Narration' => 'Sales "total vat" credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $tota_vat,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );

                //5th cost of goods sold debit
                $cogs_debit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 4111,
                    'Narration' => 'Sales "cost of goods sold" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => $cogs_price,
                    'Credit' => 0, //sales price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                //6th cost of goods sold Main warehouse Credit
                $cogs_main_warehouse_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'Inv-' . $invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $date,
                    'COAID' => 1141,
                    'Narration' => '"cost of goods sold" Main warehouse credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                    'Debit' => 0,
                    'Credit' => $cogs_price, //supplier price asbe
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                //7th paid_amount Credit
                if ($this->input->post('paid_amount', TRUE) > 0) {
                    $paid_amount = $this->input->post('paid_amount', TRUE);
                    $customer_credit = array(
                        'fy_id' => $find_active_fiscal_year->id,
                        'VNo' => 'Inv-' . $invoice_id,
                        'Vtype' => 'Sales',
                        'VDate' => $date,
                        'COAID' => $customer_head->HeadCode,
                        'Narration' => 'Sales "paid_amount" Credit by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                        'Debit' => 0,
                        'Credit' => $paid_amount,
                        'IsPosted' => 1,
                        'CreateBy' => $receive_by,
                        'CreateDate' => $createdate,
                        'IsAppove' => 0
                    );

                    $this->db->insert('acc_transaction', $customer_credit);
                }
                $this->db->insert('acc_transaction', $allowed_discount_debit);
                $this->db->insert('acc_transaction', $showroom_sales_credit);
                $this->db->insert('acc_transaction', $vat_credit);
                $this->db->insert('acc_transaction', $cogs_debit);
                $this->db->insert('acc_transaction', $cogs_main_warehouse_credit);
                // SALES/INVOICE TRANSECTIONS END
                //Tax information
                $cgst = $this->input->post('cgst', TRUE);
                $sgst = $this->input->post('sgst', TRUE);
                $igst = $this->input->post('igst', TRUE);
                $cgst_id = $this->input->post('cgst_id', TRUE);
                $sgst_id = $this->input->post('sgst_id', TRUE);
                $igst_id = $this->input->post('igst_id', TRUE);

                //Tax collection summary for three start
                //Delete all tax  from summary
                $this->db->where('invoice_id', $invoice_id);
                $this->db->delete('tax_collection_summary');
                //CGST tax info
                if (!empty($cgst)) {
                    for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                        $cgst_tax = $cgst[$i];
                        $cgst_tax_id = $cgst_id[$i];
                        $cgst_summary = array(
                            'tax_collection_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $cgst_tax,
                            'tax_id' => $cgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($cgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $cgst_tax_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $cgst_summary);
                            }
                        }
                    }
                }
                //SGST tax info
                if (!empty($sgst)) {
                    for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                        $sgst_tax = $sgst[$i];
                        $sgst_tax_id = $sgst_id[$i];

                        $sgst_summary = array(
                            'tax_collection_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $sgst_tax,
                            'tax_id' => $sgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $sgst_tax_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $sgst_summary);
                            }
                        }
                    }
                }
                //IGST tax info
                if (!empty($igst)) {
                    for ($i = 0, $n = count($igst); $i < $n; $i++) {
                        $igst_tax = $igst[$i];
                        $igst_tax_id = $igst_id[$i];

                        $igst_summary = array(
                            'tax_collection_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'tax_amount' => $igst_tax,
                            'tax_id' => $igst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_summary')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $igst_tax_id)
                                    ->get()
                                    ->num_rows();

                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->update('tax_collection_summary');
                            } else {
                                $this->db->insert('tax_collection_summary', $igst_summary);
                            }
                        }
                    }
                }
                //Tax collection summary for three end
                //Delete all tax  from summary
                $this->db->where('invoice_id', $invoice_id);
                $this->db->delete('tax_collection_details');

                //Tax collection details for three start
                //CGST tax info
                if (!empty($cgst)) {
                    for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                        $cgst_tax = $cgst[$i];
                        $cgst_tax_id = $cgst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $variants[$i];
                        $cgst_details = array(
                            'tax_col_de_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $cgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $cgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($cgst[$i])) {

                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $cgst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $cgst_details);
                            }
                        }
                    }
                }
                //SGST tax info
                if (!empty($sgst)) {
                    for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                        $sgst_tax = $sgst[$i];
                        $sgst_tax_id = $sgst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $variants[$i];
                        $sgst_summary = array(
                            'tax_col_de_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $sgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $sgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $sgst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $sgst_summary);
                            }
                        }
                    }
                }
                // IGST tax info
                if (!empty($igst)) {
                    for ($i = 0, $n = count($igst); $i < $n; $i++) {
                        $igst_tax = $igst[$i];
                        $igst_tax_id = $igst_id[$i];
                        $product_id = $p_id[$i];
                        $variant_id = $variants[$i];
                        $igst_summary = array(
                            'tax_col_de_id' => $this->auth->generator(15),
                            'invoice_id' => $invoice_id,
                            'amount' => $igst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $igst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                    ->from('tax_collection_details')
                                    ->where('invoice_id', $invoice_id)
                                    ->where('tax_id', $igst_tax_id)
                                    ->where('product_id', $product_id)
                                    ->where('variant_id', $variant_id)
                                    ->get()
                                    ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                                $this->db->where('invoice_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('tax_collection_details');
                            } else {
                                $this->db->insert('tax_collection_details', $igst_summary);
                            }
                        }
                    }
                }
                //Tax collection details for three end
                return $invoice_id;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            //Invoice and customer info
            $invoice_id = $this->input->post('invoice_id', TRUE);
            $customer_id = $this->input->post('customer_id', TRUE);
            $quantity = $this->input->post('product_quantity', TRUE);
            $available_quantity = $this->input->post('available_quantity', TRUE);

            //Stock availability check
            $result = array();
            foreach ($available_quantity as $k => $v) {
                if ($v < $quantity[$k]) {
                    $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                    redirect('dashboard/Cinvoice/manage_invoice');
                }
            }

            if ($invoice_id != '') {
                //Data update into invoice table
                $data = array(
                    'invoice_id' => $invoice_id,
                    'customer_id' => $customer_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                    'total_amount' => $this->input->post('grand_total_price', TRUE),
                    'invoice' => $this->input->post('invoice', TRUE),
                    'total_discount' => $this->input->post('total_discount', TRUE),
                    'invoice_discount' => (int) $this->input->post('invoice_discount', TRUE) + (int) $this->input->post('total_discount', TRUE),
                    'user_id' => $this->session->userdata('user_id'),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'paid_amount' => $this->input->post('paid_amount', TRUE),
                    'due_amount' => $this->input->post('due_amount', TRUE),
                    'service_charge' => $this->input->post('service_charge', TRUE),
                    'shipping_charge' => $this->input->post('shipping_charge', TRUE),
                    'shipping_method' => $this->input->post('shipping_method', TRUE),
                    'invoice_details' => $this->input->post('invoice_details', TRUE),
                    'invoice_status' => $this->input->post('invoice_status', TRUE),
                    'status' => 1
                );
                $this->db->where('invoice_id', $invoice_id);
                $result = $this->db->delete('invoice');

                if ($result) {
                    $this->db->insert('invoice', $data);
                }

                //Delete old customer ledger data
                $this->db->where('invoice_no', $invoice_id);
                $result = $this->db->delete('customer_ledger');

                //Insert customer ledger data where amount > 0
                if ($this->input->post('paid_amount', TRUE) > 0) {
                    //Insert to customer_ledger Table 
                    $data1 = array(
                        'transaction_id' => $this->auth->generator(15),
                        'customer_id' => $customer_id,
                        'invoice_no' => $invoice_id,
                        'receipt_no' => $this->auth->generator(15),
                        'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                        'amount' => $this->input->post('paid_amount', TRUE),
                        'payment_type' => 1,
                        'description' => 'ITP',
                        'status' => 1,
                        'acc' => 'Inv-' . $invoice_id
                    );
                    $this->db->insert('customer_ledger', $data1);
                }

                //Update to customer ledger Table 
                $data2 = array(
                    'transaction_id' => $this->auth->generator(15),
                    'customer_id' => $customer_id,
                    'invoice_no' => $invoice_id,
                    'date' => DateTime::createFromFormat('m-d-Y', $this->input->post('invoice_date', TRUE))->format('Y-m-d'),
                    'amount' => $this->input->post('grand_total_price', TRUE),
                    'status' => 1,
                    'acc' => 'Inv-' . $invoice_id
                );
                $this->db->insert('customer_ledger', $data2);
            }

            //Insert payment method
            $terminal = $this->input->post('terminal', TRUE);
            $card_type = $this->input->post('card_type', TRUE);
            $card_no = $this->input->post('card_no', TRUE);
            if ($card_no != null) {
                $data3 = array(
                    'terminal_id' => ($terminal ? $terminal : ''),
                    'card_type' => $card_type,
                    'card_no' => $card_no,
                    'amount' => $this->input->post('grand_total_price', TRUE),
                    'invoice_id' => $invoice_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                );
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('cardpayment', $data3);
            }

            //Delete old invoice info
            if (!empty($invoice_id)) {
                //find previous invoice history and REDUCE the stock
                $invoice_history = $this->db->select('*')->from('invoice_details')->where('invoice_id', $invoice_id)->get()->result_array();
                if (count($invoice_history) > 0) {
                    foreach ($invoice_history as $invoice_item) {
                        //update
                        $check_stock = $this->check_stock($invoice_item['store_id'], $invoice_item['product_id'], $invoice_item['variant_id'], $invoice_item['variant_color']);
                        $stock = array(
                            'quantity' => $check_stock->quantity - $invoice_item['quantity']
                        );
                        if (!empty($invoice_item['store_id'])) {
                            $this->db->where('store_id', $invoice_item['store_id']);
                        }
                        if (!empty($invoice_item['product_id'])) {
                            $this->db->where('product_id', $invoice_item['product_id']);
                        }
                        if (!empty($invoice_item['variant_id'])) {
                            $this->db->where('variant_id', $invoice_item['variant_id']);
                        }
                        if (!empty($invoice_item['variant_color'])) {
                            $this->db->where('variant_color', $invoice_item['variant_color']);
                        }
                        $this->db->update('invoice_stock_tbl', $stock);
                        //update
                    }
                }
                $this->db->where('invoice_id', $invoice_id);
                $this->db->delete('invoice_details');
            }

            //Invoice details for inovoice
            $invoice_d_id = $this->input->post('invoice_details_id', TRUE);
            $rate = $this->input->post('product_rate', TRUE);
            $p_id = $this->input->post('product_id', TRUE);
            $total_amount = $this->input->post('total_price', TRUE);
            $discount = $this->input->post('discount', TRUE);
            $variants = $this->input->post('variant_id', TRUE);
            //$pricing = $this->input->post('pricing', TRUE);
            $color_variants = $this->input->post('color_variant', TRUE);
            $batch_no = $this->input->post('batch_no', TRUE);
            //Invoice details for invoice
            if (!empty($p_id)) {
                for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                    $product_quantity = $quantity[$i];
                    $product_rate = $rate[$i];
                    $product_id = $p_id[$i];
                    $discount_rate = $discount[$i];
                    $total_price = $total_amount[$i];
                    $variant_id = $variants[$i];
                    // $pricing_id = $pricing[$i];
                    $variant_color = (!empty($color_variants[$i]) ? $color_variants[$i] : NULL);
                    $invoice_detail_id = (!empty($invoice_d_id[$i]) ? $invoice_d_id[$i] : null);
                    $supplier_rate = $this->supplier_rate($product_id);
                    $batch = $batch_no[$i];

                    $invoice_details = array(
                        'invoice_details_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'product_id' => $product_id,
                        'variant_id' => $variant_id,
                        // 'pricing_id' => $pricing_id,
                        'variant_color' => $variant_color,
                        'batch_no' => $batch,
                        'store_id' => $this->input->post('store_id', TRUE),
                        'quantity' => $product_quantity,
                        'rate' => $product_rate,
                        'supplier_rate' => $supplier_rate[0]['supplier_price'],
                        'total_price' => $total_price,
                        'discount' => $discount_rate,
                        'status' => 1
                    );

                    if (!empty($p_id)) {
                        $this->db->select('invoice_details_id');
                        $this->db->from('invoice_details');
                        $this->db->where('invoice_id', $invoice_id);
                        $this->db->where('product_id', $product_id);
                        $this->db->where('variant_id', $variant_id);
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $query = $this->db->get();
                        $result = $query->num_rows();

                        if ($result > 0) {
                            $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                            $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('product_id', $product_id);
                            $this->db->where('variant_id', $variant_id);
                            if (!empty($variant_color)) {
                                $this->db->where('variant_color', $variant_color);
                            }
                            $this->db->update('invoice_details');
                        } else {
                            $this->db->insert('invoice_details', $invoice_details);
                        }
                        // stock
                        $store_id = $this->input->post('store_id', TRUE);
                        $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
                        //update
                        if (!empty($check_stock)) {
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
                            $this->db->update('invoice_stock_tbl', $stock);
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
                            $this->db->insert('invoice_stock_tbl', $stock);
                            // insert
                        }
                        //update
                        // stock
                    }
                }
            }
            //Tax information
            $cgst = $this->input->post('cgst', TRUE);
            $sgst = $this->input->post('sgst', TRUE);
            $igst = $this->input->post('igst', TRUE);
            $cgst_id = $this->input->post('cgst_id', TRUE);
            $sgst_id = $this->input->post('sgst_id', TRUE);
            $igst_id = $this->input->post('igst_id', TRUE);

            //Tax collection summary for three start
            //Delete all tax  from summary
            $this->db->where('invoice_id', $invoice_id);
            $this->db->delete('tax_collection_summary');
            //CGST tax info
            if (!empty($cgst)) {
                for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                    $cgst_tax = $cgst[$i];
                    $cgst_tax_id = $cgst_id[$i];
                    $cgst_summary = array(
                        'tax_collection_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $cgst_tax,
                        'tax_id' => $cgst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($cgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $cgst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $cgst_summary);
                        }
                    }
                }
            }
            //SGST tax info
            if (!empty($sgst)) {
                for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                    $sgst_tax = $sgst[$i];
                    $sgst_tax_id = $sgst_id[$i];

                    $sgst_summary = array(
                        'tax_collection_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $sgst_tax,
                        'tax_id' => $sgst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($sgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $sgst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $sgst_summary);
                        }
                    }
                }
            }
            //IGST tax info
            if (!empty($igst)) {
                for ($i = 0, $n = count($igst); $i < $n; $i++) {
                    $igst_tax = $igst[$i];
                    $igst_tax_id = $igst_id[$i];

                    $igst_summary = array(
                        'tax_collection_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'tax_amount' => $igst_tax,
                        'tax_id' => $igst_tax_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($igst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_summary')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->get()
                                ->num_rows();

                        if ($result > 0) {
                            $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $igst_tax_id);
                            $this->db->update('tax_collection_summary');
                        } else {
                            $this->db->insert('tax_collection_summary', $igst_summary);
                        }
                    }
                }
            }
            //Tax collection summary for three end
            //Delete all tax  from summary
            $this->db->where('invoice_id', $invoice_id);
            $this->db->delete('tax_collection_details');

            //Tax collection details for three start
            //CGST tax info
            if (!empty($cgst)) {
                for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                    $cgst_tax = $cgst[$i];
                    $cgst_tax_id = $cgst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $cgst_details = array(
                        'tax_col_de_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $cgst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $cgst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($cgst[$i])) {

                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $cgst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $cgst_details);
                        }
                    }
                }
            }
            //SGST tax info
            if (!empty($sgst)) {
                for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                    $sgst_tax = $sgst[$i];
                    $sgst_tax_id = $sgst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $sgst_summary = array(
                        'tax_col_de_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $sgst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $sgst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($sgst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $sgst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $sgst_summary);
                        }
                    }
                }
            }
            // IGST tax info
            if (!empty($igst)) {
                for ($i = 0, $n = count($igst); $i < $n; $i++) {
                    $igst_tax = $igst[$i];
                    $igst_tax_id = $igst_id[$i];
                    $product_id = $p_id[$i];
                    $variant_id = $variants[$i];
                    $igst_summary = array(
                        'tax_col_de_id' => $this->auth->generator(15),
                        'invoice_id' => $invoice_id,
                        'amount' => $igst_tax,
                        'product_id' => $product_id,
                        'tax_id' => $igst_tax_id,
                        'variant_id' => $variant_id,
                        'date' => $this->input->post('invoice_date', TRUE),
                    );
                    if (!empty($igst[$i])) {
                        $result = $this->db->select('*')
                                ->from('tax_collection_details')
                                ->where('invoice_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                        if ($result > 0) {
                            $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                            $this->db->where('invoice_id', $invoice_id);
                            $this->db->where('tax_id', $igst_tax_id);
                            $this->db->where('variant_id', $variant_id);
                            $this->db->update('tax_collection_details');
                        } else {
                            $this->db->insert('tax_collection_details', $igst_summary);
                        }
                    }
                }
            }
            //Tax collection details for three end
            return $invoice_id;
        }
    }

    //invoice Search Item
    public function search_inovoice_item($customer_id) {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('b.customer_id', $customer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //POS invoice entry
    public function pos_invoice_setup($product_id) {
        $product_information = $this->db->select('*')
                ->from('product_information')
                ->where('product_id', $product_id)
                ->get()
                ->row();

        if ($product_information != null) {

            $this->db->select('SUM(a.quantity) as total_purchase');
            $this->db->from('product_purchase_details a');
            $this->db->where('a.product_id', $product_id);
            $total_purchase = $this->db->get()->row();

            $this->db->select('SUM(b.quantity) as total_sale');
            $this->db->from('invoice_stock_tbl b');
            $this->db->where('b.product_id', $product_id);
            $total_sale = $this->db->get()->row();

            $data2 = (object) array(
                        'total_product' => ($total_purchase->total_purchase - $total_sale->total_sale),
                        'supplier_price' => $product_information->supplier_price,
                        'price' => $product_information->price,
                        'supplier_id' => $product_information->supplier_id,
                        'tax' => $product_information->tax,
                        'product_id' => $product_information->product_id,
                        'product_name' => $product_information->product_name,
                        'product_model' => $product_information->product_model,
                        'unit' => $product_information->unit,
            );

            return $data2;
        } else {
            return false;
        }
    }

    //Customer entry
    public function customer_entry($data) {

        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_name', $data['customer_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert('customer_information', $data);

            $this->db->select('*');
            $this->db->from('customer_information');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_customer[] = array('label' => $row->customer_name . (!empty($row->customer_mobile) ? ' (' . $row->customer_mobile . ')' : ''), 'value' => $row->customer_id);
            }
            $cache_file = './my-assets/js/admin_js/json/customer.json';
            $customerList = json_encode($json_customer);
            file_put_contents($cache_file, $customerList);
            return TRUE;
        }
    }

    //Store List
    public function store_list() {
        $this->db->select('*');
        $this->db->from('store_set');
        $this->db->order_by('store_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    //Terminal List
    public function terminal_list() {
        $this->db->select('*');
        $this->db->from('terminal_payment');
        $this->db->order_by('terminal_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Get Supplier rate of a product
    public function supplier_rate($product_id) {
        $this->db->select('supplier_price');
        $this->db->from('product_information');
        $this->db->where(array('product_id' => $product_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve invoice Edit Data
    public function retrieve_invoice_editdata($invoice_id) {
        $this->db->select('
				a.*,
				b.customer_name,
				c.*,
				c.product_id,
				c.batch_no,
				d.product_name,
				d.product_model,
				e.unit_short_name as unit,
			');

        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('invoice_details c', 'c.invoice_id = a.invoice_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('unit e', 'e.unit_id = d.unit', 'left');
        $this->db->where('a.invoice_id', $invoice_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve invoice_html_data
    public function retrieve_invoice_html_data($invoice_id) {
        $direct_invoice = $this->db->select('*')->from('invoice')->where('invoice', $invoice_id)->get()->result_array();
        $this->db->select('
			a.*,
			a.created_at as date_time,
			a.invoice_discount as total_invoice_discount,
			b.*,
			c.*,
			d.product_id,
            d.category_id,
			d.product_name,
			d.product_details,
			d.product_model,
			d.image_thumb,
			d.unit,
			e.unit_short_name,
			f.variant_name,
			g.customer_name as ship_customer_name,
			g.first_name as ship_first_name, g.last_name as ship_last_name,
			g.customer_short_address as ship_customer_short_address,
			g.customer_address_1 as ship_customer_address_1,
			g.customer_address_2 as ship_customer_address_2,
			g.customer_mobile as ship_customer_mobile,
			g.customer_email as ship_customer_email,
			g.city as ship_city,
			g.state as ship_state,
			g.country as ship_country,
			g.zip as ship_zip,
			g.company as ship_company
			');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id', 'left');
        $this->db->join('invoice_details c', 'c.invoice_id = a.invoice_id', 'left');
        if (empty($direct_invoice[0]['order_id'])) {
            $this->db->join('customer_information g', 'g.customer_id = a.customer_id', 'left');
        } else {
            $this->db->join('shipping_info g', 'g.customer_id = a.customer_id', 'left');
        }

        $this->db->join('product_information d', 'd.product_id = c.product_id', 'left');
        $this->db->join('unit e', 'e.unit_id = d.unit', 'left');
        $this->db->join('variant f', 'f.variant_id = c.variant_id', 'left');
        $this->db->where('a.invoice_id', $invoice_id);
        $this->db->group_by('d.product_id, c.invoice_details_id');
        $this->db->order_by('d.product_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Delete invoice Item
    public function retrieve_product_data($product_id) {
        $this->db->select('supplier_price,price,supplier_id,tax');
        $this->db->from('product_information');
        $this->db->where(array('product_id' => $product_id, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Delete invoice Item
    public function delete_invoice($invoice_id) {
        //find previous invoice history and REDUCE the stock
        $invoice_history = $this->db->select('*')->from('invoice_details')->where('invoice_id', $invoice_id)->get()->result_array();
        if (count($invoice_history) > 0) {
            foreach ($invoice_history as $invoice_item) {
                //update
                $check_stock = $this->check_stock($invoice_item['store_id'], $invoice_item['product_id'], $invoice_item['variant_id'], $invoice_item['variant_color']);
                $stock = array(
                    'quantity' => $check_stock->quantity - $invoice_item['quantity']
                );
                if (!empty($invoice_item['store_id'])) {
                    $this->db->where('store_id', $invoice_item['store_id']);
                }
                if (!empty($invoice_item['product_id'])) {
                    $this->db->where('product_id', $invoice_item['product_id']);
                }
                if (!empty($invoice_item['variant_id'])) {
                    $this->db->where('variant_id', $invoice_item['variant_id']);
                }
                if (!empty($invoice_item['variant_color'])) {
                    $this->db->where('variant_color', $invoice_item['variant_color']);
                }
                $this->db->update('invoice_stock_tbl', $stock);
                //update
            }
        }
        //find previous invoice history and REDUCE the stock
        //Delete Invoice table
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice');

        //Delete invoice_details table
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_details');

        //Delete invoice_tax smmary table
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('tax_collection_summary');

        //Delete invoice_tax details table
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('tax_collection_details');

        // Delete Invoice from customer ledger
        $this->db->where('invoice_no', $invoice_id);
        $this->db->delete('customer_ledger');

        //remove invoice transection
        $this->db->where('VNo', 'Inv-' . $invoice_id);
        $this->db->delete('acc_transaction');

        return true;
    }

    public function invoice_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('invoices a');
        $this->db->join('invoice_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('invoice_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // GET TOTAL PURCHASE PRODUCT
    public function get_total_purchase_item($product_id) {
        $this->db->select('SUM(quantity) as total_purchase');
        $this->db->from('product_purchase_details');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // GET TOTAL SALES PRODUCT
    public function get_total_sales_item($product_id) {
        $this->db->select('SUM(quantity) as total_sale');
        $this->db->from('invoice_stock_tbl');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Get total product
    public function get_total_product($product_id) {
        $this->db->select('assembly,pricing,category_id,product_name,product_id,supplier_price,price,supplier_id,unit,variants,default_variant,product_model,onsale,onsale_price,unit.unit_short_name');
        $this->db->from('product_information');
        $this->db->join('unit', 'unit.unit_id = product_information.unit', 'left');
        $this->db->where(array('product_id' => $product_id, 'status' => 1));
        $product_information = $this->db->get()->row();



        $html = $colorhtml = "";
        if (!empty($product_information->variants)) {
            $exploded = explode(',', $product_information->variants);

            $this->db->select('*');
            $this->db->from('variant');
            $this->db->where_in('variant_id', $exploded);
            $this->db->order_by('variant_name', 'asc');
            $variant_list = $this->db->get()->result();
            $var_types = array_column($variant_list, 'variant_type');

            $html .= '';
            foreach ($variant_list as $varitem) {
                if ($varitem->variant_type == 'size') {
                    $size = $varitem->variant_id;
                    $html .= "<option value=" . $varitem->variant_id . ">" . $varitem->variant_name . "</option>";
                }
            }

            if (in_array('color', $var_types)) {
                $colorhtml .= "";
                foreach ($variant_list as $varitem2) {
                    if ($varitem2->variant_type == 'color') {
                        $color = $varitem2->variant_id;
                        $colorhtml .= "<option value=" . $varitem2->variant_id . ">" . $varitem2->variant_name . "</option>";
                    }
                }
            }
        }

//        $pricinghtml = "";
//        if ($product_information->pricing == 1) {
//            $this->db->select('pricing_types.pri_type_id as pri_type_id,pricing_types.pri_type_name as pri_type_name');
//            $this->db->from('pricing_types_product');
//            $this->db->join('pricing_types', 'pricing_types.pri_type_id = pricing_types_product.pri_type_id');
//            $this->db->where('pricing_types_product.product_id', $product_id);
//            $this->db->order_by('pricing_types.pri_type_name', 'asc');
//            $pricing_list = $this->db->get()->result();
//            $pricinghtml .= '<option value=""></option>';
//            foreach ($pricing_list as $pricitem) {
//                $pricinghtml .= "<option value=" . $pricitem->pri_type_id . ">" . $pricitem->pri_type_name . "</option>";
//            }
//        }

        $this->db->select('tax.*,tax_product_service.product_id,tax_percentage');
        $this->db->from('tax_product_service');
        $this->db->join('tax', 'tax_product_service.tax_id = tax.tax_id', 'left');
        $this->db->where('tax_product_service.product_id', $product_id);
        $tax_information = $this->db->get()->result();

        //New tax calculation for discount
        if (!empty($tax_information)) {
            foreach ($tax_information as $k => $v) {
                if ($v->tax_id == '52C2SKCKGQY6Q9J') {
                    $tax['cgst_tax'] = ($v->tax_percentage) / 100;
                    $tax['cgst_name'] = $v->tax_name;
                    $tax['cgst_id'] = $v->tax_id;
                } elseif ($v->tax_id == 'H5MQN4NXJBSDX4L') {
                    $tax['sgst_tax'] = ($v->tax_percentage) / 100;
                    $tax['sgst_name'] = $v->tax_name;
                    $tax['sgst_id'] = $v->tax_id;
                } elseif ($v->tax_id == '5SN9PRWPN131T4V') {
                    $tax['igst_tax'] = ($v->tax_percentage) / 100;
                    $tax['igst_name'] = $v->tax_name;
                    $tax['igst_id'] = $v->tax_id;
                }
            }
        }
        $purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
                ->from('product_purchase_details')
                ->where('product_id', $product_id)
                ->get()
                ->row();
        $sales = $this->db->select("SUM(quantity) as totalSalesQnty")
                ->from('invoice_stock_tbl')
                ->where('product_id', $product_id)
                ->get()
                ->row();
        $stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;

        // $stock = ($purchase->totalPurchaseQnty + $product_information->open_quantity) - $sales->totalSalesQnty;

        $discount = "";

        $pricing_types = $this->Cfiltration_model->get_pricing_data($product_id);

        if (!empty($product_information->onsale) && ($product_information->onsale == 1)) {
            $discount = ($product_information->price - $product_information->onsale_price);
        }
        $data2 = array(
            'total_product' => @$stock,
            'supplier_price' => @$product_information->supplier_price,
            'price' => @$product_information->price,
            'variant_id' => @$product_information->variants,
            'default_variant' => @$product_information->default_variant,
            'supplier_id' => @$product_information->supplier_id,
            'product_name' => @$product_information->product_name,
            'product_model' => @$product_information->product_model,
            'product_id' => @$product_information->product_id,
            'variant' => @$html,
            'colorhtml' => @$colorhtml,
            //'pricinghtml' => @$pricinghtml,
            'size' => $size,
            'color' => $color,
            'discount' => @$discount,
            'sgst_tax' => (!empty($tax['sgst_tax']) ? $tax['sgst_tax'] : null),
            'cgst_tax' => (!empty($tax['cgst_tax']) ? $tax['cgst_tax'] : null),
            'igst_tax' => (!empty($tax['igst_tax']) ? $tax['igst_tax'] : null),
            'cgst_id' => (!empty($tax['cgst_id']) ? $tax['cgst_id'] : null),
            'sgst_id' => (!empty($tax['sgst_id']) ? $tax['sgst_id'] : null),
            'igst_id' => (!empty($tax['igst_id']) ? $tax['igst_id'] : null),
            'unit' => @$product_information->unit_short_name,
            'assembly' => @$product_information->assembly,
            'pricing_types' => $pricing_types,
            'category_id' => $product_information->category_id,
        );

        return $data2;
    }

    //Get total product
    public function get_total_product_data($product_id) {
        $this->db->select('product_information.*');
        $this->db->from('product_information');
        $this->db->join('unit', 'unit.unit_id = product_information.unit', 'left');
        $this->db->where(array('product_information.product_id' => $product_id, 'status' => 1));
        $product_information = $this->db->get()->row();
        $this->db->select('*')->from('filter_product')
            ->join('filter_types', 'filter_types.fil_type_id = filter_product.filter_type_id', 'left')
            ->join('filter_items', 'filter_items.item_id = filter_product.filter_item_id', 'left')
            ->where('filter_product.product_id', $product_id);
        $product_information->filters = $this->db->get()->result_object();

        $product_information->pricing_types = $this->Cfiltration_model->get_pricing_data($product_id);

        return $product_information;
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

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

    //NUMBER GENERATOR
    public function number_generator() {
        $this->db->select('invoice', 'invoice_no');
        $query = $this->db->get('invoice');
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

    //get Product List for pos invoice page
    public function product_list() {
        $query = $this->db->select('
					a.product_id,a.product_name,a.price,a.image_thumb,a.variants,a.product_model,
					c.category_name,c.category_id
				')
                ->from('product_information a')
                ->join('product_category c', 'c.category_id = a.category_id', 'left')
                ->group_by('a.product_id')
                ->order_by('a.product_name', 'asc')
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_first20_product() {
        $query = $this->db->select('
					a.product_id,a.product_name,a.price,a.image_thumb,a.variants,a.product_model,
					c.category_name,c.category_id
				')
                ->from('product_information a')
                ->join('product_category c', 'c.category_id = a.category_id', 'left')
                ->group_by('a.product_id')
                ->order_by('a.product_name', 'asc')
                ->limit(20)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    //Category List
    public function category_list() {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->where('status', 1);
        $this->db->order_by('category_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //Product Search
    public function product_search($product_name, $category_id) {

        $this->db->select('*');
        $this->db->from('product_information');
        if (!empty($product_name)) {
            $this->db->like('product_name', $product_name, 'both');
            //$this->db->or_like('product_model', $product_name, 'both');
            $this->db->or_like('product_id', $product_name, 'both');
        }

        if (!empty($category_id)) {
            $this->db->where('category_id', $category_id);
        }

        $this->db->where('status', 1);
        $this->db->order_by('product_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function pos_invoice_popular_product() {

        $product_ids = $this->db->query('SELECT DISTINCT product_id FROM `invoice_details`')->result_array();

        $product_ids = array_column($product_ids, 'product_id');
        if (!empty($product_ids)) {
            $result = $this->db->select('
            	a.product_id,a.product_name,a.price,a.image_thumb,a.variants,a.product_model,
					c.category_name,c.category_id')
                    ->from('product_information as a')
                    ->join('product_category as c', 'c.category_id = a.category_id', 'left')
                    ->where_in('a.product_id', $product_ids)
                    ->group_by('a.product_id')
                    ->limit(30)
                    ->get()
                    ->result();
            if ($result) {
                return $result;
            }
            return false;
        }
    }

    //Get today sales 
    public function get_today_invoice_list($today) {

        $this->db->select('a.*,b.*,c.order');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('order c', 'c.order_id = a.order_id', 'left');
        $this->db->where("STR_TO_DATE(a.date, '%m-%d-%Y')=DATE('" . $today . "')");
        $this->db->order_by('a.invoice', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_invoice_card_payments($invoice_id) {
        $result = $this->db->select('*')
                        ->from('cardpayment')
                        ->where('invoice_id', $invoice_id)
                        ->get()->result_array();
        return $result;
    }

    public function invoice_text_details() {
        $invoice_text_details = $this->db->select('*')->from('invoice_text_table')->get()->result();
        return $invoice_text_details;
    }

    public function get_product_batches($product_id, $store_id) {
        $this->db->select('batch_no,expiry_date');
        $this->db->from('product_purchase_details');
        $this->db->where('product_id', $product_id);
        $batches = $this->db->get()->result();
        $html = '<option value=""></option>';
        foreach ($batches as $batch) {
            $html .= "<option value=" . $batch->batch_no . ">" . $batch->batch_no . "(" . $batch->expiry_date . ")</option>";
        }
        return $html;
    }

    public function bank_list() {
        return $this->db->select('bank_id,bank_name')->from('bank_list')->get()->result();
    }

    public function payment_info() {
        $store_id = $this->session->userdata('store_id');
        if (empty($store_id)) {
            return $this->db->select('HeadCode,HeadName')->from('acc_coa')->where_in('PHeadCode', array('111', '112'))->get()->result();
        } else {
            //$cash_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->where('PHeadCode', '111')->get()->result();
            $cash_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('PHeadCode', '111')->get()->result();
            //$bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where_in('PHeadCode', array('1121', '1122', '1123'))->get()->result();
            $bank_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where_in('PHeadCode', array('112'))->get()->result();
            return array_merge($bank_head, $cash_head);
        }
    }

    public function user_invoice_data($user_id) {
        return $this->db->select('*')->from('users')->where('user_id', $user_id)->get()->row();
    }

    public function pad_print_settingdata() {
        return $this->db->select('*')->from('pad_print_setting')->where('id', 1)->get()->row();
    }

    public function get_pri_type_rate($product_id, $pri_type_id, $product_type = null) {

        if ($product_type == 2) {
            // product is assemply
            // then if accessories return zero
            $this->db->select("category_id");
            $this->db->from('product_information');
            $this->db->where('product_id', $product_id);
            $pro = $this->db->get()->row();

            // get accessiores category id
            $acc_cate_id = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->limit(1)->get()->row();

            if ($pro->category_id == $acc_cate_id->category_id) {
                // return "0";
            }
        }

        if ($pri_type_id == 0) {
            $this->db->select("price,onsale,onsale_price");
            $this->db->from('product_information');
            $this->db->where('product_id', $product_id);
            $rate = $this->db->get()->row();
            if (!empty($rate->onsale) && !empty($rate->onsale_price)) {
                return $rate->onsale_price;
            } else {
                return $rate->price;
            }
        } else {
            $this->db->select("pricing,price,onsale,onsale_price");
            $this->db->from('product_information');
            $this->db->where('product_id', $product_id);
            $check = $this->db->get()->row();
            if (!empty($check->onsale) && !empty($check->onsale_price)) {
                return $check->onsale_price;
            } else {
                if ($check->pricing == 0) {
                    return $check->price;
                } else {
                    $this->db->select("product_price");
                    $this->db->from('pricing_types_product');
                    $this->db->where('product_id', $product_id);
                    $this->db->where('pri_type_id', $pri_type_id);
                    $rate2 = $this->db->get()->row();

                    return $rate2->product_price;
                }
            }
        }
    }

}
