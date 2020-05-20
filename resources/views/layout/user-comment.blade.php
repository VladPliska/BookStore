@if($live)
    <div class="user-comment-block">
        <div class="icon-avatar">
            <img src="{{asset('img/avatar.png')}}" class="avatar-for-comment" alt=""> {{--user avatar--}}
        </div>
        <div class="info-comment">
            <div class="username-comment">{{$user->username}}</div>
            <div class="text-comment">{{$text}}</div>
        </div>
    </div>
@else
    <div>
        <div class="user-comment-block">
            <div class="icon-avatar">
                <img src="{{asset('img/avatar.png')}}" class="avatar-for-comment" alt=""> {{--user avatar--}}
            </div>
            <div class="info-comment">
                <div class="username-comment">{{$v->user->username}}</div>
                <div class="text-comment">{{$v->coment}}</div>
            </div>
        </div>
    </div>
@endif
