<div class="container searchbar col-lg-6 col-sm-12 col-xs-12">  
	<form action="<?php echo base_url(); ?>itassets/search" method = "post" class="searchbar">
	<label for="keyword">Search
	<input type="text" name = "keyword" label="Search" />
	<input type="submit" value = "Search" />
	</label>
	</form>
	<br>
	<br>
</div>

<h2><?= $title ?></h2>

<div class="container" style="flex-wrap:wrap; display:flex;	">	
		 <table class="userstable" style="width:100%">
		  <tr>
			<th>Asset ID</th>
			<th>Asset Name/Identifier</th>
			<th>Asset Type</th>
			<th>Asset Room</th>
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

