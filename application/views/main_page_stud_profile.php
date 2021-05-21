<?php $this->load->view('constants/header_stud_profile'); ?>

<?= isset($alert_page) ? $alert_page : $this->session->flashdata('alert'); ?>

<?= isset($page_view) ? $page_view : 'No Page'; ?>

<?php $this->load->view('constants/footer'); ?>
