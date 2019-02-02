<?php require_once __DIR__ . '/vendor/autoload.php';

use ProxyManager\ProxyController;
use ProxyManager\ProxyManager;

$MetothodSearchconfig = [
	'MetothodSearch'    => ['APISearcher'],
];
//$ProxyManager = new ProxyManager($MetothodSearchconfig);
//$SettingControlles = $ProxyManager->setSettingControlles();
$ProxyController = new ProxyController();
$CheckFilesSearchers = $ProxyController->setCheckFilesSearchers();
$setProcesChekers = $ProxyController->setProcesChekers();
echo "<pre>"; print_r($ProxyController);	echo "</pre>";
echo "<pre>"; print_r($setProcesChekers);	echo "</pre>";
echo "<pre>"; print_r($CheckFilesSearchers);	echo "</pre>";