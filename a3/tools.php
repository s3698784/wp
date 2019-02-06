<?php
  session_start();

// -------------------- arrays with movie and price data ---------------------
// ---------------------------------------------------------------------------

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

// calculate price helper functions

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

// ------------------------ validation helper functions ----------------------
// ---------------------------------------------------------------------------

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

  function sanName($name) {
      $sanitizedName = generalSan($name);
      $sanitizedName = strtolower($sanitizedName);
      $sanitizedName = ucwords($sanitizedName);
      return $sanitizedName;
  }

  function generalSan($input) {
      $sanitizedInput = trim($input);
      $sanitizedInput = htmlspecialchars($sanitizedInput);
      return $sanitizedInput;
  }

// --------------- functions taken from assignment 3 brief. ------------------
//----------------------------------------------------------------------------

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

?>
