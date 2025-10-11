  <?php include "./includes/home_header.php" ?>
  <?php include "./config/config.php" ?>
  <!-- Main Content-->
  <?php
    // only if the user have logged in 
       $caterories_query = $connection->query("SELECT * FROM categories");
       $caterories_query->execute();
       $categories = $caterories_query->fetchAll(PDO::FETCH_ASSOC);

     if(isset($_SESSION['user_id']) && isset($_SESSION['email'])) {

       $current_user_id = $_SESSION['user_id'];
       $query = $connection->query("SELECT * FROM users WHERE user_id='$current_user_id'");
       $query->execute();
       //
       $user = $query->fetch(PDO::FETCH_ASSOC);
       //
       if(isset($user['user_id'])) {
         // the user exist now we will fetch the post

          $query_posts = $connection->query("SELECT * FROM posts WHERE user_id='$current_user_id' AND status=1");
          $query_posts->execute();
          $user_posts_rows = $query_posts->fetchAll(PDO::FETCH_ASSOC);
          
       }
     }else {
        //
         $fetch_posts_query = $connection->prepare("SELECT posts.*, users.user_name FROM posts JOIN users ON posts.user_id=users.user_id WHERE posts.status=1");
         $fetch_posts_query->execute();
         $posts_random = $fetch_posts_query->fetchAll(PDO::FETCH_ASSOC);
         $row_number = $fetch_posts_query->rowCount();
         // 
         
     }
 
 ?>
  <style>
.list-group-item:hover {
    background-color: #000 !important;
    color: #fff !important;
}
  </style>


  <div class="container mt-1">
      <div class="row" style="display: flex; justify-content: center;">
          <!-- Sidebar -->
          <aside class="col-md-3 mb-4" style="margin-top: 32px;">
              <div class="card">
                  <div class="card-header bg-dark text-white">
                      Categories
                  </div>
                  <ul class="list-group list-group-flush" style="cursor: pointer;">
                      <?php foreach($categories as $cat): ?>
                      <a
                          href="http://localhost:8888/blog/blog_project_1.0/blog/categories/category.php?id=<?php echo $cat['id']; ?>">
                          <li class="list-group-item"><?php echo $cat['name']; ?></li>
                      </a>
                      <?php endforeach; ?>
                  </ul>
              </div>
          </aside>

          <!-- Main Content -->
          <div class="col-md-9">
              <?php if(isset($_SESSION['username']) && isset($_SESSION['email'])){
          echo 'Hello, ' . $_SESSION['username'];
        } ?>

              <!-- Posts if logged in -->
              <?php if(isset($_SESSION['username']) && isset($_SESSION['email'])): ?>
              <?php foreach($user_posts_rows as $row): ?>
              <div class="post-preview">
                  <a
                      href="http://localhost:8888/blog/blog_project_1.0/blog/posts/post.php?id=<?php echo $row['id']; ?>">
                      <h2 class="post-title"><?php echo $row['title']; ?></h2>
                      <h3 class="post-subtitle"><?php echo $row['subtitle']; ?></h3>
                  </a>
                  <p class="post-meta">
                      Posted by <b style="color: black;"><?php echo $user['user_name']; ?></b>
                      <?php echo date("F j, Y", strtotime($row['created_at'])); ?>
                  </p>
              </div>
              <hr class="my-4" />
              <?php endforeach; ?>
              <?php endif; ?>

              <!-- Posts if not logged in -->
              <?php if(!isset($_SESSION['email'])): ?>
              <?php for($x = 0; $x < $row_number; $x++): ?>
              <div class="post-preview">
                  <a
                      href="http://localhost:8888/blog/blog_project_1.0/blog/posts/post.php?id=<?php echo $posts_random[$x]['id']; ?>">
                      <h2 class="post-title"><?php echo $posts_random[$x]['title']; ?></h2>
                      <h3 class="post-subtitle"><?php echo $posts_random[$x]['subtitle']; ?></h3>
                  </a>
                  <p class="post-meta">
                      Posted by <b style="color: black;"><?php echo $posts_random[$x]['user_name']; ?></b>
                      <?php echo date("F j, Y", strtotime($posts_random[$x]['created_at'])); ?>
                  </p>
              </div>
              <hr class="my-4" />
              <?php endfor; ?>
              <?php endif; ?>
          </div>
      </div>
  </div>


  <!-- Footer-->
  <?php include "./includes/home_footer.php"; ?>