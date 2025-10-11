<?php include __DIR__ . "/../layout/header.php";  ?>
<?php 
   
   $query = "SELECT 
    posts.id AS post_id,
    posts.title,
    posts.status AS post_status,
    posts.created_at AS post_created_at,
    users.user_id AS author_id,
    users.user_name AS author_name,
    users.email AS author_email,
    categories.id AS category_id,
    categories.name AS category_name
FROM posts
JOIN users ON posts.user_id = users.user_id
JOIN categories ON posts.category_id = categories.id
";

   $stmt = $connection->prepare($query);
   $stmt->execute();
   $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
   if($stmt->rowCount() == 0){
       echo "<h1 class='text-center text-danger'>No Posts Found</h1>";
       die();
   }

    //fetch user and category for each pos

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Posts</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">title</th>
                                <th scope="col">category</th>
                                <th scope="col">status</th>
                                <th scope="col">user</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($posts as $index=>$post): ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1; ?></th>
                                <td><?php echo $post['title']; ?></td>
                                <td><?php echo $post['category_name']; ?></td>
                                <td>
                                    <a
                                        href="http://localhost:8888/blog/blog_project_1.0/blog/admin/post/update_status.php?status=<?php echo $post['post_status']; ?>&id=<?php echo $post['post_id']; ?>">
                                        <span
                                            class="badge <?php if($post['post_status'] == 1) { echo 'bg-success'; } else { echo 'bg-warning'; } ?> text-white"
                                            style="padding: 8px 14px; font-size: 0.8rem;">
                                            <?php echo $post['post_status'] == 1 ?  "Activated" : "Deactivated"; ?>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo $post['author_name']; ?></td>
                                <td>
                                    <a href="http://localhost:8888/blog/blog_project_1.0/blog/admin/post/delete_post.php?id=<?php echo $post['post_id']; ?>"
                                        class="btn btn-danger btn-sm text-center">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?php if(!isset($_SESSION['admin_username'])): ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mt-5">You are not logged in. Please <a
                        href="<?php echo base_url('admin/panel/login'); ?>">login</a> to access the admin panel.
                </h5>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">

</script>
</body>

</html>