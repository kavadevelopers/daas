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
		$this->load->theme('areas/index',$data);
	}
}