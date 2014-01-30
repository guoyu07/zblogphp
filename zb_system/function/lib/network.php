<?php
/**
 * Z-Blog with PHP
 * @author 
 * @copyright (C) RainbowSoft Studio
 * @version 2.0 2013-06-14
 */

interface iNetwork
{

	
	public function abort();
	public function getAllResponseHeaders();
	public function getResponseHeader($bstrHeader);
	public function open($bstrMethod, $bstrUrl, $varAsync=true, $bstrUser='', $bstrPassword='');
	public function send($varBody='');
	public function setRequestHeader($bstrHeader, $bstrValue);

}

/**
* NetworkFactory
*/
class NetworkFactory 
{

	public $networktype = null;
	public $network_list = array();
	public $curl = false;
	public $fso = false;
	
	function __construct()
	{
		if (function_exists('curl_init'))
		{
			$network_list[] = 'curl';
			$this->curl = true;
		}
		
		if ((bool)ini_get('allow_url_fopen'))
		{
			if(function_exists('file_get_contents')) $network_list[] = 'file_get_contents';
			if(function_exists('fsockopen')) $network_list[] = 'fsockopen';
			$this->fso = true;
		}
		
		if ((!$this->fso) && (!$this->curl)) return false;
		$type = 'network'.$network_list[0];
		$network = New $type();
		return $network;
		
	}
	
	
}
