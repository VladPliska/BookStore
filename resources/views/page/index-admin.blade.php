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
           <div class="add-book">
            <span class="add-book-title">Додати книжку</span>
            <div class="add-info-book">
                <div class="info-block">
                    <label for="new-name-book">Назва</label>
                    <input id = 'new-name-book'type="text"></input>
                </div>
                <div class="info-block">
                    <label for="new-name-book">Назва</label>
                    <input id = 'new-name-book'type="text"></input>
                </div>
                
            </div>
           </div>

       </div>
    </div>

</div>

@include('.includes/footer') 