<?php include "../config/config.php" ?>
<?php
     

if(isset($_GET['del_id'])) {
    //
    $post_id = $_GET['del_id'];
    $delete_query = $connection->query("DELETE *  FROM posts WHERE id= :id");

    $delete_query->execute([
        "id" => $post_id
    ]);
    
    header('location: http://localhost:8888/blog/blog_project_1.0/blog/index.php');
}
?>