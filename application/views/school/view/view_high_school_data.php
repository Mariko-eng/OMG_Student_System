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
                            <label for="english_degree" class="col-md-2 control-label">English Degree</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10"  
                            value="<?= set_value('english_degree', isset($row) ? $row['english_degree'] : '') ?>">
                        </div>

                        <div class="form-group row">
                            <label for="math_degree" class="col-md-2 control-label">Math Degree</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            value="<?= set_value('math_degree', isset($row) ? $row['math_degree'] : '') ?>">
                        </div>

                        <div class="form-group row">
                            <label for="physics_degree" class="col-md-2 control-label">Physics Degree</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            value="<?= set_value('physics_degree', isset($row) ? $row['physics_degree'] : '') ?>">
                        </div>

                        <div class="form-group row">
                            <label for="chemistry_degree" class="col-md-2 control-label">Chemistry Degree</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            value="<?= set_value('chemistry_degree', isset($row) ? $row['chemistry_degree'] : '') ?>">
                        </div>

                        <div class="form-group row">
                            <label for="biology_degree" class="col-md-2 control-label">Biology Degree</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            value="<?= set_value('biology_degree', isset($row) ? $row['biology_degree'] : '') ?>">
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-md-2 control-label">Total</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            value="<?= set_value('total', isset($row) ? $row['total'] : '') ?>">
                        </div>

                        <div class="form-group row">
                            <label for="certificate_no" class="col-md-2 control-label">Certificate N0</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            value="<?= set_value('certificate_no', isset($row) ? $row['certificate_no'] : '') ?>">
                        </div>
                        
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->