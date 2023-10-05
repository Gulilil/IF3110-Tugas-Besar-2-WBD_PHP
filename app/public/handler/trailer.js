function displayTrailer (trailer){
  // let trailer = '/public/vid/trailer1.mp4';
  document.getElementById("trailer-div").style.top = "0px";
  document.getElementById("anime-trailer-iframe").src = trailer;
}

function hideTrailer() {
  document.getElementById("trailer-div").style.top = "-100%";
  document.getElementById("anime-trailer-iframe").src = "";
}
