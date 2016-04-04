<script src="<?= base_url();?>/assets/js/custom/upload.js"></script>
<link href="<?= base_url();?>/assets/css/custom/upload.css" rel="stylesheet" type="text/css">
</head>
<body>
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
      <h1>THIS IS THE Upload</h1>
      <form action="/collections/get_template" method="post" enctype="multipart/form-data">
        <p>Download our required excel template:
          <input type="hidden" name="downloadFile" id="downloadFile">
          <input type="submit" value="Download Template" name="submit">
        </p>
      </form>
      <form action="/collections/upload_batch" method="post" enctype="multipart/form-data">
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
      <a href="/upload/submit/final"><button>Submit to Database</button></a>
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
      <h3>Test</h3>
      <p>Lorem ipsum...</p>
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