<?php
class CronController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
// 		$this->db->insert('cronchk',['time' => date('Y-m-d H:i:s')]);
// 		exit;
		$users = $this->db->get_where('z_customer',['df' => '','free' => ''])->result_array();
		foreach ($users as $key => $user) {
		    
			if(daysBeetweenDates($user['sub_expired_on']) >= 0){
				//Expired Notification
				
				sendPush(
					[$user['token']],
					"Subscription",
					"Your subscription plan has been expired. To enjoy unlimited deliveries and services subscribe now!"
				);
			}

			if(daysBeetweenDates($user['sub_expired_on']) == -2 || daysBeetweenDates($user['sub_expired_on']) == -1){
				// Two Days remaining notification
				sendPush(
					[$user['token']],
					"Subscription",
					"Your Subscription is about to end soon. To enjoy uninterrupted and unlimited deliveries renew your subscription on time!"
				);
			}
		}
	}
}