@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    <h1 class ="buy-page-title">Вибрані товари</h1>
    <div class="all-select-book">
        <div class="book-section">
            <div class="number-book">
                <p>1</p>
            </div>
            <div class="buy-book-img">
                <img src="{{asset('img/img.jpeg')}}" alt="book">
            </div>
            <div class="buy-title-book">
                <div class="name-book">Відьмак. Останнє бажання. Книга 1</div>
                <div class="author-name-book">Анджей Сапковський</div>
            </div>
            <div class = "parent-book-price">
                <div class="buy-book-price">119.90грн</div>
            </div>
            <div class="buy-total-book">
                <input type="text" class="total-buy" maxlength="3" value="1">
            </div>
            <div class="buy-remove-book">
                <a href="javascript:;" >X</a>
            </div>
        </div>
        <div class="book-section">
            <div class="number-book">
                <p>1</p>
            </div>
            <div class="buy-book-img">
                <img src="{{asset('img/img.jpeg')}}" alt="book">
            </div>
            <div class="buy-title-book">
                <div class="name-book">Відьмак. Останнє бажання. Книга 1</div>
                <div class="author-name-book">Анджей Сапковський</div>
            </div>
            <div class = "parent-book-price">
                <div class="buy-book-price">119.90грн</div>
            </div>
            <div class="buy-total-book">
                <input type="text" class="total-buy" maxlength="3" value="1">
            </div>
            <div class="buy-remove-book">
                <a href="javascript:;" >X</a>
            </div>
        </div>
    </div>
    <a  href ="javascript:;" class ="buy-basket">Замовити</a>
</div>
@include('includes/footer')