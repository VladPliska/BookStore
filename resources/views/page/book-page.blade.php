@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
        @include('./layout/book-content',
            ['author'=>$author,'info'=>$infoBook,'genre'=>$genre,'popular'=>$popularBook])
</div>
@include('.includes/footer')
