<?php

/**
 * Indication.php

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Indikation
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Indication
{
    private $indicationID;
    private $indicationName;
    private $indicationCode;
    private $indicationComment;

    /**
     * @return mixed
     */

    public function getEntry($id)
    {
        $entry = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `indication` WHERE indicationID = '$id' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Indication');
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
            $db_request = "SELECT * FROM `indication`  ORDER BY indicationName ASC";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Indication');
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
