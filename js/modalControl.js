$(document).ready(function () {

    $('#searchStuMdl-table').on('click', 'tbody tr', function () {
        var id = $(this).attr("data-id");
        var fullName = $(this).attr("data-full-name");

        if (id == '') {
            alert('Try to search student again');
        } else {
            counrOfDevice(id, fullName);
        }
    });

    $('#addNewStu-student').keypress(function (e) {
        var id = '#addNewStu-student';
        var key = e.which;
        if (key == 13) {
            searchStudentByName(id);
        }
    });

    $('.addNewStu-type').on('change', function() {
      var str = this.value;
      if (str.toLowerCase().indexOf("apple") >= 0){
        $('.table-manufacturer').val('Apple');
      } else {
        $('.table-manufacturer').val('');
      }

    });

    $('.table-type').on('change', function() {
      var str = this.value;
      if (str.toLowerCase().indexOf("apple") >= 0){
        $('.table-manufacturer').val('Apple');
      } else {
        $('.table-manufacturer').val('');
      }

    });

})

$(document).on('click touchstart', '.regDevice-update-btn', function (e) {
    if ($('.regDevice-updated').is(':checked')) {
        $('.regDevice-updated').removeAttr('checked');
        setFormValidation('#regDeviceMdlValidation');
        if ($("#regDeviceMdlValidation").valid()) {
            $(this).prop('disabled', true);
            $(".table-category").removeAttr("disabled");
            $(".table-type").removeAttr("disabled");
            $(".table-registerTo").removeAttr("disabled");
            $(".table-network").removeAttr("disabled");
            var regDeviceForm = $('#regDeviceMdlValidation').serializeArray();
            var regDeviceFormObject = {};
            $.each(regDeviceForm,
                function (i, v) {
                    regDeviceFormObject[v.name] = v.value;
                });
            updateDeviceInfo(regDeviceFormObject);
            closeModal('#regDeviceModal');
        }
    } else {
        showNotification("warning", "You did Not update any value!");
    }
});


$(document).on('click touchstart', '.assetMasterModal-save-btn', function (e) {
    var assetMasterModalForm = $('#assetMasterModal-form').serializeArray();
    var assetMasterModalFormObject = {};
    $.each(assetMasterModalForm,
        function (i, v) {
            assetMasterModalFormObject[v.name] = v.value;
        });
    updateAssetMaster(assetMasterModalFormObject);
    // closeModal('#regDeviceModal');
});

$(document).on('click touchstart', '.regDevice-add-btn', function () {
    setFormValidation('#regDeviceMdlValidation');
    if ($("#regDeviceMdlValidation").valid()) {
        $(this).prop('disabled', true);
        $(".table-category").removeAttr("disabled");
        $(".table-type").removeAttr("disabled");
        $(".table-registerTo").removeAttr("disabled");
        $(".table-network").removeAttr("disabled");
        var regDeviceForm = $('#regDeviceMdlValidation').serializeArray();
        var regDeviceFormObject = {};
        $.each(regDeviceForm, function (i, v) {
            regDeviceFormObject[v.name] = v.value;
        });
        addDeviceInfo(regDeviceFormObject);
        closeModal('#regDeviceModal');
    }
});

$(document).on('click touchstart', '.addNewStu-add-btn', function () {
    setFormValidation('#addNewStuMdlValidation');
    if ($("#addNewStuMdlValidation").valid()) {
        $(this).prop('disabled', true);
        $(".addNewStu-category").removeAttr("disabled");
        $(".addNewStu-type").removeAttr("disabled");
        $(".addNewStu-registerTo").removeAttr("disabled");
        $(".addNewStu-network").removeAttr("disabled");
        var regDeviceForm = $('#addNewStuMdlValidation').serializeArray();
        var regDeviceFormObject = {};
        $.each(regDeviceForm, function (i, v) {
            regDeviceFormObject[v.name] = v.value;
        });
        addDeviceInfo(regDeviceFormObject);
        closeModal('#addNewStuModal');
        location.reload();
    }
});

$(document).on('change', '#regDeviceModal-table input,#regDeviceModal-table textarea,#regDeviceModal-table select', function () {
    $('.regDevice-updated').attr('checked', 'checked');
});


