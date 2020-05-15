@if(count($data) == 0)
    <h2 style="font-size: 20px">Авторів не знайдено</h2>
@else
    @foreach($data as $v)
        <div class="author-search-item" data-id="{{$v->id}}">{{$v->name}}</div>
    @endforeach
@endif
