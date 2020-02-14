@include('./includes/head')
{{-- <div class="container"> --}}
@include('.layout/header')
    <div class="content-reg-block">
        <div class="popup">
            <div class="popup-confirm-code">
                <form action="#" method="post" class="verification-form">
                    @csrf
                    <label for="code" class = "ce">Enter verification code</label><br>
                    <input id="code" type="text" placeholder="Code" required name="ver-code"><br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
          <div class="reg-block">
              <form action="/signin" method="POST">
                  @csrf
                  <p class="title-reg">Реєстрація</p>
                    <div class="get-reg-info">
                        <div class="get-nic">
                            <label for="nicname">Вкажіть нік: </label>
                            <input type="text" id="nicname" name ="username" placeholder="Username" required>
                        </div>
                        <div class="get-email">
                            <label for="email">Вкажіть email: </label>
                            <input type="text" id='email' name ="email" placeholder="Email"  required>
                        </div>
                        <div class="get-password">
                            <label for="pass">Вкажіть пароль: </label>
                            <input type="password" id ="pass" name="pass" placeholder="**********" required>
                        </div>
                        <div class="get-repeat-password">
                            <label for="repPass">Повторіть пароль: </label>
                            <input type="password" placeholder="**********" name="repeatPass" id="repPass" required>
                        </div>
                    </div>
                  @if(!empty($err))
                      <p class ="msg msg-err">{{$err}}</p>
                  @endif
                    <button class ="btn-g ce" type = "submit">Зареєструватися</button><br>
              </form>
                    <a href="/login" class = "btn-g ce loginBtn">Увійти</a>

            </div>
    </div>
