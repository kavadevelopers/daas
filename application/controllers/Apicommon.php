<?php
class Apicommon extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function chatPush()
	{
		if($this->input->post('sender_id') && $this->input->post('receiver_id') && $this->input->post('sender_type') && $this->input->post('receiver_type') && $this->input->post('msg') && $this->input->post('order_id')){	
			
			if($this->input->post('sender_type') == "customer"){
				if($this->input->post('receiver_type') == "delivery"){
					$user = $this->db->get_where('z_delivery',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}

				if($this->input->post('receiver_type') == "service"){
					$user = $this->db->get_where('z_service',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}
			}

			if($this->input->post('sender_type') == "delivery"){
				if($this->input->post('receiver_type') == "customer"){
					$user = $this->db->get_where('z_customer',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}

				if($this->input->post('receiver_type') == "delivery"){
					$user = $this->db->get_where('z_delivery',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}

				if($this->input->post('receiver_type') == "service"){
					$user = $this->db->get_where('z_service',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}
			}

			if($this->input->post('sender_type') == "service"){
				if($this->input->post('receiver_type') == "customer"){
					$user = $this->db->get_where('z_customer',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}

				if($this->input->post('receiver_type') == "delivery"){
					$user = $this->db->get_where('z_delivery',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}

				if($this->input->post('receiver_type') == "service"){
					$user = $this->db->get_where('z_service',['id' => $this->input->post('receiver_id')])->row_array();
					sendChatPush($user['token'],"New Message",$this->input->post('msg'),$this->input->post('sender_id'),$this->input->post('receiver_id'),$this->input->post('sender_type'),$this->input->post('receiver_type'),$this->input->post('order_id'));
				}
			}			

		}else{
			retJson(['_return' => false,'msg' => '`sender_id`,`receiver_id`,`sender_type`,`receiver_type`,`msg` and `order_id` are Required']);
		}	
	}


	public function get_business_categories()
	{
		$where = ['df' => ''];
		if($this->input->post('type')){
			$where = ['df' => '','type' => $this->input->post('type'),'start <=' => date('H:i:s'),'end >=' => date('H:i:s')];
		}
		$query = $this->db->get_where('business_categories',$where);
		$list = $query->result_array();
		foreach ($list as $key => $value) {
			$list[$key]['image'] = getCategoryThumb($value['image']);
			$list[$key]['menu'] = getCategoryThumb($value['menu']);
		}
		retJson(['_return' => true,'count' => $query->num_rows(),'list' => $list]);
	}


	public function getsettings()
	{
		$data = [
			'_return' => true,
			'razorepay_key' => get_setting()['razorpay_key'],
			'support_email' => get_setting()['support_email'],
			'support_mobile' => get_setting()['support_mobile']
		];

		if($this->input->post('type') && $this->input->post('userid')){
			$user = $this->db->get_where('z_customer',['id' => $this->input->post('userid')])->row_array();
			$service = $this->db->get_where('z_service',['id' => $this->input->post('userid')])->row_array();
			$delivery = $this->db->get_where('z_delivery',['id' => $this->input->post('userid')])->row_array();
			if($this->input->post('type') == "customer" && $user){
				$data['subscription_status'] 	= checkSubscriptionExpiration($user['sub_expired_on']);
				$data['sub_expired_on'] 		= $user['sub_expired_on'];
				$data['token']					= $user['token'];
			}

			if($this->input->post('type') == "delivery" && $delivery){
				$data['token']					= $delivery['token'];
			}

			if($this->input->post('type') == "service" && $service){
				$data['token']					= $service['token'];
			}
		}

		retJson(
			$data
		);
	}

}
