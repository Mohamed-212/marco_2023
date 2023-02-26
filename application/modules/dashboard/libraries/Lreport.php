<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lreport
{
    // Retrieve All Stock Report
    public function stock_report($limit, $page, $links)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');
        $stok_report = $CI->Reports->stock_report($limit, $page);

        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['stok_quantity'] = $stok_report[$k]['totalBuyQnty'] - $stok_report[$k]['totalSalesQnty'];
                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];
                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalBuyQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = $stok_report[$k]['stok_quantity'] / $stok_report[$k]['cartoon_quantity'];
            }
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('stock_report'),
            'stok_report' => $stok_report,
            'links' => $links,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],

        );
        $reportList = $CI->parser->parse('dashboard/report/stock_report', $data, true);
        return $reportList;
    }

    //Out of stock
    public function out_of_stock()
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');

        $out_of_stock = $CI->Reports->out_of_stock();

        if (!empty($out_of_stock)) {
            $i = 0;
            foreach ($out_of_stock as $k => $v) {
                $i++;
                $out_of_stock[$k]['sl'] = $i;
            }
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('out_of_stock'),
            'out_of_stock' => $out_of_stock,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('dashboard/report/out_of_stock', $data, true);
        return $reportList;
    }

    public function unpaid_installments($from_date = null, $to_date = null, $customer_id = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Customers');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');

        $unpaid_installments = $CI->Reports->unpaid_installments($from_date, $to_date, $customer_id);

        if (!empty($unpaid_installments)) {
            $i = 0;
            foreach ($unpaid_installments as $k => $v) {
                $i++;
                $unpaid_installments[$k]['sl'] = $i;
            }
        }

        $customers_list = $CI->Customers->customer_list();

        $data = array(
            'title' => display('unpaid_installment'),
            'unpaid_installments' => $unpaid_installments,
            'customers_list' => $customers_list
        );
        // echo "<pre>";print_r($data['unpaid_installments']);exit;


        $reportList = $CI->parser->parse('dashboard/report/unpaid_installment', $data, true);
        return $reportList;
    }

    // Retrieve Single Item Stock Stock Report
    public function stock_report_single_item($product_id = null, $date = null, $per_page = null, $page = null, $link = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->library('dashboard/occational');
        $stok_report = $CI->Reports->stock_report_bydate($product_id, $date, $per_page, $page);
        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
            foreach ($stok_report as $k => $v) {
                $sales = $CI->db->select("
					sum(quantity) as totalSalesQnty,
					quantity
					")
                    ->from('invoice_stock_tbl')
                    ->where('product_id', $v['product_id'])
                    ->get()
                    ->row();
                $stok_report[$k]['stok_quantity_cartoon'] = ($stok_report[$k]['totalPurchaseQnty'] - $sales->totalSalesQnty);
                $stok_report[$k]['totalSalesCtn'] = $sales->totalSalesQnty;
                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalPurchaseQnty'];
            }
        } else {
            $p_name = $CI->db->select('product_name')->from('product_information')->where('product_id', $product_id)->get()->row();
            if (!empty($p_name)) {
                $CI->session->set_userdata('error_message', $p_name->product_name . ' ' . display('stock_not_available'));
            } else {
                $CI->session->set_userdata('error_message', display('stock_not_available'));
            }
            redirect('Admin_dashboard');
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => display('stock_report'),
            'stok_report' => $stok_report,
            'link' => $link,
            'date' => $date,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('dashboard/report/stock_report', $data, true);
        return $reportList;
    }

    // Stock report supplier wise
    public function stock_report_supplier_wise($product_id = null, $supplier_id = null, $date = null, $links = null, $per_page = null, $page = null)
    {

        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->library('dashboard/occational');
        $stok_report = $CI->Reports->stock_report_supplier_bydate($product_id, $supplier_id, $date, $per_page, $page);
        $supplier_list = $CI->Suppliers->supplier_list_report();
        $supplier_info = $CI->Suppliers->retrieve_supplier_editdata($supplier_id);

        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;

        if (($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
            foreach ($stok_report as $k => $v) {
                $i++;
                $sales = $CI->db->select("
					sum(quantity) as totalSalesQnty,
					quantity
					")
                    ->from('invoice_details')
                    ->where('product_id', $v['product_id'])
                    ->get()
                    ->row();
                $stok_report[$k]['stok_quantity'] = ($stok_report[$k]['totalPrhcsCtn'] - $sales->totalSalesQnty);
                $stok_report[$k]['SubTotalOut'] = ($sub_total_out + $sales->totalSalesQnty);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];
                $stok_report[$k]['SubTotalIn'] = ($sub_total_in + $stok_report[$k]['totalPrhcsCtn']);
                $sub_total_in = $stok_report[$k]['SubTotalIn'];
                $stok_report[$k]['in_qnty'] = $stok_report[$k]['totalPrhcsCtn'];
                $stok_report[$k]['out_qnty'] = $sales->totalSalesQnty;
                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];
            }
        } else {
            $CI->session->set_userdata('error_message', display('stock_not_available'));
            redirect('dashboard/Creport');
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => display('stock_report_supplier_wise'),
            'stok_report' => $stok_report,
            'product_model' => $stok_report[0]['product_model'],
            'links' => $links,
            'date' => $date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'supplier_list' => $supplier_list,
            'supplier_info' => $supplier_info,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('dashboard/report/stock_report_supplier_wise', $data, true);
        return $reportList;
    }

    // Stock Report Product Wise
    public function stock_report_product_wise($product_id, $supplier_id, $from_date, $to_date, $links, $per_page, $page)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->library('dashboard/occational');
        $stok_report = $CI->Reports->stock_report_product_bydate($product_id, $supplier_id, $from_date, $to_date, $per_page, $page);
        $supplier_list = $CI->Suppliers->supplier_list_report();
        $supplier_info = $CI->Suppliers->retrieve_supplier_editdata($supplier_id);

        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;
        $sub_total_in_qnty = 0;
        $sub_total_out_qnty = 0;
        $sub_total_in_taka = 0;
        $sub_total_out_taka = 0;
        $stok_quantity_cartoon = 0;

        if (($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }

            foreach ($stok_report as $k => $v) {
                $i++;

                $sales = $CI->db->select("sum(quantity) as totalSalesQnty,quantity,rate")
                    ->from('invoice_details')
                    ->where('product_id', $v['product_id'])
                    ->get()
                    ->row();
                $stok_report[$k]['stok_quantity_cartoon'] = ($stok_report[$k]['totalPurchaseQnty'] - $sales->totalSalesQnty);
                $stok_report[$k]['totalSalesQnty']       = ($sales->totalSalesQnty);
                $stok_report[$k]['SubTotalStock']        = ($sub_total_stock + $stok_report[$k]['stok_quantity_cartoon']);
                $sub_total_stock                         = $stok_report[$k]['SubTotalStock'];
                $stok_report[$k]['in_taka']              = $stok_report[$k]['totalPurchaseQnty'] * $stok_report[$k]['supplier_price'];
                $stok_report[$k]['out_taka']             = $sales->totalSalesQnty * $stok_report[$k]['supplier_price'];
                $stok_report[$k]['SubTotalinQnty']       = ($sub_total_in_qnty + $stok_report[$k]['totalPurchaseQnty']);
                $sub_total_in_qnty                       = $stok_report[$k]['SubTotalinQnty'];
                $stok_report[$k]['SubTotaloutQnty']      = ($sub_total_out_qnty + $sales->totalSalesQnty);
                $sub_total_out_qnty                      = $stok_report[$k]['SubTotaloutQnty'];
                $stok_report[$k]['SubTotalinTaka']       = ($sub_total_in_taka + $stok_report[$k]['in_taka']);
                $sub_total_in_taka                       = $stok_report[$k]['SubTotalinTaka'];
                $stok_report[$k]['SubTotalOutTaka']      = ($sub_total_out_taka + $stok_report[$k]['out_taka']);
                $sub_total_out_taka                      = $stok_report[$k]['SubTotalOutTaka'];
            }
        } else {
            $CI->session->set_userdata('error_message', display('stock_not_available'));
            redirect('dashboard/Creport');
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => display('stock_report_product_wise'),
            'stok_report' => $stok_report,
            'product_model' => $stok_report[0]['product_model'],
            'links' => $links,
            'date' => $to_date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'SubTotalinQnty' => $sub_total_in_qnty,
            'SubTotaloutQnty' => $sub_total_out_qnty,
            'sub_total_in_taka' => number_format($sub_total_in_taka, 2, '.', ','),
            'sub_total_out_taka' => number_format($sub_total_out_taka, 2, '.', ','),
            'supplier_list' => $supplier_list,
            'supplier_info' => $supplier_info,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/stock_report_product_wise', $data, true);
        return $reportList;
    }

    // Stock Report Variant Wise
    public function stock_report_variant_wise($from_date = false, $to_date = false, $store_id = false, $links = false, $per_page = false, $page = false, $product_id = false)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Stores');
        $CI->load->library('dashboard/occational');


        if (empty($store_id)) {
            $from_date = date('d-m-Y');

            $to_date = date('d-m-Y');
            $result =  $CI->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
            $store_id = $result->store_id;
        }

        $stok_report = $CI->Reports->stock_report_by_store($from_date, $to_date, $store_id, $per_page, $page, $product_id);
        $trans_received_items = $CI->Reports->stock_receive_report_by_store($from_date, $to_date, $store_id, $per_page, $page, $product_id);
        $product_list = $CI->Products->product_list();

        $store_list = $CI->Stores->store_list();

        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;

        $i = $page;
        foreach ($stok_report as $k => $v) {
            $i++;
            $stok_report[$k]['sl'] = $i;
        }
        if ($stok_report) {
            foreach ($stok_report as $k => $v) {
                $i++;

                $CI->db->select("sum(quantity) as totalSalesQnty");
                $CI->db->from('invoice_stock_tbl');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);

                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }

                $CI->db->where('store_id', @$v['store_id']);
                $sales = $CI->db->get()->row();

                $CI->db->select("sum(b.quantity) as totalPrhcsCtn");
                $CI->db->from('transfer b');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);
                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }
                $CI->db->where('store_id', @$v['store_id']);
                $CI->db->where('t_store_id =', null);
                $purchase = $CI->db->get()->row();

                $CI->db->select("sum(b.quantity) as totalReceive");
                $CI->db->from('transfer b');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);
                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }
                $CI->db->where('store_id', @$v['store_id']);
                $CI->db->where('quantity >', 0);
                $CI->db->where('t_store_id !=', null);
                $receive = $CI->db->get()->row();

                $CI->db->select("sum(b.quantity) as totalSend");
                $CI->db->from('transfer b');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);
                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }
                $CI->db->where('store_id', @$v['store_id']);
                $CI->db->where('quantity <', 0);
                $CI->db->where('t_store_id !=', null);
                $send = $CI->db->get()->row();


                $stok_report[$k]['stok_quantity'] = (@$purchase->totalPrhcsCtn + @$receive->totalReceive - $sales->totalSalesQnty + @$send->totalSend);
                $stok_report[$k]['SubTotalOut']   = ($sub_total_out + $sales->totalSalesQnty);
                $sub_total_out                    = $stok_report[$k]['SubTotalOut'];

                $stok_report[$k]['SubTotalIn']    = ($sub_total_in + @$receive->totalReceive + @$purchase->totalPrhcsCtn);
                $sub_total_in                     = $stok_report[$k]['SubTotalIn'];
                $stok_report[$k]['in_qnty']       = @$purchase->totalPrhcsCtn;
                $stok_report[$k]['out_qnty']      = $sales->totalSalesQnty;

                $stok_report[$k]['rec_qty']       = @$receive->totalReceive;
                $stok_report[$k]['issue_qty'] = @substr($send->totalSend, 1);
                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];
            }
        } else if ($trans_received_items) {
            $stok_report = $trans_received_items;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
            foreach ($stok_report as $k => $v) {
                $i++;

                $CI->db->select("sum(quantity) as totalSalesQnty");
                $CI->db->from('invoice_stock_tbl');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);

                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }

                $CI->db->where('store_id', @$v['store_id']);
                $sales = $CI->db->get()->row();

                $CI->db->select("sum(b.quantity) as totalPrhcsCtn");
                $CI->db->from('transfer b');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);
                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }
                $CI->db->where('store_id', @$v['store_id']);
                $CI->db->where('t_store_id =', null);
                $purchase = $CI->db->get()->row();

                $CI->db->select("sum(b.quantity) as totalReceive");
                $CI->db->from('transfer b');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);
                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }
                $CI->db->where('store_id', @$v['store_id']);
                $CI->db->where('quantity >', 0);
                $CI->db->where('t_store_id !=', null);
                $receive = $CI->db->get()->row();

                $CI->db->select("sum(b.quantity) as totalSend");
                $CI->db->from('transfer b');
                $CI->db->where('product_id', @$v['product_id']);
                $CI->db->where('variant_id', @$v['variant_id']);
                if (!empty($v['variant_color'])) {
                    $CI->db->where('variant_color', @$v['variant_color']);
                }
                $CI->db->where('store_id', @$v['store_id']);
                $CI->db->where('quantity <', 0);
                $CI->db->where('t_store_id !=', null);
                $send = $CI->db->get()->row();


                $stok_report[$k]['stok_quantity'] = (@$purchase->totalPrhcsCtn + @$receive->totalReceive - $sales->totalSalesQnty + @$send->totalSend);
                $stok_report[$k]['SubTotalOut']   = ($sub_total_out + $sales->totalSalesQnty);
                $sub_total_out                    = $stok_report[$k]['SubTotalOut'];

                $stok_report[$k]['SubTotalIn']    = ($sub_total_in + @$receive->totalReceive + @$purchase->totalPrhcsCtn);
                $sub_total_in                     = $stok_report[$k]['SubTotalIn'];
                $stok_report[$k]['in_qnty']       = @$purchase->totalPrhcsCtn;
                $stok_report[$k]['out_qnty']      = $sales->totalSalesQnty;

                $stok_report[$k]['rec_qty']       = @$receive->totalReceive;
                $stok_report[$k]['issue_qty'] = @substr($send->totalSend, 1);
                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];
            }
        } else {
            $CI->session->set_userdata('error_message', display('stock_not_available'));
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info     = $CI->Reports->retrieve_company();
        $data = array(
            'title'          => display('stock_report_store_wise'),
            'stok_report'    => $stok_report,
            'product_model'  => @$stok_report[0]['product_model'],
            'links'          => $links,
            'date'           => '',
            'sub_total_in'   => $sub_total_in,
            'sub_total_out'  => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'product_list'   => $product_list,
            'store_list'     => $store_list,
            'company_info'   => $company_info,
            'currency'       => $currency_details[0]['currency_icon'],
            'position'       => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/stock_report_variant_wise', $data, true);
        return $reportList;
    }

    // stock report product card
    public function stock_report_product_card($from_date = false, $to_date = false, $store_id = false, $product_id)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Stores');
        $CI->load->library('dashboard/occational');


        if (empty($store_id)) {
            $from_date = date('d-m-Y');

            $to_date = date('d-m-Y');
            $result =  $CI->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
            $store_id = $result->store_id;
        }

        $stok_report = $product_id ? $CI->Reports->stock_report_by_product_card($from_date, $to_date, $store_id, $product_id) : [];

        // foreach ($stok_report as $repo) {
        //     $repo
        // }

        $product_list = $CI->Products->product_list();
        $store_list = $CI->Stores->store_list();

        $data = array(
            'title'          => display('stock_report_product_card'),
            'stok_report'    => $stok_report,
            // 'product_info'  => $stok_report[0],
            // 'links'          => $links,
            // 'date'           => '',
            // 'sub_total_in'   => $sub_total_in,
            // 'sub_total_out'  => $sub_total_out,
            // 'sub_total_stock' => $sub_total_stock,
            'product_list'   => $product_list,
            'store_list'     => $store_list,
            // 'company_info'   => $company_info,
            // 'currency'       => $currency_details[0]['currency_icon'],
            // 'position'       => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/stock_report_product_card', $data, true);
        return $reportList;
    }

    // ===========================STORE WISE STOCK REPORT======================
    public function store_wise_product($links = null, $per_page = null, $page = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $stok_report = $CI->Reports->store_wise_product($per_page, $page);
        $i = $page;
        if (!empty($stok_report)) {
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
        }

        $data = [
            'store_product_list' => $stok_report,
            'links' => $links
        ];
        $reportList = $CI->parser->parse('dashboard/report/stock_report_store_wise', $data, true);
        return $reportList;
    }


    //=================sales report store wise==================
    public function sales_report_store_wise($links = null, $per_page = null, $page = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Stores');
        $CI->load->model('dashboard/Reports');
        $store_list = $CI->Stores->store_list();
        $data = [
            'stores' => $store_list
        ];
        $reportList = $CI->parser->parse('dashboard/report/sales_report_store_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_store_wise($store_id, $start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $store_list = $CI->Stores->store_list();
        $sales_reports = $CI->Reports->retrieve_sales_report_store_wise($store_id, $start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'stores' => $store_list,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        $reportList = $CI->parser->parse('dashboard/report/sales_report_store_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_employee_wise($employee_id, $start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('hrm/Hrm_model');
        $employee_list = $CI->Hrm_model->employee_list();
        $sales_reports = $CI->Reports->retrieve_sales_report_employee_wise($employee_id, $start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'employees' => $employee_list,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'employee_id' => $employee_id,
        ];
        $reportList = $CI->parser->parse('dashboard/report/sales_report_employee_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_city_wise($cities, $start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/States');
        $CI->load->model('hrm/Hrm_model');
        $country_list = $CI->States->get_country_list();
        // get employees with that cities
        $query = $CI->db->select('e.id')->from('employee_history e');
        foreach ($cities as $city) {
            $query->or_where('FIND_IN_SET("' . $city . '", e.cities) >', 0);
        }
        $employee_ids = $query->get()->result();

        $sales_reports = [];

        foreach ($employee_ids as $empId) {
            $sales_reports[] = $CI->Reports->retrieve_sales_report_employee_wise($empId->id, $start_date, $end_date);
        }
        // echo "<pre>";var_dump($sales_reports);exit;

        $country = $CI->input->post('country', TRUE);
        $states = [];
        if ($country) {
            $states = $CI->States->get_states_by_country($country);
        }

        $data = [
            'sales_reports' => $sales_reports[0],
            'countries' => $country_list,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'cities' => $cities,
            'states' => $states,
        ];
        $reportList = $CI->parser->parse('dashboard/report/sales_report_city_wise', $data, true);
        return $reportList;
    }

    public function retrieve_purchase_report_product_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $reports = $CI->Reports->retrieve_purchase_report_product_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_purchase_return_report_product_wise($start_date, $end_date);
        $data = [
            'reports' => $reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => display('purchase_report_product_wise'),
        ];
        // echo "<pre>";var_dump($return_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/purchase_report_product_wise', $data, true);
        return $reportList;
    }

    public function retrieve_purchase_report_invoice_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $reports = $CI->Reports->retrieve_purchase_report_invoice_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_purchase_return_report_invoice_wise($start_date, $end_date);
        $data = [
            'reports' => $reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => display('purchase_report_invoice_wise'),
        ];
        // echo "<pre>";var_dump($return_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/purchase_report_invoice_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_customer_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $sales_reports = $CI->Reports->retrieve_sales_report_customer_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_return_report_customer_wise($start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        // echo "<pre>";var_dump($sales_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/sales_report_customer_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_summary_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $sales_reports = $CI->Reports->retrieve_sales_report_summary_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_return_report_summary_wise($start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => display('sales_report_summary_wise'),
        ];
        // echo "<pre>";var_dump($sales_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/sales_report_summary_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_latest_customers($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $sales_reports = $CI->Reports->retrieve_sales_report_latest_customers($start_date, $end_date);

        // $return_reports = $CI->Reports->retrieve_return_report_summary_wise($start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        // echo "<pre>";var_dump($reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/sales_report_latest_customers', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_all_details_count(
        $category_id = null,
        $product_type = null,
        $general_filter = null,
        $material_filter = null,
        $product_name = null
    ) {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Stores');
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Categories');
        $CI->load->library('dashboard/occational');

        if (empty($store_id)) {
            $result =  $CI->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
            $store_id = $result->store_id;
        }

        $product_ids = [];

        if ($general_filter || $material_filter) {
            $CI->db->reset_query();
            $filter_products = $CI->db->select('a.product_id')
                ->from('filter_product a, filter_product b');

            if ($general_filter) {
                $filter_products->where_in('a.filter_item_id', $general_filter);
            }
            if ($material_filter) {
                $filter_products->where_in('b.filter_item_id', $material_filter);
            }
            $filter_products->where('a.product_id = b.product_id');
            $filter_products = $filter_products->get()->result_array();
            foreach ($filter_products as $prod) {
                $product_ids[] = $prod['product_id'];
            }
        }

        $CI->db->reset_query();
        $products = $CI->db->select('COUNT(p.product_id) as products_count')->from('product_information p');

        if ($category_id) {
            $products->where_in('p.category_id', $category_id);
        }

        if ($product_type) {
            $products->where('p.assembly', $product_type);
        }

        if (($general_filter || $material_filter) && count($product_ids)) {
            $products->where_in('p.product_id', $product_ids);
        }

        if ($product_name) {
            $products->where('LOWER(p.product_name) LIKE', "%$product_name%");
        }

        return $products->get()->row();
    }

    public function retrieve_sales_report_all_details(
        $product_id = null,
        $pricing_type = null,
        $category_id = null,
        $product_type = null,
        $general_filter = null,
        $material_filter = null,
        $sales_from = null,
        $sales_to = null,
        $purchase_from = null,
        $purchase_to = null,
        $balance_from = null,
        $balance_to = null,
        $supplier_from = null,
        $supplier_to = null,
        $total_supplier_from = null,
        $total_supplier_to = null,
        $sell_from = null,
        $sell_to = null,
        $total_sell_from = null,
        $total_sell_to = null,
        $start_date = null,
        $end_date = null,
        $store_id = null,
        $product_name = null,
        $per_page = 20,
        $page = 0,
        $links = [],
        $footer = []
    ) {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Stores');
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Categories');
        $CI->load->library('dashboard/occational');

        // if (empty($store_id)) {
        //     $result =  $CI->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
        //     $store_id = $result->store_id;
        // }

        // $product_ids = [];
        // // if ($material_filter) {
        // //     $CI->db->reset_query();
        // //     $materialProducts = $CI->db->select('product_id')
        // //         ->from('filter_product')
        // //         ->where('filter_type_id', 2)
        // //         ->where('filter_item_id', $material_filter)
        // //         ->get()->result_array();
        // //     foreach ($materialProducts as $prod) {
        // //         $product_ids[] = $prod['product_id'];
        // //     }
        // // }

        // if (!empty($general_filter) || !empty($material_filter)) {
        //     $CI->db->reset_query();
        //     $filter_products = $CI->db->select('a.product_id')
        //         ->from('filter_product a, filter_product b');

        //     if (!empty($general_filter)) {
        //         $filter_products->where_in('a.filter_item_id', $general_filter);
        //     }
        //     if (!empty($material_filter)) {
        //         $filter_products->where_in('b.filter_item_id', $material_filter);
        //     }
        //     $filter_products->where('a.product_id = b.product_id');
        //     $filter_products = $filter_products->get()->result_array();
        //     foreach ($filter_products as $prod) {
        //         $product_ids[] = $prod['product_id'];
        //     }
        // }

        // $CI->db->reset_query();
        // $products = $CI->db->select('p.product_id')->from('product_information p');

        // // if (!$product_id) {
        // // $product_id = '92886343';
        // // if ($store_id) {
        // //     $products->where('store_id', $store_id);
        // // }

        // if (!empty($category_id) && !empty($category_id[0])) {
        //     $products->where_in('p.category_id', $category_id);
        // }

        // if ($product_type) {
        //     $products->where('p.assembly', $product_type);
        // }

        // if (($general_filter || $material_filter) && count($product_ids)) {
        //     $products->where_in('p.product_id', $product_ids);
        // }
        // // } else {
        // if (!empty($product_name)) {
        //     $products->where('LOWER(p.product_name) LIKE', "%$product_name%");
        // }

        // // if (!$product_name && !$category_id && !$product_type && empty($product_ids)) {
        // //     $products->limit(400);
        // // }

        // // }

        // $products = $products->limit($per_page, $page)->order_by('product_name', 'asc')->get()->result_array();

        // echo "<pre>";var_dump(count($products));exit;

        $product_list = $CI->Products->product_list();
        $category_list = $CI->Categories->category_list();
        $store_list = $CI->Stores->store_list();
        $all_pri_type = $CI->Invoices->select_all_pri_type();
        $filter_1_list = $CI->db->select('fi.*')
            ->from('filter_items fi')
            ->where('fi.type_id = 1')
            ->get()->result_array();
        $filter_2_list = $CI->db->select('fi.*')
            ->from('filter_items fi')
            ->where('fi.type_id = 2')
            ->get()->result_array();

        // $stock_reports = [];

        // echo "<pre>";

        // foreach ($products as $prod) {
        //     $item = $CI->Reports->sales_report_all_details(
        //         $prod['product_id'],
        //         $store_id,
        //         $pricing_type,
        //         $start_date,
        //         $end_date,
        //     );

        //     // $sales_quantity = (int)$item[1]->total_invoice_quantity + (int)$item[2]->total_purchase_return_quantity;
        //     // $purchase_quantity = (int)$item[3]->total_purchase_quantity + (int)$item[4]->total_invoice_return;
        //     $sales_quantity = (int)$item[6];
        //     $purchase_quantity = (int)$item[5];
        //     $balance = (int)$item[7];
        //     $supplier_price_total = abs(round((float)$item[0]['supplier_price'] * $balance, 2));
        //     $sell_price_total = abs(round((float)$item[0]['selected_price'] * $balance, 2));

        //     if ($sales_from && $sales_quantity < (int)$sales_from) continue;
        //     if ($sales_to && $sales_quantity > (int)$sales_to) continue;

        //     if ($purchase_from && $purchase_quantity < (int)$purchase_from) continue;
        //     if ($purchase_to && $purchase_quantity > (int)$purchase_to) continue;

        //     if ($balance_from && abs($balance) < (int)$balance_from) continue;
        //     if ($balance_to && abs($balance) > (int)$balance_to) continue;

        //     if ($supplier_from && (float)($item[0]['supplier_price']) < (float)$supplier_from) continue;
        //     if ($supplier_to && (float)($item[0]['supplier_price']) > (float)$supplier_to) continue;

        //     if ($total_supplier_from && $supplier_price_total < (float)$total_supplier_from) continue;
        //     if ($total_supplier_to && $supplier_price_total > (float)$total_supplier_to) continue;

        //     if ($sell_from && (float)($item[0]['selected_price']) < (float)$sell_from) continue;
        //     if ($sell_to && (float)($item[0]['selected_price']) > (float)$sell_to) continue;

        //     if ($total_sell_from && $sell_price_total < (float)$total_sell_from) continue;
        //     if ($total_sell_to && $sell_price_total > (float)$total_sell_to) continue;

        //     $stock_reports[] = $item;
        // }

        // $ids = [];
        // foreach ($products as $prod) {
        //     $ids[] = $prod['product_id'];
        // }

        // var_dump(count($ids));exit;
        // echo "<pre>";var_dump($sales_from,
        // $sales_to,
        // $purchase_from,
        // $purchase_to,
        // $balance_from,
        // $balance_to,
        // $supplier_from,
        // $supplier_to,
        // $total_supplier_from,
        // $total_supplier_to,
        // $sell_from,
        // $sell_to,
        // $total_sell_from,
        // $total_sell_to,
        // $start_date,
        // $end_date);exit;

        $stock_reports = $CI->Reports->sales_report_all_details_sum_all(
            $product_id,
            $pricing_type,
            $category_id,
            $product_type,
            $general_filter,
            $material_filter,
            $sales_from,
            $sales_to,
            $purchase_from,
            $purchase_to,
            $balance_from,
            $balance_to,
            $supplier_from,
            $supplier_to,
            $total_supplier_from,
            $total_supplier_to,
            $sell_from,
            $sell_to,
            $total_sell_from,
            $total_sell_to,
            $start_date,
            $end_date,
            $store_id,
            $product_name,
            $per_page,
            $page,
            $links
        );

        // var_dump($balance_from, $balance_to);exit;


        // echo "<pre>";
        // var_dump($stock_reports);
        // exit;

        

        // var_dump($footer);
        // exit;



        $data = array(
            'title'          => display('sales_report_all_details'),
            'stock_reports'    => $stock_reports,
            'product_list'   => $product_list,
            'category_list' => $category_list,
            'store_list'     => $store_list,
            'filter_1_list' => $filter_1_list,
            'filter_2_list' => $filter_2_list,
            'start_date'   => $start_date,
            'end_date'   => $end_date,
            'all_pri_type' => $all_pri_type,
            'links' => $links,
            'product_name' => $product_name,
            'footer' => $footer,
            'page' => $page,
        );
        // echo "<pre>";var_dump($reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/sales_report_all_details', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_all_details_count_all(
        $product_id = null,
        $pricing_type = null,
        $category_id = null,
        $product_type = null,
        $general_filter = null,
        $material_filter = null,
        $sales_from = null,
        $sales_to = null,
        $purchase_from = null,
        $purchase_to = null,
        $balance_from = null,
        $balance_to = null,
        $supplier_from = null,
        $supplier_to = null,
        $total_supplier_from = null,
        $total_supplier_to = null,
        $sell_from = null,
        $sell_to = null,
        $total_sell_from = null,
        $total_sell_to = null,
        $start_date = null,
        $end_date = null,
        $store_id = null,
        $product_name = null,
        $per_page = 20,
        $page = 0,
        $links = []
    ) {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Stores');
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Categories');
        $CI->load->library('dashboard/occational');
// return;
        $stock_reports = $CI->Reports->sales_report_all_details_sum_all_count(
            $product_id,
            $pricing_type,
            $category_id,
            $product_type,
            $general_filter,
            $material_filter,
            $sales_from,
            $sales_to,
            $purchase_from,
            $purchase_to,
            $balance_from,
            $balance_to,
            $supplier_from,
            $supplier_to,
            $total_supplier_from,
            $total_supplier_to,
            $sell_from,
            $sell_to,
            $total_sell_from,
            $total_sell_to,
            $start_date,
            $end_date,
            $store_id,
            $product_name,
            $per_page,
            $page,
            $links
        );

        $totalPurchase = 0;
        $totalSales = 0;
        $totalBalance = 0;
        $totalSupplierPrice = 0;
        $totalSellPrice = 0;
        $count = 0;
        foreach ($stock_reports as $fo) {
            $totalPurchase += (int)$fo['totalPurchaseQnty'];
            $totalSales += (int)$fo['totalSalesQnty'];
            $totalBalance += (int)$fo['totalPurchaseQnty'] - (int)$fo['totalSalesQnty'];
            $totalSupplierPrice += (float)$fo['supplier_price'];
            $totalSellPrice += (float)$fo['selected_price'];
            $count++;
        }

        return compact('totalPurchase', 'totalSales', 'totalBalance', 'totalSupplierPrice', 'totalSellPrice', 'count');

        // return $stock_reports;
    }

    public function retrieve_sales_report_all_details_footer(
        $product_id = null,
        $pricing_type = null,
        $category_id = null,
        $product_type = null,
        $general_filter = null,
        $material_filter = null,
        $sales_from = null,
        $sales_to = null,
        $purchase_from = null,
        $purchase_to = null,
        $balance_from = null,
        $balance_to = null,
        $supplier_from = null,
        $supplier_to = null,
        $total_supplier_from = null,
        $total_supplier_to = null,
        $sell_from = null,
        $sell_to = null,
        $total_sell_from = null,
        $total_sell_to = null,
        $start_date = null,
        $end_date = null,
        $store_id = null,
        $product_name = null
    ) {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Stores');
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Categories');
        $CI->load->library('dashboard/occational');

        if (empty($store_id)) {
            $result =  $CI->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
            $store_id = $result->store_id;
        }

        $product_ids = [];

        if ($general_filter || $material_filter) {
            $CI->db->reset_query();
            $filter_products = $CI->db->select('a.product_id')
                ->from('filter_product a, filter_product b');

            if ($general_filter) {
                $filter_products->where_in('a.filter_item_id', $general_filter);
            }
            if ($material_filter) {
                $filter_products->where_in('b.filter_item_id', $material_filter);
            }
            $filter_products->where('a.product_id = b.product_id');
            $filter_products = $filter_products->get()->result_array();
            foreach ($filter_products as $prod) {
                $product_ids[] = $prod['product_id'];
            }
        }

        $CI->db->reset_query();
        $products = $CI->db->select('p.product_id')->from('product_information p');


        if ($category_id) {
            $products->where_in('p.category_id', $category_id);
        }

        if ($product_type) {
            $products->where('p.assembly', $product_type);
        }

        if (($general_filter || $material_filter) && count($product_ids)) {
            $products->where_in('p.product_id', $product_ids);
        }
        // } else {
        if ($product_name) {
            $products->where('LOWER(p.product_name) LIKE', "%$product_name%");
        }

        $products = $products->order_by('product_name', 'asc')->get()->result_array();

        $ids = [];
        foreach ($products as $prod) {
            $ids[] = $prod['product_id'];
        }

        $footer = $CI->Reports->sales_report_all_details_sum_all(
            $ids,
            $pricing_type,
            $sales_from,
            $sales_to,
            $purchase_from,
            $purchase_to,
            $balance_from,
            $balance_to,
            $supplier_from,
            $supplier_to,
            $total_supplier_from,
            $total_supplier_to,
            $sell_from,
            $sell_to,
            $total_sell_from,
            $total_sell_to,
            $start_date,
            $end_date
        );
        $totalPurchase = 0;
        $totalSales = 0;
        $totalBalance = 0;
        $totalSupplierPrice = 0;
        $totalSellPrice = 0;
        foreach ($footer as $fo) {
            $totalPurchase += (int)$fo['totalPurchaseQnty'];
            $totalSales += (int)$fo['totalSalesQnty'];
            $totalBalance += (int)$fo['totalPurchaseQnty'] - (int)$fo['totalSalesQnty'];
            $totalSupplierPrice += (float)$fo['supplier_price'];
            $totalSellPrice += (float)$fo['selected_price'];
        }

        return compact('totalPurchase', 'totalSales', 'totalBalance', 'totalSupplierPrice', 'totalSellPrice');
    }

    // Retrieve todays_sales_report
    public function todays_sales_report($links = null, $per_page = null, $page = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Web_settings');
        $CI->load->library('dashboard/occational');
        $sales_report = $CI->Reports->todays_sales_report($per_page, $page);
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();

        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => display('todays_sales_report'),
            'sales_amount' => number_format($sales_amount, 2, '.', ','),
            'sales_report' => $sales_report,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'links' => $links,
        );
        $reportList = $CI->parser->parse('dashboard/report/sales_report', $data, true);
        return $reportList;
    }

    // Retrieve datewise sales report
    public function retrieve_dateWise_SalesReports($start_date = false, $end_date = false, $employee_id = false, $city = false)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Web_settings');
        $CI->load->library('dashboard/occational');

        $sales_report = $CI->Reports->retrieve_dateWise_SalesReports($start_date, $end_date, $employee_id, $city);

        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => display('sales_report'),
            'sales_amount' => $sales_amount,
            'sales_report' => $sales_report,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'links' => '',
        );
        $reportList = $CI->parser->parse('dashboard/report/sales_report', $data, true);
        return $reportList;
    }

    /** Purchaes reports */

    // Retrieve todays_purchase_report
    public function todays_purchase_report($links = null, $per_page = null, $page = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Web_settings');
        $CI->load->library('dashboard/occational');
        $purchase_report = $CI->Reports->todays_purchase_report($per_page, $page);
        $purchase_amount = 0;

        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => display('todays_purchase_report'),
            'purchase_amount' => number_format($purchase_amount, 2, '.', ','),
            'purchase_report' => $purchase_report,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'links' => $links,
        );
        $reportList = $CI->parser->parse('dashboard/report/purchase_report', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_product_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $sales_reports = $CI->Reports->retrieve_sales_report_product_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_return_report_product_wise($start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        // echo "<pre>";var_dump($return_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/sales_report_product_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_invoice_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $sales_reports = $CI->Reports->retrieve_sales_report_invoice_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_return_report_invoice_wise($start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        // echo "<pre>";var_dump($sales_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/sales_report_invoice_wise', $data, true);
        return $reportList;
    }

    public function retrieve_sales_report_graph_wise($start_date = null, $end_date = null, $pri_type = 1, $all_pri_type = [])
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        // $sales_reports = $CI->Reports->retrieve_sales_report_graph_wise($start_date, $end_date);
        // $return_reports = $CI->Reports->retrieve_return_report_invoice_wise($start_date, $end_date);

        $addon = 'p.price';
        if ($pri_type == 1 || $pri_type == 2) {
            $addon = 'p.product_price';
        }

        $repo =  $CI->db->select('SUM(quantity) as tqty, (SUM(quantity) * ' . $addon . ') as sprice, il.created_at')->from('invoice_stock_tbl il')->group_by('month(il.created_at)');

        if ($pri_type == 1) {
            $repo->join('pricing_types_product p', 'p.product_id = il.product_id and p.pri_type_id = 1', 'inner');
        } elseif ($pri_type == 2) {
            $repo->join('pricing_types_product p', 'p.product_id = il.product_id and p.pri_type_id = 2', 'inner');
        } else {
            $repo->join('product_information p', 'p.product_id = il.product_id', 'inner');
        }

        if ($start_date && $end_date) {
            $dateRangePurchase = "DATE(il.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
            $repo->where($dateRangePurchase, null, true);
        }

        $repo = $repo->order_by('il.created_at', 'asc')->get()->result();

        $t_qty = 0;
        $t_price = 0;
        if ($repo) {
            
            foreach ($repo as $r) {
                // if (!$r->total_price) {
                //     $r->total_price = 0;
                // }
                // if (!$r->t_qty) {
                //     $r->t_qty = 0;
                // }
                if (!$pri_type || $pri_type == 0) {
                    $r->t_price = (float) $r->sprice;
                } elseif ($pri_type == 1) {
                    $r->t_price = (float) $r->sprice;
                } elseif ($pri_type == 2) {
                    $r->t_price = (float) $r->sprice;
                } else {
                    $r->t_price = (float) $r->sprice;
                }

                $t_price += (float) $r->t_price;
                $t_qty += (int) $r->tqty;
            }
        }

        // echo "<pre>";var_dump($repo);exit;

        $data = [
            // 'sales_reports' => $sales_reports,
            // 'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'pri_type' => $pri_type,
            'all_pri_type' => $all_pri_type,
            'repos' => $repo,
            't_qty' => $t_qty,
            't_price' => $t_price,
        ];
        // echo "<pre>";var_dump($sales_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/sales_report_graph_wise', $data, true);
        return $reportList;
    }

    public function retrieve_purchase_report_graph_wise($start_date = null, $end_date = null, $pri_type = 1, $all_pri_type = [])
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        // $purchase_reports = $CI->Reports->retrieve_purchase_report_graph_wise($start_date, $end_date);
        // $return_reports = $CI->Reports->retrieve_return_report_invoice_wise($start_date, $end_date);

        $addon = 'p.price';
        if ($pri_type == 1 || $pri_type == 2) {
            $addon = 'p.product_price';
        }

        $repo =  $CI->db->select('SUM(quantity) as tqty, (SUM(quantity) * ' . $addon . ') as sprice, il.created_at')->from('purchase_stock_tbl il')->group_by('month(il.created_at)');

        if ($pri_type == 1) {
            $repo->join('pricing_types_product p', 'p.product_id = il.product_id and p.pri_type_id = 1', 'inner');
        } elseif ($pri_type == 2) {
            $repo->join('pricing_types_product p', 'p.product_id = il.product_id and p.pri_type_id = 2', 'inner');
        } else {
            $repo->join('product_information p', 'p.product_id = il.product_id', 'inner');
        }

        if ($start_date && $end_date) {
            $dateRangePurchase = "DATE(il.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
            $repo->where($dateRangePurchase, null, true);
        }

        $repo = $repo->order_by('il.created_at', 'asc')->get()->result();

        $t_qty = 0;
        $t_price = 0;
        if ($repo) {
            
            foreach ($repo as $r) {
                // if (!$r->total_price) {
                //     $r->total_price = 0;
                // }
                // if (!$r->t_qty) {
                //     $r->t_qty = 0;
                // }
                if (!$pri_type || $pri_type == 0) {
                    $r->t_price = (float) $r->sprice;
                } elseif ($pri_type == 1) {
                    $r->t_price = (float) $r->sprice;
                } elseif ($pri_type == 2) {
                    $r->t_price = (float) $r->sprice;
                } else {
                    $r->t_price = (float) $r->sprice;
                }

                $t_price += (float) $r->t_price;
                $t_qty += (int) $r->tqty;
            }
        }

        // echo "<pre>";var_dump($repo);exit;

        $data = [
            // 'purchase_reports' => $purchase_reports,
            // 'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'pri_type' => $pri_type,
            'all_pri_type' => $all_pri_type,
            'repos' => $repo,
            't_qty' => $t_qty,
            't_price' => $t_price,
        ];
        // echo "<pre>";var_dump($purchase_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/purchase_report_graph_wise', $data, true);
        return $reportList;
    }

    public function retrieve_purchase_report_customer_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $purchase_reports = $CI->Reports->retrieve_purchase_report_customer_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_purchase_return_report_customer_wise($start_date, $end_date);
        $data = [
            'purchase_reports' => $purchase_reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        // echo "<pre>";var_dump($return_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/purchase_report_customer_wise', $data, true);
        return $reportList;
    }

    public function retrieve_purchase_report_summary_wise($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $purchase_reports = $CI->Reports->retrieve_purchase_report_summary_wise($start_date, $end_date);
        $return_reports = $CI->Reports->retrieve_purchase_return_report_summary_wise($start_date, $end_date);
        $data = [
            'purchase_reports' => $purchase_reports,
            'return_reports' => $return_reports,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => display('purchase_report_summary_wise'),
        ];
        // echo "<pre>";var_dump($purchase_reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/purchase_report_summary_wise', $data, true);
        return $reportList;
    }

    public function retrieve_purchase_report_latest_suppliers($start_date = null, $end_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $sales_reports = $CI->Reports->retrieve_purchase_report_latest_suppliers($start_date, $end_date);

        // $return_reports = $CI->Reports->retrieve_return_report_summary_wise($start_date, $end_date);
        $data = [
            'sales_reports' => $sales_reports,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => display('purchase_report_latest_suppliers'),
        ];
        // echo "<pre>";var_dump($reports);exit;
        $reportList = $CI->parser->parse('dashboard/report/purchase_report_latest_suppliers', $data, true);
        return $reportList;
    }

    //Total profit report
    public function total_profit_report($links, $per_page, $page)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');
        $total_profit_report = $CI->Reports->total_profit_report($per_page, $page);

        $profit_ammount = 0;
        $SubTotalSupAmnt = 0;
        $SubTotalSaleAmnt = 0;
        if (!empty($total_profit_report)) {
            $i = 0;
            foreach ($total_profit_report as $k => $v) {
                $total_profit_report[$k]['sl'] = $i;
                $total_profit_report[$k]['prchse_date'] = $CI->occational->dateConvert($total_profit_report[$k]['date']);
                $profit_ammount = $profit_ammount + $total_profit_report[$k]['total_profit'];
                $SubTotalSupAmnt = $SubTotalSupAmnt + $total_profit_report[$k]['total_supplier_rate'];
                $SubTotalSaleAmnt = $SubTotalSaleAmnt + $total_profit_report[$k]['total_sale'];
            }
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('total_profit_report'),
            'profit_ammount' => number_format($profit_ammount, 2, '.', ','),
            'total_profit_report' => $total_profit_report,
            'SubTotalSupAmnt' => number_format($SubTotalSupAmnt, 2, '.', ','),
            'SubTotalSaleAmnt' => number_format($SubTotalSaleAmnt, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/profit_report', $data, true);
        return $reportList;
    }

    //Retrive datewise purchase report
    public function retrieve_dateWise_PurchaseReports($start_date, $end_date)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');
        $purchase_report = $CI->Reports->retrieve_dateWise_PurchaseReports($start_date, $end_date);
        $purchase_amount = 0;
        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => display('purchase_report'),
            'purchase_amount' => $purchase_amount,
            'purchase_report' => $purchase_report,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'links' => ''
        );
        $reportList = $CI->parser->parse('dashboard/report/purchase_report', $data, true);
        return $reportList;
    }

    //Retrive date wise total profit report
    public function retrieve_dateWise_profit_report($start_date, $end_date)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');
        $total_profit_report = $CI->Reports->retrieve_dateWise_profit_report($start_date, $end_date);

        $profit_ammount = 0;
        $SubTotalSupAmnt = 0;
        $SubTotalSaleAmnt = 0;
        if (!empty($total_profit_report)) {
            $i = 0;
            foreach ($total_profit_report as $k => $v) {
                $total_profit_report[$k]['sl'] = $i;
                $total_profit_report[$k]['prchse_date'] = $CI->occational->dateConvert($total_profit_report[$k]['date']);
                $profit_ammount = $profit_ammount + $total_profit_report[$k]['total_profit'];
                $SubTotalSupAmnt = $SubTotalSupAmnt + $total_profit_report[$k]['total_supplier_rate'];
                $SubTotalSaleAmnt = $SubTotalSaleAmnt + $total_profit_report[$k]['total_sale'];
            }
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('profit_report'),
            'profit_ammount' => number_format($profit_ammount, 2, '.', ','),
            'total_profit_report' => $total_profit_report,
            'SubTotalSupAmnt' => number_format($SubTotalSupAmnt, 2, '.', ','),
            'SubTotalSaleAmnt' => number_format($SubTotalSaleAmnt, 2, '.', ','),
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/profit_report', $data, true);
        return $reportList;
    }

    // Retrieve transfer report
    public function transfer_report($from_date = null, $to_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');

        $store_to_store_transfer = $CI->Reports->store_to_store_transfer($from_date, $to_date);
        $store_to_warehouse_transfer = $CI->Reports->store_to_warehouse_transfer($from_date, $to_date);
        $warehouse_to_store_transfer = $CI->Reports->warehouse_to_store_transfer($from_date, $to_date);
        $warehouse_to_warehouse_transfer = $CI->Reports->warehouse_to_warehouse_transfer($from_date, $to_date);

        $data = array(
            'title' => display('transfer_report'),
            'store_to_store_transfer' => $store_to_store_transfer,
            'store_to_warehouse_transfer' => $store_to_warehouse_transfer,
            'warehouse_to_store_transfer' => $warehouse_to_store_transfer,
            'warehouse_to_warehouse_transfer' => $warehouse_to_warehouse_transfer,
        );
        $reportList = $CI->parser->parse('dashboard/report/transfer_report', $data, true);
        return $reportList;
    }

    // Retrieve store to store transfer report
    public function store_to_store_transfer($from_date = null, $to_date = null, $from_store = null, $to_store = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');

        $store_to_store_transfer = $CI->Reports->store_to_store_transfer($from_date, $to_date, $from_store, $to_store);
        $store_list = $CI->Stores->store_list();

        $data = array(
            'title'                  => display('store_to_store_transfer'),
            'store_to_store_transfer' => $store_to_store_transfer,
            'store_list'             => $store_list,
        );
        $reportList = $CI->parser->parse('dashboard/report/store_to_store_transfer', $data, true);
        return $reportList;
    }

    // Store to wearhouse transfer
    public function store_to_warehouse_transfer($from_date = null, $to_date = null, $from_store = null, $t_wearhouse = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $CI->load->model('dashboard/Wearhouses');

        $store_to_warehouse_transfer = $CI->Reports->store_to_warehouse_transfer($from_date, $to_date, $from_store, $t_wearhouse);
        $store_list = $CI->Stores->store_list();
        $wearhouse_list = $CI->Wearhouses->wearhouse_list();

        $data = array(
            'title' => display('store_to_warehouse_transfer'),
            'store_to_warehouse_transfer' => $store_to_warehouse_transfer,
            'store_list' => $store_list,
            'wearhouse_list' => $wearhouse_list,
        );
        $reportList = $CI->parser->parse('dashboard/report/store_to_warehouse_transfer', $data, true);
        return $reportList;
    }

    // Wearhouse to store transfer
    public function warehouse_to_store_transfer($from_date = null, $to_date = null, $wearhouse = null, $t_store = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Stores');
        $CI->load->model('dashboard/Wearhouses');

        $warehouse_to_store_transfer = $CI->Reports->warehouse_to_store_transfer($from_date, $to_date, $wearhouse, $t_store);
        $store_list = $CI->Stores->store_list();
        $wearhouse_list = $CI->Wearhouses->wearhouse_list();

        $data = array(
            'title' => display('warehouse_to_store_transfer'),
            'warehouse_to_store_transfer' => $warehouse_to_store_transfer,
            'store_list' => $store_list,
            'wearhouse_list' => $wearhouse_list,
        );
        $reportList = $CI->parser->parse('dashboard/report/warehouse_to_store_transfer', $data, true);
        return $reportList;
    }

    // Wearhouse to wearhouse transfer
    public function warehouse_to_warehouse_transfer($from_date = null, $to_date = null, $wearhouse = null, $t_wearhouse = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Wearhouses');

        $warehouse_to_warehouse_transfer = $CI->Reports->warehouse_to_warehouse_transfer($from_date, $to_date, $wearhouse, $t_wearhouse);
        $wearhouse_list = $CI->Wearhouses->wearhouse_list();
        $data = array(
            'title' => display('warehouse_to_warehouse_transfer'),
            'warehouse_to_warehouse_transfer' => $warehouse_to_warehouse_transfer,
            'wearhouse_list' => $wearhouse_list,
        );
        $reportList = $CI->parser->parse('dashboard/report/warehouse_to_warehouse_transfer', $data, true);
        return $reportList;
    }

    // Retrieve tax report
    public function tax_report($from_date = null, $to_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');

        $tax_report_product_wise = $CI->Reports->tax_report_product_wise($from_date, $to_date);

        $Subtotal_tax_amnt = 0;
        if (!empty($tax_report_product_wise)) {
            $i = 0;
            foreach ($tax_report_product_wise as $k => $v) {
                $tax_report_product_wise[$k]['sl'] = $i;
                $tax_report_product_wise[$k]['date'] = $CI->occational->dateConvert($tax_report_product_wise[$k]['date']);
                $Subtotal_tax_amnt = $Subtotal_tax_amnt + $tax_report_product_wise[$k]['amount'];
            }
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('tax_report_product_wise'),
            'tax_report_product_wise' => $tax_report_product_wise,
            'Subtotal_tax_amnt' => $Subtotal_tax_amnt,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/tax_report_product_wise', $data, true);
        return $reportList;
    }

    // Retrieve tax report
    public function tax_report_invoice_wise($from_date = null, $to_date = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');

        $tax_report_invoice_wise = $CI->Reports->tax_report_invoice_wise($from_date, $to_date);
        $Subtotal_tax_amnt = 0;
        if (!empty($tax_report_invoice_wise)) {
            $i = 0;
            foreach ($tax_report_invoice_wise as $k => $v) {
                $tax_report_invoice_wise[$k]['sl'] = $i;
                $tax_report_invoice_wise[$k]['date'] = $CI->occational->dateConvert($tax_report_invoice_wise[$k]['date']);
                $Subtotal_tax_amnt = $Subtotal_tax_amnt + $tax_report_invoice_wise[$k]['tax_amount'];
            }
        }


        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('tax_report_invoice_wise'),
            'tax_report_invoice_wise' => $tax_report_invoice_wise,
            'Subtotal_tax_amnt' => $Subtotal_tax_amnt,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/tax_report_invoice_wise', $data, true);
        return $reportList;
    }

    //Products search report
    public function get_products_search_report($from_date, $to_date)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');
        $product_report = $CI->Reports->retrieve_product_search_sales_report($from_date, $to_date);

        if (!empty($product_report)) {
            $i = 0;
            foreach ($product_report as $k => $v) {
                $i++;
                $product_report[$k]['sl'] = $i;
            }
        }
        $sub_total = 0;
        if (!empty($product_report)) {
            foreach ($product_report as $k => $v) {
                $product_report[$k]['sales_date'] = $CI->occational->dateConvert($product_report[$k]['date']);
                $sub_total = $sub_total + $product_report[$k]['total_price'];
            }
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('sales_report_product_wise'),
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'product_report' => $product_report,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('dashboard/report/product_report', $data, true);
        return $reportList;
    }

    public function get_products_balance($from_date = null, $to_date = null, $store_id = null, $product_id = null)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Reports');
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Customers');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');

        $store_list = $CI->Stores->store_list();

        $store_list[] = [
            'store_id' => 's1',
            'store_name' => display('damaged')
        ];
        // $store_list[] = [
        //     'store_id' => 's2',
        //     'store_name' => display('no warranty')
        // ];
        $products_balance = $CI->Reports->products_balance($from_date, $to_date, $store_id, $product_id);


        if (!empty($products_balance)) {
            $i = 0;
            foreach ($products_balance as $k => $v) {
                $i++;
                $products_balance[$k]['sl'] = $i;
            }
        }

        $product_name = $CI->db->select('product_name')->from('product_information')->where('product_id', $product_id)->get()->row()->product_name;

        $data = array(
            'title' => display('products_balance'),
            'products_balance' => $products_balance,
            'store_list' => $store_list,
            'date_from' => $from_date,
            'date_to' => $to_date,
            'store_id' => $store_id,
            'product_id' => $product_id,
            'product_name' => $product_name
        );
        // echo "<pre>";print_r($data['products_balance']);exit;


        $reportList = $CI->parser->parse('dashboard/report/products_balance', $data, true);
        return $reportList;
    }
}
