
<header>
<h2 class = 'logo-header'>BookStore</h2>
<nav>
    <div class="nav-link">
        <a href="/">Головна</a>
        <a href="/catalog">Каталог</a>
        <a href="/news">Новини</a>
        <a href="/action">Акції</a>
        <a href="#contact">Контакти</a>
    </div>
    <div class="searc-block">
        <input type="text" class ="search-query" placeholder="Пошук книг">
    </div>
</nav>
<div class="btnLogin">
    <a href="/profile" class="open-user-setting">
        <img src="{{asset('img/avatar.png')}}" class="avatar-header ce">
    </a>
    <div class="admin-panel-open">
        <ul>
            <li>Profile</li>
            <li>
                <a href="/admin">Admin setting</a>

            </li>
            <li>Logout</li>
        </ul>
    </div>
</div>

</header>

