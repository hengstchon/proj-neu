<?php
/**

 * ------------------------------------------------------------------
 * Content Switch of cases form 4000 - 4999
 * nur DMT
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
switch ($x) {


    case 4000:
        listAerzte();
        break;


    case 4100:
        editArzt($arztID);
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
        foreach ($processInfo as $ID => $errorMessages) {
            $arztID = $ID;
            if (!empty($errorMessages)) {
                echo "<h4>Leider trat ein Problem auf:</h4><ul>";
                foreach ($errorMessages as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
            }
        }
        listAerzte();
        break;
    case 4120:
        $arztID = 0;
        $userID = Login::saveLogin('', '', '', '');
        $arzt = new Arzt();
        $arzt->setUserID($userID);
        $arzt->setArztID($arztID);
        $addOption = $_SESSION['addOption'];
        if ($addOption == 0) {
            $processInfo = $arzt->saveEntry_arzt($arzt);
            foreach ($processInfo as $ID => $errorMessages) {
                $arztID = $ID;
                if (!empty($errorMessages)) {
                    echo "<h4>Leider trat ein Problem auf:</h4><ul>";
                    foreach ($errorMessages as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                }
            }
            if ($arztID != 0) editArzt($arztID);
        }
        break;
    case 4200:
        $doc = new Arzt();
        $arztInfos = $doc->getArztInfos($arztID);
        ?>
        <fieldset>
            <legend>L&ouml;schen</legend>
            <div class='row'>
                <p class='col-12'>L&ouml;sche Arzt-Eintrag: <?php echo $arztInfos; ?></p>
                <p class='col-12'>Hinweis: Es werden der Arzt-Eintrag und der entsprechende Login gel&ouml;scht
                    ohne die arztID aus den Patientendaten zu entfernen.</p>
            </div>
            <?php
            $addA[] = "<input type='hidden' name='arztID' value='$arztID'/>";
            smallButton($url, '4210', 'Ja, L&ouml;sche ' . $arztInfos, 'btn btn-danger mt-3 mb-3', $addA, '');
            smallButton($url, '4000', 'Abbrechen', 'btn btn-outline-info mt-3 mb-3', "", '');
            ?>
        </fieldset>
        <?php
        break;
    case 4210:
        $doc = new Arzt();
        $doc->deleteArzt($arztID);
        listAerzte();
        break;
}