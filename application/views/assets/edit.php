<h2><? =$title; ?></h2>
<?php foreach($assets as $asset) : ?>
<?php echo validation_errors(); ?>
<?php echo form_open('itassets/edit/'.$asset['id']); ?>
<input type="hidden" name="id" value="<?php echo $asset['id']; ?>">
	<div class="form-group loginelement">
		<label>Asset Name</label>
		<input type='text' class="form-control" name="AssetName" placeholder="Name"value="<?php echo $asset['AssetName']?>">
	</div>
	<div class="form-group">		
	<label>Asset Type</label>
	<select class="form-control" name="AssetType">
		<option value="Laptop" <?php if($asset['AssetType']=='Laptop'){ echo "selected";}?> >Laptop</option>
		<option value="Computer" <?php if($asset['AssetType']=='Computer'){ echo "selected";}?> >Computer</option>
		<option value="Mouse" <?php if($asset['AssetType']=='Mouse'){ echo "selected";}?> >Mouse</option>
		<option value="Speakers" <?php if($asset['AssetType']=='Speakers'){ echo "selected";}?> >Speakers</option>
		<option value="Peripheral" <?php if($asset['AssetType']=='Peripheral'){ echo "selected";}?> >Peripheral</option>
		<option value="Projector" <?php if($asset['AssetType']=='Projector'){ echo "selected";}?> >Projector</option>
		<option value="Monitor" <?php if($asset['AssetType']=='Monitor'){ echo "selected";}?> >Monitor</option>
		<option value="Whiteboard" <?php if($asset['AssetType']=='Whiteboard'){ echo "selected";}?> >Whiteboard</option>
		<option value="TV" <?php if($asset['AssetType']=='TV'){ echo "selected";}?> >TV</option>
	</select>
	</div>
	<div class="form-group loginelement">
		<label>Room</label>
		<input type='text' class="form-control" name="AssetRoom" placeholder="Room"value="<?php echo $asset['AssetRoom']?>">
	</div>	
	<button type="submit" class="btn viewbtn">submit</button>
<?php echo form_close(); ?>
	<?php endforeach; ?>
