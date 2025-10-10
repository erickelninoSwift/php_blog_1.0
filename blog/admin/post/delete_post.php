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
    if (isset($_GET['id'])) {
    // Sanitize and validate the ID
    $post_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($post_id === false || $post_id === null) {
        echo "<div class='alert alert-danger' role='alert'>Invalid post ID.</div>";
        exit;
    }

    // Prepare and execute DELETE query
    $query = "DELETE FROM posts WHERE id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Successfully deleted
        header("Location: " . base_url('admin/post/show'));
        exit;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting post or post not found.</div>";
    }
} else {
    // No ID passed
    header("Location: " . base_url('admin/post/show'));
    exit;
}

?>