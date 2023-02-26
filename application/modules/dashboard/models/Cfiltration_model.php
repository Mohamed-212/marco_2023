<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cfiltration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Parent List
    public function get_all_types() {
        $this->db->select('*');
        $this->db->from('filter_types');
        $this->db->order_by('fil_type_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

/////////////////////////pricing_types/////////////////////////////////


    public function get_no_types() {
        $this->db->select('count(pri_type_id) as nooftypes ');
        $this->db->from('pricing_types');
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function get_all_pricing_types() {
        $this->db->select('*');
        $this->db->from('pricing_types');
        $this->db->order_by('pri_type_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_all_pricing_types2($idarray) {
        $this->db->select('*');
        $this->db->from('pricing_types');
        $this->db->where_not_in('pri_type_id', $idarray);
        $this->db->order_by('pri_type_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_pricing_types() {
        $this->db->select('*');
        $this->db->from('pricing_types');
        $this->db->order_by('pri_type_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_pricing_data($product_id) {
        $this->db->select('*');
        $this->db->from('pricing_types_product');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /////////////////////////////////////////////////////
    ////////////////assembly_products//////////////////////

    public function check_assembly($product_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_assembly_products($product_id) {
        $this->db->select('*');
        $this->db->from('assembly_products');
        $this->db->where('parent_product_id', $product_id);
        $this->db->join('product_information', 'product_information.product_id = assembly_products.child_product_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function category_list_all() {
        $this->db->select('category_name, category_id');
        $this->db->from('product_category');
        $this->db->order_by('category_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_filter_type($id) {
        $this->db->select('filter_types.fil_type_name,filter_types.fil_type_id');
        $this->db->from('filter_types');
        $this->db->where('fil_type_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_filter_names($id) {
        $this->db->select('filter_items.item_id,filter_items.item_name');
        $this->db->from('filter_items');
        $this->db->where('type_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filter_categories($id) {
        $this->db->select('filter_type_category.category_id');
        $this->db->from('filter_type_category');
        $this->db->where('type_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function category_wise_filters($category_id) {
        $this->db->select('b.*');
        $this->db->from('filter_type_category a');
        $this->db->where('a.category_id', $category_id);
        $this->db->join('filter_types b', 'b.fil_type_id = a.type_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_type_wise_items($type_id) {
        $this->db->select('filter_items.item_id,filter_items.item_name');
        $this->db->from('filter_items');
        $this->db->where('type_id', $type_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function category_wise_filter_types($cat_id) {
        $this->db->select('a.*');
        $this->db->from('filter_types a');
        $this->db->join('filter_type_category b', 'b.type_id = a.fil_type_id');
        $this->db->where('b.category_id', $cat_id);
        $this->db->order_by('a.fil_type_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}
