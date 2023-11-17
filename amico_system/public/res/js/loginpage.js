var current = null;
document.querySelector("#number").addEventListener("focus", function (e) {
  if (current) current.pause();
  current = anime({
    targets: "path",
    strokeDashoffset: {
      value: 0,
      duration: 700,
      easing: "easeOutQuart"
    },
    strokeDasharray: {
      value: "240 1386",
      duration: 700,
      easing: "easeOutQuart"
    }
  });
});
document.querySelector("#password").addEventListener("focus", function (e) {
  if (current) current.pause();
    current = anime({
      targets: "path",
      strokeDashoffset: {
        value: -336,
        duration: 700,
        easing: "easeOutQuart"
      },
      strokeDasharray: {
        value: "240 1386",
        duration: 700,
        easing: "easeOutQuart"
      }
    });
});
document.querySelector("#submit").addEventListener("focus", function (e) {
  if (current) current.pause();
    current = anime({
      targets: "path",
      strokeDashoffset: {
        value: -730,
        duration: 700,
        easing: "easeOutQuart"
      },
      strokeDasharray: {
        value: "530 1386",
        duration: 700,
        easing: "easeOutQuart"
      }
    });

  $( "form" ).submit();
  
});
document.addEventListener("DOMContentLoaded", function() {
  window.addEventListener("scroll", function() {
      var aboutUs = document.getElementById("aboutUs");
      var aboutUsPosition = aboutUs.getBoundingClientRect().top;

      var windowHeight = window.innerHeight;

      if (aboutUsPosition < windowHeight / 1.5) {
          aboutUs.style.display = "block";
          // You can add animations or other effects here
      }
  });
});