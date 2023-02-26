<?php
class App extends CI_Controller
{

	private $table = "language";
	public function __construct()
	{
		parent::__construct();
	}
	//Index is loading first
	public function index()
	{
		$json[] = array(
			'status' => "OK"
		);
		echo json_encode(array('json' => $json), JSON_UNESCAPED_UNICODE);
	}

	//User login
	public function login()
	{
		$customer_mobile = $this->input->get('customer_mobile', true);
		$password1 = $this->input->get('password', true);

		if (empty($customer_mobile) || empty($password1)) {
			$json[] = array(
				'error' => "Please fill up all required field !"
			);
			echo json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$password = md5("gef" . $password1);
			$this->db->where('customer_mobile', $customer_mobile);
			$this->db->where('password', $password);
			$this->db->where('status', 1);
			$query    = $this->db->get('customer_information');
			$num_rows = $query->num_rows();
			$result   = $query->row();

			if ($num_rows > 0) {
				$json[] = array(
					'auth_status' => 'true',
					'user_id'	  => $result->customer_id
				);
				echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'auth_status' => 'false',
					'user_id'	  => (!empty($result->customer_id) ? $result->customer_id : null)
				);
				echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		}
	}
	//User Registration
	public function registration()
	{

		$first_name      = $this->input->get('first_name', true);
		$last_name       = $this->input->get('last_name', true);
		$full_name       = $first_name . '' . $last_name;
		$email 		     = $this->input->get('email', true);
		$birth_day 		 = $this->input->get('birth_day', true);
		$customer_mobile = $this->input->get('customer_mobile', true);
		$password 	     = $this->input->get('password', true);
		if (empty($full_name) || empty($email) || empty($password)) {
			$json[] = array(
				'error' => "Please fillup all required field !",
			);
			echo $json_encode = json_encode(array('registration_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$check_email = $this->test_input($email);
			if (filter_var($check_email, FILTER_VALIDATE_EMAIL)) {
				//Email existing check
				$customer = $this->db->select('*')
					->from('customer_information')
					->where('customer_email', $email)
					->get()
					->num_rows();

				if ($customer > 0) {
					$json[] = array(
						'error'  => 'Email already exists !'
					);
					echo $json_encode = json_encode(array('registration_info' => $json), JSON_UNESCAPED_UNICODE);
				} else {
					$data = array(
						'customer_id'    => $this->generator(15),
						'customer_name'  => $full_name,
						'first_name'     => $first_name,
						'last_name'      => $last_name,
						'customer_email' => $email,
						'customer_mobile' => $customer_mobile,
						'birth_day'      => $birth_day,
						'password' 	     => md5("gef" . $password),
						'status' 		 => 1,
					);
					$result = $this->db->insert('customer_information', $data);
					if ($result) {
						$json[] = array(
							'user_id' => $data['customer_id'],
							'status'  => 'true'
						);
						echo $json_encode = json_encode(array('registration_info' => $json), JSON_UNESCAPED_UNICODE);
					}
				}
			} else {
				$json[] = array(
					'error' => "Email is not validate!",
				);
				echo $json_encode = json_encode(array('registration_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		}
	}
	//Email testing
	public function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	// Show all category upto 2 level
	public function categorylist()
	{
		$main_cats = $this->db->select('category_id,category_name as name,cat_favicon as image, cat_image as big_image')
			->from('product_category')
			->where('cat_type', 1)
			->where('status', 1)
			->get()
			->result_array();
		$full_cats = array();
		if (!empty($main_cats)) {
			foreach ($main_cats as $maincat) {
				$subcats_list = $this->db->select('category_id as sub_category_id ,category_name as name,cat_favicon as image, cat_image as big_image')
					->from('product_category')
					->where('parent_category_id', $maincat['category_id'])
					->where('cat_type', 2)
					->where('status', 1)
					->get()
					->result_array();
				if (!empty($subcats_list)) {

					foreach ($subcats_list as $key => $subcat) {
						$categoriesleveltwo = $this->db->select('category_id as child_category_id ,category_name as name,cat_favicon as image, cat_image as big_image')
							->from('product_category')
							->where('parent_category_id', $subcat['sub_category_id'])
							->where('cat_type', 2)
							->where('status', 1)
							->get()
							->result_array();
						if (!empty($subcats_list)) {
							$subcats_list[$key]['categoriesleveltwo'] = $categoriesleveltwo;
						} else {
							$subcats_list[$key]['categoriesleveltwo'] = [];
						}
					}
					$maincat['categorieslevelone'] = $subcats_list;
				} else {
					$maincat['categorieslevelone'] = [];
				}
				$full_cats[] = $maincat;
			}
		}
		if ($full_cats) {
			$status = 'success';
			echo $json_encode = json_encode(array('category_info' => $full_cats, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => "error",
				'message' => "Slider not found !",
			);
			$status = 'error';
			echo $json_encode = json_encode(array('slider_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	//Return product list category wise
	public function all_child_category($category_id)
	{
		$categories_ids[] = $category_id;
		$categories = $this->db->select('category_id')->from('product_category')->where('parent_category_id', $category_id)->get()->result_array();
		foreach ($categories as $key => $category) {
			$categories_ids[] = $category['category_id'];
			$categories2 = $this->db->select('category_id')->from('product_category')->where('parent_category_id', $category['category_id'])->get()->result_array();
			foreach ($categories2 as $key2 => $category2) {
				$categories_ids[] = $category2['category_id'];
				$categories3 = $this->db->select('category_id')->from('product_category')->where('parent_category_id', $category2['category_id'])->get()->result_array();
				foreach ($categories3 as $key3 => $category3) {
					$categories_ids[] = $category3['category_id'];
					$categories4 = $this->db->select('category_id')->from('product_category')->where('parent_category_id', $category3['category_id'])->get()->result_array();
					foreach ($categories4 as $key4 => $category4) {
						$categories_ids[] = $category4['category_id'];
					}
				}
			}
		}
		return $categories_ids;
	}
	public function cat_product_list_count($cat_id)
	{
		$category_ids = $this->all_child_category($cat_id);
		$this->db->select('a.*');
		$this->db->from('product_information a');
		$this->db->where('a.is_assemble IS NULL');
		$this->db->where_in('a.category_id', $category_ids);
		$this->db->group_by('a.product_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {

			return $query->num_rows();
		}
		return false;
	}
	public function category_product($cat_id, $per_page = null, $page = null)
	{

		$category_ids = $this->all_child_category($cat_id);
		$this->db->select('a.*,b.category_name');
		$this->db->from('product_information a');
		$this->db->join('product_category b', 'a.category_id=b.category_id');
		$this->db->where_in('a.is_assemble', array(0, null));
		$this->db->where_in('a.category_id', $category_ids);
		$this->db->where('a.assembly', 0);
		$this->db->limit($per_page, $page);
		$this->db->order_by('product_name');
		$this->db->group_by('a.product_id');
		$query = $this->db->get();
		$w_cat_pro = $query->result();
		return $w_cat_pro;
	}
	public function productlist()
	{
		$category_id     = $this->input->get('category', true);
		$get_per_page    = $this->input->get('per_page', true);
		$get_page_number = ($this->input->get('page_number', true) - 1) * $get_per_page;
		if (!empty($category_id)) {
			#pagination starts
			$total_rows  = $this->cat_product_list_count($category_id);
			#pagination ends
			$productlist = $this->category_product($category_id, $get_per_page, $get_page_number);
		} else {
			#pagination starts
			$total_rows = $this->db->select('*')->from('product_information')->where('is_assemble IS NULL')->order_by('id', 'desc')->get()->num_rows();
			#pagination ends
			$productlist = $this->db->select('*')->from('product_information')->where('is_assemble IS NULL',)->limit($get_per_page, $get_page_number)->order_by('id', 'desc')->get()->result();
		}
		if ($productlist) {
			foreach ($productlist as $product) {
				$product_rating = $this->rating_calculator($product->product_id);
				$purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
					->from('transfer')
					->where('product_id', $product->product_id)
					->get()
					->row();
				$sales = $this->db->select("SUM(quantity) as totalSalesQnty")
					->from('invoice_stock_tbl')
					->where('product_id', $product->product_id)
					->get()
					->row();
				$stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
				if ($stock <= 0) {
					$stock = 0;
				}
				$json[] = array(
					'id' 			     => $product->product_id,
					'name'			     => (!empty($product->product_name) ? $product->product_name : null),
					'cat_id'		     => (!empty($product->category_id) ? $product->category_id : null),
					'price'			     => (!empty($product->price) ? $product->price : null),
					'model'			     => (!empty($product->product_model) ? $product->product_model : null),
					'image_thumb'	     => (!empty($product->image_thumb) ? $product->image_thumb : null),
					'product_details'    => (!empty($product->product_details) ? $product->product_details : null),
					'description'	     => (!empty($product->description) ? $product->description : null),
					'variants'		     => (!empty($product->variants) ? $product->variants : null),
					'onsale'		     => (!empty($product->onsale) ? $product->onsale : null),
					'best_sale'		     => (!empty($product->best_sale) ? $product->best_sale : null),
					'onsale_price'	     => (!empty($product->onsale_price) ? $product->onsale_price : null),
					'image_large_details' => (!empty($product->image_large_details) ? $product->image_large_details : null),
					'rating'		     => (!empty($product_rating) ? $product_rating : 0),
					'stock'		     	 => $stock,
				);
			}
			$status = 'success';
			echo $json_encode = json_encode(array('product_info' => $json, 'total_rows' => $total_rows, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'error' => "Product not found !",
			);
			$status = 'error';
			echo $json_encode = json_encode(array('product_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	//Customer info
	public function customer_info($customer_id = null)
	{
		$customer_info = $this->db->select('a.*,b.name as country_name')
			->from('customer_information a')
			->where('a.customer_id', $customer_id)
			->join('countries b', 'a.country = b.id', 'left')
			->get()
			->row();
		if ($customer_info) {
			$status = 'success';
			echo json_encode(array('customer_info' => $customer_info, 'status' => $status));
		} else {
			$json[] = array(
				'error' => "Customer not found !",
			);
			$status = 'error';
			echo $json_encode = json_encode(array('customer_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	//Review list
	public function review_list()
	{
		$product_id  = $this->input->get('product_id', TRUE);
		$review_list = $this->db->select('*')
			->from('product_review')
			->where('product_id', $product_id)
			->get()
			->result();
		if ($review_list) {
			foreach ($review_list as $review) {
				$review_name = $this->customer_info($review->reviewer_id);
				$json[] = array(
					'product_review_id' => $review->product_review_id,
					'product_id' 	   => $review->product_id,
					'reviewer_id' 	   => $review->reviewer_id,
					'reviewer_name'    => (!empty($review_name) ? $review_name->customer_name : null),
					'comments' 		   => $review->comments,
					'rate' 			   => $review->rate,
				);
			}
			$status = 'success';
			echo $json_encode = json_encode(array('review_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'error' => "No review found!",
			);
			$status = 'error';
			echo $json_encode = json_encode(array('review_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	//Review entry
	public function review_entry()
	{

		$data = array(
			'product_review_id' => $this->generator(15),
			'product_id' 	=> $this->input->get('product_id', true),
			'reviewer_id' 	=> $this->input->get('user_id', true),
			'comments' 		=> $this->input->get('comments', true),
			'rate' 			=> $this->input->get('rate', true),
			'status' 		=> '1',
		);
		$result = $this->db->select('*')
			->from('product_review')
			->where('product_id', $data['product_id'])
			->where('reviewer_id', $data['reviewer_id'])
			->get()
			->num_rows();

		if ($result > 0) {
			$json[] = array(
				'status' => "false",
				'error' => "You are already reviwed !",
			);
			echo $json_encode = json_encode(array('review_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$result = $this->db->insert('product_review', $data);
			if ($result) {
				$json[] = array(
					'status' => "true",
					'success' => "You are reviewed successfully.",
				);
				echo $json_encode = json_encode(array('review_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		}
	}
	//Rating calculator
	public function rating_calculator($product_id = null)
	{
		$result =   $this->db->select('sum(rate) as rates')
			->from('product_review')
			->where('product_id', $product_id)
			->get()
			->row();
		$rater = $this->db->select('rate')
			->from('product_review')
			->where('product_id', $product_id)
			->get()
			->num_rows();
		if ($rater) {
			return $total_rate = ($result->rates / $rater);
		} else {
			return 0;
		}
	}

	//Slider list
	public function slider_list()
	{
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('status', 1);
		$this->db->order_by('slider_position', 'asc');
		$query = $this->db->get()->result();

		if ($query) {
			foreach ($query as $slider) {
				$json[] = array(
					'slider_id' 	 => $slider->slider_id,
					'slider_link' 	 => $slider->slider_link,
					'slider_image'   => base_url() . $slider->slider_image,
					'slider_position' => $slider->slider_position,
					'slider_category' => $slider->slider_category,
					'status' => $slider->status
				);
			}
			$status = 'success';
			echo $json_encode = json_encode(array('slider_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => "error",
				'message' => "Slider not found !",
			);
			$status = 'error';
			echo $json_encode = json_encode(array('slider_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}

	//Best sale product list
	public function best_sale()
	{
		$productlist = $this->db->select('*')
			->from('product_information')
			->where('is_assemble IS NULL')
			->where('assembly', 0)
			->where('best_sale', 1)
			->order_by('id', 'desc')
			->limit(4)
			->get()
			->result();
		if ($productlist) {
			foreach ($productlist as $product) {

				$product_rating = $this->rating_calculator($product->product_id);
				$taxes_info    = $this->get_tax($product->product_id);
				$tax_details   = array();
				if (!empty($taxes_info)) {
					$tax_details = $taxes_info;
				}


				$purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
					->from('transfer')
					->where('product_id', $product->product_id)
					->get()
					->row();
				$sales = $this->db->select("SUM(quantity) as totalSalesQnty")
					->from('invoice_stock_tbl')
					->where('product_id', $product->product_id)
					->get()
					->row();
				$stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
				if ($stock <= 0) {
					$stock = 0;
				}
				$json[] = array(
					'id' 			     => $product->product_id,
					'name'			     => (!empty($product->product_name) ? $product->product_name : null),
					'cat_id'		     => (!empty($product->category_id) ? $product->category_id : null),
					'price'			     => (!empty($product->price) ? $product->price : null),
					'model'			     => (!empty($product->product_model) ? $product->product_model : null),
					'image_thumb'	     => (!empty($product->image_thumb) ? $product->image_thumb : null),
					'product_details'    => (!empty($product->product_details) ? $product->product_details : null),
					'description'	     => (!empty($product->description) ? $product->description : null),
					'variants'		     => (!empty($product->variants) ? $product->variants : null),
					'onsale'		     => (!empty($product->onsale) ? $product->onsale : null),
					'best_sale'		     => (!empty($product->best_sale) ? $product->best_sale : null),
					'onsale_price'	     => (!empty($product->onsale_price) ? $product->onsale_price : null),
					'image_large_details' => (!empty($product->image_large_details) ? $product->image_large_details : null),
					'tax_details'        => $tax_details,
					'rating'	         => (!empty($product_rating) ? $product_rating : 0),
					'stock'	             => $stock,
				);
			}
			if ($product) {
				$status = 'success';
				echo $json_encode = json_encode(array('product_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'status' => "error",
					'message' => "Best sale products not found !",
				);
				$status = 'error';
				echo $json_encode = json_encode(array('product_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
			}
		}
	}
	public function get_tax($product_id)
	{
		$taxes            = $this->db->select('tax_id')->from('tax')->where('status', 1)->get()->result_array();
		$taxe_ids         = array_column($taxes, 'tax_id');
		$product_wise_tax = $this->db->select('a.*,b.tax_name')
			->from('tax_product_service a')
			->where('a.product_id', $product_id)
			->join('tax b', 'a.tax_id = b.tax_id')
			->where_in('a.tax_id', $taxe_ids)
			->get()->result_array();
		return $product_wise_tax;
	}

	//Search product list
	public function search()
	{
		$keyword    = $this->input->get('keyword', true);
		$per_page   = $this->input->get('per_page', true);
		$page_number = ($this->input->get('page_number', true) - 1) * $per_page;


		if (!empty($keyword)) {
			$res_rows = $this->db->select('COUNT(product_id) as total_product')
				->from('product_information')
				->like('product_name', $keyword)
				->or_like('product_model', $keyword)
				->get()->row();

			$total_rows = (!empty($res_rows->total_product) ? $res_rows->total_product : 0);

			$searchlist = $this->db->select('*')
				->from('product_information')
				->like('product_name', $keyword)
				->or_like('product_model', $keyword)
				->where('is_assemble IS NULL')
				->where('assembly', 0)
				->limit($per_page, $page_number)
				->get()
				->result();

			if ($searchlist) {
				foreach ($searchlist as $search) {
					$product_rating = $this->rating_calculator($search->product_id);
					$purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
						->from('transfer')
						->where('product_id', $search->product_id)
						->get()
						->row();
					$sales = $this->db->select("SUM(quantity) as totalSalesQnty")
						->from('invoice_stock_tbl')
						->where('product_id', $search->product_id)
						->get()
						->row();
					$stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
					if ($stock <= 0) {
						$stock = 0;
					}
					$json[] = array(
						'id' 			 => $search->product_id,
						'name'			 => (!empty($search->product_name) ? $search->product_name : null),
						'cat_id'		 => (!empty($search->category_id) ? $search->category_id : null),
						'price'			 => (!empty($search->price) ? $search->price : null),
						'model'			 => (!empty($search->product_model) ? $search->product_model : null),
						'image_thumb'	 => (!empty($search->image_thumb) ? $search->image_thumb : null),
						'product_details' => (!empty($search->product_details) ? $search->product_details : null),
						'description'	 => (!empty($search->description) ? $search->description : null),
						'variants'		 => (!empty($search->variants) ? $search->variants : null),
						'onsale'		 => (!empty($search->onsale) ? $search->onsale : null),
						'onsale_price'	 => (!empty($search->onsale_price) ? $search->onsale_price : null),
						'image_large_details' => (!empty($search->image_large_details) ? $search->image_large_details : null),
						'rating'		 => (!empty($product_rating) ? $product_rating : 0),
						'stock'		     => $stock,
					);
				}

				$status = 'success';
				echo $json_encode = json_encode(array('product_info' => $json, 'total_rows' => $total_rows, 'status' => $status), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'error' => "Product not found !",
				);
				$status = 'error';
				echo $json_encode = json_encode(array('product_info' => $json, 'total_rows' => $total_rows, 'status' => $status), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$json[] = array(
				'error' => "Please enter search keyword.",
			);
			echo $json_encode = json_encode(array('product_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Variant name
	public function variant()
	{
		$variant_id = $this->input->get('variant_id', true);
		$result = $this->db->select('*')
			->from('variant')
			->where('variant_id', $variant_id)
			->get()
			->row();

		if ($result) {
			$json[] = array(
				'variant_name' => $result->variant_name,
				'variant_id'   => $result->variant_id,
			);
			echo $json_encode = json_encode(array('variant_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'error' => "Variant not found !",
			);
			echo $json_encode = json_encode(array('variant_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Product stock check
	public function stock()
	{
		$variant_id = $this->input->get('variant_id', true);
		$product_id = $this->input->get('product_id', true);

		if (empty($variant_id) || empty($product_id)) {
			$json[] = array(
				'error' => "Please fillup all required field !",
			);
			echo $json_encode = json_encode(array('stock_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {

			$store = $this->db->select('*')
				->from('store_set')
				->where('default_status', '1')
				->get()
				->row();

			if ($store) {
				$this->db->select("b.*,sum(b.quantity) as totalPrhcsCtn");
				$this->db->from('product_purchase_details b');
				$this->db->where('b.store_id', $store->store_id);
				$this->db->where('b.variant_id', $variant_id);
				$this->db->where('b.product_id', $product_id);
				$query = $this->db->get();
				$purchase_details = $query->result_array();

				if ($purchase_details) {
					foreach ($purchase_details as $purchase) {
						$sales = $this->db->select("sum(quantity) as totalSalesQnty")
							->from('invoice_stock_tbl')
							->where('product_id', $purchase['product_id'])
							->where('variant_id', $purchase['variant_id'])
							->where('store_id', $purchase['store_id'])
							->get()
							->row();
						$stock_info = ($purchase['totalPrhcsCtn'] - $sales->totalSalesQnty);
					}

					if ($stock_info > 0) {
						$json[] = array(
							'status' => 'true',
							'stock'  => $stock_info,
						);
						echo $json_encode = json_encode(array('stock_info' => $json), JSON_UNESCAPED_UNICODE);
					} else {
						$json[] = array(
							'status' => 'false',
							'stock'  => '0',
						);
						echo $json_encode = json_encode(array('stock_info' => $json), JSON_UNESCAPED_UNICODE);
					}
				} else {
					$json[] = array(
						'status' => 'false',
						'stock'  => '0',
					);
					echo $json_encode = json_encode(array('stock_info' => $json), JSON_UNESCAPED_UNICODE);
				}
			} else {
				$json[] = array(
					'error' => "Please set default store !",
				);
				echo $json_encode = json_encode(array('stock_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		}
	}

	//User information view
	public function user_info()
	{
		$user_id = $this->input->get('user_id', true);
		if ($user_id) {
			$customer = $this->db->select('*')
				->from('customer_information')
				->where('customer_id', $user_id)
				->get()
				->row();
			if ($customer) {
				$json[] = array(
					'customer_id' => $customer->customer_id,
					'name' 		 => $customer->customer_name,
					'first_name' => $customer->first_name,
					'last_name'  => $customer->last_name,
					'email' 	 => $customer->customer_email,
					'address_1'  => $customer->customer_address_1,
					'address_2'  => $customer->customer_address_2,
					'city' 		 => $customer->city,
					'state' 	 => $customer->state,
					'country' 	 => $customer->country,
					'zip' 		 => $customer->zip,
					'mobile' 	 => $customer->customer_mobile,
					'image' 	 => $customer->image,
					'company' 	 => $customer->company,
					'password' 	 => $customer->password,
				);
				echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'error' => "User not found !",
				);
				echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$json[] = array(
				'error' => "Please enter user ID !",
			);
			echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//User information update
	public function user_update()
	{
		$userinfo = (object) $_POST;
		if (!empty($userinfo)) {

			$customer_id = $userinfo->user_id;
			$full_name   = $userinfo->full_name;
			$first_name  = $userinfo->first_name;
			$last_name   = $userinfo->last_name;
			$email   	 = $userinfo->email;
			$address_1   = $userinfo->address_1;
			$address_2   = $userinfo->address_2;
			$city   	 = $userinfo->city;
			$state   	 = $userinfo->state;
			$country_id  = $userinfo->country;
			$zip     	 = $userinfo->zip;
			$mobile      = $userinfo->mobile;
			$company     = $userinfo->company;
			$user_image  = NULL;
			// Image Upload
			if (!empty($_FILES['image']['name'])) {
				$fileName  =  $_FILES['image']['name'];
				$tempPath  =  $_FILES['image']['tmp_name'];
				$fileSize  =  $_FILES['image']['size'];
				$upload_path = 'assets/dist/img/profile_picture/'; // set upload folder path
				$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get image extension
				// valid image extensions
				$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
				// allow valid image file formats
				if (in_array($fileExt, $valid_extensions)) {
					// check file size '5MB'
					if ($fileSize < 5000000) {
						move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
						$user_image = $upload_path . $fileName;
					} else {
						$json[] = array(
							'status' => "false",
							'error'  => "Sorry, your file is too large, please upload 5 MB size !",
						);
						echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
						exit();
					}
				} else {
					$json[] = array(
						'status' => "false",
						'error'  => "Sorry, only JPG, JPEG, PNG & GIF files are allowed !",
					);
					echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
					exit();
				}
			}
			$country_info = $this->db->select('*')
				->from('countries')
				->where('id', $country_id)
				->get()
				->row();
			$customer_info = array(
				'customer_name' 		 => $full_name,
				'first_name'			 => $first_name,
				'last_name' 			 => $last_name,
				'customer_email' 		 => $email,
				'customer_short_address' => $city . ',' . $state . ',' . (!empty($country_info->name) ? $country_info->name : null) . ',' . $zip,
				'customer_address_1'	 => $address_1,
				'customer_address_2'	 => $address_2,
				'city' 					 => $city,
				'state' 				 => $state,
				'country' 				 => (!empty($country_id) ? $country_id : null),
				'zip' 					 => $zip,
				'customer_mobile' 		 => $mobile,
				'image' 				 => $user_image,
				'company' 				 => $company
			);
			$this->db->where('customer_id', $customer_id);
			$result = $this->db->update('customer_information', $customer_info);
			if ($result) {
				$json[] = array(
					'status'  => "true",
					'success' => "User information update successfully !",
				);
				echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'status' => "false",
					'error'  => "User information not updated !",
				);
				echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$json[] = array(
				'status' => "false",
				'error'  => "Invalid request !",
			);
			echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Deleviry method list
	public function shipping_list()
	{
		$deleviry_info = $this->db->select('*')
			->from('shipping_method')
			->get()
			->result();
		if ($deleviry_info) {
			foreach ($deleviry_info as $delivery) {
				$json[] = array(
					'id' 		   => $delivery->method_id,
					'name'		   => $delivery->method_name,
					'details'	   => $delivery->details,
					'charge_amount' => $delivery->charge_amount,
					'position'	   => $delivery->position,
				);
			}
			echo $json_encode = json_encode(array('deleviry_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => "false",
				'error'  => "Delivery method not found !",
			);
			echo $json_encode = json_encode(array('deleviry_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}
	//Wishlist info
	public function wishlist()
	{
		$user_id 	= $this->input->get('user_id', true);
		$product_id = $this->input->get('product_id', true);
		if (!empty($user_id) && !empty($product_id)) {
			$result = $this->db->select('*')
				->from('wishlist')
				->where('user_id', $user_id)
				->where('product_id', $product_id)
				->get()
				->num_rows();
			if ($result > 0) {
				$json[] = array(
					'status'    => 'false',
					'error'   => 'Product already added to wishlist !',
				);
				echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$data = array(
					'wishlist_id' => $this->generator('10'),
					'user_id' => $user_id,
					'product_id' => $product_id,
				);
				$wishlist = $this->db->insert('wishlist', $data);
				if ($wishlist) {
					$json[] = array(
						'status'    => 'true',
						'success'   => 'Product added to wishlist.',
					);
					echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
				} else {
					$json[] = array(
						'status' => "false",
						'error'  => "Wishlist not found !",
					);
					echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
				}
			}
		} elseif (!empty($user_id)) {
			$wishlist = $this->db->select('a.*,b.*')
				->from('wishlist a')
				->join('product_information b', 'a.product_id = b.product_id')
				->where('a.user_id', $user_id)
				->get()
				->result();
			if ($wishlist) {
				foreach ($wishlist as $list) {
					$product_rating = $this->rating_calculator($list->product_id);
					$json[] = array(
						'wishlist_id'    => $list->wishlist_id,
						'product_id'     => $list->product_id,
						'user_id'        => $list->user_id,
						'name'		     => (!empty($list->product_name) ? $list->product_name : null),
						'cat_id'	     => (!empty($list->category_id) ? $list->category_id : null),
						'price'		     => (!empty($list->price) ? $list->price : null),
						'model'		     => (!empty($list->product_model) ? $list->product_model : null),
						'image_thumb'    => (!empty($list->image_thumb) ? $list->image_thumb : null),
						'product_details' => (!empty($list->product_details) ? $list->product_details : null),
						'description'    => (!empty($list->description) ? $list->description : null),
						'variants'	     => (!empty($list->variants) ? $list->variants : null),
						'onsale'	     => (!empty($list->onsale) ? $list->onsale : null),
						'onsale_price'   => (!empty($list->onsale_price) ? $list->onsale_price : null),
						'image_large_details' => (!empty($list->image_large_details) ? $list->image_large_details : null),
						'rating'	         => (!empty($product_rating) ? $product_rating : 0),
					);
				}
				echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'status' => "false",
					'error'  => "Wishlist not found !",
				);
				echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$wishlist = $this->db->select('*')
				->from('wishlist')
				->get()
				->result();
			if ($wishlist) {
				foreach ($wishlist as $list) {
					$json[] = array(
						'wishlist_id' => $list->wishlist_id,
						'product_id'  => $list->product_id,
						'user_id'     => $list->user_id,
					);
				}
				echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'status' => "false",
					'error'  => "Wishlist not found !",
				);
				echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		}
	}

	//Wishlist remove/delete
	public function wishlist_remove()
	{
		$wishlist_id = $this->input->get('wishlist_id', true);
		if ($wishlist_id) {
			$result = $this->db->where('wishlist_id', $wishlist_id)
				->delete('wishlist');
			if ($result) {
				$json[] = array(
					'status' => "true",
					'success' => "Wishlist delete successfully.",
				);
				echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'status' => "false",
					'error'  => "Wishlist not delete !",
				);
				echo $json_encode = json_encode(array('wishlist_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		}
	}

	//County list
	public function country_list()
	{
		$country_list = $this->db->select('*')
			->from('countries')
			->get()
			->result();
		if ($country_list) {
			foreach ($country_list as $country) {
				$json[] = array(
					'id' 		=> $country->id,
					'sortname'  => $country->sortname,
					'name'     	=> $country->name,
					'phonecode' => $country->phonecode,
				);
			}
			echo $json_encode = json_encode(array('country_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => "false",
				'error'  => "Country not found !",
			);
			echo $json_encode = json_encode(array('country_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//County via id
	public function country_info()
	{

		$id = $this->input->get('id', true);

		$country_list = $this->db->select('*')
			->from('countries')
			->where('id', $id)
			->get()
			->result();
		if ($country_list) {
			foreach ($country_list as $country) {
				$json[] = array(
					'id' 		=> $country->id,
					'sortname'  => $country->sortname,
					'name'     	=> $country->name,
					'phonecode' => $country->phonecode,
				);
			}
			echo $json_encode = json_encode(array('country_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => "false",
				'error'  => "Country not found !",
			);
			echo $json_encode = json_encode(array('country_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//State list
	public function state_list()
	{
		$country_id = $this->input->get('country_id', true);

		$state_list = $this->db->select('*')
			->from('states')
			->where('country_id', $country_id)
			->get()
			->result();

		if ($state_list) {
			foreach ($state_list as $state) {
				$json[] = array(
					'id' 		 => $state->id,
					'name'  	 => $state->name,
					'country_id' => $state->country_id,
				);
			}
			echo $json_encode = json_encode(array('state_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => "false",
				'error'  => "State not found !",
			);
			echo $json_encode = json_encode(array('state_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Get Supplier rate of a product
	public function supplier_rate($product_id)
	{
		$this->db->select('supplier_price');
		$this->db->from('product_information');
		$this->db->where(array('product_id' => $product_id));
		$query = $this->db->get();
		return $query->row();
	}

	// Coupon update
	private function order_coupon_update($customer_id, $order_id, $coupon_code)
	{
		$this->db->set('coupon', $coupon_code);
		$this->db->where('customer_id', $customer_id);
		$this->db->where('order_id', $order_id);
		$result = $this->db->update('order');
		return $result;
	}

	public function countries()
	{
		$countries = $this->db->select('*')
			->from('countries')
			->get()
			->result_array();
		if ($countries) {
			echo $json_encode = json_encode(array('status' => 'success', 'countries' => $countries), JSON_UNESCAPED_UNICODE);
		} else {
			$json = array(
				'status' => "false",
				'error'  => "countries not found !",
			);
			echo $json_encode = json_encode(array('status' => 'error', 'countries' => $json), JSON_UNESCAPED_UNICODE);
		}
	}
	public function states($country_id)
	{
		$states = $this->db->select('*')
			->from('states')
			->where('country_id', $country_id)
			->get()
			->result_array();
		if ($states) {
			echo $json_encode = json_encode(array('status' => 'success', 'states' => $states), JSON_UNESCAPED_UNICODE);
		} else {
			$json = array(
				'status' => "false",
				'error'  => "states not found !",
			);
			echo $json_encode = json_encode(array('status' => 'error', 'states' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Checkout process
	public function checkout()
	{
		$get_order_data = file_get_contents('php://input');
		$order_info = json_decode($get_order_data);

		if ($order_info) {
			$order_id = $this->generator(15);
			// Select country from country table
			$country_info = $this->db->select('*')
				->from('countries')
				->where('id', $order_info->shippingInfo->country)
				->get()
				->row();
			// Shipping info entry
			$ship_info = array(
				'customer_id' 	        => $order_info->orderInfo->userId,
				'order_id'    	        => $order_id,
				'customer_name'         => $order_info->shippingInfo->fullname,
				'customer_short_address' => $order_info->shippingInfo->city . "," . $order_info->shippingInfo->state . "," . $country_info->name . "," . $order_info->shippingInfo->zip,
				'customer_address_1'    => $order_info->shippingInfo->Address,
				'customer_mobile'       => $order_info->shippingInfo->phone,
				'customer_email'        => $order_info->shippingInfo->email,
				'city'   		        => $order_info->shippingInfo->city,
				'state'   		        => $order_info->shippingInfo->state,
				'country'  		        => $order_info->shippingInfo->country,
				'zip'   		        => $order_info->shippingInfo->zip,
				'company'   	        => $order_info->shippingInfo->company,
			);

			if ($order_info->orderInfo->shippingBillingStatus == 1) {

				// redirect_for_insufficient_points start
				// redirect_for_insufficient_points end

				//Update billing info

				$this->db->set('customer_name', $ship_info["customer_name"])
					->set('customer_short_address', $ship_info["customer_short_address"])
					->set('customer_address_1', $ship_info["customer_address_1"])
					->set('customer_mobile', $ship_info["customer_mobile"])
					->set('customer_email', $ship_info["customer_email"])
					->set('city', $ship_info["city"])
					->set('state', $ship_info["state"])
					->set('country', $ship_info["country"])
					->set('zip', $ship_info["zip"])
					->set('company', $ship_info["company"])
					->where('customer_id', $order_info->orderInfo->userId)
					->update('customer_information');

				$customer_info = $this->db->select('*')
					->from('shipping_info')
					->where('customer_id', $order_info->orderInfo->userId)
					->get()
					->num_rows();

				if ($customer_info > 0) {
					$this->db->where('customer_id', $order_info->orderInfo->userId)
						->update('shipping_info', $ship_info);
				} else {
					$this->db->insert('shipping_info', $ship_info);
				}
			} else {
				// redirect_for_insufficient_points start
				// redirect_for_insufficient_points end
				// Billing info entry
				$billing_country = $this->db->select('*')
					->from('countries')
					->where('id', $order_info->billingInfo->country)
					->get()
					->row();
				$bill_info = array(
					'customer_id' 	=> $order_info->orderInfo->userId,
					'order_id'    	=> $order_id,
					'customer_name' => $order_info->billingInfo->fullname,
					'customer_short_address' => $order_info->billingInfo->city . "," . $order_info->billingInfo->state . "," . $billing_country->name . "," . $order_info->billingInfo->zip,
					'customer_address_1'    => $order_info->billingInfo->Address,
					'customer_mobile'       => $order_info->billingInfo->phone,
					'customer_email' => $order_info->billingInfo->email,
					'city'   		=> $order_info->billingInfo->city,
					'state'   		=> $order_info->billingInfo->state,
					'country'  		=> $order_info->billingInfo->country,
					'zip'   		=> $order_info->billingInfo->zip,
					'company'   	=> $order_info->billingInfo->company,
				);
				$this->db->set('customer_name', $bill_info["customer_name"])
					->set('customer_short_address', $bill_info["customer_short_address"])
					->set('customer_address_1', $bill_info["customer_address_1"])
					->set('customer_mobile', $bill_info["customer_mobile"])
					->set('customer_email', $bill_info["customer_email"])
					->set('city', $bill_info["city"])
					->set('state', $bill_info["state"])
					->set('country', $bill_info["country"])
					->set('zip', $bill_info["zip"])
					->set('company', $bill_info["company"])
					->where('customer_id', $order_info->orderInfo->userId)
					->update('customer_information');
				$customer_info = $this->db->select('*')
					->from('shipping_info')
					->where('customer_id', $order_info->orderInfo->userId)
					->get()
					->num_rows();
				if ($customer_info > 0) {
					$this->db->where('customer_id', $order_info->orderInfo->userId)
						->update('shipping_info', $ship_info);
				} else {
					$this->db->insert('shipping_info', $ship_info);
				}
			}
			if ($order_info->orderInfo->payment_method == 1) {
				// loyalty point insertion start
				// loyalty point redeem end
				$paid_amount = 0;
				$due_amount  = 0;
				if ($order_info->orderInfo->paidStatus == 1) {
					$paid_amount = $order_info->orderInfo->totalAmount;
				} else {
					$due_amount = $order_info->orderInfo->totalAmount;
				}
				//For order entry
				$data = array(
					'order_id'		=> $order_id,
					'customer_id'	=> $order_info->orderInfo->userId,
					'date'			=> date('d-m-Y'),
					'total_amount'	=> $order_info->orderInfo->totalAmount,
					'order'			=> $this->number_generator_order(),
					'total_discount' => $order_info->orderInfo->totalDiscount,
					'service_charge' => $order_info->orderInfo->serviceCharge,
					'store_id'		=> $this->default_store(),
					'details'		=> $order_info->orderInfo->details,
					'paid_amount'	=> $paid_amount,
					'due_amount'	=> $due_amount,
					'status'		=> 1
				);
				$this->db->insert('order', $data);
				//Order details
				if ($order_info->orderInfo->cartItems) {
					foreach ($order_info->orderInfo->cartItems as $order) {
						$product_id    = $order->cartItemProductId;
						$variant_id    = $order->cartItemProductVariantId;
						$quantity 	   = $order->cartItemProductQuantity;
						$product_rate  = $order->cartItemProductPrice;
						$total_price   = $order->cartItemTotalPrice;
						$discount 	   = $order->cartItemDiscountPerProduct;
						$supplier_rate = $this->supplier_rate($product_id);
						//For order details entry
						$order_details = array(
							'order_details_id' => $this->generator(15),
							'order_id'		  => $order_id,
							'product_id'	  => $product_id,
							'variant_id'	  => $variant_id,
							'store_id'		  => $this->default_store(),
							'quantity'		  => $quantity,
							'rate'			  => $product_rate,
							'supplier_rate'   => $supplier_rate->supplier_price,
							'total_price'     => $total_price,
							'discount'        => $discount,
							'status'		  => 1
						);
						if (!empty($quantity)) {
							$result = $this->db->select('*')
								->from('order_details')
								->where('order_id', $order_id)
								->where('product_id', $product_id)
								->where('variant_id', $variant_id)
								->get()
								->num_rows();
							if ($result > 0) {
								$this->db->set('quantity', 'quantity+' . $quantity, FALSE);
								$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
								$this->db->where('order_id', $order_id);
								$this->db->where('product_id', $product_id);
								$this->db->where('variant_id', $variant_id);
								$this->db->update('order_details');
							} else {
								$this->db->insert('order_details', $order_details);
							}
						}
						$cgst_tax = $this->calculate_cgst_tax($product_id, $product_rate, $order_id, $quantity, $variant_id);
						$sgst_tax = $this->calculate_sgst_tax($product_id, $product_rate, $order_id, $quantity, $variant_id);
						$igst_tax = $this->calculate_igst_tax($product_id, $product_rate, $order_id, $quantity, $variant_id);
					}
				}
				// Coupon using validation
				if (!empty($order_info->orderInfo->coupon_code)) {
					$this->order_coupon_update($order_info->orderInfo->userId, $order_id, $order_info->orderInfo->coupon_code);
				}
				//Send invoice email to customer
				$this->load->model('dashboard/Orders');
				$this->load->model('dashboard/Soft_settings');
				$this->load->library('dashboard/occational');
				$order_detail = $this->Orders->retrieve_order_html_data($order_id);
				$subTotal_quantity = 0;
				$subTotal_cartoon = 0;
				$subTotal_discount = 0;
				if (!empty($order_detail)) {
					foreach ($order_detail as $k => $v) {
						$order_detail[$k]['final_date'] = $this->occational->dateConvert($order_detail[$k]['date']);
						$subTotal_quantity = $subTotal_quantity + $order_detail[$k]['quantity'];
					}
					$i = 0;
					foreach ($order_detail as $k => $v) {
						$i++;
						$order_detail[$k]['sl'] = $i;
					}
				}
				$currency_details = $this->Soft_settings->retrieve_currency_info();
				$company_info 	  = $this->Orders->retrieve_company();
				$data = array(
					'title'			   => display('order_details'),
					'order_id'		   => $order_detail[0]['order_id'],
					'order_no'		   => $order_detail[0]['order'],
					'customer_address' => $order_detail[0]['customer_short_address'],
					'customer_name'	   => $order_detail[0]['customer_name'],
					'customer_mobile'  => $order_detail[0]['customer_mobile'],
					'customer_email'   => $order_detail[0]['customer_email'],
					'final_date'	   => $order_detail[0]['final_date'],
					'total_amount'	   => $order_detail[0]['total_amount'],
					'order_discount'   => $order_detail[0]['order_discount'],
					'service_charge'   => $order_detail[0]['service_charge'],
					'paid_amount'	   => $order_detail[0]['paid_amount'],
					'due_amount'	   => $order_detail[0]['due_amount'],
					'details'		   => $order_detail[0]['details'],
					'subTotal_quantity' => $subTotal_quantity,
					'order_all_data'   => $order_detail,
					'company_info'	   => $company_info,
					'currency' 		   => $currency_details[0]['currency_icon'],
					'position' 		   => $currency_details[0]['currency_position'],
				);
				$chapterList = $this->parser->parse('dashboard/order/order_pdf', $data, true);
				//PDF Generator 
				$this->load->library('pdfgenerator');
				$file_path = $this->pdfgenerator->generate_order($order_id, $chapterList);
				//File path save to database
				$this->db->set('file_path', base_url($file_path));
				$this->db->where('order_id', $order_id);
				$this->db->update('order');
				$send_email = '';
				if (!empty($data['customer_email'])) {
					$send_email = $this->setmail($data['customer_email'], $file_path);
				}
				if ($send_email) {
					//Return order information
					$json = array(
						'status'  => "true",
						'order_id' => $order_id,
						'success' => "Product orderd successfully !",
					);
					echo $json_encode = json_encode(array('status' => 'success', 'order_status' => $json), JSON_UNESCAPED_UNICODE);
				} else {
					//Return order information
					$json = array(
						'status'  => "true",
						'order_id' => $order_id,
						'error'   => "Email not send !",
					);
					echo $json_encode = json_encode(array('status' => 'success', 'order_status' => $json), JSON_UNESCAPED_UNICODE);
				}
			} elseif ($order_info->orderInfo->payment_method == 10) {
				if (check_module_status('mastercard') == 1) {
					$mastercard_info   = $this->db->select('*')->from('mastercard_settings')->where('id', 1)->get()->row();
					$total_amount      = number_format($order_info->orderInfo->totalAmount, 2, '.', '');
					$merchant          = $mastercard_info->merchant_id;
					$apipassword       = $mastercard_info->token_password;
					$returnURL         = base_url('app/mastercard_return_url');
					$currency          = 'SAR';
					$customer_name     = $order_info->billingInfo->fullname;
					$customer_address_1 = $order_info->billingInfo->city . "," . $order_info->billingInfo->state . "," . $billing_country->name . "," . $order_info->billingInfo->zip;
					$customer_address_2 = $order_info->billingInfo->Address;
					$ordre_notes       = $order_info->orderInfo->details;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, (($mastercard_info->getway_status == 1) ? "https://ap-gateway.mastercard.com/api/nvp/version/49" : "https://test-gateway.mastercard.com/api/nvp/version/49"));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, 'apiOperation=CREATE_CHECKOUT_SESSION&apiPassword=' . $apipassword . '&apiUsername=merchant.' . $merchant . '&merchant=' . $merchant . '&interaction.returnUrl=' . $returnURL . '&order.id=' . $order_id . '&order.amount=' . $total_amount . '&order.currency=' . $currency . '');
					$headers   = array();
					$headers[] = 'Content-Type: application/x-www-form-urlencoded';
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					$result    = curl_exec($ch);
					if (curl_errno($ch)) {
						echo 'ERROR :' . curl_error($ch);
					}
					curl_close($ch);
					$successIndicator = explode("=", explode("&", $result)[5])[1];
					$sessionid = explode("=", explode("&", $result)[2])[1];
					if (!empty($sessionid)) {
						$json = array(
							'successIndicator' => $successIndicator,
							'order_id'        => $order_id,
							'mastercard_redirection' => base_url() . 'app/mastercard_redirection?' . 'total_amount=' . $total_amount . '&order_id=' . $order_id . '&customer_name=' . $customer_name . '&customer_address_1=' . $customer_address_1 . '&customer_address_2=' . $customer_address_2 . '&sessionid=' . $sessionid,
						);
						echo $json_encode = json_encode(array('status' => 'success', 'mastercard_details' => $json), JSON_UNESCAPED_UNICODE);
					} else {
						echo $json_encode = json_encode(array('status' => 'error'), JSON_UNESCAPED_UNICODE);
					}
				}
			} else {
				//Return order information
				$json[] = array(
					'status' => "false",
					'error'  => "Payment method doesn't exist!",
				);
				echo $json_encode = json_encode(array('order_status' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			//Return order information
			$json[] = array(
				'status'   => "false",
				'error'  => "Product orderd failed !",
			);
			echo $json_encode = json_encode(array('order_status' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	public function mastercard_redirection()
	{
		$total_amount       = $this->input->get('total_amount', true);
		$order_id           = $this->input->get('order_id', true);
		$customer_name      = $this->input->get('customer_name', true);
		$customer_address_1 = $this->input->get('customer_address_1', true);
		$customer_address_2 = $this->input->get('customer_address_2', true);
		$sessionid          = $this->input->get('sessionid', true);
		$mastercard_info    = $this->db->select('*')->from('mastercard_settings')->where('id', 1)->get()->row();
		$merchant           = $mastercard_info->merchant_id;
		$currency           = 'SAR';
		$html = '<script src=' . (($mastercard_info->getway_status == 1) ? "https://ap-gateway.mastercard.com/checkout/version/49/checkout.js" : "https://test-gateway.mastercard.com/checkout/version/49/checkout.js") . '
                                    data-error="errorCallback"
                                    data-cancel="' . base_url() . '">
                </script>
                <script type="text/javascript">
                    function errorCallback(error){
                        alert("Error: "+ JSON.stringify(error));
                        window.location.href="' . base_url() . '";
                    }
                    Checkout.configure({
                        merchant: "' . $merchant . '",
                        order:{
                            amount:function(){
                                return ' . $total_amount . '
                            },
                            currency: "' . $currency . '",
                            description:"Total payable amount is: ' . $total_amount . '",
                            id:"' . $order_id . '"
                        },
                        interaction:{
                            merchant: {
                                name:"' . $customer_name . '",
                                address:{
                                        line1: "' . $customer_address_1 . '",
                                        line2: "' . $customer_address_2 . '",
                                }
                            }
                        },
                        session: {
                            id: "' . $sessionid . '"
                        }
                    });
                    Checkout.showPaymentPage();
                </script>';
		echo $html;
	}
	public function mastercard_return_url()
	{
		$resultIndicator = $this->input->get('resultIndicator', true);
		$sessionVersion  = $this->input->get('sessionVersion', true);
		$json = array(
			'resultIndicator' => $resultIndicator,
			'sessionVersion'  => $sessionVersion,
		);
		echo $json_encode = json_encode(array('order_status' => $json), JSON_UNESCAPED_UNICODE);
	}

	public function complete_mastercard_payment()
	{
		$get_order_data = file_get_contents('php://input');
		$order_info = json_decode($get_order_data);

		$resultIndicator = $order_info->orderInfo->resultIndicator;
		$sessionVersion  = $order_info->orderInfo->sessionVersion;
		$successIndicator = $order_info->orderInfo->successIndicator;
		$order_id        = $order_info->orderInfo->order_id;
		if ($resultIndicator == $successIndicator) {

			// loyalty point insertion start
			// loyalty point redeem end

			$paid_amount = 0;
			$due_amount  = 0;
			if ($order_info->orderInfo->paidStatus == 1) {
				$paid_amount = $order_info->orderInfo->totalAmount;
			} else {
				$due_amount = $order_info->orderInfo->totalAmount;
			}
			//For order entry
			$data = array(
				'order_id'		 => $order_id,
				'customer_id'	 => $order_info->orderInfo->userId,
				'date'			 => date('d-m-Y'),
				'total_amount'	 => $order_info->orderInfo->totalAmount,
				'order'			 => $this->number_generator_order(),
				'total_discount' => $order_info->orderInfo->totalDiscount,
				'service_charge' => $order_info->orderInfo->serviceCharge,
				'store_id'		 => $this->default_store(),
				'details'		 => $order_info->orderInfo->details,
				'paid_amount'	 => $paid_amount,
				'due_amount'	 => $due_amount,
				'status'		 => 1
			);
			$this->db->insert('order', $data);
			//Order details
			if ($order_info->orderInfo->cartItems) {
				foreach ($order_info->orderInfo->cartItems as $order) {
					$product_id    = $order->cartItemProductId;
					$variant_id    = $order->cartItemProductVariantId;
					$quantity 	   = $order->cartItemProductQuantity;
					$product_rate  = $order->cartItemProductPrice;
					$total_price   = $order->cartItemTotalPrice;
					$discount 	   = $order->cartItemDiscountPerProduct;
					$supplier_rate = $this->supplier_rate($product_id);
					//For order details entry
					$order_details = array(
						'order_details_id' => $this->generator(15),
						'order_id'		  => $order_id,
						'product_id'	  => $product_id,
						'variant_id'	  => $variant_id,
						'store_id'		  => $this->default_store(),
						'quantity'		  => $quantity,
						'rate'			  => $product_rate,
						'supplier_rate'   => $supplier_rate->supplier_price,
						'total_price'     => $total_price,
						'discount'        => $discount,
						'status'		  => 1
					);
					if (!empty($quantity)) {
						$result = $this->db->select('*')
							->from('order_details')
							->where('order_id', $order_id)
							->where('product_id', $product_id)
							->where('variant_id', $variant_id)
							->get()
							->num_rows();
						if ($result > 0) {
							$this->db->set('quantity', 'quantity+' . $quantity, FALSE);
							$this->db->set('total_price', 'total_price+' . $total_price, FALSE);
							$this->db->where('order_id', $order_id);
							$this->db->where('product_id', $product_id);
							$this->db->where('variant_id', $variant_id);
							$this->db->update('order_details');
						} else {
							$this->db->insert('order_details', $order_details);
						}
					}
					$cgst_tax = $this->calculate_cgst_tax($product_id, $product_rate, $order_id, $quantity, $variant_id);
					$sgst_tax = $this->calculate_sgst_tax($product_id, $product_rate, $order_id, $quantity, $variant_id);
					$igst_tax = $this->calculate_igst_tax($product_id, $product_rate, $order_id, $quantity, $variant_id);
				}
			}
			// start mastercard transections insert
			$mastercard_transections = array(
				'resultIndicator' => $resultIndicator,
				'sessionVersion'  => $sessionVersion,
				'successIndicator' => $successIndicator,
				'order_id'        => $order_id
			);
			$this->db->insert('mastercard_transections', $mastercard_transections);
			// end mastercard transections insert

			// Coupon using validation
			if (!empty($order_info->orderInfo->coupon_code)) {
				$this->order_coupon_update($order_info->orderInfo->userId, $order_id, $order_info->orderInfo->coupon_code);
			}
			//Send invoice email to customer
			$this->load->model('dashboard/Orders');
			$this->load->model('dashboard/Soft_settings');
			$this->load->library('dashboard/occational');
			$order_detail = $this->Orders->retrieve_order_html_data($order_id);
			$subTotal_quantity = 0;
			$subTotal_cartoon = 0;
			$subTotal_discount = 0;
			if (!empty($order_detail)) {
				foreach ($order_detail as $k => $v) {
					$order_detail[$k]['final_date'] = $this->occational->dateConvert($order_detail[$k]['date']);
					$subTotal_quantity = $subTotal_quantity + $order_detail[$k]['quantity'];
				}
				$i = 0;
				foreach ($order_detail as $k => $v) {
					$i++;
					$order_detail[$k]['sl'] = $i;
				}
			}
			$currency_details = $this->Soft_settings->retrieve_currency_info();
			$company_info 	  = $this->Orders->retrieve_company();
			$data = array(
				'title'			   => display('order_details'),
				'order_id'		   => $order_detail[0]['order_id'],
				'order_no'		   => $order_detail[0]['order'],
				'customer_address' => $order_detail[0]['customer_short_address'],
				'customer_name'	   => $order_detail[0]['customer_name'],
				'customer_mobile'  => $order_detail[0]['customer_mobile'],
				'customer_email'   => $order_detail[0]['customer_email'],
				'final_date'	   => $order_detail[0]['final_date'],
				'total_amount'	   => $order_detail[0]['total_amount'],
				'order_discount'   => $order_detail[0]['order_discount'],
				'service_charge'   => $order_detail[0]['service_charge'],
				'paid_amount'	   => $order_detail[0]['paid_amount'],
				'due_amount'	   => $order_detail[0]['due_amount'],
				'details'		   => $order_detail[0]['details'],
				'subTotal_quantity' => $subTotal_quantity,
				'order_all_data'   => $order_detail,
				'company_info'	   => $company_info,
				'currency' 		   => $currency_details[0]['currency_icon'],
				'position' 		   => $currency_details[0]['currency_position'],
			);
			$chapterList = $this->parser->parse('dashboard/order/order_pdf', $data, true);
			//PDF Generator 
			$this->load->library('pdfgenerator');
			$file_path = $this->pdfgenerator->generate_order($order_id, $chapterList);
			//File path save to database
			$this->db->set('file_path', base_url($file_path));
			$this->db->where('order_id', $order_id);
			$this->db->update('order');
			$send_email = '';
			if (!empty($data['customer_email'])) {
				$send_email = $this->setmail($data['customer_email'], $file_path);
			}
			if ($send_email) {
				//Return order information
				$json = array(
					'status'   => "true",
					'order_id' => $order_id,
					'success'  => "Product orderd successfully !",
				);
				echo $json_encode = json_encode(array('status' => 'success', 'order_status' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				//Return order information
				$json = array(
					'status'  => "true",
					'order_id' => $order_id,
					'error'   => "Email not send !",
				);
				echo $json_encode = json_encode(array('status' => 'success', 'order_status' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$json = array(
				'status'  => "error",
				'order_id' => $order_id,
				'error'   => "Payment Failed!",
			);
			echo $json_encode = json_encode(array('status' => 'error', 'order_status' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Send Customer Email with invoice
	public function setmail($email, $file_path)
	{
		$CI = &get_instance();
		$CI->load->model('dashboard/Soft_settings');
		$setting_detail = $CI->Soft_settings->retrieve_email_editdata();

		$subject = display("order_information");
		$message = display("order_info_details") . '<br>' . base_url();

		$config = array(
			'protocol' 		=> $setting_detail[0]['protocol'],
			'smtp_host' 	=> $setting_detail[0]['smtp_host'],
			'smtp_port' 	=> $setting_detail[0]['smtp_port'],
			'smtp_user' 	=> $setting_detail[0]['sender_email'],
			'smtp_pass' 	=> $setting_detail[0]['password'],
			'mailtype' 		=> $setting_detail[0]['mailtype'],
			'charset' 		=> 'utf-8',
		);

		$CI->load->library('email');
		$CI->email->initialize($config);

		$CI->email->set_newline("\r\n");
		$CI->email->from($setting_detail[0]['sender_email']);
		$CI->email->to($email);
		$CI->email->subject($subject);
		$CI->email->message($message);
		$CI->email->attach($file_path);

		$check_email = $this->test_input($email);
		if (filter_var($check_email, FILTER_VALIDATE_EMAIL)) {
			if ($CI->email->send()) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	//Paypal setting
	public function paypal_setting()
	{
		$result = $this->db->select('*')
			->from('payment_gateway')
			->where('id', 3)
			->get()
			->row();

		if ($result) {
			$json[] = array(
				'paypal_email'	  => $result->paypal_email,
				'paypal_client_id' => $result->paypal_client_id,
				'currency'		  => $result->currency,
			);
			echo $json_encode = json_encode(array('paypal_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => false,
				'error' => 'No paypal settings found !',
			);
			echo $json_encode = json_encode(array('paypal_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Payment setting
	public function payment_setting($payment_id = false)
	{
		$this->db->select('*');
		$this->db->from('payment_gateway');
		if (!empty($payment_id)) {
			$this->db->where('used_id', $payment_id);
		}
		$result = $this->db->get()->result();

		if ($result) {

			$json = $result;
			echo $json_encode = json_encode(array('payment_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => false,
				'error' => 'No paypal settings found !',
			);
			echo $json_encode = json_encode(array('paypal_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}
	//Order info

	public function order_all_info()
	{
		$customer_id = $this->input->get('user_id', true);
		if ($customer_id) {
			$order_info = $this->db->select('*')
				->from('order')
				->where('customer_id', $customer_id)
				->order_by('order', 'desc')
				->get()
				->result();
			if ($order_info) {
				foreach ($order_info as $order) {
					$status = 0;
					$order_status = $this->get_invoice_status($order->order_id);
					if ($order_status) {
						$status =  $order_status->invoice_status;
						if ($status  == 1) {
							$status = "Shipped";
						} elseif ($status  == 2) {
							$status = "Cancel";
						} elseif ($status  == 3) {
							$status = "Pending";
						} elseif ($status  == 4) {
							$status = "Complete";
						} elseif ($status  == 5) {
							$status = "Processing";
						} elseif ($status  == 6) {
							$status = "Return";
						} else {
							$status = "Pending";
						}
					} else {
						$status = "Pending";
					}
					//Return order information
					$json[] = array(
						'order_id' 		=> $order->order_id,
						'customer_id' 	=> $order->customer_id,
						'store_id' 		=> $order->store_id,
						'date' 			=> $order->date,
						'total_amount' 	=> $order->total_amount,
						'details' 		=> $order->details,
						'total_discount' => $order->total_discount,
						'service_charge' => $order->service_charge,
						'paid_amount'	=> $order->paid_amount,
						'due_amount'	=> $order->due_amount,
						'status'		=> $status,
					);
				}
				$status = "success";
				echo $json_encode = json_encode(array('order_info' => $json, 'success' => $status), JSON_UNESCAPED_UNICODE);
			} else {
				//Return order information
				$json[] = array(
					'status' => 'error',
					'error' => 'No order found !',
				);
				echo $json_encode = json_encode(array('order_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			//Return order information
			$json[] = array(
				'status' => 'error',
				'error' => 'No order found !',
			);
			echo $json_encode = json_encode(array('order_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Invoice status
	public function get_invoice_status($order_id = null)
	{
		return $this->db->select('invoice_status')
			->from('invoice')
			->where('order_id', $order_id)
			->get()
			->row();
	}

	//Image Gallery
	public function image_gallery()
	{
		$product_id = $this->input->get('product_id', true);

		if ($product_id) {
			$image_details = $this->db->select('*')
				->from('image_gallery')
				->where('product_id', $product_id)
				->get()
				->result();
			if ($image_details) {
				foreach ($image_details as $image) {
					$json[] = array(
						'image_gallery_id' => $image->image_gallery_id,
						'product_id'	=> $image->product_id,
						'image'			=> $image->image_url,
						'img_thumb'		=> $image->img_thumb,
					);
				}
				echo $json_encode = json_encode(array('image_info' => $json), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'status' => "false",
					'error' => "Image not found !",
				);
				echo $json_encode = json_encode(array('image_info' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$json[] = array(
				'status' => "false",
				'error' => "Please enter product id !",
			);
			echo $json_encode = json_encode(array('image_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Order Details
	public function order_details()
	{
		$order_id = $this->input->get('order_id', TRUE);
		if ($order_id) {
			$order_details = $this->db->select('a.*,b.product_name,b.image_thumb,c.variant_name')
				->from('order_details a')
				->join('product_information b', 'a.product_id = b.product_id')
				->join('variant c', 'a.variant_id = c.variant_id')
				->where('order_id', $order_id)
				->get()
				->result();
			if ($order_details) {
				foreach ($order_details as $order) {
					//Return order information
					$json[] = array(
						'order_id' 	   => $order->order_id,
						'product_name' => $order->product_name,
						'product_image' => $order->image_thumb,
						'store_id' 	   => $order->store_id,
						'variant_name' => $order->variant_name,
						'quantity' 	   => $order->quantity,
						'rate' 		   => $order->rate,
						'total_price'  => $order->total_price,
						'discount'	   => $order->discount,
					);
				}
				echo $json_encode = json_encode(array('order_details' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			//Return order information
			$json[] = array(
				'status' => false,
				'error' => 'No order details found !',
			);
			echo $json_encode = json_encode(array('order_details' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Default store search
	public function default_store()
	{
		$store = $this->db->select('*')
			->from('store_set')
			->where('default_status', '1')
			->get()
			->row();
		return $store->store_id;
	}

	//Calculate cgst tax by product and tax id
	public function calculate_cgst_tax($product_id = null, $product_rate = null, $order_id = null, $quantity, $variant_id = null)
	{
		$percentage = $this->db->select('*')
			->from('tax_product_service')
			->where('product_id', $product_id)
			->where('tax_id', 'H5MQN4NXJBSDX4L')
			->get()
			->row();
		if ($percentage) {
			$tax_amount = ($product_rate * $percentage->tax_percentage / 100) * $quantity;

			//CGST Tax summary
			$cgst_summary = array(
				'order_tax_col_id'	=>	$this->generator(15),
				'order_id'			=>	$order_id,
				'tax_amount' 		=> 	$tax_amount,
				'tax_id' 			=> 	$percentage->tax_id,
				'date'				=>	date('d-m-Y'),
			);
			if (!empty($tax_amount)) {
				$result = $this->db->select('*')
					->from('order_tax_col_summary')
					->where('order_id', $order_id)
					->where('tax_id', $percentage->tax_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('tax_amount', 'tax_amount+' . $tax_amount, FALSE);
					$this->db->where('order_id', $order_id);
					$this->db->where('tax_id', $percentage->tax_id);
					$this->db->update('order_tax_col_summary');
				} else {
					$this->db->insert('order_tax_col_summary', $cgst_summary);
				}
			}

			//CGST tax info
			$cgst_details = array(
				'order_tax_col_de_id' =>	$this->generator(15),
				'order_id'			=>	$order_id,
				'amount' 			=> 	$tax_amount,
				'product_id' 		=> 	$product_id,
				'tax_id' 			=> 	$percentage->tax_id,
				'variant_id' 		=> 	$variant_id,
				'date'				=>	date('d-m-Y'),
			);
			if (!empty($tax_amount)) {
				$result = $this->db->select('*')
					->from('order_tax_col_details')
					->where('order_id', $order_id)
					->where('tax_id', $percentage->tax_id)
					->where('product_id', $product_id)
					->where('variant_id', $variant_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('amount', 'amount+' . $tax_amount, FALSE);
					$this->db->where('order_id', $order_id);
					$this->db->where('tax_id', $percentage->tax_id);
					$this->db->where('variant_id', $variant_id);
					$this->db->where('product_id', $product_id);
					$this->db->update('order_tax_col_details');
				} else {
					$this->db->insert('order_tax_col_details', $cgst_details);
				}
			}
		}
	}

	//Calculate sgst by product and tax id
	public function calculate_sgst_tax($product_id = null, $product_rate = null, $order_id = null, $quantity, $variant_id = null)
	{
		$percentage = $this->db->select('*')
			->from('tax_product_service')
			->where('product_id', $product_id)
			->where('tax_id', '52C2SKCKGQY6Q9J')
			->get()
			->row();
		if ($percentage) {
			$tax_amount = ($product_rate * $percentage->tax_percentage / 100) * $quantity;


			//Sgst tax summary
			$sgst_summary = array(
				'order_tax_col_id'	=>	$this->generator(15),
				'order_id'			=>	$order_id,
				'tax_amount' 		=> 	$tax_amount,
				'tax_id' 			=> 	$percentage->tax_id,
				'date'				=>	date('d-m-Y'),
			);
			if (!empty($tax_amount)) {
				$result = $this->db->select('*')
					->from('order_tax_col_summary')
					->where('order_id', $order_id)
					->where('tax_id', $percentage->tax_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('tax_amount', 'tax_amount+' . $tax_amount, FALSE);
					$this->db->where('order_id', $order_id);
					$this->db->where('tax_id', $percentage->tax_id);
					$this->db->update('order_tax_col_summary');
				} else {
					$this->db->insert('order_tax_col_summary', $sgst_summary);
				}
			}

			//SGST tax details
			$sgst_summary = array(
				'order_tax_col_de_id' =>	$this->generator(15),
				'order_id'			=>	$order_id,
				'amount' 			=> 	$tax_amount,
				'product_id' 		=> 	$product_id,
				'tax_id' 			=> 	$percentage->tax_id,
				'variant_id' 		=> 	$variant_id,
				'date'				=>	date('d-m-Y'),
			);
			if (!empty($tax_amount)) {
				$result = $this->db->select('*')
					->from('order_tax_col_details')
					->where('order_id', $order_id)
					->where('tax_id', $percentage->tax_id)
					->where('product_id', $product_id)
					->where('variant_id', $variant_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('amount', 'amount+' . $tax_amount, FALSE);
					$this->db->where('order_id', $order_id);
					$this->db->where('tax_id', $percentage->tax_id);
					$this->db->where('variant_id', $variant_id);
					$this->db->where('product_id', $product_id);
					$this->db->update('order_tax_col_details');
				} else {
					$this->db->insert('order_tax_col_details', $sgst_summary);
				}
			}
		}
	}

	//Calculate igst by product and tax id
	public function calculate_igst_tax($product_id = null, $product_rate = null, $order_id = null, $quantity, $variant_id = null)
	{
		$percentage = $this->db->select('*')
			->from('tax_product_service')
			->where('product_id', $product_id)
			->where('tax_id', '5SN9PRWPN131T4V')
			->get()
			->row();
		if ($percentage) {
			$tax_amount = ($product_rate * $percentage->tax_percentage / 100) * $quantity;

			//IGST tax summary
			$igst_summary = array(
				'order_tax_col_id'	=>	$this->generator(15),
				'order_id'			=>	$order_id,
				'tax_amount' 		=> 	$tax_amount,
				'tax_id' 			=> 	$percentage->tax_id,
				'date'				=>	date('d-m-Y'),
			);
			if (!empty($tax_amount)) {
				$result = $this->db->select('*')
					->from('order_tax_col_summary')
					->where('order_id', $order_id)
					->where('tax_id', $percentage->tax_id)
					->get()
					->num_rows();

				if ($result > 0) {
					$this->db->set('tax_amount', 'tax_amount+' . $tax_amount, FALSE);
					$this->db->where('order_id', $order_id);
					$this->db->where('tax_id', $percentage->tax_id);
					$this->db->update('order_tax_col_summary');
				} else {
					$this->db->insert('order_tax_col_summary', $igst_summary);
				}
			}

			//IGST tax details
			$igst_summary = array(
				'order_tax_col_de_id' =>	$this->generator(15),
				'order_id'			=>	$order_id,
				'amount' 			=> 	$tax_amount,
				'product_id' 		=> 	$product_id,
				'tax_id' 			=> 	$percentage->tax_id,
				'variant_id' 		=> 	$variant_id,
				'date'				=>	date('d-m-Y'),
			);

			if (!empty($tax_amount)) {
				$result = $this->db->select('*')
					->from('order_tax_col_details')
					->where('order_id', $order_id)
					->where('tax_id', $percentage->tax_id)
					->where('product_id', $product_id)
					->where('variant_id', $variant_id)
					->get()
					->num_rows();
				if ($result > 0) {
					$this->db->set('amount', 'amount+' . $tax_amount, FALSE);
					$this->db->where('order_id', $order_id);
					$this->db->where('tax_id', $percentage->tax_id);
					$this->db->where('variant_id', $variant_id);
					$this->db->where('product_id', $product_id);
					$this->db->update('order_tax_col_details');
				} else {
					$this->db->insert('order_tax_col_details', $igst_summary);
				}
			}
		}
	}

	//Tax info by product id
	public function tax_info()
	{

		$product_info = file_get_contents('php://input');
		$product_info = json_decode($product_info);

		if ($product_info) {
			foreach ($product_info->idsForTaxes as $product) {
				foreach ($product->ids as $p) {

					$tax_info = $this->db->select('SUM(a.tax_percentage) as total_tax,b.*')
						->from('tax_product_service a')
						->join('product_information b', 'a.product_id = b.product_id')
						->where('a.product_id', $p)
						->get()
						->row();
					$price = 0;
					if ($tax_info->onsale == 1) {
						$price = $tax_info->onsale_price;
					} else {
						$price = $tax_info->price;
					}
					$json[] = array(
						'product_id'  => $tax_info->product_id,
						'tax_amount'  => $tax_info->total_tax * $price / 100,
					);
				}
			}
			echo $json_encode = json_encode(array('tax_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'product_id'  => 'none',
			);

			echo $json_encode = json_encode(array('tax_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Web setting
	public function web_setting()
	{
		$result = $this->db->select('logo')
			->from('web_setting')
			->where('setting_id', 1)
			->get()
			->row();

		if ($result) {
			$json[] = array(
				'logo'  => $result->logo,
			);

			echo $json_encode = json_encode(array('setting_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => 'false',
				'error'  => 'No logo found !',
			);

			echo $json_encode = json_encode(array('setting_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//Currency list
	public function currency_list()
	{
		$currency_info = $this->db->select('*')
			->from('currency_info')
			->get()
			->result();
		if ($currency_info) {
			foreach ($currency_info as $currency_info) {
				$json[] = array(
					'currency_id'	=>	$currency_info->currency_id,
					'currency_name'	=>	$currency_info->currency_name,
					'currency_icon'	=>	$currency_info->currency_icon,
					'currency_position'	=>	$currency_info->currency_position,
					'convertion_rate' =>	$currency_info->convertion_rate,
					'default_status' =>	$currency_info->default_status,
				);
			}
			echo $json_encode = json_encode(array('currency_info' => $json), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'error'  => 'No currency found !',
			);
			echo $json_encode = json_encode(array('currency_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	//This function is used to Generate Key
	public function generator($lenth)
	{
		$number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

		for ($i = 0; $i < $lenth; $i++) {
			$rand_value = rand(0, 34);
			$rand_number = $number["$rand_value"];

			if (empty($con)) {
				$con = $rand_number;
			} else {
				$con = "$con" . "$rand_number";
			}
		}
		return $con;
	}
	//NUMBER GENERATOR FOR ORDER
	public function number_generator_order()
	{
		$this->db->select_max('order', 'order_no');
		$query = $this->db->get('order');
		$result = $query->result_array();
		$order_no = $result[0]['order_no'];
		if ($order_no != '') {
			$order_no = $order_no + 1;
		} else {
			$order_no = 1000;
		}
		return $order_no;
	}
	// Review and rating calculation
	public function get_total_five_start_rating($product_id = null, $rate)
	{
		return $this->db->select('*')
			->from('product_review')
			->where('product_id', $product_id)
			->where('rate', $rate)
			->where('status', 1)
			->get()
			->num_rows();
	}

	//Product info
	public function product_info()
	{
		$p_id = $this->input->get('product_id');
		$this->db->select('a.product_id as id, a.product_name as name,a.product_details,a.review,a.description,a.specification,a.bar_code,a.code,a.supplier_id,a.category_id,a.warrantee,a.price,a.supplier_price,a.unit,a.product_model,a.image_thumb,a.brand_id,a.variants,a.default_variant,a.variant_price,a.type,a.best_sale,a.onsale,a.onsale_price,a.invoice_details,a.image_large_details,a.review,a.tag,a.specification,a.video,a.status,a.is_assemble,b.*,c.*');
		$this->db->from('product_information a');
		$this->db->join('product_category b', 'a.category_id = b.category_id', 'LEFT');
		$this->db->join('brand c', 'c.brand_id = a.brand_id', 'LEFT');
		$this->db->where('product_id', $p_id);
		$json = $this->db->get();
		if ($json->num_rows() > 0) {
			$product_info = $json->row_array();
			$product_info['refined_product_details'] = strip_tags(htmlspecialchars_decode($product_info['product_details']));
			$product_info['refined_review'] = strip_tags(htmlspecialchars_decode($product_info['review']));
			$product_info['refined_description'] = strip_tags(htmlspecialchars_decode($product_info['description']));
			$product_info['refined_specification'] = strip_tags(htmlspecialchars_decode($product_info['specification']));
			$product_info['product_link'] = base_url() . 'product/' . remove_space($product_info['name']) . '/' . $product_info['id'];

			// Product images
			$this->db->select('*');
			$this->db->from('image_gallery');
			$this->db->where('product_id', $p_id);
			$product_info['product_images'] = $this->db->get()->result_array();

			// Review Total
			$product_info['product_rating'] = $this->rating_calculator($p_id);

			$review_list = [];
			for ($i = 5; $i >= 1; $i--) {

				$review_list['start_' . $i] = $this->get_total_five_start_rating($p_id, $i);
			}

			$product_info['review_list'] = $review_list;

			$purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
				->from('transfer')
				->where('product_id', $p_id)
				->get()
				->row();
			$sales = $this->db->select("SUM(quantity) as totalSalesQnty")
				->from('invoice_stock_tbl')
				->where('product_id', $p_id)
				->get()
				->row();
			$stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
			if ($stock > 0) {
				$product_info['stock'] = $stock;
			} else {
				$stock = 0;
				$product_info['stock'] = $stock;
			}

			$status = 'success';
			echo $json_encode = json_encode(array('product_info' => $product_info, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => false,
				'error'  => 'No product details found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('product_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	//related Products
	public function related_product()
	{
		$cat_id = $this->input->get('category_id');
		$p_id   = $this->input->get('product_id');

		$json = $this->db->select('a.product_id as id, a.product_name as name,a.product_details,a.review,a.description,a.specification,a.bar_code,a.code,a.supplier_id,a.category_id,a.warrantee,a.price,a.supplier_price,a.unit,a.product_model,a.image_thumb,a.brand_id,a.variants,a.default_variant,a.variant_price,a.type,a.best_sale,a.onsale,a.onsale_price,a.invoice_details,a.image_large_details,a.review,a.tag,a.specification,a.video,a.status,a.is_assemble,b.category_name')
			->from('product_information a')
			->join('product_category b', 'a.category_id=b.category_id')
			->where('a.category_id', $cat_id)
			->where_not_in('a.product_id', $p_id)
			->where('a.is_assemble', null)
			->limit(10)
			->get()->result_array();

		foreach ($json as $key => $product) {
			$purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
				->from('transfer')
				->where('product_id', $product['id'])
				->get()
				->row();
			$sales = $this->db->select("SUM(quantity) as totalSalesQnty")
				->from('invoice_stock_tbl')
				->where('product_id', $product['id'])
				->get()
				->row();
			$stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
			if ($stock > 0) {
				$json[$key]['stock'] = $stock;
			} else {
				$stock = 0;
				$json[$key]['stock'] = $stock;
			}
		}

		if (count($json) > 0) {
			$status = 'success';
			echo $json_encode = json_encode(array('related_products' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => 'error',
				'error'  => 'No products found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('related_products' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}

	//Retrieve  Brand List	
	public function brand_list()
	{
		$this->db->select('*');
		$this->db->from('brand');
		$this->db->order_by('brand_name', 'asc');
		$json = $this->db->get();
		if ($json->num_rows() > 0) {
			$status = 'success';
			echo $json_encode = json_encode(array('brand_list' => $json->result_array(), 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => 'error',
				'error'  => 'No brands found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('brand_list' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	//Retrieve brand product
	public function retrieve_brand_product()
	{
		$brand_id = $this->input->get('brand_id');
		$get_per_page    = $this->input->get('per_page', true);
		$get_page_number = ($this->input->get('page_number', true) - 1) * $get_per_page;

		if (!empty($brand_id)) {
			#pagination starts
			$total_rows  = $this->brand_product_list_count($brand_id);
			#pagination ends
			$productlist = $this->brand_product($brand_id, $get_per_page, $get_page_number);
		} else {
			#pagination starts
			$total_rows = $this->db->select('*')->from('product_information')->where('is_assemble IS NULL')->order_by('id', 'desc')->get()->num_rows();
			#pagination ends
			$productlist = $this->db->select('*')->from('product_information')->where('is_assemble IS NULL',)->limit($get_per_page, $get_page_number)->order_by('id', 'desc')->get()->result();
		}

		if ($productlist) {
			foreach ($productlist as $product) {
				$product_rating = $this->rating_calculator($product->product_id);
				$json[] = array(
					'id' 			     => $product->product_id,
					'name'			     => (!empty($product->product_name) ? $product->product_name : null),
					'brand_id'		     => (!empty($product->brand_id) ? $product->brand_id : null),
					'price'			     => (!empty($product->price) ? $product->price : null),
					'model'			     => (!empty($product->product_model) ? $product->product_model : null),
					'image_thumb'	     => (!empty($product->image_thumb) ? $product->image_thumb : null),
					'product_details'    => (!empty($product->product_details) ? $product->product_details : null),
					'description'	     => (!empty($product->description) ? $product->description : null),
					'variants'		     => (!empty($product->variants) ? $product->variants : null),
					'onsale'		     => (!empty($product->onsale) ? $product->onsale : null),
					'best_sale'		     => (!empty($product->best_sale) ? $product->best_sale : null),
					'onsale_price'	     => (!empty($product->onsale_price) ? $product->onsale_price : null),
					'image_large_details' => (!empty($product->image_large_details) ? $product->image_large_details : null),
					'rating'		     => (!empty($product_rating) ? $product_rating : 0)
				);
			}
			$status = 'success';
			echo $json_encode = json_encode(array('product_info' => $json, 'total_rows' => $total_rows, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'error' => "Product not found !",
			);
			$status = 'error';
			echo $json_encode = json_encode(array('product_info' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}

	public function brand_product_list_count($brand_id)
	{
		$this->db->select('a.*');
		$this->db->from('product_information a');
		$this->db->where('a.is_assemble IS NULL');
		$this->db->where('a.brand_id', $brand_id);
		$this->db->group_by('a.product_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {

			return $query->num_rows();
		}
		return false;
	}
	public function brand_product($brand_id, $per_page, $page)
	{

		$this->db->select('a.*,b.brand_name');
		$this->db->from('product_information a');
		$this->db->join('brand b', 'a.brand_id=b.brand_id');
		$this->db->where('a.is_assemble IS NULL');
		$this->db->where('a.brand_id', $brand_id);
		$this->db->limit($per_page, $page);
		$this->db->order_by('product_name');
		$this->db->group_by('a.product_id');
		$query = $this->db->get();
		$w_brand_pro = $query->result();
		return $w_brand_pro;
	}

	//Product List
	public function assembly_product_list()
	{
		$per_page    = $this->input->get('per_page', true);
		$page_number = ($this->input->get('page_number', true) - 1) * $per_page;

		$is_aff = false;
		if (check_module_status('affiliate_products') == 1) {
			$is_aff = true;
		}
		$this->db->select('
			product_information.product_id as id,
            product_information.product_name as name,
            product_information.product_model,
            product_information.price,
            product_information.image_thumb,
			product_category.category_name');
		$this->db->from('product_information');
		$this->db->join('product_category', 'product_category.category_id = product_information.category_id', 'left');
		if ($is_aff) {
			$this->db->where('product_information.is_affiliate IS NULL');
		}
		$this->db->where('product_information.status', 1);
		$this->db->where('product_information.is_assemble', 1);
		$this->db->limit($per_page, $page_number);
		$this->db->order_by('product_information.product_name', 'asc');
		$this->db->group_by('product_information.product_id');
		$json = $this->db->get();
		if ($json->num_rows() > 0) {
			$status = 'success';
			echo $json_encode = json_encode(array('assembly_products' => $json->result_array(), 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json2[] = array(
				'status' => 'error',
				'error'  => 'No products found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('assembly_products' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	public function assembly_product_info($p_id)
	{
		$this->db->select('a.product_id as id, a.product_name as name,a.product_details,a.review,a.description,a.specification,a.bar_code,a.code,a.supplier_id,a.category_id,a.warrantee,a.price,a.supplier_price,a.unit,a.product_model,a.image_thumb,a.brand_id,a.variants,a.default_variant,a.variant_price,a.type,a.best_sale,a.onsale,a.onsale_price,a.invoice_details,a.image_large_details,a.review,a.tag,a.specification,a.video,a.status,a.is_assemble,b.*,c.*');
		$this->db->from('product_information a');
		$this->db->join('product_category b', 'a.category_id = b.category_id', 'LEFT');
		$this->db->join('brand c', 'c.brand_id = a.brand_id', 'LEFT');
		$this->db->where('product_id', $p_id);
		$json = $this->db->get();

		if ($json->num_rows() > 0) {
			$product_info = $json->row_array();
			$product_info['refined_product_details'] = strip_tags(htmlspecialchars_decode($product_info['product_details']));
			$product_info['refined_review'] = strip_tags(htmlspecialchars_decode($product_info['review']));
			$product_info['refined_description'] = strip_tags(htmlspecialchars_decode($product_info['description']));
			$product_info['refined_specification'] = strip_tags(htmlspecialchars_decode($product_info['specification']));
			$product_info['product_link'] = base_url() . 'product/' . remove_space($product_info['name']) . '/' . $product_info['id'];

			// Product images
			$this->db->select('*');
			$this->db->from('image_gallery');
			$this->db->where('product_id', $p_id);
			$product_info['product_images'] = $this->db->get()->result_array();

			// Review Total
			$product_info['product_rating'] = $this->rating_calculator($p_id);

			$review_list = [];
			for ($i = 5; $i >= 1; $i--) {

				$review_list['start_' . $i] = $this->get_total_five_start_rating($p_id, $i);
			}

			$product_info['review_list'] = $review_list;



			$status = 'success';
			echo $json_encode = json_encode(array('assembly_product_info' => $product_info, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json2[] = array(
				'status' => 'error',
				'error'  => 'No products found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('assembly_product_info' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	// assembled products 
	public function assembled_products($p_id)
	{
		$this->db->select('*');
		$this->db->from('assembly_products');
		$this->db->where_in('a_product_id', $p_id);
		$json = $this->db->get()->result_array();
		if (!empty($json)) {
			$assembled_product_details = array();
			foreach ($json as $assembled_product) {
				$this->db->select('a.*,b.product_name,b.image_thumb,b.default_variant,b.price,b.onsale,b.onsale_price');
				$this->db->from('assembly_products_details a');
				$this->db->where('a.assembly_product_id', $assembled_product['id']);
				$this->db->join('product_information b', 'b.product_id=a.product_id', 'left');
				$result = $this->db->get()->result_array();
				foreach ($result as $key => $product) {
					$purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
						->from('transfer')
						->where('product_id', $product['id'])
						->get()
						->row();
					$sales = $this->db->select("SUM(quantity) as totalSalesQnty")
						->from('invoice_stock_tbl')
						->where('product_id', $product['id'])
						->get()
						->row();
					$stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
					if ($stock <= 0) {
						$stock = 0;
					}
					$result[$key]['stock'] = $stock;
				}
				if (!empty($result)) {
					$assembled_product['is_assemble'] = 1;
					$assembled_product['assembled_details'] = $result;
				} else {
					$assembled_product['is_assemble'] = 0;
					$assembled_product['assembled_details'] = array();
				}
				$assembled_product_details[] = $assembled_product;
			}
			$status = 'success';
			$assembly_object  = array('assembled_products' => $assembled_product_details);
			echo $json_encode = json_encode(array('assembly_object' => $assembly_object, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json2[] = array(
				'status' => 'error',
				'error'  => 'No products found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('assembled_products' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	public function assembled_product_details($p_id)
	{
		$this->db->select('a.*,b.product_name,b.image_thumb,b.default_variant,b.price,b.onsale,b.onsale_price');
		$this->db->from('assembly_products_details a');
		$this->db->where('a.assembly_product_id', $p_id);
		$this->db->join('product_information b', 'b.product_id=a.product_id', 'left');
		$json = $this->db->get();
		if ($json->num_rows() > 0) {
			$status = 'success';
			echo $json_encode = json_encode(array('assembled_product_details' => $json->result_array(), 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json2[] = array(
				'status' => 'error',
				'error'  => 'No products found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('assembled_product_details' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	public function languages()
	{
		$result = $this->db->select('*')->from('language_config')->get()->result_array();

		if (!empty($result)) {
			$status = 'success';
			$this->db->select('language');
			$this->db->from('soft_setting');
			$this->db->where('setting_id', 1);
			$default_language = $this->db->get()->row();
			echo $json_encode = json_encode(array('languages' => $result, 'default_language' => $default_language->language, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => 'error',
				'error'  => 'No languages found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('languages' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}

	public function phrases()
	{
		$result = $this->db->select('phrase')->from('language')->get()->result_array();
		if (!empty($result)) {
			$status = 'success';
			echo $json_encode = json_encode(array('languages' => $result, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => 'error',
				'error'  => 'No languages found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('languages' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	public function language_wise_phrases($language)
	{
		$language_infos = $this->db->select('*')->from('language_config')->get()->result_array();
		$languages = array_column($language_infos, 'language');
		if (!in_array($language, $languages)) {
			$json[] = array(
				'status' => 'error',
				'error'  => 'No languages found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('languages' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$finc_column = $this->db->query("SHOW COLUMNS FROM `language` LIKE '" . $language . "'")->result_array();
			if (count($finc_column) > 0) {
				$result = $this->db->select('phrase,' . $language . ' as lang')->from('language')->get()->result_array();
				if (empty($result['lang'])) {
					$object = array();
					foreach ($result as  $phrase) {
						$phasename = $phrase['phrase'];
						$object[$phasename] = $phrase['lang'];
					}
					$language_info = $this->db->select('*')->from('language_config')->where('language', $language)->get()->row();
					$status = 'success';
					echo $json_encode = json_encode(array('languages' => $object, 'language_info' => $language_info, 'status' => $status), JSON_UNESCAPED_UNICODE);
				} else {
					$json[] = array(
						'status' => 'error',
						'error'  => 'No languages found !',
					);
					$status = 'error';
					echo $json_encode = json_encode(array('languages' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
				}
			} else {
				$json[] = array(
					'status' => 'error',
					'error'  => 'No languages found !',
				);
				$status = 'error';
				echo $json_encode = json_encode(array('languages' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
			}
		}
	}


	public function flash_deals()
	{
		$this->db->select('
			supplier_information.supplier_name,
			product_information.product_id,
            product_information.product_name,
            product_information.product_model,
            product_information.unit,
            product_information.price,
            product_information.onsale,
            product_information.onsale_price,
            product_information.supplier_price,
            product_information.onsale_price,
            product_information.image_thumb,
			product_category.category_name,
			unit.unit_short_name');
		$this->db->from('product_information');
		$this->db->where('product_information.onsale', 1);
		$this->db->join('supplier_information', 'product_information.supplier_id = supplier_information.supplier_id', 'left');
		$this->db->join('product_category', 'product_category.category_id = product_information.category_id', 'left');
		$this->db->join('unit', 'unit.unit_id = product_information.unit', 'left');
		$this->db->order_by('product_information.product_name', 'asc');
		$this->db->group_by('product_information.product_id');
		$json = $this->db->get();
		if ($json->num_rows() > 0) {
			$status = 'success';
			echo $json_encode = json_encode(array('flash_deals' => $json->result_array(), 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json2[] = array(
				'status' => 'error',
				'error'  => 'No products found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('flash_deals' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	public function hot_categories()
	{
		$today    = date("Y-m-d");
		$fromdate = date("Y-m-d", strtotime("-30 days"));
		$json = $this->db->query("SELECT COUNT(a.order_id) as order_count, c.category_id, d.category_name, d.cat_image
                    FROM order_details a
                    LEFT JOIN `order` b ON a.order_id = b.order_id
                    LEFT JOIN product_information c ON a.product_id = c.product_id
                    LEFT JOIN product_category d ON d.category_id = c.category_id
                    WHERE DATE(b.created_at) BETWEEN DATE('" . $fromdate . "') AND DATE('" . $today . "')  AND c.category_id IS NOT NULL
                    GROUP BY c.category_id ORDER BY order_count DESC LIMIT 5");
		if ($json->num_rows() > 0) {
			$status = 'success';
			echo $json_encode = json_encode(array('hot_categories' => $json->result_array(), 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json2[] = array(
				'status' => 'error',
				'error'  => 'No products found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('flash_deals' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	public function send_mail($email, $ptoken)
	{
		$CI = &get_instance();
		$CI->load->model('dashboard/Soft_settings');
		$setting_detail = $CI->Soft_settings->retrieve_email_editdata();
		$subject = 'Reset Password';
		$message = 'To reset your password, Click the link bellow...' . '<br>' . '<a href="' . base_url('web/customer/Login/password_reset_form/' . $ptoken) . '"> Reset Password</a>';
		$config = array(
			'protocol'  => $setting_detail[0]['protocol'],
			'smtp_host' => $setting_detail[0]['smtp_host'],
			'smtp_port' => $setting_detail[0]['smtp_port'],
			'smtp_user' => $setting_detail[0]['sender_email'],
			'smtp_pass' => $setting_detail[0]['password'],
			'mailtype'  => $setting_detail[0]['mailtype'],
			'charset'   => 'utf-8'
		);
		$CI->load->library('email');
		$CI->email->initialize($config);
		$CI->email->set_newline("\r\n");
		$CI->email->from($setting_detail[0]['sender_email']);
		$CI->email->to($email);
		$CI->email->subject($subject);
		$CI->email->message($message);
		if ($CI->email->send()) {
			$json[] = array(
				'status' => 'Success',
				'Success'  => 'Email send to customer',
			);
			$status = 'Success';
			echo $json_encode = json_encode(array('email' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json2[] = array(
				'status' => 'error',
				'error'  => 'Email not sent',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('email' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	//check user exists on the database or not
	public function get_user_info($email)
	{
		$this->load->model('dashboard/Customers');
		$result = $this->Customers->get_user_info($email);
		return $result;
	}
	//set token to specific email
	public function update_recovery_pass($precdat)
	{
		$this->load->model('dashboard/Customers');
		$result = $this->Customers->set_token($precdat);
		return $result;
	}
	public function forget_password()
	{
		$email = $this->input->get('email', TRUE);

		if (!empty($email)) {
			$user = $this->get_user_info($email);
			$ptoken = md5($email . time());

			if ($user) {
				$email = $user[0]['customer_email'];
				$precdat = array(
					'email' => $email,
					'token' => $ptoken,
				);

				$send_email = '';
				if (!empty($email)) {
					$send_email = $this->send_mail($email, $ptoken);
					$this->update_recovery_pass($precdat);
				}
			} else {
				$json2[] = array(
					'status' => 'error',
					'error'  => 'Email does not exist',
				);
				$status = 'error';
				echo $json_encode = json_encode(array('email' => $json2, 'status' => $status), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$json3[] = array(
				'status' => 'error',
				'error'  => 'OOps! Something went wrong',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('email' => $json3, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	// Password update on pass reset
	public function password_update()
	{
		$this->load->model('dashboard/Customers');
		$token = $this->input->get('token', TRUE);
		$data = [
			'token' => $this->input->get('token', TRUE),
			'password' => $this->input->get('password', TRUE)
		];
		$result = $this->Customers->password_update($data);
		if ($result) {
			$json[] = array(
				'status' => 'success',
				'success'  => 'updated successfully !',
			);
			$status = 'success';
			echo $json_encode = json_encode(array('flash_deals' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json[] = array(
				'status' => 'error',
				'error'  => 'Not updated !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('flash_deals' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}
	public function splash_image()
	{
		$this->db->select('*');
		$this->db->from('splash_images');
		$json = $this->db->get();
		if ($json->num_rows() > 0) {
			$status = 'success';
			echo $json_encode = json_encode(array('splash_images' => $json->result_array(), 'status' => $status), JSON_UNESCAPED_UNICODE);
		} else {
			$json = array(
				'status' => 'error',
				'error'  => 'No images found !',
			);
			$status = 'error';
			echo $json_encode = json_encode(array('splash_images' => $json, 'status' => $status), JSON_UNESCAPED_UNICODE);
		}
	}

	// Apply Coupon
	public function apply_coupon()
	{
		$customer_id 	  = $this->input->get('customer_id', true);
		$coupon_code = $this->input->get('coupon_code', true);

		if (!empty($customer_id) && !empty($coupon_code)) {
			$result = $this->db->select('*')
				->from('coupon')
				->where('coupon_discount_code', $coupon_code)
				->where('status', 1)
				->get()
				->row();

			$check_coupon = $this->db->select('customer_id,date,coupon')->where('customer_id', $customer_id)->where('coupon', $coupon_code)->from('order')->get()->row();

			if ($result && empty($check_coupon)) {
				$today     = strtotime(date('d-m-Y'));
				$start_date = strtotime($result->start_date);
				$end_date  = strtotime($result->end_date);

				if (($today >= $start_date) && ($today <= $end_date)) {
					$json[] = array(
						'status' => true,
						'couponinfo' => $result
					);
					echo $json_encode = json_encode(array('response' => $json), JSON_UNESCAPED_UNICODE);
				} else {
					$json[] = array(
						'status' => false,
						'error' => display('coupon_is_expired'),
					);
					echo $json_encode = json_encode(array('response' => $json), JSON_UNESCAPED_UNICODE);
				}
			} else {
				$json[] = array(
					'status' => false,
					'error' => display('invalid_coupon'),
				);
				echo $json_encode = json_encode(array('response' => $json), JSON_UNESCAPED_UNICODE);
			}
		} else {
			$json[] = array(
				'status' => false,
				'error' => 'Missing coupon code or customer id!',
			);
			echo $json_encode = json_encode(array('response' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	// Order details list by order id
	public function order_detials_by_order_id()
	{
		$order_id 	  = $this->input->get('order_id', true);

		if (!empty($order_id)) {

			$this->db->select('a.order_id,a.product_id,d.variant_name,d.variant_id,e.variant_name as variant_color,e.variant_id as variant_color_id,c.product_name');
			$this->db->from('order_details a');
			$this->db->join('product_information c', 'a.product_id = c.product_id', 'left');
			$this->db->join('variant d', 'a.variant_id = d.variant_id', 'left');
			$this->db->join('variant e', 'e.variant_id = a.variant_color', 'left');
			$this->db->where('a.order_id', $order_id);
			$list = $this->db->get()->result_array();

			$response = array(
				'status' => 'success',
				'list'  => $list
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status' => 'error',
				'message'  => 'No data found !',
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}

	// Invoice info
	private function get_invoice_info($order_id)
	{
		$this->db->select('a.invoice_id,a.total_amount,a.store_id');
		$this->db->from('invoice a');
		$this->db->where('a.order_id', $order_id);
		$query = $this->db->get();
		return $query->row();
	}
	//Variant Details
	private function get_variant_details($product_id, $order_id)
	{
		$this->db->select('a.variant_id, a.variant_color');
		$this->db->from('order_details a');
		$this->db->where('a.order_id', $order_id);
		$this->db->where('a.product_id', $product_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
		return false;
	}

	// submit return request
	public function submit_return_request()
	{

		$return_info_all = file_get_contents('php://input');
		$returninfo = json_decode($return_info_all);

		$order_id 	= $returninfo->order_id;
		$product_ids = $returninfo->product_ids;
		$customer_id = $returninfo->customer_id;
		$note 	    = $returninfo->note;

		$invoice_info     = $this->get_invoice_info($order_id);

		$result = FALSE;
		if (!empty($product_ids) && !empty($invoice_info->invoice_id)) {
			$invoice_id = @$invoice_info->invoice_id;
			$data = array(
				'order_id'   => $order_id,
				'invoice_id' => $invoice_id,
				'customer_id' => $customer_id,
				'note'       => $note,
				'status'     => 0
			);
			$result = $this->db->insert('return_request', $data);
			$request_id = $this->db->insert_id();

			if ($result) {
				foreach ($product_ids as $product_id) {
					$variantinfo = $this->get_variant_details($product_id, $order_id);
					$requested_data = array(
						'request_id'   => $request_id,
						'product_id'   => $product_id,
						'variant_id'   => $variantinfo['variant_id'],
						'variant_color' => $variantinfo['variant_color']
					);
					$submit = $this->db->insert('return_request_products', $requested_data);
				}
			}
		}

		if ($result) {
			$response = array(
				'status' => 'success',
				'message'  => 'Return request is sent successfully'
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status' => 'error',
				'message'  => 'Failed, Please try again.',
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}

	// Return Order List
	public function return_order_list()
	{
		$customer_id = $this->input->get('customer_id', true);

		if (!empty($customer_id)) {

			$this->db->select('a.*,b.order');
			$this->db->from('return_request a');
			$this->db->join('order b', 'a.order_id = b.order_id', 'left');
			$this->db->where('a.customer_id', $customer_id);
			$this->db->order_by('a.id', 'desc');
			$list = $this->db->get()->result_array();

			$response = array(
				'status' => 'success',
				'list'  => $list
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status' => 'error',
				'message'  => 'No data found !',
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}

	// Return Order details list by return id
	public function return_detials_by_return_id()
	{
		$return_id  = $this->input->get('return_id', true);

		if (!empty($return_id)) {

			$this->db->select('b.order_id, a.product_id, d.variant_name, d.variant_id, e.variant_name as variant_color, e.variant_id as variant_color_id, c.product_name');
			$this->db->from('return_request_products a');
			$this->db->join('return_request b', 'b.id = a.request_id', 'left');
			$this->db->join('product_information c', 'a.product_id = c.product_id', 'left');
			$this->db->join('variant d', 'a.variant_id = d.variant_id', 'left');
			$this->db->join('variant e', 'e.variant_id = a.variant_color', 'left');
			$this->db->where('a.request_id', $return_id);
			$list = $this->db->get()->result_array();

			$response = array(
				'status' => 'success',
				'list'  => $list
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status' => 'error',
				'message' => 'No data found !',
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}

	public function get_return_info($return_id)
	{
		$this->db->select('*');
		$this->db->from('return_request');
		$this->db->where('id', $return_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

	// Update Return request
	public function update_return_request()
	{
		$return_info_all = file_get_contents('php://input');
		$returninfo = json_decode($return_info_all);


		$return_id 	= $returninfo->return_id;
		$product_ids = $returninfo->product_ids;
		$note 	    = $returninfo->note;

		$retinfo     = $this->get_return_info($return_id);
		$invoice_info = $this->get_invoice_info($retinfo['order_id']);

		$result = FALSE;
		if (!empty($product_ids) && !empty($retinfo)) {
			$data = array(
				'note'       => $note
			);
			$result = $this->db->update('return_request', $data, array('id' => $return_id));

			if ($result) {
				$requested_data = [];
				foreach ($product_ids as $product_id) {
					$variantinfo = $this->get_variant_details($product_id, $retinfo['order_id']);
					$requested_data[] = array(
						'request_id'   => $request_id,
						'product_id'   => $product_id,
						'variant_id'   => $variantinfo['variant_id'],
						'variant_color' => $variantinfo['variant_color']
					);
				}
				$this->db->delete('return_request_products', array('request_id' => $return_id));
				$this->db->insert_batch('return_request_products', $requested_data);
			}
		}

		if ($result) {
			$response = array(
				'status' => 'success',
				'message'  => 'Return request is updated successfully'
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status' => 'error',
				'message'  => 'Failed, Please try again.',
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}
	// Point Settings
	public function point_settings()
	{
		$result = $this->db->select('*')->from('loyalty_points_settings')->where('id', 1)->get()->row();
		if ($result) {
			$response = array(
				'status' => 'success',
				'result' => $result
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status' => 'error',
				'message'  => 'Loyalty Points Status: Failed',
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}

	// Customer Loyalty Points
	public function customer_loyalty_points($customer_id)
	{
		$result = $this->db->select('current_points')->from('loyalty_points')->where('customer_id', $customer_id)->get()->row();
		if ($result) {
			$response = array(
				'status' => 'success',
				'result' => $result
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status'  => 'error',
				'message' => 'Loyalty Points Status: Failed',
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}
	public function insert_loyalty_points($customer_id, $points)
	{
		$piting_status = $this->db->select('*')->from('loyalty_points_settings')->where('id', 1)->get()->row();
		if ($piting_status->status == 1) {
			// here will go the point insertion
			$chq_customer_points = $this->db->select('*')->from('loyalty_points')->where('customer_id', $customer_id)->get()->row();
			if (!empty($chq_customer_points)) {
				$points_data = array(
					'total_points'   => $chq_customer_points->total_points + $points,
					'current_points' => $chq_customer_points->current_points + $points
				);
				$result = $this->db->where('customer_id', $customer_id)->update('loyalty_points', $points_data);
				if (!$result) {
					$response = array(
						'status' => 'error',
						'message' => 'Failed, Please try again.',
					);
					echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
				}
			} else {
				$points_data = array(
					'customer_id'   => $customer_id,
					'total_points'  => $points,
					'current_points' => $points
				);
				$result = $this->db->insert('loyalty_points', $points_data);
				if ($result) {
					$response = array(
						'status' => 'success',
						'message' => 'Loyalty points inserted successfully'
					);
					echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
				} else {
					$response = array(
						'status' => 'error',
						'message'  => 'Failed, Please try again.',
					);
					echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
				}
			}
		}
	}
	public function redeem_loyalty_points($customer_id, $used_points = null)
	{
		$piting_status = $this->db->select('*')->from('loyalty_points_settings')->where('id', 1)->get()->row();
		if ($piting_status->status == 1) {
			// loyalty point redeem start
			$chq_current_points = $this->db->select('*')->from('loyalty_points')->where('customer_id', $customer_id)->get()->row();
			if (!empty($used_points)) {
				if ($used_points <= $chq_current_points->current_points) {
					$customer_points = $this->db->select('*')->from('loyalty_points')->where('customer_id', $customer_id)->get()->row();
					if (!empty($customer_points)) {
						$points_data = array(
							'current_points' => $customer_points->current_points - $used_points
						);
						$result = $this->db->where('customer_id', $customer_id)->update('loyalty_points', $points_data);
						if (!$result) {
							$response = array(
								'status'   => 'error',
								'message'  => 'Failed, Please try again.',
							);
							echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
						}
					}
				}
			}
			// loyalty point redeem end
		}
	}
	public function redirect_for_insufficient_points($customer_id, $used_points = null)
	{
		$piting_status = $this->db->select('*')->from('loyalty_points_settings')->where('id', 1)->get()->row();
		if ($piting_status->status == 1) {
			$chq_current_points = $this->db->select('*')->from('loyalty_points')->where('customer_id', $customer_id)->get()->row();
			if ($used_points > $chq_current_points->current_points) {
				$response = array(
					'status' => 'error',
					'message'  => 'You have insufficient points!',
				);
				echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
			}
		}
	}

	public function get_category_childs()
	{
		$category_id = $this->input->get('category_id', true);
		$categories = $this->db->select('*')->from('product_category')->where('parent_category_id', $category_id)->get()->result_array();

		if (!empty($categories)) {
			$response = array(
				'status'   => 'success',
				'catgories' => $categories
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		} else {
			$response = array(
				'status' => 'error',
				'message' => 'No category found!'
			);
			echo $json_encode = json_encode($response, JSON_UNESCAPED_UNICODE);
		}
	}

	//Order info
	public function order_info_by_status()
	{
		$customer_id = $this->input->get('user_id', TRUE);
		$status = $this->input->get('status', true);
		if ($customer_id) {
			$order_list = $this->db->select('a.*')
				->from('order a')
				->where('a.customer_id', $customer_id)
				->group_by('a.order_id')
				->order_by('a.order', 'desc')
				->limit(50)
				->get()
				->result();
			$json = [];
			if ($order_list) {
				foreach ($order_list as $order) {

					$order_status = $this->get_invoice_status($order->order_id);

					if ($order_status) {
						$status_no = $order_status->invoice_status;
					} else {
						$status_no = 3;
					}
					if ($status_no == $status) {
						$order_details = $this->db->select('a.*,b.product_name,b.image_thumb')
							->from('order_details a')
							->where('order_id', $order->order_id)
							->join('product_information b', 'b.product_id=a.product_id', 'left')
							->get()->result();
						$date_time = explode(" ", $order->created_at);
						$time = $date_time[1];
						//Return order information
						$json[] = array(
							'order_id' 		=> $order->order_id,
							'customer_id' 	=> $order->customer_id,
							'store_id' 		=> $order->store_id,
							'date' 			=> $order->date,
							'total_amount' 	=> $order->total_amount,
							'details' 		=> $order->details,
							'total_discount' => $order->total_discount,
							'service_charge' => $order->service_charge,
							'paid_amount'	=> $order->paid_amount,
							'due_amount'	=> $order->due_amount,
							'created_at'	=> $order->created_at,
							'status_no'	    => $status_no,
							'time'	        => $time,
							'order_details'	=> $order_details
						);
					}
				}
				echo $json_encode = json_encode(array('order_info' => $json, 'status' => TRUE), JSON_UNESCAPED_UNICODE);
			} else {
				$json[] = array(
					'status' => 0,
					'error' => 'No order found !',
				);
				echo $json_encode = json_encode(array('order_info' => $json, 'status' => FALSE), JSON_UNESCAPED_UNICODE);
			}
		} else {
			//Return order information
			$json[] = array(
				'status' => 0,
				'error' => 'No order found !',
			);
			echo $json_encode = json_encode(array('order_info' => $json, 'status' => TRUE), JSON_UNESCAPED_UNICODE);
		}
	}

	public function google_login()
	{
		$get_google_info = file_get_contents('php://input');
		$google_info = json_decode($get_google_info);

		$email      = $google_info->email;
		$first_name = $google_info->first_name;
		$last_name  = $google_info->last_name;
		$phoneNumber = $google_info->phoneNumber;
		$name 		= $google_info->name;
		$gid        = $google_info->gid;
		$guid       = $google_info->guid;

		$check_email = $this->test_input($email);
		if (filter_var($check_email, FILTER_VALIDATE_EMAIL)) {
			//Email existing check
			$customer = $this->db->select('*')
				->from('customer_information')
				->where('customer_email', $email)
				->get()
				->row();
			if (!empty($customer)) {
				$this->db->where('customer_email', $email);
				$this->db->where('guid', $guid);
				$this->db->where('gid', $gid);
				$this->db->where('status', 1);
				$query    = $this->db->get('customer_information');
				$num_rows = $query->num_rows();
				$result   = $query->row();
				if ($num_rows > 0) {

					$json[] = array(
						'auth_status' => 'true',
						'user_id'	  => $result->customer_id
					);
					echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
				} else {
					$gdata = array(
						'gid'  => $gid,
						'guid' => $guid,
					);
					$this->db->where('customer_email', $email);
					$gupdate = $this->db->update('customer_information', $gdata);
					if ($gupdate) {
						$this->db->where('customer_email', $email);
						$this->db->where('guid', $guid);
						$this->db->where('gid', $gid);
						$this->db->where('status', 1);
						$query    = $this->db->get('customer_information');
						$num_rows = $query->num_rows();
						$result   = $query->row();
						if ($num_rows > 0) {
							$json[] = array(
								'auth_status' => 'true',
								'user_id'	  => $result->customer_id
							);
							echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
						}
					} else {
						$json[] = array(
							'auth_status' => 'false',
							'user_id'	 => (!empty($result->customer_id) ? $result->customer_id : null)
						);
						echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
					}
				}
			} else {
				$data = array(
					'customer_id'    => $this->generator(15),
					'customer_name'  => $name,
					'first_name'     => $first_name,
					'last_name'      => $last_name,
					'customer_email' => $email,
					'customer_mobile' => $phoneNumber,
					'gid'            => $gid,
					'guid'           => $guid,
					'status' 		 => 1,
				);
				$result = $this->db->insert('customer_information', $data);
				if ($result) {
					$this->db->where('customer_email', $email);
					$this->db->where('guid', $guid);
					$this->db->where('gid', $gid);
					$this->db->where('status', 1);
					$query    = $this->db->get('customer_information');
					$num_rows = $query->num_rows();
					$result   = $query->row();
					if ($num_rows > 0) {
						$json[] = array(
							'auth_status' => 'true',
							'user_id'	  => $result->customer_id
						);
						echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
					} else {
						$json[] = array(
							'auth_status' => 'false',
							'user_id'	  => (!empty($result->customer_id) ? $result->customer_id : null)
						);
						echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
					}
				}
			}
		} else {
			$json[] = array(
				'error' => "Email is not validate!",
			);
			echo $json_encode = json_encode(array('registration_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}

	public function facebook_login()
	{
		$get_facebook_info = file_get_contents('php://input');
		$facebook_info = json_decode($get_facebook_info);
		$email      = $facebook_info->email;
		$first_name = $facebook_info->first_name;
		$last_name  = $facebook_info->last_name;
		$phoneNumber = $facebook_info->phoneNumber;
		$name 		= $facebook_info->name;
		$fid        = $facebook_info->fid;
		$fuid       = $facebook_info->fuid;

		$check_email = $this->test_input($email);
		if (filter_var($check_email, FILTER_VALIDATE_EMAIL)) {
			//Email existing check
			$customer = $this->db->select('*')
				->from('customer_information')
				->where('customer_email', $email)
				->get()
				->row();
			if (!empty($customer)) {
				$this->db->where('customer_email', $email);
				$this->db->where('fuid', $fuid);
				$this->db->where('fid', $fid);
				$this->db->where('status', 1);
				$query    = $this->db->get('customer_information');
				$num_rows = $query->num_rows();
				$result   = $query->row();
				if ($num_rows > 0) {
					$json[] = array(
						'auth_status' => 'true',
						'user_id'	  => $result->customer_id
					);
					echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
				} else {
					$fdata = array(
						'fid'  => $fid,
						'fuid' => $fuid,
					);
					$this->db->where('customer_email', $email);
					$fupdate = $this->db->update('customer_information', $fdata);
					if ($fupdate) {
						$this->db->where('customer_email', $email);
						$this->db->where('fuid', $fuid);
						$this->db->where('status', 1);
						$query    = $this->db->get('customer_information');
						$num_rows = $query->num_rows();
						$result   = $query->row();
						if ($num_rows > 0) {
							$json[] = array(
								'auth_status' => 'true',
								'user_id'	  => $result->customer_id
							);
							echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
						}
					} else {
						$json[] = array(
							'auth_status' => 'false',
							'user_id'	 => (!empty($result->customer_id) ? $result->customer_id : null)
						);
						echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
					}
				}
			} else {
				$data = array(
					'customer_id'    => $this->generator(15),
					'customer_name'  => $name,
					'first_name'     => $first_name,
					'last_name'      => $last_name,
					'customer_email' => $email,
					'customer_mobile' => $phoneNumber,
					'fid'            => $fid,
					'fuid'           => $fuid,
					'status' 		 => 1,
				);
				$result = $this->db->insert('customer_information', $data);
				if ($result) {
					$this->db->where('customer_email', $email);
					$this->db->where('fuid', $fuid);
					$this->db->where('fid', $fid);
					$this->db->where('status', 1);
					$query    = $this->db->get('customer_information');
					$num_rows = $query->num_rows();
					$result   = $query->row();
					if ($num_rows > 0) {
						$json[] = array(
							'auth_status' => 'true',
							'user_id'	  => $result->customer_id
						);
						echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
					} else {
						$json[] = array(
							'auth_status' => 'false',
							'user_id'	  => (!empty($result->customer_id) ? $result->customer_id : null)
						);
						echo $json_encode = json_encode(array('user_info' => $json), JSON_UNESCAPED_UNICODE);
					}
				}
			}
		} else {
			$json[] = array(
				'error' => "Email is not validate!",
			);
			echo $json_encode = json_encode(array('registration_info' => $json), JSON_UNESCAPED_UNICODE);
		}
	}
}