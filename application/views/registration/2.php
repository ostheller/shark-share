<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-10 col-sm-offset-1 text-left well" id="box">
	<div>
		<?php echo form_open('register/accept'); ?>
		<h3>To save you time reading T&amp;Cs, here are the main aspects of Shark Share you are agreeing to when signing up.</h3> 
		<hr>
				<div class="checkbox">
				    <label>
				      <input name="responsibility" value="accept" type="checkbox"> <span class="lead">You agree that Shark Share is not responsible for samples submitted and interactions with other researchers</span>
				    </label>
					<?php echo form_error('responsibility'); ?>
				 </div>

				<div class="checkbox">
				    <label>
				      <input name="acknowledgment" value="accept" type="checkbox"> <span class="lead">You agree to abide by the decided level of acknowledgement for samples being shared</span>
				    </label>
					<?php echo form_error('acknowledgment'); ?>
				 </div>

				<div class="checkbox">
				    <label>
				      <input name="shipping" value="accept" type="checkbox"> <span class="lead">You agree to abide by the cost of shipping decided between yourself and another user</span>
				    </label>
					<?php echo form_error('shipping'); ?>
				 </div>

		<p>If you want to read the rest download our complete T&amp;Cs <a id="terms" href="#">here</a>.</p>
	</div>
	<div>
		<input class="btn btn-primary" type="submit" value="Confirm" />
		<?php if ($this->session->flashdata('errors') !== NULL) {echo $this->session->flashdata('errors');} ?>
		</form>
	</div>		
</div>
</div>
</div>	