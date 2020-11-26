<?php
class Business_category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data['_title']		= "Business Categories";
		$data['list']	= $this->db->get_where('business_categories',['df' => ''])->result_array();
		$data['_e']		= "0";
		$this->load->theme('business_categories',$data);
	}


	public function save()
	{
		$data = [
			'name'	=> $this->input->post('name')
		];
		$this->db->insert('business_categories',$data);

		$this->session->set_flashdata('msg', 'Category Added');
		redirect(base_url('business_category'));
	}

	public function edit($id)
	{
		$data['_title']		= "Business Categories";
		$data['list']	= $this->db->get_where('business_categories',['df' => ''])->result_array();
		$data['single']	= $this->db->get_where('business_categories',['id' => $id])->row_array();
		$data['_e']		= "1";
		$this->load->theme('business_categories',$data);
	}

	public function update()
	{
		$data = [
			'name'	=> $this->input->post('name')
		];
		$this->db->where('id',$this->input->post('id'))->update('business_categories',$data);

		$this->session->set_flashdata('msg', 'Category Updated');
		redirect(base_url('business_category'));
	}

	public function delete($id)
	{
		$this->db->where('id',$id)->update('business_categories',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Category Deleted');
		redirect(base_url('business_category'));
	}
}