<?php

 require_once './lib/EnterLib.php';
 require_once './lib/ImageTableLib.php';

 $oEnter = new Enter('./input/data.txt', '|');

 //import danych wejsciowych
 if(!$inputArray = $oEnter->getSource()){
 	die('Import file not found!');
 }

 $oImageTable = new ImageTable('./font/arial.ttf', 8, 0, $inputArray);

 //tworzenie obszaru roboczego
 $aImage = $oImageTable->createWorkingArea();

 //inicjalizacja kolorow
 $blackColor = $oImageTable->setColor($aImage, 0, 0, 0);
 $whiteColor = $oImageTable->setColor($aImage, 255, 255, 255);
 $blueColor = $oImageTable->setColor($aImage, 48, 135, 230);

 //kolorowanie tla
 $oImageTable->drawBackgroundRectangle($aImage, null, null, null, null, $whiteColor);

 //naglowek
 $oImageTable->drawHeader($aImage, $whiteColor, $blueColor);

 //rysowanie wierszy
 $oImageTable->drawRow($aImage, $inputArray, $blackColor, $blueColor);

 //dodanie watermarka
 $oImageTable->setWatermark($aImage);

 //Outputstream oraz sprzatanie
 header('Content-Type: image/png');
 imagepng($aImage);
 imagedestroy($aImage);
