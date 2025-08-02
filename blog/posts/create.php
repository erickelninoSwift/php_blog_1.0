<?php include "../includes/header.php"?>
<?php include "../config/config.php" ?>
<?php include "../categories/all_catorgies.php"; ?>
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
         $catgory_id = $_POST['category_id'];
         $file = $_FILES['file']['name'];
         //SESSION CURRENT USER
         $current_user = $_SESSION['email'];
         $current_user_id = $_SESSION['user_id'];

         echo $current_user;

         $dir = "images/" . basename($file);

         // Query first -> connection ->prepare
         $query = $connection->prepare("INSERT INTO posts (title, subtitle, body, category_id, img, user_id) VALUES (:title, :subtitle, :body, :category_id, :img, :user_id)");
         // execute the query : $query -> execute
         $query->execute([
            "title" => $title,
            "subtitle" => $subtitle,
            "body" => $body,
            "category_id" => $catgory_id,
            "img" => basename($_FILES['file']['name']),
            "user_id" => $current_user_id
         ]);

         if(move_uploaded_file($_FILES['file']['tmp_name'], $dir)){
              echo "File was uploaded";
              header('location: http://localhost:8888/blog/blog_project_1.0/blog/index.php');
         }
         
    }

   }else {
       header("location: http://localhost:8888/blog/blog_project_1.0/blog/404.php");
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
        <select name="category_id" class="form-select" aria-label="Select a category">
            <option selected disabled>Select a category</option>
            <?php foreach($all_categories as $cat): ?>
            <option name="category_id" value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="form-outline mb-4">
        <input type="file" name="file" id="form2Example1" class="form-control" placeholder="file" />
    </div>


    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


</form>



</div>
<!-- Footer-->
<?php include "../includes/footer.php"?>