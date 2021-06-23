function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav mb-3") {
    x.className += " responsive mb-3";
  } else {
    x.className = "topnav mb-3";
  }
}
