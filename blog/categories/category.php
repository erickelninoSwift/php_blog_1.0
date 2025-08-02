<?php include "../config/config.php"; ?>
<?php include "./all_catorgies.php"; ?>
<?php include "../includes/header.php"; ?>
<?php 
      
      
      if((!isset($_SESSION['email']) || !isset($_SESSION['user_name'])) && !isset($_GET['id'])) {
        header('location: http://localhost:8888/blog/blog_project_1.0/blog/index.php');
      }
       if(isset($_GET['id']))  {
         $cat_query = $connection ->prepare("SELECT * FROM categories WHERE id= :id");
         $cat_query->execute([
            ":id" => $_GET['id']
         ]);
         $category_name = $cat_query->fetchAll(PDO::FETCH_ASSOC);
       }

       $cat_id = trim($_GET['id']);

       //
       // fetch all post based on categories
       $fetch_posts = $connection->prepare("SELECT * FROM posts WHERE category_id=:cat_id");
       $fetch_posts->execute([
           ":cat_id" => $cat_id
       ]);
       $all_posts = $fetch_posts->fetchAll(PDO::FETCH_ASSOC);

       //
       $current_user = $_SESSION['user_id'] ?? '';
       
         $fetch_posts_user = $connection->prepare("SELECT * , posts.id as post_id FROM posts JOIN categories ON posts.category_id = categories.id JOIN users ON posts.user_id = users.user_id WHERE posts.category_id = :cat_id");
         $fetch_posts_user->execute([
            "cat_id" => $cat_id
         ]);
         $fetch_posts_user = $fetch_posts_user->fetchAll(PDO::FETCH_ASSOC);

    
?>
<div class="container mt-5 px-4 px-lg-5">
    <!-- Category Header -->
    <h2 class="mb-4 text-center">
        Posts in Category: <span class="text-primary"> <?php echo $category_name[0]['name'];?></span>
    </h2>

    <!-- Post Preview Card -->
    <?php if(count($fetch_posts_user) > 0): ?>
    <?php foreach($fetch_posts_user as $current_post): ?>
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title"><?php echo htmlspecialchars($current_post['title']);?></h3>
            <h5 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($current_post['subtitle']); ?></h5>
            <p class="card-text text-grey">
                <?php echo htmlspecialchars($current_post['body']); ?>
            <p class="card-text">
                Posted by <strong><?php echo $current_post['user_name']; ?></strong> &nbsp;
                <?php echo date('F j, Y', strtotime($current_post['created_at'])); ?>
            </p>
            <a href="http://localhost:8888/blog/blog_project_1.0/blog/posts/post.php?id=<?php echo $current_post['post_id']; ?>"
                class="btn btn-outline-dark btn-sm">Read More</a>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- No Posts Message -->
    <?php else: ?>
    <div class="alert alert-info text-center">
        No posts found in this category.
    </div>
    <?php endif; ?>

</div>

<?php include "../includes/footer.php"; ?>