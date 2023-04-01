<body>
    <div class="container">
        <?php //$this->load->view('nav.php'); 
        ?>

        <h1>All Users</h1>

        <p> - All created users list</p>
        <?php //echo $this->session->flashdata('msg'); 
        ?>
        <?= session('msg'); ?>

        <div class="row">

            <div class="col-md-12">
                <div class="well">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Office</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Username</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($result as $user) : ?>
                                    <tr>
                                        <td> <?php echo $user['id']; ?></td>
                                        <td> <?php echo $user['fullname']; ?></td>
                                        <td> <?php echo $user['designation_name']; ?></td>
                                        <td><?php echo $user['dept_name'] ;?></td>
                                        <td><?php echo $user['office_name']; ?></td>
                                        <td> <?php echo$user['email']; ?></td>
                                        <td><?php echo $user['contactnumber'];?></td>
                                        <td><?php if ($user['active'] == 1) echo "Active"; else echo "Inactive"; ?></td>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><a href="edit_user/<?php echo $user['id']; ?>">Edit</a></td>
                                        <?php if ($user['role'] != 1) : ?>
                                            <td><a onclick="return confirm('Are you sure you want to delete?');" href="delete_user/<?php echo $user['id']; ?>">Delete</a></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach;
                                ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

        <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
            seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
        </p>

    </div>
</body>

</html>