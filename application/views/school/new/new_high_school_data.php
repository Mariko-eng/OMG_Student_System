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
                            <label for="school_name" class="col-md-2 control-label">High School Name<?= form_error('school_name', '<span style=" color:red;">', '</span>') ?></label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            maxlength="50" name="school_name" id="school_name" 
                            placeholder="School Name"
                            value="<?= set_value('school_name', isset($row) ? $row['school_name'] : '') ?>">
                        </div>
                        
                        <div class="form-group row">
                            <label for="english_degree" class="col-md-2">English Degree <?= form_error('english_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "A" name = "english_degree">A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "B" name = "english_degree">B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "C" name = "english_degree">C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "D" name = "english_degree">D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "E" name = "english_degree">E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "F" name = "english_degree">F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "Other" name = "english_degree">Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="math_degree" class="col-md-2">Math Degree <?= form_error('math_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "A" name = "math_degree">A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "B" name = "math_degree">B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "C" name = "math_degree">C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "D" name = "math_degree">D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "E" name = "math_degree">E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "F" name = "math_degree">F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "Other" name = "math_degree">Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="physics_degree" class="col-md-2">Physics Degree <?= form_error('physics_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "A" name = "physics_degree">A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "B" name = "physics_degree">B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "C" name = "physics_degree">C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "D" name = "physics_degree">D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "E" name = "physics_degree">E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "F" name = "physics_degree">F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "Other" name = "physics_degree">Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="chemistry_degree" class="col-md-2">Chemistry Degree <?= form_error('chemistry_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "A" name = "chemistry_degree">A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "B" name = "chemistry_degree">B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "C" name = "chemistry_degree">C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "D" name = "chemistry_degree">D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "E" name = "chemistry_degree">E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "F" name = "chemistry_degree">F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "Other" name = "chemistry_degree">Other</h4>
                        </div>


                        <div class="form-group row">
                            <label for="biology_degree" class="col-md-2">Biology Degree <?= form_error('biology_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "A" name = "biology_degree">A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "B" name = "biology_degree">B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "C" name = "biology_degree">C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "D" name = "biology_degree">D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "E" name = "biology_degree">E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "F" name = "biology_degree">F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;"><input type="radio" value = "Other" name = "biology_degree">Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-md-2 control-label">Total</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10 " 
                            maxlength="10" name="total" id="total" 
                            placeholder="Total"
                            value="<?= set_value('total', isset($row) ? $row['total'] : '') ?>">
                        </div>

                        <div class="form-group row">
                            <label for="certificate_no" class="col-md-2 control-label">Cerificate N0</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            maxlength="50" name="certificate_no" id="certificate_no" 
                            placeholder="Certificate Number"
                            value="<?= set_value('certificate_no', isset($row) ? $row['certificate_no'] : '') ?>">
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