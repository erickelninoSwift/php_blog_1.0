<?php require __DIR__ ."/../layout/header.php"; ?>
<?php 

if(!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
       header("Location: http://localhost:8888/blog/blog_project_1.0/blog/login.php");
       exit();
   };
  
   if(isset($_POST['submit'])) {
      $name = $_POST['name'];

      // insert into database
      $query = "INSERT INTO categories (name) VALUES (:name)";
      $stmt = $connection->prepare($query);
      $stmt->bindParam(':name', $name);

      if($stmt->execute()) {
         //redirect to index page
         header("Location: " . base_url('admin/categories/show'));
         exit();
      }
   };
   ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Categories</h5>
                    <form method="POST" action="">
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


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