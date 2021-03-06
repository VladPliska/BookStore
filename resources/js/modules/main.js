'use strict'

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

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// let adminNav = document.getElementsByClassName('showWork');
//
// for (let i = 0; adminNav.length > i; i++) {
//     adminNav[i].addEventListener('click', showAdminWorkSpace);
//     console.log(adminNav[i]);
// }
$(document).on('click', '.showWork', function (e) {
    let showArea = $(this).attr('data-open');
    let type = $(this).attr('data-type');
    let form = $('.addBookForm');
    if (showArea != 'Add-Book') {
        form.find('input').val('');
        form.find('textarea').val('');
        form.find('select').val('default');
        form.find('img').attr('src', '/img/emptyBook.png');
    } else {
        form.find('input[name=_token]').val($('meta[name="csrf-token"]').attr('content'));
    }


    $('.showWork').removeClass('active');
    $(this).addClass('active');
    if ($(this).hasClass('admin-stats') || $(this).hasClass('admin-addBook')) {
        $('.searchAdminBlock').hide();
    } else {
        $('.searchAdminBlock').show();
        $('.searchAdminBlock').attr('data-search', showArea);
    }


    $('.tab').addClass('hide');
    $('[data-target=' + showArea + ']').removeClass('hide');
    $.ajax({
        type: "post",
        url: "/getAdminInfo",
        data: {type},
        success: function (res) {
            if (res.setData != 'none') {
                $('.' + res.setData).html(res.view);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });


});


$(document).on('click', '.searchCatalog', function () {
    let searchQuery = $('#filter-search').val();

    if ($('.res-search-author').is(':visible')) {
        $('.res-search-author').addClass('hide');
        $('.author-name').val('');
    }

    if (searchQuery == '') {
        popup.fire({
            title: 'Введіть назву книги для пошуку'
        });
    } else {
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
                'author': $('.author-id').val(),
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
    }


});

///add comment
$(document).on('click', '.add-comment', function (e) {

    let text = $("#bookComment").val();
    let id = $(this).attr('data-id');
    let userId = 1;

    if (text != '') {
        $.ajax({
            type: "post",
            url: '/addComment',
            data: {
                'text': text,
                'book': id,
                'user': userId,
                'live': true,
            },
            success: function (res) {
                if (res.commented) {
                    $('.all-comment-block').find('.emptyComment').remove();
                    $('.all-comment-block').append(res.body);
                    $("#bookComment").val('')
                } else {
                    popup.fire('Виникла помилка,спробуйте пізніше')
                }
            }
        });
    } else {
        popup.fire('Коментар не може бути порожнім!!')
    }
});

///add new news
$(document).on('click', '.addNews', function () {
    popup.fire({
        title: "Введіть текст новини:",
        html: "<textarea class='news-textarea' id='news'></textarea>",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        animation: "slide-from-top",
        inputPlaceholder: "Write something"
    }).then((res) => {
        if (res.value) {
            let text = $('#news').val();
            if (text != "") {
                $.ajax({
                    type: 'post',
                    url: '/addNews',
                    data: {
                        text: text
                    },
                    success: function (result) {
                        if (result.news) {
                            popup.fire('Успіх', 'Новину успішно додано', 'success')
                            popup.fire('Успіх', 'Новину успішно додано', 'success')
                        } else {
                            popup.fire('Помилка', 'Помилка під час додавання новини,спробуйте пізніше', 'error')

                        }
                    }
                })
            }
        }
    })
});
/////

//add Author
$(document).on('click', '.addAuthor', function () {
    popup.fire({
        title: "Введіть ім'я автора:",
        html: "<textarea class='news-textarea' id='news'></textarea>",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        animation: "slide-from-top",
        inputPlaceholder: "Write something"
    }).then((res) => {
        if (res.value) {
            let text = $('#news').val();
            if (text != "") {
                $.ajax({
                    type: 'post',
                    url: '/addAuthor',
                    data: {
                        text: text
                    },
                    success: function (result) {
                        if (result.news) {
                            popup.fire('Успіх', 'Автора успішено додано', 'success')
                        } else {
                            popup.fire('Помилка', 'Помилка під час додавання автора,спробуйте пізніше', 'error')
                        }
                    }
                })
            }
        }
    })
});

/////

$(document).on('click', '.avatar-header', function () {
    $('.login-area').toggleClass('active');
});

$(document).on('click', '.btnFilter', function () {
    let type = $(this).attr('data-type');
});

$(document).on('change', '.addImg-profile', function (e) {
    let a = document.getElementById('img-avatar').files[0];
    $('.user-avatar').find('img').attr('src', URL.createObjectURL(a));
})


$(document).on('click', '.admin-user-block', function (e) {
    let id = $(this).attr('data-id');
    let curr = $(this);
    $.ajax({
        type: "post",
        url: '/ban',
        data: {id: id},
        success: function (res) {
            if (res.ban) {
                curr.text('Розблокувати').addClass('msg-err');

            } else {
                curr.text('Заблокувати').addClass('msg-suc');
            }
        }
    });
})


$('.author-name').on('keyup', function (e) {
    let curr = $(this);
    let val = curr.val();

    if (val === "") {
        curr.parent().find('.res-search-author').addClass('hide');
    } else {
        $.ajax({
            type: 'post',
            url: '/searchAuthor',
            data: {
                name: val
            },
            success: function (res) {
                curr.parent().find('.res-search-author').removeClass('hide').html(res.view);
            }
        })
    }
})

$(document).on('click', '.author-search-item', function (e) {
    let curr = $(this);
    curr.parent().parent().find('input').val(curr.text());
    curr.parent().parent().find('.author-id').val(curr.attr('data-id'));
    curr.parent().addClass('hide');
})

$(document).on('submit', '.addBookForm', function (e) {
    if ($('.res-search-author').is(':visible') || $('.author-name').val() === '') {
        $('.res-search-author').addClass('hide');
        $('.author-name').val('');
        popup.fire({
            title: 'Виберіть автора'
        });
        e.preventDefault();
    }
});


$(document).on('change', '.bookImg-add', function (e) {
    let a = $('#add-book-img')[0].files[0];
    $(this).parent().find('img').attr('src', URL.createObjectURL(a));
})

$(document).on('click', '.book-btn-edit', function (e) {
    let el = $(e.currentTarget);
    if (el.hasClass('book-btn-edit')) {
        let id = el.attr('data-id');
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/bookInfo',
            data: {id: id},

            success: function (res) {
                let form = $('.addBookForm');
                let book = res.info;
                form.find('.addType').val(id);
                form.find('input[name=_token]').val($('meta[name="csrf-token"]').attr('content'));
                form.find('#new-name-book').val(book.title);
                form.find('#new-author-book').val(book.authorname);
                form.find('.author-id').val(book.author_id);
                form.find('#create-select-ganre').val(book.genre_id)
                form.find('#new-description-book').val(book.description);
                form.find('#book-price').val(book.price);
                form.find('img').attr('src', book.img);
                if (book.action > 0) {
                    form.find('#book-action')[0].checked = true;
                    form.find('.action-price').val(book.action).addClass('active');

                }
                $('.admin-addBook').trigger('click');
            }
        })
    }

})

