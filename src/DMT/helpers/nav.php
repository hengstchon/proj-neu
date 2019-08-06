<?php
/**

 * ------------------------------------------------------------------
 * Functions for Web App
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */

$pNavSign = "<span style='font-size:140%;'>&diams;</span>";


/**
 * @method navigation
 * @description navigation verwaltung (web)
 *
 */

function navigation()
{
    global $pNavSign;
    global $x, $url;
    $verwaltung[] = array("vwName" => "Neuer Patient", "vwCase" => "1000");
    $verwaltung[] = array("vwName" => "Offen", "vwCase" => "2000");
    $verwaltung[] = array("vwName" => "Abgeschlossen", "vwCase" => "2100");
    $verwaltung[] = array("vwName" => "Alle Patienten", "vwCase" => "3000");
    $verwaltung[] = array("vwName" => "Eigenes Profil", "vwCase" => "4000");
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bgColor mb-3">
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                foreach ($verwaltung as $key => $row) {
                    $buttonText = $row["vwName"];
                    $vwCase = $row["vwCase"];
                    ($x == $vwCase) ? $active = "active" : $active = "";
                    echo "
                        <li class='nav-item $active'>
                            <a class='nav-link' href='$url?x=$vwCase'>$buttonText</a>
                        </li>
                        ";
                }
                $excludeCases1 = array(2000, 2100, 3000);
                if (!in_array($x, $excludeCases1)) {
                    ($x == '1100') ? $active = "active" : $active = "";
                    echo "
                        <li class='nav-item $active'><a class='nav-link' href='$url?x=1100#suchen'>Suche</a></li>
                        ";
                }
                $excludeCases = array('100', '1000', '1010', '1100', '1020', '2000', '2100', '3000', '4000', '4110');
                if (!in_array($x, $excludeCases)) {
                    echo "<li class='nav-item'><a class='nav-link' href='#navPatient'>$pNavSign Patient</a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <?php
}
$a = new Arzt();
$adminArztID = Arzt::getAdminID();
if ($adminArztID == 0) {
    $verwaltung[] = array('vwName' => '&Auml;rzte', 'vwCase' => '4000', 'dbTabelle' => 'aerzte', 'dbSpalte' => 'arztID');
    $verwaltung[] = array('vwName' => 'Kliniken', 'vwCase' => '5000', 'dbTabelle' => 'clinics', 'dbSpalte' => 'clinicID');
    $nachricht = "<div class='row mb-5  text-danger text-center'>
    <dic class='col-12'>
    <h2>Admin-Arzt fehlt!</h2>
    <p>Bitte Admin in der Datenbank eintragen.</p>
    </div>
    </div>
    ";
} else {
    $verwaltung[] = array('vwName' => '&Auml;rzte', 'vwCase' => '4000', 'dbTabelle' => 'aerzte', 'dbSpalte' => 'arztID');
    $verwaltung[] = array('vwName' => 'Patienten', 'vwCase' => '3000', 'dbTabelle' => 'patients', 'dbSpalte' => 'patientID');
    $verwaltung[] = array('vwName' => 'Kliniken', 'vwCase' => '5000', 'dbTabelle' => 'clinics', 'dbSpalte' => 'clinicID');
    $nachricht = "";
}

function navDMT()
{
    global $verwaltung, $url, $x;
    ?>
    <nav class="navbar navbar-expand-lg  navbar-light bgColor d-print-none">
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                foreach ($verwaltung as $key => $row) {
                    $vwName[$key] = $row['vwName'];
                    $vwCase[$key] = $row['vwCase'];
                    ($x == $vwCase) ? $active = "active" : $active = "";
                    echo "
                        <li class='nav-item $active'><a class='nav-link' href='$url?x=" . $vwCase[$key] . "'>" . $vwName[$key] . "</a></li>
                        ";
                }
                ?>
            </ul>
        </div>
    </nav>
    <?php
}

function navigationHomeDMT()
{
    global $verwaltung, $url, $nachricht;
    ?>
    <div class="row mb-5">
        <?php
        if (!empty($verwaltung)) {
            foreach ($verwaltung as $key => $row) {
                $vwName[$key] = $row['vwName'];
                if (strlen($vwName[$key]) > 20) {
                    $buttonText = $vwName[$key];
                } else {
                    $buttonText = $vwName[$key] . '-Verwaltung';
                }
                $vwCase[$key] = $row['vwCase'];
                $dbTabelle[$key] = $row['dbTabelle'];
                $dbSpalte[$key] = $row['dbSpalte'];
                if ($dbTabelle[$key] != "") {
                    $count2 = ' (' . getMaxEntries($dbTabelle[$key], $dbSpalte[$key]) . ')';
                } else {
                    $count2 = "";
                }
                echo "<div class='col-sm-4'><h2>$vwName[$key]</h2>";
                    smallButton($url, $vwCase[$key], $buttonText . $count2, 'btn btn-primary mb-5', '', '');
                echo "</div>";
            }
        }
        ?>
    </div>
    <?php
    echo $nachricht;
}

function patientsNavigation()
{
    global $url;
    ?>
    <div class='row ml-1 mr-1'>
        <?php
        for ($i = 65; $i <= 90; $i++) {
            $capitalLetter = chr($i);
            $cnt = count(Patient::getAllEntriesOfCatitalLetter($capitalLetter));
            if ($cnt > 0) {
                ?>
                <form method='post' action='<?php echo $url; ?>' class='d-inline m-1'>
                    <input type='hidden' name='x' value='3000'/>
                    <input type='hidden' name='capitalLetter' value='<?php echo $capitalLetter; ?>'/>
                    <button class='form-control'><?php echo $capitalLetter; ?></button>
                </form>
                <?php
            } else {
                echo "<div  class='d-inline m-2'>$capitalLetter</div>";
            }
        }
        ?>
    </div>
    <?php
}
