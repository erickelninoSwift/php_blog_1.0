<?php require __DIR__ ."/../layout/header.php"; ?>
<?php
   
   if(isset($_POST['submit'])) {
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      //hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // insert into database
      $query = "INSERT INTO admins (admin_name, email, password) VALUES (:username, :email, :password)";
      $stmt = $connection->prepare($query);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $hashed_password);

      if($stmt->execute()) {
         //redirect to index page
         header("Location: " . base_url('admin/index'));
         exit();
      }
   }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Admins</h5>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="email" name="email" id="form2Example1" class="form-control"
                                placeholder="email" />

                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="form2Example1" class="form-control"
                                placeholder="username" />
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="form2Example1" class="form-control"
                                placeholder="password" />
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