<?php
class Reimburs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}


	public function index()
	{
		$data['_title']		= "Reimbursement";
		$data['invoices']	= $this->db->order_by('id','desc')->get_where('reimbursement',['df' => ''])->result_array();
		$this->load->theme('reimburs/index',$data);	
	}

	public function save()
	{
		$client = $this->general_model->_get_client($this->input->post('client'));
		$company = $this->general_model->_get_company($client['company']);
		$r_count = $this->db->get_where('reimbursement',['company' => $client['company']])->num_rows();
		$data = [
			'date'				=> dd($this->input->post('date')),
			'invoice'			=> $company['reimbur_prefix'].'_'.($r_count + 1),
			'client'			=> $this->input->post('client'),
			'company'			=> $client['company'],
			'branch'			=> $client['branch'],	
			'particular'		=> strtoupper($this->input->post('remarks')),
			'amount'			=> $this->input->post('amount'),
			'created_by'		=> get_user()['id'],
			'created_at'		=> date('Y-m-d H:i:s')
		];

		$this->db->insert('reimbursement',$data);
		$inv_id = $this->db->insert_id();

		$data = [
			'type'		=> reimbursement(),
			'client'	=> $this->input->post('client'),
			'date'		=> dd($this->input->post('date')),
			'main'		=> $inv_id,
			'debit'		=> $this->input->post('amount'),
		];
		$this->db->insert('transaction',$data);

		$this->session->set_flashdata('msg', 'Reimbursement Added');
	    redirect(base_url('reimburs'));
	}

	public function update()
	{
		$client = $this->general_model->_get_client($this->input->post('client'));
		$data = [
			'date'				=> dd($this->input->post('date')),
			'client'			=> $this->input->post('client'),
			'company'			=> $client['company'],
			'branch'			=> $client['branch'],	
			'particular'		=> strtoupper($this->input->post('remarks')),
			'amount'			=> $this->input->post('amount')
		];

		$this->db->where('id',$this->input->post('id'))->update('reimbursement',$data);
		$inv_id = $this->input->post('id');

		$data = [
			'type'		=> reimbursement(),
			'client'	=> $this->input->post('client'),
			'date'		=> dd($this->input->post('date')),
			'main'		=> $inv_id,
			'debit'		=> $this->input->post('amount'),
		];
		$this->db->where('type',reimbursement())->where('main',$inv_id)->update('transaction',$data);
		$this->session->set_flashdata('msg', 'Reimbursement Updated');
	    redirect(base_url('reimburs'));
	}

	public function delete($id = false)
	{
		if($id){
			$this->db->where('id',$id)->update('reimbursement',['df' => 'yes']);
			$this->db->where('main',$id)->where('type',reimbursement())->delete('transaction');
			$this->session->set_flashdata('msg', 'Reimbursement Deleted');
	    	redirect(base_url('reimburs'));
		}else{
			redirect(base_url('reimburs'));
		}
	}
}
?>