<div class="backgroundsetting container-fluid">    
    <div class= "backwrapper0">
      <div class="row">
        <div class="col-sm-5 width-20 text-left well">
          <h1 class="fontbold">Admin Tools</h1>
          <ul id="sidebar_nav">
            <li><a href="/dashboard" class=" btn btn-primary">User View</a></li>
            <li><a href="/upload" class="btn btn-primary ">Upload Samples</a></li>
            <li><a href="/collection/<?=$this->session->userdata('id')?>" class="btn btn-primary">View Collection</a></li>

<!--             <li><a href="/user/<?=$this->session->userdata('id')?>" class="btn btn-primary ">Profile</a></li>
 -->            <li><a href="/taxonomy" class="btn btn-primary ">Manage Site Taxonomy</a></li>
          <ul>
        </div>
        <div class="col-sm-7 width-70 text-left well about"> 
            <h1>Hello, <?= $this->session->userdata('first_name') ?> <?= $this->session->userdata('last_name') ?>!</h1>
            <p>
              Welcome back to Shark Share Global.
            </p>
            <p>
            This is your Administrative Dashboard- where you can check incoming requests,
              track new users as they utilize the setup process, send notifications, and monitor the site in general. In order to
              see your samples and interact with other researchers as a regular user would, please click 'User View' in your side
              menu.
            </p>
            <hr>
            <p>
              Further Notifications will appear here as needed!
            </p>
            <!--<p>!!!!!!!!!   THESE LINKS ARE FOR THE EDITING PROCESS AND NEED TO BE COMMENTED OUT FOR THE FINAL PROJECT !!!!!!</p>
            <ul>
              <li><a style="font-weight:bold" href="/edit/two"> Temporary Link: Edit T&amp;C Page</a></li>
              <li><a style="font-weight:bold" href="/edit/three"> Temporary Link: Edit Registration Success Page</a></li>
              <li><a style="font-weight:bold" href="/edit/profile_page"> Temporary Link: Edit Setup Profile Page</a></li>
            </ul>
            <p>!!!!!!!!!   THESE LINKS ARE FOR THE EDITING PROCESS AND NEED TO BE COMMENTED OUT FOR THE FINAL PROJECT !!!!!!</p>-->
        </div>
      </div>
      <!--<div class="col-sm-10">-->
    <div class="row">
      <div class="col-sm-9 text-left well">
        <h2>Registration Requests</h2>
       <div id="toolbar">
          <button id="approve" class="btn btn-primary" disabled>
              <i class="glyphicon glyphicon-thumbs-up"></i> Approve
          </button>
          <button id="reject" class="btn btn-danger" disabled>
              <i class="glyphicon glyphicon-remove"></i> Reject
          </button>
        </div>
        <div>
        <table class= "col-sm-9" id="potential_user_table"
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
    </div>
  </div>
</div>
  <div class="row">
      <div class="col-sm-9 text-left well" id="padbottom">
    <h2>Pending Email Invites</h2>
    <div>
        <table class="col-sm-9" id="email_sent_table"
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
    </div>
  </div>
</div>
<!--</div>-->
<!-- start: Delete Potential User Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h3 class="modal-title" id="myModalLabel">Notice</h3>

              </div>
              <div class="modal-body">
                   <h4> Are you sure you want to reject the selected registration request(s)?</h4>

              </div>
              <!--/modal-body-collapse -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              </div>
              <!--/modal-footer-collapse -->
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
</div>