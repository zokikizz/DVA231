<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">


    <!--MatirialIcons-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--FontAwsomeIcons-->
    <link rel="stylesheet" href="font-awesome-4.7.0\font-awesome-4.7.0\css\font-awesome.css">
    <link rel="stylesheet" href="font-awesome-4.7.0\font-awesome-4.7.0\css\font-awesome.min.css">

  </head>
  <body>


      <form class="" action="loginProcess.php" method="post">
        <div class="logo">
          <i class="fa fa-imdb fa-5x" aria-hidden="true"></i>
        </div>

        <div class="inputPart">
          <div>Username:</div>
          <input type="text" name="username" placeholder="username">
          <div>Password:</div>
          <input type="password" name="password" placeholder="password">
          <!--<input type="submit" name="submit" value="Login">
          <button class="logInButton" onCLick="logIn()" type="button"
           name="logIn" name="button">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
          </button>
           -->

          <div class="loginButtonDiv" >
            <button type="submit" name="submit">
              <i class="fa fa-sign-in" aria-hidden="true"></i> Login
            </button>
          </div>

        </div>

      </form>



  </body>
</html>
