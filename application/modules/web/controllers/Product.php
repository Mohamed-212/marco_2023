<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('web/lproduct');
        $this->load->model('web/Products_model');
        $this->load->model('dashboard/Subscribers');
    }

    //Default loading for Product Index.
    public function index()
    {
        $content = $this->lproduct->Product_page();
        $this->template_lib->full_website_html_view($content);
    }

    //Product Search
    public function get_search_item()
    {
        $search_item = $this->input->get('term', TRUE);

        $v = $this->db->select('*')->from('variant')->like('variant_name', $search_item, 'both')->get()->result();
        $vArr = ['"22"'];
        if ($v && is_array($v) && count($v) > 0) {
            foreach ($v as $value) {
                $vArr[] = '"' . $value->variant_id . '"';
            }
        }

        // echo json_encode($vArr);exit;

        $products = $this->db->select('product_id as id, product_name as value')
        ->from('product_information')
        ->where('category_id !=', 'DPCIHH462YEXA24')->where('category_id !=', '7OYMIICEX171GYC')
        ->where("(product_name like '%$search_item%' or variants in (" . implode(',', $vArr) . "))", null, false)
        ->where('status', 1)
        ->where('assembly', 0)
             ->limit(10)
        ->get()->result();

        $searchitems = [];
        if(!empty($products)){
            foreach ($products as $product) {
                $item['id'] = $product->id;
                $item['value'] = $product->value;
                $item['prodname'] = remove_space($product->value);
                array_push($searchitems, $item);
            }
        }
        echo json_encode($searchitems);
    }

    //Default loading for Product Details.
    public function product_details($p_id)
    {
        $p_id = urldecode($p_id);
        $content = $this->lproduct->product_details($p_id);
        $this->template_lib->full_website_html_view($content);
    }

    //Check 2d variant stock info
    public function check_2d_variant_info()
    {
        $product_id = $this->input->post('product_id',TRUE);
        $variant_id = $this->input->post('variant_id',TRUE);
        $variant_color = $this->input->post('variant_color',TRUE);

        if (!empty($variant_id)) {
            $variant_id = str_replace(',', '', $variant_id);
        }

        $stock = $this->Products_model->check_variant_wise_stock($variant_id, $product_id, $variant_color);

        $currency_new_id = $this->session->userdata('currency_new_id');
        $cur = $this->db->select('*')->from('currency_info')->where('currency_id', $currency_new_id)->get()->row();
        if ($cur) {
            $r = (float) $cur->convertion_rate;
        } else {
            $r = 1;
        }
        
        if ($stock > 0) {
            $result[0] = "yes";
            $price = $this->Products_model->check_variant_wise_price($product_id, $variant_id, $variant_color);

            $result[1] = get_amount($price['price']);
            $result[2] = get_amount($price['regular_price']);
            $result[3] = (($price['regular_price']>$price['price'])?ceil((($price['regular_price']-$price['price'])/$price['regular_price'])*100):0);
            $result[4] = $stock;
            $p = get_amount($price['regular_price']);
            if ($cur) {
                $p = str_replace($cur->currency_icon, '', $p);
            } else {
                $p = str_replace('EGP', '', $p);
            }
            $result[5] = (float)str_replace(',', '', $p);

        } else {
            $result[0] = 'no';

            $price = $this->Products_model->check_variant_wise_price($product_id, $variant_id, $variant_color);
            $result[1] = get_amount($price['price']);
            $result[2] = get_amount($price['regular_price']);
            $result[3] = (($price['regular_price']>$price['price'])?ceil((($price['regular_price']-$price['price'])/$price['regular_price'])*100):0);
            $result[4] = $stock;
            $p = get_amount($price['regular_price']);
            if ($cur) {
                $p = str_replace($cur->currency_icon, '', $p);
            } else {
                $p = str_replace('EGP', '', $p);
            }
            $result[5] = (float)str_replace(',', '', $p);
        }
        echo json_encode($result);
    }

    //Check variant wise stock
    public function check_variant_wise_stock()
    {
        $variant_id    = $this->input->post('variant_id',TRUE);
        $product_id    = $this->input->post('product_id',TRUE);
        $variant_color = $this->input->post('variant_color',TRUE);
        $stock         = $this->Products_model->check_variant_wise_stock($variant_id, $product_id);

        if ($stock > 0) {
            echo "1";
        } else {
            echo "2";
        }
    }

    //Check quantity wise stock
    public function check_quantity_wise_stock()
    {
        $quantity      = $this->input->post('product_quantity',TRUE);
        $product_id    = $this->input->post('product_id',TRUE);
        $variant       = $this->input->post('variant',TRUE);
        $variant_color = $this->input->post('variant_color',TRUE);
        $stock         = $this->Products_model->check_quantity_wise_stock($quantity, $product_id, $variant, $variant_color); 
        if ($stock >= $quantity) {
            echo "yes";
        } else {
            echo "no";
        }
    }

    public function brand_product($brand_id=null)
    {
        $price_range = $this->input->get('price',TRUE);
        $size        = $this->input->get('size',TRUE);
        $sort        = $this->input->get('sort',TRUE);
        $rate        = $this->input->get('rate',TRUE);
        $cat        = $this->input->get('cat',TRUE);

        $url = str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $qs = !empty($_SERVER['QUERY_STRING']) ? explode('&', $_SERVER['QUERY_STRING']) : [];
        $q = [];
        $qstr = '';
        foreach ($qs as $k){
            $k = explode('=', $k);
            if ($k[0] == 'per_page') continue;
            $q[$k[0]] = $k[1];
        }

        foreach ($q as $key => $val) {
            $qstr .= "$key=$val&";
        }
        $qstr = substr($qstr, 0, -1);

// echo "<pre>";
// var_dump($q, $qstr, $url, $_SERVER);
// exit;
        #
        #pagination starts
        #
        $config["base_url"]    = base_url($url . $qstr);
        $config["total_rows"]  = $this->Products_model->retrieve_brand_productcount($brand_id,$price_range,$size,$sort,$rate, $cat);
        // var_dump($this->Products_model->retrieve_brand_productcount($brand_id,$price_range,$size,$sort,$rate, $cat));exit;
        $config["per_page"]    = 20;
        $config["uri_segment"] = 5;
        $config["num_links"]   = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open']  = "<ul class='pagination justify-content-center'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open']   = "<li class='page-item'>";
        $config['num_tag_close']  = '</li>';
        $config['cur_tag_open']   = "<li class='page-item active'><a href='#'>";
        $config['cur_tag_close']  = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']  = "<li class='page-item'>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open']  = "<li class='page-item'>";
        $config['prev_tagl_close']= "</li>";
        $config['first_tag_open'] = "<li class='page-item'>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li class='page-item'>";
        $config['last_tagl_close'] = "</li>";
        $config['prev_link'] = display('Previous');
        $config['next_link'] = display('Next');
        // $config['reuse_query_string'] = false;
        $config['page_query_string'] = true;
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = $_GET['per_page'] ?? 0;
        $links = $this->pagination->create_links();

        $content = $this->lproduct->brand_product($brand_id,$links,$config["per_page"],$page,$price_range,$size,$sort,$rate, $cat);
        $this->template_lib->full_website_html_view($content);
    }

    //Submit a subscriber.
    public function add_subscribe()
    {
        $data = array(
            'subscriber_id' => $this->generator(15),
            'apply_ip' => $this->input->ip_address(),
            'email' => $this->input->post('sub_email',TRUE),
            'status' => 1
        );

        $result = $this->Subscribers->subscriber_entry($data);

        if ($result) {
            echo "2";
        } else {
            echo "3";
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
}