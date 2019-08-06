<?php
/**

 * ------------------------------------------------------------------
 * Patienten Navigation Buttons, NIHSS Administration
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


/**
 * @method viewblock_case3215
 * @description
 *
 * @param $patientID
 * @param $pnID
 * @internal param $url_nihss
 */

function viewBlock_Patient_NIHSS($patientID, $pnID)
{
    ?>
    <fieldset>
        <?php
        showPatientNameBDay($patientID, false, 'legend');
        showPatientNIHSSWerte($pnID);
        ?>
    </fieldset>
    <?php
}

function editNIHSSForm($patientID, $pnID)
{
    global $url;
    $patientRecordID = getDBContent('patientNIHSS', 'patientRecordID', 'pnID', $pnID);
    $editStatus = getDBContent('patientRecords', 'editStatus', 'patientRecordID', $patientRecordID);
    ($editStatus == 't') ? $buttonClass = 'btn btn-outline-primary' : $buttonClass = 'btn btn-primary';
    $addInput[] = "<input type='hidden' name='patientID' value='$patientID' />";
    $addInput[] = "<input type='hidden' name='pnID' value='$pnID' />";
    smallButton($url, '3200', 'NIHSS (id: ' . $pnID . ')', $buttonClass, $addInput, '');
}

function editPatientNIHSSWerte($pnID)
{
    global $url;
    $patientID = getDBContent('patientNIHSS', 'patientID', 'pnID', $pnID);
    $arztID = getDBContent('patientNIHSS', 'arztID', 'pnID', $pnID);
    $arzt = new Arzt();
    $arztInfos = $arzt->getArztInfos($arztID);
    $time = getDBContent('patientNIHSS', 'timeNIHSS', 'pnID', $pnID);
    $time = strtotime($time);
    $time = date("d.m.Y. H:i", $time) . ' Uhr';
    $nr = 1;
    $connection = new Access();
    $access = $connection->connectDB();
    echo " <hr>NIHSS (id: $pnID) Arzt: $arztInfos, Datum: $time <hr>";
    if ($access) {
        $db_request1 = "SELECT  nihssStepName, nihssStepText, cameraInfo, assistenzInfo, nihssStepID, posNIHSSoriginal FROM docuNIHSS ORDER by posTelekonsil  ";
        $query_handle1 = mysqli_query($access, $db_request1);
        if ($query_handle1 != "") {
            ?>
            <form method='post' action='<?php echo $url; ?>'>
                <input type='hidden' name='x' value='3235'/>
                <input type='hidden' name='pnID' value='<?php echo $pnID; ?>'/>
                <input type='hidden' name='patientID' value='<?php echo $patientID; ?>'/>
                <?php
                $rows1 = mysqli_num_rows($query_handle1);
                for ($i1 = 0; $i1 < $rows1; $i1++) {
                    $data1 = mysqli_fetch_row($query_handle1);
                    $name = $data1[0];
                    $text = $data1[1];
                    $camera = $data1[2];
                    $assitenz = $data1[3];
                    $nihssStepID = $data1[4];
                    $posNIHSSoriginal = $data1[5];
                    ?>
                    <div class="row">
                        <div class='col-12'>
                            <h2>
                                <?php
                                if ($posNIHSSoriginal != '') {
                                    echo "$posNIHSSoriginal. ";
                                }
                                echo "$name";
                                ?>
                            </h2>
                            <?php
                            if ($text != '') echo "<p>$text</p>";
                            ?>
                        </div>
                    </div>
                    <div class="row font-weight-bold">
                        <div class='col-sm-6'>Kameraeinstellung:</div>
                        <div class='col-sm-6'>
                            <?php
                            if ($camera == 'z') echo "Naheinstellung ";
                            if ($camera == 'w') echo "&Uuml;bersicht ";
                            if ($assitenz == 'j') echo ", Assitenz n&ouml;tig";
                            ?>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <?php
                        $db_request2 = "SELECT eigenschaftID, eigenschaftName, eigenschaftText, bewertungsType, wert1, wert2 FROM docuNIHSSdetails  WHERE nihssStepID ='$nihssStepID'  ";
                        $query_handle2 = mysqli_query($access, $db_request2);
                        if ($query_handle2 != "") {
                            $rows2 = mysqli_num_rows($query_handle2);
                            for ($i2 = 0; $i2 < $rows2; $i2++) {
                                $data2 = mysqli_fetch_row($query_handle2);
                                $eigenschaftID = $data2[0];
                                $name = $data2[1];
                                $text = $data2[2];
                                $type = $data2[3];
                                $wert1 = $data2[4];
                                $wert2 = $data2[5];
                                if (($type == 'b') && ($i2 == 0)) {
                                    echo "<div class='col-2 offset-8 font-weight-bold'>rechts</div>";
                                    echo "<div class='col-2 font-weight-bold'>links</div>";
                                }
                                ?>
                                <div class='col-8 mb-2'>
                                    <?php
                                    echo $name;
                                    if ($text != '') echo "($text)";
                                    ?>
                                </div>
                                <?php
                                $db_request3 = "SELECT pWert1, pWert2, pWert3, pWert4, pWert5, pWertDescr FROM patientNIHSSWerte  WHERE pnID = '$pnID' AND nihssStepID = '$nihssStepID' ";
                                $query_handle3 = mysqli_query($access, $db_request3);
                                if ($query_handle3 != "") {
                                    $rows3 = mysqli_num_rows($query_handle3);
                                    if ($rows3 == 0) {
                                        $eID1 = '';
                                        $eID2 = '';
                                        $eID3 = '';
                                        $eID4 = '';
                                        $eID5 = '';
                                        $pWertDescr = '';
                                    } else {
                                        $data3 = mysqli_fetch_row($query_handle3);
                                        $eID1 = $data3[0];
                                        $eID2 = $data3[1];
                                        $eID3 = $data3[2];
                                        $eID4 = $data3[3];
                                        $eID5 = $data3[4];
                                        $pWertDescr = $data3[5];
                                    }
                                    ?>
                                    <div class='col-4 mb-2'>
                                        <?php
                                        if ($type == 'p') {
                                            ($eigenschaftID == $eID1) ? $checked = "checked" : $checked = "";
                                            ?>
                                            <div class='form-check form-check-inline'>
                                                <input type='radio' class='form-check-input'
                                                       name='pWert1[<?php echo $i1; ?>]'
                                                       id='pWert1_<?php echo $i1; ?>'
                                                       value='<?php echo $eigenschaftID; ?>'
                                                    <?php echo $checked; ?> />
                                                <label for='pWert1_<?php echo $i1; ?>'
                                                       class='form-check-label'><?php echo $wert1; ?></label>
                                            </div>
                                            <?php
                                        }
                                        if ($type == 'b') {
                                            ?>
                                            <div class="row">
                                                <div class="col-6">
                                                    <?php
                                                    ($eigenschaftID == $eID2) ? $checked2 = "checked" : $checked2 = "";
                                                    ?>
                                                    <div class="form-check form-check-inline">
                                                        <input type='radio' class='form-check-input'
                                                               name='pWert2[<?php echo $i1; ?>]'
                                                               id='pWert2_<?php echo $i1; ?>'
                                                               value='<?php echo $eigenschaftID; ?>'
                                                            <?php echo $checked2; ?> />
                                                        <label for='pWert2_<?php echo $i1; ?>'
                                                               class='form-check-label'><?php echo $wert1; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <?php
                                                    ($eigenschaftID == $eID3) ? $checked3 = "checked" : $checked3 = "";
                                                    ?>
                                                    <div class="form-check form-check-inline">
                                                        <input type='radio' class='form-check-input'
                                                               name='pWert3[<?php echo $i1; ?>]'
                                                               id='pWert3_<?php echo $i1; ?>'
                                                               value='<?php echo $eigenschaftID; ?>'
                                                            <?php echo $checked3; ?> />
                                                        <label for='pWert3_<?php echo $i1; ?>'
                                                               class='form-check-label'><?php echo $wert2; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        if ($type == 'c') {
                                            ($eigenschaftID == $eID5) ? $checked5 = "checked" : $checked5 = "";
                                            ?>
                                            <div class="form-check form-check-inline">
                                                <input type='radio' class='form-check-input'
                                                       name='pWert5[<?php echo $i1; ?>]'
                                                       id='pWert5_<?php echo $i1; ?>'
                                                       value='<?php echo $eigenschaftID; ?>'
                                                    <?php echo $checked5; ?> />
                                                <label for='pWert5_<?php echo $i1; ?>'
                                                       class='form-check-label'>li</label>
                                            </div>
                                            <?php
                                            ($eigenschaftID == $eID4) ? $checked4 = "checked" : $checked4 = "";
                                            ?>
                                            <div class="form-check form-check-inline">
                                                <input type='radio' class='form-check-input'
                                                       name='pWert4[<?php echo $i1; ?>]'
                                                       id='pWert4_<?php echo $i1; ?>'
                                                       value='<?php echo $eigenschaftID; ?>'
                                                    <?php echo $checked4; ?> />
                                                <label for='pWert4_<?php echo $i1; ?>'
                                                       class='form-check-label'>re</label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if ($type == 's') {
                                        ?>
                                        <div class='col-12'>
                                            <input name='pWertDescr[<?php echo $i1; ?>]'
                                                   value='<?php echo $pWertDescr; ?>' class='w-100'/>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        } else {
                            echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [editNIHSS($pnID) > query2]</p>";
                        }
                        ?>
                    </div>
                    <?php
                    $nr++;
                }
                ?>
                <button class='btn btn-primary'>Speichern</button>
            </form>
            <?php
        } else {
            echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [editNIHSS($pnID) > query1]</p>";
        }
        ?>
        <hr>
        <p>Erkl&auml;rungen Kameraeinstellungen: &Uuml;bersicht = Kamera Zoom weit, Naheinstellung = Kamera Zoom nah</p>
        <hr>
        <?php
    }
}

function savePatientNIHSSWerte($pnID, $pWerteArray)
{
    global $db_handle;
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        foreach ($pWerteArray as $key => $werte) {
            if ($werte != '') {
                foreach ($werte as $step => $eigenschaftID) {
                    $nihssStepID = $step + 1;
                    $db_request1 = "SELECT nihssStepName FROM docuNIHSS WHERE nihssStepID = '$nihssStepID'";
                    $query_handle1 = mysqli_query($access, $db_request1);
                    if ($query_handle1 != "") {
                        $data1 = mysqli_fetch_row($query_handle1);
                        $name = $data1[0];
                        if ($eigenschaftID != '') {
                            if ($key != 5) {
                                $db_request2 = "SELECT eigenschaftName, eigenschaftText, bewertungsType FROM docuNIHSSdetails  WHERE eigenschaftID ='$eigenschaftID'  ";
                                $query_handle2 = mysqli_query($access, $db_request2);
                                if ($query_handle2 != "") {
                                    $data2 = mysqli_fetch_row($query_handle2);
                                    $nameE = $data2[0];
                                    $textE = $data2[1];
                                    $type = $data2[2];
                                } else {
                                    echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [savePatientNIHSSWerte($pnID,$pWerteArray) - query 2]</p>";
                                }
                            } else {
                            }
                        }
                    } else {
                        echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [savePatientNIHSSWerte($pnID,$pWerteArray) - query 1]</p>";
                    }
                    if ($key == 0) {
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert1', $eigenschaftID);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert2', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert3', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert4', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert5', 0);
                    }
                    if ($key == 1) {
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert2', $eigenschaftID);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert1', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert3', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert4', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert5', 0);
                    }
                    if ($key == 2) {
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert3', $eigenschaftID);
                        $db_request2 = "SELECT pWert2 FROM `patientNIHSSWerte` WHERE pnID = '$pnID' AND nihssStepID = '$nihssStepID'";
                        $query_handle2 = mysqli_query($access, $db_request2);
                        if ($query_handle2 != "") {
                            $pW2 = mysqli_fetch_row($query_handle2);
                        }
                        if ($pW2[0] == 99) {
                            saveNIHSSWert($pnID, $nihssStepID, 'pWert2', 0);
                        }
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert1', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert4', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert5', 0);
                    }
                    if ($key == 3) {
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert4', $eigenschaftID);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert1', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert2', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert3', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert5', 0);
                    }
                    if ($key == 4) {
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert5', $eigenschaftID);
                        $db_request3 = "SELECT pWert4 FROM `patientNIHSSWerte` WHERE pnID = '$pnID' AND nihssStepID = '$nihssStepID'";
                        $query_handle3 = mysqli_query($access, $db_request3);
                        if ($query_handle3 != "") {
                            $pW4 = mysqli_fetch_row($query_handle3);
                        }
                        if ($pW4[0] == 99) {
                            saveNIHSSWert($pnID, $nihssStepID, 'pWert4', 0);
                        }
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert1', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert2', 0);
                        saveNIHSSWert($pnID, $nihssStepID, 'pWert3', 0);
                    }
                    if ($key == 5) {
                        if ($eigenschaftID != '') {
                            saveNIHSSWert($pnID, $nihssStepID, 'pWertDescr', $eigenschaftID);
                        }
                    }
                }
            }
        }
    }
}

function saveNIHSSWert($pnID, $nihssStepID, $column, $pWert)
{
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $db_request1 = "SELECT nihssStepID FROM `patientNIHSSWerte` WHERE pnID = '$pnID' AND nihssStepID = '$nihssStepID'";
        $query_handle1 = mysqli_query($access, $db_request1);
        if ($query_handle1 != "") {
            $rows1 = mysqli_num_rows($query_handle1);
            if ($rows1 != 0) {
                $db_request = "UPDATE patientNIHSSWerte SET $column = '$pWert' WHERE pnID = '$pnID' AND nihssStepID = '$nihssStepID'";
                $query_handle = mysqli_query($access, $db_request);
                if ($query_handle != "") {
                } else {
                    echo "<p class='errorMessage'>Konnte NIHSS $column nicht &auml;ndern [saveNIHSSWert($pnID, $nihssStepID, $column, $pWert)]!</p>";
                }
            }
        }
    } else {
        echo "<p class='errorMessage'>Kein Zugriff auf Datenbank [ssaveNIHSSWert($pnID, $nihssStepID, $column, $pWert)]!</p>";
    }
}

function savePatientNIHSS($patientID, $patientRecordID)
{
    global $case, $x;
    $pnID = '';
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $arztID = "";
        $timestampCreated = date('Y-m-d H:i:s');
        if ($case == 'dmt') {
            $arztID = Arzt::getAdminID();
        }
        if ($case == 'web') {
            $arztID = $_SESSION['arztID'];
        }
        $where = 'arztID, patientID, patientRecordID, timeNIHSS, nihssTotal';
        $value = "'$arztID','$patientID','$patientRecordID', '$timestampCreated', '0'";
        $db_request = "INSERT INTO `patientNIHSS` (" . $where . ") VALUES (" . $value . ")";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $pnID = mysqli_insert_id($access);
            setSavedOptionYes($x);
            $anzahl = getMaxEntries('docuNIHSS', 'nihssStepID');
            for ($i = 1; $i <= $anzahl; $i++) {
                $where2 = ' pnID, nihssStepID, pWert1, pWert2, pWert3, pWert4, pWert5, pWertDescr';
                $value2 = "'$pnID','$i','99','99','99','99','99', ''";
                $db_request2 = "INSERT INTO `patientNIHSSWerte` (" . $where2 . ") VALUES (" . $value2 . ")";
                $query_handle2 = mysqli_query($access, $db_request2);
                if ($query_handle2 != "") {
                    $pWertID = mysqli_insert_id($access);
                } else {
                    echo "<p class='errorMessage'>Konnte kein neuen Eintrag erzeugen [savePatientNIHSS()]!</p>";
                }
            }
        } else {
            echo "<p class='errorMessage'>Konnte kein neuen Eintrag in erzeugen [savePatientNIHSS($patientID, $patientRecordID)]!</p>";
        }
    } else {
        echo "<p class='errorMessage'>Kein Zugriff auf Datenbank [savePatientNIHSS($patientID, $patientRecordID)]!</p>";
    }
    return $pnID;
}

