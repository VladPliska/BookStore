@if(!empty($author))
{{--    @dd($data)--}}
    @foreach($data as $k => $v)
        <div class="item-order">
            <div class="name">{{$k+1}}</div>
            <div class="nameAuthor">{{$v->name ?? 'test'}}</div>
            <div class="count">{{$v->books ?? '1'}}</div>
            <div class="updateAuthor" data-id="{{$v->id}}">Редагувати</div>
            <div class="removeAuthor remove" data-id="{{$v->id}}">Видалити</div>
        </div>
    @endforeach
@else
    @foreach($orders as $data)
        <div class="item-order" data-id="{{$data->id}}">
            <div>{{$data->id}}</div>
            <div>{{$data->firstname .' '.$data->lastname}}</div>
            <div>{{$data->phone}}</div>
            <div>{{$data->city}}</div>
            <div class="status">{{$data->status}}</div>
        </div>
    @endforeach
@endif
