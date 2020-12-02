<?php
class Apicustomer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function cancel_order()
	{
		if($this->input->post('order_id') && $this->input->post('userid')){
			$single = $this->db->get_where('corder',['id' => $this->input->post('order_id'),'userid' => $this->input->post('order_id')])->row_array();
			if($single){
				$this->db->where('id',$this->input->post('order_id'))->update('corder',
					['status' => 'completed','status_desc' => 'Canceled By Customer.','cancel' => 'canceled']
				);
				retJson(['_return' => true,'msg' => 'Order Canceled.']);
			}else{
				retJson(['_return' => false,'msg' => 'Please Enter Valid Order Id']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`order_id` and `userid` are Required']);
		}
	}

	public function accept_order()
	{
		if($this->input->post('type') && $this->input->post('order_id') && $this->input->post('userid')){
			if($this->input->post('type') == 'accept'){
				$this->db->where('id',$this->input->post('order_id'))->update('corder',
					['status' => 'ongoing','status_desc' => 'Accepted By Customer.']
				);
				retJson(['_return' => true,'msg' => 'Order Accepted.']);	
			}else if($this->input->post('type') == 'reject'){
				$this->db->where('id',$this->input->post('order_id'))->update('corder',
					['status' => 'upcoming','status_desc' => 'Order Placed.','price' => '0.00','service' => '']
				);
				retJson(['_return' => true,'msg' => 'Order Rejected.']);	
			}else{
				retJson(['_return' => false,'msg' => '`type` = (`accept`,`reject`) Please Enter Valid Type']);	
			}
		}else{
			retJson(['_return' => false,'msg' => '`type` = (`accept`,`reject`),`order_id` and `userid` are Required']);
		}
	}

	public function getorder()
	{
		if($this->input->post('order_id')){	
			$single = $this->db->get_where('corder',['id' => $this->input->post('order_id')])->row_array();
			if($single){
				$customer = $this->db->get_where('z_customer',['id' => $single['userid']])->row_array();
				$address = $this->db->get_where('address',['userid' => $single['userid']])->row_array();
				$single['customer_name'] = $customer['fname'].' '.$customer['lname'];
				$single['address']	= $address;
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
		if($this->input->post('userid') && $this->input->post('status')){
			if($this->input->post('status') == 'current'){
				$where = ['status !=' => 'completed','userid' => $this->input->post('userid'),'df' => ''];
			}else{
				$where = ['status' => 'completed','userid' => $this->input->post('userid'),'df' => ''];
			}
			$list = $this->db->get_where('corder',$where);
			$nlist = $list->result_array();
			foreach ($list->result_array() as $key => $value) {
				$customer = $this->db->get_where('z_customer',['id' => $value['userid']])->row_array();
				$address = $this->db->get_where('address',['userid' => $value['userid']])->row_array();
				$nlist[$key]['customer_name'] = $customer['fname'].' '.$customer['lname'];
				$nlist[$key]['address']		  = $address;
			}
			retJson(['_return' => true,'count' => $list->num_rows(),'list' => $nlist]);
		}else{
			retJson(['_return' => false,'msg' => '`status` = (`current`,`past`) and `userid` are Required']);
		}
	}

	public function order()
	{
		if($this->input->post('userid') && $this->input->post('category') && $this->input->post('type')){
			$desc = "";
			if($this->input->post('desc')){
				$desc = $this->input->post('desc');
			}
			$last_id = $this->db->order_by('id','desc')->limit(1)->get('corder')->row_array();
			if($last_id){
				$order_id = mt_rand(10000000, 99999999).($last_id['id'] + 1);
			}else{
				$order_id = mt_rand(10000000, 99999999).'1';
			}
			$data = [
				'userid'		=> $this->input->post('userid'),
				'order_id'		=> $order_id,
				'type'			=> $this->input->post('type'),
				'category'		=> $this->input->post('category'),
				'descr'			=> $desc,
				'status'		=> 'upcoming',
				'status_desc'	=> 'Order Placed',
				'notes'			=> '',
				'created_at'	=> date('Y-m-d H:i:s')
			];
			$this->db->insert('corder',$data);
			$or_id = $this->db->insert_id();

			$config['upload_path'] = './uploads/order/';
		    $config['allowed_types']	= '*';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $this->load->library('upload', $config);
			if(isset($_FILES ['img1']) && $_FILES['img1']['error'] == 0){
				$img1 = microtime(true).".".pathinfo($_FILES['img1']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $img1;
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('img1')){
		    		$this->db->insert('corder_images',['order_id' => $or_id,'name' => 'img1','image' => $img1]);
		    	}
			}

			$config['upload_path'] = './uploads/order/';
		    $config['allowed_types']	= '*';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $this->load->library('upload', $config);
			if(isset($_FILES ['img2']) && $_FILES['img2']['error'] == 0){
				$img2 = microtime(true).".".pathinfo($_FILES['img2']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $img2;
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('img2')){
		    		$this->db->insert('corder_images',['order_id' => $or_id,'name' => 'img2','image' => $img2]);
		    	}
			}

			$config['upload_path'] = './uploads/order/';
		    $config['allowed_types']	= '*';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $this->load->library('upload', $config);
			if(isset($_FILES ['img3']) && $_FILES['img3']['error'] == 0){
				$img3 = microtime(true).".".pathinfo($_FILES['img3']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $img3;
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('img3')){
		    		$this->db->insert('corder_images',['order_id' => $or_id,'name' => 'img3','image' => $img3]);
		    	}
			}

			$config['upload_path'] = './uploads/order/';
		    $config['allowed_types']	= '*';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $this->load->library('upload', $config);
			if(isset($_FILES ['img4']) && $_FILES['img4']['error'] == 0){
				$img4 = microtime(true).".".pathinfo($_FILES['img4']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $img4;
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('img4')){
		    		$this->db->insert('corder_images',['order_id' => $or_id,'name' => 'img4','image' => $img4]);
		    	}
			}

			$config['upload_path'] = './uploads/order/';
		    $config['allowed_types']	= '*';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $this->load->library('upload', $config);
			if(isset($_FILES ['img5']) && $_FILES['img5']['error'] == 0){
				$img5 = microtime(true).".".pathinfo($_FILES['img5']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $img5;
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('img5')){
		    		$this->db->insert('corder_images',['order_id' => $or_id,'name' => 'img5','image' => $img5]);
		    	}
			}

			$config['upload_path'] = './uploads/order/';
		    $config['allowed_types']	= '*';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $this->load->library('upload', $config);
			if(isset($_FILES ['img6']) && $_FILES['img6']['error'] == 0){
				$img6 = microtime(true).".".pathinfo($_FILES['img6']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $img6;
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('img6')){
		    		$this->db->insert('corder_images',['order_id' => $or_id,'name' => 'img6','image' => $img6]);
		    	}
			}
			retJson(['_return' => true,'msg' => 'Order Placed.','order' => $order_id,'order_id' => $or_id]);
		}else{
			retJson(['_return' => false,'msg' => '`userid`,`category` and `type` are Required']);
		}
	}

	public function save_address()
	{
		if($this->input->post('userid') && $this->input->post('flat_no') && $this->input->post('street_no') && $this->input->post('address_line') && $this->input->post('latitude') && $this->input->post('longitude')){
			$old = $this->db->get_where('address',['id' => $this->input->post('userid')])->num_rows();
			if($old > 0){
				$data = [
					'flat_no'		=> $this->input->post('flat_no'),
					'street_no'		=> $this->input->post('street_no'),
					'address_line'	=> $this->input->post('address_line'),
					'latitude'		=> $this->input->post('latitude'),
					'longitude'		=> $this->input->post('longitude')
				];	
				$this->db->where('userid',$this->input->post('userid'))->update('address',$data);
				retJson(['_return' => true,'msg' => 'Address Updated.']);
			}else{
				$data = [
					'userid'		=> $this->input->post('userid'),
					'flat_no'		=> $this->input->post('flat_no'),
					'street_no'		=> $this->input->post('street_no'),
					'address_line'	=> $this->input->post('address_line'),
					'latitude'		=> $this->input->post('latitude'),
					'longitude'		=> $this->input->post('longitude')
				];	
				$this->db->insert('address',$data);
				retJson(['_return' => true,'msg' => 'Address Saved.']);
			}
		}else{
			retJson(['_return' => false,'msg' => '`userid`,`flat_no`,`street_no`,`address_line`,`latitude` and `longitude` are Required']);
		}
	}

	public function getbanner()
	{
		$query = $this->db->get_where('banner');
		$list = $query->result_array();
		foreach ($list as $key => $value) {
			$list[$key]['image'] = base_url('uploads/banner/').$value['image'];
		}
		retJson(['_return' => true,'count' => $query->num_rows(),'list' => $list]);
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
	   		            	@unlink(FCPATH.'/uploads/user/'.$user['image']);   
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
							$address = $this->db->get_where('address',['userid'] => $user['id'])->row_array();
							$ad = 0;
							if($address){
								$ad = 1;
							}
							$user['address']	= $ad;
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