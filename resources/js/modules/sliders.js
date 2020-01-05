import { tns } from "tiny-slider/src/tiny-slider"

let slider1 = tns({
    container:'.slider-Popular',
    items:1,
    slideBy:'page',
    autoplay:false,
    autoWidth:false,
    controlsPosition:"bottom",
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
let slider2 = tns({
    container:'.slider-Action',
    items:1,
    slideBy:'page',
    autoplay:false,
    autoWidth:false,
    controlsPosition:"bottom",
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
