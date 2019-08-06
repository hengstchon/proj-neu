<?php

/**
 * login.php
 *

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class of Login Data
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Login
{
    private $userID;
    private $userLogin;
    private $userPW;
    private $userEmail;

    /**
     * @return mixed
     */

    public function getLogin_UserID($userLogin)
    {
        $userID = '';
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT userID FROM `logins` WHERE userLogin ='$userLogin' Limit 1";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $data = mysqli_fetch_row($query_handle);
                    $userID = $data[0];
                }
            } else {
                echo "<p class='errorMessage'>Kein UserID-Zugriff m&ouml;glich [user-check].</p>";
            }
        } else {
            echo "<p class='errorMessage'>Kein Zugriff [user-check]. </p>";
        }
        mysqli_close($access);
        return $userID;
    }

    public function getLogin_PW($userLogin)
    {
        $pw = '0';
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT userPW FROM `logins` WHERE userLogin ='$userLogin' Limit 1";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $data = mysqli_fetch_row($query_handle);
                    $pw = $data[0];
                }
            } else {
                echo "<p class='errorMessage'>Kein User-Zugriff m&ouml;glich [login-check].</p>";
            }
        } else {
            echo "<p class='errorMessage'>Kein Zugriff [login-check]. </p>";
        }
        return $pw;
    }

    public function getLogin_data($userLogin)
    {
        $data = array();
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request = "SELECT * FROM `logins` WHERE userLogin ='$userLogin' Limit 1";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $rows = mysqli_num_rows($query_handle);
                if ($rows > 0) {
                    $data = mysqli_fetch_row($query_handle);
                }
            } else {
                echo "<p class='errorMessage'>Kein Zugriff m&ouml;glich [login-data].</p>";
            }
        } else {
            echo "<p class='errorMessage'>Kein Zugriff [login-data]. </p>";
        }
        mysqli_close($access);
        return $data;
    }

    public function insertLogin($login, $pw)
    {
        $userID = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $where = 'userLogin, userPW, userEMail';
            $value = "'$login','$pw',''";
            $db_request = "INSERT INTO `logins` (" . $where . ") VALUES (" . $value . ")";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $userID = mysqli_insert_id($access);
            }
        }
        mysqli_close($access);
        return $userID;
    }

    public static function saveLogin($userID, $userLogin, $userPW, $userEMail)
    {
        $ID = "";
        $db_access = new Access();
        $access = $db_access->connectDB();
        if ($access) {
            $db_request1 = "SELECT userID FROM `logins` WHERE userID = '$userID'";
            $query_handle1 = mysqli_query($access, $db_request1);
            if ($query_handle1 != "") {
                $rows = mysqli_num_rows($query_handle1);
                if ($rows > 0) {
                    $loginCheck = true;
                    $db_request2 = "SELECT userID  FROM `logins` WHERE userLogin = '$userLogin'";
                    $query_handle2 = mysqli_query($access, $db_request2);
                    if ($query_handle2 != "") {
                        $rows2 = mysqli_num_rows($query_handle2);
                        if ($rows2 > 0) {
                            for ($i = 0; $i < $rows2; $i++) {
                                $data2 = mysqli_fetch_row($query_handle2);
                                $userID1 = $data2[0];
                                if ($userID1 <> $userID) {
                                    print "<p class='errorMessage'>Der Login Name wurde nicht gespeichert, da dieser schon existiert.</p>";
                                    $loginCheck = false;
                                }
                            }
                        }
                    } else {
                        print "<p class='errorMessage'>Keine Anfrage m&ouml;glich! [saveArztLogin > checkLoginName]</p>";
                    }
                    if ($loginCheck == true) {
                        $db_request = "UPDATE `logins` SET userLogin = '$userLogin' WHERE userID = $userID";
                        $query_handle = mysqli_query($access, $db_request);
                        if ($query_handle != "") {
                        } else {
                            print "<p class='errorMessage'>Konnte Login Name nicht &auml;ndern!</p>";
                        }
                    }
                    $db_request = "UPDATE `logins` SET userPW = '$userPW' WHERE userID = $userID";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        print "<p class='errorMessage'>Konnte Passwort nicht &auml;ndern!</p>";
                    }
                    $db_request = "UPDATE `logins` SET userEMail = '$userEMail' WHERE userID = $userID";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        print "<p class='errorMessage'>Konnte E-Mail-Adresse nicht &auml;ndern!</p>";
                    }
                    $ID = $userID;
                } else {
                    $where = 'userLogin, userPW, userEMail';
                    $value = " '','',''";
                    $db_request = "INSERT INTO `logins` (" . $where . ") VALUES (" . $value . ")";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                        $ID = mysqli_insert_id($access);
                    } else {
                        print "<p class='errorMessage'>Konnte kein neuen Eintrag erzeugen [saveArztLogin]!</p>";
                    }
                }
            }
        } else {
            print "<p class='errorMessage'>Kein Zugriff auf Datenbank [saveArztLogin]!</p>";
        }
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
