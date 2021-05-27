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
        <h2 class="pageTitle">Reset School Email Password Request</h2>
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
                <h4 class="card-title table-card-title"> <i class="material-icons">mail_outline</i>Reset Request Report</h4>
              </div>

              <div class="toolbar">
              </div>
              <div class="material-datatables">
                <table id="datatables-resReq" class="table table-striped table-no-bordered table-hover table-device"
                  cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Student ID</th>
                      <th>Request<br /> Status</th>
                      <th>Request<br />Date</th>
                      <th>School Email</th>
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
<script src="js/modalControl.js?ver=0.5" charset="utf-8"></script>

<?php
  include_once('layout/resetEmailPasswordModal.php');
?>

<script type="text/javascript">
  $(document).ready(function () {
    Getstaffall();
    Getstudentall();

    load_data();

    function load_data() {
      var html = '';
      var eData = [];
      var fullName = '';
      var fullNameLink = '';
      var deviceIdLink = '';
      var requestStatus = '';
      $.ajax({
        url: 'ajax_php/a.getResetEmailRequest.php',
        type: 'POST',
        dataType: "json",
        success: function (response) {
          if (response.result == 0) {
            alert("IT")
          } else {
            resetReqArr = response;
            var studentIdData = '';
            for (var i = 0; i < response.length; i++) {
              fullName = '';

              if(response[i].StudentID == 0){
                studentIdData = ''
              } else {
                studentIdData = response[i].StudentID;
              }
              var stuInfLink =
                '<a href="https://admin.bodwell.edu/bhs/updatestudent1.cfm?studentid=' + studentIdData +
                '" class="stuInfLink" target="blank">' +
                studentIdData + '</a>'

              if (response[i].FirstName == null || response[i].LastName == null) {
                fullName = response[i].sFirstName + ' ' + response[i].sLastName;
              }else{
                if (response[i].EnglishName != null && response[i].EnglishName.length > 0) {
                  fullName = response[i].FirstName + ' ' + response[i].LastName + ' (' + response[i].EnglishName + ')'
                } else {
                  fullName = response[i].FirstName + ' ' + response[i].LastName
                }
              }


              fullNameLink = '<a href="" data-target="" data-toggle="modal" data-id="' + response[i].ResetID +
                '" class="resetEmailLink">' +
                fullName + '</a>';



              switch (response[i].Status) {
                case '0':
                  requestStatus = 'Pending'
                  break;
                case '1':
                  requestStatus = 'Done'
                  break;
                case '2':
                  requestStatus = 'Rejected'
                  break;

                default:
                  break;
              }


              eData.push([
                fullNameLink,
                stuInfLink,
                requestStatus,
                response[i].CreateDate.substring(0, 10),
                response[i].SchoolEmail
              ])
            }
            var table = $('#datatables-resReq').DataTable({
              dom: '<"row"<"col-md-8 custom-filter"f><"col-md-4"l>><"row"<"col-sm-12"t>><"row"<"col-sm-5"i><"col-sm-7"p>>',
              data: eData,
              deferRender: true,
              bDestroy: true,
              autoWidth: false,
              ordering: true,
              order: [
                [0, "asc"],
                [2, "asc"]
              ],
              lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
              ],
              columnDefs: [
                {
                  targets: 0,
                  width:"30%"
                },
                {
                  targets: 1,
                  width:"15%",
                  className:"text-center"
                },
                {
                  targets: 2,
                  width:"10%",
                  className:"text-center"
                },
                {
                  targets: 3,
                  width:"15%",
                  className:"text-center"
                },
                {
                  targets: 4,
                  width:"30%"
                }
              ]
            })
            var current = 'Pending';


            $('#datatables-resReq_filter').append(
              '<label class="resReqTable-reqStatus-label">Request Status: <div class="form-group form-group-sm" id="resReqTable-reqStatus"></div></label>'
            );
            table.column(2).every(function () {
              var column = this;
              var select = $(
                  '<select class="select-reqStatus form-control"><option value="">All</option></select>'
                )
                .prependTo($('#resReqTable-reqStatus'))
                .on('change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                  );

                  column
                    .search(val ? '^' + val + '$' : '', true, false)
                    .draw();
                });

              column.data().unique().sort().each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
              });
              var val2 = 'Pending';

              column
                .search(val2 ? '^' + val2 + '$' : '', true, false)
                .draw();
            });

            table.column(2).search(current ? '^' + current + '$' : '', true, false).draw();
            $('option[value="' + current + '"]').prop('selected', 'selected')

          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert("ajax error : " + textStatus + "\n" + errorThrown);
        }
      });
    }
  });
</script>
