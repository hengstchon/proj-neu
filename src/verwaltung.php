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
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
    if ($_SESSION['userID'] != '') {
        if ($x == 200) {
            $_SESSION['userID'] = '';
            $_SESSION['arztID'] = '';
            session_unset();
            session_destroy();
            $errMessageTitle = "";
            $errMessage = "Sie haben den gesch&uuml;tzten Arbeitsbereich verlassen";
            $errorCode = 1;
        } else {
            if ($x == 4110) {
                Login::saveLogin($userID, $userLogin, $userPW, $userEMail);
                $arzt = new Arzt();
                $arzt = $arzt->getArzt($arztID);
                $arzt->setArztGender($arztGender);
                $arzt->setAcadTitle($acadTitle);
                $arzt->setArztFirstName($arztFirstName);
                $arzt->setArztLastName($arztLastName);
                $arzt->setArztPhone($arztPhone);
                $arzt->setArztComment($arztComment);
                $arzt->setUserID($userID);
                $arzt->setClinicID($clinicID);
                $processInfo = $arzt->saveEntry_arzt($arzt);
            }
            $xWas = $_SESSION['xWas'];
            if ($xWas != $x) {
                setSavedEmpty();
            }
            $arztID = $_SESSION['arztID'];
            $doc = new Arzt();
            $arztInfos = $doc->getArztInfos($arztID);
            if (in_array($x, $printCases)) {
                ?>
                <div class="row text-right date d-print-inline d-print-only">
                    <div class="col-12">Datum: <?php echo $datum; ?></div>
                </div>
                <div class='row font-weight-light text-right d-print-inline'>
                    <div class='col-12'>Angemeldeter Arzt: <?php echo $arztInfos; ?> </div>
                </div>
                <?php
            }
            else
                {
                ?>
                <div class='row font-weight-light'>
                    <div class='col-8'>Angemeldet: <?php echo $arztInfos; ?></div>
                    <div class='col-4'>
                        <form method='post' action='<?php echo $url; ?>' class="mt-0 mb-0">
                            <input type='hidden' name='x' value='200'/>
                            <button class='btn btn-secondary p-0'>Abmelden</button>
                        </form>
                    </div>
                </div>
                <?php
                navigation();
            }
            if ($x == 100) {
                $arztLastName = getDBContent('aerzte', 'arztLastName', 'arztID', $arztID);
                if ($arztLastName == '') {
                    editArzt($_SESSION['arztID']);
                } else {
                    echo "<h2><img src='assets/imagesLayout/blinkenRot.gif' class='mr-2'> Offene Konsilschein-&Uuml;bersicht</h2>";
                    listAllPatientsRecords('o');
                }
            }
            if (($x >= 1000) and ($x < 9000)) {
                switch ($x) {
                    case 1000:
                    case 1010:
                    case 1015:
                    case 1020:
                    case 1025:
                    case 1030:
                    case 1033:
                    case 1035:
                    case 1100:
                        include("DMT/cases/1000erWeb.php");
                        break;
                    case 2000:
                    case 2100:
                    case 2200:
                        include("DMT/cases/2000er.php");
                        break;
                    case 3000:
                    case 3200:
                    case 3215:
                    case 3216:
                    case 3220:
                    case 3235:
                    case 3300:
                    case 3310:
                    case 3315:
                    case 3316:
                    case 3320:
                    case 3400:
                    case 3410:
                    case 3415:
                    case 3416:
                    case 3420:
                    case 3999:
                        include("DMT/cases/3000er.php");
                        break;
                    case 4000:
                    case 4110:
                    case 4200:
                    case 4210:
                        include("DMT/cases/4000erWeb.php");
                        break;
                }
            }
            $noTopLinkCases = array(100, 1000, 1020, 1033, 1035, 3000, 3310, 4000, 4110);
            if (!in_array($x, $noTopLinkCases)) {
                ?>
                <div class="row text-center d-print-none mt-5">
                    <div class="col-12">
                        <a href='#top' class='btn btn-outline-success m-auto'>Nach Oben</a></div>
                </div>
                <?php
            }
            if (!in_array($x, $noSearchCases)) {
                include_once($url_search);
                searchPatientMenu();
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
