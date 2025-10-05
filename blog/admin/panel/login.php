<?php include __DIR__ . "/../layout/header.php"; ?>
<?php
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $connection->prepare("SELECT * FROM admins WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<pre>";
        print_r($admin);
        echo "</pre>";

        echo gettype($stmt->rowCount());


        if ($stmt->rowCount() > 0) {
            // Login successful
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['admin_username'] = $admin['admin_name'];
            header("Location: " . base_url('admin/index'));
            exit();
        } else {
            // Login failed
            echo "<div class='alert alert-danger' role='alert'>Invalid email or password.</div>";
        }
    
    }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mt-5">Login</h5>
                    <form method="POST" class="p-auto" action="login.php">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="form2Example1" class="form-control"
                                placeholder="Email" />

                        </div>


                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="form2Example2" placeholder="Password"
                                class="form-control" />

                        </div>



                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . "/../layout/footer.php"; ?>