import sayHello from "./lib/sayHello.js";
import "jquery";
import 'owl.carousel2';

sayHello();

// $(document).on('change', 'input[type=text]', function (e) {
//   $(this).attr('placeholder') = '';
// });

// main search
$(document).on("focus", ".search__input", function () {
  $(".search").addClass("search--focus");
  setTimeout(() => {
    $(".search__ac").slideDown(300);
  }, 100);
});

$(document).on("focusout", ".search__input", function () {
  setTimeout(() => {
    $(".search__ac").slideUp(300);
  }, 100);
  setTimeout(() => {
    $(".search").removeClass("search--focus");
  }, 350);
});

// cguide open
$(document).on("click", ".js--cguide-open", function (e) {
  e.preventDefault();
  if ($(this).hasClass("active")) {
    $(this).removeClass("active");
    $(".cguide__contact-hide").slideUp(150);
  } else {
    $(this).addClass("active");
    $(".cguide__contact-hide").slideDown(150);
  }
});

// main tabs
$(document).on("click", "a[data-main-tab-nav]", function (e) {
  e.preventDefault();
  let nTab = $(this).data("main-tab-nav");
  let href = $(this).parent("li");
  let tab = $("[data-main-tab]");

  tab.removeClass("active");
  $(".subnavigation__item").removeClass("active");

  $("[data-main-tab-nav='" + nTab + "']")
    .parent()
    .addClass("active");
  $("[data-main-tab='" + nTab + "']").addClass("active");

  console.log(href);
});

// owl carousel
$(".js--action-slider").owlCarousel({
  loop: true,
  margin: 20,
  dots: false,
  responsive: {
    0: {
      items: 1,
      stagePadding: 20
    },
    420: {
      items: 2,
      stagePadding: 0,
      dots: true
    },
    768: {
      items: 3,
      stagePadding: 0,
      dots: true
    },
    992: {
      items: 4,
      stagePadding: 0,
      dots: true
    }
  }
});
