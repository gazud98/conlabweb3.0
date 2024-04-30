<link rel="stylesheet" href="/cw3/conlabweb3.0/view/public/templates/styles.min.css" />

<style>
  body {
    background-image: url('/cw3/conlabweb3.0/view/public/templates/imgs/pasteur2_8711657_20231013151857.jpeg');
    background-size: cover;
  }

  .page-wrapper {
    width: 100%;
    height: 100vh;
    background: rgb(19, 18, 199);
    background: linear-gradient(135deg, rgba(19, 18, 199, 0.5438550420168067) 0%, rgba(255, 255, 255, 0) 49%, rgba(214, 11, 11, 0.5690651260504201) 100%);
    overflow: hidden;
  }

  .content-all {
    width: 45%;
    margin: auto;
    margin-top: 10%;
    overflow: hidden;
    -webkit-box-shadow: 0px 0px 33px -6px rgba(0, 0, 0, 0.4);
    -moz-box-shadow: 0px 0px 33px -6px rgba(0, 0, 0, 0.4);
    box-shadow: 0px 0px 33px -6px rgba(0, 0, 0, 0.4);
  }

  #login-form {
    padding: 60px;
  }

  .login-form {
    width: 100%;
    margin-top: 10px;
    border: none;
    border-left: 4px solid #164085;
    background-color: #F4F4F4;
    font-weight: 800;
    padding: 5px;
  }

  ::placeholder {
    color: #C8C8C8 !important;
  }

  .form-data-login {
    padding: 100px;
  }

  .form-check {
    padding: 0px;
  }

  .btn-sg {
    border-radius: 20px;
    background-color: #164085;
  }

  .login-title {
    width: 100%;
    color: #164085;
    font-weight: 700;
    text-align: center;
    padding: 20px;
  }

  .content-img {
    text-align: center;
    padding-bottom: 10px;
  }

  .content-img img {
    width: 200px;
  }

  .back-img {
    width: 100%;
    height: 100%;
    background-image: url('/cw3/conlabweb3.0/view/public/templates/imgs/IMG_20230928_175450.jpg');
    background-size: cover;
    background-repeat: no-repeat;
  }

  .overflow {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #A0205775;
    color: #fff;
    text-align: center;
    padding-top: 42%;
  }

  .form-control {
    border-radius: 0px;
  }

  .overflow-back-all {
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: #8cb7ff70;
    margin-top: -10%;
  }
  
  @media only screen and (max-width:1200) {
    .content-all {
      width: 40%;
      margin: auto;
      margin-top: 10%;
      overflow: hidden;
    }
  }

  @media only screen and (max-width:900px) {
    .content-all {
      width: 80%;
      margin: auto;
      margin-top: 10%;
      overflow: hidden;
    }
  }

  @media only screen and (max-width:700px) {
    .content-all {
      width: 100%;
      margin: auto;
      margin-top: 10%;
      overflow: hidden;
    }
  }
  
</style>

<div class="overflow-back-all">
</div>

<div class="row content-all">
  <div class="col-md-6 bg-white p-0">
    <div class="overflow">
      <span style="font-size:15px">The future is now</span>
      <h5 style="color:#fff;font-size:35px">WELCOME TO CW3</h5>
      <img src="/cw3/conlabweb3.0/view/public/templates/imgs/logo-w.png" alt="" width="220px">
    </div>
    <div class="back-img">

    </div>
  </div>
  <div class="col-md-6 bg-white p-0">
    <form id="login-form" method="post">
      <div class="content-img"><img src="/cw3/conlabweb3.0/view/public/templates/imgs/logopequenio.png" alt=""></div>
      <h4 class="login-title">Login Account</h4>
      <div class="input-group mb-3">
        <input type="text" class="form-control login-form" placeholder="Email" name="login">
        <div class="input-group-append">

        </div>
        <span class="help-block btn-block" style="color: red; font-size: 14px"></span>
      </div>
      <div class="input-group mb-3">
        <input type="password" class="form-control login-form" placeholder="Password" name="password">
        <div class="input-group-append">

        </div>
        <span class="help-block btn-block" style="color: red; font-size: 14px"></span>
      </div>
      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="remember" name="remember" value="1">
            <label for="remember" style="color: #A4B6D6;">
              Remember Me
            </label>
          </div>
        </div>
      </div>
      <div class="row mt-2 p-2">
        <button id="btnlogin" class="btn btn-primary btn-block btn-sg" onclick="login_form()">Sign In</button>
      </div>
    </form>
  </div>
</div>





<!--<div class="login-box" >
    <div class="card">
      <div class="card-body login-card-body rounded">
        <div class="d-flex justify-content-center">
          <a href="<?= $this->url("auth", "index"); ?>">
            <img src="./assets/dist/img/logopequenio.png" alt="CONLAB 3" class="brand-image">
          </a>
        </div>
        <p class="login-box-msg">Start your session</p>
        <form id="login-form" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="login">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <span class="help-block btn-block" style="color: red; font-size: 14px"></span>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <span class="help-block btn-block" style="color: red; font-size: 14px"></span>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button id="btnlogin" class="btn btn-primary btn-block" onclick="login_form()">Sign In</button>
            </div>
          </div>
        </form>
        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
      </div>
    </div>
  </div>-->