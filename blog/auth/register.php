<!-- header -->
<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"  ?>

<?php

 if(isset($_SESSION['email']) && isset($_SESSION['username'])) {
        header('location: http://localhost:8888/blog/blog_project_1.0/blog/index.php');
    }

// check if the server metho is get or post
      if($_SERVER['REQUEST_METHOD'] === "POST") {
        //

        if(isset($_POST["submit"])) {
            //
            if(empty($_POST["email"]) || empty($_POST['username']) || empty($_POST['password'])) {
                echo 'Please make sure all fields are provided';
            }else {
                //continue with registration
                $email = trim($_POST['email']);
                $username = trim($_POST['username']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                //query
                $query = $connection->prepare("INSERT INTO users (email,user_name,password) VALUES (:email,:username,:password)");
                //execute function thats hwere you bind your data 
                $query ->execute([
                    "email"=> $email,
                    "username"=> $username,
                    "password"=> $password
                ]);

                //redirect us to the login page

                header("location: login.php");
                
            };
        }

      }else {
         header("location: http://localhost:8888/blog/blog_project_1.0/blog/404.php");
      }
 ?>

<form method="POST" action="register.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

    </div>

    <div class="form-outline mb-4">
        <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />

    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

    </div>



    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>Aleardy a member? <a href="login.php">Login</a></p>



    </div>
</form>

<!-- Footer-->
<?php require "../includes/footer.php"?>