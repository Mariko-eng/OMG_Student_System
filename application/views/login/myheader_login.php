<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="YMG">
	<link rel="icon" href="<?= base_url($this->site_options->get_site_data('favicon')) ?>"/>
	<link rel="shortcut icon" href="<?= base_url($this->site_options->get_site_data('favicon')) ?>"/>
    <title><?= isset($title) ? humanize($title) : '' ?>
        | <?= $this->site_options->get_site_data('site_name') ?></title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/themify.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick-theme.css">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jsgrid.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/admin.css">

</head>
<body>

