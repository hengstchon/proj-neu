<?php

/**
 * Clinic.php
 *

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Clinics
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Clinic
{
    private $clinicID;
    private $clinicType;
    private $clinicName;
    private $clinicInitial;
    private $clinicComment;

    /**
     * @return mixed
     */
    public function getClinicID()
    {
        return $this->clinicID;
    }

    public function setClinicID($clinicID)
    {
        $this->clinicID = $clinicID;
    }

    public function getClinicType()
    {
        return $this->clinicType;
    }

    public function setClinicType($clinicType)
    {
        $this->clinicType = $clinicType;
    }

    public function getClinicName()
    {
        return $this->clinicName;
    }

    public function setClinicName($clinicName)
    {
        $this->clinicName = $clinicName;
    }

    public function getClinicInitial()
    {
        return $this->clinicInitial;
    }

    public function setClinicInitial($clinicInitial)
    {
        $this->clinicInitial = $clinicInitial;
    }

    public function getClinicComment()
    {
        return $this->clinicComment;
    }

    public function setClinicComment($clinicComment)
    {
        $this->clinicComment = $clinicComment;
    }

    public function getEntry($id)
    {
        $entry = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `clinics` WHERE clinicID = '$id' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Clinic');
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
            $db_request = "SELECT * FROM `clinics`  ORDER BY clinicType, clinicInitial";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Clinic');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }
}