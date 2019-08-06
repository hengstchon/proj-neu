<?php

/**
 * Indication2.php
 *

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Indication2
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Indication2
{
    private $indication2ID;
    private $indication2Name;
    private $indication2Code;
    private $indication2Comment;

    /**
     * @return mixed
     */
    public function getIndication2ID()
    {
        return $this->indication2ID;
    }

    public function setIndication2ID($indication2ID)
    {
        $this->indication2ID = $indication2ID;
    }

    public function getIndication2Code()
    {
        return $this->indication2Code;
    }

    public function setIndication2Code($indication2Code)
    {
        $this->indication2Code = $indication2Code;
    }

    public function getIndication2Name()
    {
        return $this->indication2Name;
    }

    public function setIndication2Name($indication2Name)
    {
        $this->indication2Name = $indication2Name;
    }

    public function getIndication2Comment()
    {
        return $this->indication2Comment;
    }

    public function setIndication2Comment($indication2Comment)
    {
        $this->indication2Comment = $indication2Comment;
    }

    public function getEntry($id)
    {
        $entry = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `indication2` WHERE indication2ID = '$id' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Indication2');
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
            $db_request = "SELECT * FROM `indication2`  ORDER BY indication2Name ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Indication2');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }
}