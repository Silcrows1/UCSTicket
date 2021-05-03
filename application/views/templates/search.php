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
