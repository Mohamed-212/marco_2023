<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lproduct
{

    //Product Details Page Load Here
    public function product_details($p_id)
    {
        $CI =& get_instance();
        $CI->load->model('web/products_model');
        $CI->load->model('web/Homes');
        $CI->load->model('dashboard/web_settings');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->model('dashboard/Blocks');
        $CI->load->model('dashboard/themes');
        $CI->load->model('dashboard/Variants');
        $theme = $CI->themes->get_theme();

        $CI->load->library('session');

        $pro_category_list    = $CI->Homes->category_list();
        $parent_category_list = $CI->Homes->parent_category_list();
        $best_sales           = $CI->Homes->best_sales();
        $footer_block         = $CI->Homes->footer_block();
        $slider_list          = $CI->web_settings->slider_list();
        $block_list           = $CI->Blocks->block_list();
        $product_info         = $CI->Products_model->product_info($p_id);
        $price         = $product_info->price;
        $onsale        = $product_info->onsale;
        $onsale_price  = $product_info->onsale_price;
        $default_color = '';
        if($product_info->variant_price){
            $varprices = $CI->Products_model->get_variant_prices($p_id, $product_info->variants, $product_info->default_variant);
            if(!empty($varprices)){
                $price         = $varprices['price'];
                $default_color = $varprices['var_color_id'];
            }
        }
        $stock_report_single_item = $CI->Products_model->stock_report_single_item_by_store($p_id);
        $best_sales_category      = $CI->Products_model->best_sales_category($p_id);
        $product_gallery_img      = $CI->Products_model->product_gallery_img($p_id);
        $category_id = $product_info->category_id;
        $product_id  = $product_info->product_id;
        $review_list 			= $CI->Products_model->review_list_with_customer($p_id);
        $related_product = $CI->Products_model->related_product($category_id, $product_id);
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $web_settings = $CI->web_settings->retrieve_setting_editdata();
        $Soft_settings = $CI->Soft_settings->retrieve_setting_editdata();
        $languages = $CI->Homes->languages();
        $currency_info = $CI->Homes->currency_info();
        $selected_currency_info = $CI->Homes->selected_currency_info();
        $select_details_adds = $CI->Homes->select_details_adds();

        

        // Insert Site Analytics
        $CI->Homes->insert_product_page_visit($p_id);

        // check affiliate
        $is_affiliate = 0;
        $affiliate_url = "javascript:void(0)";
        if(check_module_status('affiliate_products') == 1){
            $is_affiliate  = $product_info->is_affiliate;
            $affiliate_url = $product_info->affiliate_url;
        }

        // check assembly
        $is_assembly = 0;
        if(check_module_status('assembly_products') == 1){
            $is_assembly  = $product_info->is_assemble;
        }


        // translation part start
        $language = $Soft_settings[0]['language'];
        $translated = '';
        $product_name = $product_info->product_name;
        $product_details = $product_info->product_details;
        $specification = $product_info->specification;
        $description = $product_info->description;
        $category_name = $product_info->category_name;
        $brand_name = $product_info->brand_name;
        if($_SESSION["language"] != $language){
            $translated = $CI->db->select('*')->from('product_translation')->where('product_id',$product_info->product_id)->where('language',ucfirst($_SESSION["language"]))->get()->row(); 
            $product_name = (!empty($translated->trans_name)?$translated->trans_name:$product_info->product_name);
            $product_details = (!empty($translated->trans_details)?$translated->trans_details:$product_info->product_details);
            $specification = (!empty($translated->trans_specification)?$translated->trans_specification:$product_info->specification);
            $description = (!empty($translated->trans_description)?$translated->trans_description:$product_info->description);
            $translated_category = $CI->db->select('*')->from('category_translation')->where('category_id',$product_info->category_id)->where('language',ucfirst($_SESSION["language"]))->get()->row();
            $category_name = (!empty($translated_category->trans_name)?$translated_category->trans_name:$product_info->category_name);
            $translated_brand = $CI->db->select('*')->from('brand_translation')->where('brand_id',$product_info->brand_id)->where('language',ucfirst($_SESSION["language"]))->get()->row();
            $brand_name = (!empty($translated_brand->trans_name)?$translated_brand->trans_name:$product_info->brand_name);
        }
        // translation part end
        // $productModelOnly = trim(preg_replace("/- C.*$/i", '', $product_info->product_model));
        $productModelOnly = $product_info->product_model_only;

        // $varients = $CI->db->select('*')->from('product_information')->where('product_model LIKE', "%$productModelOnly%")->get()->result_array();
        $varients = $CI->db->select('p.*, pr.product_price as whole_price')
            ->from('product_information p')
            ->join('pricing_types_product pr', 'pr.product_id = p.product_id AND pr.pri_type_id = 1', 'left')
            ->where('p.product_model_only IS NOT NULL', null, false)
            ->where('p.product_model_only', $product_info->product_model_only)
            ->get()->result_array();

        $varientsArray = [];
        foreach ($varients as $product) {
            // $productVarients = ;
            
            // check if only size was added
            // if (!is_array($productVarients) && !isset($productVarients[1])) continue;
            

            // get color varient information
            // $colorVarient = $CI->Variants->variant_search_item($productVarients[1]);

            // var_dump($colorVarient);
            // if varient is not valied
            // if (!$colorVarient || !isset($colorVarient[0])) continue;

            $product['color'] = trim(substr($product['product_model'], strlen($productModelOnly)+ 3));
            $product['size_id'] = str_replace(',', '', $product['variants']);
            
            $varientsArray[] = $product;
        }

        // sort($varientsArray);

        usort($varientsArray, fn($a, $b) => $a['color'] <=> $b['color']);



        // echo "<pre>";
        // print_r($varientsArray);
        // exit;

       


        $data = array(
            'title'           => display('product_details'),
            'category_list'   => $parent_category_list,
            'slider_list'     => $slider_list,
            'block_list'      => $block_list,
            'best_sales'      => $best_sales,
            'footer_block'    => $footer_block,
            'product_name'    => trim(preg_replace("/- C.*/i", "", $product_name)),
            'product_color'    => trim(substr($product['product_model'], strlen($productModelOnly)+ 3)),
            'brand_name'      => $brand_name,
            'brand_id'        => $product_info->brand_id,
            'product_id'      => $product_info->product_id,
            'product_details' => $product_details,
            'product_model'   => $product_info->product_model,
            'type'            => $product_info->type,
            'price'           => $price ,
            'onsale'          => $onsale,
            'onsale_price'    => $onsale_price,
            'image_thumb'     => $product_info->image_thumb,
            'variant'         => $product_info->variants,
            'default_variant' => $product_info->default_variant,
            'default_color'   => $default_color,
            'category_name'   => $category_name,
            'variant_price'   => $product_info->variant_price,
            'video'           => $product_info->video,
            'category_id'     => $category_id,
            'stok'            => $stock_report_single_item,
            'related_product' => $related_product,
            'image_large_details'=> $product_info->image_large_details,
            'product_gallery_img'=> $product_gallery_img,
            'review'             => $product_info->review,
            'description'        => $description,
            'tag'                => $product_info->tag,
            'specification'      => $specification,
            'pro_category_list'  => $pro_category_list,
            'web_settings'       => $web_settings,
            'Soft_settings'      => $Soft_settings,
            'languages'          => $languages,
            'currency_info'      => $currency_info,
            'selected_cur_id'    => (($selected_currency_info->currency_id) ? $selected_currency_info->currency_id : ""),
            'currency'           => $currency_details[0]['currency_icon'],
            'position'           => $currency_details[0]['currency_position'],
            'best_sales_category'=> $best_sales_category,
            'review_list' 		 => $review_list,
            'select_details_adds'=> $select_details_adds,
            'is_affiliate'       => $is_affiliate,
            'is_assembly'        => $is_assembly,
            'affiliate_url'      => $affiliate_url,
            'varients' => $varientsArray,
            'isLogIn' => !empty($CI->session->userdata('customer_id')),
        );

        if($is_assembly==1){
            $data['assembled_products'] = $CI->Products_model->assembled_products($p_id);
            $HomeForm = $CI->parser->parse('web/themes/' . $theme . '/assembly_details', $data, true);
        }else{
            $HomeForm = $CI->parser->parse('web/themes/' . $theme . '/details', $data, true);
        }
        return $HomeForm;
    }


    //Brand product
    public function brand_product($brand_id=null,$links,$per_page,$page,$price_range=null,$size=null,$sort=null,$rate=null,$cat=null)
    {
        $CI =& get_instance();
        $CI->load->model('web/Products_model');
        $CI->load->model('web/Categories');
        $CI->load->model('web/Homes');
        $CI->load->model('dashboard/web_settings');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->model('dashboard/Blocks');
        $CI->load->model('dashboard/Companies');
        $CI->load->model('dashboard/Variants');
        $CI->load->model('dashboard/Themes');
        $theme = $CI->Themes->get_theme();
        $CI->load->library('session');

        $brand_product 	  = $CI->Products_model->retrieve_brand_product($brand_id,$per_page,$page,$price_range,$size,$sort,$rate,$cat);

        $brand_info 	  = $CI->Products_model->select_brand_info($brand_id);
        $categoryList 	  = $CI->Homes->parent_category_list();
        $pro_category_list= $CI->Homes->category_list();
        $best_sales 	  = $CI->Homes->best_sales();
        $footer_block 	  = $CI->Homes->footer_block();
        $block_list 	  = $CI->Blocks->block_list();
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $soft_settings 	  = $CI->Soft_settings->retrieve_setting_editdata();
        $web_settings 	  = $CI->web_settings->retrieve_setting_editdata();
        $languages 		  = $CI->Homes->languages();
        $currency_info 	  = $CI->Homes->currency_info();
        $selected_currency_info = $CI->Homes->selected_currency_info();
        $company_info  	  = $CI->Companies->company_list();
        $selected_default_currency_info = $CI->Homes->selected_default_currency_info();
        $variant_list  	  = $CI->Variants->variant_list();


        $max_value   	 = $CI->Products_model->get_max_value_of_pro($brand_id);
        $min_value   	 = $CI->Products_model->get_min_value_of_pro($brand_id);
        if ($max_value->price == $min_value->price) {
            $max = $max_value->price;
            $min = 0;
        }else{
            $max = $max_value->price;
            $min = $min_value->price;
        }

        $from_price = 0;
        $to_price 	= 0;
        if (!(empty($price_range))) {
            $ex = explode("-", $price_range);
            $from_price = $ex[0];
            $to_price   = $ex[1];
        }

        $data = array(
            'title' 		  => display('brand_product'),
            'brand_product'   => $brand_product,
            'brand_id' 		  => $brand_id,
            'brand_name' 	  => $brand_info->brand_name,
            'pro_category_list' => $pro_category_list,
            'category_list'   => $categoryList,
            'block_list' 	  => $block_list,
            'best_sales' 	  => $best_sales,
            'footer_block' 	  => $footer_block,
            'languages' 	  => $languages,
            'currency_info'   => $currency_info,
            'selected_cur_id' => (($selected_currency_info->currency_id)?$selected_currency_info->currency_id:""),
            'selected_currency_icon'  => $selected_currency_info->currency_icon,
            'selected_currency_name'  => $selected_currency_info->currency_name,
            'web_settings'    => $web_settings,
            'Soft_settings'   => $soft_settings,
            'logo' 			  => $web_settings[0]['logo'],
            'favicon' 		  => $web_settings[0]['favicon'],
            'footer_text'     => $web_settings[0]['footer_text'],
            'company_name'    => $company_info[0]['company_name'],
            'email'  		  => $company_info[0]['email'],
            'address'  		  => $company_info[0]['address'],
            'mobile'  		  => $company_info[0]['mobile'],
            'website'  		  => $company_info[0]['website'],
            'currency' 		  => $currency_details[0]['currency_icon'],
            'position' 		  => $currency_details[0]['currency_position'],
            'links' 		  => $links,
            'max_value' 	  => $max,
            'min_value' 	  => $min,
            'from_price' 	  => $from_price,
            'to_price' 		  => $to_price,
            'default_currency_icon' => $selected_default_currency_info->currency_icon,
            'variant_list'  => $variant_list,
            'isLogIn' => !empty($CI->session->userdata('customer_id')),
        );
        $categoryList = $CI->parser->parse('web/themes/' . $theme .'/brand_product',$data,true);
        return $categoryList;
    }
  
}

?>