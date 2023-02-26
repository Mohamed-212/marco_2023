<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cstore extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('dashboard/lstore');
        $this->load->model('dashboard/Stores');
        $this->load->model('dashboard/Wearhouses');
        $this->load->model('dashboard/Purchases');
        $this->load->model('dashboard/Variants');
        $this->auth->check_user_auth();
    }

    //Default loading for store system.
    public function index()
    {
        $this->permission->check_label('store_add')->create()->redirect();
        $content = $this->lstore->store_add_form();
        $this->template_lib->full_admin_html_view($content);
    }

    //Insert store
    public function insert_store()
    {
        $this->permission->check_label('store_add')->create()->redirect();

        $this->form_validation->set_rules('store_name', display('store_name'), 'trim|required');
        $this->form_validation->set_rules('store_address', display('store_address'), 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => display('add_store')
            );
            $content = $this->parser->parse('dashboard/store/add_store', $data, true);
            $this->template_lib->full_admin_html_view($content);
        } else {
            $data = array(
                'store_id'      => $this->auth->generator(15),
                'store_name'    => $this->input->post('store_name', TRUE),
                'store_address' => $this->input->post('store_address', TRUE),
                'default_status' => $this->input->post('default_status', TRUE)
            );
            $result = $this->Stores->store_entry($data);
            if ($result == TRUE) {
                $this->session->set_userdata(array('message' => display('successfully_added')));
                if (isset($_POST['add-store'])) {
                    redirect('dashboard/Cstore/manage_store');
                } elseif (isset($_POST['add-store-another'])) {
                    redirect('dashboard/Cstore');
                }
            } else {
                redirect('dashboard/Cstore');
            }
        }
    }

    //Manage store
    public function manage_store()
    {
        $this->permission->check_label('manage_store')->read()->redirect();
        $content = $this->lstore->store_list();
        $this->template_lib->full_admin_html_view($content);
    }

    //Store Update Form
    public function store_update_form($store_id)
    {
        $this->permission->check_label('manage_store')->update()->redirect();
        $content = $this->lstore->store_edit_data($store_id);
        $this->menu = array('label' => 'Edit store', 'url' => 'Ccustomer');
        $this->template_lib->full_admin_html_view($content);
    }

    // Store Update
    public function store_update($store_id = null)
    {
        $this->permission->check_label('manage_store')->update()->redirect();
        $this->form_validation->set_rules('store_name', display('store_name'), 'trim|required');
        $this->form_validation->set_rules('store_address', display('store_address'), 'trim|required');
        $this->form_validation->set_rules('default_status', display('default_status'), 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'store_name'    => $this->input->post('store_name', TRUE),
                'store_address' => $this->input->post('store_address', TRUE),
                'default_status' => $this->input->post('default_status', TRUE),
            );
            $result = $this->Stores->update_store($data, $store_id);
            if ($result == TRUE) {
                $this->session->set_userdata(array('message' => display('successfully_updated')));
                redirect('dashboard/Cstore/manage_store');
            } else {
                redirect('dashboard/Cstore/manage_store');
            }
        }
        $this->store_update_form($store_id);
    }

    //Store Product
    public function store_transfer()
    {
        $this->permission->check_label('store_transfer')->update()->redirect();

        $content = $this->lstore->store_transfer_form();
        $this->template_lib->full_admin_html_view($content);
    }


    //Store transfer select
    public function store_transfer_select()
    {

        $this->load->model('dashboard/Products');
        $store_id = $this->input->post('store_id', TRUE);
        $product_lists = $this->Products->get_product_list_by_store($store_id);
        $store_list = $this->Stores->store_select($store_id);


        $stores = '';
        $stores .= "<select class=\"form-control -js-example-basic-single\" id=\"store\" name=\"t_store_id\" required=\"\" >";
        $stores .= "<option>Select Store</option>";
        if (!empty($store_list)) {
            foreach ($store_list as $store) {
                $stores .= "<option value=" . $store->store_id . ">" . $store->store_name . "</option>";
            }
        }
        $stores .= "</select>";

        $products = '';
        $products .= "<select class=\"form-control \" id=\"product_name\" name=\"product_id\" required=\"\" >";
        $products .= "<option>Select Product</option>";
        if (!empty($product_lists)) {
            foreach ($product_lists as $product_list) {
                $products .= "<option value=" . $product_list['product_id'] . ">" . $product_list['product_name'] . "-(" .
                    $product_list['product_model'] . ")"
                    . "</option>";
            }
        }
        $products .= "</select>";

        $result['stores'] = $stores;
        $result['products'] = $products;
        echo json_encode($result);
    }


    //get variant by existing purched product
    public function get_variant_by_store()
    {
        $store_id = $this->input->post('store_id', TRUE);
        $product_id = $this->input->post('product_id', TRUE);

        $this->db->select('a.*');
        $this->db->from('variant a');
        $this->db->join('transfer b', 'a.variant_id=b.variant_id');
        $this->db->where('b.store_id =', $store_id);
        $this->db->where('b.product_id =', $product_id);
        $this->db->group_by('a.variant_id');
        $variants = $this->db->get()->result();

        $this->db->select('a.*');
        $this->db->from('variant a');
        $this->db->join('transfer b', 'a.variant_id=b.variant_color');
        $this->db->where('b.store_id =', $store_id);
        $this->db->where('b.product_id =', $product_id);
        $this->db->group_by('a.variant_id');
        $variant_color = $this->db->get()->result();

        $variant_html = $variant_colorhtml = '<option value=""></option>';

        foreach ($variants as $variant) {
            $variant_html .= "<option value=" . $variant->variant_id . ">" . $variant->variant_name . "</option>";
        }

        if (!empty($variant_color)) {
            foreach ($variant_color as $cvariant) {
                $variant_colorhtml .= "<option value=" . $cvariant->variant_id . ">" . $cvariant->variant_name . "</option>";
            }
        }

        echo json_encode(array(
            'variant_html' => $variant_html,
            'variant_colorhtml' => $variant_colorhtml
        ));
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

    //Insert store product
    public function insert_store_product()
    {
        $transfer_id1  = $this->auth->generator(15);
        $transfer_id2  = $this->auth->generator(15);
        $store_id     = $this->input->post('store_id', TRUE);
        $product_ids  = $this->input->post('product_id', TRUE);
        $variant_id   = $this->input->post('variant_id', TRUE);
        $variant_color = $this->input->post('color_variant', TRUE);
        $quantity     = $this->input->post('product_quantity', TRUE);
        $batch_no     = $this->input->post('batch_no', TRUE);
        $transfer_by  = $this->session->userdata('user_id');
        $t_store_id   = $this->input->post('t_store_id', TRUE);
        $txtTNo   = $this->input->post('txtTNo', TRUE);
        $txtRemarks   = $this->input->post('txtRemarks', TRUE);
        $trans_date   = $this->input->post('trans_date', TRUE);
        $date_time    = !empty($trans_date) ? date('Y-m-d H:i:s', strtotime($trans_date)) : date("Y-m-d H:i:s");
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
                'variant_color' => @$variant_color[$key],
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
                'variant_color' => @$variant_color[$key],
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
                'variant_color' => @$variant_color[$key],
                'batch_no'     => $batch_no[$key],
                'quantity'     => $quantity[$key],
                'transfer_by'  => $transfer_by,
                'transfer_no'  => $txtTNo,
                'notes'      => $txtRemarks,
            );

            // stock1
            $check_stock1 = $this->check_stock($store_id, $product, $variant_id[$key], $variant_color[$key]);
            if (!empty($check_stock1)) {
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
                if (!empty($variant_color[$key])) {
                    $this->db->where('variant_color', $variant_color[$key]);
                }
                $this->db->update('purchase_stock_tbl', $stock);
                //update
            } else {
                // insert
                $stock = array(
                    'store_id'     => $store_id,
                    'product_id'   => $product,
                    'variant_id'   => $variant_id[$key],
                    'variant_color' => (!empty($variant_color[$key]) ? $variant_color[$key] : NULL),
                    'quantity'     => $quantity[$key],
                    'warehouse_id' => '',
                );
                $this->db->insert('purchase_stock_tbl', $stock);
                // insert
            }
            // stock1

            // stock2
            $check_stock2 = $this->check_stock($t_store_id, $product, $variant_id[$key], $variant_color[$key]);
            if (!empty($check_stock2)) {
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
                if (!empty($variant_color[$key])) {
                    $this->db->where('variant_color', $variant_color[$key]);
                }
                $this->db->update('purchase_stock_tbl', $stock);
                //update
            } else {
                // insert
                $stock = array(
                    'store_id'     => $t_store_id,
                    'product_id'   => $product,
                    'variant_id'   => $variant_id[$key],
                    'variant_color' => (!empty($variant_color[$key]) ? $variant_color[$key] : NULL),
                    'quantity'     => $quantity[$key],
                    'warehouse_id' => '',
                );
                $this->db->insert('purchase_stock_tbl', $stock);
                // insert
            }
            // stock2

        }

        $result = $this->Stores->store_transfer($data, $data1, $transfer_details);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => display('successfully_inserted')));
            if (isset($_POST['add-store'])) {
                redirect(base_url('dashboard/Cstore/manage_store_product'));
            } elseif (isset($_POST['add-store-another'])) {
                redirect(base_url('dashboard/Cstore/store_transfer'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('product_is_not_available_please_purchase_product')));
            redirect('dashboard/Cstore/store_transfer');
        }
    }

    // Manage store
    public function manage_store_product()
    {
        $this->permission->check_label('manage_store_product')->update()->redirect();

        $content = $this->lstore->store_product_list();
        $this->template_lib->full_admin_html_view($content);
    }

    //Store Product Update Form
    public function store_product_update_form($store_product_id)
    {
        $this->permission->check_label('manage_store_product')->update()->redirect();

        $content = $this->lstore->store_product_edit_data($store_product_id);
        $this->template_lib->full_admin_html_view($content);
    }


    // Store Product Update
    public function store_product_update($store_product_id = null)
    {
        $this->permission->check_label('manage_store_product')->update()->redirect();

        $this->form_validation->set_rules('store_name', display('store_name'), 'trim|required');
        $this->form_validation->set_rules('product_name', display('product_name'), 'trim|required');
        $this->form_validation->set_rules('variant', display('variant'), 'trim|required');
        $this->form_validation->set_rules('quantity', display('quantity'), 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => display('add_store')
            );
            $content = $this->parser->parse('dashboard/store/add_store', $data, true);
            $this->template_lib->full_admin_html_view($content);
        } else {

            $data = array(
                'store_id' => $this->input->post('store_name', TRUE),
                'product_id' => $this->input->post('product_name', TRUE),
                'variant_id' => $this->input->post('variant', TRUE),
                'quantity' => $this->input->post('quantity', TRUE),
            );


            $result = $this->Stores->store_product_update($data, $store_product_id);
            if ($result == TRUE) {
                $this->session->set_userdata(array('message' => display('successfully_updated')));
                redirect('dashboard/Cstore/manage_store_product_product');
            } else {
                $this->session->set_userdata(array('message' => display('successfully_updated')));
                redirect('dashboard/Cstore/manage_store_product_product');
            }
        }
    }

    // Store Delete
    public function store_delete($store_id)
    {
        $this->permission->check_label('manage_store')->delete()->redirect();

        $result = $this->Stores->delete_store($store_id);
        if ($result == 1) {
            $this->session->set_userdata(array('message' => display('successfully_delete')));
            redirect('dashboard/Cstore/manage_store');
        } elseif ($result === 'default') {
            $this->session->set_userdata(array('error_message' => display('you_cant_delete_this_is_default_store')));
            redirect('dashboard/Cstore/manage_store');
        } else {
            $this->session->set_userdata(array('error_message' => display('you_cant_delete_this_is_in_calculate_system')));
            redirect('dashboard/Cstore/manage_store');
        }
    }

    // store product Delete
    public function store_product_delete()
    {
        $this->permission->check_label('manage_store_product')->delete()->redirect();

        $store_product_id = $this->input->post('store_product_id', TRUE);
        $this->Stores->delete_store_product($store_product_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }

    // Update status of store
    public function update_status($store_id)
    {
        $this->db->set('default_status', 1)
            ->where('store_id', $store_id)
            ->update('store_set');

        $this->db->set('default_status', 0)
            ->where('store_id !=', $store_id)
            ->update('store_set');

        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect('dashboard/Cstore/manage_store');
    }

    //Add Store CSV
    public function add_store_csv()
    {
        $this->permission->check_label('import_store_csv')->create()->redirect();

        $CI = &get_instance();
        $data = array(
            'title' => display('import_store_csv')
        );
        $content = $CI->parser->parse('dashboard/store/add_store_csv', $data, true);
        $this->template_lib->full_admin_html_view($content);
    }


    //CSV Upload File
    function uploadCsv()
    {
        $this->permission->check_label('import_store_csv')->create()->redirect();

        $count = 0;
        $fp = fopen($_FILES['upload_csv_file']['tmp_name'], 'r') or die("can't open file");

        if (($handle = fopen($_FILES['upload_csv_file']['tmp_name'], 'r')) !== FALSE) {

            while ($csv_line = fgetcsv($fp, 1024)) {
                //keep this if condition if you want to remove the first row
                for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                    $insert_csv = array();
                    $insert_csv['store_name'] = (!empty($csv_line[0]) ? $csv_line[0] : null);
                    $insert_csv['store_address'] = (!empty($csv_line[1]) ? $csv_line[1] : null);
                    $insert_csv['status'] = (!empty($csv_line[2]) ? $csv_line[2] : 0);
                }

                $data = array(
                    'store_id' => $this->auth->generator(10),
                    'store_name' => $insert_csv['store_name'],
                    'store_address' => $insert_csv['store_address'],
                    'default_status' => $insert_csv['status'],
                );

                if ($count > 0) {
                    $result = $this->db->select('*')
                        ->from('store_set')
                        ->where('store_name', $data['store_name'])
                        ->get()
                        ->num_rows();

                    if ($result == 0 && !empty($data['store_name']) && $data['default_status'] == 0) {
                        $this->db->insert('store_set', $data);
                        $this->session->set_userdata(array('message' => display('successfully_added')));
                    } else {
                        $this->db->set('store_name', $data['store_name']);
                        $this->db->where('store_name', $data['store_name']);
                        $this->db->update('store_set');
                        $this->session->set_userdata(array('error_message' => display('default_store_already_exists')));
                    }
                }
                $count++;
            }
        }

        fclose($fp) or die("Can't close file");
        if (isset($_POST['add-store'])) {
            redirect(base_url('dashboard/Cstore/manage_store'));
            exit;
        } elseif (isset($_POST['add-store-another'])) {
            redirect(base_url('dashboard/Cstore'));
            exit;
        }
    }

    public function product_search_by_store()
    {
        $store_id    = $this->input->post('store_id', TRUE);
        $product_name = $this->input->post('product_name', TRUE);
        $product_info = $this->product_search_item($store_id, $product_name);
        $json_product = [];
        foreach ($product_info as $value) {
            //$json_product[] = array('label' => $value['product_name'] . '-(' . $value['product_model'] . ')', 'value' => $value['product_id']);
            $json_product[] = array('label' => $value['product_name'], 'value' => $value['product_id']);
        }
        echo json_encode($json_product);
    }
    //Product search item
    public function product_search_item($store_id, $product_name)
    {
        $query = $this->db->select('a.*')
            ->from('product_information a')
            ->join('transfer b', 'a.product_id = b.product_id')
            ->where('store_id=', $store_id)
            ->like('a.product_name', $product_name, 'both')
            ->group_by('a.product_name')
            ->get();
        return $query->result_array();
    }
    public function retrieve_product_data()
    {
        $this->load->model('dashboard/Products');

        $product_id = $this->input->post('product_id', TRUE);
        $variant_id = $this->input->post('variant_id', TRUE);
        $store_id = $this->input->post('store_id', TRUE);
        $product_info = $this->Purchases->get_total_product($product_id);

        $this->db->select("SUM(quantity) as totalPurchaseQnty");
        $this->db->from('purchase_stock_tbl');
        $this->db->where('product_id', $product_id);
        if ($variant_id) {
            $this->db->where('variant_id', $variant_id);
        }
        if ($store_id) {
            $this->db->where('store_id', $store_id);
        }
       
        $purchase = $this->db->get()->row();
        // dd($this->db->last_query());

        $this->db->select("SUM(quantity) as totalSalesQnty");
        $this->db->from('invoice_stock_tbl');
        $this->db->where('product_id', $product_id);
        if ($variant_id) {
            $this->db->where('variant_id', $variant_id);
        }
        if ($store_id) {
            $this->db->where('store_id', $store_id);
        }
       
        $this->db->where('store_id', $store_id);
        $sales = $this->db->get()->row();

        $product_information = $this->db->select('open_quantity')->from('product_information')->where('product_id', $product_id)->get()->row();

        $stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
        // $stock = ($purchase->totalPurchaseQnty + $product_information->open_quantity) - $sales->totalSalesQnty;
        // var_dump($purchase->totalPurchaseQnty , $product_information->open_quantity , $sales->totalSalesQnty);exit;
        
        // $openQuantity = $details_info->open_quantity;

        $product_info['total_product'] = $stock;

        echo json_encode($product_info);
    }
}