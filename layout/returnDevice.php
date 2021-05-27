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
        <h2 class="pageTitle">Return BHS Device</h2>
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
                <h4 class="card-title table-card-title"> <i class="material-icons">mail_outline</i>Return Device Plan List</h4>
              </div>

              <div class="toolbar">
                <div class="row">
                  <div class="col-md-2 col-md-offset-10">
                    <button class="btn btn-info btn-sm btn-add-return-device" id="returnSchoolDevicesModalBtn" data-target="#returnSchoolDevicesModal" data-toggle="modal">Add</button>

                    <button type="button" class="btn btn-danger btn-sm btn-export-return-device" onclick="exporttoExcel('return')" name="button">Export</button>
                   </div>
                </div>
              </div>
              <div class="material-datatables">
                <table id="datatables-returndevice" class="table table-striped table-no-bordered table-hover table-device"
                  cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Full Name</th>
                      <th>Return<br /> Status</th>
                      <th>Return<br />Date</th>
                      <!-- <th>School Email</th> -->
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
<div class="mask">
    <div class="spinnerContainer">
        <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30">
            </circle>
        </svg>
    </div>
</div>
<script src="js/modalControl.js?ver=0.7" charset="utf-8"></script>

<?php
  include_once('layout/returnDeviceModal.php');
  include_once('layout/returnSchoolDevicesModal.php');

?>

<script type="text/javascript">
  $(document).ready(function () {
    getReturnBHSDevice();
  });
</script>
