<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lcategory {
	private $table = "language";
	//Retrieve  category List	
	public function category_list()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Categories');
		$category_list = $CI->Categories->category_list_all(); 
		$total=0;
		$i = 0;
		if(!empty($category_list)){	
			foreach($category_list as $k=>$v){
				$i++;
			    $category_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => display('manage_category'),
				'category_list' => $category_list,
			);
		$categoryList = $CI->parser->parse('dashboard/category/category',$data,true);
		return $categoryList;
	}
	//Category Add
	public function category_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Categories');
		$parent_category = $CI->Categories->parent_category();
		$languages = $this->languages();
		$data = array(
				'title' => display('add_category'),
				'category_list' => $parent_category,
				'languages' => $languages
			);
		$content = $CI->parser->parse('dashboard/category/add_category_form',$data,true);
		return $content;
	}

	//Category Edit Data
	public function category_edit_data($category_id)
	{
		$CI =& get_instance();
		$CI->load->model('dashboard/Categories');
		$category_detail = $CI->Categories->retrieve_category_editdata($category_id);
		$parent_category_list = $CI->Categories->parent_category_list($category_id);
		$languages = $this->languages();

		$data=array(
			'title'			     => display('category_edit'),
			'category_id' 	     => $category_detail[0]['category_id'],
			'category_name'      => $category_detail[0]['category_name'],
			'menu_pos' 		     => $category_detail[0]['menu_pos'],
			'status' 		     => $category_detail[0]['status'],
			'top_menu' 		     => $category_detail[0]['top_menu'],
			'cat_image' 	     => $category_detail[0]['cat_image'],
			'cat_favicon' 	     => $category_detail[0]['cat_favicon'],
			'parent_category_id' => $category_detail[0]['parent_category_id'],
			'category_list'	     => $parent_category_list,
			'languages'          => $languages
			);
		$categoryEdit = $CI->parser->parse('dashboard/category/edit_category_form',$data,true);
		return $categoryEdit;
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
}
?>