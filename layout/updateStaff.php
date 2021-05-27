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
        <h2 class="pageTitle">Update Staff Info</h2>
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
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header card-header-icon" data-background-color="rose">
                          <i class="material-icons">perm_identity</i>
                      </div>
                      <div class="card-content">
                          <h4 class="card-title">Edit Profile - <small class="category">Complete your profile</small></h4>

                          <form class="" id="updateStfForm">
                              <div class="row">
                                  <div class="col-md-5">
                                      <div class="form-group">
                                          <label class="control-label">StaffID</label>
                                          <input type="text" name="StaffID" class="form-control" readonly>
                                      <span class="material-input"></span></div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" name="FirstName" class="form-control" disabled>
                                      <span class="material-input"></span></div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">Last Name</label>
                                          <input type="text" name="LastName" class="form-control" disabled>
                                      <span class="material-input"></span></div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="control-label">Department</label>
                                          <input type="text" name="Department" class="form-control">
                                      <span class="material-input"></span></div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="control-label">PositionTitle</label>
                                          <input type="text" name="PositionTitle" class="form-control">
                                      <span class="material-input"></span></div>
                                  </div>
                              </div>


                              <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">MealTagID</label>
                                        <input type="text" name="MealTagID" class="form-control">
                                    <span class="material-input"></span></div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">Email</label>
                                          <input type="email" name="Email" class="form-control">
                                      <span class="material-input"></span></div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">RoleBogs</label>
                                          <input type="text" name="RoleBogs" class="form-control" disabled>
                                      <span class="material-input"></span></div>
                                  </div>
                              </div>



                              <button type="button" class="btn btn-rose pull-right btn-staff-update">Update Profile</button>
                              <div class="clearfix"></div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="card card-profile">
                      <div class="card-avatar">
                          <a href="#pablo">
                              <img class="img" src="assets/img/student.png">
                          </a>
                      </div>

                      <div class="card-content">
                          <h4 class="card-title">Search Staff</h4>
                          <p class="description">
                              First Name, Last Name, Staff ID.
                          </p>
                          <input id="stf-search-input" type="text" class="form-control" name="" value="">
                          <a class="btn btn-rose btn-round btn-staff-search">Search</a>
                      </div>
                  </div>
              </div>
      </div>
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
<script src="js/modalControl.js?ver=0.8" charset="utf-8"></script>
<?php   include_once('layout/searchStaffModal.html'); ?>

<script type="text/javascript">
  $(document).ready(function () {
    $('.btn-staff-update').click(function(event) {
      var data = $("#updateStfForm").serializeArray()
      var paramsObject = {};
      $.each(data, function (i, v) {
          paramsObject[v.name] = v.value;
      });

      updateStaffInfo(paramsObject);

    });
  });
</script>
