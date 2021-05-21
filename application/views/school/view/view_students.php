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
                            <label for="first_name" class="col-md-2 control-label">First Name</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10 phone" 
                            maxlength="50" name="first_name" id="first_name" placeholder="First Name"
                            value="<?= set_value('first_name', isset($row) ? $row['first_name'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-2 control-label">Last Name</label>
                            <input required <?= $subtitle == 'view' ? '' : '' ?> type="text" class="form-control col-md-10" 
                            name="last_name" id="last_name" placeholder="Last Name"
                            value="<?= set_value('last_name', isset($row) ? $row['last_name'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="user_name" class="col-md-2 control-label">User Name</label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10" 
                            maxlength="50" name="user_name" id="user_name" placeholder="User Name"
                            value="<?= set_value('user_name', isset($row) ? $row['username'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-2 control-label">Password</label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10" 
                            maxlength="50" name="password" id="password" placeholder="Password"
                            value="<?= set_value('password', isset($row) ? $row['password'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-2 control-label">Gender</label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10" 
                            placeholder="Gender"
                            value="<?= set_value('gender', isset($row) ? $row['gender'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="certificate_date" class="col-md-2 control-label">
                                Date Of Birth
                            </label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                                name="birth_date" 
                                id="birth_date"
                                class="form-control col-md-10" required
                                placeholder="Date Of Birth"
                                value="<?= set_value('birth_date')?>">
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-2 control-label">Phone</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10 phone" 
                            maxlength="20" name="phone" id="phone" placeholder="Phone"
                            value="<?= set_value('phone', isset($row) ? $row['phone'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-2 control-label">Email</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10" 
                            name="email" id="email" placeholder="Email"
                            value="<?= set_value('email', isset($row) ? $row['email'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="course_name" class="col-md-2">Course </label>
                            <select required <?= $subtitle == 'view' ? 'disabled' 
                            : '' ?> 
                            class="col-md-10" name="course_name" id="course_name">
                                <?php foreach ($school_courses as $course): ?>
                                    <option value=<?=$course['aut_id']?> <?= set_select('course_name', $course['course_name'], 
                                    isset($row) && isset($row['course_name']) &&
                                    in_array($course['course_name'], $row['course_name']) ? true : '')  ?>>
                                    <?=$course['course_name']?>
                                    </option>
                                <?php endforeach; ?>
                                <option value="Other"  <?= set_select('course_name', 'Other', isset($row) && isset($row['course_name']) && in_array('Other', $row['course_name']) ? true : '')  ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="academic_year" class="col-md-2 control-label">Academic Year</label>
                            <input <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10" 
                            placeholder="Academic Year"
                            value="<?= set_value('academic_year', isset($row) ? $row['academic_year'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="nationality" class="col-md-2 control-label">Nationality</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> type="text" class="form-control col-md-10" 
                            maxlength="20" name="nationality" id="nationality" placeholder="Nationality"
                            value="<?= set_value('nationality', isset($row) ? $row['nationality'] : '') ?>">
                        </div>
                        <div>
                            <h4>
                                Profile Picture
                            </h4>
                            <div class="form-group row">
                                <div style="width:100px;height:150px;">
                                    <img src="<?= base_url($row['profile_pic']) ?>" alt="No Profile Picture"/>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->