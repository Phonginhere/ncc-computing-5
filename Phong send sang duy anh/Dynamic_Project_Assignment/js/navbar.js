// document.addEventListener("DOMContentLoaded", function() {
//   const navbar = document.getElementById("navbar");
//   const navbarToggle = navbar.querySelector(".navbar-toggle");
//   const searchButton = document.getElementById("searchButton");

//   function openMobileNavbar() {
//     navbar.classList.add("opened");
//     navbarToggle.setAttribute("aria-expanded", "true");
//   }

//   function closeMobileNavbar() {
//     navbar.classList.remove("opened");
//     navbarToggle.setAttribute("aria-expanded", "false");
//   }

//   navbarToggle.addEventListener("click", () => {
//     if (navbar.classList.contains("opened")) {
//       closeMobileNavbar();
//     } else {
//       openMobileNavbar();
//     }
//   });

//   const navbarMenu = navbar.querySelector("#navbar-menu");
//   const navbarLinksContainer = navbar.querySelector(".navbar-links");

//   navbarLinksContainer.addEventListener("click", (clickEvent) => {
//     clickEvent.stopPropagation();
//   });

//   navbarMenu.addEventListener("click", closeMobileNavbar);

//   searchButton.addEventListener("click", () => {
//     navbar.classList.toggle("opened");
//     navbarToggle.setAttribute("aria-expanded", navbar.classList.contains("opened"));
//   });
// });

const navbar = document.getElementById("navbar");
const navbarToggle = navbar.querySelector(".navbar-toggle");
const navbarMenu = navbar.querySelector("#navbar-menu");
const navbarLinksContainer = navbar.querySelector(".navbar-links");

function openMobileNavbar() {
  navbarMenu.classList.add("opened");
  navbarToggle.setAttribute("aria-expanded", "true");
}

function closeMobileNavbar() {
  navbarMenu.classList.remove("opened");
  navbarToggle.setAttribute("aria-expanded", "false");
}

navbarToggle.addEventListener("click", () => {
  if (navbarMenu.classList.contains("opened")) {
    closeMobileNavbar();
  } else {
    openMobileNavbar();
  }
});

navbarLinksContainer.addEventListener("click", (clickEvent) => {
  clickEvent.stopPropagation();
});

navbarMenu.addEventListener("click", closeMobileNavbar);

