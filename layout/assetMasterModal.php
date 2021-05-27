<div class="modal fade modal-primary" id="assetMasterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    <h3>Asset Master Detail</h3>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                    <form id="assetMasterModal-form" action="" method="">
                        <div class="row">
                            <div class="col-md-12 mg-b-50">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 row">
                                        <div class="col-md-12 row row-eq-height">
                                            <div class="col-md-6 row">
                                              <div class="col-md-4">
                                                  Full Name
                                              </div>
                                              <div class="col-md-8">
                                                  <input type="text" class="form-control" name="FullName" value="" readonly>
                                              </div>
                                            </div>
                                            <div class="col-md-6 row">
                                              <button class="btn btn-primary" data-toggle="modal" data-target="#searchModal" type="button" name="button">Search</button>
                                            </div>
                                        </div>

                                        <div class="col-md-12 row row-eq-height">
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                BHSD ID
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="BHSDID" value="" readonly>
                                                <input type="hidden" class="form-control" name="AssetID" value="" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                Manufacturer
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="Manufacturer" value="">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12 row row-eq-height">
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                Model
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="Model" value="" >
                                            </div>
                                          </div>
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                BHSD Year
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="BHSDYear" value="" >
                                            </div>
                                          </div>
                                        </div>


                                        <div class="col-md-12 row row-eq-height">
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                Ownership
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="Ownership" value="" >
                                            </div>
                                          </div>
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                Serial No
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="SerialNo" value="" >
                                            </div>
                                          </div>
                                        </div>


                                        <div class="col-md-12 row row-eq-height">
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                Username
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="Username" value="" >
                                            </div>
                                          </div>
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                UserID
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="UserID" value="" readonly>
                                                <input type="hidden" name="PrevUserID" value="">

                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-md-12 row row-eq-height">
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                Stock Status
                                            </div>
                                            <div class="col-md-8">
                                                <select name="StockStatus" id="" class="form-control StockStatus">
                                                  <option value=""></option>
                                                  <option value="1_IN_IT242_OTS">1_IN_IT242_OTS</option>
                                                  <option value="2_OUT_USER">2_OUT_USER</option>
                                                  <option value="3_OUT_USER_FACILITY">3_OUT_USER_FACILITY</option>
                                                  <option value="4_OUT_VENDOR_FIXIP">4_OUT_VENDOR_FIXIP</option>
                                                  <option value="5_OUT_REPLACED">5_OUT_REPLACED</option>
                                                  <option value="6_OUT_MISSING">6_OUT_MISSING</option>
                                                  <option value="7_OUT_MISSING_PAID">7_OUT_MISSING_PAID</option>
                                                  <option value="9_OUT_LFS_RETURNED">9_OUT_LFS_RETURNED</option>
                                                </select>
                                                <input type="hidden" name="PrevStockStatus" value="">

                                            </div>
                                          </div>
                                          <div class="col-md-6 row">
                                            <div class="col-md-4">
                                                Device Status
                                            </div>
                                            <div class="col-md-8">
                                                <select name="DeviceStatus" id="" class="form-control DeviceStatus">
                                                    <option value=""></option>
                                                    <option value="RFI">RFI</option>
                                                    <option value="FIX">FIX</option>
                                                    <option value="RFF">RFF</option>
                                                    <option value="RFA">RFA</option>
                                                    <option value="RFU">RFU</option>
                                                    <option value="DIU">DIU</option>
                                                    <option value="MSG">MSG</option>
                                                </select>
                                                <input type="hidden" name="PrevDeviceStatus" value="">

                                            </div>
                                          </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                      <div class="col-md-12 col-sm-12">
                                        <div class="col-md-12">
                                        <h6 class="font-weight-bold">Asset Remark</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea name="AssetRemark" rows="5" class="form-control AssetRemark"
                                                      maxlength="300"></textarea>
                                            <input type="hidden" name="PrevAssetRemark" value="">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                      <div class="col-md-12 col-sm-12">
                                        <div class="col-md-12">
                                        <h6 class="font-weight-bold">User Remark</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea name="UserRemark" rows="5" class="form-control UserRemark"
                                                      maxlength="300"></textarea>
                                            <input type="hidden" name="PrevUserRemark" value="">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div id="assetmasterdetail-history" class="text-center">
                                  
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-sm btn-info assetMasterModal-save-btn">save</button>
                    <button type="button" class="btn btn-sm assetMasterModal-close-btn" data-dismiss="modal" aria-label="Close">cancel</button>
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
