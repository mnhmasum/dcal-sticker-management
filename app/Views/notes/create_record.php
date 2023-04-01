<body>
    <div class="container">


        <div class="jumbotron">
            <div class="row">

                <form action="<?= base_url() ?>/Records/save_record" method="post" class="form-horizontal" name="notesaveform" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Create a new record</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Vehicle No</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="vehicleno" placeholder="Vehicle No" type="text" value="<?php //echo set_value('title'); 
                                                                                                                            ?>" />
                                <?= csrf_field() ?>
                                <span class="text-danger"><?php //echo form_error('title'); 
                                                            ?></span>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-12">
                                <label for="email" class="control-label">Office</label>
                            </div>
                            <div class="col-md-12">
                            <?php //print_r($session_data); ?>
                                <select name="office" class="form-control">
                                    <option value="" disabled selected>Choose Office</option>
                                    <?php foreach ($offices as $office) : ?>
                                        <option value="<?= $office['id'] ?>"> <?= $office['office_name'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger"><?php //echo form_error('description'); 
                                                            ?></span>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email" class="control-label">Decal Image</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="file" name="images[]" multiple />
                                <span class="text-danger"><?php //echo form_error('description'); 
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

            </div>
        </div>
    </div>
    </div>
</body>

</html>