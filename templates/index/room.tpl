<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo tên khách sạn" class="hasDatepicker">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":staffsave:" !== false }
                <span class="add_real code_real">Thêm phòng <img src="{$domain}/public/images/add_user.png" width="24"></span>
                {/if}
            </div>
            {* <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":staffgid:" !== false }
                <span id="btn_add_staff_group" class="add_real add_staff_group">Quản lý nhóm <img src="{$domain}/public/images/group_management.png" width="32"></span>
                {/if}
            </div> *}
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
                        <th>Mã phòng</th>
                        <th>Khách sạn</th>
                        <th>Mô tả</th>
                        <th>Giá phòng</th>
                        <th>Trạng thái phòng</th>
                        <th width="112">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_list_room">
                   
                </tbody>
            </table>
        </div>

        <div class="infomation_table infomation_code">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">
               
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Mã phòng</label>
                    <div class="input_name">
                        <input id="number_room" placeholder="" class="form-control" type="text" value="">
                    </div>
                </div>
                
                
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Giá phòng</label>
                    <div class="input_name">
                        <input id="price" placeholder="" class="form-control"type="text" value="">
                    </div>
                </div>
                
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Lượng khách</label>
                    <div class="input_name">
                        <input id="number_of_member" placeholder="" class="form-control"type="text" value="">
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Kích thước phòng</label>
                    <div class="input_name">
                        <input id="size_room" placeholder="" class="form-control"type="text" value="">
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Giường</label>
                    <select id="sl_bed" class=" form-control" >
                        <option value="">Chọn loại giường</option>
                        <option value="0">Giường đơn</option>
                        <option value="1">Giường đôi</option>
                    </select>
                </div>
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Chọn loại phòng</label>
                    <select id="sl_category" class="choose_cate form-control" >
                    <option value="">Chọn loại phòng</option>
                    {foreach from=$lRCategory item=item}
                        <option value="{$item.category_room_id}">{$item.name}</option>
                    {/foreach}
                    </select>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Chọn khách sạn</label>
                    <select id="sl_hotel" class="choose_cate form-control" >
                    {foreach from=$lHotel item=item}
                        <option value="{$item.hotel_id}">{$item.hotel_name}</option>
                    {/foreach}
                    </select>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Ăn sáng miễn phí</label>
                    <div class="input_name">
                        <input id="breakfast" placeholder="" class="form-control"type="checkbox" value="">
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Wifi</label>
                    <div class="input_name">
                        <input id="wifi" placeholder="" class="form-control"type="checkbox" value="">
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Áp dụng chính sách hoàn tiền</label>
                    <div class="input_name">
                        <input id="refund" placeholder="" class="form-control"type="checkbox" value="">
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Áp dụng chính sách đổi lịch</label>
                    <div class="input_name">
                        <input id="reschedule" placeholder="" class="form-control"type="checkbox" value="">
                    </div>
                </div>

                
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <label class="label_name">Mô tả</label>
                    <div class="input_name">
                        {* <input id="description" class="form-control" type="text" name="" value=""> *}
                        <textarea id="description" class="form-control" rows="20" cols="12" ></textarea>
                    </div>
                </div>
                {* <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Trạng phòng</label>
                    <div class="input_name">
                        <input id="status" class="form-control" type="text" name="" value="">
                    </div>
                </div> *}


                <div class="row">
                    <div class="col-md-3 col-dm-12 col-xs-12">
                        <div class="col-md-12 col-dm-6 col-xs-12">
                            <h3>Tiện nghi phòng</h3>
                            <ul>
                                {foreach from=$lRBenefit item=item}
                                    {if $item.group == 1}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.room_benefit_id}" class="ace group-create" type="checkbox" value="{$item.room_benefit_id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-dm-12 col-xs-12">
                        <div class="col-md-12 col-dm-6 col-xs-12">
                            <h3>Tiện nghi công cộng</h3>
                            <ul>
                                {foreach from=$lRBenefit item=item}
                                    {if $item.group == 2}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.room_benefit_id}" class="ace group-create" type="checkbox" value="{$item.room_benefit_id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="row"><div class="col-md-12"><label class="label_name">Hình ảnh phòng</label></div></div>
                    <div class="avatar_thumbs create-product row">
                        <a id="hold_img_show" class="col-md-2"><img src="{$domain}/public/images/plus-sign.png" style="opacity:0.3;cursor:pointer;" class="img-responsive"></a>
                        {* <a class="col-md-2 img"><img src="{$domain}/public/images/product.jpg" class="img-responsive img"><i class="delete">x</i></a> *}
                    </div>
                    <input class="hide" hide id="file_uploading" type="file" name="files" value="" accept="image/x-png,image/gif,image/jpeg" />
                </div>

                <div class="row  ">
                    {* <div class="row"><div class="col-md-12"><label class="label_name">Danh sách ảnh phòng</label></div></div>    *}
                    <div class="avatar_lst  row" id="lstAvatar">
                    </div>
                </div>
            </div>
           
            <div class="text-right">
                <button class="btn btn-close-infomation_code cancel">Huỷ</button>
                <button id="btn_create_room" class="btn">Lưu</button>
            </div>
        </div>

        


        <div id="deleteRoom" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc muốn xóa phòng này <b id="staff_delete_noti"></b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="modal_delete_btn" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="deleteImg" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc muốn xóa ảnh này <b id="img_delete_noti"></b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="modal_delete_img_btn" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</div>



<link href="{$domain}/public/upload/upload_temp.css?{$version}" rel="stylesheet">
<script src="{$domain}/public/upload/uploadfunction.js?{$version}"></script>
<script src="{$domain}/public/upload/jquery.fileupload.js?"></script>
<script src="{$domain}/public/upload/jquery.fileupload.js?"></script>