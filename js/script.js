function dashBoard_numDevice() {
  $.ajax({
    url: 'ajax_php/a.numOfDevice.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        console.log("IT");
      } else {
        var currentTotal = 0;
        var newTotal = 0;
        var notcurrentTotal = 0;
        var totalObj = response['total'];
        var subObj = response['sub'];
        var loanerObj = response['loaner'];
        for (var i = 0; i < totalObj.length; i++) {
          var totalnos = parseInt(totalObj[i].NOS);
          $('.' + totalObj[i].CurrentStudent + '-student').html(totalnos);
        }

        for (var i = 0; i < subObj.length; i++) {
          var subnos = parseInt(subObj[i].NOS);
          var subnrs = subObj[i].NetworkRegStatus.toLowerCase();
          var subdc = subObj[i].DeviceCategory.toLowerCase();
          var subcs = subObj[i].CurrentStudent.toLowerCase();
          var selector = '.' + subnrs + '-' + subdc + '-' + subcs;
          $(selector).html(subObj[i].NOS);
        }
        calculateSubTotal('.dashboard-bhsd-Table', 'bhsd');
        calculateSubTotal('.dashboard-byod-Table', 'byod');

        for (var i = 0; i < loanerObj.length; i++) {
          var loanernos = parseInt(loanerObj[i].NOS);
          var loanerds = loanerObj[i].DeviceStatus.toLowerCase();
          var loanerdc = loanerObj[i].DeviceCategory.toLowerCase();
          var loanercs = loanerObj[i].CurrentStudent.toLowerCase();
          var selector = '.' + loanerds + '-' + loanerdc + '-' + loanercs;
          $(selector).html(loanernos);
        }
        calculateSubTotal('.dashboard-loaner-Table', 'loaner');
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}

function staffUserCounts() {
  var tr;
  $.ajax({
    url: 'ajax_php/a.staffUserCounts.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      if (response.result == 0) {
        console.log("IT");
      } else {
        for (var i = 0; i < response.length; i++) {
          var Department = response[i].Department2;
          var SchoolID = response[i].SchoolID;
          var totalnos = response[i].TOTALNOS;
          var bhsnos = response[i].BHSNOS;
          var bssnos = response[i].BSSNOS;
          var bclnos = response[i].BCLNOS;
          var bcinos = response[i].BCINOS;

          tr += '<tr><td>' + Department + '</td><td>' + totalnos + '</td><td>' + bhsnos + '</td><td>' + bssnos + '</td><td>' + bclnos + '</td><td>' + bcinos + '</td></tr>';
        }
        tr += '<tr class="total-staff-userCounts-tr font-weight-bold"><td>Total</td><td></td><td></td><td></td><td></td><td></td></tr>';
        $('.dashboard-staffcounts-table tbody').html(tr);
        calculateSubTotalStaff('.dashboard-staffcounts-table', '.total-staff-userCounts-tr');
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}

function showCurrentStat() {
  var tr;
  var personType;
  var icon;
  $.ajax({
    url: 'ajax_php/a.currentPerson.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        console.log("IT");
      } else {
        for (var i = 0; i < response.length; i++) {
          if (i == 1) {
            personType = 'Student';
            icon = 'school'
          } else {
            personType = 'Staff';
            icon = 'person'
          }
          tr += '<tr> <td><i class="material-icons">' + icon + '</i></td><td>' + personType + '</td><td>' + response[i].numOfPeople + '</td></tr>';
        }
        $('#dashboard-person-table tbody').html(tr);

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}

function showCurrentTerm() {
  var tr;
  $.ajax({
    url: 'ajax_php/a.currentterm.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      if (response.result == 0) {
        console.log("IT");
      } else {
        $('.dashboard-semesterName').html('<i class="material-icons">calendar_today</i>' + response[0].SemesterName);
        var EndDate = new Date(response[0].EndDate).getTime()
        var StartDate = new Date(response[0].StartDate).getTime()
        var Today = new Date().getTime();
        var Total = EndDate - StartDate;
        var per = EndDate - Today;
        var param = per / Total * 100;
        console.log(EndDate);
        console.log(StartDate);
        makeProgress(param.toFixed(2));
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}


function Getstaffall() {
  var html = '';
  $.ajax({
    url: 'ajax_php/a.staffall.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        allStaffArr = response;
        for (var i = 0; i < response.length; i++) {
          html += "<tr>" +
            "<td>" + response[i].FirstName + "</td>" +
            "<td>" + response[i].LastName + "</td>" +
            "<td>" + response[i].ExtNo + "</td>" +
            "<td>" + response[i].Phone1 + "</td>" +
            "<td>" + response[i].PositionTitle + "</td>" +
            "<td>" + response[i].Department + "</td>" +
            "<td>" + response[i].FullPart + "</td>" +
            "<td>" + response[i].StaffID + "</td>" +
            "<td>" + response[i].JoinDate + "</td>" +
            "<td>" + response[i].Email3 + "</td>" +
            "</tr>";
        }
        $('.table-staff tbody').html(html);

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}


function Getstudentall() {
  $.ajax({
    url: 'ajax_php/a.studentall.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        allStudentArr = response;
        $('.term-startdate').html(response[0].StartDate);
        $('.term-midcutoffdate').html(response[0].MidCutOffDate);
        $('.term-enddate').html(response[0].EndDate);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}

function getStudentInfo(studentId) {
  var fullName = '';
  var boarding = '';
  $.ajax({
    url: 'ajax_php/a.studentInfoVer2.php',
    type: 'POST',
    dataType: "json",
    data: {
      "studentId": studentId
    },
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        var imgsrc = "https://asset.bodwell.edu/OB4mpVpg/student/bhs" + response[0].StudentID + ".jpg";
        $('.stuInfModal-stu-img').attr('src', imgsrc);
        $('.stuInfTable-stuId').html(response[0].StudentID);
        if (response[0].EnglishName.length > 0) {
          fullName = response[0].FirstName + ' ' + response[0].LastName + ' (' + response[0].EnglishName + ')'
        } else {
          fullName = response[0].FirstName + ' ' + response[0].LastName
        }
        $('.stuInfTable-fullName').html(fullName);
        var enrolDate = response[0].EnrolmentDate.toString().substring(0, 10);
        $('.stuInfTable-enrolDate').html(enrolDate);
        var stuStatus = '';
        switch (response[0].CurrentStudent) {
          case 'Y':
            stuStatus = 'Current'
            break;
          case 'N':
            stuStatus = 'Not Current'
            break;
          case 'A':
            stuStatus = 'New'
            break;
          default:
            break;
        }
        $('.stuInfTable-stuStatus').html(stuStatus);
        $('.stuInfTable-origin').html(response[0].CName);
        $('.stuInfTable-counsellor').html(response[0].Counselor);
        boarding = getBoardingText(response[0].Homestay, response[0].Residence)
        $('.stuInfTable-residence').html(boarding);
        var halls;
        if (response[0].Halls == '') {
          halls = response[0].Houses;
        } else {
          halls = response[0].Halls;
        }
        $('.stuInfTable-hall').html(halls);
        $('.stuInfTable-advisor').html(response[0].Hadvisor);
        $('.stuInfTable-room').html(response[0].RoomNo);
      }

    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }

  })
}


function getDeviceInfo(studentId) {
  var modifyDate = '';
  var html = '';
  var noData = '<tr class="no-reg-device"><td colspan="9" class="text-center">There is no Registered Device</td></tr>';
  var html_flg = {
    BHSD: false,
    BYOD: false,
    LOANER: false
  };
  var lowerCase = '';

  $.ajax({
    url: 'ajax_php/a.deviceInfo.php',
    type: 'POST',
    dataType: "json",
    data: {
      "studentId": studentId
    },
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        if (response[0].CurrentStudent === 'Y' || response[0].CurrentStudent === 'A') {
          var reg_bhsd_button = '<button type="button" class="btn btn-info reg-bhsd-btn" data-toggle="modal" data-id="' + studentId + '" >BHSD [+]</button>'
          var reg_byod_button = '<button type="button" class="btn btn-success reg-byod-btn" data-toggle="modal" data-id="' + studentId + '">BYOD [+]</button>'
          var reg_loaner_button = '<button type="button" class="btn btn-warning reg-loaner-btn" data-toggle="modal" data-id="' + studentId + '">LOANER [+]</button>'
          $('.reg-bhsd').html(reg_bhsd_button);
          $('.reg-byod').html(reg_byod_button);
          $('.reg-loaner').html(reg_loaner_button);
        }

        $('#stuInfModal-devInfTable-BHSD tbody').html('');
        $('#stuInfModal-devInfTable-BYOD tbody').html('');
        $('#stuInfModal-devInfTable-LOANER tbody').html('');

        for (let i = 0; i < response.length; i++) {
          modifyDate = response[i].ModifyDate.toString().substring(0, 10);
          lowerCase = response[i].DeviceCategory.toLowerCase()
          html = '<tr><td><a href="" data-toggle="modal" data-id="' + response[i].DeviceID + '" class="' + lowerCase + 'Link">' + response[i].DeviceID + '</a></td>' +
            '<td>' + response[i].DeviceCategory + '</td>' +
            '<td>' + response[i].BHSDNo + '</td>' +
            '<td>' + response[i].DeviceType + '</td>' +
            '<td>' + response[i].MACAddress + '</td>' +
            '<td>' + response[i].DeviceStatus + '</td>' +
            '<td>' + response[i].NetworkRegStatus + '</td></tr>'
          if (response[i].DeviceCategory === 'BHSD') {
            $('#stuInfModal-devInfTable-BHSD tbody').append(html);
            html_flg.BHSD = true;
          } else if (response[i].DeviceCategory === 'BYOD') {
            $('#stuInfModal-devInfTable-BYOD tbody').append(html);
            html_flg.BYOD = true;
          } else if (response[i].DeviceCategory === 'LOANER') {
            $('#stuInfModal-devInfTable-LOANER tbody').append(html);
            html_flg.LOANER = true;
          }
        }

        if (html_flg.BHSD === false) {
          $('#stuInfModal-devInfTable-BHSD tbody').append(noData);
        } else if (html_flg.BYOD === false) {
          $('#stuInfModal-devInfTable-BYOD tbody').append(noData);
        } else if (html_flg.LOANER === false) {
          $('#stuInfModal-devInfTable-LOANER tbody').append(noData);
        }
      }

    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }

  })
}

function getOneDevice(target) {
  var deviceId = target.attr('data-id');
  $('.regDevice-deviceId').val(deviceId);

  var modifyDate = '';
  $.ajax({
    url: 'ajax_php/a.getOneDevice.php',
    type: 'POST',
    dataType: "json",
    data: {
      "deviceId": deviceId
    },
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {

        switch (response[0].DeviceCategory) {
          case 'BHSD':
            displayLoanerElement('');
            generateSelector('.table-category', deviceCategory, 'BHSD', true);
            $('.name-bhsdNum').html('BHSD Number *');
            $('.tr-bhsdNum').css('display', '');
            $('.table-bhsdNum').val(response[0].BHSDNo);
            generateSelector('.table-type', bhsdType, 'Computer-PC', true);
            $('.manufact-form').html(manuInput);
            $('.model-form').html(modelInput);
            $('.table-manufacturer').val(response[0].Make);
            $('.table-model').val(response[0].Model);
            $('.tr-macAddress').css('display', '');
            $('.table-macAddress').val(response[0].MACAddress);
            generateSelector('.table-registerTo', registerTo, 'BHSD-STUDENT', true);
            generateSelector('.table-network', netRegist, response[0].NetworkRegStatus, false);
            generateSelector('.table-usage', bhsdUsage, response[0].DeviceStatus, false);
            $('.table-remark').val(response[0].Remarks);
            break;
          case 'BYOD':
            displayLoanerElement('');
            generateSelector('.table-category', deviceCategory, "BYOD", true);
            $('.tr-bhsdNum').css('display', 'none');
            generateSelector('.table-type', byodType, response[0].DeviceType, false);
            $('.manufact-form').html(manuInput);
            $('.model-form').html(modelInput);
            $('.table-manufacturer').val(response[0].Make);
            $('.table-model').val(response[0].Model);
            $('.tr-macAddress').css('display', '');
            $('.table-macAddress').val(response[0].MACAddress);
            generateSelector('.table-registerTo', registerTo, 'BYOD-STUDENT', true);
            generateSelector('.table-network', netRegist, response[0].NetworkRegStatus, false);
            generateSelector('.table-usage', bhsdUsage, response[0].DeviceStatus, false);
            $('.table-remark').val(response[0].Remarks);
            break;
          case 'LOANER':
            var make = response[0].Make
            var model = response[0].Model
            if (make === '') {
              make = 'none';
            }
            if (model === '') {
              model = 'none';
            }

            if (response[0].DeviceType === 'Loaner-Charger' || response[0].DeviceType === 'Loaner-Other') {
              displayLoanerElement('none');
            } else {
              displayLoanerElement('');
            }
            generateSelector('.table-category', deviceCategory, "LOANER", true);
            $('.name-bhsdNum').html('LOANER BHSD Number *');
            $('.tr-bhsdNum').css('display', '');
            $('.table-bhsdNum').val(response[0].BHSDNo);
            generateSelector('.table-type', loanerType, response[0].DeviceType, false);
            $('.manufact-form').html(manuSelect);
            $('.model-form').html(modelSelect);
            generateSelector('.table-manufacturer', loanerManufacturer, make, false);
            generateSelector('.table-model', loanerModel, model, false);
            $('.tr-macAddress').css('display', 'none');
            generateSelector('.table-registerTo', registerTo, 'BHSD-STUDENT', true);
            generateSelector('.table-network', netRegist, 'Registered', true);
            generateSelector('.table-usage', loanerUsage, response[0].DeviceStatus, false);
            $('.table-remark').val(response[0].Remarks);
            $('.table-type').change(function (params) {
              if ($('.table-type').val() === 'Loaner-Charger' || $('.table-type').val() === 'Loaner-Other') {
                displayLoanerElement('none');
              } else {
                displayLoanerElement('');
                generateSelector('.table-manufacturer', loanerManufacturer, 'none', false);
                generateSelector('.table-model', loanerModel, 'none', false);
              }

            });
            break;
          default:
            break;
        }

        modifyDate = response[0].ModifyDate.toString().substring(0, 10);
        $('.last-modify').html('Last Modified On: ' + modifyDate + ' by ' + response[0].ModifyStaff)
      }

    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }

  })

}

function updateDeviceInfo(formArr) {
  if (formArr.category === 'LOANER') {
    if (formArr.type != 'Loaner-PC') {
      formArr.manufacturer = '';
      formArr.model = '';
      formArr.registerTo = '';
      formArr.network = '';
    }
  }

  $.ajax({
    url: 'ajax_php/a.updateDeviceInfo.php',
    type: 'POST',
    dataType: "json",
    data: formArr,
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        showNotification("success", "UPDATED");

        var d = new Date();
        var strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();

        var tableRow = $("#stuInfModal-devInfTable-" + formArr.category + " td:first-child");
        var tableColumn = '';
        for (let i = 0; i < tableRow.length; i++) {
          if (tableRow[i].innerText == formArr.deviceId) {
            tableColumn = tableRow[i].closest('tr');
            $(tableColumn).children('td:nth-child(3)').text(formArr.bhsdNum);
            $(tableColumn).children('td:nth-child(4)').text(formArr.type);
            $(tableColumn).children('td:nth-child(5)').text(formArr.macAddress);
            $(tableColumn).children('td:nth-child(6)').text(formArr.usage);
            $(tableColumn).children('td:nth-child(7)').text(formArr.network);
            break;
          }
        }

        var tableRow2 = $('#datatables-device td:nth-child(4)');
        var tableColumn2 = '';
        for (let i = 0; i < tableRow2.length; i++) {
          if (tableRow2[i].innerText == formArr.deviceId) {
            tableColumn2 = tableRow2[i].closest('tr');
            $(tableColumn2).children('td:nth-child(6)').text(formArr.type);
            $(tableColumn2).children('td:nth-child(7)').text(formArr.usage);
            $(tableColumn2).children('td:nth-child(8)').text(formArr.macAddress);
            $(tableColumn2).children('td:nth-child(9)').text(formArr.network);
            break;
          }
        }

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}

function addDeviceInfo(formArr) {
  if (formArr.category === 'BYOD') {
    formArr.bhsdNum = 'N/A';
  } else if (formArr.category === 'LOANER') {
    if (formArr.type != 'Loaner-PC') {
      formArr.manufacturer = '';
      formArr.model = '';
      formArr.registerTo = '';
      formArr.network = '';
    }
  }
  $.ajax({
    url: 'ajax_php/a.addDeviceInfo.php',
    type: 'POST',
    dataType: "json",
    data: formArr,
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        showNotification("success", "INSERTED");
        var tableId;
        var link;
        tableId = '#stuInfModal-devInfTable-' + formArr.category + ' tbody';
        link = formArr.category.toLowerCase() + 'Link';
        $(tableId + ' .no-reg-device').hide();

        var atag = '<a href="" data-toggle="" data-id="" class="' + link + '">In Progress</a>'
        var tableHtml = '<tr><td>In Progress</td><td>' + formArr.category + '</td><td>' + formArr.bhsdNum + '</td><td>' + formArr.type + '</td>';
        tableHtml += '<td>' + formArr.macAddress + '</td><td>' + formArr.usage + '</td><td>' + formArr.network + '</td></tr>';
        $(tableId).append(tableHtml);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}


function searchStudentByName(id) {
  var input = $(id).val();
  $('#searchStuMdl-table tbody').html('');
  if (input == '') {
    showNotification("warning", "You need to type something");
    return;
  }
  $.ajax({
    url: 'ajax_php/a.getStudentListFromSearch.php',
    type: 'POST',
    dataType: "json",
    data: {
      'param': input
    },
    success: function (response) {
      if (response.result == 0) {
        showNotification("warning", "No data");
      } else {
        console.log(response);
        var tr;
       for (let i = 0; i < response.length; i++) {
         var name = "";
         if (response[i].EnglishName) {
           name =
             response[i].FirstName +
             " (" +
             response[i].EnglishName +
             ") " +
             response[i].LastName;
         } else {
           name = response[i].FirstName + " " + response[i].LastName;
         }
         tr +=
           '<tr data-id="' +
           response[i].StudentID +
           '" data-full-name="' +
           name +
           '" data-status="' +
           response[i].CurrentStatus +
           '"><td class="text-center">' +
           response[i].StudentID +
           "</td><td>" +
           name +
           "</td><td class='text-center'>" +
           response[i].CurrentStatus +
           "</td></tr>";
       }
        $('#searchStuMdl-table tbody').html(tr);
        $('#searchStudentModal').modal();

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }

  });
}

function searchStudentByNameVR(id) {
  var input = $(id).val();
  $("#searchStuMdl-tableVR tbody").html("");
  if (input == "") {
    showSwal("error", "Please enter search keyword(s)");
    return;
  }
  $.ajax({
    url: "ajax_php/a.getStudentListFromSearch.php",
    type: "POST",
    dataType: "json",
    data: {
      param: input,
    },
    success: function (response) {
      if (response.result == 0) {
        alert("No data");
      } else {
        var tr;
        for (let i = 0; i < response.length; i++) {
          var name = "";
          if (response[i].EnglishName) {
            name =
              response[i].FirstName +
              " (" +
              response[i].EnglishName +
              ") " +
              response[i].LastName;
          } else {
            name = response[i].FirstName + " " + response[i].LastName;
          }
          tr +=
            '<tr data-id="' +
            response[i].StudentID +
            '" data-full-name="' +
            name +
            '" data-status="' +
            response[i].CurrentStatus +
            '"><td class="text-center">' +
            response[i].StudentID +
            "</td><td>" +
            name + "</tr>";
        }
        $("#searchStuMdl-tableVR tbody").html(tr);
        $('#searchStudentModalVR').modal('toggle');
        $("#pageId-comeFrom").val(id);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    },
  });
}

function searchStaff(id) {
  var input = $(id).val();
  $('#searchStaffMdl-table tbody').html('');
  if (input == '') {
    showNotification("warning", "You need to type something");
    return;
  }
  $('#updateStfForm input').val('');

  $.ajax({
    url: 'ajax_php/a.getStaffListFromSearch.php',
    type: 'POST',
    dataType: "json",
    data: {
      'param': input
    },
    success: function (response) {
      if (response.result == 0) {
        showNotification("warning", "No data");
      } else {
        console.log(response);
        var tr;
       for (let i = 0; i < response.length; i++) {
          var name = response[i].FirstName + " " + response[i].LastName;

         tr +=
           '<tr data-id="' +
           response[i].StaffID +
           '" data-status="' +
           response[i].CurrentStaff +
           '" data-firstname="' +
           response[i].FirstName +
           '" data-lastname="' +
           response[i].LastName +
           '" data-positiontitle2="' +
           response[i].PositionTitle2 +
           '" data-department2="' +
           response[i].Department2 +
           '" data-email="' +
           response[i].Email3 +
           '" data-mealtagid="' +
           response[i].MealTagID +
           '" data-rolebogs="' +
           response[i].RoleBOGS +
           '"><td class="text-center">' +
           response[i].StaffID +
           "</td><td>" +
           name +
           "</td><td class='text-center'>" +
           response[i].CurrentStaff +
           "</td></tr>";
       }
        $('#searchStaffMdl-table tbody').html(tr);
        $('#searchStaffModal').modal();

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }

  });
}

function counrOfDevice(studentId, fullName) {
  $.ajax({
    url: 'ajax_php/a.countOfDevice.php',
    type: 'POST',
    dataType: "json",
    data: {
      'studentId': studentId
    },
    success: function (response) {
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        if (response[0].num > 0) {
          $('#stuInfModal').modal('toggle');
          $('#addNewStuModal').modal('toggle');
          $('#searchStudentModal').modal('toggle');
          getStudentInfo(studentId);
          getDeviceInfo(studentId);
        } else {
          if ($('#addNewStuModal').is(':visible')) {
            $('#addNewStu-studentId').val(studentId);
            $('#addNewStu-student').val(fullName);
          }
          $('#searchStudentModal').modal('toggle');
        }
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }

  });
}

function exporttoExcel(category) {
  if (category == 'student') {
    window.location.href = 'excel/studentExcel.php';
  } else if (category == 'device') {
    window.location.href = 'excel/deviceExcel.php';
  } else if (category == 'return') {
    window.location.href = 'excel/returndeviceExcel.php';
  } else if (category == 'asset') {
    window.location.href = 'excel/assetExcel.php';
  } else {
    window.location.href = 'excel/staffExcel.php';
  }

}

function getBoardingText(homestay, residence) {

  if (homestay == 'Y' && residence == 'Y') {
    subCategoryTxt = 'Boarding';
  } else if (homestay == 'N' && residence == 'N') {
    subCategoryTxt = 'Day Program';
  } else if (homestay == 'Y' && residence == 'N') {
    subCategoryTxt = 'Homestay';
  } else if (homestay == 'N' && residence == 'Y') {
    subCategoryTxt = 'Boarding';
  } else {
    subCategoryTxt = 'Error';
  }

  return subCategoryTxt;
}

function updateAllNetStatus() {
  var filteredData = getFilteredRows(1);
  var confirm = false;
  if (filteredData.length == 0) {
    showNotification("warning", "There is no data for registration.");
  } else if (filteredData.length > 500) {
    showNotification("warning", "You cannot register more than 500 data.");
  } else {
    swal({
      title: 'Are you sure?',
      text: "This will register " + filteredData.length + " pending devices!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      confirmButtonText: 'Yes, register!',
      buttonsStyling: false
    }).then(function (confirm) {
      if (confirm) {
        $.ajax({
          url: "ajax_php/a.registerFilteredData.php",
          type: "POST",
          datatype: "json",
          data: {
            "filteredData": filteredData,
            "status" : "Registered"
          },
          success: function (response) {
            console.log(response);
            if (response.result == 0) {
              showNotification("danger", "Contact IT");
            } else {
              showNotification("success", "UPDATED");
              location.reload();
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log("ajax error : " + textStatus + "\n" + errorThrown);
          }
        })
      }
    }).catch(swal.noop)
  }
}

function updateAllNetStatusToRemoved() {
  var filteredData = getFilteredRows(2);
  var confirm = false;
  if (filteredData.length == 0) {
    showNotification("warning", "There is no data.");
  } else if (filteredData.length > 500) {
    showNotification("warning", "You cannot update more than 500 data.");
  } else {
    swal({
      title: 'Are you sure?',
      text: "This will update  " + filteredData.length + " devices to Removed",
      type: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      confirmButtonText: 'Yes, Update!',
      buttonsStyling: false
    }).then(function (confirm) {
      if (confirm) {
        $.ajax({
          url: "ajax_php/a.registerFilteredData.php",
          type: "POST",
          datatype: "json",
          data: {
            "filteredData": filteredData,
            "status" : "Removed"
          },
          success: function (response) {
            console.log(response);
            if (response.result == 0) {
              showNotification("danger", "Contact IT");
            } else {
              showNotification("success", "UPDATED");
              location.reload();
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log("ajax error : " + textStatus + "\n" + errorThrown);
          }
        })
      }
    }).catch(swal.noop)
  }
}

function updateAllDevStatusToNotUsed() {
  var filteredData = getFilteredRows(3);
  var confirm = false;
  if (filteredData.length == 0) {
    showNotification("warning", "There is no data.");
  } else if (filteredData.length > 500) {
    showNotification("warning", "You cannot update more than 500 data.");
  } else {
    swal({
      title: 'Are you sure?',
      text: "This will update " + filteredData.length + " devices to Not Used",
      type: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      confirmButtonText: 'Yes!',
      buttonsStyling: false
    }).then(function (confirm) {
      if (confirm) {
        $.ajax({
          url: "ajax_php/a.updateFilteredDeviceStatusData.php",
          type: "POST",
          datatype: "json",
          data: {
            "filteredData": filteredData,
            "status":"NotUsed"
          },
          success: function (response) {
            console.log(response);
            if (response.result == 0) {
              showNotification("danger", "Contact IT");
            } else {
              showNotification("success", "UPDATED");
              location.reload();
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log("ajax error : " + textStatus + "\n" + errorThrown);
          }
        })
      }
    }).catch(swal.noop)
  }
}

function getResetRequestedStuInf(reqId){
  console.log(resetReqArr);
  var fullname = '';
  var stdId = '';
  var modifiedUser = '';
  resetReqArr.forEach(element => {
    if(element.ResetID == reqId){
      if (element.StudentID == '0') {
        $('.reqStuInfTable-stuId').prop('readonly', false);
        stdId = '';
      } else {
        stdId = element.StudentID;
        var imgsrc = "https://asset.bodwell.edu/OB4mpVpg/student/bhs" + element.StudentID + ".jpg";
      $('.resPwdModal-stu-img').attr('src', imgsrc);
      }

      if (element.FirstName == null || element.LastName == null) {
        fullname = element.sFirstName + ' ' + element.sLastName;
      }else{
        fullname = element.FirstName + ' ' + element.LastName + ' (' + element.EnglishName + ')';
      }

      $('.resPwdModal-resetId').val(element.ResetID);
      $('.resPwdModal-hiddenStatus').val(element.Status);
      $('.reqStuInfTable-stuId').val(stdId);
      $('.resPwdModal-hiddenStuId').val(element.StudentID);
      $('.reqStuInfTable-fullName').val(fullname);
      $('.reqStuInfTable-dob').val(moment(element.sDOB).format('LL'));
      $('.reqStuInfTable-sEmail').val(element.SchoolEmail);
      $('.reqStuInfTable-pEmail').val(element.PersonalEmail);
      $('.reqStuInfTable-counsellor').val(element.Counsellor);
      $('.reqStatus-select').val(element.Status).change();
      $('.reqStuInfTable-date').val(moment(element.CreateDate).format('LL'));
      $('.reqStuInfTable-country').val(element.sCountry);
      $('.reqStuInfTable-city').val(element.sCity);
      $('.reqStuInfTable-dat').val(moment(element.sDateTime).format('LLL'));
      $('.reqStuInfTable-phone').val(element.sPhoneNumber);
      $('.reqStuInfTable-translation[value=' + element.translation + ']').prop('checked', true);
      $('.reqStuInfTable-comment').val(element.Comment);
      $('.resPwdModal-hiddenComment').val(element.Comment);
      $('#resetMdl-modifiedAt').html(moment(element.ModifyDate).format('LLL'))
      if (element.ModifyUserID.trim() != "") {
        if (element.ModifyUserID.charAt(0) == "2") {
          allStudentArr.forEach(item => {
            if (item.StudentID == element.ModifyUserID.trim()) {
              if (item.EnglishName == '') {
                modifiedUser = item.FirstName + ' ' + item.LAStName
              }else{
                modifiedUser = item.FirstName + ' ' + item.LAStName + ' (' + item.English + ')'
              }

            }
          });
        }else{
          allStaffArr.forEach(item => {
            if (item.StaffID == element.ModifyUserID.trim()) {
              modifiedUser = item.FirstName + ' ' + item.LastName
            }
          });
        }
      }
      $('#resetMdl-modifiedBy').html(modifiedUser)
    }
  });
}

function updateResetRequestStatus(params){
  $('.reqPwd-save-btn').prop('disabled', true)
  toggleSpinner();
  console.log(params);
  $.ajax({
    url: "ajax_php/a.updateRequestStatus.php",
    type: "POST",
    datatype: "json",
    data:params,
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        showNotification("success", "UPDATED");
        $('.reqPwd-save-btn').prop('disabled', false)
        toggleSpinner();
        location.reload();
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  })
}

function getReturnBHSDevice() {
  var html = '';
  var eData = [];
  var fullName = '';
  var fullNameLink = '';
  var returnStatus = '';
  $.ajax({
    url: 'ajax_php/a.getReturnBHSDevice.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        alert("IT")
      } else {
        returnDevArr = response;

        for (var i = 0; i < response.length; i++) {
          fullName = getFullName(response[i].EnglishName, response[i].FirstName, response[i].LastName);
          var studentId = response[i].StudentID;
          var stuInfLink =
            '<a href="https://admin.bodwell.edu/bhs/updatestudent1.cfm?studentid=' + studentId +
            '" class="stuInfLink" target="blank">' +
            studentId + '</a>'




          fullNameLink = '<a href="" data-target="" data-toggle="modal" data-id="' + response[i].returnId +
            '" class="returnDeviceLink">' +
            fullName + '</a>';



          switch (response[i].ReturnStatus) {
            case '0':
              returnStatus = 'Pending'
              break;
            case '1':
              returnStatus = 'Not Returned'
              break;
            case '2':
              returnStatus = 'Returned'
              break;

            default:
              break;
          }


          eData.push([
            stuInfLink,
            fullNameLink,
            returnStatus,
            response[i].CreateDate.substring(0, 10),
          ])
        }
        var table = $('#datatables-returndevice').DataTable({
          data: eData,
          deferRender: true,
          bDestroy: true,
          autoWidth: false,
          ordering: true,
          order: [
            [0, "asc"],
          ],
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          columnDefs: [
            {
              targets: 0,
              width:"10%"
            },
            {
              targets: 1,
              width:"60%",
            },
            {
              targets: 2,
              width:"10%",
            },
            {
              targets: 3,
              width:"20%",
            },
          ]
        })


        $('#datatables-returndevice_filter').append(
          '<label class="returnStatus-label">Return Status: <div class="form-group form-group-sm" id="returndevice-returnStatus"></div></label>'
        );
        table.column(2).every(function () {
          var column = this;
          var select = $(
              '<select class="select-return form-control"><option value="">All</option><option value="Pending">Pending</option><option value="Not Returned">Not Returned</option><option value="Returned">Returned</option></select>'
            )
            .prependTo($('#returndevice-returnStatus'))
            .on('change', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );

              column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
            });
        });



      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}


function getReturnBHSDeviceStuInf(retId){
  console.log(returnDevArr);
  var fullName = '';
  var stdId = '';
  var modifiedUser = '';
  returnDevArr.forEach(element => {
    if(element.returnId == retId){
      stdId = element.StudentID;
      var imgsrc = "https://asset.bodwell.edu/OB4mpVpg/student/bhs" + element.StudentID + ".jpg";
      $('.retStuInfTable-stu-img').attr('src', imgsrc);

      fullName = getFullName(element.EnglishName, element.FirstName, element.LastName);
      $('.ret-hiddenReturnId').val(element.returnId);
      $('.retStuInfTable-stuId').val(stdId);
      $('.retStuInfTable-fullName').val(fullName);
      $('.retStuInfTable-sEmail').val(element.SchoolEmail);
      $('.retStuInfTable-counsellor').val(element.Counselor);
      $('.returnDeviceModal-returnDeviceStudent').val(element.ReturnDevices);
      $('.retStatus-select').val(element.ReturnStatus).change();

      $('.returnDeviceModal-AssetLabels-select').val(element.rAssetLabels).change();
      $('.returnDeviceModal-Tablet-select').val(element.rTablet).change();
      $('.returnDeviceModal-Keyboard-select').val(element.rKeyboard).change();
      $('.returnDeviceModal-Pen-select').val(element.rPen).change();
      $('.returnDeviceModal-Power-select').val(element.rPower).change();
      $('.returnDeviceModal-deduct-select').val(element.DeductCheck).change();

      $('.returnDeviceModal-BHSDID').val(element.BHSDID);
      $('.returnDeviceModal-ServiceTag').val(element.ServiceTag);
      $('.returnDeviceModal-DeductAmount').val(element.DeductionAmount);
      $('.returnDeviceModal-InspectionDate').val(element.InspectionDate);

      $('.returnDeviceModal-InspectionResult').val(element.InspectionResult);

      $('.OrgReturnStatus').val(element.ReturnStatus);


      // if (element.ModifyUserID.trim() != "") {
      //   if (element.ModifyUserID.charAt(0) == "2") {
      //     allStudentArr.forEach(item => {
      //       if (item.StudentID == element.ModifyUserID.trim()) {
      //         if (item.EnglishName == '') {
      //           modifiedUser = item.FirstName + ' ' + item.LAStName
      //         }else{
      //           modifiedUser = item.FirstName + ' ' + item.LAStName + ' (' + item.English + ')'
      //         }
      //
      //       }
      //     });
      //   }else{
      //     allStaffArr.forEach(item => {
      //       if (item.StaffID == element.ModifyUserID.trim()) {
      //         modifiedUser = item.FirstName + ' ' + item.LastName
      //       }
      //     });
      //   }
      // }
    }
  });
}

function updateReturnDevice(params){
  $('.returnDeviceModal-save-btn').prop('disabled', true)
  toggleSpinner();
  console.log(params);
  $.ajax({
    url: "ajax_php/a.updateReturnDevice.php",
    type: "POST",
    datatype: "json",
    data:params,
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
      } else {
        showNotification("success", "UPDATED");
        toggleSpinner();
        location.reload();
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  })
}


function updateStaffInfo(params){
  toggleSpinner();
  console.log(params);
  $.ajax({
    url: "ajax_php/a.updateStaffInfo.php",
    type: "POST",
    datatype: "json",
    data:params,
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
        $('#updateStfForm input').val('');
      } else {
        showNotification("success", "UPDATED");
        toggleSpinner();
        $('#updateStfForm input').val('');
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  })
}

function insertBHSLaptopReturnPlan(updateForm) {
  console.log(updateForm);
  $.ajax({
    url: 'ajax_php/a.insertBHSLaptopReturnPlan.php',
    type: 'POST',
    data: updateForm,
    dataType: 'json',
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        alert("Something Went wrong. Contact IT");
      } else {
        if(response == 'duplicate') {
          alert('You have already submitted return plan');
        } else {
          alert('Success');
          location.reload();
        }
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}

function getAssetMaster() {
  var html = '';
  var eData = [];
  var fullName = '';
  var assetIDLink = '';
  $.ajax({
    url: 'ajax_php/a.getAssetMaster.php',
    type: 'POST',
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        alert("IT")
      } else {
        assetmasterArr = response;

      for (var i = 0; i < response.length; i++) {
          fullName = response[i].FullName;



          assetIDLink = '<a href="" data-target="" data-toggle="modal" data-id="' + response[i].AssetID +
            '" class="assetMasterLink">' +
            response[i].AssetID + '</a>';


          eData.push([
            assetIDLink,
            fullName,
            response[i].UserID,
            response[i].Username,
            response[i].BHSDID,
            response[i].SerialNo,
            response[i].StockStatus,
            response[i].DeviceStatus,
            response[i].Model,
          ])
        }
        var table = $('#datatables-asset').DataTable({
          data: eData,
          deferRender: true,
          bDestroy: true,
          autoWidth: false,
          ordering: true,
          order: [
            [0, "asc"],
          ],
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          columnDefs: [
            {
              targets: 0,
              width:"10%",
              className: "text-center",
            },
            {
              targets: 4,
              className: "text-center",
            },
            {
              targets: 8,
              visible: false,
            },
            // {
            //   targets: 2,
            //   width:"10%",
            // },
            // {
            //   targets: 3,
            //   width:"20%",
            // },
          ]
        })


        table.column(6).every(function () {
          var that = this;

          // Create the select list and search operation
          var select = $('#assetmaster-stockstatus-select')
            .on("change", function () {
              that.search($(this).val()).draw();
            });

          // Get the search data for the first column and add to the select list
          select.append($('<option value="">All</option>'));

          this.cache("search")
            .sort()
            .unique()
            .each(function (d) {
              select.append($('<option value="' + d + '">' + d + "</option>"));
            });
        });

        table.column(7).every(function () {
          var that = this;

          // Create the select list and search operation
          var select = $('#assetmaster-devicestatus-select')
            .on("change", function () {
              that.search($(this).val()).draw();
            });

          // Get the search data for the first column and add to the select list
          select.append($('<option value="">All</option>'));

          this.cache("search")
            .sort()
            .unique()
            .each(function (d) {
              select.append($('<option value="' + d + '">' + d + "</option>"));
            });
        });

        table.column(8).every(function () {
          var that = this;

          // Create the select list and search operation
          var select = $('#assetmaster-model-select')
            .on("change", function () {
              that.search($(this).val()).draw();
            });

          // Get the search data for the first column and add to the select list
          select.append($('<option value="">All</option>'));

          this.cache("search")
            .sort()
            .unique()
            .each(function (d) {
              select.append($('<option value="' + d + '">' + d + "</option>"));
            });
        });


      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("ajax error : " + textStatus + "\n" + errorThrown);
    }
  });
}

function getDetailofAsset(dataid, obj){
  for (var i = 0; i < obj.length; i++) {
    if(obj[i].AssetID == dataid) {
      $('input[name ="FullName"]').val(obj[i].FullName);
      $('input[name ="AssetID"]').val(obj[i].AssetID);
      $('input[name ="BHSDID"]').val(obj[i].BHSDID);
      $('input[name ="Manufacturer"]').val(obj[i].Manufacturer);
      $('input[name ="Model"]').val(obj[i].Model);
      $('input[name ="BHSDYear"]').val(obj[i].BHSDYear);
      $('input[name ="SerialNo"]').val(obj[i].SerialNo);
      $('input[name ="Ownership"]').val(obj[i].Ownership);

      $('input[name ="UserID"]').val(obj[i].UserID);
      $('input[name ="PrevUserID"]').val(obj[i].UserID);

      $('input[name ="Username"]').val(obj[i].Username);

      $('select[name ="StockStatus"]').val(obj[i].StockStatus);
      $('input[name ="PrevStockStatus"]').val(obj[i].StockStatus);

      $('select[name ="DeviceStatus"]').val(obj[i].DeviceStatus);
      $('input[name ="PrevDeviceStatus"]').val(obj[i].DeviceStatus);

      $('textarea[name ="AssetRemark"]').val(obj[i].AssetRemark);
      $('input[name ="PrevAssetRemark"]').val(obj[i].AssetRemark);

      $('textarea[name ="UserRemark"]').val(obj[i].UserRemark);
      $('input[name ="PrevUserRemark"]').val(obj[i].UserRemark);

      if ($('select[name ="DeviceStatus"] option:selected').get().length==0) {
        $('select[name ="DeviceStatus"]').append('<option value='+obj[i].DeviceStatus+' selected>'+obj[i].DeviceStatus+'</option>');
      }


    }
  }
}

function updateAssetMaster(obj) {
  toggleSpinner();
  console.log(obj);
  $.ajax({
    url: "ajax_php/a.updateAssetMaster.php",
    type: "POST",
    dataType: "json",
    data:obj,
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
        location.reload();
      } else {
        showNotification("success", "UPDATED");
        toggleSpinner();
        $('#assetMasterModal').modal('toggle');
        getAssetMaster();
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  })
}


function SearchStaffOrStudent(s,t) {
  var url = '';
  if(t == 'Student') {
    url = "ajax_php/a.getStudentListFromSearch.php";
  } else if (t == 'Staff') {
    url = "ajax_php/a.getStaffListFromSearch.php";
  }
  $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data:{
      param:s,
    },
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        showNotification("danger", "Contact IT");
        $('#searchMdl-table tbody').html('');

      } else {
        var tr = '';

        for (let i = 0; i < response.length; i++) {
          if(t == 'Student') {
           var name =
              response[i].FirstName + ' ' +
              response[i].LastName + ' ' + response[i].EnglishName;
           var id =  response[i].StudentID;
           var status = response[i].CurrentStatus;
           if(response[i].SchoolEmail) {
            var username = response[i].SchoolEmail.slice(0,-20);
          } else {
            var username = '';
          }


          } else if (t == 'Staff') {
            var name =
               response[i].FirstName + ' ' +
               response[i].LastName;
            var id =  response[i].StaffID;
            var status = response[i].CurrentStaff;

            if(response[i].Email3) {
              var username = response[i].Email3.slice(0,-12);
            } else {
              var username = '';
            }


          }

          tr +=
            '<tr data-id="' +
            id +
            '" data-full-name="' +
            name +
            '" data-username="' +
            username +
            '"><td class="text-center">' +
            id +
            "</td><td>" +
            name +
            "</td><td>" +
            status +
            "</td></tr>";
        }
         $('#searchMdl-table tbody').html(tr);

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  })

}

function getAssetMasterHistory(AssetID) {
  var history = '';
  $.ajax({
    url: "ajax_php/a.getAssetMasterHistory.php",
    type: "POST",
    dataType: "json",
    data:{
      AssetID : AssetID
    },
    success: function (response) {
      console.log(response);
      if (response.result == 0) {
        $('#assetmasterdetail-history').html('');

      } else {
        for (var i = 0; i < response.length; i++) {
          var txt = '';

          if(response[i].DeviceStatus !== response[i].PrevDeviceStatus) {
            txt += response[i].PrevDeviceStatus + ' -> ' + response[i].DeviceStatus + ' '
          }

          if(response[i].AssetRemark !== response[i].PrevAssetRemark) {
            txt += response[i].PrevAssetRemark + ' -> ' + response[i].AssetRemark + ' '
          }

          if(response[i].StockStatus !== response[i].PrevStockStatus) {
            txt += response[i].PrevStockStatus + ' -> ' + response[i].StockStatus + ' '
          }

          if(response[i].UserID !== response[i].PrevUserID) {
            txt += response[i].PrevUserID + ' -> ' + response[i].UserID + ' '
          }

          if(response[i].UserRemark !== response[i].PrevUserRemark) {
            txt += response[i].PrevUserRemark + ' -> ' + response[i].UserRemark + ' '
          }


          history += '<label class="last-modify">Last Modified On: '+ response[i].cDate + ' ' + txt + ' '
           +' by '+ response[i].Fullname +'</label><br/>'


        }

        $('#assetmasterdetail-history').html(history);

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("ajax error : " + textStatus + "\n" + errorThrown);
    }
  })
}
