<?php include "../config/config.php" ?>
<?php include "../includes/navbar.php"; ?>
<?php if(!isset($_SESSION['email']) || !isset($_SESSION['user_name'])) {
        header('locoation: http://localhost:8888/blog/blog_project_1.0/blog/index.php');
}?>
<?php 
    if(isset($_GET['update_id'])) {
        //
        $post_id = $_GET['update_id'];
        $user_id = $_SESSION['user_id'];
        // fetch 
        $fetch_posts = $connection->prepare("SELECT * FROM posts WHERE id=:id");
        $fetch_posts->execute([
            ":id"=> $post_id
        ]);
        $all_posts = $fetch_posts->fetch(PDO::FETCH_ASSOC);
        $number_row = $fetch_posts->rowCount();

        if(isset($_SESSION['user_id']) && $number_row > 0 && isset($_POST['submit'])) {
           
         $title = trim($_POST['title']);
         $subtitle = trim($_POST['subtitle']);
         $body = trim($_POST['body']);
        $file = basename($_FILES['file']['name']);
        //
         $dir = "images/" . basename($file);
        echo $file;

             $update = $connection->prepare("UPDATE posts SET title=:title, subtitle=:subtitle, body=:body, img=:image WHERE id= :id");
             
             // execute
             $update->execute([
                ":title" => $title,
                ":subtitle" => $subtitle,
                ":body" => $body,
                ":image" => $file,
                ":id" => $post_id,
             ]);
            
             // after update 
             if(move_uploaded_file($_FILES['file']['tmp_name'], $dir)){

               header("location: http://localhost:8888/blog/blog_project_1.0/blog/posts/post.php?id=". $post_id);
         }
            
        }
       
    }
?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('./images/<?php echo $all_posts['img'];?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h2><?php echo $all_posts['title']; ?></h2>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content-->
<div class="container px-4 px-lg-5">

    <form method="POST" action="" enctype="multipart/form-data">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title"
                value="<?php echo $all_posts['title']?>" />

        </div>

        <div class="form-outline mb-4">
            <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle"
                value="<?php echo $all_posts['subtitle']?>" />
        </div>

        <div class="form-outline mb-4">
            <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="Description"
                rows="8"><?php echo $all_posts['body'];?></textarea>
        </div>

        <img class="mb-4" src="./images/<?php echo $all_posts['img']; ?>" width="100%" height="400px"
            alt="upload picture" />

        <!-- #region -->
        <div class="form-outline mb-4">
            <input type="file" name="file" id="form2Example1" class="form-control" placeholder="image" />
        </div>


        <!-- Submit button -->
        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


    </form>



</div>
<!-- Footer-->
<?php include "../includes/footer.php" ?>