$(document).on('click', ".stuNameLink, .btn-add-new-stu, .reg-bhsd-btn, .reg-byod-btn, .reg-loaner-btn, .bhsdLink, .byodLink, .loanerLink, .resetEmailLink, .returnDeviceLink, .assetMasterLink", function (event) {
    var target = $(event.target);
    var data_id = target.attr('data-id');

    if (target.hasClass('stuNameLink')) {
        target.attr({
            'href': '#stuInfModal',
            'data-target': "#stuInfModal"
        })

        getStudentInfo(data_id);
        getDeviceInfo(data_id);
    } else if (target.hasClass('btn-add-new-stu')) {
        target.attr({
            'data-target': "#addNewStuModal"
        });
        setInput('NEW');
    } else if (target.hasClass('reg-bhsd-btn')) {
        target.attr({
            'data-target': "#regDeviceModal"
        })
        $('.regDevice-stuId').val(data_id);
        setInput('BHSD');
        displaySubmitBtn('', 'none');
        $('.title').html('Add New BHSD');
    } else if (target.hasClass('reg-byod-btn')) {
        target.attr({
            'data-target': "#regDeviceModal"
        })
        $('.regDevice-stuId').val(data_id);
        setInput('BYOD');
        displaySubmitBtn('', 'none');
        $('.title').html('Add New BYOD');
    } else if (target.hasClass('reg-loaner-btn')) {
        target.attr({
            'data-target': "#regDeviceModal"
        })
        $('.regDevice-stuId').val(data_id);
        setInput('LOANER');
        displaySubmitBtn('', 'none');
        $('.title').html('Add New LOANER');
    } else if (target.hasClass('bhsdLink')) {
        target.attr({
            'data-target': "#regDeviceModal"
        })
        $('.regDevice-update-btn').attr('disabled', false);
        displaySubmitBtn('none', '');
        $('.title').html('Edit BHSD');
        getOneDevice(target);
    } else if (target.hasClass('byodLink')) {
        target.attr({
            'data-target': "#regDeviceModal"
        })
        $('.regDevice-update-btn').attr('disabled', false);
        displaySubmitBtn('none', '');
        $('.title').html('Edit BYOD');
        getOneDevice(target);
    } else if (target.hasClass('loanerLink')) {
        target.attr({
            'data-target': "#regDeviceModal"
        })
        $('.regDevice-update-btn').attr('disabled', false);
        displaySubmitBtn('none', '');
        $('.title').html('Edit LOANER');
        getOneDevice(target);
    }else if (target.hasClass('resetEmailLink')) {
        target.attr({
            'href': '#resPwdModal',
            'data-target': "#resPwdModal"
        })

        getResetRequestedStuInf(data_id)
    } else if (target.hasClass('returnDeviceLink')) {
        target.attr({
            'href': '#returnDeviceModal',
            'data-target': "#returnDeviceModal"
        })

        getReturnBHSDeviceStuInf(data_id)
    } else if (target.hasClass('assetMasterLink')) {
      target.attr({
          'href': '#assetMasterModal',
          'data-target': "#assetMasterModal"
      })
      getDetailofAsset(data_id,assetmasterArr);
      getAssetMasterHistory(data_id);
    }
});


$(document).on('click', ".regDevice-close-btn, .search-close-btn, .addNewStu-close-btn, .stuInfo-close-btn, .reqPwd-close-btn, .returnDeviceModal-close-btn", function (event) {
    var target = $(event.target);
    var modal = '';

    if (target.hasClass('regDevice-close-btn')) {
        modal = '#regDeviceModal';
    } else if (target.hasClass('search-close-btn')) {
        modal = '#searchStudentModal'
    } else if (target.hasClass('addNewStu-close-btn')) {
        modal = '#addNewStuModal'
    } else if (target.hasClass('stuInfo-close-btn')) {
        modal = '#stuInfModal'
    } else if (target.hasClass('reqPwd-close-btn')) {
        modal = '#resPwdModal'
    } else if (target.hasClass('returnDeviceModal-close-btn')) {
        modal = '#returnDeviceModal'
    }
    $(modal).modal('hide');
});

$(document).on('click', "#searchStuMdl-table tbody a", function () {
    $("#searchStudentModal").modal('hide');
})

