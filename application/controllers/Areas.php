<?php
class Areas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Areas";
		$data['list']		= $this->db->order_by('id','desc')->get('areas')->result_array();
		$this->load->theme('areas/index',$data);
	}

	public function add()
	{
		$data['_title']		= "Add Area";
		$this->load->theme('areas/add',$data);
	}
}