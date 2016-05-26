<div class="backgroundsetting container-fluid text-center">    
  <div class="row content">
    <div class="neutralwrapper">
      <div class="col-sm-8-2 text-left"> 
            <?php if ($user != NULL) { ?>
              <h1><?php echo $user['first_name'] . " " . $user['last_name']?>'s Collection of Samples</h1>
            <?php } else {echo "<h1>This user does not exist</h1>";} ?>
             <?php if ($user['id'] == $this->session->userdata('id')) { 
               echo '<div id="toolbar">
                <button id="edit" class="btn btn-primary" disabled>
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </button>
                <button id="remove" class="btn btn-danger" disabled>
                    <i class="glyphicon glyphicon-remove"></i> Remove
                </button>
              </div>';
            } ?>
            <hr>
              <div>
                <table id="collection_table"
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
<script src="<?= base_url();?>/assets/js/custom/user_collection.js"></script>
