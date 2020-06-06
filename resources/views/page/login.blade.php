@include('./includes/head')
{{-- <div class="container"> --}}
@include('.layout/header')
    <div class="content-reg-block">
          <div class="reg-block">
              <p class="title-reg">Вхід</p>
              <form action="/login" method="post">
                  @csrf
                <div class="get-reg-info">
                    <div class="get-nic">
                        <label for="nicname">Вкажіть email або нік: </label>
                        <input type="text" id="nicname" name = "username" placeholder="Username,Email" required>
                    </div>
                    <div class="get-password">
                        <label for="pass">Вкажіть пароль: </label>
                        <input type="password" id ="pass"  name="password" placeholder="**********" required>
                    </div>
                </div>
               @if(session('err'))
                      <p class ="msg msg-err">{{session('err')}}</p>
                  @endif
              @if(!empty($reg))
                  <p class ="msg msg-suc">Verification link send successful</p>
              @elseif(!empty($confirm))
                  <p class ="msg msg-suc">Account verification succesfull</p>
              @elseif(!empty($err))
                  <p class ="msg msg-err">{{$err}}</p>
              @endif
                <button type="submit" class ="btn-g ce">Увійти</button><br>
              </form>
                <a href="/signup" class = "btn-g ce loginBtn">Зареєструватися</a>

            </div>
    </div>
