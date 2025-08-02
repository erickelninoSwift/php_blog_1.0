<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>

<?php 
    if(!isset($_SESSION['email']) || !isset($_SESSION['user_id'])) {
        header("Location: http://localhost:8888/blog/blog_project_1.0/blog/auth/login.php");
        exit();
    }

    $user_email = $_SESSION['email'] ?? '';
    $user_id = $_SESSION['user_id'] ?? '';
    $user_name = $_SESSION['username'] ?? '';
    $user_object = $_SESSION['user_object'] ?? null;

    // fetch number of post current user have 
    $user_posts = $connection->prepare("SELECT * FROM posts WHERE user_id = :id");
    $user_posts->execute(['id' => $user_id]);
    $post_count = $user_posts->rowCount() ?? 0;
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_button'])) {

        $new_email = $_POST['email'] ?? '';
        $new_name = $_POST['full_name'] ?? '';

        if (!empty($user_id) && !empty($new_email) && !empty($new_name)) {
            $update_query = $connection->prepare("UPDATE users SET email = :email, user_name = :username WHERE user_id = :id");
            $update_query->execute([
                ":email" => $new_email,
                ":username" => $new_name,
                ":id" => $user_id,
            ]);

            // Optionally update session
            $_SESSION['email'] = $new_email;
            $_SESSION['username'] = $new_name;

            header("Location: http://localhost:8888/blog/blog_project_1.0/blog/auth/user_profile.php");
            exit();
        }
    }
}
?>

<div class="container mt-5 px-4 px-lg-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Profile Update Form -->
            <form method="POST" action="user_profile.php">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">

                        <!-- Editable Inputs -->
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control text-center" id="fullName" name="full_name"
                                value="<?php echo htmlspecialchars($user_name); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control text-center" id="email" name="email"
                                value="<?php echo htmlspecialchars($user_email); ?>">
                        </div>

                        <hr />

                        <div class="row text-start">
                            <div class="col-6 mb-3">
                                <label for="userId" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="userId" name="user_id"
                                    value="<?php echo $user_id; ?>" readonly>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" readonly
                                    value="<?php echo htmlspecialchars($user_name); ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="joined" class="form-label">Joined</label>
                                <input type="text" class="form-control" id="joined" name="joined"
                                    value="<?php echo date('Y-m-d', strtotime($user_object['created_at'])); ?>"
                                    readonly>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="postCount" class="form-label">Total Posts</label>
                                <input type="text" class="form-control" id="postCount" name="post_count"
                                    value="<?php echo $post_count; ?>" readonly>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" name="update_button" class="btn btn-primary mt-3">Update Profile</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>