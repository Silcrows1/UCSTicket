<h2><? =$title; ?></h2>
<?php echo validation_errors(); ?>
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
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>



