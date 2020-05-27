@include('./includes/head')
<div class="container">
    @include('./layout/header')
    <div class="content-container">


        {{--    @dd($user)--}}
        <form action="/createOrder" method="POST">
            @csrf
            <div class="buy-page">
                <div class="post-order-info">
                    <div class="select-post">
                        <h2 class="title-select-post title">Виберіть спосіб доставки</h2>
                        <div>
                            <input type="radio" name="post" id="new-post" class="new-post post" value="Нова пошта"
                                   required><label
                                for="new-post">Нова пошта (50грн)</label>
                        </div>
                        <div>
                            <input type="radio" name="post" id="ukr-post" class="ukr-post post" value="Укрпошта"
                                   required><label
                                for="ukr-post">Укрпошта (45грн)</label>
                        </div>
                        <div>
                            <input type="radio" name="post" id="mist" class="mistExpress post" value="Містекспрес"
                                   required><label
                                for="mist">Містекспресс (45грн)</label>
                        </div>
                    </div>
                    <div class="select-type-pay">
                        <h2>Виберіть спосіб оплати</h2>
                        <div>
                            <input type="radio" name="type-pay" id="start-pay" class="post type-pay" value="Предоплата"
                                   required><label
                                for="start-pay">Предоплата</label>
                        </div>
                        <div>
                            <input type="radio" name="type-pay" id="after-order" class="post type-pay" value="Оплата при отриманні"
                                   required><label
                                for="after-order">Оплата при отримані</label>
                        </div>
                    </div>
                </div>
                <div class="info-client">
                    <h2>Контактні дані</h2>
                    @if(!$user)
                        <input type="text" name="name" placeholder="Ім'я" required><br>
                        <input type="text" name="surname" placeholder="Прізвище" required><br>
                        <input type="number" name="number" placeholder="Номер телефону" required><br>
                        <input type="text" name="email" placeholder="Email" required><br>
                        <input type="text" class='city-select' name="city" placeholder="Населений пункт" required><br>
                        <div class="hide res-city"></div>
                    @else
                        <input type="text" name="name" placeholder="Ім'я" value="{{$user->lastname ?? ''}}" required>
                        <br>
                        <input type="text" name="surname" placeholder="Прізвище" value="{{$user->firstname ?? ''}}"
                               required><br>
                        <input type="number" name="number" placeholder="Номер телефону" value="{{$user->phone ?? ''}}"
                               required><br>
                        <input type="text" name="email" placeholder="Email" value="{{$user->email ?? ''}}" required><br>
                        <input type="text" class='city-select' name="city" placeholder="Населений пункт" required><br>
                        <div class="hide res-city"></div>
                    @endif
                </div>
            </div>
            <h2 class="titleOrder">Ваше замовлення</h2>
            <div class="order-select-book">
                <div class="item">
                    <h3>Картинка</h3>
                    <h3 class="name">Назва</h3>
                    <h3 class="count">Кількість</h3>
                    <h3 class="price">Ціна за 1 книжку</h3>
                    <h3 class="priceCount">Ціна за всі книжки</h3>
                </div>
                @foreach($books as $k=>$v)
                    <div class="item">
                        <img src="/storage/bookImg/{{$v->img}}" class="orderImg" alt="">
                        <div class="name">{{$v->title}}</div>
                        <div class="count">{{$v->count}}</div>
                        <div class="price">{{$v->price}}</div>
                        <div class="priceCount">{{($v->price) * $v->count}}</div>
                    </div>
                @endforeach
            </div>
            <input type="text" hidden name="allPrice" value="{{$allPrice}}">
            <button class="btn-g ce btnCreateOrder" type="submit">Замовити</button>
        </form>
    </div>
@include('.includes/footer')
