$(document).ready(function () {
  $(".search-icon").click(function () {
    $(".header-1 .responsive-menu form").slideToggle(500);
  });

  /* Smooth scrolling */
  $("a.scrollto").on("click", function (e) {
    //store hash
    var target = this.hash;
    e.preventDefault();
    $("body").scrollTo(target, 800, { offset: -50, axis: "y" });
  });

  // 	nft hub script ends
});

/* navbar toggler script header */
function navbartoggle(x) {
  x.classList.toggle("change");
}

