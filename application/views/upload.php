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
      echo '<p id="message">Please confirm there are no errors, and then submit the data to the database.</p>'; 
      }
    if (isset($header)) { ?>
      <div id="toolbar">
          <button id="submit" href="/upload/submit/final" class="btn btn-primary pull-right">
              Submit to Database
          </button>
          <button id="check_for_errors" class="btn btn-success pull-right">
              Check for Errors
          </button>
        </div>         <form id="validation">
      <table class = "table-bordered table-responsive" id="result_table">
         
         <thead>
            <tr>
              <th></th>
              <?php foreach ($header[1] as $col => $value) { ?>
               <th><?= $value ?></th>
               <?php } ?>
            </tr>
         </thead>

         <tbody>
            <tr>
              <?php for($i = 2; $i < count($values); $i++) {
                if ($values[$i]["A"] == NULL ) {
                    continue;
                  } else {?>
                  <td id="<?=$i?>" class="status"></td>
                  <input class="hidden" type="hidden" name="<?=$i?>_id" value="<?=$i?>"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_genus" value="<?= $values[$i]["A"] ?>" id="<?=$i?>_genus">
                  <td><input class="fitfont" type="text" name="<?=$i?>_species" value="<?= $values[$i]["B"] ?>" id="<?=$i?>_species"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_family" value="<?= $values[$i]["C"] ?>" id="<?=$i?>_family"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_order" value="<?= $values[$i]["D"] ?>" id="<?=$i?>_order"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_sex" value="<?= $values[$i]["E"] ?>" id="<?=$i?>_sex"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_sample_type" value="<?= $values[$i]["F"] ?>" id="<?=$i?>_sample_type"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_location_stored" value="<?= $values[$i]["G"] ?>" id="<?=$i?>_location_stored"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_avail_until" value="<?= $values[$i]["H"] ?>" id="<?=$i?>_avail_until"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_specimen_size_number" value="<?= $values[$i]["I"] ?>" id="<?=$i?>_specimen_size_number"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_specimen_size_unit" value="<?= $values[$i]["J"] ?>" id="<?=$i?>_specimen_size_unit"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_specimen_size_type" value="<?= $values[$i]["K"] ?>" id="<?=$i?>_specimen_size_type"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_specimen_identifier" value="<?= $values[$i]["L"] ?>" id="<?=$i?>_specimen_identifier"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_preservation_medium" value="<?= $values[$i]["M"] ?>" id="<?=$i?>_preservation_medium"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_sample_size" value="<?= $values[$i]["N"] ?>" id="<?=$i?>_sample_size"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_sample_tag_id" value="<?= $values[$i]["O"] ?>" id="<?=$i?>_sample_tag_id"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_ocean_collected" value="<?= $values[$i]["P"] ?>" id="<?=$i?>_ocean_collected"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_region_collected" value="<?= $values[$i]["Q"] ?>" id="<?=$i?>_region_collected"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_lat_dec" value="<?= $values[$i]["R"] ?>" id="<?=$i?>_lat_dec"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_long_dec" value="<?= $values[$i]["S"] ?>" id="<?=$i?>_long_dec"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_lat_deg" value="<?= $values[$i]["T"] ?>" id="<?=$i?>_lat_deg"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_long_deg" value="<?= $values[$i]["U"] ?>" id="<?=$i?>_long_deg"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_date_tagged" value="<?= $values[$i]["V"] ?>" id="<?=$i?>_date_tagged"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_photo" value="<?= $values[$i]["W"] ?>" id="<?=$i?>_photo"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_lab_id" value="<?= $values[$i]["X"] ?>" id="<?=$i?>_lab_id"></td>
                  <td><input class="fitfont" type="text" name="<?=$i?>_comment" value="<?= $values[$i]["Y"] ?>" id="<?=$i?>_comment" ></td>
<!--                 foreach ($row as $cells => $cell) { ?>
                <td><?= $cell ?></td> -->

                </tr> <?php } }?>       
         </tbody> 
         </form>   
      </table>
    <?php } ?>
    </div>
  </div>
</div>