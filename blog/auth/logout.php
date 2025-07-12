<?php 
  
  session_start();
  session_unset();
  session_destroy();
  
  $_SESSION = [];

  header("location: http://localhost:8888/blog/blog_project_1.0/blog/index.php");