<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //Count Product
    public function count_product()
    {
        return $this->db->count_all("product_information");
    }

    //Product List Count
    public function product_list_count($filter = null)
    {
        $this->db->select('product_information.product_id');
        $this->db->from('product_information');
        $this->db->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left');
        $this->db->join('product_category', 'product_category.category_id = product_information.category_id', 'left');
        $this->db->join('unit', 'unit.unit_id = product_information.unit', 'left');
        if (!empty($filter['product_name'])) {
            $this->db->like('product_information.product_name', $filter['product_name'], 'both');
        }
        if (!empty($filter['supplier_id'])) {
            $this->db->where('product_information.supplier_id', $filter['supplier_id']);
        }
        if (!empty($filter['category_id'])) {
            $this->db->where('product_information.category_id', $filter['category_id']);
        }
        if (!empty($filter['unit_id'])) {
            $this->db->where('product_information.unit', $filter['unit_id']);
        }
        if (!empty($filter['model_no'])) {
            $this->db->like('product_information.product_model', $filter['model_no'], 'both');
        }
        $this->db->group_by('product_information.product_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Product List
    public function product_list($filter = null, $per_page = null, $page = null)
    {
        $is_aff = false;
        if (check_module_status('affiliate_products') == 1) {
            $is_aff = true;
        }
        $this->db->select('
			supplier_information.supplier_name,
			product_information.product_id,
            product_information.product_name,
             product_information.assembly,
            product_information.product_model,
            product_information.unit,
            product_information.price,
            product_information.supplier_price,
            product_information.onsale_price,
            product_information.image_thumb,
			product_category.category_name,
			unit.unit_short_name,
            product_information.variants');
        $this->db->from('product_information');
        $this->db->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left');
        $this->db->join('product_category', 'product_category.category_id = product_information.category_id', 'left');
        $this->db->join('unit', 'unit.unit_id = product_information.unit', 'left');
        if (!empty($filter['product_name'])) {
            $this->db->like('product_information.product_name', $filter['product_name'], 'both');
        }
        // if (!empty($filter['product_id'])) {
        //     $this->db->where('product_information.product_id', $filter['product_id']);
        // }
        if (!empty($filter['supplier_id'])) {
            $this->db->where('product_information.supplier_id', $filter['supplier_id']);
        }
        if (!empty($filter['category_id'])) {
            $this->db->where('product_information.category_id', $filter['category_id']);
        }
        if (!empty($filter['unit_id'])) {
            $this->db->where('product_information.unit', $filter['unit_id']);
        }
        if (!empty($filter['model_no'])) {
            $this->db->like('product_information.product_model', $filter['model_no'], 'both');
        }
        if ($is_aff) {
            $this->db->where('product_information.is_affiliate IS NULL');
        }
        $this->db->limit($per_page, $page);
        $this->db->order_by('product_information.id', 'desc');
        $this->db->group_by('product_information.product_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //get store wise product when product transfer to another store
    public function get_product_list_by_store($store_id)
    {
        $query = $this->db->select('a.*')
            ->from('product_information a')
            ->join('transfer b', 'a.product_id = b.product_id')
            ->where('store_id=', $store_id)
            ->group_by('a.product_name')
            ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Retrive Products
    public function retrive_products($product_name)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->like('product_name', $product_name, 'both');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //All Product List
    public function all_product_list()
    {
        $query = $this->db->select('
					supplier_information.*,
					product_information.*,
					product_category.category_name,
					unit.unit_short_name
				')
            ->from('product_information')
            ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
            ->join('product_category', 'product_category.category_id = product_information.category_id', 'left')
            ->join('unit', 'unit.unit_id = product_information.unit', 'left')
            ->order_by('product_information.product_name', 'asc')
            ->group_by('product_information.product_id')
            ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //All Supplier List
    public function all_supplier_list()
    {
        $query = $this->db->select('supplier_information.*')
            ->from('supplier_information')
            ->order_by('supplier_information.supplier_name', 'asc')
            ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //all_category_list
    public function all_category_list()
    {
        $query = $this->db->select('product_category.*')
            ->from('product_category')
            ->order_by('product_category.category_name', 'asc')
            ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //All Unit List
    public function all_unit_list()
    {
        $query = $this->db->select('unit.*')
            ->from('unit')
            ->order_by('unit.unit_name', 'asc')
            ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Tax selected item
    public function tax_selected_item($tax_id)
    {
        $result = $this->db->select('*')
            ->from('tax_information')
            ->where('tax_id', $tax_id)
            ->get()
            ->result();

        return $result;
    }

    //Product generator id check
    public function product_id_check($product_id)
    {
        $query = $this->db->select('*')
            ->from('product_information')
            ->where('product_id', $product_id)
            ->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Count Product
    public function product_entry($data)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('status', 1);
        $this->db->where('product_model', $data['product_model']);
        $this->db->where('product_name', $data['product_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $result = $this->db->insert('product_information', $data);
            // insert into website product information
            $this->website_product_entry($data);

            $this->db->select('*');
            $this->db->from('product_information');
            $this->db->where('status', 1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                //$json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);
                $json_product[] = array('label' => $row->product_name, 'value' => $row->product_id);
            }
            $cache_file = './my-assets/js/admin_js/json/product.json';
            $productList = json_encode($json_product);
            file_put_contents($cache_file, $productList);
            return $result;
        }
    }

    public function website_product_entry($data)
    {
        return true;
        $product_model = explode('-', $data['product_model']);
        $model_only = '';
        if (is_array($product_model)) {
            $model_only = trim($product_model[0]);
        }

        if (!empty($data['product_model_only'])) {
            $model_only = $data['product_model_only'];
        }

        $this->db->select('*');
        $this->db->from('website_product_information');
        $this->db->where('status', 1);
        $this->db->where('product_model_only', $model_only);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {

            $this->db->insert('website_product_information', $data);
        }
    }

    //Retrieve Product Edit Data
    public function retrieve_product_editdata($product_id)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
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

    //Update Categories
    public function update_product($data, $product_id)
    {

        $this->db->where('product_id', $product_id);
        $this->db->update('product_information', $data);

        // var_dump($product_id);

        // // website
        // $this->db->reset_query();
        // $this->db->where('product_id', $product_id);
        // $this->db->update('website_product_information', $data);
        // $this->db->reset_query();

        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            //$json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);
            $json_product[] = array('label' => $row->product_name, 'value' => $row->product_id);
        }
        $cache_file = './my-assets/js/admin_js/json/product.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
        return true;
    }

    //Get variant prices
    public function get_product_variant_prices($product_id)
    {
        $result = $this->db->select('*')
            ->from('product_variants')
            ->where('product_id', $product_id)
            ->get()->result();
        return $result;
    }

    // Delete Product Item
    public function delete_product($product_id)
    {
        #### Check product is using on system or not##########
        # If this product is used any calculation you can't delete this product.
        # but if not used you can delete it from the system.

        $this->db->select('product_id');
        $this->db->from('product_purchase_details');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        $affected_row = $query->num_rows();

        if ($affected_row == 0) {

            //product image delete
            $product_info = $this->db->select('image_large_details, image_thumb')->from('product_information')->where('product_id', $product_id)->get()->result();
            if ($product_info) {
                @unlink(FCPATH . $product_info->image_large_details);
                @unlink(FCPATH . $product_info->image_thumb);
            }
            //product gallery image delete
            $gallery_images = $this->db->select('image_url')->from('image_gallery')->where('product_id', $product_id)->get()->result();
            if ($gallery_images) {
                foreach ($gallery_images as $gallery_image) {
                    @unlink(FCPATH . $gallery_image->image_url);
                }
            }
            //delete filter
            $this->db->delete('filter_product', array('product_id' => $product_id));
            //delete filter
            $this->db->where('product_id', $product_id);
            $this->db->delete('image_gallery');

            $this->db->where('product_id', $product_id);
            $this->db->delete('pricing_types_product');

            $this->db->where('parent_product_id', $product_id);
            $this->db->delete('assembly_products');

            $this->db->where('product_id', $product_id);
            $this->db->delete('product_information');
            $this->session->set_userdata(array('message' => display('successfully_delete')));

            $this->db->select('*');
            $this->db->from('product_information');
            $this->db->where('status', 1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                //$json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);
                $json_product[] = array('label' => $row->product_name, 'value' => $row->product_id);
            }
            $cache_file = './my-assets/js/admin_js/json/product.json';
            $productList = json_encode($json_product);
            file_put_contents($cache_file, $productList);
            redirect('dashboard/Cproduct/manage_product');
        } else {
            $this->session->set_userdata(array('error_message' => display('you_cant_delete_this_product')));
            redirect('dashboard/Cproduct/manage_product');
        }
    }

    //Product By Search
    public function product_search_item($product_id)
    {
        $query = $this->db->select('
			supplier_information.*,
			product_information.*,
			product_category.category_name,
			unit.unit_short_name
		')
            ->from('product_information')
            ->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left')
            ->join('product_category', 'product_category.category_id = product_information.category_id', 'left')
            ->join('unit', 'unit.unit_id = product_information.unit', 'left')
            ->where('product_information.product_id', $product_id)
            ->order_by('product_information.product_name', 'desc')
            ->group_by('product_information.product_id')
            ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Duplicate Entry Checking
    public function product_model_search($product_model)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_model', $product_model);
        $query = $this->db->get();
        return $this->db->affected_rows();
    }

    //Product Details
    public function product_details_info($product_id)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Product Purchase Report
    public function product_purchase_info($product_id, $from_date = null, $to_date = null)
    {
        $this->db->select('a.*, a.created_at as date_time,b.*,c.supplier_name, d.variant_name');
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details b', 'b.purchase_id = a.purchase_id', 'left');
        $this->db->join('supplier_information c', 'c.supplier_id = a.supplier_id', 'left');
        $this->db->join('variant d', 'd.variant_id = b.variant_id', 'left');
        if ($from_date && $to_date) {
            $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->where('b.product_id', $product_id);
        $this->db->order_by('a.purchase_id', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Product Purchase data for multiable
    public function product_purchase_info_sum($product_ids, $from_date = null, $to_date = null)
    {
        $this->db->select('SUM(b.quantity) as total_purchase_quantity');
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details b', 'b.purchase_id = a.purchase_id', 'left');
        if ($from_date && $to_date) {
            $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->where_in('b.product_id', $product_ids);
        $this->db->group_by('b.purchase_id');

        return $this->db->get()->row();
    }

    // Invoice Data for specific data
    public function invoice_data($product_id, $from_date = null, $to_date = null)
    {
        $this->db->select('
                a.*,
                a.created_at as date_time,
                b.*,
                b.invoice_discount as item_invoice_discount,
                sum(b.quantity) as t_qty,
                sum(b.total_price) - (b.discount * sum(b.quantity)) as total_price,
                b.total_price as t_total_price,
                c.customer_name,
                d.variant_name
			');
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
        $this->db->join('variant d', 'd.variant_id = b.variant_id', 'left');
        if ($from_date && $to_date) {
            $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->where('b.product_id', $product_id);
        $this->db->group_by('a.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            // echo "<pre>";var_dump($query->result_array());exit;
            return $query->result_array();
        }
        return false;
    }

    public function invoice_data_sum($product_ids, $from_date = null, $to_date = null)
    {
        $this->db->select('sum(b.quantity) as t_sales_qty');
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left');
        if ($from_date && $to_date) {
            $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->where_in('b.product_id', $product_ids);
        $this->db->group_by('b.product_id');

        return $this->db->get()->row();
    }

    public function return_invoice_data($product_id, $from_date = null, $to_date = null)
    {
        $this->db->select('
                a.*,
                a.created_at as date_time,
                ib.invoice,
                c.customer_name,
                d.variant_name
			');
        $this->db->from('invoice_return a');
        $this->db->join('invoice ib', 'ib.invoice_id = a.invoice_id', 'left');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
        $this->db->join('variant d', 'd.variant_id = b.variant_id', 'left');
        if ($from_date && $to_date) {
            $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->where('b.product_id', $product_id);
        // $this->db->group_by('a.invoice_id');
        $this->db->order_by('ib.invoice', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    } 

    public function return_invoice_data_sum($product_ids, $from_date = null, $to_date = null)
    {
        $this->db->select('SUM(a.return_quantity) as t_return_quantity');
        $this->db->from('invoice_return a');
        if ($from_date && $to_date) {
            $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->where_in('a.product_id', $product_ids);
        $this->db->group_by('a.product_id');

        return $this->db->get()->row();
    }

    public function previous_stock_data($product_id, $startdate)
    {
        $startdate .= " 00:00:00";

        $this->db->select('date,sum(quantity) as quantity');
        $this->db->from('product_report');
        $this->db->where('product_id', $product_id);
        $this->db->where('date <=', $startdate);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_product_model($data)
    {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_model', $data['product_model']);
        $this->db->where('product_name', $data['product_name']);
        $query = $this->db->get();
        if ($query->num_rows() <= 0) {
            return null;
        }

        return $query->row();
    }

    public function return_product_report($from_date = null, $to_date = null, $status = null)
    {
        $this->db->select('pr.id as pid, p.product_name,d.variant_name,pr.product_id,pr.variant_id,SUM(pr.quantity) as quantity,pr.status,pr.created_at');
        $this->db->from('product_return pr');
        $this->db->join('product_information p', 'p.product_id = pr.product_id', 'left');
        $this->db->join('variant d', 'd.variant_id = pr.variant_id', 'left');
        if (!empty($from_date)) {
            $time1 = strtotime($from_date);
            $newformat1 = date('Y-m-d', $time1);
            $this->db->where('pr.created_at >=', $from_date);
        }
        if (!empty($to_date)) {
            $time2 = strtotime($to_date);
            $newformat2 = date('Y-m-d', $time2);
            $this->db->where('pr.created_at <=', $to_date);
        }
        if (!empty($status)) {
            // $this->db->where('pr.status =', $status);
        }

        $this->db->group_by('pr.product_id,pr.variant_id,pr.status');
        return $this->db->get()->result_array();
    }

    // Get variant stock info
    public function check_variant_wise_stock($product_id, $store_id, $variant_id, $variant_color = false, $date_from = null, $date_to = null)
    {
        $this->db->select("SUM(quantity) as totalPurchaseQnty");
        $this->db->from('purchase_stock_tbl');
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

        if ($date_from) {
            $this->db->where('DATE(created_at) >= DATE(' . date('Y-m-d', strtotime($date_from)) . ')', null, false);
        }

        if ($date_to) {
            $this->db->where('DATE(created_at) <= DATE(' . date('Y-m-d', strtotime($date_to)) . ')', null, false);
        }

        $purchase = $this->db->get()->row();
        // var_dump($product_id);

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

        if ($date_from) {
            $this->db->where('DATE(created_at) >= DATE(' . date('Y-m-d', strtotime($date_from)) . ')', null, false);
        }

        if ($date_to) {
            $this->db->where('DATE(created_at) <= DATE(' . date('Y-m-d', strtotime($date_to)) . ')', null, false);
        }
        $sales = $this->db->get()->row();

        // $product_information = $this->db->select('open_quantity')->from('product_information')->where('product_id', $product_id)->get()->row();

        // $stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
        // $stock = ($purchase->totalPurchaseQnty + $product_information->open_quantity) - $sales->totalSalesQnty;

        return [$purchase->totalPurchaseQnty, $sales->totalSalesQnty];
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
                // if ($stock1 < $stock) {
                //     $stock = $stock1;
                // }
                return [$purchase->totalPurchaseQnty, $sales->totalSalesQnty];
            }
        }

        return [0, 0];
    }

    public function update_products_model_no()
    {
        $products = $this->db->select('*')->from('product_information')->get()->result_array();

        $accessories = $this->db->select('category_id')->from('product_category')->where('category_name', 'ACCESSORIES')->limit(1)->get()->row();

        foreach ($products as $prod) {
            $model_and_color = explode('-', $prod['product_model']);
            $product_model_only = trim($model_and_color[0]);
            $product_color = trim($model_and_color[1]) . (isset($model_and_color[2]) ? '/' . $model_and_color[2] : '');
            $prod['product_model_only'] = $product_model_only;
            $prod['product_color'] = $product_color;

            if ($prod['category_id'] == $accessories->category_id) {
                $prod['product_model_only'] = null;
                $prod['product_color'] = null;
            }

            $this->db->where('product_id', $prod['product_id'])
                ->update('product_information', $prod);
        }
    }

    public function copy_products_to_website_products()
    {
        ini_set('memory_limit', '5000000000M');
        set_time_limit(5000000000);

        $this->db->truncate('website_product_information');

        $products = $this->db->select('*')->from('product_information')->get()->result_array();

        foreach ($products as $prod) {
            $this->website_product_entry($prod);
        }
    }
}
