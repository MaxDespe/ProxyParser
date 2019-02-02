<?php  namespace ProxyManager;

use ProxyManager\ProxyController;
use ProxyManager\Checker\ProxyCheckerCore;
use ProxyManager\Controllers\SettingControlles;
use ProxyManager\Controllers\ListFileControllers;
use ProxyManager\Controllers\InputCheckControllers;
use ProxyManager\Controllers\MetothodSearchControllers;
use ProxyManager\Controllers\SearchParametrs\ApiParametrs;
use ProxyManager\Controllers\SearchParametrs\ParserParametrs;
use ProxyManager\Controllers\SearcherControllers;


class ProxyManager
{
	public static $LoadProxyValid;
	public static $DataCheckProxy;
	/**
	* @return string
	*/
    public static function initLoadProxyValid(){
		$DataFile = new ListFileControllers(SettingControlles::getDIRHoumeValid());
		$DataFile->setNameFile(SettingControlles::getFileNameValid());
		$ArrayData = array_diff($DataFile->getFileArray(), array(''));
		$CheckControllers = new InputCheckControllers();
		self::$LoadProxyValid = $CheckControllers->getOneCycleArrSetKey($ArrayData);
	}
	
	/**
	* @return string
	*/
    public static function getLoadProxyValid(){
		return  self::$LoadProxyValid;
	}
	
	/**
	* @return string
	*/
    public static function initDataCheckProxy($DataCheckProxy){
		$Url = "https://bot.shopvw.pw/ping.php";
		$proxyChecker = new ProxyCheckerCore($Url, SettingControlles::getChekersConfig());
		self::$DataCheckProxy = $proxyChecker->checkProxy($DataCheckProxy);
	}
	
	/**
	* @return string
	*/
    public static function getDataCheckProxy(){
		return  self::$DataCheckProxy;
	}
	
	/**
	* @return array
	*/
	public function __construct()
    {
	} 
	
	
	
}
?>