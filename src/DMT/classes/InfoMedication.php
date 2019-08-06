<?php
/**
 * Medication.php
 *

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Medication
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Medication
{
    private $medicationID;
    private $medicationName;
    private $medicationText;
    private $medicationComment;

    /**
     * @return mixed
     */
    public function getMedicationID()
    {
        return $this->medicationID;
    }

    public function setMedicationID($medicationID)
    {
        $this->medicationID = $medicationID;
    }

    public function getMedicationText()
    {
        return $this->medicationText;
    }

    public function setMedicationText($medicationText)
    {
        $this->medicationText = $medicationText;
    }

    public function getMedicationName()
    {
        return $this->medicationName;
    }

    public function setMedicationName($medicationName)
    {
        $this->medicationName = $medicationName;
    }

    public function getMedicationComment()
    {
        return $this->medicationComment;
    }

    public function setMedicationComment($medicationComment)
    {
        $this->medicationComment = $medicationComment;
    }

    public function getEntry($id)
    {
        $entry = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `infoMedication` WHERE medicationID = '$id' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Medication');
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
            $db_request = "SELECT * FROM `infoMedication`  ORDER BY medicationName ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Medication');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public function getAllMedIDs()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT medicationID FROM `infoMedication` ORDER by medicationID";
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
}