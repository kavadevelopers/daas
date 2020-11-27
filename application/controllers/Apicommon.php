<?php
class Apicommon extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function get_business_categories()
	{
		$query = $this->db->get_where('business_categories',['df' => '']);
		$list = $query->result_array();
		foreach ($list as $key => $value) {
			$list[$key]['image'] = getCategoryThumb($value['image']);
		}
		retJson(['_return' => true,'count' => $query->num_rows(),'list' => $list]);
	}

}
