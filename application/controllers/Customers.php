<?php
class Customers extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}


	public function index()
	{
		$data['_title']		= "Customers";
		$data['list']		= $this->db->get_where('z_customer',['df' => ''])->result_array();
		$this->load->theme('users/customers',$data);	
	}

	public function delete($id)
	{
		$this->db->where('id',$id)->update('z_customer',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Customer Deleted');
		redirect(base_url('customers'));
	}

	public function block($id,$flag = false)
	{
		$fg = "";
		if ($flag) {
			$fg = "yes";
		}
		$this->db->where('id',$id)->update('z_customer',['block' => $fg]);
		$this->session->set_flashdata('msg', 'Customer Status Changed');
		redirect(base_url('customers'));
	}
}