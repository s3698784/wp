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

    <style><?php include("css/style.css");  ?></style>
    

    <style>
        <?php
        // This PHP code inserts CSS to style the "current page" link in the nav area
        $here = $_SERVER['SCRIPT_NAME']; 
        $bits = explode('/',$here); 
        $filename = $bits[count($bits)-1]; 
        echo "nav a[href$='$filename'] {
        box-shadow: 1px 1px 1px 2px navy;
      }";
      ?>
      
    </style>
</head>

<body>

    <header>
        <!-- logo was made at https://www.freelogodesign.org/ -->
        <div class="logo"><img src="../../media/logo.png" alt="logo" width="200" height="200"> </div>
        <h1>Lunardo</h1>
    </header>

    <!---------------------------- Navigation ------------------------------------>
    <!---------------------------------------------------------------------------->
    <nav>
        <ul>
            <li><a href='#home'>Home</a></li>
            <li><a href='#about-us'>About Us</a></li>
            <li><a href='#seats-and-prices'>Seats and Prices</a></li>
            <li><a href='#now-showing'>Now Showing</a></li>
            <li><a href='#bookings'>Bookings</a></li>
        </ul>
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
                        <li>Extensivly improved and renovated the whole cinema</li><br>
                        <li>New seats for all, including reclinable first class seats</li><br>
                        <li>Major projection and sound systems upgrades with top off the range 3D Dolby Vision projection and Dolby Atmos sound. </li><br>
                        <!-- external link aout the sound system upgrades-->
                        <a class="dolby" href="https://www.dolby.com/us/en/cinema" target="_blank">Cick here for more Dolby details</a>
                    </ul>

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

                        <!-- images of seats -->
                        <img class="stand-seat" src='../../media/standard-seats.jpeg' alt='standard seats' width=300>
                        <div class="img-info">Spacious and comfortable standard seats</div>


                        <img class="first-seat" src='../../media/first-class-seats.png' alt='first class seats' width=300>
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

            <div class="flex-container-now-showing">
                <!-- featured movies -->
                <div class='flex-movie1'id="ACT" onclick="selectMovie('ACT')">
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

                <div class='flex-movie2' onclick="selectMovie('RMC')">
                    <img src='../../media/star-is-born.jpg' alt='A star is born' >
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

                <div class='flex-movie3' onclick="selectMovie('ANM')">
                    <img src='../../media/ralph-breaks-internet.jpg' alt='ralph breaks the internet'>
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
                            <td><time>6:00 pm</time></td>
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

                <div class='flex-movie4' onclick="selectMovie('AHF')">
                    <img src='../../media/boy-erased.jpg' alt='boy erased'>
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

            </div>


            <!-- trailer and description of a featured moive -->
            <div class="trailer-background-cont">
                <div class='flex-container-trailer'>
                    <div class='flex-item-trailerDescrip'>
                        <h3 id="nowShowingTitle" >Ralph Breaks the Internet</h3>
                        <span id="rating">PG</span>
                            <h4>Plot Description</h4>
                            <!-- plot taken from: https://www.imdb.com/title/tt5848272/?ref_=nv_sr_1 -->
                            <p id="plot">Six years after the events of "Wreck-It Ralph," Ralph and Vanellope, now friends, discover a wi-fi router in their arcade, leading them into a new adventure.</p>
                    </div>
                    <!-- video trailer-->
                    <!-- below code snippet taken from youtube.com-->
                    <div class='flex-item-trailer'>
                        <iframe id="trailer" width="560" height="315" src="https://www.youtube.com/embed/_BcYBFC6zfY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <h3 class="select-time-heading">Make a booking:</h3>
                <div class="slecect-day-time-buttons-flex" id="time-buttons">
                    <button>Monday - 12:00pm</button>
                    <button>Tuesday - 12:00pm</button>
                    <button>Wednesday - 6:00pm</button>
                    <button>Thursday - 6:00pm</button>
                    <button>Friday - 6:00pm</button>
                    <button>Saturday - 12:00pm</button>
                    <button>Sunday - 12:00pm</button>
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
                    <form action='https://titan.csit.rmit.edu.au/~e54061/wp/lunardo-formtest.php' method='post' onsubmit="return formValidate()">

                        <!-- hidden form inputs -->
                        <input id="movie[id]" name='movie[id]' type='hidden' value='ACT'>
                        <input id="movie[day]" name='movie[day]' type='hidden' value='MON'>
                        <input id="movie[hour]" name='movie[hour]' type='hidden' value='09'>
                        

                        <!-- this below heading will be changeable in a3 -->
                        <h3 class="movie-selected-heading"><span id="booking-movie-title"></span>  <span id="selected-day"></span>  <span id="selected-time"></span></h3>
                        <!-------------------- standard booking ------------->
                        <div class="booking-flex-wraper">
                            <div class="ticket-flex-wraper">
                                <fieldset>
                                    <legend>Standard</legend>
                                    <!-- select standard adult tickets-->
                                    <label>Adults</label>
                                    <select id="seats[STA]" class="clearInput" name='seats[STA]' oninput="callPrice()">
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
                                    <input name='cust[name]' type='text' id='name' placeholder='Enter name' value="" required pattern='[a-zA-Z \-.’]{1,100}' title='Western names only'>
                                    <label for='email'>Email</label>
                                    <input name='cust[email]' type='email' id='email' placeholder="Enter email" value="" required>
                                    <label for='mob-num'>Mobile</label>
                                    <input name='cust[mobile]' type='tel' id='mob-num' placeholder="Enter mobile number" value="" required pattern='((\(04\))|(04)|(\+614))( ?\d){8}' title="Australian mobile numbers only">
                                    <label for='cred-card'>Credit Card</label>
                                    <input name='cust[card]' type='text' id='cred-card' placeholder='Enter credit card number' value="" required pattern="[0-9 \-]{15,19}" title= "Format: 1234 5678 1234 5678 or 1234567812345678">
                                    <label for='expiry'>Expiry Date</label>
                                    <input name='cust[expiry]' type='month' id='expiry' placeholder='YYYY-MM' value="" required oninput="checkExpiry()">
                                    <p id='exp-err'></p>
                                </fieldset>
                            </div>
                            <!-- total amount and order button -->
                        <p id='no-tickets'></p>
                        </div>
                        <div class="total-order-wrap">
                            <span>Total:</span>
                            <output name="sub-total" id="sub-total"></output>
                            <button class="order-button" name='order' type='submit' value='order'>Order</button>
                        </div>

                    </form>
                </div>
            </div>
        </section>

        <main>

        </main>

        <footer>
            <div class="footer-wrap-flex">
                <div class="footer-content">
                    <div class="contact-dets">
                        <span>Contact: </span>
                        <span>Lunardo Cinema, </span>
                        <address>123 Fake Street, Tralralgon, </address>
                        <span>lunardo@lunardocinema.com.au</span>
                    </div>
                    <div>&copy;
                        <script>
                            document.write(new Date().getFullYear());

                        </script> James Ciuciu, s3698784. https://github.com/s3698784/wp. Last modified

                    </div>
                    <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.
                    </div>
                    <div>Maintain links to your <a href='products.txt'>products spreadsheet</a> and <a href='orders.txt'>orders spreadsheet</a> here.
                    </div>
                    <div class="footer-button">
                        <button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button>
                    </div>
                </div>
        </footer>
<script><?php include("js/tools.js"); ?></script>
</body>

</html>
