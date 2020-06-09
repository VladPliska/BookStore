<div class="news-block">
    <h1>Новини</h1>
    @foreach($news as $val)
        <div class="news-item">
            <div class="news-time">{{$val->created_at}}</div>
            <div class="news-text">{{$val->text}}</div>
        </div>
    @endforeach
</div>
