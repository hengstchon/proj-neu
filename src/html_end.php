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
<!-- start footer -->
<footer class='text-center mt-5 mb-5'>
    <div class='rowmt-5 mb-5'>
        <div class='col-12'>
            <div id='printGrafik'></div>
            <div id='nav2'></div>
        </div>
    </div>
    <?php
    if ($errorCode != 0) {
        ?>
        <div class='row'>
            <div class='col-4'><b>Datum:</b> <br/><?php echo $datumFreigabeGNV; ?></div>
            <div class='col-4'><b>Version:</b><br/> <?php echo $versionsNr; ?></div>
            <div class='col-4'><b>Autor:</b> <br/><?php echo $author; ?></div>
        </div>
        <div class='row'>
            <div class='col-12'>Freigegeben:
                ZEA am <?php echo $datumFreigabeZEA; ?>
                GNV am <?php echo $datumFreigabeGNV; ?>
                Projektleiter am <?php echo $datumFreigabePL; ?>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>G&uuml;ltigkeit: Gesamtnetz bis <?php echo $gueltigkeit; ?></div>
        </div>
        <?php
    }
    ?>
</footer>
</div>
</div>
</div>
<!--/div>
</div>
</div-->
<?php
include("html_js.php");
?>
</body>
</html>