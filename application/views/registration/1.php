<div class="container-fluid text-center">    
  <div class="row content" id="forms">
    <div class="col-sm-12 text-left center-block">
		<div id="registration_form">
			<?php echo form_open('register/validate'); ?>

			<h5>First Name</h5>
			<input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>" size="50" />
			<?php echo form_error('first_name'); ?>
			<h5>Last Name</h5>
			<input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" size="50" />
			<?php echo form_error('last_name'); ?>
			<h5>Email Address</h5>
			<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />
			<?php echo form_error('email'); ?>
			<h5>Institution</h5>
			<input type="text" name="institution" value="<?php echo set_value('institution'); ?>" size="50" />
			<?php echo form_error('institution'); ?>
			<h5>Field of Research</h5>
			<input type="text" name="field" value="<?php echo set_value('field'); ?>" size="50" />
			<?php echo form_error('field'); ?>
			<h5>Academic Status</h5>
			<select name="status_id">
			  <option value="1" selected>Undergraduate Student</option>
			  <option value="2">Graduate Student</option>
			  <option value="3">Professor</option>
			</select>
			<?php echo form_error('status_id'); ?>
			<h5>City</h5>
			<input type="text" name="city" value="<?php echo set_value('city'); ?>" size="50" />
			<?php echo form_error('city'); ?>
			<h5>Country</h5>
			<select name="country">
				<?php foreach ($countries as $country) { ?>
					<option value="<?= $country['id'] ?>"><?= $country['code'] ?> (<?= $country['name'] ?>)</option>
				<?php } ?>
			</select>
			<?php echo form_error('country'); ?>
			<h5>Name of Reference</h5>
			<input type="text" name="reference_name" value="<?php echo set_value('reference'); ?>" size="50" />
			<?php echo form_error('reference_name'); ?>
			<h5>Email of Reference</h5>
			<input type="text" name="reference_email" value="<?php echo set_value('reference_email'); ?>" size="50" />
			<?php echo form_error('reference_email'); ?>

			<div><input class="btn btn-primary" type="submit" value="Submit" /></div>

			</form>
		</div>
	</div>
</div>