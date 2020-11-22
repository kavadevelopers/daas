<?php
class Cupboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}


	public function main()
	{
		$data['_title']		= "Document Cupboards";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('cupboards',['df' => ''])->result_array();
		$this->load->theme('master/cupboard/main',$data);	
	}

	public function sub()
	{
		$data['_title']		= "Document Cupboard Recks";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('cupboards_racks',['df' => ''])->result_array();
		$this->load->theme('master/cupboard/sub',$data);		
	}

	public function save_cupboard()
	{
		$data = [
			'name'			=> $this->input->post('name'),
			'created_at'	=> date('Y-m-d H:i:s')
		];
		$this->db->insert('cupboards',$data);
		$this->session->set_flashdata('msg', 'Cupboard Added');
        redirect(base_url('cupboard/main'));
	}

	public function save_reck()
	{
		$data = [
			'name'			=> $this->input->post('name'),
			'created_at'	=> date('Y-m-d H:i:s')
		];
		$this->db->insert('cupboards_racks',$data);
		$this->session->set_flashdata('msg', 'Cupboard Reck Added');
        redirect(base_url('cupboard/sub'));
	}

	public function edit_cupboard($id)
	{
		$data['_title']		= "Document Cupboards";
		$data['_e']         = 1;
		$data['list']		= $this->db->order_by('id','desc')->get_where('cupboards',['df' => ''])->result_array();
		$data['ind']		= $this->db->order_by('id','desc')->get_where('cupboards',['id' => $id])->row_array();
		$this->load->theme('master/cupboard/main',$data);	
	}

	public function edit_reck($id)
	{
		$data['_title']		= "Document Cupboards Recks";
		$data['_e']         = 1;
		$data['list']		= $this->db->order_by('id','desc')->get_where('cupboards_racks',['df' => ''])->result_array();
		$data['ind']		= $this->db->order_by('id','desc')->get_where('cupboards_racks',['id' => $id])->row_array();
		$this->load->theme('master/cupboard/sub',$data);	
	}

	public function update_cupboard()
	{
		$data = [
			'name'			=> $this->input->post('name')
		];
		$this->db->where('id',$this->input->post('id'))->update('cupboards',$data);
		$this->session->set_flashdata('msg', 'Cupboard Saved');
        redirect(base_url('cupboard/main'));
	}

	public function update_reck()
	{
		$data = [
			'name'			=> $this->input->post('name')
		];
		$this->db->where('id',$this->input->post('id'))->update('cupboards_racks',$data);
		$this->session->set_flashdata('msg', 'Reck Saved');
        redirect(base_url('cupboard/sub'));
	}

	public function delete_cupboard($id)
	{
		$data = [
			'df'			=> "yes"
		];
		$this->db->where('id',$id)->update('cupboards',$data);
		$this->session->set_flashdata('msg', 'Cupboard Deleted');
        redirect(base_url('cupboard/main'));	
	}

	public function delete_reck($id)
	{
		$data = [
			'df'			=> "yes"
		];
		$this->db->where('id',$id)->update('cupboards_racks',$data);
		$this->session->set_flashdata('msg', 'Reck Deleted');
        redirect(base_url('cupboard/sub'));	
	}
}
?>