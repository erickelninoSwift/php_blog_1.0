<?php define('BASE_URL', '/blog/blog_project_1.0/blog/');
session_start();
   function base_url($path) {
         return BASE_URL . $path . '.php';
   }
   function base_styles() {
            return BASE_URL . 'admin/styles/style.css';
   }
 
?>
<?php
 
 session_start();
    session_unset();
    session_destroy();
    header("Location: " . base_url('admin/panel/login'));
    exit(); 
?>