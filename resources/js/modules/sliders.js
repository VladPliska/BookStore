import { tns } from "tiny-slider/src/tiny-slider";

let popularSlider = document.getElementsByClassName("slider-Popular");
let actionSlider = document.getElementsByClassName("slider-Action");
let rangeMin = document.getElementsByClassName("range-min");
let rangeMax = document.getElementsByClassName("range-max");

if (rangeMax[0] != null && rangeMin[0] != null) {
    rangeMax[0].addEventListener("input", function() {
        if (rangeMax[0].value - rangeMin[0].value >= 50) {
        document.getElementsByClassName("maxPrice")[0].innerHTML =rangeMax[0].value;
            let maxVal = rangeMax[0].value;
    }
    });
    rangeMin[0].addEventListener("input", function() {
        if (rangeMax[0].value - rangeMin[0].value >= 50) {
            let minVal = rangeMin[0].value;
            document.getElementsByClassName("minPrice")[0].innerHTML =rangeMin[0].value;
        }
    });
}

if (popularSlider.length > 0) {
    let slider1 = tns({
        container: ".slider-Popular",
        items: 1,
        slideBy: "page",
        autoplay: false,
        autoWidth: false,
        controlsPosition: "bottom",
        controlsText: ["<", ">"],
        mouseDrag: true,
        responsive: {
            320: {
                items: 1
            },
            450: {
                items: 2
            },
            1024: {
                items: 3
            }
        }
    });
}
if (actionSlider.length > 0) {
    let slider2 = tns({
        container: ".slider-Action",
        items: 1,
        slideBy: "page",
        autoplay: false,
        autoWidth: false,
        controlsPosition: "bottom",
        controlsText: ["<", ">"],
        mouseDrag: true,
        responsive: {
            320: {
                items: 1
            },
            450: {
                items: 2
            },
            1024: {
                items: 3
            }
        }
    });
}
let controllerSlider = document.getElementsByClassName(".tns-controls");
