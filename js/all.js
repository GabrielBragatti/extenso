document.addEventListener("DOMContentLoaded", function () {
  var currentLocation = window.location.href;

  var navLinks = document.querySelectorAll("nav ul li a");

  navLinks.forEach(function (link) {
    if (link.href === currentLocation) {
      link.classList.add("active");
    }
  }); 
});

// function notifyMe() {
//   if (!("Notification" in window)) {
//     alert("Este browser não suporta notificações de Desktop");
//   }
//   else if (Notification.permission === "granted") {
//     var notification = new Notification("Hi there!");
//   }
//   else if (Notification.permission !== "denied") {
//     Notification.requestPermission(function (permission) {
//       if (permission === "granted") {
//         var notification = new Notification("Hi there!");
//       }
//     });
//   }
// }
// Notification.requestPermission();
// function spawnNotification(corpo, icone, titulo) {
//   var opcoes = {
//     body: corpo,
//     icon: icone,
//   };
//   var n = new Notification(titulo, opcoes);
// }
