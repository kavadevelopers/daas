<?php
class Apicommon extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function get_business_categories()
	{
		$where = ['df' => ''];
		if($this->input->post('type')){
			$where = ['df' => '','type' => $this->input->post('type')];
		}
		$query = $this->db->get_where('business_categories',$where);
		$list = $query->result_array();
		foreach ($list as $key => $value) {
			$list[$key]['image'] = getCategoryThumb($value['image']);
		}
		retJson(['_return' => true,'count' => $query->num_rows(),'list' => $list]);
	}

}
