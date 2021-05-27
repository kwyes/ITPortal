<div class="modal fade modal-primary" id="addNewStuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-login card-plain">
                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="header header-primary text-center">
                    <h3>Add New Student's Device</h3>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form id="addNewStuMdlValidation" action="" method="">
                            <input type="hidden" name="studentId" class="addNewStu-stuId">
                            <input type="hidden" name="deviceId" class="addNewStu-deviceId">
                            <table id="addNewStuModal-table" class="table table-hover" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td>Student</td>
                                        <td class="row">
                                            <div class="col-md-8 col-sm-12" style="padding:0px;">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="addNewStu-student" name="student">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12" style="padding:0px;">
                                                <div>
                                                    <button type="button" class="btn btn-fill btn-info btn-sm material-icons"
                                                        id="search-stu-btn" data-toggle="modal">
                                                        search
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student ID *</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="addNewStu-studentId" name="studentId"
                                                    readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Category *</td>
                                        <td>
                                            <div class="form-group">
                                                <select name="category" class="addNewStu-category form-control">
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="tr-bhsdNum">
                                        <td class="name-bhsdNum">BHSD Number *</td>
                                        <td>
                                            <div class="form-group">
                                                <input name="bhsdNum" class="form-control addNewStu-bhsdNum" maxlength="4">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type *</td>
                                        <td>
                                            <div class="form-group">
                                                <select name="type" class="addNewStu-type form-control" required
                                                    disabled>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class='tr-manufacturer'>
                                        <td>Manufacturer *</td>
                                        <td>
                                            <div class="form-group manufact-form">
                                                <!-- <input type="text" name="manufacturer" class="form-control addNewStu-manufacturer"
                                                    maxlength="50"> -->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class='tr-model'>
                                        <td>Model *</td>
                                        <td>
                                            <div class="form-group model-form">
                                                <!-- <input type="text" name="model" class="form-control addNewStu-model"
                                                    maxlength="50"> -->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="tr-macAddress">
                                        <td>MAC Address *</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="macAddress" class="form-control addNewStu-macAddress"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class='tr-registerTo'>
                                        <td>Register to *</td>
                                        <td>
                                            <div class="form-group">
                                                <select name="registerTo" class="addNewStu-registerTo form-control"
                                                    required disabled>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class='tr-network'>
                                        <td>Network Registration *</td>
                                        <td>
                                            <div class="form-group">
                                                <select name="network" class="addNewStu-network form-control">
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Device Usage *</td>
                                        <td>
                                            <div class="form-group">
                                                <select name="usage" class="addNewStu-usage form-control">
                                                </select>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Remarks</td>
                                        <td><textarea name="remark" rows="5" class="form-control addNewStu-remark"
                                                maxlength="300"></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-success addNewStu-add-btn">save</button>
                                <button type="button" class="btn btn-sm addNewStu-close-btn">cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer text-center">


                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php
  include_once('layout/searchStudentModal.html');
?>
<script type="text/javascript">
    $(document).ready(function () {
        var category
        $('.addNewStu-category').change(function (params) {
            category = $('.addNewStu-category').val();
            if (category === 'BHSD') {
                displayLoanerElement('');
                generateSelector('.addNewStu-type', bhsdType, 'Computer-PC', true);
                generateSelector('.addNewStu-registerTo', registerTo, 'BHSD-STUDENT', true);
                generateSelector('.addNewStu-network', netRegist, 'Registered', true);
                generateSelector('.addNewStu-usage', bhsdUsage, 'InUse', false);
                $('.manufact-form').html(manuInput);
                $('.model-form').html(modelInput);
                $('.tr-bhsdNum').css('display', '');
                $('.name-bhsdNum').html('BHSD Number *');
            } else if (category === 'BYOD') {
                displayLoanerElement('');
                generateSelector('.addNewStu-type', byodType, 'none', false);
                generateSelector('.addNewStu-registerTo', registerTo, 'BYOD-STUDENT', true);
                generateSelector('.addNewStu-usage', bhsdUsage, 'InUse', false);
                $('.manufact-form').html(manuInput);
                $('.model-form').html(modelInput);
                $('.tr-bhsdNum').css('display', 'none');
            } else if (category === 'LOANER') {
                generateSelector('.addNewStu-type', loanerType, 'Loaner-PC', false);
                generateSelector('.addNewStu-registerTo', registerTo, 'BHSD-STUDENT', true);
                generateSelector('.addNewStu-network', netRegist, 'Registered', true);
                $('.manufact-form').html(manuSelect);
                $('.model-form').html(modelSelect);
                generateSelector('.table-manufacturer', loanerManufacturer, 'none', false);
                generateSelector('.table-model', loanerModel, 'none', false);
                generateSelector('.addNewStu-usage', loanerUsage, 'Loaned', false);
                $('.tr-bhsdNum').css('display', '');
                $('.name-bhsdNum').html('LOANER BHSD Number');
                $('.tr-macAddress').css('display', 'none');
                $('.addNewStu-type').change(function (params) {
                    if ($('.addNewStu-type').val() === 'Loaner-Charger' || $('.addNewStu-type')
                        .val() === 'Loaner-Other') {
                        displayLoanerElement('none');
                    } else {
                        displayLoanerElement('');
                        generateSelector('.table-manufacturer', loanerManufacturer, 'none',
                            false);
                        generateSelector('.table-model', loanerModel, 'none', false);
                    }
                });
            }
        });

        var cleaveCustom2 = new Cleave('.addNewStu-bhsdNum', {
            numeralDecimalMark: '',
            delimiter: '',
            numeral: true,
            rawValueTrimPrefix: true,
            numeralPositiveOnly: true
        });

    });
</script>
