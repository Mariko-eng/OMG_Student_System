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
                            <h3><?=$row['student_id'] ?></h3>
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
                            <label for="math_degree" class="col-md-2">Math Degree <?= form_error('math_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="math_degree" value="A" <?php 
                                echo set_value('math_degree', $row['math_degree']) == 'A' ? "checked" : ""; 
                            ?> />A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="math_degree" value="B" <?php 
                                echo set_value('math_degree', $row['math_degree']) == 'B' ? "checked" : ""; 
                            ?> />B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="math_degree" value="C" <?php 
                                echo set_value('math_degree', $row['math_degree']) == 'C' ? "checked" : ""; 
                            ?> />C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="math_degree" value="D" <?php 
                                echo set_value('math_degree', $row['math_degree']) == 'D' ? "checked" : ""; 
                            ?> />D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="math_degree" value="E" <?php 
                                echo set_value('math_degree', $row['math_degree']) == 'E' ? "checked" : ""; 
                            ?> />E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="math_degree" value="F" <?php 
                                echo set_value('math_degree', $row['math_degree']) == 'F' ? "checked" : ""; 
                            ?> />F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="math_degree" value="Other" <?php 
                                echo set_value('math_degree', $row['math_degree']) == 'Other' ? "checked" : ""; 
                            ?> />Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="english_degree" class="col-md-2">English Degree <?= form_error('english_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="english_degree" value="A" <?php 
                                echo set_value('english_degree', $row['english_degree']) == 'A' ? "checked" : ""; 
                            ?> />A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="english_degree" value="B" <?php 
                                echo set_value('english_degree', $row['english_degree']) == 'B' ? "checked" : ""; 
                            ?> />B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="english_degree" value="C" <?php 
                                echo set_value('english_degree', $row['english_degree']) == 'C' ? "checked" : ""; 
                            ?> />C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="english_degree" value="D" <?php 
                                echo set_value('english_degree', $row['english_degree']) == 'D' ? "checked" : ""; 
                            ?> />D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="english_degree" value="E" <?php 
                                echo set_value('english_degree', $row['english_degree']) == 'E' ? "checked" : ""; 
                            ?> />E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="english_degree" value="F" <?php 
                                echo set_value('english_degree', $row['english_degree']) == 'F' ? "checked" : ""; 
                            ?> />F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="english_degree" value="Other" <?php 
                                echo set_value('english_degree', $row['english_degree']) == 'Other' ? "checked" : ""; 
                            ?> />Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="physics_degree" class="col-md-2">Physics Degree <?= form_error('physics_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="physics_degree" value="A" <?php 
                                echo set_value('physics_degree', $row['physics_degree']) == 'A' ? "checked" : ""; 
                            ?> />A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="physics_degree" value="B" <?php 
                                echo set_value('physics_degree', $row['physics_degree']) == 'B' ? "checked" : ""; 
                            ?> />B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="physics_degree" value="C" <?php 
                                echo set_value('physics_degree', $row['physics_degree']) == 'C' ? "checked" : ""; 
                            ?> />C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="physics_degree" value="D" <?php 
                                echo set_value('physics_degree', $row['physics_degree']) == 'D' ? "checked" : ""; 
                            ?> />D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="physics_degree" value="E" <?php 
                                echo set_value('physics_degree', $row['physics_degree']) == 'E' ? "checked" : ""; 
                            ?> />E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="physics_degree" value="F" <?php 
                                echo set_value('physics_degree', $row['physics_degree']) == 'F' ? "checked" : ""; 
                            ?> />F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="physics_degree" value="Other" <?php 
                                echo set_value('physics_degree', $row['physics_degree']) == 'Other' ? "checked" : ""; 
                            ?> />Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="chemistry_degree" class="col-md-2">Chemistry Degree <?= form_error('chemistry_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="chemistry_degree" value="A" <?php 
                                echo set_value('chemistry_degree', $row['chemistry_degree']) == 'A' ? "checked" : ""; 
                            ?> />A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="chemistry_degree" value="B" <?php 
                                echo set_value('chemistry_degree', $row['chemistry_degree']) == 'B' ? "checked" : ""; 
                            ?> />B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="chemistry_degree" value="C" <?php 
                                echo set_value('chemistry_degree', $row['chemistry_degree']) == 'C' ? "checked" : ""; 
                            ?> />C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="chemistry_degree" value="D" <?php 
                                echo set_value('chemistry_degree', $row['chemistry_degree']) == 'D' ? "checked" : ""; 
                            ?> />D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="chemistry_degree" value="E" <?php 
                                echo set_value('chemistry_degree', $row['chemistry_degree']) == 'E' ? "checked" : ""; 
                            ?> />E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="chemistry_degree" value="F" <?php 
                                echo set_value('chemistry_degree', $row['chemistry_degree']) == 'F' ? "checked" : ""; 
                            ?> />F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="chemistry_degree" value="Other" <?php 
                                echo set_value('chemistry_degree', $row['chemistry_degree']) == 'Other' ? "checked" : ""; 
                            ?> />Other</h4>
                        </div>

                        <div class="form-group row">
                            <label for="biology_degree" class="col-md-2">Biology Degree <?= form_error('biology_degree', '<span style=" color:red;">', '</span>') ?></label>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="biology_degree" value="A" <?php 
                                echo set_value('biology_degree', $row['biology_degree']) == 'A' ? "checked" : ""; 
                            ?> />A</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="biology_degree" value="B" <?php 
                                echo set_value('biology_degree', $row['biology_degree']) == 'B' ? "checked" : ""; 
                            ?> />B</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="biology_degree" value="C" <?php 
                                echo set_value('biology_degree', $row['biology_degree']) == 'C' ? "checked" : ""; 
                            ?> />C</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="biology_degree" value="D" <?php 
                                echo set_value('biology_degree', $row['biology_degree']) == 'D' ? "checked" : ""; 
                            ?> />D</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="biology_degree" value="E" <?php 
                                echo set_value('biology_degree', $row['biology_degree']) == 'E' ? "checked" : ""; 
                            ?> />E</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="biology_degree" value="F" <?php 
                                echo set_value('biology_degree', $row['biology_degree']) == 'F' ? "checked" : ""; 
                            ?> />F</h4>
                            <h4 style="color: blueviolet; margin-right: auto;">
                            <input type="radio" name="biology_degree" value="Other" <?php 
                                echo set_value('biology_degree', $row['biology_degree']) == 'Other' ? "checked" : ""; 
                            ?> />Other</h4>
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