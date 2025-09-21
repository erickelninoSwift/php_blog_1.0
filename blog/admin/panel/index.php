<?php require "../layout/header.php"; ?>
<div class="container-fluid">
    <?php if(isset($_SESSION['amdin_username'])){
        echo "Welcome " . $_SESSION['admin_username'];
    } ?>
    <?php if(isset($_SESSION['admin_username'])): ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Admins</h5>
                    <a href="<?php echo base_url('admin/panel/create'); ?>"
                        class="btn btn-primary mb-4 text-center float-right">Create
                        Admins</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">username</th>
                                <th scope="col">email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>

                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>

                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>

                            </tr>
                        </tbody>
                    </table>
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
<script type="text/javascript">

</script>
</body>

</html>