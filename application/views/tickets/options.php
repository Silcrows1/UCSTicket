<?php if ($this->session->userdata('logged_in')!=TRUE) {
       redirect('users/login');	;
    }?>
<div class="container center">
<h2 class="Welcome" style="text-align:center"> Please select ticket type <br> to create</h2>
<br>
<br>
<a class="btn viewbtn" href="<?php echo base_url('createt') ?>" style="max-width:100px;" role="button">Technical</a>
<a class="btn viewbtn" href="<?php echo base_url('createg') ?>" style="max-width:100px;" role="button">General</a>
</div>
