<?php

use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dashboard/lcustomer');
        $this->load->library('session');
        $this->load->model('dashboard/Customers');
    }
    //Count order
    public function count_order()
    {
        return $this->db->count_all("order");
    }
    // Count order list
    public function count_order_list_old($filter = [])
    {
        $this->db->select('a.order_id');
        $this->db->from('order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id', 'left');

        if (!empty($filter['order_no'])) {
            $this->db->where('a.order', $filter['order_no']);
        }
        if (!empty($filter['customer_name'])) {
            $this->db->like('b.customer_name', $filter['customer_name'], 'both');
        }

        if (!empty($filter['order_date'])) {
            $this->db->where('a.date', date('m-d-Y', strtotime($filter['order_date'])));
        }
        if (!empty($filter['invoice_status'])) {
            $this->db->join('invoice c', 'c.order_id = a.order_id', 'left');
            if (($filter['invoice_status'] == '3')) {
                $this->db->where('c.invoice_status', 3);
                $this->db->or_where('c.invoice_status IS NULL');
            } else {
                $this->db->where('c.invoice_status', $filter['invoice_status']);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    //Order List count
    public function count_order_list($filter = [])
    {
        $this->db->select('a.order_id');
        $this->db->from('order a');
        if (!empty($filter['invoice_no'])) {
            $this->db->where('a.order', $filter['invoice_no']);
        }
        if (!empty($filter['customer_id'])) {
            $this->db->where('a.customer_id', $filter['customer_id']);
        }
        if (!empty($filter['employee_id'])) {
            $this->db->where('a.employee_id', $filter['employee_id']);
        }
        if (!empty($filter['date'])) {
            // $this->db->where("STR_TO_DATE(a.date, '%m-%d-%Y')=DATE('" . $filter['date'] . "')");
            $this->db->where("DATE(a.create_at) = DATE('" . date('Y-m-d', strtotime($filter['date'])) . "')");
        }
        if (!empty($filter['invoice_status'])) {
            $this->db->where('a.status', $filter['invoice_status']);
        }
        $query = $this->db->count_all_results();
        return $query;
    }

    //Order List
    public function get_order_list($filter, $start, $limit)
    {
        // $this->db->select('a.*,b.*,c.order');
        $this->db->select('a.*, a.created_at as date_time, a.status as order_status,b.*');
        $this->db->from('order a');
        // $this->db->from('order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        // $this->db->join('invoice c', 'c.order_id = a.order_id', 'left');
        if (!empty($filter['invoice_no'] != '')) {
            $this->db->where('a.order', $filter['invoice_no']);
        }
        if ($filter['customer_id'] != '') {
            $this->db->where('a.customer_id', $filter['customer_id']);
        }
        if ($filter['from_date'] != '') {
            // $this->db->where("STR_TO_DATE(a.date, '%m-%d-%Y')>=DATE('" . $filter['date'] . "')");
            $this->db->where("DATE(a.created_at)>=DATE('" . date('Y-m-d', strtotime($filter['from_date'])) . "')");
        }
        if ($filter['to_date'] != '') {
            // $this->db->where("STR_TO_DATE(a.date, '%m-%d-%Y')<=DATE('" . $filter['date'] . "')");
            $this->db->where("DATE(a.created_at) <= DATE('" . date('Y-m-d', strtotime($filter['to_date'])) . "')");
        }
        if ($filter['invoice_status'] != '') {
            $this->db->where('a.status', $filter['invoice_status']);
        }
        $this->db->order_by('a.order', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        // echo "<pre>";
        // print_r($query->result_array());
        // exit;

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return false;
    }

    //order List
    public function order_list($filter = [], $page, $per_page)
    {
        $this->db->select('a.*, a.created_at as date_time,,b.customer_name, IFNULL(c.invoice_status,0) as invoice_status');
        $this->db->from('order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id', 'left');
        $this->db->join('invoice c', 'c.order_id = a.order_id', 'left');

        if (!empty($filter['order_no'])) {
            $this->db->where('a.order', $filter['order_no']);
        }
        if (!empty($filter['customer_name'])) {
            $this->db->like('b.customer_name', $filter['customer_name'], 'both');
        }
        if (!empty($filter['order_date'])) {
            // $this->db->where('a.date', date('m-d-Y', strtotime($filter['order_date'])));
            $this->db->where("DATE(a.create_at) = DATE('" . date('Y-m-d', strtotime($filter['date'])) . "')");
        }
        if (!empty($filter['invoice_status'])) {
            if (($filter['invoice_status'] == '3')) {
                $this->db->where('c.invoice_status', 3);
                $this->db->or_where('c.invoice_status IS NULL');
            } else {
                $this->db->where('c.invoice_status', $filter['invoice_status']);
            }
        }
        $this->db->order_by('a.order', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Stock Report by date
    public function stock_report_bydate($product_id)
    {
        $this->db->select("
			SUM(d.quantity) as 'totalSalesQnty',
			SUM(b.quantity) as 'totalPurchaseQnty',
			(sum(b.quantity) - sum(d.quantity)) as stock
			");

        $this->db->from('product_information a');
        $this->db->join('product_purchase_details b', 'b.product_id = a.product_id', 'left');
        $this->db->join('order_details d', 'd.product_id = a.product_id', 'left');
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

    //order Search Item
    public function search_inovoice_item($customer_id)
    {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('b.customer_id', $customer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //POS order entry
    public function pos_order_setup($product_id)
    {
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
            $this->db->from('order_details b');
            $this->db->where('b.product_id', $product_id);
            $total_sale = $this->db->get()->row();



            $data2 = (object)array(
                'total_product' => ($total_purchase->total_purchase - $total_sale->total_sale),
                'supplier_price' => $product_information->supplier_price,
                'price'          => $product_information->price,
                'supplier_id'      => $product_information->supplier_id,
                'tax'             => $product_information->tax,
                'product_id'     => $product_information->product_id,
                'product_name'     => $product_information->product_name,
                'product_model'     => $product_information->product_model,
                'unit'             => $product_information->unit,
            );

            return $data2;
        } else {
            return false;
        }
    }
    //POS customer setup
    public function pos_customer_setup()
    {
        $query = $this->db->select('*')
            ->from('customer_information')
            ->where('customer_name', 'Walking Customer')
            ->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    //POS customer list
    public function customer_list()
    {
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
    //Customer entry
    public function customer_entry($data)
    {

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
            $this->session->set_userdata(array('message' => display('successfully_added')));
            return TRUE;
        }
    }

    //order entry
    public function order_entry_old()
    {
        //Order information
        $order_id             = $this->auth->generator(15);
        $quantity             = $this->input->post('product_quantity', TRUE);
        $available_quantity = $this->input->post('available_quantity', TRUE);
        $product_id         = $this->input->post('product_id', TRUE);

        //Stock availability check
        $result = array();
        foreach ($available_quantity as $k => $v) {
            if ($v < $quantity[$k]) {
                $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                redirect('dashboard/Corder');
            }
        }

        //Product existing check
        if ($product_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_product')));
            redirect('dashboard/Corder');
        }

        //Customer existing check
        if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
            $this->session->set_userdata(array('error_message' => display('please_select_customer')));
            redirect(base_url() . 'dashboard/Corder');
        }

        //Customer data Existence Check.
        if ($this->input->post('customer_id', TRUE) == "") {

            $customer_id = $this->auth->generator(15);
            //Customer  basic information adding.
            $data = array(
                'customer_id'     => $customer_id,
                'customer_name' => $this->input->post('customer_name_others', TRUE),
                'customer_short_address'     => $this->input->post('customer_name_others_address', TRUE),
                'customer_mobile'     => "NONE",
                'customer_email'     => "NONE",
                'status'             => 1
            );

            $result = $this->Customers->customer_entry($data);
            if ($result == false) {
                $this->session->set_userdata(array('error_message' => display('already_exists')));
                redirect('dashboard/Corder/manage_order');
            }
            //Previous balance adding -> Sending to customer model to adjust the data.
            $this->Customers->previous_balance_add(0, $customer_id);
        } else {
            $customer_id = $this->input->post('customer_id', TRUE);
        }


        $this->session->set_userdata('customerId', $customer_id);
        $invoice_discount = $this->input->post('invoice_discount', TRUE);
        $total_discount   = $this->input->post('total_discount', TRUE);
        //Data inserting into order table
        $data = array(
            'order_id'        => $order_id,
            'customer_id'    => $customer_id,
            'date'            => $this->input->post('invoice_date', TRUE),
            'total_amount'    => $this->input->post('grand_total_price', TRUE),
            'order'            => $this->number_generator_order(),
            'total_discount' => $this->input->post('total_discount', TRUE),
            'order_discount' => ((!empty($invoice_discount)) ? $invoice_discount : 0) + ((!empty($total_discount)) ? $total_discount : 0),
            'service_charge' => $this->input->post('service_charge', TRUE),
            'user_id'        => $this->session->userdata('user_id'),
            'store_id'        => $this->input->post('store_id', TRUE),
            'details'        => $this->input->post('details'),
            'paid_amount'    => $this->input->post('paid_amount', TRUE),
            'due_amount'    => $this->input->post('due_amount', TRUE),
            'status'        => 1
        );
        $this->db->insert('order', $data);

        //Order details info
        $rate         = $this->input->post('product_rate', TRUE);
        $p_id         = $this->input->post('product_id', TRUE);
        $total_amount = $this->input->post('total_price', TRUE);
        $discount     = $this->input->post('discount', TRUE);
        $variants     = $this->input->post('variant_id', TRUE);
        $color_variants   = $this->input->post('color_variant', TRUE);

        //Order details entry
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate       = $rate[$i];
            $product_id       = $p_id[$i];
            $discount_rate    = $discount[$i];
            $total_price      = $total_amount[$i];
            $variant_id       = $variants[$i];
            if (!empty($color_variants)) {
                $variant_color    = $color_variants[$i];
            } else {
                $variant_color    = null;
            }

            $supplier_rate    = $this->supplier_rate($product_id);

            $order_details = array(
                'order_details_id'    =>    $this->auth->generator(15),
                'order_id'            =>    $order_id,
                'product_id'        =>    $product_id,
                'variant_id'        =>    $variant_id,
                'variant_color'     => (!empty($variant_color)) ? $variant_color : null,
                'store_id'            =>    $this->input->post('store_id', TRUE),
                'quantity'            =>    $product_quantity,
                'rate'                =>    $product_rate,
                'supplier_rate'     =>    $supplier_rate[0]['supplier_price'],
                'total_price'       =>    $total_price,
                'discount'          =>    $discount_rate,
                'status'            =>    1
            );

            if (!empty($quantity)) {
                $this->db->select('*');
                $this->db->from('order_details');
                $this->db->where('order_id', $order_id);
                $this->db->where('product_id', $product_id);
                $this->db->where('variant_id', $variant_id);
                if (!empty($variant_color)) {
                    $this->db->where('variant_color', $variant_color);
                }
                $query  = $this->db->get();
                $result = $query->num_rows();
                if ($result > 0) {
                    $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
                    $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
                    $this->db->where('order_id', $order_id);
                    $this->db->where('product_id', $product_id);
                    $this->db->where('variant_id', $variant_id);
                    if (!empty($variant_color)) {
                        $this->db->where('variant_color', $variant_color);
                    }
                    $this->db->update('order_details');
                } else {
                    $this->db->insert('order_details', $order_details);
                }
            }
        }

        //Tax info
        $cgst    = $this->input->post('cgst', TRUE);
        $sgst    = $this->input->post('sgst', TRUE);
        $igst    = $this->input->post('igst', TRUE);
        $cgst_id = $this->input->post('cgst_id', TRUE);
        $sgst_id = $this->input->post('sgst_id', TRUE);
        $igst_id = $this->input->post('igst_id', TRUE);

        //Tax collection summary for three
        //CGST tax info
        if (!empty($cgst)) {
            for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                $cgst_tax = $cgst[$i];
                $cgst_tax_id = $cgst_id[$i];
                $cgst_summary = array(
                    'order_tax_col_id'    =>    $this->auth->generator(15),
                    'order_id'            =>    $order_id,
                    'tax_amount'         =>     $cgst_tax,
                    'tax_id'             =>     $cgst_tax_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($cgst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_summary')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $cgst_tax_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $cgst_tax_id);
                        $this->db->update('order_tax_col_summary');
                    } else {
                        $this->db->insert('order_tax_col_summary', $cgst_summary);
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
                    'order_tax_col_id'    =>    $this->auth->generator(15),
                    'order_id'        =>    $order_id,
                    'tax_amount'         =>     $sgst_tax,
                    'tax_id'             =>     $sgst_tax_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($sgst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_summary')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $sgst_tax_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $sgst_tax_id);
                        $this->db->update('order_tax_col_summary');
                    } else {
                        $this->db->insert('order_tax_col_summary', $sgst_summary);
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
                    'order_tax_col_id'    =>    $this->auth->generator(15),
                    'order_id'        =>    $order_id,
                    'tax_amount'         =>     $igst_tax,
                    'tax_id'             =>     $igst_tax_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($igst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_summary')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $igst_tax_id)
                        ->get()
                        ->num_rows();

                    if ($result > 0) {
                        $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $igst_tax_id);
                        $this->db->update('order_tax_col_summary');
                    } else {
                        $this->db->insert('order_tax_col_summary', $igst_summary);
                    }
                }
            }
        }
        //Tax collection summary for three

        //Tax collection details for three
        //CGST tax info
        if (!empty($cgst)) {
            for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                $cgst_tax      = $cgst[$i];
                $cgst_tax_id = $cgst_id[$i];
                $product_id  = $p_id[$i];
                $variant_id  = $variants[$i];
                $cgst_details = array(
                    'order_tax_col_de_id' =>    $this->auth->generator(15),
                    'order_id'            =>    $order_id,
                    'amount'             =>     $cgst_tax,
                    'product_id'         =>     $product_id,
                    'tax_id'             =>     $cgst_tax_id,
                    'variant_id'         =>     $variant_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($cgst[$i])) {

                    $result = $this->db->select('*')
                        ->from('order_tax_col_details')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $cgst_tax_id)
                        ->where('product_id', $product_id)
                        ->where('variant_id', $variant_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $cgst_tax_id);
                        $this->db->where('variant_id', $variant_id);
                        $this->db->update('order_tax_col_details');
                    } else {
                        $this->db->insert('order_tax_col_details', $cgst_details);
                    }
                }
            }
        }

        //SGST tax info
        if (!empty($sgst)) {
            for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                $sgst_tax      = $sgst[$i];
                $sgst_tax_id = $sgst_id[$i];
                $product_id  = $p_id[$i];
                $variant_id  = $variants[$i];
                $sgst_summary = array(
                    'order_tax_col_de_id'    =>    $this->auth->generator(15),
                    'order_id'            =>    $order_id,
                    'amount'             =>     $sgst_tax,
                    'product_id'         =>     $product_id,
                    'tax_id'             =>     $sgst_tax_id,
                    'variant_id'         =>     $variant_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($sgst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_details')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $sgst_tax_id)
                        ->where('product_id', $product_id)
                        ->where('variant_id', $variant_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $sgst_tax_id);
                        $this->db->where('variant_id', $variant_id);
                        $this->db->update('order_tax_col_details');
                    } else {
                        $this->db->insert('order_tax_col_details', $sgst_summary);
                    }
                }
            }
        }

        //IGST tax info
        if (!empty($igst)) {
            for ($i = 0, $n = count($igst); $i < $n; $i++) {
                $igst_tax      = $igst[$i];
                $igst_tax_id = $igst_id[$i];
                $product_id  = $p_id[$i];
                $variant_id  = $variants[$i];
                $igst_summary = array(
                    'order_tax_col_de_id' =>    $this->auth->generator(15),
                    'order_id'            =>    $order_id,
                    'amount'             =>     $igst_tax,
                    'product_id'         =>     $product_id,
                    'tax_id'             =>     $igst_tax_id,
                    'variant_id'         =>     $variant_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($igst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_details')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $igst_tax_id)
                        ->where('product_id', $product_id)
                        ->where('variant_id', $variant_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $igst_tax_id);
                        $this->db->where('variant_id', $variant_id);
                        $this->db->update('order_tax_col_details');
                    } else {
                        $this->db->insert('order_tax_col_details', $igst_summary);
                    }
                }
            }
        }
        //Tax collection details for three
        return $order_id;
    }

    // create new order
    public function order_entry($order_id = null, $orderNo = null)
    {
        // if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $invoice_id = $order_id ? $order_id : generator(15);
                $orderNo = $orderNo ? $orderNo : $this->number_generator_order();
                $quantity = $this->input->post('product_quantity', TRUE);
                $available_quantity = $this->input->post('available_quantity', TRUE);
                $product_id = $this->input->post('product_id', TRUE);
                $pricing_type = $this->input->post('pri_type', TRUE);
                $payment_id = $this->input->post('payment_id', TRUE);
                $product_type = $this->input->post('product_type', TRUE);

                //Stock availability check
                $result = array();
                foreach ($available_quantity as $k => $v) {
                    if ($v < $quantity[$k]) {
                        $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                        redirect('dashboard/Corder');
                    }
                }

                //Product existing check
                if ($product_id == null) {
                    $this->session->set_userdata(array('error_message' => display('please_select_product')));
                    redirect('dashboard/Corder');
                }

                //payment account existing check
                // if ($payment_id == null && $order_id) {
                //     $this->session->set_userdata(array('error_message' => display('please_select_payment')));
                //     redirect('dashboard/Corder/create_invoice_form/' . $order_id);
                // }

                //Customer existing check
                if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
                    $this->session->set_userdata(array('error_message' => display('please_select_customer')));
                    redirect(base_url() . 'dashboard/Corder');
                }

                //Customer data Existence Check.
                $customer_id = $this->input->post('customer_id', TRUE);
                // if ($this->input->post('customer_id', TRUE)) {
                //     $customer_id = $this->input->post('customer_id', TRUE);
                // } 
                // else {
                //     $customer_id = generator(15);
                //     //Customer  basic information adding.
                //     $data = array(
                //         'customer_id' => $customer_id,
                //         'customer_name' => $this->input->post('customer_name_others', TRUE),
                //         'customer_address_1' => $this->input->post('customer_name_others_address', TRUE),
                //         'customer_mobile' => $this->input->post('customer_mobile_no', TRUE),
                //         'customer_email' => "NONE",
                //         'status' => 1
                //     );
                //     $this->Customers->customer_entry($data);
                //     //Previous balance adding -> Sending to customer model to adjust the data.
                //     $this->Customers->previous_balance_add(0, $customer_id);
                // }

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
                        'date' => $this->input->post('invoice_date', TRUE),
                        'amount' => $this->input->post('paid_amount', TRUE),
                        'payment_type' => 1,
                        'description' => 'ITP',
                        'status' => 1,
                        // 'created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                    );
                    $this->db->insert('order_customer_ledger', $data2);
                }

                //Insert to customer ledger Table 
                $data2 = array(
                    'transaction_id' => generator(15),
                    'customer_id' => $customer_id,
                    'invoice_no' => $invoice_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                    'amount' => $this->input->post('grand_total_price', TRUE),
                    'status' => 1
                );
                $this->db->insert('order_customer_ledger', $data2);

                //Data inserting into invoice table
                (($this->input->post('total_cgst', true) && $this->input->post('is_quotation', true) == 0) ? $total_cgsti = $this->input->post('total_cgst', true) : $total_cgsti = 0);
                (($this->input->post('total_sgst', true)) ? $total_sgsti = $this->input->post('total_sgst', true) : $total_sgsti = 0);
                (($this->input->post('total_igst', true)) ? $total_igsti = $this->input->post('total_igst', true) : $total_igsti = 0);

                $tota_vati = $total_cgsti + $total_sgsti + $total_igsti;
                $installment_month_no = $this->input->post('month_no', true);
                $data = array(
                    'order_id' => $invoice_id,
                    'customer_id' => $customer_id,
                    'date' => $this->input->post('invoice_date', TRUE),
                    'total_amount' => $this->input->post('grand_total_price', TRUE),
                    'order' => $orderNo,
                    'total_discount' => $this->input->post('total_discount', TRUE),
                    'total_vat' => $tota_vati,
                    'is_quotation' => ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
                    'employee_id' => $this->input->post('employee_id', true),
                    'is_installment' => $this->input->post('is_installment', true),
                    'month_no' => $installment_month_no,
                    'due_day' => $this->input->post('due_day', true),
                    'order_discount' => $this->input->post('invoice_discount', TRUE),
                    'percentage_discount' => $this->input->post('percentage_discount', TRUE),
                    'user_id' => $this->session->userdata('user_id'),
                    'store_id' => $this->input->post('store_id', TRUE),
                    'paid_amount' => $this->input->post('paid_amount', TRUE),
                    'due_amount' => $this->input->post('due_amount', TRUE),
                    'service_charge' => $this->input->post('service_charge', TRUE),
                    'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
                    'shipping_method' => $this->input->post('shipping_method', TRUE),
                    'details' => $this->input->post('invoice_details', TRUE),
                    'status' => 1,
                    // 'created_at' => date("Y-m-d H:i:s"),
                    'pricing_type' => $pricing_type,
                    'created_at' => date('Y-m-d H:i:s', strtotime($this->input->post('invoice_date', TRUE))),
                    'product_type' => $product_type,
                    'customer_balance' => $this->input->post('customer_balance', TRUE),
                );
                $this->db->insert('order', $data);

                // insert installment
                if ($this->input->post('is_installment', true) == 1) {
                    $installment_amount = $this->input->post('amount', TRUE);
                    $installment_due_date = $this->input->post('due_date', TRUE);
                    for ($i = 0; $i < $installment_month_no; $i++) {
                        $installment_data = array(
                            'invoice_id' => $invoice_id,
                            'amount' => $installment_amount[$i],
                            'due_date' => $installment_due_date[$i],
                        );
                        $this->db->insert('order_invoice_installment', $installment_data);
                    }
                }

                //Invoice details info
                $rate = $this->input->post('product_rate', TRUE);
                $p_id = $this->input->post('product_id', TRUE);
                $total_amount = $this->input->post('total_price', TRUE);
                $discount = $this->input->post('discount', TRUE);
                $variants = $this->input->post('variant_id', TRUE);
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
                        $invoice_details = array(
                            'order_details_id' => generator(15),
                            'order_id' => $invoice_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                            //  'pricing_id' => $pricing_id,
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
                            $this->db->from('order_details');
                            $this->db->where('order_id', $invoice_id);
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
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('product_id', $product_id);
                                $this->db->where('variant_id', $variant_id);
                                if (!empty($variant_color)) {
                                    $this->db->where('variant_color', $variant_color);
                                }
                                $this->db->update('order_details');
                            } else {
                                $this->db->insert('order_details', $invoice_details);
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
                                        $this->db->insert('order_invoice_stock_tbl', $stock);
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
                                        $this->db->update('order_invoice_stock_tbl', $stock);
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

                        $invoice_details = array(
                            'order_details_id' => generator(15),
                            'order_id' => $invoice_id,
                            'product_id' => $product_id,
                            'variant_id' => $variant_id,
                            //  'pricing_id' => $pricing_id,
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
                            $this->db->from('order_details');
                            $this->db->where('order_id', $invoice_id);
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
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('product_id', $product_id);
                                $this->db->where('variant_id', $variant_id);
                                if (!empty($variant_color)) {
                                    $this->db->where('variant_color', $variant_color);
                                }
                                $this->db->update('order_details');
                            } else {
                                $this->db->insert('order_details', $invoice_details);
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
                                $this->db->insert('order_invoice_stock_tbl', $stock);
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
                                $this->db->update('order_invoice_stock_tbl', $stock);
                                //update
                            }
                            // stock
                        }
                    }
                }

                // SALES/INVOICE TRANSECTIONS ENTRY
                $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                // if (empty($customer_head)) {
                //     $this->load->model('accounting/account_model');
                //     $customer_name = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $result->customer_id)->get()->row();
                //     if ($customer_name) {
                //         $customer_data = $data = array(
                //             'customer_id' => $result->customer_id,
                //             'customer_name' => $customer_name->customer_name,
                //         );
                //         $this->account_model->insert_customer_head($customer_data);
                //     }
                //     $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                // }
                $createdate = date('Y-m-d H:i:s');
                $receive_by = $this->session->userdata('user_id');
                $date = $createdate;

                $i_vat = $this->db->select('total_vat')->from('order')->where('order_id', $invoice_id)->get()->row();
                $tota_vat = $i_vat->total_vat;
                $total_with_vat = $this->input->post('grand_total_price', TRUE);
                $cogs_price = $cogs_price;
                $total_discount = $this->input->post('total_discount', TRUE);
                $total_price_before_discount = ($total_with_vat - $tota_vat) + $total_discount;
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();

                $payment_id = $this->input->post('payment_id', TRUE);
                $account_no = $this->input->post('account_no', TRUE);

                //1st customer debit total_with_vat
                // $customer_debit = array(
                //     'fy_id' => $find_active_fiscal_year->id,
                //     'VNo' => $invoice_id,
                //     'Vtype' => 'Sales',
                //     'VDate' => $date,
                //     'COAID' => $customer_head->HeadCode,
                //     'Narration' => 'Sales "total with vat" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                //     'Debit' => $total_with_vat,
                //     'Credit' => 0,
                //     'IsPosted' => 1,
                //     'CreateBy' => $receive_by,
                //     'CreateDate' => $createdate,
                //     //'IsAppove' => 0
                //     'IsAppove' => 1
                // );
                // $this->db->insert('order_acc_transaction', $customer_debit);

                // //2nd Allowed Discount Debit
                // $allowed_discount_debit = array(
                //     'fy_id' => $find_active_fiscal_year->id,
                //     'VNo' => $invoice_id,
                //     'Vtype' => 'Sales',
                //     'VDate' => $date,
                //     'COAID' => 4114,
                //     'Narration' => 'Sales "total discount" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                //     'Debit' => $total_discount,
                //     'Credit' => 0,
                //     'IsPosted' => 1,
                //     'CreateBy' => $receive_by,
                //     'CreateDate' => $createdate,
                //     //'IsAppove' => 0
                //     'IsAppove' => 1
                // );
                // //3rd Showroom Sales credit
                // $showroom_sales_credit = array(
                //     'fy_id' => $find_active_fiscal_year->id,
                //     'VNo' => $invoice_id,
                //     'Vtype' => 'Sales',
                //     'VDate' => $date,
                //     'COAID' => 5111, // account payable game 11
                //     'Narration' => 'Sales "total price before discount" store_credit credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                //     'Debit' => 0,
                //     'Credit' => $total_price_before_discount,
                //     'IsPosted' => 1,
                //     'CreateBy' => $receive_by,
                //     'CreateDate' => $createdate,
                //     //'IsAppove' => 0
                //     'IsAppove' => 1
                // );
                // //4th VAT on Sales
                // $vat_credit = array(
                //     'fy_id' => $find_active_fiscal_year->id,
                //     'VNo' => $invoice_id,
                //     'Vtype' => 'Sales',
                //     'VDate' => $date,
                //     'COAID' => 2114, // account payable game 11
                //     'Narration' => 'Sales "total vat" credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                //     'Debit' => 0,
                //     'Credit' => $tota_vat,
                //     'IsPosted' => 1,
                //     'CreateBy' => $receive_by,
                //     'CreateDate' => $createdate,
                //     //'IsAppove' => 0
                //     'IsAppove' => 1
                // );

                // //5th cost of goods sold debit
                // $cogs_debit = array(
                //     'fy_id' => $find_active_fiscal_year->id,
                //     'VNo' => $invoice_id,
                //     'Vtype' => 'Sales',
                //     'VDate' => $date,
                //     'COAID' => 4111,
                //     'Narration' => 'Sales "cost of goods sold" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                //     'Debit' => $cogs_price,
                //     'Credit' => 0, //sales price asbe
                //     'IsPosted' => 1,
                //     'CreateBy' => $receive_by,
                //     'CreateDate' => $createdate,
                //     //'IsAppove' => 0
                //     'IsAppove' => 1
                // );
                // //6th cost of goods sold Main warehouse Credit
                // $cogs_main_warehouse_credit = array(
                //     'fy_id' => $find_active_fiscal_year->id,
                //     'VNo' => $invoice_id,
                //     'Vtype' => 'Sales',
                //     'VDate' => $date,
                //     'COAID' => 1141,
                //     'Narration' => '"cost of goods sold" Main warehouse credited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                //     'Debit' => 0,
                //     'Credit' => $cogs_price, //supplier price asbe
                //     'IsPosted' => 1,
                //     'CreateBy' => $receive_by,
                //     'CreateDate' => $createdate,
                //     //'IsAppove' => 0
                //     'IsAppove' => 1
                // );
                // //7th paid_amount Credit
                // if ($this->input->post('paid_amount', TRUE) > 0) {
                //     $paid_amount = $this->input->post('paid_amount', TRUE);
                //     $customer_credit = array(
                //         'fy_id' => $find_active_fiscal_year->id,
                //         'VNo' => $invoice_id,
                //         'Vtype' => 'Sales',
                //         'VDate' => $date,
                //         'COAID' => $customer_head->HeadCode,
                //         'Narration' => 'Sales "paid_amount" Credit by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                //         'Debit' => 0,
                //         'Credit' => $paid_amount,
                //         'IsPosted' => 1,
                //         'CreateBy' => $receive_by,
                //         'CreateDate' => $createdate,
                //         //'IsAppove' => 0
                //         'IsAppove' => 1
                //     );
                //     $this->db->insert('order_acc_transaction', $customer_credit);
                //     if (!empty($payment_id)) {
                //         $payment_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', $payment_id)->get()->row();
                //         $bank_debit = array(
                //             'fy_id' => $find_active_fiscal_year->id,
                //             'VNo' => $invoice_id,
                //             'Vtype' => 'Sales',
                //             'VDate' => $date,
                //             'COAID' => $payment_head->HeadCode,
                //             'Narration' => 'Sales "paid_amount" debited by cash/bank id: ' . $payment_head->HeadName . '(' . $payment_id . ')',
                //             'Debit' => $paid_amount,
                //             'Credit' => 0,
                //             'IsPosted' => 1,
                //             'CreateBy' => $receive_by,
                //             'CreateDate' => $createdate,
                //             //'IsAppove' => 0
                //             'IsAppove' => 1
                //         );
                //         $this->db->insert('order_acc_transaction', $bank_debit);
                //     }
                // }
                // $this->db->insert('order_acc_transaction', $allowed_discount_debit);
                // $this->db->insert('order_acc_transaction', $showroom_sales_credit);
                // $this->db->insert('order_acc_transaction', $vat_credit);
                // $this->db->insert('order_acc_transaction', $cogs_debit);
                // $this->db->insert('order_acc_transaction', $cogs_main_warehouse_credit);
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
                            'order_tax_col_id ' => $this->auth->generator(15),
                            'order_id' => $invoice_id,
                            'tax_amount' => $cgst_tax,
                            'tax_id' => $cgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($cgst[$i])) {
                            $result = $this->db->select('*')
                                ->from('order_tax_col_summary')
                                ->where('order_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->get()
                                ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->update('order_tax_col_summary');
                            } else {
                                $this->db->insert('order_tax_col_summary', $cgst_summary);
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
                            'order_tax_col_id ' => $this->auth->generator(15),
                            'order_id' => $invoice_id,
                            'tax_amount' => $sgst_tax,
                            'tax_id' => $sgst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                ->from('order_tax_col_summary')
                                ->where('order_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->get()
                                ->num_rows();
                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->update('order_tax_col_summary');
                            } else {
                                $this->db->insert('order_tax_col_summary', $sgst_summary);
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
                            'order_tax_col_id ' => generator(15),
                            'order_id' => $invoice_id,
                            'tax_amount' => $igst_tax,
                            'tax_id' => $igst_tax_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                ->from('order_tax_col_summary')
                                ->where('order_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->get()
                                ->num_rows();

                            if ($result > 0) {
                                $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->update('order_tax_col_summary');
                            } else {
                                $this->db->insert('order_tax_col_summary', $igst_summary);
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
                            'order_tax_col_de_id' => generator(15),
                            'order_id' => $invoice_id,
                            'amount' => $cgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $cgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($cgst[$i])) {

                            $result = $this->db->select('*')
                                ->from('order_tax_col_details')
                                ->where('order_id', $invoice_id)
                                ->where('tax_id', $cgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('tax_id', $cgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('order_tax_col_details');
                            } else {
                                $this->db->insert('order_tax_col_details', $cgst_details);
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
                            'order_tax_col_de_id' => generator(15),
                            'order_id' => $invoice_id,
                            'amount' => $sgst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $sgst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($sgst[$i])) {
                            $result = $this->db->select('*')
                                ->from('order_tax_col_details')
                                ->where('order_id', $invoice_id)
                                ->where('tax_id', $sgst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('tax_id', $sgst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('order_tax_col_details');
                            } else {
                                $this->db->insert('order_tax_col_details', $sgst_summary);
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
                            'order_tax_col_de_id' => generator(15),
                            'order_id' => $invoice_id,
                            'amount' => $igst_tax,
                            'product_id' => $product_id,
                            'tax_id' => $igst_tax_id,
                            'variant_id' => $variant_id,
                            'date' => $this->input->post('invoice_date', TRUE),
                        );
                        if (!empty($igst[$i])) {
                            $result = $this->db->select('*')
                                ->from('order_tax_col_details')
                                ->where('order_id', $invoice_id)
                                ->where('tax_id', $igst_tax_id)
                                ->where('product_id', $product_id)
                                ->where('variant_id', $variant_id)
                                ->get()
                                ->num_rows();
                            if ($result > 0) {
                                $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                                $this->db->where('order_id', $invoice_id);
                                $this->db->where('tax_id', $igst_tax_id);
                                $this->db->where('variant_id', $variant_id);
                                $this->db->update('order_tax_col_details');
                            } else {
                                $this->db->insert('order_tax_col_details', $igst_summary);
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
        // }
        //  else {
        //     //Invoice entry info
        //     $invoice_id = $order_id ? $order_id : generator(15);
        //     $quantity = $this->input->post('product_quantity', TRUE);
        //     $available_quantity = $this->input->post('available_quantity', TRUE);
        //     $product_id = $this->input->post('product_id', TRUE);
        //     $pricing_type = $this->input->post('pri_type', TRUE);
        //     $payment_id = $this->input->post('payment_id', TRUE);

        //     //Stock availability check
        //     $result = array();
        //     foreach ($available_quantity as $k => $v) {
        //         if ($v < $quantity[$k]) {
        //             $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
        //             redirect('dashboard/Corder');
        //         }
        //     }

        //     //Product existing check
        //     if ($product_id == null) {
        //         $this->session->set_userdata(array('error_message' => display('please_select_product')));
        //         redirect('dashboard/Corder');
        //     }

        //     //payment account existing check
        //     // if ($payment_id == null && $order_id) {
        //     //     $this->session->set_userdata(array('error_message' => display('please_select_payment')));
        //     //     redirect('dashboard/Corder/create_invoice_form/' . $order_id);
        //     // }

        //     //Customer existing check
        //     if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
        //         $this->session->set_userdata(array('error_message' => display('please_select_customer')));
        //         redirect(base_url() . 'dashboard/Corder');
        //     }

        //     //Customer data Existence Check.
        //     if ($this->input->post('customer_id', TRUE)) {
        //         $customer_id = $this->input->post('customer_id', TRUE);
        //     }
        //     // else {
        //     //     $customer_id = generator(15);
        //     //     //Customer  basic information adding.
        //     //     $data = array(
        //     //         'customer_id' => $customer_id,
        //     //         'customer_name' => $this->input->post('customer_name_others', TRUE),
        //     //         'customer_address_1' => $this->input->post('customer_name_others_address', TRUE),
        //     //         'customer_mobile' => $this->input->post('customer_mobile_no', TRUE),
        //     //         'customer_email' => "NONE",
        //     //         'status' => 1
        //     //     );
        //     //     $this->Customers->customer_entry($data);
        //     //     //Previous balance adding -> Sending to customer model to adjust the data.
        //     //     $this->Customers->previous_balance_add(0, $customer_id);
        //     // }

        //     // create customer head start
        //     // if (check_module_status('accounting') == 1) {
        //     //     $this->load->model('accounting/account_model');
        //     //     $check_customer = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->get()->row();
        //     //     if (!empty($check_customer)) {
        //     //         $customer_data = $data = array(
        //     //             'customer_id' => $customer_id,
        //     //             'customer_name' => $check_customer->customer_name,
        //     //         );
        //     //     } else {
        //     //         $customer_data = $data = array(
        //     //             'customer_id' => $customer_id,
        //     //             'customer_name' => $this->input->post('customer_id', TRUE)
        //     //         );
        //     //     }
        //     //     $this->account_model->insert_customer_head($customer_data);
        //     // }
        //     // create customer head END
        //     //Full or partial Payment record.
        //     // if ($this->input->post('paid_amount', TRUE) > 0) {
        //     //Insert to customer_ledger Table 
        //     // $data2 = array(
        //     //     'transaction_id' => generator(15),
        //     //     'customer_id' => $customer_id,
        //     //     'invoice_no' => $invoice_id,
        //     //     'receipt_no' => $this->auth->generator(15),
        //     //     'date' => $this->input->post('invoice_date', TRUE),
        //     //     'amount' => $this->input->post('paid_amount', TRUE),
        //     //     'payment_type' => 1,
        //     //     'description' => 'ITP',
        //     //     'status' => 1
        //     // );
        //     // $this->db->insert('order_customer_ledger', $data2);
        //     // }

        //     //Insert to customer ledger Table 
        //     // $data2 = array(
        //     //     'transaction_id' => generator(15),
        //     //     'customer_id' => $customer_id,
        //     //     'invoice_no' => $invoice_id,
        //     //     'date' => $this->input->post('invoice_date', TRUE),
        //     //     'amount' => $this->input->post('grand_total_price', TRUE),
        //     //     'status' => 1
        //     // );
        //     // $this->db->insert('order_customer_ledger', $data2);

        //     //Data inserting into invoice table
        //     (($this->input->post('total_cgst', true) && $this->input->post('is_quotation', true) == 0) ? $total_cgsti = $this->input->post('total_cgst', true) : $total_cgsti = 0);
        //     (($this->input->post('total_sgst', true)) ? $total_sgsti = $this->input->post('total_sgst', true) : $total_sgsti = 0);
        //     (($this->input->post('total_igst', true)) ? $total_igsti = $this->input->post('total_igst', true) : $total_igsti = 0);
        //     $tota_vati = $total_cgsti + $total_sgsti + $total_igsti;
        //     $installment_month_no = $this->input->post('month_no', true);
        //     $data = array(
        //         // 'order_id' => $invoice_id,
        //         // 'customer_id' => $customer_id,
        //         // 'date' => $this->input->post('invoice_date', TRUE),
        //         // 'total_amount' => $this->input->post('grand_total_price', TRUE),
        //         // 'order' => $orderNo,
        //         // 'total_discount' => $this->input->post('total_discount', TRUE),
        //         // 'product_discount' => $this->input->post('invoice_discount', TRUE),
        //         // 'user_id' => $this->session->userdata('user_id'),
        //         // 'store_id' => $this->input->post('store_id', TRUE),
        //         // 'paid_amount' => $this->input->post('paid_amount', TRUE),
        //         // 'due_amount' => $this->input->post('due_amount', TRUE),
        //         // 'service_charge' => $this->input->post('service_charge', TRUE),
        //         // 'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
        //         // 'shipping_method' => $this->input->post('shipping_method', TRUE),
        //         // 'details' => $this->input->post('invoice_details', TRUE),
        //         // 'status' => 1,
        //         // 'created_at' => date('Y-m-d h:i:s')
        //         'order_id' => $invoice_id,
        //         'customer_id' => $customer_id,
        //         'date' => $this->input->post('invoice_date', TRUE),
        //         'total_amount' => $this->input->post('grand_total_price', TRUE),
        //         'order' => $orderNo,
        //         'total_discount' => $this->input->post('total_discount', TRUE),
        //         'total_vat' => $tota_vati,
        //         'is_quotation' => ($this->input->post('is_quotation', True)) ? $this->input->post('is_quotation', True) : 0,
        //         'employee_id' => $this->input->post('employee_id', true),
        //         'is_installment' => $this->input->post('is_installment', true),
        //         'month_no' => $installment_month_no,
        //         'due_day' => $this->input->post('due_day', true),
        //         'order_discount' => $this->input->post('invoice_discount', TRUE),
        //         'percentage_discount' => $this->input->post('percentage_discount', TRUE),
        //         'user_id' => $this->session->userdata('user_id'),
        //         'store_id' => $this->input->post('store_id', TRUE),
        //         'paid_amount' => $this->input->post('paid_amount', TRUE),
        //         'due_amount' => $this->input->post('due_amount', TRUE),
        //         'service_charge' => $this->input->post('service_charge', TRUE),
        //         'shipping_charge' => $this->input->post('shipping_charge', TRUE) ? $this->input->post('shipping_charge', TRUE) : 0,
        //         'shipping_method' => $this->input->post('shipping_method', TRUE),
        //         'details' => $this->input->post('invoice_details', TRUE),
        //         'status' => 1,
        //         'created_at' => date("Y-m-d H:i:s"),
        //         'pricing_type' => $pricing_type
        //     );
        //     $this->db->insert('order', $data);

        //     // insert installment
        //     if ($this->input->post('is_installment', true) == 1) {
        //         $installment_amount = $this->input->post('amount', TRUE);
        //         $installment_due_date = $this->input->post('due_date', TRUE);
        //         for ($i = 0; $i < $installment_month_no; $i++) {
        //             $installment_data = array(
        //                 'invoice_id' => $invoice_id,
        //                 'amount' => $installment_amount[$i],
        //                 'due_date' => $installment_due_date[$i],
        //             );
        //             $this->db->insert('order_invoice_installment', $installment_data);
        //         }
        //     }


        //     //Insert payment method
        //     $terminal = $this->input->post('terminal', TRUE);
        //     $bank_id = $this->input->post('bank_id', TRUE);
        //     $account_no = $this->input->post('account_no', TRUE);
        //     $payment_amount = $this->input->post('grand_total_price', TRUE);

        //     // if (!empty($bank_id) && !empty($account_no)) {
        //     //     $bank_paydata = array(
        //     //         'bank_payment_id' => generator(15),
        //     //         'terminal_id' => ($terminal ? $terminal : ''),
        //     //         'bank_id' => $bank_id,
        //     //         'account_no' => $account_no,
        //     //         'amount' => $payment_amount,
        //     //         'invoice_id' => $invoice_id,
        //     //         'date' => $this->input->post('invoice_date', TRUE),
        //     //     );
        //     //     $this->db->insert('order_bank_payment', $bank_paydata);
        //     // }

        //     //Invoice details info
        //     $rate = $this->input->post('product_rate', TRUE);
        //     $p_id = $this->input->post('product_id', TRUE);
        //     $total_amount = $this->input->post('total_price', TRUE);
        //     $discount = $this->input->post('discount', TRUE);
        //     $variants = $this->input->post('variant_id', TRUE);
        //     // $pricing = $this->input->post('pricing', TRUE);
        //     $color_variants = $this->input->post('color_variant', TRUE);
        //     $batch_no = $this->input->post('batch_no', TRUE);
        //     $cogs_price = 0;

        //     //Invoice details for invoice
        //     for ($i = 0, $n = count($quantity); $i < $n; $i++) {
        //         $product_quantity = $quantity[$i];
        //         $product_rate = $rate[$i];
        //         $product_id = $p_id[$i];
        //         $discount_rate = $discount[$i];
        //         $total_price = $total_amount[$i];
        //         //  $pricing_id = $pricing[$i];
        //         $variant_id = $variants[$i];
        //         $variant_color = $color_variants[$i];
        //         $batch = $batch_no[$i];
        //         $supplier_rate = $this->supplier_rate($product_id);
        //         $cogs_price += ($supplier_rate[0]['supplier_price'] * $product_quantity);

        //         $invoice_details = array(
        //             'order_details_id' => generator(15),
        //             'order_id' => $invoice_id,
        //             'product_id' => $product_id,
        //             //  'pricing_id' => $pricing_id,
        //             'variant_id' => $variant_id,
        //             'variant_color' => $variant_color,
        //             'batch_no' => $batch,
        //             'store_id' => $this->input->post('store_id', TRUE),
        //             'quantity' => $product_quantity,
        //             'rate' => $product_rate,
        //             'supplier_rate' => $supplier_rate[0]['supplier_price'],
        //             'total_price' => $total_price,
        //             'discount' => $discount_rate,
        //             'status' => 1
        //         );

        //         if (!empty($quantity)) {
        //             $this->db->select('*');
        //             $this->db->from('order_details');
        //             $this->db->where('order_id', $invoice_id);
        //             $this->db->where('product_id', $product_id);
        //             $this->db->where('variant_id', $variant_id);
        //             if (!empty($variant_color)) {
        //                 $this->db->where('variant_color', $variant_color);
        //             }
        //             $query = $this->db->get();
        //             $result = $query->num_rows();

        //             if ($result > 0) {
        //                 $this->db->set('quantity', 'quantity+' . $product_quantity, FALSE);
        //                 $this->db->set('total_price', 'total_price+' . $total_price, FALSE);
        //                 $this->db->where('order_id', $invoice_id);
        //                 $this->db->where('product_id', $product_id);
        //                 $this->db->where('variant_id', $variant_id);
        //                 if (!empty($variant_color)) {
        //                     $this->db->where('variant_color', $variant_color);
        //                 }
        //                 $this->db->update('order_details');
        //             } else {
        //                 $this->db->insert('order_details', $invoice_details);
        //             }

        //             // stock 
        //             $store_id = $this->input->post('store_id', TRUE);
        //             $check_stock = $this->check_stock($store_id, $product_id, $variant_id, $variant_color);
        //             if (empty($check_stock)) {
        //                 // insert
        //                 $stock = array(
        //                     'store_id' => $store_id,
        //                     'product_id' => $product_id,
        //                     'variant_id' => $variant_id,
        //                     'variant_color' => (!empty($variant_color) ? $variant_color : NULL),
        //                     'quantity' => $product_quantity,
        //                     'warehouse_id' => '',
        //                 );
        //                 $this->db->insert('order_invoice_stock_tbl', $stock);
        //                 // insert
        //             } else {
        //                 //update
        //                 $stock = array(
        //                     'quantity' => $check_stock->quantity + $product_quantity
        //                 );
        //                 if (!empty($store_id)) {
        //                     $this->db->where('store_id', $store_id);
        //                 }
        //                 if (!empty($product_id)) {
        //                     $this->db->where('product_id', $product_id);
        //                 }
        //                 if (!empty($variant_id)) {
        //                     $this->db->where('variant_id', $variant_id);
        //                 }
        //                 if (!empty($variant_color)) {
        //                     $this->db->where('variant_color', $variant_color);
        //                 }
        //                 $this->db->update('order_invoice_stock_tbl', $stock);
        //                 //update
        //             }
        //             // stock
        //         }
        //     }

        //     //Tax information
        //     $cgst = $this->input->post('cgst', TRUE);
        //     $sgst = $this->input->post('sgst', TRUE);
        //     $igst = $this->input->post('igst', TRUE);
        //     $cgst_id = $this->input->post('cgst_id', TRUE);
        //     $sgst_id = $this->input->post('sgst_id', TRUE);
        //     $igst_id = $this->input->post('igst_id', TRUE);

        //     //Tax collection summary for three start
        //     //CGST tax info
        //     if (!empty($cgst)) {
        //         for ($i = 0, $n = count(@$cgst); $i < $n; $i++) {
        //             $cgst_tax = $cgst[$i];
        //             $cgst_tax_id = $cgst_id[$i];
        //             $cgst_summary = array(
        //                 'order_tax_collection_id' => $this->auth->generator(15),
        //                 'order_id' => $invoice_id,
        //                 'tax_amount' => $cgst_tax,
        //                 'tax_id' => $cgst_tax_id,
        //                 'date' => $this->input->post('invoice_date', TRUE),
        //             );
        //             if (!empty($cgst[$i])) {
        //                 $result = $this->db->select('*')
        //                     ->from('order_tax_col_summary')
        //                     ->where('order_id', $invoice_id)
        //                     ->where('tax_id', $cgst_tax_id)
        //                     ->get()
        //                     ->num_rows();
        //                 if ($result > 0) {
        //                     $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
        //                     $this->db->where('order_id', $invoice_id);
        //                     $this->db->where('tax_id', $cgst_tax_id);
        //                     $this->db->update('order_tax_col_summary');
        //                 } else {
        //                     $this->db->insert('order_tax_col_summary', $cgst_summary);
        //                 }
        //             }
        //         }
        //     }
        //     //SGST tax info
        //     if (!empty($sgst)) {
        //         for ($i = 0, $n = count($sgst); $i < $n; $i++) {
        //             $sgst_tax = $sgst[$i];
        //             $sgst_tax_id = $sgst_id[$i];

        //             $sgst_summary = array(
        //                 'order_tax_collection_id' => $this->auth->generator(15),
        //                 'order_id' => $invoice_id,
        //                 'tax_amount' => $sgst_tax,
        //                 'tax_id' => $sgst_tax_id,
        //                 'date' => $this->input->post('invoice_date', TRUE),
        //             );
        //             if (!empty($sgst[$i])) {
        //                 $result = $this->db->select('*')
        //                     ->from('order_tax_col_summary')
        //                     ->where('order_id', $invoice_id)
        //                     ->where('tax_id', $sgst_tax_id)
        //                     ->get()
        //                     ->num_rows();
        //                 if ($result > 0) {
        //                     $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
        //                     $this->db->where('order_id', $invoice_id);
        //                     $this->db->where('tax_id', $sgst_tax_id);
        //                     $this->db->update('order_tax_col_summary');
        //                 } else {
        //                     $this->db->insert('order_tax_col_summary', $sgst_summary);
        //                 }
        //             }
        //         }
        //     }
        //     if (!empty($igst)) {
        //         //IGST tax info
        //         for ($i = 0, $n = count($igst); $i < $n; $i++) {
        //             $igst_tax = $igst[$i];
        //             $igst_tax_id = $igst_id[$i];

        //             $igst_summary = array(
        //                 'order_tax_collection_id' => generator(15),
        //                 'order_id' => $invoice_id,
        //                 'tax_amount' => $igst_tax,
        //                 'tax_id' => $igst_tax_id,
        //                 'date' => $this->input->post('invoice_date', TRUE),
        //             );
        //             if (!empty($igst[$i])) {
        //                 $result = $this->db->select('*')
        //                     ->from('order_tax_col_summary')
        //                     ->where('order_id', $invoice_id)
        //                     ->where('tax_id', $igst_tax_id)
        //                     ->get()
        //                     ->num_rows();

        //                 if ($result > 0) {
        //                     $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
        //                     $this->db->where('order_id', $invoice_id);
        //                     $this->db->where('tax_id', $igst_tax_id);
        //                     $this->db->update('order_tax_col_summary');
        //                 } else {
        //                     $this->db->insert('order_tax_col_summary', $igst_summary);
        //                 }
        //             }
        //         }
        //     }
        //     //Tax collection summary for three end
        //     //Tax collection details for three start
        //     //CGST tax info
        //     if (!empty($cgst)) {
        //         for ($i = 0, $n = count($cgst); $i < $n; $i++) {
        //             $cgst_tax = $cgst[$i];
        //             $cgst_tax_id = $cgst_id[$i];
        //             $product_id = $p_id[$i];
        //             $variant_id = $variants[$i];
        //             $cgst_details = array(
        //                 'order_tax_col_de_id' => generator(15),
        //                 'order_id' => $invoice_id,
        //                 'amount' => $cgst_tax,
        //                 'product_id' => $product_id,
        //                 'tax_id' => $cgst_tax_id,
        //                 'variant_id' => $variant_id,
        //                 'date' => $this->input->post('invoice_date', TRUE),
        //             );
        //             if (!empty($cgst[$i])) {

        //                 $result = $this->db->select('*')
        //                     ->from('order_tax_col_details')
        //                     ->where('order_id', $invoice_id)
        //                     ->where('tax_id', $cgst_tax_id)
        //                     ->where('product_id', $product_id)
        //                     ->where('variant_id', $variant_id)
        //                     ->get()
        //                     ->num_rows();
        //                 if ($result > 0) {
        //                     $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
        //                     $this->db->where('order_id', $invoice_id);
        //                     $this->db->where('tax_id', $cgst_tax_id);
        //                     $this->db->where('variant_id', $variant_id);
        //                     $this->db->update('order_tax_col_details');
        //                 } else {
        //                     $this->db->insert('order_tax_col_details', $cgst_details);
        //                 }
        //             }
        //         }
        //     }

        //     //SGST tax info
        //     if (!empty($sgst)) {
        //         for ($i = 0, $n = count($sgst); $i < $n; $i++) {
        //             $sgst_tax = $sgst[$i];
        //             $sgst_tax_id = $sgst_id[$i];
        //             $product_id = $p_id[$i];
        //             $variant_id = $variants[$i];
        //             $sgst_summary = array(
        //                 'order_tax_col_de_id' => generator(15),
        //                 'order_id' => $invoice_id,
        //                 'amount' => $sgst_tax,
        //                 'product_id' => $product_id,
        //                 'tax_id' => $sgst_tax_id,
        //                 'variant_id' => $variant_id,
        //                 'date' => $this->input->post('invoice_date', TRUE),
        //             );
        //             if (!empty($sgst[$i])) {
        //                 $result = $this->db->select('*')
        //                     ->from('order_tax_col_details')
        //                     ->where('order_id', $invoice_id)
        //                     ->where('tax_id', $sgst_tax_id)
        //                     ->where('product_id', $product_id)
        //                     ->where('variant_id', $variant_id)
        //                     ->get()
        //                     ->num_rows();
        //                 if ($result > 0) {
        //                     $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
        //                     $this->db->where('order_id', $invoice_id);
        //                     $this->db->where('tax_id', $sgst_tax_id);
        //                     $this->db->where('variant_id', $variant_id);
        //                     $this->db->update('order_tax_col_details');
        //                 } else {
        //                     $this->db->insert('order_tax_col_details', $sgst_summary);
        //                 }
        //             }
        //         }
        //     }
        //     // IGST tax info
        //     if (!empty($igst)) {
        //         for ($i = 0, $n = count($igst); $i < $n; $i++) {
        //             $igst_tax = $igst[$i];
        //             $igst_tax_id = $igst_id[$i];
        //             $product_id = $p_id[$i];
        //             $variant_id = $variants[$i];
        //             $igst_summary = array(
        //                 'order_tax_col_de_id' => generator(15),
        //                 'order_id' => $invoice_id,
        //                 'amount' => $igst_tax,
        //                 'product_id' => $product_id,
        //                 'tax_id' => $igst_tax_id,
        //                 'variant_id' => $variant_id,
        //                 'date' => $this->input->post('invoice_date', TRUE),
        //             );
        //             if (!empty($igst[$i])) {
        //                 $result = $this->db->select('*')
        //                     ->from('order_tax_col_details')
        //                     ->where('order_id', $invoice_id)
        //                     ->where('tax_id', $igst_tax_id)
        //                     ->where('product_id', $product_id)
        //                     ->where('variant_id', $variant_id)
        //                     ->get()
        //                     ->num_rows();
        //                 if ($result > 0) {
        //                     $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
        //                     $this->db->where('order_id', $invoice_id);
        //                     $this->db->where('tax_id', $igst_tax_id);
        //                     $this->db->where('variant_id', $variant_id);
        //                     $this->db->update('order_tax_col_details');
        //                 } else {
        //                     $this->db->insert('order_tax_col_details', $igst_summary);
        //                 }
        //             }
        //         }
        //     }
        //     //Tax collection details for three end

        //     return $invoice_id;
        // }
    }

    //update_order
    public function update_order_old()
    {
        //Order information
        $order_id      = $this->input->post('order_id', TRUE);
        $customer_id = $this->input->post('customer_id', TRUE);

        if ($order_id != '') {
            //Data update into order table
            $data = array(
                'order_id'        => $order_id,
                'customer_id'    => $customer_id,
                'date'            => $this->input->post('invoice_date', TRUE),
                'total_amount'    => $this->input->post('grand_total_price', TRUE),
                'order'            => $this->input->post('order', TRUE),
                'total_discount' => $this->input->post('total_discount', TRUE),
                'order_discount' => (int)$this->input->post('invoice_discount', TRUE) + (int)$this->input->post('total_discount', TRUE),
                'service_charge' => $this->input->post('service_charge', TRUE),
                'user_id'        => $this->session->userdata('user_id'),
                'store_id'        => $this->input->post('store_id', TRUE),
                'paid_amount'    => $this->input->post('paid_amount', TRUE),
                'due_amount'    => $this->input->post('due_amount', TRUE),
                'status'        => $this->input->post('status', TRUE),
            );

            $this->db->where('order_id', $order_id);
            $result = $this->db->delete('order');

            if ($result) {
                $this->db->insert('order', $data);
            }
        }

        //Order details info
        $rate            = $this->input->post('product_rate', TRUE);
        $p_id            = $this->input->post('product_id', TRUE);
        $total_amount  = $this->input->post('total_price', TRUE);
        $discount        = $this->input->post('discount', TRUE);
        $variants        = $this->input->post('variant_id', TRUE);
        $color_variants = $this->input->post('color_variant', TRUE);
        $order_d_id    = $this->input->post('order_details_id', TRUE);
        $quantity        = $this->input->post('product_quantity', TRUE);
        //Delete old invoice info
        if (!empty($order_id)) {
            $this->db->where('order_id', $order_id);
            $this->db->delete('order_details');
        }

        //Order details for entry
        if (!empty($p_id)) {
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_quantity = $quantity[$i];
                $product_rate       = $rate[$i];
                $product_id       = $p_id[$i];
                $discount_rate       = $discount[$i];
                $total_price       = $total_amount[$i];
                $variant_id       = $variants[$i];
                $variant_color    = (!empty($color_variants[$i]) ? $color_variants[$i] : NULL);
                $supplier_rate    = $this->supplier_rate($product_id);

                $order_details = array(
                    'order_details_id' => $this->auth->generator(15),
                    'order_id'          => $order_id,
                    'product_id'      => $product_id,
                    'variant_id'      => $variant_id,
                    'variant_color'   => $variant_color,
                    'quantity'          => $product_quantity,
                    'rate'              => $product_rate,
                    'store_id'          => $this->input->post('store_id', TRUE),
                    'supplier_rate'   => $supplier_rate[0]['supplier_price'],
                    'total_price'     => $total_price,
                    'discount'        => $discount_rate,
                    'status'          => 1
                );

                if (!empty($p_id)) {
                    $this->db->select('order_details_id');
                    $this->db->from('order_details');
                    $this->db->where('order_id', $order_id);
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
                        $this->db->where('order_id', $order_id);
                        $this->db->where('product_id', $product_id);
                        $this->db->where('variant_id', $variant_id);
                        if (!empty($variant_color)) {
                            $this->db->where('variant_color', $variant_color);
                        }
                        $this->db->update('order_details');
                    } else {
                        $this->db->insert('order_details', $order_details);
                    }
                }
            }
        }
        //Tax info
        $cgst = $this->input->post('cgst', TRUE);
        $sgst = $this->input->post('sgst', TRUE);
        $igst = $this->input->post('igst', TRUE);
        $cgst_id = $this->input->post('cgst_id', TRUE);
        $sgst_id = $this->input->post('sgst_id', TRUE);
        $igst_id = $this->input->post('igst_id', TRUE);

        //Tax collection summary for three

        //Delete all tax  from summary
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_tax_col_summary');

        //CGST Tax Summary
        if (!empty($cgst)) {
            for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                $cgst_tax = $cgst[$i];
                $cgst_tax_id = $cgst_id[$i];
                $cgst_summary = array(
                    'order_tax_col_id'    =>    $this->auth->generator(15),
                    'order_id'            =>    $order_id,
                    'tax_amount'         =>     $cgst_tax,
                    'tax_id'             =>     $cgst_tax_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($cgst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_summary')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $cgst_tax_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('tax_amount', 'tax_amount+' . $cgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $cgst_tax_id);
                        $this->db->update('order_tax_col_summary');
                    } else {
                        $this->db->insert('order_tax_col_summary', $cgst_summary);
                    }
                }
            }
        }
        //SGST Tax Summary
        if (!empty($sgst)) {
            for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                $sgst_tax = $sgst[$i];
                $sgst_tax_id = $sgst_id[$i];

                $sgst_summary = array(
                    'order_tax_col_id'    =>    $this->auth->generator(15),
                    'order_id'            =>    $order_id,
                    'tax_amount'         =>     $sgst_tax,
                    'tax_id'             =>     $sgst_tax_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($sgst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_summary')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $sgst_tax_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('tax_amount', 'tax_amount+' . $sgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $sgst_tax_id);
                        $this->db->update('order_tax_col_summary');
                    } else {
                        $this->db->insert('order_tax_col_summary', $sgst_summary);
                    }
                }
            }
        }
        //IGST Tax Summary
        if (!empty($igst)) {
            for ($i = 0, $n = count($igst); $i < $n; $i++) {
                $igst_tax = $igst[$i];
                $igst_tax_id = $igst_id[$i];

                $igst_summary = array(
                    'order_tax_col_id'    =>    $this->auth->generator(15),
                    'order_id'        =>    $order_id,
                    'tax_amount'         =>     $igst_tax,
                    'tax_id'             =>     $igst_tax_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($igst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_summary')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $igst_tax_id)
                        ->get()
                        ->num_rows();

                    if ($result > 0) {
                        $this->db->set('tax_amount', 'tax_amount+' . $igst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $igst_tax_id);
                        $this->db->update('order_tax_col_summary');
                    } else {
                        $this->db->insert('order_tax_col_summary', $igst_summary);
                    }
                }
            }
        }
        //Tax collection summary for three


        //Tax collection details for three

        //Delete all tax  from summary
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_tax_col_details');

        //CGST Tax Details
        if (!empty($cgst)) {
            for ($i = 0, $n = count($cgst); $i < $n; $i++) {
                $cgst_tax      = $cgst[$i];
                $cgst_tax_id = $cgst_id[$i];
                $product_id  = $p_id[$i];
                $variant_id  = $variants[$i];
                $cgst_details = array(
                    'order_tax_col_de_id' =>    $this->auth->generator(15),
                    'order_id'            =>    $order_id,
                    'amount'             =>     $cgst_tax,
                    'product_id'         =>     $product_id,
                    'tax_id'             =>     $cgst_tax_id,
                    'variant_id'         =>     $variant_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($cgst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_details')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $cgst_tax_id)
                        ->where('product_id', $product_id)
                        ->where('variant_id', $variant_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('amount', 'amount+' . $cgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $cgst_tax_id);
                        $this->db->where('variant_id', $variant_id);
                        $this->db->update('order_tax_col_details');
                    } else {
                        $this->db->insert('order_tax_col_details', $cgst_details);
                    }
                }
            }
        }
        //SGST Tax Details
        if (!empty($sgst)) {
            for ($i = 0, $n = count($sgst); $i < $n; $i++) {
                $sgst_tax      = $sgst[$i];
                $sgst_tax_id = $sgst_id[$i];
                $product_id  = $p_id[$i];
                $variant_id  = $variants[$i];
                $sgst_summary = array(
                    'order_tax_col_de_id'    =>    $this->auth->generator(15),
                    'order_id'        =>    $order_id,
                    'amount'             =>     $sgst_tax,
                    'product_id'         =>     $product_id,
                    'tax_id'             =>     $sgst_tax_id,
                    'variant_id'         =>     $variant_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($sgst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_details')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $sgst_tax_id)
                        ->where('product_id', $product_id)
                        ->where('variant_id', $variant_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('amount', 'amount+' . $sgst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $sgst_tax_id);
                        $this->db->where('variant_id', $variant_id);
                        $this->db->update('order_tax_col_details');
                    } else {
                        $this->db->insert('order_tax_col_details', $sgst_summary);
                    }
                }
            }
        }
        //IGST Tax Details
        if (!empty($igst)) {
            for ($i = 0, $n = count($igst); $i < $n; $i++) {
                $igst_tax      = $igst[$i];
                $igst_tax_id = $igst_id[$i];
                $product_id  = $p_id[$i];
                $variant_id  = $variants[$i];
                $igst_summary = array(
                    'order_tax_col_de_id' =>    $this->auth->generator(15),
                    'order_id'        =>    $order_id,
                    'amount'             =>     $igst_tax,
                    'product_id'         =>     $product_id,
                    'tax_id'             =>     $igst_tax_id,
                    'variant_id'         =>     $variant_id,
                    'date'                =>    $this->input->post('invoice_date', TRUE),
                );
                if (!empty($igst[$i])) {
                    $result = $this->db->select('*')
                        ->from('order_tax_col_details')
                        ->where('order_id', $order_id)
                        ->where('tax_id', $igst_tax_id)
                        ->where('product_id', $product_id)
                        ->where('variant_id', $variant_id)
                        ->get()
                        ->num_rows();
                    if ($result > 0) {
                        $this->db->set('amount', 'amount+' . $igst_tax, FALSE);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('tax_id', $igst_tax_id);
                        $this->db->where('variant_id', $variant_id);
                        $this->db->update('order_tax_col_details');
                    } else {
                        $this->db->insert('order_tax_col_details', $igst_summary);
                    }
                }
            }
        }
        //End tax details
        return $order_id;
    }

    //Update Invoice

    public function update_order($order_id)
    {
        //Invoice entry info
        $quantity = $this->input->post('product_quantity', TRUE);
        $available_quantity = $this->input->post('available_quantity', TRUE);
        $product_id = $this->input->post('product_id', TRUE);
        $payment_id = $this->input->post('payment_id', TRUE);

        //Stock availability check
        foreach ($available_quantity as $k => $v) {
            if ($v < $quantity[$k]) {
                $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                redirect('dashboard/Corder/create_invoice_form/' . $order_id);
            }
        }

        //Product existing check
        if ($product_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_product')));
            redirect('dashboard/Corder/create_invoice_form/' . $order_id);
        }

        //payment account existing check
        if ((float)$this->input->post('paid_amount', TRUE) > 0 && $payment_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_payment')));
            redirect('dashboard/Corder/create_invoice_form/' . $order_id);
        }

        //Customer existing check
        if (($this->input->post('customer_name_others', TRUE) == null) && ($this->input->post('customer_id', TRUE) == null)) {
            $this->session->set_userdata(array('error_message' => display('please_select_customer')));
            redirect('dashboard/Corder/create_invoice_form/' . $order_id);
        }

        // delete then insert new ==> update
        $this->delete_order($order_id);
        // insert as new
        $order_id = $this->order_entry($order_id);

        // turn to paid

        // turn into invoice
        // insert invoice from this input data
        $this->load->model('dashboard/Invoices');
        $invoice_id = $this->Invoices->invoice_entry($order_id);

        // get invoice no
        $invoiceNo = $this->db->select('invoice')->from('invoice')->where('invoice_id', $invoice_id)->where('order_id', $order_id)->get()->row();
        // update order status
        $this->db->set('invoice_no', $invoiceNo->invoice)->set('status', 2)->where('order_id', $order_id)->update('order');

        return $order_id;
    }

    public function check_stock($store_id = null, $product_id = null, $variant = null, $variant_color = null)
    {
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

    public function order_to_invoice_data($order_id)
    {
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();

            if (!empty($find_active_fiscal_year)) {
                $invoice_id = $this->auth->generator(15);
                $invoiceNo = 'Inv-' . $this->number_generator();
                $result = $this->db->select('*')
                    // ->from('order')
                    ->from('order_invoice')
                    ->where('invoice_id', $order_id)
                    ->get()
                    ->row();
                if ($result) {
                    // create customer head start
                    if (check_module_status('accounting') == 1) {
                        $this->load->model('accounting/account_model');
                        $customer_name = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $result->customer_id)->get()->row();
                        if ($customer_name) {
                            $customer_data = $data = array(
                                'customer_id'  => $result->customer_id,
                                'customer_name' => $customer_name->customer_name,
                            );
                            $this->account_model->insert_customer_head($customer_data);
                        }
                    }
                    // create customer head END
                    $data = array(
                        'invoice_id'    => $invoice_id,
                        // 'order_id'      => $result->order_id,
                        'order_id'      => $result->invoice_id,
                        'quotation_id' => $result->quotation_id,
                        'customer_id'   => $result->customer_id,
                        'store_id'      => $result->store_id,
                        'user_id'       => $result->user_id,
                        'date'          => $result->date,
                        'total_amount'  => $result->total_amount,
                        'invoice'       => $invoiceNo,
                        'total_discount' => $result->total_discount,
                        'invoice_discount' => $result->invoice_discount,
                        'total_vat' => $result->total_vat,
                        // 'invoice_discount' => $result->order_discount,
                        'service_charge' => $result->service_charge,
                        'shipping_charge' => $result->shipping_charge,
                        'shipping_method' => $result->shipping_method,
                        'paid_amount'   => $result->paid_amount,
                        'due_amount'    => $result->due_amount,
                        'invoice_details' => $result->invoice_details,
                        'is_quotation' => $result->is_quotation,
                        'is_installment' => $result->is_installment,
                        'month_no' => $result->month_no,
                        'due_day' => $result->due_day,
                        'employee_id' => $result->employee_id,
                        'status'        => $result->status,
                    );
                    $this->db->insert('invoice', $data);
                    //Update to customer ledger Table
                    $data2 = array(
                        'transaction_id' => $this->auth->generator(15),
                        'customer_id'   => $result->customer_id,
                        'invoice_no'    => $invoice_id,
                        // 'order_no'      => $result->order_id,
                        'order_no'      => $result->invoice_id,
                        'date'          => date('Y-m-d', strtotime($result->date)),
                        'amount'        => $result->total_amount,
                        'status'        => 1
                    );
                    $ledger = $this->db->insert('customer_ledger', $data2);
                }
                //order update
                $this->db->set('status', '2');
                $this->db->set('invoice_no', $invoiceNo);
                $this->db->where('invoice_id', $order_id);
                $order = $this->db->update('order_invoice');
                if ($ledger) {
                    $store_id      = $this->input->post('store_id', TRUE);
                    $products      = $this->input->post('product_id', TRUE);
                    $variant_ids   = $this->input->post('variant_id', TRUE);
                    $variant_colors = $this->input->post('color_variant', TRUE);
                    $batch_nos     = $this->input->post('batch_no', TRUE);
                    $quantities    = $this->input->post('product_quantity', TRUE);
                    $rates         = $this->input->post('product_rate', TRUE);
                    $supplier_rates = $this->input->post('supplier_rate', TRUE);
                    $total_prices  = $this->input->post('total_price', TRUE);
                    $discounts     = $this->input->post('discount', TRUE);
                    $statuses      = $this->input->post('status', TRUE);

                    $sub_total_price = 0;
                    $cogs_price = 0;
                    $total_rate = 0;
                    $total_inv_discount = 0;
                    foreach ($products as $key => $product_id) {
                        $sub_total_price += $total_prices[$key];
                        $total_rate += $rates[$key] * $quantities[$key];
                        $cogs_price      += $supplier_rates[$key] * $quantities[$key];
                        $total_inv_discount += $discounts[$key] * $quantities[$key];
                        $invoice_details = array(
                            'invoice_details_id' => $this->auth->generator(15),
                            'invoice_id'         => $invoice_id,
                            'product_id'         => $product_id,
                            'variant_id'         => $variant_ids[$key],
                            'batch_no'           => $batch_nos[$key],
                            'variant_color'      => $variant_colors[$key],
                            'store_id'           => $store_id,
                            'quantity'           => $quantities[$key],
                            'rate'               => $rates[$key],
                            'supplier_rate'      => $supplier_rates[$key],
                            'total_price'        => $total_prices[$key],
                            'discount'           => $discounts[$key],
                            'status'             => $statuses[$key],
                        );
                        $order_details = $this->db->insert('invoice_details', $invoice_details);
                        // stock 
                        $check_stock = $this->check_stock($store_id, $product_id, $variant_ids[$key], $variant_colors[$key]);
                        if (empty($check_stock)) {
                            // insert
                            $stock = array(
                                'store_id'     => $store_id,
                                'product_id'   => $product_id,
                                'variant_id'   => $variant_ids[$key],
                                'variant_color' => (!empty($variant_colors[$key]) ? $variant_colors[$key] : NULL),
                                'quantity'     => $quantities[$key],
                                'warehouse_id' => '',
                            );
                            $this->db->insert('invoice_stock_tbl', $stock);
                            // insert
                        } else {
                            //update
                            $stock = array(
                                'quantity' => $check_stock->quantity + $quantities[$key]
                            );
                            if (!empty($store_id)) {
                                $this->db->where('store_id', $store_id);
                            }
                            if (!empty($product_id)) {
                                $this->db->where('product_id', $product_id);
                            }
                            if (!empty($variant_ids[$key])) {
                                $this->db->where('variant_id', $variant_ids[$key]);
                            }
                            if (!empty($variant_colors[$key])) {
                                $this->db->where('variant_color', $variant_colors[$key]);
                            }
                            $this->db->update('invoice_stock_tbl', $stock);
                            //update
                        }
                        // stock
                    }
                }
                //Tax summary entry start
                $this->db->select('*');
                $this->db->from('order_tax_collection_summary');
                $this->db->where('invoice_id', $order_id);
                $query = $this->db->get();
                $tax_summary = $query->result();
                if ($tax_summary) {
                    foreach ($tax_summary as $summary) {
                        $tax_col_summary = array(
                            'tax_collection_id' => $summary->tax_collection_id,
                            'invoice_id'        => $invoice_id,
                            'tax_id'            => $summary->tax_id,
                            'tax_amount'        => $summary->tax_amount,
                            'date'              => $summary->date,
                        );
                        $this->db->insert('tax_collection_summary', $tax_col_summary);
                    }
                }
                //Tax summary entry end

                // start customer order to invoice sales transection
                $store_id = $this->input->post('store_id', TRUE);
                $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
                $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $result->customer_id)->get()->row();
                $createdate   = date('Y-m-d H:i:s');
                $receive_by   = $this->session->userdata('user_id');
                $date         = date('Y-m-d');
                $get_tota_vat = $this->db->query("SELECT SUM(tax_amount) as total_vat FROM `tax_collection_summary` WHERE `invoice_id` = '" . $invoice_id . "'")->row();
                if (!empty($get_tota_vat->total_vat)) {
                    $total_vat = $get_tota_vat->total_vat;
                } else {
                    $total_vat = 0;
                }

                $total_with_vat = $sub_total_price + $total_vat;
                $cogs_price    = $cogs_price;
                $total_discount = $total_inv_discount;
                $total_price_before_discount = $total_rate;

                //1st customer debit
                // $customer_debit = array(
                //     'fy_id'     => $find_active_fiscal_year->id,
                //     'VNo'       => $invoice_id,
                //     'Vtype'     => 'Sales',
                //     'VDate'     => $date,
                //     'COAID'     => $customer_head->HeadCode,
                //     'Narration' => 'Sales "total with vat" debited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
                //     'Debit'     => $total_with_vat,
                //     'Credit'    => 0,
                //     'IsPosted'  => 1,
                //     'CreateBy'  => $receive_by,
                //     'CreateDate' => $createdate,
                //     'store_id'  => $result->store_id,
                //     'IsAppove'  => 0
                // );
                // //2nd Allowed Discount Debit
                // $allowed_discount_debit = array(
                //     'fy_id'     => $find_active_fiscal_year->id,
                //     'VNo'       => 'Inv-' . $invoice_id,
                //     'Vtype'     => 'Sales',
                //     'VDate'     => $date,
                //     'COAID'     => 4114,
                //     'Narration' => 'Sales "total discount" debited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
                //     'Debit'     => $total_discount,
                //     'Credit'    => 0,
                //     'IsPosted'  => 1,
                //     'CreateBy'  => $receive_by,
                //     'CreateDate' => $createdate,
                //     'store_id'  => $result->store_id,
                //     'IsAppove'  => 0
                // );
                // //3rd Showroom Sales credit
                // $showroom_sales_credit = array(
                //     'fy_id'     => $find_active_fiscal_year->id,
                //     'VNo'       => 'Inv-' . $invoice_id,
                //     'Vtype'     => 'Sales',
                //     'VDate'     => $date,
                //     'COAID'     => 5111, // account payable game 11
                //     'Narration' => 'Sales "total price before discount" credited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
                //     'Debit'     => 0,
                //     'Credit'    => $total_price_before_discount,
                //     'IsPosted'  => 1,
                //     'CreateBy'  => $receive_by,
                //     'CreateDate' => $createdate,
                //     'store_id'  => $result->store_id,
                //     'IsAppove'  => 0
                // );
                // //4th VAT on Sales
                // $vat_credit = array(
                //     'fy_id'     => $find_active_fiscal_year->id,
                //     'VNo'       => 'Inv-' . $invoice_id,
                //     'Vtype'     => 'Sales',
                //     'VDate'     => $date,
                //     'COAID'     => 2114, // account payable game 11
                //     'Narration' => 'Sales "total_vat" credited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
                //     'Debit'     => 0,
                //     'Credit'    => $total_vat,
                //     'IsPosted'  => 1,
                //     'CreateBy'  => $receive_by,
                //     'CreateDate' => $createdate,
                //     'store_id'  => $result->store_id,
                //     'IsAppove'  => 0
                // );
                // //5th cost of goods sold debit
                // $cogs_debit = array(
                //     'fy_id'     => $find_active_fiscal_year->id,
                //     'VNo'       => 'Inv-' . $invoice_id,
                //     'Vtype'     => 'Sales',
                //     'VDate'     => $date,
                //     'COAID'     => 4111,
                //     'Narration' => 'Sales "COGS" debited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
                //     'Debit'     => $cogs_price,
                //     'Credit'    => 0, //sales price asbe
                //     'IsPosted'  => 1,
                //     'CreateBy'  => $receive_by,
                //     'CreateDate' => $createdate,
                //     'store_id'  => $result->store_id,
                //     'IsAppove'  => 0
                // );
                // //6th cost of goods sold inventory Credit
                // $inventory_credit = array(
                //     'fy_id'     => $find_active_fiscal_year->id,
                //     'VNo'       => 'Inv-' . $invoice_id,
                //     'Vtype'     => 'Sales',
                //     'VDate'     => $date,
                //     'COAID'     => 1141,
                //     'Narration' => 'Sales inventory "cogs_price" credited by customer id: ' . $customer_head->HeadName . '(' . $result->customer_id . ')',
                //     'Debit'     => 0,
                //     'Credit'    => $cogs_price, //supplier price asbe
                //     'IsPosted'  => 1,
                //     'CreateBy'  => $receive_by,
                //     'CreateDate' => $createdate,
                //     'store_id'  => $result->store_id,
                //     'IsAppove'  => 0
                // );
                // $this->db->insert('acc_transaction', $customer_debit);
                // $this->db->insert('acc_transaction', $allowed_discount_debit);
                // $this->db->insert('acc_transaction', $showroom_sales_credit);
                // $this->db->insert('acc_transaction', $vat_credit);
                // $this->db->insert('acc_transaction', $cogs_debit);
                // $this->db->insert('acc_transaction', $inventory_credit);

                $order_acc_trans = $this->db->select('*')
                    ->from('order_acc_transaction')
                    ->where('VNo', $order_id)
                    ->get();
                $order_acc_trans_result = $order_acc_trans ? $order_acc_trans->result_array() : [];
                foreach ($order_acc_trans_result as $acc_trans) {
                    $acc_trans['VNo'] = 'Inv-' . $invoice_id;
                    $this->db->insert('acc_transaction', $acc_trans);
                }
                // end customer order to invoice sales transection

                //Tax details entry start
                $this->db->select('*');
                $this->db->from('order_tax_collection_details');
                $this->db->where('invoice_id', $order_id);
                $query = $this->db->get();
                $tax_details = $query->result();
                if ($tax_details) {
                    foreach ($tax_details as $details) {
                        $tax_col_details = array(
                            'tax_col_de_id'     => $details->tax_col_de_id,
                            'invoice_id'        => $invoice_id,
                            'product_id'        => $details->product_id,
                            'variant_id'        => $details->variant_id,
                            'tax_id'            => $details->tax_id,
                            'amount'            => $details->amount,
                            'date'              => $details->date,
                        );
                        $this->db->insert('tax_collection_details', $tax_col_details);
                    }
                }
                //Tax details entry end

                // installment entry start
                $this->db->select('*');
                $this->db->from('order_invoice_installment');
                $this->db->where('invoice_id', $order_id);
                $query = $this->db->get();
                $order_installment = $query->result();
                if ($order_installment) {
                    foreach ($order_installment as $details) {
                        $invoice_installment_details = array(
                            'invoice_id'        => $invoice_id,
                            'amount'        => $details->amount,
                            'due_date'        => $details->due_date,
                            'payment_date'            => $details->payment_date,
                            'payment_amount'            => $details->payment_amount,
                            'status'              => $details->status,
                            'payment_type'              => $details->payment_type,
                            'account'              => $details->account,
                            'check_no'              => $details->check_no,
                            'employee_id'              => $details->employee_id,
                            'expiry_date'              => $details->expiry_date,
                        );
                        $this->db->insert('invoice_installment', $invoice_installment_details);
                    }
                }
                // installment entry end

                return true;
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            $invoice_id = $this->auth->generator(15);
            $invoiceNo = 'Inv-' . $this->number_generator();
            $result = $this->db->select('*')
                ->from('order_invoice')
                ->where('invoice_id', $order_id)
                ->get()
                ->row();
            if ($result) {
                // create customer head start
                if (check_module_status('accounting') == 1) {
                    $this->load->model('accounting/account_model');
                    $customer_name = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $result->customer_id)->get()->row();
                    if ($customer_name) {
                        $customer_data = $data = array(
                            'customer_id'  => $result->customer_id,
                            'customer_name' => $customer_name->customer_name,
                        );
                        $this->account_model->insert_customer_head($customer_data);
                    }
                }
                // create customer head END
                $data = array(
                    'invoice_id'    => $invoice_id,
                    // 'order_id'      => $result->order_id,
                    'order_id'      => $result->invoice_id,
                    'quotation_id' => $result->quotation_id,
                    'customer_id'   => $result->customer_id,
                    'store_id'      => $result->store_id,
                    'user_id'       => $result->user_id,
                    'date'          => $result->date,
                    'total_amount'  => $result->total_amount,
                    'invoice'       => $invoiceNo,
                    'total_discount' => $result->total_discount,
                    'invoice_discount' => $result->invoice_discount,
                    'total_vat' => $result->total_vat,
                    // 'invoice_discount' => $result->order_discount,
                    'service_charge' => $result->service_charge,
                    'shipping_charge' => $result->shipping_charge,
                    'shipping_method' => $result->shipping_method,
                    'paid_amount'   => $result->paid_amount,
                    'due_amount'    => $result->due_amount,
                    'invoice_details' => $result->invoice_details,
                    'is_quotation' => $result->is_quotation,
                    'is_installment' => $result->is_installment,
                    'month_no' => $result->month_no,
                    'due_day' => $result->due_day,
                    'employee_id' => $result->employee_id,
                    'status'        => $result->status,
                );
                $this->db->insert('invoice', $data);
                //Update to customer ledger Table
                $data2 = array(
                    'transaction_id' => $this->auth->generator(15),
                    'customer_id'   => $result->customer_id,
                    'invoice_no'    => $invoice_id,
                    'order_no'      => $result->invoice_id,
                    'date'          => date('Y-m-d', strtotime($result->date)),
                    'amount'        => $result->total_amount,
                    'status'        => 1
                );
                $ledger = $this->db->insert('customer_ledger', $data2);
            }
            //order update
            $this->db->set('status', '2');
            $this->db->set('invoice_no', $invoiceNo);
            $this->db->where('invoice_id', $order_id);
            $order = $this->db->update('order_invoice');
            if ($ledger) {

                $store_id      = $this->input->post('store_id', TRUE);
                $products      = $this->input->post('product_id', TRUE);
                $variant_ids   = $this->input->post('variant_id', TRUE);
                $variant_colors = $this->input->post('color_variant', TRUE);
                $batch_nos     = $this->input->post('batch_no', TRUE);
                $quantities    = $this->input->post('product_quantity', TRUE);
                $rates         = $this->input->post('product_rate', TRUE);
                $supplier_rates = $this->input->post('supplier_rate', TRUE);
                $total_prices  = $this->input->post('total_price', TRUE);
                $discounts     = $this->input->post('discount', TRUE);
                $statuses      = $this->input->post('status', TRUE);

                $sub_total_price = 0;
                $cogs_price = 0;
                $total_rate = 0;
                $total_inv_discount = 0;
                foreach ($products as $key => $product_id) {
                    $sub_total_price += $total_prices[$key];
                    $total_rate += $rates[$key] * $quantities[$key];
                    $cogs_price      += $supplier_rates[$key] * $quantities[$key];
                    $total_inv_discount += $discounts[$key] * $quantities[$key];
                    $invoice_details = array(
                        'invoice_details_id' => $this->auth->generator(15),
                        'invoice_id'         => $invoice_id,
                        'product_id'         => $product_id,
                        'variant_id'         => $variant_ids[$key],
                        'batch_no'           => $batch_nos[$key],
                        'variant_color'      => $variant_colors[$key],
                        'store_id'           => $store_id,
                        'quantity'           => $quantities[$key],
                        'rate'               => $rates[$key],
                        'supplier_rate'      => $supplier_rates[$key],
                        'total_price'        => $total_prices[$key],
                        'discount'           => $discounts[$key],
                        'status'             => $statuses[$key],
                    );
                    $order_details = $this->db->insert('invoice_details', $invoice_details);
                    // stock 
                    $check_stock = $this->check_stock($store_id, $product_id, $variant_ids[$key], $variant_colors[$key]);
                    if (empty($check_stock)) {
                        // insert
                        $stock = array(
                            'store_id'     => $store_id,
                            'product_id'   => $product_id,
                            'variant_id'   => $variant_ids[$key],
                            'variant_color' => (!empty($variant_colors[$key]) ? $variant_colors[$key] : NULL),
                            'quantity'     => $quantities[$key],
                            'warehouse_id' => '',
                        );
                        $this->db->insert('invoice_stock_tbl', $stock);
                        // insert
                    } else {
                        //update
                        $stock = array(
                            'quantity' => $check_stock->quantity + $quantities[$key]
                        );
                        if (!empty($product_id)) {
                            $this->db->where('store_id', $store_id);
                        }
                        if (!empty($details->product_id)) {
                            $this->db->where('product_id', $product_id);
                        }
                        if (!empty($variant_ids[$key])) {
                            $this->db->where('variant_id', $variant_ids[$key]);
                        }
                        if (!empty($variant_colors[$key])) {
                            $this->db->where('variant_color', $variant_colors[$key]);
                        }
                        $this->db->update('invoice_stock_tbl', $stock);
                        //update
                    }
                    // stock
                }
            }
            //Tax summary entry start
            $this->db->select('*');
            $this->db->from('order_tax_collection_summary');
            $this->db->where('invoice_id', $order_id);
            $query = $this->db->get();
            $tax_summary = $query->result();
            if ($tax_summary) {
                foreach ($tax_summary as $summary) {
                    $tax_col_summary = array(
                        'tax_collection_id' => $summary->tax_collection_id,
                        'invoice_id'        => $invoice_id,
                        'tax_id'            => $summary->tax_id,
                        'tax_amount'        => $summary->tax_amount,
                        'date'              => $summary->date,
                    );
                    $this->db->insert('tax_collection_summary', $tax_col_summary);
                }
            }
            //Tax summary entry end

            //Tax details entry start
            $this->db->select('*');
            $this->db->from('order_tax_collection_details');
            $this->db->where('invoice_id', $order_id);
            $query = $this->db->get();
            $tax_details = $query->result();
            if ($tax_details) {
                foreach ($tax_details as $details) {
                    $tax_col_details = array(
                        'tax_col_de_id'     => $details->tax_col_de_id,
                        'invoice_id'        => $invoice_id,
                        'product_id'        => $details->product_id,
                        'variant_id'        => $details->variant_id,
                        'tax_id'            => $details->tax_id,
                        'amount'            => $details->amount,
                        'date'              => $details->date,
                    );
                    $this->db->insert('tax_collection_details', $tax_col_details);
                }
            }
            //Tax details entry end

            // installment entry start
            $this->db->select('*');
            $this->db->from('order_invoice_installment');
            $this->db->where('invoice_id', $order_id);
            $query = $this->db->get();
            $order_installment = $query->result();
            if ($order_installment) {
                foreach ($order_installment as $details) {
                    $invoice_installment_details = array(
                        'invoice_id'        => $invoice_id,
                        'amount'        => $details->amount,
                        'due_date'        => $details->due_date,
                        'payment_date'            => $details->payment_date,
                        'payment_amount'            => $details->payment_amount,
                        'status'              => $details->status,
                        'payment_type'              => $details->payment_type,
                        'account'              => $details->account,
                        'check_no'              => $details->check_no,
                        'employee_id'              => $details->employee_id,
                        'expiry_date'              => $details->expiry_date,
                    );
                    $this->db->insert('invoice_installment', $invoice_installment_details);
                }
            }
            // installment entry end

            return true;
        }
    }

    //Store List
    public function store_list()
    {
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
    public function terminal_list()
    {
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
    public function supplier_rate($product_id)
    {
        $this->db->select('supplier_price');
        $this->db->from('product_information');
        $this->db->where(array('product_id' => $product_id));
        $query = $this->db->get();
        return $query->result_array();
    }
    //Retrieve order Edit Data
    public function retrieve_order_editdata($order_id)
    {
        $acc_category = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->get()->row();

        $this->db->select('
			a.*,
			b.customer_name,
			c.*,
			c.product_id,
			d.product_name,
			d.product_model,
            d.category_id,
			a.status
			');
        // $this->db->from('order a');
        $this->db->from('order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        // $this->db->join('order_details c', 'c.order_id = a.order_id');
        $this->db->join('order_details c', 'c.order_id = a.order_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        // $this->db->where('a.order_id', $order_id);
        $this->db->where('a.order_id', $order_id);
        // $this->db->order_by('d.product_name');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            uksort($result, fn ($a) => $result[$a]['category_id'] == $acc_category->category_id ? 1 : -1);
            return $result;
        }
        return false;
    }

    //Retrieve order_html_data
    public function retrieve_order_html_data($order_id)
    {
        $details_page =  $this->uri->segment(2);
        $shipping_addon = '';

        $this->db->select('
			a.*,
            a.created_at as date_time,
			a.order_discount as total_order_discount,
			b.*,
			c.*,
			d.product_id,
			d.product_name,
            d.category_id,
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
        // $this->db->from('order a');
        $this->db->from('order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('shipping_info g', 'g.customer_id = a.customer_id', 'left');
        $this->db->join('order_details c', 'c.order_id = a.order_id');
        // var_dump($this->db->get()->result());
        // exit;
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('unit e', 'e.unit_id = d.unit', 'left');
        $this->db->join('variant f', 'f.variant_id = c.variant_id', 'left');
        // $this->db->where('a.order_id', $order_id);
        $this->db->where('a.order_id', $order_id);
        if ($details_page == 'order_details_data') {
            // $this->db->where('g.order_id', $order_id);
            $this->db->where('g.order_id', $order_id);
        }
        $this->db->group_by('c.product_id, c.order_details_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    // Delete order Item
    public function retrieve_product_data($product_id)
    {
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
    // Delete order Item
    public function delete_order_old($order_id)
    {

        $invoice = $this->db->select('invoice_id')->where('order_id', $order_id)->from('invoice')->get()->row();
        $invoice_id = 'Inv-' . @$invoice->invoice_id;

        //Delete order table
        $this->db->where('order_id', $order_id);
        $this->db->delete('order');
        //Delete order_details table
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_details');
        //Order tax summary delete
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_tax_col_summary');
        //Order tax details delete
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_tax_col_details');

        if ($invoice_id) {
            //invoice details delete
            $this->db->where('invoice_id', $invoice_id);
            $this->db->delete('invoice_details');

            //invoice  delete
            $this->db->where('invoice_id', $invoice_id);
            $this->db->delete('invoice');
            //customer ledger
            $this->db->where('invoice_no', $invoice_id);
            $this->db->delete('customer_ledger');

            //tax_collection_summary
            $this->db->where('invoice_id', $invoice_id);
            $this->db->delete('tax_collection_summary');

            //tax_collection_details
            $this->db->where('invoice_id', $invoice_id);
            $this->db->delete('tax_collection_details');
        }
        return true;
    }

    // Delete invoice Item
    public function delete_order($order_id)
    {
        //find previous order history and REDUCE the stock
        $order_history = $this->db->select('*')->from('order_details')->where('order_id', $order_id)->get()->result_array();
        if (count($order_history) > 0) {
            foreach ($order_history as $order_item) {
                //update
                $check_stock = $this->check_stock($order_item['store_id'], $order_item['product_id'], $order_item['variant_id'], $order_item['variant_color']);
                $stock = array(
                    'quantity' => $check_stock->quantity - $order_item['quantity']
                );
                if (!empty($order_item['store_id'])) {
                    $this->db->where('store_id', $order_item['store_id']);
                }
                if (!empty($order_item['product_id'])) {
                    $this->db->where('product_id', $order_item['product_id']);
                }
                if (!empty($order_item['variant_id'])) {
                    $this->db->where('variant_id', $order_item['variant_id']);
                }
                if (!empty($order_item['variant_color'])) {
                    $this->db->where('variant_color', $order_item['variant_color']);
                }
                $this->db->update('order_invoice_stock_tbl', $stock);
                //update
            }
        }
        //find previous invoice history and REDUCE the stock
        //Delete Invoice table
        $this->db->where('order_id', $order_id);
        $this->db->delete('order');

        //Delete invoice_details table
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_details');

        //Delete invoice_tax smmary table
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_tax_col_summary');

        //Delete invoice_tax details table
        $this->db->where('order_id', $order_id);
        $this->db->delete('order_tax_col_details');

        // Delete Invoice from customer ledger
        $this->db->where('order_no', $order_id);
        $this->db->delete('order_customer_ledger');

        //remove invoice transection
        $this->db->where('VNo', 'Inv-' . $order_id);
        $this->db->delete('order_acc_transaction');

        return true;
    }

    public function order_search_list($cat_id, $company_id)
    {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('orders a');
        $this->db->join('order_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('order_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    // GET TOTAL PURCHASE PRODUCT
    public function get_total_purchase_item($product_id)
    {
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
    public function get_total_sales_item($product_id)
    {
        $this->db->select('SUM(quantity) as total_sale');
        $this->db->from('order_details');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    //Get total product
    public function get_total_product($product_id)
    {
        $this->db->select('
			product_name,
			product_id,
			supplier_price,
			price,
			supplier_id,
			unit,
			variants,
			product_model,
			unit.unit_short_name
			');
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
            $html .= '<option value=""></option>';
            foreach ($variant_list as $varitem) {

                if ($varitem->variant_type == 'size') {
                    $html .= "<option value=" . $varitem->variant_id . ">" . $varitem->variant_name . "</option>";
                }
            }
            if (in_array('color', $var_types)) {
                $colorhtml .= "<option value=''></option>";
                foreach ($variant_list as $varitem2) {
                    if ($varitem2->variant_type == 'color') {
                        $colorhtml .= "<option value=" . $varitem2->variant_id . ">" . $varitem2->variant_name . "</option>";
                    }
                }
            }
        }
        $this->db->select('tax.*,tax_product_service.product_id,tax_percentage');
        $this->db->from('tax_product_service');
        $this->db->join('tax', 'tax_product_service.tax_id = tax.tax_id', 'left');
        $this->db->where('tax_product_service.product_id', $product_id);
        $tax_information = $this->db->get()->result();
        //New tax calculation for discount
        if (!empty($tax_information)) {
            foreach ($tax_information as $k => $v) {
                if ($v->tax_id == 'H5MQN4NXJBSDX4L') {
                    $tax['cgst_tax']     = ($v->tax_percentage) / 100;
                    $tax['cgst_name']    = $v->tax_name;
                    $tax['cgst_id']         = $v->tax_id;
                } elseif ($v->tax_id == '52C2SKCKGQY6Q9J') {
                    $tax['sgst_tax']     = ($v->tax_percentage) / 100;
                    $tax['sgst_name']    = $v->tax_name;
                    $tax['sgst_id']         = $v->tax_id;
                } elseif ($v->tax_id == '5SN9PRWPN131T4V') {
                    $tax['igst_tax']     = ($v->tax_percentage) / 100;
                    $tax['igst_name']    = $v->tax_name;
                    $tax['igst_id']        = $v->tax_id;
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
        $data2 = array(
            'total_product'    => $stock,
            'supplier_price' => $product_information->supplier_price,
            'price'         => $product_information->price,
            'variant_id'     => $product_information->variants,
            'supplier_id'     => $product_information->supplier_id,
            'product_name'     => $product_information->product_name,
            'product_model' => $product_information->product_model,
            'product_id'     => $product_information->product_id,
            'variant'         => $html,
            'colorhtml'       => $colorhtml,
            'sgst_tax'         => (!empty($tax['sgst_tax']) ? $tax['sgst_tax'] : null),
            'cgst_tax'         => (!empty($tax['cgst_tax']) ? $tax['cgst_tax'] : null),
            'igst_tax'         => (!empty($tax['igst_tax']) ? $tax['igst_tax'] : null),
            'cgst_id'         => (!empty($tax['cgst_id']) ? $tax['cgst_id'] : null),
            'sgst_id'         => (!empty($tax['sgst_id']) ? $tax['sgst_id'] : null),
            'igst_id'         => (!empty($tax['igst_id']) ? $tax['igst_id'] : null),
            'unit'             => $product_information->unit_short_name,
        );
        return $data2;
    }

    //This function is used to Generate Key
    public function generator($lenth)
    {
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
    public function number_generator()
    {
        $this->db->select('invoice', 'invoice_no');
        $query = $this->db->get('invoice');
        $result = $query->result_array();
        $invoice_no = count($result);
        if ($invoice_no >= 1  && $invoice_no < 2) {
            $invoice_no = 1000 + (($invoice_no == 1) ? 0 : $invoice_no) + 1;
        } elseif ($invoice_no >= 2) {
            $invoice_no = 1000 + (($invoice_no == 1) ? 0 : $invoice_no);
        } else {
            $invoice_no = 1000;
        }
        return $invoice_no;
    }

    //NUMBER GENERATOR FOR ORDER
    public function number_generator_order()
    {
        $this->db->select_max('order', 'order_no');
        $query    = $this->db->get('order');
        $result   = $query->result_array();
        $order_no = $result[0]['order_no'];
        if ($order_no != '') {
            $order_no = $order_no + 1;
        } else {
            $order_no = 1000;
        }
        return $order_no;
    }
    //Product List
    public function product_list()
    {
        $query = $this->db->select('
				supplier_information.*,
				product_information.*,
				product_category.category_name
				')
            ->from('product_information')
            ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
            ->join('product_category', 'product_category.category_id = product_information.category_id', 'left')
            ->group_by('product_information.product_id')
            ->order_by('product_information.product_name', 'asc')
            ->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    //Category List
    public function category_list()
    {
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
    public function product_search($product_name, $category_id)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        if (!empty($product_name)) {
            $this->db->like('product_name', $product_name, 'both');
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
    // Order payment info
    public function get_order_payinfo($order_id)
    {
        return $this->db->select('a.*, b.agent as payment_method')
            ->from('order_payment a')
            ->join('payment_gateway b', 'a.payment_id=b.used_id', 'left')
            ->where('a.order_id', $order_id)
            ->get()->row_array();
    }
    //Best Sale Product
    public function best_sale_product()
    {
        $today    = date("m-d-Y");
        $fromdate = date("m-d-Y", strtotime("-30 days"));
        $product_ids = $this->db->query("SELECT COUNT(a.order_id) as order_count, c.product_name 
                    FROM order_details a
                    LEFT JOIN product_information c
                    ON a.product_id = c.product_id
                    LEFT JOIN `order` b
                    ON a.order_id = b.order_id
                    WHERE DATE(b.date) BETWEEN '" . $fromdate . "' AND '" . $today . "'
                    GROUP BY a.product_id ORDER BY order_count DESC LIMIT 5")->result_array();
        if (!empty($product_ids)) {
            return $product_ids;
        }
    }
    public function all_best_sale_product($from_date = false, $to_date = false, $product_id = false)
    {
        $from = date("Y-m-d", strtotime($from_date));
        $to   = date("Y-m-d", strtotime($to_date));
        if (!empty($from_date) && !empty($to_date) && !empty($product_id)) {
            $product_ids = $this->db->query("SELECT COUNT(a.order_id) as order_count, c.product_name 
                    FROM order_details a
                    LEFT JOIN product_information c
                    ON a.product_id = c.product_id
                    LEFT JOIN `order` b
                    ON a.order_id = b.order_id
                    WHERE DATE(b.created_at) BETWEEN '" . $from . "' AND '" . $to . "' AND c.product_id = '" . $product_id . "'
                    GROUP BY a.product_id ORDER BY order_count DESC")->result_array();
        } elseif (empty($from_date) && empty($to_date) && !empty($product_id)) {
            $product_ids = $this->db->query("SELECT COUNT(a.order_id) as order_count, c.product_name 
                    FROM order_details a
                    LEFT JOIN product_information c
                    ON a.product_id = c.product_id
                    LEFT JOIN `order` b
                    ON a.order_id = b.order_id
                    WHERE c.product_id = '" . $product_id . "'
                    GROUP BY a.product_id ORDER BY order_count DESC")->result_array();
        } elseif (!empty($from_date) && !empty($to_date) && empty($product_id)) {
            $product_ids = $this->db->query("SELECT COUNT(a.order_id) as order_count, c.product_name 
                    FROM order_details a
                    LEFT JOIN product_information c
                    ON a.product_id = c.product_id
                    LEFT JOIN `order` b
                    ON a.order_id = b.order_id
                    WHERE DATE(b.created_at) BETWEEN '" . $from . "' AND '" . $to . "'
                    GROUP BY a.product_id ORDER BY order_count DESC")->result_array();
        } else {
            $to          = date("Y-m-d");
            $from        = date("Y-m-d", strtotime("-30 days"));
            $product_ids = $this->db->query("SELECT COUNT(a.order_id) as order_count, c.product_name 
                    FROM order_details a
                    LEFT JOIN product_information c
                    ON a.product_id = c.product_id
                    LEFT JOIN `order` b
                    ON a.order_id = b.order_id
                    WHERE DATE(b.created_at) BETWEEN '" . $from . "' AND '" . $to . "'
                    GROUP BY a.product_id ORDER BY order_count DESC")->result_array();
        }
        if (!empty($product_ids)) {
            return $product_ids;
        }
    }
}
