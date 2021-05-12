<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="UCSTickets">
		<!--Title -->
		<title>UCSTicket</title>
		<!--Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!--Ajax required for Select2 -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script> 
		<!--CSS -->
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
		<!--Fonts -->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Cantarell&display=swap" rel="stylesheet">
		</head>

	<body>
	<!--NAV BAR-->
	<nav class="navbar navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">
      <img src="<?php echo base_url(); ?>assets/icon.png" alt="" width="50" height="auto" class="d-inline-block align-text-middle">
      UCSTickets
    </a>
	<!--View User and Archive only available to Admin -->
	<?php if($this->session->userdata('Role')=='Admin') : ?>
	<a class="btn navi MSButton" href="<?php echo base_url('/users/viewusers') ?>" style="max-width:120px;" role="button">View Users</a>
	<a class="btn navi MSButton" href="<?php echo base_url('/archive') ?>" style="max-width:130px;" role="button">View Archive</a>
	<?php endif ?>	
	<!--All other options available to users logged in -->
	<?php if($this->session->userdata('logged_in')) : ?>
	<a class="btn navi MSButton" href="<?php echo base_url('/itassets/viewassets') ?>" style="max-width:120px;" role="button">View Assets</a>           
	<a class="btn navi MSButton" href="<?php echo base_url('/options') ?>" style="max-width:130px;" role="button">Create Ticket</a>
	<a class="btn navi MSButton" href="<?php echo base_url('assigned/'.$this->session->userdata('user_id')); ?>" style="max-width:100px;" role="button">Action</a>
	<a class="btn navi MSButton" href="<?php echo base_url('/users/logout') ?>" style="max-width:100px;" role="button">Logout</a>
	<a class="btn navi MSButton" href="<?php echo base_url('tickets') ?>" style="max-width:100px;" role="button">Home</a>
	<?php endif ?>	
  </div>	
</nav>
<div class="container">
<!--Flash data for login failed -->
<?php if ($this->session->flashdata('login_failed')): ?>
	<?php echo '<div class="flash"><p class="alert alert-success">'.$this->session->flashdata('login_failed').'</p></div>';?>
	<?php endif; ?>


