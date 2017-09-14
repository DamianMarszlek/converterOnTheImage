<?php

/**
 * Class Enter
 */
 class Enter{

	/**
	* @var
	*/
 	private $_source;
 	private $_delimiter;

	/**
	* @param $source
	* @param $delimiter
	*/
 	public function __construct($source, $delimiter){
 		$this->_source = $source;
 		$this->_delimiter = $delimiter;
 	}

	/**
	* @return array|bool
	*/
 	public function getSource(){
 		if ($file = fopen($this->_source, "r")) {
		    $input = array();
		    
		    while(!feof($file)) {
		        $input[] = explode($this->_delimiter, fgets($file));
		    }

		    fclose($file);

		    return $input;
		} else{
			return false;
		}
 	}

 }