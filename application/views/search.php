<script src="<?= base_url();?>/assets/js/custom/search.js"></script>
<link href="<?= base_url();?>/assets/css/custom/search.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Search Samples</h1>      <hr>
      <form>
        Genus:
        <input type="text" name="genus">
        Species:
        <input type="text" name="species">
        Sample Type:
        <input type="text" name="type">
        Location:
        <input type="text" name="location">
        Sharer Name:
        <input type="text" name="name">
        Institution:
        <input type="text" name="institution">
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
              <th>sampleType<th>
              <th>preservationMedium<th>
              <th>Photos Available<th>
              <th>comments<th>
              <th><input type="submit" value="Request Samples"> <th>
            </tr>
         </thead>
         <tbody>
            <tr>
              <?php foreach ($data as $row) { ?>
                <td><a href="/samples/<?=$row['id']?>"><?php echo $row['id']; ?></a><td>
                <td><?php echo $row['sampleType']; ?><td>
                <td><?php echo $row['preservationMedium']; ?><td>
                <td><?php if ($row['photos'] == 0) {echo 'No';} else {echo 'Yes';} ?><td>
                <td><?php echo $row['comments']; ?><td>
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