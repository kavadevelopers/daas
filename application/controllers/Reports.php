<?php
class Reports extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}


	public function ledger()
	{
		$data['_title']		= "Ledger";
		$data['client']		= "";
		$data['fdate']		= "";
		$data['tdate']		= "";
		$this->load->theme('reports/ledger',$data);
	}

	public function expense()
	{
		$data['_title']		= "Expense";
		$data['fdate']		= "";
		$data['tdate']		= "";
		$this->load->theme('reports/expense',$data);
	}

	public function petty_cash()
	{
		$data['_title']		= "Petty Cash Ledger";
		$data['user']		= "";
		$data['fdate']		= "";
		$data['tdate']		= "";
		$this->load->theme('reports/petty_cash',$data);
	}

	public function task()
	{
		$data['_title']		= "Task Reports";
		$data['for']		= "";
		$data['from']		= "";
		$data['fdate']		= "";
		$data['tdate']		= "";
		$this->load->theme('reports/task',$data);	
	}

	public function ledger_result()
	{
		$data['_title']		= "Ledger";
		$data['client']		= $this->input->post('client');
		$data['fdate']		= $this->input->post('fdate');
		$data['tdate']		= $this->input->post('tdate');
		$data['opening']    = $this->general_model->opening_balance($this->input->post('client'),dd($this->input->post('fdate')));
        $this->db->where('client', $this->input->post('client'));
		$this->db->group_start();
		    $this->db->where('type',invoice());
            $this->db->or_where('type',payment());
            $this->db->or_where('type',reimbursement());
            $this->db->or_where('type',referal());
		$this->db->group_end();
		if($this->input->post('fdate') != ""){
			$this->db->where('date >=',dd($this->input->post('fdate')));	
		}		

		if($this->input->post('tdate') != ""){
			$this->db->where('date <=',dd($this->input->post('tdate')));	
		}	
		$this->db->order_by('date','asc');
		$data['list']		= $this->db->get('transaction')->result_array();
		$this->load->theme('reports/ledger',$data);	
	}

	public function petty_cash_result()
	{
		$data['_title']		= "Petty Cash Ledger";
		$data['user']		= $this->input->post('user');
		$data['fdate']		= $this->input->post('fdate');
		$data['tdate']		= $this->input->post('tdate');
		$data['opening']    = $this->general_model->pettyCashOpeningBalance($this->input->post('user'),dd($this->input->post('fdate')));
		$this->db->where('user', $this->input->post('user'));
		if($this->input->post('fdate') != ""){
			$this->db->where('date >=',dd($this->input->post('fdate')));	
		}		
		if($this->input->post('tdate') != ""){
			$this->db->where('date <=',dd($this->input->post('tdate')));	
		}	
		$this->db->order_by('date','asc');
		$data['list']		= $this->db->get('transaction_petty_cash')->result_array();
		$this->load->theme('reports/petty_cash',$data);
	}

	public function task_result()
	{
		$data['_title']		= "Task Results";
		$data['for']		= $this->input->post('for');
		$data['from']		= $this->input->post('from');
		$data['fdate']		= $this->input->post('fdate');
		$data['tdate']		= $this->input->post('tdate');


		if($this->input->post('for') != ""){
			$this->db->where('to',$this->input->post('for'));
		}

		if($this->input->post('from') != ""){
			$this->db->where('from',$this->input->post('from'));
		}

		if($this->input->post('fdate') != ""){
			$this->db->where('date >=',dd($this->input->post('fdate')));	
		}		

		if($this->input->post('tdate') != ""){
			$this->db->where('date <=',dd($this->input->post('tdate')));	
		}		
		$this->db->order_by('id','desc');
		$data['task'] = $this->db->get('task')->result_array();
		$this->load->theme('reports/task',$data);
	}

	public function expense_result()
	{
		$data['_title']		= "Expense Results";
		$data['fdate']		= $this->input->post('fdate');
		$data['tdate']		= $this->input->post('tdate');
		if($this->input->post('fdate') != ""){
			$this->db->where('date >=',dd($this->input->post('fdate')));	
		}		
		if($this->input->post('tdate') != ""){
			$this->db->where('date <=',dd($this->input->post('tdate')));	
		}	
		$this->db->order_by('date','asc');
		$data['list']		= $this->db->get('expenses')->result_array();
		$this->load->theme('reports/expense',$data);
	}
}
?>