<?php
include_once('tools.php');
ini_set("auto_detect_line_endings", true);

if (empty($_SESSION)) {
    header("Location: index.php");
}

if(isset($_POST['home'])){
    session_unset();
    header("Location: index.php");
            }

// get current date and time at time of booking
$currDateTime = date('d/m h:i');

// -------------------------- write to spread sheet -----------------------------------
// ------------------------------------------------------------------------------------

// Gathers all needed spreadsheet information from the session array and stores the data
// in the spreadsheet

$fileName = "bookings.txt";
$file = fopen($fileName, "a");
flock($file, LOCK_EX);

$length = count($_SESSION['cart']);
for ($j=0; $j < $length; $j++ ){
    $currArray = array(
                       $currDateTime,
                       $_SESSION['cart'][$j]['cust']['name'],
                       $_SESSION['cart'][$j]['cust']['email'],
                       $_SESSION['cart'][$j]['cust']['mobile'],
                       $_SESSION['cart'][$j]['movie']['id'],
                       $_SESSION['cart'][$j]['movie']['day'],
                       $_SESSION['cart'][$j]['movie']['hour'],
                       $_SESSION['cart'][$j]['seats']['STA'],
                       $_SESSION['cart'][$j]['seats']['STP'],
                       $_SESSION['cart'][$j]['seats']['STC'],
                       $_SESSION['cart'][$j]['seats']['FCA'],
                       $_SESSION['cart'][$j]['seats']['FCP'],
                       $_SESSION['cart'][$j]['seats']['FCC'],
                       $_SESSION['cart'][$j]['grandPrice']['totalPrice']
                       );
    fputcsv($file, $currArray, "\t");
}
flock($file, LOCK_UN);
fclose($file);
?>

<!---------------------------- start of receipt html --------------------------------
 ----------------------------------------------------------------------------------->
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
    <style><?php include("css/style.css");?></style>
    <style>
        <?php // This PHP code inserts CSS to style the "current page" link in the nav area
        $here=$_SERVER['SCRIPT_NAME'];
        $bits=explode('/', $here);
        $filename=$bits[count($bits)-1];
        echo "nav a[href$='$filename'] {
        box-shadow: 1px 1px 1px 2px navy;
        }";?>
    </style>
</head>

