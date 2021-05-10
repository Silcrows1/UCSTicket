<!--Title -->
<h2><? =$title; ?></h2>
<!--Validation errors show here -->
<?php echo validation_errors(); ?>
<!--Form location -->
<?php echo form_open('users/register'); ?>
	<div class="form-group loginelement">
	<!--First name input -->
		<label>First Name</label>
		<input type='text' class="form-control" name="fname" placeholder="First Name">
	</div>
	<div class="form-group loginelement">
	<!--Last Name input-->
		<label>Last Name</label>
		<input type='text' class="form-control" name="lname" placeholder="Last Name">
	</div>
	<div class="form-group loginelement">
	<!--Department input -->
		<label>Department</label>
		<input type='text' class="form-control" name="dept" placeholder="Department">
	</div>
	<div class="form-group loginelement">
	<!--Email address input -->
		<label>Email Address</label>
		<input type='email' class="form-control" name="email" placeholder="Email Address">
	</div>
	<div class="form-group loginelement">
	<!--Password input-->
		<label>Password</label>
		<input type='text' class="form-control" name="password" placeholder="Password">
	</div>
	<div class="form-group loginelement">
	<!--Confirm password input (must match previous password (validation)) -->
		<label>Confirm Password</label>
		<input type='text' class="form-control" name="password2" placeholder="Confirm Password">
	</div>
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>

