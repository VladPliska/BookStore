@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    @if(count($popularBook))
        @include('.layout/content',['type'=>"Popular",'data' => $popularBook])
    @endif
    @if(count($actionBook))
        @include('.layout/content',['type'=>"Action",'data' => $actionBook])
    @endif
    @if(count($news))
        @include('.layout/news',['news' => $news])
    @endif
</div>

@include('.includes/footer')
