<body>
    <div class="container">
        <?php //$this->load->view('nav.php'); 
        ?>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 well">
                    <?php
                    foreach ($notes as $note) {
                        //$attributes = array("class" => "form-horizontal", "name" => "notesaveform");
                        //echo form_open(base_url() . "records/update_note/" . $note->id, $attributes);
                    ?>
                        <form action="<?= base_url() ?>/Records/update_record/<?= $note['id'] ?>" method="post" class="form-horizontal" name="notesaveform">
                            <?= csrf_field() ?>
                            <fieldset>
                                <legend>Update Record</legend>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Vehicle No</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="vehicleno" placeholder="Vehicle No" type="text" value="<?php echo $note['vehicleno']; ?>" />
                                        <span class="text-danger"><?php //echo form_error('title'); 
                                                                    ?></span>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="control-label">Office</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="office" class="form-control">
                                            <?php foreach ($offices as $office) : ?>
                                                <option <?php if ($office['id'] == $note['office']) echo "selected"; ?> value="<?= $office['id'] ?>"> <?= $office['office_name'];  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="email" class="control-label">Status</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" name="status" type="checkbox" <?php if($note['status'] == 1) { echo "checked"; }; ?>  />
                                        <span class="text-danger"><?php //echo form_error('description'); 
                                                                    ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                    <label for="email" class="control-label">Decal Image</label>
                                        <?php
                                        $str_arr = explode("||", $note['images']);
                                        echo "<td>";
                                        foreach ($str_arr as $img) :
                                        ?>
                                            <a href="<?php echo base_url(); ?>/uploads/<?php echo $img ?>">View</a>
                                        <?php
                                        endforeach;
                                        ?>
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