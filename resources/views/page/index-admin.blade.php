@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
   <div class="admin">
       <div class="admin-nav">
        <a href="javascript:;" class="admin-stats btn-nav showWork active " data-open="Statistic">Статистика</a>
        <a href="javascript:;" class="admin-addBook btn-nav showWork" data-open="Add-Book">Додати книжку</a>
        <a href="javascript:;" class="admin-allBook btn-nav showWork" data-open="All-Book">Книжки</a>
        <a href="javascript:;" class="admin-users btn-nav showWork" data-open="All-User">Користувачі</a>
        <a href="javascript:;" class="admin-comments btn-nav showWork" data-open="All-Comment">Коментарі</a>
       </div>
       <div class="admin-workspace">
           <div class="tab-stats tab" data-target="Statistic">
               <div class="info-1">
                    <div class="info-block">
                        <p>Всіх користувачів</p>
                        <h4>{{$user}}</h4>
                    </div>
                    <div class="info-block">
                        <p>Всіх книг</p>
                        <h4>{{$book}}</h4>
                    </div>
                    <div class="info-block">
                        <p>В клубі</p>
                        <h4>{{$club}}</h4>
                    </div>
               </div>
               <div class="info-2">
                   <div class="info-center info-block">
                    <p>Прибуток</p>
                    <h4>{{$profit}} грн</h4>
                   </div>
               </div>
               <div class="info-3">
                <div class="info-block">
                    <p>Всього покупок</p>
                    <h4>{{$orders}}</h4>
                </div>
                <div class="info-block">
                    <p>Прибуток за місяць</p>
                    <h4>{{$priceMonth}} грн</h4>
                </div>
                <div class="info-block">
                    <p>Всіх коментарів</p>
                    <h4>{{$coment}}</h4>
                </div>
               </div>
           </div>
           <div class="add-book hide tab" data-target="Add-Book">
               <form action="/addBook" method="POST"  enctype="multipart/form-data">
                @csrf
               <div class="book-save">
                    <div class="add-info-book">
                        <div class="info-block">
                            <label for="new-name-book">Назва: </label>
                            <input id = 'new-name-book' name="nameBook" class="inpStan" type="text" placeholder="Назва книги"></input>
                        </div>
                        <div class="info-block">
                            <label for="new-author-book">Автор: </label>
                            <input id = 'new-author-book' name="authorName" class="inpStan" type="text" placeholder="Ім'я автора"></input>
                        </div>
                        <div class="info-block">
                            <label for="input-price">Ціна: </label>
                            <input type="number" name = "price" class = "inpStan" id="input-price" placeholder="Ціна">
                        </div>
                        <div class="info-block">
                            <label for="create-select-ganre">Жанр: </label>
                                <select name="create-select-ganre" id="create-select-ganre">
                                    <option value="default">Виберіть жанр</option>
                                    <option value="Фантастика">Фантастика</option>
                                    <option value="Психологія">Психологія</option>
                                </select>
                        </div>
                        <div class="info-block">
                            <label for="new-book">Опис: </label>
                            <textarea id = 'new-name-book' name="description" type="text" rows="5"  placeholder="Опис до книги" class="new-description-book"></textarea>
                        </div>

                    </div>
                    <div class="imgBlock">
                        <input type="file" hidden id ="add-book-img" name="image"  accept="image/x-png,image/gif,image/jpeg">
                        <img src="{{asset('img/emptyBook.png')}}" alt="" class="ce">
                        <label for="add-book-img">Додати картинку</label>
                    </div>
               </div>
               <button class ="btn-g ce btnAddBook" type="submit">Зберегти книжку</button>
            </form>
           </div>
           <div class="admin-all-book hide tab" data-target="All-Book">
             @include('includes.book-item-list',['data'=>$listBook])
           </div>
           <div class="admin-all-users hide tab" data-target="All-User">
               <div class="user-list-title">
                    <div class="admin-user-avatar first">Фото</div>
                    <div class="admin-user-name">Ім'я</div>
                    <div class="admin user-email">Email</div>
                    <div class="admin-user-inclub">В клубі</div>
                    <div class="admin-user-block-title last">Блокування</div>
                </div>
               <div class="user-list">
                    @include('includes.user-item-list',['data'=>$listUser])
               </div>
           </div>
           <div class="admin-all-coments hide tab" data-target ="All-Comment">
               <div class="all-coments-title">
                   <div class="comment-name-book first">Назва книги</div>
                   <div class="comment-user-info">Користувач</div>
                   <div class="comment-text-admin">Текст</div>
                   <div class="comment-response-btn-title">Відповісти</div>
                   <div class="comment-remove-btn-title last">Видалити</div>
               </div>
               <div class="all-comments">

               </div>
           </div>

       </div>
       <button class ="btn-g ce addNews">Додати новину</button>
    </div>

</div>

@include('.includes/footer')
