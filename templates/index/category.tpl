<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo tên khách sạn" class="hasDatepicker">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":staffsave:" !== false }
                <span class="add_real code_real">Thêm loại khách sạn <img src="{$domain}/public/images/add_user.png" width="24"></span>
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
                        <th>Loại khách sạn</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th width="112">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_list_category_hotel">
                   
                </tbody>
            </table>
        </div>

        <div class="infomation_table infomation_code">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">
               
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Loại khách sạn</label>
                    <div class="input_name">
                        <input id="name" placeholder="" class="form-control" type="text" value="">
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Hình ảnh</label>
                    <div class="input_name">
                        <input id="image" placeholder="" class="form-control"type="text" value="">
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Mô tả</label>
                    <div class="input_name">
                        <input id="description" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                {* <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Loại khách sạn</label>
                    <select id="sl_category_hotel" class="choose_cate form-control" >
                        {foreach from=$lCategory item=item}
                            <option value="{$item.category_id}">{$item.name}</option>
                        {/foreach}
                    </select>
                </div> *}

            </div>
           
            <div class="text-right">
                <button class="btn btn-close-infomation_code cancel">Huỷ</button>
                <button id="btn_create_category" class="btn">Lưu</button>
            </div>
        </div>

        <div class="infomation_table infomation_group_staff">
            <i id="infomation_gid_mgt" class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="authorities">
                <h2 style="margin-top: 0px;padding-top: 2px;">Nhóm</h2>
            </div>
            <div class="category_real gid">
                <div class="item">
                    <ul class="sub">
                    {foreach from=$lGid item=item}
                        <li class="list-gid">
                            <input {if $item.id == 1}style="opacity:0.8;" disabled{/if} id="gid-name-{$item.id}" gid="{$item.id}" class="gid-name" value="{$item.name}" title="{$item.name}"/>
                            <img gid="{$item.id}" {if $item.id == 1}style="opacity:0.4;"{else}class="gid-delete"{/if} src="{$domain}/public/images/delete.png" alt="" width="24">
                        </li>
                    {/foreach}
                    <li id="tpl_list_gid"><input id="gid_name" type="text" name="" placeholder="Tên nhóm mới" value=""><img id="gid_btn_save" src="{$domain}/public/images/done.png" alt="" width="24"></li>
                    </ul>
                </div>
            </div>
            
            {* <div class="text-right"><button class="btn cancel">Huỷ</button><button class="btn">Lưu</button></div> *}
        </div>


        <div id="deleteCategory" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc muốn xóa loại khách sạn này <b id="staff_delete_noti"></b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="modal_delete_btn" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="deleteGID" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc xoá nhóm <b id="gid_delete_noti"></b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="modal_gid_delete_btn" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>