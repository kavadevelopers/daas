<?php
class WalletCron extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$users = $this->db->get_where('z_customer',['df' => '','block' => ''])->result_array();
		foreach ($users as $key => $user) {
			if($user['free'] != 'yes'){
				$sub = $this->db->order_by('id','desc')->get_where('extend_subscription',['userid' => $user['id']])->row_array();
				if ($sub) {
					if($sub['month'] == '3'){
						$setedMonth = false;
						if(minusMonth('1',$user['sub_expired_on']) == strtotime(date('d-m-Y'))){
							$setedMonth = true;
						}
						else if(minusMonth('2',$user['sub_expired_on']) == strtotime(date('d-m-Y'))){
							$setedMonth = true;	
						}
						else if(strtotime($user['sub_expired_on']) <= strtotime(date('d-m-Y'))){
							$setedMonth = true;
						}
						if($setedMonth){
							$points = $this->general_model->getTotalPoints($user['id'],'point');
							if($points >= 500 && $points < 750){
								$amount = $this->db->get_where('range_of_points',['id' => '1'])->row_array()['amount'];
								$this->general_model->insertWalletTransactions($user['id'],'amount','0.00',$amount,'Wallet balance credited','',date('Y-m-d H:i:s'));
								$this->general_model->insertWalletTransactions($user['id'],'point',$points,'0.00','Points to wallet balance','',date('Y-m-d H:i:s'));
							}else if($points >= 750 && $points < 1000){
								$amount = $this->db->get_where('range_of_points',['id' => '2'])->row_array()['amount'];
								$this->general_model->insertWalletTransactions($user['id'],'amount','0.00',$amount,'Wallet balance credited','',date('Y-m-d H:i:s'));
								$this->general_model->insertWalletTransactions($user['id'],'point',$points,'0.00','Points to wallet balance','',date('Y-m-d H:i:s'));
							}else if($points >= 1000){
								$amount = $this->db->get_where('range_of_points',['id' => '3'])->row_array()['amount'];
								$this->general_model->insertWalletTransactions($user['id'],'amount','0.00',$amount,'Wallet balance credited','',date('Y-m-d H:i:s'));
								$this->general_model->insertWalletTransactions($user['id'],'point',$points,'0.00','Points to wallet balance','',date('Y-m-d H:i:s'));
							}
						}
					}else{
						if(strtotime($user['sub_expired_on']) <= strtotime(date('d-m-Y'))){
							$points = $this->general_model->getTotalPoints($user['id'],'point');
							if($points >= 500 && $points < 750){
								$amount = $this->db->get_where('range_of_points',['id' => '1'])->row_array()['amount'];
								$this->general_model->insertWalletTransactions($user['id'],'amount','0.00',$amount,'Wallet balance credited','',date('Y-m-d H:i:s'));
								$this->general_model->insertWalletTransactions($user['id'],'point',$points,'0.00','Points to wallet balance','',date('Y-m-d H:i:s'));
							}else if($points >= 750 && $points < 1000){
								$amount = $this->db->get_where('range_of_points',['id' => '2'])->row_array()['amount'];
								$this->general_model->insertWalletTransactions($user['id'],'amount','0.00',$amount,'Wallet balance credited','',date('Y-m-d H:i:s'));
								$this->general_model->insertWalletTransactions($user['id'],'point',$points,'0.00','Points to wallet balance','',date('Y-m-d H:i:s'));
							}else if($points >= 1000){
								$amount = $this->db->get_where('range_of_points',['id' => '3'])->row_array()['amount'];
								$this->general_model->insertWalletTransactions($user['id'],'amount','0.00',$amount,'Wallet balance credited','',date('Y-m-d H:i:s'));
								$this->general_model->insertWalletTransactions($user['id'],'point',$points,'0.00','Points to wallet balance','',date('Y-m-d H:i:s'));
							}
						}
					}
				}
			}
		}
	}
}