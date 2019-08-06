<?php
/**

 * ------------------------------------------------------------------
 * Login Formular
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */

?>
    <h2>Bitte loggen Sie sich ein:</h2>

    <form method='post' action='<?php echo $url; ?>' class='mt-5 mb-5'>
        <input type='hidden' name='x' value='100'/>
        <div class="form-row mb-3">
            <label for="userLogin" class="col-12 col-sm-4 col-form-label">Benutzer-Name:</label>
            <input name='userLogin' id='userLogin'  required class="col-12 col-sm-8 " />
        </div>
        <div class="form-row mb-3">
            <label for="userPW" class="col-xs-12 col-sm-4 col-form-label">Passwort:</label>
            <input type='password' name='userPW' id='userPW'  required class="col-xs-12 col-sm-8" />
        </div>
        <button class="btn btn-primary"><h2>Anmelden</h2></button>
    </form>
    <hr>
