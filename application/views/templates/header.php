<html>
	<head>
		<title>UCSTicket</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
	</head>
	<body>
	<nav class="navbar navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">
      <img src="<?php echo base_url(); ?>assets/icon.png" alt="" width="50" height="50" class="d-inline-block align-text-middle">
      UCSTickets
    </a>
	<?php if($this->session->userdata('logged_in')) : ?>
	<a class="btn navi btn-primary MSButton" href="<?php echo base_url('/users/logout') ?>" style="max-width:100px;" role="button">Logout</a>
	<?php endif ?>
	<?php if($this->session->userdata('Role')=='Admin') : ?>
	<a class="btn navi btn-primary MSButton" href="<?php echo base_url('/users/viewusers') ?>" style="max-width:120px;" role="button">View Users</a>
	<a class="btn navi btn-primary MSButton" href="<?php echo base_url('/itassets/viewassets') ?>" style="max-width:120px;" role="button">View Assets</a>
	<?php endif ?>	
	<a class="btn navi btn-primary MSButton" href="<?php echo base_url('tickets') ?>" style="max-width:100px;" role="button">Home</a>
	
  </div>
</nav>
<div class="container">


<?php if ($this->session->flashdata('login_failed')): ?>
	<?php echo '<div class="flash"><p class="alert alert-success">'.$this->session->flashdata('login_failed').'</p></div>';?>
	<?php endif; ?>


