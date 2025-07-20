<?php include "../config/config.php";?>
<!-- Page Header-->
<?php include "../includes/navbar.php";?>

<?php 
   // 
   if(isset($_GET['id'])) {
       //
       $id = $_GET['id'];
       $fetch_post = $connection->query("SELECT * FROM posts WHERE id='$id'");
       $fetch_post->execute();
       $post = $fetch_post->fetch(PDO::FETCH_ASSOC);
   }

?>

<header class="masthead" style="background-image: url('./images/<?php echo $post['img']; ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?php echo $post['title'] ?></h1>
                    <h2 class="subheading"><?php echo $post['subtitle'] ?></h2>
                    <span class="meta">
                        Posted by
                        <a href="#!"><?php echo $_SESSION['username'] ?? ""; ?></a>
                        <?php echo date("F j, Y", strtotime($post['created_at'])); ?>
                    </span>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p><?php echo $post['body']?></p>
                <p>
                    <?php if(isset($_SESSION['email'])): ?>

                    <a class="btn btn-danger text-center"
                        href="http://localhost:8888/blog/blog_project_1.0/blog/posts/delete.php?del_id=<?php echo $post['id']; ?>"
                        style="text-decoration:none;">Delete</a>
                    <a class="btn btn-warning text-center text-white"
                        href="http://localhost:8888/blog/blog_project_1.0/blog/posts/update.php?update_id=<?php echo $post['id']; ?>"
                        style="text-decoration: none;">Update</a>
                    <?php endif;?>
                </p>
            </div>
        </div>
    </div>
</article>
<!-- Footer-->
<?php include "../includes/footer.php"; ?>