<?php
/**

 * ------------------------------------------------------------------
 * Views - Indication und Indication2
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


function getIndication2SelectMenu($IDHere)
{
    $inputName = "indication2ID";
    $indication = new Indication2();

    $indications = $indication->getAllEntries();

    if (!empty($indications)) {
        echo "
        <select name='$inputName' class='form-control mb-1'>
        ";
        if ($IDHere == 0) {
            print "<option value='0'>Bitte ausw&auml;hlen</option>";
        }
        foreach ($indications as $indication) {
            $ID = $indication->getIndication2ID();
            $Name = $indication->getIndication2Name();
            $Text = $indication->getIndication2Code();
            if ($ID == $IDHere) {
                print "<option value='$ID' selected>$Text: $Name</option>";
            } else {
                print "<option value='$ID'>$Text: $Name</option>";
            }
        }
        echo "</select>";
    } else {
        echo "<p>Keine Indikation vorhanden.</p>";
    }
}

function getIndication2DetailSelectMenu($IDHere)
{
    $inputName = "indication2DID";
    $indication = new Indication2Detail();
    $indications = $indication->getAllEntries();
    if (!empty($indications)) {
        echo "
        <select name='$inputName' class='form-control'>
        ";
        if ($IDHere == 0) {
            print "<option value='0'>Bitte ausw&auml;hlen</option>";
        }
        foreach ($indications as $indication) {
            $ID = $indication->getIndication2DID();
            $Name = $indication->getIndication2DName();
            $Text = $indication->getIndication2DCode();
            if ($ID == $IDHere) {
                print "<option value='$ID' selected>$Text: $Name</option>";
            } else {
                print "<option value='$ID'>$Text: $Name</option>";
            }
        }
        echo "</select>";
    } else {
        echo "<p>Keine Indikation vorhanden.</p>";
    }
}

function getIndicationSelectMenu($IDHere)
{
    $inputName = "indicationID";
    $indication = new Indication();
    $indications = $indication->getAllEntries();
    if (!empty($indications)) {
        echo "
        <select name='$inputName' class='form-control'>
        ";
        if ($IDHere == 0) {
            print "<option value=''>Bitte ausw&auml;hlen</option>";
        }
        foreach ($indications as $indication) {
            $ID = $indication->getIndicationID();
            $Name = $indication->getIndicationName();
            $Text = $indication->getIndicationCode();
            if ($ID == $IDHere) {
                print "<option value='$ID' selected>$Text: $Name</option>";
            } else {
                print "<option value='$ID'>$Text: $Name</option>";
            }
        }
        echo "</select>";
    } else {
        echo "<p>Keine Indikation vorhanden.</p>";
    }
}
