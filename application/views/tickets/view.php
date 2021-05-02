<h2><?= $title ?></h2>
<div class="container" style="flex-wrap:wrap; display:flex;	">
	<?php foreach($tickets as $ticket) : ?>
		<div class="card col-12">
			<h3 class="posttitle"><?php echo $ticket['title']; ?></h3>
				<div class="postcard row">
					<div class="col">
						<span class="<?php if ($ticket['title'] == "Open") echo ' dot'; else echo 'dot2'?>"></span>
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
						<small class="post-date">Posted on: <?php echo $ticket['created_at']; ?> </a></small><br>
						<p><?php echo $ticket['body']; ?> </p>        
					</div>	
				</div>
			<a class="btn btn-primary" href="<?php echo base_url('/tickets/'.$ticket['id']) ?>" style="max-width:100px;" role="button">Add comment</a>
		</div>
	<?php endforeach; ?>
</div>
