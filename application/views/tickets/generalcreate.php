<h2><? =$title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('createG'); ?>
	<div class="form-group loginelement">
		<label>Ticket Title</label>
		<input type='text' class="form-control" name="title" placeholder="Title">
	<div class="form-group loginelement">
		<label>Issue raised by</label>
		<input type='text' class="form-control" name="raisedby" placeholder="Name">
	</div>
	<div class="form-group loginelement">
		<label>Description</label>
		<input type='text' class="form-control" name="description" placeholder="Description">
	</div>
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>
