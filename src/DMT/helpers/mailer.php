<?php
/**

 * ------------------------------------------------------------------
 * E-Mail Sender Functions
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


function sendEmailNewLogin($userLogin, $userPW) {
    global $administrator,  $adminEMailAdresse, $baseURL;
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        $timestamp	= date('d.m.y H:i');
        $message 		= "<html><head></head><body>";
        $message		.= "<p align='right'>Erlangen, den $timestamp</p>";
        $message		.= "<h2>Schlaganfall-Netzwerk mit Telemedizin in Nordbayern</h2>";
        $message		.= "<p>Im Folgenden finden Sie f&uuml;r $userLogin die Zugangsdaten zum Konsilschein - Telekonsil:</b> <br>";
        $message		.= "Name: $userLogin <br>";
        $message		.= "PW: $userPW </p>";
        $message		.= "<p>Diese Daten k&ouml;nnen jederzeit nach dem Login unter >Eigenes Arzt-Profil< ge&auml;ndert werden. </p>";
        $message		.= "Automatisches Email aus dem PDVS<br>";
        $message		.= "Universit&auml;tsklinikum Erlangen";
        $message		.= "</body></html>";
        $headers		= 'MIME-Version: 1.0' . "\r\n";
        $headers		.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers		.= 'From: ' . $adminEMailAdresse . "\r\n";
        $subject		= 'Telekonsil - New Login - ' .  $userLogin;
        if (@mail($adminEMailAdresse, $subject, $message, $headers) == true){
            print "<p class='erfolgsMessage'>Die Zugangsdaten wurden erfolgreich an den $administrator versandt!</p>";
            print "<p class='erfolgsMessage'>Bitte wenden Sie sich an ihn.</p>";
            print "<p class='erfolgsMessage'>Die Daten k&ouml;nnen jederzeit nach dem Login unter >Eigenes Arzt-Profil< ge&auml;ndert werden. </p>";
        }
        include($baseURL . "helpers/login.php");
    }
}

function sendEmailLoginNotfall($requestInfos) {
    global  $adminEMailAdresse;
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        $timestamp	= date('d.m.y H:i');
        $info1	= $requestInfos[0];
        $info2	= $requestInfos[1];
        $info3	= $requestInfos[2];
        $message 		= "<html><head></head><body>";
        $message		.= "<p align='right'>Erlangen, den $timestamp</p>";
        $message		.= "<h2>Schlaganfall-Netzwerk mit Telemedizin in Nordbayern</h2>";
        $message		.= "<p>Es wurde der Login >Notfall< benutzt. <br>Request time: $info1 <br>IP: $info2 <br>User Agent: $info3</p>";
        $message		.= "Automatisches Email aus dem PDVS<br>";
        $message		.= "Universit&auml;tsklinikum Erlangen";
        $message		.= "</body></html>";
        $headers		= 'MIME-Version: 1.0' . "\r\n";
        $headers		.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers		.= 'From: ' . $adminEMailAdresse . "\r\n";
        if (@mail($adminEMailAdresse, 'Telekonsil - Noftall-Login benutzt ', $message, $headers) == true){
        } else {
        }
    }
}

function sendEmailAdmin($requestInfos) {
    global  $adminEMailAdresse;
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        $timestamp	= date('d.m.y H:i');
        $info1	= $requestInfos[0];
        $info2	= $requestInfos[1];
        $info3	= $requestInfos[2];
        $info4	= $requestInfos[3];
        $info5	= $requestInfos[4];
        $message = "
		<html>
		<head>
		</head>
		<body>
		";
        $message		.= "<p align='right'>Erlangen, den $timestamp</p>";
        $message		.= "<h2>Schlaganfall-Netzwerk mit Telemedizin in Nordbayern</h2>";
        $message		.= "<p>Anfrage an den Administrator von: $info4 <br>";
        $message		.= "Mitteilung: $info5";
        $message		.= "<br>";
        $message		.= "Request time: $info1 <br>IP: $info2 <br>User Agent: $info3</p>";
        $message		.= "Automatisches Email aus dem PDVS<br>";
        $message		.= "Universit&auml;tsklinikum Erlangen";
        $message		.= "</body></html>";
        $headers		= 'MIME-Version: 1.0' . "\r\n";
        $headers		.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers		.= 'From: ' . $adminEMailAdresse . "\r\n";
        if (@mail($adminEMailAdresse, 'Telekonsil - Frage zum PDVS ', $message, $headers) == true){
            print "<p class='erfolgsMessage'>Ihre Mitteilung: <br>'$info5'<br> wurde erfolgreich versandt!</p>";
        } else {
        }
    }
}
