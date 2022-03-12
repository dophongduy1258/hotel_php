<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo email/ điện thoại" class="hasDatepicker">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
              {if $str_gid == 1 || $str_permission|strpos:":mlmdelivery_commission:" !== false }
                <div class="col-md-12 col-sm-12 col-xs-12">
                <span id="btn_delivery_commission" class="add_real code_real">
                    Chia hoa hồng <img src="{$domain}/public/images/icon_delivery.png" width="24">
                </span>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <a id="show_commission_history" href="javascript:;">Lịch sử chia hoa hồng</a>
                </div>
            {/if}
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":mlmcommission:" !== false }
                <span id="btn_mngt_level" class="add_real add_staff_group">Quản lý hoa hồng <img src="{$domain}/public/images/group_management.png" width="32"></span>
                {/if}
            </div>
        </div>
   </form>
</div>

<div id="holder_info" style="display:none;" class="content-pr bg-holder info-commission-tree list-holder-content">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
            - Hệ thống của: <b id="txt_fullname"></b>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            - Người giới thiệu: <a href="javascript:;" id="txt_parent"></a>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12">
            - Hoa hồng đang có: <b id="txt_commission"></b>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            {if $str_gid == 1 || $str_permission|strpos:":staffsave:" !== false }
                <span id="btn_change_parent" class="add_real code_real">Thay người giới thiệu <img src="{$domain}/public/images/icon_change_user.png" width="24"></span>
            {/if}
        </div>
        <div class="col-md-1 col-sm-1 col-xs-12 text-right">
            <i class="fa fa-times icon-closing holder_info_closing" aria-hidden="true"></i>
        </div>
    </div>
</div>

<div class="row content-pr bg-holder info-commission-history list-holder-content infomation_table" style="display:none">
    <i id="" class="fa fa-angle-left infomation_mgt_level_back" aria-hidden="true"></i>
    <div class="authorities">
        <h2 style="margin-top: 0px;padding-top: 2px;">Lịch sử chia hoa hồng  </h2>
    </div>
    <form autocomplete="off" action="return:javascript:;">
        <div class="col-lg-2 col-md-12">
            <label class="">Từ ngày:</label>
            <div class="input_name">
                <input id="commission_from" class="form-control" type="text" name="" value="{$smarty.now|date_format:"01/m/Y"}">
            </div>
        </div>
        <div class="col-lg-2 col-md-12">
            <label class="">Đến ngày:</label>
            <div class="input_name">
                <input id="commission_to" class="form-control" type="text" name="" value="">
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="input_name">
                <button id="btn_commission_history" class="btn">Xem</button>
            </div>
        </div>
    </form>
</div>

