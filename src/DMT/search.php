<?php
/**

 * ------------------------------------------------------------------
 * Suche
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
$from = getPOSTAndGETData('from');
$to = getPOSTAndGETData('to');
if ($from == '') {
    $from = $to;
}
if ($to == '') {
    $to = $from;
}
$name = getPOSTAndGETData('name');
$pBdayDayS = getSecurePOSTAndGETData('pBdayDayS');
$pBdayMonthS = getSecurePOSTAndGETData('pBdayMonthS');
$pBdayYearS = getSecurePOSTAndGETData('pBdayYearS');
$arzt = getPOSTAndGETData('arzt');
$search = array($from, $to, $name, $pBdayDayS, $pBdayMonthS, $pBdayYearS, $arzt);
$column = getPOSTAndGETData('column');
$what = getPOSTAndGETData('what');

function searchPatientMenu()
{
    global $url, $baseURL;
    ?>
    <a id='suchen'></a>
    <div class="mt-5 d-print-none">
            <h2>Suche</h2>
            <div class="row">
                <div class="col-sm-8 specialView">
                    <form method='post' action='<?php echo $url; ?>'>
                        <div class='form-row'>
                            <label for='name' class='col-sm-4 col-form-label'>Patientenname:</label>
                            <input id='name' name='name' placeholder='Name' class='col-sm-8 form-control mb-1'/>
                        </div>
                        <div class="form-row">
                            <label for='pBdayDayS' class='col-sm-4 col-form-label'>Geburtstag:</label>
<!--
                            <input name='pBday' id='pBday' class=' datepicker' placeholder='Geburtsdatum' >
-->
                            <select id='pBdayDayS' name='pBdayDayS' class='col-sm-2 form-control'>
                                <option selected value=''>Tag</option>
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    if ($i < 10) {
                                        print "<option value='0$i'>0$i</option>";
                                    } else {
                                        print "<option value='$i'>$i</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for='pBdayMonthS'></label>
                            <select name='pBdayMonthS' id='pBdayMonthS' class='col-sm-3 form-control'>
                                <option selected value=''>Monat</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    $mName = monthName($i);
                                    if ($i < 10) {
                                        print "<option value='0$i'>$mName</option>";
                                    } else {
                                        print "<option value='$i'>$mName</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for='pBdayYearS'></label>
                            <select name='pBdayYearS' id='pBdayYearS' class='col-sm-3 form-control'>
                                <option value=''>Jahr</option>
                                <?php
                                $currentYear = date('Y');
                                $startjahr = $currentYear - 110;
                                for ($i = 0; $i < 110; $i++) {
                                    $year = $startjahr + $i;
                                    print "<option value='$year'>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class='col-12'>Klinikaufnahme:</div>
                            <input name='from' id='from' class='col-sm-5 offset-sm-1 form-control datepicker' placeholder="von">
                            <input name='to' id='to' class='col-sm-5 offset-sm-1 form-control datepicker' placeholder="bis">
                            <!--
                            <input id='from' name='from' onfocus='showCalendarControl(this);'
                                   class="col-5 offset-1 form-control"
                                   placeholder="von"/>
                            <input id='to' name='to' onfocus='showCalendarControl(this);'
                                   class="col-5 offset-1 form-control"
                                   placeholder="bis"/>
                                   -->
                        </div>
                        <hr>
                        <div class="form-row">
                            <label for="arzt" class="col-sm-4 col-form-label">&Uuml;berweiser:</label>
                            <select name='arzt' class="col-sm-8 form-control">
                                <option value='' selected>Bitte ausw&auml;hlen</option>
                                <?php
                                $allAerzte = new Arzt();
                                $allAerzte = $allAerzte->getAllEntries();
                                foreach ($allAerzte as $arzt) {
                                    $id = $arzt->getArztID();
                                    $arztLastName = $arzt->getArztLastName();
                                    $info = $arzt->getArztInfosShort($id);
                                    print "<option value='$arztLastName'>$info</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type='hidden' name='x' value='1100'/>
                        <button class="btn btn-outline-primary mt-3 font-weight-bold">Suchen</button>
                    </form>
                </div>
                <div class="col-sm-4 specialView">
                    <fieldset>
                        <legend>Klinik&shy;aufnahme</legend>
                        <?php
                        $yesterday = date('d.m.Y', time() - (60 * 60 * 24));
                        $addInputSearch1[] = "<input type='hidden' name='from' value='$yesterday'/>";
                        smallButton($url, '1100', 'Gestern', 'btn btn-outline-primary mb-3', $addInputSearch1, '');
                        $today = date("d.m.Y");
                        $addInputSearch2[] = "<input type='hidden' name='from' value='$today'/>";
                        smallButton($url, '1100', 'Heute', 'btn btn-outline-primary mb-2', $addInputSearch2, '');
                        ?>
                    </fieldset>
                </div>
        </div>
    </div>
    <?php
}

function searchAll($search)
{
    global $url;
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $patientIDs = array();
        $arztIDs = array();
        $patientIDOld = '';
        $pBdayDB = $search[5] . '-' . $search[4] . '-' . $search[3];
        $pBdayT = $search[3] . '. ' . monthName($search[4]) . ' ' . $search[5];
        if ($search[0] != '' || $search[1] != '' || $search[2] != '' || $search[3] != '' || $search[4] != '' || $search[5] != '' || $search[6] != '') {
            ?>
            <h4>Suchkriterien:</h4>
            <p>
                <?php
                $allCriteriaArray = array();
                if ($search[0] != '') {
                    $allCriteriaArray[] = "Zeitraum von $search[0] bis $search[1]";
                }
                if ($search[2] != '') {
                    $allCriteriaArray[] = "Patientenname: $search[2]";
                }
                if ($search[3] != '' && $search[4] != '' && $search[5] != '') {
                    $monat = monthName($search[4]);
                    $allCriteriaArray[] = "Geburtstagdatum: $search[3]. $monat $search[5]";
                } else {
                    if ($search[3] != '') {
                        $allCriteriaArray[] = "Geburtstag-Tag: $search[3]";
                    }
                    if ($search[4] != '') {
                        $monat = monthName($search[4]);
                        $allCriteriaArray[] = "Geburtstag-Monat: $monat";
                    }
                    if ($search[5] != '') {
                        $allCriteriaArray[] = "Geburtstag-Jahr: $search[5]";
                    }
                }
                if ($search[6] != '') {
                    $allCriteriaArray[] = "Arztname: $search[6]";
                }
                $allCriteria = implode(', ', $allCriteriaArray);
                echo $allCriteria;
                ?>
            </p>
            <?php
        }
        if ($search[2] != '') {
            if ((($search[3] != '') AND ($search[4] != '')) And ($search[5] != '')) {
                $db_request1 = "SELECT * FROM patients WHERE pBday = '$pBdayDB' AND MATCH (pLastName) AGAINST ('$search[2]*' IN BOOLEAN MODE) OR pLastName LIKE '%$search[2]%' ORDER by pLastName, pBday";
            } else {
                $db_request1 = "SELECT * FROM patients WHERE MATCH (pLastName) AGAINST ('$search[2]*' IN BOOLEAN MODE) OR pLastName LIKE '%$search[2]%' ORDER by pLastName, pBday";
            }
        } else {
            if ((($search[3] != '') AND ($search[4] != '')) And ($search[5] != '')) {
                $db_request1 = "SELECT * FROM patients WHERE pBday = '$pBdayDB'  ORDER by pLastName, pBday";
            } else {
                $db_request1 = "SELECT * FROM  patients ORDER by pLastName";
            }
        }
        $query_handle1 = mysqli_query($access, $db_request1);
        if ($query_handle1 != "") {
            $rows1 = mysqli_num_rows($query_handle1);
            if ($rows1 > 0) {
                for ($i1 = 0; $i1 < $rows1; $i1++) {
                    $data1 = mysqli_fetch_object($query_handle1, 'Patient');
                    $patientID = $data1->getPatientID();
                    $patientIDs[] = $patientID;
                }
            } else {
                print "<div class='col-12 btn btn-warning btn-wrap'>Kein Patient zu diesen Suchkriterien auffindbar.</div>";
            }
        }
        if ($search[6] != '') {
            $db_request1 = "SELECT * FROM aerzte WHERE arztLastName ='$search[6]'";
            $query_handle1 = mysqli_query($access, $db_request1);
            if ($query_handle1 != "") {
                $rows1 = mysqli_num_rows($query_handle1);
                if ($rows1 > 0) {
                    for ($i1 = 0; $i1 < $rows1; $i1++) {
                        $data1 = mysqli_fetch_object($query_handle1, 'Arzt');
                        $arztIDs[] = $data1->getArztID();
                    }
                } else {
                    print "<p class='btn btn-warning '>Kein Arzt mit diesem Namen auffindbar</p>";
                }
            } else {
                print "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [searchAll - query_handle 1 - arzt > arztIDs]</p>";
            }
        }
        if ($search[0] != '') {
            $from = explode('.', $search[0]);
            $fromD = $from[0];
            $fromM = $from[1];
            $fromY = $from[2];
            $from = $fromY . '-' . $fromM . '-' . $fromD;
        } else {
            $from = '';
        }
        if ($search[0] != '') {
            $to = explode('.', $search[1]);
            $toD = $to[0];
            $toM = $to[1];
            $toY = $to[2];
            $to = $toY . '-' . $toM . '-' . $toD;
        } else {
            $to = '';
        }
        if (!empty($patientIDs)) {
            ?>
            <fieldset>
                <legend>Patienten ausw&auml;hlen:</legend>
                <form method='post' action='<?php echo $url; ?>'>
                    <input type='hidden' name='x' value='1020'/>
                    <ol class='list-unstyled'>
                        <?php
                        $printExists = false;
                        foreach ($patientIDs as $patientID) {
                            $print = false;
                            $records = PatientRecord::getAllRecordsOfPatient($patientID, '');
                            foreach ($records as $record) {
                                $timeHospital = $record->getTimeHospital();
                                $diagnosisArztID = $record->getDiagnosisArztID();
                                $editStatus = $record->getEditStatus();
                                ($editStatus == 'o') ? $editStatus = "offen" : $editStatus = "abge&shy;schlossen";
                                $timeHospital = explode(' ', $timeHospital);
                                $timeHospital = $timeHospital[0];
                                if (($from != '') AND (count($arztIDs) == 0)) {
                                    if (($timeHospital >= $from) AND ($timeHospital <= $to)) {
                                        $print = true;
                                    }
                                } else {
                                    $print = true;
                                }
                                if ((count($arztIDs) > 0) AND ($from == '')) {
                                    foreach ($arztIDs as $arztID) {
                                        if ($diagnosisArztID == $arztID) {
                                            $print = true;
                                        } else {
                                            $print = false;
                                        }
                                    }
                                }
                                if ((count($arztIDs) > 0) AND ($from != '')) {
                                    foreach ($arztIDs as $arztID) {
                                        if ($diagnosisArztID == $arztID) {
                                            if (($timeHospital >= $from) AND ($timeHospital <= $to)) {
                                                $print = true;
                                            } else {
                                                $print = false;
                                            }
                                        } else {
                                            $print = false;
                                        }
                                    }
                                }
                                $print2 = false;
                                if ($patientID != $patientIDOld) {
                                    if ($print) {
                                        $patientIDOld = $patientID;
                                        $patient = new  Patient();
                                        $patient = $patient->getPatient($patientID);
                                        $pFirstName = $patient->getPFirstName();
                                        $pLastName = $patient->getPLastName();
                                        $pBday = $patient->getPBday();
                                        $pGender = $patient->getPGender();
                                        ($pGender == 'w') ? $pGender = "Frau " : $pGender = "Herr ";
                                        $pFirstName = schreibweise($pFirstName);
                                        $pLastName = schreibweise($pLastName);
                                        $pBday1 = explode('-', $pBday);
                                        $pBdayYear = $pBday1[0];
                                        $pBdayMonth = $pBday1[1];
                                        $pBdayDay = $pBday1[2];
                                        $what2 = explode(' ', $search[2]);
                                        if (is_array($search[2])) {
                                            foreach ($what2 as $i => $what3) {
                                                $pLastName = str_ireplace( 
                                                    $what3,
                                                    "<b>" . substr(strtolower($what3), 0, 1) . substr($what3, 1) . "</b>",
                                                    $pLastName
                                                );
                                            }
                                        } else {
                                            $pLastName = str_ireplace(
                                                $search[2],
                                                "<b>" . substr(strtolower($search[2]), 0, 1) . substr($search[2], 1) . "</b>",
                                                $pLastName
                                            );
                                        }
                                        $info = '';
                                        if ((($search[3] != '') OR ($search[4] != '')) OR ($search[5] != '')) {
                                            if ($pBdayDay == $search[3]) {
                                                $info .= 'Tag';
                                                $print2 = true;
                                                $pBdayDay = '<b>' . $pBdayDay . '</b>';
                                            }
                                            if ($pBdayMonth == $search[4]) {
                                                if ($print2) {
                                                    $info .= ' & Monat';
                                                } else {
                                                    $info .= 'Monat';
                                                }
                                                $print2 = true;
                                                $pBdayMonth = '<b>' . $pBdayMonth . '</b>';
                                            }
                                            if ($pBdayYear == $search[5]) {
                                                if ($print2) {
                                                    $info .= ' & Jahr';
                                                } else {
                                                    $info .= 'Jahr';
                                                }
                                                $print2 = true;
                                                $pBdayYear = '<b>' . $pBdayYear . '</b>';
                                            }
                                            $info = " <span class=''>&Uuml;bereinstimmung:<b> " . $info . "</b></span>";
                                        } else {
                                            $print2 = true;
                                        }
                                        if ($print2) {
                                            $printExists = true;
                                            ?>
                                            <li class="form-group row">
                                                <div class="col-1">
                                                    <input type="radio" name='patientID'
                                                           value='<?php echo $patientID; ?>' required>
                                                </div>
                                                <div class="col-7">
                                                    <?php
                                                    showPatientNameBDay($patientID, true, "");
                                                    echo " $info";
                                                    ?>
                                                </div>
                                                <div class='pull-right col-3'>
                                                    <?php
                                                    echo "$timeHospital  ($editStatus)";
                                                    ?>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                        if ($printExists === false) {
                            echo "<li class='btn btn-warning'>Keine Daten vorhanden</li>";
                        }
                        if ((($search[3] != '') OR ($search[4] != '')) OR ($search[5] != '')) {
                            $entries1 = Patient::getAllEntriesOfEmptyBDay(); 
                            $entries2 = Patient::getAllEntriesOfThisYearBDay();  
                            $entries = array_merge($entries1, $entries2);
                            if (!empty($entries)) {
                                ?>
                                <hr>
                                <h5>Patienten ohne Angabe des Geburtsdatums:</h5>
                                <?php
                                foreach ($entries as $entry) {
                                    $patientID = $entry->getPatientID();
                                    $pGender = $entry->getPGender();
                                    $pLastName = $entry->getPLastName();
                                    $pFirstName = $entry->getPFirstName();
                                    $pBday = $entry->getPBday();
                                    ($pGender == 'w') ? $pGender = "Frau " : $pGender = "Herr ";
                                    $pFirstName = schreibweise($pFirstName);
                                    $pLastName = schreibweise($pLastName);
                                    ?>
                                    <li class="form-group row">
                                        <div class="col-1">
                                            <input type="radio" name='patientID' value='<?php echo $patientID; ?>' required>
                                        </div>
                                        <div class="col-xs-11 col-sm-8">
                                            <?php
                                            showPatientNameBDay($patientID, true, "");
                                            ?>
                                        </div>
                                        <?php
                                        $recordsInfo = array();
                                        $records = PatientRecord::getAllRecordsOfPatient($patientID, '');
                                        if (!empty($records)) {
                                            foreach ($records as $record) {
                                                $timeHospital = $record->getTimeHospital();
                                                $editStatus = $record->getEditStatus();
                                                ($editStatus == 'o') ? $editStatus = "offen" : $editStatus = "abgeschlossen";
                                                $timeHospital = strtotime($timeHospital);
                                                $timeHospital = date("d.m.Y", $timeHospital);
                                                $recordsInfo[] = "$timeHospital ($editStatus)";
                                            }
                                            $recordsInfoString = implode(', ', $recordsInfo);
                                            echo "<div class='col-sm-3 '>$recordsInfoString </div>";
                                        }
                                        ?>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ol>
                    <button class="btn btn-primary mb-3">Ausgew&auml;hlten Patienten &uuml;bernehmen</button>
                </form>
                <?php
                if ($search[2] != '') {
                    print "<p class='text-info'>Hinweis f&uuml;r bessere Suchergebnisse: <br>
			Beispiel 'Schmidt' -> Eingabe Suchfeld: 'Schmi' damit alle Schreibvarianten (dt, tt und t) gefunden werden.</p>";
                }
                ?>
            </fieldset>
            <?php
        }
    }
}