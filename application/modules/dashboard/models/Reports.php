<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array(
            'dashboard/Suppliers',
            'dashboard/Purchases',
            'dashboard/Stores',
            'dashboard/Variants',
            'dashboard/Soft_settings',
            'template/Template_model',
            'dashboard/Products',
        ));
    }

    //Count stock report
    public function count_stock_report()
    {
        $this->db->select("a.product_name,a.product_id,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',(select sum(product_purchase_details.quantity) from product_purchase_details where product_id= `a`.`product_id`) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_stock_tbl b', 'b.product_id = a.product_id');
        $this->db->where(array('a.status' => 1, 'b.status' => 1));
        $this->db->group_by('a.product_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Stock report
    public function stock_report($limit, $page)
    {
        $this->db->select("a.product_name,a.product_id,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',(select sum(product_purchase_details.quantity) from product_purchase_details where product_id= `a`.`product_id`) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_stock_tbl b', 'b.product_id = a.product_id');
        $this->db->where(array('a.status' => 1, 'b.status' => 1));
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_id', 'desc');
        $this->db->limit($limit, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Out of stock
    public function out_of_stock()
    {

        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(d.quantity) as totalSalesQnty,
			sum(b.quantity) as totalPurchaseQnty,
			e.purchase_date as purchase_date,
			e.purchase_id,
			(sum(b.quantity) - sum(d.quantity)) as stock
			");

        $this->db->from('product_information a');
        $this->db->join('product_category c', 'c.category_id = a.category_id', 'left');
        $this->db->join('purchase_stock_tbl b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_purchase_details k', 'b.product_id = a.product_id', 'left');
        $this->db->join('invoice_stock_tbl d', 'd.product_id = a.product_id', 'left');
        $this->db->join('product_purchase e', 'e.purchase_id = k.purchase_id', 'left');
        $this->db->group_by('a.product_id');
        $this->db->having('stock < 10', null, false);
        $this->db->having('totalPurchaseQnty < 10', null, false);
        $this->db->order_by('a.product_name', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function unpaid_installments($from_date = null, $to_date = null, $customer_id = null)
    {
        $today = date('Y-m-d');
        $query = $this->db->select('i.*, c.*, a.*, i.id as installment_id')
            ->from('invoice_installment i')
            ->join('invoice c', 'i.invoice_id = c.invoice_id', 'left')
            ->join('customer_information a', 'c.customer_id = a.customer_id', 'left')
            // ->where('due_date <=', $today)
            ->where('payment_amount', null);

        if ($customer_id) {
            $query->where('c.customer_id', $customer_id);
        }

        if ($from_date) {
            $from_date = date('Y-m-d', strtotime($from_date));
        } else {
            // get report for current month only
            $from_date = date('Y-m-d', strtotime('first day of this month', strtotime(date('Y-m-d'))));
        }

        if ($to_date) {
            $to_date = date('Y-m-d', strtotime($to_date));
        } else {
            // get report for current month only
            $to_date = date('Y-m-d', strtotime('last day of this month', strtotime(date('Y-m-d'))));
        }

        // $query->where('i.due_date >=', $from_date);
        // $query->where('i.due_date <=', $to_date);
        $dateRange = "DATE(i.due_date_datetime) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
        $this->db->where($dateRange, NULL, FALSE);

        if (!$query = $query->get()) {
            return redirect(base_url());
        }

        return $query->result_array();
    }

    //Out of stock count
    public function out_of_stock_count()
    {
        $this->db->query("SET SQL_BIG_SELECTS=1"); // for avoid max_join_size.
        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(d.quantity) as totalSalesQnty,
			sum(b.quantity) as totalPurchaseQnty,
			e.purchase_date as purchase_date,
			e.purchase_id,
			(sum(b.quantity) - sum(d.quantity)) as stock
			");

        $this->db->from('product_information a');
        $this->db->join('product_category c', 'c.category_id = a.category_id', 'left');
        $this->db->join('product_purchase_details b', 'b.product_id = a.product_id', 'left');
        $this->db->join('invoice_stock_tbl d', 'd.product_id = a.product_id', 'left');
        $this->db->join('product_purchase e', 'e.purchase_id = b.purchase_id', 'left');
        $this->db->group_by('a.product_id');
        $this->db->having('stock < 10', null, false);
        $this->db->having('totalPurchaseQnty < 10', null, false);
        $this->db->order_by('a.product_name', 'asc');

        $query = $this->db->get();
        return $query->num_rows();
    }

    //Stock report single item
    public function stock_report_single_item($product_id)
    {
        $this->db->select("a.product_name,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',sum(c.quantity) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_stock_tbl b', 'b.product_id = a.product_id');
        $this->db->join('product_purchase_details c', 'c.product_id = a.product_id');
        $this->db->where(array('a.product_id' => $product_id, 'a.status' => 1, 'b.status' => 1));
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Count Stock Report by date
    public function count_stock_report_bydate($product_id = null)
    {

        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(b.quantity) as totalPurchaseQnty,
			f.unit_name
			");

        $this->db->from('product_information a');
        $this->db->join('purchase_stock_tbl b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->where('b.store_id !=', null);
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_name', 'asc');
        if (empty($product_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where("( a.product_id ='" . $product_id . "' OR a.category_id ='" . $product_id . "' )");
        }

        $query = $this->db->get();
        if ($query == false) {
            return 0;
        }
        return $query->num_rows();
    }
    //Stock Report by date
    public function stock_report_bydate($product_id = null, $date = null, $per_page, $page)
    {
        $this->db->select("
            a.product_name,
            a.unit,
            a.product_id,
            a.price,
            a.supplier_price,
            a.product_model,
            c.category_name,
            sum(b.quantity) as totalPurchaseQnty,
            f.unit_name
        ");
        $this->db->from('product_information a');
        $this->db->join('purchase_stock_tbl b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->where('b.store_id !=', null);
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_name', 'asc');

        if (empty($product_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where("( a.product_id ='" . $product_id . "' OR a.category_id ='" . $product_id . "' )");
        }

        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if (!$query) {
            return false;
        }
        if ($query->num_rows() <= 0) {
            return false;
        } else {
            return $query->result_array();
        }
    }

    //Counter of unique product histor which has been affected
    public function product_counter($product_id, $date)
    {
        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(b.quantity) as totalPurchaseQnty,
			e.purchase_date as purchase_date,
			e.purchase_id,
			f.unit_name
			");

        $this->db->from('product_information a');
        $this->db->join('product_purchase_details b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('product_purchase e', 'e.purchase_id = b.purchase_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->where('b.store_id !=', null);
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_name', 'asc');

        if (empty($product_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            //Single product information
            $this->db->where(array('a.status' => 1, 'e.purchase_date <= ' => $date, 'a.product_id' => $product_id));
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Stock report product by date
    public function stock_report_product_bydate($product_id, $supplier_id, $from_date, $to_date, $per_page, $page)
    {

        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(b.quantity) as 'totalPurchaseQnty',
			e.purchase_date as date
			");

        $this->db->from('product_information a');
        $this->db->join('product_purchase_details b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('product_purchase e', 'e.purchase_id = b.purchase_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->where('b.store_id !=', null);
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_name', 'asc');
        $this->db->limit($per_page, $page);

        if (empty($supplier_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where(
                array(
                    'a.status' => 1,
                    'a.supplier_id' => $supplier_id,
                    'a.product_id' => $product_id
                )
            );
            $this->db->where("STR_TO_DATE(e.purchase_date, '%m-%d-%Y') BETWEEN DATE('" . $from_date . "') AND DATE('" . $to_date . "')");
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    //Stock report product by date count
    public function stock_report_product_bydate_count($product_id, $supplier_id, $from_date, $to_date)
    {

        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(b.quantity) as 'totalPurchaseQnty',
			e.purchase_date as date
			");

        $this->db->from('product_information a');
        $this->db->join('product_purchase_details b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('product_purchase e', 'e.purchase_id = b.purchase_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->where('b.store_id !=', null);
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_name', 'asc');

        if (empty($supplier_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where(
                array(
                    'a.status' => 1,
                    'a.supplier_id' => $supplier_id,
                    'a.product_id' => $product_id
                )
            );
            $this->db->where("STR_TO_DATE(e.purchase_date, '%m-%d-%Y') BETWEEN DATE('" . $from_date . "') AND DATE('" . $to_date . "')");
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Stock report supplier by date
    public function stock_report_supplier_bydate($product_id, $supplier_id, $date, $perpage, $page)
    {

        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(k.quantity) as 'totalPrhcsCtn',
			");
        $this->db->from('product_information a');
        $this->db->join('purchase_stock_tbl k', 'k.product_id = a.product_id');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = k.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = k.store_id');
        $this->db->where('k.store_id !=', null);
        $this->db->group_by('k.product_id');
        $this->db->order_by('a.product_name', 'asc');

        if (empty($supplier_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where('a.status', 1);
            $this->db->where('e.purchase_date <=', $date);
            $this->db->where('a.supplier_id', $supplier_id);
        }
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Counter of unique product histor which has been affected
    public function product_counter_by_supplier($supplier_id, $date)
    {
        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(k.quantity) as 'totalPrhcsCtn',
			");

        $this->db->from('product_information a');
        $this->db->join('purchase_stock_tbl k', 'k.product_id = a.product_id');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = k.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = k.store_id');
        $this->db->where('k.store_id !=', null);
        $this->db->group_by('k.product_id');
        $this->db->order_by('a.product_name', 'asc');

        if (empty($supplier_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where('a.status', 1);
            $this->db->where('e.purchase_date <=', $date);
            $this->db->where('a.supplier_id', $supplier_id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function stock_receive_report_by_store($from_date, $to_date, $store_id = false, $per_page, $page, $product_id = false)
    {
        $this->db->select("a.product_name,
                           a.unit,
                           a.product_id,
                           a.price,
                           a.supplier_price,
                           a.product_model,
                           sum(b.quantity) as totalReceive,
                           c.category_name,
                           e.created_at as purchase_date,
                           g.variant_name,
                           g.variant_id,
                           ga.variant_id as variant_color,
                           ga.variant_name as variant_color_name,
                           h.store_name,
                           h.store_id
                            ");
        // $wh = "date_format( str_to_date( b.date_time, '%m-%d-%Y') , '%m-%d-%Y' ) Between '" . date("m-d-Y", strtotime($from_date)) . "' AND'" . date("m-d-Y", strtotime($to_date)) . "'";
        $wh = "date_format( str_to_date( b.date_time, '%Y-%m-%d' ) , '%Y-%m-%d' ) Between DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
        $this->db->from('transfer b');
        $this->db->join('product_information a', 'a.product_id = b.product_id', 'left');
        $this->db->join('product_purchase e', 'b.store_id = e.store_id', 'left');
        $this->db->join('product_purchase_details d', 'e.purchase_id = d.purchase_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('variant ga', 'ga.variant_id = b.variant_color', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->group_by('a.product_id');
        $this->db->group_by('g.variant_id');
        $this->db->group_by('h.store_id');
        $this->db->order_by('a.product_name', 'asc');

        $this->db->where('a.status', 1);
        $this->db->where('b.store_id', $store_id);
        if (!empty($product_id)) {
            $this->db->where('a.product_id', $product_id);
        } elseif (!empty($product_array)) {
            $this->db->where_in('a.product_id', $product_array);
        }
        $this->db->where($wh);
        $this->db->limit($per_page, $page);
        $this->db->where('b.quantity >', 0);
        $this->db->where('b.t_store_id !=', null);
        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }

    //get stock report store wise
    public function stock_report_by_store($from_date, $to_date, $store_id = false, $perpage, $page, $product_id = false)
    {
        $sore_product = $this->db->select('product_id')->from('product_purchase_details')->where('store_id', $store_id)->get()->result_array();
        $product_array = array_column($sore_product, 'product_id');
        $check_color = 0;
        if (!empty($product_array)) {
            $check_color = $this->db->select('var_color_id')->from('product_variants')->where_in('product_id', $product_array)->get()->num_rows();
        }
        $this->db->select("a.product_name,
                           a.unit,
                           a.product_id,
                           a.price,
                           a.supplier_price,
                           a.product_model,
                           c.category_name,
                           e.created_at as purchase_date,
                           g.variant_name,
                           g.variant_id,
                           ga.variant_id as variant_color,
                           ga.variant_name as variant_color_name,
                           h.store_name,
                           h.store_id");
        // $wh = "date_format( str_to_date( e.created_at, '%Y-%m-%d') , '%Y-%m-%d' ) Between '" . $from_date . "' AND'" . $to_date . "'";
        $wh = "date_format( str_to_date( e.created_at, '%Y-%m-%d' ) , '%Y-%m-%d' ) Between DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
        $this->db->from('product_information a');
        $this->db->join('purchase_stock_tbl b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_purchase e', 'b.store_id = e.store_id', 'left');
        $this->db->join('product_purchase_details d', 'e.purchase_id = d.purchase_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('variant ga', 'ga.variant_id = b.variant_color', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->group_by('a.product_id');
        $this->db->group_by('g.variant_id');
        $this->db->group_by('h.store_id');
        if ($check_color > 0) {
            $this->db->group_by('ga.variant_id');
        }
        $this->db->order_by('a.product_name', 'asc');

        $this->db->where('a.status', 1);
        $this->db->where('b.store_id', $store_id);
        if (!empty($product_id)) {
            $this->db->where('a.product_id', $product_id);
        } elseif (!empty($product_array)) {
            $this->db->where_in('a.product_id', $product_array);
        }
        $this->db->where($wh);
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }

    //Stock report variant by date
    public function stock_report_variant_bydate($from_date, $to_date, $store_id, $perpage, $page)
    {
        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			sum(b.quantity) as totalPrhcsCtn,
			b.date_time as purchase_date,
			g.variant_name,
			g.variant_id,
			h.store_name,
			h.store_id,
			");
        $this->db->from('product_information a');
        $this->db->join('transfer b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->where('b.store_id !=', null);
        $this->db->where('b.t_store_id =', null);
        $this->db->group_by('a.product_id');
        $this->db->group_by('g.variant_id');
        $this->db->group_by('h.store_id');
        $this->db->order_by('a.product_name', 'asc');
        if (empty($from_date)) {
            $this->db->where('a.status', 1);
        } else {
            $this->db->where('a.status', 1);
            $this->db->where('b.date_time >=', $from_date);
            $this->db->where('b.date_time <=', $to_date);
            $this->db->where('b.store_id', $store_id);
        }
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Counter of unique product histor which has been affected
    public function stock_report_variant_bydate_count($from_date = false, $to_date = false, $store_id = false, $product_id = false)
    {

        $this->db->select("
			a.product_name,
			a.unit,
			a.product_id,
			a.price,
			a.supplier_price,
			a.product_model,
			c.category_name,
			b.date_time as purchase_date,
			g.variant_name,
			g.variant_id,
			h.store_name,
			h.store_id,
			");
        $wh = "date_format( str_to_date( date_time, '%Y-%m-%d' ) , '%Y-%m-%d' ) Between DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
        $this->db->from('product_information a');
        $this->db->join('transfer b', 'b.product_id = a.product_id', 'left');
        $this->db->join('product_category c', 'c.category_id = a.category_id');
        $this->db->join('unit f', 'f.unit_id = a.unit', 'left');
        $this->db->join('variant g', 'g.variant_id = b.variant_id', 'left');
        $this->db->join('store_set h', 'h.store_id = b.store_id');
        $this->db->group_by('a.product_id');
        $this->db->group_by('g.variant_id');
        $this->db->group_by('h.store_id');
        $this->db->order_by('a.product_name', 'asc');
        $this->db->where('a.status', 1);
        $this->db->where('b.store_id', $store_id);
        if (!empty($product_id)) {
            $this->db->where('a.product_id', $product_id);
        }
        $this->db->where($wh);
        $query = $this->db->get();

        return $query->num_rows();
    }

    // ====================STORE WISE STOCK REPORT =======================
    public function store_wise_product($per_page = NULL, $page = NULL)
    {

        $this->db->select('
			a.store_name,
			a.store_id,
			b.*,
			SUM(b.quantity) as quantity,
			c.product_name,
			c.product_id,
			c.product_model,
			d.variant_name,
			d.variant_id				
			');
        $this->db->from('store_set a');
        $this->db->join('transfer b', 'a.store_id= b.store_id', 'left');
        $this->db->join('product_information c', 'c.product_id = b.product_id');
        $this->db->join('variant d', 'd.variant_id = b.variant_id');

        $this->db->group_by('b.product_id');
        $this->db->group_by('b.variant_id');
        $this->db->group_by('a.store_id');
        $this->db->order_by('a.store_name', 'asc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        $result = $query->result();

        $test = [];
        foreach ($result as $product) {

            $sql = 'select sum(a.quantity) as sell from order_details a  where store_id="' . $product->store_id . '" and product_id="' . $product->product_id . '" and variant_id="' . $product->variant_id . '"';
            $product_sell = $this->db->query($sql)->row();
            $test[] = array_merge((array)$product, (array)$product_sell);
        }


        if ($test != NULl && !empty($test)) {
            return $test;
        }
        return false;
    }

    // ====================INDIVIDUAL STORE WISE STOCK REPORT =======================
    public function individual_store_wise_product($per_page = NULL, $page = NULL)
    {

        $store_id = $this->session->userdata('store_id');

        $this->db->select('
			a.store_name,
			a.store_id,
			b.*,
			SUM(b.quantity) as quantity,
			c.product_name,
			c.product_id,
			c.product_model,
			d.variant_name,
			d.variant_id				
			');
        $this->db->from('store_set a');
        $this->db->join('transfer b', 'a.store_id= b.store_id', 'left');
        $this->db->join('product_information c', 'c.product_id = b.product_id');
        $this->db->join('variant d', 'd.variant_id = b.variant_id');

        $this->db->where('b.store_id=', $store_id);
        $this->db->group_by('b.product_id');
        $this->db->group_by('b.variant_id');
        $this->db->group_by('a.store_id');
        $this->db->order_by('a.store_name', 'asc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        $result = $query->result();

        $test = [];
        foreach ($result as $product) {

            $sql = 'select sum(a.quantity) as sell from invoice_stock_tbl a  where store_id="' . $store_id . '" and product_id="' . $product->product_id . '" and variant_id="' . $product->variant_id . '"';
            $product_sell = $this->db->query($sql)->row();
            $test[] = array_merge((array)$product, (array)$product_sell);
        }


        if ($test != NULl && !empty($test)) {
            return $test;
        }
        return false;
    }

    //=============sales report store wise=================

    public function retrieve_sales_report_store_wise($store_id, $start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*,b.store_name");
        $this->db->from('invoice a');
        $this->db->join('store_set b', 'a.store_id = b.store_id');
        $this->db->where('a.store_id', $store_id);
        if ($dateRange) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //=============sales report employee wise=================

    public function retrieve_sales_report_employee_wise($employee_id, $start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*,b.first_name,b.last_name");
        $this->db->from('invoice a');
        $this->db->join('employee_history b', 'a.employee_id = b.id');
        $this->db->where('a.employee_id', $employee_id);
        if ($dateRange) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //=============sales report product wise=================

    public function retrieve_sales_report_product_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("invoice_id");
        $this->db->from('invoice a');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        $result = [];
        foreach ($query as $inv) {
            $result[] = $this->get_invoice_details($inv['invoice_id']);
        }

        // uksort($result, fn ($a, $b) => )

        return $result;
    }

    public function retrieve_return_report_product_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time, inv.invoice, p.product_name, c.customer_name");
        $this->db->from('invoice_return a');
        $this->db->join('invoice inv', 'inv.invoice_id = a.invoice_id');
        $this->db->join('product_information p', 'p.product_id = a.product_id');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();

        if (!$query) {
            return [];
        }

        $query = $query->result_array();
        // echo "<pre>";var_dump($query);exit;

        // $result = [];
        // foreach ($query as $inv) {
        //     $inv['invoice_all_data'] = $this->get_return_invoice_details('PVPRNKOHP7RWYV1');
        //     $result[] = $inv;
        // }

        // echo "<pre>";var_dump($query);exit;

        return $query;
    }

    public function retrieve_sales_report_invoice_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time, c.customer_name, e.first_name, e.last_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
        $this->db->join('employee_history e', 'e.id = a.employee_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        $result = [];
        foreach ($query as $q) {
            $q['total_quantity'] = 0;
            $q['total_quantity'] = ($this->db->select('SUM(quantity) as total_quantity')->from('invoice_details')->where('invoice_id', $q['invoice_id'])->get()->row())->total_quantity;
            // var_dump($q['total_quantity']);exit;
            $result[] = $q;
        }

        return $result;
    }

    public function retrieve_return_report_invoice_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("SUM(a.return_quantity) as total_return_quantity, SUM(a.total_discount) as total_total_discount, SUM(a.total_return) as total_total_return, SUM(a.rate) as total_rate, a.*, a.created_at as date_time, c.customer_name, e.first_name, e.last_name");
        $this->db->from('invoice_return a');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
        $this->db->join('employee_history e', 'e.id = a.employee_id', 'left');
        $this->db->group_by('invoice_id');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();

        if (!$query) {
            return [];
        }

        $query = $query->result_array();
        // echo "<pre>";var_dump($query);exit;

        $result = [];
        foreach ($query as $q) {
            $q['invoice'] = ($this->db->select('invoice')->from('invoice')->where('invoice_id', $q['invoice_id'])->get()->row())->invoice;
            $result[] = $q;
        }

        return $result;
    }

    public function retrieve_sales_report_customer_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time, c.customer_name, e.first_name, e.last_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
        $this->db->join('employee_history e', 'e.id = a.employee_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.customer_id', 'asc');
        $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        $result = [];
        $customers = [];
        foreach ($query as $q) {
            $q['total_quantity'] = 0;
            $q['total_quantity'] = ($this->db->select('SUM(quantity) as total_quantity')->from('invoice_details')->where('invoice_id', $q['invoice_id'])->get()->row())->total_quantity;

            $customers[$q['customer_id']]++;
            $result[] = $q;
        }

        $result['customers'] = $customers;

        return $result;
    }

    public function retrieve_return_report_customer_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("SUM(a.return_quantity) as total_return_quantity, SUM(a.total_discount) as total_total_discount, SUM(a.total_return) as total_total_return, SUM(a.rate) as total_rate, a.*, a.created_at as date_time, c.customer_name, e.first_name, e.last_name");
        $this->db->from('invoice_return a');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id', 'left');
        $this->db->join('employee_history e', 'e.id = a.employee_id', 'left');
        $this->db->group_by('invoice_id');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        // $this->db->order_by('a.created_at', 'desc');
        $this->db->order_by('a.customer_id', 'asc');
        $this->db->limit('500');
        $query = $this->db->get();

        if (!$query) {
            return [];
        }

        $query = $query->result_array();
        // echo "<pre>";var_dump($query);exit;

        $result = [];
        $customers = [];
        foreach ($query as $q) {
            $q['invoice'] = ($this->db->select('invoice')->from('invoice')->where('invoice_id', $q['invoice_id'])->get()->row())->invoice;

            $customers[$q['customer_id']]++;
            $result[] = $q;
        }

        $result['customers'] = $customers;
        return $result;
    }

    public function retrieve_sales_report_summary_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.paid_amount, a.invoice_id, SUM(ind.quantity) as sum_quantity");
        $this->db->from('invoice a');
        $this->db->join('invoice_details ind', 'ind.invoice_id = a.invoice_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.customer_id', 'asc');
        $this->db->group_by('a.invoice_id');
        // $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        // echo "<pre>";var_dump($query);exit;

        $result = [
            'total_quantity' => 0,
            'total_paid' => 0
        ];
        // $customers = [];
        foreach ($query as $q) {
            $result['total_quantity'] += $q['sum_quantity'];
            $result['total_paid'] += $q['paid_amount'];

            // $result[] = $q;
        }

        // echo "<pre>";var_dump($result);exit;

        return $result;
    }

    public function retrieve_return_report_summary_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("SUM(a.return_quantity) as sum_quantity, SUM(total_return - (total_discount * return_quantity)) as paid_amount");
        $this->db->from('invoice_return a');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.customer_id', 'asc');
        $this->db->group_by('a.invoice_id');
        // $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        // echo "<pre>";var_dump($query);exit;

        $result = [
            'total_quantity' => 0,
            'total_paid' => 0
        ];
        // $customers = [];
        foreach ($query as $q) {
            $result['total_quantity'] += $q['sum_quantity'];
            $result['total_paid'] += $q['paid_amount'];

            // $result[] = $q;
        }

        // echo "<pre>";var_dump($result);exit;

        return $result;
    }

    public function retrieve_sales_report_latest_customers($start_date = null, $end_date = null)
    {
        $this->load->model('dashboard/Customers');
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time");
        $this->db->from('customer_information a');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
            // exit;
        }
        $this->db->order_by('a.created_at', 'desc');
        // $this->db->limit(10);
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        // echo "<pre>";var_dump($query);exit;

        $result = [];
        // $customers = [];
        foreach ($query as $q) {
            $summary = $this->Customers->customer_transection_summary($q['customer_id']);

            $q['balance'] = $summary[1][0]['total_debit']-$summary[0][0]['total_credit'];

            // echo "<pre>";var_dump($q, $summary);exit;

            $result[] = $q;
        }

        // echo "<pre>";print_r($result);exit;

        return $result;
    }


    //Retrieve todays_sales_report
    public function todays_total_sales_report()
    {
        $today = date('Y-m-d');

        $this->db->select('date,
			invoice,
			SUM(total_amount) as total_sale');
        $this->db->from('invoice');
        $this->db->where('DATE(created_at)', $today);
        $query = $this->db->get();
        return $query->result_array();
    }

    /** Purchase reports */

    //Retrieve todays_total_purchase_report
    public function todays_total_purchase_report()
    {
        $today = date('Y-m-d');

        $this->db->select('purchase_date,
			invoice_no,
			SUM(grand_total_amount) as total_purchase');
        $this->db->from('product_purchase');
        $this->db->where('DATE(created_at)', $today);
        $query = $this->db->get();
        return $query->result_array();
    }

    //=============purchase report product wise=================

    public function retrieve_purchase_report_product_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time, ppe.purchase_expense, s.supplier_name");
        $this->db->from('product_purchase a');
        $this->db->join('proof_of_purchase_expese ppe', 'ppe.purchase_id = a.purchase_id', 'left');
        $this->db->join('supplier_information s', 's.supplier_id = a.supplier_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();
        // echo "<pre>";var_dump($query);exit;

        $result = [];
        foreach ($query as $inv) {
            $inv['all_details'] = $this->get_purchase_details($inv['purchase_id']);

            $result[] = $inv;
        }

        // echo "<pre>";
        // var_dump($result);
        // exit;

        return $result;
    }

    // purchase invoice wise
    public function retrieve_purchase_report_invoice_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time, c.supplier_name");
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information c', 'c.supplier_id = a.supplier_id', 'left');
        // $this->db->join('employee_history e', 'e.id = a.user_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        // $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        return $query;
    }

    public function retrieve_purchase_return_report_invoice_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("SUM(prd.quantity) as total_return_quantity, SUM(prd.discount) as total_total_discount, SUM(prd.total_return_amount) as total_total_return, SUM(prd.rate) as total_rate, a.*, a.created_at as date_time, c.supplier_name");
        $this->db->from('product_purchase_return a');
        $this->db->join('product_purchase_return_details prd', 'prd.return_id = a.purchase_return_id', 'left');
        $this->db->join('supplier_information c', 'c.supplier_id = a.supplier_id', 'left');
        $this->db->group_by('purchase_id');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        return $query;
    }

    public function retrieve_purchase_return_report_product_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time, s.supplier_name");
        $this->db->from('product_purchase_return a');
        $this->db->join('supplier_information s', 's.supplier_id = a.supplier_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();
        // echo "<pre>";var_dump($query);exit;

        $result = [];
        foreach ($query as $inv) {
            $inv['all_details'] = $this->get_return_purchase_details($inv['purchase_return_id']);

            $result[] = $inv;
        }

        // echo "<pre>";var_dump($result);exit;

        return $result;
    }

    public function retrieve_purchase_report_customer_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time, c.supplier_name");
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information c', 'c.supplier_id = a.supplier_id', 'left');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.supplier_id', 'asc');
        // $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        $result = [];
        $suppliers = [];
        foreach ($query as $q) {
            $suppliers[$q['supplier_id']]++;
            $result[] = $q;
        }

        $result['suppliers'] = $suppliers;

        return $result;
    }

    public function retrieve_purchase_return_report_customer_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(pd.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("SUM(a.quantity) as total_return_quantity, SUM(a.discount) as total_total_discount, SUM(a.total_return_amount) as total_total_return, SUM(a.rate) as total_rate, pd.*, pd.created_at as date_time, c.supplier_name");
        // $this->db->select('pd.*, a.*');
        $this->db->from('product_purchase_return pd');
        $this->db->join('product_purchase_return_details a', 'a.return_id = pd.purchase_return_id', 'left');
        $this->db->join('supplier_information c', 'c.supplier_id = pd.supplier_id', 'left');
        $this->db->group_by('a.return_id');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        // $this->db->order_by('a.created_at', 'desc');
        $this->db->order_by('pd.supplier_id', 'asc');
        // $this->db->limit('500');
        $query = $this->db->get();

        if (!$query) {
            return [];
        }

        $query = $query->result_array();
        // echo "<pre>";var_dump($query);exit;

        $result = [];
        $suppliers = [];
        foreach ($query as $q) {
            $suppliers[$q['supplier_id']]++;
            $result[] = $q;
        }

        $result['suppliers'] = $suppliers;
        return $result;
    }

    public function retrieve_purchase_report_summary_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*");
        $this->db->from('product_purchase a');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        $this->db->order_by('a.supplier_id', 'asc');
        $query = $this->db->get();

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        // echo "<pre>";var_dump($query);exit;

        $result = [
            'total_quantity' => 0,
            'total_paid' => 0
        ];

        foreach ($query as $q) {
            $result['total_quantity'] += $q['total_items'];
            $result['total_paid'] += $q['grand_total_amount'];
        }

        // echo "<pre>";var_dump($result);exit;

        return $result;
    }

    public function retrieve_purchase_return_report_summary_wise($start_date = null, $end_date = null)
    {
        $dateRange = "DATE(pd.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("SUM(a.quantity) as total_return_quantity, SUM(a.discount) as total_total_discount, SUM(a.total_return_amount) as total_total_return, SUM(a.rate) as total_rate, pd.*, pd.created_at as date_time, c.supplier_name");
        // $this->db->select('pd.*, a.*');
        $this->db->from('product_purchase_return pd');
        $this->db->join('product_purchase_return_details a', 'a.return_id = pd.purchase_return_id', 'left');
        $this->db->join('supplier_information c', 'c.supplier_id = pd.supplier_id', 'left');
        $this->db->group_by('a.return_id');

        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }
        // $this->db->limit('500');
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        // echo "<pre>";var_dump($query);exit;

        $result = [
            'total_quantity' => 0,
            'total_paid' => 0
        ];
        // $customers = [];
        foreach ($query as $q) {
            $result['total_quantity'] += $q['total_return_quantity'];
            $result['total_paid'] += $q['total_total_return'];

            // $result[] = $q;
        }

        // echo "<pre>";var_dump($result);exit;

        return $result;
    }

    public function retrieve_purchase_report_latest_suppliers($start_date = null, $end_date = null)
    {
        $this->load->model('dashboard/Suppliers');
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
        $this->db->select("a.*, a.created_at as date_time");
        $this->db->from('supplier_information a');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
            // exit;
        }
        $this->db->order_by('a.created_at', 'desc');
        // $this->db->limit(10);
        $query = $this->db->get();
        // var_dump($query);exit;

        if (!$query) {
            return [];
        }

        $query = $query->result_array();

        // echo "<pre>";var_dump($query);exit;

        $result = [];
        foreach ($query as $q) {
            $q['balance'] = $this->Suppliers->suppliers_transection_summary($q['supplier_id'], null, null);
            $result[] = $q;
        }

        return $result;
    }

    //Retrieve todays_total_discount_report
    public function todays_total_discount_report()
    {
        $today = date('Y-m-d');

        $this->db->select('date,
			invoice,
			SUM(invoice_discount) as total_discount');
        $this->db->from('invoice');
        $this->db->where('DATE(created_at)', $today);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve todays_sales_report
    public function todays_sales_report($per_page, $page)
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('DATE(a.created_at)', $today);
        $this->db->limit($per_page, $page);
        $this->db->order_by('a.invoice_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve todays_sales_report_count
    public function todays_sales_report_count()
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('DATE(a.created_at)', $today);
        $this->db->order_by('a.invoice_id', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Retrieve store_to_store_transfer
    public function store_to_store_transfer($from_date = false, $to_date = false, $from_store = false, $to_store = false)
    {
        $today = date("Y-m-d");
        $this->db->select("
			a.*,
			b.store_name,
			c.product_name,
			c.product_model,
			d.variant_name,
			e.store_name as t_store_name,
            td.transfer_no,
            td.notes
			");
        $this->db->from('transfer a');
        $this->db->join('store_set b', 'b.store_id = a.store_id');
        $this->db->join('product_information c', 'c.product_id = a.product_id');
        $this->db->join('variant d', 'd.variant_id = a.variant_id');
        $this->db->join('store_set e', 'e.store_id = a.t_store_id');
        $this->db->join('transfer_details td', 'c.product_id = td.product_id');


        if (!empty($from_store)) {
            $this->db->where('a.store_id', $from_store);
        }
        if (!empty($to_store)) {
            $this->db->where('a.t_store_id', $to_store);
        }

        if (!empty($from_date) && !empty($to_date)) {
            // $dateRange = "STR_TO_DATE(a.date_time, '%m-%d-%Y') BETWEEN DATE('$from_date') AND DATE('$to_date')";
            $dateRange = "DATE(a.date_time) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";
            $this->db->where($dateRange, null, false);
        }

        $this->db->where('a.status', 1);
        $this->db->order_by('a.transfer_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve store_to_warehouse_transfer
    public function store_to_warehouse_transfer($from_date, $to_date, $from_store, $t_wearhouse)
    {
        $today = date("m-d-Y");
        $this->db->select("
			a.*,
			b.store_name,
			c.product_name,
			c.product_model,
			d.variant_name,
			e.wearhouse_name as t_wearhouse_name
			");
        $this->db->from('transfer a');
        $this->db->join('store_set b', 'b.store_id = a.store_id');
        $this->db->join('product_information c', 'c.product_id = a.product_id');
        $this->db->join('variant d', 'd.variant_id = a.variant_id');
        $this->db->join('wearhouse_set e', 'e.wearhouse_id = a.t_warehouse_id');
        if (!empty($from_store)) {
            $this->db->where('a.date_time >=', $from_date);
            $this->db->where('a.date_time <=', $to_date);
            $this->db->where('a.store_id', $from_store);
            $this->db->where('a.t_warehouse_id', $t_wearhouse);
        }
        $this->db->where('a.status', 2);
        $this->db->order_by('a.transfer_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve store_to_warehouse_transfer
    public function warehouse_to_store_transfer($from_date, $to_date, $wearhouse, $t_store)
    {
        $today = date("m-d-Y");
        $this->db->select("
			a.*,
			b.store_name,
			c.product_name,
			c.product_model,
			d.variant_name,
			e.wearhouse_name
			");
        $this->db->from('transfer a');
        $this->db->join('store_set b', 'b.store_id = a.t_store_id');
        $this->db->join('product_information c', 'c.product_id = a.product_id');
        $this->db->join('variant d', 'd.variant_id = a.variant_id');
        $this->db->join('wearhouse_set e', 'e.wearhouse_id = a.warehouse_id');
        if (!empty($wearhouse)) {
            $this->db->where('a.date_time >=', $from_date);
            $this->db->where('a.date_time <=', $to_date);
            $this->db->where('a.warehouse_id', $wearhouse);
            $this->db->where('a.t_store_id', $t_store);
        }
        $this->db->where('a.status', 3);
        $this->db->order_by('a.transfer_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve store_to_warehouse_transfer
    public function warehouse_to_warehouse_transfer($from_date, $to_date, $wearhouse, $t_wearhouse)
    {
        $today = date("Y-m-d");
        $this->db->select("
			a.*,
			b.wearhouse_name,
			c.product_name,
			c.product_model,
			d.variant_name,
			e.wearhouse_name as t_wearhouse_name
			");
        $this->db->from('transfer a');
        $this->db->join('wearhouse_set b', 'b.wearhouse_id = a.warehouse_id');
        $this->db->join('product_information c', 'c.product_id = a.product_id');
        $this->db->join('variant d', 'd.variant_id = a.variant_id');
        $this->db->join('wearhouse_set e', 'e.wearhouse_id = a.t_warehouse_id');
        if (!empty($wearhouse)) {
            $this->db->where('DATE(a.date_time) >= DATE(' . date('Y-m-d', strtotime($from_date)) . ')', null, false);
            $this->db->where('DATE(a.date_time) <= DATE(' . date('Y-m-d', strtotime($to_date)) . ')', null, false);
            $this->db->where('a.warehouse_id', $wearhouse);
            $this->db->where('a.t_warehouse_id', $t_wearhouse);
        }
        $this->db->where('a.status', 4);
        $this->db->order_by('a.transfer_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve todays_purchase_report
    public function todays_purchase_report($per_page = null, $page = null)
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.supplier_id,b.supplier_name");
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        // $this->db->where('a.purchase_date', $today);
        $this->db->where('DATE(a.created_at) = DATE("' . $today . '")', null, false);
        $this->db->order_by('a.purchase_id', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve todays_purchase_report count
    public function todays_purchase_report_count()
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.supplier_id,b.supplier_name");
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        // $this->db->where('a.purchase_date', $today);
        $this->db->where('DATE(a.created_at) = DATE("' . $today . '")', null, false);
        $this->db->order_by('a.purchase_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->num_rows();
    }


    //Total profit report
    public function total_profit_report($perpage, $page)
    {

        $this->db->select("a.date,a.invoice,b.invoice_id,
			CAST(sum(total_price) AS DECIMAL(16,2)) as total_sale");
        $this->db->select('CAST(sum(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) as total_supplier_rate', FALSE);
        $this->db->select("CAST(SUM(total_price) - SUM(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) AS total_profit");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');
        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Total profit report
    public function total_profit_report_count()
    {

        $this->db->select("a.date,a.invoice,b.invoice_id,sum(total_price) as total_sale");
        $this->db->select('sum(`quantity`*`supplier_rate`) as total_supplier_rate', FALSE);
        $this->db->select("(SUM(total_price) - SUM(`quantity`*`supplier_rate`)) AS total_profit");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');
        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Tax report product wise
    public function tax_report_product_wise($from_date = null, $to_date = null)
    {

        $today = date("Y-m-d");
        $this->db->select("
			a.amount,
			a.date,
			a.invoice_id,
			b.product_name,
			c.tax_name
			");
        $this->db->from('tax_collection_details a');
        $this->db->join('product_information b', 'b.product_id = a.product_id', 'left');
        $this->db->join('tax c', 'c.tax_id = a.tax_id');

        if (empty($from_date)) {
            $this->db->where('DATE(a.tcd_created_at) = DATE("' . $today . '")');
        } else {
            $this->db->where("DATE(a.tcd_created_at) BETWEEN DATE('$from_date') AND DATE('$to_date')");
        }
        $this->db->order_by('a.tcd_created_at', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Tax report product wise
    public function tax_report_invoice_wise($from_date = false, $to_date = false)
    {

        $today = date("Y-m-d");
        $this->db->select("
			a.tax_amount,
			a.date,
			a.invoice_id,
			c.tax_name
			");
        $this->db->from('tax_collection_summary a');
        $this->db->join('tax c', 'c.tax_id = a.tax_id');

        if (empty($from_date)) {
            // $this->db->where('a.date', $today);
            $this->db->where('DATE(a.tcs_created_at) = DATE("' . $today . '")');
        } else {
            // $this->db->where("a.date BETWEEN '$from_date' AND '$to_date'");
            $this->db->where("DATE(a.tcs_created_at) BETWEEN DATE('$from_date') AND DATE('$to_date')");
        }
        $this->db->order_by('a.tcs_created_at', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function monthly_sales_report()
    {
        $query1 = $this->db->query("
			SELECT 
			date,
			EXTRACT(MONTH FROM STR_TO_DATE(date,'%m-%d-%Y')) as month,
			COUNT(invoice_id) as total
			FROM 
			invoice
			WHERE 
			EXTRACT(YEAR FROM STR_TO_DATE(date,'%m-%d-%Y'))  >= EXTRACT(YEAR FROM NOW())
			GROUP BY 
			EXTRACT(YEAR_MONTH FROM STR_TO_DATE(date,'%m-%d-%Y'))
			ORDER BY
			month ASC
			")->result();

        $query2 = $this->db->query("
			SELECT 
			purchase_date,
			EXTRACT(MONTH FROM STR_TO_DATE(purchase_date,'%m-%d-%Y')) as month, 
			COUNT(purchase_id) as total_month
			FROM 
			product_purchase
			WHERE 
			EXTRACT(YEAR FROM STR_TO_DATE(purchase_date,'%m-%d-%Y'))  >= EXTRACT(YEAR FROM NOW())
			GROUP BY 
			EXTRACT(YEAR_MONTH FROM STR_TO_DATE(purchase_date,'%m-%d-%Y'))
			ORDER BY
			month ASC
			")->result();

        return [$query1, $query2];
    }

    //Retrieve all Report
    public function retrieve_dateWise_SalesReports($start_date = false, $end_date = false, $empId = false, $city = false)
    {
        // $dateRange = "STR_TO_DATE(a.date, '%m-%d-%Y') BETWEEN DATE('$start_date') AND DATE('$end_date')";
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";

        $ids = [];
        if ($city) {
            $this->db->select('id');
            $this->db->from('employee_history');
            $this->db->where('city', $city);
            $query = $this->db->get();
            $ids = $query->result_array();
            // $this->db->where('city', $city);
        }

        $this->db->reset_query();
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        if ($start_date && $end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        }

        if ($empId) {
            $this->db->where('employee_id', $empId);
        }

        if ($city && $ids) {
            // var_dump($ids);
            $arr = [];
            foreach ($ids as $id) {
                $arr[] = $id['id'];
            }
            $this->db->where_in('employee_id', $arr);
        }

        $this->db->order_by('a.created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve all Report
    public function retrieve_dateWise_PurchaseReports($start_date, $end_date)
    {
        // $dateRange = "STR_TO_DATE(a.purchase_date, '%m-%d-%Y') BETWEEN DATE('$start_date') AND DATE('$end_date')";
        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";

        $this->db->select("a.*,b.supplier_id,b.supplier_name");
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('a.purchase_date', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve date wise profit report
    public function retrieve_dateWise_profit_report($start_date, $end_date)
    {
        $this->db->select("a.date,a.invoice,b.invoice_id,
			CAST(sum(total_price) AS DECIMAL(16,2)) as total_sale");
        $this->db->select('CAST(sum(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) as total_supplier_rate', FALSE);
        $this->db->select("CAST(SUM(total_price) - SUM(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) AS total_profit");

        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');

        $this->db->where('a.date >=', $start_date);
        $this->db->where('a.date <=', $end_date);

        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve date wise profit report
    public function retrieve_dateWise_profit_report_count($start_date, $end_date)
    {
        $this->db->select("a.date,a.invoice,b.invoice_id,sum(total_price) as total_sale");
        $this->db->select('sum(`quantity`*`supplier_rate`) as total_supplier_rate', FALSE);
        $this->db->select("(SUM(total_price) - SUM(`quantity`*`supplier_rate`)) AS total_profit");

        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');

        $this->db->where('a.date >=', $start_date);
        $this->db->where('a.date <=', $end_date);

        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Product wise sales report
    public function product_wise_report()
    {
        $today = date('m-d-Y');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('a.date', $today);
        $this->db->order_by('a.invoice_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //RETRIEVE DATE WISE SEARCH SINGLE PRODUCT REPORT
    public function retrieve_product_search_sales_report($start_date, $end_date)
    {
        $dateRange = "STR_TO_DATE(c.date, '%m-%d-%Y') BETWEEN DATE('$start_date') AND DATE('$end_date')";
        $this->db->select("a.*,b.product_name,b.product_model,c.date,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $this->db->join('invoice c', 'c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d', 'd.customer_id = c.customer_id');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('c.date', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //RETRIEVE DATE WISE SEARCH SINGLE PRODUCT REPORT
    public function retrieve_product_search_sales_report_count($start_date, $end_date)
    {
        $dateRange = "STR_TO_DATE(c.date, '%m-%d-%Y') BETWEEN DATE('$start_date') AND DATE('$end_date')";

        $this->db->select("a.*,b.product_name,b.product_model,c.date,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $this->db->join('invoice c', 'c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d', 'd.customer_id = c.customer_id');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('c.date', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
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

    public function get_stock_items($id)
    {
        $this->db->select("
			a.product_name,			
			a.product_id,
            a.variants
			");

        $this->db->from('product_information a');

        $this->db->where('a.product_id', $id);
        $query = $this->db->get();
        $product = $query->result_array();
        $variants = explode(',', $product[0]['variants']);
        $product_info = [
            'product_name' => $product[0]['product_name'],
            'variants' => $variants
        ];
        //====================================

        foreach ($product_info['variants'] as $variant) :

            $this->db->select("a.variant_id, a.variant_name, sum(b.quantity) as totalPurchaseQnty, 
        (select sum(c.quantity) from invoice_details c where c.product_id=b.product_id and c.variant_id=b.variant_id) as totalSalesQty,
         a.variant_name");

            $this->db->from('variant a', null, false);
            $this->db->join('product_purchase_details b', 'a.variant_id=b.variant_id');

            $this->db->where('a.variant_id', $variant);
            $this->db->where('b.product_id', $id);
            $query = $this->db->get();
            $tt[] = $query->result_array();

        endforeach;

        $data = [
            'product_name' => $product[0]['product_name'],
            'products' => $tt
        ];

        return $data;
    }

    public function products_balance($from_date = null, $to_date = null, $store_id = null, $product_id = null)
    {
        $this->db->select('a.*')
            ->from('product_information a');



        if ($store_id) {
            $this->db->reset_query();
            $this->db->select('a.*')
                ->from('purchase_stock_tbl b')
                ->where('b.store_id', $store_id)
                ->join('product_information a', 'a.product_id = b.product_id', 'left');
        }

        if ($product_id) {
            $this->db->where('a.product_id', $product_id);
        }

        $products = $this->db->get();

        // echo "<pre>";
        // var_dump(count($products->result()), $store_id, $product_id);
        // exit;

        if (!$products) {
            return redirect(base_url() . 'dashboard/Creport/products_balance');
        }
        $products = $products->result_array();

        $store_list = $this->Stores->store_list();



        $p_list = [];
        // echo "<pre>";
        // var_dump($products);

        foreach ($products as $product) {
            $size_id = explode(',', $product['variants']);
            if (is_array($size_id)) {
                $size_id = $size_id[0];
            } else {
                $size_id = $product['variants'];
            }

            $size_id = $product['variants'];

            foreach ($store_list as $st) {
                if ($product['assembly'] == 1) {
                    $product['stores'][$st['store_id']] = $this->Purchases->check_variant_wise_stock2($product['product_id'], $st['store_id'], $size_id, null, $from_date, $to_date);
                } else {
                    $product['stores'][$st['store_id']] = $this->Purchases->check_variant_wise_stock($product['product_id'], $st['store_id'], $size_id, null, $from_date, $to_date);
                }
            }
            // return stores
            $product['stores']['s1'] = $this->get_return_products_count($product['product_id'], $size_id, '1', $from_date, $to_date); // damaged
            // $product['stores']['s2'] = $this->get_return_products_count($product['product_id'], $size_id, '2', $from_date, $to_date); // warrinty

            $p_list[] = $product;
        }

        // echo"<pre>";var_dump($p_list);exit;



        // echo "<pre>";
        // var_dump($products);
        // exit;



        return $p_list;
    }

    public function get_return_products_count($product_id, $variant, $status, $date_from = null, $date_to = null)
    {
        $count = $this->db->select('SUM(quantity) as count')->from('product_return')->where('product_id', $product_id)->where('variant_id', $variant)->where('status', $status);

        if ($date_from) {
            $this->db->where('DATE(created_at) >= DATE(' . date('Y-m-d', strtotime($date_from)) . ')', null, false);
        }

        if ($date_to) {
            $this->db->where('DATE(created_at) <= DATE(' . date('Y-m-d', strtotime($date_to)) . ')', null, false);
        }

        $count = $count->get();

        return $count ? (int)(($count->row())->count) : 0;
    }

    public function get_invoice_details($invoice_id)
    {
        $CI = &get_instance();
        $CI->load->model('dashboard/Invoices');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');
        $CI->load->model('dashboard/Shipping_methods');
        $CI->load->model('hrm/Hrm_model');
        $CI->load->model('dashboard/Products');

        $invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);
        // echo "<pre>";var_dump($invoice_detail);exit;
        $invoice_detail[0]['invoice_discount'] = $invoice_detail[0]['total_invoice_discount'];
        $order_no = $CI->db->select('b.order as order_no')->from('invoice a')->where('a.order_id', $invoice_detail[0]['order_id'])->join('order b', 'a.order_id = b.order_id', 'left')->get()->result();
        $quotation_no = $CI->db->select('q.quotation as quotation_no')->from('invoice a')->where('a.quotation_id', $invoice_detail[0]['quotation_id'])->join('quotation q', 'q.quotation_id = a.quotation_id', 'left')->get()->result();

        $cardpayments = $CI->Invoices->get_invoice_card_payments($invoice_id);
        $shipping_method  = $CI->Shipping_methods->shipping_method_search_item($invoice_detail[0]['shipping_method']);
        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        $isTaxed = 1;
        if ($invoice_detail[0]['is_quotation'] > 0) {
            $isTaxed = 0;
        }
        if (!empty($invoice_detail)) {
            foreach ($invoice_detail as $k => $v) {
                $invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);
                $subTotal_quantity = $subTotal_quantity + $invoice_detail[$k]['quantity'];
            }
            $i = 0;
            $products = [];
            foreach ($invoice_detail as $k => $v) {
                $i++;
                $invoice_detail[$k]['sl'] = $i;
                $invoice_detail[$k]['product_price'] = ($CI->Products->get_product_model([
                    'product_model' => $invoice_detail[0]['product_model'],
                    'product_name' => $invoice_detail[0]['product_name'],
                ]))->price;
            }
        }

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $company_info      = $CI->Invoices->retrieve_company();

        $created_at      = explode(' ', $invoice_detail[0]['date_time']);
        $invoice_time = @$created_at[1];

        $all_details = $invoice_detail;

        $hide_discount = false;

        $data = array(
            'invoice_id'       => $invoice_detail[0]['invoice_id'],
            'invoice_no'       => $invoice_detail[0]['invoice'],
            'customer_id'      => $invoice_detail[0]['customer_id'],
            'customer_no'      => $invoice_detail[0]['customer_no'],
            'customer_name'       => $invoice_detail[0]['customer_name'],
            'customer_mobile'  => $invoice_detail[0]['customer_mobile'],
            'customer_email'   => $invoice_detail[0]['customer_email'],
            'store_id'           => (empty($invoice_detail[0]['store_id']) ? '' : $invoice_detail[0]['store_id']),
            'vat_no'           => $invoice_detail[0]['vat_no'],
            'cr_no'               => $invoice_detail[0]['cr_no'],
            'customer_address' => $invoice_detail[0]['customer_address_1'],
            'final_date'       => $invoice_detail[0]['final_date'],
            'invoice_time'       => $invoice_time,
            'total_amount'       => $invoice_detail[0]['total_amount'],
            'total_discount'   => $invoice_detail[0]['total_discount'],
            'invoice_discount' => $invoice_detail[0]['invoice_discount'],
            'percentage_discount' => $invoice_detail[0]['percentage_discount'],
            'service_charge'   => $invoice_detail[0]['service_charge'],
            'shipping_charge'  => $invoice_detail[0]['shipping_charge'],
            'shipping_method'  => @$shipping_method[0]['method_name'],
            'paid_amount'       => $invoice_detail[0]['paid_amount'],
            'due_amount'       => $invoice_detail[0]['due_amount'],
            'product_type'     => $invoice_detail[0]['product_type'],
            'invoice_details'  => $invoice_detail[0]['invoice_details'],
            'subTotal_quantity' => $subTotal_quantity,
            'invoice_all_data' => $all_details,
            'isTaxed'          => $isTaxed,
            'order_no'         => $order_no,
            'quotation_no'     => $quotation_no,
            'company_info'       => $company_info,
            'currency'            => $currency_details[0]['currency_icon'],
            'position'            => $currency_details[0]['currency_position'],
            'ship_customer_short_address' => $invoice_detail[0]['ship_customer_short_address'],
            'ship_customer_name' => $invoice_detail[0]['ship_customer_name'],
            'ship_customer_mobile' => $invoice_detail[0]['ship_customer_mobile'],
            'ship_customer_email' => $invoice_detail[0]['ship_customer_email'],
            'cardpayments'         => $cardpayments,
            'hide_discount' => $hide_discount
        );
        $data['Soft_settings'] = $CI->Soft_settings->retrieve_setting_editdata();

        return $data;
    }

    public function get_return_invoice_details($invoice_id)
    {
        $invoice_return = $this->db->select('*')->from('invoice_return ir')
            ->join('invoice_details ind', 'ind.invoice_id = ir.invoice_id', 'left')
            ->join('product_information pi', 'pi.product_id = ind.product_id')
            ->where('return_invoice_id', $invoice_id)->get()->result_array();
        // echo "<pre>";var_dump($invoice_return);exit;

        return $invoice_return;
    }

    public function get_purchase_details($purchase_id)
    {
        return $this->db->select('pd.*, p.product_name')->from('product_purchase_details pd')->join('product_information p', 'p.product_id = pd.product_id')->where('pd.purchase_id', $purchase_id)->get()->result_array();
    }

    public function get_return_purchase_details($purchase_id)
    {
        return $this->db->select('pd.*, p.product_name')->from('product_purchase_return_details pd')->join('product_information p', 'p.product_id = pd.product_id')->where('pd.return_id', $purchase_id)->get()->result_array();
    }

    public function stock_report_by_product_card($from_date = false, $to_date = false, $store_id = false, $product_id)
    {

        $product = $this->db->select('*')->from('product_information')->where('product_id', $product_id)->get()->row();

        $default_store_id = $this->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
        $default_store_id = $default_store_id->store_id;
        $first_purchase = $this->db->select('quantity')->from('purchase_stock_tbl')->where('product_id', $product_id)->where('store_id', $default_store_id)->where('quantity', $product->open_quantity)->limit(1)->order_by('created_at', 'asc')->get()->row();

        // TODO change this
        if (empty($first_purchase->quantity)) {
            // $first_purchase->quantity = $product->open_quantity;
            $openQuantity = (int)$product->open_quantity;
        } else {
            $openQuantity = (int)$first_purchase->quantity;
        }

        

        // $openQuantity = 5;
        // var_dump($openQuantity);exit;

        $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";

        $get_details = [];

        $invs = $this->db->select('a.*, a.invoice_id as id_me, b.*, b.quantity as qty, a.created_at as date_to_format, a.created_at as minus, c.customer_name')->from('invoice a')->join('invoice_details b', 'b.invoice_id = a.invoice_id AND b.product_id = ' . $product_id)->join('customer_information c', 'c.customer_id = a.customer_id', 'left')->where('a.store_id', $store_id)->get()->result_array();

        $adjus_dec = $this->db->select('a.*, a.adjustment_id as id_me, b.*, b.adjustment_quantity as qty, a.created_at as date_to_format, a.created_at as minus')->from('stock_adjustment_table a')->join('stock_adjustment_details b', 'b.adjustment_id = a.adjustment_id AND a.adjustment_status = 1 AND b.adjustment_type = "decrease" AND b.product_id = ' . $product_id)->where('a.store_id', $store_id)->get()->result_array();

        $pur_ret = $this->db->select('a.*, a.purchase_return_id as id_me, b.*, b.quantity as qty, a.created_at as date_to_format, a.created_at as minus, c.supplier_name')->from('product_purchase_return a')->join('product_purchase_return_details b', 'b.return_id = a.purchase_return_id AND b.product_id = ' . $product_id)->join('supplier_information c', 'c.supplier_id = a.supplier_id', 'left')->where('a.store_id', $store_id)->get()->result_array();

        // $pur_ret = $this->db->select('a.*, a.purchase_return_id as id_me')->from('product_purchase_return a')->join('product_purchase_return_details b', 'b.return_id = a.purchase_return_id AND b.product_id = ' . $product_id)->get()->result_array();

        // var_dump($pur_ret);exit;

        // $pur_ret = $this->db->select('a.*, b.*')->from('product_purchase_return a')->join('product_purchase_return_details b', 'b.return_id = a.purchase_return_id AND b.product_id = ' . $product_id)->get()->result_array();

        $trans_from = $this->db->select('a.*, a.id as id_me, b.*, b.quantity as qty, b.created_at as date_to_format, b.created_at as minus')->from('transfer a')->join('transfer_details b', 'b.transfer_id = a.transfer_id AND b.store_id = "'. $store_id  .'" AND b.product_id = ' . $product_id)->where('a.store_id', $store_id)->get()->result_array();


        /**
         * 
         */

        $purs = $this->db->select('a.*, a.purchase_id as id_me, b.*, b.quantity as qty, a.created_at as date_to_format, a.created_at as plus, c.supplier_name')->from('product_purchase a')->join('product_purchase_details b', 'b.purchase_id = a.purchase_id AND b.product_id = ' . $product_id)->join('supplier_information c', 'c.supplier_id = a.supplier_id', 'left')->where('a.store_id', $store_id)->get()->result_array();

        $adjus = $this->db->select('a.*, a.adjustment_id as id_me, b.*, b.adjustment_quantity as qty, a.created_at as date_to_format, a.created_at as plus')->from('stock_adjustment_table a')->join('stock_adjustment_details b', 'b.adjustment_id = a.adjustment_id AND a.adjustment_status = 1 AND b.adjustment_type = "increase" AND b.product_id = ' . $product_id)->where('a.store_id', $store_id)->get()->result_array();

        $inv_ret = $this->db->select('b.*, b.id as id_me, b.return_quantity as qty, b.created_at as date_to_format, b.created_at as plus, c.customer_name')->from('invoice_return b')->join('customer_information c', 'c.customer_id = b.customer_id', 'left')->join('invoice inv', 'inv.invoice_id = b.invoice_id and inv.store_id = "' . $store_id . '"', 'left')->where('b.product_id', $product_id)->get()->result_array();

        $trans_to = $this->db->select('a.*, a.purchase_id as id_me, b.*, b.quantity as qty, b.created_at as date_to_format, b.created_at as plus')->from('transfer a')->join('transfer_details b', 'b.transfer_id = a.transfer_id AND b.t_store_id = "'. $store_id  .'" AND b.product_id = ' . $product_id)->get()->result_array();

        $get_details = array_merge($get_details, $invs, $adjus_dec, $pur_ret, $trans_from, $purs, $adjus, $inv_ret, $trans_to);

        usort($get_details, function ($a, $b) {
            return strtotime($a['date_to_format']) - strtotime($b['date_to_format']);
        });

        $all_details = [];
        // $all_details[0]['balance'] += $openQuantity;
        $i = 0;
        $balance = 0;
        // var_dump($from_date, $to_date);exit;
        
        foreach ($get_details as $d) {
            $d['balance'] = 0;

            // $today = date('Y-m-d');
            $today = new DateTime(date('Y-m-d', strtotime($d['date_to_format']))); // Today
            $contractDateBegin = new DateTime(date('Y-m-d', strtotime($from_date)));
            $contractDateEnd  = new DateTime(date('Y-m-d', strtotime($to_date)));
            // $contractDateEnd->da(1);
            // $contractDateEnd->modify('+1 day');
            // var_dump($contractDateBegin->format('d-m-Y'), $contractDateEnd->format('d-m-Y'), $contractDateBegin->getTimestamp());
            // var_dump( $today->getTimestamp() <= $contractDateEnd->getTimestamp());
            if (
                $today->getTimestamp() >= $contractDateBegin->getTimestamp() && 
                $today->getTimestamp() <= $contractDateEnd->getTimestamp()){
                // echo "is between";
              }else{
                continue;
              }

            

            if ($i == 0) {
                $balance += $openQuantity; 
                $d['balance'] = $balance;
            }
            if (isset($d['minus'])) {
                $balance -= (int)$d['qty'];
                $d['balance'] = $balance;
            }

            if (isset($d['plus'])) {
                $balance += (int)$d['qty'];
                $d['balance'] = $balance;
            }
            
            $all_details[] = $d;
            $i++;
        }

        // $sales[0]['balance'] = $openQuantity;
        // foreach ($sales as $sale) {
        //     // $sale['balance'] = 0;
        //     $sale['balance'] -= $sale['qty']; 
        // }
        

        // echo "<pre>";var_dump($sales);exit;

        // $totalPurchase = 0;
        // $purchaseData = $this->Products->product_purchase_info($product_id);
        // if (!empty($purchaseData)) {
        //     foreach ($purchaseData as $k => $v) {
        //         $totalPurchase = ($totalPurchase + $purchaseData[$k]['quantity']);
        //     }
        // }
        // $totalPurchase += $product->open_quantity;
        // $salesData = $this->Products->invoice_data($product_id);
        // $totalSales = 0;
        // if (!empty($salesData)) {
        //     foreach ($salesData as $k => $v) {
        //         $totalSales = ($totalSales + $salesData[$k]['t_qty']);
        //     }
        // }

        // $total = $this->db->select("SUM(p.quantity) as totalPurchaseQnty, SUM(i.quantity) as totalSalesQnty")
        //     ->from('purchase_stock_tbl p')
        //     ->join('invoice_stock_tbl i', 'i.product_id = p.product_id', 'left')
        //     ->where('p.product_id', $product_id)
        //     ->group_by('p.product_id', 'i.product_id')
        //     ->get()
        //     ->row();

        // var_dump($total);exit;
        // $totalPurchase = $total->totalPurchaseQnty;
        // $totalSales = $total->totalSalesQnty;


        // $balance = $totalPurchase - $totalSales;

        // var_dump($totalPurchase, $totalSales, $product_id, $total);exit;

        return [$openQuantity, $all_details, $product];
    }

    public function sales_report_all_details(
        $product_id = null,
        $store_id = null,
        $pricing_type = null,
        $from_date = null,
        $to_date = null
    ) {

        $product = $this->db->select('p.*, c.category_name')->from('product_information p')
            ->join('product_category c', 'c.category_id = p.category_id', 'left')
            ->where('p.product_id', $product_id)
            ->get()->result_array()[0];

        // get item filters
        $product['filters'] = $this->db->select('fi.item_name')
            ->from('filter_product fp')
            ->join('filter_items fi', 'fi.item_id = fp.filter_item_id', 'left')
            ->where('fp.product_id', $product_id)
            ->order_by('fp.filter_type_id', 'asc')
            ->get()->result_array();

        // get item pricing types
        $product['prices'] = $this->db->select('product_price, pri_type_id')
            ->from('pricing_types_product')
            ->where('product_id', $product_id)
            ->order_by('pri_type_id', 'asc')
            ->get()->result_array();

        // set product selected price
        $product['selected_price'] = $product['price']; // without cases
        if ($pricing_type == 1) {
            // withcases / whole price
            $product['selected_price'] = $product['prices'][0]['product_price'];
        } elseif ($pricing_type == 2) {
            // customer price
            $product['selected_price'] = $product['prices'][1]['product_price'];
        }

        // $default_store_id = $this->db->select('store_id')->from('store_set')->where('default_status=', 1)->get()->row();
        // $default_store_id = $default_store_id->store_id;
        // $first_purchase = $this->db->select('quantity')->from('purchase_stock_tbl')->where('product_id', $product_id)->where('store_id', $default_store_id)->where('quantity', $product->open_quantity)->limit(1)->order_by('created_at', 'asc')->get()->row();

        // $dateRange = "DATE(a.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($from_date)) . "') AND DATE('" . date('Y-m-d', strtotime($to_date)) . "')";

        // $totalPurchase = 0;
        // $purchaseData = $this->Products->product_purchase_info($product_id, $from_date, $to_date);

        // if (!empty($purchaseData)) {
        //     foreach ($purchaseData as $k => $v) {
        //         $totalPurchase = ($totalPurchase + $purchaseData[$k]['quantity']);
        //     }
        // }
        // $totalPurchase += $product['open_quantity'];
        // $salesData = $this->Products->invoice_data($product_id, $from_date, $to_date);
        // $returnData = $this->Products->return_invoice_data($product_id, $from_date, $to_date);
        // $totalSales = 0;
        // if (!empty($salesData)) {
        //     foreach ($salesData as $k => $v) {
        //         $totalSales = ($totalSales + $salesData[$k]['t_qty']);
        //     }
        // }
        // $total_return = 0;
        // foreach ($returnData as $return) {
        //     $total_return += $return['return_quantity'];
        // }
        // $totalSales -= $total_return;

        $total = $this->db->select("SUM(p.quantity) as totalPurchaseQnty, SUM(i.quantity) as totalSalesQnty")
            ->from('purchase_stock_tbl p')
            ->join('invoice_stock_tbl i', 'i.product_id = p.product_id')
            ->where('p.product_id', $product_id)
            ->group_by('p.product_id', 'i.product_id')
            ->get()
            ->row();

        // var_dump($total);exit;
        $totalPurchase = $total->totalPurchaseQnty;
        $totalSales = $total->totalSalesQnty;


        $balance = $totalPurchase - $totalSales;


        return [$product, 0, 0, 0, 0, $totalPurchase, $totalSales, $balance];
    }

    public function sales_report_all_details_sum_all(
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

        $selectAddon = 'pi.price';
        if ($pricing_type) {
            $selectAddon = 'pr.product_price';
        }

        if (!empty($general_filter) || !empty($material_filter)) {
            $this->db->reset_query();
            $filter_products = $this->db->select('a.product_id')
                ->from('filter_product a, filter_product b');

            if (!empty($general_filter)) {
                $filter_products->where_in('a.filter_item_id', $general_filter);
            }
            if (!empty($material_filter)) {
                $filter_products->where_in('b.filter_item_id', $material_filter);
            }
            $filter_products->where('a.product_id = b.product_id');
            $filter_products = $filter_products->get()->result_array();
            foreach ($filter_products as $prod) {
                $product_ids[] = $prod['product_id'];
            }
        }


        $total = $this->db->select("pi.product_id, pi.product_name, pi.category_id, c.category_name, fi1.item_name as filter_1, fi2.item_name as filter_2, pi.supplier_price as supplier_price, $selectAddon as selected_price, IFNULL(SUM(p.quantity), 0) as totalPurchaseQnty, IFNULL(SUM(i.quantity), 0) as totalSalesQnty")
            ->from('product_information pi')
            ->join('product_category c', 'c.category_id = pi.category_id', 'left')
            ->join('filter_product fp1', 'fp1.product_id = pi.product_id AND fp1.filter_type_id = 1', 'left')
            ->join('filter_items fi1', 'fi1.item_id = fp1.filter_item_id', 'left')
            ->join('filter_product fp2', 'fp2.product_id = pi.product_id AND fp2.filter_type_id = 2', 'left')
            ->join('filter_items fi2', 'fi2.item_id = fp2.filter_item_id', 'left')
            ->join('purchase_stock_tbl p', 'p.product_id = pi.product_id', 'left')
            ->join('invoice_stock_tbl i', 'i.product_id = pi.product_id', 'left');
        if ($pricing_type) {
            $total->join('pricing_types_product pr', 'pr.product_id = p.product_id AND pr.pri_type_id = ' . $pricing_type, 'left');
        }

        // $total->where_in('pi.product_id', $product_ids);

        if ($purchase_from) {
            $total->having('totalPurchaseQnty >=', $purchase_from);
        }
        if ($purchase_to) {
            $total->having('totalPurchaseQnty <=', $purchase_to);
        }

        if ($sales_from) {
            $total->having('totalSalesQnty >=', $sales_from);
        }
        if ($sales_to) {
            $total->having('totalSalesQnty <=', $sales_to);
        }

        if ($balance_from) {
            $total->having('(totalPurchaseQnty - totalSalesQnty) >=', $balance_from);
        }
        if ($balance_to) {
            $total->having('(totalPurchaseQnty - totalSalesQnty) <=', $balance_to);
        }

        if ($supplier_from) {
            $total->having('supplier_price >=', $supplier_from);
        }
        if ($supplier_to) {
            $total->having('supplier_price <=', $supplier_to);
        }

        if ($total_supplier_from) {
            $total->having('(supplier_price * (totalPurchaseQnty - totalSalesQnty)) >=', $total_supplier_from);
        }
        if ($total_supplier_to) {
            $total->having('(supplier_price * (totalPurchaseQnty - totalSalesQnty)) <=', $total_supplier_to);
        }

        if ($sell_from) {
            $total->having('selected_price >=', $sell_from);
        }
        if ($sell_to) {
            $total->having('selected_price <=', $sell_to);
        }

        if ($total_sell_from) {
            $total->having('(selected_price * (totalPurchaseQnty - totalSalesQnty)) >=', $total_sell_from);
        }
        if ($total_sell_to) {
            $total->having('(selected_price * (totalPurchaseQnty - totalSalesQnty)) <=', $total_sell_to);
        }

        if ($start_date && $end_date) {
            $dateRangePurchase = "DATE(p.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
            $dateRangeSales = "DATE(i.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
            $total->where($dateRangePurchase, null, true)->or_where($dateRangeSales, null, true);
        }

        if (!empty($category_id) && !empty($category_id[0])) {
            $total->where_in('pi.category_id', $category_id);
        }

        if (!empty($product_name)) {
            $total->where('LOWER(pi.product_name) LIKE', "%$product_name%");
        }

        if (($general_filter || $material_filter) && count($product_ids)) {
            $total->where_in('pi.product_id', $product_ids);
        }

        $total = $total->limit($per_page, $page)->group_by('pi.product_id')->order_by('pi.product_name', 'asc')->get()->result_array();

        // echo"<pre>";var_dump(count($total));exit;

        return $total;
        // echo "<pre>";
        // print_r($total);
        // print_r($product_ids);
        // exit;

        // $totalPurchase = 0;
        // $purchaseData = $this->Products->product_purchase_info_sum($product_ids, $from_date, $to_date);
        // $totalPurchase = $this->db->select('(SUM(open_quantity) + SUM(b.quantity)) as total_purchase, (SUM(ind.quantity) ) as total_sales, ')
        //     ->from('product_information a')
        //     ->join('product_purchase_details b', 'b.product_id = a.product_id', 'left')
        //     ->join('invoice_details ind', 'ind.product_id = a.product_id', 'left')
        //     // ->join('invoice_return inr', 'inr.product_id = a.product_id', 'left')
        //     ->where_in('a.product_id', $product_ids)
        //     ->group_by('a.product_id');

        // if ($purchase_from) {
        //     $totalPurchase->having('total_purchase >=', $sales_from);
        // }
        // if ($purchase_to) {
        //     $totalPurchase->having('total_purchase <=', $sales_from);
        // }

        // if ($sales_from) {
        //     $totalPurchase->having('total_sales >=', $sales_from);
        // }
        // if ($sales_to) {
        //     $totalPurchase->having('total_sales <=', $sales_to);
        // }

        // $totalPurchase = $totalPurchase->get()->row();

        // // var_dump($totalPurchase->total_purchase);exit;
        // // $totalPurchase = (int) $totalOpenQuantity->total_open_quantity + (int)$purchaseData->total_purchase_quantity;

        // $totalSales = 0;
        // $salesData = $this->Products->invoice_data_sum($product_ids, $from_date, $to_date);
        // $returnData = $this->Products->return_invoice_data_sum($product_ids, $from_date, $to_date);
        // $totalSales = (int)$salesData->t_sales_qty - (int)$returnData->t_return_quantity;

        // $balance = $totalPurchase - $totalSales;


        // return [$totalPurchase, $totalSales, $balance];
    }

    public function sales_report_all_details_sum_all_count(
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

        $selectAddon = 'pi.price';
        if ($pricing_type) {
            $selectAddon = 'pr.product_price';
        }

        if (!empty($general_filter) || !empty($material_filter)) {
            $this->db->reset_query();
            $filter_products = $this->db->select('a.product_id')
                ->from('filter_product a, filter_product b');

            if (!empty($general_filter)) {
                $filter_products->where_in('a.filter_item_id', $general_filter);
            }
            if (!empty($material_filter)) {
                $filter_products->where_in('b.filter_item_id', $material_filter);
            }
            $filter_products->where('a.product_id = b.product_id');
            $filter_products = $filter_products->get()->result_array();
            foreach ($filter_products as $prod) {
                $product_ids[] = $prod['product_id'];
            }
        }


        $total = $this->db->select("pi.product_id, pi.product_name, pi.category_id, c.category_name, pi.supplier_price as supplier_price, $selectAddon as selected_price, IFNULL(SUM(p.quantity), 0) as totalPurchaseQnty, IFNULL(SUM(i.quantity), 0) as totalSalesQnty")
            ->from('product_information pi')
            ->join('product_category c', 'c.category_id = pi.category_id', 'left')
            ->join('filter_product fp1', 'fp1.product_id = pi.product_id AND fp1.filter_type_id = 1', 'left')
            ->join('filter_items fi1', 'fi1.item_id = fp1.filter_item_id', 'left')
            ->join('filter_product fp2', 'fp2.product_id = pi.product_id AND fp2.filter_type_id = 2', 'left')
            ->join('filter_items fi2', 'fi2.item_id = fp2.filter_item_id', 'left')
            ->join('purchase_stock_tbl p', 'p.product_id = pi.product_id', 'left')
            ->join('invoice_stock_tbl i', 'i.product_id = pi.product_id', 'left');
        if ($pricing_type) {
            $total->join('pricing_types_product pr', 'pr.product_id = p.product_id AND pr.pri_type_id = ' . $pricing_type, 'left');
        }

        // $total->where_in('pi.product_id', $product_ids);

        if ($purchase_from) {
            $total->having('totalPurchaseQnty >=', $purchase_from);
        }
        if ($purchase_to) {
            $total->having('totalPurchaseQnty <=', $purchase_to);
        }

        if ($sales_from) {
            $total->having('totalSalesQnty >=', $sales_from);
        }
        if ($sales_to) {
            $total->having('totalSalesQnty <=', $sales_to);
        }

        if ($balance_from) {
            $total->having('(totalPurchaseQnty - totalSalesQnty) >=', $balance_from);
        }
        if ($balance_to) {
            $total->having('(totalPurchaseQnty - totalSalesQnty) <=', $balance_to);
        }

        if ($supplier_from) {
            $total->having('supplier_price >=', $supplier_from);
        }
        if ($supplier_to) {
            $total->having('supplier_price <=', $supplier_to);
        }

        if ($total_supplier_from) {
            $total->having('(supplier_price * (totalPurchaseQnty - totalSalesQnty)) >=', $total_supplier_from);
        }
        if ($total_supplier_to) {
            $total->having('(supplier_price * (totalPurchaseQnty - totalSalesQnty)) <=', $total_supplier_to);
        }

        if ($sell_from) {
            $total->having('selected_price >=', $sell_from);
        }
        if ($sell_to) {
            $total->having('selected_price <=', $sell_to);
        }

        if ($total_sell_from) {
            $total->having('(selected_price * (totalPurchaseQnty - totalSalesQnty)) >=', $total_sell_from);
        }
        if ($total_sell_to) {
            $total->having('(selected_price * (totalPurchaseQnty - totalSalesQnty)) <=', $total_sell_to);
        }

        if ($start_date && $end_date) {
            $dateRangePurchase = "DATE(p.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
            $dateRangeSales = "DATE(i.created_at) BETWEEN DATE('" . date('Y-m-d', strtotime($start_date)) . "') AND DATE('" . date('Y-m-d', strtotime($end_date)) . "')";
            $total->where($dateRangePurchase, null, true)->or_where($dateRangeSales, null, true);
        }

        if (!empty($category_id) && !empty($category_id[0])) {
            $total->where_in('pi.category_id', $category_id);
        }

        if (!empty($product_name)) {
            $total->where('LOWER(pi.product_name) LIKE', "%$product_name%");
        }

        if (($general_filter || $material_filter) && count($product_ids)) {
            $total->where_in('pi.product_id', $product_ids);
        }

        $total = $total->group_by('pi.product_id')->get()->result_array();

        // echo"<pre>";var_dump(count($total));exit;

        return $total;
    }
}
