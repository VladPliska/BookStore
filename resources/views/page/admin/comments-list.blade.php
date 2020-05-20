@if(!count($data))
    <h3 class="msg-empty">Коментарів не знайдено</h3>
@else
    @foreach($data as $k => $v)
        <div class="coments-body-parent">
            <div class="comment-name-book">{{$v->books->title}}</div>
            <div class="comment-info-user">
                <img src="{{asset('img/avatar.png')}}" alt="" class="forCommentsAdmin">
                <span>{{$v->user->username}}</span>
            </div>
            <span class="comment-text-admin" title="{{$v->coment}}">{{$v->coment}}</span>
            <div class="comment-response-btn" data-id="{{$v->id}}">Відповісти</div>
            <div class="comment-remove-btn btn-remove-content" data-type='comment' data-id="{{$v->id}}">Видалити</div>
        </div>
    @endforeach
@endif
