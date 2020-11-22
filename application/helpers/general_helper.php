<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function pre_print($array)
{   
    echo count($array);
    echo "<pre>";
    print_r($array);
    exit;
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

function followupVD($date)
{
    if($date != null){
        return vd($date);
    }else{
        return "NA";
    }
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

function get_sort_name($str,$length)
{
    if($str != "" && $str != null){
        return $str[$length - 1];
    }else{
        return "";
    }
}

function timeConverter($str){
    $arr = explode(":", $str);
    $new = "";
    foreach ($arr as $key => $value) {
        if($key != 0){
            $c = ":";
        }else{
            $c = "";
        }
        $value = trim($value,"_");
        if($value != ""){
            if(strlen($value) == 2){
                $new .= $c.$value;
            }else{
                $new .= $c."0".$value;
            }
        }else{
            $new .= $c."00";
        }
    }
    return dt($new);
}

function get_from_to($from,$to){
    $ret = "";
    if(!empty($from)){
        $ret .= "<br><small>".vt($from);
    }else{
        $ret .= "<br><small> NA ";
    }

    if(!empty($to)){
        $ret .= " - ".vt($to)."</small>";
    }else{
        $ret .= " - NA"."</small>";
    }

    return $ret;
}

function get_from_to_wbr($from,$to){
    $ret = "";
    if(!empty($from)){
        $ret .= "<small>".vt($from);
    }else{
        $ret .= "<small> NA ";
    }

    if(!empty($to)){
        $ret .= " - ".vt($to)."</small>";
    }else{
        $ret .= " - NA"."</small>";
    }

    return $ret;
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

function user_type(){
    if(get_user()['user_type'] == '2'){
        if(get_user()['type'] == '1'){
            return "Manager";
        }else if(get_user()['type'] == '2'){
            return "Senior";
        }else{
            return "Junior";
        }
    }else if(get_user()['user_type'] == '3'){
        if(get_user()['type'] == '1'){
            return "Field Sales";
        }else if(get_user()['type'] == '2'){
            return "Tele Sales";
        }else if(get_user()['type'] == '3'){
            return "Freelance Sales";
        }else{
            return "Admin Tele Sales";
        }
    }   
}

function _user_type($id){
    $ci=& get_instance();
    $ci->load->database();
    $user = $ci->db->get_where('user',['id' => $id])->row_array();  

    if($user['user_type'] == '2'){
        if($user['type'] == '1'){
            return "Manager";
        }else if($user['type'] == '2'){
            return "Senior";
        }else{
            return "Junior";
        }
    }else if($user['user_type'] == '3'){
        if($user['type'] == '1'){
            return "Field Sales";
        }else if($user['type'] == '2'){
            return "Tele Sales";
        }else if($user['type'] == '3'){
            return "Freelance Sales";
        }else{
            return "Admin Tele Sales";
        }
    }   
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

function getRole($type){
    if($type == 0){
        return "Super Admin";
    }else if($type == 1){
        return "Admin";
    }else if($type == 2){
        return "Back Office";
    }else if($type == 3){
        return "Sales Person";
    }
}

function getjobStatus($s){
    if($s == "0"){
        return "WORK PENDING";
    }else if($s == "1"){
        return "DOCUMENTS RECEIVED";
    }else if($s == "2"){
        return "WORK IN PROGRESS";
    }else if($s == "3"){
        return "WORK DONE";
    }else if($s == "4"){
        return "BILLED";
    }else{
        return "PAID";
    }
}

function getjobStatusList(){
    return [
        '0' => "WORK PENDING",
        '1' => "DOCUMENTS RECEIVED",
        '2' => "WORK IN PROGRESS",
        '3' => "WORK DONE",
        '4' => "BILLED",
        '5' => "PAID"
    ];
}

function daysBeetweenDates($date){
    $now = time();
    $your_date = strtotime($date);
    $datediff = $now - $your_date;
    return round($datediff / (60 * 60 * 24)) - 1;
}

function invoice()
{
    return "1";
}

function payment()
{
    return "2";
}

function referal()
{
    return "3";
}

function opening()
{
    return "4";
}

function reimbursement()
{
    return "5";
}

function typestring($str){
    if($str == 1){
        return "Invoice";
    }else if($str == 2){
        return "Receipt";
    }else if($str == 3){
        return "Referal Amount";
    }else if($str == 5){
        return "Reimbursement Amount";
    }
}

function ledamtd($debit,$credit){
    if($credit == 0){
        return "";
    }
    else{
        return moneyFormatIndia($credit);   
    }
}

function ledamtc($debit,$credit){
    if($debit == 0){
        return "";
    }
    else{
        return moneyFormatIndia($debit);   
    }
}

function tledamtd($debit,$credit){
    if($credit == 0){
        return 0;
    }
    else{
        return $credit;   
    }
}

function tledamtc($debit,$credit){
    if($debit == 0){
        return 0;
    }
    else{
        return $debit;   
    }
}

function vch_no($type,$tra_id)
{   
    $CI =& get_instance();
    if($type == "1"){
        $invoice = $CI->db->get_where('invoice',['id' => $tra_id])->row_array();
        return '<a href="'.base_url('pdf/invoice/').$invoice['id'].'" target="_blank">'.$invoice['inv'].'<a>';
    }else if($type == "2"){
        $invoice = $CI->db->get_where('payment',['id' => $tra_id])->row_array();
        return '<a href="'.base_url('pdf/receipt/').$invoice['id'].'" target="_blank">'.$invoice['invoice'].'<a>';
    }else if($type == "5"){
        $invoice = $CI->db->get_where('reimbursement',['id' => $tra_id])->row_array();
        return '<a href="'.base_url('pdf/reimburs/').$invoice['id'].'" target="_blank">'.$invoice['id'].'<a>';
    }
}

function moneyFormatIndia($amount): string {
    list ($number, $decimal) = explode('.', sprintf('%.2f', floatval($amount)));

    $sign = $number < 0 ? '-' : '';

    $number = abs($number);

    for ($i = 3; $i < strlen($number); $i += 3)
    {
        $number = substr_replace($number, ',', -$i, 0);
    }

    return $sign . $number . '.' . $decimal;
}

function selected($val,$val2,$val3 = false){
    $ret = "";
    if($val == $val2){
        $ret = "selected";
    }

    if($val3 && $ret == ''){
        if($val == $val3){
            $ret = "selected";       
        }
    }
    return $ret;
}

function getClientId($num){
    if(strlen($num) == 1)
    {
        return "0000".$num;
    }else if(strlen($num) == 2)
    {
        return "000".$num;
    }else if(strlen($num) == 3)
    {
        return "00".$num;
    }else if(strlen($num) == 4)
    {
        return "0".$num;
    }else {
        return $num;
    }
}   

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>