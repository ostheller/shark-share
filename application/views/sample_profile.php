<script src="<?= base_url();?>/assets/js/custom/sample_profile.js"></script>
<link href="<?= base_url();?>/assets/css/custom/sample_profile.css" rel="stylesheet" type="text/css">
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
        <?php if (empty($data)) {
          echo "<h1>This sample does not exist</h1>";
        } else { ?>
          <h1><?php echo ucfirst($data['Genus']) . " " . ucfirst($data['Species']) . " " . ucfirst($data['Sample Type']); }?></h1>
      <?php if($this->session->userdata['id'] == $data['User id']) { ?>
             <button class="btn btn-primary btn">Edit Sample</button>
      <table class = "table">
         <thead>
            <tr>
            <?php foreach ($data as $key => $value) { ?>
              <th><?php echo $key ?></th>
            <?php }?>
            </tr>
         </thead>         
         <tbody>  
                <tr>
                  <?php foreach ($data as $key => $value) { ?>
                    <th><?php echo $value ?></th>
                  <?php }?>
                   <?php if($this->session->userdata['id'] == $data['User id']) { ?>
                    <td><button class="btn btn-primary" id="<?= $data[$i]['id'] ?>">Update #<?= $data[$i]['id'] ?></button></td>
                    <?php }}?>
            </tr>                 
         </tbody>    
      </table>
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
