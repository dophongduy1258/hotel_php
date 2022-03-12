<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo user/mã bất động sản">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <label class="name">Hoặc lọc theo</label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <input id="from" type="text" name="" placeholder="Từ ngày">
                        <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <input id="to" type="text" name="" placeholder="Đến ngày" autocomplete="off" />
                        <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<ul class="nav nav-tabs nav-storing storing4">
    
    {if $str_gid == 1 || $str_permission|strpos:":indexreport:reporthistory:reportdetail_investor:" !== false }
    <li id="tab_history_inves" class="active"><a data-toggle="tab" href="#history_inves">Lịch sử đầu tư</a></li>
    {{/if}}

    {if $str_gid == 1 || $str_permission|strpos:":reportROI:" !== false }
    <li id="tab_profit_inves"><a data-toggle="tab" href="#profit_inves">Lợi nhuận đầu tư</a></li>
    {/if}

    {if $str_gid == 1 || $str_permission|strpos:":reportdeposit:" !== false }
    <li id="tab_history_recharge"><a data-toggle="tab" href="#history_recharge">Lịch sử nạp tiền</a></li>
    {/if}

    {if $str_gid == 1 || $str_permission|strpos:":reportwithdraw:" !== false }
    <li id="tab_history_withdrawal"><a data-toggle="tab" href="#history_withdrawal">Lịch sử rút tiền</a></li>
    {/if}
    
