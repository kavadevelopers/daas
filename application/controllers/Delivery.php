<?php
class Delivery extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function new()
	{
		$data['_title']		= "Delivery - New";
		$data['list']		= $this->db->get_where('z_delivery',['df' => '','approved' => '0'])->result_array();
		$this->load->theme('users/delivery/new',$data);	
	}

	public function rejected()
	{
		$data['_title']		= "Delivery - Rejected";
		$data['list']		= $this->db->get_where('z_delivery',['df' => '','approved' => '2'])->result_array();
		$this->load->theme('users/delivery/rejected',$data);	
	}

	public function approved()
	{
		$data['_title']		= "Delivery - Approved";
		$data['list']		= $this->db->get_where('z_delivery',['df' => '','approved' => '1'])->result_array();
		$this->load->theme('users/delivery/approved',$data);	
	}

	public function delete($id)
	{
		$this->db->where('id',$id)->update('z_delivery',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Delivery User Deleted');
		redirect(base_url('delivery/new'));
	}

	public function approve($id)
	{
		$this->db->where('id',$id)->update('z_delivery',['approved' => '1']);
		$this->session->set_flashdata('msg', 'Delivery User Approved');
		redirect(base_url('delivery/new'));	
	}

	public function reject($id)
	{
		$this->db->where('id',$id)->update('z_delivery',['approved' => '2']);
		$this->session->set_flashdata('msg', 'Delivery User Rejected');
		redirect(base_url('delivery/new'));	
	}

	public function rapprove($id)
	{
		$this->db->where('id',$id)->update('z_delivery',['approved' => '1']);
		$this->session->set_flashdata('msg', 'Delivery User Approved');
		redirect(base_url('delivery/rejected'));	
	}

	public function rdelete($id)
	{
		$this->db->where('id',$id)->update('z_delivery',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Delivery User Deleted');
		redirect(base_url('delivery/rejected'));
	}

	public function areject($id)
	{
		$this->db->where('id',$id)->update('z_delivery',['approved' => '2']);
		$this->session->set_flashdata('msg', 'Delivery User Rejected');
		redirect(base_url('delivery/approved'));	
	}

	public function adelete($id)
	{
		$this->db->where('id',$id)->update('z_delivery',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Delivery User Deleted');
		redirect(base_url('delivery/approved'));
	}


	public function block($id,$flag = false)
	{
		$fg = "";
		if ($flag) {
			$fg = "yes";
		}
		$this->db->where('id',$id)->update('z_delivery',['block' => $fg]);
		$this->session->set_flashdata('msg', 'Delivery User Status Changed');
		redirect(base_url('delivery/approved'));
	}
}