function showPatientNIHSSWerte($pnID)
{
    $printTotal = '';
    $arztID = getDBContent('patientNIHSS', 'arztID', 'pnID', $pnID);
    $arzt = new Arzt();
    $arztInfos = $arzt->getArztInfos($arztID);
    $time = getDBContent('patientNIHSS', 'timeNIHSS', 'pnID', $pnID);
    $time = strtotime($time);
    $time = date("d.m.Y. H:i", $time) . ' Uhr';
    $connection = new Access();
    $access = $connection->connectDB();
    echo "<h2>NIHSS-Durchf&uuml;hrender Arzt: $arztInfos, <br>Datum: $time&nbsp;</h2>";
    if ($access) {
        echo "<ol class='mt-3 mb-3'>";
        $db_request = "SELECT nihssStepID, pWert1, pWert2, pWert3, pWert4, pWert5, pWertDescr FROM patientNIHSSWerte WHERE pnID = '$pnID' ORDER by nihssStepID";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $rows = mysqli_num_rows($query_handle);
            if ($rows == 0) {
            } else {
                for ($i = 0; $i < $rows; $i++) {
                    $data = mysqli_fetch_row($query_handle);
                    $nihssStepID = $data[0];
                    $eID1 = $data[1];
                    $eID2 = $data[2];
                    $eID3 = $data[3];
                    $eID4 = $data[4];
                    $eID5 = $data[5];
                    $eIDArray = array($eID1, $eID2, $eID3, $eID4, $eID5);
                    $wertDescr = $data[6];
                    $db_request3 = "SELECT nihssStepName, nihssStepText, cameraInfo, assistenzInfo, posNIHSSoriginal FROM docuNIHSS WHERE nihssStepID = '$nihssStepID' ";
                    $query_handle3 = mysqli_query($access, $db_request3);
                    if ($query_handle3 != "") {
                        $data3 = mysqli_fetch_row($query_handle3);
                        $name = $data3[0];
                        $text = $data3[1];
                        $camera = $data3[2];
                        $assitenz = $data3[3];
                        $posNIHSSoriginal = $data3[4];
                        echo "<li class='mb-2'>";
                        echo "<b>";
                        if ($posNIHSSoriginal != '') {
                            echo "$posNIHSSoriginal. ";
                        }
                        echo "$name</b> ";
                        if ($text != '') {
                            echo "($text)<br />";
                        }
                        $remember = 0;
                        foreach ($eIDArray as $key => $id) {
                            if ($remember != 1) {
                                if (($id != 0) AND ($id != 99)) {
                                    $db_request2 = "SELECT eigenschaftName, eigenschaftText, bewertungsType FROM docuNIHSSdetails  WHERE eigenschaftID ='$id'  ";
                                    $query_handle2 = mysqli_query($access, $db_request2);
                                    if ($query_handle2 != "") {
                                        $data2 = mysqli_fetch_row($query_handle2);
                                        $nameE = $data2[0];
                                        $textE = $data2[1];
                                        $type = $data2[2];
                                        echo "$nameE ";
                                        if ($textE != '') echo " ($textE) ";
                                        echo "<b>";
                                        if ($eID1 != 0) {
                                            $wert1 = getDBContent('docuNIHSSdetails', 'wert1', 'eigenschaftID', $id);
                                            if ($wert1 == 9) {
                                                $wert1 = '9 -> 0';
                                            }
                                            echo "$wert1 ";
                                        }
                                        if ($type == 'b') {
                                            if ($eID2 != 0) {
                                                $wert2 = getDBContent('docuNIHSSdetails', 'wert1', 'eigenschaftID', $eID2);
                                                if ($wert2 == 9) {
                                                    $wert2 = '9 -> 0';
                                                }
                                                echo "rechts: $wert2";
                                            }
                                            if (($eID2 != 0) AND ($eID3 != 0)) {
                                                echo " & ";
                                            }
                                            if ($eID3 != 0) {
                                                $wert3 = getDBContent('docuNIHSSdetails', 'wert2', 'eigenschaftID', $eID3);
                                                if ($wert3 == 9) {
                                                    $wert3 = '9 -> 0';
                                                }
                                                echo "links: $wert3";
                                            }
                                            $remember = 1;
                                        }
                                        if ($type == 'c') {
                                            if ($eID4 != 0) {
                                                $wert4 = 'rechts';
                                            } else {
                                                $wert4 = '';
                                            }
                                            if ($eID5 != 0) {
                                                $wert5 = 'links';
                                            } else {
                                                $wert5 = '';
                                            }
                                            echo "$wert4 &nbsp; $wert5";
                                            $remember = 1;
                                        }
                                        echo "</b>";
                                        if ($wertDescr != '') {
                                            echo "<br>";
                                            echo "Erkl.: $wertDescr ";
                                        }
                                    } else {
                                        echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [showPatientNIHSSWerte($pnID) > detail, WHERE eigenschaftID ='$id']</p>";
                                    }
                                }
                            }
                        }
                        if ($id == 99) {
                            echo "<b style='color:#FF3300;'>Nicht bewertet</b>";
                        }
                        echo "</li>";
                    }
                }
                $total = getTotalNIHSSviaSUM($pnID);
                $printTotal = "<h1 class='mb-3'>GESAMT: $total</h2>";
            }
        } else {
            echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [showPatientNIHSSWerte($pnID) ]</p>";
        }
    }
    echo "</ol>
    $printTotal
    ";
}

