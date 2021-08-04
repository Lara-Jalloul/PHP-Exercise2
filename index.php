<?php
session_start();
require_once 'vendor/autoload.php';
use App\Classes\User;


// $user = new User();
// if($user->is_loggedin()!="")
// {
//  $user->redirect('home.php');
// }

$uname_error=""; $pass_error="";

if (isset($_POST['btn-login'])) {
    $uname = trim($_POST['txt_uname_email']);
    $umail = trim($_POST['txt_uname_email']);
    $upass = trim($_POST['txt_password']);

    if(empty($uname)){
      $uname_error = "Email or Username is required!";
    }

    if(empty($upass)){
      $pass_error = "Password is required!";
    }

    if(empty($pass_error) && empty($uname_error)){
      $user = new User();
      if($user->login($uname,$umail,$upass))
      {
        $user->redirect('blog/blogs.php');
      }else{
       echo "Wrong Details!";
      }
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login and Registration Form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="register-form">
        <figure class="register-logo">
          <img
            src="https://raw.githubusercontent.com/alaattinerby/Kodluyoruz-Work01-Register-Form/main/Work01/img/logo.png"
            alt="Logo"
          />
        </figure>
        <h1>LOGIN</h1>
        <form method="post">
          <div>
          <input type="text" name="txt_uname_email" placeholder="Username or Email" value="<?php echo $uname; ?>"/>
          <span class="alert"> <?php echo $uname_error; ?></span>
        </div>
        <div>
          <input type="password" name="txt_password" placeholder="Password" value="<?php echo $upass; ?>"/>
          <span class="alert"> <?php echo $pass_error; ?></span>
        </div>
          <button type="submit" name="btn-login">Sign In</button>
        </form>
        <p class="loginP">
          Don't have account yet ! <a href="register.php">Sign Up</a>
        </p>
      </div>
    </div>
  </body>
</html>
