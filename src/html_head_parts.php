<?php

function printCase($baseURL)
{
    ?>
    <link rel='stylesheet' href='<?php echo $baseURL; ?>assets/css/print.css' type='text/css'>

    <script>
        function printPage() {
            window.print();
        }
    </script>
    <?php

}

function defaultCase($baseURL)
{
    ?>

    <link rel='stylesheet' href='<?php echo $baseURL; ?>assets/bootstrap-4.1.3/css/bootstrap.min.css' type='text/css'>

    <!-- Add awesome fonts-->
    <link rel='stylesheet' href='<?php echo $baseURL; ?>assets/font-awesome/css/font-awesome.css' type='text/css'
          media='screen'/>

    <link rel='stylesheet' href='<?php echo $baseURL; ?>assets/css/main.css' type='text/css'>

    <?php
}