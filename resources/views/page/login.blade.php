@include('./includes/head')
{{-- <div class="container"> --}}
@include('.layout/header')
    <div class="content-reg-block">
          <div class="reg-block">
              <p class="title-reg">Вхід</p>
                <div class="get-reg-info">
                    <div class="get-nic">
                        <label for="nicname">Вкажіть email або нік: </label>
                        <input type="text" id="nicname" placeholder="Username,Email" required>
                    </div>
                    <div class="get-password">
                        <label for="pass">Вкажіть пароль: </label>
                        <input type="password" id ="pass" placeholder="**********" required>
                    </div>
                </div>
              @if(!empty($reg))
                  <p class ="msg msg-suc">Verification code send successful</p>
              @endif
                <button type="submit" class ="btn-g ce">Увійти</button><br>
                <a href="/signup" class = "btn-g ce loginBtn">Зареєструватися</a>

            </div>
    </div>
