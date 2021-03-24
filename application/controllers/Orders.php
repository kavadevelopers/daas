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
		$data['last']		= $this->db->order_by('id','desc')->get_where('corder',['df' => ''])->row_array()['id'];
		$this->load->theme('orders/new',$data);	
	}

	public function get_new_order()
	{
		$this->db->where('status','upcoming');
		$this->db->where('df','');
		$this->db->where('id >',$this->input->post('last'));
		$this->db->order_by('id','desc');
		$list = $this->db->get('corder')->result_array();
		$data = "";
		foreach ($list as $key => $value) {
			$orderType = $value["order_type"] == "later"?"<b>Later</b>":"";
			$delievryDate = $value['order_type'] == "later"?"Delivery Date : ".$value['delivery_date']:"";
			$data .= '<tr>';
				$data .= '<td class="text-center">#'.$value["order_id"].'</td>';
				$data .= "<th>".get_customer($value['userid'])['fname']." ".get_customer($value['userid'])['lname']."</th>";
				$data .= "<th>".get_service($value['service'])['fname']." ".get_service($value['service'])['lname']."</th>";
				$data .= '<td class="text-center">'.ucfirst($value["type"]).'<br>'.$orderType.'</td>';
				$data .= '<td class="text-center">'._get_category($value["category"])["name"].'</td>';
				$data .= '<td>'.subStrr($value['descr'],25).'</td>';
				$data .= '<td>'.$value['notes'].'</td>';
				$data .= '<td class="text-center">'.getPretyDateTime($value['created_at']).'<br>'.$delievryDate.'</td>';
				$data .= '<td class="text-center">';
					$data .= '<a href="'.base_url('orders/view/').$value['id'].'/new" class="btn btn-success btn-mini" title="View">';
						$data .= '<i class="fa fa-eye"></i>';
					$data .= '</a>';
					$data .= ' <button class="btn btn-secondary btn-mini" title="Edit Price" onclick="changePrice('.$value["id"].',"new",'.$value["price"].')">';
						$data .= '<i class="fa fa-pencil"></i>';
					$data .= '</button>';
					$data .= ' <a href="'.base_url('orders/complete/').$value['id'].'/new" class="btn btn-info btn-mini" title="Complete Order" onclick="return confirm("Are you sure want to Complete Order ?")">';
						$data .= '<i class="fa fa-check"></i>';
					$data .= '</a>';
					$data .= ' <a href="'.base_url('orders/cancel/').$value['id'].'/new" class="btn btn-warning btn-mini" title="Cancel Order" onclick="return confirm("Are you sure want to Cancel Order ?")">';
						$data .= '<i class="fa fa-times"></i>';
					$data .= '</a>';
					$data .= ' <button class="btn btn-primary btn-mini assignServiceBtn" data-id="'.$value["id"].'" data-type="'.$value["type"].'" data-category="'.$value["category"].'" title="Assign Service Provider">';
						$data .= '<i class="fa fa-send"></i>';
					$data .= '</button>';
					$data .= ' <a href="'.base_url('orders/delete/').$value['id'].'/new" class="btn btn-danger btn-mini btn-delete" title="Delete">';
						$data .= '<i class="fa fa-trash"></i>';
					$data .= '</a>';
				$data .= '</td>';
			$data .= '</tr>';
		}
		
		retJson([$data,$this->db->order_by('id','desc')->get_where('corder',['df' => ''])->row_array()['id']]);
	}

	public function ongoing()
	{
		$data['_title']		= "Ongoing Orders";
		$data['list']		= $this->db->get_where('corder',['status' => "ongoing",'df' => ''])->result_array();
		$this->load->theme('orders/ongoing',$data);	
	}	

	public function completed()
	{
		$data['_title']		= "Completed Orders";
		$data['list']		= $this->db->get_where('corder',['status' => "completed",'df' => ''])->result_array();
		$this->load->theme('orders/completed',$data);	
	}	

	public function complete($id,$route)
	{
		$this->db->where('id',$id)->update('corder',['notes' => 'Order completed','status' => 'completed']);
		$order = get_order($id);
		if($order['type'] == 'delivery'){
			$service = get_service($order['service']);
			$category = get_category($service['category']);
			if($category['type'] == 'ourpartner' && get_setting()['ppoints'] != 0){
				$this->general_model->insertWalletTransactions($order['userid'],'point','0.00',get_setting()['ppoints'],'Credited Delivery Order',$order['order_id'],date('Y-m-d H:i:s'));
			}
			if($category['type'] != 'ourpartner' && get_setting()['dpoints'] != 0){
				$this->general_model->insertWalletTransactions($order['userid'],'point','0.00',get_setting()['dpoints'],'Credited Delivery Order',$order['order_id'],date('Y-m-d H:i:s'));
			}
		}
		if($order['type'] == 'service' && get_setting()['spoints'] != 0){
			$this->general_model->insertWalletTransactions($order['userid'],'point','0.00',get_setting()['spoints'],'Credited Service Order',$order['order_id'],date('Y-m-d H:i:s'));
		}
		if($order['type'] == 'alignment' && get_setting()['apoints'] != 0){
			$this->general_model->insertWalletTransactions($order['userid'],'point','0.00',get_setting()['apoints'],'Credited Alignment Order',$order['order_id'],date('Y-m-d H:i:s'));
		}
		$this->session->set_flashdata('msg', 'Order Completed');
		redirect(base_url('orders/').$route);
	}

	public function cancel($id,$route)
	{
		$this->db->where('id',$id)->update('corder',['notes' => 'Order Canceled','status' => 'completed','cancel' => 'canceled']);
		$this->session->set_flashdata('msg', 'Order Canceled');
		redirect(base_url('orders/').$route);
	}

	public function view($order = false,$type = false)
	{
		if($type && in_array($type, ['new','ongoing','completed'])){
			if($order && get_order($order)){
				$data['order']			= get_order($order);
				$data['customer']		= get_customer($data['order']['userid']);
				$data['_title']			= "Order #".$data['order']['order_id'];
				$data['type']			= $type;
				$this->load->theme('orders/view',$data);	
			}else{
				redirect(base_url('orders/'.$type));	
			}
		}else{
			redirect(base_url('orders/new'));	
		}
	}

	public function assign_driver()
	{
		$this->db->where('id',$this->input->post('id'))->update('corder',
			['driver' => $this->input->post('driver')]
		);
		sendPush(
			[get_delivery($this->input->post('driver'))['token']],
			"Order #".get_order($this->input->post('id'))['order_id'],
			"New Delivery Request",
			"order",
			$this->input->post('id')
		);

		$this->session->set_flashdata('msg', 'Driver Assigned');
		redirect(base_url('orders/ongoing'));	
	}

	public function update_price()
	{
		$this->db->where('id',$this->input->post('id'))->update('corder',
			['price' => $this->input->post('price')]
		);

		$this->session->set_flashdata('msg', 'Amount Changed');
		redirect(base_url('orders/'.$this->input->post('type')));	
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

	public function get_service_provider()
	{
    	//$list = $this->db->get_where('z_service',['verified' => 'Verified','df' => '','block' => '','approved' => '1','token !=' => '','active' => '1','category' => $this->input->post('category')])->result_array();
    	$list = $this->db->get_where('z_service',['verified' => 'Verified','df' => '','block' => '','approved' => '1','category' => $this->input->post('category')])->result_array();

    	$str = '<option value="">-- Select --</option>';
    	foreach ($list as $key => $value) {
    		$str .= '<option value="'.$value["id"].'">'.$value["fname"].' '.$value["lname"].'</option>';
    	}
    	echo $str;
	}
}