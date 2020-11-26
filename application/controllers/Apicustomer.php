<?php
class Apicustomer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function edit_profile()
	{
		if($this->input->post('userid') && $this->input->post('fname') && $this->input->post('lname') && $this->input->post('gender')){
			$user = $this->db->get_where('z_customer',['id' => $this->input->post('userid')])->row_array();
			if($user){
				$data = [
					'fname'		=> $this->input->post('fname'),
					'lname'		=> $this->input->post('lname'),
					'gender'	=> $this->input->post('gender')
				];
				$this->db->where('id',$this->input->post('userid'))->update('z_customer',$data);

				$config['upload_path'] = './uploads/user/';
			    $config['allowed_types']	= '*';
			    $config['max_size']      = '0';
			    $config['overwrite']     = FALSE;
			    $this->load->library('upload', $config);
			    if (isset ( $_FILES ['image'] ) && $_FILES ['image']['error'] == 0) {
					$file_name = microtime(true).".".pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$config['file_name'] = $file_name;
			    	$this->upload->initialize($config);
			    	if($this->upload->do_upload('image')){
			    		$data = [
							'image'		=> $file_name
						];
						$this->db->where('id',$this->input->post('userid'))->update('z_customer',$data);

						if($user['image'] != 'male.png' && file_exists(FCPATH.'uploads/user/'.$user['image'])){
	   		            	unlink(FCPATH.'/uploads/user/'.$user['image']);   
	 		        	}
			    	}
				}

				$user = $this->db->get_where('z_customer',['id' => $this->input->post('userid')])->row_array();
				$user['image'] = base_url('uploads/user/').$user['image'];
				retJson(['_return' => true,'msg' => 'Profile Updated.','data' => $user]);
			}else{
				retJson(['_return' => false,'msg' => 'User Not Found']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`userid`,`fname`,`lname` and `gender` are Required']);
		}	
	}

	public function change_password()
	{
		if($this->input->post('userid') && $this->input->post('old_password') && $this->input->post('new_password')){
			$user = $this->db->get_where('z_customer',['id' => $this->input->post('userid')])->row_array();
			if($user && $user['password'] == md5($this->input->post('old_password'))){
				$this->db->where('id',$this->input->post('userid'))->update('z_customer',['password' => md5($this->input->post('new_password'))]);
				retJson(['_return' => true,'msg' => 'Password Changed.']);
			}else{
				retJson(['_return' => false,'msg' => 'Old Password Not Match.']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`userid`,`old_password` and `new_password` are Required']);
		}
	}

	public function reset_password()
	{
		if($this->input->post('userid') && $this->input->post('otp') && $this->input->post('password')){
			$user = $this->db->get_where('z_customer',['id' => $this->input->post('userid')])->row_array();
			if($user && $user['otp'] == $this->input->post('otp')){
				$this->db->where('id',$this->input->post('userid'))->update('z_customer',['password' => md5($this->input->post('password'))]);
				retJson(['_return' => true,'msg' => 'Password Changed.']);
			}else{
				retJson(['_return' => false,'msg' => 'Please Enter Valid OTP.']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`userid`,`otp` and `password` are Required']);
		}
	}

	public function forget_password()
	{
		if($this->input->post('mobile')){
			$user = $this->db->get_where('z_customer',['mobile' => $this->input->post('mobile'),'df' => '']);
			if($user->num_rows() > 0){
				$oldRow = $user->row_array();
				if($oldRow['verified'] == 'Verified'){
					$otp = mt_rand(100000, 999999);
					$this->db->where('id',$oldRow['id'])->update('z_customer',['otp' => $otp]);
					retJson(['_return' => true,'msg' => 'OTP Sent','otp' => $otp,'userid' => $oldRow['id']]);
				}else{
					retJson(['_return' => false,'msg' => 'Mobile No. Not Verified.']);
				}
			}else{
				retJson(['_return' => false,'msg' => 'Mobile No. Not Registered.']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`mobile` is Required']);
		}	
	}

	public function faq()
	{
		$list = $this->db->get('faq_customer');
		retJson(['_return' => true,'count' => $list->num_rows(),'list' => $list->result_array()]);
	}

	public function how()
	{
		$content = $this->db->get_where('pages',['id' => '4'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function about()
	{
		$content = $this->db->get_where('pages',['id' => '3'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function privacy()
	{
		$content = $this->db->get_where('pages',['id' => '2'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function terms()
	{
		$content = $this->db->get_where('pages',['id' => '1'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function logout()
	{
		if($this->input->post('userid')){
			$this->db->where('id',$this->input->post('userid'))->update('z_customer',['token' => ""]);
			retJson(['_return' => true,'msg' => 'Logout Successful']);
		}else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function login()
	{
		if($this->input->post('mobile') && $this->input->post('password') && $this->input->post('token')){
			$user = $this->db->get_where('z_customer',['mobile' => $this->input->post('mobile'),'df' => '']);
			if($user->num_rows() > 0){
				$user = $user->row_array();
				if($user['password'] === md5($this->input->post('password'))){
					if($user['verified'] == "Verified"){
						if($user['block'] == ""){
							$this->db->where('id',$user['id'])->update('z_customer',['token' => $this->input->post('token')]);
							$user['image'] = base_url('uploads/user/').$user['image'];
							retJson(['_return' => true,'msg' => 'Login Successful','data' => $user]);
						}else{
							retJson(['_return' => false,'msg' => 'Account is Blocked.']);	
						}	
					}else{
						retJson(['_return' => false,'msg' => 'Mobile No. Not Varified.']);	
					}
				}else{
					retJson(['_return' => false,'msg' => 'Mobile No. and Password Not Match.']);	
				}
			}else{
				retJson(['_return' => false,'msg' => 'Mobile No. Not Exists.']);	
			}
		}else{
			retJson(['_return' => false,'msg' => '`mobile`,`password` and `token` are Required']);
		}
	}

	public function resend_register_otp()
	{
		if($this->input->post('userid')){
			$otp = mt_rand(100000, 999999);
			$this->db->where('id',$this->input->post('userid'))->update('z_customer',['otp' => $otp]);
			retJson(['_return' => true,'msg' => 'OTP Sent','otp' => $otp,'userid' => $this->input->post('userid')]);
		}
		else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function verify_otp()
	{
		if($this->input->post('userid') && $this->input->post('otp')){
			$user = $this->db->get_where('z_customer',['id' => $this->input->post('userid')])->row_array();
			if($user && $user['otp'] == $this->input->post('otp')){
				$this->db->where('id',$this->input->post('userid'))->update('z_customer',['verified' => 'Verified']);
				retJson(['_return' => true,'msg' => 'Registration Successful.']);
			}else{
				retJson(['_return' => false,'msg' => 'Please Enter Valid OTP.']);
			}
		}
		else{
			retJson(['_return' => false,'msg' => '`userid` and `otp` are Required']);
		}
	}

	public function register()
	{
		if($this->input->post('fname') && $this->input->post('lname') && $this->input->post('mobile') && $this->input->post('password') && $this->input->post('gender')){
			$old = $this->db->get_where('z_customer',['mobile' => $this->input->post('mobile'),'df' => '']);
			if($old->num_rows() == 0){
				$otp = mt_rand(100000, 999999);
				$data = [
					'fname'			=> $this->input->post('fname'),
					'lname'			=> $this->input->post('lname'),
					'mobile'		=> $this->input->post('mobile'),
					'password'		=> md5($this->input->post('password')),
					'gender'		=> $this->input->post('gender'),
					'deviceid'		=> '',
					'token'			=> '',
					'df'			=> '',
					'block'			=> '',
					'registered_at'	=> date('Y-m-d H:i:s'),
					'otp'			=> $otp
				];
				$this->db->insert('z_customer',$data);
				$user = $this->db->insert_id();
				retJson(['_return' => true,'msg' => 'Registration Successful. Please Verify OTP.','otp' => $otp,'userid' => $user]);
			}else{
				$oldRow = $old->row_array();
				if($oldRow['verified'] == 'Not Verified'){
					$otp = mt_rand(100000, 999999);
					$data = [
						'fname'			=> $this->input->post('fname'),
						'lname'			=> $this->input->post('lname'),
						'mobile'		=> $this->input->post('mobile'),
						'password'		=> md5($this->input->post('password')),
						'gender'		=> $this->input->post('gender'),
						'deviceid'		=> '',
						'token'			=> '',
						'df'			=> '',
						'block'			=> '',
						'registered_at'	=> date('Y-m-d H:i:s'),
						'otp'			=> $otp
					];
					$this->db->where('id',$oldRow['id'])->update('z_customer',$data);
					retJson(['_return' => true,'msg' => 'Registration Successful','otp' => $otp,'userid' => $oldRow['id']]);
				}else{
					retJson(['_return' => false,'msg' => 'Mobile No. Already Exists.']);
				}
			}
		}else{
			retJson(['_return' => false,'msg' => '`fname`,`lname`,`mobile`,`password` and `gender` are Required']);
		}
	}

	public function index()
	{
		retJson(['No Script Found Here']);
	}
}

?>