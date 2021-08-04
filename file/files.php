<?php

require_once '../vendor/autoload.php';
use App\Classes\File;

session_start();

if (!isset($_SESSION['user_session']) && empty($_SESSION['user_session'])) {
    header('Location: ../index.php');
}
   else {
    $file = new File();
    $file = $file->getFiles();
   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Page</title>
  <link rel="stylesheet" href="files.css">
</head>

<body>
  <nav class="nav">
    <h1 class="nav-logo">Hello <?php echo $_SESSION['username'] ?> !</h1>
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
      <span class="component-name">Files</span>
    </div>
    <a class="link-btn" href='insertFile.php'>Insert New File</a>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>name</th>
          <th>size</th>
          <th>format</th>
          <th>path</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
            echo "<td>
            <a class='update-btn' href='updateFile.php?id=$id&name=$name&format=$format'>Update</a>
            <a class='delete-btn' href='deleteFile.php?id=$id&path=$fullPath'>Delete</a>
            <a class='update-btn' href='downloadFile.php?path=$fullPath'>Download</a>
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