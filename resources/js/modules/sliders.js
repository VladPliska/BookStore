import { tns } from "tiny-slider/src/tiny-slider"

let popularSlider = document.getElementsByClassName('slider-Popular');
let actionSlider = document.getElementsByClassName('slider-Action');

if(popularSlider.length > 0){
let slider1 = tns({
    container:'.slider-Popular',
    items:1,
    slideBy:'page',
    autoplay:false,
    autoWidth:false,
    controlsText:["<",">"],
    mouseDrag:true,
    responsive:{
        320:{
            items:1
        },
        450:{
            items:2
        },
        1024:{
            items:3
        }
    }
});
}
if(actionSlider.length > 0 ){
let slider2 = tns({
    container:'.slider-Action',
    items:1,
    slideBy:'page',
    autoplay:false,
    autoWidth:false,
    controlsText:["<",">"],
    mouseDrag:true,
    responsive:{
        320:{
            items:1
        },
        450:{
            items:2
        },
        1024:{
            items:3
        }
    }
});
}
let controllerSlider = document.getElementsByClassName('.tns-controls');