function getNIHSSlist($patientRecordID)
{
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $db_request1 = "SELECT  pnID, timeNIHSS, arztID  FROM `patientNIHSS` WHERE patientRecordID = '$patientRecordID'  AND nihssTotal = '0' ORDER by pnID DESC";
        $query_handle1 = mysqli_query($access, $db_request1);
        if ($query_handle1 != "") {
            $rows1 = mysqli_num_rows($query_handle1);
            if ($rows1 == 0) {
            } else {
                ?>
                <span class=' d-print-inline'>NIHSS Dok.:</span>
                <ul class='list-unstyled d-print-inline'>
                    <?php
                    for ($i1 = 0; $i1 < $rows1; $i1++) {
                        $data1 = mysqli_fetch_row($query_handle1);
                        $pnID = $data1[0];
                        $timeNIHSS = $data1[1];
                        $nArztID = $data1[2];
                        $nArzt = Arzt::getArztInfosShort($nArztID);
                        $timeNIHSS = strtotime($timeNIHSS);
                        $timeNIHSS = date("d.m.Y", $timeNIHSS) . ' (' . date("H:i", $timeNIHSS) . ' Uhr)';
                        $nihssTotal = getTotalNIHSSviaSUM($pnID);
                        echo "<li class=''>Wert: <b>$nihssTotal</b>, $timeNIHSS</li>";
                    }
                    ?>
                </ul>
                <?php
            }
        }
    }
}

