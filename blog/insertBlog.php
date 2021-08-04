<?php
session_start();
require_once ("../vendor/autoload.php");

use App\Classes\Blog;

$user_session = $_SESSION['user_session'];
if (!isset($_SESSION['user_session']) && empty($_SESSION['user_session'])) {
    header('Location: ../index.php');
} else {
  if (isset($_POST['addBlog'])) {

    $btitle = $_POST['title'];
    $boverview = $_POST['overview'];
    $bcontent = $_POST['content'];
    $bdate = $_POST['Date_Of_Publishing'];

    if(empty($btitle)){
        $btitle_error = "Title is required!";
    }
    if(empty($boverview)){
        $boverview_error = "Overview is required!";
    }
    if(empty($bcontent)){
        $bcontent_error = "Content is required!";
    }
    if(empty($bdate)){
        $bdate_error = "Date of publishing is required!";
    }
    
    if(empty($btitle_error) && empty($boverview_error) && empty($bcontent_error) && empty($bdate_error)){
        $blog = new Blog();
        if($blog->InsertBlog($btitle, $boverview, $bcontent, $bdate, $_SESSION['user_session']))
        {
          $add_error = "Successful";  
        }else{
         echo "Wrong Details!";
        }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
  <title>Blog Page</title>
  <link rel="stylesheet" href="blogs.css">
</head>

<body>
  <nav class="nav">
    <h1 class="nav-logo">Hello <?php echo $_SESSION['username'] ?> !</h1>
    <hr class="nav__line" />
    <ul class="nav-links">
      <a class="nav-link" href='blogs.php'>
        <li class="active">Blogs</li>
      </a>

      <a class="nav-link" href='../file/files.php'>
        <li>Files</li>
      </a>

      <a class="nav-link" href='../logout.php'>
        <li>Logout</li>
      </a>
    </ul>
  </nav>

  <div class="div-wrapper">
    <div class="component-div">
      <span class="component-name">Add Blog</span>
      <span class="reply">

      </span>
    </div>
    <form action="" method="POST">
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" placeholder="Enter the title" value="<?php echo $btitle; ?>"/>
        <span class="alert"> <?php echo $btitle_error; ?></span>
      </div>
      <div class="form-group">
        <label>Overview </label>
        <input type="text" name="overview" placeholder="Enter the overview" value="<?php echo $boverview; ?>" />
        <span class="alert"> <?php echo $boverview_error; ?></span>
      </div>
      <div class="form-group">
        <label>Content </label>
        <textarea value="<?php echo $bcontent; ?>" id="editor" name="content" cols="30" rows="10"></textarea>
        <span class="alert"> <?php echo $bcontent_error; ?></span>
      </div>
      <div class="form-group">
        <label>Date Of Publishing </label>
        <input value="<?php echo $bdate; ?>" type="date" name="Date_Of_Publishing" placeholder="Enter the date of publishing" />
        <span class="alert"> <?php echo $bdate_error; ?></span>
      </div>
      <div class="form-group">
        <button style="border: none; font-size: 18px;" name="addBlog" class="link-btn">Add Blog</button>
        <span class="alert"> <?php echo $add_error; ?></span>
      </div>
      <div class="form-group">
        <a href="blogs.php" style="border: none; font-size: 18px;" name="back" class="link-btn">Go Back</a>
      </div>
    </form>
  </div>

  <script type="text/javascript">
    let editor = document.getElementById("editor")
    let value = editor.attributes.value.value
    CKEDITOR.replace('editor', {
      width: "100%",
      height: "200px"

    })
    if (value != '')
      CKEDITOR.instances['editor'].setData(value)
  </script>
</body>

</html>