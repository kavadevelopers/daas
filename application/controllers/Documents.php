<?php
class Documents extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Documents";
		$data['list']		= $this->db->get_where('documents_locker',['df' => ''])->result_array();
		$this->load->theme('documents/index',$data);		
	}

	public function save()
	{
		$done = 0;
		if($this->input->post('verified')){
			$done = 1;
		}
		$data = [
			'client'		=> $this->input->post('client'),
			'responsible'	=> $this->input->post('res_person'),
			'cupboard'		=> $this->input->post('cupboard'),
			'reck'			=> $this->input->post('reck'),
			'get_remarks'	=> $this->input->post('get_person'),
			'sent_remarks'	=> $this->input->post('sent_person'),
			'get_date'		=> dd($this->input->post('get_date')),
			'sent_date'		=> $this->input->post('sent_date')!= ""?dd($this->input->post('sent_date')):null,
			'doc_remarks'	=> $this->input->post('remarks'),
			'done'			=> $done,
			'created_at'	=> date('Y-m-d H:i:s')
		];

		$this->db->insert('documents_locker',$data);

		$this->session->set_flashdata('msg', 'Documents Added');
	    redirect(base_url('documents'));
	}

	public function update()
	{
		$done = 0;
		if($this->input->post('verified')){
			$done = 1;
		}
		$data = [
			'client'		=> $this->input->post('client'),
			'responsible'	=> $this->input->post('res_person'),
			'cupboard'		=> $this->input->post('cupboard'),
			'reck'			=> $this->input->post('reck'),
			'get_remarks'	=> $this->input->post('get_person'),
			'sent_remarks'	=> $this->input->post('sent_person'),
			'get_date'		=> dd($this->input->post('get_date')),
			'sent_date'		=> $this->input->post('sent_date')!= ""?dd($this->input->post('sent_date')):null,
			'doc_remarks'	=> $this->input->post('remarks'),
			'done'			=> $done
		];
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('documents_locker',$data);

		$client = $this->general_model->_get_client($this->input->post('client'));
		$firm = $client['firm'] != ""?'<br>'.$client['firm'] :'';
		$sent_date = $this->input->post('sent_date') != ""? $this->input->post('sent_date'):"";
		$done = "no";
		if($this->input->post('verified')){
			$done = "yes";
		}
		$data = [
			'client'		=> '#'.$client['c_id'].'<br><b>'.$client['fname'].' '.$client['mname'].' '.$client['lname'].'</b>'. $firm.'<br><small>'.$client['mobile'].'</small>',
			'responsible'		=> 	$this->input->post('res_person'),
			'cupboard'			=> 	$this->input->post('cupboard').'<br><b>Reck</b> - '.$this->input->post('reck'),
			'get_remarks'		=> 	'<p style="margin: 0;"><b>'.$this->input->post('get_date').'</b></p>'.nl2br($this->input->post('get_person')),
			'sent_remarks'		=> 	'<p style="margin: 0;"><b>'.$sent_date.'</b></p>'.nl2br($this->input->post('sent_remarks')),
			'doc_remarks'		=>  nl2br($this->input->post('remarks')),
			'done'		=>  $done,
		];

		echo json_encode($data);
	}

	public function delete()
	{
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('documents_locker',['df' => 'yes']);
	}
}