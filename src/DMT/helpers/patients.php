<?php
/**

 * ------------------------------------------------------------------
 * View - Patienten
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */

/**
 * @method hiddenDiagnosisFields
 * @description
 *
 * @param $patientRecordID
 */
function hiddenDiagnosisFields($patientRecordID)
{
    $record = new PatientRecord();
    $record = $record->getRecord($patientRecordID);
    if (!empty($record)) {
        $symptomsText = $record->getSymptomsText();
        $timeInitialContact = $record->getTimeInitialContact();
        $timeHospital = $record->getTimeHospital();
        $timeDiagnosis = $record->getTimeDiagnosis();
        $clinicID = $record->getClinicID();
        $diagnosisArztID = $record->getDiagnosisArztID();
        $symptomDescr = $record->getSymptomDescr();
        $indicationID = $record->getIndicationID();
        $pDrugs = $record->getPDrugs();
        $pConditions = $record->getPConditions();
        $pGewicht = $record->getPGewicht();
        $pGroesse = $record->getPGroesse();
        $timeSymptoms = $record->getTimeSymptoms();
        $symptomsText2 = $record->getSymptomsText2();
        $timeSymptomsGesund = $record->getTimeSymptomsGesund();
        $diagnosisArzttxt = $record->getDiagnosisArzttxt();
        $radtxt = $record->getRadtxt();
        $bdWert1AufnahmeRec = $record->getBdWert1AufnahmeRec();
        $bdWert2AufnahmeRec = $record->getBdWert2AufnahmeRec();
        $bdDescrAufnahmeRec = $record->getBdDescrAufnahmeRec();

        echo "
        <input type='hidden' name='clinicID' 			value='$clinicID' />
        <input type='hidden' name='diagnosisArztID' 	value='$diagnosisArztID' />
        <input type='hidden' name='symptomsText' 		value='$symptomsText' />
        <input type='hidden' name='timeInitialContact' 	value='$timeInitialContact' />
        <input type='hidden' name='timeHospital' 		value='$timeHospital' />
        <input type='hidden' name='timeDiagnosis' 		value='$timeDiagnosis' />
        <input type='hidden' name='symptomDescr' 		value='$symptomDescr' />
        <input type='hidden' name='indicationID' 		value='$indicationID' />
        <input type='hidden' name='pDrugs' 				value='$pDrugs' />
        <input type='hidden' name='pConditions' 		value='$pConditions' />
        <input type='hidden' name='pGewicht'			value='$pGewicht' />
        <input type='hidden' name='pGroesse' 			value='$pGroesse' />
        <input type='hidden' name='timeSymptoms' 		value='$timeSymptoms' />
        <input type='hidden' name='symptomsText2' 		value='$symptomsText2' />
        <input type='hidden' name='timeSymptomsGesund' 	value='$timeSymptomsGesund' />
        <input type='hidden' name='diagnosisArzttxt' 				value='$diagnosisArzttxt' />
        <input type='hidden' name='radtxt' 				value='$radtxt' />
        <input type='hidden' name='bdWert1AufnahmeRec' 				value='$bdWert1AufnahmeRec' />
        <input type='hidden' name='bdWert2AufnahmeRec' 				value='$bdWert2AufnahmeRec' />
        <input type='hidden' name='bdDescrAufnahmeRec' 				value='$bdDescrAufnahmeRec' />
        ";
    }
}

function hiddenTherapyFields($patientRecordID)
{
    $record = new PatientRecord();
    $r = $record->getRecord($patientRecordID);

    $therapyArzttxt = $r->getTherapyArzttxt();
    $patid_abgleich = $r->getPatid_abgleich();
    $bgart = $r->getBgart();
    $radbef = $r->getRadbef();
    $bgproblem = $r->getBgproblem();
    $bgpblmtxt = $r->getBgpblmtxt();
    $nihssint = $r->getNihssint();
    $kuproblem = $r->getKuproblem();
    $videopblmtxt = $r->getVideopblmtxt();
    $proxgv = $r->getProxgv();
    $proxgvtxt = $r->getProxgvtxt();
    $mrs = $r->getMrs();
    $lyseempfint = $r->getLyseempfint();
    $offlabellyse = $r->getOfflabellyse();
    $tbempfint = $r->getTbempfint();
    $verlegort = $r->getVerlegort();
    $verlegtxt = $r->getVerlegtxt();
    $freenote = $r->getFreenote();
    $lysezeitbolus = $r->getLysezeitbolus();

    $visualData = $r->getVisualData();
    $visualData = explode(',', $visualData);
    $hiddenFieldArray = array(
        "timeTreatment" => $r->getTimeTreatment(),
        "therapyArztID" => $r->getTherapyArztID(),
        "konsilType" => $r->getKonsilType(),
        "lyseOption" => $r->getLyseOption(),
        "visualData[0]" => $visualData[0],
        "visualData[1]" => $visualData[1],
        "visualData[2]" => $visualData[2],
        "visualData[3]" => $visualData[3],
        "visualDataDescr" => $r->getVisualDataDescr(),
        "indication2ID" => $r->getIndication2ID(),
        "indication2DID" => $r->getIndication2DID(),
        "therapyDescr" => $r->getTherapyDescr1(),
        "therapyDescr2" => $r->getTherapyDescr2(),
        "therapyDescr3" => $r->getTherapyDescr3(),
        "editStatus" => $r->getEditStatus()
    );
    foreach ($hiddenFieldArray as $key => $val) {
        echo "<input type='hidden' name='$key' 	value='$val' />";
    }

    echo "
    <input type='hidden' name='therapyArzttxt' 				value='$therapyArzttxt' />
    <input type='hidden' name='patid_abgleich' 				value='$patid_abgleich' />
    <input type='hidden' name='bgart' 				value='$bgart' />
    <input type='hidden' name='radbef' 				value='$radbef' />
    <input type='hidden' name='bgproblem' 				value='$bgproblem' />
    <input type='hidden' name='bgpblmtxt' 				value='$bgpblmtxt' />
    <input type='hidden' name='nihssint' 				value='$nihssint' />
    <input type='hidden' name='kuproblem' 				value='$kuproblem' />
    <input type='hidden' name='videopblmtxt' 				value='$videopblmtxt' />
    <input type='hidden' name='proxgv' 				value='$proxgv' />
    <input type='hidden' name='proxgvtxt' 				value='$proxgvtxt' />
    <input type='hidden' name='mrs' 				value='$mrs' />
    <input type='hidden' name='lyseempfint' 				value='$lyseempfint' />
    <input type='hidden' name='offlabellyse' 				value='$offlabellyse' />
    <input type='hidden' name='tbempfint' 				value='$tbempfint' />
    <input type='hidden' name='verlegort' 				value='$verlegort' />
    <input type='hidden' name='verlegtxt' 				value='$verlegtxt' />
    <input type='hidden' name='freenote' 				value='$freenote' />
    <input type='hidden' name='lysezeitbolus' 				value='$lysezeitbolus' />
    ";
}

