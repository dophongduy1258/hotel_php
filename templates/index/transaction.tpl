<div class="search-order content-form">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo nhà đầu tư" class="hasDatepicker">
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
                        <input id="to" type="text" name="" placeholder="Đến ngày">
                        <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="content-pr bg-white">
    <div class="wrap-table-detail">

        <div class="status_transaction content-form">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <p>
                        <font color="#D22326" size="4"><b><span id="total_transactions">10,000,000,000</span>/<span id="no_transactions">50</span> giao dịch</b></font>
                    </p>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12 text-right">
                    <a><img src="{$domain}/public/images/download.png" width="30" class="icon-download"></a>
                    <a><img src="{$domain}/public/images/print.png" width="30" class="icon-download"></a>
                    {if $str_gid == 1 || $str_permission|strpos:":transactionwithdraw:" !== false }
                        <button id="btn_withdraw" class="btn btn_withdraw">Rút tiền</button>
                    {/if}
                    {if $str_gid == 1 || $str_permission|strpos:":transactiondeposit:" !== false }
                        <button id="btn_deposit" class="btn btn_deposit">Nạp tiền</button>
                    {/if}
                </div>
            </div>
        </div>

        <!--BEGIN main Transaction-->
        <div class="table-responsive table-detail table-0-15 content-form">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ngày GD</th>
                        {* <th>Người chuyển</th> *}
                        <th>Người nhận</th>
                        <th>Giá trị GD</th>
                        <th>Phí GD</th>
                        <th>Tổng tiền</th>
                        <th width="20%">Mô tả</th>
                        <th width="10%">Người tạo</th>
                        <th class="text-left">
                            <div class="chosse_transaction">
                                <select id="slDeposit">
                                    <option value="">Loại GD</option>
                                    <option value="1">Nạp tiền</option>
                                    <option value="0">Rút tiền</option>
                                </select>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="tpl_list_transaction">
                    {*
                    <tr>
                        <td>1</td>
                        <td>
                            <span class="dt-span">11/11/2018</span>
                            <input type="text" name="" value="11/11/2018" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">Nguyễn Thành Tân</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">Kaido Nguyễn</span>
                            <input type="text" name="" value="Kaido Nguyễn" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">50.000.000</span>
                            <input type="text" name="" value="50.000.000" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">50.000</span>
                            <input type="text" name="" value="50.000" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">50.050.000</span>
                            <input type="text" name="" value="50.050.000" class="dt-select">
                        </td>
                        <td class="text-left">
                            <span class="dt-span user_deposit">Nạp tiền</span>
                        </td>
                    </tr>*}
                </tbody>
            </table>
        </div>

        <!-- Start Edit Transaction Deposit -->
        <div class="infomation_table infomation_transaction_deposit content-form">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <b>
                <font color="#0C4155" size="4">Nạp tiền cho User</font>
            </b>
            <p style="color: #999;font-size: 17px;margin-top: 20px;margin-bottom:30px;">Xin vui lòng sử dụng các chi tiết thanh toán để thực hiện giao dịch nạp tiền</p>
            <div class="row search_NDT">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <p>Tìm kiếm thông tin user</p>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <input id="d_searching" type="text" name="" placeholder="Tìm theo tên/email/số điện thoại NĐT">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">Họ & tên người nhận</label>
                    <div class="input_name">
                        <input disabled id="d_name" class="form-control" type="text" name="" value="Nguyễn Thành Tân">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">Số điện thoại</label>
                    <div class="input_name">
                        <input disabled id="d_mobile" placeholder="" class="form-control" type="text" value="0976 674 647">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">Email</label>
                    <div class="input_name">
                        <input disabled id="d_email" class="form-control" type="text" name="" value="tannt2103@gmail.com">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        Số dư TK VND
                    </label>
                    <div class="input_name">
                        <input disabled id="d_balance" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                {*<div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_dVND' name='type' />
                        <span class="lbl"></span>
                        Số dư TK VND
                    </label>
                    <div class="input_name">
                        <input disabled id="d_vnd" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_dBRS' name='type' />
                        <span class="lbl"></span>
                        Số dư TK BRS
                    </label>
                    <div class="input_name">
                        <input disabled id="d_brs" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_dVNDC' name='type' />
                        <span class="lbl"></span>
                        Số dư TK VNDC
                    </label>
                    <div class="input_name">
                        <input disabled id="d_vndc" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_dVSG' name='type' />
                        <span class="lbl"></span>
                        Số dư TK VSG
                    </label>
                    <div class="input_name">
                        <input disabled id="d_vsg" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div> *}
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="label_name">Số tiền cần nạp</label>
                    <div class="input_name">
                        <input id="d_value" class="form-control number-format" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <label class="label_name">Nội dung</label>
                    <div class="input_name">
                        <textarea id="d_note"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-right"><button class="btn btn-close-infomation_transaction deposit cancel">Huỷ</button><button class="btn" id="d_btn">Nạp ngay</button></div>
        </div>
        <!-- End Edit Transaction Deposit -->

        <!-- Start Edit Transaction Withdraw -->
        <div class="infomation_table infomation_transaction_withdraw content-form">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <b>
                <font color="#0C4155" size="4">Rút tiền của User</font>
            </b>
            <p style="color: #999;font-size: 17px;margin-top: 20px;margin-bottom:30px;">Xin vui lòng sử dụng các chi tiết thanh toán để thực hiện giao dịch nạp tiền</p>
            <div class="row search_NDT">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <p>Tìm kiếm thông tin user</p>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <input id="w_searching" type="text" name="" placeholder="Tìm theo tên/email/số điện thoại NĐT">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">Họ & tên người chuyển</label>
                    <div class="input_name">
                        <input disabled id="w_name" class="form-control" type="text" name="" value="Nguyễn Thành Tân">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">Số điện thoại</label>
                    <div class="input_name">
                        <input disabled id="w_mobile" placeholder="" class="form-control" type="text" value="0976 674 647">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">Email</label>
                    <div class="input_name">
                        <input disabled id="w_email" class="form-control" type="text" name="" value="tannt2103@gmail.com">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="input_name">
                        <label class="label_name">
                            Số dư TK VND
                        </label>
                        <input disabled id="w_balance" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                {*<div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_wVND' name='type' />
                        <span class="lbl"></span>
                        Số dư TK VND
                    </label>
                    <div class="input_name">
                        <input disabled id="w_vnd" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_wBRS' name='type' />
                        <span class="lbl"></span>
                        Số dư TK BRS
                    </label>
                    <div class="input_name">
                        <input disabled id="w_brs" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_wVNDC' name='type' />
                        <span class="lbl"></span>
                        Số dư TK VNDC
                    </label>
                    <div class="input_name">
                        <input disabled id="w_vndc" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <label class="label_name">
                        <input class="ace" type='radio' id='radio_wVSG' name='type' />
                        <span class="lbl"></span>
                        Số dư TK VSG
                    </label>
                    <div class="input_name">
                        <input disabled id="w_vsg" class="form-control" type="text" name="" value="10,000,000,000">
                    </div>
                </div>*}
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="label_name">Số tiền cần rút</label>
                    <div class="input_name">
                        <input id="w_value" class="form-control number-format" type="text" name="" value="">
                    </div>
                </div> 
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <label class="label_name">Nội dung</label>
                    <div class="input_name">
                        <textarea id="w_note"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-right"><button class="btn btn-close-infomation_transaction withdraw cancel">Huỷ</button><button class="btn" id="w_btn">Rút ngay</button></div>
        </div>
        <!-- End Edit Transaction Withdraw -->

        <!-- Start Bill Deposit -->
        <div class="infomation_table infomation_table_bill infomation_transaction_deposit_bill content-form">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <b>
                <font color="#0C4155" size="4">Biên lại nạp tiền</font>
            </b>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Mã giao dịch</label>
                    <div class="input_name">
                        <span id="d_transaction_id" class="form-control">GD00912</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Ngày chờ giao dịch</label>
                    <div class="input_name">
                        <span id="d_date" class="form-control">10/12/2018 09:12 AM</span>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="label_name">Số tiền</label>
                    <div class="input_name">
                        <span id="d_amount" class="form-control">50.000.000</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <label class="label_name">Nạp tiền cho</label>
                    <div id="d_info" dateclass="input_name">
                        <span class="form-control">
                            Nguyễn Thành Tân
                            <span>9333 3938 3934</span>
                            <span>Ngân hàng ngoài thương VietcomBank</span>
                        </span>
                    </div>
                </div>
                {* <div class="col-md-6 col-sm-12 col-xs-12">
                    <label class="label_name">Đến</label>
                    <div id="d_info_to" class="input_name">
                        <span class="form-control">
                            Kaido Nguyen
                            <span>9333 3938 3934</span>
                            <span>Ngân hàng ngoài thương VietcomBank</span>
                        </span>
                    </div>
                </div> *}
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <label class="label_name">Nội dung chuyển khoản</label>
                    <div class="input_name">
                        <textarea id="d_memo"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-right"><button id="deposit-printing" class="btn deposit-printing cancel">In</button><button id="d_btn_ok" class="btn">OK</button></div>
        </div>
        <!-- End Bill Deposit -->

        <!-- Start Bill Withdraw -->
        <div class="infomation_table infomation_table_bill infomation_transaction_withdraw_bill content-form">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <b>
                <font color="#0C4155" size="4">Biên lại rút tiền</font>
            </b>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Mã giao dịch</label>
                    <div class="input_name">
                        <span id="w_transaction_id" class="form-control">GD00912</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Ngày chờ giao dịch</label>
                    <div class="input_name">
                        <span id="w_date" class="form-control">10/12/2018 09:12 AM</span>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="label_name">Số tiền</label>
                    <div class="input_name">
                        <span id="w_amount" class="form-control">50.000.000</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <label class="label_name">Rút tiền của</label>
                    <div id="w_info" class="input_name">
                        <span class="form-control">
                            Nguyễn Thành Tân
                            <span>9333 3938 3934</span>
                            <span>Ngân hàng ngoài thương VietcomBank</span>
                        </span>
                    </div>
                </div>
                {* <div class="col-md-6 col-sm-12 col-xs-12">
                    <label class="label_name">Đến</label>
                    <div class="input_name">
                        <span class="form-control">
                            Kaido Nguyen
                            <span>9333 3938 3934</span>
                            <span>Ngân hàng ngoài thương VietcomBank</span>
                        </span>
                    </div>
                </div> *}
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <label class="label_name">Nội dung chuyển khoản</label>
                    <div class="input_name">
                        <textarea id="w_meno"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-right"><button class="btn withdraw-printing cancel">In</button><button id="w_btn_ok" class="btn">OK</button></div>
        </div>
        <!-- End Bill Withdraw -->

    </div>
</div>