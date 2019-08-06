<?php
/**

 * ------------------------------------------------------------------
 * HTML END - Footer
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */

?>
<!-- bootstrap & jquery lib-->
<script src='<?php echo $baseURL; ?>assets/jquery/jquery-3.3.1.min.js'></script>
<script src='<?php echo $baseURL; ?>assets/bootstrap-4.1.3/js/bootstrap.min.js'></script>
<?php

    if (!in_array($x, $noSearchCases)) {
    ?>
    <!-- Add bootstrap datepicker library -->
    <script src="<?php echo $baseURL; ?>assets/bootstrap-4.1.3/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="<?php echo $baseURL; ?>assets/bootstrap-4.1.3/css/bootstrap-datepicker.min.css">
    <!-- locale file after bootstrap-xxx.js -->
    <script src="<?php echo $baseURL; ?>assets/bootstrap-4.1.3/js/bootstrap-datepicker.de.js"></script>
    <script>
        $(".datepicker").datepicker({
            format: "dd.mm.yyyy",
            language: "de",
            todayBtn: "linked",
            calendarWeeks: true
        });
    </script>
<?php
}