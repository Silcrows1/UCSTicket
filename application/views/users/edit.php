
<div class="container" style="flex-wrap:wrap; display:flex;	">
<?php foreach($users as $user) : ?>
<?php var_dump($user)?>
		<?php echo form_open_multipart('posts/create'); ?>
		<div class="form-group">
			 <label>First Name</label>
		<input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $user['FirstName']?>">
		</div>
		<div class="form-group">
			 <label>Last Name</label>
		<input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $user['LastName']?>">
		</div>
		<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $user['email']?>">
		</div>
		<div class="form-group">
		<label>Role Select</label>
		<select class="form-control" Selected="<?php echo $user['roles']?>">
			<option value="Super Admin" <?php if($user['roles']='SuperAdmin') echo "selected"?>>Super Admin</option>
			<option value="Admin"<?php if($user['roles']='Admin') echo "selected"?>>Admin</option>
			<option value="Staff"<?php if($user['roles']='Staff') echo "selected"?>>Staff</option>
			<option value="Standard"<?php if($user['roles']='Standard') echo "selected"?>>Standard</option>
		</select>
		</div>
	<?php endforeach; ?>
	</table> 
</div>
