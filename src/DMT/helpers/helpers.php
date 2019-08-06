<?php
/**

 * ------------------------------------------------------------------
 * Helper Functions
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


/**
 * @method varDumpPre
 * @description debugging helper
 *
 * @param $x
 */
function cl($data) {
  if (is_array($data) || is_object($data)) {
      echo("<script>console.log('".json_encode($data)."');</script>");
  }
  else {
      echo("<script>console.log('".$data."');</script>");
  }
}

function vdp($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function setSavedOptionYes($x)
{
    $_SESSION['addOption'] = 1;
    $_SESSION['xWas'] = $x;
}

function setSavedEmpty()
{
    $_SESSION['addOption'] = 0;
    $_SESSION['xWas'] = "";
}

function replaceSpecialCharacters($variable)
{
    $variable = str_replace(' ', '-', $variable);
    $variable = str_replace('.', '', $variable);
    $variable = str_replace(',', '', $variable);
    $variable = str_replace('\'', '', $variable);
    $variable = str_replace('"', '', $variable);
    $variable = str_replace('&', '-', $variable);
    $variable = str_replace('/', '-', $variable);
    $variable = str_replace('%', '-', $variable);
    $variable = str_replace('�', 'ss', $variable);
    $variable = str_replace('�', 'ue', $variable);
    $variable = str_replace('�', 'oe', $variable);
    $variable = str_replace('�', 'ae', $variable);
    $variable = str_replace('�', 'Ue', $variable);
    $variable = str_replace('�', 'Oe', $variable);
    $variable = str_replace('�', 'Ae', $variable);
    $variable = str_replace('�', 'e', $variable);
    $variable = str_replace('�', 'i', $variable);
    $variable = str_replace('�', 'u', $variable);
    $variable = str_replace('�', 'o', $variable);
    $variable = str_replace('�', 'a', $variable);
    return $variable;
}

function monthName($month)
{
    $monthName = '';
    $monthNameArray = Array('Januar', 'Februar', 'M&auml;rz', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
    if (($month >= 1) and ($month < 13)) {
        $monthName = $monthNameArray[$month - 1];
    }
    return $monthName;
}

function createFormRow_Date($label, $dayArray, $monthArray, $yearArray)
{
    $day_name = $dayArray[0];
    $day_val = $dayArray[1];
    $m_name = $monthArray[0];
    $m_val = $monthArray[1];
    $y_name = $yearArray[0];
    $y_val = $yearArray[1];
    ?>
    <div class="form-group row mb-3">
        <div class="col-3"><?php echo $label; ?></div>
        <div class="col-9">
            <?php
            createDayFields($day_name, $day_val);
            createMonthFields($m_name, $m_val);
            createYearFields($y_name, $y_val);
            ?>
        </div>
    </div>
    <?php
}

function createFormRow_Time($label, $hArray, $minArray)
{
    ?>
    <div class="form-group row mb-3">
        <div class="col-3"><?php echo $label; ?></div>
        <?php
        createHoursFields($hArray[0], $hArray[1]);
        ?>
        <span class="col-1">:</span>
        <?php
        createMinutesFields($minArray[0], $minArray[1]);
        ?>
        <span class="col-1">Uhr</span>
    </div>
    <?php
}

function createFormRow_DateTime($label, $dayArray, $monthArray, $yearArray, $hourArray, $minutesArray, $color)
{
    ($color != "") ? $style = " style='background-color: $color;'" : $style = "";
    ?>
    <div class='form-group row mb-3'>
        <div class='col-sm-3'><?php echo $label; ?></div>
        <div class='col-sm-5'>
            <div class="row mb-1">
                <?php
                createDayFields($dayArray[0], $dayArray[1]);
                createMonthFields($monthArray[0], $monthArray[1]);
                createYearFields($yearArray[0], $yearArray[1]);
                ?>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class="row" <?php echo $style; ?> >
                <?php
                createHoursFields($hourArray[0], $hourArray[1]);
                ?>
                <span class="col-1">:</span>
                <?php
                createMinutesFields($minutesArray[0], $minutesArray[1]);
                ?>
                <span class="col-2">Uhr</span>
            </div>
        </div>
    </div>
    <?php
}

function createYearFields($selectName, $selectedYear)
{
    print "<select name='$selectName'  class='col-4 form-control form-control-sm'>";
    if ($selectedYear == "" || $selectedYear == "0000") {
        $selectedYear = date("Y");
    }
    print "<option selected value='$selectedYear'>$selectedYear</option>";
    $currentYear = date('Y');
    for ($i = 1; $i < 4; $i++) {
        $year = $currentYear - $i;
        if ($selectedYear != $year) {
            print "<option value='$year'>$year</option>";
        }
    }
    print "</select>";
}

function createMonthFields($selectName, $selectedMonth)
{
    print "<select name='$selectName'  class='col-5 form-control form-control-sm'>";
    if ($selectedMonth == "" || $selectedMonth == "00") {
        $selectedMonth = date("m");
    }
    $smName = monthName($selectedMonth);
    print "<option selected value='$selectedMonth'>$smName</option>";
    for ($i = 1; $i <= 12; $i++) {
        $mName = monthName($i);
        if ($i < 10) {
            print "<option value='0$i'>$mName</option>";
        } else {
            print "<option value='$i'>$mName</option>";
        }
    }
    print "</select>";
}

function createDayFields($selectName, $selectedDay)
{
    print "<select name='$selectName' id='$selectName' class='col-3 form-control form-control-sm'>";
    if ($selectedDay == "" || $selectedDay == "00") {
        $selectedDay = date('d');
    }
    print "<option selected value='$selectedDay'>$selectedDay</option>";
    for ($i = 1; $i <= 31; $i++) {
        if ($i < 10) {
            print "<option value='0$i'>0$i</option>";
        } else {
            print "<option value='$i'>$i</option>";
        }
    }
    print "</select>";
}

function createHoursFields($selectName, $selected)
{
    print "<select name='$selectName'  class='col-3 form-control form-control-sm'>";
    if ($selected == "") {
        $selected = date('H');
    }
    print "<option selected value='$selected'>$selected</option>";
    for ($i = 0; $i < 24; $i++) {
        if ($i < 10) {
            print "<option value='0$i'>0$i</option>";
        } else {
            print "<option value='$i'>$i</option>";
        }
    }
    print "</select>";
}

function createMinutesFields($selectName, $selected)
{
    print "<select name='$selectName' class='col-3 form-control form-control-sm' >";
    if ($selected == "") {
        $selected = date('i');
    }
    print "<option selected value='$selected'>$selected</option>";
    for ($i = 0; $i < 60; $i++) {
        if ($i < 10) {
            print "<option value='0$i'>0$i</option>";
        } else {
            print "<option value='$i'>$i</option>";
        }
    }
    print "</select>";
}

function createSelectMenu($array, $target) {
    $num = sizeof($array);
    for ($i = 0; $i < $num; $i++){
        $ID	= $i;
        $Name	= $array[$i];
        if ($ID == $target) {
            print "<option value='$ID' selected>$Name</option> ";
        } else {
            print "<option value='$ID'>$Name</option>";
        }
    }
}

function getDBContent($table, $column, $IDcolumn, $ID)
{
    $value = '';
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        $db_request = "SELECT $column FROM $table WHERE $IDcolumn = '$ID' ";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $rows = mysqli_num_rows($query_handle);
            $data = mysqli_fetch_row($query_handle);
            $value = $data[0];
        } else {
            print "<p class='errorMessage'>Kein Zugriff auf Tabelle! [getDBContent($table, $column, $IDcolumn, $ID)]</p>";
        }
    } else {
        print "<p class='errorMessage'>Kein Zugriff auf Datenbank! [getDBContent($table, $column, $IDcolumn, $ID)]</p>";
    }
    return $value;
}

