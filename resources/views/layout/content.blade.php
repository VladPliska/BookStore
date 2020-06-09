<div class="popular-book">
    <h2>{{$type}} book</h2>
    <div class="main-slider">
        <div class="slider">
            <div class="slider-{{$type}}">
                @if(!empty($data))
                        @foreach($data as $v)
                        <a class="popular-item openBook" href="/book/{{$v->getOriginal('id')}}">
                                <img class="book-img" src="{{$v->getOriginal('img')}}" alt="test">
                                <span class="book-title">{{$v->getOriginal('title')}}</span>

                            <span class="book-price-item {{$v->action > 0 ? 'actionTrue': ''}}">{{$v->getOriginal('price')}} грн.</span>
                            @if($v->action >0)
                                 <span class="action-price-item">{{$v->action}} грн.</span>
                            @endif
                            <br>
                                <span class="book-price">{{$v->author->name}}</span>
                            </a>
                        @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
