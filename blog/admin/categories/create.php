<?php require __DIR__ ."/../layout/header.php"; ?>
<?php 


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
    <?php if(isset($_SESSION['admin_username'])): ?>
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