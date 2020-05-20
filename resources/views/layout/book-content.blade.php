<div class="main-info">
    <div class="img-book">
        <img src="/storage/bookImg/{{$info->img}}" alt="BookImg" class="page-main-book-img">
    </div>
    <div class="first-book-info">
        <div class="page-title-book">Назва: {{$info->title}}</div>
        <div class="page-name-author">Автор: {{$author['name']}}</div>
        <div class="page-ganre">Жанр: {{$genre['name']}}</div>
        <div class="page-rice">Ціна: {{$info->price}} грн</div>
    </div>
    <div class="button-buy">
        <button class="buyBook" data-id="{{$info->id}}">В кошик</button>
    </div>
</div>
<div class="description-info">
    <h3>Опис</h3>
    <div class="page-description-book">
        {{$info->description }}
    </div>
</div>
<div class="recomend-book">
    @if(count($popular))
        @include('.layout/content',['type'=>"Popular",'data'=>$popular])
    @endif
</div>
<div class="coment-block">
    <div class="title-block title-all-coment">Коментарі</div>
    <div class="all-comment-block">
        @if(count($comments))
            @foreach($comments as $v)
                @include('layout.user-comment',['live'=>false,'data'=>$v])
            @endforeach
        @else
            <h3 class="msg-empty emptyComment">Коментарі відсутні.Станьте першим хто прокоментує!</h3>
        @endif
    </div>
    <div class="title-block">Коментувати</div>
    <textarea name="comment-text" class="comment-text" id="bookComment" cols="30" rows="10"
              placeholder="Текст комантаря....."></textarea>
    <button class="add-comment" data-id="{{$info->id}}">Коментувати</button>

</div>
