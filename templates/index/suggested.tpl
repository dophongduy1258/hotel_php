<div class="content-pr bg-white">
    <div class="row" id="tpl" >

            {* <div class="col-sm-6 col-xs-12" id="holder-suggested-{$item.id}">
                
                <div class="col-sm-12 col-xs-12">
                    <img suggested-id="{$item.id}" src="{$domain}/public/images/delete.png" alt="" width="24" class="suggested img_delete">
                </div>

                <div class="col-sm-12 col-xs-12">
                    <label class="label_name">Thời gian đề xuất</label>
                    <div class="input_name">
                        {$item.created_at|date_format:"H:i d/m/y"}
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <label class="label_name">Người đề suất</label>
                    <div class="input_name">
                        {$item.fullname}
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <label class="label_name">Địa chỉ BĐS</label>
                    <div class="input_name">
                        {$item.address}
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <label class="label_name">Giá đề xuất bán</label>
                    <div class="input_name">
                        {$item.price|number_format:0:'.':','}
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <label class="label_name">Điện thoại liên hệ</label>
                    <div class="input_name">
                        {$item.mobile}
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <label class="label_name">Tỉnh/ Thành</label>
                    <div class="input_name">
                        {$item.province_name}
                    </div>
                </div>
                
                <div class="col-sm-12 col-xs-12">
                    <label class="label_name">Ghi chú</label>
                    <div class="input_name">
                        {$item.description}
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                   <div class="avatar_thumbs row">
                        <a class="col-md-3 img">
                            <img src="https://musado.vn/blockreal/uploads/product/images/171.233.140.237-1541822884-63093524-blockreal.vn.jpg" class="img-responsive img">
                        </a>
                    </div>
                </div>
                
            </div> *}


    </div>
</div>

<div id="deleteModal" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thông báo</h3>
                <p>Xác nhận xóa bất động sản này?</p>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_confirm_delete" class="btn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>