<?php
/**

 * ------------------------------------------------------------------
 * Globale Konstanten
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
$adminEMailAdresse		= "Mateusz.Scibor@uk-erlangen.de";
$administrator			= "Hr. Scibor";
$timestamp 				= $_SERVER['REQUEST_TIME'];
$datum 					= date("d.m.Y",$timestamp);
$uhrzeit 				= date("H:i",$timestamp);
$zeit   				= date('H:i');
$currentTime			= time(); 
$datumZeit				=  $datum . " - " . $uhrzeit . " Uhr";
$versionsNr				= '04';
$author					= 'R. Handschu';
$datumFreigabeZEA		= '08.06.2010';
$datumFreigabeGNV		= '01.07.2010';
$datumFreigabePL		= '10.07.2010';
$gueltigkeit			= '31.10.2011';
$diagnoseButton			= 'Anforderung'; 
$therapyButton			= 'Konsil&shy;empfehlung';
?>