<a class="book-card" href="/book/{{$info->getOriginal('id')}}" style="z-index:100">
    <img src="/storage/bookImg/{{$v->getOriginal('img')}}" alt="bookImg" class ="book-card-img">
    <div class="book-card-name">{{$v->getOriginal('title')}}</div>
    <div class="book-card-price">{{$v->getOriginal('price')}} грн</div>
    <div class="book-card-add-bascket">В корзину</div>
</a>