<body>
    <div class="receipt-buttons">
        <form method="post" action="receipt.php" onsubmit='return leaveCheck()'>
            <button name="home" type="submit">Home</button>
        </form>
        <button onclick="showReceipt()">Show receipt</button>
        <button onclick="showGroupTicket()">Show Group Ticket</button>
        <button onclick="showSingleTickets()">Show Single Tickets</button>
        <button class="print-but" onclick="window.print()">Print</button>
    </div>
    
    <!-- ---------------- print receipt ----------------- -->
    <article id="receipt" class="receipt">
        <h1>Receipt</h1>
        <!-- letter header -->
        <div class="receipt-header-wrap">
            <div><img src="../../media/logo.png" alt="logo" width="100" height="100"></div>
            <h2>Lunardo</h2>
        </div>
        <!-- display date when receipt being created -->
        <div class="date">
           <p>Date:<time><?php echo date('d/m/y'); ?></time></p>
        </div>
        <div class="bus-cust-wrap">
            <!-- Business details -->
            <div class="bus-dets">
                <h3>Business Details</h3>
                <p>Lunardo Cinema</p>
                <p>123 Fake Street, Tralralgon</p>
                <p>lunardo@lunardocinema.com.au</p>
                <p>ABN: 00 123 456 789</p>
            </div>
            <!-- customers details -->
            <div class="cust-dets">
                <h3>Customer Details</h3>
                <p><?php echo $_SESSION['cart'][0]['cust']['name']; ?></p>
                <p><?php echo $_SESSION['cart'][0]['cust']['email']; ?></p>
                <p><?php echo $_SESSION['cart'][0]['cust']['mobile'] ?></p>
            </div>
        </div>
        <!-- display purchase details of movie and seats -->
        <div class="purchase-wrap">
          <h3>Purchase:</h3>
          <table>
           <?php
            $len = count($_SESSION['cart']);
            for ($i = 0; $i < $len; $i++){
               $num = $i + 1;
               echo "<tr><th colspan='4'>Movie Purchase: {$num}</th></tr>";
               echo "<tr>";
               echo "<th class='remove-bord'>Movie ID</th>";
               echo "<th class='remove-bord'>Movie:</th>";
               echo "<th class='remove-bord'>Day:</th>";
               echo "<th class='remove-bord'>Time: (24hr)</th>";
               echo "</tr>";
               echo "<tr>";
               echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['movie']['id']} </td>";
               echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['movie']['title']} </td>";
               echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['movie']['day']} </td>";
               echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['movie']['hour']}:00 </td>";
               echo "</tr>";
               echo "<tr>";
               echo "<th class='remove-bord'>Seat ID:</th>";
               echo "<th class='remove-bord'>Seat:</th>";
               echo "<th class='remove-bord'>Qty:</th>";
               echo "<th class='remove-bord'>Sub total:</th>";
               echo "</tr>";
               //checks each seat category and prints each price and details if exists/purchased
               //prints to 2 decimal places
               purchasedSeats($i);
            }
           ?>
            </table>
        </div>
        <table class="rec-tot-price">
            <tr>
               <!-- <th>GST:</th> -->
                <!-- prints total GST of session/recipt to 2 decimal places -->
                <td class='remove-bord'><?php printGST(); ?></td>
            </tr>
            <tr>
              <!--  <th>Total price:</th> -->
                <!-- prints total price of session/recipt to 2 decimal places -->
                <td><?php printAllTotalPrice(); ?></td>
            </tr>
        </table>
    </article>
    
    <!-- --------------- Print group tickets-------------- -->
    <article id='group-ticket-wrap'>
    <?php
        $length = count($_SESSION['cart']);
        for($i = 0; $i < $length; $i++){
            echo "<div class='group-ticket'>";
            echo "<div class='grp-tick-dets'>";
            echo "<div class='grp-tick-header-wrap'>";
            echo "<div><img src='../../media/logo.png' alt='logo' width='55' height='55'> </div>";
            echo "<h2>Lunardo</h2>";
            echo "<h1>Group Ticket</h1>";
            echo "</div>";
            echo "<div class='grp-tick-movie-dets'>";
            echo "<div class='tickMovDets'>";
            echo "<p><span>Movie:</span> {$_SESSION['cart'][$i]['movie']['title']}</p>";
            echo "<p><span>Rating:</span> {$_SESSION['cart'][$i]['movie']['rating']}</p>";
            echo "<p><span>Day:</span> {$_SESSION['cart'][$i]['movie']['day']}</p>";
            echo "<p><span>Hour:</span>{$_SESSION['cart'][$i]['movie']['hour']}:00</p>";
            echo "</div>";
            echo "<div class='tickSeatDets'>";
           
            //prints seat code and qty's for each movie
            foreach ($_SESSION['cart'][$i]['seats'] as $seat => $qty) {
                if ($qty > 0)
                    echo "<p>" . $seat . " - Qty: " . $qty . "</p>";
            }
            
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='admit-once'>";
            echo "<p>Admit</p>";
            echo "<p>One</p>";
            echo "<p>Group</p>";
            echo "</div>";
            echo "</div>";
        }
    ?>
    </article>
    
    <!-- --------------- Print single tickets-------------- -->
    <article id='single-tickets-wrap'>
    <?php
        $length = count($_SESSION['cart']);
        for($i = 0; $i < $length; $i++){
            foreach ($_SESSION['cart'][$i]['seats'] as $seat => $qty) {
                if ($qty > 0) {
                    for ($j = 0; $j < $qty; $j++) {
                        echo "<div class='single-tickets'>";
                        echo "<div class='grp-tick-dets'>";
                        echo "<div class='grp-tick-header-wrap'>";
                        echo "<div><img src='../../media/logo.png' alt='logo' width='55' height='55'></div>";
                        echo "<h2>Lunardo</h2>";
                        echo "<h1>Single Ticket</h1>";
                        echo "</div>";
                        echo "<div class='grp-tick-movie-dets'>";
                        echo "<div class='tickMovDets'>";
                        echo "<p><span>Movie:</span> {$_SESSION['cart'][$i]['movie']['title']}</p>";
                        echo "<p><span>Rating:</span> {$_SESSION['cart'][$i]['movie']['rating']}</p>";
                        echo "<p><span>Day:</span> {$_SESSION['cart'][$i]['movie']['day']}</p>";
                        echo "<p><span>Hour:</span> {$_SESSION['cart'][$i]['movie']['hour']}:00</p>";
                        echo "</div>";
                        echo "<div class='tickSeatDets'>";
                        echo "<p> $seat  - Qty: 1</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='admit-once'>";
                        echo "<p>Admit</p>";
                        echo "<p>One</p>";
                        echo "<p>Person</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
       }
    ?>
    </article>
    
    <footer>
        <div class="footer-wrap-flex">
            <div class="footer-content">
                <div class="contact-dets"> 
                    <span>Contact: </span><span>Lunardo Cinema, </span><address>123 Fake Street, Tralralgon, </address> <span>lunardo@lunardocinema.com.au</span> 
                </div>
                <div>
                    &copy;<script>document.write(new Date().getFullYear());</script> 
                    James Ciuciu, s3698784. https://github.com/s3698784/wp. Last modified 
                </div>
                <div>
                    Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia. 
                </div>
                <div>
                    Maintain links to your <a href='products.txt'>products spreadsheet</a> and <a href='orders.txt'>orders spreadsheet</a> here. 
                </div>
                <div class="footer-button">
                    <button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button>
                </div>
            </div>
        </div>
    </footer>
    <!-- debug module -->
    <div class="debug-module">
        <?php
            preShow($_POST);
            preShow($_SESSION);
            printMyCode();
        ?>
        <script>
            <?php include("js/tools.js"); ?>
        </script>
    </div>
</body>
</html>