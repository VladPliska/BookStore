@foreach($books as $val)

    <div class="book-info">
        <div class="admin-book-img">
            <img src="/storage/bookImg/{{$v[0]->img}}" class ="small-book-img" alt={{$v[0]->img}}>
        </div>
        <div class="book-name">{{$v[0]->title}}</div>
        <div class="book-author">{{$v[0]->author->name}}</div>
        <div class="book-price">{{$v[0]->price}}</div>
        <div class="book-btn-edit">Змінити</div>
        <div class="book-btn-remove">Видалити</div>
    </div>

@endforeach
