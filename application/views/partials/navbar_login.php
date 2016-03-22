<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
            <ul class="nav navbar-nav">
        <li><a href="/logout">Logout</a></li>
      </ul>
      <ul class="nav navbar-nav">
        <li><a href="/upload">GO TO UPLOAD PAGE</a></li>
      </ul>
      <?php $form = array('class' => 'navbar-form navbar-right','method' => 'post'); ?>
         <?= form_open('login_attempt', $form); ?>
           <div class="form-group">
            <?php $email = array(
              'type'=> 'text', 
              'class'=>'form-control', 
              'name' => 'email', 
              'placeholder' => 'Email');?>
               <?= form_input($email)?>
            </div>
            <div class="form-group">
            <?php $password = array(
              'type'=> 'password', 
              'class'=>'form-control', 
              'name' => 'password', 
              'placeholder' => 'Password');?> 
            <?= form_password($password)?>
              </div>
            <?php $submit = array(
              'type'=> 'submit', 
              'class'=>'btn btn-success',);?>
            <?= form_submit($submit, 'Sign In'); ?>
          <?= form_close(); ?>
    </div>
  </div>
</nav>