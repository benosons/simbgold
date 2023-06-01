<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class QSecure {
	/***********************************************************
	 **	function encrypt and decrypt get from :
	 **	http://www.webmasterworld.com/php/3086138.htm
	 **	@ neophyte
	 ***********************************************************/
	 
	function __construct()
	{
		//Get the CodeIgniter super object
		$this->ci =& get_Instance();
	}
	
	function encrypt($string) 
	{
		$key = $this->ci->config->item('encryption_key');
		$result = '';
		for($i=0; $i<strlen($string); $i++) 
		{
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		$result = base64_encode($result);
		$hasil1 = str_replace('=','-',$result);
		$hasil2 = str_replace('/','~',$hasil1);
		//$hasil3 = str_replace('\','%',$result);
		return $hasil2;
	}

	function decrypt($string) 
	{
		$key =  $this->ci->config->item('encryption_key');
		$result = '';
		$string1 = str_replace('-','=',$string);
		$string = str_replace('~','/',$string1);
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) 
		{
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	} 
}

/* End of file QSecure.php */
/* Location: ./application/libraries/QSecure.php */