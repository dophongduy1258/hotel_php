
<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo email/điện thoại nhà đầu tư" class="hasDatepicker">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-4 pull-right">
                <span id="btn_add_investor" class="add_real code_real">Thêm NĐT <img src="{$domain}/public/images/add.png" width="24"></span>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-4 pull-right">
                <span id="btn_sync_client" class="add_real code_real">Đồng bộ tài khoản <img src="{$domain}/public/images/sync.png" width="24"></span>
            </div>
        </div>
    </form>
</div>
<div class="content-pr bg-white">
    <div class="wrap-table-detail">
        <div class="table-responsive table-detail table-0-15">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã NĐT</th>
                        <th>Tên nhà đầu tư</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Ngày tham gia</th>
                        <th width="10%">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_list">
                    <tr>
                        <td>1</td>
                        <td>
                            <span class="dt-span">-</span>
                        </td>
                        <td>
                            <span class="dt-span">-</span>
                        </td>
                        <td>
                            <span class="dt-span">-</span>
                        </td>
                        <td>-</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            {* <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done"> *}
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                        </td>
                    </tr>
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
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
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
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
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
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
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
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                        </td>
                    </tr> *}
                </tbody>
            </table>
            <div id="hd_page_html" class="col-lg-12 col-md-12 top10">
                <div id="page_html" class="col-lg-12 col-md-12 top10">
                </div>
            </div>
        </div>

        {* <div class="infomation_table infomation_code">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Mã nhà đầu tư</label>
                    <div class="input_name">
                        <input class="form-control" type="text" name="" value="Q7001">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Họ & tên</label>
                    <div class="input_name">
                        <input placeholder="" class="form-control" type="text" value="Nguyễn Thành Tân">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Số điện thoại</label>
                    <div class="input_name">
                        <input class="form-control" type="text" name="" value="0976674647">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Email</label>
                    <div class="input_name">
                        <input class="form-control" type="text" name="" value="tannt2103@gmail.com">
                    </div>
                </div>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <label class="label_name">Địa chỉ</label>
                    <div class="input_name">
                        <input placeholder="" class="form-control"type="text" value="23-25 Nguyễn Kiệm, Gò Vấp, TpHCM">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Số tài khoản ngân hàng</label>
                    <div class="input_name">
                        <input class="form-control" type="text" name="" value="0251002717858">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Ngân hàng</label>
                    <select class="choose_cate form-control">
                        <option value="">Vietcombank</option>
                        <option value="">Sacombank</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Chi nhánh</label>
                    <select class="choose_cate form-control">
                        <option value="">Bình Tây</option>
                        <option value="">Bình Bông</option>
                    </select>
                </div>
            </div>
            <div class="text-right"><button class="btn cancel">Huỷ</button><button class="btn">Lưu</button></div>
        </div> *}

        <!-- Start Edit Profile Investor -->
        <div class="infomation_table infomation_investor">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Mã NĐT</label>
                    <div class="input_name">
                        <input id="username" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Họ & tên</label>
                    <div class="input_name">
                        <input id="name" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Email</label>
                    <div class="input_name">
                        <input  id="email" placeholder="" class="form-control" type="text" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Số điện thoại</label>
                    <div class="input_name">
                        <input id="mobilePhone" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                {* <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Mật khẩu</label>
                    <div class="input_name">
                        <input class="form-control" type="text" name="" value="123456">
                    </div>
                </div> *}
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <label class="label_name">Địa chỉ</label>
                    <div class="input_name">
                        <input id="diachi" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Trạng thái</label>
                    <select id="activate" disabled class="choose_cate form-control">
                        <option value="1">Hoạt động</option>
                        <option value="0">Bị khoá</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Tài khoản ngân hàng</label>
                    <div class="input_name">
                        <input id="bankaccnum" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Tên người hưởng thụ</label>
                    <div class="input_name">
                        <input id="beneficiary" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Ngân hàng</label>
                    <div class="input_name">
                        <input id="bankname" class="form-control" type="text" name="" value="">                    
                        {* <select class="choose_cate form-control">
                            <option>Chọn ngân hàng</option>
                            <option>Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank)</option>
                            <option>Ngân hàng Wooribank (WooriBank)</option>
                            <option>Ngân hàng TMCP Bưu Điện Liên Việt (LienvietPostBank)</option>
                            <option>Ngân hàng TNHH Indovina (IVB)</option>
                            <option>Ngân hàng TMCP Nam Á (NamABank)</option>
                            <option>Ngân hàng Liên Doanh Việt Nga (VRB)</option>
                            <option>Ngân hàng TMCP Kiên Long (KienLongBank)</option>
                            <option>Ngân hàng TMCP Sài Gòn Công Thương (SaiGonBank)</option>
                            <option>Ngân hàng Nông Nghiệp và Phát triển Nông Thôn Việt Nam (AgriBank)</option>
                            <option>Ngân hàng TMCP Sài Gòn Thương Tín (SacomBank)</option>
                        </select> *}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Chi nhánh ngân hàng</label>
                    <div class="input_name">
                        <input id="branch" class="form-control" type="text" name="" value="">
                        {* <select class="choose_cate form-control">
                            <option>Chọn chi nhánh</option>
                            <option>Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank)</option>
                            <option>Ngân hàng Wooribank (WooriBank)</option>
                            <option>Ngân hàng TMCP Bưu Điện Liên Việt (LienvietPostBank)</option>
                            <option>Ngân hàng TNHH Indovina (IVB)</option>
                            <option>Ngân hàng TMCP Nam Á (NamABank)</option>
                            <option>Ngân hàng Liên Doanh Việt Nga (VRB)</option>
                            <option>Ngân hàng TMCP Kiên Long (KienLongBank)</option>
                            <option>Ngân hàng TMCP Sài Gòn Công Thương (SaiGonBank)</option>
                            <option>Ngân hàng Nông Nghiệp và Phát triển Nông Thôn Việt Nam (AgriBank)</option>
                            <option>Ngân hàng TMCP Sài Gòn Thương Tín (SacomBank)</option>
                        </select> *}
                    </div>
                </div>
            </div>
            <div class="text-right"><button class="btn btn-close-infomation_code cancel">Huỷ</button><button id="btn_modify_investor" class="btn">Lưu</button></div>
        </div>
        <!-- End Edit Profile Investor -->

       
    </div>
</div>

 <div id="resetPassword" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thông báo</h3>
                <p>Tạo mật khẩu mới cho nhà đầu tư này, mật khẩu mới sẽ tự động được tạo và gửi đến email đã đăng ký!</p>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_confirm_reset_password" class="btn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>