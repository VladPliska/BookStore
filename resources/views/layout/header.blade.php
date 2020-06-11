<header>
    <div>
        <h2 class='logo-header'>BookStore</h2>
        <a href="/buy"><h2 class="busket-btn">Товарів в корзині: <span class="countBasket">{{$countBook ?? 0}}</span></h2></a>
    </div>
    <nav>
        <div class="nav-link">
            <a href="/">Головна</a>
            <a href="/catalog">Каталог</a>
            <a href="/news">Новини</a>
            <a href="/action">Акції</a>
            <a href="#contact">Контакти</a>
            <div class="searc-block mobile-search" hidden>
                <form action="/headerSearch">
                    <input type="text"  class="search-query" id="headerSearch" name='title' placeholder="Пошук книг">
                </form>
            </div>
        </div>
        <div class="searc-block desktop-search">
            <form action="/headerSearch">
                <input type="text"  class="search-query" id="headerSearch" name='title' placeholder="Пошук книг">
            </form>
        </div>
    </nav>
    @if($user != null)
        <div class="btnLogin">
        <img src="{{$user->img ? $user->img:asset('img/avatar.png')}}"  class='avatar-header' alt="">
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
                    <a href="javascript:;" class="logoutUser">Logout</a>
                </div>
            @elseif($user != null)
                <h2 class="header-title-area">Привіт,{{$user->username}}</h2>
                <div class="profileBtn">
                    <a href="/profile">Profile</a>
                </div>
                <div class="logoutBtn">
                    <a href="javascript:;" class="logoutUser">Logout</a>
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
        <a class='loginBtnHeader' href="/login">Авторизація</a>
    @endif
</header>

