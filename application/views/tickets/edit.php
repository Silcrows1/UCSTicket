<h2><? =$title; ?></h2>
<?php echo validation_errors(); ?>
<?php foreach($tickets as $ticket) : ?>
		<?php echo form_open_multipart('tickets/editticket/'.$ticket['id']); ?>
	<div class="form-group loginelement">
		<label>Ticket Title</label>
		<input type='text' class="form-control" name="title" value="<?php echo $ticket['title']?>">
	</div>
	<div class="form-group">		
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
	<button type="submit" class="btn btn-primary">submit</button>
		<?php endforeach; ?>
<?php echo form_close(); ?>



