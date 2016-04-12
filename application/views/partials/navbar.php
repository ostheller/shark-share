<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">SHARKSHARE</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/dashboard">Home</a></li>
        <li><a href="/browse">Browse</a></li>
        <li><a href="/collection/<?php echo $this->session->userdata('id'); ?>">Collection</a></li>
        <li><a href="/user/<?php echo $this->session->userdata('id'); ?>">Profile</a></li>
        <li><a href="/logout">Logout</a></li>
      </ul>
      <?php $form = array('class' => 'navbar-form navbar-right','method' => 'post'); ?>
         <?= form_open('keyword_search', $form); ?>
           <div class="form-group">
            <?php $keyword = array(
              'type'=> 'text', 
              'class'=>'form-control', 
              'name' => 'keyword', 
              'placeholder' => 'Search for samples');?>
               <?= form_input($keyword)?>
            </div>
            <?php $submit = array(
              'type'=> 'submit', 
              'class'=>'btn btn-success',);?>
            <?= form_submit($submit, 'Search'); ?>
          <?= form_close(); ?>
      <ul class="nav navbar-nav navbar-right pull">
        <li><a href="/request">Request Samples <?php if(isset($count)) echo '(' . $count .')'; ?></a></li>
      </ul>
    </div>
  </div>
</nav>