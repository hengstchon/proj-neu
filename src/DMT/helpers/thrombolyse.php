<?php
/**

 * ------------------------------------------------------------------
 * Functions for Web App
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */

/**
 * @method editThrombolyseForm
 * @description
 *
 * @param $patientID
 * @param $ptID
 */
function editThrombolyseForm($patientID, $ptID)
{
    global $url;
    $add[] = "<input type='hidden' name='patientID' value='$patientID' />";
    $add[] = "<input type='hidden' name='ptID' value='$ptID' />";
    smallButton($url, '3400', 'Thrombolyse (id:' . $ptID . ')', 'btn btn-primary', $add, '');
}

function editPatientThrombolyse($ptID)
{
    global $url, $dmt;
    if ($dmt == 0) {
        $arztID = $_SESSION['arztID'];
    }
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        $db_request1 = "
        SELECT arztID, patientID, patientRecordID, apaVoreinnahme, mVoreinnahme, vorhofflimmern, diabetes, hypertonus, vorSchlaganfall, oberArztTime, oberArztDescr, laborWerteTime, laborWert1, laborWert2, laborWert3, laborWert4, laborWert5, bdSenkungOption, lyseDecisionTime, lyseDecisionDescr1, lyseDecisionDescr2, dosisWert1, dosisWert2, dosisWert3, dosisWert4, timeLyseStart, timeLyseEnd, rekonsilArztID, nihssWert2448, complications, nihssWert7days, ranking, entlassung, timeCCTStart, timeCCTEnd, cctDescr1, cctDescr2, cctDescr3, cctOption1, cctOption2, cctOption3, cctOption4, entlassungNach, apaVoreinnahme2, apaVoreinnahme3, bdWert1Aufnahme, bdWert2Aufnahme, bdDescrAufnahme,  bdWert1vorLyse, bdWert2vorLyse, bdDescrvorLyse  
        FROM patientThrombolyse 
        WHERE ptID = '$ptID'";
        $query_handle1 = mysqli_query($access, $db_request1);
        if ($query_handle1 != "") {
            $rows1 = mysqli_num_rows($query_handle1);
            if ($rows1 == 0) {
                echo "<p>Keine Thrombolyse-Dokumentation vorhanden.</p>";
            } else {
                $data = mysqli_fetch_row($query_handle1);
                $tArztID = $data[0];
                $patientID = $data[1];
                $patientRecordID = $data[2];
                $apaVoreinnahme = $data[3];
                $mVoreinnahme = $data[4];
                $vorhofflimmern = $data[5];
                $diabetes = $data[6];
                $hypertonus = $data[7];
                $vorSchlaganfall = $data[8];
                $oberArztTime = $data[9];
                $oberArztDescr = $data[10];
                $laborWerteTime = $data[11];
                $laborWert1 = $data[12];
                $laborWert2 = $data[13];
                $laborWert3 = $data[14];
                $laborWert4 = $data[15];
                $laborWert5 = $data[16];
                $bdSenkungOption = $data[17];
                $lyseDecisionTime = $data[18];
                $lyseDecisionDescr1 = $data[19];
                $lyseDecisionDescr2 = $data[20];
                $dosisWert1 = $data[21];
                $timeLyseStart = $data[25];
                $timeLyseEnd = $data[26];
                $rekonsilArztID = $data[27];
                $nihssWert2448 = $data[28];
                $complications = $data[29];
                $nihssWert7days = $data[30];
                $ranking = $data[31];
                $entlassung = $data[32];
                $timeCCTStart = $data[33];
                $cctDescr1 = $data[35];
                $cctDescr2 = $data[36];
                $cctOption1 = $data[38];
                $entlassungNach = $data[42];
                $apaVoreinnahme2 = $data[43];
                $apaVoreinnahme3 = $data[44];
                $bdWert1Aufnahme = $data[45];
                $bdWert2Aufnahme = $data[46];
                $bdDescrAufnahme = $data[47];
                $bdWert1vorLyse = $data[48];
                $bdWert2vorLyse = $data[49];
                $laborWert1 = str_replace('.', ',', $laborWert1);
                $laborWert2 = str_replace('.', ',', $laborWert2);
                $laborWert3 = str_replace('.', ',', $laborWert3);
                $laborWert4 = str_replace('.', ',', $laborWert4);
                $laborWert5 = str_replace('.', ',', $laborWert5);
                $timeSymptoms = getDBContent('patientRecords', 'timeSymptoms', 'patientRecordID', $patientRecordID);
                $timeInitialContact = getDBContent('patientRecords', 'timeInitialContact', 'patientRecordID', $patientRecordID);
                $timeHospital = getDBContent('patientRecords', 'timeHospital', 'patientRecordID', $patientRecordID);
                if ($timeSymptoms != "0000-00-00 00:00:00") {
                    $timeSymptoms = strtotime($timeSymptoms);
                    $timeSymptoms = date('d.m.Y H:i', $timeSymptoms) . " Uhr";
                } else {
                    $timeSymptoms = "nicht angegeben";
                }
                if ($timeHospital != '0000-00-00 00:00:00') {
                    $timeHospital = strtotime($timeHospital);
                    $timeHospital = date('d.m.Y H:i', $timeHospital) . " Uhr";
                } else {
                    $timeHospital = "nicht angegeben";
                }
                $nArztID = getDBContent('patientRecords', 'therapyArztID', 'patientRecordID', $patientRecordID);
                if ($nArztID != 0) {
                    $nArztInfo = Arzt::getArztInfos($nArztID);
                } else {
                    $nArztInfo = "Keine Therapie-Arztdaten hinterlegt.";
                }
                if ($timeCCTStart != "") {
                    $timeCCTStartArray = explode(':', $timeCCTStart);
                    $timeCCT1H = $timeCCTStartArray[0];
                    $timeCCT1Min = $timeCCTStartArray[1];
                } else {
                    $timeCCT1H = '00';
                    $timeCCT1Min = '00';
                }
                if ($oberArztTime != "") {
                    $OATimeArray = explode(':', $oberArztTime);
                    $timeOAH = $OATimeArray[0];
                    $timeOAMin = $OATimeArray[1];
                } else {
                    $timeOAH = '00';
                    $timeOAMin = '00';
                }
                $timeTherapy = getDBContent('patientRecords', 'timeTreatment', 'patientRecordID', $patientRecordID);
                if ($timeTherapy != "0000-00-00 00:00:00") {
                    $timeTherapyA = strtotime($timeTherapy);
                    $timeTherapy = date("d.m.Y. H:i", $timeTherapyA) . " Uhr";
                } else {
                    $timeTherapy = "Keine Datum vorhanden";
                }
                if ($laborWerteTime != "") {
                    $laborWerteTimeA = explode(':', $laborWerteTime);
                    $timeLaborH = $laborWerteTimeA[0];
                    $timeLaborMin = $laborWerteTimeA[1];
                } else {
                    $timeLaborH = '00';
                    $timeLaborMin = '00';
                }
                if ($lyseDecisionTime != "") {
                    $lyseDecisionTimeArray = explode(':', $lyseDecisionTime);
                    $timeLDH = $lyseDecisionTimeArray[0];
                    $timeLDMin = $lyseDecisionTimeArray[1];
                } else {
                    $timeLDH = '00';
                    $timeLDMin = '00';
                }
                $pGewicht = getDBContent('patientRecords', 'pGewicht', 'patientRecordID', $patientRecordID);
                if ($timeLyseStart == "") $timeLyseStart = "0000-00-00 00:00:00";
                $timeLyseStart = str_replace(' ', '-', $timeLyseStart);
                $timeLyseStart = str_replace(':', '-', $timeLyseStart);
                $timeLyseStartArray = explode('-', $timeLyseStart);
                $time1 = $timeLyseStartArray[0];
                $time2 = $timeLyseStartArray[1];
                $time3 = $timeLyseStartArray[2];
                $time4 = $timeLyseStartArray[3];
                $time5 = $timeLyseStartArray[4];
                $time6 = $timeLyseStartArray[5];
                if ($timeLyseEnd == "") $timeLyseEnd = "0000-00-00 00:00:00";
                $timeLyseEnd = str_replace(' ', '-', $timeLyseEnd);
                $timeLyseEnd = str_replace(':', '-', $timeLyseEnd);
                $timeLyseEndArray = explode('-', $timeLyseEnd);
                $time1a = $timeLyseEndArray[0];
                $time2a = $timeLyseEndArray[1];
                $time3a = $timeLyseEndArray[2];
                $time4a = $timeLyseEndArray[3];
                $time5a = $timeLyseEndArray[4];
                $time6a = $timeLyseEndArray[5];
                if ($entlassung == "") $entlassung = "0000-00-00 00:00:00";
                $entlassung = str_replace(' ', '-', $entlassung);
                $entlassung = str_replace(':', '-', $entlassung);
                $entlassungArray = explode('-', $entlassung);
                $time1b = $entlassungArray[0];
                $time2b = $entlassungArray[1];
                $time3b = $entlassungArray[2];
                $time4b = $entlassungArray[3];
                $time5b = $entlassungArray[4];
                $time6b = $entlassungArray[5];
                $editLink = "<a href='$url?x=1025&patientRecordID=$patientRecordID&patientID=$patientID' class='btn btn-outline-primary ml-5 mb-1'>&Auml;ndern</a>";
                $editLinkTherapy = "<a href='$url?x=3300&patientRecordID=$patientRecordID&patientID=$patientID' class='btn btn-outline-primary'>&Auml;ndern</a>";
                $d = new Arzt();
                $docs = $d->getAllEntries();
                ?>
                <div class='row mb-1'>
                    <div class='col-sm-3'> Beginn der Symptomatik:</div>
                    <div class='col-xs-6 col-sm-4'><?php echo $timeSymptoms; ?></div>
                    <div class='col-xs-6 col-sm-2'><?php if ($dmt == 1) echo $editLink; ?> </div>
                </div>
                <div class='row mb-3'>
                    <div class='col-sm-3'> Klinikaufnahme:</div>
                    <div class='col-xs-6 col-sm-4'><?php echo $timeHospital; ?></div>
                    <div class='col-xs-6 col-sm-2'><?php if ($dmt == 1) echo $editLink; ?> </div>
                </div>
                <form method='Post' action='<?php echo $url; ?>'>
                    <input type='hidden' name='x' value='3410'/>
                    <input type='hidden' name='ptID' value='<?php echo $ptID; ?>'/>
                    <input type='hidden' name='patientID' value='<?php echo $patientID; ?>'/>
                    <input type='hidden' name='patientRecordID' value='<?php echo $patientRecordID; ?>'/>
                    <div class='row mb-3'>
                        <div class='col-sm-3'>Erstkontakt mit med. Personal:</div>
                        <div class='col-sm-9'><input name='timeInitialContact'
                                                     value='<?php echo $timeInitialContact; ?>'
                                                     class='form-control'/></div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-sm-3'>Voreinnahme :</div>
                        <div class='col-sm-9'>
                            <div class='row'>
                                <?php
                                $voreinnahmeArray['apaVoreinnahme'] = array("ASS", $apaVoreinnahme);
                                $voreinnahmeArray['apaVoreinnahme2'] = array("Plavix", $apaVoreinnahme2);
                                $voreinnahmeArray['apaVoreinnahme3'] = array("Aggrenox", $apaVoreinnahme3);
                                $voreinnahmeArray['mVoreinnahme'] = array("Marcumar", $mVoreinnahme);
                                foreach ($voreinnahmeArray as $keyV => $infoArray) {
                                    $text = $infoArray[0];
                                    $acticeKey = $infoArray[1];
                                    ($acticeKey == 'j') ? $checked = "checked" : $checked = "";
                                    echo "<div class='col-xs-2'>
                                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='checkbox' 
                                            name='$keyV' id='symp_$keyV' value='j' $checked/>
                                        <label class='form-check-label' for='symp_$keyV'>$text</label>
                                    </div>
                                 </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3'>Vorhofflimmern:
                            <div class='form-check form-check-inline'>
                                <input type='checkbox' class='form-check-input' name='vorhofflimmern'
                                       id='vorhofflimmern' value='j'
                                    <?php if ($vorhofflimmern == 'j') echo "checked "; ?>
                                />
                                <label class='form-check-label' for='vorhofflimmern'> ja</label>
                            </div>
                        </div>
                        <div class='col-sm-4'>Fr&uuml;herer Schlaganfall:
                            <div class='form-check form-check-inline'>
                                <input type='checkbox' class='form-check-input'
                                       name='vorSchlaganfall' id='vorSchlaganfall' value='j'
                                    <?php if ($vorSchlaganfall == 'j') echo "checked"; ?>
                                />
                                <label class='form-check-label' for='vorSchlaganfall'> ja</label>
                            </div>
                        </div>
                        <div class='col-sm-2'>Diabetes:
                            <div class='form-check form-check-inline'>
                                <input type='checkbox' class='form-check-input' name='diabetes' id='diabetes' value='j'
                                    <?php if ($diabetes == 'j') echo " checked "; ?>
                                />
                                <label class='form-check-label' for='diabetes'> ja</label>
                            </div>
                        </div>
                        <div class='col-sm-3'>Hypertonus:
                            <div class='form-check form-check-inline'>
                                <input type='checkbox' class='form-check-input' name='hypertonus'
                                       id='hypertonus' value='j'
                                    <?php if ($hypertonus == 'j') echo " checked "; ?>
                                />
                                <label class='form-check-label' for='hypertonus'> ja</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3'>Blutdruck vor Thrombolyse:</div>
                        <span class='col-sm-9'>
                            <input name='bdWert1Aufnahme' id='bdWert1Aufnahme'
                                   value='<?php echo $bdWert1Aufnahme; ?>'
                                   class='col-2 form-control form-check-inline text-right'/>
                        <span> /</span>
                            <input name='bdWert2Aufnahme' id='bdWert2Aufnahme'
                                   value='<?php echo $bdWert2Aufnahme; ?>'
                                   class='col-2 form-control form-check-inline text-right'/>
                        <span> mmHg =></span>
                            <input name='bdDescrAufnahme' id='bdDescrAufnahme'
                                   value='<?php echo $bdDescrAufnahme; ?>'
                                   class='col-2 form-control form-check-inline text-right'/>
                    </div>
                    <hr>
                    <h4>Beginn CCT:</h4>
                    <?php
                    $hourArray = array('timeCCTStartH', $timeCCT1H);
                    $minutesArray = array('timeCCTStartMin', $timeCCT1Min);
                    createFormRow_Time("Beginn Uhrzeit:", $hourArray, $minutesArray);
                    ?>
                    <div class='form-group row'>
                        <div class='col-sm-3'>Anmerk.:</div>
                        <div class='col-sm-9'><input name='cctDescr1' class='form-control'
                                                     value='<?php echo $cctDescr1; ?>'/></div>
                    </div>
                    <?php
                    $hourArray = array('oberArztTimeH', $timeOAH);
                    $minutesArray = array('oberArztTimeMin', $timeOAMin);
                    createFormRow_Time("Ggfs. R&uuml;ck&shy;sprache Oberarzt:", $hourArray, $minutesArray);
                    ?>
                    <div class='form-group row'>
                        <div class='col-sm-3'>Anmerk.:</div>
                        <div class='col-sm-9'><input name='oberArztDescr' class='form-control'
                                                     value='<?php echo $oberArztDescr; ?>'/></div>
                    </div>
                    <hr>
                    <h4>Beginn Telekonsil:</h4>
                    <div class='row mb-3'>
                        <div class='col-sm-6'>Durchf&uuml;hrender Arzt: <?php echo $nArztInfo; ?></div>
                        <div class='col-sm-3'><?php echo $timeTherapy; ?></div>
                        <div class='col-sm-3'><?php if ($dmt == 1) echo $editLinkTherapy; ?> </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <h5>NIHSS - durchgef&uuml;hrte Dokumentation:</h5>
                            <?php getNIHSSlist($patientRecordID); ?>
                        </div>
                        <div class='col-sm-6'>
                            <h5>NIHSS - Eingetragene Werte im Konsilschein:</h5>
                            <?php getTotalNIHSSWerte($patientRecordID); ?>
                        </div>
                    </div>
                    <hr>
                    <h4>Laborwerte: </h4>
                    <?php
                    $hourArray = array('laborWerteTimeH', $timeLaborH);
                    $minutesArray = array('laborWerteTimeMin', $timeLaborMin);
                    createFormRow_Time("Uhrzeit:", $hourArray, $minutesArray);
                    ?>
                    <div class='row'>
                        <div class='col-sm-3'>Thrombozyten:</div>
                        <div class='col-sm-9'>
                            <table class='table'>
                                <tr>
                                    <?php
                                    ?>
                                    <td>&nbsp;</td>
                                    <td><input name='laborWert1' class='form-control text-right'
                                               value='<?php echo $laborWert1; ?>'/></td>
                                    <td>td/cmm</td>
                                </tr>
                                <tr>
                                    <td>Hb:</td>
                                    <td><input name='laborWert2' class='form-control text-right'
                                               value='<?php echo $laborWert2; ?>'/></td>
                                    <td>g/dl</td>
                                </tr>
                                <tr>
                                    <td>NR:</td>
                                    <td><input name='laborWert3' class='form-control text-right'
                                               value='<?php echo $laborWert3; ?>'/></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>PTT:</td>
                                    <td><input name='laborWert4' class='form-control text-right'
                                               value='<?php echo $laborWert4; ?>'/></td>
                                    <td>sek</td>
                                </tr>
                                <tr>
                                    <td>BZ bei Aufnahme</td>
                                    <td><input name='laborWert5' class='form-control text-right'
                                               value='<?php echo $laborWert5; ?>'/></td>
                                    <td>mg/dl</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class='row mb-3'>
                        <div class="col-sm-3">Blutdruck vor Lyse:</div>
                        <div class="col-sm-3 mb-1">
                            <input name='bdWert1vorLyse' class='col-2 form-control form-check-inline text-right'
                                   value='<?php echo $bdWert1vorLyse; ?>'/>
                            <span>/</span>
                            <input name='bdWert2vorLyse' class='col-2 form-control form-check-inline text-right'
                                   value='<?php echo $bdWert2vorLyse; ?>'/>
                        </div>
                        <div class="col-sm-6">
                            Blutdrucksenkung vor Lyse (im KH) :
                            <input type='checkbox' name='bdSenkungOption' id='bdSenkungOption'
                                   value='j' class='col-1 form-check form-check-inline'
                                <?php if ($bdSenkungOption == 'j') echo " checked"; ?> />
                            <label for='bdSenkungOption'>ja</label>
                        </div>
                    </div>
                    <h4>Entscheidung Lyse:</h4>
                    <?php
                    $hourArray = array('lyseDecisionTimeH', $timeLDH);
                    $minutesArray = array('lyseDecisionTimeMin', $timeLDMin);
                    createFormRow_Time("Uhrzeit:", $hourArray, $minutesArray);
                    ?>
                    <div class='row mb-3'>
                        <div class="col-sm-3">Anmerk.:</div>
                        <div class="col-sm-9"><input name='lyseDecisionDescr1' class='form-control'
                                                     value='<?php echo $lyseDecisionDescr1; ?>'/></div>
                    </div>
                    <div class='row mb-3'>
                        <div class="col-sm-3">keine Lyse wegen:</div>
                        <div class="col-sm-9"><input name='lyseDecisionDescr2' class='form-control'
                                                     value='<?php echo $lyseDecisionDescr2; ?>'/></div>
                    </div>
                    <div class='row mb-3'>
                        <div class="col-xs-12 col-sm-3 h5">Dosis rtPA: => K&ouml;rpergewicht:</div>
                        <div class="col-xs-2 col-sm-3">
                            <input name='pGewicht' value='<?php echo $pGewicht; ?>'
                                   class='col-2 form-control text-right'/>
                        </div>
                        <div class="col-xs-10 col-sm-6 small">
                            <?php
                            if ($pGewicht == 0) {
                                ?>
                                kg x 0,9 => ... mg rtPA = ml-L&ouml;sung Gesamt,
                                <br>
                                10% der Gesamtdosis als Bolus = ... ml;
                                Rest (90%) &uuml;ber 1 Std. = ... ml = ml/h (Laufrate Perfusor)
                                <?php
                            } else {
                                if ($pGewicht <= 100) {
                                    $dosisWert1 = ($pGewicht * 0.9);
                                    $dosisWert1a = str_replace('.', ',', $dosisWert1);
                                } else {
                                    $dosisWert1a = "90";
                                }
                                $dosisWert2 = $dosisWert1 / 10;
                                $dosisWert2a = str_replace('.', ',', $dosisWert2);
                                $dosisWert3 = $dosisWert1 - $dosisWert2;
                                $dosisWert3a = str_replace('.', ',', $dosisWert3);
                                echo "
                                    $pGewicht kg => $dosisWert1a mg rtPA = ml-L&ouml;sung Gesamt,
                                    <input type='hidden' name='dosisWert1' value='$dosisWert1a' />
                                    <br />
                                    10% der Gesamtdosis als Bolus = $dosisWert2a ml;
                                    Rest (90%) &uuml;ber 1 Std. = $dosisWert3a ml = ml/h (Laufrate Perfusor)
                                ";
                            }
                            ?>
                        </div>
                    </div>
                    <h4>Beginn Lyse:</h4>
                    <?php
                    $dArray = array('timeLyseStartD', $time3);
                    $mArray = array('timeLyseStartM', $time2);
                    $yArray = array('timeLyseStartY', $time1);
                    $hArray = array('timeLyseStartH', $time4);
                    $minArray = array('timeLyseStartMin', $time5);
                    createFormRow_DateTime("Datum:", $dArray, $mArray, $yArray, $hArray, $minArray, '');
                    ?>
                    <h4>End Lyse:</h4>
                    <?php
                    $dArray = array('timeLyseEndD', $time3a);
                    $mArray = array('timeLyseEndM', $time2a);
                    $yArray = array('timeLyseEndY', $time1a);
                    $hArray = array('timeLyseEndH', $time4a);
                    $minArray = array('timeLyseEndMin', $time5a);
                    createFormRow_DateTime("Datum:", $dArray, $mArray, $yArray, $hArray, $minArray, '');
                    ?>
                    <div class='row mt-3'>
                        <div class="col-sm-3">Durchf&uuml;hrender Arzt:</div>
                        <div class="col-sm-9">
                            <select name='tArztID' class='form-control'>
                                <?php
                                if ($tArztID == '') {
                                    $infoA = Arzt::getArztInfos($arztID);
                                    echo "<option value='$arztID'>$infoA</option>";
                                } else {
                                    $infoA = Arzt::getArztInfos($tArztID);
                                    echo "<option value='$tArztID'>$infoA</option>";
                                }
                                echo "<option value=''>Bitte ausw&auml;hlen</option>";
                                if (!empty($docs)) {
                                    foreach ($docs as $doc) {
                                        $arztID_here = $doc->getArztID();
                                        $info_here = $doc->getArztInfosShort($arztID_here);
                                        $clinicID_here = $doc->getClinicID();
                                        $clinicInitial = getDBContent('clinics', 'clinicInitial', 'clinicID', $clinicID_here);
                                        $clinicType = getDBContent('clinics', 'clinicType', 'clinicID', $clinicID_here);
                                        if ($clinicType == 'k') {
                                            echo "<option value='$arztID_here'>$clinicInitial - $info_here</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class='row mb-3'>
                        <div class="col-sm-3">Kontroll-CCT <br/>24-48 Std. nach Lyse:</div>
                        <div class="col-sm-3">Einblutung:</div>
                        <div class="col-sm-6">
                            <?php
                            if ($cctOption1 != '') {
                                if ($cctOption1 == 'j') {
                                    $j = "checked";
                                    $n = "";
                                } else {
                                    $j = "";
                                    $n = "checked";
                                }
                            } else {
                                $j = "";
                                $n = "";
                            }
                            ?>
                            <input class='form-check form-check-inline' type='radio' name='cctOption1'
                                   id='cctOption1_j' value='j' <?php echo $j; ?> />
                            <label for='cctOption1_j' class='mr-5'> asympt.</label>
                            <input class='form-check form-check-inline' type='radio' name='cctOption1'
                                   id='cctOption1_n' value='n' <?php echo $n; ?>/>
                            <label for='cctOption1_n'> sympt.</label>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-sm-3">Sonstiges:</div>
                        <div class="col-sm-9"><input name='cctDescr2' class='form-control'
                                                     value='<?php echo $cctDescr2; ?>'/></div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class="col-sm-3"> NIHSS nach 24-48 Std.</div>
                        <div class="col-sm-2 mb-3">
                            <input name='nihssWert2448' class='form-control'
                                <?php if ($nihssWert2448 != 0) echo "value='$nihssWert2448'"; ?>/>
                        </div>
                        <div class="col-sm-2"> Re-Konsil durch:</div>
                        <div class="col-sm-5">
                            <select name='rekonsilArztID' class='form-control'>
                                <?php
                                if ($rekonsilArztID == 0) {
                                    echo "<option value='0'>Bitte w&auml;hlen</option>";
                                } else {
                                    $info2 = Arzt::getArztInfos($rekonsilArztID);
                                    echo "<option value='$rekonsilArztID'>$info2</option>";
                                }
                                if (!empty($docs)) {
                                    foreach ($docs as $doc) {
                                        $d_id = $doc->getArztID();
                                        $clinicID_h = $doc->getClinicID();
                                        $info = $doc->getArztInfosShort($d_id);
                                        $clinicInitial = getDBContent('clinics', 'clinicInitial', 'clinicID', $clinicID_h);
                                        echo "<option value='$d_id'>$clinicInitial - $info </option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class="col-sm-3">Sonstige Komplikationen:</div>
                        <div class="col-sm-9">
                            <textarea name='complications' class='form-control'
                            ><?php echo $complications; ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class="col-sm-3">Tag 7 / Entlassung: </div>
                        <div class="col-sm-1">NIHSS: </div>
                        <div class="col-sm-1">
                            <input name='nihssWert7days' class='form-control'
                                <?php if ($nihssWert7days != 0) echo " value='$nihssWert7days'"; ?> /></div>
                        <div class="col-sm-7">Ranking-Score:
                            <?php
                            for ($i = 1; $i <= 6; $i++) {
                                echo "<input type='radio' name='ranking' id='ranking_$i' value='$i'  
                                         class='form-check form-check-inline '";
                                if ($ranking == $i) echo " checked ";
                                echo "/>
                                 <label for='ranking_$i' class='mr-3'>$i</label>";
                            }
                            ?>
                        </div>
                    </div>
                    <h4>Entlassung am:</h4>
                    <?php
                    $dArray = array('entlassungD', $time3b);
                    $mArray = array('entlassungM', $time2b);
                    $yArray = array('entlassungY', $time1b);
                    $hArray = array('entlassungH', $time4b);
                    $minArray = array('entlassungMin', $time5b);
                    createFormRow_DateTime("Datum:", $dArray, $mArray, $yArray, $hArray, $minArray, '');
                    ?>
                    <div class='row'>
                        <div class="col-sm-3">Entlassung nach: </div>
                        <div class="col-sm-9">
                            <select name='entlassungNach' class='form-control'>
                                <?php
                                if ($entlassungNach != '') {
                                    echo "<option value='$entlassungNach' selected>$entlassungNach</option>";
                                }
                                ?>
                                <option value=''>Bitte w&auml;hlen</option>
                                <option value='Reha'>Reha</option>
                                <option value='zuhause'>zuhause</option>
                                <option value='Pflege'>Pflege</option>
                                <option value='Tod'>Tod</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <?php
                    ?>
                    <button class='btn btn-primary mb-3'>Weiter</button>
                </form>
                <?php
            }
        } else {
            echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [editPatientThrombolyse($ptID) ]</p>";
        }
    }
}

function showPatientThrombolyseWerte($ptID)
{
    global $dmt;
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        $db_request1 = "SELECT arztID, patientID, patientRecordID, apaVoreinnahme, mVoreinnahme, vorhofflimmern, diabetes, hypertonus, vorSchlaganfall, oberArztTime, oberArztDescr, laborWerteTime, laborWert1, laborWert2, laborWert3, laborWert4, laborWert5, bdSenkungOption, lyseDecisionTime, lyseDecisionDescr1, lyseDecisionDescr2, dosisWert1, dosisWert2, dosisWert3, dosisWert4, timeLyseStart, timeLyseEnd, rekonsilArztID, nihssWert2448, complications, nihssWert7days, ranking, entlassung, timeCCTStart, timeCCTEnd, cctDescr1, cctDescr2, cctDescr3, cctOption1, cctOption2, cctOption3, cctOption4, entlassungNach, apaVoreinnahme2, apaVoreinnahme3, bdWert1Aufnahme, bdWert2Aufnahme, bdDescrAufnahme,  bdWert1vorLyse, bdWert2vorLyse, bdDescrvorLyse  FROM patientThrombolyse WHERE ptID = '$ptID'";
        $query_handle1 = mysqli_query($access, $db_request1);
        if ($query_handle1 != "") {
            $rows1 = mysqli_num_rows($query_handle1);
            if ($rows1 == 0) {
                echo "<p>Keine Thrombolyse-Dokumentation vorhanden.</p>";
            } else {
                for ($i1 = 0; $i1 < $rows1; $i1++) {
                    $data = mysqli_fetch_row($query_handle1);
                    $arztID = $data[0];
                    $patientID = $data[1];
                    $patientRecordID = $data[2];
                    $apaVoreinnahme = $data[3];
                    $mVoreinnahme = $data[4];
                    $vorhofflimmern = $data[5];
                    $diabetes = $data[6];
                    $hypertonus = $data[7];
                    $vorSchlaganfall = $data[8];
                    $oberArztTime = $data[9];
                    $oberArztDescr = $data[10];
                    $laborWerteTime = $data[11];
                    $laborWert1 = $data[12];
                    $laborWert2 = $data[13];
                    $laborWert3 = $data[14];
                    $laborWert4 = $data[15];
                    $laborWert5 = $data[16];
                    $bdSenkungOption = $data[17];
                    $lyseDecisionTime = $data[18];
                    $lyseDecisionDescr1 = $data[19];
                    $lyseDecisionDescr2 = $data[20];
                    $dosisWert1 = $data[21];
                    $dosisWert2 = $data[22];
                    $dosisWert3 = $data[23];
                    $dosisWert4 = $data[24];
                    $timeLyseStart = $data[25];
                    $timeLyseEnd = $data[26];
                    $rekonsilArztID = $data[27];
                    $nihssWert2448 = $data[28];
                    $complications = $data[29];
                    $nihssWert7days = $data[30];
                    $ranking = $data[31];
                    $entlassung = $data[32];
                    $timeCCTStart = $data[33];
                    $timeCCTEnd = $data[34];
                    $cctDescr1 = $data[35];
                    $cctDescr2 = $data[36];
                    $cctDescr3 = $data[37];
                    $cctOption1 = $data[38];
                    $cctOption2 = $data[39];
                    $cctOption3 = $data[40];
                    $cctOption4 = $data[41];
                    $entlassungNach = $data[42];
                    $apaVoreinnahme2 = $data[43];
                    $apaVoreinnahme3 = $data[44];
                    $bdWert1Aufnahme = $data[45];
                    $bdWert2Aufnahme = $data[46];
                    $bdDescrAufnahme = $data[47];
                    $bdWert1vorLyse = $data[48];
                    $bdWert2vorLyse = $data[49];
                    $bdDescrvorLyse = $data[50];
                    $timeSymptoms = getDBContent('patientRecords', 'timeSymptoms', 'patientRecordID', $patientRecordID);
                    $timeSymptoms = strtotime($timeSymptoms);
                    $timeSymptoms = date('d.m.Y H:i', $timeSymptoms) . ' Uhr';
                    $timeInitialContact = getDBContent('patientRecords', 'timeInitialContact', 'patientRecordID', $patientRecordID);
                    $timeHospital = getDBContent('patientRecords', 'timeHospital', 'patientRecordID', $patientRecordID);
                    if ($timeHospital != '0000-00-00 00:00:00') {
                        $timeHospital = strtotime($timeHospital);
                        $timeHospital = date('d.m.Y H:i', $timeHospital);
                    } else {
                        ($dmt == 1) ? $timeSymptoms = "nicht angegeben" : $timeSymptoms = "";
                    }
                    ($apaVoreinnahme == 'j') ? $xxx['ASS'] = "ja" : $xxx['ASS'] = "nein ";
                    ($apaVoreinnahme2 == 'j') ? $xxx['Plavix'] = "ja" : $xxx['Plavix'] = "nein ";
                    ($apaVoreinnahme3 == 'j') ? $xxx['Aggrenox'] = "ja" : $xxx['Aggrenox'] = "nein ";
                    ($mVoreinnahme == 'j') ? $xxx['Marcumar'] = "ja" : $xxx['Marcumar'] = "nein ";
                    ($vorhofflimmern == 'j') ? $xxx2['Vorhofflimmern'] = "ja" : $xxx2['Vorhofflimmern'] = "nein ";
                    ($vorSchlaganfall == 'j') ? $xxx2['Fr&uuml;herer Schlaganfall'] = "ja" : $xxx2['Fr&uuml;herer Schlaganfall'] = "nein ";
                    ($diabetes == 'j') ? $xxx2['Diabetes'] = "ja" : $xxx2['Diabetes'] = "nein ";
                    ($hypertonus == 'j') ? $xxx2['Hypertonus'] = "ja" : $xxx2['Hypertonus'] = "nein ";
                    $timeCCTStartArray = explode(':', $timeCCTStart);
                    $timeCCT1H = $timeCCTStartArray[0];
                    $timeCCT1Min = $timeCCTStartArray[1];
                    $OATimeArray = explode(':', $oberArztTime);
                    $timeOAH = $OATimeArray[0];
                    $timeOAMin = $OATimeArray[1];
                    $timeTherapy = getDBContent('patientRecords', 'timeTreatment', 'patientRecordID', $patientRecordID);
                    $timeTherapyA = strtotime($timeTherapy);
                    $timeTherapy = date("d.m.Y. H:i", $timeTherapyA);
                    $nArztID = getDBContent('patientRecords', 'therapyArztID', 'patientRecordID', $patientRecordID);
                    $doc = new Arzt();
                    $nArztInfo = $doc->getArztInfos($nArztID);
                    $laborWerteTimeA = explode(':', $laborWerteTime);
                    $timeLaborH = $laborWerteTimeA[0];
                    $timeLaborMin = $laborWerteTimeA[1];
                    $laborWerte['Thrombozyten'] = str_replace('.', ',', $laborWert1) . " td/cmm";
                    $laborWerte['Hb'] = str_replace('.', ',', $laborWert2) . " g/dl";
                    $laborWerte['INR'] = str_replace('.', ',', $laborWert3) . "";
                    $laborWerte['PTT'] = str_replace('.', ',', $laborWert4) . " sek";
                    $laborWerte['BZ bei Aufnahme'] = str_replace('.', ',', $laborWert5) . " mg/dl";
                    $lyseDecisionTimeArray = explode(':', $lyseDecisionTime);
                    $timeLDH = $lyseDecisionTimeArray[0];
                    $timeLDMin = $lyseDecisionTimeArray[1];
                    $pGewicht = getDBContent('patientRecords', 'pGewicht', 'patientRecordID', $patientRecordID);
                    $dosisWert1 = ($pGewicht * 0.9);
                    $dosisWert1a = str_replace('.', ',', $dosisWert1);
                    $dosisWert2 = $dosisWert1 / 10;
                    $dosisWert2a = str_replace('.', ',', $dosisWert2);
                    $dosisWert3 = $dosisWert1 - $dosisWert2;
                    $dosisWert3a = str_replace('.', ',', $dosisWert3);
                    $timeLS = strtotime($timeLyseStart);
                    $timeLS = date("d.m.Y H:i", $timeLS);
                    $timeLE = strtotime($timeLyseEnd);
                    $timeLE = date("d.m.Y H:i", $timeLE);
                    $arzt1 = new Arzt();
                    $infoA = $arzt1->getArztInfos($arztID);
                    $arzt2 = new Arzt();
                    $infoRA = $arzt2->getArztInfos($rekonsilArztID);
                    $entlassung = strtotime($entlassung);
                    $entlassung = date("d.m.Y H:i", $entlassung);
                    ?>
                    <div class='row'>
                        <div class='col-sm-6 d-print-inline'><strong>Beginn der Symptomatik: </strong></div>
                        <div class='col-sm-6 d-print-inline'><?php echo $timeSymptoms; ?></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 d-print-inline'><strong>Klinikaufnahme: </strong></div>
                        <div class='col-sm-6 d-print-inline'><?php echo $timeHospital; ?> Uhr</div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 d-print-inline'><strong>Erstkontakt mit med. Personal: </strong></div>
                        <div class='col-sm-6 d-print-inline'><?php echo $timeInitialContact; ?></div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'><strong>Voreinnahme: </strong></div>
                        <div class='col-sm-9 d-print-inline'><?php
                            foreach ($xxx as $key => $val) {
                                echo "<span class='mr-3'>$key: $val</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class='row'>
                        <?php
                        foreach ($xxx2 as $key => $val) {
                            echo "<div class='col-sm-3 d-print-inline delimiter'>$key: $val</div>";
                        }
                        ?>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'>Blutdruck vor Thrombolyse:</div>
                        <div class='col-sm-3 d-print-inline'><?php echo $bdWert1Aufnahme . "/" . $bdWert2Aufnahme; ?>
                            mmHg =>
                        </div>
                        <div class='col-sm-6 d-print-inline'>Anmerk.: <?php echo $bdDescrAufnahme; ?></div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'><h4>Beginn CCT: </h4></div>
                        <div class='col-sm-3 d-print-inline'><?php echo $timeCCT1H . ":" . $timeCCT1Min; ?> Uhr</div>
                        <div class='col-sm-6 d-print-inline'>Anmerk.: <?php echo $cctDescr1; ?></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'>Ggfs. R&uuml;cksprache Oberarzt:</div>
                        <div class='col-sm-3 d-print-inline'><?php echo $timeOAH . ":" . $timeOAMin; ?> Uhr</div>
                        <div class='col-sm-6 d-print-inline'>Anmerk.: <?php echo $oberArztDescr; ?></div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'><h4>Beginn Telekonsil:</h4></div>
                        <div class='col-sm-3 d-print-inline'><?php echo $timeTherapy; ?>,</div>
                        <div class='col-sm-6 d-print-inline'>Durchf&uuml;hrender Arzt: <?php echo $nArztInfo; ?></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'></div>
                        <div class='col-sm-9 d-print-inline'>
                            <h4 class=''>NIHSS - durchgef&uuml;hrte Dokumentation:</h4>
                            <?php
                            getNIHSSlist($patientRecordID);
                            ?>
                            <h4 class=''>NIHSS - Eingetragene Werte im Konsilschein:</h4>
                            <?php
                            getTotalNIHSSWerte($patientRecordID);
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class='row mb-3'>
                        <div class='col-sm-3 d-print-inline'><h4>Labor&shy;werte:</h4></div>
                        <div class='col-sm-3 d-print-inline'><?php echo $timeLaborH . ":" . $timeLaborMin; ?> Uhr</div>
                        <div class='col-sm-6 d-print-none'>Durchf&uuml;hrender Arzt: <?php echo $nArztInfo; ?></div>
                    </div>
                    <div class='row'>
                        <div class='col-12'><?php
                            foreach ($laborWerte as $key => $val) {
                                echo "<span class='mr-3'>$key: $val</span> ";
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'>Blutdruck vor Lyse:</div>
                        <div class='col-sm-9 d-print-inline'>
                            <?php
                            echo $bdWert1vorLyse . "/" . $bdWert2vorLyse;
                            ?>
                            <br/>
                            Blutdrucksenkung vor Lyse (im KH):
                            <?php
                            if ($bdSenkungOption == 'j') {
                                echo "ja";
                            } else {
                                echo "nein";
                            }
                            ?>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'><h4>Ent&shy;scheidung Lyse:</h4></div>
                        <div class='col-sm-3 d-print-inline'><?php echo $timeLDH . ":" . $timeLDMin; ?> Uhr</div>
                        <div class='col-sm-6 d-print-inline'>Anmerk.: <?php echo $lyseDecisionDescr1; ?></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'>keine Lyse wegen:</div>
                        <div class='col-sm-9 d-print-inline'>
                            <?php
                            echo $lyseDecisionDescr2;
                            ?>
                        </div>
                    </div>
                    <div class='row'>
                        <?php
                        if ($dmt == 1) {
                            echo "<div class='col-12'>Gewicht: $pGewicht (Ptienten-ID: $patientID & RecordID: $patientRecordID)</div>";
                        }
                        ?>
                        <div class='col-sm-6 d-print-inline'><h4>Dosis rtPA: => K&ouml;rpergewicht:</h4></div>
                        <div class='col-sm-6 d-print-inline'>
                            <?php
                            if ($pGewicht == 0) {
                                echo " keine Gewichtsangabe vorhanden";
                            } else {
                                echo " $pGewicht kg => x 0,9 = $dosisWert1a  mg rtPA = ml-L&ouml;sung Gesamt,
                                        $dosisWert1a
                                        <br />
                                        10% der Gesamtdosis als Bolus = $dosisWert2a ml; 
                                        Rest (90%) &uuml;ber 1 Std. = $dosisWert3a ml = ml/h (Laufrate Perfusor)";
                            }
                            ?>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'><h4>Zeiten Lyse:</h4></div>
                        <div class='col-sm-9 d-print-inline'>
                            <?php
                            if ($timeLyseStart != '0000-00-00 00:00:00' && $timeLyseEnd != '0000-00-00 00:00:00') {
                                echo "Beginn: $timeLS	End: $timeLE
                                        <br/>
                                        Durchf&uuml;hrender Arzt: $infoA ";
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'>Kontroll-CCT<br> 24-48 Std. nach Lyse:</div>
                        <div class='col-sm-3 d-print-inline'>Einblutung:</div>
                        <div class='col-sm-3 d-print-inline'>
                            <?php
                            if ($cctOption1 != '') {
                                if ($cctOption1 == 'j') echo "asympt.";
                                if ($cctOption1 == 'n') echo "sympt.";
                            }
                            ?>
                        </div>
                        <div class='col-sm-3 d-print-inline'>
                            Sonstiges: <?php echo $cctDescr2; ?>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'>NIHSS nach 24-48 Std.</div>
                        <div class='col-sm-3 d-print-inline'><?php echo $nihssWert2448; ?></div>
                        <div class='col-sm-6 d-print-inline'>Re-Konsil durch: <?php echo $infoRA; ?></div>
                    </div>
                    <hr>
                    <?php
                    if ($complications != '') {
                        ?>
                        <div class='row'>
                            <div class='col-sm-3 d-print-inline'>Sonstige Komplikationen:</div>
                            <div class='col-sm-9 d-print-inline'><?php echo $complications; ?></div>
                        </div>
                        <hr>
                        <?php
                    }
                    ?>
                    <div class='row'>
                        <div class='col-sm-3 d-print-inline'>Tag 7 / Entlassung:</div>
                        <div class='col-sm-3 d-print-inline'>NIHSS: <?php echo $nihssWert7days; ?></div>
                        <div class='col-sm-3 d-print-inline'>Ranking-Score: <?php echo $ranking; ?></div>
                        <div class='col-sm-3 d-print-inline'>
                            am <?php echo $entlassung . " nach: " . $entlassungNach; ?></div>
                    </div>
                    <?php
                }
            }
        } else {
            echo "<p class='errorMessage'>Datenbankabfrage nicht erfolgreich! [showPatientThrombolyseWerte($ptID) ]</p>";
        }
    }
}

function savePatientThrombolyse($ptID, $ptWerteArray)
{
    global $dmt, $x;
    $ID = "";
    if ($dmt == 1) {
        $arztID = Arzt::getAdminID();
    } else {
        $arztID = $_SESSION['arztID'];
    }
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        if ($ptID == "") {
            $timeT = date("Y-m-d H:i:s");
            $where = '
                arztID, 
                patientID, 
                patientRecordID, 
                oberArztDescr,
                laborWert1,
                laborWert2,
                laborWert3,
                laborWert4,
                laborWert5,
                lyseDecisionDescr1,
                lyseDecisionDescr2,
                dosisWert1,
                dosisWert2,
                dosisWert3,
                dosisWert4,
                rekonsilArztID,
                nihssWert2448,
                complications,
                nihssWert7days,
                ranking,
                entlassungNach,
                cctDescr1,
                cctDescr2,
                cctDescr3,
                timestampCreated,
                bdWert1Aufnahme,
                bdWert2Aufnahme,
                bdDescrAufnahme,
                bdWert1vorLyse,
                bdWert2vorLyse,
                bdDescrvorLyse
                ';
            $value = "
            '$arztID',
            '$ptWerteArray[0]',
            '$ptWerteArray[1]', 
                '',
                '0',
                '0',
                '0',
                '0',
                '0',
                '',
                '',
                '0',
                '0',
                '0',
                '0',
                '0',
                '0',
                '',
                '0',
                '0',
                '',
                '',
                '',
                '',
                '$timeT',
                '0',
                '0',
                '',
                '0',
                '0',
                '0'
                ";
            $db_request = "INSERT INTO `patientThrombolyse` (" . $where . ") VALUES (" . $value . ")";
            $query_handle = mysqli_query($access, $db_request);
            if ($query_handle != "") {
                $ptID = mysqli_insert_id($access);
                setSavedOptionYes($x);
            } else {
                echo "<p class='errorMessage'>Konnte kein neuen Eintrag erzeugen [savePatientThrombolyse($ptID, werteArray)]!</p>";
            }
            $ID = $ptID;
        } else {
            $db_request1 = "SELECT patientID FROM `patientThrombolyse` WHERE ptID = '$ptID' ";
            $query_handle1 = mysqli_query($access, $db_request1);
            if ($query_handle1 != "") {
                $rows1 = mysqli_num_rows($query_handle1);
                if ($rows1 != 0) {
                    $db_request = "UPDATE `patientThrombolyse` SET apaVoreinnahme = '$ptWerteArray[2]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse apaVoreinnahme nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET mVoreinnahme = '$ptWerteArray[3]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse mVoreinnahme nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET vorhofflimmern = '$ptWerteArray[4]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Vorhof-Flimmern nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET diabetes = '$ptWerteArray[5]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Vorhofflimmern nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET hypertonus = '$ptWerteArray[6]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Hypertonus nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET vorSchlaganfall = '$ptWerteArray[7]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Frueherer Schlaganfall nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET oberArztTime = '$ptWerteArray[8]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Oberarzt-Zeit nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET oberArztDescr = '$ptWerteArray[9]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Oberarzt-Bemerkung nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET laborWerteTime = '$ptWerteArray[10]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Zeit - Laborwerte nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET laborWert1 = '$ptWerteArray[11]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse laborWert1 = Thrombozyten nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET laborWert2 = '$ptWerteArray[12]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse laborWert2 = HB nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET laborWert3 = '$ptWerteArray[13]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse laborWert3 (INR) = $ptWerteArray[13] nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET laborWert4 = '$ptWerteArray[14]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse laborWert4 = PTT nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET laborWert5 = '$ptWerteArray[15]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse laborWert5 = Option BZ bei Aufnahme nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET bdSenkungOption = '$ptWerteArray[16]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Blutdrucksenkung (bdSenkung) bei Aufnahme nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET lyseDecisionTime = '$ptWerteArray[17]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse lyseDecisionTime nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET lyseDecisionDescr1 = '$ptWerteArray[18]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse lyseDecision Descr. 1 nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET lyseDecisionDescr2 = '$ptWerteArray[19]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse lyseDecision Descr. 2 (keine - wegen) nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET dosisWert1 = '$ptWerteArray[20]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse Dosiswert 1 (mg rtPa) = '$ptWerteArray[20]' nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET timeLyseStart = '$ptWerteArray[24]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - Lyse starttime nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET timeLyseEnd = '$ptWerteArray[25]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - Lyse endtime nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET rekonsilArztID = '$ptWerteArray[26]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - rekonsilArztID nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET nihssWert2448 = '$ptWerteArray[27]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - nihss2448  = '$ptWerteArray[27]' nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET complications = '$ptWerteArray[28]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - Komplikationen nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET nihssWert7days = '$ptWerteArray[29]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - nihssWert7days nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET ranking = '$ptWerteArray[30]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - Ranking nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET entlassung = '$ptWerteArray[31]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - Entlassung nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET entlassungNach = '$ptWerteArray[32]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - Entlassung nach ... nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET timeCCTStart = '$ptWerteArray[33]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - timeCCTStart nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET timeCCTEnd = '$ptWerteArray[34]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - timeCCTEnd nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET cctDescr1 = '$ptWerteArray[35]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - cctDescr1 nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET cctDescr2 = '$ptWerteArray[36]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - cctDescr2 nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET cctDescr3 = '$ptWerteArray[37]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse - cctDescr3 nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    if ($ptWerteArray[38] != "") {
                        $db_request = "UPDATE patientThrombolyse SET cctOption1 = '$ptWerteArray[38]' WHERE ptID = '$ptID'";
                        $query_handle = mysqli_query($access, $db_request);
                        if ($query_handle != "") {
                        } else {
                            echo "<p class='errorMessage'>Konnte Thrombolyse - cctOption1 = '$ptWerteArray[38]' nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                        }
                    }
                    $db_request = "UPDATE patientThrombolyse SET apaVoreinnahme2 = '$ptWerteArray[42]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse apaVoreinnahme2 nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET apaVoreinnahme3 = '$ptWerteArray[43]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse apaVoreinnahme3 nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET bdWert1Aufnahme = '$ptWerteArray[44]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse bdWert1Aufnahme nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET bdWert2Aufnahme = '$ptWerteArray[45]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse bdWert2Aufnahme nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET bdDescrAufnahme = '$ptWerteArray[46]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse bdDescrAufnahme nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET bdWert1vorLyse = '$ptWerteArray[47]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse bdWert1vorLyse nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                    $db_request = "UPDATE patientThrombolyse SET bdWert2vorLyse = '$ptWerteArray[48]' WHERE ptID = '$ptID'";
                    $query_handle = mysqli_query($access, $db_request);
                    if ($query_handle != "") {
                    } else {
                        echo "<p class='errorMessage'>Konnte Thrombolyse bdWert2vorLyse nicht &auml;ndern [savePatientThrombolyse($ptID,array mit werten)]!</p>";
                    }
                }
            }
        }
    } else {
        echo "<p class='errorMessage'>Kein Zugriff auf Datenbank [savePatientThrombolyse($ptID,array mit werten)]!</p>";
    }
    return $ID;
}

function getLyselistPlusButtons($patientID, $patientRecordID)
{
    global $url;
    $connection = new Access();
    $access = $connection->connectDB();
    if ($access) {
        $db_request = "SELECT  ptID, timestampCreated, arztID  FROM `patientThrombolyse` WHERE patientID = '$patientID' AND patientRecordID = '$patientRecordID' ORDER by ptID DESC";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $rows = mysqli_num_rows($query_handle);
            if ($rows == 0) {
            } else {
                ?>
                <ul class='list-unstyled'>
                    <?php
                    for ($i = 0; $i < $rows; $i++) {
                        $data = mysqli_fetch_row($query_handle);
                        $ptID = $data[0];
                        $time = $data[1];
                        $tArztID = $data[2];
                        $time = strtotime($time);
                        $time = date("d.m.", $time) . ' (' . date("H:i", $time) . ' Uhr)';
                        $tArzt = Arzt::getArztInfosShort($tArztID);
                        if ($i > 0) {
                            echo "<hr>";
                        }
                        echo "<li class=''>$time</li> ";
                        $editStatus = getDBContent('patientRecords', 'editStatus', 'patientRecordID', $patientRecordID);
                        if ($editStatus == 't') {
                            $add[] = "<input type='hidden' name='patientID' value='$patientID' />";
                            $add[] = "<input type='hidden' name='ptID' value='$ptID' />";
                            $css = "btn btn-outline-success col-5 mt-2 mb-1 ml-0 mr-0";
                            $formcss = "d-inline col-6 ml-0 mr-0 pl-0 pr-0";
                            smallButton($url, '3415', '<i class="icon-eye-open"></i>', $css, $add, $formcss);
                            smallButton($url, '3416', '<i class="icon-print"></i>', $css, $add, $formcss);
                        } else {
                            editThrombolyseForm($patientID, $ptID);
                        }
                    }
                    ?>
                </ul>
                <?php
            }
        }
    }
}
