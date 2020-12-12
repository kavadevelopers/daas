<?php
class Apicommon extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function get_business_categories()
	{
		$where = ['df' => ''];
		if($this->input->post('type')){
			$where = ['df' => '','type' => $this->input->post('type')];
		}
		$query = $this->db->get_where('business_categories',$where);
		$list = $query->result_array();
		foreach ($list as $key => $value) {
			$list[$key]['image'] = getCategoryThumb($value['image']);
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
			if($this->input->post('type') == "customer" && $user){
				$data['subscription_status'] 	= checkSubscriptionExpiration($user['sub_expired_on']);
				$data['sub_expired_on'] 		= $user['sub_expired_on'];
			}
		}

		retJson(
			$data
		);
	}

}
