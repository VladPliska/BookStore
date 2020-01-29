@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">


<div class="buy-page">

    <div class="select-post">
        <span class="title-select-post title">Виберіть спосіб доставки</span>
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

    <div class="info-client">
        <p>Контактні дані</p>
        <input type="text" name="name" placeholder="Ім'я"><br>
        <input type="text" name="surname" placeholder="Прізвище"><br>
        <input type="text" name="number" placeholder="Номер телефону"><br>
        <input type="text" name="email" placeholder="Email"><br>


    </div>

</div>  



</div>
@include('.includes/footer') 
