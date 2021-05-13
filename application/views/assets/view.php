<!--Search bar and button -->
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
<!--Title -->
<h2><?= $title ?></h2>

<div class="container" style="overflow-x:auto;">	
			<!--Asset Table -->
		 <table class="userstable" style="width:100%">
		  <tr>
			<th>Asset ID</th>
			<th>Asset Name/Identifier</th>
			<th>Asset Type</th>
			<th>Asset Room</th>
			<?php if($this->session->userdata('Role')=='Admin') : ?>
			<!--Edit and Delete Table headers only viewable as Admin -->
			<th>Edit</th>
			<th>Delete</th>
			<?php endif ?>
		  </tr>
		  <?php foreach($assets as $asset) : ?>
		  <tr>
			<td><?php echo $asset['id'] ?></td>
			<td><?php echo $asset['AssetName'] ?></td>
			<td><?php echo $asset['AssetType'] ?></td>
			<td><?php echo $asset['AssetRoom'] ?></td>
			<?php if($this->session->userdata('Role')=='Admin') : ?>	
			<!--Edit and delete buttons only viewable as Admin -->
			<td><a class="btn viewbtn" href=" <?php echo base_url('/itassets/viewasset/'.$asset['id'])?>" style="max-width:100px;" role="button">Edit</a></td>
			<td><a class="btn viewbtn" href="<?php echo base_url('/itassets/delete/'.$asset['id'])?>"  onclick="return confirm('\t Are you sure you want to delete this ticket? \t \n\t This is irreversible \t') " style="max-width:100px;" role="button" >Delete</a></td>
			<?php endif ?>
			</tr>
	
			<?php endforeach; ?>
	</table> 
	<a class="btn viewbtn" href="<?php echo base_url('/itassets/create/')?>" style="max-width:150px; margin-top:2vh;" role="button">Create Asset</a>
</div>

