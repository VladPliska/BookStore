@foreach($orders as $data)

    <div class="item-order" data-id="{{$data->id}}">
        <div>{{$data->id}}</div>
        <div>{{$data->firstname .' '.$data->lastname}}</div>
        <div>{{$data->phone}}</div>
        <div>{{$data->city}}</div>
        <div class="status">{{$data->status}}</div>
    </div>
@endforeach
