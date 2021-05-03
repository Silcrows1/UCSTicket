
<div class="container searchbar col-lg-6 col-sm-12 col-xs-12">  
	<form action="<?php echo base_url(); ?>tickets/search" method = "post" class="searchbar">
	<label for="keyword">Search
	<input type="text" name = "keyword" placeholder ="Search e.g name or title"label="Search" />
	<input type="submit" value = "Search" />
	</label>
	</form>
	<br>
	<br>
</div>
<form action="<?php echo base_url(); ?>tickets/search_category" method="POST">
    <select name="category" id="myselect" onchange="this.form.submit()">
	<option disabled selected value> -- filter options -- </option>
        <option value="Open">Open</option>
        <option value="Closed">Closed</option>
		<option value="All">View all</option>
    </select>
</form>

<h2><?= $title ?></h2>
<!--prevent users with no session from viewing tickets -->
<?php if ($this->session->userdata('logged_in')!=TRUE) {
       redirect('users/login');	;
    }?>
<!--Ticket card foreach loop -->
<div class="container" style="flex-wrap:wrap; display:flex;	">
	<?php foreach($tickets as $ticket) : ?>
		<div class="card tickets " style="display:inline-flex; min-width:200px; flex-grow:4; ">
			<h3 class="posttitle"><?php echo $ticket['title']; ?></h3>
				<div class="postcard row">
					<div class="col mainticketbody">
					<span class="dot" style="
					<?php if($ticket['status']=="Open"){//if ticket is open, set dot to green, else red//
						echo'background-color:green;';
						}
						else{ 						
						echo 'background-color:red;';
						}
						?>"> </span>
						<?php if($ticket['status']=="Open"){//if ticket is open, echo Green 'Active, else red 'Completed'//
						echo'<p class="status" style="color:green;">Active</p>';
						}
						else{ 						
						echo '<p class="status" style="color:red;">Completed</p>';
						}
						?>
						<br>
						<small class="post-date">Posted on: <?php echo $ticket['created_at']; ?> for <?php echo $ticket['raisedBy']; ?></small><br>
						<small class="post-date"><a class="effect-box" href=<?php if($ticket['ticketType'] =='General'){echo "general";}else{echo "technical";}?> <b> <?php echo $ticket['ticketType']; ?></b></a></small><br>
						<br>
						<p class="sampleticketbody"><?php echo word_limiter($ticket['body'], 20); ?></p>
					</div>	
				</div>
			<div class="openticket">	
			<a class="btn btn-primary open" href="<?php echo base_url('/tickets/'.$ticket['id']) ?>" style="max-width:100px;" role="button">Open</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>
