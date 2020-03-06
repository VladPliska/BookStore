@foreach($data as $val)
<div class="user-list">
    <div class="admin-user-avatar">
        <img src="{{asset('img/avatar.png')}}" class="small-avatar-img" alt="">
    </div>
    <div class="admin-user-name">{{$val[0]->name}}</div>
    <div class="admin user-email">{{$val[0]->email}}</div>
    <div class="admin-user-inclub">Так</div>   {{--club--}}
    <div class="admin-user-block" data-id="{{$val[0]->id}}">Заблокувати</div>
</div>
@endforeach
