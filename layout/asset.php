<div class="main-panel">

  <nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
      <div class="navbar-minimize">
        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
          <i class="material-icons visible-on-sidebar-regular">more_vert</i>
          <i class="material-icons visible-on-sidebar-mini">view_list</i>
        </button>
      </div>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <h2 class="pageTitle">Asset</h2>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="separator hidden-lg hidden-md"></li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <div class="card-content">
              <div>
                <h4 class="card-title table-card-title"> <i class="material-icons">keyboard</i>Asset Master</h4>
              </div>

              <div class="toolbar">
                <div id="database-asset-filter">
                  <label class="assetmaster-devicestatus-label">Device Status:
                     <div class="form-group form-group-sm inline-block" id="assetmaster-devicestatus">
                       <select class="form-control custom-form mg-lr-7" id="assetmaster-devicestatus-select">

                       </select>
                     </div>
                   </label>
                  <label class="assetmaster-stockstatus-label">Stock Status:
                     <div class="form-group form-group-sm inline-block" id="assetmaster-stockstatus">
                       <select class="form-control custom-form mg-lr-7" id="assetmaster-stockstatus-select">

                       </select>

                     </div>
                   </label>
                   <label class="assetmaster-model-label">Model:
                      <div class="form-group form-group-sm inline-block" id="assetmaster-model">
                        <select class="form-control custom-form mg-lr-7" id="assetmaster-model-select">

                        </select>

                      </div>
                    </label>

                    <button type="button" class="btn btn-primary" onclick="exporttoExcel('asset')" name="button">Export</button>
                </div>
              </div>
              <div class="material-datatables">
                <table id="datatables-asset" class="table table-striped table-no-bordered table-hover table-asset"
                  cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr>
                      <th>AssetID</th>
                      <th style="text-align:left">Full Name</th>
                      <th style="text-align:left">UserID</th>
                      <th style="text-align:left">Username</th>
                      <th>BHSDID</th>
                      <th style="text-align:left">Serial #</th>
                      <th style="text-align:left">Stock<br />Status</th>
                      <th style="text-align:left">Device<br /> Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div><!-- end content-->
          </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
      </div> <!-- end row -->
    </div>
  </div>
</div>
<script src="js/modalControl.js?ver=0.5" charset="utf-8"></script>

<?php
  include_once('layout/assetMasterModal.php');
  include_once('layout/search.html');

?>

<script type="text/javascript">
  $(document).ready(function() {
    getAssetMaster();
  });
</script>
