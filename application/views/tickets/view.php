
<div class="container" style="flex-wrap:wrap; display:flex;	">
	<?php foreach($tickets as $ticket) : ?>
	<button class="btn btn-primary viewbtn"><a href="<?php echo base_url('/tickets/delete/'.$ticket['id']) ?>" style="max-width:100px;" role="button">Delete ticket</a></button>
		<div class="card col-12">
			<h3 class="posttitle"><?php echo $ticket['title']; ?></h3>
			<div class="postcard row">
				<div class="col-md-9 col-sm-12">
					<div class="row-12 statusdiv">
						<span class="dot" style="
						<?php if($ticket['status']=="Open"){//if ticket is open, set dot to green, else red//
							echo'background-color:green;';
							}
							else{ 						
							echo 'background-color:red;';
							}
							?>"> </span>
						<?php if($ticket['status']=="Open"){ 
						echo '<style type="text/css">
								.dot2 {
								background-color: green;
							}
								</style>';
						echo'<p style="color:green;">Active</p>';
						}
						else{ 
						
						echo '<p style="color:red;">Completed</p>';
						}
						?>
						</div>
						<div class="row-12 statusdiv view">
						<small class="post-date">Posted on: <?php echo $ticket['created_at']; ?> </a></small>
						</div>
						<div class="row-12 body">
						<p class="viewbody"><?php echo $ticket['body']; ?> </p>
						</div>
					</div>
				<div class="assetsview col-md-3 col-sm-12">
					<h5>Assets Affected</h5>
					<?php foreach($assets as $asset) : ?>
					<div class="row-3">
					
						<p><?php echo $asset['AssetName']; ?> <?php echo $asset['AssetType']; ?> </p>
					</div>
					<?php endforeach; ?>
				</div>					
			</div>	
			<?php if($ticket['status']=="Open"){//if ticket is open, set dot to green, else red//
							echo'<button class="btn btn-primary viewbtn"><a href="'.base_url('/comments/create_comments/'.$ticket['id']).'" style="max-width:100px;" role="button">Add comment</a></button>';
							}
							else{ 						
							echo '<button class="btn btn-primary viewbtn">Locked</button>';
							} ?>		
		</div>
	<?php endforeach; ?>

	<?php foreach($comments as $comment) : ?>
	<div class="card col-12 comments">
		<div class="row">
		
		<span><p>Posted by <?php echo $comment['FirstName'].' '.$comment['LastName'].' on '.$comment['created_at']; ?></p></span>

		<p><?php echo $comment['body']?></p>
		</div>
		<a href="<?php echo base_url('/comments/delete/'.$comment['commentid']) ?>">Delete</a>
	</div>
	<?php endforeach; ?>
</div>
