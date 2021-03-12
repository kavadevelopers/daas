<?php
class General_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function get_setting()
	{
		return $this->db->get_where('setting',['id' => '1'])->row_array();
	}

	public function insertWalletTransactions($user,$type,$debit,$credit,$desc,$dy,$cat)
	{
		$this->db->insert('points_transactions',[
			'user'		=> $user,
			'type'		=> $type,
			'debit'		=> $debit,
			'credit'	=> $credit,
			'descr'		=> $desc,
			'dy'		=> $dy,
			'cat'		=> $cat
		]);
	}

	public function getTotalPoints($user,$type)
	{
		$this->db->select_sum('debit');
	    $this->db->from('points_transactions');
	    $this->db->where('user',$user);
	    $this->db->where('type',$type);
	    $debit = $this->db->get()->row()->debit;

	    $this->db->select_sum('credit');
	    $this->db->from('points_transactions');
	    $this->db->where('user',$user);
	    $this->db->where('type',$type);
	    $credit = $this->db->get()->row()->credit;

	    $dTotal = 0;
	    if($debit){
	    	$dTotal = $debit;
	    }

	    $cTotal = 0;
	    if($credit){
	    	$cTotal = $credit;
	    }

	    return $cTotal - $dTotal;
	}
}
?>