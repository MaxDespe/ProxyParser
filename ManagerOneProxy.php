<?php require_once __DIR__ . '/vendor/autoload.php';

use ProxyManager\ProxyController;
use ProxyManager\ProxyManager;

$MetothodSearchconfig = [
	'MetothodSearch'    => ['APISearcher'],
];

$ProxyController = new ProxyController($MetothodSearchconfig);
$LoadProxyValid = ProxyManager::getLoadProxyValid();
// $CheckFilesSearchers = $ProxyController->setCheckFilesSearchers();
// $setProcesChekers = $ProxyController->setProcesChekers();
echo "<pre>"; print_r($LoadProxyValid);	echo "</pre>";
