<div class="backgroundsetting container-fluid">    
    <div class= "backwrapper0">
      <div class="row">
        <div class="col-sm-5 width-20 height-set text-left well">
          <h1 class="fontbold">User Tools</h1>
          <ul id="sidebar_nav">
            <li><a href="/upload" class="btn btn-primary">Upload Samples</a></li>
            <li><a href="/collection/<?=$this->session->userdata('id')?>" class="btn btn-primary">View Collection</a></li>
             <?php if($this->session->userdata['admin'] == TRUE) echo '<li><a href="/admin" class="btn btn-primary">Return to Admin Dashboard</a></li>'; ?>
          </ul>
        </div>
        <div class="col-sm-7 width-70 height-set text-left well about"> 
              <h1>Hello, <?= $this->session->userdata('first_name') ?> <?= $this->session->userdata('last_name') ?>!</h1>
              <p>Welcome back to Shark Share Global!</p>
            <hr>
            <p>
              Further Notifications will appear here as needed!
            </p>
          </div>
        </div>
          <div class="row col-sm-9 text-left well" id="padbottom">
                  <h2>Request History</h2>
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
      </div>
    </div>