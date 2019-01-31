<?php 
include_once('tools.php');
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}


echo "<p>receipt</p>";
preShow($_POST);
preShow($_SESSION);
$aaarg = preShow($my_bad_array, true);
printMyCode();
?>
