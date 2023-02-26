<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lexpriy_report
 {
	//Retrive product list
    public function product_list($filter,$links,$per_page,$page)
    {
        $CI =& get_instance();
        $CI->load->model('dashboard/expriy_report_model');
        $CI->load->model('dashboard/Soft_settings');
        $products_expiry_list = $CI->expriy_report_model->product_list($filter,$per_page,$page);
        $i=$page;
        $i=5;
        if(!empty($products_list)){
            foreach($products_list as $k=>$v){
                $i++;
                $products_list[$k]['sl']=$i;
            }
        }
        $currency_details=$CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title' 	          =>display('expriy_report'),
            'products_expiry_list'=>$products_expiry_list,
            'links' 	          =>$links,
            'currency' 	          =>$currency_details[0]['currency_icon'],
            'position' 	          =>$currency_details[0]['currency_position'],
        );
        $productList = $CI->parser->parse('dashboard/report/expriy_report',$data,true);
        return $productList;
    }
}
?>