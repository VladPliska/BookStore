let showAllFilter = document.getElementById('showAllFilter');
let mainFilter = document.getElementById('mainFilter');
if (showAllFilter != null) {
    showAllFilter.addEventListener('click', function () {          //for animation show main filter
        mainFilter.style.display = "grid";
        window.setTimeout(function () {
            mainFilter.classList.toggle("active")
        }, 0)

    });
}


// let adminNav = document.getElementsByClassName('showWork');
//
// for (let i = 0; adminNav.length > i; i++) {
//     adminNav[i].addEventListener('click', showAdminWorkSpace);
//     console.log(adminNav[i]);
// }
$(document).on('click', '.showWork', function (e) {
    console.log($(this));
    let showArea = $(this).attr('data-open');
    let type = $(this).attr('data-type');

    $('.showWork').removeClass('active');
    $(this).addClass('active');

    $('.tab').addClass('hide');
    $('[data-target=' + showArea + ']').removeClass('hide');
    $.ajax({
        type: "post",
        url: "/getAdminInfo",
        data: {type},
        success: function (res) {
            console.log(res);
            if (res.setData != 'none') {
                console.log($('.' + res.setData));
                $('.' + res.setData).html(res.view);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });


});

// function showAdminWorkSpace(e) {
//     let showArea = e.target.getAttribute('data-open');
//     let type = e.target.getAttribute('data-type');
// // e.target.classList.add('active')
//     for (let i = 0; adminNav.length > i; i++) {
//         adminNav[i].classList.remove('active');
//         if (adminNav[i].getAttribute('data-open') == showArea) {
//             adminNav[i].classList.add('active');
//         }
//         console.log(type);
//
//     }
//
//     let adminWorkSpace = document.querySelectorAll('.admin-workspace .tab');
//     for (let a = 0; adminWorkSpace.length > a; a++) {
//         adminWorkSpace[a].classList.add('hide');
//         if (adminWorkSpace[a].getAttribute('data-target') == showArea) {
//             adminWorkSpace[a].classList.remove('hide');
//         }
//     }
// }

$('.searchCatalog').on('click', function () {
    let searchQuery = $('#filter-search').val();
    let mainFilter = $('#mainFilter');
    let filterOn = false;
    let filterInfo = null;
    let sortBy;


    if (mainFilter.hasClass('active')) {
        filterOn = true;
        if ($('#sort-up')[0].checked)
            sortBy = 'asc';
        else if ($('#sort-down')[0].checked)
            sortBy = 'desc';
        else
            sortBy = null;


        filterInfo = {
            'genre': $('#ganre-select').val(),
            'author': $('.author-name').val(),
            'min-price': $('.minPrice').text(),
            'max-price': $('.maxPrice').text(),
            'sort': sortBy

        }
    }

    $.ajax({
        method: "POST",
        url: "searchCatalog",
        data: {
            'query': searchQuery,
            'filter': filterOn,
            'filterInfo': filterInfo
        },
        success: function (res) {
            $('.result-search').html(res.view);
        }
    })

});

///add comment
$(document).on('click', '.add-comment', function (e) {
    let text = $("#bookComment").val();
    let id = $(this).attr('data-id');
    let userId = 1;

    $.ajax({
        type: "post",
        url: '/addComment',
        data: {
            'text': text,
            'book': id,
            'user': userId,
            'live':true,
        },
        success: function (res) {
            if (res.commented) {
                $('.all-comment-block').find('.emptyComment').remove();
                $('.all-comment-block').append(res.body);
            } else {
                alert('err');

            }
        }
    });

});

