@if(count($data))
{{--    @dd(count($data))--}}
    @foreach($data as $val)
        <div class="user-list">
            <div class="admin-user-avatar">
                <img src="{{asset('img/avatar.png')}}" class="small-avatar-img" alt="">
            </div>
            <div class="admin-user-name">{{$val->username}}</div>
            <div class="admin user-email">{{$val->email}}</div>
            <div class="admin-user-inclub">Так</div> {{--club--}}
            <div class="admin-user-block" data-id="{{$val->id}}">Заблокувати</div>
        </div>
    @endforeach
@else
    <h1 class="msg-empty">Nothing</h1>
@endif
