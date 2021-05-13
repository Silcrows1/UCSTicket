
<div class="container" style="flex-wrap:wrap; display:flex;	">
<!--cycle through ticket array -->
	<?php foreach($tickets as $ticket) : ?>
	<!--change flashdata to correspond with tickettype -->
	<?php if ($ticket['ticketType']=="Technical"){
			$this->session->set_flashdata('type', 'Technical');
		}else{
			$this->session->set_flashdata('type', 'General');
		}?>
		<!--Delete option with confirmation required using confirm -->
	<button class="btn delete"><a href="<?php echo base_url('/tickets/delete/'.$ticket['ticketid']) ?>" onclick="return confirm('\t Are you sure you want to delete this ticket? \t \n\t This is irreversible \t') " style="max-width:100px;" role="button">Delete ticket</a></button>
		<div class="card col-12" style="flex-wrap:nowrap;">
		<!--Title preload -->
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
							<div class="row-12 statusdiv view"><!-- Append details for when the ticked was created and which user created it  -->
								<small class="post-date">Posted at: <?php echo (date("H:i A",strtotime ($ticket['created_at']))).' on '.(date("l jS F Y",strtotime ($ticket['created_at']))). ' by ' .($ticket['FirstName']).' '.($ticket['LastName'])?> </a></small>
							</div>						
						<!-- preload body -->						
						<div class="row-12 body">
						<p class="viewbody" style="background-color:#f2f2f2; width:98%"><?php echo $ticket['body']; ?> </p>
						</div>
					</div>
					<!--Show all assets found in assets affected table -->
				<div class="assetsview col-md-3 col-sm-12" style="flex-wrap:wrap; ">
					<div class="assetsview" style=" <?php if ($ticket['ticketType']=="General"){echo "display:none"; }?>">
						<h5 class="assettext">Assets Affected</h5>
						<?php foreach($assets as $asset) : ?>
						<div class="row-3 assetlist" >					
							<p ><?php echo $asset['AssetName']; ?> <?php echo $asset['AssetType']; ?> </p>
						</div>
						<?php endforeach; ?><br>
					</div>
					<div class="assetsview" style="flex-wrap:wrap; ">
					<!--Show all campuses selected that were found within campusassigned table -->
					<h5 class="assettext">Campus selected</h5>
					<?php foreach($campusassigneds as $campusassigned) : ?>
					<div class="row-3 assetlist">
						<p class="campus"><?php echo $campusassigned['campus']; ?> campus</a></p>
					</div>
					<?php endforeach; ?>
					</div>
				</div>					
			</div>
			<div class="buttons row-12" style=" margin-bottom:2vh;">			
			<?php if($ticket['status']=="Open"){//if ticket is open, show the edit and add comment buttons, else replace with locked button
							echo'<button class="btn viewbtn"><a href="'.base_url('/comments/create_comments/'.$ticket['ticketid']).'" style="max-width:100px;" role="button">Add comment</a></button>';
							echo '<button class="btn viewbtn"><a href="'.base_url('/tickets/edit/'.$ticket['ticketid']).'"style="max-width:100px;" role="button">Edit ticket</a></button>';
							}
							else{ 						
							echo '<button class="btn viewbtn">Locked</button>';
							} ?>	
							</div>
		</div>
	<?php endforeach; ?>
	<!--Append all comments found within the comments table -->
	<?php foreach($comments as $comment) : ?>
	<div class="card col-12 comments">
		<div class="row ">
			<!--Append all information contained -->
			<p class="dim">Posted by <?php echo $comment['FirstName'].' '.$comment['LastName'].' at '.(date("H:i A",strtotime ($comment['created_at']))).' on '.(date("l jS F Y",strtotime ($comment['created_at']))); ?></p>
			<?php if($comment['type'] =="resolution"){echo "<p class='' style='color:#00a125; margin-top:-1vh;'> Marked as <b> ". ucwords($comment['type'])."</b></p>";}?>
			<div class="container comment">
			<p><?php echo $comment['body']?></p>
			</div>
		</div>
		<!--Delete comment-->		
		<a style="position:relative; bottom:0vh; margin:2vh 0vh 0vh 0vh;"href="<?php echo base_url('/comments/delete/'.$comment['commentid']) ?>"  onclick="return confirm('\t Are you sure you want to delete this ticket? \t \n\t This is irreversible\t') ">Delete</a>
		
	</div>
	<?php endforeach; ?>
</div>