$(document).on('click', '.btn-remove-content', function (e) {
    let curr = $(this);
    let id = $(this).attr('data-id');
    let type = $(this).attr('data-type');
    let title, err, success;

    if (type === 'book') {
        title = "Видалити книжку?"
        err = "Не вдалося видалити книжку"
        success = 'Книжку видалено'
    } else {
        title = "Видалити коментар?"
        err = "Не вдалося видалити коментар"
        success = 'Коментар видалено'
    }
    popup.fire({
        title: title,
        icon: "warning",
        buttons: true,
        showCancelButton: true,
    }).then(function (data) {
        if (data.value) {
            $.ajax({
                type: "delete",
                url: '/deleteBook',
                data: {
                    id: id,
                    type: type
                },
                success: function (res) {
                    if (res.delete) {
                        curr.parent().remove()
                        popup.fire({
                            title: success
                        })
                    } else {
                        popup.fire({
                            title: err
                        })
                    }
                }
            })
        }
    })


})

$(document).on('click', '.buyBook', function (e) {
    let id = $(this).attr('data-id');
    let other = getCookie('basket');
    let allProduct = localStorage.getItem('products');

    if (other) {
        let data = other.split(',');
        if (data.indexOf(id) != -1) {
            popup.fire({
                title: "Книжка вже в кошику"
            })
            return
        }
        let info = JSON.parse(allProduct);
        info.push({
            id: id,
            count: 1
        });
        localStorage.setItem('products', JSON.stringify(info));

        other += ',' + id;
    } else {
        other = id;
        let data = [
            {
                id: id,
                count: 1,
            }
        ]
        localStorage.setItem('products', JSON.stringify(data));
    }

    document.cookie = 'basket=' + other + ';path=/';

    let count = parseInt($('.countBasket').text());
    $('.countBasket').text(count + 1);
    popup.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Товар додано в кошик',
        showConfirmButton: false,
        timer: 1000
    })

})

