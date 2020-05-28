<div class="item">
    <h3>Картинка</h3>
    <h3 class="name">Назва</h3>
    <h3 class="count">Кількість</h3>
    <h3 class="price">Ціна за 1 книжку</h3>
    <h3 class="priceCount">Ціна за всі книжки</h3>
</div>
@foreach($data as $v)
<div class="item">
    <img src="{{$v->img ?? ''}}" class="orderImg" alt="">
    <div class="name">{{$v->title ?? 'test'}}</div>
    <div class="count">{{$v->count ?? '1'}}</div>
    <div class="price">{{$v->price ?? 200}} грн.</div>
    <div class="priceCount">{{($v->price ?? 200) * $v->count ?? 1}} грн.</div>
</div>
@endforeach
