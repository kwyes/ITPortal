<div class="modal fade modal-primary" id="stuInfModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    <h3>Student Device Detail</h3>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mg-b-50">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12 text-center">
                                        <img class="stuInfModal-stu-img">

                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <table id="stuInfModal-stuInfTable" class="table table-hover" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td>Student ID</td>
                                                    <td class="stuInfTable-stuId"></td>
                                                    <td>Counsellor</td>
                                                    <td class="stuInfTable-counsellor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Full Name</td>
                                                    <td class="stuInfTable-fullName"></td>
                                                    <td>Residence</td>
                                                    <td class="stuInfTable-residence"></td>
                                                </tr>
                                                <tr>
                                                    <td>Enrolled Date</td>
                                                    <td class="stuInfTable-enrolDate"></td>
                                                    <td>Hall</td>
                                                    <td class="stuInfTable-hall"></td>
                                                </tr>
                                                <tr>
                                                    <td>Student Status</td>
                                                    <td class="stuInfTable-stuStatus"></td>
                                                    <td>Youth Advisor</td>
                                                    <td class="stuInfTable-advisor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Country of Origin</td>
                                                    <td class="stuInfTable-origin"></td>
                                                    <td>Room Number</td>
                                                    <td class="stuInfTable-room"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mg-b-30">
                                        <div class="reg-bhsd"></div>
                                        <table id="stuInfModal-devInfTable-BHSD" class="table table-hover" cellspacing="0">
                                            <thead>
                                                <tr class="table-warning">
                                                    <th>Device ID</th>
                                                    <th>Category</th>
                                                    <th>BHSD No.</th>
                                                    <th>Type</th>
                                                    <th>MAC Address</th>
                                                    <th>Device Status</th>
                                                    <th>Network Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 mg-b-30">
                                        <div class="reg-loaner"></div>
                                        <table id="stuInfModal-devInfTable-LOANER" class="table table-hover"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Device ID</th>
                                                    <th>Category</th>
                                                    <th>BHSD No.</th>
                                                    <th>Type</th>
                                                    <th>MAC Address</th>
                                                    <th>Device Status</th>
                                                    <th>Network Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 mg-b-30">
                                        <div class="reg-byod"></div>
                                        <table id="stuInfModal-devInfTable-BYOD" class="table table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Device ID</th>
                                                    <th>Category</th>
                                                    <th>BHSD No.</th>
                                                    <th>Type</th>
                                                    <th>MAC Address</th>
                                                    <th>Device Status</th>
                                                    <th>Network Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-sm stuInfo-close-btn">cancel</button>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<?php
  include_once('layout/registerDeviceModal.html');
?>