$(document).on('change', '#book-action', function () {
    $('.action-price').toggleClass('active');
    if ($('#book-action')[0].checked) {
        $('.action-price').attr('required', '');
    } else {
        $('.action-price').removeAttr('required').val('')
    }
})

$(document).on('click', '.removeInBasket', function (e) {
    e.preventDefault();
    $(this).closest('.book-section').remove();

    let id = $(this).attr('data-id');

    let basket = getCookie('basket');

    basket = basket.split(',');
    let newBasket = [];
    basket.map((e) => {
        if (e != id) {
            newBasket.push(e);
        }
    });
    document.cookie = 'basket=' + newBasket.toString() + ';path=/';

    let local = JSON.parse(localStorage.getItem('products'));

    local.map((el, k) => {
        if (el.id == id) {
            local.splice(k, 1);
        }
    })

    localStorage.setItem('products', JSON.stringify(local));

    $('.bookSelectId[value=' + id + ']').remove();
    $('.productCount[data-id=' + id + ']').remove();


    let count = parseInt($('.countBasket').text());
    $('.countBasket').text(count - 1);


})

// $(document).ready(function(e){
//     // localStorage.setItem('data',);
//     let data = localStorage.getItem('all')
//     console.log(data['item'])
//     // for(let key in data){
//     //     console.log(key[]);
//     // }
// })

$(document).on('click', '.buy-basket', function (e) {
    e.preventDefault();
    let curr = $(this)

    if (curr.parent().find('input').length >= 1) {
        let data = JSON.parse(localStorage.getItem('products'));

        data.map(el => {
            curr.parent().append('<input type="text" class="productCount" hidden data-id="' + el.id + '" name="count[]" value="' + el.count + '">');
        })
        document.cookie = 'basketNew=' + JSON.stringify(data);

        curr.parent().submit();
    } else {
        popup.fire({
            title: 'Спочатку виберіть твар щоб зробити замовлення'
        })
    }
})


$(document).on('input', '.total-buy', function (e) {

    let id = $(this).attr('data-id');
    let value = $(this).val() || 0;

    let item = JSON.parse(localStorage.getItem('products'));

    item.map((val) => {
            if (val.id == id) {
                val.count = parseInt(value);
            }
        }
    )

    localStorage.setItem('products', JSON.stringify(item))
    $('.productCount').remove();
})

$('.logoutUser').click(function (e) {
    $.ajax({
        type: 'POST',
        url: '/logout',
        success: function (res) {
            location.reload()
        }
    })
})

$(document).ready(function (e) {
    if (location.pathname == '/buy') {
        let data = JSON.parse(localStorage.getItem('products'));
        data.map(v => {
            v.count = 1
        })

        localStorage.setItem('products', JSON.stringify(data));
    }
    if (location.hash == '#createOrder') {
        localStorage.clear();
        popup.fire({
            icon: 'success',
            title: 'Замовлення успішно створенно,через деякий час з вами зявжеться наш оператор для уточнення деталей'
        })
        window.history.replaceState(null, null, '/')
    }
})


$(document).on('click', '.book-card', function (e) {
    let target = $(e.target);
    let curr = $(this);
    if (target.hasClass('buyBook')) {
        e.preventDefault();
    }
})


$('.admin-orders').click(function (e) {
    if ($('.list-orders').find('div').length == 0) {
        $.ajax({
            type: 'POST',
            url: '/getAllOrders',
            success: (res) => {
                $('.list-orders').html(res.view);
            }
        })
    }
})

$(document).on('click', '.item-order', function (e) {
    if (!$(e.target).hasClass('updateAuthor') || !$(e.target).hasClass('removeAuthor')) {
        let id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: '/getOrder',
            data: {
                id: id
            },
            success: (res) => {
                $('.pib-order').text(res.order.firstname + " " + res.order.lastname);
                $('.phone-order').text(res.order.phone);
                $('.email-order').text(res.order.email);
                $('.city-order').val(res.order.city);
                $('.paymethod-order').text(res.order.payType);
                $('.post-order').text(res.order.post);
                $('.body-order-item').html(res.view);
                $('.orderDetail-title').first().text('Замовлення №' + res.order.id)
                $('.order-price').text('Ціна ' + res.order.price + "грн.")
                $('#status').val(res.order.status)
                $('.changeStatusBtn').attr('data-id', res.order.id);

                $('.list-orders').addClass('hide');
                $('.header-list-order').addClass('hide');
                $('.selectOrder').toggleClass('hide');
            }
        })
    }

})
$(document).on('click', '.all-orders-show', function (e) {
    $('.list-orders').removeClass('hide');
    $('.header-list-order').removeClass('hide');
    $('.selectOrder').toggleClass('hide');
})

