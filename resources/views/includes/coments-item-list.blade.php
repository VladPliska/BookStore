@foreach($data as $v)
<div class="comment-name-book">{{$v->getOriginal('bookComented')}}</div>
<div class="comment-info-user">
    <img src="{{asset('img/avatar.png')}}" alt="" class ="forCommentsAdmin">
    <span>Вася</span>
</div>
<div class="comment-text-admin">{{$v->getOriginal('coment')}}</div>
<div class="comment-response-btn">Відповісти</div>
<div class="comment-remove-btn">Видалити</div>
@endforeach
