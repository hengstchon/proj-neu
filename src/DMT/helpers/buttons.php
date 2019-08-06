<?php
/**

 * ------------------------------------------------------------------
 * Formulare, Buttons
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */


/**
 * small button (html form)
 *
 * @param $actionURL
 * @param $x
 * @param $title
 * @param $css
 * @param $inputs (additional inputfields)
 * @param $formCss
 * @internal param $case : hidden $x
 */

function smallButton($actionURL, $x, $title, $css, $inputs, $formCSS)
{
    echo "<form method='post' action='$actionURL' class='$formCSS'>";
    ?>
        <input type='hidden' name='x' value='<?php echo $x; ?>'/>
        <?php
        if (!empty($inputs)) {
            foreach ($inputs as $input) {
                echo $input;
            }
        }
        ?>
        <button <?php if ($css != "") echo "class='$css'"; ?> ><?php echo $title; ?></button>
    <?php
    echo "</form>";
}
