<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
            <label class="label_name">Lọc khách sạn theo loại</label>
            <select id="search_sl_category_hotel" class="choose_cate form-control" >
                
                <option value="">Tất cả</option>
                {foreach from=$lCategory item=item}
                    <option value="{$item.category_id}">{$item.name}</option>
                {/foreach}
            </select>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":staffsave:" !== false }
                <span class="add_real code_real">Thêm khách sạn <img src="{$domain}/public/images/add_user.png" width="24"></span>
                {/if}
            </div>
        </div>
   </form>
</div>
<div class="content-pr bg-white">
    <div class="wrap-table-detail">
        <!--BEGIN main infomation-->
        <div class="table-responsive table-detail table-0-15">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên khách sạn</th>
                        <th>Mô tả</th>
                        <th>địa chỉ</th>
                        <th>Loại khách sạn</th>
                        <th width="112">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_list_hotels">
                   
                </tbody>
            </table>
        </div>

        <div class="infomation_table infomation_code">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">
               
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Tên khách sạn</label>
                    <div class="input_name">
                        <input id="hotel_name" placeholder="" class="form-control" type="text" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Mô tả</label>
                    <div class="input_name">
                        <input id="hotel_description" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Địa chỉ</label>
                    <div class="input_name">
                        <input id="hotel_address" placeholder="" class="form-control"type="text" value="">
                    </div>
                </div>
                 {* <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Mật khẩu</label>
                    <div class="input_name">
                        <input id="staff_password" class="form-control" type="text" name="" value="">
                    </div>
                </div> *}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Loại khách sạn</label>
                    <select id="staff_sl_category_hotel" class="choose_cate form-control" >
                        {foreach from=$lCategory item=item}
                            <option value="{$item.category_id}">{$item.name}</option>
                        {/foreach}
                    </select>
                </div>

            </div>
           
            <div class="text-right">
                <button class="btn btn-close-infomation_code cancel">Huỷ</button>
                <button id="btn_create_hotel" class="btn">Lưu</button>
            </div>
        </div>


        <div id="deleteHotel" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc muốn xóa khách sạn này <b id="staff_delete_noti"></b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="modal_delete_btn" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>