<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// define tx_env_env field
$tempColumns = Array (
	"tx_env_env" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:env/locallang_db.xml:tx_env_env",		
		"config" => Array (
			'type' => 'select',
			'size' => '5',
			'maxitems' => '20',
			'items' => array()
		)
	),
);

// add the available environments defined in the em settings to the field items
$baseConfArr = unserialize($TYPO3_CONF_VARS['EXT']['extConf']['env']);
if (!empty($baseConfArr['allEnvironments'])) {
	foreach (t3lib_div::trimExplode(',',$baseConfArr['allEnvironments']) as $env) {
		$tempColumns['tx_env_env']['config']['items'][] = array($env, $env);	
	}
}

// Tables listed here must have the sys_template field.
// Don't forget to add the field in ext_tables.sql if  you add a table here
$addEnvironmentToRecords = array('pages', 'tt_content', 'sys_template'); 

// add field to records
foreach ($addEnvironmentToRecords as $record) {
	t3lib_div::loadTCA($record);
	t3lib_extMgm::addTCAcolumns($record, $tempColumns, 1);
	t3lib_extMgm::addToAllTCAtypes($record,"--div--;LLL:EXT:env/locallang_db.xml:tab,tx_env_env;;;;1-1-1");
	$GLOBALS['TCA'][$record]['ctrl']['enablecolumns']['environments'] = 'tx_env_env';
}

?>