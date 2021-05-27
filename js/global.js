var deviceCategory = ['BHSD', 'BYOD', 'LOANER'];
var bhsdType = ['Computer-PC'];
var byodType = ['Computer-PC', 'Computer-Apple', 'SmartPhone-Android', 'SmartPhone-Apple', 'Tablet-Android', 'Tablet-Apple', 'Game-PlayStation', 'Game-Xbox', 'Other (Specify below)'];
var loanerType = ['Loaner-PC', 'Loaner-Charger', 'Loaner-Other'];
var registerTo = ['BHSD-STUDENT', 'BYOD-STUDENT']
var netRegist = ['Pending', 'Registered', 'Removed', 'Invalid'];
var bhsdUsage = ['InUse', 'NotUsed'];
var byodUsage = ['InUse', 'NotUsed'];
var loanerUsage = ['Loaned', 'Returned', 'Lost'];
var loanerManufacturer = ['Dell', 'Lenovo', 'Other'];
var loanerModel = ['Latitude 5480', 'Latitude 5290 2-in-1', 'ThinkPad T460s', 'ThinkPad T470s', 'Other'];
var manuInput = '<input type="text" name="manufacturer" class="form-control table-manufacturer" maxlength="50">';
var manuSelect = '<select name="manufacturer" class="table-manufacturer form-control"></select>';
var modelInput = '<input type="text" name="model" class="form-control table-model" maxlength="50">';
var modelSelect = '<select name="model" class="table-model form-control"></select>';
var resetReqArr = '';
var returnDevArr = '';
var assetmasterArr = '';
var allStaffArr = '';
var allStudentArr = '';

$(document).ready(function () {
	$(document).on('click', '.cta', function () {
		$(this).toggleClass('active')
	})
});


(function () {
	'use strict';
	var $ = jQuery;
	$.fn.extend({
		filterTable: function () {
			return this.each(function () {
				$(this).on('keyup', function (e) {
					var $this = $(this),
						search = $this.val().toLowerCase(),
						target = $this.attr('data-filters'),
						$rows = $(target).find('tbody tr');
					if (search == '') {
						$rows.show();
					} else {
						$rows.each(function () {
							var $this = $(this);
							$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
						})
					}
				});
			});
		}
	});
	$('[data-action="filter"]').filterTable();
})(jQuery);

