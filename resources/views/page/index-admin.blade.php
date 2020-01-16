@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
   <div class="admin">
       <div class="admin-nav">
        <a href="" class="admin-addBook btn-nav active">Додати книжку</a>
        <a href="" class="admin-stats btn-nav ">Статистика</a>
        <a href="" class="admin-allBook btn-nav">Книжки</a>
        <a href="" class="admin-users btn-nav">Користувачі</a>
        <a href="" class="admin-comments btn-nav">Коментарі</a>
       </div>
       <div class="admin-workspace">
           <div class="tab-stats hide">
               <div class="info-1">
                    <div class="info-block">
                        <p>Всіх користувачів</p>
                        <h4>1000</h4>
                    </div>
                    <div class="info-block">
                        <p>Всіх книг</p>
                        <h4>1000</h4>
                    </div>
                    <div class="info-block">
                        <p>В клубі</p>
                        <h4>1000</h4>
                    </div>
               </div>
               <div class="info-2">
                   <div class="info-center info-block">
                    <p>Прибуток</p>
                    <h4>$10000</h4>
                   </div>
               </div>
               <div class="info-3">
                <div class="info-block">
                    <p>Всього покупок</p>
                    <h4>1000</h4>
                </div>
                <div class="info-block">
                    <p>Прибуток за місяць</p>
                    <h4>1000</h4>
                </div>
                <div class="info-block">
                    <p>Всіх коментарів</p>
                    <h4>1000</h4>
                </div>
               </div>
           </div>
           <div class="add-book hide">
               <div class="book-save">   
                    <div class="add-info-book">
                        <div class="info-block">
                            <label for="new-name-book">Назва: </label>
                            <input id = 'new-name-book' class="inpStan" type="text" placeholder="Назва книги"></input>
                        </div>
                        <div class="info-block">
                            <label for="new-author-book">Автор: </label>
                            <input id = 'new-author-book' class="inpStan" type="text" placeholder="Ім'я автора"></input>
                        </div>
                        <div class="info-block">
                            <label for="input-price">Ціна: </label>
                            <input type="number" class = "inpStan" id="input-price" placeholder="Ціна">
                        </div>
                        <div class="info-block">
                            <label for="create-select-ganre">Жанр: </label>
                                <select name="create-select-ganre" id="create-select-ganre">
                                    <option value="default">Виберіть жанр</option>
                                    <option value="">Фантастика</option>
                                    <option value="">Психологія</option>
                                </select>
                        </div>
                        <div class="info-block">
                            <label for="new-book">Опис: </label>
                            <textarea id = 'new-name-book' type="text" rows="5"  placeholder="Опис до книги" class="new-description-book"></textarea>
                        </div>
                        
                    </div>
                    <div class="imgBlock">
                        <input type="file" hidden id="add-book-img">
                        <img src="{{asset('img/emptyBook.png')}}" alt="" class="ce">
                        <label for="add-book-img" >Додати картинку</label>
                    </div>
               </div>
               <button class ="btn-g ce btnAddBook">Зберегти книжку</button>
           </div>
           <div class="admin-all-book hide">
               <div class="book-info">
                   <div class="admin-book-img">
                        <img src="{{asset('img/img.jpeg')}}" class ="small-book-img"alt="">
                   </div>
                   <div class="book-name">Назва</div>
                   <div class="book-author">Автор</div>
                   <div class="book-price">$1000</div>
                    <div class="book-btn-edit">Змінити</div>
                    <div class="book-btn-remove">Видалити</div>
               </div>
               <div class="book-info">
                    <div class="admin-book-img">
                        <img src="{{asset('img/img.jpeg')}}" class ="small-book-img"alt="">
                    </div>
                    <div class="book-name">Назва</div>
                    <div class="book-author">Автор</div>
                    <div class="book-price">$1000</div>
                    <div class="book-btn-edit">Змінити</div>
                    <div class="book-btn-remove">Видалити</div>
                </div>
                <div class="book-info">
                    <div class="admin-book-img">
                        <img src="{{asset('img/img.jpeg')}}" class ="small-book-img"alt="">
                    </div>
                    <div class="book-name">Назва</div>
                    <div class="book-author">Автор</div>
                    <div class="book-price">$1000</div>
                    <div class="book-btn-edit">Змінити</div>
                    <div class="book-btn-remove">Видалити</div>
                </div>
           </div>
           <div class="admin-all-users hide">
               <div class="user-list-title">
                    <div class="admin-user-avatar first">Фото</div>
                    <div class="admin-user-name">Ім'я</div>
                    <div class="admin user-email">Email</div>
                    <div class="admin-user-inclub">В клубі</div>
                    <div class="admin-user-block-title last">Блокування</div>        
                </div>
               <div class="user-list">
                   <div class="admin-user-avatar">
                        <img src="{{asset('img/avatar.png')}}" class="small-avatar-img" alt="">
                   </div>
                   <div class="admin-user-name">Ім'я</div>
                   <div class="admin user-email">Email</div>
                   <div class="admin-user-inclub">Так</div>
                   <div class="admin-user-block">Заблокувати</div>
               </div>
           </div>
           <div class="admin-all-coments">
               <div class="all-coments-title">
                   <div class="comment-name-book first">Назва книги</div>
                   <div class="comment-user-info">Користувач</div>
                   <div class="comment-text-admin">Текст</div>
                   <div class="comment-response-btn-title">Відповісти</div>
                   <div class="comment-remove-btn-title last">Видалити</div>
               </div>
               <div class="all-comments">
                    <div class="comment-name-book">Топ 1</div>
                    <div class="comment-info-user">
                        <img src="{{asset('img/avatar.png')}}" alt="" class ="forCommentsAdmin">
                        <span>Вася</span>
                    </div>
                    <div class="comment-text-admin">Супер книга!</div>
                    <div class="comment-response-btn">Відповісти</div>
                    <div class="comment-remove-btn">Видалити</div>
               </div>
           </div>

       </div>
    </div>

</div>

@include('.includes/footer') 