function getMaxEntries($table, $column)
{
    $rows = 0;
    $db_access = new Access();
    $access = $db_access->connectDB();
    if ($access) {
        $db_request = "SELECT $column FROM $table";
        $query_handle = mysqli_query($access, $db_request);
        if ($query_handle != "") {
            $rows = mysqli_num_rows($query_handle);
        } else {
            print "<p class='errorMessage'>Kein Zugriff auf Datenbanktabelle '$table!' [getMaxEntries($table, $column)]</p>";
        }
    } else {
        print "<p class='errorMessage'>Kein Zugriff auf Datenbank! [getMaxEntries($table, $column)]</p>";
    }
    return $rows;
}

function schreibweise($variable)
{
    $variable = trim($variable);
    if ($variable != "") {
        $variable1 = array();
        $variable2 = array();
        $variable = strtolower($variable);
        $nameArray = explode(' ', $variable);
        if (!empty($nameArray)) {
            foreach ($nameArray as $namePart) {
                $variable1[] = ucfirst($namePart);
            }
            $variable = implode(' ', $variable1);
        }
        $nameArray2 = explode('-', $variable, "-1");
        if (!empty($nameArray2)) {
            foreach ($nameArray2 as $namePart2) {
                $variable2[] = ucfirst($namePart2);
            }
            $variable = implode('-', $variable2);
        }
        if (!empty($variable1) && !empty($variable2)) {
            $variable = ucfirst($variable);
        }
    }
    return $variable;
}
