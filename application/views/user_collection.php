<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <?php if ($user != NULL) { ?>
        <h1><?php echo $user['first_name'] . " " . $user['last_name']?>'s Collection of Samples</h1>
      <?php } else {echo "<h1>This user does not exist</h1>";} ?>
      <?php if ($data != NULL) { ?>
      <table class = "table">
         <thead>
            <tr>
            <?php foreach ($data[0] as $key => $value) { ?>
              <th><?php echo $key ?></th>
            <?php }?>
             <?php if($this->session->userdata['id'] == $user['id']) {
              echo "<th>Edit</th>"; }?>
            </tr>
         </thead>         
         <tbody> 
            <?php if($this->session->userdata['id'] == $user['id']) {
               for ($i=0; $i < count($data); $i++) { ?>
                <tr>
                  <?php foreach ($data[$i] as $key => $value) { ?>
                      <td><input type="text" name="<?= $key ?>" value="<?= $value ?>" /></td>
                  <?php } ?>                    
                    <td><button class="btn btn-primary" id="<?= $data[$i]['id'] ?>">Update #<?= $data[$i]['id'] ?></button></td>
                </tr>
                <?php } } else {
                for ($i=0; $i < count($data); $i++) { ?>
                  <tr>
                  <?php foreach ($data[$i] as $key => $value) { ?>
                      <td><?= $value ?></td>
                  <?php } } }?>                    
                  </tr>
         </tbody>    
      </table>
      <?php } else echo "<p>No samples yet!</p>"; ?>
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