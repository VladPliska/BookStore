@include('./includes/head')
<div class="container">
    @include('.layout/header')
    <h2 class="title-news">Головні новини сайту</h2>
    {{--    @dd($news)--}}
    <div class="news-content">
        @foreach($news as $v)
            <div class="news-item">
                <div class="date-news">{{$v->created_at}}</div>
                <div class="text-news">{{$v->text}}</div>
            </div>
        @endforeach
    </div>


    @include('./includes/footer')
</div>