$(document).on('click', "#searchStaffMdl-table tbody tr", function (event) {
    $("#searchStaffModal").modal('hide');

    var staffid = $(this).attr('data-id');
    var firstname = $(this).attr('data-firstname');
    var lastname = $(this).attr('data-lastname');
    var positiontitle2 = $(this).attr('data-positiontitle2');
    var department2 = $(this).attr('data-department2');
    var mealtagid = $(this).attr('data-mealtagid');
    var email = $(this).attr('data-email');
    var rolebogs = $(this).attr('data-rolebogs');

    $('input[name ="StaffID"]').val(staffid);
    $('input[name ="PositionTitle"]').val(positiontitle2);
    $('input[name ="Department"]').val(department2);
    $('input[name ="FirstName"]').val(firstname);
    $('input[name ="LastName"]').val(lastname);
    $('input[name ="MealTagID"]').val(mealtagid);
    $('input[name ="Email"]').val(email);
    $('input[name ="RoleBogs"]').val(rolebogs);

})

$(document).on('click', "#searchMdl-table tbody tr", function (event) {
  $("#searchModal").modal('hide');

  var id = $(this).attr('data-id');
  var fullname = $(this).attr('data-full-name');
  var username = $(this).attr('data-username');

  $('input[name ="UserID"]').val(id);
  $('input[name ="FullName"]').val(fullname);
  $('input[name ="Username"]').val(username);
});

$(document).on('hidden.bs.modal', "#regDeviceModal, #addNewStuModal", function (event) {
    var id = event.currentTarget.id;
    var table = '';
    var validation = ''

    if (id === 'regDeviceModal') {
        table = '#regDeviceModal-table';
        validation = '#regDeviceMdlValidation';
        $('.last-modify').html('');
    } else if (id === 'addNewStuModal') {
        table = '#addNewStuModal-table';
        validation = '#addNewStuMdlValidation';
    }
    clearForm(table);
    clearFormValidation(validation);
});

$(document).on('click', "#search-stu-btn", function (event) {
    searchStudentByName('#addNewStu-student');
});

$(document).on('click', ".btn-staff-search", function (event) {
    searchStaff('#stf-search-input');
});

$(document).on('click', ".reqPwd-save-btn", function (event) {
    setFormValidation('#resPwdModal-form');
    if ($("#resPwdModal-form").valid()) {
        $('.resPwdModal-resetId').prop('type', 'text');
        var preStatus = $('.resPwdModal-hiddenStatus').val();
        var preStudentId = $('.resPwdModal-hiddenStuId').val();
        var preComment = $('.resPwdModal-hiddenComment').val();
        var data = $("#resPwdModal-form").serializeArray()
        var paramsObject = {};
        $.each(data, function (i, v) {
            paramsObject[v.name] = v.value;
        });
        $('.resPwdModal-resetId').prop('type', 'hidden');
        if (preStudentId == paramsObject.stuId && preStatus == paramsObject.status && preComment == paramsObject.comment) {
            swal({
                title: 'You did not change anything',
                text: "You need to change Student ID or Status or Comment to update!",
                type: 'warning',
                confirmButtonClass: 'btn btn-sm',
                confirmButtonText: 'close',
                buttonsStyling: false
            }).catch(swal.noop)
        }else{
            console.log(paramsObject);
            updateResetRequestStatus(paramsObject);
        }
    }
});


$(document).on('click', ".returnDeviceModal-save-btn", function (event) {
        $('.ret-hiddenReturnId').prop('type', 'text');
        var data = $("#returnDeviceModal-form").serializeArray()
        var paramsObject = {};
        $.each(data, function (i, v) {
            paramsObject[v.name] = v.value;
        });
        $('.ret-hiddenReturnId').prop('type', 'hidden');
        console.log(paramsObject);
        updateReturnDevice(paramsObject);


});


function closeModal(modal) {
    $(modal).modal('hide');
}

function displaySubmitBtn(addBtn, updateBtn) {
    $('.regDevice-add-btn').css('display', addBtn)
    $('.regDevice-update-btn').css('display', updateBtn)
}


