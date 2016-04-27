<div class="container-fluid">    
    <div class= "backwrapper0">
        <div class="col-sm-2 text-left">
          <h1 class="fontbold">User Tools</h1>
            <p><a href="/upload">Upload</a></p>
            <p><a href="/user/<?=$this->session->userdata('id')?>">Profile</a></p>
      <?php if($this->session->userdata['admin'] == TRUE) echo '<p><a href="/admin">Return to Admin Dashboard</a></p>'; ?>
        </div>
         <div class="col-sm-10">
            <div class="row">
            <div class="text-left"> 
              <h1>User Dashboard</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <hr>
              <h2>Sent Requests</h2>
                <div>
                    <table id="sent_requests"
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
        </div>
      </div>
    </div>