<div class="backgroundsetting container-fluid text-center">    
  <div class="row content">
      <!--<div class="col-sm-8-2 height-10 text-left">
      <h1>Search Samples</h1>
      </div-->
      <div class="col-sm-8-2 text-left"> 
        <h1>Search Samples</h1>      
        <hr>
        <div id="search_bar" class="col-md-12 well">  
        <form class="form" id = "search" method="post" action="search">
          <div class="col-md-6">
          <div class="form-group row">
            <label for="genus" class="col-sm-3 form-control-label">Genus</label> 
            <div class="col-sm-9">
              <input type="text" name="genus" id="genus" class="fitfont">
            </div>
          </div>
          <div class="form-group row">
            <label for="species" class="col-sm-3 form-control-label">Species</label> 
            <div class="col-sm-9">
              <input type="text" name="species" id="species" class="fitfont">
            </div>
          </div>
          <!--  Family:
          <input type="text" name="family" id="family">
          Order:
          <input type="text" name="order" id="order"> -->
        <div class="form-group row">
            <label for="name" class="col-sm-3 form-control-label">Contributer Name</label> 
            <div class="col-sm-9">
              <input type="text" name="name" id="name" size="50">
            </div>
          </div>
          <div class="form-group row">
            <label for="sample_type_id" class="col-sm-3 form-control-label">Sample Type</label> 
            <div class="col-sm-9">
            <select name="sample_type_id">
              <option></option>
              <?php foreach ($sample_types as $sample_type) { ?>
                <option value="<?= $sample_type['id'] ?>"><?= $sample_type['type'] ?></option>
              <?php } ?>
            </select>
            </div>
          </div>
        </div>
          <div class="col-md-6">
          <div class="form-group row">
            <label for="ocean_id" class="col-sm-3 form-control-label">Ocean Source</label> 
            <div class="col-sm-9">
             <select name="ocean_id">
              <option></option>
                <?php foreach ($oceans as $ocean) { ?>
                  <option value="<?= $ocean['id'] ?>"> <?= $ocean['name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="institution_id" class="col-sm-3 form-control-label">Institution</label> 
            <div class="col-sm-9">
              <select name="institution_id">
                <option></option>
                <?php foreach ($institutions as $institution) { ?>
                  <option value="<?= $institution['id'] ?>"><?= $institution['name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-roup row">
            <label for="gender" class="col-sm-3 form-control-label">Sex</label> 
            <div class="col-sm-9">
              <select name="gender">
                <option></option>
                <option value="1"> Male</option>
                <option value="2"> Female</option>
              </select>
            </div>
          </div>
          <div class="form-roup row">
          <button type="submit" class="btn btn-primary" id="search_submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
      <div id="toolbar">
          <button id="request" class="btn btn-primary" disabled>
              <i class="glyphicon"></i> Request
          </button>
      </div>
        <table id="search_results_table"
             data-toolbar="#toolbar"
             data-search="true"
             data-show-refresh="true"
             data-show-toggle="true"
             data-show-columns="true"
             data-show-export="true"
             data-detail-view="true"
             data-detail-formatter="detailFormatter"
             data-minimum-count-columns="2"
             data-show-pagination-switch="true"
             data-pagination="true"
             data-id-field="id"
             data-page-list="[10, 25, 50, 100, ALL]"
             data-show-footer="false"
             data-side-pagination="server"
             data-response-handler="responseHandler">
      </table>
        <!-- <table class = "table" id = 'browse_table' data-toggle="table">
           <caption>Results</caption>
            <form action="samples/request" method="post" id="request_form"></form>
           <thead>
              <tr>
                <th>id<th>
                <th>genus<th>
                <th>species<th>
                <th>sample type<th>
                <th>preservation medium<th>
                <th>Photos Available<th>
                <th>comments<th>
                <th><input type="submit" value="Request Samples"> <th>
              </tr>
           </thead>
           <tbody>
              <tr>
                <?php foreach ($data as $row) { ?>
                  <td><a href="/samples/<?=$row['id']?>"><?php echo $row['id']; ?></a><td>
                  <td><?php echo $row['Genus']; ?><td>
                  <td><?php echo ucwords($row['Species']); ?><td>
                  <td><?php echo $row['Sample Type']; ?><td>
                  <td><?php echo $row['Preservation Medium']; ?><td>
                  <td><?php if ($row['Photo Available'] == 0) {echo 'No';} else {echo 'Yes';} ?><td>
                  <td><?php echo $row['Comments']; ?><td>
                  <td><input type="checkbox" name='id<?= $row['id']?>' value="<?= $row['id']?>" /></td>
                </tr> 
                  
                  <?php } echo form_close(); ?>            
           </tbody>    
        </table> -->
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url();?>/assets/js/custom/search.js"></script>