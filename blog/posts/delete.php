<?php include "../config/config.php"; ?>
<?php
    
if(isset($_GET['del_id'])) {
    //
    $post_id = $_GET['del_id'];
    echo $post_id;

    $select_query = $connection->prepare("SELECT * FROM posts WHERE id=:id");

    $select_query->execute([
        ":id" => $post_id
    ]);

    $current_post = $select_query->fetch(PDO::FETCH_ASSOC);

    $num_row = $select_query->rowCount();

    if($num_row > 0) {
       //delete now
       $dir_name = "images/" . $current_post['img'];
       unlink($dir_name . "");
       
          // $delete_query = $connection->query("DELETE *  FROM posts WHERE id= :id");
     $delete_query = $connection->prepare("DELETE FROM posts WHERE id=:current_post_id");
     
     $delete_query->execute([
        "current_post_id" => $post_id,
     ]);
    
    header('location: http://localhost:8888/blog/blog_project_1.0/blog/index.php');

    }

    exit();
}
?>