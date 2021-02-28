<?php if (!defined('BASEPATH'))     exit('No direct script access allowed');



if(!function_exists('tglPhpToDB'))
{
    function tglPhpToDB($tgl) 
    {
		if($tgl==''){
			$res='1900-01-01';
		}else{
			$arr=explode('/',$tgl);
			//var_dump($arr);//die();
			$res=$arr[2].'-'.$arr[1].'-'.$arr[0];
        }
		//var_dump($res);
		
		$res=str_replace(" ","",$res);
		//var_dump($res);
		return $res;
    }
}

if(!function_exists('tglDBToPhp'))
{
    function tglDBToPhp($tgl) 
    {
		if($tgl=='1900-01-01'){
			$res='';
		}elseif($tgl==''){
			$res='';
		}else{
			$arr=explode('-',$tgl);
			$res=$arr[2].'/'.$arr[1].'/'.$arr[0];
        }
		
		$res=str_replace(" ","",$res);
		
		return $res;
    }
}

if(!function_exists('formatDateTime'))
{
    function formatDateTime($datetime) 
    {
		return date('d/m/Y H:i',strtotime($datetime));
    }
}

if(!function_exists('formatDateFromDateTime'))
{
    function formatDateFromDateTime($datetime) 
    {
		return date('d/m/Y',strtotime($datetime));
    }
}

if(!function_exists('tglDBToPhp2'))
{
    function tglDBToPhp2($tgl) 
    {
		if($tgl=='1900-01-01'){
			$res='';
		}elseif($tgl==''){
			$res='';
		}else{
			//$arr=explode('-',$tgl);
			//$res=$arr[2].'-'.$arr[1].'-'.$arr[0];
			$res=date('d-M-Y',strtotime($tgl));
        }
		
		$res=str_replace(" ","",$res);
		
		return $res;
    }
}

if(!function_exists('cleanNumber'))
{
    function cleanNumber($number) 
    {
		if($number==''){
			$number='0';
		}
		$res=str_replace(",","",$number);
		
		return $res;
    }
}

if(!function_exists('bikin_kode'))
{
	function bikin_kode($ids){
		$ids=(int)$ids+1;
		if(strlen($ids)==1){
			$res='00000'.$ids;
		}elseif(strlen($ids)==2){
			$res='0000'.$ids;
		}elseif(strlen($ids)==3){
			$res='000'.$ids;
		}elseif(strlen($ids)==4){
			$res='00'.$ids;
		}elseif(strlen($ids)==5){
			$res='0'.$ids;
		}elseif(strlen($ids)==6){
			$res=''.$ids;
		}
		return $res;
	}
	
}

if(!function_exists('isnullNumber'))
{
    function isnullNumber($number) 
    {
		if($number==''){
			return '0';
		}else{
			return $number;
		}
    }
}

if(!function_exists('formatNomor'))
{
    function formatNomor($number) 
    {
		if($number==""){
			return "";
		}
		return number_format($number,0,',','.');
    }
}

if(!function_exists('formatNomor2'))
{
    function formatNomor2($number) 
    {
		if($number==""){
			return "";
		}
		return number_format($number,2,',','.');
    }
}

if(!function_exists('formatQty'))
{
    function formatQty($number) 
    {
		if($number==""){
			return "";
		}
		return number_format($number,0,',','.');
    }
}


if(!function_exists('formatQty2'))
{
    function formatQty2($number) 
    {
		return number_format($number,2);
    }
}


if(!function_exists('replaceMin'))
{
    function replaceMin($number) 
    {
		return str_replace('-','',$number);
    }
}

function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
 
function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

function kolom_header($str){
	$str=str_replace("_"," ",$str);
	$str=strtoupper($str);
	return $str;
}
	
function kolom_db($str){
	$str=strtolower($str);
	return $str;
}

function set_label($text = NULL)
{
	if($text)
	{
		$label = preg_replace('/_id$/', '', $text);
		$label = str_replace('_', ' ', $label);
		$label = ucwords($label);
	}
	else
	{
		$label = '';
	}
	
	return $label;
}
	
if(!function_exists('strip_validation_msg'))
{
    function strip_validation_msg($string){
		$string=str_replace('<p>','',validation_errors());
		$string=str_replace('</p>','',$string);
		return $string;
	}
}

if(!function_exists('clearDotNumber'))
{
    function clearDotNumber($string){
		$string=str_replace('.','',$string);
		return $string;
	}
}

if(!function_exists('cekJam'))
{
    function cekJam(){
		$jam=(int)date('H');
		if($jam>=0 && $jam<=3){
			return 'Malam';
		}else if($jam>=4 && $jam<=10){
			return 'Pagi';
		}else if($jam>=11 && $jam<=14){
			return 'Siang';
		}else if($jam>=15 && $jam<=18){
			return 'Sore';
		}else if($jam>=19 && $jam<=23){
			return 'Malam';
		}else{
			return '';
		}
	}
}


?>
