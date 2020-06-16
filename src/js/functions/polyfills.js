// site polyfills

// check if foreach is supported
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach;
}
// check if .matches() is supported
if (!Element.prototype.matches) {
    Element.prototype.matches =
        Element.prototype.msMatchesSelector ||
        Element.prototype.webkitMatchesSelector;
}

// check if object.assign is supported
if (typeof Object.assign !== "function") {
    // Must be writable: true, enumerable: false, configurable: true
    Object.defineProperty(Object, "assign", {
        value: function assign(target, varArgs) {
            // .length of function is 2
            "use strict";
            if (target === null || target === undefined) {
                throw new TypeError(
                    "Cannot convert undefined or null to object"
                );
            }

            var to = Object(target);

            for (var index = 1; index < arguments.length; index++) {
                var nextSource = arguments[index];

                if (nextSource !== null && nextSource !== undefined) {
                    for (var nextKey in nextSource) {
                        // Avoid bugs when hasOwnProperty is shadowed
                        if (
                            Object.prototype.hasOwnProperty.call(
                                nextSource,
                                nextKey
                            )
                        ) {
                            to[nextKey] = nextSource[nextKey];
                        }
                    }
                }
            }
            return to;
        },
        writable: true,
        configurable: true,
    });
}
// check if CSS Transforms on SVG elements is supported
const supportsCSSTransformsOnSVG = (() => {
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 2 2");
    Object.assign(svg.style, {
        position: "absolute",
        top: 0,
        left: 0,
        width: "2px",
        height: "2px",
    });
    svg.innerHTML =
        '<rect width="1" height="1" style="transform: translate(1px, 1px)"/>';
    document.body.appendChild(svg);
    const result = document.elementFromPoint(1, 1) !== svg;
    svg.parentNode.removeChild(svg);
    return result;
})();

export default supportsCSSTransformsOnSVG;
