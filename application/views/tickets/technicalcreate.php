<!--Title -->
<h2><? =$title; ?></h2>
<!--Validation Errors show here -->
<?php echo validation_errors(); ?>
<!-- if user is not logged in, redirect -->
<?php if ($this->session->userdata('logged_in')!=TRUE) {
       redirect('users/login');	;
    }?>
	<!--Form location -->
<?php echo form_open('createT'); ?>
	<div class="form-group loginelement">
		<label>Ticket Title</label>
		<!--Title input-->
		<input type='text' class="form-control" name="title" placeholder="Title">
	</div>
	<div class="form-group">		
	<label>Asset Type</label>
	<!--Load all assets for multiple select -->
	<select class="form-control assetselect" name="assettype[]" multiple>
	<?php foreach($assets as $asset) : ?>
		<option value="<?php echo $asset['id']?>"><?php echo $asset['AssetName'].' '.$asset['AssetType']  ?></option>
		<?php endforeach; ?>
	</select>
	</div>
	<!--Raised by input -->
	<div class="form-group loginelement">
		<label>Issue raised by</label>
		<input type='text' class="form-control" name="raisedby" placeholder="Name">
	</div>
	<!-- Description Input -->
	<div class="form-group loginelement">
		<label>Description</label>
		<input type='text' class="form-control" name="description" placeholder="Description">
	</div>
	<div class="form-group">
	<!-- Load campuses for select options-->
	<label>Campus</label>
	<select class="form-control assetselect" name="campus[]" multiple>
	<option value="Taunton">Taunton</option>
	<option value="Bridgwater">Bridgwater</option>
	</select>
	</div>
	<br>
	<div class="form-group">	
	<!--Load all users for multiple select options -->
	<label>Assign to user/s</label>
	<select class="form-control assetselect" name="assigned[]" multiple>		
	<?php foreach($users as $user) : ?>
	
		<option value="<?php echo $user['id']?>"><?php echo $user['FirstName'].' '.$user['LastName']  ?></option>
		<?php endforeach; ?>
	</select>
	</div>
	<br>
	<button type="submit" class="btn viewbtn">submit</button>
<?php echo form_close(); ?>



