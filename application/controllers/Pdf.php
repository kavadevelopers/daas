<?php
class Pdf extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
		$this->load->library('tcpdf/invoice');
	}

	public function invoice($id = false)
	{
		if($id){
			if($this->general_model->_get_invoice($id)){
				$invoice = $this->general_model->_get_invoice($id);
				$client = $this->general_model->_get_client($invoice['client']);
				$company = $this->general_model->_get_company($invoice['company']);
				$pdf = new Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$invoiceData['image'] = base_url('uploads/company/').$company['letter_head'];
				$invoiceData['extention'] = getFileExtension($company['letter_head']);
				$pdf->set($invoiceData);
				$pdf->SetMargins(10, 35, 10);
		        $pdf->SetCreator(PDF_CREATOR);
		        $pdf->SetAuthor('Kava Developers');
		        $pdf->SetTitle($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id']);
		        $pdf->SetSubject('Invoice - #'.$invoice['inv']);
		        $pdf->SetKeywords('PDF');
		        $pdf->SetFontSize(11);
		        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		        $pdf->AddPage();
		        $data['invoice'] = $invoice;
		        $html = $this->load->view('pdf/invoice',$data,true);
		        $pdf->writeHTML($html, true, false, true, false, '');
		        $pdf->Output($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id'].' '.$invoice['inv'].'.pdf', 'I');
		    }
		    else{
	    		redirect(base_url('invoices'));
	    	}
	    }else{
	    	redirect(base_url('invoices'));
	    }
	}

	public function receipt($id = false)
	{
		if($id){
			if($this->general_model->_get_payment($id)){
				$invoice = $this->general_model->_get_payment($id);
				$client = $this->general_model->_get_client($invoice['client']);
				$company = $this->general_model->_get_company($invoice['company']);
				$pdf = new Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$invoiceData['image'] = base_url('uploads/company/').$company['letter_head'];
				$invoiceData['extention'] = getFileExtension($company['letter_head']);
				$pdf->set($invoiceData);
		        $pdf->SetCreator(PDF_CREATOR);
		        $pdf->SetMargins(10, 35, 10);
		        $pdf->SetAuthor('Kava Developers');
		        $pdf->SetTitle($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id']);
		        $pdf->SetSubject('Receipt - #'.$invoice['invoice']);
		        $pdf->SetKeywords('PDF');
		        $pdf->SetFontSize(11);
		        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		        $pdf->AddPage();
		        $data['invoice'] = $invoice;
		        $html = $this->load->view('pdf/receipt',$data,true);
		        $pdf->writeHTML($html, true, false, true, false, '');
		        $pdf->Output($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id'].' '.$invoice['invoice'].'.pdf', 'I');
		    }
		    else{
	    		redirect(base_url('payment'));
	    	}
	    }else{
	    	redirect(base_url('payment'));
	    }
	}

	public function reimburs($id = false)
	{
		if($id){
			if($this->general_model->_get_reimburs($id)){
				$invoice = $this->general_model->_get_reimburs($id);
				$client = $this->general_model->_get_client($invoice['client']);
				$company = $this->general_model->_get_company($invoice['company']);
				$pdf = new Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$invoiceData['image'] = base_url('uploads/company/').$company['letter_head'];
				$invoiceData['extention'] = getFileExtension($company['letter_head']);
				$pdf->set($invoiceData);
				$pdf->SetMargins(10, 35, 10);
		        $pdf->SetCreator(PDF_CREATOR);
		        $pdf->SetAuthor('Kava Developers');
		        $pdf->SetTitle($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id']);
		        $pdf->SetSubject('Reimburs');
		        $pdf->SetKeywords('PDF');
		        $pdf->SetFontSize(11);
		        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		        $pdf->AddPage();
		        $data['invoice'] = $invoice;
		        $html = $this->load->view('pdf/reimburs',$data,true);
		        $pdf->writeHTML($html, true, false, true, false, '');
		        $pdf->Output($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id'].' Reimbursement.pdf', 'I');
		    }
		    else{
	    		redirect(base_url('reimburs'));
	    	}
	    }else{
	    	redirect(base_url('reimburs'));
	    }
	}

	public function invoiceD($id = false)
	{
		if($id){
			if($this->general_model->_get_invoice($id)){
				$invoice = $this->general_model->_get_invoice($id);
				$client = $this->general_model->_get_client($invoice['client']);
				$company = $this->general_model->_get_company($invoice['company']);
				$pdf = new Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$invoiceData['image'] = base_url('uploads/company/').$company['letter_head'];
				$invoiceData['extention'] = getFileExtension($company['letter_head']);
				$pdf->set($invoiceData);
				$pdf->SetMargins(10, 35, 10);
		        $pdf->SetCreator(PDF_CREATOR);
		        $pdf->SetAuthor('Kava Developers');
		        $pdf->SetTitle($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id']);
		        $pdf->SetSubject('Invoice - #'.$invoice['inv']);
		        $pdf->SetKeywords('PDF');
		        $pdf->SetFontSize(11);
		        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		        $pdf->AddPage();
		        $data['invoice'] = $invoice;
		        $html = $this->load->view('pdf/invoice',$data,true);
		        $pdf->writeHTML($html, true, false, true, false, '');
		        $pdf->Output($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id'].' '.$invoice['inv'].'.pdf', 'D');
		    }
		    else{
	    		redirect(base_url('invoices'));
	    	}
	    }else{
	    	redirect(base_url('invoices'));
	    }
	}

	public function receiptD($id = false)
	{
		if($id){
			if($this->general_model->_get_payment($id)){
				$invoice = $this->general_model->_get_payment($id);
				$client = $this->general_model->_get_client($invoice['client']);
				$company = $this->general_model->_get_company($invoice['company']);
				$pdf = new Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$invoiceData['image'] = base_url('uploads/company/').$company['letter_head'];
				$invoiceData['extention'] = getFileExtension($company['letter_head']);
				$pdf->set($invoiceData);
		        $pdf->SetCreator(PDF_CREATOR);
		        $pdf->SetMargins(10, 35, 10);
		        $pdf->SetAuthor('Kava Developers');
		        $pdf->SetTitle($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id']);
		        $pdf->SetSubject('Receipt - #'.$invoice['invoice']);
		        $pdf->SetKeywords('PDF');
		        $pdf->SetFontSize(11);
		        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		        $pdf->AddPage();
		        $data['invoice'] = $invoice;
		        $html = $this->load->view('pdf/receipt',$data,true);
		        $pdf->writeHTML($html, true, false, true, false, '');
		        $pdf->Output($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id'].' '.$invoice['invoice'].'.pdf', 'D');
		    }
		    else{
	    		redirect(base_url('payment'));
	    	}
	    }else{
	    	redirect(base_url('payment'));
	    }
	}

	public function reimbursD($id = false)
	{
		if($id){
			if($this->general_model->_get_reimburs($id)){
				$invoice = $this->general_model->_get_reimburs($id);
				$client = $this->general_model->_get_client($invoice['client']);
				$company = $this->general_model->_get_company($invoice['company']);
				$pdf = new Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$invoiceData['image'] = base_url('uploads/company/').$company['letter_head'];
				$invoiceData['extention'] = getFileExtension($company['letter_head']);
				$pdf->set($invoiceData);
				$pdf->SetMargins(10, 35, 10);
		        $pdf->SetCreator(PDF_CREATOR);
		        $pdf->SetAuthor('Kava Developers');
		        $pdf->SetTitle($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id']);
		        $pdf->SetSubject('Reimburs');
		        $pdf->SetKeywords('PDF');
		        $pdf->SetFontSize(11);
		        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		        $pdf->AddPage();
		        $data['invoice'] = $invoice;
		        $html = $this->load->view('pdf/reimburs',$data,true);
		        $pdf->writeHTML($html, true, false, true, false, '');
		        $pdf->Output($client['fname'].' '.$client['mname'].' '.$client['lname'].' '.$client['c_id'].' Reimbursement.pdf', 'D');
		    }
		    else{
	    		redirect(base_url('reimburs'));
	    	}
	    }else{
	    	redirect(base_url('reimburs'));
	    }
	}

}
?>