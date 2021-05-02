<h2><?= $title ?></h2>

<div class="container" style="flex-wrap:wrap; display:flex;	">	
		 <table class="userstable" style="width:100%">
		  <tr>
			<th>Asset ID</th>
			<th>Asset Name</th>
			<th>Description</th>
			<th>Department</th>
			<th>Edit</th>
			<th>Delete</th>
		  </tr>
		  <?php foreach($assets as $asset) : ?>
		  <tr>
			<td><?php echo $asset['id'] ?></td>
			<td><?php echo $asset['AssetName'] ?></td>
			<td><?php echo $asset['AssetType'] ?></td>
			<td><?php echo $asset['AssetRoom'] ?></td>
			<td><a class="btn btn-primary MSButton" href="<?php echo base_url('/itassets/viewasset/'.$asset['id']) ?>" style="max-width:100px;" role="button">Edit</a></td>
			<td><a class="btn btn-primary MSButton" href="<?php echo base_url('/itassets/delete/'.$asset['id']) ?>" style="max-width:100px;" role="button">Delete</a></td>

		  </tr>
	<?php endforeach; ?>
	</table> 
	<a class="btn btn-primary MSButton" href="<?php echo base_url('/itassets/create/')?>" style="max-width:150px; margin-top:2vh;" role="button">Create Asset</a>
</div>
