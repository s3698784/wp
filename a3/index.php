<?php
include_once('tools.php');


// initialse form input variables
$hasError = false;
$name = "";
$nameErrMsg = "";
$email = "";
$emailErrMsg = "";
$mobNumber = $mobErrMsg ="";
$credCardNum = $creditErrMsg= "";
$expiryDate = $expiryErrMsg = "";
$mvID = $mvErr = "";
$mvTitle = "";
$day = $dayErr = "";
$hour = $hourErr = "";
$seatErr = "";
$stanAdult = "";
$stanConcession = "";
$stanChild = "";
$firstAdult = "";
$firstConcession = "";
$firstChild = "";

// check is POST has been sent

if (!empty($_POST)) {
    // validate and sanitise 'name'.
    if (empty($_POST['cust']['name'])){
        $nameErrMsg = '<span style="color:red">* Please enter name</span>';
        $hasError = true;
    } else {
        $name = sanName($_POST['cust']['name']);
        if (!preg_match("/^[a-zA-z ]+$/", $name)){
            $nameErrMsg = '<span style="color:red">* Please enter western letters</span>';
            $hasError = true;
        }
     }
    
    //validate and sanitise 'email'
    if (empty($_POST['cust']['email'])){
        $emailErrMsg = '<span style="color:red">* Please enter email</span>';
        $hasError = true;
    } else {
        $email = strtolower(generalSan($_POST['cust']['email']));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            $emailErrMsg = "<span style='color:red'>* Invalid e-mail format, did you mean: {$sanitizedEmail}? </span>"  ;
            $hasError = true;
        }
    }
    
    //validate and sanitise 'mobile number'
    if (empty($_POST['cust']['mobile'])){
        $mobErrMsg = '<span style="color:red">* Please eneter a mobile number</span>';
        $hasError = true;
    } else {
        $mobNumber = generalSan($_POST['cust']['mobile']);
        if (!preg_match("#^(\(04\)|(04)|(\+614))( ?\d){8}$#", $mobNumber)){
            $mobErrMsg = '<span style="color:red">* Please enter an australian mobile number: e.g. starts with 04, +614 or (04)</span>';
            $hasError = true;
        }
     }
    
    //validate and sanitise 'credit card number'
   if (empty($_POST['cust']['card'])){
        $creditErrMsg = '<span style="color:red">* Please eneter a credit card number</span>';
        $hasError = true;
    } else {
        $credCardNum = generalSan($_POST['cust']['card']);
        if (!preg_match("#[0-9 \-]{15,19}#", $credCardNum)){
            $creditErrMsg = '<span style="color:red">* Please enter credit card number with min 15 to max 19 numbers including spaces ';
            $hasError = true;
        }
     }
    
    if (empty($_POST['cust']['expiry'])){
        $expiryErrMsg = '<span style="color:red">* Please eneter a credit card expiry</span>';
        $hasError = true;
    } else {
        $expiryDate = generalSan($_POST['cust']['expiry']);
        if (!checkExpiry($expiryDate)){
             $expiryErrMsg = '<span style="color:red">* Expiry should not be within the next month </span>';
            $hasError = true;
        }
     }
    
    //validate and sanitise move id
    if (empty($_POST['movie']['id'])) {
        $hasError = true;
        $mvErr = '<a href="#now-showing"><span style="color:red">* Please select a movie and time</span></a>';
    } else {
        $mvID = generalSan($_POST['movie']['id']);
    }
    
    //validate and sanitise selected day
    if (empty($_POST['movie']['day'])) {
        $hasError = true;
        $mvErr = '<a href="#now-showing"><span style="color:red">* Please select a movie and time</span></a>';
    } else {
        $day = generalSan($_POST['movie']['day']);
    }
    
    //validate and sanitise selected hour
    if (empty($_POST['movie']['hour'])) {
        $hasError = true;
        $mvErr = '<a href="#now-showing"><span style="color:red">* Please select a movie and time</span></a>';
    } else {
        $hour = generalSan($_POST['movie']['hour']);
    }
     
    $hasAmount = false;
    foreach ($_POST['seats'] as $seat => $qty) {
        if ($qty > 0){
            $hasAmount = true;
        }
    }
    if ($hasAmount == false) {
        $hasError = true;
        $seatErr = '<span style="color:red">* Please select seats</span>';
    } else {
        //sanitze seat inputs
        if (isset($_POST['seats']['STA'])) {
        $stanAdult = generalSan($_POST['seats']['STA']);
        }
        if (isset($_POST['seats']['STP'])) {
        $stanConcession = generalSan($_POST['seats']['STP']);
        }
        if (isset($_POST['seats']['STC'])) {
        $stanChild = generalSan($_POST['seats']['STC']);
        }
        if (isset($_POST['seats']['FCA'])) {
        $firstAdult = generalSan($_POST['seats']['FCA']);
        }
        if (isset($_POST['seats']['FCP'])) {
        $firstConcession = generalSan($_POST['seats']['FCP']);
        }
        if (isset($_POST['seats']['FCC'])) {
        $firstChild = generalSan($_POST['seats']['FCC']);
        }
  }
}//end of post checks

