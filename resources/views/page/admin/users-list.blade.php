@if(count($data))
    {{--    @dd(count($data))--}}
    @foreach($data as $val)
        <div class="user-list">
            <div class="admin-user-avatar">
                <img src="{{asset('img/avatar.png')}}" class="small-avatar-img" alt="">
            </div>
            <div class="admin-user-name">{{$val->username}}</div>
            <div class="admin user-email">{{$val->email}}</div>
            @if($val->ban == false)
                <div class="admin-user-block msg-err" data-id="{{$val->id}}">Заблокувати</div>
            @else
                <div class="admin-user-block msg-suc" data-id="{{$val->id}}">Розблокувати</div>
            @endif
        </div>
    @endforeach
@else
    <h1 class="msg-empty">Nothing</h1>
@endif
