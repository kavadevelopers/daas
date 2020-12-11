<?php
class Setting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Settings";
		$this->load->theme('setting/index',$data);
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('company', 'Company Name','trim|required');
		$this->form_validation->set_rules('fserverkey', 'Firebase Server Key','trim|required');
		$this->form_validation->set_rules('razorpay_key', 'Razorpay Key','trim|required');
		$this->form_validation->set_rules('twofecturekey', '2Factor API Key','trim|required');
		$this->form_validation->set_rules('support_email', 'Support Email','trim|required');
		$this->form_validation->set_rules('support_mobile', 'Support Mobile','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Settings';
			$this->load->theme('setting/index',$data);
		}
		else
		{ 
			$data = [
				'name'				=> $this->input->post('company'),
				'fserverkey'		=> $this->input->post('fserverkey'),
				'razorpay_key'		=> $this->input->post('razorpay_key'),
				'twofecturekey'		=> $this->input->post('twofecturekey'),
				'support_email'		=> $this->input->post('support_email'),
				'support_mobile'	=> $this->input->post('support_mobile'),
			];

			$this->db->where('id','1');
			$this->db->update('setting',$data);

			$this->session->set_flashdata('msg', 'Settings Saved');
	        redirect(base_url('setting'));
		}
	}
}
?>