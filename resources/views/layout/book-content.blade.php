<div class="main-info">
    <div class="img-book">
        <img src="/storage/bookImg/{{$info->img}}" alt="BookImg" class ="page-main-book-img">
    </div>
    <div class="first-book-info">
        <div class="page-title-book">Назва: {{$info->title}}</div>
        <div class="page-name-author">Автор: {{$author['name']}}</div>
        <div class="page-ganre">Жанр: {{$genre['name']}}</div>
        <div class="page-rice">Ціна: {{$info->price}} грн</div>
    </div>
    <div class="button-buy">
        <button class ="buyBook">В кошик</button>
    </div>
</div>
<div class="description-info">
    <h3>Опис</h3>
    <div class="page-description-book">
    {{$info->description }}
    </div>
</div>
<div class="recomend-book">
    @include('.layout/content',['type'=>"Popular",'data'=>$popular])
</div>
<div class="coment-block">
    <div class="title-block title-all-coment">Коментарі</div>
    <div class="all-comment-block">

        <div class="user-comment-block">
            <div class="icon-avatar">
                <img src="{{asset('img/avatar.png')}}"  class = "avatar-for-comment" alt="">
            </div>
            <div class="info-comment">
                <div class="username-comment">Вася</div>
                <div class="text-comment">Test comment</div>
            </div>
        </div>
         <div class="user-comment-block">
            <div class="icon-avatar">
                <img src="{{asset('img/avatar.png')}}"  class = "avatar-for-comment" alt="">
            </div>
            <div class="info-comment">
                <div class="username-comment">Вася</div>
                <div class="text-comment">Test comment</div>
            </div>
        </div>

    </div>
    <div class="title-block">Коментувати</div>
    <textarea name="comment-text textarea ce" class="comment-text" id="" cols="30" rows="10" placeholder="Текст комантаря....."></textarea>
    <button class ="add-comment">Коментувати</button>

</div>
