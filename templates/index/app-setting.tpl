<div class="col-sm-12">
    <div class="col-md-2 col-sm-6 col-xs-4 pull-right">
        <span id="btn_add_app_setting" class="add_real code_real">Thêm chức năng <img src="{$domain}/public/images/add.png" width="24"></span>
    </div>
</div>
<div class="content-pr">
    <div id="tpl_list" class="row">
    </div>
</div>

<div id="deleteModal" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thông báo</h3>
                <p>Xác nhận xóa chức năng: <b id="delete_app_setting"></b></p>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_confirm_delete" class="btn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<div id="isCenterIconModal" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Xác nhận</h3>
                <p>Đặt có muốn đặt hình ảnh này làm hình trung tâm?</p>
                <button id="btn_center_icon_no" type="button" class="close btn" data-dismiss="modal" aria-label="Close">Không</button>
                <button id="btn_center_icon_yes" class="btn">Có</button>
            </div>
        </div>
    </div>
</div>

<div id="addModal" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thêm chức năng ngân hàng</h3>
                <form autocomplete="off" action="return:javascript:;">
                <div class="col-sm-12 col-xs-12">
                    <div class="col-sm-12 col-xs-12 bg-white bank-holder">
                        <div class="holder-suggested1">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Tiêu đề</label>
                                    <div class="input_name">
                                        <input maxlength="100" placeholder="Tiêu đề" id="app-setting-title" value="" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Liên kết</label>
                                    <div class="input_name">
                                        <input placeholder="Link liên kết" id="app-setting-link" value="" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Ảnh đại diện</label>
                                    <div class="input_name">
                                        <input placeholder="Link logo" id="app-setting-img" value="" class="form-control" type="text">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 margin-b-30">
                        </div>
                    </div>
                </div>
                </form>

                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_add" class="btn">Thêm</button>
            </div>
        </div>
    </div>
</div>