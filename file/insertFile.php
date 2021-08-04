<?php
session_start();
require_once realpath("../vendor/autoload.php");

use App\Classes\File;


if (!isset($_SESSION['user_session']) && empty($_SESSION['user_session'])) {
    header('Location: ../index.php');
// }else {
//   if (isset($_POST['addFile'])) {
//     $file = new File();
//     $file->addFile($_SESSION['user_session']);
//   }
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dashboard page for admins. Here admins can add their own files">

  <title>Blog Page | Admin's Files</title>
  <link rel="stylesheet" href="files.css">
</head>

<body>
  <nav class="nav">
    <h1 class="nav-logo">Hello Admin</h1>
    <hr class="nav__line" />
    <ul class="nav-links">
      <a class="nav-link" href='../blog/blogs.php'>
        <li>Blogs</li>
      </a>

      <a class="nav-link" href='files.php'>
        <li class="active">Files</li>
      </a>

      <a class="nav-link" href='../blog/logout.php'>
        <li>Logout</li>
      </a>
    </ul>
  </nav>

  <div class="div-wrapper">
    <div class="component-div">
      <span class="component-name">Add File</span>
      <span class="reply">

      </span>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>File name</label>
        <input type="text" name="name">
        <span class="alert"> <?php echo $fname_error; ?></span>
      </div>
      <input style="margin-bottom: 10px;" type="file" name="fileUpload">
      <span class="alert"> <?php echo $upload_error; ?></span>
      <div class="form-group">
        <button style="border: none; font-size: 18px;" name="addFile" class="link-btn">Add File</button>
      </div>
      <div class="form-group">
        <a href="files.php" style="border: none; font-size: 18px;" name="back" class="link-btn">Go Back</a>
      </div>
    </form>
  </div>
</body>

</html>
