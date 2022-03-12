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
                    <p><font color="#D22326" size="4"><b><span id="total_record">-</span>/<span id="total_sum">-</span></b></font></p>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12 text-right">
                    <a><img src="{$domain}/public/images/download.png" width="30" class="icon-download"></a>
                    <a><img src="{$domain}/public/images/print.png" width="30" class="icon-download"></a>
                </div>
            </div>
        </div>

        <!--BEGIN main Transaction-->
        <th class="table-responsive table-detail table-0-15 content-form">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ngày GD</th>
                        {* <th>Người chuyển</th> *}
                        <th>Sản phẩm</th>
                        <th>Từ người</th>
                        <th>Đến người</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th width="30%">Ghi chú</th>
                        <th class="text-left">
                            <div class="chosse_transaction">
                                <select id="sl_status">
                                    <option value="" >Trạng thái</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Done</option>
                                </select>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </th>
                        <th class="text-left">
                            @
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
        
        <div id="hd_page_html" class="col-lg-12 col-md-12 top10">
            <div id="page_html" class="col-lg-12 col-md-12 top10">
            </div>
            <input id="current_page" class="hidden" value="1" >
        </div>

    </div>
</div>