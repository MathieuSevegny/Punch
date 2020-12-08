// Responsive Megamenu
const navModal = document.getElementById("navmodal");
const openMenu = document.getElementById("openmenu");
const closeMenu = document.getElementById("closemenu");
const main = document.querySelector("main");

// Open Megamenu and Make Main Fixed Position
openMenu.addEventListener("click", function () {
    navModal.classList.add("active");
    main.classList.add("fixed");
});

// Close Megamenu and Remove Main Fixed Position
closeMenu.addEventListener("click", function () {
    navModal.classList.remove("active");
    main.classList.remove("fixed");
});
