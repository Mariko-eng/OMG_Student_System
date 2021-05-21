<!-- Page Sidebar Start-->
<div class="page-sidebar">
	<div class="sidebar custom-scrollbar">
		<ul class="sidebar-menu">
            <!--Dashboard-->
			<li <?= $this->authorization->is_role_for_group("students") ? '' : 'hidden'; ?>>
                <a class="sidebar-header" href="<?= base_url('app/dashboard') ?>"
                    <?= ($title=='dashboard'?'style="font-weight: 800 !important;"':'') ?>>
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!--Courses-->
			<li <?= ($title == 'courses'?'class="active"':'') ?>
                <?= $this->authorization->is_role_for_group("courses") ? '' : 'hidden'; ?>>
                <a class="sidebar-header" href="#"
                    <?= ($title=='courses'?'style="font-weight: 800 !important;"':'') ?>>
                    <i data-feather="box"></i>
                    <span>Courses</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
				<ul class="sidebar-submenu">
                    <li <?= $this->authorization->is_role_for_group('can_view_courses','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/courses/list') ?>"
                        <?= ($title == 'courses' && $subtitle == 'list'?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>List
                        </a>
                    </li>
                    <li <?= $this->authorization->is_role_for_group('can_add_courses','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/courses/new') ?>"
                        <?= ($title == 'courses' && ($subtitle ==  'new' || $subtitle == 'update')?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>New
                        </a>
                    </li>
				</ul>
			</li>

            <!--Students-->
            <li <?= ($title == 'students'?'class="active"':'') ?>
                <?= $this->authorization->is_role_for_group("students") ? '' : 'hidden'; ?>>
                <a class="sidebar-header" href="#"
                    <?= ($title=='students'?'style="font-weight: 800 !important;"':'') ?>>
                    <i data-feather="box"></i>
                    <span>Students</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
				<ul class="sidebar-submenu">
                    <li <?= $this->authorization->is_role_for_group('can_view_students','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/students/list') ?>"
                        <?= ($title == 'students' && $subtitle == 'list'?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>List
                        </a>
                    </li>
                    <li <?= $this->authorization->is_role_for_group('can_add_students','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/students/new') ?>"
                        <?= ($title == 'students' && ($subtitle ==  'new' || $subtitle == 'update')?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>New
                        </a>
                    </li>
				</ul>
			</li>

            <!--High School Data-->
            <li <?= ($title == 'high_school_data'?'class="active"':'') ?>
                <?= $this->authorization->is_role_for_group("high_school_data") ? '' : 'hidden'; ?>>
                <a class="sidebar-header" href="#"
                    <?= ($title=='high_school_data'?'style="font-weight: 800 !important;"':'') ?>>
                    <i data-feather="box"></i>
                    <span>High School Data</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li <?= $this->authorization->is_role_for_group('can_view_high_school_data','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/high_school_data/list') ?>"
                        <?= ($title == 'high_school_data' && $subtitle == 'list'?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>List
                        </a>
                    </li>
                </ul>
            </li>

            <!--Student Documents-->
            <li <?= ($title == 'student_documents'?'class="active"':'') ?>
                <?= $this->authorization->is_role_for_group("student_documents") ? '' : 'hidden'; ?>>
                <a class="sidebar-header" href="#"
                    <?= ($title=='student_documents'?'style="font-weight: 800 !important;"':'') ?>>
                    <i data-feather="box"></i>
                    <span>Students Documents</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li <?= $this->authorization->is_role_for_group('can_view_student_documents','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/student_documents/list') ?>"
                        <?= ($title == 'student_documents' && $subtitle == 'list'?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>List
                        </a>
                    </li>
                </ul>
            </li>

            <!--Users-->
            <li <?= ($title == 'users'?'class="active"':'') ?>
                <?= $this->authorization->is_role_for_group("sysytem_users") ? '' : 'hidden'; ?>>
                <a class="sidebar-header" href="#"
                    <?= ($title=='users'?'style="font-weight: 800 !important;"':'') ?>>
                    <i data-feather="box"></i>
                    <span>Users</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
				<ul class="sidebar-submenu">
                    <li <?= $this->authorization->is_role_for_group('can_view_users','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/users/list') ?>"
                        <?= ($title == 'users' && $subtitle == 'list'?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>List
                        </a>
                    </li>
                    <li <?= $this->authorization->is_role_for_group('can_add_users','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/users/new') ?>"
                        <?= ($title == 'users' && ($subtitle ==  'new' || $subtitle == 'update')?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>New
                        </a>
                    </li>
				</ul>
			</li>

            <!--Logs-->
            <li <?= ($title == 'logs'?'class="active"':'') ?>
                <?= $this->authorization->is_role_for_group("sysytem_logs") ? '' : 'hidden'; ?>>
                <a class="sidebar-header" href="#"
                    <?= ($title=='logs'?'style="font-weight: 800 !important;"':'') ?>>
                    <i data-feather="box"></i>
                    <span>Logs</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
				<ul class="sidebar-submenu">
                    <li <?= $this->authorization->is_role_for_group('can_view_sysytem_logs','title') ? '' : 'hidden'; ?>>
                        <a href="<?= base_url('app/logs/list') ?>"
                            <?= ($title == 'logs' && $subtitle == 'list'?'style="font-weight: 800 !important;"':'') ?>>
                            <i class="fa fa-circle"></i>List
                        </a>
                    </li>
				</ul>
			</li>

		</ul>
	</div>
</div>
<!-- Page Sidebar Ends-->