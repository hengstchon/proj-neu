<?php
/**

 * ------------------------------------------------------------------
 * Content Switch of cases form 1000 - 1999
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


switch ($x) {

    case 1000:
        navigationHomeDMT();
        break;


    case 1010:
        $patients = Patient::getPatientIDsByLastName($pLastName);
        if (!empty($patients)) {
            selectExistingPatientForm($pLastName, $patients);
        } else {
            addPatientAndShowEdit($pLastName);
        }
        break;
    case 1015:
        addPatientAndShowEdit($pLastName);
        break;
    case 1020:
        ?>
        <h2>Patienten-Daten eingeben - bearbeiten</h2>
        <fieldset>
            <form method='Post' action='<?php echo $url; ?>'>
                <input type='hidden' name='x' value='1033'/>
                <?php
                editPatient($patientID);
                ?>
                <button class="btn btn-primary mt-3 mb-3"> >>> Weiter >>></button>
            </form>
        </fieldset>
        <?php
        navPatient($patientID);
        break;
    case 1025:
        echo "<h2>$diagnoseButton eingeben</h2>";
        ?>
        <fieldset>
            <?php
            showPatientNameBDay($patientID, false, 'legend');
            ?>
            <form method='Post' action='<?php echo $url; ?>'>
                <input type='hidden' name='x' value='1035'/>
                <?php
                hiddenTherapyFields($patientRecordID);
                editPatientRecordDiagnose($patientRecordID);
                ?>
                <button class="btn btn-primary mb-3"> >>> Konislanforderung senden >>></button>
            </form>
        </fieldset>
        <?php
        navPatient($patientID);
        break;
    case 1030:
        $patientEntry->saveEntry_patient($patientEntry);
        savePatientInfos($patientRecordID, $pInfoIDsM, $pInfoIDsC);
        $record->savePatientRecord($record);
        viewBlock_Patient_RecordList($patientID);
        break;
    case 1033:
        $patientEntry->saveEntry_patient($patientEntry);
        viewBlock_Patient_RecordList($patientID);
        break;
    case 1035:
        savePatientInfos($patientRecordID, $pInfoIDsM, $pInfoIDsC);
        $record->savePatientRecord($record);
        viewBlock_Patient_RecordList($patientID);
        break;
    case 1100:
        include_once($url_search);
        searchAll($search);
        addPatientForm($name, 'bg-secondary');
        break;
    case 1200:
        $vname = getDBContent('patients', 'pFirstName', 'patientID', $patientID);
        $nname = getDBContent('patients', 'pLastName', 'patientID', $patientID);
        $capitalLetter = substr($nname, 0, 1);
        ?>
        <fieldset>
            <legend>Daten l&ouml;schen</legend>
            <p>L&ouml;sche Patientendaten und all die damit verbundenen Dokumentationen von :</p>
            <?php
            echo "<h2>$vname $nname  (id: $patientID )</h2>";
            $addInputs1[] = "<input type='hidden' name='capitalLetter' value='$capitalLetter' />";
            $addInputs1[] = "<input type='hidden' name='patientID' value='$patientID' />";
            smallButton($url, '1210', 'Ja, L&ouml;schen', 'btn btn-danger mt-3 mb-3', $addInputs1, '');
            $addInputs2[] = "<input type='hidden' name='capitalLetter' value='$capitalLetter' />";
            smallButton($url, '3000', 'Abbrechen', 'btn btn-outline-info mt-3 mb-3', $addInputs2, '');
            ?>
        </fieldset>
        <?php
        break;
    case 1210:
        Patient::deletePatient($patientID);
        listAllPatients($capitalLetter);
        break;
}