function getNIHSSdocuAndButtons($patientRecordID)
{
    global $url;
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $db_request1 = "SELECT  pnID, timeNIHSS, arztID, patientID  FROM `patientNIHSS` WHERE patientRecordID = '$patientRecordID'  AND nihssTotal = '0' ORDER by pnID DESC";
        $query_handle1 = mysqli_query($access, $db_request1);
        if ($query_handle1 != "") {
            $rows1 = mysqli_num_rows($query_handle1);
            if ($rows1 == 0) {
            } else {
                ?>
                <ul class='list-unstyled mb-2'>
                    <?php
                    for ($i1 = 0; $i1 < $rows1; $i1++) {
                        $data1 = mysqli_fetch_row($query_handle1);
                        $pnID = $data1[0];
                        $timeNIHSS = $data1[1];
                        $nArztID = $data1[2];
                        $patientID = $data1[3];
                        $nArzt = Arzt::getArztInfosShort($nArztID);
                        $timeNIHSS = strtotime($timeNIHSS);
                        $timeNIHSS = date("d.m.", $timeNIHSS) . ' (' . date("H:i", $timeNIHSS) . ' Uhr)';
                        $nihssTotal = getTotalNIHSSviaSUM($pnID);
                        ?>
                        <li>Dok.-Wert:
                            <?php
                            echo "<b>$nihssTotal</b>, $timeNIHSS";
                            ?>
                        </li>
                        <li>
                            <?php
                            $editStatus = getDBContent('patientRecords', 'editStatus', 'patientRecordID', $patientRecordID);
                            if ($editStatus == 't') {
                                $addInput[] = "<input type='hidden' name='patientID' value='$patientID' />";
                                $addInput[] = "<input type='hidden' name='pnID' value='$pnID' />";
                                $css = "btn btn-outline-success col-5 mt-2 mb-1 ml-0 mr-0";
                                $formcss = "d-inline col-6 ml-0 mr-0 pl-0 pr-0";
                                smallButton($url, '3215', '<i class="icon-eye-open"></i>', $css, $addInput, $formcss);
                                smallButton($url, '3216', '<i class="icon-print"></i>', $css, $addInput, $formcss);
                            } else {
                                editNIHSSForm($patientID, $pnID);
                            }
                            ?>
                        </li>
                        <?php
                        if ($i1 < $rows1 - 1) {
                            echo "<li><hr></li>";
                        }
                    }
                    ?>
                </ul>
                <?php
            }
        }
    }
}

