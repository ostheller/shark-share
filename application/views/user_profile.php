<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-8-2 text-left"> 
      <h1><?php echo $first_name . " " . $last_name?>'s Profile</h1>
      <hr>
      <h3>About:</h3>
      <p>Username: <?= $user_name ?></p>
      <p><?= $status_name ?> from <?= $name?>, <?= $city?></p>
      <p>Email: <?= $email ?></p>
      <p>Bio: <?= $about ?></p>
      <p>Date joined: <?= $date ?></p>
      <?php if($this->session->userdata['id'] == $id) { 
        echo '<button id="edit_modal" class="btn btn-primary" data-toggle="modal" data-target="#edit_user">
              <i class="glyphicon glyphicon-edit"></i> Update Information
          </button>'; }?>
    </div>
  </div>
<!-- start: Edit User Modal -->
  <div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="edit_user_header" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h3 class="modal-title" id="edit_user_header">Update Information</h3>

              </div>
              <div class="modal-body text-left">
                    <form id="edit" action="/request/email">
                      <h5>Username</h5>
                        <input type="text" name="username" value="<?php echo $user_name; ?>" size="50" />
                        <?php echo form_error('username'); ?>
                      <h5>First Name</h5>
                        <input type="text" name="first_name" value="<?php echo $first_name; ?>" size="50" />
                        <?php echo form_error('first_name'); ?>
                      <h5>Last Name</h5>
                        <input type="text" name="last_name" value="<?php echo $last_name; ?>" size="50" />
                        <?php echo form_error('last_name'); ?>
                      <h5>Email Address</h5>
                        <input type="text" name="email" value="<?php echo $email; ?>" size="50" />
                        <?php echo form_error('email'); ?>
                      <h5>About</h5>
                        <textarea name="about" cols="50" rows="4"><?php echo $about; ?></textarea>
                        <?php echo form_error('about'); ?>
                      <h5>Institution</h5>
                        <input type="text" name="institution" value="<?php echo $name; ?>" size="50" />
                        <?php echo form_error('institution'); ?>
                      <h5>Field of Research</h5>
                        <input type="text" name="field" value="<?php echo $field; ?>" size="50" />
                        <?php echo form_error('field'); ?>
                      <h5>Academic Status</h5>
                        <select name="status_id">
                          <option value="1" <?php if ($status == 1) {echo 'selected';}?>>Undergraduate Student</option>
                          <option value="2" <?php if ($status == 2) {echo 'selected';}?>>Graduate Student</option>
                          <option value="3" <?php if ($status == 3) {echo 'selected';}?>>Professor</option>
                        </select>
                        <?php echo form_error('status_id'); ?>
                      <h5>City</h5>
                        <input type="text" name="city" value="<?php echo $city; ?>" size="50" />
                        <?php echo form_error('city'); ?>
                      <h5>Country</h5>
                        <select name="country">
                          <?php foreach ($countries as $country) { ?>
                            <option value="<?= $country['id'] ?>" <?php if ($country['id'] == $country_id) {echo 'selected';}?>><?= $country['code'] ?> (<?= $country['name'] ?>)</option>
                          <?php } ?>
                        </select>
                      </form>
              </div>
              <!--/modal-body-collapse -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="btnChooseContributer" href="#">Update</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
              <!--/modal-footer-collapse -->
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>