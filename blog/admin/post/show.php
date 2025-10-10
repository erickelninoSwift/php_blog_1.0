<?php include __DIR__ . "/../layout/header.php";  ?>
<?php 
   $query = "SELECT posts.*, users.*, categories.*
          FROM posts 
          JOIN users ON posts.user_id = users.user_id 
          JOIN categories ON posts.category_id = categories.id";
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
                                <th scope="col">user</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($posts as $index=>$post): ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1; ?></th>
                                <td><?php echo $post['title']; ?></td>
                                <td><?php echo $post['name']; ?></td>
                                <td><?php echo $post['user_name']; ?></td>
                                <td><a href="http://localhost:8888/blog/blog_project_1.0/blog/admin/post/delete_post.php?id=<?php echo $post['id']; ?>"
                                        class="btn btn-danger  text-center ">delete</a>
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
<script type="text/javascript">

</script>
</body>

</html>