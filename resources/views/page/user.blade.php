@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    <div class="user-page">
        <div class="all-order">
            <div class="title-order">Всі замовлення</div>
            <div class="title-for-orders">
                <div class="num-order">Номер</div>
                <div class="count-book-order">Кількість</div>
                <div class="date-order">Дата</div>
                <div class="price-order">Ціна</div>
            </div>
             <div class="order-item">
                <div class="num-order">1</div>
                <div class="count-book-order">12</div>
                <div class="date-order">12.12.2020</div>
                <div class="price-order">$100</div>

            </div>
        </div>
        <div class="user-coments">
            <div class="my-coments-title">Мої коментарі</div>
            <div class="all-my-comment">
                    <div class="user-comment-block">
                        <div class="icon-avatar">
                            <img src="{{asset('img/avatar.png')}}"  class = "avatar-for-comment" alt="">
                        </div>
                        <div class="info-comment" style="display:flex;align-items:center">
                            <div class="text-comment">Test comment</div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

@include('.includes/footer') 