<? =$title; ?>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create_comments'); ?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="form-group">
		  <br><p>Please select comment type</p>
	<select class="form-control assetselect" name="type">
			<option value="comment" Selected="seleceted">Comment</option>
			<option value="resolution">Resolution</option>
	</select>
	</div>
	<div class="form-group loginelement">
		<label>Comment</label>
		<input type='text' class="form-control" name="body" placeholder="Write Comment Here">
	</div>
	<button type="submit" class="btn btn-primary">submit</button>
<?php echo form_close(); ?>
