<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lbrand {
	//Add Brand
	private $table = "language";
	public function brand_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Brands');
		$languages = $this->languages();
		$data = array(
				'title' => display('add_brand'),
				'languages' => $languages
			);
		$customerForm = $CI->parser->parse('dashboard/brand/add_brand',$data,true);
		return $customerForm;
	}

	public function languages(){
    	$CI =& get_instance();
    	$settings = $CI->db->select('language')->from('soft_setting')->where('setting_id',1)->get()->row();
        if ($CI->db->table_exists($this->table)) {

            $fields = $CI->db->field_data($this->table);

            $i = 1;
            foreach ($fields as $field) {
                if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
            }

            if (!empty($result)) {
            	$langusges = array_diff($result, array($settings->language=>ucfirst($settings->language)));
            	return $langusges;
            }

            	return false;

        } else {
            return false;
        }
    }

	//Retrieve  Brand List	
	public function brand_list(){
		$CI =& get_instance();
		$CI->load->model('dashboard/Brands');
		$brand_list = $CI->Brands->brand_list(); 

		$i=0;
		if(!empty($brand_list)){	
			foreach($brand_list as $k=>$v){$i++;
			   $brand_list[$k]['sl']=$i;
			}
		}

		$data = array(
				'title' => display('manage_brand'),
				'brand_list' => $brand_list,
			);
		$customerList = $CI->parser->parse('dashboard/brand/brand',$data,true);
		return $customerList;
	}

	//Brand Edit Data
	public function brand_edit_data($brand_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Brands');
		$brand_details = $CI->Brands->retrieve_brand_editdata($brand_id);
		$languages = $this->languages();
		$data=array(
			'title' 	 => display('brand_edit'),
			'brand_id' 	 => $brand_details[0]['brand_id'],
			'brand_name' => $brand_details[0]['brand_name'],
			'brand_image'=> $brand_details[0]['brand_image'],
			'website' 	 => $brand_details[0]['website'],
			'status' 	 => $brand_details[0]['status'],
			'languages'  => $languages
			);
		$chapterList = $CI->parser->parse('dashboard/brand/edit_brand',$data,true);
		return $chapterList;
	}
}