<?php

 require_once './lib/HeaderLib.php';

/**
 * Class ImageTable
 */
 class ImageTable{

	/**
	* @var
	*/
 	private $_fontSource;
 	private $_fontSize;
 	private $_fontAngle;
 	private $_imageWidth;
 	private $_imageHeight;

 	private $_padding;

	private $_fuelIcon;
 	private $_waterMarkImage = './img/bg.png';

	/**
	* @param $fontSource
	* @param $fontSize
	* @param $fontAngle
	* @param $input
	* @param null $padding
	*/
 	public function __construct($fontSource, $fontSize, $fontAngle, $input, $padding = NULL){
 		$this->_fontSource = $fontSource;
 		$this->_fontSize = $fontSize;
 		$this->_fontAngle = $fontAngle;

		$padding === NULL?$this->_padding = 10:$this->_padding = $padding;

 		$this->_imageWidth = $this->setImageWidth();
 		$this->_imageHeight = $this->setImageHeigth($input);

		$this->_fuelIcon = array(
			'on' => './img/on_icon.jpg',
			'95' => './img/95_icon.jpg'
		);
 	}

	/**
	* @return resource
	*/
 	public function createWorkingArea(){
 		return imagecreatetruecolor($this->_imageWidth, $this->_imageHeight);
 	}

	/**
	* @return int
	*/
 	public function setImageWidth(){
 		$width = 0;
 		$oneCharacters = $this->calculateTextBox('m');
 		for ($i=0; $i < count(Header::$_header) ; $i++) { 
 			$proportion = Header::$_header[$i]['padding'] / $oneCharacters['width'];
 			$box = $this->calculateTextBox(Header::$_header[$i]['name']);
 			$width += Header::$_header[$i]['width'] = $box["width"] + ($proportion*$oneCharacters['width']*2);
 		};

 		return $width;
 	}

	/**
	* @param $input
	* @return mixed
	*/
 	public function setImageHeigth($input){
 		$height = $this->_fontSize + $this->_padding;
		foreach ($input as $row) {
			$lines = array();
			for ($i=0; $i < count($row) ; $i++) { 
				$lines[] =  count(explode("\n", wordwrap(trim(preg_replace('/\s+/', ' ', $row[$i])), $this->setBrakePoint($i), "\n")));
			}
			$height +=  max($lines) * ($this->_fontSize + $this->_padding);
		}

 		return $height;
	}

	/**
	* @param $image
	* @param $r
	* @param $g
	* @param $b
	* @return int
	*/
 	public function setColor($image, $r, $g, $b){
 		return imagecolorallocate($image, $r, $g, $b);
 	}

	/**
	* @param $image
	* @param $positionX
	* @param $positionY
	* @param $width
	* @param $height
	* @param $color
	*/
 	public function drawBackgroundRectangle($image, $positionX, $positionY, $width, $height, $color){
		$positionX === NULL?0:$positionX;
		$positionY === NULL?0:$positionY;
		$width === NULL?$width = $this->_imageWidth:$width;
		$height === NULL?$height = $this->_imageHeight:$height;
	
 		imagefilledrectangle($image, $positionX, $positionY, $width, $height, $color);
 	}

	/**
	* @param $index
	* @return float
	*/
 	public function setBrakePoint($index){
 		$oneCharacters = $this->calculateTextBox('m');

 		return ceil(Header::$_header[$index]['width'] / $oneCharacters['width'])*1.25;
 	}

	/**
	* @param $text
	* @return array
	*/
 	public function calculateTextBox($text){
 		$rect = imagettfbbox($this->_fontSize, $this->_fontAngle, $this->_fontSource, $text); 
	    $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6])); 
	    $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6])); 
	    $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7])); 
	    $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7])); 
	    
	    return array( 
	    	"left"   => abs($minX) - 1, 
     		"top"    => abs($minY) - 1,
	    	"width"  => $maxX - $minX, 
	    	"height" => $maxY - $minY, 
	    	"box"    => $rect 
	    ); 
 	}

	/**
	* @param $image
	* @param $color
	* @param $background
	*/
 	public function drawHeader($image, $color, $background){
		$prevColumnBox = 0;

		$this->drawBackgroundRectangle($image, null, null, null, $this->_fontSize + $this->_padding, $background);

 		foreach (Header::$_header as $column) {
 			$columnBox = imagettfbbox($this->_fontSize, $this->_fontAngle, $this->_fontSource, $column['name']);

 			$positionX = $prevColumnBox + $columnBox[0] + ($column['width'] / 2) - ($columnBox[4] / 2);
			$positionY = $this->_fontSize + $this->_padding/2;	
			
			imagettftext($image, $this->_fontSize, $this->_fontAngle, $positionX, $positionY, $color, $this->_fontSource, $column['name']);

 			$prevColumnBox += $column['width'];
 		}
 	}

	/**
	* @param $image
	* @param $input
	* @param $colorText
	* @param $colorLine
	*/
 	public function drawRow($image, $input, $colorText, $colorLine){
 		$rowPositionX = 0;
 		$rowPositionY = $this->_fontSize + $this->_padding;
 		foreach ($input as $row) {
 			$maxDeltaY = 0;
 			for ($i=0; $i < count($row); $i++) {
	 			$deltaY = 0;
	 			$text = explode("\n", wordwrap(trim(preg_replace('/\s+/', ' ', $row[$i])), $this->setBrakePoint($i), "\n"));

				foreach($text as $line) {
				    $dimensions = imagettfbbox($this->_fontSize, $this->_fontAngle, $this->_fontSource, $line);

					$positionX = $rowPositionX + $dimensions[0] + (Header::$_header[$i]['width'] / 2) - ($dimensions[4] / 2);
					$positionY = $rowPositionY + $this->_fontSize + $this->_padding/2;

					if($i == 0){
						imagettftext($image, $this->_fontSize, $this->_fontAngle, $positionX, $positionY + $deltaY, $colorText, $this->_fontSource, strtoupper($line));
					}elseif($i == 2){
                        $this->drawFuelIcon($image, $line, $rowPositionX + Header::$_header[$i]['width'] / 2, $rowPositionY);
					}else{
						imagettftext($image, $this->_fontSize, $this->_fontAngle, $positionX, $positionY + $deltaY, $colorText, $this->_fontSource, $line);	
					}

					$deltaY =  $deltaY + $this->_fontSize + $this->_padding;

					if($deltaY > $maxDeltaY){
						$maxDeltaY = $deltaY;
					}
				}
				$rowPositionX += Header::$_header[$i]['width'];	
 			}
 			$rowPositionX = 0;
			imageline($image, $rowPositionX, $rowPositionY, $this->_imageWidth, $rowPositionY, $colorLine);
			$rowPositionY += $maxDeltaY;
 		}

	}

	/**
	* @param $image
	* @param $fuel
	* @param $positionX
	* @param $positionY
	*/
	public function drawFuelIcon($image, $fuel,  $positionX, $positionY){
		$icon = imagecreatefromjpeg($this->_fuelIcon[strtolower($fuel)]);
	 	list($width, $height) = getimagesize($this->_fuelIcon[strtolower($fuel)]);

		 imagecopy($image, $icon,
			 $positionX - $width/2,
			 $positionY + $this->_padding/2,
			 0, 0, $width, $height
		 );
	}

	/**
	* @param $image
	*/
	public function setWatermark($image){
		$waterMart = imagecreatefrompng($this->_waterMarkImage);
		
		imagesettile($image, $waterMart);
		imagefilledrectangle($image, 0, 0, $this->_imageWidth, $this->_imageHeight, IMG_COLOR_TILED);
	}

 }

 