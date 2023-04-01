<body>
    <div class="container">


        <div class="jumbotron">
            <div class="row">

                <form action="<?= base_url() ?>/Users/save_user" method="post" class="form-horizontal" name="usersaveform">
                    <?= csrf_field() ?>
                    <fieldset>
                        <legend>Create a new user</legend>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Full Name</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="fullname" placeholder="Full Name" type="text" required />
                                <span class="text-danger"><?php //echo form_error('title'); 
                                                            ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Designation</label>
                            </div>
                            <div class="col-md-12">
                                <select name="designation" class="form-control" required>
                                    <option value="" disabled selected>Choose Designation</option>
                                    <?php foreach ($designations as $designation) : ?>
                                        <option value="<?= $designation['id'] ?>"> <?= $designation['designation_name'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger"><?php //echo form_error('title'); 
                                                            ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Department</label>
                            </div>
                            <div class="col-md-12">
                                <select name="department" class="form-control" required>
                                    <option value="" disabled selected>Choose department</option>
                                    <?php foreach ($departments as $department) : ?>
                                        <option value="<?= $department['id'] ?>"> <?= $department['dept_name'];  ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <span class="text-danger"><?php //echo form_error('title'); 
                                                            ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Office</label>
                            </div>
                            <div class="col-md-12">
                                <select name="office" class="form-control" required>
                                    <option value="" disabled selected>Choose Office</option>
                                    <?php foreach ($offices as $office) : ?>
                                        <option value="<?= $office['id'] ?>"> <?= $office['office_name'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Contact Number</label>
                            </div>
                            <div class="col-md-12">
                                <input required class="form-control" name="contactnumber" placeholder="Mobile Number" type="text" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Email</label>
                            </div>
                            <div class="col-md-12">
                                <input required class="form-control" name="email" placeholder="Email" type="text" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Username</label>
                            </div>
                            <div class="col-md-12">
                                <input required class="form-control" name="username" placeholder="User Name" type="text" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email" class="control-label">Password</label>
                            </div>
                            <div class="col-md-12">
                                <input required class="form-control" name="password" placeholder="Password" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email" class="control-label">Active</label>
                            </div>
                            <div class="col-md-1">
                                <input class="form-control" name="active" type="checkbox" value="1" />
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12">
                                <input name="submit" type="submit" class="btn btn-primary" value="Save" />
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
    </div>
</body>

</html>