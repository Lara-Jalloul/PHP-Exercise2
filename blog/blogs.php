<?php

require_once '../vendor/autoload.php';
use App\Classes\Blog;

session_start();


$user_session = $_SESSION['user_session'];
if (!isset($_SESSION['user_session']) && empty($_SESSION['user_session'])) {
    header('Location: ../index.php');
}
   else {
    $blog = new Blog();
    $blog = $blog->getBlogs();
   
}
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Page</title>
  <link rel="stylesheet" href="blogs.css">
</head>

<body>
  <nav class="nav">
    <h1 class="nav-logo">Hello <?php echo $_SESSION['username'] ?> !</h1>
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
      <span class="component-name">Blogs</span>
    </div>
    <div class="btn">
    <a class="link-btn" href='insertBlog.php'>Add New Blog</a>
    <a style="margin-left: 20px;" class="link-btn" href='excel.php'>Export as excel sheet</a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>id</th>
          <th>TITLE</th>
          <th>OVERVIEW</th>
          <th>CONTENT</th>
          <th>DATE OF PUBLISHING</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
            echo "<td>
            <a class='update-btn' href='updateBlog.php?id=$blog_id'>Edit</a>
            <a class='delete-btn' href='deleteBlog.php?id=$blog_id'>Delete</a>
            </td>";
            echo "</tr>";
        ?> 
      </tbody>
    </table>
    <div class="paginated-div">
      <ul class="paginated-list">
        <a href="?page=<?php
                        if ($page == 1) {
                          echo 1;
                        } else {
                          echo $page - 1;
                        }
                        ?>">
          <li>prev</li>
        </a>
        <a href="?page=<?php
                        if ($total->total - $end < 0) {
                          echo $page;
                        } else {
                          echo $page + 1;
                        }
                        ?>">
          <li>next</li>
        </a>
      </ul>
    </div>
  </div>
</body>


</html>