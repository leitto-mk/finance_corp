  <!-- BEGIN CONTAINER -->
  <div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <!-- <div class="page-head">
          <div class="page-title">
            <h1>Chart Of Account
              <small>Chart Of Account Function</small>
            </h1>
          </div>
        </div> -->
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
          <div class="col-lg-12">
            <div class="portlet light">
              <div class="portlet-title">
                <div class="caption">
                  <span class="caption-subject bold uppercase">Structure Chart Of Account</span>
                  <span class="caption-helper">List of all Chart of Account</span>
                </div>
                <div class="actions">
                  <a href="#modal-finance" data-toggle="modal" class="btn blue-chambray" id="btn-new-heading" data-url="<?= base_url('C_Finance/get_form') ?>" title="Create Header For Level 1"><i class="fa fa-plus"></i> Heading</a>
                </div>
              </div>
              <div class="portlet-body" style="margin-top: -20px">
                <div class="table-responsive">
                  <table class="table table-bordered" id="table-coa">
                    <?= $table ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
        <div class="modal fade" id="modal-finance" tabindex="-1" role="basic" aria-hidden="true">
          <form id="form-finance">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-blue-chambray bg-font-blue-chambray">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title bold uppercase">Create New Heading</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                  <button type="submit" id="action-submit" data-unique="" data-type="" data-submit="" data-table-url="" class="btn blue-chambray">Save</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </form>
          <!-- /.modal-dialog -->
        </div>
      </div>

      <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
  </div>
  <!-- END CONTAINER -->