<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3><?= humanize($title) ?>
                        <small><?= humanize($subtitle) ?></small>
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="<?= base_url($this->page_level.'dashboard') ?>"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><?= humanize($title) ?></li>
                    <li class="breadcrumb-item active"><?= humanize($subtitle) ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid Ends-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= form_open_multipart('' ,'class="needs-validation"') ?>
                        <div class="form-group row">
                            <label for="student_id" class="col-md-2 control-label">Student ID</label>
                            <h3><?=$row_stud_id ?></h3>
                        </div>
                        <div class="form-group row">
                            <label for="national_id_no" class="col-md-2 control-label">National ID N0</label>
                            <input required <?= $subtitle == 'view' ? '' : '' ?> 
                            type="text" class="form-control col-md-10" name="national_id_no" id="national_id_no" 
                            placeholder="NAtional ID N0"
                            value="<?= set_value('national_id_no', isset($row) ? $row['national_id_no'] : '') ?>">
                        </div>

                        <div style = "display:flex; justify-content: space-between;">
                            <div>
                            <h4>
                                National ID Document *Jpeg|Png*
                            </h4>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5" style="margin-top: 5px">
                                    <input required type="file" name="userfile" size="20" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="high_school_cert_no" class="col-md-2 control-label">
                                High School Certificate N0</label>
                            <input required <?= $subtitle == 'view' ? '' : '' ?> 
                            type="text" class="form-control col-md-10" name="high_school_cert_no" 
                            id="high_school_cert_no" 
                            placeholder="High School Certificate N0"
                            value="<?= set_value('high_school_cert_no', isset($row) ? $row['high_school_cert_no'] : '') ?>">
                        </div>

                        <div style = "display:flex; justify-content: space-between;">
                            <div>
                            <h4>
                                High School Certificate Document *Jpeg|Png*
                            </h4>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5" style="margin-top: 5px">
                                    <input required type="file" name="userfile1" size="20" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_cert_no" class="col-md-2 control-label">Birth Certificate N0</label>
                            <input required <?= $subtitle == 'view' ? '' : '' ?> 
                            type="text" class="form-control col-md-10" name="birth_cert_no" id="birth_cert_no" 
                            placeholder="Birth Certificate N0"
                            value="<?= set_value('birth_cert_no', isset($row) ? $row['birth_cert_no'] : '') ?>">
                        </div>

                        <div style = "display:flex; justify-content: space-between;">
                            <div>
                            <h4>
                                Birth Certificate Document *Jpeg|Png*
                            </h4>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5" style="margin-top: 5px">
                                    <input required type="file" name="userfile2" size="20" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit Data</button>
                                <button type="reset" class="btn default">Cancel</button>
                            </div>
                        </div> 
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->