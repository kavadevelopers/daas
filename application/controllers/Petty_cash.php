<?php
class Petty_cash extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Petty Cash";
		$data['list']		= $this->general_model->getPettyCash();
		$this->load->theme('petty_cash/index',$data);	
	}


	public function save()
	{
		if(get_user()['user_type'] == "0"){
			$owner = $this->input->post('user');
			if($this->input->post('type') == "credit"){
				$credit = $this->input->post('amount');
				$debit = 0;
			}else{
				$credit = 0;
				$debit = $this->input->post('amount');
			}
		}else{
			$owner 	= get_user()['id'];
			$credit = 0;
			$debit = $this->input->post('amount');
		}


		$data = [
			'user'		=> $owner,
			'remarks'	=> $this->input->post('remarks'),
			'debit'		=> $debit,
			'credit'	=> $credit,
			'date'		=> dd($this->input->post('date'))
		];

		$this->db->insert('transaction_petty_cash',$data);
		$this->session->set_flashdata('msg', 'Petty Cash Saved');
	    redirect(base_url('petty_cash'));
	}

	public function delete($id)
	{
		$this->db->where('id',$id)->delete('transaction_petty_cash');
		$this->session->set_flashdata('msg', 'Petty Cash Deleted');
	    redirect(base_url('petty_cash'));
	}
}