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
$movieTitle = $movieDetails[$mvID]['title'];
$movieRating = $movieDetails[$mvID]['rating'];
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

$_SESSION['$priceSTA'] = $prices['STA'][$priceRate] * $stanAdult;
$_SESSION['$priceSTP'] = $prices['STP'][$priceRate] * $stanConcession;
$_SESSION['$priceSTC'] = $prices['STC'][$priceRate] * $stanChild;
$_SESSION['$priceFCA'] = $prices['FCA'][$priceRate] * $firstAdult;
$_SESSION['$priceFCP'] = $prices['FCP'][$priceRate] * $firstConcession;
$_SESSION['$priceFCC'] = $prices['FCC'][$priceRate] * $firstChild;

$totPrice = $_SESSION['$priceSTA'] + $_SESSION['$priceSTP'] + $_SESSION['$priceSTC'] + $_SESSION['$priceFCA'] + $_SESSION['$priceFCP'] + $_SESSION['$priceFCC'];

$gst = $totPrice * 0.1;

//write to spread sheet
$currOrder = array($currDateTime, $name, $email, $mobNumber, $mvID, $day, $hour, $stanAdult, $stanConcession, $stanChild, $firstAdult, $firstConcession, $firstConcession, $totPrice);
$fileName = "bookings.txt";
$file = fopen($fileName, "a");
flock($file, LOCK_EX);
fputcsv($file, $currOrder, "\t");
flock($file, LOCK_UN);
fclose($file);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 3</title>
    <!-- import google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Molengo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Condiment" rel="stylesheet">
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <!-- <link id='stylecss' type="text/css" rel="stylesheet" href="css/style.css"> -->
    <script src='../wireframe.js'></script>
    <style>
        <?php include("css/style.css");
        ?>

    </style>
    <style>
        <?php // This PHP code inserts CSS to style the "current page" link in the nav area
        $here=$_SERVER['SCRIPT_NAME'];
        $bits=explode('/', $here);
        $filename=$bits[count($bits)-1];
        echo "nav a[href$='$filename'] {
box-shadow: 1px 1px 1px 2px navy;
        }

        ";
?>

    </style>
</head>

<body>
    <div class="receipt-buttons">
        <button>Show receipt</button>
        <button onclick="window.print()">Print receipt</button>
    </div>
    <article class="receipt">
        <h1>Receipt</h1>

        <!-- letter header -->

        <div class="receipt-header-wrap">
            <div><img src="../../media/logo.png" alt="logo" width="100" height="100"> </div>
            <h2>Lunardo</h2>
        </div>
        <div class="date">Date: <time>
                <?php echo date('d/m/y'); ?></time></div>



        <div class="bus-cust-wrap">
            <!-- Business details -->
            <div class="bus-dets">
                <h3>Business Details</h3>
                <p>Lunardo Cinema</p>
                <p>123 Fake Street, Tralralgon</p>
                <p>lunardo@lunardocinema.com.au</p>
                <p>ABN: 00 123 456 789</p>
            </div>

            <! -- customers details -->
            <div class="cust-dets">
                <h3>Customer Details</h3>
                <p>
                    <?php echo $name; ?>
                </p>
                <p>
                    <?php echo $email; ?>
                </p>
                <p>
                    <?php echo $mobNumber; ?>
                </p>
            </div>
        </div>

        <div class="purchase-wrap">
            <h3>Purchase:</h3>
            <table>
                <tr>
                    <th>Movie ID:</th>
                    <th>Movie:</th>
                    <th>Day:</th>
                    <th>Time: (24hr)</th>
                </tr>
                <tr>
                    <td>
                        <?php echo $mvID; ?>
                    </td>
                    <td>
                        <?php echo $movieTitle; ?>
                    </td>
                    <td>
                        <?php echo $day;?>
                    </td>
                    <td>
                        <?php echo $hour;?>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Seat ID:</th>
                    <th>Seat:</th>
                    <th>Qty:</th>
                    <th>Sub total:</th>
                </tr>
                <!-- print each seat -->
                <?php printPurchasedSeats(); ?>
            </table>
        </div>

        <table class="gst">
            <tr>
                <th>GST:</th>
                <td>
                    <?php printf("$ %6.2f", $gst); ?>
                </td>
            </tr>
            <tr>
                <th>Total price:</th>
                <td>
                    <?php printf("$ %6.2f", $totPrice); ?>
                </td>
            </tr>
        </table>
        <div class="gst">

        </div>
    </article>

    <article class="group-ticket">
        <div class="grp-tick-dets">
            
            <div class="grp-tick-header-wrap">
                <div><img src="../../media/logo.png" alt="logo" width="55" height="55"> </div>
                <h2>Lunardo</h2>
                <h1>Group Ticket</h1>
            </div>
            
            <div class="grp-tick-movie-dets">
                <div>
                <p> <?php echo $movieTitle ?> - <?php echo $movieRating ?></p>
                <p><?php echo $day ?> - <?php echo $hour ?></p>
                </div>
                <div>
                <?php printSeats2ticket (); ?>
                </div>
            </div>
            </div>

            <div class="admit-once">
                <p>Admit</p>
                <p>One</p>
                <p>Group</p>
            </div>
    </article>


    <footer>
        <div class="footer-wrap-flex">
            <div class="footer-content">
                <div class="contact-dets"> <span>Contact: </span> <span>Lunardo Cinema, </span> <address>123 Fake Street, Tralralgon, </address> <span>lunardo@lunardocinema.com.au</span> </div>
                <div>&copy;
                    <script>
                        document.write(new Date().getFullYear());

                    </script> James Ciuciu, s3698784. https://github.com/s3698784/wp. Last modified </div>
                <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia. </div>
                <div>Maintain links to your <a href='products.txt'>products spreadsheet</a> and <a href='orders.txt'>orders spreadsheet</a> here. </div>
                <div class="footer-button">
                    <button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button>
                </div>
            </div>
    </footer>
    <!-- debug module -->
    <div class="debug-module">
        <?php
            
            preShow($_POST);
            preShow($_SESSION);
            $aaarg = preShow($my_bad_array, true);
            printMyCode();
            ?>
        <script>
            <?php include("js/tools.js"); ?>

        </script>
    </div>
</body>


</html>
