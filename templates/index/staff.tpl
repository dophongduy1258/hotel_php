<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo email/ điện thoại" class="hasDatepicker">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":staffsave:" !== false }
                <span class="add_real code_real">Thêm user <img src="{$domain}/public/images/add_user.png" width="24"></span>
                {/if}
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":staffgid:" !== false }
                <span id="btn_add_staff_group" class="add_real add_staff_group">Quản lý nhóm <img src="{$domain}/public/images/group_management.png" width="32"></span>
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
                        <th>Tên nhân viên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Nhóm</th>
                        <th width="112">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_list_users">
                    {* <tr>
                        <td>1</td>
                        <td>
                            <span class="dt-span">Nguyễn Thành Tân</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">Admin</span>
                            <select id="staff_sl_gid" class="dt-select">
                               
                            </select>
                        </td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete" data-toggle="modal" data-target="#deleteStaff">
                        </td>
                    </tr> *}
                    {* <tr>
                        <td>1</td>
                        <td class="code_real">ĐT005</td>
                        <td>
                            <span class="dt-span">Tân Đẹp Trai Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete" data-toggle="modal" data-target="#deleteStaff">
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="code_real">BĐ005</td>
                        <td>
                            <span class="dt-span">Tân Bá Đạo Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete" data-toggle="modal" data-target="#deleteStaff">
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="code_real">QB005</td>
                        <td>
                            <span class="dt-span">Tân Quá Bá Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete" data-toggle="modal" data-target="#deleteStaff">
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="code_real">ĐC005</td>
                        <td>
                            <span class="dt-span">Tân Đại Ca Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete" data-toggle="modal" data-target="#deleteStaff">
                        </td>
                    </tr> *}
                </tbody>
            </table>
        </div>

        <div class="infomation_table infomation_code">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">
               
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Họ & tên</label>
                    <div class="input_name">
                        <input id="staff_fullname" placeholder="" class="form-control" type="text" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Số điện thoại</label>
                    <div class="input_name">
                        <input id="staff_mobile" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Email</label>
                    <div class="input_name">
                        <input id="staff_email" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Địa chỉ</label>
                    <div class="input_name">
                        <input id="staff_address" placeholder="" class="form-control"type="text" value="">
                    </div>
                </div>
                 <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Mật khẩu</label>
                    <div class="input_name">
                        <input id="staff_password" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Nhóm</label>
                    <select id="staff_sl_gid" class="choose_cate form-control">
                        {foreach from=$lGid item=item}
                            <option value="{$item.id}">{$item.name}</option>
                        {/foreach}
                    </select>
                </div>

            </div>
            {* <div class="authorities hide">
                <h2>Phân quyền</h2>
                <div class="row">
                    <div class="col-md-12 col-dm-12 col-xs-12">
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Báo cáo</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 1}
                                        <li>
                                            <label class="field_L1"><input id="staff-create-{$item.id}" class="ace staff-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý sản phẩm</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 2}
                                        <li>
                                            <label class="field_L1"><input id="staff-create-{$item.id}" class="ace staff-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý nhà đầu tư</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 3}
                                        <li>
                                            <label class="field_L1"><input id="staff-create-{$item.id}" class="ace staff-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý nhân viên</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 4}
                                        <li>
                                            <label class="field_L1"><input id="staff-create-{$item.id}" class="ace staff-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 col-dm-12 col-xs-12">
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Tài khoản Ngân Hàng</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 5}
                                        <li>
                                            <label class="field_L1"><input id="staff-create-{$item.id}" class="ace staff-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Notification</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 6}
                                        <li>
                                            <label class="field_L1"><input id="staff-create-{$item.id}" class="ace staff-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Cài đặt</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 7}
                                        <li>
                                            <label class="field_L1"><input id="staff-create-{$item.id}" class="ace staff-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                </div>
            </div> *}
            <div class="text-right">
                <button class="btn btn-close-infomation_code cancel">Huỷ</button>
                <button id="btn_create_user" class="btn">Lưu</button>
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
            <div class="authorities">
                <h2>Phân quyền (mặc định)</h2>

                <select id="gid_sl_gid">
                    {foreach from=$lGid item=item}
                    <option value="{$item.id}">{$item.name}</option>
                    {/foreach}
                </select>

                <label class="field_check">
                    <input fees-id="1" name="1withdraw" id="checkallpermission" class="ace fees-by-script fees-setting" type="checkbox">
                    <span class="lbl"></span> Chọn tất cả
                </label>

                <div class="row">
                    <div class="col-md-12 col-dm-12 col-xs-12">
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Báo cáo</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 1}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý sản phẩm</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 2}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Sản phẩm đăng bán</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 10}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý nhà đầu tư</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 3}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý nhân viên</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 4}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 col-dm-12 col-xs-12">
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Tài khoản Ngân Hàng</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 5}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Chức năng giao diện APP</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 11}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Notification</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 6}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý giao dịch</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 8}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Quản lý Cọc/ Mua BĐS</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 9}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Hệ thống hoa hồng</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 12}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                        <div class="col-md-3 col-dm-6 col-xs-12">
                            <h3>Cài đặt</h3>
                            <ul>
                                {foreach from=$lPermission item=item}
                                    {if $item.group == 7}
                                        <li>
                                            <label class="field_L1"><input id="group-create-{$item.id}" class="ace group-create" type="checkbox" value="{$item.id}"><span class="lbl active"></span>{$item.title}</label>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {* <div class="text-right"><button class="btn cancel">Huỷ</button><button class="btn">Lưu</button></div> *}
        </div>

        <div id="resetPassword" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Mật khẩu mặc định sẽ là <b>{$setup.default_password}</b> cho <b id="staff_reset_noti"></b>?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="btn_reset_password" class="btn">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="deleteStaff" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc xoá nhân viên <b id="staff_delete_noti"></b> không?</p>
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