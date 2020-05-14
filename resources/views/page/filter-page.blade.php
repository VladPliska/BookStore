@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    <div class="header-filter">
        <div class="filter-main-search">
            <label for="filter-search">Що ви шукаєте:</label>
            <input type="text" id = "filter-search" >
            <button class="btn-g searchCatalog">Search</button>
        </div>
        <div id="showAllFilter"class="show-main-filter">Фільтри</div>
    </div>
    <div id="mainFilter"class="main-filters ">
        <div class="filter-ganre-author">
            <div class="ganre-list">
                <div>Виберіть жанр</div>
                <select name="ganre" id="ganre-select" >
                    <option value="Fan" selected disabled>Виберіть жанр</option>
                    <option value="Fan">Психологія</option>
                    <option value="Fan">Фантастика</option>
                </select>
            </div>
            <div class="filter-author">
                <div>Автор</div>
                <input type="text" name="filter-author" class="author-name">
                <div class="res-search"></div>
            </div>
        </div>
        <div class="filter-price">
            <p>Мінімальна ціна</p>
            <input class = "range-min" name="minn-price" value="0" type="range" step="50" max="1000" min="0">
            <div class = "minPrice">0</div>
            <p>Максимальна ціна</p>
            <input class = "range-max" name ="max-price" type="range" value='500' step="50" max="1000" min="0">
            <div class = "maxPrice">500</div>
        </div>
    <div class="sort">
        <span>Сортувати за:</span>
        <div class="sort-by">
            <label for="sort-up">
                Зростанням
                <input id="sort-up" name="sort-by" type="radio" value="asc" checked>
            </label>
            <label for="sort-down">
                Спаданням
                <input id="sort-down" name="sort-by" type="radio" value="desc">
            </label>
        </div>
        <div class="button-block">
            <div class="sort-btn-all btnNewBook btnFilter" data-type="News">Новинки</div>
            <div class="sort-btn-all btnAction btnFilter" data-type="Action">Акції</div>
            <div class="sort-btn-all btnPopular btnFilter" data-type="Popular">Популярні</div>
            <div class="sort-btn-all btnRecomended btnFilter" data-type="Recommended">Рекомендовані</div>
        </div>
    </div>
    </div>
    <div class="result-search">
        @foreach($data as $v)
                @include('.layout/book-card',['info'=>$v])
        @endforeach
    </div>

</div>
@include('.includes/footer')
