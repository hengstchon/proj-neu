<?php

/**
 * dbAccess.php

 *
 * @package     Patienten-Daten-Verwaltungssystem == PDVS
 * @subpackage  Class for Database Connection
 *
 * Working History
 * Version 2.1  Oktober-November 2018
 *
 */
class Access
{
    public function connectDB()
    {

        $connectData = $this->getCredentials();
        $mysqli = new mysqli($connectData[0], $connectData[1], $connectData[2], $connectData[3]);

        if (mysqli_connect_errno()) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL . "<br/>";
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL . "<br/>";
            exit;
        }
        $mysqli->set_charset("latin1");
        return $mysqli;
    }

    private function getCredentials()
    {

        $dbHost = "";
        $dbUser = "";
        $dbPw = "";
        $dbName = "2011msqjbla24";

        return array($dbHost, $dbUser, $dbPw, $dbName);
    }
}