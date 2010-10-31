<?php

class tx_env_hooks_page {
	
	/**
	 * Add enable columns hook implementation
	 * 
	 * @param array $params
	 * @return string query part
	 * @author Fabrizio Branca <typo3@fabrizio-branca.de>
	 */
	public function addEnableColumns(array $params /*, t3lib_pageSelect $pObj */) {
		$queryPart = '';
		
		$envField = $params['ctrl']['enablecolumns']['environments']; 
		$currentEnvironment = $GLOBALS['environment'];
		
		if ($envField && !empty($currentEnvironment)) {
		
			$table = $params['table'];
			$currentEnvironment = $GLOBALS['TYPO3_DB']->quoteStr($currentEnvironment, $table);
			$envField = $GLOBALS['TYPO3_DB']->quoteStr($envField, $table);
			
			$queryPart .= ' AND ('.$envField.'="" OR FIND_IN_SET("'.$currentEnvironment.'", '.$envField.'))';
		}
		
		return $queryPart;
	}
	
}