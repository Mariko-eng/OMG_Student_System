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
                    <li class="breadcrumb-item"><a href="<?= base_url('app/dashboard') ?>"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><?= humanize($title) ?></li>
                    <li class="breadcrumb-item"><?= humanize($subtitle) ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <?= anchor('app/students/new', ' <i class="fa fa-plus"></i> New', 'class="btn btn-sm btn-primary"'); ?>
        </div>
        <div class="card-body dataTable">
            <table class="table table-striped table-bordered" id="students">
                <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Name</th>
                    <th>Gender</th>
                    <th>Birth Date</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Profile Picture</th>
                    <th>Nationality</th>
                    <th>Admission Date</th>
                    <th>Course</th>
                    <th>Academic Year</th>
                    <th width="100">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
