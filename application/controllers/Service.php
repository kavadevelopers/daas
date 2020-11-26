<?php
class Service extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function new()
	{
		$data['_title']		= "Service - New";
		$data['list']		= $this->db->get_where('z_service',['df' => '','approved' => '0'])->result_array();
		$this->load->theme('users/service/new',$data);	
	}

	public function rejected()
	{
		$data['_title']		= "Service - Rejected";
		$data['list']		= $this->db->get_where('z_service',['df' => '','approved' => '2'])->result_array();
		$this->load->theme('users/service/rejected',$data);	
	}

	public function approved()
	{
		$data['_title']		= "Service - Approved";
		$data['list']		= $this->db->get_where('z_service',['df' => '','approved' => '1'])->result_array();
		$this->load->theme('users/service/approved',$data);	
	}

	public function delete($id)
	{
		$this->db->where('id',$id)->update('z_service',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Service User Deleted');
		redirect(base_url('service/new'));
	}

	public function approve($id)
	{
		$this->db->where('id',$id)->update('z_service',['approved' => '1']);
		$this->session->set_flashdata('msg', 'Service User Approved');
		redirect(base_url('service/new'));	
	}

	public function reject($id)
	{
		$this->db->where('id',$id)->update('z_service',['approved' => '2']);
		$this->session->set_flashdata('msg', 'Service User Rejected');
		redirect(base_url('service/new'));	
	}

	public function rapprove($id)
	{
		$this->db->where('id',$id)->update('z_service',['approved' => '1']);
		$this->session->set_flashdata('msg', 'Service User Approved');
		redirect(base_url('service/rejected'));	
	}

	public function rdelete($id)
	{
		$this->db->where('id',$id)->update('z_service',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Service User Deleted');
		redirect(base_url('service/rejected'));
	}

	public function areject($id)
	{
		$this->db->where('id',$id)->update('z_service',['approved' => '2']);
		$this->session->set_flashdata('msg', 'Service User Rejected');
		redirect(base_url('service/approved'));	
	}

	public function adelete($id)
	{
		$this->db->where('id',$id)->update('z_service',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Service User Deleted');
		redirect(base_url('service/approved'));
	}


	public function block($id,$flag = false)
	{
		$fg = "";
		if ($flag) {
			$fg = "yes";
		}
		$this->db->where('id',$id)->update('z_service',['block' => $fg]);
		$this->session->set_flashdata('msg', 'Service User Status Changed');
		redirect(base_url('service/approved'));
	}
}