<?php
class Expenses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Expenses";
		$data['_e']         = 0;
		$data['list']		= $this->db->limit(300)->order_by('id','desc')->get_where('expenses')->result_array();
		$this->load->theme('expenses/index',$data);		
	}

	public function save()
	{
		$data = [
			'date'			=> dd($this->input->post('date')),
			'perticulars'	=> $this->input->post('perticulars'),
			'amount'		=> $this->input->post('amount')
		];

		$this->db->insert('expenses',$data);

		$this->session->set_flashdata('msg', 'Expenses Added');
	    redirect(base_url('expenses'));
	}

	public function edit($id = false)
	{
		$data['_title']		= "Expenses";
		$data['_e']         = 1;
		$data['single']		= $this->db->get_where('expenses',['id' => $id])->row_array();
		$data['list']		= $this->db->limit(300)->order_by('id','desc')->get_where('expenses')->result_array();
		$this->load->theme('expenses/index',$data);	
	}

	public function update()
	{
		$data = [
			'date'			=> dd($this->input->post('date')),
			'perticulars'	=> $this->input->post('perticulars'),
			'amount'		=> $this->input->post('amount')
		];

		$this->db->where('id',$this->input->post('id'))->update('expenses',$data);

		$this->session->set_flashdata('msg', 'Expenses Updated');
	    redirect(base_url('expenses'));
	}

	public function delete($id = false)
	{
		$this->db->where('id',$id)->delete('expenses');
		$this->session->set_flashdata('msg', 'Expenses Delete');
	    redirect(base_url('expenses'));
	}
}
?>