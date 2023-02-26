<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Whatsapp_info extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function whatsapp_infos(){
		$whatsapp_info_details = $this->db->select('*')->from('whatsapp_info_table')->get()->row_array();
		return $whatsapp_info_details;
	}
}