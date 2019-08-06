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
        addPatientForm('', '');
        break;

    case 1010:
        /*
         *  pruefe uebergebenen Nachnamen ob schon vorhanden
         *  wenn vorhanden
         *      exisiterenden Patienten auswaehlen
         *  wenn nicht,
         *      uebergebenen Patienten neu anlegen, Record anlegen
         *      und danach bearbeiten Anzeigen
         *      (editPatientAndDiagnose: editPatient + anlegen neuer Record + editPatientRecordDiagnose)
         */
        $pLastName = strtolower($pLastName);
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
        if ($patientID == '') {
            ?>
            <h1>Patienten-&Uuml;bersicht</h1>
            <p class='errorMessage'>Es wurde kein Patient ausgew&auml;hlt.</p>
            <?php
            listAllPatients($capitalLetter);
        } else {
            ?>
            <h2>Patienten-Daten eingeben - bearbeiten</h2>
            <form method='Post' action='<?php echo $url; ?>'>
                <fieldset>
                    <input type='hidden' name='x' value='1033'/>
                    <?php
                    editPatient($patientID);
                    ?>
                    <button class="btn btn-primary mt-3 mb-3"> >>> Weiter >>></button>
                </fieldset>
            </form>
            <?php
            navPatient($patientID);
        }
        break;
    case 1025:
        echo "<h1>$diagnoseButton eingeben</h1>";
        ?>
        <form method='Post' action='<?php echo $url; ?>'>
            <input type='hidden' name='x' value='1035'/>
            <fieldset>
                <?php
                showPatientNameBDay($patientID, false, 'legend');
                hiddenTherapyFields($patientRecordID);
                editPatientRecordDiagnose($patientRecordID);
                ?>
                <button class="btn btn-primary mb-3"> >>> Konsilanforderung senden >>></button>
            </fieldset>
        </form>
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
}
