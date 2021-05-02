<h2><?= $title ?></h2>

<div class="container" style="flex-wrap:wrap; display:flex;	">	
		 <table class="userstable" style="width:100%">
		  <tr>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Email</th>
			<th>Department</th>
			<th>Role</th>
			<th>Edit</th>
			<th>Delete</th>
		  </tr>
		  <?php foreach($users as $user) : ?>
		  <tr>
			<td><?php echo $user['FirstName'] ?></td>
			<td><?php echo $user['LastName'] ?></td>
			<td><?php echo $user['email'] ?></td>
			<td><?php echo $user['department'] ?></td>
			<td><?php echo $user['roles'] ?></td>
			<td><a class="btn btn-primary MSButton" href="<?php echo base_url('/users/edit/'.$user['id']) ?>" style="max-width:100px;" role="button">Edit</a></td>
			<td><a class="btn btn-primary MSButton" href="<?php echo base_url('/users/delete/'.$user['id']) ?>" style="max-width:100px;" role="button">Delete</a></td>

		  </tr>
	<?php endforeach; ?>
	</table> 
</div>
