<div class="modal fade modal-primary" id="returnDeviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-custom">
        <div class="modal-content">
            <div class="card card-login card-plain">
                <div class="modal-header justify-content-center">
                    <input type="hidden" class="joinActivityId" name="joinActivityId" value="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="header header-primary text-center">
                    <h3>Return Device Info</h3>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                    <form id="returnDeviceModal-form" action="" method="">
                        <div class="row">
                            <div class="col-md-12 mg-b-50">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 text-center">
                                        <img class="retStuInfTable-stu-img" onerror="this.src='assets/img/student.png'">
                                        <input type="hidden" class="ret-hiddenReturnId" name="returnId" value="">
                                    </div>
                                    <div class="col-md-6 col-sm-12 row">
                                        <div class="col-md-12">
                                        <h6 class="font-weight-bold">Student Info</h6>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Student ID *
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control retStuInfTable-stuId" name="stuId" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Full Name
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control retStuInfTable-fullName" name="fullName" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                School Email
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control retStuInfTable-sEmail" name="sEmail" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Counsellor
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control retStuInfTable-counsellor" name="counsellor" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Return Device (Student)
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control returnDeviceModal-returnDeviceStudent" name="returnDeviceStudent" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Return Status
                                            </div>
                                            <div class="col-md-8">
                                                <select name="ReturnStatus" id="" class="form-control retStatus-select">
                                                    <option value="0">Pending</option>
                                                    <option value="1">Not Returned</option>
                                                    <option value="2">Returned</option>
                                                </select>
                                                <input type="hidden" class="OrgReturnStatus" name="OrgReturnStatus" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 col-sm-12">
                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Asset Labels
                                        </div>
                                        <div class="col-md-8">
                                            <select name="rAssetLabels" id="" class="form-control returnDeviceModal-AssetLabels-select">
                                                <option value="">None</option>
                                                <option value="1">Ok</option>
                                                <option value="2">Minor</option>
                                                <option value="3">Major</option>
                                                <option value="4">Missing</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Tablet
                                        </div>
                                        <div class="col-md-8">
                                            <select name="rTablet" id="" class="form-control returnDeviceModal-Tablet-select">
                                                <option value="">None</option>
                                                <option value="1">Ok</option>
                                                <option value="2">Minor</option>
                                                <option value="3">Major</option>
                                                <option value="4">Missing</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Keyboard
                                        </div>
                                        <div class="col-md-8">
                                            <select name="rKeyboard" id="" class="form-control returnDeviceModal-Keyboard-select">
                                                <option value="">None</option>
                                                <option value="1">Ok</option>
                                                <option value="2">Minor</option>
                                                <option value="3">Major</option>
                                                <option value="4">Missing</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Digitizer Pen
                                        </div>
                                        <div class="col-md-8">
                                            <select name="rPen" id="" class="form-control returnDeviceModal-Pen-select">
                                                <option value="">None</option>
                                                <option value="1">Ok</option>
                                                <option value="2">Minor</option>
                                                <option value="3">Major</option>
                                                <option value="4">Missing</option>
                                                <option value="5">Unassigned</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Power Adapter
                                        </div>
                                        <div class="col-md-8">
                                            <select name="rPower" id="" class="form-control returnDeviceModal-Power-select">
                                                <option value="">None</option>
                                                <option value="1">Ok</option>
                                                <option value="2">Minor</option>
                                                <option value="3">Major</option>
                                                <option value="4">Missing</option>
                                            </select>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-12 row">
                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            BHSD ID
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control returnDeviceModal-BHSDID" name="BHSDID" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Service Tag
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control returnDeviceModal-ServiceTag" name="ServiceTag" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Deduct
                                        </div>
                                        <div class="col-md-8">
                                          <select name="DeductCheck" id="" class="form-control returnDeviceModal-deduct-select">
                                              <option value="">None</option>
                                              <option value="Y">Yes</option>
                                              <option value="N">No</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Deduct Amount
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control returnDeviceModal-DeductAmount" name="DeductionAmount" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 row row-eq-height">
                                        <div class="col-md-4">
                                            Inspection Date
                                        </div>
                                        <div class="col-md-8">
                                          <input type="text" name="InspectionDate" class="form-control datepicker returnDeviceModal-InspectionDate mg-lr-7"
                                            data-date-format="YYYY-MM-DD" value="" />
                                        </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-12 col-sm-12">
                                    <div class="col-md-12">
                                    <h6 class="font-weight-bold">Inspection Result</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="InspectionResult" rows="5" class="form-control returnDeviceModal-InspectionResult"
                                                  maxlength="300"></textarea>
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <!-- <div class="text-center mg-b-30">
                        <div class="text-left" style="display:inline-block;">
                            <label style="width:120px">Last modified at </label><label
                                id="resetMdl-modifiedAt"></label><br />
                            <label style="width:120px">Last modified by </label><label
                                id="resetMdl-modifiedBy"></label>
                        </div>
                    </div> -->
                    <button type="button" class="btn btn-sm btn-info returnDeviceModal-save-btn">save</button>
                    <button type="button" class="btn btn-sm returnDeviceModal-close-btn">cancel</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  dateTimePicker();

});
</script>
