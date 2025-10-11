<?php require __DIR__ ."/../layout/header.php"; ?>
<?php

if(!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
       header("Location: http://localhost:8888/blog/blog_project_1.0/blog/login.php");
       exit();
   };

    if (!isset($_GET['id'])) {
        header("Location: " . base_url('admin/categories/show'));
        exit();
    }

    if (isset($_GET['id'])) {
         $category_to_update = $_GET['id'];
         $query = "SELECT * FROM categories WHERE id = :id";
         $stmt = $connection->prepare($query);
         $stmt->bindParam(':id', $category_to_update);
         $stmt->execute();
         $category = $stmt->fetch(PDO::FETCH_ASSOC);
    };

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];

        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $category_to_update);

        if ($stmt->execute()) {
            header("Location: " . base_url('admin/categories/show'));
            exit();
        } else {
            echo "Error updating category.";
        }
    }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name"
                                value="<?php echo $category['name']; ?>" />

                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
</body>

</html>