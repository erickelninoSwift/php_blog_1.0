<?php require __DIR__ ."/../layout/header.php"; ?>
<?php 

   
    $query = "SELECT * FROM categories";
    $stmt = $connection->prepare($query);
    $stmt->execute();

    $count = $stmt->rowCount();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
?>
<div class="container-fluid">
    <?php if(isset($_SESSION['admin_username'])): ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Categories</h5>
                    <a href="<?php echo base_url('admin/categories/create'); ?>"
                        class="btn btn-primary mb-4 text-center float-right">Create
                        Categories</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">update</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($categories as $index => $category) : ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1; ?></th>
                                <td><?php echo $category['name']; ?></td>
                                <td><a href="http://localhost:8888/blog/blog_project_1.0/blog/admin/categories/update.php?id=<?php echo $category['id']; ?>"
                                        class="btn btn-warning text-white text-center ">Update Categories</a>
                                </td>
                                <td><a href="http://localhost:8888/blog/blog_project_1.0/blog/admin/categories/delete_categories.php?id=<?php echo $category['id']; ?>"
                                        class="btn btn-danger  text-center ">Delete
                                        Categories</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

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