function setFormValidation(id) {
    $(id).validate({
        onclick: false,
        rules: {
            studentId: {
                required: true
            },
            category: {
                required: true
            },
            studentId: {
                required: true
            },
            manufacturer:{
              required: true
            },
            model:{
              required: true
            },
            // bhsdNum: {
            //     maxlength: 4,
            //     required: true
            // },
            type: {
                required: true,
            },
            macAddress: {
                required: true,
                minlength: 17
            },
            registerTo: {
                required: true
            },
            network: {
                required: true
            },
            usage: {
                required: true
            },
            stuId:{
                required: true,
                minlength:9,
                maxlength:9
            }
        },
        messages: {
            macAddress: {
                minlength: "Please match the MAC address format"
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            $(element).closest('.form-group').append(error);
        }
    });
}

function clearFormValidation(form_id) {
    var input_text = form_id + ' input';
    $(input_text).closest('.form-group').removeClass('has-danger').addClass('has-success');
    $(input_text).closest('.form-check').removeClass('has-danger').addClass('has-success');

    var input_num = form_id + ' select';
    $(input_num).closest('.form-group').removeClass('has-danger').addClass('has-success');
    $(input_num).closest('.form-check').removeClass('has-danger').addClass('has-success');
    $('.error').remove();
}

function clearForm(table_id) {
    $(table_id).find('input, textarea,select').val('');
}

function setInput(category) {
    clearForm('#regDeviceModal-table');
    $('.regDevice-add-btn').attr('disabled', false);

    switch (category) {
        case 'BHSD':
            displayLoanerElement('');
            generateSelector('.table-category', deviceCategory, 'BHSD', true);
            $('.name-bhsdNum').html('BHSD Number *');
            $('.tr-bhsdNum').css('display', '');
            generateSelector('.table-type', bhsdType, 'Computer-PC', true);
            $('.manufact-form').html(manuInput);
            $('.model-form').html(modelInput);
            $('.tr-macAddress').css('display', '');
            generateSelector('.table-registerTo', registerTo, 'BHSD-STUDENT', true);
            generateSelector('.table-network', netRegist, 'Registered', true);
            generateSelector('.table-usage', bhsdUsage, 'InUse', false);
            break;
        case 'BYOD':
            displayLoanerElement('');
            generateSelector('.table-category', deviceCategory, "BYOD", true);
            $('.tr-bhsdNum').css('display', 'none');
            generateSelector('.table-type', byodType, 'none', false);
            $('.manufact-form').html(manuInput);
            $('.model-form').html(modelInput);
            $('.tr-macAddress').css('display', '');
            generateSelector('.table-registerTo', registerTo, 'BYOD-STUDENT', true);
            generateSelector('.table-network', netRegist, 'Pending', false);
            generateSelector('.table-usage', bhsdUsage, 'InUse', false);
            break;
        case 'LOANER':
            displayLoanerElement('');
            generateSelector('.table-category', deviceCategory, "LOANER", true);
            $('.name-bhsdNum').html('LOANER BHSD Number');
            $('.tr-bhsdNum').css('display', '');
            generateSelector('.table-type', loanerType, 'Loaner-PC', false);
            $('.manufact-form').html(manuSelect);
            $('.model-form').html(modelSelect);
            generateSelector('.table-manufacturer', loanerManufacturer, 'none', false);
            generateSelector('.table-model', loanerModel, 'none', false);
            $('.tr-macAddress').css('display', 'none');
            generateSelector('.table-registerTo', registerTo, 'BHSD-STUDENT', true);
            generateSelector('.table-network', netRegist, 'Registered', true);
            generateSelector('.table-usage', loanerUsage, 'Loaned', false);
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
        case 'NEW':
            displayLoanerElement('');
            generateSelector('.addNewStu-category', deviceCategory, "BYOD", false);
            $('.tr-bhsdNum').css('display', 'none');
            generateSelector('.addNewStu-type', byodType, 'none', false);
            $('.manufact-form').html(manuInput);
            $('.model-form').html(modelInput);
            $('.tr-macAddress').css('display', '');
            generateSelector('.addNewStu-registerTo', registerTo, 'BYOD-STUDENT', true);
            generateSelector('.addNewStu-network', netRegist, 'Pending', false);
            generateSelector('.addNewStu-usage', bhsdUsage, 'InUse', false);
            break;
        default:
            break;
    }
}

function generateSelector(select, arr, def_val, disable) {
    var options = '';
    if (def_val == 'none') {
        options = '<option value="">Select..</option>'
    }
    for (let i = 0; i < arr.length; i++) {
        options += '<option value="' + arr[i] + '">' + arr[i] + '</option>'
    }

    $(select).html(options);
    if (def_val != 'none') {
        $(select).val(def_val).prop('selected', true);
    }

    $(select).prop('disabled', disable);


}
