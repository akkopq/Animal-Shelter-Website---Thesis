function displayTime() {
  var date = new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();


  hours = ("0" + hours).slice(-2);
  minutes = ("0" + minutes).slice(-2);
  seconds = ("0" + seconds).slice(-2);

  var time = hours + ":" + minutes + ":" + seconds;


  document.getElementById("clock").innerHTML = time;
}

// Actualizarea timpului la fiecare secundă
document.addEventListener("DOMContentLoaded", function() {
  displayTime("clock");
  setInterval(displayTime, 1000);
});


