<?php
/**

 * ------------------------------------------------------------------
 * receive all variables from $_GET and $_POST
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


$x = getSecurePOSTAndGETData('x');
$rowHR = "<tr><td colspan='3'><hr></td></tr>";
$indicationID = getSecurePOSTAndGETData('indicationID');
$indicationName = getSecurePOSTAndGETData('indicationName');
$indicationCode = getSecurePOSTAndGETData('indicationCode');
$indicationComment = getSecurePOSTAndGETData('indicationComment');
$indication2ID = getSecurePOSTAndGETData('indication2ID');
$indication2Name = getSecurePOSTAndGETData('indication2Name');
$indication2Code = getSecurePOSTAndGETData('indication2Code');
$indication2Comment = getSecurePOSTAndGETData('indication2Comment');
$indication2DID = getSecurePOSTAndGETData('indication2DID');
$indication2DName = getSecurePOSTAndGETData('indication2DName');
$indication2DCode = getSecurePOSTAndGETData('indication2DCode');
$conditionID = getSecurePOSTAndGETData('conditionID');
$conditionName = getSecurePOSTAndGETData('conditionName');
$conditionText = getPOSTAndGETData('conditionText');
$conditionComment = getSecurePOSTAndGETData('conditionComment');
$symptomID = getSecurePOSTAndGETData('symptomID');
$symptomName = getSecurePOSTAndGETData('symptomName');
$symptomText = getPOSTAndGETData('symptomText');
$symptomComment = getSecurePOSTAndGETData('symptomComment');
$therapyID = getSecurePOSTAndGETData('therapyID');
$therapyName = getSecurePOSTAndGETData('therapyName');
$therapyText = getPOSTAndGETData('therapyText');
$therapyComment = getSecurePOSTAndGETData('therapyComment');
$arztID = getSecurePOSTAndGETData('arztID');
$arztGender = getSecurePOSTAndGETData('arztGender');
$acadTitle = getSecurePOSTAndGETData('acadTitle');
$arztFirstName = getSecurePOSTAndGETData('arztFirstName');
$arztLastName = getSecurePOSTAndGETData('arztLastName');
$arztPhone = getSecurePOSTAndGETData('arztPhone');
$arztComment = getSecurePOSTAndGETData('arztComment');
$userID = getSecurePOSTAndGETData('userID');
$userLogin = getSecurePOSTAndGETData('userLogin');
$userPW = getSecurePOSTAndGETData('userPW');
$userEMail = getSecurePOSTAndGETData('userEMail');
$requestInfos = getSecurePOSTAndGETData('requestInfos');
$clinicID = getSecurePOSTAndGETData('clinicID');
$capitalLetter = getSecurePOSTAndGETData('capitalLetter');
$patientID = getSecurePOSTAndGETData('patientID');
$pFirstName = getSecurePOSTAndGETData('pFirstName');
$pLastName = getSecurePOSTAndGETData('pLastName');
$pBday = getSecurePOSTAndGETData('pBday');
if ($pBday == '') {
    $pBdayDay = getSecurePOSTAndGETData('pBdayDay');
    $pBdayMonth = getSecurePOSTAndGETData('pBdayMonth');
    $pBdayYear = getSecurePOSTAndGETData('pBdayYear');
    $pBday = $pBdayYear . '-' . $pBdayMonth . '-' . $pBdayDay;
}
$pStreet = getSecurePOSTAndGETData('pStreet');
$pZipCode = getSecurePOSTAndGETData('pZipCode');
$pCity = getSecurePOSTAndGETData('pCity');
$pPhone = getSecurePOSTAndGETData('pPhone');
$pGender = getSecurePOSTAndGETData('pGender');
$patientEntry = new Patient();
if ($patientID != "") $patientEntry = $patientEntry->getPatient($patientID);
$patientEntry->setPFirstName($pFirstName);
$patientEntry->setPLastName($pLastName);
$patientEntry->setPBday($pBday);
$patientEntry->setPStreet($pStreet);
$patientEntry->setPZipCode($pZipCode);
$patientEntry->setPCity($pCity);
$patientEntry->setPPhone($pPhone);
$patientEntry->setPGender($pGender);
$patientRecordID = getSecurePOSTAndGETData('patientRecordID');
$timeSymptoms = getSecurePOSTAndGETData('timeSymptoms');
if ($timeSymptoms == '') {
    $timeSymptomsDay = getSecurePOSTAndGETData('timeSymptomsDay');
    $timeSymptomsMonth = getSecurePOSTAndGETData('timeSymptomsMonth');
    $timeSymptomsYear = getSecurePOSTAndGETData('timeSymptomsYear');
    $timeSymptomsHour = getSecurePOSTAndGETData('timeSymptomsHour');
    $timeSymptomsMinutes = getSecurePOSTAndGETData('timeSymptomsMinutes');
    $timeSymptoms = $timeSymptomsYear . "-" . $timeSymptomsMonth . "-" . $timeSymptomsDay . " " . $timeSymptomsHour . ":" . $timeSymptomsMinutes . ":00";
}
$symptomsText = getSecurePOSTAndGETData('symptomsText');
$symptomsText2 = getSecurePOSTAndGETData('symptomsText2');
$timeSymptomsGesund = getSecurePOSTAndGETData('timeSymptomsGesund');
if ($timeSymptomsGesund == '') {
    $timeGesundDay = getSecurePOSTAndGETData('timeGesundDay');
    $timeGesundMonth = getSecurePOSTAndGETData('timeGesundMonth');
    $timeGesundYear = getSecurePOSTAndGETData('timeGesundYear');
    $timeGesundHour = getSecurePOSTAndGETData('timeGesundHour');
    $timeGesundMinutes = getSecurePOSTAndGETData('timeGesundMinutes');
    $timeSymptomsGesund = $timeGesundYear . "-" . $timeGesundMonth . "-" . $timeGesundDay . " " . $timeGesundHour . ":" . $timeGesundMinutes . ":00";
}
$timeInitialContact = getSecurePOSTAndGETData('timeInitialContact');
$timeHospital = getSecurePOSTAndGETData('timeHospital');
if ($timeHospital == '') {
    $timeHospitalDay = getSecurePOSTAndGETData('timeHospitalDay');
    $timeHospitalMonth = getSecurePOSTAndGETData('timeHospitalMonth');
    $timeHospitalYear = getSecurePOSTAndGETData('timeHospitalYear');
    $timeHospitalHour = getSecurePOSTAndGETData('timeHospitalHour');
    $timeHospitalMinutes = getSecurePOSTAndGETData('timeHospitalMinutes');
    $timeHospital = $timeHospitalYear . "-" . $timeHospitalMonth . "-" . $timeHospitalDay . " " . $timeHospitalHour . ":" . $timeHospitalMinutes . ":00";
}
$timeDiagnosis = getSecurePOSTAndGETData('timeDiagnosis');
if ($timeDiagnosis == '') {
    $timeDiagnosisDay = getSecurePOSTAndGETData('timeDiagnosisDay');
    $timeDiagnosisMonth = getSecurePOSTAndGETData('timeDiagnosisMonth');
    $timeDiagnosisYear = getSecurePOSTAndGETData('timeDiagnosisYear');
    $timeDiagnosisHour = getSecurePOSTAndGETData('timeDiagnosisHour');
    $timeDiagnosisMinutes = getSecurePOSTAndGETData('timeDiagnosisMinutes');
    $timeDiagnosis = $timeDiagnosisYear . "-" . $timeDiagnosisMonth . "-" . $timeDiagnosisDay . " " . $timeDiagnosisHour . ":" . $timeDiagnosisMinutes . ":00";
}
$diagnosisArztID = getSecurePOSTAndGETData('diagnosisArztID');
$timeTreatment = getSecurePOSTAndGETData('timeTreatment');
if ($timeTreatment == '') {
    $timeTreatmentDay = getSecurePOSTAndGETData('timeTreatmentDay');
    $timeTreatmentMonth = getSecurePOSTAndGETData('timeTreatmentMonth');
    $timeTreatmentYear = getSecurePOSTAndGETData('timeTreatmentYear');
    $timeTreatmentHour = getSecurePOSTAndGETData('timeTreatmentHour');
    $timeTreatmentMinutes = getSecurePOSTAndGETData('timeTreatmentMinutes');
    $timeTreatment = $timeTreatmentYear . "-" . $timeTreatmentMonth . "-" . $timeTreatmentDay . " " . $timeTreatmentHour . ":" . $timeTreatmentMinutes . ":00";
}
$therapyArztID = getSecurePOSTAndGETData('therapyArztID');
$konsilType = getSecurePOSTAndGETData('konsilType');
$visualDataDescr = getSecurePOSTAndGETData('visualDataDescr');
$pGewicht = getSecurePOSTAndGETData('pGewicht');
$pGroesse = getSecurePOSTAndGETData('pGroesse');
$pGewicht = str_replace(',', '.', $pGewicht);
$pGroesse = str_replace(',', '.', $pGroesse);
$lyseOption = getPOST_CheckedValue('lyseOption');

$visualData = getPOSTAndGETData('visualData');
if ($visualData <> '') {
    for ($i = 0; $i < 4; $i++) {
        if (array_key_exists($i, $visualData)) {
        } else {
            $visualData[$i] = '';
        }
    }
    $visualData = $visualData[0] . ',' . $visualData[1] . ',' . $visualData[2] . ',' . $visualData[3];
} else {
    $visualData = ',,,';
}
$therapyDescr1 = getPOSTAndGETData('therapyDescr');
$therapyDescr2 = getPOSTAndGETData('therapyDescr2');
$therapyDescr3 = getPOSTAndGETData('therapyDescr3');
$editStatus = getPOSTAndGETData('editStatus');
$pDrugs = getPOSTAndGETData('pDrugs');
$pConditions = getPOSTAndGETData('pConditions');
$symptomDescr = getPOSTAndGETData('symptomDescr');
$diagnosisArzttxt = getPOSTAndGETData('diagnosisArzttxt');
$radtxt = getPOSTAndGETData('radtxt');
$bdWert1AufnahmeRec = getPOSTAndGETData('bdWert1AufnahmeRec');
$bdWert2AufnahmeRec = getPOSTAndGETData('bdWert2AufnahmeRec');
$bdDescrAufnahmeRec = getPOSTAndGETData('bdDescrAufnahmeRec');
$therapyArzttxt = getPOSTAndGETData('therapyArzttxt');
$patid_abgleich = getPOSTAndGETData('patid_abgleich');
$bgart = getPOSTAndGETData('bgart');
$radbef = getPOSTAndGETData('radbef');
$bgproblem = getPOSTAndGETData('bgproblem');
$bgpblmtxt = getPOSTAndGETData('bgpblmtxt');
$nihssint = getPOSTAndGETData('nihssint');
$kuproblem = getPOSTAndGETData('kuproblem');
$videopblmtxt = getPOSTAndGETData('videopblmtxt');
$proxgv = getPOSTAndGETData('proxgv');
$proxgvtxt = getPOSTAndGETData('proxgvtxt');
$mrs = getPOSTAndGETData('mrs');
$lyseempfint = getPOSTAndGETData('lyseempfint');
$offlabellyse = getPOSTAndGETData('offlabellyse');
$tbempfint = getPOSTAndGETData('tbempfint');
$verlegort = getPOSTAndGETData('verlegort');
$verlegtxt = getPOSTAndGETData('verlegtxt');
$freenote = getPOSTAndGETData('freenote');
$lysezeitbolus = getSecurePOSTAndGETData('lysezeitbolus');
if ($lysezeitbolus == '') {
    $lysezeitbolusHour = getSecurePOSTAndGETData('lysezeitbolusHour');
    $lysezeitbolusMinutes = getSecurePOSTAndGETData('lysezeitbolusMinutes');
    $lysezeitbolus =  $lysezeitbolusHour . ":" . $lysezeitbolusMinutes . ":00";
}

$record = new PatientRecord();
if ($patientRecordID != "") {
    $record->getRecord($patientRecordID);
}
$record->setPatientRecordID($patientRecordID);
$record->setPatientID($patientID);
$record->setSymptomsText($symptomsText);
$record->setTimeInitialContact($timeInitialContact);
$record->setTimeHospital($timeHospital);
$record->setTimeDiagnosis($timeDiagnosis);
$record->setTimeTreatment($timeTreatment);
$record->setDiagnosisArztID($diagnosisArztID);
$record->setSymptomDescr($symptomDescr);
$record->setIndicationID($indicationID);
$record->setTherapyArztID($therapyArztID);
$record->setKonsilType($konsilType);
$record->setLyseOption($lyseOption);
$record->setVisualData($visualData);
$record->setIndication2ID($indication2ID);
$record->setIndication2DID($indication2DID);
$record->setTherapyDescr1($therapyDescr1);
$record->setTherapyDescr2($therapyDescr2);
$record->setTherapyDescr3($therapyDescr3);
$record->setEditStatus($editStatus);
$record->setPDrugs($pDrugs);
$record->setPConditions($pConditions);
$record->setPGewicht($pGewicht);
$record->setPGroesse($pGroesse);
$record->setVisualDataDescr($visualDataDescr);
$record->setTimeSymptoms($timeSymptoms);
$record->setSymptomsText2($symptomsText2);
$record->setTimeSymptomsGesund($timeSymptomsGesund);
$record->setDiagnosisArzttxt($diagnosisArzttxt);
$record->setRadtxt($radtxt);
$record->setBdWert1AufnahmeRec($bdWert1AufnahmeRec);
$record->setBdWert2AufnahmeRec($bdWert2AufnahmeRec);
$record->setBdDescrAufnahmeRec($bdDescrAufnahmeRec);


$record->setTherapyArzttxt($therapyArzttxt);
$record->setPatid_abgleich($patid_abgleich);
$record->setBgart($bgart);
$record->setRadbef($radbef);
$record->setBgproblem($bgproblem);
$record->setBgpblmtxt($bgpblmtxt);
$record->setNihssint($nihssint);
$record->setKuproblem($kuproblem);
$record->setVideopblmtxt($videopblmtxt);
$record->setProxgv($proxgv);
$record->setProxgvtxt($proxgvtxt);
$record->setMrs($mrs);
$record->setLyseempfint($lyseempfint);
$record->setOfflabellyse($offlabellyse);
$record->setTbempfint($tbempfint);
$record->setVerlegort($verlegort);
$record->setVerlegtxt($verlegtxt);
$record->setFreenote($freenote);
$record->setLysezeitbolus($lysezeitbolus);

$pInfoIDs = getPOSTAndGETArray('pInfoIDs');
$pInfoIDsM = getPOSTAndGETArray('pInfoIDsM');
$pInfoIDsC = getPOSTAndGETArray('pInfoIDsC');
$pnID = getSecurePOSTAndGETData('pnID');
$nihssStepID = getSecurePOSTAndGETData('nihssStepID');
$posTelekonsil = getSecurePOSTAndGETData('posTelekonsil');
$posNIHSSoriginal = getSecurePOSTAndGETData('posNIHSSoriginal');
$nihssStepName = getSecurePOSTAndGETData('nihssStepName');
$nihssStepText = getSecurePOSTAndGETData('nihssStepText');
$cameraInfo = getSecurePOSTAndGETData('cameraInfo');
$assistenzInfo = getPOST_CheckedValue('assistenzInfo');
$pWerteID = getPOSTAndGETData('pWerteID');
$pWert1 = getPOSTAndGETData('pWert1');
$pWert2 = getPOSTAndGETData('pWert2');
$pWert3 = getPOSTAndGETData('pWert3');
$pWert4 = getPOSTAndGETData('pWert4');
$pWert5 = getPOSTAndGETData('pWert5');
$pWertDescr = getPOSTAndGETData('pWertDescr');
$pWerteArray = array($pWert1, $pWert2, $pWert3, $pWert4, $pWert5, $pWertDescr);
$step = getPOSTAndGETData('step');
$column = getPOSTAndGETData('column');
$pWert = getPOSTAndGETData('pWert');
$nihssTotal = getPOSTAndGETData('nihssTotal');
$ptID = getPOSTAndGETData('ptID');
$apaVoreinnahme = getPOST_CheckedValue('apaVoreinnahme');
$apaVoreinnahme2 = getPOST_CheckedValue('apaVoreinnahme2');
$apaVoreinnahme3 = getPOST_CheckedValue('apaVoreinnahme3');
$mVoreinnahme = getPOST_CheckedValue('mVoreinnahme');
$vorhofflimmern = getPOST_CheckedValue('vorhofflimmern');
$diabetes = getPOST_CheckedValue('diabetes');
$hypertonus = getPOST_CheckedValue('hypertonus');
$vorSchlaganfall = getPOST_CheckedValue('vorSchlaganfall');
$oberArztTime = getPOSTAndGETData('oberArztTime');
if ($oberArztTime == '') {
    $oberArztTimeH = getSecurePOSTAndGETData('oberArztTimeH');
    $oberArztTimeMin = getSecurePOSTAndGETData('oberArztTimeMin');
    $oberArztTime = $oberArztTimeH . ":" . $oberArztTimeMin . ":00";
}
$oberArztDescr = getPOSTAndGETData('oberArztDescr');
$laborWerteTime = getPOSTAndGETData('laborWerteTime');
if ($laborWerteTime == '') {
    $laborWerteTimeH = getSecurePOSTAndGETData('laborWerteTimeH');
    $laborWerteTimeMin = getSecurePOSTAndGETData('laborWerteTimeMin');
    $laborWerteTime = $laborWerteTimeH . ":" . $laborWerteTimeMin . ":00";
}
$laborWert1 = getPOSTAndGETData('laborWert1');
$laborWert2 = getPOSTAndGETData('laborWert2');
$laborWert3 = getPOSTAndGETData('laborWert3');
$laborWert4 = getPOSTAndGETData('laborWert4');
$laborWert5 = getPOSTAndGETData('laborWert5');
$laborWert1 = str_replace(',', '.', $laborWert1);
$laborWert2 = str_replace(',', '.', $laborWert2);
$laborWert3 = str_replace(',', '.', $laborWert3);
$laborWert4 = str_replace(',', '.', $laborWert4);
$laborWert5 = str_replace(',', '.', $laborWert5);
$bdSenkungOption = getPOST_CheckedValue('bdSenkungOption');
$lyseDecisionTime = getPOSTAndGETData('lyseDecisionTime');
if ($lyseDecisionTime == '') {
    $lyseDecisionTimeH = getSecurePOSTAndGETData('lyseDecisionTimeH');
    $lyseDecisionTimeMin = getSecurePOSTAndGETData('lyseDecisionTimeMin');
    $lyseDecisionTime = $lyseDecisionTimeH . ":" . $lyseDecisionTimeMin . ":00";
}
$lyseDecisionDescr1 = getPOSTAndGETData('lyseDecisionDescr1');
$lyseDecisionDescr2 = getPOSTAndGETData('lyseDecisionDescr2');
$dosisWert1 = setDefaultVorNotNullableValues(getPOSTAndGETData('dosisWert1'));
$dosisWert2 = getPOSTAndGETData('dosisWert2');
$dosisWert3 = getPOSTAndGETData('dosisWert3');
$dosisWert4 = getPOSTAndGETData('dosisWert4');
$timeLyseStart = getPOSTAndGETData('timeLyseStart');
if ($timeLyseStart == '') {
    $timeLyseStartY = getSecurePOSTAndGETData('timeLyseStartY');
    $timeLyseStartD = getSecurePOSTAndGETData('timeLyseStartD');
    $timeLyseStartM = getSecurePOSTAndGETData('timeLyseStartM');
    $timeLyseStartH = getSecurePOSTAndGETData('timeLyseStartH');
    $timeLyseStartMin = getSecurePOSTAndGETData('timeLyseStartMin');
    $timeLyseStart = $timeLyseStartY . "-" . $timeLyseStartM . "-" . $timeLyseStartD . " " . $timeLyseStartH . ":" . $timeLyseStartMin . ":00";
}
$timeLyseEnd = getPOSTAndGETData('timeLyseEnd');
if ($timeLyseEnd == '') {
    $timeLyseEndY = getSecurePOSTAndGETData('timeLyseEndY');
    $timeLyseEndD = getSecurePOSTAndGETData('timeLyseEndD');
    $timeLyseEndM = getSecurePOSTAndGETData('timeLyseEndM');
    $timeLyseEndH = getSecurePOSTAndGETData('timeLyseEndH');
    $timeLyseEndMin = getSecurePOSTAndGETData('timeLyseEndMin');
    $timeLyseEnd = $timeLyseEndY . "-" . $timeLyseEndM . "-" . $timeLyseEndD . " " . $timeLyseEndH . ":" . $timeLyseEndMin . ":00";
}
$rekonsilArztID = getPOSTAndGETData('rekonsilArztID');
$nihssWert2448 = setDefaultVorNotNullableValues(getPOSTAndGETData('nihssWert2448'));
$complications = getPOSTAndGETData('complications');
$nihssWert7days = setDefaultVorNotNullableValues(getPOSTAndGETData('nihssWert7days'));
$ranking = setDefaultVorNotNullableValues(getPOSTAndGETData('ranking'));
$entlassung = getPOSTAndGETData('entlassung');
if ($entlassung == '') {
    $entlassungY = getSecurePOSTAndGETData('entlassungY');
    $entlassungD = getSecurePOSTAndGETData('entlassungD');
    $entlassungM = getSecurePOSTAndGETData('entlassungM');
    $entlassungH = getSecurePOSTAndGETData('entlassungH');
    $entlassungMin = getSecurePOSTAndGETData('entlassungMin');
    $entlassung = $entlassungY . "-" . $entlassungM . "-" . $entlassungD . " " . $entlassungH . ":" . $entlassungMin . ":00";
}
$entlassungNach = getPOSTAndGETData('entlassungNach');
$timeCCTStart = getPOSTAndGETData('timeCCTStart');
if ($timeCCTStart == '') {
    $timeCCTStartH = getSecurePOSTAndGETData('timeCCTStartH');
    $timeCCTStartMin = getSecurePOSTAndGETData('timeCCTStartMin');
    $timeCCTStart = $timeCCTStartH . ":" . $timeCCTStartMin . ":00";
}
$timeCCTEnd = '00:00:00';
$cctDescr1 = getSecurePOSTAndGETData('cctDescr1');
$cctDescr2 = getSecurePOSTAndGETData('cctDescr2');
$cctDescr3 = getSecurePOSTAndGETData('cctDescr3');
$cctOption1 = getPOST_CheckedValue2('cctOption1');
$cctOption2 = getPOST_CheckedValue2('cctOption2');
$cctOption3 = getPOST_CheckedValue2('cctOption3');
$cctOption4 = getPOST_CheckedValue2('cctOption4');
$bdWert1Aufnahme = getPOSTAndGETData('bdWert1Aufnahme');
$bdWert2Aufnahme = getPOSTAndGETData('bdWert2Aufnahme');
$bdDescrAufnahme = getPOSTAndGETData('bdDescrAufnahme');
$bdWert1vorLyse = getPOSTAndGETData('bdWert1vorLyse');
$bdWert2vorLyse = getPOSTAndGETData('bdWert2vorLyse');
$bdDescrvorLyse = getPOSTAndGETData('bdDescrvorLyse');
$ptWerteArray = array(
    $patientID,
    $patientRecordID,
    $apaVoreinnahme,
    $mVoreinnahme,
    $vorhofflimmern,
    $diabetes,
    $hypertonus,
    $vorSchlaganfall,
    $oberArztTime,
    $oberArztDescr,
    $laborWerteTime,
    $laborWert1,
    $laborWert2,
    $laborWert3,
    $laborWert4,
    $laborWert5,
    $bdSenkungOption,
    $lyseDecisionTime,
    $lyseDecisionDescr1,
    $lyseDecisionDescr2,
    $dosisWert1,
    $dosisWert2,
    $dosisWert3,
    $dosisWert4,
    $timeLyseStart,
    $timeLyseEnd,
    $rekonsilArztID,
    $nihssWert2448,
    $complications,
    $nihssWert7days,
    $ranking,
    $entlassung,
    $entlassungNach,
    $timeCCTStart,
    $timeCCTEnd,
    $cctDescr1,
    $cctDescr2,
    $cctDescr3,
    $cctOption1,
    $cctOption2,
    $cctOption3,
    $cctOption4,
    $apaVoreinnahme2,
    $apaVoreinnahme3,
    $bdWert1Aufnahme,
    $bdWert2Aufnahme,
    $bdDescrAufnahme,
    $bdWert1vorLyse,
    $bdWert2vorLyse,
    $bdDescrvorLyse
);

function getPOSTAndGETData($send)
{
    if (isset($_POST[$send])) {
        $variable = $_POST[$send];
    } else {
        $variable = '';
    }
    if (isset($_GET[$send])) {
        $variable = $_GET[$send];
    }
    $variable = str_replace('"', '&quot;', $variable);
    $variable = str_replace('\'', '&apos;', $variable);
    return $variable;
}

function getPOSTAndGETArray($send)
{
    if (isset($_POST[$send])) {
        $variable = $_POST[$send];
    } else {
        $variable = array();
    }
    return $variable;
}

function getSecurePOSTAndGETData($send)
{
    $variable = '';
    if (isset($_POST[$send])) {
        $variable = strip_tags($_POST[$send]);
    } else {
        if (isset($_GET[$send])) {
            $variable = strip_tags($_GET[$send]);
        }
    }
    $variable = str_replace('"', '&quot;', $variable);
    $variable = str_replace('\'', '&apos;', $variable);
    return $variable;
}

function getPOST_CheckedValue($send)
{
    if (isset($_POST[$send])) {
        $variable = $_POST[$send];
    } else {
        $variable = 'n';
    }
    return $variable;
}

function getPOST_CheckedValue2($send)
{
    if (isset($_POST[$send])) {
        $variable = $_POST[$send];
    } else {
        $variable = '';
    }
    return $variable;
}

function setDefaultVorNotNullableValues($send){
    if ($send == "") $send = "0";
    return $send;
}
