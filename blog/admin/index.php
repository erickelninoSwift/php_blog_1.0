<?php include "./layout/header.php"; ?>
<div class="container-fluid">
    <?php if(isset($_SESSION['amdin_username'])){
        echo "Welcome " . $_SESSION['admin_username'];
    } ?>
    <?php if(isset($_SESSION['admin_username'])): ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
                    <p class="card-text">number of posts: 8</p>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>

                    <p class="card-text">number of categories: 4</p>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admins</h5>

                    <p class="card-text">number of admins: 3</p>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!isset($_SESSION['admin_username'])): ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mt-5">You are not logged in. Please <a
                            href="<?php echo base_url('admin/panel/login'); ?>">login</a> to access the admin panel.
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<!--  <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
<?php include __DIR__ . '/layout/footer.php'; ?>