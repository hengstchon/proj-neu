<?php

/**
 * PatientRecord.php
 *
 *
 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Records of Patients
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class PatientRecord
{
    private $patientRecordID;
    private $timestampCreated;
    private $patientID;
    private $timeSymptoms;
    private $symptomsText;
    private $symptomsText2;
    private $timeSymptomsGesund;
    private $timeInitialContact;
    private $timeHospital;
    private $timeDiagnosis;
    private $timeTreatment;
    private $clinicID;
    private $diagnosisArztID;
    private $symptomDescr;
    private $indicationID;
    private $therapyArztID;
    private $konsilType;
    private $lyseOption;
    private $visualData;
    private $visualDataDescr;
    private $indication2ID;
    private $indication2DID;
    private $therapyDescr1;
    private $therapyDescr2;
    private $therapyDescr3;
    private $editStatus;
    private $timestampLastSaved;
    private $pDrugs;
    private $pConditions;
    private $pGewicht;
    private $pGroesse;
    private $diagnosisArzttxt;
    private $radtxt;
    private $bdWert1AufnahmeRec;
    private $bdWert2AufnahmeRec;
    private $bdDescrAufnahmeRec;
    private $therapyArzttxt;
    private $patid_abgleich;
    private $bgart;
    private $radbef;
    private $bgproblem;
    private $bgpblmtxt;
    private $nihssint;
    private $kuproblem;
    private $videopblmtxt;
    private $proxgv;
    private $proxgvtxt;
    private $mrs;
    private $lyseempfint;
    private $offlabellyse;
    private $tbempfint;
    private $verlegort;
    private $verlegtxt;
    private $freenote;
    private $lysezeitbolus;

    public static function savePatientWeight($patientRecordID, $pGewicht, $pGroesse)
    {
        $connection = new Access();
        $access = $connection->connectDB();
        if ($access) {
            if ($patientRecordID != '') {
                $db_request1 = "SELECT patientRecordID FROM patientRecords WHERE patientRecordID = '$patientRecordID'";
                $query_handle1 = mysqli_query($access, $db_request1);
                if ($query_handle1 != "") {
                    $rows = mysqli_num_rows($query_handle1);
                    if ($rows > 0) {
                        if ($pGewicht != '') {
                            $db_request = "UPDATE patientRecords SET  pGewicht = '$pGewicht' WHERE patientRecordID = '$patientRecordID'";
                            $query_handle = mysqli_query($access, $db_request);
                            if ($query_handle != "") {
                            } else {
                                echo "<p class='errorMessage'>Konnte Gewicht nicht &auml;ndern!</p>";
                            }
                        }
                        if ($pGroesse != '') {
                            $db_request = "UPDATE patientRecords SET pGroesse = '$pGroesse' WHERE patientRecordID = '$patientRecordID' LIMIT 1";
                            $query_handle = mysqli_query($access, $db_request);
                            if ($query_handle != "") {
                            } else {
                                echo "<p class='errorMessage'>Konnte Gr&ouml;&szlig;e nicht &auml;ndern!</p>";
                            }
                        }
                    }
                }
            }
        } else {
            echo "<p class='errorMessage'>Kein Zugriff auf Datenbank [savePatientWeight($patientRecordID, $pGewicht, $pGroesse)]!</p>";
        }
        mysqli_close($access);
    }

    public static function saveTimeErstContact($patientRecordID, $timeInitialContact)
    {
        $connection = new Access();
        $access = $connection->connectDB();
        if ($access) {
            $db_request1 = "SELECT patientID FROM patientRecords WHERE patientRecordID = '$patientRecordID'";
            $query_handle1 = mysqli_query($access, $db_request1);
            if ($query_handle1 != "") {
                $rows = mysqli_num_rows($query_handle1);
                if ($rows > 0) {
                    $db_request = "UPDATE patientRecords SET timeInitialContact = '$timeInitialContact' WHERE patientRecordID = '$patientRecordID' LIMIT 1";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Zeit (Med. Erstkontakt) nicht &auml;ndern!</p>";
                    }
                }
            }
        } else {
            echo "<p class='errorMessage'>Kein Zugriff auf Datenbank [saveTimeErstContact($patientRecordID, $timeInitialContact)]!</p>";
        }
        mysqli_close($access);
    }

    public static function getAllRecordsOfPatient($patientID, $editStatus)
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            if ($editStatus != "") {
                $db_request = "SELECT * FROM `patientRecords` WHERE patientID = '$patientID' AND editStatus = '$editStatus' ORDER by patientID DESC , timestampCreated DESC";
            } else {
                $db_request = "SELECT * FROM `patientRecords` WHERE patientID = '$patientID' ORDER by patientID DESC,  timestampCreated DESC";
            }
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'PatientRecord');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public static function getAllRecordsOfPatientAmount($patientID, $editStatus)
    {
        $rows = 0;
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `patientRecords` WHERE patientID = '$patientID' ";
            if ($editStatus != "") {
                $db_request .= " AND editStatus = '$editStatus' ORDER by patientID DESC , timestampCreated DESC";
            } else {
                $db_request .= " ORDER by patientID DESC,  timestampCreated DESC";
            }
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
            }
        }
        mysqli_close($access);
        return $rows;
    }

    public static function getInfoIDs($patientRecordID, $type)
    {
        $ids = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT `infoID` FROM `patientInfos` WHERE patientRecordID = '$patientRecordID' AND infoType = '$type'";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                for ($i = 0; $i < $rows; $i++) {
                    $ids[] = mysqli_fetch_row($query_handle)[0];
                }
            }
        }
        mysqli_close($access);
        return $ids;
    }

    public static function getAllRecords($editStatus)
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `patientRecords` ";
            if ($editStatus != "") {
                $db_request .= " WHERE editStatus = '$editStatus' ORDER by patientID DESC, timestampCreated DESC";
            } else {
                $db_request .= " ORDER by patientID DESC,  timestampCreated DESC";
            }
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'PatientRecord');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public function getRecord($patientRecordID)
    {
        $entry = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM patientRecords WHERE patientRecordID = '$patientRecordID' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $entry = mysqli_fetch_object($query_handle, 'PatientRecord');
            }
        }
        mysqli_close($access);
        return $entry;
    }

    public function getAllEntries_allPatients_allRecords()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM patientRecords ORDER BY patientID, patientRecordID ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'PatientRecord');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public function savePatientRecord($record)
    {
        global $dmt, $x;
        $ID = "";
        $patientRecordID = $record->getPatientRecordID();
        $patientID = $record->getPatientID();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            if ($patientRecordID != '') {
                $symptomsText = $record->getSymptomsText();
                $timeInitialContact = $record->getTimeInitialContact();
                $timeHospital = $record->getTimeHospital();
                $timeDiagnosis = $record->getTimeDiagnosis();
                $timeTreatment = $record->getTimeTreatment();
                $diagnosisArztID = $record->getDiagnosisArztID();
                $symptomDescr = $record->getSymptomDescr();
                $indicationID = $record->getIndicationID();
                $therapyArztID = $record->getTherapyArztID();
                $konsilType = $record->getKonsilType();
                $lyseOption = $record->getLyseOption();
                $visualData = $record->getVisualData();
                $visualDataDescr = $record->getVisualDataDescr();
                $indication2ID = $record->getIndication2ID();
                $indication2DID = $record->getIndication2DID();
                $therapyDescr1 = $record->getTherapyDescr1();
                $therapyDescr2 = $record->getTherapyDescr2();
                $therapyDescr3 = $record->getTherapyDescr3();
                $editStatus = $record->getEditStatus();
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



                $arztCheck = Arzt::getArzt($diagnosisArztID);
                if (!empty($arztCheck)) {
                    $clinicID = Arzt::getArzt($diagnosisArztID)->getClinicID();
                } else {
                    $clinicID = 0;
                }
                if ($pGewicht == "") $pGewicht = 0;
                if ($pGroesse == "") $pGroesse = 0;
                $saveArray = array(
                    "timeSymptoms" => $timeSymptoms,
                    "symptomsText" => $symptomsText,
                    "symptomsText2" => $symptomsText2,
                    "symptomDescr" => $symptomDescr,
                    "timeTreatment" => $timeTreatment,
                    "timeSymptomsGesund" => $timeSymptomsGesund,
                    "timeInitialContact" => $timeInitialContact,
                    "timeHospital" => $timeHospital,
                    "timeDiagnosis" => $timeDiagnosis,
                    "clinicID" => $clinicID,
                    "diagnosisArztID" => $diagnosisArztID,
                    "indicationID" => $indicationID,
                    "pDrugs" => $pDrugs,
                    "pConditions" => $pConditions,
                    "pGewicht" => $pGewicht,
                    "pGroesse" => $pGroesse,
                    "therapyArztID" => $therapyArztID,
                    "konsilType" => $konsilType,
                    "lyseOption" => $lyseOption,
                    "visualData" => $visualData,
                    "visualDataDescr" => $visualDataDescr,
                    "indication2ID" => $indication2ID,
                    "indication2DID" => $indication2DID,
                    "therapyDescr1" => $therapyDescr1,
                    "therapyDescr2" => $therapyDescr2,
                    "therapyDescr3" => $therapyDescr3,
                    "editStatus" => $editStatus,
                    "diagnosisArzttxt" => $diagnosisArzttxt,
                    "radtxt" => $radtxt,
                    "bdWert1AufnahmeRec" => $bdWert1AufnahmeRec,
                    "bdWert2AufnahmeRec" => $bdWert2AufnahmeRec,
                    "bdDescrAufnahmeRec" => $bdDescrAufnahmeRec,
                    "therapyArzttxt" => $therapyArzttxt,
                    "patid_abgleich" => $patid_abgleich,
                    "bgart" => $bgart,
                    "radbef" => $radbef,
                    "bgproblem" => $bgproblem,
                    "bgpblmtxt" => $bgpblmtxt,
                    "nihssint" => $nihssint,
                    "kuproblem" => $kuproblem,
                    "videopblmtxt" => $videopblmtxt,
                    "proxgv" => $proxgv,
                    "proxgvtxt" => $proxgvtxt,
                    "mrs" => $mrs,
                    "lyseempfint" => $lyseempfint,
                    "offlabellyse" => $offlabellyse,
                    "tbempfint" => $tbempfint,
                    "verlegort" => $verlegort,
                    "verlegtxt" => $verlegtxt,
                    "freenote" => $freenote,
                    "lysezeitbolus" => $lysezeitbolus
                );
                $db_request1 = "SELECT patientRecordID FROM `patientRecords` WHERE patientRecordID = '$patientRecordID'";
                $query_handle1 = mysqli_query($access, $db_request1);
                if ($query_handle1 != "") {
                    $rows = mysqli_num_rows($query_handle1);
                    if ($rows > 0) {
                        foreach ($saveArray as $key => $value) {
                            $db_request = "UPDATE `patientRecords` SET $key = '$value' WHERE patientRecordID = '$patientRecordID' LIMIT 1";
                            $query_handle = mysqli_query($access, $db_request);
                            if ($query_handle != "") {
                            } else {
                                print "<p class='errorMessage'>Save Patient-Record: Konnte  $key => $value nicht &auml;ndern!</p>";
                            }
                        }
                    }
                }
                $ID = $patientRecordID;
            } else {
                $timestampCreated = date('Y-m-d H:i:s');
                if ($dmt == 1) {
                    $arztID = Arzt::getAdminID();
                } else {
                    $arztID = $_SESSION['arztID'];
                }
                $clinicID = Arzt::getArzt($arztID)->getClinicID();
                $where = '
                    timestampCreated,
                    patientID,
                    timeSymptoms,
                    symptomsText,
                    timeSymptomsGesund,
                    timeInitialContact,
                    timeHospital,
                    timeDiagnosis,
                    timeTreatment,
                    clinicID,
                    diagnosisArztID,
                    symptomDescr,
                    indicationID,
                    therapyArztID,
                    konsilType,
                    lyseOption,
                    visualData,
                    visualDataDescr,
                    indication2ID,
                    indication2DID,
                    therapyDescr1,
                    therapyDescr2,
                    therapyDescr3,
                    editStatus,
                    pDrugs,
                    pConditions,
                    pGewicht,
                    pGroesse,
                    diagnosisArzttxt,
                    radtxt,
                    bdWert1AufnahmeRec,
                    bdWert2AufnahmeRec,
                    bdDescrAufnahmeRec';
                $value = "
                    '$timestampCreated',
                    '$patientID',
                    '$timestampCreated',
                    '',
                    '$timestampCreated',
                    '',
                    '$timestampCreated',
                    '$timestampCreated',
                    '$timestampCreated',
                     '$clinicID',
                     '$arztID',
                     '',
                     '0',
                     '0',
                     't',
                     'n',
                     ',,,',
                     '',
                     '0',
                     '0',
                     '',
                     '',
                     '',
                     'o',
                     '',
                     '',
                     '0',
                     '0',
                     '',
                     '',
                     '0',
                     '0',
                     ''
                     ";
                $db_request = "INSERT INTO `patientRecords` (" . $where . ") VALUES (" . $value . ")";
                $query_handle = mysqli_query($access, $db_request);
                if ($query_handle != "") {
                    $ID = mysqli_insert_id($access);
                    setSavedOptionYes($x);
                } else {
                    echo "<p class='errorMessage'>Konnte keinen neuen Eintrag erzeugen [savePatientRecord]!</p>";
                }
            }
        } else {
            print "<p class='errorMessage'>Kein Zugriff auf Datenbank [savePatientRecord]!</p>";
        }
        mysqli_close($access);
        return $ID;
    }

    function __call($fun, $args) {
      if (substr($fun, 0, 3) == 'get') {
        $var = strtolower(substr($fun, 3, 1)).substr($fun, 4);
        return $this->$var;
      } else if (substr($fun, 0, 3) == 'set') {
        $var = strtolower(substr($fun, 3, 1)).substr($fun, 4);
        $this->$var = $args[0];
      }
    }

}
