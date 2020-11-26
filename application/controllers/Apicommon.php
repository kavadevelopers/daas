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
		retJson(['_return' => true,'count' => $query->num_rows(),'list' => $query->result_array()]);
	}

}
