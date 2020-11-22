<?php
class Import_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}



	public function getBranch($str)
	{
		return $this->db->get_where('branch',['name' => $str])->row_array();
	}

	public function getSource($str)
	{
		return $this->db->get_where('source',['name' => $str])->row_array();
	}

	public function getClientType($str)
	{
		return $this->db->get_where('client_type',['name' => $str])->row_array();
	}

	public function getClientByPanCard($str)
	{
		return $this->db->get_where('client',['pan' => $str])->num_rows();
	}

	public function getArea($str)
	{
		return $this->db->get_where('areas',['name' => $str])->row_array();
	}

	public function getCity($str)
	{
		return $this->db->get_where('area_city',['name' => $str])->row_array();
	}

	public function getDistrict($str)
	{
		return $this->db->get_where('district',['name' => $str])->row_array();
	}

	public function getState($str)
	{
		return $this->db->get_where('area_state',['name' => $str])->row_array();
	}

	public function getIndustry($str)
	{
		return $this->db->get_where('industry',['name' => $str])->row_array();
	}

	public function getSubIndustry($str)
	{
		return $this->db->get_where('sub_industry',['name' => $str])->row_array();
	}

	public function getNotRequired($str)
	{
		if($str != "" || $str != null || $str){
			return strtoupper($str);
		}else{
			return "";
		}
	}

	public function getClientStatus($str)
	{
		if($str == "ACTIVE"){
			return "0";
		}else if($str == "INACTIVE"){
			return "8";
		}else if($str == "CANCELED"){
			return "9";
		}else{
			return "1";	
		}
	}

}