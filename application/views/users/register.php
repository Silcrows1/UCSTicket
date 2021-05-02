<h2><? =$title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('users/register'); ?>
	<div class="form-group loginelement">
		<label>First Name</label>
		<input type='text' class="form-control" name="fname" placeholder="First Name">
	</div>
	<div class="form-group loginelement">
		<label>Last Name</label>
		<input type='text' class="form-control" name="lname" placeholder="Last Name">
	</div>
	<div class="form-group loginelement">
		<label>Department</label>
		<input type='text' class="form-control" name="dept" placeholder="Department">
	</div>
	<div class="form-group loginelement">
		<label>Email Address</label>
		<input type='email' class="form-control" name="email" placeholder="Email Address">
	</div>
	<div class="form-group loginelement">
		<label>Password</label>
		<input type='text' class="form-control" name="password" placeholder="Password">
	</div>
	<div class="form-group loginelement">
		<label>Confirm Password</label>
		<input type='text' class="form-control" name="password2" placeholder="Confirm Password">
	</div>
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>

