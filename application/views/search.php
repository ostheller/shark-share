<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>THIS IS THE Search</h1>      <hr>
      <table class = "table">
         <caption>Results</caption>
         
         <thead>
            <tr>
              <th>sampleType<th>
              <th>preservationMedium<th>
              <th>Photos Available<th>
              <th>comments<th>
            </tr>
         </thead>
         
         <tbody>
            <tr>
              <?php { ?>
                <td><?php echo $sampleType; ?><td>
                <td><?php echo $preservationMedium; ?><td>
                <td><?php if ($photos == 0) {echo 'No';} else {echo 'Yes';} ?><td>
                <td><?php echo $comments; ?><td>
                <?php } ?> </tr>            
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