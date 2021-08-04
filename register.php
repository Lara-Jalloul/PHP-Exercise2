<?php
require_once 'vendor/autoload.php';
use App\Classes\User;


use PDO;
use PDOException;

require_once 'vendor/autoload.php';


$username_error=""; $pass_error=""; $email_error=""; 

if(isset($_POST['btn-signup']))
{
   $uname = trim($_POST['txt_uname']);
   $umail = trim($_POST['txt_umail']);
   $upass = trim($_POST['txt_upass']); 
   
   
   //validate username
   $user = new User();
   if(empty($uname)){
     $username_error = "Username is required!";
   }else if($user->findUserByName($uname)){
     $username_error = "Sorry username already taken!";
   }

  

   //validate email
   $user = new User();
   if(empty($umail)){
     $email_error = "Email is required!";
    }else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)){
      $email_error = 'Please provide us with a valid email!';
    } else if($user->findUserByEmail($umail)){
      $email_error = 'Sorry email already taken!';
    }


    //validate password
    if(empty($upass)){
      $pass_error = "Password is required!";
    }else{
      $uppercase = preg_match('@[A-Z]@', $upass);
      $lowercase = preg_match('@[a-z]@', $upass);
      $number    = preg_match('@[0-9]@', $upass);
      $specialChars = preg_match('@[^\w]@', $upass);

      if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($upass) < 8) {
        $pass_error = 'Password should be at least 8 characters, include at least one upper case letter, one number, and one special character.';
      }
    }

    if (empty($email_error) && empty($username_error) && empty($pass_error)) {

      $user = new User();
      if($user->register($uname,$umail,$upass))
      {
        $user->redirect('register.php');
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
        <h1>REGISTER</h1>
        <form method="post">
          <div>
          <input type="text" name="txt_uname" placeholder="Username" value="<?php echo $uname; ?>"/>
          <span class="alert"> <?php echo $username_error; ?></span>
          </div>
          <div>
          <input type="email" name="txt_umail" placeholder="Email" value="<?php echo $umail; ?>"/>
          <span class="alert"> <?php echo $email_error; ?></span>
          </div>
          <div>
          <input type="password" name="txt_upass" placeholder="Password" value="<?php echo $upass; ?>"/>
          <span class="alert"> <?php echo $pass_error; ?></span>
          </div>
          <button type="submit" name="btn-signup">Create Account</button>
        </form>
        <p class="loginP">
          Already have an account? <a href="index.php"> Sign In</a>
        </p>
      </div>
    </div>
  </body>
</html>