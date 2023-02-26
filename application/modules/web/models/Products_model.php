<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    //Product info
    public function product_info($p_id)
    {
        $this->db->select('a.*,b.*,c.*');
        $this->db->from('product_information a');
        $this->db->join('product_category b','a.category_id = b.category_id','LEFT');
        $this->db->join('brand c','c.brand_id = a.brand_id','LEFT');
        $this->db->where('product_id',$p_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();   
        }
        return false;
    }
    //Select max value of product
    public function get_max_value_of_pro($brand_id=null){
        $this->db->select_max('price');
        $this->db->from('product_information');
        $this->db->where('brand_id',$brand_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }
    //Select min value of product
    public function get_min_value_of_pro($brand_id=null){
        $this->db->select_min('price');
        $this->db->from('product_information');
        $this->db->where('brand_id',$brand_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }
    //Retrive promotion product
    public function promotion_product(){
        $this->db->select('a.product_id,a.category_id,a.product_name,a.image_thumb,a.onsale_price,b.category_name');
        $this->db->from('product_information a');
        $this->db->join('product_category b','a.category_id = b.category_id','left');
        $this->db->where('a.onsale',1);
        $this->db->limit(4);
        $this->db->order_by('a.id','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    //Category wise best product
    public function best_sales_category($p_id)
    {
        $this->db->select('a.*,b.*,e.brand_name');
        $this->db->from('product_information a');
        $this->db->join('product_category b','a.category_id = b.category_id','left');
        $this->db->join('brand e','a.brand_id = e.brand_id','left');
        $this->db->where('a.best_sale',1);
        $this->db->order_by('a.id','desc');
        $this->db->where_not_in('a.product_id',$p_id);
        $query = $this->db->get();
        return $query->result();
    }


    //Get total five start rating
    public function get_total_five_start_rating($product_id = null,$rate){
        return $this->db->select('*')
            ->from('product_review')
            ->where('product_id',$product_id)
            ->where('rate',$rate)
            ->where('status',1)
            ->get()
            ->num_rows();
    }

    //Get customer name for product rating
    public function get_customer_name($customer_id){
        $result = $this->db->select('customer_name')
            ->from('customer_information')
            ->where('customer_id',$customer_id)
            ->get()
            ->row();
        if ($result) {
            return $result;
        }else{
            return null;
        }
    }

    //Product review list
    public function review_list($p_id)
    {
        $this->db->select('*');
        $this->db->from('product_review');
        $this->db->where('product_id',$p_id);
        $this->db->order_by('product_review_id','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

 //Product review list
    public function review_list_with_customer($p_id)
    {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('product_review a');
        $this->db->join('customer_information b','a.reviewer_id=b.customer_id');
        $this->db->where('a.product_id',$p_id);
        $this->db->where('a.status',1);
        $this->db->order_by('a.product_review_id','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    //Product gallery image
    public function product_gallery_img($p_id)
    {
        $this->db->select('*');
        $this->db->from('image_gallery');
        $this->db->where('product_id',$p_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
    }

    //Stock Report Single Product
    public function stock_report_single_item($p_id)
    {
        $this->db->select("
            sum(d.quantity) as totalSalesQnty,
            sum(b.quantity) as totalPurchaseQnty,
            ");
        $this->db->from('product_information a');
        $this->db->join('product_purchase_details b','b.product_id = a.product_id','left');
        $this->db->join('invoice_details d','d.product_id = a.product_id','left');
        $this->db->join('product_purchase e','e.purchase_id = b.purchase_id','left');
        $this->db->where('a.product_id',$p_id);
        $this->db->order_by('a.product_name','asc');
        $this->db->where(array('a.status'=>1));
        $query = $this->db->get();
        return $query->result();
    }

    //Stock Report By Store
    public function stock_report_single_item_by_store($p_id)
    {
        $result = $this->db->select('*')
        ->from('store_set')
        ->where('default_status','1')
        ->get()
        ->row();
        if ($result) {
            $purchase = $this->db->select("SUM(quantity) as totalPurchaseQnty")
            ->from('transfer')
            ->where('product_id',$p_id)
            ->where('store_id',$result->store_id)
            ->get()
            ->row();
            $sales = $this->db->select("SUM(quantity) as totalSalesQnty")
            ->from('invoice_stock_tbl')
            ->where('product_id',$p_id)
            ->where('store_id',$result->store_id)
            ->get()
            ->row();
            // $product_information = $this->db->select('open_quantity')->from('product_information')->where('product_id', $p_id)->get()->row();

        $stock = $purchase->totalPurchaseQnty - $sales->totalSalesQnty;
        // $stock = ($purchase->totalPurchaseQnty + $product_information->open_quantity) - $sales->totalSalesQnty;
        return $stock;
        }else{
            return "none";
        }
    }       

    //Check variant wise stock
    public function check_variant_wise_stock($variant_id, $product_id, $variant_color = false)
    {
        $result = $this->db->select('*')
        ->from('store_set')
        ->where('default_status','1')
        ->get()
        ->row();

        // $this->db->select('open_quantity')
        //     ->from('product_information')
        //     ->where('product_id',$product_id);
            // ->where('variants LIKE ',"%$variant_id%");
        // $openQuantity = $this->db->get()->row()->open_quantity;
        
        $this->db->select("SUM(quantity) as totalPurchaseQnty");
        $this->db->from('purchase_stock_tbl');
        $this->db->where('product_id',$product_id);
        $this->db->where('variant_id',$variant_id);
        if(!empty($variant_color)){
             $this->db->where('variant_color',$variant_color);
        }
        $this->db->where('store_id',$result->store_id);
        $purchase = $this->db->get()->row();
        
        $this->db->select("SUM(quantity) as totalSalesQnty");
        $this->db->from('invoice_stock_tbl');
        $this->db->where('product_id',$product_id);
        $this->db->where('variant_id',$variant_id);
        if(!empty($variant_color)){
             $this->db->where('variant_color',$variant_color);
        }
        $this->db->where('store_id',$result->store_id);
        $sales = $this->db->get()->row();
        // $stock = (($purchase->totalPurchaseQnty + (int)$openQuantity) - $sales->totalSalesQnty);
        $stock = ($purchase->totalPurchaseQnty - $sales->totalSalesQnty);
        return $stock;
    }   
    public function get_product_cart_quantity($product_id, $variant, $variant_color=false)
    {
        $cart_qnty = 0;
        if ($this->cart->contents()) {
            foreach ($this->cart->contents() as $items){
                if (($items['product_id'] == $product_id) && ($items['variant'] == $variant)) {
                    $cart_qnty = $items['qty'];
                }
            }
        }
        return $cart_qnty;
    }

    //variant wise price
    public function check_variant_wise_price($product_id, $variant_id, $variant_color = false)
    {
        $pinfo = $this->db->select('p.price, p.onsale, p.onsale_price, p.variant_price, pr.product_price as whole_price')
                ->from('product_information p')
                ->join('pricing_types_product pr', 'pr.product_id = p.product_id AND pr.pri_type_id = 1', 'left')
                ->where('p.product_id', $product_id)
                ->get()->row();
        if($pinfo->variant_price){
            $this->db->select('price');
            $this->db->from('product_variants');
            $this->db->where('product_id', $product_id);
            $this->db->where('var_size_id', $variant_id);
            if(!empty($variant_color)){
                $this->db->where('var_color_id', $variant_color);
            }else{
                $this->db->where("var_color_id IS NULL");
            }
            $varprice = $this->db->get()->row();
            if(!empty($varprice)){
                $price_arr['price'] = $varprice->price;
                $price_arr['regular_price'] = $pinfo->price;
            }else{
                 if(!empty($pinfo->onsale) && !empty($pinfo->onsale_price)){
                    $price_arr['price'] = $pinfo->onsale_price;
                    // $price_arr['regular_price'] = $pinfo->price;
                    $price_arr['regular_price'] = $pinfo->whole_price;
                }else{
                    // $price_arr['price'] = $price_arr['regular_price'] = $pinfo->price;
                    $price_arr['regular_price'] = $pinfo->whole_price;
                }
            }
        } else{

            if(!empty($pinfo->onsale) && !empty($pinfo->onsale_price)){
                $price_arr['price'] = $pinfo->onsale_price;
                // $price_arr['regular_price'] = $pinfo->price;
                $price_arr['regular_price'] = $pinfo->whole_price;
            }else{
                // $price_arr['price'] = $price_arr['regular_price'] = $pinfo->price;
                $price_arr['price'] = $price_arr['regular_price'] = $pinfo->whole_price;
            }
        }
        return $price_arr;
    }


    //Check product Quantity wise stock
    public function check_quantity_wise_stock($quantity, $product_id, $variant, $variant_color = false)
    {
        $result = $this->db->select('*')
        ->from('store_set')
        ->where('default_status','1')
        ->get()
        ->row();

        $variant = str_replace(',', '', $variant);

        // $this->db->select('open_quantity')
        //     ->from('product_information')
        //     ->where('product_id',$product_id);
            // ->where('variants LIKE ',"%$variant_id%");
        // $openQuantity = $this->db->get()->row()->open_quantity;

        $this->db->select("SUM(quantity) as totalPurchaseQnty");
        $this->db->from('purchase_stock_tbl');
        $this->db->where('product_id',$product_id);
        $this->db->where('store_id',$result->store_id);
        $this->db->where('variant_id',$variant);
        if(!empty($variant_color)){
            $this->db->where('variant_color', $variant_color);
        }
        $purchase = $this->db->get()->row();
        $this->db->select("SUM(quantity) as totalSalesQnty");
        $this->db->from('invoice_stock_tbl');
        $this->db->where('product_id',$product_id);
        $this->db->where('store_id',$result->store_id);
        $this->db->where('variant_id',$variant);
        if(!empty($variant_color)){
            $this->db->where('variant_color', $variant_color);
        }
        $order = $this->db->get()->row();
        // $cart_qnty = $quantity;
        $cart_qnty = $this->get_product_cart_quantity($product_id, $variant);
        
        // $result = (($purchase->totalPurchaseQnty + (int)$openQuantity) - ($order->totalSalesQnty + $cart_qnty));

        $result = $purchase->totalPurchaseQnty - ($order->totalSalesQnty + $cart_qnty);
        return $result;
    }   
    //Category wise related product
    public function related_product($cat_id,$p_id)
    {
        $query = $this->db->select('a.*,b.category_name')
        ->from('product_information a')
        ->join('product_category b','a.category_id=b.category_id')
        ->where('a.category_id',$cat_id)
        ->where_not_in('a.product_id',$p_id)
        ->get()
        ->result();
        return $query;
    }
    public function retrieve_setting_editdata()
    {
        $this->db->select('*');
        $this->db->from('soft_setting');
        $this->db->where('setting_id',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //Retrieve brand product
    public function retrieve_brand_product($brand_id=null, $per_page, $page, $price_range=null,$size=null,$sort=null,$rate=null,$cat=null)
    {
        $Soft_settings = $this->retrieve_setting_editdata();
        $language = $Soft_settings[0]['language'];
        if($_SESSION["language"] != $language){
            $this->db->select('a.*,b.*,e.brand_name,IF(c.trans_name IS NULL OR c.trans_name = "",a.product_name,c.trans_name) as product_name, pr.product_price as whole_price');
            $this->db->from('product_information a');
            $this->db->join('product_category b','a.category_id = b.category_id','left');
            $this->db->join('brand e','a.brand_id = e.brand_id','left');
            $this->db->where('a.brand_id',$brand_id);
            $this->db->join('product_translation c', 'a.product_id = c.product_id', 'left');
            $this->db->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left');
        }else{
            $this->db->select('a.*,b.*,e.brand_name, pr.product_price as whole_price');
            $this->db->from('product_information a');
            $this->db->join('product_category b','a.category_id = b.category_id','left');
            $this->db->join('brand e','a.brand_id = e.brand_id','left');
            $this->db->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left');
            $this->db->where('a.brand_id',$brand_id);
            
            // $this->db->having();
        }
        $this->db->where('a.image_thumb !=', null);
        $this->db->where('a.image_thumb !=', '');
        $this->db->group_by('a.product_model_only');
        $this->db->order_by('a.product_name','desc');
        // echo "<pre>";var_dump($this->db->get()->result_array());exit;
        if ($price_range) {
            $ex = explode("-", $price_range);
            $from = $ex[0];
            $to = $ex[1];
            // $this->db->where('price >=', $from);
            // $this->db->where('price <=', $to);
            $this->db->where('pr.product_price >=', $from);
            $this->db->where('pr.product_price <=', $to);
        }
        // if ($sort) {
        //     if ($sort == 'new') {
        //         $this->db->order_by('a.id','desc');
        //     }elseif ($sort == 'discount') {
        //         $this->db->order_by('a.offer_price','desc');
        //     }elseif ($sort == 'low_to_high') {
        //         $this->db->order_by('a.price','asc');
        //     }elseif ($sort == 'high_to_low') {
        //         $this->db->order_by('a.price','desc');
        //     }
        // }else{
        //     $this->db->order_by('a.id','desc');
        // }

        // var_dump($per_page, $page);

        $this->db->limit($per_page, $page);
        
        if ($size) {
            $this->db->like('a.variants', $size,'both');
        }

        if(!empty($cat)){
            $all_brand = (explode("--", $cat));
            $this->db->where_in('a.category_id', $all_brand);
        }

        $this->db->where('a.category_id !=', 'DPCIHH462YEXA24');
        $this->db->where('a.category_id !=', '7OYMIICEX171GYC');
        $this->db->where('a.assembly', 0);

        $query = $this->db->get();
        $brand_pro =  $query->result_array();
// echo "<pre>";
//         var_dump($rate, $brand_pro);exit;

        if ($rate) {
            return $this->get_rating_product($brand_pro,$rate);
        }else{
            return $brand_pro;
        }
    }

    public function retrieve_brand_productcount($brand_id=null,$price_range=null,$size=null,$sort=null,$rate=null,$cat=null)
    {
        $Soft_settings = $this->retrieve_setting_editdata();
        $language = $Soft_settings[0]['language'];
        if($_SESSION["language"] != $language){
            $this->db->select('a.*,b.*,e.brand_name,IF(c.trans_name IS NULL OR c.trans_name = "",a.product_name,c.trans_name) as product_name, pr.product_price as whole_price');
            $this->db->from('product_information a');
            $this->db->join('product_category b','a.category_id = b.category_id','left');
            $this->db->join('brand e','a.brand_id = e.brand_id','left');
            $this->db->where('a.brand_id',$brand_id);
            $this->db->join('product_translation c', 'a.product_id = c.product_id', 'left');
            $this->db->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left');
        }else{
            $this->db->select('a.*,b.*,e.brand_name, pr.product_price as whole_price');
            $this->db->from('product_information a');
            $this->db->join('product_category b','a.category_id = b.category_id','left');
            $this->db->join('brand e','a.brand_id = e.brand_id','left');
            $this->db->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left');
            $this->db->where('a.brand_id',$brand_id);
            
            // $this->db->having();
        }
        $this->db->where('a.image_thumb !=', null);
        $this->db->where('a.image_thumb !=', '');
        $this->db->group_by('a.product_model_only');
        $this->db->order_by('a.product_name','desc');
        // echo "<pre>";var_dump($this->db->get()->result_array());exit;
        if ($price_range) {
            $ex = explode("-", $price_range);
            $from = $ex[0];
            $to = $ex[1];
            // $this->db->where('price >=', $from);
            // $this->db->where('price <=', $to);
            $this->db->where('pr.product_price >=', $from);
            $this->db->where('pr.product_price <=', $to);
        }
        // if ($sort) {
        //     if ($sort == 'new') {
        //         $this->db->order_by('a.id','desc');
        //     }elseif ($sort == 'discount') {
        //         $this->db->order_by('a.offer_price','desc');
        //     }elseif ($sort == 'low_to_high') {
        //         $this->db->order_by('a.price','asc');
        //     }elseif ($sort == 'high_to_low') {
        //         $this->db->order_by('a.price','desc');
        //     }
        // }else{
        //     $this->db->order_by('a.id','desc');
        // }
        
        if ($size) {
            $this->db->like('a.variants', $size,'both');
        }

        if(!empty($cat)){
            $all_brand = (explode("--", $cat));
            $this->db->where_in('a.category_id', $all_brand);
        }

        $this->db->where('a.category_id !=', 'DPCIHH462YEXA24');
        $this->db->where('a.category_id !=', '7OYMIICEX171GYC');
        $this->db->where('a.assembly', 0);

        $query = $this->db->get();
        $brand_pro =  $query->result_array();

        if ($rate) {
            return $this->get_rating_product($brand_pro,$rate);
        }else{
            return count($brand_pro);
        }
    }

    //Get rating product by rate
    public function get_rating_product($brand_pro=null,$rate=null){
        $rate = explode('-', $rate);
        $rate = $rate[0];

        $n_cat_pro = array();
        if ($brand_pro) {
            foreach ($brand_pro as $product) {
                $rater  = $this->get_total_rater_by_product_id($product['product_id']);
                $result = $this->get_total_rate_by_product_id($product['product_id']);
                if ($rater) {
                    $total_rate = $result->rates/$rater;
                    if ($total_rate >= $rate ) {
                        $this->db->select('a.*,b.category_name,c.brand_name,pr.product_price as whole_price');
                        $this->db->from('product_information a');
                        $this->db->join('brand c','c.brand_id = a.brand_id','left');
                        $this->db->join('product_category b','b.category_id = a.category_id');
                        $this->db->join('pricing_types_product pr', 'pr.product_id = a.product_id AND pr.pri_type_id = 1', 'left');
                        $this->db->where('a.product_id',$product['product_id']);
                        $query = $this->db->get();
                        $third_cat_pro = $query->result_array();

                        if ($third_cat_pro) {
                            foreach ($third_cat_pro as $t_cat_pro) {
                                array_push($n_cat_pro, $t_cat_pro);
                            }
                        }
                    }
                }
            }
            return $n_cat_pro;
        }else{
            return $brand_pro;
        }
    }


    //Get total rater by product id
    public function get_total_rater_by_product_id($product_id=null){
        $rater = $this->db->select('rate')
            ->from('product_review')
            ->where('product_id',$product_id)
            ->get()
            ->num_rows();
        return $rater;
    }
    //Get total rate by product id
    public function get_total_rate_by_product_id($product_id=null){
        $rate = $this->db->select('sum(rate) as rates')
            ->from('product_review')
            ->where('product_id',$product_id)
            ->get()
            ->row();
        return $rate;
    }
    
    // Retrieve brand info
    public function select_brand_info($brand_id=null){
        $Soft_settings = $this->retrieve_setting_editdata();
        $language = $Soft_settings[0]['language'];
        if($_SESSION["language"] != $language){
            $this->db->select('a.brand_name,IF(c.trans_name IS NULL OR c.trans_name = "",a.brand_name,c.trans_name) as brand_name');
            $this->db->from('brand a');
            $this->db->where('a.brand_id',$brand_id);
            $this->db->join('brand_translation c', 'a.brand_id = c.brand_id', 'left');
            $query = $this->db->get();
            return $query->row();
        }else{
            $this->db->select('a.brand_name');
            $this->db->from('brand a');
            $this->db->where('a.brand_id',$brand_id);
            $query = $this->db->get();
            return $query->row();
        }
    }

    // Comparison
    public function comparison(){
        $comparisons = $this->session->userdata('comparison_ids');
        if (!empty($comparisons)) {
            $this->db->select('a.*, b.category_name, c.brand_name');
            $this->db->from('product_information a');
            $this->db->join('product_category b', 'b.category_id=a.category_id','left');
            $this->db->join('brand c', 'c.brand_id=a.brand_id','left');
            $this->db->where_in('a.product_id', $comparisons);
            $this->db->group_by('a.product_id');
            $prods = $this->db->get()->result_array();
            $result = [];

            foreach ($prods as $p) {
                $w = $this->db->select('*')->from('pricing_types_product')->where('product_id', $p['product_id'])->where('pri_type_id', 1)->get()->row();
                if ($w) {
                    $p['price'] = $w->product_price;
                }

                $currency_new_id = $this->session->userdata('currency_new_id');
                $cur = $this->db->select('*')->from('currency_info')->where('currency_id', $currency_new_id)->get()->row();
                if ($cur) {
                    $r = (float) $cur->convertion_rate;
                } else {
                    $r = 1;
                }

                $p['price'] = (float)$p['price'] * (float)$r;

                $result[] = $p;
            }            
            
            
            return $result;
        }
        return false;
    }

    // Variant Prices
    public function get_variant_prices($pid, $variants,  $def_size_bar = false)
    {
        $exploded = explode(',', $variants);
        $this->db->select('*');
        $this->db->from('variant');
        $this->db->where_in('variant_id', $exploded);
        $this->db->order_by('variant_name', 'asc');
        $vresult = $this->db->get()->result_array();
        $var_types = array_column($vresult, 'variant_type');

        $def_color_var = '';
        foreach ($vresult as $vitem) {
            if(empty($def_size_bar) && ($vitem['variant_type']=='size')) {
                $def_size_bar = $vitem['variant_id'];
            }

            if(empty($def_color_var) && ($vitem['variant_type']=='color')) {
                $def_color_var = $vitem['variant_id'];
            }
        }

        $this->db->where('product_id', $pid);
        $this->db->where('var_size_id', $def_size_bar);
        if(!empty($def_color_var)){
            $this->db->where('var_color_id', $def_color_var);
        }
        $result = $this->db->get('product_variants')->row_array();
        return $result;
    }

    // Assembly Products 
    public function assembled_products($p_id){
        $this->db->select('*');
        $this->db->from('assembly_products');
        $this->db->where_in('a_product_id', $p_id);
        $result = $this->db->get()->result_array();
        return $result;
    }
}