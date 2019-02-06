<?php
include_once('tools.php');
ini_set("auto_detect_line_endings", true);

if (empty($_SESSION)) {
    header("Location: index.php");
}

$name = $_SESSION['cust']['name'];
$email = $_SESSION['cust']['email'];
$mobNumber =$_SESSION['cust']['mobile'];
$credCardNum = $_SESSION['cust']['card'];
$expiryDate = $_SESSION['cust']['expiry'];
$mvID = $_SESSION['movie']['id'];

$day = $_SESSION['movie']['day'];
$hour = $_SESSION['movie']['hour'];

$stanAdult = $_SESSION['seats']['STA'];
$stanConcession = $_SESSION['seats']['STP'];
$stanChild = $_SESSION['seats']['STC'];
$firstAdult = $_SESSION['seats']['FCA'];
$firstConcession = $_SESSION['seats']['FCP'];
$firstChild = $_SESSION['seats']['FCC'];

// get current date and time at time of booking
$currDateTime = date('d/m h:i');


// get total price
//$totPrice = getTotalPrice ($day, $hour, $stanAdult);
//getTotalPrice ($day, $hour, $stanAdult);

$priceRate = discountOrNormal($day, $hour);

$priceSTA = $prices['STA'][$priceRate] * $stanAdult;
$priceSTP = $prices['STP'][$priceRate] * $stanConcession;
$priceSTC = $prices['STC'][$priceRate] * $stanChild;
$priceFCA = $prices['FCA'][$priceRate] * $firstAdult;
$priceFCP = $prices['FCP'][$priceRate] * $firstConcession;
$priceFCC = $prices['FFC'][$priceRate] * $firstChild;

$totPrice = $priceSTA + $priceSTP + $priceSTC + $priceFCA + $priceFCP + $priceFCC;


//write to spread sheet
$currOrder = array($currDateTime, $name, $email, $mobNumber, $mvID, $day, $hour, $stanAdult, $stanConcession, $stanChild, $firstAdult, $firstConcession, $firstConcession, $totPrice);
$fileName = "bookings.txt";
$file = fopen($fileName, "a");
flock($file, LOCK_EX);
fputcsv($file, $currOrder, "\t");
flock($file, LOCK_UN);
fclose($file);





echo "<p>receipt</p>";
preShow($_POST);
preShow($_SESSION);
$aaarg = preShow($my_bad_array, true);
printMyCode();
?>