if (!empty($_POST) && $hasError == false) {
    $_SESSION['cust']['name'] = $name;
    $_SESSION['cust']['email'] = $email;
    $_SESSION['cust']['mobile'] = $mobNumber;
    $_SESSION['cust']['card'] = $credCardNum;
    $_SESSION['cust']['expiry'] = $expiryDate;
    $_SESSION['movie']['id'] = $mvID;
    $_SESSION['movie']['day'] = $day;
    $_SESSION['movie']['hour'] = $hour;
    $_SESSION['seats']['STA'] = $stanAdult;
    $_SESSION['seats']['STP'] = $stanConcession;
    $_SESSION['seats']['STC'] = $stanChild;
    $_SESSION['seats']['FCA'] = $firstAdult;
    $_SESSION['seats']['FCP'] = $firstConcession;
    $_SESSION['seats']['FCC'] = $firstChild;
      
    header("Location: receipt.php");
}

?>
    <!DOCTYPE html>
    <html lang='en'>

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
        <script>
                window.onscroll = function () {
                   
                    console.clear();
                    let navlinks = document.getElementsByTagName("nav")[0].children;
                    console.log(navlinks);
                    let sections = document.getElementsByTagName("main")[0].children;
                    console.log(sections);
                    var last = sections[sections.length - 1].getBoundingClientRect().top;
                    if (last <= 0) {
                        console.log('last');
                        navlinks[navlinks.length - 1].classList.add("active");
                        for (let j = 0; j < navlinks.length - 1; j++) 
                            navlinks[j].classList.remove("active");
                    }
                    else {
                        navlinks[sections.length - 1].classList.remove("active");
                        for (let i = 1; i < sections.length; i++) {
                            let prev = sections[i - 1].getBoundingClientRect().top;
                            let next = sections[i].getBoundingClientRect().top;
                            let log = prev + ' ' + next;
                            if (prev <= 100 && next > 10) {
                                log += '<--- ' + (i - 1);
                                navlinks[i - 1].classList.add("active");
                            }
                            else {
                                log += ' xxx ';
                                navlinks[i - 1].classList.remove("active");
                            }
                            console.log(log);
                        }
                    }
                }
            
            </script>
    </head>

    <body>
        <header id="home">
            <!-- logo was made at https://www.freelogodesign.org/ -->
            <div class="logo"><img src="../../media/logo.png" alt="logo" width="200" height="200"> </div>
            <h1>Lunardo</h1> </header>
        <!---------------------------- Navigation ------------------------------------>
        <!---------------------------------------------------------------------------->
        <nav>
            <!-- <a href='#home'>Home</a> -->
            <a href='#about-us' class=active >About Us</a> 
            <a href='#seats-and-prices'>Seats and Prices</a> 
            <a href='#now-showing'>Now Showing</a> 
            <a href='#bookings'>Bookings</a> 
        </nav>
        
        <main>
            <!------------------------about us-------------------------->
            <!---------------------------------------------------------->
            <!-- contains a description of Lunardo -->
            <section id='about-us'>
                <h2>About Us</h2>
                <div class="elim-margin">
                    <div class="about-us-cont">
                        <h3>So who are we?</h3>
                        <p>Lunardo is a local cinema located in the small country city of Traralgon. We do our best to give all customers a great exprience </p>
                        <p>To really show this we have recently made some upgrades, we have:</p>
                        <ul>
                            <li>Extensivly improved and renovated the whole cinema</li>
                            <br>
                            <li>New seats for all, including reclinable first class seats</li>
                            <br>
                            <li>Major projection and sound systems upgrades with top off the range 3D Dolby Vision projection and Dolby Atmos sound. </li>
                            <br>
                            <!-- external link aout the sound system upgrades--><a class="dolby" href="https://www.dolby.com/us/en/cinema" target="_blank">Cick here for more Dolby details</a> </ul>
                        <p>If you are a local or just visiting, you are always welcome to come by our cinema to enjoy some popcorn and a relaxing film</p>
                    </div>
                </div>
            </section>
            <!---------------seats and prices divided into 2 boxes--------------------->
            <!------------------------------------------------------------------------->
            <section id='seats-and-prices'>
                <h2>Seats and Prices</h2>
                <div class="elim-margin">
                    <!----------- seats -------------->
                    <div class="seat-prices-flex">
                        <div class="seat-cont">
                            <h3>All new seating</h3>
                            <p>We have installed new seats through out the whole cinema</p>
                            <!-- images of seats --><img class="stand-seat" src='../../media/standard-seats.jpeg' alt='standard seats' width=300>
                            <div class="img-info">Spacious and comfortable standard seats</div> <img class="first-seat" src='../../media/first-class-seats.png' alt='first class seats' width=300>
                            <div class="img-info">Recline to watch in style with all new first class seating</div>
                        </div>
                        <!------ all prices - set out in a table ------>
                        <div class="price-cont">
                            <h3>Prices:</h3>
                            <table>
                                <!-- table headings -->
                                <theader>
                                    <tr>
                                        <th>Seat Type</th>
                                        <!--   <th>Seat Code</th> -->
                                        <th>Discounted Price* </th>
                                        <th>Normal Price</th>
                                    </tr>
                                </theader>
                                <!-- standard tickets -->
                                <tr>
                                    <th class="table-space">Standard Adult</th>
                                    <!--  <td class="table-space">STA</td> -->
                                    <td class="table-space">$14.00</td>
                                    <td class="table-space">$19.80</td>
                                </tr>
                                <tr>
                                    <th>Standard Concession</th>
                                    <!-- <td>STP</td> -->
                                    <td>$12.50</td>
                                    <td>$17.50</td>
                                </tr>
                                <tr>
                                    <th>Standard Child</th>
                                    <!-- <td>STC</td> -->
                                    <td>$11.00</td>
                                    <td>$15.30</td>
                                </tr>
                                <!-- first class tickets -->
                                <tr>
                                    <th class="table-space">First Class Adult</th>
                                    <!-- <td class="table-space">FCA</td> -->
                                    <td class="table-space">$24.00</td>
                                    <td class="table-space">$30.00</td>
                                </tr>
                                <tr>
                                    <th>First Class Concession</th>
                                    <!-- <td>FCP</td> -->
                                    <td>$22.50</td>
                                    <td>$27.00</td>
                                </tr>
                                <tr>
                                    <th>First Class Child</th>
                                    <!-- <td>FCC</td> -->
                                    <td>$21.00</td>
                                    <td>$24.00</td>
                                </tr>
                            </table>
                            <p class="discounts">*Discounts apply <strong>all</strong> day Monday and Wednesday <strong>and</strong> 12pm on Weekdays</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-------------------------------now showing---------------------------------->
            <!---------------------------------------------------------------------------->
            <section id='now-showing'>
                <h2>Now Showing</h2>
                <div class="elim-margin">
                <div class="flex-container-now-showing">
                    <!-- featured movies -->
                    
                    <a class='now-showing-a' href='#toggle-mov-dets'>
                      <div class='flex-movie1' id="ACT" onclick="selectMovie('ACT')"> 
                        <img src='../../media/spiders-web.jpg' alt="The girl in the spiders's web">
                        <h3>The Girl in the Spider's web</h3>
                        <p>MA15+</p>
                        <table>
                            <tr>
                                <td>Wednesday</td>
                                <td><time>9:00pm</time></td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td><time>9:00pm</time></td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td><time>9:00pm</time></td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td><time>6:00pm</time></td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td><time>6:00pm</time></td>
                            </tr>
                        </table>
                    </div>
                    </a>
                   
                    <a class='now-showing-a' href='#toggle-mov-dets'>
                      <div class='flex-movie2' onclick="selectMovie('RMC')"> 
                        <img src='../../media/star-is-born.jpg' alt='A star is born'>
                        <h3>A Star is Born</h3>
                        <p>M</p>
                        <table>
                            <tr>
                                <td>Monday</td>
                                <td><time>6:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td><time>6:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td><time>3:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td><time>3:00 pm</time></td>
                            </tr>
                        </table>
                      </div>
                    </a>
                    
                    <a class='now-showing-a' href='#toggle-mov-dets'>
                    <div class='flex-movie3' onclick="selectMovie('ANM')"> 
                       <img src='../../media/ralph-breaks-internet.jpg' alt='ralph breaks the internet poster'>
                        <h3>Ralph Breaks the Internet</h3>
                        <p>PG</p>
                        <table>
                            <tr>
                                <td>Monday</td>
                                <td><time>12:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td><time>12:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Wednesday</td>
                                <td>
                                    <time>6:00 pm</time>
                                </td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td><time>6:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td><time>6:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td><time>12:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td><time>12:00 pm</time></td>
                            </tr>
                        </table>
                    </div>
                    </a>
                    
                    <a class='now-showing-a' href='#toggle-mov-dets'>
                      <div class='flex-movie4' onclick="selectMovie('AHF')">
                        <img src='../../media/boy-erased.jpg' alt='boy erased poster'>
                        <h3>Boy Erased</h3>
                        <p>MA15+</p>
                        <table>
                            <tr>
                                <td>Wednesday</td>
                                <td><time>12:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td><time>12:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td><time>9:00 pm</time></td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td><time>9:00 pm</time></td>
                            </tr>
                        </table>
                      </div>
                    </a>
                </div>
                <!-- trailer and description of a featured moive -->
                <div id="toggle-mov-dets" class="trailer-background-cont">
                    <div class='flex-container-trailer'>
                        <div class='flex-item-trailerDescrip'>
                            <h3 id="nowShowingTitle"></h3> 
                            <span id="rating"></span>
                            <h4>Plot Description</h4>
                            <!-- plot taken from: https://www.imdb.com/title/tt5848272/?ref_=nv_sr_1 -->
                            <p id="plot"></p>
                        </div>
                        <!-- video trailer-->
                        <!-- below code snippet taken from youtube.com-->
                        <div class='flex-item-trailer'>
                            <iframe id="trailer" width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <h3 class="select-time-heading">Make a booking:</h3>
                    <div class="slecect-day-time-buttons-flex" id="time-buttons">
                        </div>
                    </div>
                </div>
            </section>
            <!-----------------------------------bookings--------------------------------->
            <!---------------------------------------------------------------------------->
            <section id='bookings'>
                <h2>Bookings</h2>
                <div class="booking-col-flex">
                    <div class="booking-wrap">
                        <!-- booking form -->
                        <form action='index.php' method='post' onsubmit="return formValidate()">
                            <!-- hidden form inputs -->
                            <input id="movie[id]" name='movie[id]' type='hidden' value=''>
                            <input id="movie[day]" name='movie[day]' type='hidden' value=''>
                            <input id="movie[hour]" name='movie[hour]' type='hidden' value=''>
                                <!-- this below heading will be changeable in a3 -->
                                <h3 class="movie-selected-heading"><span id="booking-movie-title"></span> <span id="selected-day"></span> <span id="selected-time"></span></h3>
                                <!-------------------- standard booking ------------->
                                <div class="booking-flex-wraper">
                                    <div class="ticket-flex-wraper">
                                        <fieldset>
                                            <legend>Standard</legend>
                                            <!-- select standard adult tickets-->
                                            <label>Adults</label>
                                            <select id="seats[STA]" name='seats[STA]' oninput="callPrice()">
                                                <option value='' selected>Please Select</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                            <!-- select standard concession tickets-->
                                            <label>Concession</label>
                                            <select id="seats[STP]" name='seats[STP]' oninput="callPrice()">
                                                <option value='' selected>Please Select</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                            <!-- select standard children tickets-->
                                            <label>Children</label>
                                            <select id="seats[STC]" name='seats[STC]' oninput="callPrice()">
                                                <option value='' selected>Please Select</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                        </fieldset>
                                        <!--------------- first class booking --------------->
                                        <fieldset>
                                            <legend>First Class</legend>
                                            <!-- select number of first class adult tickets-->
                                            <label>Adults</label>
                                            <select id="seats[FCA]" name='seats[FCA]' oninput="callPrice()">
                                                <option value='' selected>Please Select</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                            <!-- select number of first class concession tickets-->
                                            <label>Concession</label>
                                            <select id="seats[FCP]" name='seats[FCP]' oninput="callPrice()">
                                                <option value='' selected>Please Select</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                            <!-- select number of first class children tickets-->
                                            <label>Children</label>
                                            <select id="seats[FCC]" name='seats[FCC]' oninput="callPrice()">
                                                <option value='' selected>Please Select</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <!-- enter customer details-->
                                    <div class="cust-details">
                                        <fieldset>
                                            <legend>Customer Details</legend>
                                            <label for='name'>Name</label>
                                            <input name='cust[name]' type='text' id='name' placeholder='Enter name' value="<?php echo $name; ?>" required pattern='[a-zA-Z \-.’]{1,100}' title='Western names only'>
                                            <p><?php echo $nameErrMsg; ?></p>
                                            
                                            <label for='email'>Email</label>
                                            <input name='cust[email]' type='email' id='email' placeholder="Enter email" value="<?php echo $email; ?>" required>
                                            <p>
                                                <?php echo $emailErrMsg?>
                                            </p>
                                            <!-- required pattern='((\(04\))|(04)|(\+614))( ?\d){8}'-->
                                            <label for='mob-num'>Mobile</label>
                                            <input name='cust[mobile]' type='tel' id='mob-num' placeholder="Enter mobile number" value="<?php echo $mobNumber; ?>" title="Australian mobile numbers only: e.g. start with 04" required pattern='((\(04\))|(04)|(\+614))( ?\d){8}'>
                                            <p>
                                                <?php echo $mobErrMsg?>
                                            </p>
                                            
                                            <label for='cred-card'>Credit Card</label>
                                            <input name='cust[card]' type='text' id='cred-card' placeholder='Enter credit card number' value="<?php echo $credCardNum; ?>" required pattern="[0-9 \-]{15,19}" title="* Please enter credit card number with min 15 to max 19 numbers including spaces">
                                            <p>
                                                <?php echo $creditErrMsg ?>
                                            </p>
                                            <!-- required oninput="checkExpiry()" id='exp-err' -->
                                            <label for='expiry'>Expiry Date</label>
                                            <input name='cust[expiry]' type='month' id='expiry' placeholder='YYYY-MM' value="<?php echo $expiryDate; ?>" required oninput="checkExpiry()" >
                                            <p id='exp-err'>
                                                <?php echo $expiryErrMsg ?>
                                            </p>
                                        </fieldset>
                                    </div>
                                    <!-- total amount and order button -->
                                    <div id='no-tickets'>
                                    <p><?php echo $mvErr;?></p>
                                    <p><?php echo $seatErr;?></p>
                                    </div>
                                    <p id="no-seats"></p>
                                </div>
                                <div class="total-order-wrap"> <span>Total:</span>
                                    <output name="sub-total" id="sub-total"></output>
                                    <button class="order-button" name='order' type='submit' value='order'>Order</button>
                                </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
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
        <?php
           
            preShow($_POST);
            preShow($_SESSION);
            $aaarg = preShow($my_bad_array, true);
            printMyCode();
            ?>
            <script>
                <?php include("js/tools.js"); ?>
            </script>
            
    </body>

    </html>