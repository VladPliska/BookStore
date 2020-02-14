@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    @include('.layout/content',['type'=>"Popular",'data' => $popularBook])
    @include('.layout/content',['type'=>"Action",'data' => $actionBook])
    @include('.layout/news')
</div>

@include('.includes/footer')
