<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>THIS IS THE Upload</h1>
<form action="/samples/upload_batch" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>      <hr>
<?php if (isset($message)) { echo $message; } ?>
<?php
    if ($this->session->userdata('file_uploaded') != FALSE) { 
      $inputFileName = $this->session->userdata('file_uploaded');
      echo 'Your file: ' . $inputFileName . ' was uploaded successfully'; 
      }
    if (isset($header)) {
      echo '<pre>' . var_export($header, true) . '</pre>';
      echo '<pre>' . var_export($values, true) . '</pre>';
    }
?>
      <h3>Test</h3>
      <p>Lorem ipsum...</p>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>