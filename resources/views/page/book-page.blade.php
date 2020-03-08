@include('./includes/head')
<div class="container">
@include('./layout/header')
<div class="content-container">
        @include('./layout/book-content',
            ['author'=>$author,'info'=>$infoBook,'genre'=>$genre,'popular'=>$popularBook,'comments'=>$comments])
</div>
@include('.includes/footer')
