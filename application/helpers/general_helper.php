<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function pre_print($array)
{   
    echo count($array);
    echo "<pre>";
    print_r($array);
    exit;
}

function retJson($array){
    header("Content-type: application/json");
    echo json_encode($array);
}

function _vdatetime($datetime)
{
	return date('d-m-Y h:i A',strtotime($datetime));
}

function _sortdate($datetime)
{
    if($datetime!=""){
        return date('Ymd',strtotime($datetime));
    }else{
        return "";
    }
}

function vd($date)
{
    return date('d-m-Y',strtotime($date));
}

function dd($date)
{
    return date('Y-m-d',strtotime($date));
}


function dt($time){
    return date('H:i:s',strtotime($time));   
}

function vt($time){
    return date('h:i A',strtotime($time));   
}

function rs()
{
    return "₹ ";
}  

function getFileExtension($filename){
    return pathinfo($filename, PATHINFO_EXTENSION);
}

function get_setting()
{
	$ci=& get_instance();
    $ci->load->database();
    return $ci->db->get_where('setting',['id' => '1'])->row_array();
}

function get_user(){
	$ci=& get_instance();
    $ci->load->database();
    return $ci->db->get_where('user',['id' => $ci->session->userdata('id')])->row_array();	
}

function menu($seg,$array)
{
    $CI =& get_instance();
    $path = $CI->uri->segment($seg);
    foreach($array as $a)
    {
        if($path === $a)
        {
          return array("active","active","pcoded-trigger");
          break;  
        }
    }
}

function getCategoryThumb($file)
{
    if($file == ""){
        return base_url('uploads/category/thumbnail.png');
    }else{
        return base_url('uploads/category/').$file;
    }
}

function get_order($id){
    return $this->db->get_where('corder',['id' => $id])->row_array();
}

function get_customer($id){
    return $this->db->get_where('z_customer',['id' => $id])->row_array();
}

function get_delivery($id){
    return $this->db->get_where('z_delivery',['id' => $id])->row_array();
}

function get_service($id){
    return $this->db->get_where('z_service',['id' => $id])->row_array();
}

function sendPush($tokon,$title,$body,$type = '',$dy = ""){
    $url = "https://fcm.googleapis.com/fcm/send";
    $serverKey = get_setting()['fserverkey'];
    $arrayToSend = array('registration_ids' => $tokon,"priority" => "high",'data' => ['title' => $title,'body' => $body,'type' => $type,'dy' => $dy]);
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 0); 
    $result = curl_exec($ch);
    curl_close($ch);
}
?>