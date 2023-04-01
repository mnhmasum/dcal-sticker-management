<body>
    <div class="container">
        <?php //$this->load->view('nav.php'); 
        ?>

        <h1>Records</h1>

        <p> - All records are visible here in a table</p>
        <?php //echo $this->session->flashdata('msg'); 
        ?>
        <?= session('msg'); ?>

        <div class="row container-fluid navbar-header col-md-12 well">
            <form action="<?= base_url() ?>/Records/search_by_date" method="post" class="form-horizontal" name="datesearchform">
                <?= csrf_field() ?>
                <div class="col-md-3">
                    <div class="input-group datepick1">
                        <input required readonly data-date-ignore-readonly="true" data-date-format="yyyy-MM-DD" type="text" class="form-control" name="fromdate" id="frmSaveOffice_startdt" required>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    To
                </div>
                <div class="col-md-3">
                    <div class="input-group datepick2">
                        <input required readonly data-date-ignore-readonly="true" data-date-format="yyyy-MM-DD" type="text" class="form-control" name="todate" id="frmSaveOffice_startdt" required>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <input name="submit" type="submit" class="btn btn-primary" value="Search" />
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <legend>Notes</legend>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle No</th>
                                    <th>Office</th>
                                    <th>By</th>
                                    <th>Decal Image</th>
                                    <th>Status</th>
                                    <th>Created At(yyyy-mm-dd)</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($result as $note) {
                                    echo "<tr>";
                                    echo "<td>" . $note['id'] . "</td>";
                                    echo "<td>" . $note['vehicleno'] . "</td>";
                                    echo "<td>" . $note['office_name'] . "</td>";
                                    echo "<td>" . $note['fullname'] . "</td>";

                                    $str_arr = explode("||", $note['images']);
                                    echo "<td>|";
                                    foreach ($str_arr as $img) :
                                ?>
                                        <a href="<?php echo base_url(); ?>/uploads/<?php echo $img ?>">View</a> | 
                                    <?php
                                    endforeach;
                                    echo "</td>";

                                    if ($note['status'] == 0) {
                                        echo "<td class='text-danger'><span class='label label-danger'>Pending</span></td>";
                                    } else {
                                        echo "<td class='text-danger'><span class='label label-success'>Done</span></td>";
                                    }
                                    echo "<td>" . $note['created_at'] . "</td>";
                                    echo "<td><a href='edit_record/" . $note['id'] . "'>Edit</a></td>";
                                    ?>
                                    <td><a onclick="return confirm('Are you sure you want to delete?');" href="delete_record/<?= $note['id'] ?>">delete</a></td>
                                <?php
                                    echo "</tr>";
                                }
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