</ul>
<div class="content-pr bg-white">
    <div class="tab-content">
        <div id="history_inves" class="wrap-table-detail tab-pane active fade in">
            <div class="table-responsive table-detail">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã BĐS</th>
                            <th>Ngày mua</th>
                            <th>Nhà đầu tư</th>
                            <th>Đã mua(suất)</th>
                            <th>Giá trị</th>
                            <th width="160">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_history">
                    {* 
                        <tr>
                            <td>1</td>
                            <td class="code_real detail-product" product-id="1">QT001</td>
                            <td>15/03/2018</td>
                            <td class="profile_real detail-product" username="huynhanhtan06">Nguyễn Thành Tân</td>
                            <td>10</td>
                            <td>1,000,000,000</td>
                            <td class="text-left"><img src="{$domain}/public/images/waiting.png" alt="" width="24">Đang chờ bán</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="code_real">QT002</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Tân Đẹp Trai Vãi</td>
                            <td>1</td>
                            <td>3,000,000,000</td>
                            <td class="text-left"><img src="{$domain}/public/images/sold.png" alt="" width="24">Đã bán</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="code_real">QT006</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Tân Bá Đạo Vãi</td>
                            <td>5</td>
                            <td>1,000,000,000</td>
                            <td class="text-left"><img src="{$domain}/public/images/waiting.png" alt="" width="24">Đang chờ bán</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="code_real">BT002</td>
                            <td>21/04/2018</td>
                            <td class="profile_real">Tân Quá Bá Vãi</td>
                            <td>10</td>
                            <td>3,000,000,000</td>
                            <td class="text-left"><img src="{$domain}/public/images/waiting.png" alt="" width="24">Đang chờ bán</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td class="code_real">GV001</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Tân Đại Ca Vãi</td>
                            <td>10</td>
                            <td>1,000,000,000</td>
                            <td class="text-left"><img src="{$domain}/public/images/waiting.png" alt="" width="24">Đang chờ bán</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td class="code_real">TH002</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Nhà đầu tư F</td>
                            <td>1</td>
                            <td>3,000,000,000</td>
                            <td class="text-left"><img src="{$domain}/public/images/sold.png" alt="" width="24">Đã bán</td>
                        </tr> *}
                    </tbody>
                </table>
            </div>
            
            <!--Detail an product-->
            <div class="infomation_table infomation_code">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Mã Bất động sản</label>
                        <div class="input_name">
                            <input id="inp_code" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="label_name">Tiêu đề</label>
                        <div class="input_name">
                            <input  id="inp_title" placeholder="" class="form-control" type="text" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Danh mục</label>
                        <select id="sl_city" class="choose_cate selectpicker show-tick form-control">
                            {* <option value="1">Quận 7</option>
                            <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                <option value="1">Test Sub</option>
                            </optgroup> *}
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Số suất chào bán</label>
                        <div class="input_name">
                            <input id="inp_slots_total" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Giá trị 1 suất</label>
                        <div class="input_name">
                            <input id="inp_price" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 hide-991"></div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Trạng thái</label>
                        <div class="input_name">
                            <select id="sl_status" class="form-control">
                                <option value="0">Đang chờ bán</option>
                                <option value="1">Đã bán xong</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Giá vốn</label>
                        <div class="input_name">
                            <input id="inp_root_price" disabled class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Giá bán ra</label>
                        <div class="input_name">
                            <input id="inp_price_sold" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Tài khoản nhận tiền</label>
                        <div class="input_name">
                            <input id="inp_receive_fund_account" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Tên tài khoản nhận tiền</label>
                        <div class="input_name">
                            <input id="inp_receive_fund_fullname" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <label class="label_name">Chi phí</label>
                        <div class="input_name">
                            <input id="inp_fee_total" disabled class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <label class="label_name_1">Trong đó:</label>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Phí trước bạ</label>
                                <div class="input_name">
                                    <input id="fee_detail_1" class="form-control number-format fee-fields" label="Phí trước bạ" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Luật sư</label>
                                <div class="input_name">
                                    <input id="fee_detail_2" class="form-control number-format fee-fields" label="Luật sư" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 show-991"></div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Thuế đất</label>
                                <div class="input_name">
                                    <input id="fee_detail_3" class="form-control number-format fee-fields" label="Thuế đất" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Môi giới</label>
                                <div class="input_name">
                                    <input id="fee_detail_4" class="form-control number-format fee-fields" label="Môi giới" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Chi phí khác</label>
                                <div class="input_name">
                                    <input id="fee_detail_5" class="form-control number-format fee-fields" label="Chi phí khác" type="text" name="" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="label_name">Mô tả</label>
                        <div class="input_name">
                            <textarea id="inp_description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row"><div class="col-md-12"><label class="label_name">Hình ảnh sản phẩm</label></div></div>
                    <div class="avatar_thumbs row">
                        <a id="hold_img_show" class="col-md-2 hide"><img src="{$domain}/public/images/plus-sign.png" style="opacity:0.3;cursor:pointer;" class="img-responsive"></a>
                        {* <a class="col-md-2 img"><img src="{$domain}/public/images/product.jpg" class="img-responsive img"><i class="delete">x</i></a> *}
                    </div>
                    <input class="hide" hide id="file_uploading" type="file" name="files" value="" accept="image/x-png,image/gif,image/jpeg" />
                </div>
                <div class="text-right"><button class="btn btn-close-infomation_code cancel">OK</button></div>
            </div>

            <!--Detail an investor-->
            <div class="infomation_table infomation_profile">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <h3 class="name" id="investor_name">-</h3>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="label_name text-uppercase">Tổng số BĐS đã đầu tư</label>
                        <div class="input_name">
                            <input id="inp_user_product_invested" class="form-control" type="text" name="" value="15">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="label_name text-uppercase">Tổng tiền đã đầu tư</label>
                        <div class="input_name">
                            <input id="inp_user_total_invested" placeholder="" class="form-control" type="text" value="3,000,000,000">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 hide">
                        <label class="label_name text-uppercase">Tổng số dư tài khoản (VNĐ)</label>
                        <div class="input_name">
                            <input id="" placeholder="" class="form-control" type="text" value="1,200,000,000">
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-bg-no">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã BĐS</th>
                                <th class="text-left">Tên BĐS</th>
                                <th>Ngày mua</th>
                                <th>Đã mua(suất)</th>
                                <th>Giá trị</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody id="tpl_user_invested">
                            {* 
                            <tr>
                                <td>1</td>
                                <td>QT001</td>
                                <td class="text-left">Căn hộ cao cấp VinHouse</td>
                                <td>15/03/2018</td>
                                <td>10</td>
                                <td>1,000,000,000</td>
                                <td class="text-left"><img src="{$domain}/public/images/waiting.png" alt="" width="24">Đang chờ bán</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>GV001</td>
                                <td class="text-left">Nhà cấp 4 Quận 7</td>
                                <td>15/03/2018</td>
                                <td>110</td>
                                <td>1,000,000,000</td>
                                <td class="text-left"><img src="{$domain}/public/images/sold.png" alt="" width="24">Đã bán</td>
                            </tr> *}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div id="profit_inves" class="tab-pane fade">
            <div class="status_bds">
                <img src="{$domain}/public/images/filter.png" alt="#" width="26"><span>Trạng thái BĐS</span>
                <select id="sl_ROI_status">
                    <option value="">Tất cả</option>
                    <option value="1">Đã bán</option>
                    <option value="0">Đang chờ bán</option>
                </select>
            </div>
            <div class="table-responsive table-0-15">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã BĐS</th>
                            <th>Ngày mua</th>
                            <th>Nhà đầu tư</th>
                            <th>Đã mua(suất)</th>
                            <th>Giá trị</th>
                            <th>Lợi nhuận</th>
                            <th>Tiền phải trả</th>
                            <th>@</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_ROI">
                        {* <tr>
                            <td>1</td>
                            <td class="code_real detail-product">QT001</td>
                            <td>15/03/2018</td>
                            <td class="profile_real detail-product">Nguyễn Thành Tân</td>
                            <td>
                                <span class="dt-span">10</span>
                                <input type="text" name="" value="10" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">1,000,000,000</span>
                                <input type="text" name="" value="1,000,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">1,000,000</span>
                                <input type="text" name="" value="1,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Dự tính</span>
                                <select class="dt-select">
                                    <option>Dự tính</option>
                                    <option>Đã trả</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="code_real">QT002</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Tân Đẹp Trai Vãi</td>
                            <td>
                                <span class="dt-span">1</span>
                                <input type="text" name="" value="1" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">3,000,000,000</span>
                                <input type="text" name="" value="3,000,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">3,000,000</span>
                                <input type="text" name="" value="3,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Dự tính</span>
                                <select class="dt-select">
                                    <option>Dự tính</option>
                                    <option>Đã trả</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="code_real">QT006</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Tân Bá Đạo Vãi</td>
                            <td>
                                <span class="dt-span">5</span>
                                <input type="text" name="" value="10" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000,000</span>
                                <input type="text" name="" value="500,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000</span>
                                <input type="text" name="" value="500,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đã trả</span>
                                <select class="dt-select">
                                    <option>Đã trả</option>
                                    <option>Dự tính</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="code_real">BT002</td>
                            <td>21/04/2018</td>
                            <td class="profile_real">Tân Quá Bá Vãi</td>
                            <td>
                                <span class="dt-span">5</span>
                                <input type="text" name="" value="10" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000,000</span>
                                <input type="text" name="" value="500,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000</span>
                                <input type="text" name="" value="500,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Dự tính</span>
                                <select class="dt-select">
                                    <option>Dự tính</option>
                                    <option>Đã trả</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td class="code_real">GV001</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Tân Đại Ca Vãi</td>
                            <td>
                                <span class="dt-span">5</span>
                                <input type="text" name="" value="10" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000,000</span>
                                <input type="text" name="" value="500,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000</span>
                                <input type="text" name="" value="500,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đã trả</span>
                                <select class="dt-select">
                                    <option>Đã trả</option>
                                    <option>Dự tính</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td class="code_real">TH002</td>
                            <td>15/03/2018</td>
                            <td class="profile_real">Nhà đầu tư F</td>
                            <td>
                                <span class="dt-span">5</span>
                                <input type="text" name="" value="10" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000,000</span>
                                <input type="text" name="" value="500,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">500,000</span>
                                <input type="text" name="" value="500,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đã trả</span>
                                <select class="dt-select">
                                    <option>Đã trả</option>
                                    <option>Dự tính</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            </td>
                        </tr> *}
                    </tbody>
                </table>
            </div>
        </div>
        <div id="history_recharge" class="tab-pane fade">
            <div class="table-responsive">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ngày nạp</th>
                            <th>Nhà đầu tư</th>
                            <th>Ngân hàng</th>
                            <th>Đã nạp</th>
                            <th>Nội dung CK</th>
                            <th>Xét duyệt</th>
                            <th>@</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_deposit">
                        {* <tr>
                            <td>1</td>
                            <td>15/03/2018</td>
                            <td>Nguyễn Thành Tân</td>
                            <td>Vietcombank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>15/03/2018</td>
                            <td>Tân Đẹp Trai Vãi</td>
                            <td>MB Bank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>15/03/2018</td>
                            <td>Tân Bá Đạo Vãi</td>
                            <td>Sacombank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>15/03/2018</td>
                            <td>Tân Quá Bá Vãi</td>
                            <td>VietcomBank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>15/03/2018</td>
                            <td>Tân Đại Ca Vãi</td>
                            <td>Đông Á</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>15/03/2018</td>
                            <td>Nhà đầu tư F</td>
                            <td>Agribank</td>
                            <td>1,000,000,000</td>
                        </tr> *}
                    </tbody>
                </table>
            </div>
        </div>
        <div id="history_withdrawal" class="tab-pane fade">
            <div class="table-responsive">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ngày rút</th>
                            <th>Nhà đầu tư</th>
                            <th>Ngân hàng</th>
                            <th>Số TK</th>
                            <th>Chủ TK</th>
                            <th>Đã rút</th>
                            <th>Nội dung CK</th>
                            <th>Xét duyệt</th>
                            <th>@</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_withdraw">
                        {* <tr>
                            <td>1</td>
                            <td>15/03/2018</td>
                            <td>Nguyễn Thành Tân</td>
                            <td>Vietcombank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>15/03/2018</td>
                            <td>Tân Đẹp Trai Vãi</td>
                            <td>MB Bank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>15/03/2018</td>
                            <td>Tân Bá Đạo Vãi</td>
                            <td>Sacombank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>15/03/2018</td>
                            <td>Tân Quá Bá Vãi</td>
                            <td>VietcomBank</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>15/03/2018</td>
                            <td>Tân Đại Ca Vãi</td>
                            <td>Đông Á</td>
                            <td>1,000,000,000</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>15/03/2018</td>
                            <td>Nhà đầu tư F</td>
                            <td>Agribank</td>
                            <td>1,000,000,000</td>
                        </tr> *}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="fundingDone" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Xác nhận giao dịch</h3>
                <p>Xác nhận hoàn thành giao dịch của đơn hàng:</p>
                <p id="funding_note"></p>
                <button type="button" class="btn-gray btn" data-dismiss="modal" aria-label="Close">Đóng</button>
                <button id="btn_funding_cancel" class="close btn">Hủy giao dịch</button>
                <button id="btn_funding_done" class="btn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>	