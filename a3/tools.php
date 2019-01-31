<?php
  session_start();

// ------------------------ validation helper functions ----------------------
// ---------------------------------------------------------------------------

  /*function valName($name) {
      $errMsg = "";
     // $pattern = "#[a-zA-Z \-.’]{1,100}#";
     // $pattern = "/[a-zA-Z]+/";
      if (strlen(($name)) < 1) {
          $errMsg = '<span style="color:red">* Please enter name</span>';
          return $errMsg;
      } /*elseif (preg_match("/[a-zA-Z]+/", $name) == false) {
          $errMsg = '<span style="color:red">* Please use western characters</span>';
          return $errMsg; 
      }*//* else {
          return true;
      }
  }*/

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
