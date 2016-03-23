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
        <li><a href="#">Put Cart Here</a></li>
      </ul>
    </div>
  </div>
</nav>