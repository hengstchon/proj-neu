<?php
/**

 * ------------------------------------------------------------------
 * Content Switch of cases form 4000 - 4999
 * nur web
 * DMT ist different
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
switch ($x) {

    case 4000:
        editArzt($_SESSION['arztID']);
        // editArzt(1184);
        break;

    case 4110:
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
        foreach ($processInfo as $artzID => $errorMessages) {
            if (!empty($errorMessages)) {
                $cnt = count($errorMessages);
                $errMessageTitle = "Leider gab es ein Problem: $cnt Fehler";
                $errMessage = "Fall: Arztdaten speichern: " . $arztFirstName . " " . $arztLastName . "<br/>";
                $errMessage .= serialize($errorMessages) . "<br/>";
                $errorCode = 3;
            }
        }
        showArztWeb();
        break;
    case 4200:
        ?>
        <h2>Kontakt zum Administrator</h2>
        <fieldset>
            <form method='post' action='verwaltung.php'>
                <input type='hidden' name='x' value='4210'/>
                <p>Hier k&ouml;nnen Sie eine Nachricht an den
                    Administrator <?php echo $administrator; ?>
                    senden.</p>
                <label for="arztComment">Mitteilung:</label> <textarea name='arztComment'
                                                                       id='arztComment' cols='45'
                                                                       rows='5'></textarea>
                <p>Absender: <?php echo $arztInfos; ?></p>
                <input type='submit'
                       value='Anfrage an den Administrator <?php echo $administrator; ?> senden'
                       class='buttonHome'/>
            </form>
        </fieldset>
        <?php
        break;
    case 4210:
        $timestamp = $_SERVER['REQUEST_TIME'];
        $d_request = date("d.m.Y", $timestamp);
        $t_request = date("H:i:s", $timestamp);
        $requestTime = $d_request . " - " . $t_request . " Uhr";
        $requestInfos = array($requestTime, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $arztInfos, $arztComment);
        sendEmailAdmin($requestInfos);
        break;
}
