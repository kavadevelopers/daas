<?php
class Maps extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Maps";
		$this->load->theme('maps/index',$data);
	}
}