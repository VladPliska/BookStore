@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
    @include('.layout/content',['type'=>"Popular"])
    @include('.layout/content',['type'=>"Action"])
    @include('.layout/news')
</div>

@include('.includes/footer') 