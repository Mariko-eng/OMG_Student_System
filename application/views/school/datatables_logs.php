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
        <div class="card-body dataTable">
            <table class="table table-striped table-bordered" id="logs">
                <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>IP Address</th>
                    <th>Transaction Type</th>
                    <th>Details</th>                    
                    <th>Platform</th>
                    <th>Browser</th>
                    <th>Agent</th>
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
