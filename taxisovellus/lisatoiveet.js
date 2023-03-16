//Seuraava scripti osoitteesta: http://www.willmaster.com/blog/css/show-hide-div-layer.php

function HideContent(d) {
  document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
  document.getElementById(d).style.display = "block";
}
function ReverseDisplay(d) {
  if (document.getElementById(d).style.display == "none") {
    document.getElementById(d).style.display = "block";
  } else {
    document.getElementById(d).style.display = "none";
  }
}
