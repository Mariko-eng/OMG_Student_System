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
                        <div>
                            <h4>
                                National ID *Jpeg|Png*
                            </h4>
                            <div class="form-group row">
                                <div class="col-md-5" style="margin-top: 5px">
                                <input required type="file" name="userfile" size="20" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="national_id_pages" class="col-md-2 control-label">National ID PAGES</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" name="national_id_pages" 
                            id="national_id_pages" placeholder="National ID PAGES"
                            value="<?= set_value('national_id_pages', isset($row) ? $row['national_id_pages'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="national_id_office" class="col-md-2 control-label">National ID OFFICE</label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10" 
                            maxlength="14" name="national_id_office" id="national_id_office" placeholder="National ID OFFICE"
                            value="<?= set_value('national_id_office', isset($row) ? $row['national_id_office'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="resident_card_no" class="col-md-2 control-label">Resident Card N0</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" 
                            class="form-control col-md-10" maxlength="10" name="resident_card_no" id="resident_card_no" 
                            placeholder="Resident Card N0"
                            value="<?= set_value('resident_card_no', isset($row) ? $row['resident_card_no'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="resident_card_office" class="col-md-2 control-label">Resident Card Office</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" name="resident_card_office" id="resident_card_office" 
                            placeholder="Resident Card Office"
                            value="<?= set_value('resident_card_office', isset($row) ? $row['resident_card_office'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="ration_card_no" class="col-md-2 control-label">Ration Card NO</label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" 
                            class="form-control col-md-10" 
                            maxlength="14" name="ration_card_no" id="ration_card_no" placeholder="Ration Card NO"
                            value="<?= set_value('ration_card_no', isset($row) ? $row['ration_card_no'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="ration_card_office" class="col-md-2 control-label">Ration Card Office</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" maxlength="10" name="ration_card_office" 
                            id="ration_card_office" placeholder="Ration Card Office"
                            value="<?= set_value('ration_card_office', isset($row) ? $row['ration_card_office'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="certificate_nationality_no" class="col-md-2 control-label">Certificate Nationality N0</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" name="certificate_nationality_no" id="certificate_nationality_no" 
                            placeholder="Certificate Nationality N0"
                            value="<?= set_value('certificate_nationality_no', isset($row) ? $row['certificate_nationality_no'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="certificate_nationality_date" class="col-md-2 control-label">Certificate Nationality Date</label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                                name="certificate_nationality_date" id="certificate_nationality_date"
                                class="form-control col-md-10" required placeholder="Certificate Nationality Date"
                                value="<?= set_value('certificate_nationality_date')?>">
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