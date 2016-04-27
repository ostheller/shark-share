<div class="container-fluid">    
    <div class= "backwrapper0">
      <div class="row">
        <div class="col-sm-7 text-left">
          <h1 class="fontbold">Admin Tools</h1>
          <a href="/dashboard" class="dash-button btn btn-info" role="button">User View</a>
          <br>
          <br>
          <a href="/upload" class="btn btn-info dash-button" role="button">Upload</a>
          <br>
          <br>
          <a href="/user/<?=$this->session->userdata('id')?>" class="btn btn-info dash-button" role="button">Profile</a>
          <br>
          <br>
          <a href="/taxonomy" class="btn btn-info dash-button" role="button">Manage Site Taxonomy</a>
        </div>
        <div class="col-sm-7 width-70 text-left"> 
            <h1>Admin Dashboard</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, whoa, how did I get in here? sed do eiusmod tempor incididunt ut labore 
            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <hr>
            <h3>Test</h3>
            <p>Lorem ipsum...</p>
        </div>
      </div>
      <!--<div class="col-sm-10">-->
    <div class="row">
      <div class="col-sm-9 text-left">
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
      <div class="col-sm-9 text-left">
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