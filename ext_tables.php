<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$tempColumns = Array (
	"tx_env_env" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:env/locallang_db.xml:tt_content.tx_env_env",		
		"config" => Array (
			"type" => "input",	
			"size" => "30",
		)
	),
);


t3lib_div::loadTCA("tt_content");
t3lib_extMgm::addTCAcolumns("tt_content",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("tt_content","--div--;LLL:EXT:env/locallang_db.xml:tab,tx_env_env;;;;1-1-1");

$GLOBALS['TCA']['tt_content']['ctrl']['enablecolumns']['environments'] = 'tx_env_env';

$tempColumns = Array (
	"tx_env_env" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:env/locallang_db.xml:pages.tx_env_env",		
		"config" => Array (
			"type" => "input",	
			"size" => "30",
		)
	),
);


t3lib_div::loadTCA("pages");
t3lib_extMgm::addTCAcolumns("pages",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("pages","--div--;LLL:EXT:env/locallang_db.xml:tab,tx_env_env;;;;1-1-1");

$GLOBALS['TCA']['pages']['ctrl']['enablecolumns']['environments'] = 'tx_env_env';

$baseConfArr = unserialize($TYPO3_CONF_VARS['EXT']['extConf']['env']);

if (!empty($baseConfArr['allEnvironments'])) {
	$fieldConfig = array(
		'type' => 'select',
		'size' => '5',
		'maxitems' => '20',
		'items' => array()
	);
	
	foreach (t3lib_div::trimExplode(',',$baseConfArr['allEnvironments']) as $env) {
		$fieldConfig['items'][] = array($env, $env);	
	}
	 
	$GLOBALS['TCA']['pages']['columns']['tx_env_env']['config'] = $fieldConfig;
	$GLOBALS['TCA']['tt_content']['columns']['tx_env_env']['config'] = $fieldConfig;
}

?>