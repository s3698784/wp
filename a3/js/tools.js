// ------------------ change movie details when clicking on mpvie panel -------------------------
//--------------------------and up-date booking heading -----------------------------------------
// now showing movie info array
// all movie info taken from https://www.imdb.com, for education purposes
// all trailers taken from https://www.youtube.com, for education purposes

var nowShowingMovies = {
    // The girl in the Spider's Web
    ACT: {
        title: "The girl in the Spider's Web",
        rating: "MA15+",
        plot: "Young computer hacker Lisbeth Salander and journalist Mikael Blomkvist find themselves caught in a web of spies, cybercriminals and corrupt government officials.",
        times: ["Wednesday - 9:00pm", "Thursday - 9:00pm", "Friday - 9:00pm", "Saturday - 6:00pm", "Sunday - 6:00pm"],
        trailerLink: "https://www.youtube.com/embed/XKMSP9OKspQ"
    },
    // a star is born
    RMC: {
        title: "A Star is Born",
        rating: "M",
        plot: "A musician helps a young singer find fame, even as age and alcoholism send his own career into a downward spiral.",
        times: ["Monday - 12:00pm", "Tuesday - 6:00pm", "Saturday - 3:00pm", "Sunday - 3:00pm"],
        trailerLink: "https://www.youtube.com/embed/nSbzyEJ8X9E"
    },

    // ralph breaks the internet
    ANM: {
         title: "Ralph Breaks the Internet",
         rating: "PG",
         plot: "Six years after the events of \"Wreck-It Ralph,\" Ralph and Vanellope, now friends, discover a wi-fi router in their arcade, leading them into a new adventure.",
         times: ["Monday - 12:00pm", "Tuesday - 12:00pm", "Wednesday - 6:00pm", "Thursday - 6:00pm", "Friday - 6:00pm", "Saturday - 12:00pm", "Sunday - 12:00pm"],
         trailerLink: "https://www.youtube.com/embed/_BcYBFC6zfY"
        },

    // boy erased
    AHF: {
         title: "Boy Erased",
         rating: "MA15+",
         plot: "The son of a Baptist preacher is forced to participate in a church-supported gay conversion program after being forcibly outed to his parents.",
         times: ["Wednesday - 12:00pm", "Thursday - 12:00pm", "Friday - 12:00pm", "Saturday - 9:00pm", "Sunday - 9:00pm"],
         trailerLink: "https://www.youtube.com/embed/-B71eyB_Onw"
    }
};
//setMovieTitle(mvID) takes the movie code as parameter given in the html.
// The funtion finds the mvID, then outputs, title, rating, plot, and select time buttons.
// returns true is successful, false if not.
// sets hidden movie[id] value
function selectMovie(mvID) {
    // first check if index found
    if (mvID.length > 0) {
        document.getElementById("movie[id]").value = mvID; // sets hidden input movie[id]value
        document.getElementById("nowShowingTitle").innerHTML = nowShowingMovies[mvID]['title'];
        //title in bookings section
        document.getElementById("booking-movie-title").innerHTML = nowShowingMovies[mvID]['title'];    
        document.getElementById("rating").innerHTML = nowShowingMovies[mvID]['rating'];    
        document.getElementById("plot").innerHTML = nowShowingMovies[mvID]['plot'];
        document.getElementById("trailer").src = nowShowingMovies[mvID]['trailerLink'];
    
        var buttons = "";
        var len = nowShowingMovies[mvID]['times'].length;
        for (y = 0; y < len; y++) {
            buttons += '<button id="timeInfo' + [y] + '" onclick=\'setHidden(this.innerHTML)\'>' + nowShowingMovies[mvID]['times'][y] + '</button>';
        }
        document.getElementById("time-buttons").innerHTML = buttons;
        return true;
    } else {
        alert("No movie ID");
        return false;
    }
    
}; 
// gets the movie title, day, time info from day - time select buttons
// and sets headings for movie title, day and time in booking section.
// sets hidden values of moovie[day] and movie[hour]
function setHidden(timeInfo) {
    let dayTimeArray = timeInfo.split(" - ");
    let day = dayTimeArray[0]
    let dayHidden = day.substr(0, 3).toUpperCase();
    let time = dayTimeArray[1]
    let hourHidden = return24Hour(time);

    //set hidden values
    document.getElementById("movie[day]").value = dayHidden;
    document.getElementById("movie[hour]").value = hourHidden;

    // set headings in booking section
    // document.getElementById("booking-movie-title").innerHTML = title + " - ";
    document.getElementById("selected-day").innerHTML = " - " + day + " - ";
    document.getElementById("selected-time").innerHTML = time;
    callPrice(); // qty's may already be selected, if so, needs to be calculated
};

//helper function
//returns the hour from 12hr in 24hr. Must have am or pm included
function return24Hour(time) {
    let hour = time.substr(0, 2);
    if (time.includes("pm") && hour != 12) {
        if (time.charAt(1) == ":" || time.charAt(1) == " ") {
            hour = 12 + Number(time.charAt(0));
            return String(hour);
        } else {
            hour = 12 + Number(hour);
            return String(hour);
        }
    } else {
        if (time.charAt(1) == ":") {
            hour = '0' + time.charAt(0);
            return hour;
        } else {
            return hour;
        }
    }
};

