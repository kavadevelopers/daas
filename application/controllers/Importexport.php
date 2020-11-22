<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Importexport extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
		$this->load->model('import_model');
	}


	public function client()
	{
		$data['_title']		= "Import Client";
		$this->load->theme('importexport/client',$data);
	}

	public function import_client()
	{
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');


		if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();

			$totalRows = count($sheetData) - 4;
			$fileName = 'clients-backup.xlsx'; 
		    $spreadsheet = new Spreadsheet();
		    $sheet = $spreadsheet->getActiveSheet();
			if($totalRows > 0){

				unset($sheetData[0]);
				unset($sheetData[1]);
				unset($sheetData[2]);
				unset($sheetData[3]);


				$errorRows = 0; $importedRows = 0; 
				foreach ($sheetData as $key => $value) {

					$error = 0; $errorString = "";

					if($value[0] == ""){ $error++; $errorString .= "COLUMN-A FIRST NAME IS REQUIRED ,";}
					if($value[2] == ""){ $error++; $errorString .= "COLUMN-C LAST NAME IS REQUIRED ,"; }
					if($value[3] == ""){ $error++; $errorString .= "COLUMN-D GENDER IS REQUIRED ,"; }else{ if(!in_array($value[3], ['MALE','FEMALE','NONE'])){ $error++; $errorString .= "COLUMN-D PLEASE ENTER VALID GENDER ,"; } }
					if($value[4] == ""){ $error++; $errorString .= "COLUMN-E BRANCH IS REQUIRED ,";}else{ if(!$this->import_model->getBranch($value[4])){ $error++; $errorString .= "COLUMN-E BRANCH NOT FOUND ,"; } }
					if($value[5] == ""){ $error++;$errorString .= "COLUMN-F SOURCE IS REQUIRED ,"; }else{ if(!$this->import_model->getSource($value[5])){ $error++; $errorString .= "COLUMN-F SOURCE NOT FOUND ,";} }
					if($value[6] == ""){ $error++; $errorString .= "COLUMN-G CLIENT TYPE IS REQUIRED ,";}else{ if(!$this->import_model->getClientType($value[6])){ $error++; $errorString .= "COLUMN-G PLEASE ENTER VALID CLIENT TYPE ,";} }

					if($value[8] == ""){ $error++; $errorString .= "COLUMN-I MOBILE NO. IS REQUIRED ,";}
					if($value[10] == ""){ $error++; $errorString .= "COLUMN-K PAN NO. IS REQUIRED ,";}else if( strlen($value[10]) != "10" ){ $error++; $errorString .= "COLUMN-K PLEASE ENTER VALID PAN NO. ,"; }else if($this->import_model->getClientByPanCard($value[10])){ $error++; $errorString .= "COLUMN-K PAN NO. ALREADY EXISTS.. ,"; }
					if($value[11] == ""){ $error++; $errorString .= "COLUMN-L DOB IS REQUIRED ,";}
					if($this->import_model->getClientStatus($value[12]) == "1"){ $error++; $errorString .= "COLUMN-M PLEASE ENTER VALID CLIENT STATUS ,";}
					if($value[13] == ""){ $error++; $errorString .= "COLUMN-N ADDRESS 1 IS REQUIRED ,";}
					if($value[15] == ""){ $error++; $errorString .= "COLUMN-P AREA/VILLAGE IS REQUIRED ,";}else{ if(!$this->import_model->getArea($value[15])){ $error++; $errorString .= "COLUMN-P PLEASE ENTER VALID AREA/VILLAGE ,";} }
					if($value[16] == ""){ $error++; $errorString .= "COLUMN-Q CITY/TALUKA IS REQUIRED ,";}else{ if(!$this->import_model->getCity($value[16])){ $error++; $errorString .= "COLUMN-P PLEASE ENTER VALID CITY/TALUKA ,";} }
					if($value[17] == ""){ $error++; $errorString .= "COLUMN-R DISTRICT IS REQUIRED ,";}else{ if(!$this->import_model->getDistrict($value[17])){ $error++; $errorString .= "COLUMN-R PLEASE ENTER VALID DISTRICT ,";} }
					if($value[18] == ""){ $error++; $errorString .= "COLUMN-S STATE IS REQUIRED ,";}else{ if(!$this->import_model->getState($value[18])){ $error++; $errorString .= "COLUMN-S PLEASE ENTER VALID STATE ,";} }
					if($value[20] == ""){ $error++; $errorString .= "COLUMN-U OCCUPATION IS REQUIRED ,"; }else{ if(!in_array($value[20], ['BUSINESS','JOB','OTHER','BOTH'])){ $error++; $errorString .= "COLUMN-U PLEASE ENTER VALID OCCUPATION ,"; } }
					if($value[21] == ""){ $error++; $errorString .= "COLUMN-V LANGUAGE IS REQUIRED ,";}
					if($value[23] == ""){ $error++; $errorString .= "COLUMN-X HELTH INSURANCE IS REQUIRED ,"; }else{ if(!in_array($value[23], ['YES','NO'])){ $error++; $errorString .= "COLUMN-X PLEASE ENTER VALID HELTH INSURANCE ,"; } }

					if($value[24] == ""){ $error++; $errorString .= "COLUMN-Y LIFE INSURANCE IS REQUIRED ,"; }else{ if(!in_array($value[24], ['YES','NO'])){ $error++; $errorString .= "COLUMN-Y PLEASE ENTER VALID LIFE INSURANCE ,"; } }

					if($value[25] == ""){ $error++; $errorString .= "COLUMN-Z ITR CLIEN IS REQUIRED ,"; }else{ if(!in_array($value[25], ['YES','NO'])){ $error++; $errorString .= "COLUMN-Z PLEASE ENTER VALID ITR CLIENT ,"; } }

					if($value[26] == ""){ $error++; $errorString .= "COLUMN-AA GST CLIEN IS REQUIRED ,"; }else{ if(!in_array($value[26], ['YES','NO'])){ $error++; $errorString .= "COLUMN-AA PLEASE ENTER VALID GST CLIENT ,"; } }

					if($value[26] == "YES"){
						if($value[27] == ""){ $error++; $errorString .= "COLUMN-AB GST TYPE IS REQUIRED ,"; }else{ if(!in_array($value[27], ['COMPOSITION','REGULAR'])){ $error++; $errorString .= "COLUMN-AB PLEASE ENTER VALID GST TYPE ,"; } }
					}

					if($value[27] == "REGULAR"){
						if($value[28] == ""){ $error++; $errorString .= "COLUMN-AC MONTHLY/QUATERLY IS REQUIRED ,"; }else{ if(!in_array($value[28], ['MONTHLY','QUATERLY'])){ $error++; $errorString .= "COLUMN-AC PLEASE ENTER VALID MONTHLY/QUATERLY ,"; } }
					}
					$Industry = "";
					if($value[20] == "BUSINESS" || $value[20] == "BOTH"){
						$errInd = "";
						foreach (explode(';', $value[29]) as $indkey => $indvalue) {
							if(!$this->import_model->getIndustry($indvalue)){ $error++; $errInd = "COLUMN-AD PLEASE ENTER VALID INDUSTRY ,";} else{
								$Industry .= $this->import_model->getIndustry($indvalue)['id'].',';
							}
						}
						$errorString .= $errInd;
					}
					$subInd = "";
					if($value[20] == "BUSINESS" || $value[20] == "BOTH"){
						$errInd = "";
						foreach (explode(';', $value[30]) as $indkey => $indvalue) {
							if(!$this->import_model->getSubIndustry($indvalue)){ $error++; $errInd = "COLUMN-AD PLEASE ENTER VALID SUBINDUSTRY ,";} else{
								$subInd .= $this->import_model->getSubIndustry($indvalue)['id'].',';
							}
						}
						$errorString .= $errInd;
					}


					if($error > 0){
						$errorRows++;	
						$sheet->setCellValue('A'.$errorRows, $value[0]);
						$sheet->setCellValue('B'.$errorRows, $value[1]);
						$sheet->setCellValue('C'.$errorRows, $value[2]);
						$sheet->setCellValue('D'.$errorRows, $value[3]);
						$sheet->setCellValue('E'.$errorRows, $value[4]);
						$sheet->setCellValue('F'.$errorRows, $value[5]);
						$sheet->setCellValue('G'.$errorRows, $value[6]);
						$sheet->setCellValue('H'.$errorRows, $value[7]);
						$sheet->setCellValue('I'.$errorRows, $value[8]);
						$sheet->setCellValue('J'.$errorRows, $value[9]);
						$sheet->setCellValue('K'.$errorRows, $value[10]);
						$sheet->setCellValue('L'.$errorRows, $value[11]);
						$sheet->setCellValue('M'.$errorRows, $value[12]);
						$sheet->setCellValue('N'.$errorRows, $value[13]);
						$sheet->setCellValue('O'.$errorRows, $value[14]);
						$sheet->setCellValue('P'.$errorRows, $value[15]);
						$sheet->setCellValue('Q'.$errorRows, $value[16]);
						$sheet->setCellValue('R'.$errorRows, $value[17]);
						$sheet->setCellValue('S'.$errorRows, $value[18]);
						$sheet->setCellValue('T'.$errorRows, $value[19]);
						$sheet->setCellValue('U'.$errorRows, $value[20]);
						$sheet->setCellValue('V'.$errorRows, $value[21]);
						$sheet->setCellValue('W'.$errorRows, $value[22]);
						$sheet->setCellValue('X'.$errorRows, $value[23]);
						$sheet->setCellValue('Y'.$errorRows, $value[24]);
						$sheet->setCellValue('Z'.$errorRows, $value[25]);
						$sheet->setCellValue('AA'.$errorRows, $value[26]);
						$sheet->setCellValue('AB'.$errorRows, $value[27]);
						$sheet->setCellValue('AC'.$errorRows, $value[28]);
						$sheet->setCellValue('AD'.$errorRows, $value[29]);
						$sheet->setCellValue('AE'.$errorRows, $value[30]);
						$sheet->setCellValue('AF'.$errorRows, $value[31]);
						$sheet->setCellValue('AG'.$errorRows, $value[32]);
						$sheet->setCellValue('AH'.$errorRows, $value[33]);
						$sheet->setCellValue('AI'.$errorRows, $value[34]);
						$sheet->setCellValue('AJ'.$errorRows, $value[35]);
						$sheet->setCellValue('AK'.$errorRows, rtrim($errorString,","));
					}else{
						$importedRows++;

						$branch = $this->import_model->getBranch($value[4]);
						$source = $this->import_model->getSource($value[5]);
						$clientType = $this->import_model->getClientType($value[6]);
						$client_count = $this->db->get_where('client',['branch' => $branch['id']])->num_rows();

						$insertData = [
							'c_id'				=> $branch['code'].getClientId($client_count + 1),
							'branch'			=> $branch['id'],
							'source'			=> $source['id'],
							'company'			=> $source['company'],
							'client_type'		=> $clientType['id'],
							'fname'				=> strtoupper($value[0]),
							'gender'			=> strtoupper($value[3]),
							'mname'				=> $this->import_model->getNotRequired($value[1]),
							'lname'				=> strtoupper($value[2]),	
							'firm'				=> $this->import_model->getNotRequired($value[7]),	
							'mobile'			=> str_replace(';',',',$value[8]),	
							'email'				=> str_replace(';',',',$value[9]),	
							'pan'				=> strtoupper($value[10]),	
							'dob'				=> date('Y-m-d',strtotime($value[11])),	
							'status'			=> $this->import_model->getClientStatus($value[12]),
							'add1'				=> strtoupper($value[13]),
							'add2'				=> $this->import_model->getNotRequired($value[14]),
							'area'				=> $this->import_model->getArea($value[15])['id'],
							'city'				=> $this->import_model->getCity($value[16])['id'],
							'district'			=> $this->import_model->getDistrict($value[17])['id'],
							'state'				=> $this->import_model->getState($value[18])['id'],
							'pin'				=> $this->import_model->getNotRequired($value[19]),
							'occupation'		=> strtoupper($value[20]),
							'language'			=> str_replace(';',',',$value[21]),	
							'time_to_call'		=> $this->import_model->getNotRequired($value[22]),
							'health_in'			=> strtoupper($value[23]),
							'life_in'			=> strtoupper($value[24]),
							'itr_client'		=> strtoupper($value[25]),
							'gst_client'		=> strtoupper($value[26]),
							'gst_type'			=> $this->import_model->getNotRequired($value[27]),
							'month_quater'		=> $this->import_model->getNotRequired($value[28]),
							'industry'			=> rtrim($Industry,','),
							'sub_industry'		=> rtrim($subInd,','),
							'ind_remarks'		=> str_replace(';',',',$value[31]),
							'profile_intro'		=> $this->import_model->getNotRequired($value[32]),
							'turnover_notes'	=> $this->import_model->getNotRequired($value[33]),
							'goal'				=> $this->import_model->getNotRequired($value[34]),
							'quotation'			=> $this->import_model->getNotRequired($value[35]),
							'parent'			=> '',
							'contact_persons'	=> '',
							'refered_by'		=> '',
							'created_by'		=> get_user()['id'],
							'created_at'		=> date('Y-m-d H:i:s')
						];

						$this->db->insert('client',$insertData);
					}
				}
				if($totalRows == $importedRows){
					
					
					if(file_exists(FCPATH.'backup/clients-backup.xlsx')){
				    	@unlink(FCPATH.'backup/clients-backup.xlsx');
				    }
				    $this->session->set_flashdata('msg', 'All Data has been imported.');
	        		redirect(base_url('importexport/client'));	
				}else{
					
				    if(file_exists(FCPATH.'backup/clients-backup.xlsx')){
				    	@unlink(FCPATH.'backup/clients-backup.xlsx');
				    }
				    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
				    $writer->save("./backup/".$fileName);

				    
				    $this->session->set_flashdata('error', 'Total '.$totalRows.'/'. $importedRows.' Clients Imported. Check Error File.');
				    redirect(base_url('importexport/client'));	
				}

			}else{
				$this->session->set_flashdata('error', 'No Data Found in this file.');
	        	redirect(base_url('importexport/client'));	
			}
			

		}else{
			$this->session->set_flashdata('error', 'File Not Found.');
	        redirect(base_url('importexport/client'));
		}

	}


}