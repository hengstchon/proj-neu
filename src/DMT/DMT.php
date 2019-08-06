<?php
/**

 * ------------------------------------------------------------------
 * Verwaltung der Kliniken, Aerzte, Patienten und deren Untersuchungen
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
$encoding = mb_internal_encoding("iso-8859-1");
mb_http_output("iso-8859-1");
session_set_cookie_params(3600);// einstellen auf 3600 = 60 Minuten
session_start();
$case = 'dmt';
$dmt = 1;

include_once("includes.php");

$x = getPOSTAndGETData('x');
if ($x == '') {
    $x = 1000;
}
include($baseURL . "html_head.php");
if (isset($_SESSION['xWas'])){
    $xWas = $_SESSION['xWas'];
} else {
    $xWas = "";
}
if ($xWas != $x) {
    setSavedEmpty();
}
if (($x >= 1000) and ($x < 9000)) {
    if ($x != 1000) {
        navDMT();
    }
    switch ($x) {
        case 1000:
        case 1010:
        case 1015:
        case 1020:
        case 1025:
        case 1030:
        case 1033:
        case 1035:
        case 1100:
        case 1200:
        case 1210:
        include("cases/1000erDMT.php");
            break;
        case 2000:
        case 2100:
        case 2200:
            include("cases/2000er.php");
            break;
        case 3000:
        case 3200:
        case 3215:
        case 3216:
        case 3220:
        case 3235:
        case 3300:
        case 3310:
        case 3315:
        case 3316:
        case 3320:
        case 3400:
        case 3410:
        case 3415:
        case 3416:
        case 3420:
        case 3999:
            include("cases/3000er.php");
            break;
        case 4000:
        case 4100:
        case 4110:
        case 4120:
        case 4200:
        case 4210:
        include("cases/4000erDMT.php");
            break;
        case 5000:
            listClinics();
            break;
    }
    if ($x != 1000) {
        ?>
        <div class="row text-center d-print-none mt-5">
            <div class="col-12">
                <a href='#top' class='btn btn-outline-success m-auto' >Nach Oben</a></div>
        </div>
        <?php
        smallButton($url, '1000', 'Home Verwaltungstools', 'btn btn-outline-success w-100 mt-5 mb-5', '', '');
    }
}
include("../html_js.php");
?>
</div>
</div>
</div>
</body>
</html>