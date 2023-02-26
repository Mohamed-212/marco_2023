<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lproduct {

    private $table = "language";

    //Product Add Form
    public function product_add_form() {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Categories');
        $CI->load->model('dashboard/Brands');
        $CI->load->model('dashboard/Variants');
        $CI->load->model('dashboard/Units');
        $CI->load->model('dashboard/Cfiltration_model');

        $supplier = $CI->Suppliers->supplier_list();
        $category_list = $CI->Categories->category_list();
        $brand_list = $CI->Brands->brand_list();
        $variant_list = $CI->Variants->variant_list();
        $unit_list = $CI->Units->unit_list();
        $filter_types = $CI->Cfiltration_model->get_all_types();
        $languages = $this->languages();

        $data = array(
            'title' => display('add_product'),
            'supplier' => $supplier,
            'category_list' => $category_list,
            'brand_list' => $brand_list,
            'variant_list' => $variant_list,
            'unit_list' => $unit_list,
            'filter_types' => $filter_types,
            'languages' => $languages,
        );
        $productForm = $CI->parser->parse('dashboard/product/add_product_form', $data, true);
        return $productForm;
    }

    //Product Add Form
    public function product_assemply_add_form() {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Categories');
        $CI->load->model('dashboard/Brands');
        $CI->load->model('dashboard/Variants');
        $CI->load->model('dashboard/Units');
        $CI->load->model('dashboard/Cfiltration_model');

        $supplier = $CI->Suppliers->supplier_list();
        $category_list = $CI->Categories->category_list();
        $brand_list = $CI->Brands->brand_list();
        $variant_list = $CI->Variants->variant_list();
        $unit_list = $CI->Units->unit_list();
        $filter_types = $CI->Cfiltration_model->get_all_types();
        $languages = $this->languages();

        $data = array(
            'title' => display('add_product'),
            'supplier' => $supplier,
            'category_list' => $category_list,
            'brand_list' => $brand_list,
            'variant_list' => $variant_list,
            'unit_list' => $unit_list,
            'filter_types' => $filter_types,
            'languages' => $languages,
        );
        $productForm = $CI->parser->parse('dashboard/product/add_assemply_product_form.php', $data, true);
        return $productForm;
    }

    //Insert product
    public function insert_product($data) {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $result = $CI->Products->product_entry($data);
        if ($result == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Retrive product list
    public function product_list($filter, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $CI->load->library('dashboard/occational');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->model('dashboard/Purchases');
        $products_list_all = $CI->Products->product_list($filter, $per_page, $page);
        $products_list = [];
        foreach ($products_list_all as $p) {
            $purchaseData = $CI->Products->product_purchase_info($p['product_id']);
            $totalPurchase = 0;
            $totalPrcsAmnt = 0;

            if (!empty($purchaseData)) {
                foreach ($purchaseData as $k => $v) {
                    $purchaseData[$k]['final_date'] = $CI->occational->dateConvert($purchaseData[$k]['purchase_date']);
                    $totalPrcsAmnt = ($totalPrcsAmnt + $purchaseData[$k]['total_amount']);
                    $totalPurchase = ($totalPurchase + $purchaseData[$k]['quantity']);
                }
            }

            $salesData = $CI->Products->invoice_data($p['product_id']);

            $totalSales = 0;
            $totaSalesAmt = 0;

            if (!empty($salesData)) {
                foreach ($salesData as $k => $v) {
                    $salesData[$k]['final_date'] = $CI->occational->dateConvert($salesData[$k]['date']);
                    $totalSales = ($totalSales + $salesData[$k]['quantity']);
                    $totaSalesAmt = ($totaSalesAmt + $salesData[$k]['total_price']);
                }
            }

            // $stock = ($totalPurchase + $openQuantity) - $totalSales;
            // $stock = ($totalPurchase - $totalSales);
            // var_dump($totalPurchase . '--' . $totalSales);
            $size_id = $p['variants'];

            // echo "<pre>";var_dump($p);exit;

            // if ($p['assembly'] == 1) {
            //     $stockData = $CI->Purchases->check_variant_wise_stock2($p['product_id'], null, $size_id);
            // } else {
            //     $stockData = $CI->Purchases->check_variant_wise_stock($p['product_id'], null, $size_id);
            // }
            if ($p['assembly'] == 1) {
                $stock = $CI->Purchases->check_variant_wise_stock2($p['product_id'], null, null,null);
            } else {
                $stock = $CI->Purchases->check_variant_wise_stock($p['product_id'], null, null,null);
            }
            $p['stock'] = $stock;
            $products_list[] = $p;
        }  
        $all_supplier_list = $CI->Products->all_supplier_list();
        $all_category_list = $CI->Products->all_category_list();
        $all_unit_list = $CI->Products->all_unit_list();
        $i = $page;
        if (!empty($products_list)) {
            foreach ($products_list as $k => $v) {
                $i++;
                $products_list[$k]['sl'] = $i;
            }
        }
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('manage_product'),
            'products_list' => $products_list,
            'links' => $links,
            'all_supplier_list' => $all_supplier_list,
            'all_category_list' => $all_category_list,
            'all_unit_list' => $all_unit_list,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $productList = $CI->parser->parse('dashboard/product/product', $data, true);
        return $productList;
    }

    //Search Product
    public function product_search_list($product_id) {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Soft_settings');
        $products_list = $CI->Products->product_search_item($product_id);
        $all_product_list = $CI->Products->all_product_list();
        $i = 0;
        if ($products_list) {
            foreach ($products_list as $k => $v) {
                $i++;
                $products_list[$k]['sl'] = $i;
            }
            $currency_details = $CI->Soft_settings->retrieve_currency_info();
            $data = array(
                'title' => display('manage_product'),
                'products_list' => $products_list,
                'all_product_list' => $all_product_list,
                'currency' => $currency_details[0]['currency_icon'],
                'position' => $currency_details[0]['currency_position'],
            );
            $productList = $CI->parser->parse('dashboard/product/product', $data, true);
            return $productList;
        } else {
            redirect('dashboard/cproduct/manage_product');
        }
    }

    //Product Edit Data
    public function product_edit_data($product_id) {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $CI->load->model('dashboard/Suppliers');
        $CI->load->model('dashboard/Categories');
        $CI->load->model('dashboard/Brands');
        $CI->load->model("dashboard/Variants");
        $CI->load->model("dashboard/Units");
        $CI->load->model("dashboard/Galleries");
        $CI->load->model('dashboard/Cfiltration_model');

        $product_detail = $CI->Products->retrieve_product_editdata(urldecode($product_id));
        $provar_prices = $CI->Products->get_product_variant_prices(urldecode($product_id));

        @$supplier_id = $product_detail[0]['supplier_id'];
        @$category_id = $product_detail[0]['category_id'];
        @$brand_id = $product_detail[0]['brand_id'];
        @$variants_ids = $product_detail[0]['variants'];
        @$unit_id = $product_detail[0]['unit'];

        $brand_list = $CI->Brands->brand_list();

        $variant_list = $CI->Variants->variant_list();

        $supplier_list = $CI->Suppliers->supplier_list();

        $category_list = $CI->Categories->category_list();

        $filter_types = $CI->Cfiltration_model->get_all_types();

        $unit_list = $CI->Units->unit_list();
        $gallery_images = $CI->Galleries->get_gallery_images($product_id);
        $languages = $this->languages();
        $data = array(
            'title' => display('product_edit'),
            'product_id' => $product_detail[0]['product_id'],
            'assembly' => $product_detail[0]['assembly'],
            'product_name' => $product_detail[0]['product_name'],
            'warrantee' => $product_detail[0]['warrantee'],
            'bar_code' => $product_detail[0]['bar_code'],
            'price' => $product_detail[0]['price'],
            'supplier_price' => $product_detail[0]['supplier_price'],
            'product_model' => $product_detail[0]['product_model'],
            'product_details' => $product_detail[0]['product_details'],
            'unit' => $product_detail[0]['unit'],
            'image_thumb' => $product_detail[0]['image_thumb'],
            'brand_id' => $product_detail[0]['brand_id'],
            'variants' => $product_detail[0]['variants'],
            'default_variant' => $product_detail[0]['default_variant'],
            'variant_price' => $product_detail[0]['variant_price'],
            'provar_prices' => $provar_prices,
            'video' => $product_detail[0]['video'],
            'type' => $product_detail[0]['type'],
            'best_sale' => $product_detail[0]['best_sale'],
            'onsale' => $product_detail[0]['onsale'],
            'onsale_price' => $product_detail[0]['onsale_price'],
            'invoice_details' => $product_detail[0]['invoice_details'],
            'image_large_details' => $product_detail[0]['image_large_details'],
            'review' => $product_detail[0]['review'],
            'description' => $product_detail[0]['description'],
            'tag' => $product_detail[0]['tag'],
            'specification' => $product_detail[0]['specification'],
            'product_model_only' => $product_detail[0]['product_model_only'],
            'product_color' => $product_detail[0]['product_color'],
            'brand_list' => $brand_list,
            'variant_list' => $variant_list,
            'variant_selected' => $variants_ids,
            'brand_selected' => $brand_id,
            'supplier_list' => $supplier_list,
            'supplier_selected' => $supplier_id,
            'category_list' => $category_list,
            'category_selected' => $category_id,
            'unit_list' => $unit_list,
            'unit_selected' => $unit_id,
            'gallery_images' => $gallery_images,
            'filter_types' => $filter_types,
            'languages' => $languages,
        );
        $chapterList = $CI->parser->parse('dashboard/product/edit_product_form', $data, true);

        return $chapterList;
    }

    //Product Details
    public function product_details($product_id) {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $CI->load->library('dashboard/occational');
        $CI->load->model('dashboard/Soft_settings');
        $details_info = $CI->Products->product_details_info($product_id);
        $purchaseData = $CI->Products->product_purchase_info($product_id);
        $totalPurchase = 0;
        $totalPrcsAmnt = 0;

        // var_dump($purchaseData);exit;

        if (!empty($purchaseData)) {
            foreach ($purchaseData as $k => $v) {
                $purchaseData[$k]['final_date'] = $CI->occational->dateConvert($purchaseData[$k]['purchase_date']);
                $totalPrcsAmnt = ($totalPrcsAmnt + $purchaseData[$k]['total_amount']);
                $totalPurchase = ($totalPurchase + $purchaseData[$k]['quantity']);
            }
        }

        $salesData = $CI->Products->invoice_data($product_id);

        $totalSales = 0;
        $totaSalesAmt = 0;

        if (!empty($salesData)) {
            foreach ($salesData as $k => $v) {
                $salesData[$k]['final_date'] = $CI->occational->dateConvert($salesData[$k]['date']);
                $totalSales = ($totalSales + $salesData[$k]['quantity']);
                $totaSalesAmt = ($totaSalesAmt + $salesData[$k]['total_price']);
            }
        }

        $openQuantity = $details_info[0]['open_quantity'];
        // $stock = ($totalPurchase + $openQuantity) - $totalSales;
        $stock = ($totalPurchase - $totalSales);

        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('product_details'),
            'product_name' => $details_info[0]['product_name'],
            'product_model' => $details_info[0]['product_model'],
            'price' => $details_info[0]['price'],
            'purchaseTotalAmount' => number_format($totalPrcsAmnt, 2, '.', ','),
            'salesTotalAmount' => number_format($totaSalesAmt, 2, '.', ','),
            'total_purchase' => $totalPurchase,
            'total_sales' => $totalSales,
            'purchaseData' => $purchaseData,
            'salesData' => $salesData,
            'stock' => $stock,
            'product_statement' => 'dashboard/Cproduct/product_sales_supplier_rate/' . $product_id,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $productList = $CI->parser->parse('dashboard/product/product_details', $data, true);
        return $productList;
    }

    // Product details single
    public function product_details_single($product_id) {
        $CI = & get_instance();
        $CI->load->model('dashboard/Products');
        $CI->load->library('dashboard/occational');
        $CI->load->model('dashboard/Soft_settings');
        $details_info = $CI->Products->product_details_info($product_id);
        $purchaseData = $CI->Products->product_purchase_info($product_id);
        $products_list = $CI->Products->product_list();

        $totalPurchase = 0;
        $totalPrcsAmnt = 0;

        if (!empty($purchaseData)) {
            foreach ($purchaseData as $k => $v) {
                $purchaseData[$k]['final_date'] = $CI->occational->dateConvert($purchaseData[$k]['purchase_date']);
                $totalPrcsAmnt = ($totalPrcsAmnt + $purchaseData[$k]['total_amount']);
                $totalPurchase = ($totalPurchase + $purchaseData[$k]['quantity']);
            }
        }

        $salesData = $CI->Products->invoice_data($product_id);
        $totalSales = 0;
        $totaSalesAmt = 0;

        if (!empty($salesData)) {
            foreach ($salesData as $k => $v) {
                $salesData[$k]['final_date'] = $CI->occational->dateConvert($salesData[$k]['date']);
                $totalSales = ($totalSales + $salesData[$k]['quantity']);
                $totaSalesAmt = ($totaSalesAmt + $salesData[$k]['total_amount']);
            }
        }
        $openQuantity = $details_info[0]['open_quantity'];
        // $stock = ($totalPurchase + $openQuantity) - $totalSales;
        $stock = ($totalPurchase - $totalSales);
        $currency_details = $CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' => display('product_report'),
            'product_name' => $details_info[0]['product_name'],
            'product_model' => $details_info[0]['product_model'],
            'price' => $details_info[0]['price'],
            'purchaseTotalAmount' => number_format($totalPrcsAmnt, 2, '.', ','),
            'salesTotalAmount' => number_format($totaSalesAmt, 2, '.', ','),
            'total_purchase' => $totalPurchase,
            'total_sales' => $totalSales,
            'purchaseData' => $purchaseData,
            'salesData' => $salesData,
            'stock' => $stock,
            'product_list' => $products_list,
            'product_statement' => 'dashboard/Cproduct/product_sales_supplier_rate/' . $product_id,
            'currency' => $currency_details[0]['currency_icon'],
            'position' => $currency_details[0]['currency_position'],
        );
        $productList = $CI->parser->parse('dashboard/product/product_details_single', $data, true);
        return $productList;
    }

    public function languages() {
        $CI = & get_instance();
        $settings = $CI->db->select('language')->from('soft_setting')->where('setting_id', 1)->get()->row();
        if ($CI->db->table_exists($this->table)) {

            $fields = $CI->db->field_data($this->table);

            $i = 1;
            foreach ($fields as $field) {
                if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
            }
            if (!empty($result)) {
                $langusges = array_diff($result, array($settings->language => ucfirst($settings->language)));
                return $langusges;
            }
            return false;
        } else {
            return false;
        }
    }

    public function return_product_report($from_date=null,$to_date=null,$status=null){
		$CI =& get_instance();
		$CI->load->model('dashboard/Products');
		$CI->load->model('dashboard/Soft_settings');
		$CI->load->library('dashboard/occational');

        $CI->db->select('*');
        $CI->db->from('product_return pr');
        $ps = $CI->db->get()->result();

        // echo "<pre>";

        // // var_dump($ps);exit;

        // $r = [];

        // foreach ($ps as $p) {
        //     $pp = $CI->db->select('*')->from('product_information')->where('product_id', $p->product_id)->get()->row();

        //     var_dump($p->product_id);
        //     if ($pp) {
        //         $r[] = $pp;
        //     }
        // }

        // var_dump(count($r));

        // exit;
        

		$return_product_report =$CI->Products->return_product_report($from_date,$to_date,$status);
        // echo "<pre>";var_dump($return_product_report);exit;
		$currency_details = $CI->Soft_settings->retrieve_currency_info();
		$data=array(
			'title'    =>display('return_product_report'),
			'return_product_report'=>$return_product_report,
			'currency' =>$currency_details[0]['currency_icon'],
			'position' =>$currency_details[0]['currency_position'],
			'from_date'=>$from_date,
			'to_date'  =>$to_date,
			'status'  =>$status,
			);
		$singleproductdetails = $CI->parser->parse('refund/return_report',$data,true);
		return $singleproductdetails;
	}

}

?>