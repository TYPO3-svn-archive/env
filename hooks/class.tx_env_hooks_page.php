<?php

class tx_env_hooks_page {
	
	/**
	 * Add enable columns hook implementation
	 * 
	 * @param array $params
	 * @return string query part
	 */
	public function addEnableColumns(array $params /*, $pObj */) {
		$queryPart = '';
		
		$envField = $params['ctrl']['enablecolumns']['environments']; 
		$currentEnvironment = $GLOBALS['environment'];
		
		if ($envField && !empty($currentEnvironment)) {
			$queryPart .= ' AND ('.$envField.'="" OR FIND_IN_SET("'.$currentEnvironment.'", '.$envField.'))';
		}
		
		return $queryPart;
	}
	
}