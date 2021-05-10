
<div class="container" style="">
<?php foreach($users as $user) : ?>
		<?php echo form_open_multipart('users/edituser/'.$user['id']); ?>
		<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
		<div class="form-group">
			 <label>First Name</label>
		<input type="text" class="form-control" name="firstName" placeholder="Add Title" value="<?php echo $user['FirstName']?>">
		</div>
		<div class="form-group">
			 <label>Last Name</label>
		<input type="text" class="form-control" name="lastName" placeholder="Add Title" value="<?php echo $user['LastName']?>">
		</div>
		<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="email" placeholder="Add Title" value="<?php echo $user['email']?>">
		</div>
		<div class="form-group">
		<label>Password</label>
		<input type="text" class="form-control" name="password" placeholder="Enter new password if required">
		</div>
		<div class="form-group">
		<label>Department</label>
		<input type="text" class="form-control" name="department" placeholder="Add Title" value="<?php echo $user['department']?>">
		</div>		
		<div class="form-group">		
		<label>Role Select</label>
		<select class="form-control" name="roles">
			<option value="Admin"<?php if($user['roles']=='Admin') { echo "selected";}?>>Admin</option>
			<option value="Staff"<?php if($user['roles']=='Staff') { echo "selected";}?>>Staff</option>
		</select>
		</div>
		
		<button type="submit" class="btn viewbtn">submit</button>
	<?php endforeach; ?>
	</table> 
</div>
