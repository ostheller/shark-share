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
 <!-- start: Delete Request Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h3 class="modal-title" id="deleteModalLabel">Notice</h3>

              </div>
              <div class="modal-body">
                   <h4> Are you sure you want to remove the selected sample request(s)?</h4>

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
<!-- start: Choose Contributer Modal -->
  <div class="modal fade" id="choose_contributer" tabindex="-1" role="dialog" aria-labelledby="choose_contributerLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h3 class="modal-title" id="choose_contributerLabel">Please Select Contributer</h3>

              </div>
              <div class="modal-body">
                   <h4> Choose Contributer to Email</h4>
                    <form id="contributer_form" action="/request/email">
                      <select name="id" id="contributer">
                        <option value="" selected>Pick a Contributer</option>
                      </select>
                    </form>
              </div>
              <!--/modal-body-collapse -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="btnChooseContributer" href="#">Compose Email</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
              <!--/modal-footer-collapse -->
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- start: Compose Email Modal -->
  <div class="modal fade" id="compose_email" tabindex="-1" role="dialog" aria-labelledby="compose_email_Label" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h3 class="modal-title" id="compose_email_Label">Compose Email</h3>

              </div>
              <div class="modal-body text-left">
                    <form id="compose">

                    </form>
              </div>
              <!--/modal-body-collapse -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="btnComposeEmail" href="#">Send Email</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
</div>
<script src="<?= base_url();?>/assets/js/custom/requests.js"></script>
