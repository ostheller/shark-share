<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Search Samples</h1>      <hr>  
<div id="the-basics">
  <input class="typeahead" type="text" placeholder="States of USA">
</div>
      <form>
        Genus:
        <input type="text" name="genus" id="genus">
        Species:
        <input type="text" name="species" id="species">
        Sample Type:
        <select name="sample_type_id">
          <?php foreach ($sample_types as $sample_type) { ?>
            <option value="<?= $sample_type['id'] ?>"><?= $sample_type['type'] ?> (<?= $country['name'] ?>)</option>
          <?php } ?>
        </select>
        Location:
        <input type="text" name="location"><br>
        Contributer Name:
        <input type="text" name="name" id="name">
        Institution:
        <select name="institution_id">
          <?php foreach ($institutions as $institution) { ?>
            <option value="<?= $institution['id'] ?>"><?= $institution['name'] ?></option>
          <?php } ?>
        </select>
        Sex
        <input type="radio" name="gender" value="male"> Male<br>
        <input type="radio" name="gender" value="female"> Female<br>
      </form>
      <table class = "table">
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