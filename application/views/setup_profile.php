<div class="container-fluid text-center">    
  <div class="row content" id="forms">
    <div class="col-sm-12 text-left">
    <h1>Hello and Welcome, <?=$user['first_name']?> <?=$user['last_name']?>!</h1>
    <hr>
    <div id="setup_profile_block" class="info_block">
    <h3>Set Up Profile:</h3>
      <form id="setup" method="post" action="setup/submit">
        <h5>Choose a username</h5>
        <input type="hidden" value="<?=$user['id']?>" name="id">
        <input type="text" name="username" value="<?php echo set_value('Username'); ?>" size="50" />
        <?php echo form_error('username'); ?>
        <h5>Password</h5>
        <input type="password" name="password" value="" id="password" size="50" />
        <span id="result"></span>
        <?php echo form_error('password'); ?>
        <h5>Password Confirm</h5>
        <input type="password" name="passconf" value="" size="50" />
        <?php echo form_error('passconf'); ?>
        <h5>Introduce Yourself</h5>
        <textarea name="about" value="<?php echo set_value('About'); ?>" cols="50" rows="4"></textarea>
        <?php echo form_error('about'); ?>
        <div><button id ="setup_pasword" class="btn btn-primary submit">Submit</button></div>
        <div><span id="password_result"></span></div>
      </form>
    </div>
    <div id="verify_info_block" class="info_block">
      <h3>Verify Your Information:</h3>
        <form id= "verify" method="post" action='user/update')>
          <h5>First Name</h5>
          <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" size="50" />
          <?php echo form_error('first_name'); ?>
          <h5>Last Name</h5>
          <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" size="50" />
          <?php echo form_error('last_name'); ?>
          <h5>Email Address</h5>
          <input type="text" name="email" value="<?php echo $user['email']; ?>" size="50" />
          <?php echo form_error('email'); ?>
          <h5>Institution</h5>
          <input type="text" name="institution" value="<?php echo $user['institution']; ?>" size="50" />
          <?php echo form_error('institution'); ?>
          <h5>Field of Research</h5>
          <input type="text" name="field" value="<?php echo $user['field']; ?>" size="50" />
          <?php echo form_error('field'); ?>
          <h5>Academic Status</h5>
          <select name="status_id">
            <option value="1" <?php if ($user['status'] == 1) {echo 'selected';}?>>Undergraduate Student</option>
            <option value="2" <?php if ($user['status'] == 2) {echo 'selected';}?>>Graduate Student</option>
            <option value="3" <?php if ($user['status'] == 3) {echo 'selected';}?>>Professor</option>
          </select>
          <?php echo form_error('status_id'); ?>
          <h5>City</h5>
          <input type="text" name="city" value="<?php echo $user['city']; ?>" size="50" />
          <?php echo form_error('city'); ?>
          <h5>Country</h5>
          <select name="country">
            <?php foreach ($countries as $country) { ?>
              <option value="<?= $country['id'] ?>" <?php if ($country['id'] == intval($user['country_id'])) {echo 'selected';}?>><?= $country['code'] ?> (<?= $country['name'] ?>)</option>
            <?php } ?>
          </select>
          <div><button class="btn btn-primary submit disabled" id="verify_changes">Verify</button></div>
            <div><span id="verify_result"></span></div>
          </form>
        </div>
      <div class="info_block">
      <h3>Site Preferences:</h3>
      <form id="tags" method="post" action="/setup/tags">
        <input type="hidden" value="<?=$user['id']?>" name="id">
        <h5>Choose a preferred genus</h5>
          <input type="text" name="genus" id="genus" class="fitfont">
        <h5>Choose a preferred species</h5>
          <input type="text" name="species" id="species" class="fitfont">
        <h5>Choose a preferred sample type</h5>
        <select name="sample_type_id">
            <option></option>
            <?php foreach ($sample_types as $sample_type) { ?>
              <option value="<?= $sample_type['id'] ?>"><?= $sample_type['type'] ?></option>
            <?php } ?>
          </select>
          <div><button class="btn btn-primary submit disabled" id="submit_tags">Submit</button></div>
          <div><span id="tags_result"></span></div>
      </form>
      </div>
      <hr>
      <button class="disabled btn-lg btn-success btn" id="success_button">Enter Site</button>
    </div>
    </div>
</div>
<script src="<?= base_url();?>/assets/js/custom/setup_profile.js"></script>