// now showing movie info object/array
// all movie info taken from https://www.imdb.com, for education purposes
// all trailers taken from https://www.youtube.com, for education purposes
 var nowShowingMovies = [
    // The girl in the Spider's Web
       ["ACT",
        "The girl in the Spider's Web",
        "MA15+",
        "In Stockholm, Sweden, vigilante hacker Lisbeth Salander is hired by computer programmer Frans Balder to retrieve Firefall, a program capable of accessing the world's nuclear codes that he developed for the National Security Agency, as Balder believes it is too dangerous to exist. Lisbeth successfully retrieves Firefall from the NSA's servers, attracting the attention of agent Edwin Needham, but is unable to unlock it, and the program is later stolen from her by mercenaries led by Jan Holtser, who also attempt to kill Lisbeth. When she doesn't attend their scheduled rendezvous, Balder mistakenly believes Lisbeth decided to keep Firefall for herself and contacts Gabrielle Grane, the deputy director of the Swedish Security Service (Säpo), who moves Balder and his young son August to a safe-house. Meanwhile, Needham tracks the unauthorized login to Stockholm and arrives to seek Lisbeth and Firefall..",
        ["Wednesday - 9pm", "Thursday - 9pm", "Friday - 9pm", "Saturday - 6pm", "Sunday - 6pm"],
        "https://www.youtube.com/embed/XKMSP9OKspQ"]
    
];


//var test = document.getElementById("ACT");
//test.onclick = setMovieTitle;

/*document.getElementById("ACT").addEventListener("click", function() 
{setMovieTitle(mvID);
});*/

function setMovieTitle(mvID) {
    var index = 0;
    var i = 0;
    for (i; i < nowShowingMovies.lenth; i++)
    {
        if(nowShowingMovies[i][0] == mvID)
            break;
    } 
    index = i;
  document.getElementById("nowShowingTitle").innerHTML = nowShowingMovies[index][1];
  document.getElementById("rating").innerHTML = nowShowingMovies[index][2];
  document.getElementById("plot").innerHTML = nowShowingMovies[index][3];
  document.getElementById("trailer").src = nowShowingMovies[index][5];
    
    var buttons = "";
    var len = nowShowingMovies[index][4].length;
    var y = 0;
    for (y; y < len; y++){
        buttons += '<button>' + nowShowingMovies[index][4][y] + '</button>';
    }
    document.getElementById("time-buttons").innerHTML = buttons;
}



