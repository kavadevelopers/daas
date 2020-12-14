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

function checkSubscriptionExpiration($expireDate)
{
    if($expireDate == NULL){
        return "expired";
    }else{
        $date1 = strtotime($expireDate);
        if($date1 >= strtotime(date('Y-m-d'))){
            return 'active';
        }else{
            return 'expired';
        }
    }
}

function getTommorrow()
{
    return date('Y-m-d',strtotime("-1 day",strtotime(date('Y-m-d'))));
}

function vd($date)
{
    return date('d-m-Y',strtotime($date));
}

function vfd($date)
{
    return date('F d, Y',strtotime($date));
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

function getPretyDateTime($date)
{
    return date('d M Y h:i A',strtotime($date));
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
    $CI =& get_instance();
    return $CI->db->get_where('corder',['id' => $id])->row_array();
}

function get_customer($id){
    $CI =& get_instance();
    return $CI->db->get_where('z_customer',['id' => $id])->row_array();
}

function get_delivery($id){
    $CI =& get_instance();
    return $CI->db->get_where('z_delivery',['id' => $id])->row_array();
}

function get_service($id){
    $CI =& get_instance();
    return $CI->db->get_where('z_service',['id' => $id])->row_array();
}

function get_category($id){
    $CI =& get_instance();
    $cat = $CI->db->get_where('business_categories',['id' => $id])->row_array();
    if($cat){
        return $cat;
    }else{
        return ['name' => ''];
    }
}

function _get_category($id){
    $CI =& get_instance();
    return $CI->db->get_where('business_categories',['id' => $id])->row_array();
}

function getServiceProviders()
{
    $CI =& get_instance();
    return $CI->db->get_where('z_service',['verified' => 'Verified','df' => '','block' => '','approved' => '1','token !=' => '','active' => '1'])->result_array();
}

function sendPush($tokon,$title,$body,$type = '',$dy = ""){
    $url = "https://fcm.googleapis.com/fcm/send";
    $serverKey = get_setting()['fserverkey'];
    if(getDeviceType($tokon) == "ios"){
        $notification = array('title' => $title, 'body' => $body,'sound' => 'default','badge' => '0');
        $arrayToSend = array('registration_ids' => $tokon,"priority" => "high","notification" => $notification,'data' => ['title' => $title,'body' => $body,'type' => $type,'dy' => $dy]);
    }else{
        $arrayToSend = array('registration_ids' => $tokon,"priority" => "high",'data' => ['title' => $title,'body' => $body,'type' => $type,'dy' => $dy]);
    }
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    //pre_print($arrayToSend);
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

function sendOtp($mobile,$otp){
    $url    = "https://2factor.in/API/V1/";
    $ApiKey = get_setting()['twofecturekey'];
    $url    .= $ApiKey.'/SMS/'.$mobile.'/'.$otp.'/MrDaas';
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    //pre_print($arrayToSend);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 0); 
    $result = curl_exec($ch);
    curl_close($ch);
}


function sendChatPush($tokon,$title,$body,$sender,$reciver,$sender_type,$receiver_type,$order_id){
    $url = "https://fcm.googleapis.com/fcm/send";
    $serverKey = get_setting()['fserverkey'];
    if(getDeviceType($tokon) == "ios"){
        $notification = array('title' => $title, 'body' => $body,'sound' => 'default','badge' => '0');
        $arrayToSend = array('registration_ids' => [$tokon],"priority" => "high","notification" => $notification,'data' => ['title' => $title,'body' => $body,'sender' => $sender,'reciver' => $reciver,'sender_type' => $sender_type,'receiver_type' => $receiver_type,'order_id' => $order_id,'type' => 'chat','dy' => $order_id]);
    }else{
        $arrayToSend = array('registration_ids' => [$tokon],"priority" => "high",'data' => ['title' => $title,'body' => $body,'sender' => $sender,'reciver' => $reciver,'sender_type' => $sender_type,'receiver_type' => $receiver_type,'order_id' => $order_id,'type' => 'chat','dy' => $order_id]);
    }
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


function sendEmail($to,$sub,$msg)
{
    $CI =& get_instance();
    $CI->load->library('email');
    $config = array(
        'protocol'      => 'SMTP',
        'smtp_host' => get_setting()['mail_host'],
        'smtp_port' => get_setting()['mail_port'],
        'smtp_user' => get_setting()['mail_username'],
        'smtp_pass' => get_setting()['mail_pass'],
        'mailtype'      => 'html',
        'charset'       => 'utf-8'
    );
    $CI->email->initialize($config);
    $CI->email->set_mailtype("html");
    $CI->email->set_newline("\r\n");
    $CI->email->to($to);
    $CI->email->from(get_setting()['mail_username']);
    $CI->email->subject($sub);
    $CI->email->message($msg);
    if($CI->email->send()){
        //echo "ok";
    }else{
        //echo $CI->email->print_debugger();
    }
}

function getDeviceType($token)
{
    $token = $token[0];
    $CI =& get_instance();
    $customer = $CI->db->get_where('z_customer',['token' => $token])->row_array();
    $delivery = $CI->db->get_where('z_delivery',['token' => $token])->row_array();
    $service = $CI->db->get_where('z_service',['token' => $token])->row_array();
    if($customer){
        return $customer['deviceid'];
    }else if($delivery){
        return $delivery['deviceid'];
    }else if($service){
        return $service['deviceid'];
    }else{
        return "";
    }
}

?>