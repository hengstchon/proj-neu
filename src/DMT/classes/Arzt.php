<?php

/**
 * Arzt.php
 *

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Aerzte
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Arzt
{
    private $arztID;
    private $arztTimestamp;
    private $arztGender;
    private $acadTitle;
    private $arztFirstName;
    private $arztLastName;
    private $arztPhone;
    private $arztComment;
    private $userID; // loginID
    private $clinicID; // Zuordnung Klinik
    private $arztStatus;

    public static function getAllArztInfos()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request2 = "SELECT arztID, clinicID FROM aerzte  ORDER BY  arztLastName";
            $query_handle2 = mysqli_query($access, $db_request2);
            if ($query_handle2 != "") {
                $rows2 = mysqli_num_rows($query_handle2);
                for ($i2 = 0; $i2 < $rows2; $i2++) {
                    $data2 = mysqli_fetch_row($query_handle2);
                    $id = $data2[0];
                    $clinicID = $data2[1];
                    $clinicType = getDBContent('clinics', 'clinicType', 'clinicID', $clinicID);
                    $info = Arzt::getArztInfos($id);
                    $entries[$id] = $info . '-' . $clinicType;
                }
            }
        }
        return $entries;
    }

    public static function getArztInfos($arztID)
    {
        if ($arztID != 0) {
            $doc = new Arzt();
            $arzt = $doc->getArzt($arztID);
            if (!empty($arzt)) {
                $doc = new Arzt();
                $arzt = $doc->getArzt($arztID);
                $arztGender = $arzt->getArztGender();
                $acadTitle = $arzt->getAcadTitle();
                $arztFirstName = $arzt->getArztFirstName();
                $arztLastName = $arzt->getArztLastName();
                $arztPhone = $arzt->getArztPhone();
                $arztComment = $arzt->getArztComment();
                $userID = $arzt->getUserID();
                $clinicID = $arzt->getClinicID();
                $clinicName = getDBContent('clinics', 'clinicName', 'clinicID', $clinicID);
                $arztInfos = $acadTitle . ' ' . $arztFirstName . ' ' . $arztLastName . ' ';
                $arztInfos .= $clinicName;
                if ($arztPhone != "") $arztInfos .= ' - Telefon: ' . $arztPhone;
            } else {
                $arztInfos = "Arzt (ID $arztID) wurde gel&ouml;scht.";
            }
        } else {
            $arztInfos = "";
        }
        return $arztInfos;
    }

    public static function getArzt($arztID)
    {
        $entry = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `aerzte` WHERE arztID = '$arztID' ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $entry = mysqli_fetch_object($query_handle, 'Arzt');
                }
            }
        }
        mysqli_close($access);
        return $entry;
    }

    public static function getArztInfosShort($arztID)
    {
        if ($arztID != 0) {
            $doc = new Arzt();
            $arzt = $doc->getArzt($arztID);
            if (!empty($arzt)) {
                $acadTitle = $arzt->getAcadTitle();
                $arztFirstName = $arzt->getArztFirstName();
                $arztLastName = $arzt->getArztLastName();
                $arztInfos = $acadTitle . ' ' . $arztFirstName . ' ' . $arztLastName;
            } else {
                $arztInfos = "Arzt (ID $arztID) wurde gel&ouml;scht.";
            }
        } else {
            $arztInfos = "";
        }
        return $arztInfos;
    }

    public static function getAdminID()
    {
        $db_access = new Access();
        $access = $db_access->connectDB();
        $id = 0;
        if ($access) {
            $id = getDBContent('aerzte', 'arztID', 'arztStatus', 'a');
        }
        return $id;
    }

    public function getAllEntries()
    {
        $entries = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `aerzte` ORDER BY clinicID, arztLastName, arztFirstName ";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $entries[] = mysqli_fetch_object($query_handle, 'Arzt');
                    }
                }
            }
        }
        mysqli_close($access);
        return $entries;
    }

    public function saveEntry_arzt($entry)
    {
        global $x;
        $errorMessages = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $arztID = $entry->getArztID();
            $array = array(
                'arztGender' => $entry->getArztGender(),
                'acadTitle' => $entry->getAcadTitle(),
                'arztFirstName' => $entry->getArztFirstName(),
                'arztLastName' => $entry->getArztLastName(),
                'arztPhone' => $entry->getArztPhone(),
                'arztComment' => $entry->getArztComment(),
                'userID' => $entry->getUserID(),
                'clinicID' => $entry->getClinicID(),
                'arztStatus' => $entry->getArztStatus()
            );
            if ($arztID != 0) {
                $db_request = "Select * FROM `aerzte` WHERE `arztID` = '$arztID' ";
                $query_handle = mysqli_query($access, $db_request);
                if ($query_handle != "") {
                    $rows = mysqli_num_rows($query_handle);
                    if ($rows > 0) {
                        foreach ($array as $key => $value) {
                            $db_request2 = "Update `aerzte` SET `$key` = '$value' WHERE `arztID` = '$arztID' LIMIT 1 ";
                            $query_handle2 = mysqli_query($access, $db_request2);
                            if ($query_handle2 == "") {
                                $errorMessages[] = "Kein Update folgender Daten m?glich: '$key' => '$value'!";
                            }
                        }
                    } else {
                        $errorMessages[] = "Kein Arzt mit $arztID vorhanden.";
                    }
                } else {
                    $errorMessages[] = "Kein Selektieren des Arztes mit ID $arztID moeglich.";
                }
            } else {
                $userID = $entry->getUserID();
                $timestamp = date('Y-m-d H:i:s');
                $where = 'arztTimestamp, arztGender, acadTitle, arztFirstName, arztLastName, arztPhone, arztComment, userID, clinicID, arztStatus';
                $value = "'$timestamp', 'w', '', '', '', '', '', '$userID', '1','w'";
                $db_request = "INSERT INTO `aerzte` (" . $where . ") VALUES (" . $value . ")";
                $query_handle = mysqli_query($access, $db_request);
                if ($query_handle != "") {
                    $arztID = mysqli_insert_id($access);
                    setSavedOptionYes($x);
                } else {
                    $errorMessages[] = "Kein Eintragen der neuen Arztdaten m&ouml;glich.";
                }
            }
        } else {
            $errorMessages[] = "Kein Speichern der Arztdaten erfolgt.";
        }
        mysqli_close($access);
        return array($arztID => $errorMessages);
    }

    public function deleteArzt($arztID)
    {
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $userID = getDBContent('aerzte', 'userID', 'arztID', $arztID);
            $db_request = "DELETE FROM `logins` WHERE userID = $userID";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $db_request = "DELETE FROM `aerzte` WHERE arztID = $arztID";
                $query_handle = mysqli_query($access, $db_request);
                if ($query_handle != "") {
                } else {
                    print "<p class='errorMessage'>Konnte den Arzteintrag nicht in Datenbank l&ouml;schen! [deleteArzt($arztID)]</p>";
                }
            } else {
                print "<p class='errorMessage'>Konnte den UserLogin nicht in Datenbank l&ouml;schen! [deleteArzt($arztID)]</p>";
            }
        } else {
            print "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [deleteArzt($arztID)]</p>";
        }
    }

    /* set and get functions:
     *
     * like:
     *
     * public function getArztID() {
     *   return $this->arztID;
     * }
     *
     * public function setArztID($arztID) {
     *   $this->arztID = $arztID;
     * }
     *
     */

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
