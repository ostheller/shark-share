<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <?php if ($this->session->userdata('admin' === true)) {
        echo '<p><a href="/admin">Admin Dashboard</a></p>
        <p><a href="/dashboard">Dashboard</a></p>';}
        else { echo '<p><a href="/dashboard">Dashboard</a></p>';} ?>
      <p><a href="/user/"<?=$this->session->userdata('id')?>"'">Profile</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Update the Taxonomy</h1>
      <form action="/taxonomies/get_template" method="post" enctype="multipart/form-data">
        <p>Download the required excel template:
          <input type="hidden" name="downloadFile" id="downloadFile">
          <input type="submit" value="Download Template" name="submit">
        </p>
      </form>
      <form action="/taxonomy/submit" method="post" enctype="multipart/form-data">
        <p>Upload template with data:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload File" name="submit">
        </p>
      </form>      <hr>
<?php if (isset($message)) { echo $message; } ?>
<?php if ($this->session->userdata('message') != FALSE) { echo $this->session->userdata('message'); } ?>
<?php
    if ($this->session->userdata('file_uploaded') != FALSE) { 
      $inputFileName = $this->session->userdata('file_uploaded');
      echo 'Your file: ' . $inputFileName . ' was uploaded successfully'; 
      }
    if (isset($header)) { ?>
      <a href="/taxonomy/submit/final"><button>Submit to Database</button></a>
      <a href="/taxonomy/update"><button>Update</button></a>
      <table class = "table">
         <caption>Uploaded Sheet</caption>
         
         <thead>
            <tr>
              <?php foreach ($header[1] as $col => $value) { ?>
               <th><?= $value ?></th>
               <?php } ?>
            </tr>
         </thead>
         
         <tbody>
            <tr>
              <?php foreach ($values as $row) { 
                foreach ($row as $cells => $cell) { ?>
                <td><?= $cell ?></td>

                <?php } ?> </tr> <?php }?>
            
         </tbody>    
      </table>
    <?php } ?>
    <?php if (isset($rows)) { ?>
      <h3>Current Taxonomy</h3>
      <table class = "table">
         <thead>
            <tr>
              <th>Shark Reference ID#</th>
              <th>Genus</th>
              <th>Species</th>
              <th>Author</th>
              <th>Family</th>
              <th>Order</th>
              <th>Edit</th>
            </tr>
         </thead>         
         <tbody> 
              <?php for ($i=0; $i < count($rows); $i++) { ?>
              <tr>
                <td><input type="text" name="species_ID_shark_references" value="<?= $rows[$i]['species_ID_shark_references'] ?>" /></td>
                <td><input type="text" name="taxonomy_genus" value="<?= $rows[$i]['taxonomy_genus'] ?>" /></td>
                <td><input type="text" name="taxonomy_species" value="<?= $rows[$i]['taxonomy_species'] ?>" /></td>
                <td><input type="text" name="author" value="<?= $rows[$i]['author'] ?>" /></td>
                <td><input type="text" name="taxonomy_family" value="<?= $rows[$i]['taxonomy_family'] ?>" /></td>
                <td><input type="text" name="taxonomy_order" value="<?= $rows[$i]['taxonomy_order'] ?>" /></td>
                <td><button class="btn btn-primary" id="<?= $rows[$i]['id'] ?>">Update #<?= $rows[$i]['id'] ?></button></td>
              </tr>
                <?php } }?> 
            
         </tbody>    
      </table>
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