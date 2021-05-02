
<?php if ($this->session->userdata('logged_in')!=FALSE) {
       redirect('tickets');	;
    }?>
<div class="container center">
<h2 class="Welcome" style="text-align:center"> Welcome to UCS Tickets <br> Please Log in</h2>
<br>
<br>
<a class="btn btn-primary MSButton" href="<?php echo base_url('/users/login') ?>" style="max-width:100px;" role="button">Login</a>
<a class="btn btn-primary MSButton" href="<?php echo base_url('/users/register') ?>" style="max-width:100px;" role="button">Register</a>
</div>
