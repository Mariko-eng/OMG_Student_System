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
                            <label for="user_name" class="col-md-2 control-label">User Name</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            maxlength="20" name="user_name" id="user_name" 
                            placeholder="User Name"
                            value="<?= set_value('user_name', isset($row) ? $row['user_name'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-2 control-label">Email</label>
                            <input required <?= $subtitle == 'view' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            maxlength="50" name="email" id="email" 
                            placeholder="email"
                            value="<?= set_value('email', isset($row) ? $row['email'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-2 control-label">
                                Password
                            </label>
                            <input <?= $subtitle == 'view' || $row['group'] == 'students' ? 'disabled' : '' ?> 
                            type="text" class="form-control col-md-10" 
                            maxlength="20" name="password" id="password" 
                            placeholder="Password"
                            value="<?= set_value('password', isset($row) ? $row['password'] : '') ?>">
                        </div>
                        <div class="form-group row">
                            <label for="group" class="col-md-2">Role <?= form_error('group', '<span style=" color:red;">', '</span>') ?></label>
                            <input type="radio" name="group" value="non_admin" <?php 
                                    echo set_value('group', $row['group']) == 'non_admin' ? "checked" : ""; 
                                ?> />Regular User
                                <input type="radio" name="group" value="admin" <?php 
                                    echo set_value('group', $row['group']) == 'admin' ? "checked" : ""; ?> />Administrator
                                <input type="radio" name="group" value="admin" <?php 
                                    echo set_value('group', $row['group']) == 'students' ? "checked" : ""; ?> />Student
                        </div>
                        <div>
                            <h4>
                                Profile Picture
                            </h4>
                            <div class="form-group row">
                                <div class="col-md-5" style="margin-top: 5px">
                                <input type="file" name="userfile" size="20" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit User</button>
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