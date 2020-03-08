$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
window.popup = require("sweetalert2/dist/sweetalert2.min.js");


require('./bootstrap');
require('./modules/sliders');
require('./modules/main');
