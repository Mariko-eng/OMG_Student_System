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
                            <label for="faculty" class="col-md-2">FACULTY <?= form_error('faculty', '<span style=" color:red;">', '</span>') ?></label>
                            <select required <?= $subtitle == 'view' ? 'disabled' : '' ?> class="col-md-10" name="faculty" id="faculty">
                                <option value="ICT" <?= set_select('faculty', 'ICT', isset($row) && isset($row['faculty']) ? true : '')  ?>>ICT</option>
                                <option value="STATISTICS" <?= set_select('faculty', 'STATISTICS', isset($row) && isset($row['faculty']) ? true : '')  ?>>STATISTICS</option>
                                <option value="MEDICINE" <?= set_select('faculty', 'MEDICINE', isset($row) && isset($row['faculty']) ? true : '')  ?>>MEDICINE</option>
                                <option value="ENGINEERING" <?= set_select('faculty', 'ENGINEERING', isset($row) && isset($row['faculty']) ? true : '')  ?>>ENGINEERING</option>
                                <option value="EDUCATION" <?= set_select('faculty', 'EDUCATION', isset($row) && isset($row['faculty']) ? true : '')  ?>>EDUCATION</option>
                                <option value="SOCIAL SCIENCES" <?= set_select('faculty', 'SOCIAL SCIENCES', isset($row) && isset($row['faculty']) ? true : '')  ?>>SOCIAL SCIENCES</option>
                                <option value="OTHER"  <?= set_select('faculty', 'Other', isset($row) && isset($row['faculty']) ? true : '')  ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="course_name" class="col-md-2 control-label">Course Name</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10 phone" 
                            maxlength="50" name="course_name" id="course_name" 
                            placeholder="Course Name"
                            value="<?= set_value('course_name', isset($row) ? $row['course_name'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="course_id" class="col-md-2 control-label">Course ID</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10 phone" 
                            maxlength="50" name="course_id" id="course_id" 
                            placeholder="Course ID"
                            value="<?= set_value('course_id', isset($row) ? $row['course_id'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="period" class="col-md-2 control-label">Period</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10 phone" 
                            maxlength="10" name="period" id="period" 
                            placeholder="Course Period"
                            value="<?= set_value('period', isset($row) ? $row['period'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update Course</button>
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