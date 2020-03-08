@if(!empty($books))
    @foreach($books as $v)
        <div class="book-info">
            <div class="admin-book-img">
                <img src="/storage/bookImg/{{$v->img}}" class="small-book-img" alt={{$v->img}}>
            </div>
            <div class="book-name">{{$v->title}}</div>
            <div class="book-author">{{$v->author->name}}</div>
            <div class="book-price">{{$v->price}}</div>
            <div class="book-btn-edit">Змінити</div>
            <div class="book-btn-remove">Видалити</div>
        </div>
    @endforeach
@else
    <h3>Nothing</h3>
@endif
