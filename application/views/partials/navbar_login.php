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
      <?php $form = array('class' => 'navbar-form navbar-right','method' => 'post'); ?>
         <?= form_open('login', $form); ?>
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
          <?php if (isset($errors)) {echo $errors; } ?></li>
    </div>
  </div>
</nav>