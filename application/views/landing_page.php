<div class="backgroundsetting container-fluid text-center">    
  <div class="row content">
    <div class= "backwrapper">
      <div class= "col-sm-8 text-left">
        <h1>What is Shark Share?</h1>
        <p> 
          Shark Share is a virtual tissue bank for all species 
          of Chondrichthyans (sharks, rays and chimeras) in an effort 
          to reduce sampling inefficiencies and facilitate global 
        collaboration. Often researchers are collecting samples 
        for critical research projects and by using the Shark Share 
        platform coordinated sampling approaches are more easily 
        arranged.
        </p>
        <hr>
        <h1>Who can use it?</h1>
        <p>
        Currently the Shark Share Global database is only available 
        for members belonging to research institutions and government 
        agencies. Public access is not granted due to ethics 
        requirements around sample collection. For more information 
        please email <a href="info@sharkshareglobal.org">info@sharksharglobal.org</a>.
        </p>
        <hr>
        <div>
          <img class="image-bar" src="/assets/images/C_speed1.jpg" alt="testpic">
          <img class="image-bar" src="/assets/images/C_speed2.jpg" alt="testpic2">
          <img class="image-bar" src="/assets/images/C_speed3.jpg" alt="testpic3">
          <img class="image-bar" src="/assets/images/C_speed4.jpg" alt="testpic4">
          <img class="image-bar" src="/assets/images/C_speed5.jpg" alt="testpic4">
          <img class="image-bar" src="/assets/images/C_speed6.jpg" alt="testpic4">        
        </div>
      </div>
      <div class="signup-bar heightfixed" id="margin-right">
        <h1 style="font-size=80%">
          Interested in joining?
        </h1>
        <hr>
        <span><a style="font-size:150%" href="/register"> Sign up here!</a></span>
      </div>
      <div class ="sponsor-bar" id="leftspacing"> 
        <h1 style="font-size=80%">Our Sponsors and Partners</h1>
        <p class = "horizontal">
         <a target="_blank" href="http://www.shark-references.com">
          <img class = "sponsor-image" src="/assets/images/sharkreflogo.png" alt= "sharkreflogo">
        </a>
        <a target="_blank" href="https://sharksrays.org">
          <img class = "sponsor-image" src="/assets/images/sharksrays.png" alt= "treelife drawing">
        </a>
         <a target="_blank" href="http://www.saveourseas.com/"> 
          <img class = "sponsor-image" src="/assets/images/soslogo.png" alt= "soslogo">
        </a>
        <a target="_blank" href="http://www.iucnredlist.org">
          <img class = "sponsor-image" src="/assets/images/redlistlogo.jpg" alt= "redlistlogo">
        </a>
         <a target="_blank" href="https://cites.org">
          <img class = "sponsor-image" src="/assets/images/citeslogo.jpg" alt= "citeslogo">
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
<!-- start: Forgot Password Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h3 class="modal-title" id="myModalLabel">Forgot Your Password?</h3>

              </div>
              <div class="modal-body">
                <h4>Create a New One</h4>
                <p>The new password will be sent to the entered email address. The email address must be the one with which you have registered at Shark Share.</p>
                <form id="new_password">
                  <h5>Email:</h5>
                    <input type="text" name="email" size="50" />
                  <h5>Password:</h5>
                    <input type="password" name="password" id="password" size="50" />
                    <span id="result"></span>
                  <h5>Confirm Password:</h5>
                    <input type="password" name="confirm_password" id ="confirm_password" size="50" />
                    <span id="confirm_result"></span>
                </form> 
                <span id="errors"></span>
              </div>
              <!--/modal-body-collapse -->
             <div class="modal-footer">
                  <button type="button" class="btn btn-primary disabled" id="reset_email" href="#">Send Email</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
              <!--/modal-footer-collapse -->
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->