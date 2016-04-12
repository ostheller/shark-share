<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <?php echo form_open('user/new/submit'); ?>
        <h5>First Name</h5>
        <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>" size="50" />
        <?php echo form_error('first_name'); ?>
        <h5>Last Name</h5>
        <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" size="50" />
        <?php echo form_error('last_name'); ?>
        <h5>Password</h5>
        <input type="password" name="password" value="" size="50" />
        <?php echo form_error('password'); ?>
        <h5>Password Confirm</h5>
        <input type="password" name="passconf" value="" size="50" />
        <?php echo form_error('passconf'); ?>
        <h5>Email Address</h5>
        <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />
        <?php echo form_error('email'); ?>
        <h5>Institution</h5>
        <input type="text" name="institution" value="<?php echo set_value('institution'); ?>" size="50" />
        <?php echo form_error('institution'); ?>
        <h5>Field of Research</h5>
        <input type="text" name="research" value="<?php echo set_value('research'); ?>" size="50" />
        <?php echo form_error('research'); ?>
        <h5>City</h5>
        <input type="text" name="city" value="<?php echo set_value('city'); ?>" size="50" />
        <?php echo form_error('city'); ?>
        <h5>Country</h5>
        <input type="text" name="country" value="<?php echo set_value('country'); ?>" size="50" />
        <?php echo form_error('country'); ?>
        <div><input type="submit" value="Submit" /></div>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>Content</p>
      </div>
      <div class="well">
        <p>Content</p>
      </div>
    </div>
  </div>
</div>