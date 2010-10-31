<?php

$baseConfArr = unserialize($TYPO3_CONF_VARS['EXT']['extConf']['env']);

if (!empty($baseConfArr['environment'])) {

	$GLOBALS['environment'] = $baseConfArr['environment']; 
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_page.php']['addEnableColumns'][] = 'EXT:env/hooks/class.tx_env_hooks_page.php:tx_env_hooks_page->addEnableColumns';
	
}