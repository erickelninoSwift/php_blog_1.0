<?php require "../includes/header.php" ?>
<!-- connection -->
<?php require "../config/config.php"  ?>
<?php

    if(isset($_SESSION['email']) && isset($_SESSION['username'])) {
        header('location: http://localhost:8888/blog/blog_project_1.0/blog/index.php');
    }
    //
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        //
    // check if the submit 
    if(isset($_POST["submit"])) {
        //
        if (empty($_POST["email"])|| empty($_POST['password']) ) {
            
         echo "error : provide all fields";
       
       } else {
        // save all fields in variables

         $email = trim($_POST["email"]);
         $password = trim($_POST["password"]);
         // write query

         $query = $connection->query("SELECT * FROM users WHERE email='$email' LIMIT 1");
         // execute and fetch
          $query->execute();
         // do our row count fetch as an aosociative array
         $row = $query->fetch(PDO::FETCH_ASSOC);
         // do our passport verify + redirect to the index page
         $row_cout = $query->rowCount();
         if($row_cout > 0) {
            // if user was found then everything will happen here 
            $user_name = $row["user_name"];
        
            if (password_verify($password, $row["password"])) {
               //
               $_SESSION['username'] = $row['user_name'];
               $_SESSION['email'] = $row['email'];
               $_SESSION['user_id'] = $row['user_id'];
               // i saved the user object in a session 
               $_SESSION['user_object'] = $row;

                header("location: http://localhost:8888/blog/blog_project_1.0/blog/index.php");
               

               
            }else {
                  header("location: http://localhost:8888/blog/blog_project_1.0/blog/404.php");
            }
            
         }else {

             header("location: http://localhost:8888/blog/blog_project_1.0/blog/404.php");
         }
       }

    }}
?>
<form method="POST" action="login.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

    </div>


    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>a new member? Create an acount<a href="register.php"> Register</a></p>

    </div>
</form>


<?php require "../includes/footer.php" ?>