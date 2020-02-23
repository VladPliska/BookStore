@foreach($data as $v)
    <div class="admin-user-avatar">
        <img src="{{asset('img/avatar.png')}}" class="small-avatar-img" alt="">
    </div>
    <div class="admin-user-name">{{$v->getOriginal('username')}}</div>
    <div class="admin user-email">{{$v->getOriginal('email')}}</div>
    <div class="admin-user-inclub">Так</div>
    <div class="admin-user-block" data-id ={{$v->getOriginal('id')}}>Заблокувати</div>
@endforeach
