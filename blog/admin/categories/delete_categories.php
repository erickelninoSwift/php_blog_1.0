<?php include __DIR__ . "/../../config/config.php"; ?>
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
     if(isset($_GET['id'])) {
          $category_id = $_GET['id'];
          $query = "DELETE FROM categories WHERE id = :id";
          $stmt = $connection->prepare($query);
          $stmt->bindParam(':id', $category_id);
          $stmt->execute();
          if($stmt->rowCount() > 0) {
               header("Location: " . base_url('admin/categories/show'));
               exit();
          } else {
               echo "<div class='alert alert-danger' role='alert'>Error deleting category.</div>";
          }
     } else {
          header("Location: " . base_url('admin/categories/show'));
          exit();
     }

?>