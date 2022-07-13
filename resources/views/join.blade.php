<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Join US</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sign.css')}}" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous">
    </script>

  </head>
  <body>

    @include('sweetalert::alert')
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

            <!-- FOR ERROR MESSAGES -->

           <!-- END FOR ERROR MESSAGES -->

            <!-- Form for login -->
          <form action="{{route('postlogin')}}" method="POST" class="sign-in-form">
            @csrf

            <h2 class="title">Sign In</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" required placeholder="Username" name="email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" />
            </div>
            <input type="submit"  required value="Login" class="btn solid" />
          </form>

          <!-- END FOR LOGIN FORM  -->

          <!-- FORM FOR REGISTRATION-->

          <form action="{{route('postregister')}}" method="POST" class="sign-up-form">
            @csrf
            <h2 class="title">Sign Up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" required placeholder="Name"  name="username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" required placeholder="Email"  name="email"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" required placeholder="Password"  name="password"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" required placeholder="Confirm password"  name="password_confirmation" />
            </div>
            <input type="submit" value="Sign Up" class="btn solid" />
          </form>

          <!-- END FOR REGISTERATION FORM  -->
        </div>
      </div>
      <div class="panels-container">

        <div class="panel left-panel">
            <div class="content">
                <h3 >New here?</h3>
                <p>If you are new here and you don't have account please register first and be a part of us</p>
                <button class="btn transparent" id="sign-up-btn">Back </button>
            </div>
            <img src="assets/img/Truck.svg" class="image" alt="">
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>One of us?</h3>
                <p>Hurry up and sign in to start exploring our services </p>
                <button class="btn transparent" id="sign-in-btn">Sign In</button>
            </div>
            <img src="" class="image" alt="">
        </div>
      </div>
    </div>

    <script src="{{asset('assets/js/app.js')}}"></script>
  </body>
</html>
