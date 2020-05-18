@include('./includes/head')
<div class="container">
    @include('./layout/header')
    <div class="content-container">
        <div class="header-filter">
            <div class="filter-main-search">
                <label for="filter-search">Що ви шукаєте:</label>
                <input type="text" value="{{$query ?? ''}}" id="filter-search">
                <button class="btn-g searchCatalog">Search</button>
            </div>
            <div id="showAllFilter" class="show-main-filter">Фільтри</div>
        </div>
        <div id="mainFilter" class="main-filters ">
            <div class="filter-ganre-author">
                <div class="ganre-list">
                    <div>Виберіть жанр</div>
                    <select name="ganre" id="ganre-select" required>
                        <option value="Fan" selected disabled>Виберіть жанр:</option>
                        @foreach($genre as $v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-author">
                    <div>Автор</div>
                    <input type="text" name="" class="author-name">
                    <input type='text' class="hide author-id" name="filter-author"/>
                    <div class="res-search-author hide"></div>
                </div>
            </div>
            <div class="filter-price">
                <p>Мінімальна ціна</p>
                <input class="range-min" name="minn-price" value="0" type="range" step="50" max="1000" min="0">
                <div class="minPrice">0</div>
                <p>Максимальна ціна</p>
                <input class="range-max" name="max-price" type="range" value='500' step="50" max="1000" min="0">
                <div class="maxPrice">500</div>
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
            @if(!count($data))
                <h2 class="empty-result">Нічого не знайденно!</h2>
            @else
                @foreach($data as $v)
                    @include('.layout/book-card',['info'=>$v])
                @endforeach
            @endif

        </div>

    </div>
@include('.includes/footer')
