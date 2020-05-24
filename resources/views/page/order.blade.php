@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">


{{--    @dd($user)--}}
<div class="buy-page">
    <div class="post-order-info">
        <div class="select-post">
            <h2 class="title-select-post title">Виберіть спосіб доставки</h2>
            <form id="select-post" action="#">
                <div>
                    <input type="radio" name="post" id="new-post" class="new-post post"><label for="new-post">Нова пошта (50грн)</label>
                </div>
                <div>
                    <input type="radio" name="post" id="ukr-post" class="ukr-post post"><label for="ukr-post">Укрпошта (45грн)</label>
                </div>
                <div>
                    <input type="radio" name="post" id="mist" class="mistExpress post"><label for="mist">Містекспресс (45грн)</label>
                </div>
                <input type="submit" style="display:none">
            </form>
        </div>
        <div class="select-type-pay">
            <h2>Виберіть спосіб оплати</h2>
            <div>
                <input type="radio" name="type-pay" id="start-pay" class="post type-pay"><label for="start-pay">Предоплата</label>
            </div>
            <div>
                <input type="radio" name="type-pay" id="after-order" class="post type-pay"><label for="after-order">Оплата при отримані</label>
            </div>
        </div>
    </div>
    <div class="info-client">
        <h2>Контактні дані</h2>
        <input type="text" name="name" placeholder="Ім'я"><br>
        <input type="text" name="surname" placeholder="Прізвище"><br>
        <input type="text" name="number" placeholder="Номер телефону"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="text" name="email" placeholder="Населений пункт"><br>

    </div>
</div>
<button class="btn-g ce btnCreateOrder">Замовити</button>



</div>
@include('.includes/footer')
