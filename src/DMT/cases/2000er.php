<?php
/**

 * ------------------------------------------------------------------
 * Content Switch of cases form 2000 - 2999
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
switch ($x) {

    case 2000:
        echo "<h2><img src='assets/imagesLayout/blinkenRot.gif'> Offene Konsilscheine</h2>";
        listAllPatientsRecords('o');
        break;
    case 2100:
        echo "<h2>Abgeschlossene Konsilscheine</h2>";
        listAllPatientsRecords('t');
        break;
    case 2200:
        echo "<h2>Konsilschein-&Uuml;bersicht</h2>";
        listAllPatientsRecords('');
        break;
}