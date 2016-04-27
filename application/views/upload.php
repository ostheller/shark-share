<div class="container-fluid text-center">    
  <div class="row content">
    <div class="neutralwrapper">
      <div class="col-sm-8-2 text-left"> 
      <h1>Upload Samples</h1>
      <form action="/collections/get_template" method="post" enctype="multipart/form-data">
        <h4>Download our required excel template:</h4>
        <p>
          <input type="hidden" name="downloadFile" id="downloadFile">
          <input class="btn btn-primary" type="submit" value="Download Template" name="submit">
        </p>
      </form>
      <hr>
      <form action="/collections/upload_batch" method="post" enctype="multipart/form-data">
        <h4>Upload template with data:</h4>
        <p>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" class="btn btn-primary" value="Upload File" name="submit">
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
    </div>
  </div>
</div>