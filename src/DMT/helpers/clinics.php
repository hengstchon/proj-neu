<?php
/**

 * ------------------------------------------------------------------
 * Views - Kliniken
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


function listClinics()
{
    print "<h2>Liste der Kliniken</h2>";
    $entry = new Clinic();
    $entries = $entry->getAllEntries();
    if (!empty($entries)) {
        ?>
        <ul class='list-unstyled ml-4'>
        <?php
        foreach ($entries as $item) {
            $name = $item->getClinicName();
            $initial = $item->getClinicInitial();
            print "<li class='mb-1'>$name ($initial) </li>";
        }
        ?>
        </ul>
        <?php
    } else {
        print "<p>Keine Kliniken vorhanden.</p>";
    }
}