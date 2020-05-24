@include('./includes/head')
<div class="container">
    @include('./layout/header')
    <div class="content-container">
        <h1 class="buy-page-title">Вибрані товари</h1>
        <div class="all-select-book">
            @if(!empty($books))
                @foreach($books as $k=> $v)
                    <div class="book-section">
                        <div class="number-book">
                            <p>{{$k+1}}</p>
                        </div>
                        <div class="buy-book-img">
                            <img src="/storage/bookImg/{{$v->img}}" alt="book">
                        </div>
                        <div class="buy-title-book">
                            <div class="name-book">{{$v->title}}</div>
                            <div class="author-name-book">{{$v->author->name}}</div>
                        </div>
                        <div class="parent-book-price">
                            <span class="buy-book-price {{$v->action > 0 ? 'actionTrue' : ''}}">{{$v->price}}грн</span>
                            @if($v->action >0)
                                <span class="action-price-item">{{$v->action}} грн.</span>
                            @endif
                        </div>
                        <div class="buy-total-book">
                            <input type="number" class="total-buy"  data-id={{$v->id}} maxlength="3" min="1" value="1">
                        </div>
                        <div class="buy-remove-book">
                            <a href="javascript:;" class="removeInBasket" data-id="{{$v->id}}">X</a>
                        </div>

                    </div>
                @endforeach
                @else
                <h1 class="ce">Нічого не знайдено</h1>
            @endif
        </div>
        <form action="/order" class="'createOrder" method="get">
            @csrf
            @foreach($books as $id)
                <input type="number" hidden class='bookSelectId' name="bookId[]" value="{{$id->id}}">
            @endforeach

            <buttton class="buy-basket" type="submit">Замовити</buttton>
        </form>
    </div>
@include('includes/footer')
