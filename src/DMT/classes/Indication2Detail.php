<?php

/**
 * Indication2Detail.php
 *
 *
 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Indication2Detail
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Indication2Detail
{
    private $indication2DID;
    private $indication2DName;
    private $indication2DCode;

    /**
     * @return mixed
     */
    public function getIndication2DID()
    {
        return $this->indication2DID;
    }

    public function setIndication2DID($indication2DID)
    {
        $this->indication2DID = $indication2DID;
    }

    public function getIndication2DCode()
    {
        return $this->indication2DCode;
    }

    public function setIndication2DCode($indication2DCode)
    {
        $this->indication2DCode = $indication2DCode;
    }

    public function getIndication2DName()
    {
        return $this->indication2DName;
    }

    public function setIndication2DName($indication2DName)
    {
        $this->indication2DName = $indication2DName;
    }

    public function getEntry($id)
    {
        $entry = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `indication2Detail` WHERE indication2DID = '$id' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Indication2Detail');
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
            $db_request = "SELECT * FROM `indication2Detail` ORDER BY indication2DID";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Indication2Detail');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }
}