$(document).on('click', '.changeStatusBtn', function () {
    let id = $(this).attr('data-id');
    let status = $(this).parent().find('select').val();

    $.ajax({
        type: 'POST',
        url: "/changeStatus",
        data: {
            id: id, status
        },
        success: (res) => {
            if (res.success) {
                popup.fire({
                    title: 'Статус змінено',
                    icon: "success"
                })
            }
        }
    })
})

$(document).on('click', '.admin-authors', function (e) {

    $.ajax({
        type: 'post',
        url: '/getAuthors',
        success: function (res) {
            $('.list-author').html(res.view)
        }
    })

})

$(document).on('click', '.updateAuthor,.removeAuthor', function (e) {
    let curr = $(this);
    let name = $(this).parent().find('.nameAuthor').text();
    let id = $(this).attr('data-id');
    if ($(this).hasClass('remove')) {
        let curr = $(this).parent();
        $.ajax({
            type: 'post',
            url: '/changeAuthor',
            data: {
                delete: true,
                id: id
            },
            success: (res) => {
                if (res.change) {
                    curr.remove();
                    popup.fire('Успіх', 'Автор видалений', 'success')
                } else {
                    if (res.message) {
                        popup.fire('Помилка', res.message, 'error')
                    } else {
                        popup.fire('Помилка', 'Невдалося оновити автора', 'error')
                    }
                }
            }
        })
    } else {
        let html = '<textarea class=\'news-textarea\' id=\'news\'>' + name + '</textarea>';
        popup.fire({
            title: "Зміна імені автора.",
            showCancelButton: true,
            html: html,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        }).then((res) => {
            if (res.value) {
                let text = $('#news').val();
                if (text != "") {
                    $.ajax({
                        type: 'post',
                        url: '/changeAuthor',
                        data: {
                            delete: false,
                            name: text,
                            id: id
                        },
                        success: (res) => {
                            if (res.change) {
                                curr.parent().find('.nameAuthor').text(text);
                                popup.fire('Успіх', 'Дані оновленно', 'success')
                            } else {
                                if (res.message) {
                                    popup.fire('Помилка', res.message, 'error')
                                } else {
                                    popup.fire('Помилка', 'Невдалося оновити автора', 'error')
                                }
                            }
                        }
                    })
                }
            }
        })

    }


})

$(document).on('click', '.searchAdminBtn', function (e) {
    let search = $(this).parent().attr('data-search');
    let searchData = '';
    if (search === 'All-Author') {
        searchData = 'author';
    } else if (search === 'All-Orders') {
        searchData = 'order';
    } else if (search === 'All-Comment') {
        searchData = 'comment';
    } else if (search === 'All-Book') {
        searchData = 'book';
    } else if (search === 'All-User') {
        searchData = 'user';
    }
    let text = $(this).parent().find('input').val();

    $.ajax({
        type: 'POST',
        url: '/searchAdmin',
        data: {
            text: text,
            search: searchData
        },
        success: (res) => {
            switch (search) {
                case 'All-Author':
                    if(res.view === ''){
                        $('.admin-all-author').find('.list-author').html('<h2 style="text-align: center;padding: 20px;">Нічого не знайдено</h2>');
                    }else{
                        $('.admin-all-author').find('.list-author').html(res.view);
                    }
                    break;
                case 'All-Orders':
                    if(res.view === ''){
                        $('.admin-all-order').find('.list-orders').html('<h2 style="text-align: center;padding: 20px;">Нічого не знайдено</h2>');
                    }else{
                        $('.admin-all-order').find('.list-orders').html(res.view);
                    }
                    break;
                case 'All-Comment':
                    if(res.view === ''){
                        $('.admin-all-coments').find('.all-comments').html('<h2 style="text-align: center;padding: 20px;">Нічого не знайдено</h2>');
                    }else{
                        $('.admin-all-coments').find('.all-comments').html(res.view);
                    }
                    break;
                case 'All-Book':
                    if(res.view === '') {
                        $('.admin-all-book').html('<h2 style="text-align: center;padding: 20px;">Нічого не знайдено</h2>');
                    }else{
                        $('.admin-all-book').html(res.view);
                    }
                    break;
                case 'All-User':
                    if(res.view === '') {
                        $(document).find('.user-append').html('<h2 style="text-align: center;padding: 20px;">Нічого не знайдено</h2>');
                    }else{
                        $(document).find('.user-append').html(res.view);
                    }
                    break;
            }
        }
    })
    $(this).parent().find('input').val('');
})
