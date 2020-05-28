@if(!empty($books))
    @foreach($books as $v)
        <div class="book-info">
            <div class="admin-book-img">
                <img src="{{$v->img}}" class="small-book-img" alt={{$v->img}}>
            </div>
            <div class="book-name">{{$v->title}}</div>
            <div class="book-author">{{$v->author->name}}</div>
            <div class="book-price">{{$v->price}}</div>
            <div class="book-btn-edit" data-id="{{$v->id}}">Змінити</div>
            <div class="book-btn-remove btn-remove-content"  data-type='book' data-id="{{$v->id}}">Видалити</div>
        </div>
    @endforeach
@else
    <h3>Nothing</h3>
@endif
