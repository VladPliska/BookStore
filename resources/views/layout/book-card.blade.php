@csrf
@if(empty($search))
<a class="book-card" href="/book/{{$v->getOriginal('id')}}" style="z-index:100">
    <img src="/storage/bookImg/{{$v->getOriginal('img')}}" alt="bookImg" class ="book-card-img">
    <div class="book-card-name">{{$v->getOriginal('title')}}</div>
    <div class="book-card-price">{{$v->getOriginal('price')}} грн</div>
    <div class="book-card-add-bascket">В корзину</div>
</a>
@else
    @if(count($result) == 0 )
        <h2 class="empty-result">Нічого не знайденно!</h2>
    @endif
    @foreach($result as $v)
    <a class="book-card" href="/book/{{$v->id}}" style="z-index:100">
        <img src="/storage/bookImg/{{$v->img}}" alt="bookImg" class ="book-card-img">
        <div class="book-card-name">{{$v->title}}</div>
        <div class="book-card-price">{{$v->price}} грн</div>
        <div class="book-card-add-bascket">В корзину</div>
    </a>
    @endforeach
@endif
