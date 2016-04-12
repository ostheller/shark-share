<?php echo form_open('register/accept'); ?>

<ul>
<li><h5>Accept Responibility Terms</h5>
<input type="checkbox" name="responsibility" value="accept" style="margin:10px" />
<?php echo form_error('responsibility'); ?></li>
<li><h5>Accept Acknowlegement Terms</h5>
<input type="checkbox" name="acknowledgment" value="accept" style="margin:10px" />
<?php echo form_error('acknowledgment'); ?></li>
<li><h5>Accept Shipping Terms</h5>
<input type="checkbox" name="shipping" value="accept" style="margin:10px" />
<?php echo form_error('shipping'); ?></li>
<div><input type="submit" value="Submit" /></div>
<?php if ($this->session->flashdata('errors') !== NULL) {echo $this->session->flashdata('errors');} ?>
</form>