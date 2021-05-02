<h2><? =$title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('itassets/create'); ?>
	<div class="form-group loginelement">
		<label>Asset Name</label>
		<input type='text' class="form-control" name="name" placeholder="Name">
	</div>
	<div class="form-group">		
	<label>Asset Type</label>
	<select class="form-control" name="type">
		<option value="Laptop">Laptop</option>
		<option value="Computer">Computer</option>
		<option value="Mouse">Mouse</option>
		<option value="Speakers">Speakers</option>
		<option value="Peripheral">Peripheral</option>
		<option value="Projector">Projector</option>
		<option value="Monitor">Monitor</option>
		<option value="Whiteboard">Whiteboard</option>
		<option value="TV">TV</option>
	</select>
	</div>
	<div class="form-group loginelement">
		<label>Room</label>
		<input type='text' class="form-control" name="room" placeholder="Room">
	</div>	
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>

