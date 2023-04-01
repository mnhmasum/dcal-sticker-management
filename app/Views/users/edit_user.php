<body>
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 well">
                    <?php foreach ($users as $user) { ?>
                        <form action="<?= base_url() ?>/Users/edit_user_save/<?= $user['id'] ?>" method="post" class="form-horizontal" name="notesaveform">
                            <?= csrf_field() ?>
                            <fieldset>
                                <legend>Update User</legend>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Full Name</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="fullname" placeholder="Full Name" type="text" value="<?php echo $user['fullname']; ?>" />
                                        <span class="text-danger"><?php //echo form_error('title'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Designation</label>
                                    </div>
                                    <div class="col-md-12">
                                    <select name="designation" class="form-control">
                                            <?php foreach ($designations as $designation) : ?>
                                                <option <?php if ($designation['id'] == $user['designation']) echo "selected"; ?> value="<?= $designation['id'] ?>"> <?= $designation['designation_name'];  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Department</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="department" class="form-control">
                                            <?php foreach ($departments as $department) : ?>
                                                <option <?php if ($department['id'] == $user['department']) echo "selected"; ?> value="<?= $department['id'] ?>"> <?= $department['dept_name'];  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Office</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="office" class="form-control">
                                            <?php foreach ($offices as $office) : ?>
                                                <option <?php if ($office['id'] == $user['office']) echo "selected"; ?> value="<?= $office['id'] ?>"> <?= $office['office_name'];  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Contact Number</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="contactnumber" placeholder="Contact Number" type="text" value="<?php echo $user['contactnumber']; ?>" />
                                        <span class="text-danger"><?php //echo form_error('title'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Email</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="email" placeholder="Email" type="text" value="<?php echo $user['email']; ?>" />
                                        <span class="text-danger"><?php //echo form_error('title'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Active</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" name="active" type="checkbox" <?php if (1 == $user['active']) echo "checked"; ?> />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Username</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="username" placeholder="Username" type="text" value="<?php echo $user['username']; ?>" />
                                        <span class="text-danger"><?php //echo form_error('title'); 
                                                                    ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Password</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="password" placeholder="Password" type="text" value="<?= $user['password']; ?>" />
                                        <span class="text-danger"><?php //echo form_error('title'); 
                                                                    ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input name="submit" type="submit" class="btn btn-primary" value="Save" />
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php
                        //echo form_close();
                        //echo $this->session->flashdata('msg');
                    } ?>
                </div>
            </div>
        </div>

    </div>
</body>

</html>