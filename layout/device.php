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
        <h2 class="pageTitle">Device</h2>
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
                <h4 class="card-title table-card-title"> <i class="material-icons">devices</i>Student End Device Report</h4>
              </div>

              <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
              </div>
              <div class="material-datatables">
                <table id="datatables-device" class="table table-striped table-no-bordered table-hover table-device"
                  cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Student ID</th>
                      <th>Student<br /> Status</th>
                      <th>Enrollment<br />Date</th>
                      <th>Device ID</th>
                      <th>BHSD No.</th>
                      <th>Category</th>
                      <th>Type</th>
                      <th>Device<br /> Status</th>
                      <th>MAC Address</th>
                      <th>Network<br /> Status</th>
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
<script src="js/modalControl.js?ver=0.4" charset="utf-8"></script>

<?php
  include_once('layout/studentInfModal.php');
  include_once('layout/addNewStudentModal.php');
?>

<script type="text/javascript">
  $(document).ready(function () {


    load_data();

    function load_data() {
      var html = '';
      var eData = [];
      var fullName = '';
      var fullNameLink = '';
      var deviceIdLink = '';
      var studentStatus = '';
      var lowerCase = '';
      $.ajax({
        url: 'ajax_php/a.deviceall.php',
        type: 'POST',
        dataType: "json",
        success: function (response) {
          if (response.result == 0) {
            alert("IT")
          } else {
            for (var i = 0; i < response.length; i++) {
              var stuInfLink =
                '<a href="https://admin.bodwell.edu/bhs/updatestudent1.cfm?studentid=' + response[i].StudentID +
                '" class="stuInfLink" target="blank">' +
                response[i].StudentID + '</a>'
              if (response[i].EnglishName.length > 0) {
                fullName = response[i].FullName + ' (' + response[i].EnglishName + ')'
              } else {
                fullName = response[i].FullName
              }

              fullNameLink = '<a href="" data-target="" data-toggle="modal" data-id="' + response[i].StudentID +
                '" class="stuNameLink">' +
                fullName + '</a>';

              lowerCase = response[i].DeviceCategory.toLowerCase();
              deviceIdLink = '<a href="" data-toggle="modal" data-id="' + response[i].DeviceID +
                '" class="' + lowerCase + 'Link">' + response[i].DeviceID + '</a>';

              switch (response[i].CurrentStudent) {
                case 'Y':
                  studentStatus = 'Current'
                  break;
                case 'A':
                  studentStatus = 'New'
                  break;
                case 'N':
                  studentStatus = 'Not Current'
                  break;
                case 'R':
                  studentStatus = 'Incomplete'
                  break;

                default:
                  break;
              }


              eData.push([
                fullNameLink,
                stuInfLink,
                studentStatus,
                response[i].EnrolmentDate,
                deviceIdLink,
                response[i].BHSDNo,
                response[i].DeviceCategory,
                response[i].DeviceType,
                response[i].DeviceStatus,
                response[i].MACAddress,
                response[i].NetworkRegStatus,
                response[i].DeviceID
              ])
            }
            var table = $('#datatables-device').DataTable({
              dom: '<"row"<"col-sm-10 custom-filter"f><"col-sm-2"l>><"row"<"col-sm-12"t>><"row"<"col-sm-5"i><"col-sm-7"p>>',
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
                  targets: 11,
                  visible: false
                }
              ]
            })
            var current = 'Current';
            var byod = 'BYOD';
            var device = 'device';
            var reset_btn =
              '<button type="button" class="btn btn-danger btn-sm btn-reset" onClick="window.location.reload()">Reset</button>';
            var add_btn =
              '<button type="button" class="btn btn-danger btn-sm btn-add-new-stu" data-toggle="modal">Add New</button>';
            var export_btn =
              '<button type="button" class="btn btn-danger btn-sm btn-export-device" onclick="exporttoExcel(\'' +
              device + '\')" name="button">Export</button>'
            var regFiltered_btn =
              '<button type="button" class="btn btn-warning btn-sm btn-register-all" onclick="updateAllNetStatus()" name="button">Register filterd</button>'
            var notUsed_btn =
              '<button type="button" class="btn btn-warning btn-sm btn-register-all" onclick="updateAllDevStatusToNotUsed()" name="button">Not Used</button>'
            var removed_btn =
              '<button type="button" class="btn btn-warning btn-sm btn-register-all" onclick="updateAllNetStatusToRemoved()" name="button">Removed</button>'

            $('#datatables-device_filter').append(
              '<label class="deviceTable-stuStatus-label">Student Status: <div class="form-group form-group-sm" id="deviceTable-stuStatus"></div></label>'
            );
            $('#datatables-device_filter').append(
              '<label class="deviceTable-category-label">Category: <div class="form-group form-group-sm" id="deviceTable-category"></div></label>'
            );
            $('#datatables-device_filter').append(reset_btn);
            $('#datatables-device_filter').append(add_btn);
            $('#datatables-device_filter').append(export_btn);
            $('#datatables-device_filter').append(regFiltered_btn);
            $('#datatables-device_filter').append(notUsed_btn);
            $('#datatables-device_filter').append(removed_btn);
            table.column(2).every(function () {
              var column = this;
              var select = $(
                  '<select class="select-stuStatus form-control"><option value="">All</option></select>'
                )
                .prependTo($('#deviceTable-stuStatus'))
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
              var val2 = 'Current';

              column
                .search(val2 ? '^' + val2 + '$' : '', true, false)
                .draw();
            });

            table.column(2).search(current ? '^' + current + '$' : '', true, false).draw();
            $('option[value="' + current + '"]').prop('selected', 'selected')

            table.column(6).every(function () {
              var column = this;
              var select = $(
                  '<select class="select-stuStatus form-control"><option value="">All</option></select>'
                )
                .prependTo($('#deviceTable-category'))
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
              // var val3 = 'BYOD';

              // column
              //   .search(val3 ? '^' + val3 + '$' : '', true, false)
              //   .draw();
            });

            // table.column(5).search(byod ? '^' + byod + '$' : '', true, false).draw();
            // $('option[value="' + byod + '"]').prop('selected', 'selected')
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert("ajax error : " + textStatus + "\n" + errorThrown);
        }
      });
    }
  });

  function getFilteredRows(chk) {
    var txt;
    if(chk == 1) {
      txt = 'Registered';
    } else if (chk == 2) {
      txt = 'Removed';
    } else if (chk == 3) {
      txt = 'NotUsed'
    } else {
      txt = 'ERR';
    }
    var table = $('#datatables-device').DataTable();
    var data = table.column(11, {
      filter: 'applied'
    }).data().toArray();
    var data2 = table.column(10, {
      filter: 'applied'
    }).data().toArray();
    var data3 = table.column(8, {
      filter: 'applied'
    }).data().toArray();
    var length = table.rows({
      filter: 'applied'
    }).data().length;
    var arr = [];
    for (let index = 0; index < data2.length; index++) {
      if (chk !== 3) {
        if (data2[index] !== txt) {
          arr.push(data[index]);
        }
      } else {
        if (data3[index] !== txt) {
          arr.push(data[index]);
        }
      }
    }
    return arr;
  }
</script>
