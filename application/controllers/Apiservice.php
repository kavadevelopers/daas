<?php
class Apiservice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function faq()
	{
		$list = $this->db->get('faq_service');
		retJson(['_return' => true,'count' => $list->num_rows(),'list' => $list->result_array()]);
	}

	public function about()
	{
		$content = $this->db->get_where('pages',['id' => '10'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function privacy()
	{
		$content = $this->db->get_where('pages',['id' => '9'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function terms()
	{
		$content = $this->db->get_where('pages',['id' => '8'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function logout()
	{
		if($this->input->post('userid')){
			$this->db->where('id',$this->input->post('userid'))->update('z_service',['token' => ""]);
			retJson(['_return' => true,'msg' => 'Logout Successful']);
		}else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function verify_login_otp()
	{
		if($this->input->post('userid') && $this->input->post('otp') && $this->input->post('token')){
			$user = $this->db->get_where('z_service',['id' => $this->input->post('userid')])->row_array();
			if($user && $user['loginotp'] == $this->input->post('otp')){
				$this->db->where('id',$user['id'])->update('z_service',['token' => $this->input->post('token')]);
				retJson(['_return' => true,'msg' => 'Login Successful.','data' => $user]);
			}else{
				retJson(['_return' => false,'msg' => 'Please Enter Valid OTP.']);
			}
		}
		else{
			retJson(['_return' => false,'msg' => '`userid`,`token` and `otp` are Required']);
		}
	}

	public function resend_login_otp()
	{
		if($this->input->post('userid')){
			$otp = mt_rand(100000, 999999);
			$this->db->where('id',$this->input->post('userid'))->update('z_service',['loginotp' => $otp]);
			retJson(['_return' => true,'msg' => 'OTP Sent','otp' => $otp,'userid' => $this->input->post('userid')]);
		}
		else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function login()
	{
		if($this->input->post('mobile')){
			$user = $this->db->get_where('z_service',['mobile' => $this->input->post('mobile'),'df' => '']);
			if($user->num_rows() > 0){
				$user = $user->row_array();
				if($user['verified'] == 1){
					if($user['block'] == ""){
						$otp = mt_rand(100000, 999999);
						$this->db->where('id',$user['id'])->update('z_service',['loginotp' => $otp]);
						retJson(['_return' => true,'msg' => 'Login Successful. Varify OTP.','otp' => $otp,'userid' => $user['id']]);
					}else{
						retJson(['_return' => false,'msg' => 'Account is Blocked.']);	
					}	
				}else{
					retJson(['_return' => false,'msg' => 'Mobile No. Not Varified.']);	
				}
			}else{
				retJson(['_return' => false,'msg' => 'Mobile No. Not Exists.']);	
			}
		}else{
			retJson(['_return' => false,'msg' => '`mobile` is Required']);
		}
	}

	public function resend_register_otp()
	{
		if($this->input->post('userid')){
			$otp = mt_rand(100000, 999999);
			$this->db->where('id',$this->input->post('userid'))->update('z_service',['otp' => $otp]);
			retJson(['_return' => true,'msg' => 'OTP Sent','otp' => $otp,'userid' => $this->input->post('userid')]);
		}
		else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function verify_otp()
	{
		if($this->input->post('userid') && $this->input->post('otp')){
			$user = $this->db->get_where('z_service',['id' => $this->input->post('userid')])->row_array();
			if($user && $user['otp'] == $this->input->post('otp')){
				$this->db->where('id',$this->input->post('userid'))->update('z_service',['verified' => 1]);
				retJson(['_return' => true,'msg' => 'Registration Successful.']);
			}else{
				retJson(['_return' => false,'msg' => 'Please Enter Valid OTP.']);
			}
		}
		else{
			retJson(['_return' => false,'msg' => '`userid` and `otp` are Required']);
		}
	}

	public function getintouch()
	{
		if($this->input->post('fname') && $this->input->post('lname') && $this->input->post('mobile') && $this->input->post('address') && $this->input->post('business') && $this->input->post('category') && $this->input->post('gender')){
			$old = $this->db->get_where('z_service',['mobile' => $this->input->post('mobile'),'df' => ''])->num_rows();
			if($old == 0){
				$otp = mt_rand(100000, 999999);
				$data = [
					'fname'			=> $this->input->post('fname'),
					'lname'			=> $this->input->post('lname'),
					'mobile'		=> $this->input->post('mobile'),
					'address'		=> $this->input->post('address'),
					'business'		=> $this->input->post('business'),
					'category'		=> $this->input->post('category'),
					'gender'		=> $this->input->post('gender'),
					'deviceid'		=> '',
					'token'			=> '',
					'df'			=> '',
					'block'			=> '',
					'approved'		=> '1',
					'registered_at'	=> date('Y-m-d H:i:s'),
					'otp'			=> $otp
				];
				$this->db->insert('z_service',$data);
				$user = $this->db->insert_id();
				retJson(['_return' => true,'msg' => 'Registration Successful','otp' => $otp,'userid' => $user]);
			}else{
				retJson(['_return' => false,'msg' => 'Mobile No. Already Exists.']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`fname`,`lname`,`address`,`business`,`category`,`gender` and `mobile` are Required']);
		}
	}

	public function index()
	{
		retJson(['No Script Found Here']);
	}
}