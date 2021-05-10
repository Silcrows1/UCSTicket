
<?php echo validation_errors(); ?>
<?php foreach($tickets as $ticket) : ?>

		<?php echo form_open_multipart('tickets/editticket/'.$ticket['ticketid']); ?>
			
	<div class="form-group loginelement">
	<h2><?php echo $type; ?> Ticket Edit</h2>
		<label>Ticket Title</label>
		<input type='text' class="form-control" name="title" value="<?php echo $ticket['title']?>">
	</div>

	
	<!-- if form is for a general ticket, hide assets-->
	<div class="form-group<?php if($type=="General"){echo" hide";} ?>">		
	<label>Asset Type</label>
	<select class="form-control assetselect" name="assettype[]" multiple>
	<!--add selected assets back in-->
	<?php foreach($assets as $asset) : ?>
	<option value="<?php echo $asset['id']?>" selected><?php echo $asset['AssetName'].' '.$asset['AssetType']  ?></option>
	<?php endforeach; ?>
	<!--add all assets back in but not the ones previously added for selected-->
	<?php foreach($assetsrests as $assetsrest) : ?>
		<?php if($assetsrest['id'] != $asset['id']) {
			echo "<option value=".$assetsrest['id'].">".$assetsrest['AssetName'].' '.$assetsrest['AssetType']."</option>";}?>
	<?php endforeach; ?>	
	</select>	
	</div>

	<div class="form-group loginelement">
		<label>Issue raised by</label>
		<input type='text' class="form-control" name="raisedby" value="<?php echo $ticket['raisedBy']?>">
	</div>
	<div class="form-group loginelement">
		<label>Description</label>
		<input type='text' class="form-control" name="description" value="<?php echo $ticket['body']?>">
	</div>
	<div class="form-group">		
		<label>Campus</label>
		<select class="form-control assetselect" name="campus[]" multiple>
		<option value= "Taunton"<?php foreach($campusassigneds as $campusassigned) : ?> <?php if($campusassigned['campus'] =="Taunton"){ echo 'selected="Selected"';}?><?php endforeach; ?>>Taunton</option>
		<option value="Bridgwater"<?php foreach($campusassigneds as $campusassigned) : ?> <?php if($campusassigned['campus'] =="Bridgwater"){ echo 'selected="Selected"';}?><?php endforeach; ?>>Bridgwater</option>
		</select>
	</div></br>
	<div class="form-group">		
		<label>Assign to user/s</label>
		<select class="form-control assetselect" name="assigned[]" multiple>
		<option value="0" >All users</option>		
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
		<?php endforeach; ?>
<?php echo form_close(); ?>



