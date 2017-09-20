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
          <span>Username:</span>
          <input type="text" name="username" placeholder="username">
          <span>Password:</span>
          <input type="text" name="password" placeholder="password">
          <!--<input type="submit" name="submit" value="Login">-->
          <button type="submit" name="submit">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
          </button>

        </div>

      </form>




  </body>
</html>
