<?php
class Apidelivery extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function item_dropped_at_service_provider()
	{
		if($this->input->post('order_id')){	
			$this->db->where('id',$this->input->post('order_id'))->update('corder',
				['status_desc' => 'Item Drop At Store','notes' => 'Item Dropped At Service Provider']
			);
			retJson(['_return' => true,'msg' => 'Status Changed.']);	
		}else{
			retJson(['_return' => false,'msg' => '`order_id` is Required']);
		}
	}

	public function item_picked_from_customer()
	{
		if($this->input->post('order_id')){	
			$this->db->where('id',$this->input->post('order_id'))->update('corder',
				['status_desc' => 'Item Picked From Customer','notes' => 'Item Collected By Driver']
			);
			retJson(['_return' => true,'msg' => 'Status Changed.']);	
		}else{
			retJson(['_return' => false,'msg' => '`order_id` is Required']);
		}
	}

	public function completed()
	{
		if($this->input->post('order_id')){	
			$this->db->where('id',$this->input->post('order_id'))->update('corder',
				['status_desc' => 'Completed','notes' => 'Delivered','status' => 'completed']
			);
			retJson(['_return' => true,'msg' => 'Order Completed']);	
		}else{
			retJson(['_return' => false,'msg' => '`order_id` is Required']);
		}
	}

	public function ontheway()
	{
		if($this->input->post('order_id')){	
			$this->db->where('id',$this->input->post('order_id'))->update('corder',
				['status_desc' => 'On The Way','notes' => 'Out For Delivery']
			);
			retJson(['_return' => true,'msg' => 'Status Changed.']);	
		}else{
			retJson(['_return' => false,'msg' => '`order_id` is Required']);
		}
	}

	public function getorder()
	{
		if($this->input->post('order_id')){	
			$single = $this->db->get_where('corder',['id' => $this->input->post('order_id')])->row_array();
			if($single){
				$customer = $this->db->get_where('z_customer',['id' => $single['userid']])->row_array();
				$service = $this->db->get_where('z_service',['id' => $single['service']])->row_array();
				$address = $this->db->get_where('address',['userid' => $single['userid']])->row_array();
				$single['customer_name'] 	= $customer['fname'].' '.$customer['lname'];
				$single['pick']  			= $service;
				$single['drop']		 	= $address;
				retJson(['_return' => true,'data' => $single]);				
			}else{
				retJson(['_return' => false,'msg' => 'Please Enter Valid Order Id']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`order_id` is Required']);
		}
	}

	public function getorders()
	{
		if($this->input->post('status') && $this->input->post('user_id')){
			if($this->input->post('status') == "ongoing"){
				$where = ['status' => "ongoing",'driver' => $this->input->post('user_id'),'df' => ''];
			}
			if($this->input->post('status') == "completed"){
				$where = ['status' => "completed",'driver' => $this->input->post('user_id'),'df' => ''];
			}
			$list = $this->db->order_by('id','desc')->get_where('corder',$where);
			$nlist = $list->result_array();
			foreach ($list->result_array() as $key => $value) {
				$customer = $this->db->get_where('z_customer',['id' => $value['userid']])->row_array();
				$service = $this->db->get_where('z_service',['id' => $value['service']])->row_array();
				$address = $this->db->get_where('address',['userid' => $value['userid']])->row_array();
				$nlist[$key]['customer_name'] 	= $customer['fname'].' '.$customer['lname'];
				$nlist[$key]['pick']  			= $service;
				$nlist[$key]['drop']		 	= $address;
			}
			retJson(['_return' => true,'count' => $list->num_rows(),'list' => $nlist]);
		}else{
			retJson(['_return' => false,'msg' => '`status` = (`ongoing`,`completed`) and `user_id` are Required']);
		}
	}

	public function mydashboard()
	{
		if($this->input->post('user_id')){
			$upcoming = $this->db->get_where('corder',['status' => "upcoming",'df' => ''])->num_rows();
			$ongoing = $this->db->get_where('corder',['status' => "ongoing",'driver' => $this->input->post('user_id'),'df' => '','cancel' => ''])->num_rows();
			$compeleted = $this->db->get_where('corder',['status' => "completed",'driver' => $this->input->post('user_id'),'df' => '','cancel' => ''])->num_rows();
			$canceled = $this->db->get_where('corder',['status' => "completed",'driver' => $this->input->post('user_id'),'df' => '','cancel !=' => ''])->num_rows();

			$ret = [
				'upcoming' 	=> $upcoming, 
				'ongoing' 	=> $ongoing, 
				'completed' => $compeleted, 
				'canceled' 	=> $canceled, 
				'cash' 		=> "0.00", 
				'bank' 		=> "0.00"
			];
			retJson(['_return' => true,'data' => $ret]);	
		}else{
			retJson(['_return' => false,'msg' => '`user_id` is Required']);
		}
	}

	public function update_latlon()
	{
		if($this->input->post('userid') && $this->input->post('lat') && $this->input->post('lon')){
			$old = $this->db->get_where('delivery_latlon',['user' => $this->input->post('userid')])->row_array();
			if($old){
				$data = [
					'lat'		=> $this->input->post('lat'),
					'lon'		=> $this->input->post('lon')
				];
				$this->db->where('id',$this->input->post('userid'))->update('delivery_latlon',$data);
			}else{
				$data = [
					'user'		=> $this->input->post('userid'),
					'lat'		=> $this->input->post('lat'),
					'lon'		=> $this->input->post('lon')
				];
				$this->db->insert('delivery_latlon',$data);
			}
			retJson(['_return' => true,'msg' => 'Lat - Lon Saved']);
		}else{
			retJson(['_return' => false,'msg' => '`userid`,`lat` and `lon` is Required']);
		}
	}

	public function faq()
	{
		$list = $this->db->get('faq_delivery');
		retJson(['_return' => true,'count' => $list->num_rows(),'list' => $list->result_array()]);
	}

	public function about()
	{
		$content = $this->db->get_where('pages',['id' => '7'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function privacy()
	{
		$content = $this->db->get_where('pages',['id' => '6'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function terms()
	{
		$content = $this->db->get_where('pages',['id' => '5'])->row_array();
		retJson(['_return' => true,'content' => $content['content']]);
	}

	public function logout()
	{
		if($this->input->post('userid')){
			$this->db->where('id',$this->input->post('userid'))->update('z_delivery',['token' => ""]);
			retJson(['_return' => true,'msg' => 'Logout Successful']);
		}else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function verify_login_otp()
	{
		if($this->input->post('userid') && $this->input->post('otp') && $this->input->post('token')){
			$user = $this->db->get_where('z_delivery',['id' => $this->input->post('userid')])->row_array();
			if($user && $user['loginotp'] == $this->input->post('otp')){
				$this->db->where('id',$user['id'])->update('z_delivery',['token' => $this->input->post('token')]);
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
			$this->db->where('id',$this->input->post('userid'))->update('z_delivery',['loginotp' => $otp]);
			retJson(['_return' => true,'msg' => 'OTP Sent','otp' => $otp,'userid' => $this->input->post('userid')]);
		}
		else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function login()
	{
		if($this->input->post('mobile')){
			$user = $this->db->get_where('z_delivery',['mobile' => $this->input->post('mobile'),'df' => '']);
			if($user->num_rows() > 0){
				$user = $user->row_array();
				if($user['verified'] == 'Verified'){
					if($user['block'] == ""){
						$otp = mt_rand(100000, 999999);
						$this->db->where('id',$user['id'])->update('z_delivery',['loginotp' => $otp]);
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
			$this->db->where('id',$this->input->post('userid'))->update('z_delivery',['otp' => $otp]);
			retJson(['_return' => true,'msg' => 'OTP Sent','otp' => $otp,'userid' => $this->input->post('userid')]);
		}
		else{
			retJson(['_return' => false,'msg' => '`userid` is Required']);
		}
	}

	public function verify_otp()
	{
		if($this->input->post('userid') && $this->input->post('otp')){
			$user = $this->db->get_where('z_delivery',['id' => $this->input->post('userid')])->row_array();
			if($user && $user['otp'] == $this->input->post('otp')){
				$this->db->where('id',$this->input->post('userid'))->update('z_delivery',['verified' => 'Verified']);
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
		if($this->input->post('fname') && $this->input->post('lname') && $this->input->post('mobile')){
			$old = $this->db->get_where('z_delivery',['mobile' => $this->input->post('mobile'),'df' => '']);
			if($old->num_rows() == 0){
				$otp = mt_rand(100000, 999999);
				$data = [
					'fname'			=> $this->input->post('fname'),
					'lname'			=> $this->input->post('lname'),
					'mobile'		=> $this->input->post('mobile'),
					'deviceid'		=> '',
					'token'			=> '',
					'df'			=> '',
					'block'			=> '',
					'approved'		=> '0',
					'registered_at'	=> date('Y-m-d H:i:s'),
					'otp'			=> $otp
				];
				$this->db->insert('z_delivery',$data);
				$user = $this->db->insert_id();
				retJson(['_return' => true,'msg' => 'Registration Successful','otp' => $otp,'userid' => $user]);
			}else{
				$oldRow = $old->row_array();
				if($oldRow['verified'] == 'Not Verified'){
					$otp = mt_rand(100000, 999999);
					$data = [
						'fname'			=> $this->input->post('fname'),
						'lname'			=> $this->input->post('lname'),
						'mobile'		=> $this->input->post('mobile'),
						'deviceid'		=> '',
						'token'			=> '',
						'df'			=> '',
						'block'			=> '',
						'approved'		=> '0',
						'registered_at'	=> date('Y-m-d H:i:s'),
						'otp'			=> $otp
					];
					$this->db->where('id',$oldRow['id'])->update('z_delivery',$data);
					retJson(['_return' => true,'msg' => 'Registration Successful','otp' => $otp,'userid' => $oldRow['id']]);
				}else{
					retJson(['_return' => false,'msg' => 'Mobile No. Already Exists.']);
				}
			}
		}else{
			retJson(['_return' => false,'msg' => '`fname`,`lname` and `mobile` are Required']);
		}
	}


	public function index()
	{
		retJson(['No Script Found Here']);
	}
}


