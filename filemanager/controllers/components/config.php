<?php
/**
 * Config component, to use in plugins so configuration files can be shipped with
 * plugins, instead of having to reside in CakePHPs app/config file. Basically a wrapper
 * for Cakes built in SessionComponent
 * 
 * @author        Richard Vanbergen <rich97@gmail.com>
 * @version       0.1 pre-alpha
 * @copyright     Copyright 2005-2008, Richard Vanbergen.
 */
class ConfigComponent extends Object
{

    private $__config = array();

    public function initialize()
    {
	$config = $this->__setConfig();
	Configure::write('Filemanager', $config);
    }
    
    private function __setConfig() {
	if(empty($this->__config)) {
	    if(file_exists($dir = APP . 'plugins' . DS . 'filemanager' . DS . 'config')) {
		$files = scandir($dir);
		foreach ($files as $file) {
		    if (substr($file, 0, 1) != '.') {
			if (is_file($include = $dir . DS . $file)) {
			    include $include;
			    $this->__config = Set::merge($config, $this->__config);
			}
		    }
		}
	    }
	}
	return $this->__config;
    }

}
?>