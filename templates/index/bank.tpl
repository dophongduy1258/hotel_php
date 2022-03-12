<div class="col-sm-12">
    <div class="col-md-2 col-sm-6 col-xs-4 pull-right">
        <span id="btn_add_bank" class="add_real code_real">Thêm ngân hàng <img src="{$domain}/public/images/add.png" width="24"></span>
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
                <p>Xác nhận xóa tài khoản ngân hàng: <b id="delete_bank"></b></p>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_confirm_delete" class="btn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
<div id="addModal" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thêm tài khoản ngân hàng</h3>
                <form autocomplete="off" action="return:javascript:;">
                <div class="col-sm-12 col-xs-12">
                    <div class="col-sm-12 col-xs-12 bg-white bank-holder">
                        <div class="holder-suggested1">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Tên Ngân Hàng</label>
                                    <div class="input_name">
                                        <input placeholder="VD: Ngân hàng ngoại thương Việt Nam" id="bank-name" value="" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Mã Ngân Hàng</label>
                                    <div class="input_name">
                                        <input placeholder="VD: VCB" id="bank-code" value="" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Tài Khoản Ngân Hàng</label>
                                    <div class="input_name">
                                        <input placeholder="VD: 0421000xxxxxx" id="bank-account" value="" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Tên Tài Khoản Ngân Hàng</label>
                                    <div class="input_name">
                                        <input placeholder="LE NGOC H" id="bank-account-name" value="" class="form-control" type="text">
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-xs-12">
                                    <label class="label_name">Link logo Ngân Hàng</label>
                                    <div class="input_name">
                                        <input placeholder="" id="bank-url" value="" class="form-control" type="text">
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