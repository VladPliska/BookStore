@include('./includes/head')
<div class="container">
    @include('.layout/header')
    <h1 class="ce">Акція</h1>
    <div class="result-search">
        @foreach($data as $v)
            @include('.layout/book-card',['info'=>$v])
        @endforeach
    </div>

</div>