$(function () {
	// attach table filter plugin to inputs
	$('[data-action="filter"]').filterTable();

	$('.container').on('click', '.panel-heading span.filter', function (e) {
		var $this = $(this),
			$panel = $this.parents('.panel');

		$panel.find('.panel-body').slideToggle();
		if ($this.css('display') != 'none') {
			$panel.find('.panel-body input').focus();
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
})



function isValidMac(mystring) {
	var regex = /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/;
	return regex.test(mystring);
}

$('body').on('keyup', '.table-macAddress', function (e) {
	var e = $(this).val();
	var r = /([a-f0-9]{2})([a-f0-9]{2})/i,
		str = e.replace(/[^a-f0-9]/ig, "");
	while (r.test(str)) {
		str = str.replace(r, '$1' + ':' + '$2');
	}
	e = str.slice(0, 17);
	$(this).val(e)
	$(".table-macAddress").parent().toggleClass("has-danger", !isValidMac(e));
	var err = '<label id="macAddress-error2" class="error2" for="macAddress">Wrong Mac Address</label>';
	// $('#macAddress-error2').toggle();
	// $(".table-macAddress").toggleClass("has-danger",!isValidMac(e));

});

$('body').on('keyup', '.addNewStu-macAddress', function (e) {
	var e = $(this).val();
	var r = /([a-f0-9]{2})([a-f0-9]{2})/i,
		str = e.replace(/[^a-f0-9]/ig, "");
	while (r.test(str)) {
		str = str.replace(r, '$1' + ':' + '$2');
	}
	e = str.slice(0, 17);
	$(this).val(e)
	$(".addNewStu-macAddress").parent().toggleClass("has-danger", !isValidMac(e));
});

function showNotification(color, msg) {
	// type = ['', 'info', 'success', 'warning', 'danger', 'rose', 'primary'];
	$.notify({
		message: msg
	}, {
		type: color,
		delay: 500,
		z_index: 9999,
		placement: {
			from: "top",
			align: "center"
		}
	});
}

function calculateSubTotal(selector, place) {
	var inputs = $(selector + " tbody tr");
	var current = 0;
	var newVal = 0;
	var notcurrent = 0;
	$(inputs).each(function () {
		current += parseInt($(this).find('td').eq(1).text());
		newVal += parseInt($(this).find('td').eq(2).text());
		notcurrent += parseInt($(this).find('td').eq(3).text());
	});
	$('.total-' + place + '-current').html(current);
	$('.total-' + place + '-new').html(newVal);
	$('.total-' + place + '-notcurrent').html(notcurrent);

}

function calculateSubTotalStaff(selector, place) {
	var inputs = $(selector + " tbody tr");
	var total = 0;
	var bhs = 0;
	var bss = 0;
	var bcl = 0;
	var bci = 0;

	$(inputs).each(function(){
		total += parseInt($(this).find('td').eq(1).text()) || 0;
		bhs += parseInt($(this).find('td').eq(2).text()) || 0;
		bss += parseInt($(this).find('td').eq(3).text()) || 0;
		bcl += parseInt($(this).find('td').eq(4).text()) || 0;
		bci += parseInt($(this).find('td').eq(5).text()) || 0;
	});
	$(place).find('td').eq(1).html(total);
	$(place).find('td').eq(2).html(bhs);
	$(place).find('td').eq(3).html(bss);
	$(place).find('td').eq(4).html(bcl);
	$(place).find('td').eq(5).html(bci);

}

function makeProgress(i){
	// alert(i);
	var j = 100 - i;
	if (j < 100) {
		j = j + 1;
		$(".progress-bar").css("width", j + "%").text(j + " %");
	}
	// Wait for sometime before running this script again
	setTimeout("makeProgress()", 100);
}

function displayLoanerElement(display) {
	$('.tr-manufacturer').css('display', display);
	$('.tr-model').css('display', display);
	$('.tr-registerTo').css('display', display);
	$('.tr-network').css('display', display);
}

function toggleSpinner() {
		if ($(".mask").is(":hidden")) {
		  $(".mask").show();
		} else {
		  $(".mask").hide();
		}
}

function getFullName(eName, fName, lName) {
	var name = '';
	if (eName) {
		name =
			fName +
			" (" +
			eName +
			") " +
			lName;
	} else {
		name = fName + " " + lName;
	}

	return name;
}

function dateTimePicker() {
  if ($(".datetimepicker").length != 0) {
    $(".datetimepicker").datetimepicker({
      // debug: true,
      ignoreReadonly: true,
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-screenshot",
        clear: "fa fa-trash",
        close: "fa fa-remove"
      }
    }).on("dp.change", function () { });
    $(".datetimepicker").attr("readonly", "readonly");
  }

  if ($(".datepicker").length != 0) {
    $(".datepicker").datetimepicker({
      // debug: true,
      // readonly: true,
      ignoreReadonly: true,
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-screenshot",
        clear: "fa fa-trash",
        close: "fa fa-remove"
      }
    }).on("dp.change", function (event) {

    });
  }
}

function getAllValInForm(formId) {
  var params = $("#" + formId).serializeArray();
  var paramsObject = {};
  $.each(params, function (i, v) {
    paramsObject[v.name] = v.value;
  });
  return paramsObject;

}

function selectOnlyThis(id){
  var myCheckbox = document.getElementsByName("returnto");
  Array.prototype.forEach.call(myCheckbox,function(el){
  	el.checked = false;
  });
  id.checked = true;
}
