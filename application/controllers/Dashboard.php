<?php
class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Dashboard";
		$data['todo']		= $this->general_model->getToDo();
		$data['other_task']		= $this->db->order_by('id','desc')->limit(5)->get_where('task',['from' => get_user()['id'],'done' => 0])->result_array();
		$data['my_task']		= $this->db->order_by('id','desc')->limit(5)->get_where('task',['to' => get_user()['id'],'done' => 0])->result_array();
		$data['receipt_request']	= $this->db->limit(5)->order_by('date','asc')->get_where('payment',['status' => '0'])->result_array();
		$data['top_five_services_sold']	= $this->getTopFiveServicesSoldInThisMonth();

		if(get_user()['user_type'] == "0"){
			$this->load->theme('dashboard/superadmin',$data);
		}

		if(get_user()['user_type'] == "1"){
			$this->load->theme('dashboard/admin',$data);
		}

		if(get_user()['user_type'] == "3"){
			$this->load->theme('dashboard/sales',$data);
		}

		if(get_user()['user_type'] == "2"){
			$this->load->theme('dashboard/backoffice',$data);
		}
	}

	public function get_leads()
	{
		$data['_title']		= "Leads";
		$data['today']		= $this->db->get_where('leads',['df' => '','date' => date("Y-m-d")])->result_array();
		$data['month']		= $this->db->get_where('leads',['df' => '','date >=' => date("Y-m-1"),'date <=' => date("Y-m-t")])->result_array();
		$this->load->theme('pages/lead',$data);
	}

	public function get_clients()
	{
		$data['_title']		= "Clients";
		$data['today']		= $this->db->get_where('client',['status' => '0','created_at >=' => date("Y-m-d 00:00:00"),'created_at <=' => date("Y-m-d 23:59:59")])->result_array();
		$data['month']		= $this->db->get_where('client',['status' => '0','created_at >=' => date("Y-m-1"),'created_at <=' => date("Y-m-t")])->result_array();
		$this->load->theme('pages/client',$data);
	}

	public function get_payments()
	{
		$data['_title']		= "Payments";
		$this->load->theme('pages/payment',$data);
	}


	public function getTopFiveServicesSoldInThisMonth()
	{	
		$user = get_user();
		$services = [];
		$this->db->select('*');
        $this->db->group_by('service');
        if($user['user_type'] != 0){
        	$this->db->where('user',$user['id']);	
        }
        $this->db->where('created_at >=',date('Y-m-1'));
        $this->db->where('created_at <=',date('Y-m-t'));
        $this->db->from('sold_services');
        $distinct = $this->db->get()->result_array();
        foreach ($distinct as $key => $value) {
        	$this->db->where('created_at >=',date('Y-m-1'));
        	$this->db->where('created_at <=',date('Y-m-t'));
        	if($user['user_type'] != 0){
	        	$this->db->where('user',$user['id']);	
	        }
		    $this->db->where('service',$value['service']);
		    $this->db->from('sold_services');
		    $total = $this->db->get()->num_rows();
		    array_push($services, ['service' => $value['service'],"total" => $total]);
        }
        array_multisort(array_column($services, 'total'), SORT_DESC, $services);
        return array_slice($services,0,5);
	}
}
?>