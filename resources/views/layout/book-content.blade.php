<div class="main-info">
    <div class="img-book">
        <img src="{{asset('img/img.jpeg')}}" alt="BookImg" class ="page-main-book-img">
    </div>
    <div class="first-book-info">
        <div class="page-title-book">Відьмак. Останнє бажання. Книга 1</div>
        <div class="page-name-author">Автор: Анджей Сапковський</div>
        <div class="page-ganre">Жанр: Фантастика, фентезі</div>
        <div class="page-rice">Ціна: 119.90 грн</div> 
    </div>
    <div class="button-buy">
        <button class ="buyBook">В кошик</button>
    </div>
</div>
<div class="description-info">
    <h3>Опис</h3>
    <div class="page-description-book">
    Голос розуму-1<br>

    Вона прийшла до нього перед ранком.

    Увійшла дуже обережно, тихо, безшелесно, пливла через кімнату наче примара, наче з’ява, а єдиний звук, який супроводжував її рух, видавала опанча, що терлася об голу шкіру. Утім, саме той тихесенький, ледь чутний шурхіт розбудив відьмака, а може, лише вирвав із напівсну, в якому він монотонно колихався, немов у безодні, підвішений між дном і поверхнею спокійного моря, серед легенько розгойданих пасм фукусу.

    Він не ворухнувся, не здригнувся навіть. Дівчина підпливла ближче, скинула опанчу, поволі, із ваганням, сперлася зігнутим коліном об край ложа. Він дивився на неї з-під примружених повік, не виказуючи, що вже не спить. Дівчина обережно залізла на постіль, на нього, обійнявши його стегнами. Спершись на напружені руки, мазнула по його обличчю волоссям, що пахло ромашкою. 
    </div>
</div>
<div class="recomend-book">
    @include('.layout/content',['type'=>"Popular"])
</div>
<div class="coment-block">
    <div class="title-block title-all-coment">Коментарі</div>
    <div class="all-comment-block">

        <div class="user-comment-block">
            <div class="icon-avatar">
                <img src="{{asset('img/avatar.png')}}"  class = "avatar-for-comment" alt="">
            </div>
            <div class="info-comment">
                <div class="username-comment">Вася</div>
                <div class="text-comment">Test comment</div>
            </div>
        </div>
         <div class="user-comment-block">
            <div class="icon-avatar">
                <img src="{{asset('img/avatar.png')}}"  class = "avatar-for-comment" alt="">
            </div>
            <div class="info-comment">
                <div class="username-comment">Вася</div>
                <div class="text-comment">Test comment</div>
            </div>
        </div>

    </div>
    <div class="title-block">Коментувати</div>
    <textarea name="comment-text textarea ce" class="comment-text" id="" cols="30" rows="10" placeholder="Текст комантаря....."></textarea>
    <button class ="add-comment">Коментувати</button>
    
</div>