@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    <div class="profile-page">
        <div class="ressetPassword">
            <h1>Зміна паролю</h1>
            <input type="text" placeholder="Старий пароль">
            <input type="text" placeholder="Новий пароль">
            <input type="text" placeholder="Повторіть новий пароль">
            <button class ="btn-g">Змінити пароль</button>
        </div>
        <div class="profile-mainInfo">
            <div class="user-avatar">
                <img src="{{asset('img/avatar.png')}}" alt=""> 
                <input type="file" class="hide">
            </div>
            <div class="user-name">
                <input type="text" class ="userName" placeholder="Ім'я">
            </div>
            <div class="user-surname">
                <input type="text" class ="userSurname" placeholder="Прізвище">
            </div>
            <button class="btn-g ce">Зберегти все</button>
        </div>
        <div class="dop-info">
            <h1>Додаткові дані</h1>
            <input type="text" placeholder="UserName">
            <input type="text" placeholder="Номер телефону">
            <input type="text" placeholder="Email">
            <button class ="btn-g">Зберегти</button>
        </div>
    </div>
</div>

@include('.includes/footer') 