<div class="content-pr bg-white">

    <div class="wrap-table-detail">
        
        <div class="row info-commission-tree list-holder-content">
            <ul class="nav nav-tabs nav-storing">
                {foreach from=$lLevel key=key item=item}
                    <li id="tab_list_level_{$item.id}" level-id="{$item.id}" class="{if $item.id == 1}active{/if} tab_list_level">
                        <a data-toggle="tab" href="#tab_list_level">{$item.name} (<span class="tab-record-total" id="tab-record-total-{$item.id}" title="Tổng số cấp con ở cấp này">-</span>)</a>
                    </li>
                {/foreach}
            </ul>

            <!--BEGIN main infomation-->
            <div class="table-responsive table-detail table-0-15">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Hoa hồng đang có</th>
                            <th width="112">@</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_list">
                    </tbody>
                </table>
                <div class="col-lg-12 col-md-12 top10">
                    <div id="page_html" class="col-lg-12 col-md-12">
                    </div>
                    <input id="current_page" class="hidden" value="1">
                </div>
            </div>
        </div>
        
        <!--Level managament template-->
        <div class="infomation_table infomation_group_level list-holder-content" style="display:none">
            <i id="" class="fa fa-angle-left infomation_mgt_level_back" aria-hidden="true"></i>
            <div class="authorities">
                <h2 style="margin-top: 0px;padding-top: 2px;">Quản lý mức hoa hồng  </h2>
            </div>
            <div class="category_real gid">
                <div class="item">
                    <ul class="sub">
                        <li class="list-gid">
                            <div class="row">
                                <div class="col-sm-8 col-xs-12 text-right">
                                Tổng mức hoa hồng:
                                </div>
                                <div class="col-sm-3 col-xs-12 text-right">
                                    <b id="total_commission" class="color-red">-</b>
                                </div>
                                <div class="col-sm-1 col-xs-12 ">
                                </div>
                            </div>
                        </li>
                    {foreach from=$lLevel item=item}
                        <li class="list-gid">
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    {$item.name}
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <input id="level-commisison-{$item.id}" level-id="{$item.id}" class="level-commission text-right number-format-decimal" value="{$item.commission}" title="{$item.commission}"/>
                                </div>
                                <div class="col-sm-1 col-xs-12 ">
                                    <img gid="{$item.id}" class="gid-delete hide top-10" src="{$domain}/public/images/edit.png" alt="" width="24">
                                </div>
                            </div>
                        </li>
                    {/foreach}
                    </ul>
                </div>
            </div>
        </div>

        <!--COmmission history template-->
        <div class="row info-commission-history list-holder-content" style="display:none">
            <div class="table-responsive table-detail table-0-15 border-t">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Từ</th>
                            <th>Hoa hồng</th>
                            <th>Đã phát</th>
                            <th>Người tạo</th>
                            <th>Ngày tạo</th>
                            <th>Ghi chú</th>
                            <th width="112">@</th>
                        </tr>
                    </thead>
                    <tbody id="commission_tpl_list">
                    </tbody>
                </table>
                <div class="col-lg-12 col-md-12 top10">
                    <div id="commisison_page_html" class="col-lg-12 col-md-12">
                    </div>
                    <input id="commisison_current_page" class="hidden" value="1">
                </div>
            </div>
        </div>

        <!--Chia hoa hồng modal-->
        <div id="deliveryCommission" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Chia hoa hồng</h3>

                        <div class="row">
                            <form autocomplete="off" action="return:javascript:;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label title="Tìm thành viên mà người tạo ra hoa hồng" class="label_name">Thành viên</label>
                                    <div title="Tìm thành viên mà người tạo ra hoa hồng" class="input_name">
                                        <input placeholder="Họ tên/ Số điện thoại/ Email" id="commission_searching" class="form-control" type="text" name="" value="" username="" user_id="">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 border-t">
                                    <label class="label_name">Họ tên</label>
                                    <div class="input_name">
                                        <b href="javascript:;" class="txt_name">-</b>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="label_name">Số điện thoại/ Email</label>
                                    <div class="input_name">
                                        <b class="txt_mobile">-/-</b>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 border-t">
                                    <label class="label_name">Cấp cha</label>
                                    <div class="input_name">
                                        <a class="txt_parent_name commission_parent_select">-</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="label_name">Số điện thoại/ Email</label>
                                    <div class="input_name">
                                        <a class="txt_parent_mobile commission_parent_select">-/-</a>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="label_name">Số tiền hoa hồng</label>
                                    <div class="input_name">
                                        <input id="amount" class="form-control number-format" type="text" name="" value="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <label class="label_name">Ghi chú</label>
                                    <div class="input_name">
                                        <textarea id="note"></textarea>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="row text-right">
                            <button type="button" class="btn cancel" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_commission_confirm" class="btn confirm">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                <!--Chia hoa hồng modal-->
        <div id="historyCommission" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Lịch sử đã chia hoa hồng</h3>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 border-t">
                                <label class="label_name">Phát sinh từ</label>
                                <div class="input_name">
                                    <span id="ch_fullname"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 border-t">
                                <label class="label_name">Ngày tạo</label>
                                <div class="input_name">
                                    <span id="ch_created_at"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="label_name">Tiền hoa hồng</label>
                                <div class="input_name">
                                    <span id="ch_total"></span>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="label_name">Số tiền đã chia</label>
                                <div class="input_name">
                                    <span id="ch_total_delivered"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="label_name">Ghi chú</label>
                                <div class="input_name">
                                    <span id="ch_note"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive table-detail table-0-15 border-t">
                                <table class="table table-bg-no">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Người nhận</th>
                                            <th>Số tiền</th>
                                            <th>Cấp</th>
                                        </tr>
                                    </thead>
                                    <tbody id="history_tpl_list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row text-right">
                            <button type="button" class="btn cancel" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Chia hoa hồng modal-->
        <div id="changeParent" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thay đổi người giới thiệu</h3>

                        <div class="row">
                            <form autocomplete="off" action="return:javascript:;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label title="Tìm thành viên mà người tạo ra hoa hồng" class="label_name">Người giới thiệu mới</label>
                                    <div title="Tìm thành viên mà người tạo ra hoa hồng" class="input_name">
                                        <input placeholder="Họ tên/ Số điện thoại/ Email" id="parent_searching" class="form-control" type="text" name="" value="" username="" user_id="">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 border-t">
                                    <label class="label_name">Họ tên</label>
                                    <div class="input_name">
                                        <b href="javascript:;" class="txt_name">-</b>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="label_name">Số điện thoại/ Email</label>
                                    <div class="input_name">
                                        <b class="txt_mobile">-/-</b>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 border-t">
                                    <label class="label_name">Cấp cha</label>
                                    <div class="input_name">
                                        <a class="txt_parent_name change_parent_select">-</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="label_name">Số điện thoại/ Email</label>
                                    <div class="input_name">
                                        <a class="txt_parent_mobile change_parent_select">-/-</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="row text-right">
                            <button type="button" class="btn cancel" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_new_parent_confirm" class="btn confirm">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>