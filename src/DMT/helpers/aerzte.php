<?php
/**

 * ------------------------------------------------------------------
 * Views - Aerzte
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


/**
 * @param $arztID
 */
function editArzt($arztID)
{
    global $url;

    $doc = new Arzt();
    $arzt = $doc->getArzt($arztID);
    $arztGender = $arzt->getArztGender();
    $acadTitle = $arzt->getAcadTitle();
    $arztFirstName = $arzt->getArztFirstName();
    $arztLastName = $arzt->getArztLastName();
    $arztPhone = $arzt->getArztPhone();
    $arztComment = $arzt->getArztComment();
    $userID = $arzt->getUserID();
    $clinicID = $arzt->getClinicID();
    $userLogin = getDBContent('logins', 'userLogin', 'userID', $userID);
    $userPW = getDBContent('logins', 'userPW', 'userID', $userID);
    $userEMail = getDBContent('logins', 'userEMail', 'userID', $userID);
    $clinicName = getDBContent('clinics', 'clinicName', 'clinicID', $clinicID);
    $clinicInitial = getDBContent('clinics', 'clinicInitial', 'clinicID', $clinicID);
    $clinic = new Clinic();
    $clinics = $clinic->getAllEntries();
    if ($arztGender == 'w') {
        $arztGenderText = "Frau ";
    } else {
        $arztGenderText = "Herr ";
    }
    ?>
    <h2>Arzt-Profil (ID: <?php echo $arztID; ?>) bearbeiten</h2>
    <div class="row">
        <div class="col-12">
            <form method='post' action='<?php echo $url; ?>'>
                <fieldset>
                    <input type='hidden' name='arztID' value='<?php echo $arztID; ?>'/>
                    <input type='hidden' name='userID' value='<?php echo $userID; ?>'/>
                    <input type='hidden' name='x' value='4110'/>
                    <div class="form-row">
                        <label for="arztGender" class="col-sm-4 col-form-label">Anrede:</label>
                        <select name='arztGender' id='arztGender' class='col-sm-8 form-control'>
                            <option value='<?php echo $arztGender; ?>'
                                    selected><?php echo $arztGenderText; ?></option>
                            <option value='m'>Herr</option>
                            <option value='w'>Frau</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="acadTitle" class="col-sm-4 col-form-label">Titel:</label>
                        <input name='acadTitle' id='acadTitle' value='<?php echo $acadTitle; ?>'
                               class='col-sm-8 form-control'/>
                    </div>
                    <div class="form-row">
                        <label for="arztFirstName" class="col-sm-4 col-form-label">Vorname:</label>
                        <input name='arztFirstName' id='arztFirstName' value='<?php echo $arztFirstName; ?>'
                               class='col-sm-8 form-control'/>
                    </div>
                    <div class="form-row">
                        <label for="arztLastName" class="col-sm-4 col-form-label">Nachname*:</label>
                        <input name='arztLastName' id='arztLastName' value='<?php echo $arztLastName; ?>'
                               class='col-sm-8 form-control' required/>
                    </div>
                    <div class="form-row">
                        <label for="clinicID" class="col-sm-4 col-form-label">Klinik:</label>
                        <select name='clinicID' id='clinicID' class='col-sm-8 form-control' required>
                            <?php
                            if ($clinicID != 0) {
                                echo "<option value='$clinicID' selected>$clinicName ($clinicInitial) </option>";
                            } else {
                                echo "<option value=''>Bitte ausw&auml;hlen</option>";
                            }
                            if (!empty($clinics)) {
                                foreach ($clinics as $clinic) {
                                    $clinicID1 = $clinic->getClinicID();
                                    $clinicName2 = $clinic->getClinicName();
                                    $clinicInitial2 = $clinic->getClinicInitial();
                                    if ($clinicID1 != $clinicID) {
                                        echo "<option value='$clinicID1'> $clinicName2 ($clinicInitial2)</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="arztPhone" class="col-sm-4 col-form-label">Telefon:</label>
                        <input name='arztPhone' id='arztPhone' value='<?php echo $arztPhone; ?>'
                               class='col-sm-8 form-control'/>
                    </div>
                    <div class="form-row">
                        <label for="userEMail" class="col-sm-4 col-form-label">E-Mail:</label>
                        <input name='userEMail' id='userEMail' value='<?php echo $userEMail; ?>'
                               class='col-sm-8 form-control'/>
                        <div class='col-sm-8 offset-4 mt-2 mb-2 font-weight-light font-italic '>Notwendig, um ggf.
                            Passwort zu zusenden
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="userLogin" class="col-sm-4 col-form-label">Login-Name*:</label>
                        <input name='userLogin' id='userLogin' value='<?php echo $userLogin; ?>'
                               class='col-sm-8 form-control' required/>
                    </div>
                    <div class="form-row">
                        <label for="userPW" class="col-sm-4 col-form-label">Passwort*:</label>
                        <input name='userPW' id='userPW' value='<?php echo $userPW; ?>' class='col-sm-8 form-control' required/>
                    </div>
                    <div class="form-row">
                        <label for="arztComment" class="col-sm-4 col-form-label">Kommentar:</label>
                        <textarea class='col-sm-8 form-control' rows='3' name='arztComment'
                                  id='arztComment'><?php echo $arztComment; ?></textarea>
                    </div>
                    <button class='btn btn-primary mt-3 mb-3'>Daten speichern</button>
                    <div class='mb-2 font-weight-light font-italic '>* Pflichtfeld</div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php
}

function listAerzte()
{
    global $url;
    ?>
    <h2>Liste der &Auml;rzte</h2>
    <form method='post' action='<?php echo $url; ?>' class='padding'>
        <input type='hidden' name='x' value='4120'/>
        <button class='btn btn-outline-primary'> >Neuen Arzt hinzuf&uuml;gen<</button>
    </form>
    <?php
    $entry = new Arzt();
    $entries = $entry->getAllEntries();
    if (!empty($entries)) {
        ?>
        <div class="table-responsive">
            <table class="table table-border table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name, Klinik & Infos</th>
                    <th>Bearbeiten</th>
                </tr>
                </thead>
                <?php
                $no = 1;
                foreach ($entries as $item) {
                    $arztID = $item->getArztID();
                    $arztGender = $item->getArztGender();
                    $acadTitle = $item->getAcadTitle();
                    $arztFirstName = $item->getArztFirstName();
                    $arztLastName = $item->getArztLastName();
                    $arztPhone = $item->getArztPhone();
                    $arztComment = $item->getArztComment();
                    $userID = $item->getUserID();
                    $clinicID = $item->getClinicID();
                    $status = $item->getArztStatus();
                    if ($arztGender == 'w') {
                        $arztGender = "Frau ";
                    } else {
                        $arztGender = "Herr ";
                    }
                    $userEMail = getDBContent('logins', 'userEMail', 'userID', $userID);
                    $clinicName = getDBContent('clinics', 'clinicName', 'clinicID', $clinicID);
                    ($status == 'a') ? $bg = "table-info" : $bg = "";
                    ($status == 'a') ? $status = "(Admin)" : $status = "(webArzt)";
                    ?>
                    <tr class='<?php echo $bg; ?>'>
                        <td><span class='small'><?php echo $no; ?></span></td>
                        <td>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <?php echo "$arztGender  $acadTitle  $arztFirstName  $arztLastName"; ?>
                                    <br/>
                                    <?php echo $clinicName; ?>
                                </div>
                                <div class='col-xs-12 col-sm-6'>
                                    <?php
                                    if ($arztPhone != '') {
                                        echo "Tel.: $arztPhone <br />";
                                    }
                                    if ($userEMail != '') {
                                        echo "Email: $userEMail  <br />";
                                    }
                                    if ($arztComment != '') {
                                        echo "Kommentar: $arztComment   <br />";
                                    }
                                    echo $status;
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                            <?php
                            $addA[] = "<input type='hidden' name='arztID' value='$arztID'/>";
                            smallButton($url, '4100', '<i class="icon-pencil"></i>', 'btn btn-primary mb-1', $addA, '');
                            ?>
                                </div>
                                <div class='col-xs-12 col-sm-6'>
                            <?php
                            smallButton($url, '4200', '<i class="icon-trash"></i>', 'btn btn-danger', $addA, '');
                            ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </table>
        </div>
        <?php
    } else {
        echo "<p > Keine &Auml;rzte vorhanden.</p > ";
    }
}

function showArztWeb()
{
    $arztID = $_SESSION['arztID'];
    $arzt = new Arzt();
    $arzt = $arzt->getArzt($arztID);
    $arztInfos = $arzt->getArztInfos($arztID);
    $userID = $arzt->getUserID();
    $clinicID = $arzt->getClinicID();
    $userLogin = getDBContent('logins', 'userLogin', 'userID', $userID);
    $userPW = getDBContent('logins', 'userPW', 'userID', $userID);
    $userEMail = getDBContent('logins', 'userEMail', 'userID', $userID);
    $clinicName = getDBContent('clinics', 'clinicName', 'clinicID', $clinicID);
    $clinicInitial = getDBContent('clinics', 'clinicInitial', 'clinicID', $clinicID);
    ?>
    <div class="row">
        <div class="col-12">
            <fieldset>
                <legend><?php echo $arztInfos; ?></legend>
                <div class="row">
                    <div class="col-sm">Klinik:</div>
                    <div class="col-sm"><?php echo "$clinicName ($clinicInitial)"; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm">Telefon:</div>
                    <div class="col-sm"><?php echo $arzt->getArztPhone(); ?></div>
                </div>
                <div class="row">
                    <div class="col-sm">E-Mail:</div>
                    <div class="col-sm"><?php echo $userEMail; ?> </div>
                </div>
                <div class="row">
                    <div class="col-sm">Login-Name:</div>
                    <div class="col-sm"><?php echo $userLogin; ?> </div>
                </div>
                <div class="row">
                    <label class="col-sm">Passwort: </label>
                    <div class="col-sm"><?php echo $userPW; ?></div>
                </div>
                <div class="row">
                    <label class="col-sm">Kommentar: </label>
                    <div class="col-sm"><?php echo $arzt->getArztComment(); ?></div>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
}