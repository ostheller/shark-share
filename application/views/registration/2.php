<?php echo form_open('accept'); ?>

<ul>
<li><h5>Accept Responibility Terms</h5></li>
<input type="checkbox" name="responsibility" value="accept" style="margin:10px" />
<?php echo form_error('responsibility'); ?>
<li><h5>Accept Acknowlegement Terms</h5></li>
<input type="checkbox" name="acknowledgement" value="accept" style="margin:10px" />
<?php echo form_error('acknowlegement'); ?>
<li><h5>Accept Shipping Terms</h5></li>
<input type="checkbox" name="shipping" value="accept" style="margin:10px" />
<?php echo form_error('shipping'); ?>

<div><input type="submit" value="Submit" /></div>

</form>