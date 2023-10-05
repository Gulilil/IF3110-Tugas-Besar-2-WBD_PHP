function displayTrailer (trailer, title){
  document.getElementById("trailer-div").style.top = "0px";
  document.getElementById("anime-trailer-iframe").src = trailer;
  document.getElementById("trailer-title").innerHTML = title;
}

function hideTrailer() {
  document.getElementById("trailer-div").style.top = "-100%";
  document.getElementById("anime-trailer-iframe").src = "";
  document.getElementById("trailer-title").innerHTML = "";

}