function listAllPatients($capitalLetter)
{
    global $dmt, $url;
    $count = 0;
    if ($capitalLetter == '') {
        $capitalLetter = Patient::getFirstCatitalLetterOFEntries();
    }
    $allPatientsOfCapitalLetter = Patient::getAllEntriesOfCatitalLetter($capitalLetter);
    if (!empty($allPatientsOfCapitalLetter)) {
        patientsNavigation();
        ?>
        <fieldset class='mt-3'>
            <legend>Vorhandene Patieneneintr&auml;ge, sortiert nach Nachname</legend>
            <?php
            if ($dmt != 1) {
                echo "<form method='post' action='$url' id='selectPatient'>
                    <input type='hidden' name='x' value='1020'/>";
            }
            ?>
            <ul class='list-unstyled m-3'>
                <?php
                foreach ($allPatientsOfCapitalLetter as $patient) {
                    $patientID = $patient->getPatientID();
                    $pFirstName = $patient->getPFirstName();
                    $pLastName = $patient->getPLastName();
                    $pBday = $patient->getPBday();
                    $pStreet = $patient->getPStreet();
                    $pZipCode = $patient->getPZipCode();
                    $pCity = $patient->getPCity();
                    $pPhone = $patient->getPPhone();
                    $pGender = $patient->getPGender();
                    if ($pGender == 'w') {
                        $pGender = "Frau ";
                    } else {
                        $pGender = "Herr ";
                    }
                    $pFirstName = schreibweise($pFirstName);
                    $pLastName = schreibweise($pLastName);
                    $pCity = schreibweise($pCity);
                    $pBday1 = explode('-', $pBday);
                    $pBdayYear = $pBday1[0];
                    $pBdayMonth = $pBday1[1];
                    $pBdayDay = $pBday1[2];
                    $record = new PatientRecord();
                    $fallAktenAnz = $record->getAllRecordsOfPatientAmount($patientID, '');
                    $count++;
                    if ($dmt == 0) {
                        ?>
                        <li class='form-check'>
                            <input type='radio' class='form-check-input' name='patientID'
                                   id='patientID_<?php echo $patientID; ?>'
                                   value='<?php echo $patientID; ?>' required/>
                            <label for='patientID_<?php echo $patientID; ?>' class='form-check-label'>
                                <?php
                                showPatientNameBDay($patientID, false, "");
                                ?>
                            </label>
                        </li>
                        <?php
                    }
                    if ($dmt == 1) {
                        $addInput[] = "<input type='hidden' name='patientID' value='$patientID' />";
                        ?>
                        <li class='row pb-1 mb-3 border-bottom'>
                            <div class='col-6'>
                                <?php
                                showPatientNameBDay($patientID, true, "");
                                echo "<br />";
                                if ($fallAktenAnz > 0) {
                                    if ($fallAktenAnz == 1) {
                                        echo "$fallAktenAnz Konsilschein vorhanden";
                                    } else {
                                        echo "$fallAktenAnz Konsilscheine vorhanden";
                                    }
                                }
                                ?>
                            </div>
                            <div class='col-3'>
                                <?php
                                smallButton($url, '1020', '<i class="fa icon-pencil"></i>', 'btn btn-secondary', $addInput, '');
                                ?>
                            </div>
                            <div class='col-3'>
                                <?php
                                smallButton($url, '1200', '<i class="fa icon-trash"></i>', 'btn btn-danger', $addInput, '');
                                ?>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
            <?php
            if ($dmt != 1) {
                echo "
            <button class='btn btn-primary mb-3'>Ausgew&auml;hlten Patienten &uuml;bernehmen</button>
            </form>
            ";
            }
            ?>
        </fieldset>
        <?php
    } else {
        echo "<p>Keine Patienten vorhanden</p>";
    }
    addPatientForm('', 'bg-secondary');
}

function listAllPatientsRecords($editStatus)
{
    $allRecords = PatientRecord::getAllRecords($editStatus);
    if (!empty($allRecords)) { 
        ?>
        <p class=''>Sortiert nach Konsilschein-Erstelldatum & -zeit
            (Neuste zuoberst -> Patienten mit mehreren Konsilscheinen meist weiter unten,
            da der erste vor l&auml;ngerer Zeit erzeugt wurde.)</p>
        <?php
        foreach ($allRecords as $record) { 
            $patientID = $record->getPatientID();
            $patientsDataArray[$patientID][] = $record;
        }
        if (!empty($patientsDataArray)) {
            foreach ($patientsDataArray as $patientID => $records) {
                echo "<fieldset class='mb-5'>";
                showPatientNameBDay($patientID, false, 'legend'); 
                $nr = 1;
                foreach ($records as $record) {
                    showPatientRecord($record, $nr);
                    $nr++;
                }
                docuListGlobalButtons($patientID);
                echo "</fieldset>";
            }
        }
    } else {
        echo "<p>Keine Eintr&auml;ge vorhanden.</p>";
        addPatientForm('', '');
    }
}

function listPatientRecords($patientID, $editStatusHere)
{
    $nr = 1;
    $allRecordsOfPatient = PatientRecord::getAllRecordsOfPatient($patientID, $editStatusHere);
    ?>
    <div class="row m-1">
        <?php
        if (!empty($allRecordsOfPatient)) {
            foreach ($allRecordsOfPatient as $record) {
                showPatientRecord($record, $nr);
                $nr++;
            }
        }
        ?>
    </div>
    <?php
    docuListGlobalButtons($patientID);
}

function patientInfoShort($patientID)
{
    $info = array();
    if ($patientID != "") {
        $pat = new Patient();
        $patient = $pat->getPatient($patientID);
        $pFirstName = $patient->getPFirstName();
        $vname = schreibweise($pFirstName);
        $nname = schreibweise($patient->getPLastName());
        $bDay = $patient->getPBday();
        if ($bDay != "0000-00-00") {
            $bDay = strtotime($bDay);
            $bDay = date("d.m.Y", $bDay);
        } else {
            $bDay = "keine Angabe ";
        }
        $info = array($vname, $nname, $bDay);
    }
    return $info;
}

function navPatient($patientID)
{
    global $pNavSign;
    $info = patientInfoShort($patientID);
    $pFirstName = $info[0];
    $pLastName = $info[1];
    $pBday = $info[2];
    ?>
    <a name='navPatient'></a>
    <fieldset class='mt-5'>
        <?php
        echo "<legend>$pNavSign Navigation f&uuml;r Patient $pLastName, $pFirstName: </legend>";
        listPatientRecords($patientID, ''); 
        ?>
    </fieldset>
    <?php
}

function docuListGlobalButtons($patientID)
{
    global $url, $x;
    $formcss = "d-inline col-6 ml-0 mr-0 pl-0 pr-0";
    $addInput[] = "<input type='hidden' name='patientID' value='$patientID' />";
    smallButton($url, '3320', 'Konsilschein <i class="icon-plus-sign"></i>', 'btn btn-outline-warning col-5 mt-1 mb-2 ml-0 mr-sm-3 mr-lg-5', $addInput, $formcss);
    if ($x != 1020) {
        $addInputNav[] = "<input type='hidden' name='patientID' value='$patientID' />";
        smallButton($url, '1020', '<i class="icon-user"></i>', 'btn btn-outline-primary col-5 mt-1 mb-2 ml-0 mr-0', $addInputNav, $formcss);
    }
}

function showPatientNameBDay($patientID, $showID, $htmlTag)
{
    if ($patientID != "") {
        $info = patientInfoShort($patientID);
        $pFirstName = $info[0];
        $pLastName = $info[1];
        $pBday = $info[2];
        $pbA = explode('.', $pBday);
        $patientYear = $pbA[2];
        $thisYear = date("Y");
        ($patientYear == $thisYear) ? $cssHint = "bg-warning p-1" : $cssHint = "";
        if ($htmlTag != "") echo "<" . $htmlTag . ">";
        echo "$pLastName, $pFirstName (geb.: <span class='$cssHint'>$pBday</span>)";
        if ($showID) echo " | id: $patientID";
        if ($htmlTag != "") echo "</" . $htmlTag . ">";
    }
}

function showPatientRecordWrapper($patientRecordID)
{
    global $diagnoseButton, $therapyButton;
    $r = new PatientRecord();
    $record = $r->getRecord($patientRecordID);
    $editStatus = $record->getEditStatus();
    echo "<h2 class='d-print-none'>Konsilschein  (ID: $patientRecordID)</h2>";
    if ($editStatus == "o") {
        echo "<h3 class='d-print-none'>- Status: <img src='assets/imagesLayout/blinkenRot.gif'> Offen </h3>";
    } else {
        echo "<h3 class='d-print-none'>- Status: Abgeschlossen</h3>";
    }
    echo "<h2>$diagnoseButton</h2>";
    showPatientRecordDiagnose($patientRecordID);
    echo "<h2>$therapyButton</h2>";
    showPatientRecordTherapy($patientRecordID);
}

function showPatientRecordDiagnose($patientRecordID)
{
    $r = new PatientRecord();
    $record = $r->getRecord($patientRecordID);
    $pGewicht = $record->getPGewicht();
    $pGroesse = $record->getPGroesse();
    $timestampCreated = $record->getTimestampCreated();
    $patientID = $record->getPatientID();
    $timeSymptoms = $record->getTimeSymptoms();
    $symptomsText = $record->getSymptomsText();
    $symptomsText2 = $record->getSymptomsText2();
    $symptomDescr = $record->getSymptomDescr();
    $timeInitialContact = $record->getTimeInitialContact();
    $timeHospital = $record->getTimeHospital();
    $timeDiagnosis = $record->getTimeDiagnosis();
    $clinicID = $record->getClinicID();
    $diagnosisArztID = $record->getDiagnosisArztID();
    $indicationID = $record->getIndicationID();
    $pDrugs = $record->getPDrugs();
    $diagnosisArzttxt = $record->getDiagnosisArzttxt();
    $radtxt = $record->getRadtxt();
    $bdWert1AufnahmeRec = $record->getBdWert1AufnahmeRec();
    $bdWert2AufnahmeRec = $record->getBdWert2AufnahmeRec();
    $bdDescrAufnahmeRec = $record->getBdDescrAufnahmeRec();
    $pConditions = $record->getPConditions();
    $timeSymptomsGesund = $record->getTimeSymptomsGesund();
    $timeInitialContact = strtotime($timeInitialContact);
    $timeInitialContact = date("d.m.y", $timeInitialContact) . '. ' . date("H:i", $timeInitialContact) . ' Uhr';
    $timeHospital = strtotime($timeHospital);
    $timeHospital = date("d.m.y", $timeHospital) . '. ' . date("H:i", $timeHospital) . ' Uhr';
    $timeDiagnosis = strtotime($timeDiagnosis);
    $timeDiagnosis = date("d.m.y", $timeDiagnosis) . '. ' . date("H:i", $timeDiagnosis) . ' Uhr';
    if ($timeSymptoms == '0000-00-00 00:00:00') {
        $timeSymptoms = 'keine Angabe';
    } else {
        $timeSymptoms = strtotime($timeSymptoms);
        $timeSymptoms = date("d.m.y", $timeSymptoms) . '. ' . date("H:i", $timeSymptoms) . ' Uhr';
    }
    if ($timeSymptomsGesund == '0000-00-00 00:00:00') {
        $timeSymptomsGesund = 'keine Angabe';
    } else {
        $timeSymptomsGesund = strtotime($timeSymptomsGesund);
        $timeSymptomsGesund = date("d.m.y", $timeSymptomsGesund) . '. ' . date("H:i", $timeSymptomsGesund) . ' Uhr';
    }
    $clinicName = getDBContent('clinics', 'clinicName', 'clinicID', $clinicID);
    $clinicInitial = getDBContent('clinics', 'clinicInitial', 'clinicID', $clinicID);
    $infoDA = Arzt::getArztInfosShort($diagnosisArztID);
    $symptomsText2Array = array(
        1 => "(Unbekannt)",
        2 => "(Im Schlaf)",
        3 => "(Sonstiges)",
        4 => "(Bekannt)"
    );
    ?>
    <div class='row mb-3'>
        <div class='col-sm-3 d-print-inline'><b>Anfordernde Klinik:</b></div>
        <div class='col-sm-9 d-print-inline'><?php echo "$clinicName ($clinicInitial) - Arzt: $infoDA";?></div>
    </div>

    <?php
    if ($diagnosisArzttxt <> '') {
    ?>
    <div class='row mb-3'>
        <div class='col-sm-3 d-print-inline'>zus. Arztangaben:</div>
        <div class='col-sm-9 d-print-inline'><?php echo "$diagnosisArzttxt";?></div>
    </div>
    <?php
    }
    ?>

    <div class='row'>
        <div class='col-sm-3 d-print-inline'><b>Zeitangaben:</b></div>
        <div class='col-sm-4 d-print-inline'><b>Beginn der Symptomatik:</b></div>
        <div class='col-sm-5 d-print-inline'><?php
            echo "$timeSymptoms";
            if ($symptomsText2 != "") echo " " . $symptomsText2Array[$symptomsText2];
            if ($symptomsText != "") echo " " . $symptomsText; ?></div>
    </div>
    <div class='row'>
        <div class='col-sm-3 d-print-inline'></div>
        <div class='col-sm-4 d-print-inline'><b>Zuletzt Gesund gesehen:</b></div>
        <div class='col-sm-5 d-print-inline'><?php echo "$timeSymptomsGesund"; ?></div>
    </div>
    <div class='row mb-3'>
        <div class='col-sm-3 d-print-inline'></div>
        <div class='col-sm-4 d-print-inline'><b>Klinikaufnahme:</b></div>
        <div class='col-sm-5 d-print-inline'><?php echo "$timeHospital"; ?></div>
    </div>
    <?php
    if ($symptomDescr != '') {
        ?>
        <div class='row mb-3 d-print-none'>
            <div class='col-sm-3'>Aktuelle Anamnese:</div>
            <div class='col-sm-9'><?php echo "$symptomDescr"; ?></div>
        </div>
        <?php
    }
    if ($radtxt != '') {
        ?>
        <div class='row mb-3 d-print-none'>
            <div class='col-sm-3'>radiol. Befund:</div>
            <div class='col-sm-9'><?php echo "$radtxt"; ?></div>
        </div>
        <?php
    }
    if ($bdWert1AufnahmeRec != 0 OR $bdWert2AufnahmeRec != 0 OR $bdDescrAufnahmeRec != '') {
        ?>
        <div class='row mb-3 d-print-none'>
            <div class='col-sm-3'>Blutdruck bei Aufnahme:</div>
            <div class='col-sm-9'>
            <?php
                echo "$bdWert1AufnahmeRec"." / "."$bdWert2AufnahmeRec"." mmHg";
                if ($bdDescrAufnahmeRec != ""){
                  echo ", "."$bdDescrAufnahmeRec";
                }
              ?>
            </div>
        </div>
        <?php
    }
    $indication = getDBContent('indication', 'indicationName', 'indicationID', $indicationID);
    if ($indication != '') {
        $indicationCode = getDBContent('indication', 'indicationCode', 'indicationID', $indicationID);
        ?>
        <div class='row mb-3'>
            <div class='col-sm-3 d-print-inline'>Indikations&shy;kodierung</div>
            <div class='col-sm-9 d-print-inline'><?php echo "($indicationCode) $indication"; ?></div>
        </div>
        <?php
    }
    $infoIDs_m = PatientRecord::getInfoIDs($patientRecordID, 'm');
    if ($pDrugs != '' || !empty($infoIDs_m)) {
        $nameMeds = array();
        $medications = "";
        if (!empty($infoIDs_m)) {
            foreach ($infoIDs_m as $infoID_m) {
                $nameMeds[] = getDBContent('infoMedication', 'medicationName', 'medicationID', $infoID_m);
            }
            $medications = implode(', ', $nameMeds);
        }
        ?>
        <div class='row mb-3'>
            <div class='col-sm-3 d-print-inline'>Weiteres:</div>
            <div class='col-sm-9 d-print-inline'>
                <?php
                echo "<b>Medikamente: </b> ";
                if ($pDrugs != '') echo "$pDrugs ";
                if ($medications != '') echo "<br/>$medications ";
                ?>
            </div>
        </div>
        <?php
    }
    $infoIDs_c = PatientRecord::getInfoIDs($patientRecordID, 'c');
    if ($pConditions != '' || !empty($infoIDs_c)) {
        $pCs = array();
        $pConditionNames = "";
        if (!empty($infoIDs_c)) {
            foreach ($infoIDs_c as $infoID_c) {
                $pCs[] = getDBContent('infoConditions', 'conditionName', 'conditionID', $infoID_c);
            }
            $pConditionNames = implode(', ', $pCs);
        }
        ?>
        <div class='row mb-3'>
            <div class='col-sm-3 d-print-inline'></div>
            <div class='col-sm-9 d-print-inline'>
                <?php
                echo "<b>Vorerkrankungen: </b> ";
                if ($pConditions != '') echo "$pConditions ";
                if ($pConditionNames != '') echo "<br/>$pConditionNames ";
                ?>
            </div>
        </div>
        <?php
    }
}

function showPatientRecordTherapy($patientRecordID)
{
    global $dmt;
    $r = new PatientRecord();
    $record = $r->getRecord($patientRecordID);
    $timeTreatment = $record->getTimeTreatment();
    $therapyArztID = $record->getTherapyArztID();
    $konsilType = $record->getKonsilType();
    $lyseOption = $record->getLyseOption();
    $visualData = $record->getVisualData();
    $visualDataDescr = $record->getVisualDataDescr();
    $indication2ID = $record->getIndication2ID();
    $indication2DID = $record->getIndication2DID();
    $therapyDescr = $record->getTherapyDescr1();
    $therapyDescr2 = $record->getTherapyDescr2();
    $therapyDescr3 = $record->getTherapyDescr3();
    $therapyArzttxt = $record->getTherapyArzttxt();
    $patid_abgleich = $record->getPatid_abgleich();
    $bgart = $record->getBgart();
    $radbef = $record->getRadbef();
    $bgproblem = $record->getBgproblem();
    $bgpblmtxt = $record->getBgpblmtxt();
    $nihssint = $record->getNihssint();
    $kuproblem = $record->getKuproblem();
    $videopblmtxt = $record->getVideopblmtxt();
    $proxgv = $record->getProxgv();
    $proxgvtxt = $record->getProxgvtxt();
    $mrs = $record->getMrs();
    $lyseempfint = $record->getLyseempfint();
    $offlabellyse = $record->getOfflabellyse();
    $tbempfint = $record->getTbempfint();
    $verlegort = $record->getVerlegort();
    $verlegtxt = $record->getVerlegtxt();
    $freenote = $record->getFreenote();
    $lysezeitbolus = $record->getLysezeitbolus();
    $visualData = explode(',', $visualData);
    if ($therapyArztID == 0) {
        echo "<p>Noch keine Empfehlungen vorhanden.</p>";
    } else {
        $infoDA2 = Arzt::getArztInfos($therapyArztID);
        ?>

        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Untersuchender Arzt:</div>
            <div class='col-sm-9 d-print-inline'><?php echo $infoDA2; ?></div>
        </div>

        <?php
        if ($therapyArzttxt != '') {
        ?>
        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>zus. Arztangaben:</div>
            <div class='col-sm-9 d-print-inline'><?php echo $therapyArzttxt; ?></div>
        </div>
        <?php
        }

        $timeTreatment = strtotime($timeTreatment);
        $timeTreatment = date("d.m.y", $timeTreatment) . '. ' . date("H:i", $timeTreatment) . ' Uhr';
        ?>
        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Untersuchung:</div>
            <div class='col-sm-9 d-print-inline'><?php echo $timeTreatment; ?></div>
        </div>

        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Art des Konsils:</div>
            <div class='col-sm-9 d-print-inline'>
            <?php
                if ($konsilType == '') {
                  echo " ";
                } else if ($konsilType == 't') {
                  echo "Telefon";
                } else if ($konsilType == 'b') {
                  echo "Bild und Telefon";
                } else if ($konsilType == 'v') {
                  echo "Videountersuchung";
                }
            ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Patienten ID und Bildgebung:</div>
            <div class='col-sm-9 d-print-inline'><?php echo ($patid_abgleich == 'j') ? "" : "nicht" ?> abgeglichen</div>
        </div>

        <hr>

        <?php if ($bgart != 0) {
          $VerlegOrtName	= array("ja","nein", "m&uuml;ndlich");
          $Name 		= $VerlegOrtName[$bgart];
        ?>
        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Bildgebung vorhanden:</div>
            <div class='col-sm-9 d-print-inline'><?php echo $Name; ?></div>
        </div>
        <?php
        }

        if ($radbef >= 0){
            $VerlegOrtName	= array("nicht verf&uuml;gbar","m&uuml;ndlich", "schriftlich");
            $Name 		= $VerlegOrtName[$radbef];
        ?>
        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>radiologischer Befund:</div>
            <div class='col-sm-9 d-print-inline'><?php echo $Name; ?></div>
        </div>
        <?php
        }

        if ($visualDataDescr <> ''){
        ?>
        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Bildbewertung:</div>
            <div class='col-sm-9 d-print-inline'><?php echo $visualDataDescr; ?></div>
        </div>
        <?php
        }

        ($visualData[0] == 'on') ? $ctOptionText = "CCT, " : $ctOptionText = "";
        ($visualData[1] == 'on') ? $mrtOptionText = "CCT+CT-A, " : $mrtOptionText = "";
        ($visualData[2] == 'on') ? $videoOptionText = "cMRT, " : $videoOptionText = "";
        ($visualData[3] == 'on') ? $angioOptionText = "Keine Bildgebung" : $angioOptionText = "";
        ?>
        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Art der Bildgebung:</div>
            <div class='col-sm-9 d-print-inline'><?php echo "$ctOptionText $mrtOptionText $videoOptionText $angioOptionText"; ?></div>
        </div>

        <?php
        if ($therapyDescr != "") {
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Klinischer Befund:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $therapyDescr; ?></div>
            </div>
        <?php
        }

        if ($nihssint != 0) {
            $VerlegOrtName = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "nicht zutreffend");
            $Name	= $VerlegOrtName[$nihssint];
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>NIHSS:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $Name; ?></div>
            </div>

        <?php
        }
        if ($therapyDescr2 != "") {
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Verdachtsdiagnose:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $therapyDescr2; ?></div>
            </div>
        <?php
        }
        if ($proxgv <> 0){
            $VerlegOrtName	= array("kein","ACI li", "ACI re", "M1 li", "M1 re", "M2 li", "M2 re", "AV li", "AV re", "BA", "anderes Gef&auml;&szlig;", "sonstige", "mehrere");
            $Name 		= $VerlegOrtName[$proxgv];
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Prox. GV:</div>
                <div class='col-sm-9 d-print-inline'>
                    <?php echo $Name;
                    echo ($proxgvtxt == "") ? "" : (", ".$proxgvtxt); ?>
                </div>
            </div>
        <?php
        }

        if ($mrs != 0) {
            $VerlegOrtName	= array("nicht beurteilt", "nicht zutreffend","0", "1","2", "3", "4", "5");
            $Name 		= $VerlegOrtName[$mrs];
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>pre Stroke mRS:</div>
                <div class='col-sm-9 d-print-inline'>
                    <?php echo $Name; ?>
                </div>
            </div>
        <?php
        }

        echo "<hr>";

        if ($therapyDescr3 != "") {
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Therapieempfehlungen:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $therapyDescr3; ?></div>
            </div>
        <?php
        }

        if ($lyseempfint <> 0){
            $VerlegOrtName	= array("Nein", "Ja");
            $Name 		= $VerlegOrtName[$lyseempfint];
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Lyse empfohlen:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $Name; ?></div>
            </div>
        <?php
        }

        if ($lysezeitbolus <> '00:00:00'){
            $lysezeitbolus		= strtotime($lysezeitbolus);
            $lysezeitbolus	 	= date("H:i",$lysezeitbolus) . ' hh:mm';
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Lysezeitbolus:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $lysezeitbolus; ?></div>
            </div>
        <?php
        }

        if ($offlabellyse <> 0){
            $VerlegOrtName	= array("Nein", "Ja");
            $Name 		= $VerlegOrtName[$offlabellyse];
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>off-label-lyse:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $Name; ?></div>
            </div>
        <?php
        }

        if ($tbempfint <> 0){
            $VerlegOrtName	= array("Nein", "Ja");
            $Name 		= $VerlegOrtName[$tbempfint];
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Thrombektomie empfohlen:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $Name; ?></div>
            </div>
        <?php
        }

        if ($verlegort <> 0){
            $VerlegOrtName	= array("keine","Erlangen", "N&uuml;rnberg", "Bayreuth", "W&uuml;rzburg", "Ingolstadt", "anderes");
            $Name 		= $VerlegOrtName[$tbempfint];
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>Patient verlegt nach:</div>
                <div class='col-sm-9 d-print-inline'>
                    <?php echo $Name;
                    echo ($verlegtxt != "") ? " ,".$verlegtxt : ""; ?>
                </div>
            </div>
        <?php
        }

        echo "<hr>";

        if ($freenote != "") {
        ?>
            <div class="row mb-3">
                <div class='col-sm-3 d-print-inline'>freie Bemerkung:</div>
                <div class='col-sm-9 d-print-inline'><?php echo $freenote; ?></div>
            </div>
        <?php
        }

        echo "<hr>";

        $indication2 = getDBContent('indication2', 'indication2Name', 'indication2ID', $indication2ID);
        $indication2Code = getDBContent('indication2', 'indication2Code', 'indication2ID', $indication2ID);
        $indication2D = getDBContent('indication2Detail', 'indication2DName', 'indication2DID', $indication2DID);
        $indication2DCode = getDBContent('indication2Detail', 'indication2DCode', 'indication2DID', $indication2DID);
        ?>
        <div class="row mb-3">
            <div class='col-sm-3 d-print-inline'>Diagnosekodierung:</div>
            <div class='col-sm-9 d-print-inline'><?php
                echo "($indication2Code)	$indication2 - Lokalit&auml;t: ($indication2DCode)	$indication2D";
                ?></div>
        </div>
        <?php
    }
}

function showPatientRecord($record, $nr)
{
    global $url, $imgPrePfad;
    $patientID = $record->getPatientID();
    $patientRecordID = $record->getPatientRecordID();
    $time = $record->getTimeHospital();
    $editStatus = $record->getEditStatus();
    $diagnosisArztID = $record->getDiagnosisArztID();
    $therapyArztID = $record->getTherapyArztID();
    ($diagnosisArztID != 0) ? $diagnosisArzt = Arzt::getArztInfos($diagnosisArztID) : $diagnosisArzt = "Fehlt";
    ($therapyArztID != 0) ? $therapyArzt = Arzt::getArztInfos($therapyArztID) : $therapyArzt = "Offen";
    $time = strtotime($time);
    $time = date("d.m", $time) . '. (' . date("H:i", $time) . ' Uhr)';
    ?>
    <div class='col-12 mb-2 p-1 docuList'>
        <a data-toggle="collapse" href="#collapse_<?php echo $patientRecordID; ?>"
           role="button" aria-expanded="false" aria-controls="collapseExample">
            <?php
            if ($editStatus == 'o') echo "<img src='" . $imgPrePfad . "assets/imagesLayout/blinkenRot.gif' >";
            echo " $nr. "; ?> Dokumentation --- Klinikaufnahme: <?php echo $time; ?> <span
                    class='font-weight-light pl-3'>(Details anzeigen)</span>
        </a>
    </div>
    <div class="col-12 collapse" id="collapse_<?php echo $patientRecordID; ?>">
        <div class="card card-body w-100">
            <div class='row'>
                <div class="col-sm-6">
                    Anfordernder Arzt: <?php echo $diagnosisArzt; ?>
                </div>
                <div class="col-sm-6">
                    Untersuchender Arzt: <?php echo $therapyArzt; ?>
                </div>
            </div>
            <div class='row mt-2'>
                <div class="col-xs-12 col-sm-4">
                    <h4>Konsilschein (ID: <?php echo $patientRecordID; ?>)</h4>
                    <?php
                    getTotalNIHSSWerte($patientRecordID);
                    $addInputs1[] = "<input type='hidden' name='patientID' value='$patientID' />";
                    $addInputs1[] = "<input type='hidden' name='patientRecordID' value='$patientRecordID' />";
                    $css = "btn btn-outline-success col-5 mt-2 mb-1 ml-0 mr-0";
                    $formcss = "d-inline col-6 ml-0 mr-0 pl-0 pr-0";
                    if ($editStatus == 't') {
                        smallButton($url, '3315', '<i class="icon-eye-open"></i>', $css, $addInputs1, $formcss);
                        smallButton($url, '3316', '<i class="icon-print"></i>', $css, $addInputs1, $formcss);
                    } else {
                        global $diagnoseButton, $therapyButton;
                        smallButton($url, '1025', $diagnoseButton, 'btn btn-primary mb-1', $addInputs1, '');
                        smallButton($url, '3300', $therapyButton, 'btn btn-primary', $addInputs1, '');
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-4 mt-2">
                    <h4>NIHSS</h4>
                    <?php
                    getNIHSSdocuAndButtons($patientRecordID);
                    echo "<hr>";
                    $addInputNIHSS[] = "<input type='hidden' name='patientID' value='$patientID' />";
                    $addInputNIHSS[] = "<input type='hidden' name='patientRecordID' value='$patientRecordID' />";
                    smallButton($url, '3220', 'Dokum. NIHSS <i class="icon-plus-sign"></i>', 'btn btn-outline-warning', $addInputNIHSS, '');
                    ?>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <h4>Thrombolyse</h4>
                    <?php
                    getLyselistPlusButtons($patientID, $patientRecordID);
                    echo "<hr>";
                    $addInputThrombolyse[] = "<input type='hidden' name='patientID' value='$patientID' />";
                    $addInputThrombolyse[] = "<input type='hidden' name='patientRecordID' value='$patientRecordID' />";
                    smallButton($url, '3420', 'Thrombolyse <i class="icon-plus-sign"></i>', 'btn btn-outline-warning', $addInputThrombolyse, '');
                    ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function editPatient($patientID)
{
    $p = new Patient();
    $patient = $p->getPatient($patientID);
    $pGender = $patient->getPGender();
    if ($pGender == 'w') {
        $checkedW = "checked";
        $checkedM = "";
    } elseif ($pGender == 'm') {
        $checkedW = "";
        $checkedM = "checked";
    } else {
        $checkedW = "";
        $checkedM = "";
    }
    $pFirstName = $patient->getPFirstName();
    $pLastName = $patient->getPLastName();
    $pStreet = $patient->getPStreet();
    $pZipCode = $patient->getPZipCode();
    $pCity = $patient->getPCity();
    $pPhone = $patient->getPPhone();
    $pBday = $patient->getPBday();
    if ($pBday != "") {
        $pBday1 = explode('-', $pBday);
        $pBdayYear = $pBday1[0];
        $pBdayMonth = $pBday1[1];
        $pBdayDay = $pBday1[2];
    } else {
        $pBdayYear = "";
        $pBdayMonth = "";
        $pBdayDay = "";
    }
    $pFirstName = schreibweise($pFirstName);
    $pLastName = schreibweise($pLastName);
    $pCity = schreibweise($pCity);
    $thisYear = date("Y");
    $patientYear = substr($pBday, 0, 4);
    ($patientYear == $thisYear) ? $cssHint = "bg-warning p-1" : $cssHint = "";
    echo "<legend>";
    if ($pLastName == '') {
        echo "Patientendaten eingeben (id: $patientID)";
    } else {
        showPatientNameBDay($patientID, false, 'legend');
    }
    echo "
    </legend>
    <input type='hidden' name='patientID' value='$patientID' />";
    ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group row">
                <div class="col-sm-3">Anrede:</div>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type='radio' name='pGender' id='pGender1'
                               value='w' <?php echo $checkedW; ?> >
                        <label for='pGender1' class="form-check-label">Frau</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type='radio' name='pGender' id='pGender2'
                               value='m' <?php echo $checkedM; ?> >
                        <label for='pGender2' class="form-check-label">Herr</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="pFirstName" class="col-sm-3">Vorname:</label>
                <div class="col-sm-9">
                    <input class='form-control' name='pFirstName' id='pFirstName' value='<?php echo $pFirstName; ?>'/>
                </div>
            </div>
            <div class="form-group row">
                <label for="pLastName" class="col-sm-3">Nachname:</label>
                <div class="col-sm-9">
                    <input class='form-control' name='pLastName' id='pLastName' value='<?php echo $pLastName; ?>'/>
                </div>
            </div>
            <?php
            $thisYear = date("Y");
            $patientYear = substr($pBday, 0, 4);
            ($patientYear == $thisYear) ? $cssHint = "bg-warning p-1" : $cssHint = "";
            ?>
            <div class="form-row">
                <div class="col-xs-12 col-sm-3 <?php echo $cssHint; ?>">Geb.Datum (TT.MM.JJJJ):</div>
                <div class="col-3 col-sm-3 <?php echo $cssHint; ?>">
                    <select name='pBdayDay' id='pBdayDay' class='form-control'>
                        <?php
                        if ($pBdayDay == "00") {
                            echo "<option selected value=''>Tag</option>";
                        } else {
                            echo "<option selected value='$pBdayDay'>$pBdayDay</option>";
                        }
                        for ($i = 1; $i <= 31; $i++) {
                            if ($i < 10) {
                                echo "<option value='0$i'>0$i</option>";
                            } else {
                                echo "<option value='$i'>$i</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-5 col-sm-3 <?php echo $cssHint; ?>">
                    <select name='pBdayMonth' class='form-control'>
                        <?php
                        if ($pBdayMonth == "00") {
                            echo "<option selected value=''>Monat</option>";
                        } else {
                            $smName = monthName($pBdayMonth);
                            echo "<option selected value='$pBdayMonth'>$smName</option>";
                        }
                        for ($i = 1; $i <= 12; $i++) {
                            $mName = monthName($i);
                            if ($i < 10) {
                                echo "<option value='0$i'>$mName</option>";
                            } else {
                                echo "<option value='$i'>$mName</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4 col-sm-3 <?php echo $cssHint; ?>">
                    <select name='pBdayYear' class='form-control'>
                        <?php
                        if ($pBdayYear == '0000') {
                            echo "<option value=''>Jahr</option>";
                        } else {
                            echo "<option selected value='$pBdayYear'>$pBdayYear</option>";
                        }
                        $currentYear = date('Y');
                        $startjahr = $currentYear - 110;
                        for ($i = 0; $i < 110; $i++) {
                            $year = $startjahr + $i;
                            if ($pBdayYear != $year) {
                                echo "<option value='$year'>$year</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function editPatientAndDiagnoseWrapper($patientID)
{
    global $url;
    ?>
    <form method='Post' action='<?php echo $url; ?>'>
        <h2>Patienten-Daten eingeben - bearbeiten</h2>
        <fieldset>
            <input type='hidden' name='x' value='1030'/>
            <?php
            editPatient($patientID);
            echo "<hr>";
            $record = new PatientRecord();
            $record->setPatientID($patientID);
            $patientRecordID = $record->savePatientRecord($record);
            editPatientRecordDiagnose($patientRecordID);
            ?>
            <button class="btn btn-primary mt-3 mb-3"> >>> Weiter >>></button>
        </fieldset>
    </form>
    <?php
}

function editPatientRecordDiagnose($patientRecordID)
{
    global $dmt, $diagnoseButton, $case;
    $r = new PatientRecord();
    $record = $r->getRecord($patientRecordID);
    $pGewicht = $record->getPGewicht();
    $pGroesse = $record->getPGroesse();
    $patientID = $record->getPatientID();
    $editStatus = $record->getEditStatus();
    $timeSymptoms = $record->getTimeSymptoms();
    $symptomsText = $record->getSymptomsText();
    $symptomsText2 = $record->getSymptomsText2();
    $symptomDescr = $record->getSymptomDescr();
    $timeInitialContact = $record->getTimeInitialContact();
    $timeHospital = $record->getTimeHospital();
    $timeDiagnosis = $record->getTimeDiagnosis();
    $clinicID = $record->getClinicID();
    $diagnosisArztID = $record->getDiagnosisArztID();
    $indicationID = $record->getIndicationID();
    $pDrugs = $record->getPDrugs();
    $diagnosisArzttxt = $record->getDiagnosisArzttxt();
    $radtxt = $record->getRadtxt();
    $bdWert1AufnahmeRec = $record->getBdWert1AufnahmeRec();
    $bdWert2AufnahmeRec = $record->getBdWert2AufnahmeRec();
    $bdDescrAufnahmeRec = $record->getBdDescrAufnahmeRec();
    $pConditions = $record->getPConditions();
    $timeSymptomsGesund = $record->getTimeSymptomsGesund();
    if ($clinicID == 0) {
        $clinicID = getDBContent('aerzte', 'clinicID', 'arztID', $diagnosisArztID);
    }
    $timeGesundArray = str_replace(' ', '-', $timeSymptomsGesund);
    $timeGesundArray = explode('-', $timeGesundArray);
    $timeGesundY = $timeGesundArray[0];
    $timeGesundM = $timeGesundArray[1];
    $timeGesundD = $timeGesundArray[2];
    $timeGesundRest = explode(':', $timeGesundArray[3]);
    $timeGesundH = $timeGesundRest[0];
    $timeGesundMin = $timeGesundRest[1];
    $timeSymptomsArray = str_replace(' ', '-', $timeSymptoms);
    $timeSymptomsArray = explode('-', $timeSymptomsArray);
    $timeSymptomsY = $timeSymptomsArray[0];
    $timeSymptomsM = $timeSymptomsArray[1];
    $timeSymptomsD = $timeSymptomsArray[2];
    $timeSymptomsRest = explode(':', $timeSymptomsArray[3]);
    $timeSymptomsH = $timeSymptomsRest[0];
    $timeSymptomsMin = $timeSymptomsRest[1];
    if ($timeHospital == '0000-00-00 00:00:00') {
        $timeHospital = date('Y-m-d H:i:s');
    }
    $timeHArray = str_replace(' ', '-', $timeHospital);
    $timeHArray = explode('-', $timeHArray);
    $timeHY = $timeHArray[0];
    $timeHM = $timeHArray[1];
    $timeHD = $timeHArray[2];
    $timeHRest = explode(':', $timeHArray[3]);
    $timeHH = $timeHRest[0];
    $timeHMin = $timeHRest[1];
    if ($timeDiagnosis == '0000-00-00 00:00:00') {
        $timeDiagnosis = date('Y-m-d H:i:s');
    }
    $timeSArray = str_replace(' ', '-', $timeDiagnosis);
    $timeSArray = explode('-', $timeSArray);
    $timeSY = $timeSArray[0];
    $timeSM = $timeSArray[1];
    $timeSD = $timeSArray[2];
    $timeSRest = explode(':', $timeSArray[3]);
    $timeSH = $timeSRest[0];
    $timeSMin = $timeSRest[1];
    echo "<h3>$diagnoseButton</h3>
            <input type='hidden' name='patientID' value='$patientID' />
            <input type='hidden' name='patientRecordID' value='$patientRecordID' />
            <input type='hidden' name='editStatus' value='$editStatus' />
            ";
    ?>
    <div class="form-group row">
        <div class="col-sm-3">Anfordernde Klinik - Arzt:</div>
        <div class="col-sm-9">
            <!-- diagnosisArztID <?php echo $diagnosisArztID; ?> -->
            <!-- cID <?php echo $clinicID; ?> -->
            <?php
            if ($dmt == 1) {
                echo "<select name='diagnosisArztID' class='form-control'>";
                if ($diagnosisArztID != 0) {
                    $infoDA = Arzt::getArztInfos($diagnosisArztID);
                    echo "<option value='$diagnosisArztID' selected>$infoDA </option>";
                } else {
                    echo "<option  selected>Bitte ausw&auml;hlen</option>";
                }
                $d = new Arzt();
                $docs = $d->getAllEntries();
                if (!empty($docs)) {
                    foreach ($docs as $arzt) {
                        $artzID_here = $arzt->getArztID();
                        $clinicID_here = $arzt->getClinicID();
                        $clinicType = getDBContent('clinics', 'clinicType', 'clinicID', $clinicID_here);
                        $info = Arzt::getArztInfos($artzID_here);
                        if ($artzID_here != $diagnosisArztID && $clinicType == 'k') {
                            echo "<option value='$artzID_here'>$info </option>";
                        }
                    }
                }
                echo "</select>";
            }
            if ($dmt == 0) {
                if ($diagnosisArztID != 0) {
                    $infoDA = Arzt::getArztInfos($diagnosisArztID);
                } else {
                    $arztID = $_SESSION['arztID'];
                    $infoDA = Arzt::getArztInfos($arztID);
                }
                echo "$infoDA
                <input type='hidden' name='diagnosisArztID' value='$diagnosisArztID' />
                ";
            }
            ?>
        </div>
    </div>

    <!--Arztangabe bei Notfall Login-->
    <div class="form-group row">
      <div class="col-sm-3"></div>
      <div class="col-sm-9">
        <div>
          <label data-toggle="collapse" data-target="#diagnosisArzttxt">
            <input type="checkbox" <?php echo $diagnosisArzttxt!='' ?  'checked' :  '' ?>/>
            Arztangabe bei Notfall Login etc.
          </label>
        </div>
        <div id="diagnosisArzttxt" class="collapse <?php echo $diagnosisArzttxt!='' ?  'show' :  ''; ?>">
          <span>Arztangabe bei Notfall Login, Station etc.:</span>
          <input type="text" class='form-control' name='diagnosisArzttxt' value='<?php echo $diagnosisArzttxt; ?>' size='50' >
        </div>
      </div>
    </div>

    <hr>

    <?php
    $dayArray = array('timeSymptomsDay', $timeSymptomsD);
    $monthArray = array('timeSymptomsMonth', $timeSymptomsM);
    $yearArray = array('timeSymptomsYear', $timeSymptomsY);
    $hourArray = array('timeSymptomsHour', $timeSymptomsH);
    $minuteArray = array('timeSymptomsMinutes', $timeSymptomsMin);
    $color = '#ff0000';
    createFormRow_DateTime("Beginn der Symptomatik:", $dayArray, $monthArray, $yearArray, $hourArray, $minuteArray, $color);
    ?>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <?php
            $symptomArray[4] = "Bekannt";
            $symptomArray[1] = "Unbekannt";
            $symptomArray[2] = "Im Schlaf";
            $symptomArray[3] = "Sonstiges";
            foreach ($symptomArray as $symptomKey => $symptomText) {
                ($symptomKey == $symptomsText2) ? $checked = "checked" : $checked = "";
                echo "
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' type='radio' 
                                name='symptomsText2' id='symp_$symptomKey' value='$symptomKey' $checked/>
                             <label class='form-check-label' for='symp_$symptomKey'>$symptomText</label>
                         </div>";
            }
            ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="symptomsText" class="col-sm-3"></label>
        <div class="col-sm-9"><input name='symptomsText' id='symptomsText' class='form-control'
                                     value='<?php echo $symptomsText; ?>'/></div>
    </div>
    <?php
    $dayArray = array('timeGesundDay', $timeGesundD);
    $monthArray = array('timeGesundMonth', $timeGesundM);
    $yearArray = array('timeGesundYear', $timeGesundY);
    $hourArray = array('timeGesundHour', $timeGesundH);
    $minuteArray = array('timeGesundMinutes', $timeGesundMin);
    $color = '#999966';
    createFormRow_DateTime("Zuletzt gesund gesehen:", $dayArray, $monthArray, $yearArray, $hourArray, $minuteArray, $color);
    echo "<hr>";
    if ($case == 'dmt') {
        ?>
        <div class="row">
            <label for="timeInitialContact" class="col-sm-3">Erstkontakt mit med. Personal:</label>
            <div class="col-sm-9"><input name='timeInitialContact' id='timeInitialContact'
                                         value='<?php echo $timeInitialContact; ?>'/></div>
        </div>
        <?php
    }
    $dayArray = array('timeHospitalDay', $timeHD);
    $monthArray = array('timeHospitalMonth', $timeHM);
    $yearArray = array('timeHospitalYear', $timeHY);
    $hourArray = array('timeHospitalHour', $timeHH);
    $minuteArray = array('timeHospitalMinutes', $timeHMin);
    $color = '#FF9900';
    createFormRow_DateTime("Klinikaufnahme", $dayArray, $monthArray, $yearArray, $hourArray, $minuteArray, $color);
    echo " <hr>";
    if ($dmt == 1) {
        $title = "$diagnoseButton <i class='fa icon-calendar'></i> (nirgends sichtbar)";
        $dayArray = array('timeDiagnosisDay', $timeSD);
        $monthArray = array('timeDiagnosisMonth', $timeSM);
        $yearArray = array('timeDiagnosisYear', $timeSY);
        $hourArray = array('timeDiagnosisHour', $timeSH);
        $minuteArray = array('timeDiagnosisMinutes', $timeHMin);
        $color = '#7ed9f3';
        createFormRow_DateTime($title, $dayArray, $monthArray, $yearArray, $hourArray, $minuteArray, $color);
        echo " <hr>";
    }
    if ($case == 'web') {
        echo "<input type='hidden' name='timeDiagnosis' value='$timeDiagnosis' />";
    }
    ?>
    <!--Anamnese-->
    <div class="row mb-3">
        <label for="symptomDescr" class="col-sm-3">Aktuelle Anamnese:</label>
        <div class="col-sm-9"><textarea class='ckeditor form-control' name='symptomDescr' id='symptomDescr' rows='8'
                                        class='form-control'><?php echo $symptomDescr; ?></textarea>
        </div>
    </div>
    <hr>

    <!--radiologischer Befund-->
    <div class="form-group row">
      <div class="col-sm-3"></div>
      <div class="col-sm-9">
        <div>
          <label data-toggle="collapse" data-target="#radtxt">
            <input type="checkbox" <?php echo $radtxt!='' ?  'checked' :  '' ?>/>
            radiologischer Befund
          </label>
        </div>
        <div id="radtxt" class="collapse <?php echo $radtxt!='' ?  'show' :  ''; ?>">
          <div>(falls bereits vorhanden):</div>
          <textarea type="text" class='ckeditor form-control' name='radtxt'><?php echo $radtxt; ?></textarea> 
        </div>
      </div>
    </div>
    <hr>

    <!-- Medikamente-->
    <div class="row">
        <label for="pDrugs" class="col-sm-3">Medikamente:</label>
        <div class="col-sm-9"><textarea class='form-control' name='pDrugs' id='pDrugs'
                                        class='form-control'><?php echo $pDrugs; ?></textarea>
            <!-- Medication-->
            <?php
            $i = 0;
            $m = new Medication();
            $meds = $m->getAllEntries();
            if (!empty($meds)) {
                foreach ($meds as $med) {
                    $i++;
                    $idM = $med->getMedicationID();
                    $nameM = $med->getMedicationName();
                    $okayM = Patient::getPatientInfosFromPatientInfos($patientRecordID, $idM, 'm');
                    ($okayM == 1) ? $checked = "checked" : $checked = "";
                    ?>
                    <div class='form-check form-check-inline'>
                        <input class='form-check-input' type='checkbox'
                               name='pInfoIDsM[]'
                               id='pInfoIDsM_<?php echo $i; ?>'
                               value='<?php echo $idM; ?>'
                            <?php echo $checked; ?> />
                        <label class='form-check-label'
                               for='pInfoIDsM_<?php echo $i; ?>'><?php echo $nameM; ?></label>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <hr>
    <!-- Vorerkrankungen-->
    <div class="row mb-3">
        <label for="pConditions" class="col-sm-3">Vorer&shy;krankungen/<br>Risikofaktoren:</label>
        <div class="col-sm-9"><textarea class=' form-control' name='pConditions' id='pConditions'
                                        class='form-control'><?php echo $pConditions; ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <?php
            $count = getMaxEntries('infoMedication', 'medicationID');
            $c = new Condition();
            $conditions = $c->getAllEntries();
            if (!empty($conditions)) {
                foreach ($conditions as $condition) {
                    $count++;
                    $idC = $condition->getConditionID();
                    $nameC = $condition->getConditionName();
                    $okayC = Patient::getPatientInfosFromPatientInfos($patientRecordID, $idC, 'c');
                    ($okayC == 1) ? $checked = "checked" : $checked = "";
                    ?>
                    <div class='form-check form-check-inline'>
                        <input class='form-check-input' type='checkbox'
                               name='pInfoIDsC[]'
                               id='pInfoIDsC_<?php echo $count; ?>'
                               value='<?php echo $idC; ?>'
                            <?php echo $checked; ?> />
                        <label class='form-check-label'
                               for='pInfoIDsC_<?php echo $count; ?>'><?php echo $nameC; ?></label>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <div class="row mb-3">
      <div class="col-sm-3">Blutdruck bei Aufnahme:</div>
      <div class="col-sm-9">
        <input name='bdWert1AufnahmeRec' id='bdWert1AufnahmeRec' value='<?php echo $bdWert1AufnahmeRec; ?>' class='col-2 form-control form-check-inline text-right'/>
        <span> /</span>
        <input name='bdWert2AufnahmeRec' id='bdWert2AufnahmeRec' value='<?php echo $bdWert2AufnahmeRec; ?>' class='col-2 form-control form-check-inline text-right'/>
        <span> mmHg =></span>
        <input name='bdDescrAufnahmeRec' id='bdDescrAufnahmeRec' value='<?php echo $bdDescrAufnahmeRec; ?>' class='col-2 form-control form-check-inline text-right'/> 
      </div>
    </div>

    <div class="row mb-5">
        <div class="col-sm-3">Indikations&shy;kodierung:</div>
        <div class="col-sm-9">
            <?php
            getIndicationSelectMenu($indicationID);
            ?>
        </div>
    </div>
    <?php
}

function editPatientRecordTherapy($patientRecordID)
{
    global $dmt, $url, $diagnoseButton, $therapyButton;
    $r = new PatientRecord();
    $record = $r->getRecord($patientRecordID);
    $timeTreatment = $record->getTimeTreatment();
    $therapyArztID = $record->getTherapyArztID();
    $konsilType = $record->getKonsilType();
    $visualData = $record->getVisualData();
    $visualDataDescr = $record->getVisualDataDescr();
    $indication2ID = $record->getIndication2ID();
    $indication2DID = $record->getIndication2DID();
    $therapyDescr = $record->getTherapyDescr1();
    $therapyDescr2 = $record->getTherapyDescr2();
    $therapyDescr3 = $record->getTherapyDescr3();
    $patientID = $record->getPatientID();
    $therapyArzttxt = $record->getTherapyArzttxt();
    $patid_abgleich = $record->getPatid_abgleich();
    $bgart = $record->getBgart();
    $radbef = $record->getRadbef();
    $bgproblem = $record->getBgproblem();
    $bgpblmtxt = $record->getBgpblmtxt();
    $nihssint = $record->getNihssint();
    $kuproblem = $record->getKuproblem();
    $videopblmtxt = $record->getVideopblmtxt();
    $proxgv = $record->getProxgv();
    $proxgvtxt = $record->getProxgvtxt();
    $mrs = $record->getMrs();
    $lyseempfint = $record->getLyseempfint();
    $offlabellyse = $record->getOfflabellyse();
    $tbempfint = $record->getTbempfint();
    $verlegort = $record->getVerlegort();
    $verlegtxt = $record->getVerlegtxt();
    $freenote = $record->getFreenote();
    $lysezeitbolus = $record->getLysezeitbolus();
    $visualData = explode(',', $visualData);
    if ($timeTreatment == '0000-00-00 00:00:00') {
        $timeTreatment = date('Y-m-d H:i:s');
    }
    $timeTArray = str_replace(' ', '-', $timeTreatment);
    $timeTArray = explode('-', $timeTArray);
    $timeTY = $timeTArray[0];
    $timeTM = $timeTArray[1];
    $timeTD = $timeTArray[2];
    $timeTRest = explode(':', $timeTArray[3]);
    $timeTH = $timeTRest[0];
    $timeTMin = $timeTRest[1];
    echo "<h2>$therapyButton eingeben</h2>";
    ?>
    <fieldset>
        <?php
        showPatientNameBDay($patientID, false, 'legend');
        echo "<h3>$diagnoseButton</h3>";
        showPatientRecordDiagnose($patientRecordID);
        echo "<hr>";
        echo "<h3>$therapyButton</h3>";
        ?>
        <form method='Post' action='<?php echo $url; ?>'>
            <?php
            echo "
                    <input type='hidden' name='x' value='3310' />
                    <input type='hidden' name='patientID' value='$patientID' />
                    <input type='hidden' name='patientRecordID' value='$patientRecordID' />";
            hiddenDiagnosisFields($patientRecordID);
            ?>
            <div class="row mb-3">
                <div class="col-sm-3"><?php echo "Arzt $therapyButton:"; ?></div>
                <div class="col-sm-9">
                    <?php
                    if ($dmt == 1) {
                        echo "<select name='therapyArztID' class='form-control mb-3'>";
                        if ($therapyArztID != 0) {
                            $infoDA = Arzt::getArztInfos($therapyArztID);
                            echo "<option value='$therapyArztID' selected>$infoDA </option>";
                        } else {
                            echo "<option  selected>Bitte ausw&auml;hlen</option>";
                        }
                        $d = new Arzt();
                        $docs = $d->getAllEntries();
                        if (!empty($docs)) {
                            foreach ($docs as $arzt) {
                                $artzID_here = $arzt->getArztID();
                                $clinicID_here = $arzt->getClinicID();
                                $clinicType = getDBContent('clinics', 'clinicType', 'clinicID', $clinicID_here);
                                $info = Arzt::getArztInfos($artzID_here);
                                if ($artzID_here != $therapyArztID && $clinicType == 'z') {
                                    echo "<option value='$artzID_here'>$info </option>";
                                }
                            }
                        }
                        echo "</select>";
                    }
                    if ($dmt == 0) {
                        if ($therapyArztID != 0) {
                            $infoDA = Arzt::getArztInfos($therapyArztID);
                            echo "$infoDA<input type='hidden' name='therapyArztID' value='$therapyArztID' />";
                        } else {
                            $arztID = $_SESSION['arztID'];
                            $infoDA = Arzt::getArztInfos($arztID);
                            echo "$infoDA<input type='hidden' name='therapyArztID' value='$arztID' />";
                        }
                    }
                    ?></div>
            </div>
            <div class="row mb3">
              <div class="col-sm-3"></div>
              <div class="col-sm-9">
                <div>
                  <label data-toggle="collapse" data-target="#therapyArzttxt">
                    <input type="checkbox" <?php echo $therapyArzttxt!='' ?  'checked' :  '' ?>/>
                    Arztangabe bei Notfall Login etc.
                  </label>
                </div>
                <div id="therapyArzttxt" class="collapse <?php echo $therapyArzttxt!='' ?  'show' :  ''; ?>">
                  <span>Arztangabe bei Notfall Login, Station etc.:</span>
                  <input type="text" class='form-control' name='therapyArzttxt' value='<?php echo $therapyArzttxt; ?>' size='50' >
                </div>
              </div>
            </div>

            <hr>

            <?php
            $dayArray = array('timeTreatmentDay', $timeTD);
            $monthArray = array('timeTreatmentMonth', $timeTM);
            $yearArray = array('timeTreatmentYear', $timeTY);
            $hourArray = array('timeTreatmentHour', $timeTH);
            $minuteArray = array('timeTreatmentMinutes', $timeTMin);
            $color = '#ff0000';
            createFormRow_DateTime("Untersuchung:", $dayArray, $monthArray, $yearArray, $hourArray, $minuteArray, $color);
            ?>

            <div class="row mb-3">
                <div class='col-sm-3'>Art des Konsils:</div>
                <div class='col-sm-9'>
                    <?php
                    ($konsilType == 't') ? $tChecked = "checked" : $tChecked = "";
                    ($konsilType == 'b') ? $bChecked = "checked" : $bChecked = "";
                    ($konsilType == 'v') ? $vChecked = "checked" : $vChecked = "";
                    ?>
                    <input type='radio' name='konsilType' id='konsilTypeT' value='t' <?php echo $tChecked; ?>>
                    <label for='konsilTypeT'>Telefon</label>
                    <input type='radio' name='konsilType' id='konsilTypeB' value='b' <?php echo $bChecked; ?>>
                    <label for='konsilTypeB'>Bild und Telefon</label>
                    <input type='radio' name='konsilType' id='konsilTypeV' value='v' <?php echo $vChecked; ?>>
                    <label for='konsilTypeV'>Video</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Patienten-ID gepr&uuml;ft?</div>
                <div class='col-sm-9'>
                <input type="checkbox" name='patid_abgleich' value='j' <?php echo $patid_abgleich == 'j' ? 'checked' : '' ?>>
                <span>Patientenidentifizierung und Abgleich der Patientendaten in Konsilanforderung und Bildgebung erfolgt</span>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class='col-sm-3'>Bildgebung vorhanden:</div>
                <div class='col-sm-9'>
                <select name="bgart">
                  <?php
                    $array = array('ja', 'nein', 'm&uuml;ndlich');
                    createSelectMenu($array, $bgart);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>radiologischer Befund:</div>
                <div class='col-sm-9'>
                <select name="radbef">
                  <?php
                  $array	= array("nicht verf&uuml;gbar","m&uuml;ndlich", "schriftlich");
                  createSelectMenu($array, $radbef);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Bildbewertung:</div>
                <div class='col-sm-9'>
                <textarea name="visualDataDescr" class="form-control ckeditor"><?php echo $visualDataDescr; ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Art der Bildgebung:</div>
                <div class='col-sm-9'>
                    <?php
                    ($visualData[0] == 'on') ? $aChecked = "checked" : $aChecked = "";
                    ($visualData[1] == 'on') ? $bChecked = "checked" : $bChecked = "";
                    ($visualData[2] == 'on') ? $cChecked = "checked" : $cChecked = "";
                    ($visualData[3] == 'on') ? $dChecked = "checked" : $dChecked = "";
                    ?>
                    <input type='checkbox' name='visualData[0]' id='vD0' <?php echo $aChecked; ?>>
                    <label for='vD0' class='mr-3'> CCT </label>
                    <input type='checkbox' name='visualData[1]' id='vD1' <?php echo $bChecked; ?>>
                    <label for='vD1' class='mr-3'> CCT+CT A </label>
                    <input type='checkbox' name='visualData[2]' id='vD2' <?php echo $cChecked; ?>>
                    <label for='vD2' class='mr-3'> cMRT </label>
                    <input type='checkbox' name='visualData[3]' id='vD3' <?php echo $dChecked; ?>>
                    <label for='vD3'> Keine Bildgebung </label>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Probleme bei der Bildgebung:</div>
                <div class='col-sm-9'>
                <select name="bgproblem">
                  <?php
                  $array	= array("keine","Bild nicht eingespielt", "zu langsam", "schlechte Bildqualit&auml;t", "andere");
                  createSelectMenu($array, $bgproblem);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'></div>
                <div class='col-sm-9'>
                  <input type='text' class='form-control' name='bgpblmtxt' value='<?php echo $bgpblmtxt; ?>' />
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class='col-sm-3'>Klinischer Befund:</div>
                <div class='col-sm-9'><textarea class='ckeditor form-control' name='therapyDescr' rows='8'
                                                cols='40'><?php echo "$therapyDescr"; ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>NIHSS-Wert eintragen:</div>
                <div class='col-sm-9'>
                <select name='nihssint'>
                  <?php
                  $array = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "nicht zutreffend");
                  createSelectMenu($array, $nihssint);
                  ?>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Probleme bei der Videountersuchung:</div>
                <div class='col-sm-9'>
                <select name='kuproblem'>
                  <?php
                  $array = array("keine", "Tonqualit&auml;t", "Bildqualit&auml;t", "andere");
                  createSelectMenu($array, $kuproblem);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'></div>
                <div class='col-sm-9'>
                  <input type='text' class='form-control' name='videopblmtxt' value='<?php echo $videopblmtxt; ?>' />
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class='col-sm-3'>Verdachtsdiagnose:</div>
                <div class='col-sm-9'>
                <textarea class='ckeditor form-control' name='therapyDescr2' ><?php echo "$therapyDescr2"; ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Prox. GV:</div>
                <div class='col-sm-9'>
                <select name='proxgv'>
                  <?php
                  $array	= array("kein","ACI li", "ACI re", "M1 li", "M1 re", "M2 li", "M2 re", "AV li", "AV re", "BA", "anderes Gef&auml;&szlig;", "sonstige", "mehrere");
                  createSelectMenu($array, $proxgv);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'></div>
                <div class='col-sm-9'>
                  <input type='text' class='form-control' name='proxgvtxt' value='<?php echo $proxgvtxt; ?>' />
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>pre Stroke mRS:</div>
                <div class='col-sm-9'>
                <select name='mrs'>
                  <?php
                  $array	= array("nicht beurteilt", "nicht zutreffend","0", "1","2", "3", "4", "5");
                  createSelectMenu($array, $mrs);
                  ?>
                </select>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class='col-sm-3'>Beurteilung und Therapie-Empfehlungen:</div>
                <div class='col-sm-9'><textarea class='ckeditor form-control' name='therapyDescr3'
                                                rows='7'><?php echo "$therapyDescr3"; ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Lyse empfohlen:</div>
                <div class='col-sm-9'>
                <select name='lyseempfint'>
                  <?php
                  $array	= array("Nein", "Ja");
                  createSelectMenu($array, $lyseempfint);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Lysezeitbolus:</div>
                <div class='col-sm-4'>
                  <div class="row">
                    <?php
                      $LZBolusArray	= explode(':',$lysezeitbolus);
                      $timeLZBH		= $LZBolusArray[0];
                      $timeLZBMin	    = $LZBolusArray[1];
                      createHoursFields('lysezeitbolusHour', $timeLZBH);
                    ?>
                    <span class="col-1">:</span>
                    <?php
                      createMinutesFields('lysezeitbolusMinutes', $timeLZBMin);
                    ?>
                    <span class="col-2">Uhr</span>
                  </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>off-label-Lyse:</div>
                <div class='col-sm-9'>
                <select name='offlabellyse'>
                  <?php
                  $array	= array("Nein", "Ja");
                  createSelectMenu($array, $offlabellyse);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Thrombektomie empfohlen:</div>
                <div class='col-sm-9'>
                <select name='tbempfint'>
                  <?php
                  $array	= array("Nein", "Ja");
                  createSelectMenu($array, $tbempfint);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Patient verlegt nach:</div>
                <div class='col-sm-9'>
                <select name='verlegort'>
                  <?php
                  $array	= array("keine","Erlangen", "N&uuml;rnberg", "Bayreuth", "W&uuml;rzburg", "Ingolstadt", "anderes");
                  createSelectMenu($array, $verlegort);
                  ?>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'></div>
                <div class='col-sm-9'>
                  <input type='text' class='form-control' name='verlegtxt' value='<?php echo $verlegtxt; ?>' />
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>freie Bemerkung:</div>
                <div class='col-sm-9'>
                <textarea class='ckeditor form-control' name='freenote' rows='8'><?php echo "$freenote"; ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'>Diagnosekodierung:</div>
                <div class='col-sm-4'>
                    <?php
                    getIndication2SelectMenu($indication2ID);
                    ?>
                </div>
                <div class='col-sm-4'>
                    <?php
                    getIndication2DetailSelectMenu($indication2DID);
                    ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class='col-sm-3'><h3>STATUS</h3></div>
                <div class='col-sm-9'>
                  <div class="row">
                      <input type='radio' name='editStatus' id='editStatusO' value='o' class='form-check-inline'>
                      <label for='editStatusO'>offen (Therapie-Empfehlung wird noch erg&auml;nzt)</label>
                  </div>
                  <div class="row">
                      <input type='radio' name='editStatus' id='editStatusT' value='t' class='form-check-inline' checked>
                      <label for='editStatusT'>abgeschlossen (Therapie-Empfehlung vorhanden)</label>
                  </div>
                </div>
            </div>

            <button class='btn btn-primary mb-3'>Therapie-Empfehlung speichern</button>
        </form>
    </fieldset>
    <?php
}

function savePatientNIHSSTotal($patientID, $patientRecordID, $nihssTotal)
{
    global $dmt;
    $connection = new Access();
    $access = $connection->connectDB();
    $ID = "";
    if ($access) {
        $timeNIHSS = date('Y-m-d H:i:s');
        if ($dmt == 1) {
            $arztID = Arzt::getAdminID();
        } else {
            $arztID = $_SESSION['arztID'];
        }
        $where = ' arztID, patientID, patientRecordID, timeNIHSS, nihssTotal';
        $value = "'$arztID','$patientID','$patientRecordID','$timeNIHSS','$nihssTotal'";
        $db_request = "INSERT INTO `patientNIHSS` (" . $where . ") VALUES (" . $value . ")";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $ID = mysqli_insert_id($access);
        } else {
            echo "<p class='errorMessage'>
            Konnte kein neuen Eintrag in patientNIHSS erzeugen 
            [savePatientNIHSSTotal($patientID, $patientRecordID, $nihssTotal) ]!</p>";
        }
    } else {
        echo "<p class='errorMessage'>Kein Zugriff auf Datenbank [savePatientNIHSSTotal($patientID, $patientRecordID, $nihssTotal) ]!</p>";
    }
    return $ID;
}

function savePatientInfos($patientRecordID, $pInfoIDsM, $pInfoIDsC)
{
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $existingInfosM = array();
        $existingInfosC = array();
        $db_request = "SELECT infoType, infoID FROM `patientInfos` WHERE patientRecordID = '$patientRecordID' ";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $rows = mysqli_num_rows($query_handle);
            if ($rows > 0) {
                for ($i = 0; $i <= $rows; $i++) {
                    $data = mysqli_fetch_row($query_handle);
                    $type = $data[0];
                    $id = $data[1];
                    if ($type == 'm') $existingInfosM[] = $id;
                    if ($type == 'c') $existingInfosC[] = $id;
                }
            }
        }
        $allM = new Medication();
        $allMedIDs = $allM->getAllMedIDs();
        if (!empty($allMedIDs)) {
            foreach ($allMedIDs as $medID) {
                if (!empty($existingInfosM)) {
                    if (in_array($medID, $existingInfosM)) { 
                        if (!in_array($medID, $pInfoIDsM)) {
                            deletePatientInfoEntry($patientRecordID, $medID, 'c');
                        }
                    } else { 
                        if (in_array($medID, $pInfoIDsM)) { 
                            addNewPatientInfoEntry($patientRecordID, $medID, 'm');
                        }
                    }
                } else {
                    if (in_array($medID, $pInfoIDsM)) { 
                        addNewPatientInfoEntry($patientRecordID, $medID, 'm');
                    }
                }
            }
        }
        $allC = new Condition();
        $allCondIDs = $allC->getAllConditionIDs();
        if (!empty($allCondIDs)) {
            foreach ($allCondIDs as $cID) {
                if (!empty($existingInfosC)) {
                    if (in_array($cID, $existingInfosC)) { 
                        if (!in_array($cID, $pInfoIDsC)) {
                            deletePatientInfoEntry($patientRecordID, $cID, 'c');
                        }
                    } else { 
                        if (in_array($cID, $pInfoIDsC)) { 
                            addNewPatientInfoEntry($patientRecordID, $cID, 'c');
                        }
                    }
                } else {
                    if (in_array($cID, $pInfoIDsC)) { 
                        addNewPatientInfoEntry($patientRecordID, $cID, 'c');
                    }
                }
            }
        }
    } else {
        echo "<p class='errorMessage'>Kein Zugriff auf Datenbank [savePatientInfos, p-Rec-ID: $patientRecordID]!</p>";
    }
}

function addNewPatientInfoEntry($patientRecordID, $id, $type)
{
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $where = 'patientRecordID, infoID, infoType';
        $value = "'$patientRecordID','$id','$type'";
        $db_request = "INSERT INTO `patientInfos` (" . $where . ") VALUES (" . $value . ")";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $ID = mysqli_insert_id($access);
        } else {
            echo "<p class='errorMessage'>
                           Konnte kein neuen Eintrag in patientInfos erzeugen 
                           RecordID: $patientRecordID, infoID: $id, type $type
                           </p>";
        }
    }
}

function addPatientForm($pLastName, $addCSS)
{
    global $url;
    ($pLastName != "") ? $x = '1015' : $x = '1010';
    ($pLastName != "") ? $title = 'Patient speichern' : $title = 'Patient anlegen';
    $_SESSION['addOption'] = 0;
    ?>
    <div class="row mt-5">
        <div class="col-12">
            <form method='post' action='<?php echo $url; ?>' id="addPatient">
                <fieldset>
                    <legend>Neuen Patienten anlegen:</legend>
                    <input type='hidden' name='x' value='<?php echo $x; ?>'/>
                    <div class="form-row">
                        <label for="pLastName" class="col-sm-4 col-form-label">Nachname des Patienten:</label>
                        <input class="col-sm-8 form-control" id='pLastName' name='pLastName'
                               value='<?php echo $pLastName; ?>' placeholder="Muster-Nachname" required/>
                    </div>
                    <button class="btn btn-primary mt-3 mb-3 <?php if ($addCSS != '') echo $addCSS; ?> ">Patient
                        eintragen
                    </button>
                </fieldset>
            </form>
        </div>
    </div>
    <?php
}

function addPatientAndShowEdit($pLastName)
{
    $addOption = $_SESSION['addOption'];
    if ($addOption == 0) {
        $patient = new Patient();
        $patient->setPLastName($pLastName);
        $info = $patient->saveEntry_patient($patient);
        $patientID = key($info);
        editPatientAndDiagnoseWrapper($patientID);
    } else {
        echo "<h2><img src='assets/imagesLayout/blinkenRot.gif'> Offene Konsilschein-&Uuml;bersicht</h2>";
        listAllPatientsRecords('o');
    }
}

function deletePatientInfoEntry($patientRecordID, $id, $type)
{
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $db_request = "DELETE FROM `patientInfos` WHERE patientRecordID = '$patientRecordID' 
            AND infoID = '$id' AND infoType = '$type'";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
        } else {
            print "<p class='errorMessage'>
                    Konnte den patienInfo Eintrag nicht in Datenbank l&ouml;schen, 
                    RecordID: $patientRecordID, infoID: $id, type $type
                    </p>";
        }
    }
}

function viewBlock_Patient_PatientThrombolyse($patientID, $ptID, $workCase)
{
    global $baseURL;
    ?>
    <h1>Thrombolyse Dokumentation</h1>
    <fieldset>
        <?php
        showPatientNameBDay($patientID, false, 'legend'); 
        showPatientThrombolyseWerte($ptID);
        ?>
    </fieldset>
    <?php
    if ($workCase == "edit") {
        ?>
        <h3 class='mt-3 p-2'>Nachtr&auml;gliches Bearbeiten der Thrombolyse-Dokumentation:</h3>
        <?php
        editThrombolyseForm($patientID, $ptID);
        navPatient($patientID);
    }
}

function viewBlock_Patient_RecordList($patientID)
{
    ?>
    <fieldset>
        <?php
        showPatientNameBDay($patientID, false, 'legend');
        listPatientRecords($patientID, '');
        ?>
    </fieldset>
    <?php
}

function viewBlock_Patient_Record($patientID, $patientRecordID)
{
    ?>
    <fieldset>
        <?php
        showPatientNameBDay($patientID, false, 'legend');
        showPatientRecordWrapper($patientRecordID); 
        ?>
    </fieldset>
    <?php
}

function selectExistingPatientForm($pLastName, $patients)
{
    global $url;
    $cnt = count($patients);
    ($cnt == 1) ? $info = " einen  Patienten " : $info = "mehrere Patienen";
    $pLastName = ucfirst($pLastName);
    ?>
    <fieldset class='mt-5 mb-5'>
        <legend>Vorhandenen Patieneneintrag mit dem Nachnamen '<?php echo $pLastName; ?>' ausw&auml;hlen</legend>
        <form method='post' action='<?php echo $url; ?>'>
            <input type='hidden' name='x' value='1020'/>
            Es gibt bereits <?php echo $info; ?> mit dem Nachnamen '<?php echo $pLastName; ?>'.
            <ul class='list-unstyled mt-3'>
                <?php
                foreach ($patients as $patientID) {
                    $info = patientInfoShort($patientID);
                    $pFirstName = $info[0];
                    $pLastName = $info[1];
                    $bday = $info[2];
                    echo "<li><input type='radio' name='patientID' value='$patientID' required /> ";
                    showPatientNameBDay($patientID, false, "");
                    echo "</li>";
                }
                ?>
            </ul>
            <button class="btn btn-primary mb-3">Ja, ausgew&auml;hlten Patienten &uuml;bernehmen</button>
        </form>
    </fieldset>
    <?php
    echo "<p>Oder tats&auml;chlich einen neuen Patienten mit dem Namen '$pLastName' anlegen:</p>";
    addPatientForm($pLastName, 'bg-secondary');
}
