$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
require('./bootstrap');
require('./modules/sliders');
require('./modules/main');
require('./modules/admin');

