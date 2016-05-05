<div class="container-fluid text-center">    
  <div class="row content">
    <!--<div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>-->
    <div class="col-sm-8 text-left"> 
      <h1><?php echo $first_name . " " . $last_name?>'s Profile</h1>
      <?php if($this->session->userdata['id'] == $id) echo '<p>This is your profile. <a href="#">Edit it.</a></p>'; ?>
      <hr>
      <h3>Test</h3>
      <p><?= $status ?> from <?= $name?>, <?= $city?></p>
    </div>
    <!--<div class="col-sm-2 sidenav">
      <div class="well">
        <p>Content</p>
      </div>
      <div class="well">
        <p>Content</p>
      </div>
    </div>-->
  </div>
</div>