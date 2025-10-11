<?php
include __DIR__ . "/../../config/config.php";

define('BASE_URL', '/blog/blog_project_1.0/blog/');
session_start();

function base_url($path) {
    return BASE_URL . $path; // removed .php for flexibility
}

if (isset($_GET['id']) && isset($_GET['status'])) {

    $post_id = $_GET['id']; // fixed key
    $status = $_GET['status'];

    $new_status = ($status == 1) ? 0 : 1;

    $query = "UPDATE posts SET status = :status WHERE id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':status', $new_status, PDO::PARAM_INT);
    $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: " . base_url('admin/post/show.php')); // explicit file
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error updating post status.</div>";
    }

} else {
    header("Location: " . base_url('admin/post/show.php'));
    exit();
}
?>