  <?php include "./includes/home_header.php" ?>
  <?php include "./config/config.php" ?>
  <!-- Main Content-->
  <?php
    // only if the user have logged in 
     if(isset($_SESSION['user_id']) && isset($_SESSION['email'])) {

       $current_user_id = $_SESSION['user_id'];
       $query = $connection->query("SELECT * FROM users WHERE user_id='$current_user_id'");
       $query->execute();
       //
       $user = $query->fetch(PDO::FETCH_ASSOC);
       //
       if(isset($user['user_id'])) {
         // the user exist now we will fetch the post

          $query_posts = $connection->query("SELECT * FROM posts WHERE user_id='$current_user_id'");
          $query_posts->execute();
          $user_posts_rows = $query_posts->fetchAll(PDO::FETCH_ASSOC);
          
       }
     }else {
        //
         $fetch_posts_query = $connection->prepare("SELECT posts.*, users.user_name FROM posts JOIN users ON posts.user_id=users.user_id");
         $fetch_posts_query->execute();
         $posts_random = $fetch_posts_query->fetchAll(PDO::FETCH_ASSOC);
         $row_number = $fetch_posts_query->rowCount();
         // 
         
     }
 
 ?>
  <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
          <div class="col-md-10 col-lg-8 col-xl-7">
              <?php if(isset($_SESSION['username']) && isset($_SESSION['email'])){
                echo 'Hello, ' . $_SESSION['username'];
              } ?>
              <!-- Post preview-->
              <?php if(isset($_SESSION['username']) && isset($_SESSION['email'])): ?>
              <?php foreach($user_posts_rows as $row) :?>
              <div class="post-preview">
                  <a
                      href="http://localhost:8888/blog/blog_project_1.0/blog/posts/post.php?id=<?php echo $row['id']; ?>">
                      <h2 class="post-title"><?php echo $row['title']; ?></h2>
                      <h3 class="post-subtitle"><?php echo $row['subtitle']; ?></h3>
                  </a>
                  <p class="post-meta">
                      Posted by <b style="color: black;"><?php echo $user['user_name']. "  "; ?></b>
                      <?php echo date("F j, Y", strtotime($row['created_at'])); ?>
                  </p>
              </div>
              <!-- Divider-->
              <hr class="my-4" />
              <?php endforeach; ?>
              <?php endif;?>

              <?php if(!isset($_SESSION['email'])):?>
              <?php for($x = 0; $x < $row_number; $x++):?>
              <div class="post-preview">
                  <a
                      href="http://localhost:8888/blog/blog_project_1.0/blog/posts/post.php?id=<?php echo $posts_random[$x]['id']; ?>">
                      <h2 class="post-title"><?php echo $posts_random[$x]['title']; ?></h2>
                      <h3 class="post-subtitle"><?php echo $posts_random[$x]['subtitle']; ?></h3>
                  </a>
                  <p class="post-meta">
                      Posted by <b style="color: black;"><?php echo $posts_random[$x]['user_name']. "  "; ?></b>
                      <?php echo date("F j, Y", strtotime($posts_random[$x]['created_at'])); ?>
                  </p>
              </div>
              <!-- Divider-->
              <hr class="my-4" />
              <?php endfor;?>
              <?php endif; ?>
          </div>

      </div>
  </div>
  <!-- Footer-->
  <?php include "./includes/home_footer.php"; ?>