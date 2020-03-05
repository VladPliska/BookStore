@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    @if(!empty($popular))
        @include('.layout/content',['type'=>"Popular",'data' => $popularBook])
    @endif
    @if(!empty($actionBook))
        @include('.layout/content',['type'=>"Action",'data' => $actionBook])
    @endif
    @if(!empty($news))
        @include('.layout/news',['news' => $news])
    @endif
</div>

@include('.includes/footer')
