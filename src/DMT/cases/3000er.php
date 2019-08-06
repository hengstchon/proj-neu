<?php
/**

 * ------------------------------------------------------------------
 * Content Switch of cases form 3000 - 3999
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
switch ($x) {

    case 3000:
        echo "<h2>Patienten-&Uuml;bersicht</h2>";
        listAllPatients($capitalLetter);
        break;


    case 3200:
        ?>
        <fieldset>
            <?php
            showPatientNameBDay($patientID, false, 'legend');
            editPatientNIHSSWerte($pnID);
            ?>
        </fieldset>
        <?php
        navPatient($patientID);
        break;
    case 3215:
        viewBlock_Patient_NIHSS($patientID, $pnID);
        ?>
        <h3 class='mt-3 p-2'>Nachtr&auml;gliches Bearbeiten der NIHSS-Dokumentation:</h3>
        <?php
        editNIHSSForm($patientID, $pnID);
        navPatient($patientID);
        break;
    case 3216:
        viewBlock_Patient_NIHSS($patientID, $pnID);
        break;
    case 3220:
        $addOption = $_SESSION['addOption'];
        ?>
        <fieldset>
            <?php
            showPatientNameBDay($patientID, false, 'legend');
            if ($addOption == 0) {
                $pnID = savePatientNIHSS($patientID, $patientRecordID);
                editPatientNIHSSWerte($pnID);
            }
            ?>
        </fieldset>
        <?php
        navPatient($patientID);
        break;
    case 3235:
        savePatientNIHSSWerte($pnID, $pWerteArray);
        viewBlock_Patient_NIHSS($patientID, $pnID);
        $addInput[] = "<input type='hidden' name='patientID' value='$patientID' />";
        $addInput[] = "<input type='hidden' name='pnID' value='$pnID' />";
        smallButton($url, '3216', '<i class="icon-print"></i>', 'btn btn-outline-success mt-3', $addInput, '');
        navPatient($patientID);
        break;
    case 3300:
        editPatientRecordTherapy($patientRecordID);
        navPatient($patientID);
        break;
    case 3310:
        if ($nihssTotal != '') {
            savePatientNIHSSTotal($patientID, $patientRecordID, $nihssTotal);
        }
        $record->savePatientRecord($record);
        viewBlock_Patient_RecordList($patientID);
        break;
    case 3315:
        viewBlock_Patient_Record($patientID, $patientRecordID);
        ?>
        <h3 class='mt-3 p-2'>Nachtr&auml;gliches Bearbeiten des Konsilscheins:</h3>
        <?php
        $addInputs1[] = "<input type='hidden' name='patientID' value='$patientID' />";
        $addInputs1[] = "<input type='hidden' name='patientRecordID' value='$patientRecordID' />";
        smallButton($url, '1025', $diagnoseButton, 'btn btn-outline-primary mb-1', $addInputs1, '');
        smallButton($url, '3300', $therapyButton, 'btn btn-outline-primary', $addInputs1, '');
        navPatient($patientID);
        break;
    case 3316:
        viewBlock_Patient_Record($patientID, $patientRecordID);
        break;
    case 3320:
        $addOption = $_SESSION['addOption'];
        if ($addOption == 0) {
            $patientRecordID = $record->savePatientRecord($record);
            ?>
            <fieldset>
                <form method='Post' action='<?php echo $url; ?>'>
                    <input type='hidden' name='x' value='1035'/>
                    <?php
                    showPatientNameBDay($patientID, false, 'legend');
                    hiddenTherapyFields($patientRecordID);
                    editPatientRecordDiagnose($patientRecordID);
                    ?>
                    <button class="btn btn-primary mb-3"> >>> Weiter >>></button>
                </form>
            </fieldset>
            <?php
        } else {
            viewBlock_Patient_RecordList($patientID);
        }
        break;
    case 3400:
        ?>
        <h2>Thrombolyse Dokumentation</h2>
        <fieldset>
            <?php
            showPatientNameBDay($patientID, false, 'legend');
            editPatientThrombolyse($ptID);
            ?>
        </fieldset>
        <?php
        navPatient($patientID);
        break;
    case 3410:
        PatientRecord::savePatientWeight($patientRecordID, $pGewicht, $pGroesse);
        PatientRecord::saveTimeErstContact($patientRecordID, $timeInitialContact);
        savePatientThrombolyse($ptID, $ptWerteArray);
        viewBlock_Patient_PatientThrombolyse($patientID, $ptID, "edit");
        break;
    case 3415:
        viewBlock_Patient_PatientThrombolyse($patientID, $ptID, "edit");
        break;
    case 3416:
        viewBlock_Patient_PatientThrombolyse($patientID, $ptID, "show");
        break;
    case 3420:
        ?>
        <h2>Thrombolyse Dokumentation</h2>
        <?php
        $addOption = $_SESSION['addOption'];
        if ($addOption == 0) {
            $ptID = savePatientThrombolyse('', $ptWerteArray);
            showPatientNameBDay($patientID, false, 'legend');
            editPatientThrombolyse($ptID);
        }
        navPatient($patientID);
        break;
    case 3999:
        viewBlock_Patient_RecordList($patientID);
        break;
}
