<div class="modal fade modal-primary" id="resPwdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    <h3>Requested Student Info</h3>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                    <form id="resPwdModal-form" action="" method="">
                        <div class="row">
                            <div class="col-md-12 mg-b-50">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 text-center">
                                        <img class="resPwdModal-stu-img" onerror="this.src='assets/img/student.png'">

                                    </div>
                                    <div class="col-md-6 col-sm-12 row">
                                        <input type="hidden" class="resPwdModal-resetId" name="resetId" value="">
                                        <input type="hidden" class="resPwdModal-hiddenStuId" name="hStuId" value="">
                                        <input type="hidden" class="resPwdModal-hiddenStatus" name="hStatus" value="">
                                        <input type="hidden" class="resPwdModal-hiddenComment" name="hComment" value="">
                                        <div class="col-md-12">
                                        <h6 class="font-weight-bold">Student Info</h6>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Student ID *
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control reqStuInfTable-stuId" name="stuId" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Full Name
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-fullName" name="fullName" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Date of Birth
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-dob" name="dob" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                School Email
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-sEmail" name="sEmail" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Personal Email
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-pEmail" name="pEmail" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Counsellor
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-counsellor" name="counsellor" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Request Status
                                            </div>
                                            <div class="col-md-8">
                                                <select name="status" id="" class="form-control reqStatus-select">
                                                    <option value="0">Pending</option>
                                                    <option value="1">Complete</option>
                                                    <option value="2">Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="font-weight-bold mg-t-20">Where student stays now</h6>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Country
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-country" name="country" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                City
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-city" name="city" value="" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <h6 class="font-weight-bold mg-t-20">When student can receive a call</h6>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Date and Time
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-dat" name="dat" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-4">
                                                Phone Number
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control reqStuInfTable-phone" name="phone" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height mg-t-20">
                                            <div class="col-md-4">Need translation while calling?</div>
                                            <div class="col-md-8 row custom-row">
                                                <div class="form-check-radio col-md-6 row row-eq-height">
                                                    <label class="form-check-label col-md-6">
                                                    <input class="form-check-input col-md-6 reqStuInfTable-translation" type="radio" name="translation" id="" value="1"
                                                        autocomplete="off" disabled>
                                                    Yes
                                                    <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check-radio col-md-6 row row-eq-height">
                                                    <label class="form-check-label col-md-6">
                                                    <input class="form-check-input col-md-6 reqStuInfTable-translation" type="radio" name="translation" id="" value="0" disabled>
                                                    No
                                                    <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mg-t-20">
                                            <div>
                                                Comment
                                            </div>
                                            <div>
                                                <textarea  name="comment" rows="10"
                                                class="md-textarea reqStuInfTable-comment form-control" placeholder="" maxlength="1000"></textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <div class="text-center mg-b-30">
                        <div class="text-left" style="display:inline-block;">
                            <label style="width:120px">Last modified at </label><label
                                id="resetMdl-modifiedAt"></label><br />
                            <label style="width:120px">Last modified by </label><label
                                id="resetMdl-modifiedBy"></label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-info reqPwd-save-btn">save</button>
                    <button type="button" class="btn btn-sm reqPwd-close-btn">cancel</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
