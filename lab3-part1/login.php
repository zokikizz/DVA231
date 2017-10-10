<?php
// Include config file
require_once 'config.php';
require_once '/objects/users.php';
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }

    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            //$_SESSION['username'] = $username;      
                            //header("location: index.php");
                            $result = mysqli_query($link, "SELECT * FROM users
                            WHERE username='" . $_REQUEST["username"] . "';" );
                            $row = $result->fetch_row();
                            $_SESSION['user'] = new user($row[1], $row[0]);
                            
                                $res = mysqli_query($link, "SELECT movie_id FROM favorite_movies
                                  WHERE user_id=" . $_SESSION['user']->id .
                                  ";" );
                            
                                  $_SESSION['favoriteMovies'] = array();
                            
                                  while( $row = mysqli_fetch_array($res))
                                  {
                                    array_push($_SESSION['favoriteMovies'], $row[0]);
                                  }
                            
                                  header('Location: http://localhost:8013/index.php'); //redirect
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
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


      <form class=""  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="logo">
          <i class="fa fa-imdb fa-5x" aria-hidden="true"></i>
        </div>

        <div class="inputPart">
          <div>Username:</div>
          <input type="text" name="username" value="<?php echo $username; ?>">
          <div>Password:</div>
          <input type="password" name="password">
                  <div class="loginButtonDiv" >
            <button type="submit" value="Submit">
              <i class="fa fa-sign-in" aria-hidden="true"></i> Login
            </button>
          </div>
          <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

        </div>

      </form>



  </body>
</html>
