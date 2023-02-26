<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invoices extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->user_auth->check_customer_auth();
	}
	//Invoice List
	public function invoice_list()
	{
		$customer_id = $this->session->userdata('customer_id');
		$this->db->select('a.*,b.customer_name');
		$this->db->from('invoice a');
		$this->db->join('customer_information b','b.customer_id = a.customer_id');
		$this->db->where('a.customer_id',$customer_id);
		$this->db->order_by('a.invoice','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	

	//Invoice List
	public function total_customer_invoice($customer_id)
	{
		$this->db->select('a.*,b.customer_name');
		$this->db->from('invoice a');
		$this->db->join('customer_information b','b.customer_id = a.customer_id');
		$this->db->where('a.customer_id',$customer_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	//Retrieve invoice_html_data
	public function retrieve_invoice_html_data_old($invoice_id)
	{
		$this->db->select('
			a.*,
			b.*,
			c.*,
			d.product_id,
			d.product_name,
			d.product_details,
			d.product_model,d.unit,
			e.unit_short_name,
			f.variant_name,
			a.invoice_details
			');
		$this->db->from('invoice a');
		$this->db->join('customer_information b','b.customer_id = a.customer_id');
		$this->db->join('invoice_details c','c.invoice_id = a.invoice_id');
		$this->db->join('product_information d','d.product_id = c.product_id');
		$this->db->join('unit e','e.unit_id = d.unit','left');
		$this->db->join('variant f','f.variant_id = c.variant_id','left');
		$this->db->where('a.invoice_id',$invoice_id);
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

	public function get_invoice_card_payments($invoice_id) {
        $result = $this->db->select('*')
                        ->from('cardpayment')
                        ->where('invoice_id', $invoice_id)
                        ->get()->result_array();
        return $result;
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
}