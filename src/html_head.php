<?php
/**

 * ------------------------------------------------------------------
 * HTML HEAD
 * ------------------------------------------------------------------
 * Working History
 * Version 2.1  Oktober-November 2018
 * ------------------------------------------------------------------
 */
header('Content-Type: text/html; charset=ISO-8859-1');
include($baseURL . "html_head_parts.php");
$datum = date("d.m.Y");
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $pageName; ?></title>
    <meta name='robots' content='noindex, nofollow, noarchive'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $noSearchCases = array(4000, 4110);
    $printCases = array(3316, 3216, 3416);
    if (in_array($x, $printCases)) {
        printCase($baseURL);
        $addOnLoad = " onLoad='printPage();'";
    } else {
        defaultCase($baseURL);
        $addOnLoad = "";
    }
    $editorCases = array(1025, 3300, 3320, 1010, 1015);
    if (in_array($x, $editorCases)) {
        echo "<script src='" . $baseURL . "assets/ckeditor/ckeditor.js'></script>";
    }
    ?>
</head>
<body <?php echo $addOnLoad; ?>>
<!--div class='container-fluid'>
    <div class='row'>
        <div class='col-12'-->
            <div class='container'>
                <div class='row'>
                    <div class='col-12'>
                        <!-- start header -->
                        <div class="row text-right date d-print-none">
                            <div class="col-12">Datum: <?php echo $datum; ?></div>
                        </div>
                        <div class='row logos'>
                            <div class='col-sm-6 hide-at-mobile d-print-inline'><a href='<?php echo $url; ?>'><img
                                            src='<?php echo $baseURL; ?>assets/imagesLayout/stenoLogo1.gif'></a>
                            </div>
                            <div class='col-sm-6 text-right hide-at-mobile d-print-inline'><a href='<?php echo $url; ?>'><img
                                            src='<?php echo $baseURL; ?>assets/imagesLayout/stenoLogo2.gif'></a>
                            </div>
                        </div>
                        <div class='row mb-2'>
                            <div class='col-12'><h1><?php echo $pageName; ?></h1></div>
                        </div>
                        <!-- start content -->
                        <a id='top'></a>
