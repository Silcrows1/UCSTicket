<!--Title -->
<h2><? =$title; ?></h2>
<!--Validation Errors show here -->
<?php echo validation_errors(); ?>
<!--Redirect user if not logged in -->
<?php if ($this->session->userdata('logged_in')!=TRUE) {
       redirect('users/login');	;
    }?>
	<!--Form Location-->
<?php echo form_open('createG'); ?>
	<div class="form-group loginelement">
		<label>Ticket Title</label>
		<!--Title input-->
		<input type='text' class="form-control" name="title" placeholder="Title">
	<div class="form-group loginelement">
		<label>Issue raised by</label>
		<!--Enter Raised by name-->
		<input type='text' class="form-control" name="raisedby" placeholder="Name">
	</div>
	<div class="form-group loginelement">
		<label>Description</label>
		<!--Description input-->
		<input type='text' class="form-control" name="description" placeholder="Description">
	</div>
		<div class="form-group">		
		<label>Campus</label>
		<!--Campus input-->
		<select class="form-control assetselect" name="campus[]" multiple>
		<option value= "Taunton">Taunton</option>
		<option value="Bridgwater">Bridgwater</option>
		</select>
	</div></br>
	<div class="form-group">	
		<!--Load all users and assign users -->
		<label>Assign to user/s</label>
		<select class="form-control assetselect" name="assigned[]" multiple>
			<?php foreach($assignedusers as $assigneduser) : ?>	
			<option value="<?php echo $assigneduser['id']?>" selected><?php echo $assigneduser['FirstName'].' '.$assigneduser['LastName']  ?></option>
			<?php endforeach; ?>
			<?php foreach($users as $user) : ?>
		<?php if($user['id'] != $assigneduser['id']) {
			echo "<option value=".$user['id'].">".$user['FirstName'].' '.$user['LastName']."</option>";}?>
	<?php endforeach; ?>	
		</select>
	</div>
	<br>
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>
