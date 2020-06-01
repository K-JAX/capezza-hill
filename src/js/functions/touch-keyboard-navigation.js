/**
 * Touch & Keyboard navigation.
 *
 * Contains handlers for touch devices and keyboard navigation.
 */

(function () {
    function burgerClick() {
        var burger = document.querySelectorAll(".burger")[0];
        var mainMenu = document.getElementById("menu-primary");
		var contentArea = document.getElementById("primary");
		var search = document.querySelectorAll('.search-area')[0];
        burger.addEventListener("click", function () {
            if (this.matches(".active")) {
                this.classList.remove("active");
                mainMenu.classList.remove("open");
				contentArea.classList.remove("menu-is-active");
				search.classList.remove("menu-is-active");
                this.setAttribute("aria-expanded", "false");
            } else {
                this.classList.add("active");
                mainMenu.classList.add("open");
				contentArea.classList.add("menu-is-active");
				search.classList.add("menu-is-active");
                this.setAttribute("aria-expanded", "true");
            }
        });
    }
    burgerClick();
})();

// function reportWindowSize(){

// 	if(window.innerWidth < 766){
// 		console.log('Window is tablet or smaller ' + window.innerWidth);
// 	}

// }

// window.onresize = reportWindowSize;

// sub-menu functionality
var menuItems = document.querySelectorAll("li.menu-item-has-children");
Array.prototype.forEach.call(menuItems, function (el, i) {
    addExpandEvent(el, "click");
    addExpandEvent(el, "mouseenter");
    addExpandEvent(el, "mouseleave");
});

var hideTimer;

function addExpandEvent(el, e) {
    var btn = el.querySelector("button"),
        sub = el.querySelector(".sub-menu"),
        anchor = el.querySelector("a"),
        eventClass,
        eventEl;

    if (e != "click") {
        eventEl = el;
        eventClass = "hover";
    } else {
        eventEl = btn;
        eventClass = "focus";
    }

    eventEl.addEventListener(e, function (event) {
        // if the window is tablet/mobile size don't accept hover events
        if (window.innerWidth >= 767 || e == "click") {
            if (!el.matches(".open")) {
                el.classList.add("open");
                show(sub, eventClass);
                anchor.setAttribute("aria-expanded", "true");
                btn.setAttribute("aria-expanded", "true");
            } else if (e !== "mouseenter") {
                el.classList.remove("open");
                hide(sub, eventClass);
                anchor.setAttribute("aria-expanded", "false");
                btn.setAttribute("aria-expanded", "false");
            }
            event.preventDefault();
        }
    });
}

function show(el, eventClass) {
    //   get the natural height of the element
    clearTimeout(hideTimer);

    var classes = ["is-visible", eventClass];

    var getHeight = function () {
        el.style.display = "block"; // Make it visible
        var height = el.scrollHeight + "px"; //Get it's height

        el.style.display = "";
        return height;
    };
    var height = getHeight(); // Get the natural height

    el.classList.add(...classes); //make the element visible
    el.style.height = height; // update the max-height

    // once the transition is complete, remove the inline max-height so the content can scale responsively
    window.setTimeout(function () {
        el.style.height = "";
    }, 250);
}

function hide(el, eventClass) {
    //   give the element a height to change from
    el.style.height = el.scrollHeight + "px";

    var classes = ["is-visible", eventClass];

    //   set the height back to 0
    window.setTimeout(function () {
        el.style.height = "0";
    }, 1);

    //   when the transition is copmlete, hide it
    hideTimer = window.setTimeout(function () {
        el.classList.remove(...classes);
    }, 500);
}

