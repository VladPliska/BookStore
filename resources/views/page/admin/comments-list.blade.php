@if(empty($data))
    <h2>Empty comments</h2>
@else
    @foreach($data as $k => $v)
        <div class="comment-name-book">Топ 1</div>
        <div class="comment-info-user">
            <img src="{{asset('img/avatar.png')}}" alt="" class="forCommentsAdmin">
            <span>Вася</span>
        </div>
        <div class="comment-text-admin">Супер книга!</div>
        <div class="comment-response-btn">Відповісти</div>
        <div class="comment-remove-btn">Видалити</div>
    @endforeach
@endif
