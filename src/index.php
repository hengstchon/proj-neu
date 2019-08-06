<?php
/**

 * ------------------------------------------------------------------
 * Start of Web App
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
$encoding = mb_internal_encoding("iso-8859-1");
mb_http_output("iso-8859-1");
session_set_cookie_params(3600);// einstellen auf 3600 = 60 Minuten
session_start();
$case = 'web';
$dmt = 0;

include_once("DMT/includes.php");

$errorCode = 0;
$errMessageTitle = "";
$errMessage = "";
$errorMessageDefault = <<<MSG
<p class='errorMessage'>Die von Ihnen eingegebene Benutzername und Passwort Kombination existiert nicht.
Bitte wenden Sie sich direkt an $administrator.</p>
MSG;
include_once("html_head.php");
if ($x == 10) {
    if ($userLogin != '') {
        sendEmailNewLogin($userLogin, $userPW);
    } else {
        $errorCode = 1;
    }
} else {
    if ($x == 20) {
        if (($userEMail == 'neuerArztLogin') AND ($userLogin != '')) {
            $userLogin = replaceSpecialCharacters($userLogin);
            $userPW = $userLogin . date('Y');
            $login = new Login();
            $userID = $login->insertLogin($userLogin, $userPW);
            if ($userID == "") {
                echo "
                    <h4>Fehler</h4>
                    <p class='errorMessage'>Leider gabe es ein Problem beim Erstellen eines Logins. Bitte versuchen Sie es sp&auml;ter erneut.</p>
                    ";
            } else {
                $arzt = new Arzt();
                $arzt->setArztLastName($userLogin);
                $arzt->setUserID($userID);
                $processInfo = $arzt->saveEntry_arzt($arzt);
                foreach ($processInfo as $artzID => $errorMessages) {
                    if (!empty($errorMessages)) {
                        $cnt = count($errorMessages);
                        $errMessageTitle = "Leider gab es ein Problem: $cnt Fehler";
                        $errMessage = "Fall: Neuen Arzt anlegen: " . $userLogin;
                        $errMessage .= serialize($errorMessages);
                        $errorCode = 1;
                        $timestamp = $_SERVER['REQUEST_TIME'];
                        $d_request = date("d.m.Y", $timestamp);
                        $t_request = date("H:i:s", $timestamp);
                        $requestTime = $d_request . " - " . $t_request . " Uhr";
                        $requestInfos = array($requestTime, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], "Fehler", $errMessage);
                        sendEmailAdmin($requestInfos);
                    } else {
                        echo "
                        <h4>Fertig</h4>
                        <p>Der neue Login '$userLogin' wurde angelegt.</p>
                        ";
                        sendEmailNewLogin($userLogin, $userPW);
                    }
                }
            }
        } else {
            $errorCode = 1;
        }
    } else {
        if (!isset($_SESSION['userID'])) {
            if (!isset($userLogin) || $userLogin == '') {
                $errorCode = 1;
            } else {
                if (isset($userLogin) && $userLogin != '' && $x == 100) {
                    $checkLogin = new Login();
                    $pw = $checkLogin->getLogin_PW($userLogin);
                    if ($pw != '') {
                        if ($pw == $userPW) {
                            setSavedEmpty();
                            $userID = $checkLogin->getLogin_UserID($userLogin);
                            $_SESSION['userID'] = $userID;
                            $arztID = getDBContent('aerzte', 'arztID', 'userID', $userID);
                            $_SESSION['arztID'] = $arztID;
                            if ($userLogin == 'notfall') {
                                $timestamp = $_SERVER['REQUEST_TIME'];
                                $d_request = date("d.m.Y", $timestamp);
                                $t_request = date("H:i:s", $timestamp);
                                $requestTime = $d_request . " - " . $t_request . " Uhr";
                                $requestInfos = array($requestTime, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
                                sendEmailLoginNotfall($requestInfos);
                            }
                        } else {
                            $errMessageTitle = "Login-Fehlermeldung: 1";
                            $errMessage = $errorMessageDefault;
                            $errorCode = 1;
                        }
                    } else {
                        $errMessageTitle = "Login-Fehlermeldung: 2";
                        $errMessage = $errorMessageDefault;
                        $errorCode = 1;
                    }
                }
            }
        }
    }
}

if ($errorCode != 0) {
    if ($errMessageTitle != "" || $errMessage != "") {
        ?>
        <div class="row mt-1">
            <div class="col-12">
                <?php if ($errMessageTitle != "") echo "<h4>$errMessageTitle</h4>"; ?>
                <p class='btn-outline-warning p-1'><?php echo $errMessage; ?></p>
            </div>
        </div>
        <?php
    }
    if ($errorCode == 1) {
        ?>
        <div class="row mt-1">
            <div class="col-12">
                <?php
                include($baseURL . "DMT/helpers/login.php");
                ?>
            </div>
        </div>
        <?php
    }
}
include("html_end.php");
