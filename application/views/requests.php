<div class="container-fluid text-center">    
  <div class="row content">
    <div class="neutralwrapper">
      <div class="col-sm-8-2 text-left"> 
      <h1>Choose Samples to Request</h1>
      <p></p>
      <div>
        <div id="toolbar">
          <button id="request" class="btn btn-primary" disabled>
              <i class="glyphicon glyphicon-thumbs-up"></i> Email to Request
          </button>
          <button id="remove" class="btn btn-danger" disabled>
              <i class="glyphicon glyphicon-remove"></i> Remove
          </button>
        </div>
        <table id="request_table"
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
</div>
</div>
<script src="<?= base_url();?>/assets/js/custom/requests.js"></script>
