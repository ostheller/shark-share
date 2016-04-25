<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-8 text-left"> 
      <h1>Upload Samples</h1>
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
  </div>
</div>