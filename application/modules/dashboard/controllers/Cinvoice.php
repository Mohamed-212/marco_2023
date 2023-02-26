<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cinvoice extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('dashboard/Invoices'));
        $this->load->library('dashboard/linvoice');
        $this->load->library('dashboard/occational');
    }

    //Default invoice add from loading
    public function index()
    {
        $this->new_invoice();
    }

    //Add new invoice
    public function new_invoice()
    {
        // $products = $this->db->select('*')->from('product_information')->get()->result();
        // // echo "<pre>";
        // // var_dump($products);exit;
        // foreach ($products as $product) {
        //     $productModel = explode('-', $product->product_model);
        //     $modelOnly = trim($productModel[0]);
        //     $colorOnly = trim($productModel[1]);
        //     $colorOnly .= isset($productModel[2]) ? '-' . trim($productModel[2]) : '';

        //     $this->db->where('product_id', $product->product_id)
        //         ->update('product_information', [
        //             'product_color' => $colorOnly,
        //             'product_model_only' => $modelOnly,
        //             'product_model' => trim($product->product_model),
        //         ]);
        // }

        // exit;

        $this->permission->check_label('new_sale')->create()->redirect();
        if (check_module_status('accounting') == 1) {
            $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
            if (!empty($find_active_fiscal_year)) {
                $this->load->model(array(
                    'dashboard/Stores',
                    'dashboard/Variants',
                    'dashboard/Customers',
                    'dashboard/Shipping_methods'
                ));
                $store_list = $this->Stores->store_list();
                $variant_list = $this->Variants->variant_list();
                $shipping_methods = $this->Shipping_methods->shipping_method_list();
                $customer = $this->Customers->customer_list();
                $bank_list = $this->Invoices->bank_list();
                $payment_info = $this->Invoices->payment_info();
                $all_pri_type = $this->Invoices->select_all_pri_type();
                $summary = $this->Customers->customer_transection_summary($customer[0]['customer_id'], null, null);
                $data = array(
                    'title' => display('new_invoice'),
                    'store_list' => $store_list,
                    'variant_list' => $variant_list,
                    'customer' => $customer[0],
                    'shipping_methods' => $shipping_methods,
                    'bank_list' => $bank_list,
                    'payment_info' => $payment_info,
                    'employee' => $this->empdropdown(),
                    'all_pri_type' => $all_pri_type,
                    'total_balance'	=> round($summary[1][0]['total_debit']-$summary[0][0]['total_credit'], 2),
                );
                $data['module'] = "dashboard";
                $data['page'] = "invoice/add_invoice_form";
                echo Modules::run('template/layout', $data);
            } else {
                $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                redirect(base_url('Admin_dashboard'));
            }
        } else {
            $this->load->model(array(
                'dashboard/Stores',
                'dashboard/Variants',
                'dashboard/Customers',
                'dashboard/Shipping_methods'
            ));
            $store_list = $this->Stores->store_list();
            $variant_list = $this->Variants->variant_list();
            $shipping_methods = $this->Shipping_methods->shipping_method_list();
            $customer = $this->Customers->customer_list();
            $bank_list = $this->Invoices->bank_list();
            $data = array(
                'title' => display('new_invoice'),
                'store_list' => $store_list,
                'variant_list' => $variant_list,
                'customer' => $customer[0],
                'shipping_methods' => $shipping_methods,
                'bank_list' => $bank_list,
            );
            $data['module'] = "dashboard";
            $data['page'] = "invoice/add_invoice_form";
            echo Modules::run('template/layout', $data);
        }
    }

    public function empdropdown()
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $query = $this->db->get();
        $data = $query->result();

        $list = array('' => 'Select One...');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->first_name . " " . $value->last_name;
            }
        }
        return $list;
    }

    public function manage_invoice()
    {
        $this->permission->check_label('manage_sale')->read()->redirect();
        $filter = array(
            'invoice_no' => $this->input->get('invoice_no', TRUE),
            'employee_id' => $this->input->get('employee_id', TRUE),
            'customer_id' => $this->input->get('customer_id', TRUE),
            'from_date' => $this->input->get('from_date', TRUE),
            'to_date' => $this->input->get('to_date', TRUE),
            'invoice_status' => $this->input->get('invoice_status', TRUE)
        );
        $config["base_url"] = base_url('dashboard/Cinvoice/manage_invoice');
        $config["total_rows"] = $this->Invoices->count_invoice_list($filter);
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
        $config["num_links"] = 5;
        /* This Application Must Be Used With BootStrap 3 * */
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
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $links = $this->pagination->create_links();
        $invoices_list = $this->Invoices->get_invoice_list($filter, $page, $config["per_page"]);
        if (!empty($invoices_list)) {
            foreach ($invoices_list as $k => $v) {
                $invoices_list[$k]['final_date'] = $this->occational->dateConvert($invoices_list[$k]['date']);
            }
            $i = 0;
            foreach ($invoices_list as $k => $v) {
                $i++;
                $invoices_list[$k]['sl'] = $i;
            }
        }
        $this->load->model(array('dashboard/Soft_settings', 'dashboard/Customers'));
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('manage_invoice'),
            'invoices_list' => $invoices_list,
            'employees' => $this->empdropdown(),
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'links' => $links
        );

        $data['module'] = "dashboard";
        $data['page'] = "invoice/invoice";
        echo Modules::run('template/layout', $data);
    }

    //Insert new invoice
    public function insert_invoice()
    {
        if ($this->input->post('due_amount', TRUE) > 0 && $this->input->post('is_installment', TRUE) == 0) {
            $this->session->set_userdata(array('error_message' => display('choose_installment_if_invoice_not_full_paid')));
            $this->index();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('product_id[]', display('product_id'), 'required');
            // $this->form_validation->set_rules('variant_id[]', display('variant'), 'required');
            // $this->form_validation->set_rules('batch_no[]', display('batch_no'), 'required');
            $this->form_validation->set_rules('employee_id', display('employee_id'), 'required');

            $this->form_validation->set_rules('available_quantity[]', display('available_quantity'), 'required|greater_than[0]');
            $this->form_validation->set_rules('product_quantity[]', display('quantity'), 'required|greater_than[0]');

            if ($this->form_validation->run() == false) {
                $this->session->set_userdata(array('error_message' => display('failed_try_again')));
                // $this->index();
                $this->new_invoice();
            } else {
                $invoice_id = $this->Invoices->invoice_entry();
                $this->session->set_userdata(array('message' => display('successfully_added')));
                if ($this->input->post('pos', TRUE) === 'pos') {
                    redirect('dashboard/Cinvoice/pos_invoice_inserted_data_redirect/' . $invoice_id . '?place=pos');
                } else {
                    redirect('dashboard/Cinvoice/invoice_inserted_data/' . $invoice_id);
                }
            }
        }
    }

    public function insert_posInvoice()
    {
        $invoice_id = $this->Invoices->pos_invoice_entry();
        $this->session->set_userdata(array('message' => display('successfully_added')));
        redirect('dashboard/Cinvoice/pos_invoice_inserted_data_redirect/' . $invoice_id . '?place=pos');
    }

    //Invoice Update Form
    public function invoice_update_form($invoice_id)
    {
        $this->permission->check_label('manage_sale')->update()->redirect();
        $content = $this->linvoice->invoice_edit_data($invoice_id);
        $this->template_lib->full_admin_html_view($content);
    }

    // Invoice Update
    public function invoice_update()
    {
        $this->permission->check_label('manage_sale')->update()->redirect();

        $invoice_id = $this->Invoices->update_invoice();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect('dashboard/cinvoice/invoice_inserted_data/' . $invoice_id);
    }

    //Retrive right now inserted data to cretae html
    public function invoice_inserted_data($invoice_id)
    {
        $content = $this->linvoice->invoice_html_data($invoice_id);
        $this->template_lib->full_admin_html_view($content);
    }

    public function invoice_inserted_data_pdf($invoice_id)
    {
        $this->load->model('dashboard/Invoices');
        $this->load->model('dashboard/Soft_settings');
        $this->load->library('dashboard/occational');
        $this->load->model('dashboard/Shipping_methods');
        $invoice_detail = $this->Invoices->retrieve_invoice_html_data($invoice_id);
        $order_no = $this->db->select('b.order as order_no')->from('invoice a')->where('a.order_id', $invoice_detail[0]['order_id'])->join('order b', 'a.order_id = b.order_id', 'left')->get()->result();
        $cardpayments = $this->Invoices->get_invoice_card_payments($invoice_id);
        $shipping_method = $this->Shipping_methods->shipping_method_search_item($invoice_detail[0]['shipping_method']);
        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;

        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $this->occational->dateConvert($invoice_detail[$k]['date']);
                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];
            }
            $i = 0;
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
            }
        }

        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Invoices->retrieve_company();

        $data = array(
            'title' => display('invoice_details'),
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'invoice_no' => $invoice_detail[0]['invoice'],
            'customer_id' => $invoice_detail[0]['customer_id'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'customer_mobile' => $invoice_detail[0]['customer_mobile'],
            'customer_email' => $invoice_detail[0]['customer_email'],
            'store_id' => $invoice_detail[0]['store_id'],
            'vat_no' => $invoice_detail[0]['vat_no'],
            'cr_no' => $invoice_detail[0]['cr_no'],
            'customer_address' => $invoice_detail[0]['customer_address_1'],
            'final_date' => $invoice_detail[0]['final_date'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'total_discount' => $invoice_detail[0]['total_discount'],
            'invoice_discount' => $invoice_detail[0]['invoice_discount'],
            'service_charge' => $invoice_detail[0]['service_charge'],
            'shipping_charge' => $invoice_detail[0]['shipping_charge'],
            'shipping_method' => @$shipping_method[0]['method_name'],
            'paid_amount' => $invoice_detail[0]['paid_amount'],
            'due_amount' => $invoice_detail[0]['due_amount'],
            'invoice_details' => $invoice_detail[0]['invoice_details'],
            'subTotal_quantity' => $subTotal_quantity,
            'invoice_all_data' => $invoice_detail,
            'order_no' => $order_no,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'ship_customer_short_address' => $invoice_detail[0]['ship_customer_short_address'],
            'ship_customer_name' => $invoice_detail[0]['ship_customer_name'],
            'ship_customer_mobile' => $invoice_detail[0]['ship_customer_mobile'],
            'ship_customer_email' => $invoice_detail[0]['ship_customer_email'],
            'cardpayments' => $cardpayments,
        );
        $data['Soft_settings'] = $this->Soft_settings->retrieve_setting_editdata();
        $chapterList = $this->parser->parse('dashboard/invoice/invoice_html_pdf', $data, true);

        $this->load->library('pdfgenerator');
        $file_path = $this->pdfgenerator->generate($chapterList);
    }

    public function invoice_pdf_data($invoice_id)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');
        $CI->load->model('dashboard/Shipping_methods');
        $invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);
        $order_no = $CI->db->select('b.order as order_no')->from('invoice a')->where('a.order_id', $invoice_detail[0]['order_id'])->join('order b', 'a.order_id = b.order_id', 'left')->get()->result();
        $cardpayments = $CI->Invoices->get_invoice_card_payments($invoice_id);
        $shipping_method = $CI->Shipping_methods->shipping_method_search_item($invoice_detail[0]['shipping_method']);
        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;

        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);
                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];
            }
            $i = 0;
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
            }
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info = $CI->Invoices->retrieve_company();

        $data = array(
            'title' => display('invoice_details'),
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'invoice_no' => $invoice_detail[0]['invoice'],
            'customer_id' => $invoice_detail[0]['customer_id'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'customer_mobile' => $invoice_detail[0]['customer_mobile'],
            'customer_email' => $invoice_detail[0]['customer_email'],
            'store_id' => $invoice_detail[0]['store_id'],
            'vat_no' => $invoice_detail[0]['vat_no'],
            'cr_no' => $invoice_detail[0]['cr_no'],
            'customer_address' => $invoice_detail[0]['customer_address_1'],
            'final_date' => $invoice_detail[0]['final_date'],
            'total_amount' => $invoice_detail[0]['total_amount'],
            'total_discount' => $invoice_detail[0]['total_discount'],
            'invoice_discount' => $invoice_detail[0]['invoice_discount'],
            'service_charge' => $invoice_detail[0]['service_charge'],
            'shipping_charge' => $invoice_detail[0]['shipping_charge'],
            'shipping_method' => @$shipping_method[0]['method_name'],
            'paid_amount' => $invoice_detail[0]['paid_amount'],
            'due_amount' => $invoice_detail[0]['due_amount'],
            'invoice_details' => $invoice_detail[0]['invoice_details'],
            'subTotal_quantity' => $subTotal_quantity,
            'invoice_all_data' => $invoice_detail,
            'order_no' => $order_no,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
            'ship_customer_short_address' => $invoice_detail[0]['ship_customer_short_address'],
            'ship_customer_name' => $invoice_detail[0]['ship_customer_name'],
            'ship_customer_mobile' => $invoice_detail[0]['ship_customer_mobile'],
            'ship_customer_email' => $invoice_detail[0]['ship_customer_email'],
            'cardpayments' => $cardpayments,
        );
        $data['Soft_settings'] = $CI->Soft_settings->retrieve_setting_editdata();
        $chapterList = $CI->parser->parse('dashboard/invoice/invoice_html', $data, true);
        $this->load->library('pdfgenerator');
        $file_path = $this->pdfgenerator->generate_order($order_id, $chapterList);
    }

    //POS invoice page load
    public function pos_invoice()
    {
        $this->permission->check_label('pos_sale')->read()->redirect();
        $content = $this->linvoice->pos_invoice_add_form();
        $this->template_lib->full_admin_html_view($content);
    }

    //Insert pos invoice
    public function insert_pos_invoice()
    {
        $product_id = urldecode($this->input->post('product_id', TRUE)); //barcode
        $store_id = $this->input->post('store_id', TRUE);
        $stok_report = $this->Invoices->stock_report_bydate_pos($product_id);
        if ($stok_report > 0) {
            $product_details = $this->Invoices->get_total_product($product_id);
            $html = "";
            if (!empty($product_details['variant'])) {
                $html = $product_details['variant'];
            }
            $batch_no = $this->Invoices->get_product_batches($product_id, $store_id);
            if (!empty($batch_no)) {
                $html2 = $batch_no;
            }
            $tr = " ";
            $order = " ";
            $bill = " ";
            if (!empty($product_details)) {
                $product_id = $this->auth->generator(5);

                $colorhtml = '';
                if (!empty($product_details['colorhtml'])) {
                    $colorhtml = "<select name=\"color_variant[]\" id=\"variant_color_" . $product_id . "\" class=\"form-control variant_color width_80\" >" . $product_details['colorhtml'] . "</select>";
                }

                $tr .= "<tr id='" . $product_id . "'>

				<th id=\"product_name_" . $product_id . "\"><input type=\"text\" name=\"product_name\" class=\"form-control productSelection \" value=\"" . $product_details['product_name'] . "\" placeholder=\"Product Name\" required readonly> </th>
				<td>
				<script>
				$(\"select.form-control:not(.dont-select-me)\").select2({
					placeholder: \"Select option\",
					allowClear: true
					});
					</script>
					<input type=\"hidden\" class=\"sl\" value='" . $product_id . "'>
					<input type=\"hidden\" class=\"product_id_" . $product_id . "\" value='" . $product_details['product_id'] . "'>
					<select name=\"variant_id[]\" id=\"variant_id_" . $product_id . "\" class=\"form-control variant_id width_80\" required=\"\">" . $html . "</select> 
                    " . $colorhtml . "
					</td>
                    <td>
                    <select name=\"batch_no[]\" id=\"batch_no" . $product_id . "\" class=\"form-control batch_no width_80\" required=\"\">" . $html2 . "</select>
                    </td>
					<td>
					<input type=\"text\" name=\"available_quantity[]\" id=\"avl_qntt_" . $product_id . "\" 
                class=\"form-control text-right  available_quantity_" . $product_id . "\" value=\"0\" readonly=\"readonly\"/>
					</td>
					<td width=\"\">
					<input type=\"hidden\" class=\"form-control product_id_" . $product_id . "\" name=\"product_id[]\" value = '" . $product_details['product_id'] . "' id=\"product_id_" . $product_id . "\"/>

					<input type=\"text\" name=\"product_rate[]\" value='" . $product_details['price'] . "' id=\"price_item_" . $product_id . "\" class=\"price_item " . $product_id . " form-control text-right\" min=\"0\" readonly=\"readonly\"/>

					<input type=\"hidden\" name=\"\" id=\"\" class=\"form-control text-right unit_" . $product_id . "\" value='" . $product_details['unit'] . "' readonly=\"readonly\" />

					<input type=\"hidden\" name=\"discount[]\" id=\"discount_" . $product_id . "\" class=\"form-control text-right\" value ='" . $product_details['discount'] . "' min=\"0\"/>
					</td>
					<td scope=\"row\">
					<input type=\"number\" name=\"product_quantity[]\"   onchange=\"quantity_limit('" . $product_id . "')\" onkeyup=\"quantity_calculate('"
                    . $product_id . "');\" onchange=\"quantity_calculate('" . $product_id . "');\" id=\"total_qntt_" . $product_id . "\" class=\"form-control text-right \" value=\"1\" min=\"1\"/>
					</td>
					<td width=\"\">
					<input class=\"total_price form-control text-right \" type=\"text\" name=\"total_price[]\" id=\"total_price_" . $product_id . "\" value='" . $product_details['price'] . "'  readonly=\"readonly\"/>
					</td>

					<td width:\"300\">";

                $this->db->select('*');
                $this->db->from('tax');
                $this->db->order_by('tax_name', 'asc');
                $tax_information = $this->db->get()->result();

                if (!empty($tax_information)) {
                    foreach ($tax_information as $k => $v) {
                        if ($v->tax_id == '52C2SKCKGQY6Q9J') {
                            $tax['cgst_name'] = $v->tax_name;
                            $tax['cgst_id'] = $v->tax_id;
                            $tax['cgst_status'] = $v->status;
                        } elseif ($v->tax_id == 'H5MQN4NXJBSDX4L') {
                            $tax['sgst_name'] = $v->tax_name;
                            $tax['sgst_id'] = $v->tax_id;
                            $tax['sgst_status'] = $v->status;
                        } elseif ($v->tax_id == '5SN9PRWPN131T4V') {
                            $tax['igst_name'] = $v->tax_name;
                            $tax['igst_id'] = $v->tax_id;
                            $tax['igst_status'] = $v->status;
                        }
                    }
                }

                if ($tax['cgst_status'] == 1) {

                    $tr .= "<input type=\"hidden\" id=\"cgst_" . $product_id . "\" class=\"cgst\" value='" . $product_details['cgst_tax'] . "'/>
						<input type=\"hidden\" id=\"total_cgst_" . $product_id . "\" class=\"total_cgst\" name=\"cgst[]\" value='" . $product_details['cgst_tax'] * $product_details['price'] . "'/>
						<input type=\"hidden\" name=\"cgst_id[]\" id=\"cgst_id_" . $product_id . "\" value='" . $product_details['cgst_id'] . "'/>";
                }
                if ($tax['sgst_status'] == 1) {

                    $tr .= "<input type=\"hidden\" id=\"sgst_" . $product_id . "\" class=\"sgst\" value='" . $product_details['sgst_tax'] . "'/>
						<input type=\"hidden\" id=\"total_sgst_" . $product_id . "\" class=\"total_sgst\" name=\"sgst[]\" value='" . $product_details['sgst_tax'] * $product_details['price'] . "'/>
						<input type=\"hidden\" name=\"sgst_id[]\" id=\"sgst_id_" . $product_id . "\" value='" . $product_details['sgst_id'] . "'/>";
                }
                if ($tax['igst_status'] == 1) {

                    $tr .= "<input type=\"hidden\" id=\"igst_" . $product_id . "\" class=\"igst\" value='" . $product_details['igst_tax'] . "'/>
						<input type=\"hidden\" id=\"total_igst_" . $product_id . "\" class=\"total_igst\" name=\"igst[]\" value='" . $product_details['igst_tax'] * $product_details['price'] . "'/>
						<input type=\"hidden\" name=\"igst_id[]\" id=\"igst_id_" . $product_id . "\" value='" . $product_details['igst_id'] . "'/>";
                }

                $tr .= "<input type=\"hidden\" id=\"total_discount_" . $product_id . "\" class=\"\" />
					<input type=\"hidden\" id=\"all_discount_" . $product_id . "\" class=\"total_discount\"/>



					<a href=\"#\" class=\"ajax_modal btn btn-primary btn-xs m-r-2\" data-toggle=\"modal\" data-target=\"#myModal\"><i class=\"fa fa-pencil\" data-toggle=\"tooltip\" data-placement=\"left\" title='" . display('edit') . "'></i></a>

					<a href=\"#\" class=\"btn btn-danger btn-xs\" data-toggle=\"tooltip\" data-placement=\"top\" title='" . display('delete') . "' onclick=\"deletePosRow('" . $product_id . "')\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>
					</td>
					</tr>";

                $order .= "<tr class='" . $product_id . "' data-item-id='" . $product_id . "'>
					<td>0</td>
					<td>" . $product_details['product_model'] . "-" . $product_details['product_name'] . "</td>
					<td id='quantity_" . $product_id . "'>[ 1 ]</td>
					</tr>";

                $bill .= "<tr class='" . $product_id . "' data-item-id='" . $product_id . "'>
					<td>0</td>
					<td colspan=\"2\" class=\"no-border\">" . $product_details['product_model'] . "-" . $product_details['product_name'] . "</td>
					<td class='qnt_price_" . $product_id . "'>(1 x " . $product_details['price'] . ")</td>
					<td class='total_price_bill_" . $product_id . " text-right'>" . $product_details['price'] . "</td>
					</tr>";

                echo json_encode(array(
                    'item' => $tr,
                    'order' => $order,
                    'bill' => $bill,
                    'product_id' => $product_id
                ));
            } else {
                echo json_encode(array(
                    'item' => 0
                ));
            }
        } else {
            echo json_encode(array(
                'item' => 0
            ));
        }
    }

    //Retrive right now inserted data to cretae html
    public function pos_invoice_inserted_data($invoice_id)
    {
        $this->permission->check_label('pos_sale')->read()->redirect();
        $content = $this->linvoice->pos_invoice_html_data($invoice_id);
        $this->template_lib->full_admin_html_view($content);
    }

    public function pos_invoice_inserted_data_redirect($invoice_id)
    {

        $this->load->library('dashboard/linvoice');
        $this->linvoice->pos_invoice_html_data_redirect($invoice_id);
    }

    // Retrieve product data
    public function retrieve_product_data()
    {
        $product_id = $this->input->post('product_id', TRUE);
        $product_info = $this->Invoices->get_total_product($product_id);
        echo json_encode($product_info);
    }

    // Retrieve product data
    public function retrieve_product_all_data()
    {
        $product_id = $this->input->post('product_id', TRUE);
        $product_info = $this->Invoices->get_total_product_data($product_id);
        echo json_encode($product_info);
    }

    //purchase search by model
    public function product_search_by_model()
    {
        $model = $this->input->post('term', TRUE);
        $query = $this->db->query("SELECT * FROM `product_information` WHERE (`product_model` LIKE '%" . $model . "%')");
        $product_info = $query->result_array();
        $json_product = [];
        foreach ($product_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id']);
        }
        echo json_encode($json_product);
    }

    // Invoice Delete
    public function invoice_delete($invoice_id)
    {
        $this->permission->check_label('manage_sale')->delete()->redirect();

        $result = $this->Invoices->delete_invoice($invoice_id);
        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_delete')));
        } else {
            $this->session->set_userdata(array('error_message' => display('failed_try_again')));
        }
        redirect('dashboard/Cinvoice/manage_invoice');
    }

    //AJAX INVOICE STOCK Check
    public function product_stock_check($product_id)
    {

        $purchase_stocks = $this->Invoices->get_total_purchase_item($product_id);
        $total_purchase = 0;
        if (!empty($purchase_stocks)) {
            foreach ($purchase_stocks as $k => $v) {
                $total_purchase = ($total_purchase + $purchase_stocks[$k]['quantity']);
            }
        }
        $sales_stocks = $this->Invoices->get_total_sales_item($product_id);
        $total_sales = 0;
        if (!empty($sales_stocks)) {
            foreach ($sales_stocks as $k => $v) {
                $total_sales = ($total_sales + $sales_stocks[$k]['quantity']);
            }
        }

        $final_total = ($total_purchase - $total_sales);
        return $final_total;
    }

    //Search product by product name and category
    public function search_product()
    {
        $product_name = $this->input->post('product_name', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        $product_search = $this->Invoices->product_search($product_name, $category_id);
        $base_url = base_url();
        if ($product_search) {
            $prodhtml = '';
            foreach ($product_search as $product) {

                $prodhtml .= '<div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-p-3">
                    <div class="product-panel overflow-hidden border-0 shadow-sm select_product">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="' . base_url() . (!empty($product->image_thumb) ? $product->image_thumb : 'assets/img/icons/default.jpg') . '" class="img-responsive" alt="">
                            <input type="hidden" name="select_product_id" class="select_product_id" value="' . html_escape(urldecode($product->product_id)) . '">
                        </div>
                        <div class="panel-footer border-0 bg-white">
                            <h3 class="item-details-title">' . html_escape($product->product_name . '-(' . $product->product_model) . ')' . '</h3>
                        </div>
                    </div>
                </div>';
            }
            echo $prodhtml;
        } else {
            echo "420";
        }
    }

    //Insert new customer
    public function insert_customer()
    {
        $customer_id = generator(15);
        //Customer  basic information adding.
        $data = array(
            'customer_id' => $customer_id,
            'customer_name' => $this->input->post('customer_name', TRUE),
            'customer_mobile' => $this->input->post('mobile', TRUE),
            'customer_email' => $this->input->post('email', TRUE),
            'status' => 1
        );
        $result = $this->Invoices->customer_entry($data);
        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
            redirect(base_url('dashboard/Cinvoice/pos_invoice'));
        } else {
            $this->session->set_userdata(array('error_message' => display('already_exists')));
            redirect(base_url('dashboard/Cinvoice/pos_invoice'));
        }
    }

    public function change_stock($invoice_id)
    {
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
    }

    public function change_inv_stock($invoice_id)
    {
        //find previous invoice history and REDUCE the stock
        $invoice_history = $this->db->select('*')->from('invoice_details')->where('invoice_id', $invoice_id)->get()->result_array();
        if (count($invoice_history) > 0) {
            foreach ($invoice_history as $invoice_item) {
                //update
                $check_stock = $this->check_inv_stock($invoice_item['store_id'], $invoice_item['product_id'], $invoice_item['variant_id'], $invoice_item['variant_color']);
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
    }

    public function check_inv_stock($store_id = null, $product_id = null, $variant = null, $variant_color = null)
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

    public function insert_loyalty_points($customer_id, $points)
    {
        $piting_status = $this->db->select('*')->from('loyalty_points_settings')->where('id', 1)->get()->row();
        if ($piting_status->status == 1) {
            // here will go the point insertion
            $chq_customer_points = $this->db->select('*')->from('loyalty_points')->where('customer_id', $customer_id)->get()->row();
            if (!empty($chq_customer_points)) {
                $points_data = array(
                    'total_points' => ($chq_customer_points->total_points + $points),
                    'current_points' => ($chq_customer_points->current_points + $points)
                );
                $this->db->where('customer_id', $customer_id)->update('loyalty_points', $points_data);
            } else {
                $points_data = array(
                    'customer_id' => $customer_id,
                    'total_points' => $points,
                    'current_points' => $points
                );
                $this->db->insert('loyalty_points', $points_data);
            }
        }
    }

    //Update status
    public function update_status($invoice_id)
    {
        $this->load->model('dashboard/Soft_settings');
        $invoice_status = $this->input->post('invoice_status', TRUE);
        $order_no = $this->input->post('order_no', TRUE);
        $order_id = $this->input->post('order_id', TRUE);
        $customer_id = $this->input->post('customer_id', TRUE);


        if ($invoice_status == 1) {
            $invoice_status_text = "Shipped"; //for send sms

            $this->db->select('a.*');
            $this->db->from('invoice a');
            $this->db->where('a.invoice_id', $invoice_id);
            $invoice_info = $this->db->get()->result_array();

            if (check_module_status('loyalty_points') == 1) {
                // here will go the point insertion
                $points_divisor = $this->db->select('*')->from('loyalty_points_settings')->where('id', 1)->get()->row();
                $points = floor($invoice_info[0]['total_amount'] / $points_divisor->amount);
                $this->insert_loyalty_points($customer_id, $points);
                // loyalty point insertion end
            }
        };
        if ($invoice_status == 5) {
            $invoice_status_text = "Processing"; //for send sms
        };
        if (($invoice_status == 2)) { //6== product cancel
            $this->change_stock($invoice_id);
            $invoice_status_text = "Cancelled"; //for send sms 
        }
        if (($invoice_status == 6)) { //6== product return
            if (check_module_status('accounting') == 1) {
                $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
                if (!empty($find_active_fiscal_year)) {




                    $this->db->select('a.*,b.*');
                    $this->db->from('invoice a');
                    $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');
                    $this->db->where('a.invoice_id', $invoice_id);
                    $invoice_info = $this->db->get()->result_array();
                    // change_stock
                    $this->change_inv_stock($invoice_id);
                    // change_stock
                    $invoice_no = $invoice_info[0]['invoice'];
                    $store_id = $invoice_info[0]['store_id'];
                    $product_id_array = array_column($invoice_info, 'product_id');
                    $variant_id_array = array_column($invoice_info, 'variant_id');
                    $variant_color_array = array_column($invoice_info, 'variant_color');
                    $batch_no_array = array_column($invoice_info, 'batch_no');
                    $quantity_array = array_column($invoice_info, 'quantity');
                    $customer_id = $invoice_info[0]['customer_id'];

                    $chq_wastage = $this->db->select('id')->from('wastage_request')->where('invoice_id', $invoice_id)->get();
                    $chq_return = $this->db->select('id')->from('return_request')->where('invoice_id', $invoice_id)->get();
                    if ($chq_wastage->num_rows() <= 0 && $chq_return->num_rows() <= 0) {

                        // return_request
                        $data = array(
                            'order_id' => $invoice_info[0]['order_id'],
                            'invoice_id' => $invoice_info[0]['invoice_id'],
                            'customer_id' => $customer_id,
                            'note' => $this->input->post('note', true),
                            'status' => 0,
                        );
                        $result = $this->db->insert('return_request', $data);
                        //return_request
                        $request_id = $this->db->insert_id();
                        $cogs = 0;
                        $price_before_discount = 0;
                        $subtotal_price = 0;
                        // return_request_products
                        foreach ($product_id_array as $key => $product_id) {
                            $this->db->select('a.total_price,a.supplier_rate,a.rate,a.discount,b.price');
                            $this->db->from('invoice_details a');
                            $this->db->where('a.invoice_id', $invoice_id);
                            $this->db->where('a.product_id', $product_id);
                            $this->db->join('product_information b', 'b.product_id = a.product_id');
                            if (!empty($variant_id_array[$key])) {
                                $this->db->where('variant_id', $variant_id_array[$key]);
                            }
                            if (!empty($variant_color_array[$key])) {
                                $this->db->where('variant_color', $variant_color_array[$key]);
                            }
                            $product_total = $this->db->get()->row();
                            $subtotal_price += $product_total->total_price;
                            $cogs += ($product_total->supplier_rate * $quantity_array[$key]);
                            $price_before_discount += ($product_total->rate * $quantity_array[$key]);

                            $requested_data = array(
                                'request_id' => $request_id,
                                'product_id' => $product_id,
                                'batch_no' => $batch_no_array[$key],
                                'variant_id' => $variant_id_array[$key],
                                'variant_color' => $variant_color_array[$key],
                                'qty' => $quantity_array[$key],
                            );
                            $submit = $this->db->insert('return_request_products', $requested_data);
                        }
                        // return_request_products
                        if ($result) {

                            //start sales return invoice
                            $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();
                            $store_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('store_id', $store_id)->get()->row();
                            $createdate = date('Y-m-d H:i:s');
                            $receive_by = $this->session->userdata('user_id');
                            $date = date('Y-m-d');

                            $invoice_info = $this->db->select('total_discount,total_vat,invoice_discount')->from('invoice')->where('invoice_id', $invoice_id)->get()->row();


                            $total_price_before_discount = $price_before_discount;
                            $total_vat = (!empty($invoice_info->total_vat) ? $invoice_info->total_vat : 0);
                            $total_discount = ((!empty($invoice_info->invoice_discount) ? $invoice_info->invoice_discount : 0) + (!empty($invoice_info->total_discount) ? $invoice_info->total_discount : 0));
                            $total_with_vat = ($total_price_before_discount - $total_discount) + $total_vat;
                            $cogs = $cogs;

                            //1st debit (Sales return for Showroom sales) with total price before discount
                            $store_debit = array(
                                'fy_id' => $find_active_fiscal_year->id,
                                'VNo' => 'SR-' . $request_id,
                                'Vtype' => 'Sales return',
                                'VDate' => $date,
                                'COAID' => 5121, // account payable game 11
                                'Narration' => 'Sales return for Showroom sales "total price before discount" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                                'Debit' => $total_price_before_discount,
                                'Credit' => 0,
                                'IsPosted' => 1,
                                'CreateBy' => $receive_by,
                                'CreateDate' => $createdate,
                                'IsAppove' => 1
                            );

                            //2nd debit (vat) with total vat
                            $vat_debit = array(
                                'fy_id' => $find_active_fiscal_year->id,
                                'VNo' => 'SR-' . $request_id,
                                'Vtype' => 'Sales return',
                                'VDate' => $date,
                                'COAID' => 2114, // account payable game 11
                                'Narration' => 'Sales return "total vat" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                                'Debit' => $total_vat,
                                'Credit' => 0,
                                'IsPosted' => 1,
                                'CreateBy' => $receive_by,
                                'CreateDate' => $createdate,
                                'IsAppove' => 1
                            );
                            //3rd credit (customer) with grand total amount
                            $customer_credit = array(
                                'fy_id' => $find_active_fiscal_year->id,
                                'VNo' => 'SR-' . $request_id,
                                'Vtype' => 'Sales return',
                                'VDate' => $date,
                                'COAID' => $customer_head->HeadCode,
                                'Narration' => 'Sales return" total with vat" debit by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                                'Debit' => 0,
                                'Credit' => $total_with_vat,
                                'IsPosted' => 1,
                                'CreateBy' => $receive_by,
                                'CreateDate' => $createdate,
                                'IsAppove' => 1
                            );
                            //4th credit (Allowed Discount) with total discount
                            $allowed_discount_credit = array(
                                'fy_id' => $find_active_fiscal_year->id,
                                'VNo' => 'SR-' . $request_id,
                                'Vtype' => 'Sales return',
                                'VDate' => $date,
                                'COAID' => 4114,
                                'Narration' => 'Sales return "total discount" debit by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                                'Debit' => 0,
                                'Credit' => $total_discount,
                                'IsPosted' => 1,
                                'CreateBy' => $receive_by,
                                'CreateDate' => $createdate,
                                'IsAppove' => 1
                            );

                            //5th cogs debit (Main Warehouse) with COGS amount
                            $store_cogs_Debit = array(
                                'fy_id' => $find_active_fiscal_year->id,
                                'VNo' => 'SR-' . $request_id,
                                'Vtype' => 'Sales return',
                                'VDate' => $date,
                                'COAID' => 1141,
                                'Narration' => 'Sales return "COGS" debited in Main Warehouse by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                                'Debit' => $cogs,
                                'Credit' => 0,
                                'IsPosted' => 1,
                                'CreateBy' => $receive_by,
                                'CreateDate' => $createdate,
                                'IsAppove' => 1
                            );

                            //6th credit Cost of Goods Sold (cogs) with COGS amount
                            $cogs_credit = array(
                                'fy_id' => $find_active_fiscal_year->id,
                                'VNo' => 'SR-' . $request_id,
                                'Vtype' => 'Sales return',
                                'VDate' => $date,
                                'COAID' => 4111,
                                'Narration' => 'Sales return inventory "COGS" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                                'Debit' => 0,
                                'Credit' => $cogs,
                                'IsPosted' => 1,
                                'CreateBy' => $receive_by,
                                'CreateDate' => $createdate,
                                'IsAppove' => 1
                            );

                            // debit
                            $this->db->insert('acc_transaction', $store_debit);
                            $this->db->insert('acc_transaction', $vat_debit);
                            // credit
                            $this->db->insert('acc_transaction', $customer_credit);
                            $this->db->insert('acc_transaction', $allowed_discount_credit);
                            // cogs
                            $this->db->insert('acc_transaction', $store_cogs_Debit);
                            $this->db->insert('acc_transaction', $cogs_credit);
                            //end sales return invoice

                            $invoice_status_text = "Returned";

                            $this->session->set_userdata(array('message' => display('successfully_returned')));
                        } else {
                            $this->session->set_userdata(array('error_message' => display('failed_try_again')));
                        }
                    } else {
                        $this->session->set_userdata(array('error_message' => display('already_requested')));
                        redirect('dashboard/Cinvoice/manage_invoice');
                    }
                } else {
                    $this->session->set_userdata(array('error_message' => display('no_active_fiscal_year_found')));
                    redirect(base_url('Admin_dashboard'));
                }
            } else {
                $this->change_stock($invoice_id);
                $invoice_status_text = "Returned"; //for send sms
            }
        }

        //Update invoice status
        $this->db->set('invoice_status', $invoice_status);
        $this->db->where('invoice_id', $invoice_id);
        $result = $this->db->update('invoice');

        // Woocommerce stock update if order invoice is completed
        if ($invoice_status == 4) {
            // trans status
            $VNo = 'Inv-' . $invoice_id;
            $transdata = array('IsAppove' => 1);
            $this->db->where('VNo', $VNo);
            $this->db->update('acc_transaction', $transdata);
            // trans status
            if (check_module_status('woocommerce')) {
                $this->load->library('woocommerce/woolib/woo_lib');
                $this->load->model('woocommerce/woo_model');
                $this->woo_lib->connection();
                // Check woo setting to update stock for local selling
                $woo_sett = $this->woo_model->get_settings();
                if (isset($woo_sett['woo_stock_update']) && !empty($woo_sett['woo_stock_update'])) {
                    $invinfo = $this->woo_model->get_invoice_info_by_id($invoice_id); // get invoice info
                    if (!empty($invinfo) && !empty($invinfo->default_status)) {  // Stock update only for default store
                        $invdetails = $this->woo_model->get_invoice_details_by_id($invoice_id); // invoice details
                        //inv details with sync data
                        if (!empty($invdetails)) {
                            $woo_stock = [];
                            foreach ($invdetails as $invitem) {
                                if (!empty($invitem->woo_product_id)) {

                                    $prod_stock = $this->woo_model->get_product_stock($invinfo->store_id, $invitem->product_id, $invitem->variant_id);
                                    if ($invitem->woo_product_type == 'variable') {  //If the product type is variable
                                        $varinfo = $this->woo_model->get_varsync_by_localvar($invitem->woo_product_id, $invitem->variant_id);
                                        if (!empty($varinfo->woo_variant_id)) {

                                            $varstock = array(
                                                'manage_stock' => TRUE,
                                                'stock_quantity' => $prod_stock,
                                                'stock_status' => ($prod_stock > 0 ? 'instock' : 'outofstock')
                                            );
                                            $this->woo_lib->put_request(array('param' => 'products/' . $invitem->woo_product_id . '/variations/' . $varinfo->woo_variant_id), $varstock);
                                        }
                                    } else {
                                        $woo_stock[] = array(
                                            'id' => $invitem->woo_product_id,
                                            'manage_stock' => TRUE,
                                            'stock_quantity' => $prod_stock,
                                            'stock_status' => ($prod_stock > 0 ? 'instock' : 'outofstock')
                                        );
                                    }
                                }
                            }

                            if (!empty($woo_stock)) { //update global stock
                                $this->woo_lib->post_request(array('param' => 'products/batch'), array('update' => $woo_stock));
                            }
                        }
                    }
                }

                // woo order status update
                $woo_ordersync = $this->woo_model->get_ordersync_byid($order_id);
                if (isset($woo_ordersync->woo_order_id) && !empty($woo_ordersync->woo_order_id)) {
                    $sync_order_data = array(
                        'status' => 'completed'
                    );
                    $this->woo_lib->put_request(array('param' => 'orders/' . $woo_ordersync->woo_order_id), $sync_order_data);
                }
            }
        }

        $setting_detail = $this->Soft_settings->retrieve_email_editdata();
        $sms_service = $this->Soft_settings->retrieve_setting_editdata();

        if ($result === true) {
            if ($sms_service[0]['sms_service'] == 1) {
                if ($invoice_status_text == "Processing" || $invoice_status_text == "Shipped") {
                    $this->load->model('web/Homes');
                    $this->Homes->send_sms($order_no, $customer_id, $invoice_status_text); //$invoice_status is type in send_sms method
                }
            }
            $subject = display("invoice_status");
            $message = $this->input->post('add_note', TRUE);

            $config = array(
                'protocol' => $setting_detail[0]['protocol'],
                'smtp_host' => $setting_detail[0]['smtp_host'],
                'smtp_port' => $setting_detail[0]['smtp_port'],
                'smtp_user' => $setting_detail[0]['sender_email'],
                'smtp_pass' => $setting_detail[0]['password'],
                'mailtype' => $setting_detail[0]['mailtype'],
                'charset' => 'utf-8'
            );

            $this->load->library('email');
            $this->email->initialize($config);

            $this->email->set_newline("\r\n");
            $this->email->from($setting_detail[0]['sender_email']);
            $this->email->to($this->input->post('customer_email', TRUE));
            $this->email->subject($subject);
            $this->email->message($message);

            $email = $this->test_input($this->input->post('customer_email', TRUE));
            $server_status = serverAliveOrNot($setting_detail[0]['smtp_host'], $setting_detail[0]['smtp_port']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($server_status && $this->email->send()) {
                    $this->session->set_userdata(array('message' => display('email_send_to_customer')));
                    redirect(base_url('dashboard/Cinvoice/manage_invoice'));
                } else {
                    $this->session->set_userdata(array('error_message' => display('email_not_send')));
                    redirect(base_url('dashboard/Cinvoice/manage_invoice'));
                }
            } else {
                $this->session->set_userdata(array('message' => display('successfully_updated')));
                redirect(base_url('dashboard/Cinvoice/manage_invoice'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('ooops_something_went_wrong')));
            redirect(base_url('dashboard/Cinvoice/manage_invoice'));
        }
    }

    //Email testing for email
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Search Inovoice Item
    public function search_inovoice_item()
    {

        $customer_id = $this->input->post('customer_id', TRUE);
        $content = $this->linvoice->search_inovoice_item($customer_id);
        $this->template_lib->full_admin_html_view($content);
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

    public function get_pos_product()
    {

        $per_page = $this->input->post('per_page', TRUE);
        $limit = $this->input->post('limit', TRUE);

        $products = $this->db->select('
                    a.product_id,a.product_name,a.price,a.image_thumb,a.variants,a.product_model,
                    c.category_name,c.category_id
                ')
            ->from('product_information a')
            ->join('product_category c', 'c.category_id = a.category_id', 'left')
            ->group_by('a.product_id')
            ->order_by('a.product_name', 'asc')
            ->limit($per_page, $limit)
            ->get()
            ->result();
        $html = '';

        foreach ($products as $product) {
            $html .= '<div class="col-xs-6 col-sm-4 col-md-2 col-p-3">
                    <div class="panel panel-bd product-panel select_product">
                        <div class="panel-body">
                            <img src="' . base_url() . (!empty($product->image_thumb) ? $product->image_thumb : 'assets/img/icons/default.jpg') . '"
                                 class="img-responsive"
                                 alt="">
                            <input type="hidden" name="select_product_id" class="select_product_id"
                                   value="' . $product->product_id . '">
                        </div>
                        <div class="panel-footer">' . $product->product_name . '-(' . $product->product_model . ')' . '</div>
                    </div>
                </div>';
        }

        echo $html;
    }

    // Pos Payment form
    public function get_pos_payment_form()
    {
        $grandtotal = $this->input->post('grandtotal', TRUE);
        $totalpaid = $this->input->post('totalpaid', TRUE);
        $more = $this->input->post('more', TRUE);
        if (!empty($more) && $more == 'more') {
            $grandtotal = floatval($grandtotal) - floatval($totalpaid);
        }

        $html = '';
        $row_id = mt_rand();
        $payment_info = $this->Invoices->payment_info();
        if (empty($more)) {
            $html .= '
            <div class="table-responsive">
                <table class="table table-bordered" id="payment_area_table">
                    <tr class="info">
                        <th>' . display('payment_method') . '</th>
                        <th>' . display('account_no') . '</th>
                        <th>' . display('pay_amount') . '</th>
                        <th>' . display('action') . '</th>
                    </tr>';
        }
        $html .= '<tr id="row_' . $row_id . '">
                        <td>
                            <div class="form-group row guifooterpanel">
                                <div class="col-sm-12">
                                        <select class="form-control dont-select-me" name="payment_id[]">';
        if ($payment_info) {
            foreach ($payment_info as $payment) {
                $html .= '<option value="' . $payment->HeadCode . '">' . $payment->HeadName . '</option>';
            }
        }
        $html .= '</select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group row guifooterpanel">
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="account_no[]"  placeholder="' . display('account_no') . '">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group row guifooterpanel">
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="payment_amount[]" value="' . $grandtotal . '" placeholder="' . display('pay_amount') . '">
                                </div>
                            </div>
                        </td>
                        <td>';
        if (empty($more)) {
            $html .= '<button class="btn btn-success" id="add_more_btn" ><i class="ti-plus"></i></button>';
        } else {
            $html .= '<button class="btn btn-danger del_more_btn" data-row_id="' . $row_id . '" ><i class="ti-minus"></i></button>';
        }
        $html .= '
                        </td>
                    </tr>';
        if (empty($more)) {
            $html .= '
                </table>
            </div>';
        }
        echo $html;
    }

    public function invoice_text()
    {
        $this->permission->check_label('invoice_text')->create()->redirect();
        $invoice_text_details = $this->db->select('*')->from('invoice_text_table')->get()->result();
        $data = array(
            'title' => display('invoice_text'),
            'invoice_text_details' => $invoice_text_details,
        );
        $data['module'] = "dashboard";
        $data['page'] = "invoice/invoice_text";
        echo Modules::run('template/layout', $data);
    }

    public function invoice_text_insert()
    {
        $this->permission->check_label('invoice_text')->update()->redirect();

        $invoice_text_details = $this->db->select('*')->from('invoice_text_table')->get()->result();
        if (empty($invoice_text_details)) {
            $data = array();
            $invoice_texts = $this->input->post('invoice_text', TRUE);
            foreach ($invoice_texts as $key => $invoice_text) {
                if (!empty($invoice_text)) {
                    $data[] = array(
                        'invoice_text' => $invoice_text
                    );
                }
            }
            $result = $this->db->insert_batch('invoice_text_table', $data);
        } else {
            $this->db->empty_table('invoice_text_table');
            $data = array();
            $invoice_texts = $this->input->post('invoice_text', TRUE);
            foreach ($invoice_texts as $key => $invoice_text) {
                if (!empty($invoice_text)) {
                    $data[] = array(
                        'invoice_text' => $invoice_text
                    );
                }
            }
            $result = $this->db->insert_batch('invoice_text_table', $data);
        }
        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_inserted')));
            return redirect(base_url('dashboard/Cinvoice/invoice_text'));
        } else {
            $this->session->set_userdata(array('error_message' => display('ooops_something_went_wrong')));
            return redirect(base_url('dashboard/Cinvoice/invoice_text'));
        }
    }

    public function order_export_csv()
    {
        $this->permission->check_label('order_csv_export')->read()->redirect();

        $this->form_validation->set_rules('order_date', display('date'), 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->load->library('export_csv');
            $order_date = $this->input->post('order_date', TRUE);
            $order_date = date('m-d-Y', strtotime($order_date));
            if (!$this->export_csv->index($order_date)) {
                $this->session->set_userdata(array('error_message' => display('ooops_order_list_is_empty')));
                return redirect(base_url('dashboard/Cinvoice/order_export_csv'));
            }
        }
        $data = array(
            'title' => display('order_csv_export')
        );
        $content = $this->parser->parse('dashboard/order_export/order_export_csv', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    public function pad_print_setting()
    {
        $this->permission->check_label('pad_print_setting')->create()->redirect();
        $pad_print_setting = $this->db->select('*')->from('pad_print_setting')->get()->row();
        $data = array(
            'title' => display('pad_print_setting'),
            'print_data' => $pad_print_setting,
        );
        $data['module'] = "dashboard";
        $data['page'] = "invoice/pad_print_setting";
        echo Modules::run('template/layout', $data);
    }

    public function pad_print_setting_insert()
    {
        $header = $this->input->post('header', TRUE);
        $footer = $this->input->post('footer', TRUE);
        $id = $this->input->post('id', TRUE);

        if (empty($id)) {
            $data = array(
                'header' => $header,
                'footer' => $footer,
            );
            $result = $this->db->insert('pad_print_setting', $data);
        } else {
            $data = array(
                'header' => $header,
                'footer' => $footer,
            );
            $result = $this->db->where('id', $id)->update('pad_print_setting', $data);
        }
        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_inserted')));
            return redirect(base_url('dashboard/Cinvoice/pad_print_setting'));
        } else {
            $this->session->set_userdata(array('error_message' => display('ooops_something_went_wrong')));
            return redirect(base_url('dashboard/Cinvoice/pad_print_setting'));
        }
    }

    public function captcha_print_setting()
    {
        $this->permission->check_label('captcha_print_setting')->create()->redirect();
        $captcha_print_setting = $this->db->select('*')->from('captcha_print_setting')->get()->row();
        $data = array(
            'title' => display('captcha_print_setting'),
            'print_data' => $captcha_print_setting,
        );
        $data['module'] = "dashboard";
        $data['page'] = "invoice/captcha_print_setting";
        echo Modules::run('template/layout', $data);
    }

    public function captcha_print_setting_insert()
    {
        $header = $this->input->post('header', TRUE);
        $id = $this->input->post('id', TRUE);

        if (empty($id)) {
            $data = array(
                'isActive' => $header,
            );
            $result = $this->db->insert('captcha_print_setting', $data);
        } else {
            $data = array(
                'isActive' => $header,
            );
            $result = $this->db->where('id', $id)->update('captcha_print_setting', $data);
        }
        if ($result) {
            $this->session->set_userdata(array('message' => display('successfully_inserted')));
            return redirect(base_url('dashboard/Cinvoice/captcha_print_setting'));
        } else {
            $this->session->set_userdata(array('error_message' => display('ooops_something_went_wrong')));
            return redirect(base_url('dashboard/Cinvoice/captcha_print_setting'));
        }
    }

    public function convert_number($number)
    {
        if ($number < 0) {
            $number = - ($number);
        }
        if (($number < 0) || ($number > 9999999999999)) {
            throw new Exception("Number is out of range");
        }
        $Gn = floor($number / 1000000);
        /* Millions (giga) */
        $number -= $Gn * 1000000;
        $kn = floor($number / 1000);
        /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);
        /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);
        /* Tens (deca) */
        $n = $number % 10;
        /* Ones */
        $res = "";
        if ($Gn) {
            $res .= $this->convert_number($Gn) . "Million";
        }
        if ($kn) {
            $res .= (empty($res) ? "" : " ") . $this->convert_number($kn) . " Thousand";
        }
        if ($Hn) {
            $res .= (empty($res) ? "" : " ") . $this->convert_number($Hn) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }
            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];
                if ($n) {
                    $res .= "-" . $ones[$n];
                }
            }
        }
        if (empty($res)) {
            $res = "zero";
        }
        return $res;
    }

    public function pad_invoice($invoice_id)
    {
        $this->load->model('dashboard/Soft_settings');
        $this->load->library('dashboard/occational');
        $invoice_detail = $this->Invoices->retrieve_invoice_html_data($invoice_id);
        $taxfield = $this->db->select('*')
            ->from('tax')
            ->where('status', 1)
            ->get()
            ->result_array();
        $txregname = '';
        foreach ($taxfield as $txrgname) {
            $regname = $txrgname['tax_name'] . ', ';
            $txregname .= $regname;
        }
        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        $subTotal_ammount = 0;
        $descript = 0;
        $isserial = 0;
        $isunit = 0;
        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $this->occational->dateConvert($invoice_detail[$k]['date']);
                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];
                $subTotal_ammount = $subTotal_ammount + $invoice_detail[$k]['total_price'];
            }
            $i = 0;
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
                if (!empty($invoice_detail[$k]['description'])) {
                    $descript = $descript + 1;
                }
                if (!empty($invoice_detail[$k]['serial_no'])) {
                    $isserial = $isserial + 1;
                }
                if (!empty($invoice_detail[$k]['unit'])) {
                    $isunit = $isunit + 1;
                }
            }
        }
        $totalbal = $invoice_detail[0]['total_amount'];
        $amount_inword = $this->convert_number($totalbal);
        $user_id = $invoice_detail[0]['user_id'];
        $users = $this->Invoices->user_invoice_data($user_id);
        $currency_details = $this->Soft_settings->retrieve_currency_info();
        $company_info = $this->Invoices->retrieve_company();
        $data = array(
            'title' => display('pad_print'),
            'invoice_id' => $invoice_detail[0]['invoice_id'],
            'invoice_no' => $invoice_detail[0]['invoice'],
            'customer_name' => $invoice_detail[0]['customer_name'],
            'customer_address' => $invoice_detail[0]['customer_short_address'],
            'customer_mobile' => $invoice_detail[0]['customer_mobile'],
            'customer_email' => $invoice_detail[0]['customer_email'],
            'final_date' => $invoice_detail[0]['final_date'],
            'print_setting' => $this->Invoices->pad_print_settingdata(),
            'invoice_details' => $invoice_detail[0]['invoice_details'],
            'total_amount' => number_format($totalbal, 2, '.', ','),
            'subTotal_cartoon' => $subTotal_cartoon,
            'subTotal_quantity' => $subTotal_quantity,
            'invoice_discount' => number_format($invoice_detail[0]['invoice_discount'], 2, '.', ','),
            'total_discount' => number_format($invoice_detail[0]['total_discount'], 2, '.', ','),
            'total_vat' => number_format($invoice_detail[0]['total_vat'], 2, '.', ','),
            'subTotal_ammount' => number_format($subTotal_ammount, 2, '.', ','),
            'paid_amount' => number_format($invoice_detail[0]['paid_amount'], 2, '.', ','),
            'due_amount' => number_format($invoice_detail[0]['due_amount'], 2, '.', ','),
            'shipping_cost' => number_format($invoice_detail[0]['shipping_charge'], 2, '.', ','),
            'invoice_all_data' => $invoice_detail,
            'am_inword' => $amount_inword,
            'is_discount' => $invoice_detail[0]['total_discount'] - $invoice_detail[0]['invoice_discount'],
            'users_name' => @$users->first_name . ' ' . @$users->last_name,
            'tax_regno' => $txregname,
            'is_desc' => $descript,
            'is_unit' => $isunit,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );

        $content = $this->parser->parse('dashboard/invoice/pad_invoice_html', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }

    // get_pri_type_rate
    public function get_pri_type_rate()
    {
        $product_id = urldecode($this->input->post('product_id', TRUE));
        $pri_type_id = urldecode($this->input->post('pri_type_id', TRUE));
        $product_type = urldecode($this->input->post('product_type', TRUE));
        $rate = $this->Invoices->get_pri_type_rate($product_id, $pri_type_id, $product_type);
        $result[1] = $rate; //stock
        echo json_encode($result);
    }

    //product search by model
    public function product_search_all_products()
    {
        $product_name = $this->input->post('product_name', TRUE);
        $searchByCategoryName = (bool)$this->input->post('by_category', TRUE);

        if (strlen($product_name) > 6 && preg_match("/^[0-9]+$/i", $product_name)) {
            $product_name = str_replace(2023, '', $product_name);
        }

        $query = $this->db->query("SELECT * FROM `product_information` WHERE (`product_name` LIKE '%" . $product_name . "%' OR `product_id` = '" . $product_name . "')");
        $product_info = $query->result_array();
        $json_product = [];
        foreach ($product_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id']);
        }

        // select with category name also
        if ($searchByCategoryName) {
            $query = $this->db->query("SELECT * FROM `product_category` WHERE (`category_name` LIKE '%" . $product_name . "%' OR `category_id` = '" . $product_name . "')");
            $product_info = $query->result_array();
            foreach ($product_info as $value) {
                //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
                $json_product[] = array('label' => $value['category_name'], 'value' => $value['category_id']);
            }
        }

        echo json_encode($json_product);
    }

    //customer search by model
    public function customer_search_all_customers()
    {
        $customer_name = $this->input->post('customer_name', TRUE);

        $query = $this->db->query("SELECT * FROM `customer_information` WHERE (`customer_name` LIKE '%" . $customer_name . "%' OR `customer_mobile` = '" . $customer_name . "')");
        $customer_info = $query->result_array();
        $json_customer = [];
        foreach ($customer_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_customer[] = array('label' => $value['customer_name'] . ' (' . $value['customer_mobile'] . ')', 'value' => $value['customer_id']);
        }

        echo json_encode($json_customer);
    }

    //supplier search by model
    public function supplier_search_all_suppliers()
    {
        $supplier_name = $this->input->post('supplier_name', TRUE);

        $query = $this->db->query("SELECT * FROM `supplier_information` WHERE (`supplier_name` LIKE '%" . $supplier_name . "%')");
        $supplier_info = $query->result_array();
        $json_supplier = [];
        foreach ($supplier_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_supplier[] = array('label' => $value['supplier_name'], 'value' => $value['supplier_id']);
        }

        echo json_encode($json_supplier);
    }

    public function invoice_images()
    {
        $this->load->helper('download');
        $this->load->library('zip');



        $invoices = $this->db->select('invoice_id, invoice')->from('invoice')->order_by('invoice', 'desc')->get()->result();

        $invoice_no = $this->input->post('invoice_no', true);

        $invoice_no = strpos($invoice_no, 'Inv-') > -1 ? $invoice_no : 'Inv-' . $invoice_no;

        // get invoice data
        $invoice = $this->db->select('invoice_id')->from('invoice')->where('invoice', $invoice_no)->get()->row();
        // get invoice details with items
        $details = $this->db->select('p.*')
            ->from('invoice_details d')
            ->join('product_information p', 'p.product_id = d.product_id', 'left')
            ->where('d.invoice_id', $invoice->invoice_id)
            ->get()->result();

        // echo "<pre>";var_dump($details);exit;

        $data = [
            'title'    => display('invoice_images'),
            'invoices' => $invoices
        ];

        if ($invoice) {
            $data['items'] = $details;

            $name = $invoice_no . '-items.txt';
            $data = 'Items ' . "\n";
            
            foreach ($details as $inv) {
                if (empty($inv->image_thumb)) continue;
                
                $this->zip->read_file('./' . $inv->image_thumb);
                $data .= $inv->product_name . "\n";
            }

            $this->zip->add_data($name, $data);

            $this->zip->download($invoice_no . '--' . microtime());

            $this->session->set_userdata(array('success_message' => display('images_downloaded')));
        }

        $content = $this->parser->parse('dashboard/invoice/invoice_images', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }
}
