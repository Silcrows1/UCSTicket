<!--Search bar for users-->
<div class="container searchbar col-lg-6 col-sm-12 col-xs-12">  
	<form action="<?php echo base_url(); ?>users/search" method = "post" class="searchbar">
	<label for="keyword">Search
	<input class = "input" type="text" name = "keyword" label="Search" />
	<input type="submit" value = "Search" />
	</label>
	</form>
	<br>
	<br>
</div>
<!--Title-->
<h2><?= $title ?></h2>

<div class="container" style="overflow-x:auto;">
			<!--Table to display all users-->
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
		  <!--Append all users in users array-->
		  <?php foreach($users as $user) : ?>
		  <tr>
			<td><?php echo $user['FirstName'] ?></td>
			<td><?php echo $user['LastName'] ?></td>
			<td><?php echo $user['email'] ?></td>
			<td><?php echo $user['department'] ?></td>
			<td><?php echo $user['roles'] ?></td>
			<!--Edit and delete buttons for each user appended-->
			<td><a class="btn viewbtn" href="<?php echo base_url('/users/view/'.$user['id']) ?>" style="max-width:100px;" role="button">Edit</a></td>
			<td><a class="btn viewbtn" href="<?php echo base_url('/users/delete/'.$user['id']) ?> "  onclick="return confirm('\t Are you sure you want to delete this ticket? \t \n\t This is irreversible \t') " style="max-width:100px;" role="button">Delete</a></td>

		  </tr>
	<?php endforeach; ?>
	</table> 
	<a class="btn viewbtn" href="<?php echo base_url('/users/register/')?>" style="max-width:150px; margin-top:2vh;" role="button">Create User</a>
</div>
