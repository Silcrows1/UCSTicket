
<div class="container" style="">
<!--Cycle through user array-->
<?php foreach($users as $user) : ?>
		<!--form location -->
		<?php echo form_open_multipart('users/edituser/'.$user['id']); ?>
		<!--Store user id in hidden input-->
		<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
		<div class="form-group">
		<!--preload First name input -->
			 <label>First Name</label>
		<input type="text" class="form-control" name="firstName" placeholder="Add Title" value="<?php echo $user['FirstName']?>">
		</div>
		<div class="form-group">
		<!-- Preload Last Name input -->
			 <label>Last Name</label>
		<input type="text" class="form-control" name="lastName" placeholder="Add Title" value="<?php echo $user['LastName']?>">
		</div>
		<div class="form-group">
		<!--Preload Email input -->
		<label>Email</label>
		<input type="text" class="form-control" name="email" placeholder="Add Title" value="<?php echo $user['email']?>">
		</div>
		<div class="form-group">
		<!--Empty box if user requires a new password, can be left blank and old password will remain -->
		<label>Password</label>
		<input type="text" class="form-control" name="password" placeholder="Enter new password if required">
		</div>
		<div class="form-group">
		<!--Preload Deparment input -->
		<label>Department</label>
		<input type="text" class="form-control" name="department" placeholder="Add Title" value="<?php echo $user['department']?>">
		</div>		
		<div class="form-group">		
		<label>Role Select</label>
		<!--Preselect user role option -->
		<select class="form-control" name="roles">
			<option value="Admin"<?php if($user['roles']=='Admin') { echo "selected";}?>>Admin</option>
			<option value="Staff"<?php if($user['roles']=='Staff') { echo "selected";}?>>Staff</option>
		</select>
		</div>		
		<button type="submit" class="btn viewbtn">submit</button>
	<?php endforeach; ?>
	</table> 
</div>
