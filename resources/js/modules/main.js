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
    let showArea = $(this).attr('data-open');
    let type = $(this).attr('data-type');
    let form = $('.addBookForm');
    if(showArea != 'Add-Book'){
        form.find('input').val('');
        form.find('textarea').val('');
        form.find('select').val('default');
        form.find('img').attr('src','/img/emptyBook.png');
    }else{
        form.find('input[name=_token]').val($('meta[name="csrf-token"]').attr('content'));
    }


    $('.showWork').removeClass('active');
    $(this).addClass('active');

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


$(document).on('click','.searchCatalog', function () {
    let searchQuery = $('#filter-search').val();

    if($('.res-search-author').is(':visible')){
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
                    type: 'put',
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

    if(val === ""){
        curr.parent().find('.res-search-author').addClass('hide');
    }else{
        $.ajax({
            type:'post',
            url:'/searchAuthor',
            data:{
                name:val
            },
            success:function (res) {
                curr.parent().find('.res-search-author').removeClass('hide').html(res.view);
            }
        })
    }
})

$(document).on('click','.author-search-item',function(e){
        let curr = $(this);
        curr.parent().parent().find('input').val(curr.text());
        curr.parent().parent().find('.author-id').val(curr.attr('data-id'));
        curr.parent().addClass('hide');
})

$(document).on('submit','.addBookForm',function(e){
    if($('.res-search-author').is(':visible') ||  $('.author-name').val() === '' ){
        $('.res-search-author').addClass('hide');
        $('.author-name').val('');
        popup.fire({
            title:'Виберіть автора'
        });
        e.preventDefault();
    }
});


$(document).on('change', '.bookImg-add', function (e) {
    let a = $('#add-book-img')[0].files[0];
    $(this).parent().find('img').attr('src', URL.createObjectURL(a));
})

$(document).on('click','.book-btn-edit',function (e) {
        let el = $(e.currentTarget);
        if(el.hasClass('book-btn-edit')){
            let id = el.attr('data-id');
            $.ajax({
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'/bookInfo',
                data:{id:id},

                success:function(res){
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
                    form.find('img').attr('src','/storage/bookImg/'+book.img);
                    $('.admin-addBook').trigger('click');
                }
            })
        }

})

$(document).on('click','.btn-remove-content',function (e) {
    let curr = $(this);
    let id = $(this).attr('data-id');
    let type = $(this).attr('data-type');
    let title,err,success;

    if(type === 'book'){
        title = "Видалити книжку?"
        err = "Не вдалося видалити книжку"
        success = 'Книжку видалено'
    }else{
        title = "Видалити коментар?"
        err = "Не вдалося видалити коментар"
        success = 'Коментар видалено'
    }
        popup.fire({
            title:title,
            icon: "warning",
            buttons: true,
            showCancelButton: true,
        }).then(function(data){
                if(data.value){
                    $.ajax({
                        type:"delete",
                        url:'/deleteBook',
                        data:{
                            id:id,
                            type:type
                        },
                        success:function(res){
                            if(res.delete){
                                curr.parent().remove()
                                    popup.fire({
                                        title:success
                                    })
                            }else{
                                    popup.fire({
                                        title:err
                                    })
                            }
                        }
                    })
                }
        })


})


