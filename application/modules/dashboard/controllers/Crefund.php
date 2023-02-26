<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crefund extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->auth->check_user_auth();
        $this->load->model(array('dashboard/Invoices', 'dashboard/Stores'));
        $this->load->library('dashboard/lproduct');
        $this->load->library('dashboard/linvoice');
        $this->load->library('dashboard/occational');
    }

    //Default invoice add from loading
    public function index()
    {
        $this->new_refund();
    }

    //Add new invoice
    public function new_refund()
    {

        $data = [
            // 'bank_list' => $this->Invoices->bank_list(),
            // 'payment_info' => $this->Invoices->payment_info(),
        ];
        $data['module'] = "dashboard";
        $data['page'] = "refund/add_refund_form";
        echo Modules::run('template/layout', $data);
    }

    public function manage_return()
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
        $config["base_url"] = base_url('dashboard/Crefund/manage_return');
        $config["total_rows"] = $this->Invoices->count_invoice_return_list($filter);
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
        $invoices_list = $this->Invoices->get_invoice_return_list($filter, $page, $config["per_page"]);
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
            'currency' => $currency_details[0]['currency_icon'],
            'employees' => $this->empdropdown(),
            'position' => $currency_details[0]['currency_position'],
            'links' => $links
        );

        $data['module'] = "dashboard";
        $data['page'] = "refund/manage_return";
        echo Modules::run('template/layout', $data);
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
    public function get_invoice_products()
    {
        $filter = array(
            'invoice_no' =>  $this->input->post('invoice_no', TRUE),
        );
        $sql = "select invoice_id from invoice where invoice='inv-" . $filter['invoice_no'] . "';";

        $result = $this->db->query($sql);
        $invoice_id = $result->result_array()[0]['invoice_id'];

        if (!empty($this->input->post('invoice_id', TRUE))) {
            $invoice_id = $this->input->post('invoice_id', TRUE);
        }

        $sql = "select v.variant_name,b.*,I.variant_id,I.invoice_id,(I.quantity - I.return_quantity) as quantity from invoice_details I join variant v on v.variant_id=I.variant_id join product_information b on b.product_id = I.product_id where quantity > 0 and I.invoice_id='" . $invoice_id . "';";
        $sql14 = $this->db->query($sql);
        $query = $sql14->result_array();
        echo json_encode($query);
    }

    public function get_product_variants()
    {
        $filter = array(
            'invoice_no' =>  $this->input->post('invoice_no', TRUE),
            'product_id' =>  $this->input->post('product_id', TRUE),
        );
        $sql = "select (I.quantity - I.return_quantity) as quantity,I.variant_id,v.variant_name from invoice_details I join variant v on v.variant_id = I.variant_id where I.product_id ='" . $filter['product_id'] . "' and I.invoice_id ='" . $filter['invoice_no'] . "';";
        $sql14 = $this->db->query($sql);
        $query = $sql14->result_array();
        echo json_encode($query);
    }

    public function new_return()
    {
        $find_active_fiscal_year = $this->db->select('*')->from('acc_fiscal_year')->where('status', 1)->get()->row();
        $filter = array(
            'invoice_no' =>  $this->input->post('invoice_no', TRUE),
            'invoice_id' =>  $this->input->post('invoice_id', TRUE),
            // 'payment_id' =>  $this->input->post('payment_id', TRUE),
            'product_id' =>  $this->input->post('product_id', TRUE),
            'variant_id' =>  $this->input->post('variant_id', TRUE),
            'status' =>  $this->input->post('status', TRUE),
            'quantity' =>  $this->input->post('quantity', TRUE),
            'payment_id' =>  $this->input->post('payment_id', TRUE),
            'price_type' =>  $this->input->post('price_type', TRUE),
            'selected_products_inx' => $this->input->post('selected_products_inx', TRUE),
            'invoice_products_id' => $this->input->post('invoice_products_id', TRUE)
        );

        $customer_id = $this->input->post('customer_id', TRUE);

        $customer_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('customer_id', $customer_id)->get()->row();

        $return_invoice_id = generator(15);

        $warnnityProductIds = [];
        $warnnityProductQty = [];
        $warnnityProductVarient = [];

        $clDataAll = [];
        $clOneRowQty = 0;
        $clOneRow = [
            'transaction_id' => generator(15),
            'customer_id' => $customer_id,
            'date' => date('Y-m-d'),
            'amount' => 0,
            'payment_type' => 1,
            'description' => 'ITP',
            'status' => 1,
            'voucher' => 'SalRe',
            // 'details' => "تم عمل مرتجع بـ $quantity منتج",
            'Vno' => $return_invoice_id,
            'acc' => 'SR-' . $return_invoice_id
        ];

        foreach ($filter['selected_products_inx'] as $selectedInx) {
            $product_id = $this->input->post('invoice_products_id_' . $selectedInx, TRUE);
            $variant_id = $this->input->post('variant_id_' . $selectedInx, TRUE);
            $invoice_id = $this->input->post('invoice_id_' . $selectedInx, TRUE);
            $payment_id = $this->input->post('payment_id_' . $selectedInx, TRUE);
            $available_quantity = $this->input->post('available_quantity_' . $selectedInx, TRUE);
            $status = $this->input->post('status_' . $selectedInx, TRUE);
            $quantity = $this->input->post('quantity_' . $selectedInx, TRUE);
            $price_type = $this->input->post('price_type_' . $selectedInx, TRUE);

            if ($quantity < 1 || $available_quantity < 1) {
                continue;
            }

            $sql = "select I.* from invoice_details I where I.product_id ='" . $product_id . "' and I.invoice_id ='" . $invoice_id . "';";
            $result = $this->db->query($sql);
            $invoice_details  = $result->result_array();

            $this->db->select('*');
            $this->db->from('assembly_products');
            $this->db->where('parent_product_id', $product_id);
            $this->db->join('product_information', 'product_information.product_id = assembly_products.child_product_id');
            $query = $this->db->get();
            $product_list = $query->result();

            if ($status == 0 || $status == 2)
            {
                if (!empty($product_list)) {
                    foreach ($product_list as $product) {
                        $sql = "update invoice_stock_tbl set quantity=quantity-" . $quantity . " where store_id='" . $invoice_details[0]['store_id'] . "' and variant_id='" . $invoice_details[0]['variant_id'] . "' and product_id='" . $product['product_id'] . "';";
                        $result = $this->db->query($sql);
                        if ($status == 2) {
                            $warnnityProductIds[] = $product['product_id'];
                            $warnnityProductQty[] = $quantity;
                            $warnnityProductVarient[] = $invoice_details[0]['variant_id'];
                        }
                    }
                } else {
                    // update stock
                    $sql = "update invoice_stock_tbl set quantity=quantity-" . $quantity . " where store_id='" . $invoice_details[0]['store_id'] . "' and variant_id='" . $invoice_details[0]['variant_id'] . "' and product_id='" . $invoice_details[0]['product_id'] . "';";
                    $result = $this->db->query($sql);
                    if ($status == 2) {
                        $warnnityProductIds[] = $product_id;
                        $warnnityProductQty[] = $quantity;
                        $warnnityProductVarient[] = $invoice_details[0]['variant_id'];
                    }
                }
                // echo json_encode($sql);

                
            } else {
                if (!empty($product_list)) {
                    foreach ($product_list as $product) {
                        $sql = "INSERT INTO `product_return`(`invoice_id`, `product_id`, `variant_id`, `quantity`, `status`) VALUES ('" . $invoice_id . "','" . $product['product_id'] . "','" . $variant_id . "'," . $quantity . "," . $status . ")";
                        $result = $this->db->query($sql);
                    }
                } else {
                    $sql = "INSERT INTO `product_return`(`invoice_id`, `product_id`, `variant_id`, `quantity`, `status`) VALUES ('" . $invoice_id . "','" . $product_id . "','" . $variant_id . "'," . $quantity . "," . $status . ")";
                    $result = $this->db->query($sql);
                }
            }

            //update invoice_details
            $sql = "update invoice_details set return_quantity= return_quantity+" . $quantity . " where invoice_details_id='" . $invoice_details[0]['invoice_details_id'] . "';";
            $result = $this->db->query($sql);

            //invoice
            $sql = "select I.* from invoice I where I.invoice_id ='" . $invoice_id . "';";
            $result = $this->db->query($sql);
            $invoice  = $result->result_array();

            //acc_transaction
            $receive_by = $this->session->userdata('user_id');
            //calc total price of returned qunty of product
            $without_cases_price = $this->db->select('price, category_id, product_name, product_model')
                ->from('product_information')
                ->where('product_id', $product_id)
                ->limit(1)
                ->get()->row();
            $with_cases_price = $this->db->select('product_price')
                ->from('pricing_types_product')
                ->where('product_id', $product_id)
                ->where('pri_type_id', 1)
                ->limit(1)
                ->get()->row();
            $accessoriesCategory = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->limit(1)->get()->row();
            $product_price = $invoice_details[0]['total_price'] / $invoice_details[0]['quantity'];
            if ($price_type == 1) {
                // with Cases
                if (empty($invoice_details[0]['whole_price_after_disc'])) {
                    $invoice_details[0]['whole_price_after_disc'] = $with_cases_price->product_price;
                }
                $invoice_details[0]['total_price'] = $invoice_details[0]['whole_price_after_disc'] * $invoice_details[0]['quantity'];
                $product_price = $invoice_details[0]['whole_price_after_disc'];
            } else {
                // without cases
                if (empty($invoice_details[0]['without_price_after_disc'])) {
                    $invoice_details[0]['without_price_after_disc'] = $without_cases_price->price;
                }
                $invoice_details[0]['total_price'] = $invoice_details[0]['without_price_after_disc'] * $invoice_details[0]['quantity'];
                $product_price = $invoice_details[0]['without_price_after_disc'];
            }

            /* if ($without_cases_price->category_id === $accessoriesCategory->category_id && $invoice['product_type'] == 2) {
                // assemply
                if ($price_type == 1) {
                    // with Cases
                    $invoice_details[0]['total_price'] = 0;
                    $product_price = 0;
                } else {
                    // without cases

                    // get all products from this invoice
                    $invProducts = $this->db->select('product_id')
                        ->from('invoice_details')
                        ->where('invoice_id', $invoice_details[0]['invoice_id'])
                        ->where('product_id !=', $product_id)
                        ->order_by('p.product_name')
                        ->get()->result();

                    $invProductsIds = [];
                    foreach ($invProducts as $invProd) {
                        $invProductsIds[] = $invProd->product_id;
                    }

                    // get the first product with same brand name in this invoice
                    $sameProduct = $this->db->select('p.product_id')
                        ->from('product_information p')
                        ->where(
                            'product_name LIKE "%' . str_replace($without_cases_price->product_model, '', $without_cases_price->product_name) . '%"'
                        )
                        ->where_in('p.product_id', $invProductsIds)
                        ->limit(1)
                        ->get()->row();

                    $invProduct = $this->db->select('whole_price, sale_price')
                        ->from('invoice_details')
                        ->where('invoice_id', $invoice_details[0]['invoice_id'])
                        ->where('product_id', $sameProduct->product_id)
                        ->get()->row();

                    // product price = sameProduct.withCases.price - sameProduct.withoutCases.price
                    // $invoice_details[0]['total_price'] = ($sameProduct->product_price - $sameProduct->price) * $invoice_details[0]['quantity'];
                    // $product_price = $sameProduct->product_price - $sameProduct->price;
                    $invoice_details[0]['total_price'] = ($invProduct->whole_price - $invProduct->sale_price) * $invoice_details[0]['quantity'];
                    $product_price = $invProduct->whole_price - $invProduct->sale_price;
                }
            }*/

            // $total_discount = $invoice_details[0]['discount'] * $quantity;
            // $total_discount += $invoice_details[0]['invoice_discount'] * $quantity;
            // $total_return = ((($invoice_details[0]['total_price'] / $invoice_details[0]['quantity']) * $quantity)) - $total_discount;
            // $total_return_without_discount = $total_return + $total_discount;
            $total_return = ((($invoice_details[0]['total_price'] / $invoice_details[0]['quantity']) * $quantity));
            $total_return_without_discount = $total_return;
            $total_discount = abs($total_return - ($price_type == 1 ? ($invoice_details[0]['whole_price'] * $quantity) : ($invoice_details[0]['sale_price'] * $quantity)));

            //total vat
            $i_vat = $this->db->select('tax_percentage')->from('tax_product_service')->where('product_id', $product_id)->get()->row();
            if (!empty($i_vat) && $invoice[0]['is_quotation'] == 0) {
                $tota_vat = ($product_price * ($i_vat->tax_percentage / 100)) * $quantity;
            } else {
                $tota_vat = 0;
            }
            $createdate = date('Y-m-d H:i:s');
            // total supplier price
            $cogs_price = $invoice_details[0]['supplier_rate'] * $quantity;
            $bank_return = $total_return + $tota_vat;
            //return installment
            if ($invoice[0]['is_installment']) {
                $total_installment_return = $total_return + $tota_vat;
                $temp = 0;
                $return = 0;
                $sql = "select * from invoice_installment where invoice_id ='" . $invoice_id . "';";
                $result = $this->db->query($sql);
                $invoice_installment  = $result->result_array();
                $invoice_installment  = array_reverse($invoice_installment);

                for ($i = 0; $i < count($invoice_installment); $i++) {
                    $temp += $invoice_installment[$i]['amount'];


                    if ($invoice_installment[$i]['status']) {
                        $return += $invoice_installment[$i]['payment_amount'];
                    }

                    if ((int)$temp < (int)$total_installment_return) {
                        $sql = "delete from invoice_installment where id='" . $invoice_installment[$i]['id'] . "';";
                        $result = $this->db->query($sql);
                    }

                    if ((int)$temp == (int)$total_installment_return) {
                        $sql = "delete from invoice_installment where id='" . $invoice_installment[$i]['id'] . "';";
                        $result = $this->db->query($sql);
                        break;
                    }

                    if ((int)$temp > (int)$total_installment_return) {

                        $total_installment_return = $temp - $total_installment_return;
                        $return = $total_installment_return;
                        $sql = "update invoice_installment set amount='" . $total_installment_return . "' where id='" . $invoice_installment[$i]['id'] . "';";
                        $result = $this->db->query($sql);
                        break;
                    }
                }
                $bank_return = $return;
            }

            $customerName = $this->db->select('customer_name')->from('customer_information')->where('customer_id', $customer_id)->limit(1)->get()->row();

            $customer_ledger_data = array(
                'transaction_id' => generator(15),
                'customer_id' => $customer_id,
                'date' => date('Y-m-d'),
                'amount' => $total_return + $tota_vat,
                'payment_type' => 1,
                'description' => 'ITP',
                'status' => 1,
                'voucher' => 'SalRe',
                'details' => "تم عمل مرتجع بـ $quantity منتج",
                'Vno' => $return_invoice_id
            );
            $clDataAll[] = $customer_ledger_data;
            // $this->db->insert('customer_ledger', $customer_ledger_data); 

            //1st debit (Sales return for Showroom sales) with total price before discount
            $customer_credit = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => 'SR-' . $return_invoice_id,
                'Vtype' => 'Sales return',
                'VDate' => $createdate,
                'COAID' => $customer_head->HeadCode, // account payable game 11
                'Narration' => 'Sales return" total with vat" debit by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                'Debit' => 0,
                'Credit' => $total_return + $tota_vat,
                'IsPosted' => 1,
                'CreateBy' => $receive_by,
                'CreateDate' => $createdate,
                'IsAppove' => 1
            );

            $this->db->insert('acc_transaction', $customer_credit);
            // 2nd Allowed Discount credit
            $allowed_discount_credit = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => 'SR-' . $return_invoice_id,
                'Vtype' => 'Sales return',
                'VDate' => $createdate,
                'COAID' => 4114,
                'Narration' => 'Sales return "total discount" debit by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                'Debit' => 0,
                'Credit' => $total_discount,
                'IsPosted' => 1,
                'CreateBy' => $receive_by,
                'CreateDate' => $createdate,
                //'IsAppove' => 0
                'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $allowed_discount_credit);

            //3rd Showroom Sales depit
            $showroom_sales_depit = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => 'SR-' . $return_invoice_id,
                'Vtype' => 'Sales return',
                'VDate' => $createdate,
                'COAID' => 5121, // account payable game 11
                'Narration' => 'Sales return for Showroom sales "total price before discount" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                'Debit' => $total_return_without_discount,
                'Credit' => 0,
                'IsPosted' => 1,
                'CreateBy' => $receive_by,
                'CreateDate' => $createdate,
                //'IsAppove' => 0
                'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $showroom_sales_depit);

            //4th VAT on Sales
            $vat_depit = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => 'SR-' . $return_invoice_id,
                'Vtype' => 'Sales return',
                'VDate' => $createdate,
                'COAID' => 2114, // account payable game 11
                'Narration' => 'Sales return "total vat" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                'Debit' => $tota_vat,
                'Credit' => 0,
                'IsPosted' => 1,
                'CreateBy' => $receive_by,
                'CreateDate' => $createdate,
                'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $vat_depit);

            //5th cost of goods sold Credit
            $cogs_credit = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => 'SR-' . $return_invoice_id,
                'Vtype' => 'Sales return',
                'VDate' => $createdate,
                'COAID' => 4111,
                'Narration' => 'Sales return inventory "COGS" debited by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                'Debit' => 0,
                'Credit' => $cogs_price, //sales price asbe
                'IsPosted' => 1,
                'CreateBy' => $receive_by,
                'CreateDate' => $createdate,
                //'IsAppove' => 0
                'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $cogs_credit);

            //6th cost of goods sold Main warehouse depit
            $cogs_main_warehouse_depit = array(
                'fy_id' => $find_active_fiscal_year->id,
                'VNo' => 'SR-' . $return_invoice_id,
                'Vtype' => 'Sales return',
                'VDate' => $createdate,
                'COAID' => 1141,
                'Narration' => 'Sales return "COGS" debited in Main Warehouse by customer id: ' . $customer_head->HeadName . '(' . $customer_id . ')',
                'Debit' => $cogs_price,
                'Credit' => 0, //supplier price asbe
                'IsPosted' => 1,
                'CreateBy' => $receive_by,
                'CreateDate' => $createdate,
                //'IsAppove' => 0
                'IsAppove' => 1
            );
            $this->db->insert('acc_transaction', $cogs_main_warehouse_depit);

            if (!empty($payment_id)) {
                $payment_head = $this->db->select('HeadCode,HeadName')->from('acc_coa')->where('HeadCode', $payment_id)->get()->row();
                $bank_credit = array(
                    'fy_id' => $find_active_fiscal_year->id,
                    'VNo' => 'SR-' . $return_invoice_id,
                    'Vtype' => 'Sales',
                    'VDate' => $createdate,
                    'COAID' => $payment_head->HeadCode,
                    'Narration' => 'Sales "return_amount" credited by cash/bank id: ' . $payment_head->HeadName . '(' . $payment_id . ')',
                    'Debit' => 0,
                    'Credit' => $bank_return,
                    'IsPosted' => 1,
                    'CreateBy' => $receive_by,
                    'CreateDate' => $createdate,
                    'IsAppove' => 1
                );
                $this->db->insert('acc_transaction', $bank_credit);
            }
            $invoice_return = array(
                'return_invoice_id' => $return_invoice_id,
                'invoice_id'        => $invoice_id,
                'return_quantity'   => $quantity,
                'product_id'        => $product_id,
                'rate'              => $product_price,
                'customer_id'       => $customer_id,
                'employee_id'       => $invoice[0]['employee_id'],
                'total_discount'    => $total_discount,
                'total_return'      => $total_return + $tota_vat + $total_discount,
            );
            $this->db->insert('invoice_return', $invoice_return);

            $invoiceData = $this->db->select('*')->from('invoice')->where('invoice_id', $invoice_id)->limit(1)->get()->row();
            $this->db->set('paid_amount', $invoiceData->paid_amount + $total_return + $tota_vat)
                ->set('due_amount', $invoiceData->due_amount - $total_return + $tota_vat)
                ->where('invoice_id', $invoice_id)
                ->update('invoice');
        }

        foreach ($clDataAll as $clData) {
            $clOneRow['amount'] = (float)$clOneRow['amount'] + (float)$clData['amount'];
            $clOneRowQty += (int)$quantity;
        }
        $clOneRow['details'] = "تم عمل مرتجع بـ $clOneRowQty منتج";
        $this->db->insert('customer_ledger', $clOneRow);


        // echo "<pre>";var_dump($warnnityProductIds, $warnnityProductVarient, $warnnityProductQty);

        $this->insert_store_product_self($warnnityProductIds, $warnnityProductVarient, $warnnityProductQty);

        return redirect(base_url('dashboard/Crefund/return_invoice/' . $return_invoice_id));
    }

    public function return_invoice($returninvoice_id)
    {
        //find previous invoice history and REDUCE the stock
        $invoice_return = $this->db->select('*')->from('invoice_return')->where('return_invoice_id', $returninvoice_id)->get()->result_array();
        $sql = "SELECT * FROM `employee_history` where `id`='" . $invoice_return[0]['employee_id'] . "' ;";
        $result = $this->db->query($sql);
        $user  = $result->result_array();
        foreach ($invoice_return as $inv_return) {
            $sql = "SELECT * FROM `customer_information` where `customer_id`='" . $inv_return['customer_id'] . "' ;";
            $result = $this->db->query($sql);
            $customer[]  = $result->result_array()[0];

            $sql = "SELECT * FROM `product_information` where `product_id`='" . $inv_return['product_id'] . "' ;";
            $result = $this->db->query($sql);
            $product[]  = $result->result_array()[0];



            $sql = "SELECT * FROM `pricing_types_product` where `product_id`='" . $inv_return['product_id'] . "' and `pri_type_id` ='2' ;";
            $result = $this->db->query($sql);
            $customer_price[] = $result->result_array()[0];
        }

        $data =
            [
                'sl'            =>  $invoice_return[0]['id'],
                'customer'      =>  $customer[0],
                'createdate'    =>  $invoice_return[0]['created_at'],
                'receive_by'    =>  $user[0]['first_name'] . " " . $user[0]['last_name'],
                'product'       =>  $product,
                'customer_price' =>  $customer_price,
                'invoice_return' =>  $invoice_return
            ];

        $data['module'] = "dashboard";
        $data['page'] = "refund/returninvoice_html";
        echo Modules::run('template/layout', $data);
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

    public function update_database()
    {
        $sql = "INSERT INTO customer_ledger (`transaction_id`,`receipt_no`,`customer_id`,`date`,`amount` ,`payment_type` ,`description` ,`status` ) SELECT '" . generator(15) . "','" . generator(15) . "',acc0.customer_id,A.VDate,A.Credit,1,'ITP',1 from acc_coa acc0 join acc_transaction A on SUBSTR(A.VNo, 4)=acc0.HeadCode where acc0.`PHeadCode` LIKE '1131' and acc0.HeadCode in (SELECT SUBSTR(VNo, 4) AS HeadCode from acc_transaction acc1 WHERE COAID =3 and HeadCode not in (SELECT COAID as HeadCode from acc_transaction acc2 where COAID !=3 and Narration  LIKE 'Opening balance%'));";
        $result = $this->db->query($sql);

        dd($this->db->affectedRows);
    }

    public function return_report()
    {
        $this->permission->check_label('customer_balance_report')->read()->redirect();
        $from_date = $this->input->post('from_date', TRUE);
        $to_date  = $this->input->post('to_date', TRUE);
        $status  = $this->input->post('status', TRUE);
        $content  = $this->lproduct->return_product_report($from_date, $to_date, $status);
        $this->template_lib->full_admin_html_view($content);
    }

    public function get_invoice_by_customer()
    {
        $customer_id  = $this->input->post('customer_id', TRUE);

        $result = $this->Invoices->get_invoice_list(['customer_id' => $customer_id], 0, 1000);

        // var_dump($result);exit;

        // header('content-type: application/json');
        echo json_encode($result);
    }

    public function get_customer_invoices()
    {
        $customer_id = $this->input->post('customer_id', true);

        $invoices = $this->db->select('a.*')
            ->from('invoice a')
            ->where('a.customer_id', $customer_id)
            ->order_by('a.invoice', 'desc')
            ->get()
            ->result();

        $options = '';
        foreach ($invoices as $inv) {
            $options .= "<option value='{$inv->invoice_id}'>" . $inv->invoice . "</option>";
        }

        echo $options;
    }

    public function get_customer_invoice_products()
    {
        $customer_id = $this->input->post('customer_id', true);

        $invoices = $this->db->select('p.*')
            ->from('invoice a')
            ->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left')
            ->join('product_information p', 'p.product_id = b.product_id', 'left')
            ->where('a.customer_id', $customer_id)
            ->order_by('a.invoice', 'desc')
            ->get()
            ->result();

        $options = '';
        foreach ($invoices as $inv) {
            $options .= "<option value='{$inv->product_id}'>" . $inv->product_name . "</option>";
        }

        echo $options;
    }

    public function get_invoice_by_product()
    {
        $customer_id = $this->input->post('customer_id', true);
        $type = $this->input->post('type', true);
        $invoice_id = $this->input->post('invoice_id', true);
        $product_id = $this->input->post('product_id', true);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('customer_id', display('customer_name'), 'required');

        // $product_id = is_array($product_id) ? $product_id[0] : $product_id;

        if ($this->form_validation->run() == false) {
            $this->session->set_userdata(array('error_message' => display('failed_try_again')));
            $this->new_refund();
            return;
        }

        if ($type == 1) {
            // select by invoice
            $invoices = $this->db->select('a.*,b.*, p.*, b.invoice_discount as item_invoice_discount, (b.quantity - b.return_quantity) as ava_quantity')
                ->from('invoice a')
                ->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left')
                ->join('product_information p', 'p.product_id = b.product_id', 'left')
                ->where('b.invoice_id', $invoice_id)
                ->where('a.customer_id', $customer_id)
                ->order_by('a.invoice', 'desc')
                ->get()
                ->result();
        } else {
            $invoices = $this->db->select('a.*,b.*, p.*, b.invoice_discount as item_invoice_discount, (b.quantity - b.return_quantity) as ava_quantity')
                ->from('invoice a')
                ->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left')
                ->join('product_information p', 'p.product_id = b.product_id', 'left')
                ->where_in('b.product_id', $product_id)
                ->where('a.customer_id', $customer_id)
                ->order_by('a.invoice', 'desc')
                ->get()
                ->result();
        }

        // echo "<pre>";var_dump($invoices);exit;

        // var_dump($this->input->post('variant_id', true));exit;

        $data = [
            'invoices' => $invoices,
            'customer_id' => $customer_id,
            'product_id' => $product_id,
            'customer_name' => $this->input->post('customer_name', true),
            'product_name' => $this->input->post('product_name', true),
        ];
        $data['module'] = "dashboard";
        $data['page'] = "refund/add_refund_form";
        echo Modules::run('template/layout', $data);
    }

    public function return_quantity_adjustment()
    {

        $product_id = $this->input->post('product_id', true);
        $quantity = $this->input->post('quantity', true);
        $status = 1;
        $stock = $this->input->post('stock', true);

        if ($stock == 2) {
            $all_quan = $this->db->select('SUM(quantity) as quan')->from('product_return')->where('product_id', $product_id[0])->get()->row();

            // var_dump((int)$all_quan->quan , (int)$quantity);exit;

            if ((int)$all_quan->quan < (int)$quantity) {
                $data = [
                    'product_id' => $product_id,
                    'quantity' => 0,
                    'status' => $status,
                ];
        
                $data['module'] = "dashboard";
                $data['page'] = "refund/refund_adjustment_form";
                $this->session->set_userdata(array('error_message' => display('entered quantity is bigger than available quantity')));
                echo Modules::run('template/layout', $data);
                return;
            }
        }

        if ($product_id && $quantity && $status) {
            $product = $this->db->select('*')->from('product_information')->where('product_id', $product_id[0])->get()->result_array();
            $quantity = $stock == 1 ? $quantity : $quantity * -1;
            $sql = "INSERT INTO `product_return`(`product_id`, `variant_id`, `quantity`, `status`) VALUES ('" . $product_id[0] . "','" . $product[0]['variants'] . "','" . $quantity . "','" . $status . "')";
            $this->db->query($sql);
        }

        $data = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'status' => $status,
        ];

        $data['module'] = "dashboard";
        $data['page'] = "refund/refund_adjustment_form";
        echo Modules::run('template/layout', $data);
    }

    public function insert_store_product_self($product_ids, $variant_id, $quantity)
    {
        $transfer_id1  = $this->auth->generator(15);
        $transfer_id2  = $this->auth->generator(15);
        $stores = $this->db->select('store_id')->from('store_set')->where('store_name', 'Mahmoud Store')->or_where('store_name', 'Warranty Store')->order_by('store_name')->get()->result_array();
        
        $store_id     = $stores[0]['store_id'];
        // $product_ids  = $this->input->post('product_id', TRUE);
        // $variant_id   = $this->input->post('variant_id', TRUE);
        $variant_color = [];
        // $quantity     = $this->input->post('product_quantity', TRUE);
        $batch_no     = null;
        $transfer_by  = $this->session->userdata('user_id');
        $t_store_id   = $stores[1]['store_id'];
        $transfer_no = 1;
        // var_dump($store_id, $t_store_id);
        $latest = $this->db->select('transfer_no')->from('transfer_details')->order_by('id', 'desc')->limit(1)->get()->row();
        if (!empty($latest->transfer_no)) {
            $latest = str_replace('Trans-', '', $latest->transfer_no);
            $transfer_no = (int)$latest + 1;
        } else {
            $transfer_no = 1000;
        }
        $txtTNo = $transfer_no;
        $txtRemarks   = 'transfer from Mahmoud Store to Warranty Store';
        $date_time    = date("Y-m-d H:i:s");
        $status       = 1;

        $data  = [];
        $data1 = [];
        $transfer_details = [];
        $pst_out = [];
        $pst_in = [];

        foreach ($product_ids as $key => $product) {
            $data[] = array(
                'transfer_id'  => $transfer_id1,
                'store_id'     => $store_id,
                'product_id'   => $product,
                'variant_id'   => $variant_id[$key],
                'variant_color' => null,
                'quantity'     => "-" . $quantity[$key],
                'transfer_by'  => $transfer_by,
                't_store_id'   => $t_store_id,
                'date_time'    => $date_time,
                'status'       => $status,
            );

            $data1[] = array(
                'transfer_id'  => $transfer_id2,
                'store_id'     => $t_store_id,
                'product_id'   => $product,
                'variant_id'   => $variant_id[$key],
                'variant_color' => null,
                'quantity'     => $quantity[$key],
                'transfer_by'  => $transfer_by,
                't_store_id'   => $store_id,
                'date_time'    => $date_time,
            );

            $transfer_details[] = array(
                'transfer_id'  => $transfer_id2,
                't_store_id'   => $t_store_id,
                'store_id'     => $store_id,
                'warehouse_id' => '',
                'product_id'   => $product,
                'variant_id'   => $variant_id[$key],
                'variant_color' => null,
                'batch_no'     => $batch_no[$key],
                'quantity'     => $quantity[$key],
                'transfer_by'  => $transfer_by,
                'transfer_no'  => $txtTNo,
                'notes'      => $txtRemarks,
            );

            // stock1
            $check_stock1 = $this->check_cstore_stock($store_id, $product, $variant_id[$key]);
            $this->db->reset_query();
            if (!empty($check_stock1)) {

                // var_dump($check_stock1);
                //update
                $stock = array(
                    'quantity' => $check_stock1->quantity - $quantity[$key]
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
                // if (!empty($variant_color[$key])) {
                //     $this->db->where('variant_color', $variant_color[$key]);
                // }
                $this->db->update('purchase_stock_tbl', $stock);
                //update
            } else {
                // insert
                $stock = array(
                    'store_id'     => $store_id,
                    'product_id'   => $product,
                    'variant_id'   => $variant_id[$key],
                    'variant_color' => null,
                    'quantity'     => $quantity[$key],
                    'warehouse_id' => '',
                );
                $this->db->insert('purchase_stock_tbl', $stock);
                // insert
            }
            // stock1

            // stock2
            $check_stock2 = $this->check_cstore_stock($t_store_id, $product, $variant_id[$key]);
            $this->db->reset_query();
            if (!empty($check_stock2)) {
                // var_dump($check_stock2);
                //update
                $stock = array(
                    'quantity' => $check_stock2->quantity + $quantity[$key]
                );
                if (!empty($t_store_id)) {
                    $this->db->where('store_id', $t_store_id);
                }
                if (!empty($product)) {
                    $this->db->where('product_id', $product);
                }
                if (!empty($variant_id[$key])) {
                    $this->db->where('variant_id', $variant_id[$key]);
                }
                // if (!empty($variant_color[$key])) {
                //     $this->db->where('variant_color', $variant_color[$key]);
                // }
                $this->db->update('purchase_stock_tbl', $stock);
                //update
            } else {
                // insert
                $stock = array(
                    'store_id'     => $t_store_id,
                    'product_id'   => $product,
                    'variant_id'   => $variant_id[$key],
                    'variant_color' => null,
                    'quantity'     => $quantity[$key],
                    'warehouse_id' => '',
                );
                $this->db->insert('purchase_stock_tbl', $stock);
                // insert
            }
            // stock2

        }

        $this->Stores->store_transfer($data, $data1, $transfer_details);
    }

    public function check_cstore_stock($store_id = null, $product_id = null, $variant = null, $variant_color = null)
    {
        // var_dump('check store');
        // var_dump($store_id, $product_id, $variant);
        // var_dump('end check store');

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
}
