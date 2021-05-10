<div class="container searchbar col-lg-6 col-sm-12 col-xs-12">  
	<form action="<?php echo base_url(); ?>itassets/search" method = "post" class="searchbar">
	<label for="keyword">Search
	<input class = "input" type="text" name = "keyword" label="Search" />
	<input type="submit" value = "Search" />
	</label>
	</form>
	<br>
	<br>
</div>

<h2><?= $title ?></h2>

<div class="container" style="overflow-x:auto;">	
		 <table class="userstable" style="width:100%">
		  <tr>
			<th>Asset ID</th>
			<th>Asset Name/Identifier</th>
			<th>Asset Type</th>
			<th>Asset Room</th>
			<?php if ($this->session->userdata('Roles')=="Admin"){echo
			"<th>Edit</th>";
			echo "<th>Delete</th>"; } ?>
		  </tr>
		  <?php foreach($assets as $asset) : ?>
		  <tr>
			<td><?php echo $asset['id'] ?></td>
			<td><?php echo $asset['AssetName'] ?></td>
			<td><?php echo $asset['AssetType'] ?></td>
			<td><?php echo $asset['AssetRoom'] ?></td>
			<?php if ($this->session->userdata('Roles')=="Admin")
			{			
				echo'<td><a class="btn viewbtn" href="'.base_url('/itassets/viewasset/'.$asset['id']).'" style="max-width:100px;" role="button">Edit</a></td>';
				echo'<td><a class="btn viewbtn" href="'.base_url('/itassets/delete/'.$asset['id']).'" style="max-width:100px;" role="button">Delete</a></td>';
				echo '</tr>';
			}
			else
			{
				echo '</tr>';
			}			
			?>
			<?php endforeach; ?>
	</table> 
	<a class="btn viewbtn" href="<?php echo base_url('/itassets/create/')?>" style="max-width:150px; margin-top:2vh;" role="button">Create Asset</a>
</div>

