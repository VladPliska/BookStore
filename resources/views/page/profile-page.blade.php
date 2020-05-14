@include('./includes/head')
<div class="container">
    @include('./layout/header')
    <div class="content-container">
        <div class="profile-page">
            <div class="ressetPassword">
                <h1>Зміна паролю</h1>
                <form method ='post' action="/changePass">
                    @csrf
                    <input type="password" name="old" placeholder="Старий пароль" readonly onfocus="this.removeAttribute('readonly')" required>
                    <input type="password" minlength="6" name='new' placeholder="Новий пароль"  readonly onfocus="this.removeAttribute('readonly')" required>
                    <input type="password" minlength="6" name='repeat' placeholder="Повторіть новий пароль" readonly onfocus="this.removeAttribute('readonly')" required>
                    <button class="btn-g" type="submit">Змінити пароль</button>
                </form>
            </div>
            <div class="profile-mainInfo">
                <form action="/changeUserRealInfo" method="POST" enctype="multipart/form-data">
                   @csrf
                    <div class="user-avatar">
                        <label for="img-avatar">
                            <img src="{{$user->img ? 'storage/bookImg/'.$user->img:asset('img/avatar.png')}}" alt="">
                        </label>
                        <input type="file" id="img-avatar" hidden name="avatar" accept="image/*" class="hide addImg-profile">
                    </div>
                    <div class="user-name">
                        <input type="text" class="userName" value="{{$user->lastname}}"  name="lastname"
                               placeholder="Ім'я">
                    </div>
                    <div class="user-surname">
                        <input type="text" class="userSurname" value="{{$user->firstname}}" name="firstname"
                               placeholder="Прізвище">
                    </div>
                    <button class="btn-g ce">Зберегти все</button>
                </form>
            </div>
            <div class="dop-info">
                <h1>Додаткові дані</h1>
                <form action="/changeDopInfo" method="post">
                    @csrf
                    <input type="text" placeholder="UserName" name="username" required value="{{$user->username}}"/>
                    <input type="number" placeholder="Номер телефону" name="phone" value="{{$user->phone ?? ''}}">
                    <input type="text" placeholder="Email" disabled required value="{{$user->email}}">
                    <button class="btn-g" type="submit">Зберегти</button>
                </form>
            </div>
        </div>
        @if(session('succ'))
            <h2 class='msg-suc'>{{session('succ')}}</h2>
        @endif
        @if($errors->any())
            <h2 class='msg-err'>{{$errors->first()}}</h2>
        @endif
    </div>


@include('.includes/footer')
