<?php

/**
 * Condition.php
 *

 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Condition
{
    private $conditionID;
    private $conditionName;
    private $conditionText;
    private $conditionComment;

    /**
     * @return mixed
     */
    public function getConditionID()
    {
        return $this->conditionID;
    }

    public function setConditionID($conditionID)
    {
        $this->conditionID = $conditionID;
    }

    public function getConditionText()
    {
        return $this->conditionText;
    }

    public function setConditionText($conditionText)
    {
        $this->conditionText = $conditionText;
    }

    public function getConditionName()
    {
        return $this->conditionName;
    }

    public function setConditionName($conditionName)
    {
        $this->conditionName = $conditionName;
    }

    public function getConditionComment()
    {
        return $this->conditionComment;
    }

    public function setConditionComment($conditionComment)
    {
        $this->conditionComment = $conditionComment;
    }

    public function getEntry($id)
    {
        $entry = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `infoConditions` WHERE conditionID = '$id' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Condition');
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
            $db_request = "SELECT * FROM `infoConditions`  ORDER BY conditionName ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Condition');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public function getAllConditionIDs()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT conditionID FROM `infoConditions`  ORDER BY conditionID ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $rows = mysqli_num_rows($query_handle);
                    if ($rows > 0) {
                        for ($i = 0; $i < $rows; $i++) {
                            $data = mysqli_fetch_row($query_handle);
                            $entries[] = $data[0];
                        }
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }
}