//-------------------------------- calculate prices -----------------------------------------
//-------------------------------------------------------------------------------------------

var prices = {
    //standard seats
    STA: {
        discount: "14.00",
        normal: "19.80"
    },
    STP: {
        discount: "12.50",
        normal: "17.50"
    },
    STC: {
        discount: "11.00",
        normal: "15.30"
    },

    //first class seats
    FCA: {
        discount: "24.00",
        normal: "30.00"
    },
    FCP: {
        discount: "22.50",
        normal: "27.00"
    },
    FCC: {
        discount: "21.00",
        normal: "24.00"
    }
};


function discountOrNormal() {
    let day = document.getElementById("movie[day]").value;
    let hour = document.getElementById("movie[hour]").value;
    let priceClass = "";
    //   alert(hour);
    //    alert(day);

    if (day == 'SAT' || day == 'SUN')
        priceClass = 'normal';
    else if (day == 'MON' || day == 'WED')
        priceClass = 'discount';
    else if (hour == "12")
        priceClass = 'discount';
    else
        priceClass = 'normal';

    return priceClass;
};

// return standard seat price
function setSTAPrice() {
    let qty = document.getElementById("seats[STA]").value;
    let priceClass = discountOrNormal();
    let STAPrice = qty * Number(prices['STA'][priceClass]);
    return STAPrice;
};

function setSTPPrice() {
    let qty = document.getElementById("seats[STP]").value;
    let priceClass = discountOrNormal();
    let STPPrice = qty * Number(prices['STP'][priceClass]);
    return STPPrice;
};

function setSTCPrice() {
    let qty = document.getElementById("seats[STC]").value;
    let priceClass = discountOrNormal();
    let STCPrice = qty * Number(prices['STC'][priceClass]);
    return STCPrice;
};

function setFCAPrice() {
    let qty = document.getElementById("seats[FCA]").value;
    let priceClass = discountOrNormal();
    let FCAPrice = qty * Number(prices['FCA'][priceClass]);
    return FCAPrice;
};

function setFCPPrice() {
    let qty = document.getElementById("seats[FCP]").value;
    let priceClass = discountOrNormal();
    let FCPPrice = qty * Number(prices['FCP'][priceClass]);
    return FCPPrice;
};

function setFCCPrice() {
    let qty = document.getElementById("seats[FCC]").value;
    let priceClass = discountOrNormal();
    let FCCPrice = qty * Number(prices['FCC'][priceClass]);
    return FCCPrice;
}

function callPrice() {
    //check is a movie has been selected
    let movieCheck = document.getElementById('booking-movie-title').innerHTML;
    let hourCheck = document.getElementById('selected-time').innerHTML;
    if (movieCheck == "" && hourCheck == "") {
        document.getElementById("booking-movie-title").innerHTML = "Please select movie and time slot";
        return false;
    } else if (hourCheck == "") {
        document.getElementById("selected-day").innerHTML = " - Please select time slot";
        return false;
    } else {
        //if selected, calculate the prices
        let staPrice = setSTAPrice();
        let stpPrice = setSTPPrice();
        let stcPrice = setSTCPrice();
        let fcaPrice = setFCAPrice();
        let fcpPrice = setFCPPrice();
        let fccPrice = setFCCPrice();
        let totPrice = staPrice + stpPrice + stcPrice + fcaPrice + fcpPrice + fccPrice;
        document.getElementById("sub-total").innerHTML = '$' + totPrice.toFixed(2);
        //remove no seat selected error message
        document.getElementById("no-tickets").innerHTML = "";
        return true;
    }
};

//  document.getElementById("sub-total").innerHTML = STAPrice;

//-----------------------------------form validation ---------------------------------------
//------------------------------------------------------------------------------------------

function checkExpiry() {
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth() + 1;
    let currentYear = currentDate.getFullYear();
    let expireDate = document.getElementById('expiry').value;
    let expiryYear = expireDate.substr(0, 4);
    let expiryMonth = expireDate.substr(5);
    let errorMsg = " * credit card must not expire in the next month";
    document.getElementById('exp-err').innerHTML = ""; //clears if there is error msg

    //  alert(expireDate);
    //  alert(currentYear);
    //  alert(expiryYear);
    //  alert(currentMonth);
    //  alert(expiryMonth);

    if ((expiryYear >= currentYear) && (expiryMonth >= currentMonth + 1)) {
        return true;
    } else if (expiryYear > currentYear) {
        return true;
    } else {
        document.getElementById('exp-err').innerHTML = errorMsg;
        return false;
    }
};

function hasPrice() {
    let hasPrice = document.getElementById("sub-total").innerHTML
    if ((hasPrice == "") || (hasPrice == "$0.00")) {
        document.getElementById("no-tickets").innerHTML = " * no seats selected";
        return false;
    } else {
        return true;
    }
};

// check credit card expiry and if there is total before submitting
// Name, e-mail, mobile and credit card are done in the HTML.
function formValidate() {
    let noError = true;

    if (!checkExpiry()) {
        noError = false;
    }

    if (!hasPrice()) {
        noError = false;
    }

    if (noError) {
        return true;
    } else {
        return false;
    }

};
