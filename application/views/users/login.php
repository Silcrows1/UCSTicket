<script>
	function myFunction() {
  var x = document.getElementById("password");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
	} 
	</script>
<?php echo form_open('users/login'); ?>
	<div class="row">
		<div class="col-8 col-md-4 center login">
				<h1 class="text-center"><?php echo $title; ?></h1>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required autofocus>
					<input type="checkbox" onclick="myFunction()">Show Password 
				</div>
				<br>
				<button type="submit" class="btn btn-primary col-12"> Login </button>
		</div>
	</div>
	

<?php echo form_close(); ?>
