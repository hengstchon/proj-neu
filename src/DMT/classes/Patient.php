<?php

/**
 * Patient.php

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Patients
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Patient
{
    private $patientID;
    private $pFirstName;
    private $pLastName;
    private $pBday;
    private $pStreet;
    private $pZipCode;
    private $pCity;
    private $pPhone;
    private $pGender;


    public static function getPatientInfosFromPatientInfos($patientRecordID, $infoID, $type)
    {
        $okay = 0;
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request4 = "SELECT `pInfoID` FROM `patientInfos` WHERE patientRecordID = '$patientRecordID' AND infoID = '$infoID' AND infoType = '$type' ";
            $query_handle4 = mysqli_query($access, $db_request4);
            if ($query_handle4 != "") {
                $rows4 = mysqli_num_rows($query_handle4);
                if ($rows4 > 0) {
                    $okay = 1;
                }
            }
        }
        mysqli_close($access);
        return $okay;
    }

    public static function getPatientIDsByLastName($name)
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $name = strtolower($name);
            $db_request = "SELECT patientID, LOWER(pLastName) FROM `patients` WHERE LOWER(pLastName) = '$name' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $data = mysqli_fetch_row($query_handle);
                        $entries[] = $data[0];
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public static function getFirstCatitalLetterOFEntries()
    {
        $capitalLetter = 'A';
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT pLastName FROM `patients` ORDER by pLastName ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $data = mysqli_fetch_row($query_handle);
                $capitalLetter = substr($data[0], 0, 1);
            }
        }
        return strtoupper($capitalLetter);
    }

    public static function getAllEntriesOfCatitalLetter($letter)
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $letter = strtolower($letter);
            $db_request = "SELECT * FROM `patients`  WHERE LOWER(pLastname) LIKE '$letter%'  ORDER by pLastName, pFirstName ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Patient');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public static function deletePatient($patientID)
    {
        $db_access = new Access();
        $access = $db_access->connectDB();
        $pnIDs = array();
        if ($access) {
            $db_request = "SELECT pnID FROM `patientNIHSS` WHERE patientID = $patientID";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $data = mysqli_fetch_row($query_handle);
                        $pnIDs[$i] = $data[0];
                    }
                    if (count($pnIDs) > 0) {
                        foreach ($pnIDs as $key => $id) {
                            $db_request = "DELETE FROM `patientNIHSSWerte` WHERE pnID = $id";
                            $query_handle = mysqli_query($access, $db_request);
                            if ($query_handle != "") {
                            } else {
                                print "<p class='errorMessage'>Konnte den NIHSS Werte $id nicht in Datenbank l&ouml;schen! [deletePatient($patientID)]</p>";
                            }
                        }
                    }
                }
            }
            $db_request = "DELETE FROM `patientNIHSS` WHERE patientID = $patientID";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
            } else {
                print "<p class='errorMessage'>Konnte den NIHSS Eintrag nicht in Datenbank l&ouml;schen! [deletePatient($patientID)]</p>";
            }
            $recordIDs = array();
            $db_request = "SELECT patientRecordID FROM `patientRecords` WHERE patientID = $patientID";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $data = mysqli_fetch_row($query_handle);
                        $recordIDs[$i] = $data[0];
                    }
                    if (count($recordIDs) > 0) {
                        foreach ($recordIDs as $key => $id) {
                            $db_request = "DELETE FROM `patientInfos` WHERE patientRecordID = $id";
                            $query_handle = mysqli_query($access, $db_request);
                            if ($query_handle != "") {
                            } else {
                                print "<p class='errorMessage'>Konnte den patientInfos nicht in Datenbank l&ouml;schen! [deletePatient($patientID)]</p>";
                            }
                        }
                        foreach ($recordIDs as $key => $id) {
                            $db_request = "DELETE FROM `patientRecords` WHERE patientRecordID = $id";
                            $query_handle = mysqli_query($access, $db_request);
                            if ($query_handle != "") {
                            } else {
                                print "<p class='errorMessage'>Konnte den patientRecord nicht in Datenbank l&ouml;schen! [deletePatient($patientID)]</p>";
                            }
                        }
                    }
                }
            }
            $ptIDs = array();
            $db_request = "SELECT ptID FROM `patientThrombolyse` WHERE patientID = $patientID";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows == 0) {
                } else {
                    for ($i = 0; $i < $rows; $i++) {
                        $data = mysqli_fetch_row($query_handle);
                        $ptIDs[$i] = $data[0];
                    }
                    if (count($ptIDs) > 0) {
                        foreach ($ptIDs as $key => $id) {
                            $db_request = "DELETE FROM `patientThrombolyse` WHERE ptID = $id";
                            $query_handle = mysqli_query($access, $db_request);
                            if ($query_handle != "") {
                            } else {
                                print "<p class='errorMessage'>Konnte den Thrombolyse $id nicht in Datenbank l&ouml;schen! [deletePatient($patientID)]</p>";
                            }
                        }
                    }
                }
            }
            $db_request = "DELETE FROM `patients` WHERE patientID = $patientID";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
            } else {
                print "<p class='errorMessage'>Konnte den Patient nicht in Datenbank l&ouml;schen! [deletePatient($patientID)]</p>";
            }
        } else {
            print "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [deletePatient($patientID)]</p>";
        }
    }

    static public function getAllEntriesOfEmptyBDay()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `patients` WHERE pBday = '0000-00-00'  ORDER by pLastName, pBDay";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Patient');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    static public function getAllEntriesOfThisYearBDay()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $currentYear = date("Y");
            $db_request = "SELECT * FROM `patients` WHERE pBday = '$currentYear'  ORDER by pLastName, pBDay";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Patient');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    function nameExist($capitalLetter)
    {
        $rows = 0;
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT pLastName FROM `patients` WHERE pLastname LIKE '$capitalLetter%'  ORDER by pLastName ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
            }
        }
        return $rows;
    }

    public function getPatientInfos($patientID)
    {
        $patient = Patient::getPatient($patientID);
        $pFirstName = $patient->getPFirstName();
        $pLastName = $patient->getPLastName();
        $patientInfos = $pFirstName . ' ' . $pLastName;
        return $patientInfos;
    }

    public function getPatient($patientID)
    {
        $entry = new Patient();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `patients` WHERE patientID = '$patientID' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Patient');
                }
            }
        }
        mysqli_close($access);
        return $entry;
    }

    public function getAllEntries()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `patients` ORDER BY pLastName, pFirstName ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Patient');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public function saveEntry_patient($entry)
    {
        global $x;
        $errorMessages = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        $patientID = 0;
        if ($access) {
            $patientID = $entry->getPatientID();
            $pFirstName = strtolower($entry->getPFirstName());
            $pLastName = strtolower($entry->getPLastName());
            $array = array(
                'pFirstName' => $pFirstName,
                'pLastName' => $pLastName,
                'pBday' => $entry->getPBday(),
                'pStreet' => $entry->getPStreet(),
                'pZipCode' => $entry->getPZipCode(),
                'pCity' => $entry->getPCity(),
                'pPhone' => $entry->getPPhone(),
                'pGender' => $entry->getPGender()
            );
            if ($patientID != "") {
                $db_request = "Select * FROM `patients` WHERE `patientID` = '$patientID' ";
                $query_handle = mysqli_query($access, $db_request);
                if ($query_handle != "") {
                    $rows = mysqli_num_rows($query_handle);
                    if ($rows > 0) {
                        foreach ($array as $key => $value) {
                            $value = mysqli_real_escape_string($access, $value);
                            $db_request2 = "Update `patients` SET `$key` = '$value' WHERE `patientID` = '$patientID' LIMIT 1 ";
                            $query_handle2 = mysqli_query($access, $db_request2);
                            if ($query_handle2 == "") {
                                $errorMessages[] = "Kein Patienten-Update folgender Daten moeglich: '$key' => '$value'!";
                            }
                        }
                    } else {
                        $errorMessages[] = "Kein Patient mit $patientID vorhanden.";
                    }
                } else {
                    $errorMessages[] = "Kein Selektieren des Patientes mit ID $patientID m?glich.";
                }
            } else {
                if ($pLastName != "") {
                    $now = date("Y-m-d");
                    $where = 'pLastName, pFirstName, pBday, pStreet, pZipCode, pCity, pPhone, pGender';
                    $value = "'$pLastName', '', '$now', '', '', '', '','w'";
                    $db_request = "INSERT INTO `patients` (" . $where . ") VALUES (" . $value . ")";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                        $patientID = mysqli_insert_id($access);
                    } else {
                        $errorMessages[] = "Kein Eintragen der neuen Patientdaten moeglich.";
                    }
                }
            }
        } else {
            $errorMessages[] = "Kein Speichern der Patientdaten erfolgt.";
        }
        if (!empty($errorMessages)) setSavedOptionYes($x);
        mysqli_close($access);
        return array($patientID => $errorMessages);
    }

    public function getPatientID()
    {
        return $this->patientID;
    }

    public function setPatientID($patientID)
    {
        $this->patientID = $patientID;
    }

    public function getPGender()
    {
        return $this->pGender;
    }

    public function setPGender($pGender)
    {
        $this->pGender = $pGender;
    }

    public function getPBday()
    {
        return $this->pBday;
    }

    public function setPBday($pBday)
    {
        $this->pBday = $pBday;
    }

    public function getPFirstName()
    {
        return $this->pFirstName;
    }

    public function setPFirstName($pFirstName)
    {
        $this->pFirstName = $pFirstName;
    }

    public function getPLastName()
    {
        return $this->pLastName;
    }

    public function setPLastName($pLastName)
    {
        $this->pLastName = $pLastName;
    }

    public function getPPhone()
    {
        return $this->pPhone;
    }

    public function setPPhone($pPhone)
    {
        $this->pPhone = $pPhone;
    }

    public function getPStreet()
    {
        return $this->pStreet;
    }

    public function setPStreet($pStreet)
    {
        $this->pStreet = $pStreet;
    }

    public function getPZipCode()
    {
        return $this->pZipCode;
    }

    public function setPZipCode($pZipCode)
    {
        $this->pZipCode = $pZipCode;
    }

    public function getPCity()
    {
        return $this->pCity;
    }

    public function setPCity($pCity)
    {
        $this->pCity = $pCity;
    }
}