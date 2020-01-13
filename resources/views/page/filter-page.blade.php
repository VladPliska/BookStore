@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    <div class="header-filter">
        <div class="filter-main-search">
            <label for="filter-search">Що ви шукаєте:</label>
            <input type="text" id = "filter-search">
            <span>Search</span>
        </div>
        <div class="filter-news">Новинки</div>
        <div class="filter-action">Акція</div>
        <div id="showAllFilter"class="show-main-filter">Фільтри</div>
    </div>
    <div id="mainFilter"class="main-filters">
        <div class="ganre-list">
            <select name="ganre" id="ganre-select" >
                <option value="Fan" selected disabled>Виберіть жанр</option>
                <option value="Fan">Психологія</option>
                <option value="Fan">Фантастика</option>
            </select>
        </div>
        <div class="filter-price">
            <p class = "minPrice">1</p>
            <input type="range" step="50" max="10000" min="1">
            <p class = "maxPrice">1000</p>
        </div>
        <div class="filter-author">
            <input type="text" name="filter-author">
        </div>
    </div>

</div>
@include('.includes/footer') 
