<?php
  session_start();

// ------------------ arrays with movie and price data ---------------------
// -------------------------------------------------------------------------

// detaail of each movie
$movieDetails = [
    // The girl in the Spider's Web
    "ACT" => [
        "title" => "The girl in the Spider's Web",
        "rating" => "MA15+",
        "plot" => "Young computer hacker Lisbeth Salander and journalist Mikael Blomkvist find themselves caught in a web of spies, cybercriminals and corrupt government officials.",
        "times" => [
             "WED-21" => "Wednesday - 9:00pm",
             "THU-21" => "Thursday - 9:00pm",
             "FRI-21" => "Friday - 9:00pm",
             "SAT-18" => "Saturday - 6:00pm",
             "SUN-18" => "Sunday - 6:00pm",
            ],
        "trailerLink" => "https://www.youtube.com/embed/XKMSP9OKspQ",
    ],
    // a star is born
    "RMC" => [
        "title" => "A Star is Born",
        "rating" => "M",
        "plot" => "A musician helps a young singer find fame, even as age and alcoholism send his own career into a downward spiral.",
        "times" => [
            "MON-12" => "Monday - 12:00pm",
            "TUE-18" => "Tuesday - 6:00pm",
            "SAT-15" => "Saturday - 3:00pm",
            "SUN-15" => "Sunday - 3:00pm",
        ],
        "trailerLink" => "https://www.youtube.com/embed/nSbzyEJ8X9E",
    ],
    // ralph breaks the internet
    "ANM" => [
         "title" => "Ralph Breaks the Internet",
         "rating" => "PG",
         "plot" => "Six years after the events of \"Wreck-It Ralph,\" Ralph and Vanellope, now friends, discover a wi-fi router in their arcade, leading them into a new adventure.",
         "times" => [
             "MON-12" => "Monday - 12:00pm",
             "TUE-12" => "Tuesday - 12:00pm",
             "WED-18" => "Wednesday - 6:00pm",
             "THU-18" => "Thursday - 6:00pm",
             "FRI-18" => "Friday - 6:00pm",
             "SAT-12" => "Saturday - 12:00pm",
             "SUN-12" => "Sunday - 12:00pm"],
         "trailerLink" => "https://www.youtube.com/embed/_BcYBFC6zfY"
        ],
    // boy erased
    "AHF" => [
         "title" => "Boy Erased",
         "rating" => "MA15+",
         "plot" => "The son of a Baptist preacher is forced to participate in a church-supported gay conversion program after being forcibly outed to his parents.",
         "times" => [
             "WED-12" => "Wednesday - 12:00pm",
             "THU-12" => "Thursday - 12:00pm",
             "FRI-12" => "Friday - 12:00pm",
             "SAT-21" =>"Saturday - 9:00pm",
             "SUN-21" =>"Sunday - 9:00pm"
         ],
         "trailerLink" => "https://www.youtube.com/embed/-B71eyB_Onw"
    ],
];

// movie prices
$prices = [
    //standard seats
    "STA" => ["discount" => 14.00, "normal" => 19.80],
    "STP" => ["discount" => 12.50, "normal" => 17.50],
    "STC" => ["discount" => 11.00, "normal" => 15.30],
    //first class seats
    "FCA" => ["discount" => 24.00, "normal" => 30.00],
    "FCP" => ["discount" => 22.50, "normal" => 27.00],
    "FCC" => ["discount" => 21.00, "normal" => 24.00],
];

// calculate price rate helper functions
// takes the day and hour are paramater and returns
// a string of 'discount' or 'normal' depending on the price rate.

function discountOrNormal($day, $hour) {
    $priceClass = "";
    if ($day == 'SAT' || $day == 'SUN')
        $priceClass = 'normal';
    else if ($day == 'MON' || $day == 'WED')
        $priceClass = 'discount';
    else if ($hour == "12")
        $priceClass = 'discount';
    else
        $priceClass = 'normal';

    return $priceClass;
};

// ------------------- validation helper functions ----------------------
// ----------------------------------------------------------------------

//checks if the credit card is valid, i.e. will not expire in the next month.
//returns true if it will not expire in the next month
//returns falase if it will expire in the next month
function checkExpiry($expDate){
    $currMonth = intval(date("m"));
    $currYear = intval(date("Y"));
    $expMonth = intval(substr($expDate, 5));
    $expYear = intval(substr($expDate, 0, 4));
      
    if ($expYear > $currYear) {
        return true;
    } else if (($expYear >= $currYear) && ($expMonth >= $currMonth )) {
        return true;
    } else {
        return false;
    }
}

//validates and sanitizes name input from form
//cleans up messy input
function sanName($name) {
    $sanitizedName = generalSan($name);
    $sanitizedName = strtolower($sanitizedName);
    $sanitizedName = ucwords($sanitizedName);
    return $sanitizedName;
}

