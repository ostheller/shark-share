<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Search Samples</h1>      <hr>  
      <form id = "search" method="post" action="search">
        Genus:
        <input type="text" name="genus" id="genus">
        Species:
        <input type="text" name="species" id="species">
        <!--  Family:
        <input type="text" name="family" id="family">
        Order:
        <input type="text" name="order" id="order"> -->
        Sample Type:
        <select name="sample_type_id">
          <option></option>
          <?php foreach ($sample_types as $sample_type) { ?>
            <option value="<?= $sample_type['id'] ?>"><?= $sample_type['type'] ?></option>
          <?php } ?>
        </select>
        Location:
       <select name="country_id">
        <option></option>
          <?php foreach ($countries as $country) { ?>
            <option value="<?= $country['id'] ?>"><?= $country['code'] ?> (<?= $country['name'] ?>)</option>
          <?php } ?>
        </select>
        Contributer Name:
        <input type="text" name="name" id="name">
        Institution:
        <select name="institution_id">
          <option></option>
          <?php foreach ($institutions as $institution) { ?>
            <option value="<?= $institution['id'] ?>"><?= $institution['name'] ?></option>
          <?php } ?>
        </select>
        Sex
        <select name="gender">
          <option></option>
          <option value="1"> Male</option>
          <option value="2"> Female</option>
        </select>
       <button type="submit" class="btn btn-primary" id="search_submit">Submit</button>
      </form>
    <div id="toolbar">
        <button id="request" class="btn btn-primary" disabled>
            <i class=""></i> Request
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
<script src="<?= base_url();?>/assets/js/custom/search.js"></script>