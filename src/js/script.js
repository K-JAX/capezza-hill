import "../sass/style.scss";

import AOS from "aos";
import "aos/dist/aos.css";
import Rellax from "rellax";

if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach;
}

import "./functions/touch-keyboard-navigation";
import "./functions/activate-search";

// Scroll to specific values
// scrollTo is the same
function scrollIt(destination, duration = 200, easing = "linear", callback) {
    // object with some some timing functions
    // function body here
    const start = window.pageYOffset;
    const startTime =
        "now" in window.performance ? performance.now() : new Date().getTime();
}

window.addEventListener("load", function () {
    AOS.init();

    if (document.querySelectorAll(".rellax").length > 0) {
        var rellax = new Rellax(".rellax", {
            center: true,
        });
    }

    var scrollE = document.querySelectorAll(".jump-scroll")[0];
    if (scrollE !== undefined) {
        scrollE.addEventListener("click", (event) => {
            if (!scrollE.classList.contains("clicked")) {
                scrollE.classList.add("clicked");
            }
        });
    }

    // Create dropdown for homepage feature section
    var navThang = document.querySelectorAll(".feature-page-subnav")[0],
        subNavThang = document.querySelectorAll(
            ".feature-page-subnav .subnav"
        )[0];
    if (navThang) {
        navThang.addEventListener("mouseenter", function (event) {
            subNavThang.classList.toggle("active");
        });
        navThang.addEventListener("mouseleave", function (event) {
            subNavThang.classList.toggle("active");
        });
    }
    // When clicking form input add active class to input's parents
    document.querySelectorAll(".wpcf7-form-control-wrap *").forEach((item) => {
        // if( item ){
        item.addEventListener("focus", (event) => {
            item.parentElement.classList.toggle("active");
        });
        item.addEventListener("blur", (event) => {
            item.parentElement.classList.toggle("active");
            if (item.value !== "") {
                item.classList.add("valid");
            } else {
                item.classList.remove("valid");
            }
        });
        // }
    });
    // Manipulating attorney title on archive page
    if (document.querySelectorAll(".feature-attorney-title") != undefined) {
        document.querySelectorAll(".feature-attorney-title").forEach((item) => {
            let name = item.innerHTML;
            let pieces = name.split(". ");
            pieces[0] =
                '<span class="small-title">' + pieces[0] + ".</span><br>";
            pieces[1] = pieces[1].replace(
                pieces[1][0],
                '<span class="block-cap">' + pieces[1][0] + "</span>"
            );
            name = pieces.join(" ");
            item.innerHTML = name;
        });
    }
    // Bio targetting on the attorney page
    if (document.querySelectorAll(".bio-button") != undefined) {
        this.document.querySelectorAll(".bio-button").forEach((item) => {
            item.addEventListener("click", (event) => {
                // remove all of the classes
                document.querySelectorAll(".active").forEach((item) => {
                    item.classList.remove("active");
                });
                // add to parent list item
                item.parentElement.parentElement.classList.add("active");
                // add to corresponding description container
                let targetID = item.getAttribute("data-target");
                let target = document.getElementById(targetID);
                target.classList.add("active");
            });
        });
    }
    var boxE = document.querySelectorAll(".invisi-box");
    if (boxE != undefined) {
        boxE.forEach((item) => {
            item.addEventListener("mouseenter", (event) => {
                // remove all calsses first
                document.querySelectorAll(".hover-state").forEach((active) => {
                    active.classList.remove("hover-state");
                });
                // update
                item.parentElement.classList.add("hover-state");
                item.classList.add("hover-state");
            });
            item.addEventListener("mouseleave", (event) => {
                // remove all calsses first
                document.querySelectorAll(".hover-state").forEach((active) => {
                    active.classList.remove("hover-state");
                });
            });
        });
    }
});
