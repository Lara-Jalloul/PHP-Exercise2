<?php
session_start();
require_once ("../vendor/autoload.php");

use App\Classes\Blog;

$blog_session = $_SESSION['blog'];
if (!isset($_SESSION['user_session']) && empty($_SESSION['user_session'])) {
    header('Location: ../index.php');
}  else {
    $blog = new Blog();
    $blog->deleteBlog($blog_session);
    header('Location: blogs.php');
}