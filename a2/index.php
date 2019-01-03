<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">
    <script src='../wireframe.js'></script>
</head>

<body>

    <header id='home'>
        <div>Put company logo here </div>
        <h1>Lunardo...</h1>
    </header>


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
        <!--   <article id='Website Under Construction'>-->
        <!-- Creative Commons image sourced from https://pixabay.com/en/maintenance-under-construction-2422173/ and used for educational purposes only -->
        <!--  <img   src='../../media/website-under-construction.png' alt='Website Under Construction' /> </article> -->

        <!--about us-->
        <section id='about-us'>
            <div id="about-grip-cont">
                
                    <h2 class="about-heading">About Us...</h2>
                
                <div class="about-info">
                    <p>Lunardo is a local cinema who puts customers first</p>
                    <p>To give the customer the best expreicnce possible we have recently made some upgrades, we have:</p>
                    <ul>
                        <li>Extensivly improved and renovated the whole cinema</li>
                        <li>New seat for all, including reclinable first class seats</li>
                        <li>Major projection and sound systems upgrades with top off the range 3D Dolby Vision projection and Dolby Atmos sound. <a href="https://www.dolby.com/us/en/cinema">Cick for more details</a></li>
                    </ul>
                </div>
                <img class="about-image " src='../../media/standard-seats.png' alt='standard seats' width=30%>

            </div>
        </section>

        <!--seats and prices divided into 2 parts-->
        <section id='seats-and-prices'>
            <!-- seats -->
            <h2>Seats and Prices</h2>
            <h3>Seats</h3> <img src='../../media/standard-seats.png' alt='standard seats' width=30%> <img src='../../media/first-class-seats.png' alt='first class seats' width=25%>

            <!-- all prices - set out in a table -->
            <h3>Prices:</h3>
            <table>
                <theader>
                    <tr>
                        <th>Seat Type</th>
                        <th>Seat Code</th>
                        <th>All day Monday and Wednesday <strong>AND</strong> 12pm Weekdays </th>
                        <th>All other Times</th>
                    </tr>
                </theader>
                <tr>
                    <th>Standard Adult</th>
                    <td>STA</td>
                    <td>$14.00</td>
                    <td>$19.80</td>
                </tr>
                <tr>
                    <th>Standard Concession</th>
                    <td>STP</td>
                    <td>$12.50</td>
                    <td>$17.50</td>
                </tr>
                <tr>
                    <th>Standard Child</th>
                    <td>STC</td>
                    <td>$11.00</td>
                    <td>$15.30</td>
                </tr>
                <tr>
                    <th>First Class Adult</th>
                    <td>FCA</td>
                    <td>$24.00</td>
                    <td>$30.00</td>
                </tr>
                <tr>
                    <th>First Class Concession</th>
                    <td>FCP</td>
                    <td>$22.50</td>
                    <td>$27.00</td>
                </tr>
                <tr>
                    <th>First Class Child</th>
                    <td>FCC</td>
                    <td>$21.00</td>
                    <td>$24.00</td>
                </tr>
            </table>
        </section>

        <!--now showing-->
        <section id='now-showing'>
            <h2>Now Showing</h2>
            <div id='movie1'>
                <p>The Girl in the Spider's web</p>
                <p>MA15+</p>
                <button type="button">Wednesday 9:00pm</button>
                <button type="button">Thursday 9:00pm</button>
                <button type="button">Friday 9:00pm</button>
                <button type="button">Saturday 6:00pm</button>
                <button type="button">Sunday 6:00pm</button>
            </div>
            <div id='movie2'>
                <p>A Start is Born</p>
                <p>M</p>
                <button type="button">Monday 6:00pm</button>
                <button type="button">Tuesday 6:00pm</button>
                <button type="button">Saturday 3:00pm</button>
                <button type="button">Sunday 3:00pm</button>
            </div>
            <div id='movie3'>
                <p>Ralph Breaks the Internet</p>
                <p>PG</p>
                <button type="button">Monday 12:00pm</button>
                <button type="button">Tuesday 12:00pm</button>
                <button type="button">Wednesday 6:00pm</button>
                <button type="button">Thursday 6:00pm</button>
                <button type="button">Friday 6:00pm</button>
                <button type="button">Saturday 12:00pm</button>
                <button type="button">Sunday 12:00pm</button>
            </div>
            <div id='movie3'>
                <p>Boy Erased</p>
                <p>MA15+</p>
                <button type="button">Wednesday 12:00pm</button>
                <button type="button">Thursday 12:00pm</button>
                <button type="button">Friday 12:00pm</button>
                <button type="button">Saturday 9:00pm</button>
                <button type="button">Sunday 9:00pm</button>
            </div>
            <h3>Ralph Breaks the Internet</h3>
            <p>PG</p>
            <h4>Plot Description</h4>
            <!-- plot taken from: https://www.imdb.com/title/tt5848272/?ref_=nv_sr_1 -->
            <p>Taking place six years after saving the arcade from Turbo's vengeance, the Sugar Rush arcade cabinet has broken, forcing Ralph and Vanellope to travel to the Internet via the newly-installed Wi-Fi router in Litwak's Arcade to retrieve the piece capable of saving the game.</p>
            <!-- video trailer-->
            <!-- below code snippet taken from youtube.com-->
            <iframe width="560" height="315" src="https://www.youtube.com/embed/_BcYBFC6zfY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </section>
        <!--bookings-->
        <section id='bookings'>
            <h2>Bookings</h2>
            <h3>Movie Title - Day - Time</h3>
            <form action='https://titan.csit.rmit.edu.au/~e54061/wp/lunardo-formtest.php' method='post' target="_blank">

                <!-- hidden form inputs -->
                <input name=moive[id] type='hidden' value='RMC'>
                <input name=moive[day] type='hidden' value='WED'>
                <input name=moive[hour] type='hidden' value='12'>

                <!-- standard booking -->
                <fieldset>
                    <legend>Standard</legend>
                    <!-- select standard adult tickets-->
                    <label>Adults</label>
                    <select name='seats[STA]'>
                        <option value=''></option>
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
                    <select name='seats[STP]'>
                        <option value=''></option>
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
                    <select name='seats[STC]'>
                        <option value=''></option>
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

                <!-- first class booking -->
                <fieldset>
                    <legend>First Class</legend>
                    <!-- select number of first class adult tickets-->
                    <label>Adults</label>
                    <select name='seats[FCA]'>
                        <option value=''></option>
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
                    <select name='seats[FCP]'>
                        <option value=''></option>
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
                    <select name='seats[FCC]'>
                        <option value=''></option>
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

                <!-- enter customer details-->
                <fieldset>
                    <legend>Customer Details</legend>
                    <label for='name'>Name</label>
                    <input name='cust[name]' type='text' id='name' placeholder='Enter name'>
                    <label for='email'>Email</label>
                    <input name='cust[email]' type='email' id='email' placeholder="Enter email">
                    <label for='mob-num'>Mobile</label>
                    <input name='cust[mobile]' type='tel' id='mob-num' placeholder="Enter mobile number">
                    <label for='cred-card'>Credit Card</label>
                    <input name='cust[card]' type='text' id='cred-card' placeholder='Enter credit card number'>
                    <label for='expiry'>Expiry Date</label>
                    <input name='cust[expiry]' type='month' id='expiry' placeholder='YYYY-MM'>
                </fieldset>

                <button name='order' type='submit' value='order'>Order</button>

            </form>
        </section>
    </main>
    <footer>
        <div>&copy;
            <script>
                document.write(new Date().getFullYear());

            </script> James Ciuciu, s3698784 and group name here. Last modified
            <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
        <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
        <div>
            <button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button>
        </div>
    </footer>
</body>

</html>
