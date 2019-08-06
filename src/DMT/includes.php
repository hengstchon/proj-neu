<?php
/**

 * ------------------------------------------------------------------
 * Include all files
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
($dmt == 1) ? $pageName = "Telekonsil DMT (PDVS)" : $pageName = "Konsilschein - Telekonsil";
($dmt == 1) ? $baseURL = "../" : $baseURL = ""; // for css, js ...libs
($dmt == 1) ? $includePfadURL = "" : $includePfadURL = "DMT/";


($dmt == 1) ? $url = "DMT.php" : $url = "verwaltung.php";
($dmt == 1) ? $imgPrePfad = "../" : $imgPrePfad = "";

$url_search = $includePfadURL . "search.php";
include($includePfadURL . "classes/Access.php");
include($includePfadURL . "classes/Arzt.php");
include($includePfadURL . "classes/Clinic.php");
include($includePfadURL . "classes/Indication.php");
include($includePfadURL . "classes/Indication2.php");
include($includePfadURL . "classes/Indication2Detail.php");
include($includePfadURL . "classes/Login.php");
include($includePfadURL . "classes/Patient.php");
include($includePfadURL . "classes/PatientRecord.php");
include($includePfadURL . "classes/InfoMedication.php");
include($includePfadURL . "classes/InfoCondition.php");
include($includePfadURL . "helpers/aerzte.php");
include($includePfadURL . "helpers/buttons.php");
include($includePfadURL . "helpers/clinics.php");
include($includePfadURL . "helpers/constant.php");
include($includePfadURL . "helpers/helpers.php");
include($includePfadURL . "helpers/indication.php");
include($includePfadURL . "helpers/nav.php");
include($includePfadURL . "helpers/nihss.php");
include($includePfadURL . "helpers/mailer.php");
include($includePfadURL . "helpers/patients.php");
include($includePfadURL . "helpers/receive.php");
include($includePfadURL . "helpers/thrombolyse.php");
