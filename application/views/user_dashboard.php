<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard</title>
		<script src="<?= base_url();?>/assets/js/jquery.js"></script>
		<script src="<?= base_url();?>/assets/js/bootstrap.min.js"></script>
		<script src="<?= base_url();?>/assets/js/browse.js"></script>
		<link href="<?= base_url();?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- Navbar -->
		<?php $this->load->view('partials/navbar'); ?>
		<!-- Page Content -->
		<h1>Hello World</h1>
	</body>
</html>