function getTotalNIHSSviaSUM($pnID)
{
    $connection = new Access();
    $access = $connection->connectDB();
    $total = 0;
    $totalAlt = 0;
    $pkt1 = 0;
    $pkt2 = 0;
    $pkt3 = 0;
    $db_request1 = "SELECT pWert1, pWert2, pWert3  FROM `patientNIHSSWerte` WHERE pnID = '$pnID' ORDER by nihssStepID";
    $query_handle1 = mysqli_query($access, $db_request1);
    if ($query_handle1 != "") {
        $rows1 = mysqli_num_rows($query_handle1);
        if ($rows1 == 0) {
        } else {
            for ($i1 = 0; $i1 < $rows1; $i1++) {
                $data1 = mysqli_fetch_row($query_handle1);
                $pWert1 = $data1[0];
                $pWert2 = $data1[1];
                $pWert3 = $data1[2];
                if (($pWert1 == 0) OR ($pWert1 == 99)) {
                    $pkt1 = 0;
                } else {
                    $db_request2 = "SELECT wert1 FROM `docuNIHSSdetails`  WHERE eigenschaftID ='$pWert1'  ";
                    $query_handle2 = mysqli_query($access, $db_request2);
                    if ($query_handle2 != "") {
                        $data2 = mysqli_fetch_row($query_handle2);
                        $pkt1 = $data2[0];
                        if ($pkt1 == 9) {
                            $pkt1 = 0;
                        }
                    }
                }
                if (($pWert2 == 0) OR ($pWert2 == 99)) {
                    $pkt2 = 0;
                } else {
                    $db_request2 = "SELECT wert1 FROM `docuNIHSSdetails`  WHERE eigenschaftID ='$pWert2'  ";
                    $query_handle2 = mysqli_query($access, $db_request2);
                    if ($query_handle2 != "") {
                        $data2 = mysqli_fetch_row($query_handle2);
                        $pkt2 = $data2[0];
                        if ($pkt2 == 9) {
                            $pkt2 = 0;
                        }
                    }
                }
                if (($pWert3 == 0) OR ($pWert3 == 99)) {
                    $pkt3 = 0;
                } else {
                    $db_request2 = "SELECT wert2 FROM `docuNIHSSdetails`  WHERE eigenschaftID ='$pWert3'  ";
                    $query_handle2 = mysqli_query($access, $db_request2);
                    if ($query_handle2 != "") {
                        $data2 = mysqli_fetch_row($query_handle2);
                        $pkt3 = $data2[0];
                        if ($pkt3 == 9) {
                            $pkt3 = 0;
                        }
                    }
                }
                $total = $totalAlt + $pkt1 + $pkt2 + $pkt3;
                $totalAlt = $total;
            }
        }
    } else {
        echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [getTotalNIHSSviaSUM($pnID)]</p>";
    }
    return $total;
}

function getTotalNIHSSWerte($patientRecordID)
{
    $connection = new Access();
    $access = $connection->connectDB();
    $counter = 0;
    if ($access) {
        $db_request2 = "SELECT  *  FROM `patientNIHSS` WHERE patientRecordID = '$patientRecordID' AND nihssTotal != '0' ORDER by pnID DESC";
        $query_handle2 = mysqli_query($access, $db_request2);
        if ($query_handle2 != "") {
            $rows2 = mysqli_num_rows($query_handle2);
            if ($rows2 == 0) {
            } else {
                ?>
                <ul class='list-unstyled d-print-inline'>
                    <?php
                    for ($i2 = 0; $i2 < $rows2; $i2++) {
                        $data2 = mysqli_fetch_object($query_handle2);
                        $pnID = $data2->pnID;
                        $nihssTotal = $data2->nihssTotal;
                        if ($nihssTotal > 0) {
                            $counter++;
                            echo "<li class=''>$counter. NIHSS: <b>$nihssTotal</b></li>";
                        }
                    }
                    ?>
                </ul>
                <?php
            }
        }
    }
}
