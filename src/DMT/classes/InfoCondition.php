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
