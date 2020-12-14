<?php
class Orders extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function new()
	{
		$data['_title']		= "New Orders";
		$data['list']		= $this->db->get_where('corder',['status' => "upcoming",'df' => ''])->result_array();
		$this->load->theme('orders/new',$data);	
	}

	public function ongoing()
	{
		$data['_title']		= "New Orders";
		$data['list']		= $this->db->get_where('corder',['status' => "ongoing",'df' => ''])->result_array();
		$this->load->theme('orders/ongoing',$data);	
	}	

	public function completed()
	{
		
	}	

	public function assign_service()
	{
		$order = get_order($this->input->post('id'));
		if($order['type'] == "delivery"){
			$this->db->where('id',$this->input->post('id'))->update('corder',
				['price' => $this->input->post('price'),'service' => $this->input->post('service'),'status_desc' => 'Price Added','notes' => 'Waiting']
			);

			sendPush(
				[get_customer(get_order($this->input->post('id'))['userid'])['token']],
				"Order #".get_order($this->input->post('id'))['order_id'],
				"Order Accepted By Service Provicer",
				"order",
				$this->input->post('id')
			);
		}

		if($order['type'] == "service"){
			$this->db->where('id',$this->input->post('id'))->update('corder',
				['service' => $this->input->post('service'),'status_desc' => 'Order Accepted By Service Provider','status' => 'ongoing','notes' => 'Coming For Visit']
			);

			sendPush(
				[get_customer(get_order($this->input->post('id'))['userid'])['token']],
				"Order #".get_order($this->input->post('id'))['order_id'],
				"Order Accepted By Service Provider. Coming For Visit",
				"order",
				$this->input->post('id')
			);
		}

		if($order['type'] == "alignment"){
			$this->db->where('id',$this->input->post('id'))->update('corder',
				['service' => $this->input->post('service'),'status_desc' => 'Order Accepted By Service Provider','status' => 'ongoing','notes' => 'Driver Assigned']
			);

			sendPush(
				[get_customer(get_order($this->input->post('id'))['userid'])['token']],
				"Order #".get_order($this->input->post('id'))['order_id'],
				"Order Accepted By Alignment. Driver Assigned.",
				"order",
				$this->input->post('id')
			);

			$driver = $this->db->order_by('rand()')->limit(1)->get_where('z_delivery',['verified' => 'Verified','df' => '','block' => '','approved' => '1','token !=' => '','active' => '1'])->result_array();
			if($driver){
				$delivery_boy = "";
				foreach ($driver as $dkey => $dvalue) {
					$dOrders = $this->db->get_where('corder',['driver' => $dvalue['id'],'status !=' => 'completed'])->num_rows();
					if($dOrders == 0){
						$delivery_boy = $dvalue['id'];
						break;
					}	
				}

				if ($delivery_boy == "") {
					$delivery_boy = $this->db->order_by('rand()')->limit(1)->get_where('z_delivery',['verified' => 'Verified','df' => '','block' => '','approved' => '1','token !=' => '','active' => '1'])->row_array()['id'];
				}


				$this->db->where('id',$this->input->post('id'))->update('corder',
					['driver' => $delivery_boy]
				);	
				sendPush(
					[get_delivery($delivery_boy)['token']],
					"Order #".get_order($this->input->post('id'))['order_id'],
					"New Alignment Request.",
					"order",
					$this->input->post('id')
				);				
			}	
		}

		$this->session->set_flashdata('msg', 'Service Provicer Assigned');
		redirect(base_url('orders/new'));	
	}

	public function delete($id,$route)
	{
		$this->db->where('id',$id)->update('corder',['df' => 'deleted']);
		$this->session->set_flashdata('msg', 'Order Deleted');
		redirect(base_url('orders/').$route);
	}
}