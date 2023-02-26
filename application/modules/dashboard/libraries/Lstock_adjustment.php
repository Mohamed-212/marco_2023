<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lstock_adjustment {
	//stock_adjustment
	public function stock_adjustment_form()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Stores');
		$data = array(
				'title' =>display('stock_adjustment'),
				'stores'=>$CI->Stores->store_list()
			);
		$content = $CI->parser->parse('dashboard/stock_adjustment/stock_adjustment_form',$data,true);
		return $content;
	}
	public function manage_stock_adjustment($page, $per_page, $links = false)
    {
        $CI =& get_instance();
        $CI->load->model('dashboard/Stock_adjustment_model');
        $CI->load->model('dashboard/Soft_settings');
        $CI->load->library('dashboard/occational');

        $stock_adjustment_list = $CI->Stock_adjustment_model->stock_adjustment_list($page, $per_page);
        if(!empty($stock_adjustment_list)){
            foreach($stock_adjustment_list as $k=>$v){
                $stock_adjustment_list[$k]['final_date'] = $CI->occational->dateConvert($stock_adjustment_list[$k]['date']);
            }
            $i=0;
            foreach($stock_adjustment_list as $k=>$v){
                $i++;
                $stock_adjustment_list[$k]['sl']=$i;
            }
        }
        $currency_details=$CI->Soft_settings->retrieve_currency_info();
        $data = array(
            'title'                => display('manage_stock_adjustment'),
            'stock_adjustment_list'=> $stock_adjustment_list,
            'links'                => $links,
            'currency'             => $currency_details[0]['currency_icon'],
            'position'             => $currency_details[0]['currency_position'],
        );
        $adjustments = $CI->parser->parse('dashboard/stock_adjustment/manage_stock_adjustment',$data,true);
        return $adjustments;
    }
    public function stock_adjustment_details($adjustment_id){
    	$CI =& get_instance();
		$CI->load->model('dashboard/Stock_adjustment_model');
		$data = array(
				'title' =>display('stock_adjustment_details'),
				'adjustment_details'=>$CI->Stock_adjustment_model->adjustment_details($adjustment_id)
			);
		$content = $CI->parser->parse('dashboard/stock_adjustment/stock_adjustment_details',$data,true);
		return $content;
    }
    public function stock_adjustment_html_data($adjustment_id){
        $CI =& get_instance();
        $CI->load->model('dashboard/Stock_adjustment_model');

        $adj = $CI->db->select('a.*, s.store_name')->from('stock_adjustment_table a')
            ->join('store_set s', 's.store_id = a.store_id', 'left')
            ->where('a.adjustment_id', $adjustment_id)
            ->get()
            ->result();

        $data = array(
                'title' =>display('stock_adjustment_details'),
                'adj' => $adj,
                'adjustment_details'=>$CI->Stock_adjustment_model->adjustment_details($adjustment_id)
            );
        $content = $CI->parser->parse('dashboard/stock_adjustment/stock_adjustment_html_data',$data,true);
        return $content;
    }
}
?>