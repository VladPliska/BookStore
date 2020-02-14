@include('./includes/head')
{{-- <div class="container"> --}}
@include('.layout/header')
    <div class="content-reg-block">
          <div class="reg-block">
              <form action="/signin" method="POST">
                  <p class="title-reg">Реєстрація</p>
                    <div class="get-reg-info">
                        <div class="get-nic">
                            <label for="nicname">Вкажіть нік: </label>
                            <input type="text" id="nicname" placeholder="Username">
                        </div>
                        <div class="get-email">
                            <label for="email">Вкажіть email: </label>
                            <input type="text" id='email' placeholder="Email" >
                        </div>
                        <div class="get-password">
                            <label for="pass">Вкажіть пароль: </label>
                            <input type="password" id ="pass" placeholder="**********">
                        </div>
                        <div class="get-repeat-password">
                            <label for="repPass">Повторіть пароль: </label>
                            <input type="password" placeholder="**********" id="repPass">
                        </div>
                    </div>
                    <button class ="btn-g ce" type = "submit">Зареєструватися</button><br>
              </form>
                    <a href="/login" class = "btn-g ce loginBtn">Увійти</a>

            </div>
    </div>
