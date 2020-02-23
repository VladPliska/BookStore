@foreach($data as $v)
    <div class="book-info" data-id="{{$v->getOriginal('id')}}">
        <div class="admin-book-img">
            <img src="/storage/bookImg/{{$v->getOriginal('img')}}" class ="small-book-img"alt="">
        </div>
        <div class="book-name">{{$v->getOriginal('title')}}</div>
        <div class="book-price">{{$v->getOriginal('price')}}</div>
        <div class="book-btn-edit">Змінити</div>
        <div class="book-btn-remove">Видалити</div>
    </div>
@endforeach