//validates and sanitizes input from form
function generalSan($input) {
    $sanitizedInput = trim($input);
    $sanitizedInput = htmlspecialchars($sanitizedInput);
    return $sanitizedInput;
}

// ------------- functions taken from assignment 3 brief. ----------------
//------------------------------------------------------------------------

// used on debug modules at the bottom web site pages

//preShow()" function prints data and shape/structure of data:
function preShow( $arr, $returnAsString=false ) {
    $ret  = '<pre>' . print_r($arr, true) . '</pre>';
    if ($returnAsString)
        return $ret;
    else
        echo $ret;
}

function printMyCode() {
$lines = file($_SERVER['SCRIPT_FILENAME']);
    echo "<pre class='mycode'><ol>";
    foreach ($lines as $line)
    echo '<li>'.rtrim(htmlentities($line)).'</li>';
    echo '</ol></pre>';
}

function php2js( $arr, $arrName ) {
$lineEnd="";
    echo "<script>\n";
    echo "  var $arrName = ".json_encode($arr, JSON_PRETTY_PRINT);
    echo "</script>\n\n";
}

// ------------------ receipt helper functions --------------------------
// ----------------------------------------------------------------------

// takes index ($i) as parameter, which is the current order number in the 'cart' array.
//checks that particular order and each seat if one or more is purchased.
//If purchased, ticket details and price is printed as a table.
function purchasedSeats ($i) {
    if ($_SESSION['cart'][$i]['seats']['STA'] > 0) {
        echo "<tr>";
        echo "<td class='remove-bord'> STA </td>";
        echo "<td class='remove-bord'> Standard Adult </td>";
        echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['seats']['STA']} </td>";
        printf("<td class='remove-bord'> $%6.2f </td>", $_SESSION['cart'][$i]['prices']['STA']);
        echo "</tr>";
    }
    if ($_SESSION['cart'][$i]['seats']['STP'] > 0) {
        echo "<tr>";
        echo "<td class='remove-bord'> STP </td>";
        echo "<td class='remove-bord'> Standard Concession </td>";
        echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['seats']['STP']} </td>";
        printf("<td class='remove-bord'> $%6.2f </td>", $_SESSION['cart'][$i]['prices']['STP']);
        echo "</tr>";
    }
    if ($_SESSION['cart'][$i]['seats']['STC'] > 0) {
        echo "<tr>";
        echo "<td class='remove-bord'> STC </td>";
        echo "<td class='remove-bord'> Standard Child </td>";
        echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['seats']['STC']} </td>";
        printf("<td class='remove-bord'> $%6.2f </td>", $_SESSION['cart'][$i]['prices']['STC']);
        echo "</tr>";
    }
    if ($_SESSION['cart'][$i]['seats']['FCA'] > 0) {
        echo "<tr>";
        echo "<td class='remove-bord'> FCA </td>";
        echo "<td class='remove-bord'> First Class Adult </td>";
        echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['seats']['FCA']} </td>";
        printf("<td class='remove-bord'> $%6.2f </td>", $_SESSION['cart'][$i]['prices']['FCA']);
        echo "</tr>";
    }
    if ($_SESSION['cart'][$i]['seats']['FCP'] > 0) {
        echo "<tr>";
        echo "<td class='remove-bord'> FCP </td>";
        echo "<td class='remove-bord'> First Class Concession </td>";
        echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['seats']['FCP']} </td>";
        printf("<td class='remove-bord'> $%6.2f </td>", $_SESSION['cart'][$i]['prices']['FCP']);
        echo "</tr>";
    }
    if ($_SESSION['cart'][$i]['seats']['FCC'] > 0) {
        echo "<tr>";
        echo "<td class='remove-bord'> FCC </td>";
        echo "<td class='remove-bord'> First Class Child </td>";
        echo "<td class='remove-bord'> {$_SESSION['cart'][$i]['seats']['FCC']} </td>";
        printf("<td class='remove-bord'> $%6.2f </td>", $_SESSION['cart'][$i]['prices']['FCC']);
        echo "</tr>";
    }
}

//calculates all prices from each seat in the session and prints the
// total price of the receipt/session.
//print to 2 decimal places
function printAllTotalPrice() {
    $totalPrice = 0;
    $length = count($_SESSION['cart']);
    for ($i = 0; $i < $length; $i++)
        $totalPrice += $_SESSION['cart'][$i]['grandPrice']['totalPrice'];
    printf("Total Price: $ %6.2f", $totalPrice);
}

//calculates all prices from each seat in the session, gets the
//total price of the receipt/session, and then calculate the gst.
//the GST total is printed to 2 deimal places
//GST rate is set to 10%
function printGST(){
    $totalPrice = 0;
    $length = count($_SESSION['cart']);
    for ($i = 0; $i < $length; $i++)
        $totalPrice += $_SESSION['cart'][$i]['grandPrice']['totalPrice'];

    $GST = $totalPrice * 0.1;
    printf("Total GST:  $ %6.2f", $GST);
}
?>