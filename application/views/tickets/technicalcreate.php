<h2><? =$title; ?></h2>
<?php echo validation_errors(); ?>
<?php if ($this->session->userdata('logged_in')!=TRUE) {
       redirect('users/login');	;
    }?>
<?php echo form_open('createT'); ?>
	<div class="form-group loginelement">
		<label>Ticket Title</label>
		<input type='text' class="form-control" name="title" placeholder="Title">
	</div>
	<div class="form-group">		
	<label>Asset Type</label>

	<select class="form-control assetselect" name="assettype[]" multiple>
	<?php foreach($assets as $asset) : ?>
		<option value="<?php echo $asset['id']?>"><?php echo $asset['AssetName'].' '.$asset['AssetType']  ?></option>
		<?php endforeach; ?>
	</select>
	</div>
	<div class="form-group loginelement">
		<label>Issue raised by</label>
		<input type='text' class="form-control" name="raisedby" placeholder="Name">
	</div>
	<div class="form-group loginelement">
		<label>Description</label>
		<input type='text' class="form-control" name="description" placeholder="Description">
	</div>
	<div class="form-group">		
	<label>Campus</label>
	<select class="form-control assetselect" name="campus[]" multiple>
	<option value="Taunton">Taunton</option>
	<option value="Bridgwater">Bridgwater</option>
	</select>
	</div>
	<br>
	<div class="form-group">		
	<label>Assign to user/s</label>
	<select class="form-control assetselect" name="assigned[]" multiple>		
	<?php foreach($users as $user) : ?>
	
		<option value="<?php echo $user['id']?>"><?php echo $user['FirstName'].' '.$user['LastName']  ?></option>
		<?php endforeach; ?>
	</select>
	</div>
	<br>
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>



