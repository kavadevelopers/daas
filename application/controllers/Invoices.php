<?php
class Invoices extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Invoice";
		$data['invoices']	= $this->general_model->getInvoices();
		$this->load->theme('invoice/index',$data);		
	}


	public function editInvoice()
	{
		$invoice = $this->db->get_where('invoice',['id' => $this->input->post('id')])->row_array();
		$client = $this->db->get_where('client',['id' => $invoice['client']])->row_array();
		$client_string = "#".$client['c_id'].'<br><b>'.$client['fname'].' '.$client['mname'].' '.$client['lname'].'</b><br>'.$client['mobile'].'<br>'.$client['add1'].'<br>'.$this->general_model->_get_area($client['area'])['name'].','.$this->general_model->_get_city($client['city'])['name'].','.$this->general_model->_get_district($client['district'])['name'].','.$this->general_model->_get_state($client['state'])['name'].'<br><br>';

		$invoice_details = $this->db->get_where('invoice_details',['invoice' => $this->input->post('id')])->result_array();
		$str = "";
		foreach ($invoice_details as $key => $invoice_detail) {
			$service = $this->general_model->_get_service($invoice_detail['service']);
			
			$str .= '<div class="col-md-3">';
				$str .= '<div class="form-group">';
					$str .= '<label>Service <span class="-req">*</span></label> <input type="hidden" class="editInvoiceDetailId" value="'.$invoice_detail['id'].'" name="detailId[]">';
					$str .= '<input name="" type="text" placeholder="Service" class="form-control form-control-sm " value="'.$service["name"].'" title="'.$service["name"].'" readonly>';
					$str .= '</div></div>';
			$str .= '<div class="col-md-3">';
                $str .= '<div class="form-group">';
                    $str .= '<label>Qty <span class="-req">*</span></label>';
                    $str .= '<input name="qty[]" type="text" placeholder="Qty" class="form-control form-control-sm numbers" onkeyup="editInvoiceTotal ();" id="editInvoiceQty'.$invoice_detail['id'].'" value="'.$invoice_detail['qty'].'" required>';
					$str .= '</div></div> ';
			$str .= '<div class="col-md-3">';
                $str .= '<div class="form-group">';
                    $str .= '<label>Price <span class="-req">*</span></label>';
                    $str .= '<input name="price[]" type="text" placeholder="Price" class="form-control form-control-sm decimal-num" onkeyup="editInvoiceTotal ();" id="editInvoicePrice'.$invoice_detail['id'].'" value="'.$invoice_detail['price'].'" required></div></div>';
                    $str .= '<div class="col-md-3">
                              <div class="form-group">
                                <label>Total</label>
                                <input name="" type="text" placeholder="Total" class="form-control form-control-sm" id="editInvoiceTotal'.$invoice_detail['id'].'" value="'.$invoice_detail['total'].'" readonly>
                            </div>';
                	$str .= '</div></div>';
		}



		echo json_encode(['title' => 'Edit Invoice - #'.$invoice['inv'],'client' => $client_string,'remarks' => $invoice['remarks'],'total' => $invoice['total'],'list' => $str]);
	}


	public function update()
	{
		$total = 0;
		foreach ($this->input->post('detailId') as $key => $value) {
			$this->db->where('id',$this->input->post('detailId')[$key]);
			$this->db->update('invoice_details',['price' => $this->input->post('price')[$key],'qty' => $this->input->post('qty')[$key] ,'total' => $this->input->post('qty')[$key] * $this->input->post('price')[$key]]);
			$total += $this->input->post('qty')[$key] * $this->input->post('price')[$key];
		}

		$this->db->where('id',$this->input->post('invoice'));
		$this->db->update('invoice',['total' => $total,'remarks' => $this->input->post('remarks')]);

		$data = [
			'debit'		=> $total,
		];
		$this->db->where('main',$this->input->post('invoice'));
		$this->db->where('type',invoice());
		$this->db->update('transaction',$data);

		$this->session->set_flashdata('msg', 'Invoice Updated');
	    redirect(base_url('invoices'));
	}
}
?>