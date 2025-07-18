<?php include "../includes/header.php"?>
<?php include "../config/config.php" ?>
<?php 
// check if method first 

   if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //
    if(empty($_POST['title']) || empty($_POST['subtitle']) || empty($_POST['body']) || empty($_FILES['file']['name'])) {
        //
         echo "please make sure all fields are provided";

    }else {
         $title = trim($_POST['title']);
         $subtitle = trim($_POST['subtitle']);
         $body = trim($_POST['body']);
         $file = $_FILES['file']['name'];
         //SESSION CURRENT USER
         $current_user = $_SESSION['email'];
         $current_user_id = $_SESSION['user_id'];

         echo $current_user;

         print_r([
            "title" => $title,
            "subtitle" => $subtitle,
            "body" => $body,
            "file" => basename($_FILES['file']['name'])
         ]);

         $dir = "images/" . basename($file);

         $query = $connection->prepare("INSERT INTO posts (title, subtitle, body, img) VALUES (:title, :subtitle, :body, :img)");
         $query->execute([
            "title" => $title,
            "subtitle" => $subtitle,
            "body" => $body,
            "file" => basename($_FILES['file']['name'])
         ]);

         if(move_uploaded_file($_FILES['file']['tmp_name'], $dir)){
              echo "File was uploaded";
              header('location: http://localhost:8888/blog/blog_project_1.0/blog/index.php')
         }
         
    }

   }
?>

<form method="POST" action="create.php" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />

    </div>

    <div class="form-outline mb-4">
        <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
    </div>

    <div class="form-outline mb-4">
        <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body"
            rows="8"></textarea>
    </div>


    <div class="form-outline mb-4">
        <input type="file" name="file" id="form2Example1" class="form-control" placeholder="file" />
    </div>


    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


</form>



</div>
<!-- Footer-->
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2022</div>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../js/script.js"></script>
</body>

</html>