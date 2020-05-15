<header>
    <h2 class='logo-header'>BookStore</h2>
    <nav>
        <div class="nav-link">
            <a href="/">Головна</a>
            <a href="/catalog">Каталог</a>
            <a href="/news">Новини</a>
            <a href="/action">Акції</a>
            <a href="#contact">Контакти</a>
        </div>
        <div class="searc-block">
            <input type="text" class="search-query" placeholder="Пошук книг">
        </div>
    </nav>
    @if($user != null)
        <div class="btnLogin">
        <img src="{{$user->img ? 'storage/bookImg/'.$user->img:asset('img/avatar.png')}}"  class='avatar-header' alt="">
        <div class='login-area'>
            @if($user != null && $user->role == 'admin')
                <h2 class="header-title-area">Привіт,{{$user->username}}</h2>
                <div class="profileBtn">
                    <a href="/profile">Profile</a>
                </div>
                <div class="adminPage">
                    <a href="/admin">Admin</a>
                </div>
                <div class="logoutBtn">
                    <a href="/logout">Logout</a>
                </div>
            @elseif($user != null)
                <h2 class="header-title-area">Привіт,{{$user->username}}</h2>
                <div class="profileBtn">
                    <a href="/profile">Profile</a>
                </div>
                <div class="logoutBtn">
                    <a href="/logout">Logout</a>
                </div>

            @elseif($user == null)
                <div class="loginPage">
                    <a href="/login">Login</a>
                </div>
                <div class="loginPage">
                    <a href="/signup">Sign Up</a>
                </div>
            @endif
        </div>
    </div>
    @else
        <a href="/login">Авторизація</a>
    @endif
</header>

