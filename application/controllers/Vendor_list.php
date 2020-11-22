<?php
class Vendor_list extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Vendor List";
		$data['list']		= $this->db->get_where('vendor_list')->result_array();
		$this->load->theme('vendor_list/index',$data);	
	}

	public function save()
	{
		$data = [
			'name'			=> strtoupper($this->input->post('name')),
			'category'		=> strtoupper($this->input->post('category')),
			'mobile'		=> strtoupper($this->input->post('mobile')),
			'address'		=> strtoupper($this->input->post('address')),
			'remarks'		=> strtoupper($this->input->post('remarks')),
			'created_by'	=> get_user()['id'],
			'created_at'	=> date('Y-m-d H:i:s')
		];
		$this->db->insert('vendor_list',$data);

		$this->session->set_flashdata('msg', 'Vendor Added');
	    redirect(base_url('vendor_list'));	
	}

	public function delete($id)
	{
		$this->db->where('id',$id)->delete('vendor_list');
		$this->session->set_flashdata('msg', 'Vendor Deleted');
	    redirect(base_url('vendor_list'));	
	}
}

?>