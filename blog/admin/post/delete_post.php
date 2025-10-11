<?php
include __DIR__ . "/../../config/config.php";
define('BASE_URL', '/blog/blog_project_1.0/blog/');
session_start();

function base_url($path) {
    return BASE_URL . $path . '.php';
}

if (isset($_GET['id'])) {
    $post_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$post_id) {
        echo "<div class='alert alert-danger'>Invalid post ID.</div>";
        exit;
    }

    $query = "DELETE FROM posts WHERE id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            header("Location: " . base_url('admin/post/show'));
            exit;
        } else {
            echo "<div class='alert alert-warning'>Post not found (ID: $post_id).</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Failed to execute delete query.</div>";
    }
} else {
    header("Location: " . base_url('admin/post/show'));
    exit;
}
?>